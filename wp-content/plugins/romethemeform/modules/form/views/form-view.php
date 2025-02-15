<?php
require_once \RomeThemeForm::module_dir() . 'form/form.php';

$paged = (isset($_GET['paged'])) ? $_GET['paged'] : 1;
$postPerPage = absint(get_option('posts_per_page'));

$index = ($postPerPage * $paged ) - $postPerPage ;

$arg = [
    'post_type' => 'romethemeform_form',
    'posts_per_page' => get_option('posts_per_page'),
    'paged' => $paged
];
$rtform = new WP_Query($arg);

?>


<?php if (!class_exists('RomeTheme')) : ?>
    <div class="w-100 p-3">
        <div class="d-flex flex-column gap-1 mb-3">
            <h2>Forms</h2>
            <div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">Add New</button>
            </div>
        </div>
        <div class="w-100">
            <table class="table shadow table-sm">
                <thead class="bg-white">
                    <tr>
                        <td class="text-center" scope="col">No</td>
                        <td scope="col">Title</td>
                        <td scope="col">Shortcode</td>
                        <td scope="col">Entries</td>
                        <td scope="col">Author</td>
                        <td scope="col">Date</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rtform->have_posts()) {
                        while ($rtform->have_posts()) {
                            $index = $index + 1;
                            $no = (string) $index;
                            $rtform->the_post();
                            $id_post =  intval(get_the_ID());
                            $delete = get_delete_post_link($id_post, '', false);
                            $edit_link = get_edit_post_link($id_post, 'display');
                            $edit_elementor = str_replace('action=edit', 'action=elementor', $edit_link);
                            $status = (get_post_status($id_post) == 'publish') ? 'Published' : 'Draft';
                            $entries = \RomethemeForm\Form\Form::count_entries($id_post);
                            $shortcode = get_post_meta($id_post, 'rtform_shortcode', true);
                            $success_msg = get_post_meta($id_post, 'rtform_form_success_message', true);
                            $f = "export_entries(' " . $id_post . " ',' " . get_the_title() . " ')";
                            echo '<tr>';
                            echo '<td class="text-center">' . esc_html__($no, 'romethemeform') . '</td>';
                            echo '<td><div>' . esc_html(get_the_title());
                            echo '</div>';
                            echo '<smal style="font-size: 13px;">
                        <a type="button" class="link" data-bs-toggle="modal" 
                        data-bs-target="#formUpdate" data-form-id="' . $id_post . '" 
                        data-form-name="' . esc_attr(get_the_title()) . '" 
                        data-form-entry="' . esc_attr(get_post_meta($id_post, "rtform_form_entry_title", true)) . '"
                        data-form-restricted ="' . esc_attr(get_post_meta($id_post, "rtform_form_restricted", true)) . '"
                        data-form-msg-success="' . esc_attr($success_msg) . '"
                        >
                        Edit</a>&nbsp;|&nbsp; <a class="link" href="' . esc_url($edit_elementor) . '">Edit Form</a> &nbsp;|&nbsp;<a class="link-danger" href="' . esc_url($delete) . '">Trash</a></small>';
                            echo '</td>';
                            echo '<td>' . esc_html($shortcode) . '</td>';
                            echo '<td>
                        <a class="btn btn-outline-primary" href="' . esc_url(admin_url("admin.php?page=romethemeform-entries&rform_id=" . $id_post)) . '" type="button" 
                        >' . esc_html($entries) . '</a>
                        <a type="button" class="btn btn-outline-success" onclick="' . esc_attr($f) . '">Export CSV</a>
                        </td>';
                            echo '<td>' . esc_html(get_the_author()) . '</td>';
                            echo '<td><small>' . esc_html($status) . '</small><br><small>' . esc_html(get_the_date('Y/m/d') . ' at ' . get_the_date('H:i a')) . '</small></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td class="text-center" colspan="6">' . esc_html('No Data') . '</td></tr>';
                    }

                    ?>
                </tbody>
                <tfoot>
                    <tr class="bg-white">
                        <td scope="col"></td>
                        <td scope="col">Title</td>
                        <td scope="col">Shortcode</td>
                        <td scope="col">Entries</td>
                        <td scope="col">Author</td>
                        <td scope="col">Date</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
<?php else: ?>
    <div class="d-flex flex-row align-items-center mb-4">

        <div class="d-flex flex-row w-100 justify-content-between align-items-center mb-4">
            <div>
                <button class="btn btn-gradient-accent rounded-pill d-flex align-items-center gap-3" data-bs-toggle="modal" data-bs-target="#formModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    Create New Template</button>
            </div>
            <div class="d-flex justify-content-end align-items-end h-100 gap-1 mb-3">
                <?php
                $total_pages = $rtform->max_num_pages;
                $current_url = add_query_arg(array()); // get the current URL
                $base_url = remove_query_arg('paged', $current_url);
                if ($total_pages > 1) {
                    $current_page = max(1, intval(sanitize_text_field($paged)));
                    echo '<div class="themebuilder-pagination">';
                    echo paginate_links(array(
                        'base' => $base_url . '&paged=%#%',
                        'format' => '&paged=%#%',
                        'current' => $current_page,
                        'total' => $total_pages,
                        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                 <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
               </svg>',
                        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                 <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
               </svg>',
                    ));
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="rounded-3 rtm-border px-3 bg-gradient-1">
        <table class="rtm-table table-themebuilder">
            <thead>
                <tr>
                    <td class="text-center" scope="col">No</td>
                    <td scope="col">Title</td>
                    <td scope="col">Shortcode</td>
                    <td scope="col">Entries</td>
                    <td scope="col">Author</td>
                    <td scope="col">Date</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rtform->have_posts()) {
                    while ($rtform->have_posts()) {
                        $index = $index + 1;
                        $no = (string) $index;
                        $rtform->the_post();
                        $id_post =  intval(get_the_ID());
                        $delete = get_delete_post_link($id_post, '', false);
                        $edit_link = get_edit_post_link($id_post, 'display');
                        $edit_elementor = str_replace('action=edit', 'action=elementor', $edit_link);
                        $status = (get_post_status($id_post) == 'publish') ? 'Published' : 'Draft';
                        $entries = \RomethemeForm\Form\Form::count_entries($id_post);
                        $shortcode = get_post_meta($id_post, 'rtform_shortcode', true);
                        $success_msg = get_post_meta($id_post, 'rtform_form_success_message', true);
                        $f = "export_entries(' " . $id_post . " ',' " . get_the_title() . " ')";
                        echo '<tr>';
                        echo '<td class="text-center">' . esc_html__($no, 'romethemeform') . '</td>';
                        echo '<td><div>' . esc_html(get_the_title());
                        echo '</div>';
                        echo '<smal style="font-size: 13px;">
                        <a type="button" class="link" data-bs-toggle="modal" 
                        data-bs-target="#formUpdate" data-form-id="' . $id_post . '" 
                        data-form-name="' . esc_attr(get_the_title()) . '" 
                        data-form-entry="' . esc_attr(get_post_meta($id_post, "rtform_form_entry_title", true)) . '"
                        data-form-restricted ="' . esc_attr(get_post_meta($id_post, "rtform_form_restricted", true)) . '"
                        data-form-msg-success="' . esc_attr($success_msg) . '"
                        >
                        Edit</a>&nbsp;|&nbsp; <a class="link" href="' . esc_url($edit_elementor) . '">Edit Form</a> &nbsp;|&nbsp;<a class="link-danger" href="' . esc_url($delete) . '">Trash</a></small>';
                        echo '</td>';
                        echo '<td>' . esc_html($shortcode) . '</td>';
                        echo '<td><div class="d-flex flex-row gap-2">
                        <a class="btn btn-outline-primary" href="' . esc_url(admin_url("admin.php?page=romethemeform-entries&rform_id=" . $id_post)) . '" type="button" 
                        >' . esc_html($entries) . '</a>
                        <a type="button" class="btn btn-outline-success" onclick="' . esc_attr($f) . '">Export CSV</a>
                        </div></td>';
                        echo '<td>' . esc_html(get_the_author()) . '</td>';
                        echo '<td><small>' . esc_html($status) . '</small><br><small>' . esc_html(get_the_date('Y/m/d') . ' at ' . get_the_date('H:i a')) . '</small></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td class="text-center" colspan="6">' . esc_html('No Data') . '</td></tr>';
                }

                ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:99999">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="w-100" id="rtform-add-form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-white fs-5" id="exampleModalLabel">Add Form</h1>
                    <button type="button" class="btn btn-transparent text-white" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="action" name="action" type="text" value="rtformnewform" hidden>
                    <nav>
                        <ul class="nav nav-underline mb-3" id="nav-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">General</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="nav-confirmation-tab" data-bs-toggle="tab" data-bs-target="#nav-confirmation" type="button" role="tab" aria-controls="nav-confirmation" aria-selected="false">Confirmation</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="nav-notification-tab" data-bs-toggle="tab" data-bs-target="#nav-notification" type="button" role="tab" aria-controls="nav-notification" aria-selected="false">Notification</button>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" tabindex="0">
                            <label for="form-name">Form Name</label>
                            <input type="text" name="form-name" id="form-name" class="form-control p-2" placeholder="Enter Form Name">
                            <h5 class="my-3">Settings</h5>
                            <hr>
                            <div class="mb-3">
                                <label for="success-message" class="form-label">Success Message</label>
                                <input type="text" class="form-control p-2" id="success-message" name="success-message" value="Thank you! Form submitted successfully.">
                            </div>
                            <div class="mb-3">
                                <label for="entry-name" class="form-label">Entry Title</label>
                                <input type="text" class="form-control p-2" id="entry-name" name="entry-name" value="Entry #">
                                <p class="fw-light fst-italic text">To set a custom entry title, enclose the input name in {{ }}.</p>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <span>
                                    <p class="m-0">Require Login</p>
                                    <p class="fw-light fst-italic text">Without login, user can't submit the form.</p>
                                </span>
                                <label class="switch">
                                    <input name="require-login" id="switch" class="switch-input" type="checkbox" value="true">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-confirmation" role="tabpanel" aria-labelledby="nav-confirmation-tab" tabindex="0">
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <span>
                                    <h5 class="m-0">Confirmation mail to user</h5>
                                </span>
                                <label class="switch">
                                    <input name="confirmation" id="switch_confirmation" class="switch-input" type="checkbox" value="true">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <p class="fw-light fst-italic text">Want to send a submission copy to user by email? <strong>Active this one.The form must have at least one Email widget and it should be required.</strong></p>
                            <div id="confirmation_form">
                                <div class="mb-3">
                                    <label for="email_subject" class="form-label">Email Subject</label>
                                    <input type="text" class="form-control p-2" name="email_subject" id="email_subject" placeholder="Enter Email Subject Here">
                                </div>
                                <div class="mb-3">
                                    <label for="email_subject" class="form-label">Email From</label>
                                    <input type="email" class="form-control p-2" name="email_from" id="email_from" placeholder="mail@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="email_subject" class="form-label">Email Reply To</label>
                                    <input type="text" class="form-control p-2" name="email_replyto" id="email_replyto" placeholder="mail@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="thks_mssg" class="form-label">Thankyou Message</label>
                                    <textarea class="form-control" id="thks_msg" name="tks_msg" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab" tabindex="0">
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <span>
                                    <h5 class="m-0">Notification mail to Admin</h5>
                                </span>
                                <label class="switch">
                                    <input name="notification" id="switch_notification" class="switch-input" type="checkbox" value="true">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <p class="fw-light fst-italic text">Want to send a submission copy to admin by email? <strong>Active this one.</strong></p>
                            <div id="notification_form">
                                <div class="mb-3">
                                    <label for="notif_subject" class="form-label">Email Subject</label>
                                    <input type="text" class="form-control p-2" name="notif_subject" id="notif_subject" placeholder="Enter Email Subject Here">
                                </div>
                                <div class="mb-3">
                                    <label for="notif_email_to" class="form-label">Email From</label>
                                    <input type="email" class="form-control p-2" name="notif_email_from" id="notif_email_from" placeholder="mail@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="notif_email_to" class="form-label">Email To</label>
                                    <input type="text" class="form-control p-2" name="notif_email_to" id="notif_email_to" placeholder="mail@example.com">
                                    <p class="fw-light fst-italic text">Enter admin email where you want to send mail. <strong>for multiple email addresses please use "," separator.</strong></p>
                                </div>
                                <div class="mb-3">
                                    <label for="thks_mssg" class="form-label">Admin Note</label>
                                    <textarea class="form-control" id="adm_msg" name="adm_msg" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close-btn" type="button" class="col btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="rform-save-button" type="button" class="col btn btn-gradient-accent rform-save-btn">Save & Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="formUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateLabel" aria-hidden="true" style="z-index: 99999;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="w-100" id="rtform-update-form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateLabel">Update Form</h1>
                    <button type="button" class="btn btn-transparent text-white" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="action" name="action" type="text" value="rtformupdate" hidden>
                    <input type="text" name="id" id="id" hidden>
                    <nav>
                        <ul class="nav nav-underline mb-3" id="nav-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-update-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">General</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="nav-confirmation-tab" data-bs-toggle="tab" data-bs-target="#nav-update-confirmation" type="button" role="tab" aria-controls="nav-confirmation" aria-selected="false">Confirmation</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="nav-notification-tab" data-bs-toggle="tab" data-bs-target="#nav-update-notification" type="button" role="tab" aria-controls="nav-notification" aria-selected="false">Notification</button>
                            </li>
                        </ul>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-update-general" role="tabpanel" aria-labelledby="nav-general-tab" tabindex="0">
                            <label for="form-name">Form Name</label>
                            <input type="text" name="form-name" id="form-name" class="form-control p-2" placeholder="Enter Form Name">
                            <h5 class="my-3">Settings</h5>
                            <hr>
                            <div class="mb-3">
                                <label for="success-message" class="form-label">Success Message</label>
                                <input type="text" class="form-control p-2" id="success-message" name="success-message" value="Thank you! Form submitted successfully.">
                            </div>
                            <div class="mb-3">
                                <label for="entry-name" class="form-label">Entry Title</label>
                                <input type="text" class="form-control p-2" id="entry-name" name="entry-name" value="Entry #">
                                <p class="fw-light fst-italic text">To set a custom entry title, enclose the input name in {{ }}.</p>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <span>
                                    <p class="m-0">Require Login</p>
                                    <p class="fw-light fst-italic text">Without login, user can't submit the form.</p>
                                </span>
                                <label class="switch">
                                    <input name="require-login" id="switch" class="switch-input" type="checkbox" value="true">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-update-confirmation" role="tabpanel" aria-labelledby="nav-confirmation-tab" tabindex="0">
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <span>
                                    <h5 class="m-0">Confirmation mail to user</h5>
                                </span>
                                <label class="switch">
                                    <input name="confirmation" id="update_switch_confirmation" class="switch-input" type="checkbox" value="true">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <p class="fw-light fst-italic text">Want to send a submission copy to user by email? <strong>Active this one.The form must have at least one Email widget and it should be required.</strong></p>
                            <div id="update_confirmation_form">
                                <div class="mb-3">
                                    <label for="email_subject" class="form-label">Email Subject</label>
                                    <input type="text" class="form-control p-2" name="email_subject" id="update_email_subject" placeholder="Enter Email Subject Here">
                                </div>
                                <div class="mb-3">
                                    <label for="email_subject" class="form-label">Email From</label>
                                    <input type="email" class="form-control p-2" name="email_from" id="update_email_from" placeholder="mail@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="email_subject" class="form-label">Email Reply To</label>
                                    <input type="text" class="form-control p-2" name="email_replyto" id="update_email_replyto" placeholder="mail@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="thks_mssg" class="form-label">Thankyou Message</label>
                                    <textarea class="form-control" id="update_thks_msg" name="tks_msg" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-update-notification" role="tabpanel" aria-labelledby="nav-notification-tab" tabindex="0">
                            <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                                <span>
                                    <h5 class="m-0">Notification mail to Admin</h5>
                                </span>
                                <label class="switch">
                                    <input name="notification" id="update_switch_notification" class="switch-input" type="checkbox" value="true">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <p class="fw-light fst-italic text">Want to send a submission copy to admin by email? <strong>Active this one.</strong></p>
                            <div id="update_notification_form">
                                <div class="mb-3">
                                    <label for="notif_subject" class="form-label">Email Subject</label>
                                    <input type="text" class="form-control p-2" name="notif_subject" id="update_notif_subject" placeholder="Enter Email Subject Here">
                                </div>
                                <div class="mb-3">
                                    <label for="notif_email_from" class="form-label">Email From</label>
                                    <input type="email" class="form-control p-2" name="notif_email_from" id="update_notif_email_from" placeholder="mail@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="notif_email_to" class="form-label">Email To</label>
                                    <input type="text" class="form-control p-2" name="notif_email_to" id="update_notif_email_to" placeholder="mail@example.com">
                                    <span class="fw-light fst-italic text">Enter admin email where you want to send mail. <strong>for multiple email addresses please use "," separator.</strong></span>
                                </div>
                                <div class="mb-3">
                                    <label for="thks_mssg" class="form-label">Admin Note</label>
                                    <textarea class="form-control" id="update_adm_msg" name="adm_msg" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="close-btn" type="button" class="col btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="rform-update-button" type="button" class="col btn btn-gradient-accent rform-save-btn">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="rform-editor-modal" class="rform-modal">
    <div class="rform-modal-content">
        <div class="elementor-editor-header-iframe">
            <div class="rform-editor-header">
                <svg width="30" height="30" id="eohpCl3PVjW1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 300" shape-rendering="geometricPrecision" text-rendering="geometricPrecision">
                    <g transform="matrix(.11326 0 0-.113381-20.251951 319.628716)">
                        <path d="M372,2749c-46-14-109-80-122-128-7-27-10-384-8-1148l3-1108l24-38c13-21,42-50,64-65l41-27h1131h1131l41,27c22,15,51,44,64,65l24,38v812v813l-383,382-382,383-798,2c-485,1-810-2-830-8Zm1500-932c211-120,337-197,335-206-2-14-262-170-285-170-7-1-102,50-212,113l-200,115-200-115c-110-63-204-114-209-114-21,0-292,163-288,174c6,19,691,407,707,400c8-3,167-92,352-197Zm-151-319c82-46,148-86,149-89c0-3-12-11-27-18-26-12-20-16,183-131c115-66,210-123,212-128c3-9-277-172-296-172-7,0-107,54-222,120l-210,120-208-120c-115-66-215-120-223-120-24,1-284,155-286,170-2,10,125,88,380,232c210,120,386,218,391,218s76-37,157-82Z" transform="matrix(1.00378 0 0 1.013853-5.68208-20.7254)" fill="#f0f0f1" />
                    </g>
                    <path d="M199.680417,24.709473v75.9h76.5l-76.5-75.9Z" transform="matrix(1.075983 0 0 1.177621-4.45472-23.399398)" fill="#a1a1a1" stroke="#3f5787" stroke-width="0.6" />
                </svg>
                <strong>ROMETHEMEFORM</strong>
            </div>
            <button id="rform-save-editor-btn" class="elementor-button elementor-button-success elementor-modal-iframe-btn-control"><?php echo esc_html__('SAVE & CLOSE', 'romethemeform') ?></button>
        </div>
        <div class="elementor-editor-container">
            <iframe class="ifr-editor" id="rform-elementor-editor" src="" frameborder="0"></iframe>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f0f0f1;
    }

    .rform-modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 99999;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.6);
        /* Black w/ opacity */
    }

    .rform-modal-content {
        display: flex;
        gap: 5px;
        flex-direction: column;
        background-color: #34383c;
        margin: auto;
        /* 15% from the top and centered */
        width: 80%;
        /* Could be more or less, depending on screen size */
        height: 90%;
        box-shadow: 0px 0px 49px -19px rgba(0, 0, 0, 0.82);
        -webkit-box-shadow: 0px 0px 49px -19px rgba(0, 0, 0, 0.82);
        -moz-box-shadow: 0px 0px 49px -19px rgba(0, 0, 0, 0.82);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .ifr-editor {
        height: 100%;
        width: 100%;
    }

    .ifr-editor[src] {
        background-color: #34383c;
    }

    /* The Close Button */
    .close {
        color: rgb(255, 255, 255);
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .elementor-editor-container {
        width: 100%;
        height: 100%;
    }

    .flex-direction-col {
        display: flex;
        flex-direction: column;
    }

    .elementor-modal-iframe-btn-control {
        padding: 15px;
    }

    .elementor-editor-header-iframe {
        display: flex;
        justify-content: space-between;
        padding: 5px;
    }

    .edit-form-wrapper {
        padding: 5px;
        display: flex;
        justify-content: center;
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .rform-editor-header {
        display: flex;
        flex-direction: row;
        gap: 1rem;
        align-items: center;
        padding-inline: 1rem;
    }

    .rform-editor-header>strong {
        font-size: 1rem;
        color: white;
    }
</style>
<style>
    .rform-save-btn {
        width: 8rem;
    }

    body {
        background-color: #f0f0f1;
    }
</style>