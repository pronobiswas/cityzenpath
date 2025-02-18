<?php
// Enqueue styles and scripts
function child_enqueue_files() {
    // Parent and child theme styles
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'));

    // Additional styles
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');
    wp_enqueue_style('login-custom', get_stylesheet_directory_uri() . '/assets/css/login.css');
}
add_action('wp_enqueue_scripts', 'child_enqueue_files');

// Enqueue assets for the user dashboard
function enqueue_user_dashboard_assets() {
    if (is_page_template('user-dashboard.php')) {
        wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.css');
        wp_enqueue_style('meteor', get_stylesheet_directory_uri() . '/assets/css/meteor.min.css');
        wp_enqueue_style('simple-line', get_stylesheet_directory_uri() . '/assets/plugins/line-icons/simple-line-icons.css');
        wp_enqueue_style('dark-layer', get_stylesheet_directory_uri() . '/assets/css/layers/dark-layer.css');
        wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/plugins/fontawesome/css/font-awesome.min.css');

        // JavaScript files
        wp_enqueue_script('jquery-ui', get_stylesheet_directory_uri() . '/assets/plugins/jquery-ui/jquery-ui.min.js', array('jquery'), null, true);
        wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), null, true);
        wp_enqueue_script('waves', get_stylesheet_directory_uri() . '/assets/plugins/waves/waves.min.js', array('jquery'), null, true);
        wp_enqueue_script('meteor', get_stylesheet_directory_uri() . '/assets/js/meteor.min.js', array('jquery'), null, true);

        wp_enqueue_script('multistep-form', get_stylesheet_directory_uri() . '/assets/js/multistep-form.js', array('jquery'), null, true);
        wp_localize_script('multistep-form', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));



    }
}   
add_action('wp_enqueue_scripts', 'enqueue_user_dashboard_assets');

// Hide admin bar for subscribers
add_action('after_setup_theme', function () {
    if (current_user_can('subscriber')) {
        show_admin_bar(false);
    }
});

// Allow admins to access WP Admin and restrict subscribers
add_action('admin_init', function () {
    if (is_admin() && !wp_doing_ajax() && current_user_can('subscriber')) {
        wp_redirect(home_url('/user-dashboard/'));
        exit;
    }
});

// Redirect non-logged-in users away from user-dashboard
function restrict_dashboard_access() {
    if (is_page_template('user-dashboard.php') && !is_user_logged_in()) {
        wp_redirect(home_url('/user-login/')); // Redirect to login page
        exit;
    }
}
add_action('template_redirect', 'restrict_dashboard_access');

// Custom login redirect based on user role
function custom_login_redirect($redirect_to, $request, $user) {
    if (isset($user->roles) && is_array($user->roles)) {
        // Subscribers go to the user dashboard
        if (in_array('subscriber', $user->roles)) {
            return home_url('/user-dashboard/');
        }
        // Admins and others go to WP Admin
        return admin_url();
    }
    return $redirect_to;
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);

// Ensure logout redirects users correctly
function custom_logout_redirect() {
    wp_redirect(home_url('/user-login/')); // Redirect to login page after logout
    exit();
}



// Load the Form
require_once get_stylesheet_directory() . '/multistep-form.php';

// Load Form Handling & PDF Generation
require_once get_stylesheet_directory() . '/inc/save-step.php';

function form_status_shortcode() {
    if (!is_user_logged_in()) {
        return '<p>You must be logged in.</p>';
    }

    $user_id = get_current_user_id();
    
    // Corrected ternary operation
    $form_id = isset($_GET['form_id']) ? intval($_GET['form_id']) : (get_user_meta($user_id, 'multi_step_last_form_id', true) ?: 1);
    
    $form_completed = get_user_meta($user_id, "multi_step_completed_{$form_id}", true);

    // Debugging log
    error_log("User ID: $user_id | Form ID: $form_id | Status: " . print_r($form_completed, true));

    if ($form_completed == '1') {
        return '<p style="color: green; font-weight: bold;">Form Completed</p>';
    } else {
        return '<p style="color: red; font-weight: bold;">Incomplete Form</p>';
    }
}
add_shortcode('form_status', 'form_status_shortcode');


//delete form
function delete_user_form() {
    if (!is_user_logged_in() || !isset($_POST['form_id'])) {
        wp_send_json_error("Invalid request");
    }

    $user_id = get_current_user_id();
    $form_id = intval($_POST['form_id']);

    // Delete form-related user meta
    delete_user_meta($user_id, "multi_step_completed_{$form_id}");
    delete_user_meta($user_id, "multi_step_last_form_id", $form_id);

    wp_send_json_success();
}
add_action('wp_ajax_delete_user_form', 'delete_user_form');


//pdf generate
add_action('wp_ajax_generate_pdf', 'generate_pdf');

function generate_pdf() {
    require_once get_stylesheet_directory() . '/tcpdf/tcpdf.php';

    if (!is_user_logged_in()) {
        wp_die('Unauthorized access');
    }

    $user_id = get_current_user_id();
    $name = get_user_meta($user_id, 'multi_step_name', true);
    $email = get_user_meta($user_id, 'multi_step_email', true);
    $address = get_user_meta($user_id, 'multi_step_address', true);
    $nid = get_user_meta($user_id, 'multi_step_nid', true);
    $passport = get_user_meta($user_id, 'multi_step_passport', true);

    if (!class_exists('TCPDF')) {
        die('TCPDF library not found.');
    }

    $pdf = new TCPDF();
    $pdf->AddPage();
    $html = "<h2>User Information</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Address:</strong> $address</p>
    <p><strong>NID:</strong> $nid</p>
    <p><strong>Passport:</strong> $passport</p>";

    $pdf->writeHTML($html);

    // Fix for corrupted PDFs
    ob_end_clean();
    $pdf->Output('user-details.pdf', 'I'); 
    exit;
}
