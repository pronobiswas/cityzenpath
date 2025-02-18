<?php
function save_step_data() {
    if (!is_user_logged_in() || !isset($_POST['multi_step_nonce']) || !wp_verify_nonce($_POST['multi_step_nonce'], 'multi_step_form_nonce')) {
        wp_send_json_error(['message' => 'Security check failed']);
    }

    $user_id = get_current_user_id();
    
    $last_form_id = get_user_meta($user_id, 'multi_step_last_form_id', true);
    $form_id = isset($_POST['form_id']) && !empty($_POST['form_id']) 
               ? sanitize_text_field($_POST['form_id'])  
               : (($last_form_id) ? intval($last_form_id) + 1 : 1); // Start from 1 if none exist

    update_user_meta($user_id, 'multi_step_last_form_id', $form_id);

    $fields = ['form_title', 'name', 'email', 'address', 'nid', 'passport'];
    $is_complete = true;

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_user_meta($user_id, "multi_step_{$field}_{$form_id}", sanitize_text_field($_POST[$field]));
        }
    }

    foreach ($fields as $field) {
        if (empty(get_user_meta($user_id, "multi_step_{$field}_{$form_id}", true))) {
            $is_complete = false;
            break;
        }
    }

    update_user_meta($user_id, "multi_step_completed_{$form_id}", $is_complete ? '1' : '0');

    wp_send_json_success([
        'message' => $is_complete ? 'Form completed successfully!' : 'Step saved!',
        'completed' => $is_complete,
        'form_id' => $form_id
    ]);
}
add_action('wp_ajax_save_step_data', 'save_step_data');
