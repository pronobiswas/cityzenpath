<?php 
function custom_multistep_form() {
    if (!is_user_logged_in()) {
        return '<p>You must be logged in to access this form.</p>';
    }

    $user_id = get_current_user_id();
    $max_forms = 5;

    // Get saved forms count by checking actual stored form titles
    $saved_forms = [];
    $user_meta = get_user_meta($user_id);
    
    foreach ($user_meta as $key => $value) {
        if (strpos($key, 'multi_step_form_title_') !== false) {
            $form_id = str_replace('multi_step_form_title_', '', $key);
            $saved_forms[] = intval($form_id);
        }
    }

    $current_form_count = count($saved_forms);

    // Handle new form creation only if `new_id` is not in URL
    if (isset($_GET['bd']) && $_GET['bd'] == 'newform' && !isset($_GET['new_id'])) {
        if ($current_form_count >= $max_forms) {
            return '<p style="color:red;">You have reached the maximum limit of 5 forms.</p>';
        }

        $new_form_id = max($saved_forms) + 1; // Generate next form ID

        // Redirect to include `new_id` in the URL
        wp_redirect(get_permalink() . '?bd=newform&new_id=' . $new_form_id);
        exit;
    }

    // Determine form ID
    $form_id = isset($_GET['new_id']) ? intval($_GET['new_id']) : (isset($_GET['form_id']) ? intval($_GET['form_id']) : 1);

    // Fetch stored form data
    $form_title = get_user_meta($user_id, "multi_step_form_title_{$form_id}", true);
    $name       = get_user_meta($user_id, "multi_step_name_{$form_id}", true);
    $email      = get_user_meta($user_id, "multi_step_email_{$form_id}", true);
    $address    = get_user_meta($user_id, "multi_step_address_{$form_id}", true);
    $nid        = get_user_meta($user_id, "multi_step_nid_{$form_id}", true);
    $passport   = get_user_meta($user_id, "multi_step_passport_{$form_id}", true);

    ob_start();
    ?>
    <form id="multiStepForm" method="post" action="">
        <?php wp_nonce_field('multi_step_form_nonce', 'multi_step_nonce'); ?>
        <input type="hidden" name="form_id" id="form_id" value="<?php echo esc_attr($form_id); ?>">

        <div class="step step-1">
            <h3>Personal Details</h3>
            <label>Form Title:</label>
            <input type="text" id="form_title" name="form_title" value="<?php echo esc_attr($form_title); ?>" placeholder="Enter form title" required>
            <label>Name:</label>
            <input type="text" name="name" id="name" value="<?php echo esc_attr($name); ?>" required>
            <label>Email:</label>
            <input type="email" name="email" id="email" value="<?php echo esc_attr($email); ?>" required>
            <label>Address:</label>
            <textarea name="address" id="address"><?php echo esc_textarea($address); ?></textarea>
            <div class="mt-3">
                <button type="button" class="save-progress" data-step="1">Save</button>
                <button type="button" class="next-step" data-step="1">Next →</button>
            </div>
        </div>

        <div class="step step-2" style="display: none;">
            <h3>Identity</h3>
            <label>NID:</label>
            <input type="text" name="nid" id="nid" value="<?php echo esc_attr($nid); ?>">
            <label>Passport:</label>
            <input type="text" name="passport" id="passport" value="<?php echo esc_attr($passport); ?>">
            <div class="mt-3">
                <button type="button" class="prev-step">← Previous</button>
                <button type="button" class="save-progress" data-step="2">Save</button>
                <button type="button" class="next-step" data-step="2">Next →</button>
            </div>
        </div>

        <div class="step step-3" style="display: none;">
            <h3>Confirmation</h3>
            <p>Review your information before submitting.</p>
            <div class="mt-3">
                <button type="button" class="prev-step">← Previous</button>
                <button type="submit" name="submit_form">Submit</button>
                <button type="button" id="generatePdf">Download PDF</button>
            </div>
        </div>
    </form>

    <p>You have created <?php echo esc_html($current_form_count); ?> out of <?php echo esc_html($max_forms); ?> allowed forms.</p>

    <?php
    return ob_get_clean();
}
add_shortcode('multistep_form', 'custom_multistep_form');
?>
