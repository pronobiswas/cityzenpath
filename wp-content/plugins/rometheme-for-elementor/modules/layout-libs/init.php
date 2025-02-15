<?php

namespace Rkit\Modules\Libs;

use RomeTheme;

class Init
{
    private $url;
    private static $instance;
    public function __construct()
    {
        $this->url = \RomeTheme::module_url() . 'layout-libs/';
        add_action('elementor/preview/enqueue_styles', [$this, 'preview_styles']);
        add_action('elementor/editor/after_enqueue_styles', [$this, 'editor_styles']);
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'editor_scripts']);
        add_action('elementor/editor/footer', array($this, 'script_var'));
        add_action('wp_ajax_fetch_layout_lib', [$this, 'fetch_layout_lib']);
    }

    public function preview_styles()
    {
        wp_enqueue_style('rkit-preview-style', $this->url . 'assets/css/preview.css');
    }

    public function editor_styles()
    {
        wp_enqueue_style('rkit-library-style', $this->url . 'assets/css/style.css');
    }

    public function editor_scripts()
    {
        $template_nonce =  wp_create_nonce('rtm_template_nonce');
        wp_enqueue_script('rkit-js', \RomeTheme::plugin_url() . 'assets/js/rkit.js', [], \RomeTheme::rt_version(), true);
        wp_enqueue_script('rkit-library-script', $this->url . 'assets/js/script.js', ['jquery'], \RomeTheme::rt_version());
        wp_localize_script('rkit-library-script', 'rkit_libs', [
            'logo_url' => \RomeTheme::plugin_url() . '/view/images/rtmkit-logo-white.png',
            'ajax_url' => admin_url('admin-ajax.php'),
            'template_nonce' => $template_nonce
        ]);
    }

    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function script_var()
    {
?>

        <script type="text/javascript">
            var rkitLO = {
                "btnIcon": "<?php echo esc_url(\RomeTheme::module_url() . 'layout-libs/assets/images/romethemekit.svg'); ?>",
                "api_url": "<?php echo esc_url(\RomeTheme::api_url()) ?>",
                "default_tab": "page"
            };
        </script>

<?php
    }

    public function fetch_layout_lib() {

        if (!isset($_GET['wpnonce']) || !wp_verify_nonce( $_GET['wpnonce'] , 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        $url = "https://api.rometheme.pro/wp-json/public/get_layout_api/";
        $ck = 'ck_p2ke51ckfmb42kefnw67krk93wwjawj6';
        $cs = 'cs_djg1rrp51rn6hvj5ck76x75u99ec8e19';

        if(isset($_GET['id'])) {
            $url .= '?id=' .$_GET['id'];
        }

        $ch = curl_init();
        // Header untuk meminta respons JSON
        $headers = [
            'Accept: application/json'
        ];
        // Atur opsi cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$ck:$cs");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Eksekusi permintaan
        $response = json_decode(curl_exec($ch), true);

        if (curl_errno($ch)) {
            wp_send_json_error('Error:' . curl_error($ch));
        } else {
            wp_send_json($response);
        }
    }
}
