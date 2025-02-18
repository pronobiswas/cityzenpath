<div class="container">
  <div class="bg-light p-5 rounded">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Form Name</th>
                <th scope="col">Progress</th>
                <th scope="col"></th>
                <th scope="col"></th> <!-- New column for Delete -->
            </tr>
        </thead>
        <tbody>
            <?php
            $user_id = get_current_user_id();
            $forms = get_user_meta($user_id);
            $form_list = [];

            // Get all completed forms
            foreach ($forms as $meta_key => $meta_value) {
                if (strpos($meta_key, 'multi_step_completed_') !== false) {
                    $form_id = str_replace('multi_step_completed_', '', $meta_key);
                    $form_list[] = intval($form_id);
                }
            }

            if (!empty($form_list)) {
                foreach ($form_list as $form_id) {
                    $form_completed = get_user_meta($user_id, "multi_step_completed_{$form_id}", true);
                    $form_title = get_user_meta($user_id, "multi_step_form_title_{$form_id}", true);

                    // If no title is set, use a default value
                    $form_title = !empty($form_title) ? esc_html($form_title) : "Untitled Form #{$form_id}";
                    ?>
                    <tr>
                        <td><p><?php echo $form_title; ?></p></td>
                        <td>
                            <p style="font-weight: bold; color: <?php echo ($form_completed == '1') ? 'green' : 'red'; ?>">
                                <?php echo ($form_completed == '1') ? 'Completed' : 'Incomplete Form'; ?>
                            </p>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-danger" href="<?php echo esc_url(get_the_permalink()); ?>?bd=resumeform&form_id=<?php echo $form_id; ?>">
                                Resume
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning delete-form" href="#" data-form-id="<?php echo $form_id; ?>">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="4"><p>No saved forms found.</p></td></tr>';
            }
            ?>
        </tbody>
    </table>
    <div class="text-center">
        <a class="btn btn-sm btn-info" href="<?php echo esc_url(get_the_permalink()); ?>?bd=newform" role="button">Add New Form</a>
    </div>
  </div>
</div>
