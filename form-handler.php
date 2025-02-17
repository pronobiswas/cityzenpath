<?php 

function save_multistep_form() {
    if (!is_user_logged_in() || !isset($_POST['form_data'])) {
        wp_send_json_error(['message' => 'Unauthorized']);
    }

    parse_str($_POST['form_data'], $form_data);
    $user_id = get_current_user_id();

    // Save each field separately
    foreach ($form_data as $key => $value) {
        update_user_meta($user_id, 'multistep_form_' . $key, sanitize_text_field($value));
    }

    wp_send_json_success(['message' => 'Form saved successfully!']);
}
add_action('wp_ajax_save_multistep_form', 'save_multistep_form');
add_action('wp_ajax_nopriv_save_multistep_form', 'save_multistep_form');
