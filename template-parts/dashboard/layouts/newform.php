<?php
$user_id = get_current_user_id();
//$form_id = get_user_meta($user_id, 'multi_step_last_form_id', true);

if (isset($_GET['new_id'])) {
    $form_id = intval($_GET['new_id']);
} elseif (isset($_GET['form_id'])) {
    $form_id = intval($_GET['form_id']);
} else {
    $form_id = get_user_meta($user_id, 'multi_step_last_form_id', true);
    $form_id = ($form_id) ? intval($form_id) : 1; // Default to 1 if no ID is found
}


if ($form_id > 0) {
    echo do_shortcode('[multistep_form id="' . esc_attr($form_id) . '"]');
} else {
    echo '<p style="color: red; font-weight: bold;">No form selected.</p>';
}
?>
