<?php

/**
 * Plugin Name:       RomethemeKit For Elementor
 * Description:      The best toolkit solution for Elementor. Enjoy advanced addons, theme builders, forms, icons, and ready-made templates to create stunning websites quickly and effortlessly.
 * Version:           1.5.4
 * Author:            Rometheme
 * Author URI: 	  	  https://rometheme.net/
 * License : 		  GPLv3 or later
 * 
 * The best toolkit solution for Elementor. Enjoy advanced addons, theme builders, forms, icons, and ready-made templates to create stunning websites quickly and effortlessly.
 */

define("ROMETHEME_PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));

class RomeTheme
{

	function __construct()
	{
		require_once self::plugin_dir() . 'libs/notice/notice.php';
		add_action('admin_menu', [$this, 'rometheme_add_menu']);
		add_action('rometheme/plugins_loaded', array($this, 'init'), 100);
		do_action('rometheme/plugins_loaded');
		add_filter('plugin_row_meta', [$this, 'row_meta_link'] , 10, 4);
		add_filter('plugin_action_links', [$this, 'action_links'] , 10, 2);
	}

	public function isCompatible()
	{
		if (!did_action('elementor/loaded')) {
			add_action('admin_head', array($this, 'missing_elementor'));
			return false;
		}

		return true;
	}

	function init()
	{
		if ($this->isCompatible()) {
			require_once self::plugin_dir() . '/plugin.php';
			require_once self::module_dir() . 'Form/form.php';
			require_once self::module_dir() . 'layout-libs/init.php';
			require_once self::module_dir() . 'widgets/widgets.php';
			require_once self::module_dir() . 'settings/settings.php';
			require_once self::module_dir() . 'template/template.php';
			new RomethemeKit\RkitWidgets();
			\Rkit_Rform::instance();
			\RomethemePlugin\Plugin::register_autoloader();
			\RomethemePlugin\Plugin::load_header_footer();
			\Rkit\Modules\Libs\Init::instance();
			new \RomeTheme\RtmSettings();
			new \RomethemeKit\Template();
			// \RomethemeKit\Rkit_GetPro::instance();	
			add_action('admin_enqueue_scripts', [$this, 'register_style']);
			add_action('wp_ajax_rkitRemoveNotice', [$this, 'rkitRemoveNotice']);
			add_action('elementor/elements/categories_registered', [\RomethemePlugin\Plugin::class, 'add_elementor_widget_categories']);
			add_action('wp_enqueue_scripts', [\RomethemePlugin\Plugin::class, 'register_widget_styles']);
			add_action('elementor/frontend/after_register_scripts', [\RomethemePlugin\Plugin::class, 'register_widget_scripts'], 1);
			add_action('elementor/editor/before_enqueue_styles', [\RomethemePlugin\Plugin::class, 'register_widget_styles']);
			add_action('elementor/editor/before_register_scripts', [\RomethemePlugin\Plugin::class, 'register_widget_scripts']);
			add_action('elementor/editor/before_enqueue_scripts', [\RomethemePlugin\Plugin::class, 'register_widget_scripts'], 1);
			add_filter('admin_footer_text', [$this, 'change_admin_footer']);
			add_filter('elementor/icons_manager/additional_tabs', array(\RomethemePlugin\Plugin::class, 'register_icon_pack_to_elementor'));
			add_action('wp_enqueue_scripts', array(\RomethemePlugin\Plugin::class, 'enqueue_frontend'));
			add_action('admin_enqueue_scripts', array(\RomethemePlugin\Plugin::class, 'enqueue_frontend'));
			add_action('elementor/editor/before_enqueue_styles', [\RomethemePlugin\Plugin::class, 'enqueue_frontend']);
			add_action('rkit_notices', [$this, 'rkit_notice']);
			do_action('rkit_notices');
		}
	}

	function row_meta_link($links, $plugin_file_name, $plugin_data, $status)
	{
		if (strpos($plugin_file_name, basename(__FILE__))) {
			// you can still use array_unshift() to add links at the beginning
			$links[] = '<a target="_blank" href="https://support.rometheme.net/docs/romethemekit/">Docs</a>';
			$links[] = '<a target="_blank" href="https://www.youtube.com/@Rometheme_Studio">Video Tutorials</a>';
		}

		return $links;
	}

	function action_links($plugin_actions, $plugin_file) {
		if (strpos($plugin_file, basename(__FILE__))) {
			$plugin_actions['go_premium'] = sprintf('<a target="_blank" style="font-weight:700; color : #00cea6" href="%s">Upgrade To Pro</a>' , 'https://rometheme.net/pricing/');
		}

		return $plugin_actions;
	}

	static function pluginbasename()
	{
		return plugin_basename(__FILE__);
	}

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	static function min_el_version()
	{
		return '3.0.0';
	}


	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string RomethemeKit Plugin Version.
	 */
	static function rt_version()
	{
		return '1.5.4';
	}

	/**
	 * Plugin file
	 *
	 * @since 1.0.0
	 * @var string plugins's root file.
	 */
	static function plugin_file()
	{
		return __FILE__;
	}

	/**
	 * Plugin url
	 *
	 * @since 1.0.0
	 * @var string plugins's root url.
	 */
	static function plugin_url()
	{
		return trailingslashit(plugin_dir_url(__FILE__));
	}
	/**
	 * Plugin dir
	 *
	 * @since 1.0.0
	 * @var string plugins's root directory.
	 */
	static function plugin_dir()
	{
		return trailingslashit(plugin_dir_path(__FILE__));
	}

	/**
	 * Plugin's module directory.
	 *
	 * @since 1.0.0
	 * @var string module's root directory.
	 */
	static function module_dir()
	{
		return self::plugin_dir() . 'modules/';
	}

	/**
	 * Plugin's module url.
	 *
	 * @since 1.0.0
	 * @var string module's root url.
	 */
	static function module_url()
	{
		return self::plugin_url() . 'modules/';
	}

	/**
	 * Plugin's Widget directory.
	 *
	 * @since 1.0.0
	 * @var string widget's root directory.
	 */
	static function widget_dir()
	{
		return self::plugin_dir() . 'widgets/';
	}

	/**
	 * Plugin's widget url.
	 *
	 * @since 1.0.0
	 * @var string widget's root url.
	 */
	static function widget_url()
	{
		return self::plugin_url() . 'widgets/';
	}

	static function api_url()
	{
		return 'https://api.rometheme.pro/';
	}

	function rometheme_add_menu()
	{
		add_menu_page(
			'RomethemeKit Dashboard',
			'RomethemeKit',
			'manage_options',
			'romethemekit',
			array($this, 'romethemekit_cal'),
			$this->plugin_url() . 'view/romethemekit.svg',
			20
		);

		add_submenu_page(
			'romethemekit',
			esc_html('RomethemeKit Dashboard'),
			esc_html('Dashboard'),
			'manage_options',
			'romethemekit',
			array($this, 'romethemekit_cal'),
			0
		);


		add_submenu_page(
			'romethemekit',
			esc_html('Widgets'),
			esc_html('Widgets'),
			'manage_options',
			'rkit-widgets',
			[$this, 'widgets_call'],
			1
		);

		add_submenu_page(
			'romethemekit',
			esc_html('Theme Builder'),
			esc_html('Theme Builder'),
			'manage_options',
			'themebuilder',
			[$this, 'themebuilder_call'],
			2
		);

		add_submenu_page(
			'romethemekit',
			esc_html('Templates'),
			esc_html('Templates'),
			'manage_options',
			'rtmkit-templates',
			[$this, 'templates_call'],
			3
		);

		add_submenu_page(
			'romethemekit',
			esc_html('System Status'),
			esc_html('System Status'),
			'manage_options',
			'rkit-system-status',
			[$this, 'submenu_system_info'],
			4
		);

		add_submenu_page(
			'romethemekit',
			esc_html('Settings'),
			esc_html('Settings'),
			'manage_options',
			'rtm-settings',
			[$this, 'settings_call'],
			5
		);
	}

	function romethemekit_cal()
	{
		require self::plugin_dir() . 'view/welcome.php';
	}

	function themebuilder_call()
	{
		require RomeTheme::module_dir() . 'themebuilder/views/themebuilder.php';
	}

	function templates_call()
	{
		require RomeTheme::module_dir() . 'template/views/templates.php';
	}

	function settings_call()
	{
		require RomeTheme::module_dir() . 'settings/views/settings-view.php';
	}


	function widgets_call()
	{
		require RomeTheme::module_dir() . 'widgets/views/widgets_view.php';
	}


	function submenu_system_info()
	{
		require self::plugin_dir() . 'view/system.php';
	}

	function register_style()
	{

		wp_enqueue_script('rkit-js', self::plugin_url() . 'assets/js/rkit.js', [], self::rt_version(), true);
		wp_enqueue_style('admin-style', self::plugin_url() . 'assets/css/admin_style.css', [], self::rt_version());
		wp_localize_script('rkit-js', 'ajax_url', array(
			'ajax_url' => admin_url('admin-ajax.php')
		));
		$screen = get_current_screen();
		if (str_contains($screen->id, "romethemekit") ||  $screen->id == 'romethemekit_page_romethemeform-form') {
			wp_enqueue_style('style.css', self::plugin_url() . 'bootstrap/css/bootstrap.css', [], self::rt_version());
			wp_enqueue_script('bootstrap.js', self::plugin_url() . 'bootstrap/js/bootstrap.min.js', [], self::rt_version(), true);
			wp_enqueue_style('fontawesome-icons', self::plugin_url() . 'assets/css/fontawesome/fontawesome.css', [], self::rt_version());
		}

		if (class_exists('RomethemeForm')) {
			$form_nonce = wp_create_nonce('rform_form_ajax_nonce');

			if ($screen->id == 'romethemekit_page_romethemeform-form') {
				wp_enqueue_script('rform-form-js', RomeThemeForm::module_url() . 'form/assets/js/form.js');
				wp_localize_script('rform-form-js', 'romethemeform_ajax_url', array(
					'ajax_url' => admin_url('admin-ajax.php'),
					'rest_url' => rest_url('wp/v2/romethemeform_form/'),
					'nonce' => $form_nonce
				));
				wp_localize_script('rform-form-js', 'romethemeform_url', ['form_url' =>  admin_url() . 'admin.php?page=romethemeform-form']);
			}
		}

		if (class_exists('RomethemePro')) {
			if ($screen->id == 'romethemekit_page_rkitpro-license') {
				wp_enqueue_style('style.css', self::plugin_url() . 'bootstrap/css/bootstrap.css', [], self::rt_version());
				wp_enqueue_script('bootstrap.js', self::plugin_url() . 'bootstrap/js/bootstrap.min.js', [], self::rt_version(), true);
			}
		}
	}

	function change_admin_footer($footer_text)
	{
		$screen = get_current_screen();
		if ($screen->id == 'toplevel_page_romethemekit') {
			$footer_text = 'Thank you for creating with <a href="https://wordpress.org">Wordpress</a>. | Love Using RomethemeKit For Elementor? <a href="https://wordpress.org/plugins/rometheme-for-elementor/#reviews">Rate Us</a> ';
			return $footer_text;
		}
	}

	public function missing_elementor()
	{
		$btn = array(
			'default_class' => 'button',
			'class'         => 'button-primary ', // button-primary button-secondary button-small button-large button-link
		);

		if (file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {
			$btn['text'] = esc_html__('Activate Elementor', 'rometheme-for-elementor');
			$btn['url']  = wp_nonce_url('plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php');
		} else {
			$btn['text'] = esc_html__('Install Elementor', 'rometheme-for-elementor');
			$btn['url']  = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('%1$s requires %2$s to work properly. Please install and activate it first.', 'rometheme-for-elementor'),
			'<strong>' . esc_html__('RomethemeKit for Elementor', 'rometheme-for-elementor') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'rometheme-for-elementor') . '</strong>'
		);

		\Rkit\Libs\Notice::instance('rometheme-for-elementor', 'unsupported-elementor-version')
			->set_type('error')
			->set_message($message)
			->set_button($btn)
			->call();
	}

	public static function rkit_notice()
	{
		$userid = get_current_user_id();
		$rkit_hasbeen_rated = get_user_meta($userid, 'rkit-hasbeen-rated');
		if (empty($rkit_hasbeen_rated)) {
			// add_action('admin_notices',  [\RomethemePlugin\Plugin::class, 'rkit_notice_raw']);
			// echo json_encode($userid);
		}
	}

	public static function rkitRemoveNotice()
	{
		$userid = get_current_user_id();
		add_user_meta($userid, 'rkit-hasbeen-rated', 'true');
	}
}

new RomeTheme();
