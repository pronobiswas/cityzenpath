<?php 
function save_multistep_form_progress() {
    if (!isset($_POST['multi_step_nonce']) || !wp_verify_nonce($_POST['multi_step_nonce'], 'multi_step_form_nonce')) {
        wp_send_json_error(['message' => 'Security check failed!']);
    }

    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'User not logged in']);
    }

    $user_id = get_current_user_id();
    $form_id = isset($_POST['form_id']) ? sanitize_text_field($_POST['form_id']) : '';

    if (empty($form_id)) {
        wp_send_json_error(['message' => 'Form ID is missing!']);
    }

    // Debugging Output
    error_log(print_r($_POST, true));  

    $fields = ['form_id', 'form_title', 'name', 'email', 'address', 'nid', 'passport'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_user_meta($user_id, "multi_step_{$field}_{$form_id}", sanitize_text_field($_POST[$field]));
        }
    }

    wp_send_json_success(['message' => 'Progress saved successfully!']);
}
add_action('wp_ajax_save_multistep_form_progress', 'save_multistep_form_progress');
