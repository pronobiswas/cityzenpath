<?php

// namespace RomethemeKit;

class Rkit_Rform
{
    /**
     * Member Variable
     *
     * @var instance
     */
    private static $instance;

    /**
     * Instance.
     *
     * Ensures only one instance of the plugin class is loaded or can be loaded.
     *
     * @since 2.6.3
     * @access public
     * @static
     *
     * @return Init An instance of the class.
     */
    public static function instance()
    {

        if (is_null(self::$instance)) {

            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Construct the plugin object.
     *
     * @since 2.6.3
     * @access public
     */

    function __construct()
    {
        add_action('admin_menu', [$this, 'add_menu_form'], 999);
        add_action('current_screen', [$this, 'redirect_to_romethemeform']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_style']);
    }

    function redirect_to_romethemeform()
    {
        $current_screen = get_current_screen();
        if (class_exists('RomeThemeForm')) {
            if (!empty($current_screen->id) && $current_screen->id === 'romethemekit_page_rform') {
                wp_safe_redirect(admin_url('admin.php?page=romethemeform-form'));
                exit;
            }
        }
    }

    function add_menu_form()
    {
        
            add_submenu_page(
                'romethemekit',
                esc_html('Submissions'),
                esc_html('Submissions'),
                'manage_options',
                'romethemeform-entries',
                [$this, 'romethemeform_call'],
                5
            );
    }

    function romethemeform_call()
    {
        if (class_exists('RomethemeForm')) {
            if (!isset($_GET['entry_id']) || $_GET['entry_id'] == "" || isset($_GET['rform_id'])) {
                require_once \RomethemeForm::module_dir() . 'form/views/entries-table.php';
            } else {
                require_once \RomethemeForm::module_dir() . 'form/views/entries-view.php';
            }
        } else {
            require_once \RomeTheme::module_dir() . 'Form/form-require.php';
        }
    }
    function enqueue_style()
    {

        $screen = get_current_screen();
        if ($screen->id == 'romethemekit_page_rform') {
            wp_enqueue_style('style.css', \RomeTheme::plugin_url() . 'bootstrap/css/bootstrap.css');
            wp_enqueue_script('bootstrap.js', \RomeTheme::plugin_url() . 'bootstrap/js/bootstrap.min.js');
        }
    }
}
