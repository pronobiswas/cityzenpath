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
add_action('wp_logout', 'custom_logout_redirect');


function handle_user_dashboard_form() {
    if (isset($_POST['user_dashboard_form'])) {
        // Verify Nonce (Security Check)
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'user_dashboard_action')) {
            wp_die('Security check failed!');
        }

        // Get Current User
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;

        // Sanitize Inputs
        $user_name = sanitize_text_field($_POST['user_name']);
        $user_email = sanitize_email($_POST['user_email']);

        // Update User Data
        wp_update_user([
            'ID'           => $user_id,
            'display_name' => $user_name,
            'user_email'   => $user_email
        ]);

        // Redirect After Submission
        wp_redirect(add_query_arg('updated', 'true', get_permalink()));
        exit;
    }
}
add_action('init', 'handle_user_dashboard_form');

//menu
function custom_user_menu_item($items, $args) {
    if ($args->theme_location !== 'primary') {
        return $items;
    }

    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        
        if (in_array('subscriber', $current_user->roles)) {
            $dashboard_url = site_url('/user-dashboard/');
            $logout_url = wp_logout_url(site_url('/user-login/')); // Redirect after logout
            
            $items .= '<li class="menu-item"><a href="' . esc_url($dashboard_url) . '">Dashboard</a></li>';
        }
    } else {
        $login_url = site_url('/user-login/');
        $register_url = site_url('/user-register/');

        $items .= '<li class="menu-item"><a href="' . esc_url($login_url) . '">Login</a></li>';
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'custom_user_menu_item', 10, 2);



