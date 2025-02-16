<?php

class RFormControls extends \Elementor\Base_Data_Control
{

    public function get_type()
    {
        return 'rform_control';
    }

    protected function get_default_settings()
    {
        return ['form_id' => ""];
    }

    public function enqueue()
    {
        $form_nonce = wp_create_nonce('rform_form_ajax_nonce');
        // Styles
        wp_register_style('control-style', \RomethemeForm::controls_url() . 'assets/css/form_modal.css');
        wp_enqueue_style('control-style');

        // Scripts
        wp_register_script('control-script', \RomeThemeForm::controls_url() . 'assets/js/form_modal.js');
        wp_enqueue_script('control-script');
        wp_register_script('rformcontrol-script', \RomeThemeForm::controls_url() . 'assets/js/form_picker.js');
        wp_enqueue_script('rformcontrol-script');
        wp_localize_script('control-script', 'adminData', array(
            'adminUrl' => esc_url(admin_url()),
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => $form_nonce
        ));
    }

    public function content_template()
    {
        $control_uid = $this->get_control_uid();

        $list = [];

        $template =  get_posts(['post_type' => 'romethemeform_form' , 'posts_per_page' => -1]);
        $list = [];
        foreach ($template as $form) {
            $list[$form->ID]  = $form->post_title;
        }
?>
        <div class="elementor-control rform-editform flex-direction-col" id="<?php echo esc_attr($control_uid); ?>" data-setting="{{ data.name }}">
            <div class="elementor-control-input-wrapper">
                <span>You can create or select the form.</span>
                <div class="rform-editform-wrapper edit-form-wrapper">
                    <button data-control-uid="<?php echo esc_attr($control_uid) ?>" type="button" class="rform-editform-btn elementor-button e-primary elementor-modal-iframe-btn-control">
                        <?php echo esc_html__('EDIT FORM', 'romethemeform') ?>
                    </button>
                </div>
            </div>
            <div class="rform-editform-modal">
                <# var form_id=data.form_id; #>
                    <div class="rform-modal-content">
                        <div class="rform-modal-header">
                            <div class="rform-logo">
                                <svg width="30" height="30" id="eohpCl3PVjW1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 300" shape-rendering="geometricPrecision" text-rendering="geometricPrecision">
                                    <g transform="matrix(.11326 0 0-.113381-20.251951 319.628716)">
                                        <path d="M372,2749c-46-14-109-80-122-128-7-27-10-384-8-1148l3-1108l24-38c13-21,42-50,64-65l41-27h1131h1131l41,27c22,15,51,44,64,65l24,38v812v813l-383,382-382,383-798,2c-485,1-810-2-830-8Zm1500-932c211-120,337-197,335-206-2-14-262-170-285-170-7-1-102,50-212,113l-200,115-200-115c-110-63-204-114-209-114-21,0-292,163-288,174c6,19,691,407,707,400c8-3,167-92,352-197Zm-151-319c82-46,148-86,149-89c0-3-12-11-27-18-26-12-20-16,183-131c115-66,210-123,212-128c3-9-277-172-296-172-7,0-107,54-222,120l-210,120-208-120c-115-66-215-120-223-120-24,1-284,155-286,170-2,10,125,88,380,232c210,120,386,218,391,218s76-37,157-82Z" transform="matrix(1.00378 0 0 1.013853-5.68208-20.7254)" fill="#858585" />
                                    </g>
                                    <path d="M199.680417,24.709473v75.9h76.5l-76.5-75.9Z" transform="matrix(1.075983 0 0 1.177621-4.45472-23.399398)" fill="#474747" stroke="#3f5787" stroke-width="0.6" />
                                </svg>
                                <strong>ROMETHEMEFORM</strong>
                            </div>
                            <div>
                                <button class="rform-close-btn"><i class="eicon eicon-close"></i></button>
                            </div>
                        </div>
                        <div class="rform-modal-tabs">
                            <div class="rform-modal-tab">
                                <label class="rform-radiobtn-container"> Select Form
                                    <input type="radio" class="rform-radio-btn" data-content="#tab-content-select" checked id="tab-select" name="radio-btn">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="rform-radiobtn-container"> New Form
                                    <input type="radio" class="rform-radio-btn" id="tab-new" data-content="#tab-content-new" name="radio-btn">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="rform-modal-tab-content">
                                <div class="rform-tab-content" id="tab-content-select">
                                    <div class="rform-tab-select">
                                        <# if ( data.label ) {#>
			                        <label for="<?php echo esc_attr($control_uid); ?>" class="form-label">{{{ data.label }}}</label>
			                    <# } #>
                                    <select class="rform-select-form">
					                <?php foreach ($list as $key => $value) : ?>
					                    <option value="<?php echo esc_attr($key) ?>"><?php echo esc_html($value) ?></option>
					                <?php endforeach; ?>
				                    </select>
                                   </div>
                                   <div class="rform-tab-select-footer">
                                        <button class="rform-modal-btn rform-select-edit">Edit Content</button>
                                        <button class="rform-modal-btn rform-select-savebtn">Save & Close</button>
                                   </div>
                                </div>
                                <div class="rform-tab-content" id="tab-content-new">
                                    <form id="rform-newform">
                                    <input id="action" name="action" type="text" value="rtformnewform" hidden>
                                        <div class="newform-tabs">
                                            <div class="newform-tab-header">
                                                <div class="tab-item active" data-tab="tab-general">General</div>
                                                <div class="tab-item " data-tab="tab-confirmation">Confirmation</div>
                                                <div class="tab-item " data-tab="tab-notification">Notification</div>
                                            </div>
                                            <div class="newform-tab-content">
                                                <div id="tab-general" class="tab-pane active">
                                                    <label for="new-form-name" class="form-label">Form Name</label>
                                                    <input type="text" class="rform-input-control" name="form-name">
                                                    <h5>Settings</h5>
                                                    <hr class="mb-3">
                                                    <div class="mb-3">
                                                        <label for="success-message" class="form-label">Success Message</label>
                                                         <input type="text" class="rform-input-control" id="success-message" name="success-message" value="Thank you! Form submitted successfully.">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="entry-name" class="form-label">Entry Title</label>
                                                        <input type="text" class="rform-input-control" id="entry-name" name="entry-name" value="Entry #">
                                                        <p class="text"><?php echo esc_html('To set a custom entry title, enclose the input name in {{}}.') ?></p>
                                                    </div>
                                                    <div class="switch-container">
                                                        <span>
                                                            <p class="form-label">Require Login</p>
                                                            <p class="text">Without login, user can't submit the form.</p>
                                                        </span>
                                                        <label class="switch">
                                                            <input name="require-login" id="switch" type="checkbox" value="true">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="tab-confirmation" class="tab-pane">
                                                    <div class="switch-container">
                                                        <span>
                                                            <h5 class="m-0">Confirmation mail to user</h5>
                                                        </span>
                                                        <label class="switch">
                                                            <input name="confirmation" id="switch_confirmation" type="checkbox" value="true">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                    <p class="conf_desc" >Want to send a submission copy to user by email? <strong style="color:white;">Active this one.The form must have at least one Email widget and it should be required.</strong></p>
                                                    <div id="confirmation_form">
                                                        <div class="mb-3">
                                                            <label for="email_subject" class="form-label">Email Subject</label>
                                                            <input type="text" class="rform-input-control" name="email_subject" id="email_subject" placeholder="Enter Email Subject Here">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email_subject" class="form-label">Email From</label>
                                                            <input type="email" class="rform-input-control" name="email_from" id="email_from" placeholder="mail@example.com">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email_subject" class="form-label">Email Reply To</label>
                                                            <input type="text" class="rform-input-control" name="email_replyto" id="email_replyto" placeholder="mail@example.com">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="thks_mssg" class="form-label">Thankyou Message</label>
                                                            <textarea class="rform-input-control" id="thks_msg" name="tks_msg" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="tab-notification" class="tab-pane">
                                                    <div class="switch-container">
                                                        <span>
                                                            <h5 class="m-0">Notification mail to Admin</h5>
                                                        </span>
                                                        <label class="switch">
                                                            <input name="notification" id="switch_notification" type="checkbox" value="true">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                    <p class="notif-desc">Want to send a submission copy to admin by email? <strong style="color:white;">Active this one.</strong></p>
                                                    <div id="notification_form">
                                                        <div class="mb-3">
                                                            <label for="notif_subject" class="form-label">Email Subject</label>
                                                            <input type="text" class="rform-input-control" name="notif_subject" id="notif_subject" placeholder="Enter Email Subject Here">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="notif_email_to" class="form-label">Email From</label>
                                                            <input type="email" class="rform-input-control" name="notif_email_from" id="notif_email_from" placeholder="mail@example.com">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="notif_email_to" class="form-label">Email To</label>
                                                            <input type="text" class="rform-input-control" name="notif_email_to" id="notif_email_to" placeholder="mail@example.com">
                                                            <span class="fw-light fst-italic text text-black-50">Enter admin email where you want to send mail. <strong style="color:white">for multiple email addresses please use "," separator.</strong></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="thks_mssg" class="form-label">Admin Note</label>
                                                            <textarea class="rform-input-control" id="adm_msg" name="adm_msg" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="rform-tab-new-footer">
                                        <button class="rform-modal-btn rform-new-savebtn">Save & Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <# if ( data.description ) { #>
            <div class="elementor-control-field-description">{{{ data.description }}}</div>
            <# } #>

            <div id="myModal<?php echo esc_attr($control_uid) ?>" class="modal rform-editor-modal">
                    <div class="modal-content">
                        <div class="elementor-editor-header-iframe">
                            <div class="rform-editor-header">
                            <svg width="30" height="30" id="eohpCl3PVjW1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 300 300" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><g transform="matrix(.11326 0 0-.113381-20.251951 319.628716)"><path d="M372,2749c-46-14-109-80-122-128-7-27-10-384-8-1148l3-1108l24-38c13-21,42-50,64-65l41-27h1131h1131l41,27c22,15,51,44,64,65l24,38v812v813l-383,382-382,383-798,2c-485,1-810-2-830-8Zm1500-932c211-120,337-197,335-206-2-14-262-170-285-170-7-1-102,50-212,113l-200,115-200-115c-110-63-204-114-209-114-21,0-292,163-288,174c6,19,691,407,707,400c8-3,167-92,352-197Zm-151-319c82-46,148-86,149-89c0-3-12-11-27-18-26-12-20-16,183-131c115-66,210-123,212-128c3-9-277-172-296-172-7,0-107,54-222,120l-210,120-208-120c-115-66-215-120-223-120-24,1-284,155-286,170-2,10,125,88,380,232c210,120,386,218,391,218s76-37,157-82Z" transform="matrix(1.00378 0 0 1.013853-5.68208-20.7254)" fill="#f0f0f1"/></g><path d="M199.680417,24.709473v75.9h76.5l-76.5-75.9Z" transform="matrix(1.075983 0 0 1.177621-4.45472-23.399398)" fill="#a1a1a1" stroke="#3f5787" stroke-width="0.6"/></svg>
                                <strong>ROMETHEMEFORM</strong>
                            </div>
                            <button id="rform-editform-button" data-control-uid="<?php echo esc_js($control_uid) ?>" class="rform-modal-btn elementor-modal-iframe-btn-control "><?php echo esc_html__('SAVE & CLOSE', 'romethemeform') ?></button>
                        </div>
                        <div class="elementor-editor-container">
                            <iframe class="ifr-editor rform-ifr-editor" id="ifr-<?php echo esc_attr($control_uid) ?>" src="" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>


        </div>
        <?php
    }
}
