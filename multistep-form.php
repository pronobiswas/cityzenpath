<?php
function custom_multistep_form() {
    if (!is_user_logged_in()) {
        return '<p>You must be logged in to access this form.</p>';
    }
    
    $user_id = get_current_user_id();
    $name = get_user_meta($user_id, 'multi_step_name', true);
    $email = get_user_meta($user_id, 'multi_step_email', true);
    $address = get_user_meta($user_id, 'multi_step_address', true);
    $nid = get_user_meta($user_id, 'multi_step_nid', true);
    $passport = get_user_meta($user_id, 'multi_step_passport', true);

    ob_start();
    ?>
    <form id="multiStepForm" method="post" action="">
        <?php wp_nonce_field('multi_step_form_nonce', 'multi_step_nonce'); ?>
        
        <div class="step step-1">
            <h3>Personal Details</h3>
            <label>Name:</label>
            <input type="text" name="name" id="name" value="<?php echo esc_attr($name); ?>" required>
            <label>Email:</label>
            <input type="email" name="email" id="email" value="<?php echo esc_attr($email); ?>" required>
            <label>Address:</label>
            <textarea name="address" id="address"><?php echo esc_textarea($address); ?></textarea>
            <button type="button" class="save-progress" data-step="1">Save</button>
            <button type="button" class="next-step" data-step="1">Next →</button>
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
    <?php
    return ob_get_clean();
}
add_shortcode('multistep_form', 'custom_multistep_form');
