<?php

namespace RomethemeKit;

use RomeTheme;
use RomethemePro;

class RkitWidgets
{

    private $list_widgets;

    public function __construct()
    {

        $this->update_widget_option();
        add_action('elementor/widgets/register', [$this, 'register_widget']);
        // add_action('elementor/widgets/register', [$this, 'register_widget_pro']);
        add_action('admin_enqueue_scripts', [$this, 'register_style']);
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'pro_js']);
        add_action('wp_ajax_save_options', [$this, 'save_options']);
        add_action('wp_ajax_save_options_pro', [$this, 'save_options_pro']);
        add_action('wp_ajax_reset_widgets', [$this, 'reset_widgets']);
    }

    private function update_widget_option()
    {
        $options = get_option('rkit-widget-options');
        $jsonWidgets = $this->listWidgets();

        if ($options == false) {
            update_option('rkit-widget-options', $this->listWidgets());
        } else {
            if (count($options) !== count($this->listWidgets())) {
                update_option('rkit-widget-options', $this->listWidgets());
            } else {
                if (!$this->compareArrays($options, $jsonWidgets, 'icon')) {
                    foreach ($options as $key => $val) {
                        $options[$key]['icon'] = $jsonWidgets[$key]['icon'];
                    }
                    update_option('rkit-widget-options', $options);
                }
            }
        }
    }

    public function reset_widgets()
    {
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'widget-options-nonce')) {
            wp_send_json_error('Invalid nonce.');
            wp_die();
        }

        if (!current_user_can('manage_options')) {
            wp_die();
        }
        $jsonWidgets = $this->listWidgets();
        delete_option('rkit-widget-options');
        update_option('rkit-widget-options', $this->listWidgets());
    }

    public static function register_widget($widgets_manager)
    {

        $widgets = scandir(\RomeTheme::widget_dir());
        $bs_widgets = scandir(\RomeTheme::widget_dir() . '/rkit_widgets');

        foreach ($widgets as $widget) {
            if (strpos($widget, '.php') !== false) {
                require_once(\RomeTheme::widget_dir() . $widget);
            }
        }

        foreach ($bs_widgets as $widget) {
            if (strpos($widget, '.php') !== false) {
                require_once(\RomeTheme::widget_dir() . 'rkit_widgets/' . $widget);
            }
        }

        $widget_lists = get_option('rkit-widget-options');

        foreach ($widget_lists as $widget) {
            if ($widget['status'] and $widget['type'] == 'free') {
                if ($widget['category'] === 'woocommerce') {
                    if (class_exists('WooCommerce')) {
                        $widgets_manager->register(new $widget['class_name']());
                    }
                } else {
                    $widgets_manager->register(new $widget['class_name']());
                }
            }
        }
    }

    function compareArrays($array1, $array2, $keyToCompare)
    {
        foreach ($array1 as $key => $value1) {
            if (!isset($array2[$key])) {
                return false; // Jika kunci tidak ditemukan di array kedua
            }

            if ($value1[$keyToCompare] !== $array2[$key][$keyToCompare]) {
                return false; // Jika nilai tidak sama
            }
        }

        return true; // Jika semua nilai sama
    }

    private function checkKey($array, $key)
    {
        foreach ($array as $obj) {
            if (!array_key_exists($key, $obj)) {
                return true;
            }
        }
        return false;
    }

    function register_style()
    {

        $nonce = wp_create_nonce('widget-options-nonce');
        $screen = get_current_screen();
        if ($screen->id == 'romethemekit_page_rkit-widgets') {
            wp_enqueue_style('style', RomeTheme::module_url() . 'HeaderFooter/assets/css/style.css');
            wp_enqueue_script('widgetViewScript', RomeTheme::module_url() . 'widgets/assets/js/widget.js', ['jquery'], RomeTheme::rt_version());
            wp_localize_script('widgetViewScript', 'rometheme_ajax_url', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => $nonce,
                'isProActive' => \RomethemePlugin\Plugin::isProActive()
            ));
        }
    }

    function pro_js()
    {
        $list_widgets_pro = $this->listWidgetPro();

        if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            wp_enqueue_script('rtmprojs', RomeTheme::module_url() . 'widgets/assets/js/rtmwp.js', ['jquery'], RomeTheme::rt_version());
            wp_localize_script('rtmprojs', 'rtmpro', [
                'is_pro' => $this->is_pro(),
                'widgets' => $list_widgets_pro
            ]);
        }
    }

    function save_options()
    {
        $data = $_POST;
        $options = get_option('rkit-widget-options');

        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'widget-options-nonce')) {
            wp_send_json_error('Invalid nonce.');
            wp_die();
        }

        if (!current_user_can('manage_options')) {
            wp_die();
        }

        unset($data['action']);
        unset($data['nonce']);

        foreach ($data as $key => $value) {
            $options[$key]['status'] = ($value == "true") ? true : false;
        }

        $update = update_option('rkit-widget-options', $options);

        if ($update) {
            wp_send_json_success('success');
        } else {
            wp_send_json_error('errorrr');
        }
    }

    function save_options_pro()
    {
        if (!current_user_can('manage_options')) {
            wp_die();
        }
        $data = $_POST;

        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'widget-options-nonce')) {
            wp_send_json_error('Invalid nonce.');
            wp_die();
        }
        unset($data['action']);
        unset($data['nonce']);

        \RomethemePro\Widget::save_options($data);
    }

    function is_pro()
    {
        if (class_exists('RomethemePro')) {
            return 'true';
        } else {
            return 'false';
        }
    }

    public static function listWidgets()
    {
        $widgetsFileJson = file_get_contents(\RomeTheme::plugin_dir() . '/assets/js/widgets.json');

        $widgets = json_decode($widgetsFileJson, true);

        uasort($widgets, function ($a, $b) {
            if ($a['category'] === $b['category']) {
                return strcasecmp($a['name'], $b['name']);
            }
            return strcasecmp($a['category'], $b['category']);
        });

        return $widgets;
    }

    public static function listWidgetPro()
    {
        $widgetsFileJson = file_get_contents(\RomeTheme::plugin_dir() . '/assets/js/rtmwp.json');

        $widgets = json_decode($widgetsFileJson, true);

        uasort($widgets, function ($a, $b) {
            if ($a['category'] === $b['category']) {
                return strcasecmp($a['name'], $b['name']);
            }
            return strcasecmp($a['category'], $b['category']);
        });

        return $widgets;
    }
}
