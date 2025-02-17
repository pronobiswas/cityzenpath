<?php
function save_step_data() {
    if (!is_user_logged_in() || !isset($_POST['multi_step_nonce']) || !wp_verify_nonce($_POST['multi_step_nonce'], 'multi_step_form_nonce')) {
        wp_send_json_error(['message' => 'Security check failed']);
    }

    $user_id = get_current_user_id();
    $fields = ['name', 'email', 'address', 'nid', 'passport'];
    $is_complete = true;

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_user_meta($user_id, 'multi_step_' . $field, sanitize_text_field($_POST[$field]));
        }
    }

    // Check if all required fields are filled
    foreach ($fields as $field) {
        if (empty(get_user_meta($user_id, 'multi_step_' . $field, true))) {
            $is_complete = false;
            break;
        }
    }

    // Update form completion status
    update_user_meta($user_id, 'multi_step_completed', $is_complete ? '1' : '0');

    wp_send_json_success([
        'message' => $is_complete ? 'Form completed successfully!' : 'Step saved!',
        'completed' => $is_complete
    ]);
}
add_action('wp_ajax_save_step_data', 'save_step_data');
