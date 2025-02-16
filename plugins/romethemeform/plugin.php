<?php

namespace RomethemeFormPlugin;

use RForm;
use RomeThemeForm;
use RomethemeForm\Autoloader;
use RomethemeForm\Form\Form;

class Plugin
{
    public static function register_autoloader()
    {
        require_once \RomeThemeForm::plugin_dir() . '/autoloader.php';
        Autoloader::run();
    }

    public static function load_romethemeform_form()
    {
        require_once \RomethemeForm::module_dir() . 'form/form.php';
        new Form();
    }

    public static function register_widget($widgets_manager)
    {
        require_once(RomeThemeForm::widget_dir() . 'rtform-text.php');
        require_once(RomeThemeForm::widget_dir() . 'rtform.php');
        require_once(RomeThemeForm::widget_dir() . 'rform-button-submit.php');
        require_once(RomeThemeForm::widget_dir() . 'rtform-email.php');
        require_once(RomeThemeForm::widget_dir() . 'rtform-text-area.php');
        require_once(RomeThemeForm::widget_dir() . 'rtform-date.php');
        require_once(RomeThemeForm::widget_dir() . 'rtform-time.php');
        require_once(RomeThemeForm::widget_dir() . 'rtform-radio-btn.php');
        require_once(RomeThemeForm::widget_dir() . 'rform-select.php');
        require_once(RomeThemeForm::widget_dir() . 'rform-checkbox.php');
        require_once(RomeThemeForm::widget_dir() . 'rform-input-number.php');
        require_once(RomeThemeForm::widget_dir() . 'rform-input-tel.php');
        $widgets_manager->register(new RForm());
        $widgets_manager->register(new \RTForm_Text());
        $widgets_manager->register(new \Rform_Button_Submit());
        $widgets_manager->register(new \RTForm_Email());
        $widgets_manager->register(new \RTForm_TextArea());
        $widgets_manager->register(new \RTForm_Date());
        $widgets_manager->register(new \RTForm_Time());
        $widgets_manager->register(new \Rform_Radio_Widget());
        $widgets_manager->register(new \RTForm_Select());
        $widgets_manager->register(new \Rform_Checkbox_Widget());
        $widgets_manager->register(new \RTForm_Number());
        $widgets_manager->register(new \RForm_Phone());
    }

    public static function register_widget_styles()
    {
        wp_enqueue_style('rtform-text-style', \RomeThemeForm::widget_url() . 'assets/css/rtform_text.css' , [] , \RomethemeForm::rform_version());
        wp_enqueue_style('rform-style', \RomeThemeForm::widget_url() . 'assets/css/rform.css' , [] , \RomethemeForm::rform_version());
        wp_enqueue_style('spinner-style', \RomeThemeForm::widget_url() . 'assets/css/spinner-loading.css' , [] , \RomethemeForm::rform_version());
        wp_enqueue_style('rform-btn-style', \RomeThemeForm::widget_url() . 'assets/css/rform-button.css' , [] , \RomethemeForm::rform_version());
        wp_enqueue_style('rform-select-style', \RomeThemeForm::widget_url() . 'assets/css/rform-select.css' , [] , \RomethemeForm::rform_version());
        wp_enqueue_style('rform-radiobutton-style', \RomeThemeForm::widget_url() . 'assets/css/rform-radiobutton.css' , [] , \RomethemeForm::rform_version());
        wp_enqueue_style('rform-checkbox-style', \RomeThemeForm::widget_url() . 'assets/css/rform-checkbox.css' , [] , \RomethemeForm::rform_version());
        wp_enqueue_style('intlTelInput', \RomeThemeForm::widget_url() . 'assets/css/intlTelInput.css' , [] , \RomethemeForm::rform_version());
    }

    public static function register_widget_scripts()
    {
        $rform_nonce = wp_create_nonce('rform_entries_nonce');
        wp_enqueue_script('rtform-text-js', \RomeThemeForm::widget_url() . 'assets/js/rtform_text.js', ['jquery'], \RomeThemeForm::rform_version());
        wp_enqueue_script('rform-select-js', \RomeThemeForm::widget_url() . 'assets/js/rform_select.js', ['jquery'], \RomeThemeForm::rform_version());
        wp_enqueue_script('rform-phone-js', \RomeThemeForm::widget_url() . 'assets/js/rform_tel_input.js', ['jquery'], \RomeThemeForm::rform_version());
        wp_enqueue_script('rform-script', \RomeThemeForm::widget_url() . 'assets/js/rform.js', ['jquery'], \RomeThemeForm::rform_version());
        wp_localize_script('rform-script', 'romethemeform_ajax_url', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => $rform_nonce
        ));
        wp_enqueue_script('intl-tel-input', \RomeThemeForm::widget_url() . 'assets/js/intl_tel_input.min.js', ['jquery'], \RomeThemeForm::rform_version());
        wp_localize_script('intl-tel-input', 'intl_tel_input_script', [
            'url' => \RomeThemeForm::widget_url() . 'assets/js/intl_tel_input_utils.js'
        ]);
    }

    public static function add_elementor_widget_categories($elements_manager)
    {
        $categories = [];
        $categories['romethemeform_form_fields'] = [
            'title' => 'Rometheme Form',
        ];

        $old_categories = $elements_manager->get_categories();
        $categories = array_merge($categories, $old_categories);

        $set_categories = function ($categories) {
            $this->categories = $categories;
        };

        $set_categories->call($elements_manager, $categories);
    }
    public static function add_controls($controls_manager)
    {
        require_once(RomeThemeForm::controls_dir() . 'form_controls.php');
        $controls_manager->register(new \RFormControls());
    }

    public static function enqueue_frontend() {
        wp_enqueue_style('rform-admin-style' , RomeThemeForm::plugin_url() . 'assets/css/style.css' , '' , RomeThemeForm::rform_version());
    }

    public static function rform_notice_raw()
    {
        $btn1 = [
            'default_class' => 'button',
            'class' => 'button-primary',
            'text' => esc_html__('Yes, I Deserve it', 'romethemeform'),
            'url' => sanitize_url('https://wordpress.org/support/plugin/romethemeform/reviews/')
        ];

        $btn2 = [
            'default_class' => 'button',
            'class' => 'rform-button-link',
            'target' => '_blank',
            'text' => esc_html__('I Need Help', 'romethemeform'),
            'url' => sanitize_url('https://rometheme.net/contact-us/')
        ];
        $message = sprintf(
            '%1$s',
            "Hey there! If you've been enjoying RomethemeForm for Elementor, we'd be grateful for a 5-star rating to help us improve and reach more users. We also welcome any feedback you have to help us better serve you and the RomethemeForm community."
        );
        $logo = \RomeThemeForm::plugin_url() . 'assets/images/rform.png';
?>
        <div id="rform-notices" class="notice rform-notice notice-info is-dismissible">
            <img src="<?php echo esc_attr($logo) ?>" style="width:5rem;height:5rem;" alt="">
            <div>
                <div class="rform-notice-body">
                    <?php echo esc_html($message) ?>
                </div>
                <div class="rform-notice-footer">
                    <button type="button" class="button rform-deserve-btn <?php echo esc_attr($btn1['class']) ?> "><?php echo esc_html($btn1['text']) ?></button>
                    <a type="button" href="<?php echo esc_attr($btn2['url']) ?>" class="button <?php echo esc_attr($btn2['class']) ?>">
                        <svg fill="#2271b1" height="16px" width="16px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 485 485" xml:space="preserve">
                            <g>
                                <path d="M413.974,71.027C368.171,25.224,307.274,0,242.5,0S116.829,25.224,71.026,71.027C25.225,116.829,0,177.726,0,242.5
		s25.225,125.671,71.026,171.473C116.829,459.776,177.726,485,242.5,485s125.671-25.224,171.474-71.027
		C459.775,368.171,485,307.274,485,242.5S459.775,116.829,413.974,71.027z M242.5,347.5c-57.897,0-105-47.103-105-105
		s47.103-105,105-105s105,47.103,105,105S300.397,347.5,242.5,347.5z M368.425,193.845l68.997-35.926
		C448.719,183.853,455,212.455,455,242.5s-6.281,58.647-17.578,84.58l-68.997-35.926c5.855-15.103,9.075-31.509,9.075-48.655
		S374.28,208.948,368.425,193.845z M423.528,131.332l-68.995,35.924c-9.773-14.504-22.285-27.016-36.789-36.789l35.924-68.995
		C382.054,78.968,406.032,102.946,423.528,131.332z M327.08,47.578l-35.926,68.997c-15.103-5.855-31.509-9.075-48.654-9.075
		s-33.552,3.22-48.654,9.075L157.92,47.578C183.854,36.281,212.455,30,242.5,30S301.146,36.281,327.08,47.578z M131.331,61.472
		l35.924,68.995c-14.504,9.773-27.016,22.285-36.789,36.789l-68.995-35.924C78.968,102.946,102.946,78.968,131.331,61.472z
		 M47.578,157.92l68.997,35.926c-5.855,15.103-9.075,31.509-9.075,48.655s3.22,33.552,9.075,48.655L47.578,327.08
		C36.281,301.147,30,272.545,30,242.5S36.281,183.853,47.578,157.92z M61.472,353.668l68.995-35.924
		c9.773,14.504,22.285,27.016,36.789,36.789l-35.924,68.995C102.946,406.032,78.968,382.054,61.472,353.668z M157.92,437.422
		l35.926-68.997c15.103,5.855,31.509,9.075,48.654,9.075s33.552-3.22,48.654-9.075l35.926,68.997
		C301.146,448.719,272.545,455,242.5,455S183.854,448.719,157.92,437.422z M353.669,423.528l-35.924-68.995
		c14.504-9.773,27.016-22.285,36.789-36.789l68.995,35.924C406.032,382.054,382.054,406.032,353.669,423.528z" />
                            </g>
                        </svg>
                        <?php echo esc_html($btn2['text']) ?>
                    </a>
                </div>
            </div>
        </div>
        <style>
            .rform-notice {
                display: flex !important;
                flex-direction: row !important;
                padding: .5rem;
                gap: 1rem;
                align-items: center;
            }

            .rform-notice-body {
                margin-bottom: 0.8rem;
            }

            .rform-notice-footer {
                display: flex;
                flex-direction: row;
                gap: .5rem;
            }

            .rform-button-link {
                text-decoration: none !important;
                border: none !important;
                background-color: transparent !important;
                display: flex !important;
                align-items: center;
                justify-content: center;
                gap: .2rem;
            }
        </style>
<?php
    }
}
