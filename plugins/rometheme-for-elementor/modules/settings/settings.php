<?php

namespace Rometheme;

class RtmSettings
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'register_scripts']);
        add_action('wp_ajax_set_global_site' , [$this , 'set_global_site']);
    }

    public static function register_scripts()
    {
        $nonce = wp_create_nonce('rometheme_settings_nonce');
        if (get_current_screen()->id === 'romethemekit_page_rtm-settings') {
            wp_enqueue_script('settings.js', \RomeTheme::module_url() . 'settings/assets/js/scripts.js', [], \RomeTheme::rt_version());
            wp_localize_script('settings.js', 'rtm_settings', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => $nonce
            ]);
        }
    }

    public static function set_global_site()
    {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'rometheme_settings_nonce')) {
            wp_send_json_error('Invalid nonce.');
            wp_die();
        }

        if (!current_user_can('manage_options')) {
            wp_send_json_error('Access Denied.');
            wp_die();
        }

        $idKit = sanitize_text_field($_POST['idKit']);
        update_option('elementor_active_kit' , $idKit);
    }
}
