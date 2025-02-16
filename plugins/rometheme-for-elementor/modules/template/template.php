<?php

namespace RomethemeKit;

use ZipArchive;

class Template
{
    public $url;
    public $ck;
    public $cs;
    public function __construct()
    {
        $this->url = 'https://api.rometheme.pro';
        $this->ck = 'ck_p2ke51ckfmb42kefnw67krk93wwjawj6';
        $this->cs = 'cs_djg1rrp51rn6hvj5ck76x75u99ec8e19';
        add_action('wp_ajax_fetch_lib', [$this, 'fetch_lib']);
        add_action('admin_enqueue_scripts', [$this, 'register_scripts']);
        add_action('init', [$this, 'init_template_dir']);
        add_action('wp_ajax_download_template', [$this, 'download_template']);
        add_action('wp_ajax_import_rtm_template', [$this, 'import_rtm_template']);
        add_action('wp_ajax_delete_template', [$this, 'delete_template']);
        add_action('wp_ajax_delete_installed_template', [$this, 'delete_installed_template']);
        add_action('wp_ajax_get_import_progress', [$this, 'get_import_progress']);
        add_action('wp_ajax_get_installed_template', [$this, 'get_installed_template']);
        add_action('wp_ajax_get_template_content', [$this, 'get_template_content']);
        add_action('wp_ajax_install_requirements', [$this, 'install_requirements']);
        add_action('wp_ajax_template_category', [$this, 'template_category']);
        add_action('wp_ajax_get_installed_templates', [$this, 'get_installed_templates']);
    }

    public function init_template_dir()
    {
        // Path direktori yang ingin dibuat
        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/rometheme_template';

        // Cek apakah direktori sudah ada
        if (!file_exists($custom_dir)) {
            // Buat direktori
            if (wp_mkdir_p($custom_dir)) {
                // Atur izin direktori ke 0777
                chmod($custom_dir, 0777);
            }
        }
    }

    public function fetch_lib()
    {

        if (!isset($_POST['wpnonce']) || !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        $ch = curl_init();
        // Header untuk meminta respons JSON
        $headers = [
            'Accept: application/json'
        ];
        // Atur opsi cURL
        curl_setopt($ch, CURLOPT_URL, $this->url . '/wp-json/public/template_lib');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->ck:$this->cs");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Eksekusi permintaan
        $response = json_decode(curl_exec($ch), true);

        // Cek untuk error
        if (curl_errno($ch)) {
            wp_send_json_error('Error:' . curl_error($ch));
        } else {
            if (isset($_POST['search']) || !empty($_POST['search'])) {
                $search = strtolower(trim($_POST['search'])); // Normalisasi input
                $response = array_filter($response, function ($item) use ($search) {
                    return stripos($item['name'], $search) !== false ||
                        stripos($item['category'], $search) !== false ||
                        stripos($item['type'], $search) !== false;
                });
            }

            if (isset($_POST['category']) || !empty($_POST['category'])) {
                $category = $_POST['category'];
                $response = array_filter($response, function ($item) use ($category) {
                    return stripos($item['category'], $category) !== false;
                });
            }

            // Pagination parameters
            $paged = isset($_POST['paged']) ? max(1, intval($_POST['paged'])) : 1; // Default halaman 1
            $per_page = 12; // Jumlah item per halaman

            // Hitung total halaman
            $total_items = count($response);
            $total_pages = ceil($total_items / $per_page);

            // Filter data untuk halaman saat ini
            $offset = ($paged - 1) * $per_page;
            $paged_data = array_slice($response, $offset, $per_page);
            $data = [];

            foreach ($paged_data as $k => $v) {
                $data[$k] = [
                    'id' => $v['id'],
                    'name' => $v['name'],
                    'category' => $v['category'],
                    'type' => $v['type'],
                    'preview_url' => $v['preview_url'],
                    'image_preview' => $v['image_preview'],
                    'downloads' => $v['downloads'],
                    'has_installed' => $this->has_installed(wp_hash($v['id'])),
                    'installed' => ($this->has_installed(wp_hash($v['id']))) ? wp_hash($v['id']) : null
                ];
                // array_push($data , $datas);
            }

            // Response
            wp_send_json_success([
                'data_template' => $data,
                'pagination' => [
                    'current_page' => $paged,
                    'total_pages' => $total_pages,
                ],
                'template_url' => admin_url('admin.php?page=rtmkit-templates')
            ]);

            curl_close($ch);
        }
    }

    public function register_scripts()
    {
        $screen = get_current_screen();
        $nonce = wp_create_nonce('rtm_template_nonce');
        if ($screen->id == 'romethemekit_page_rtmkit-templates') {
            wp_enqueue_script('template-scripts', \Rometheme::module_url() . 'template/assets/js/template.js');
            wp_localize_script('template-scripts', 'rometheme_ajax', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => $nonce
            ]);
        }
    }

    public function download_template()
    {
        if (!current_user_can('manage_options')) {
            wp_die();
        }

        if (!isset($_POST['wpnonce']) || !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        $id = $_POST['template'];
        $ch = curl_init();
        // Header untuk meminta respons JSON
        $headers = [
            'Accept: application/json'
        ];
        // Atur opsi cURL
        curl_setopt($ch, CURLOPT_URL, $this->url . '/wp-json/public/template_lib?id=' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->ck:$this->cs");
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Eksekusi permintaan
        $response = json_decode(curl_exec($ch), true);

        $url = $response['zip_url'];

        if (curl_errno($ch)) {
            wp_send_json_error('Error:' . curl_error($ch));
        }
        curl_close($ch);

        $this->update_download($id);
        $this->template_extract($url, $response['id']);
    }

    public function import_rtm_template()
    {
        if (!current_user_can('manage_options')) {
            wp_die();
        }

        if (!isset($_POST['wpnonce']) || !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        // Ambil parameter yang diperlukan
        $template = sanitize_text_field($_POST['template']);
        $path = sanitize_text_field($_POST['path']);
        $template_name = sanitize_text_field($_POST['template_name']);
        $upload_dir = wp_upload_dir();
        $template_dir = $upload_dir['basedir'] . '/rometheme_template';
        $fullPath = $template_dir . '/' . $template . '/' . $path;

        $transient_id = 'rtm_import_progress_' . $template . '_' . $template_name;
        // Awal progres
        set_transient($transient_id, ['progress' => 0, 'message' => 'Initializing import...'], 60);

        // Validasi file JSON
        if (!file_exists($fullPath)) {
            set_transient($transient_id, ['progress' => 100, 'message' => 'File not found!'], 60);
            wp_send_json_error('File JSON tidak ditemukan.');
            return;
        }

        $json_data = file_get_contents($fullPath);
        $template_data = json_decode($json_data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            set_transient('rtm_import_progress', ['progress' => 100, 'message' => 'Invalid JSON file.'], 60);
            wp_send_json_error('File JSON tidak valid.');
            return;
        }

        // Update progres
        set_transient($transient_id, ['progress' => 25, 'message' => 'Importing template...'], 60);

        // Akses Template Manager dan lakukan import
        $local_source = \Elementor\Plugin::$instance->templates_manager->get_source('local');
        $temp_template = wp_tempnam('temp_' . $template);
        file_put_contents($temp_template, $json_data);
        $result = $local_source->import_template(basename($temp_template), $temp_template);

        if (file_exists($temp_template)) {
            unlink($temp_template);
        }

        if (is_wp_error($result)) {
            set_transient($transient_id, ['progress' => 100, 'message' => 'Failed to import template.'], 60);
            wp_send_json_error('Failed to import template: ' . esc_html($result->get_error_message()));
        }

        if ($result[0] && $result[0]['template_id']) {
            $imported_template_id = $result[0]['template_id'];
            set_transient($transient_id, ['progress' => 50, 'message' => 'Importing Template...'], 60);
            if ($template_data['metadata'] && ! empty($template_data['metadata']['template_type']) && 'global-styles' === $template_data['metadata']['template_type']) {
                // We set some metadata around the global template so Elementor can interpret them correctly:
                // From: wp-content/plugins/elementor/core/documents-manager.php:366
                update_post_meta($imported_template_id, '_elementor_edit_mode', 'builder');
                update_post_meta($imported_template_id, '_elementor_template_type', 'kit');
                // Set the global theme styles to this newly imported template:
                update_option('elementor_active_kit', $imported_template_id);

                // Update the kit styles title so we can display it nicely in the drop down settings UI.
                wp_update_post(
                    array(
                        'ID'         => $imported_template_id,
                        'post_title' => 'Kit Styles: ' . $this->get_template_name($template),
                    )
                );
            }

            set_transient($transient_id, ['progress' => 75, 'message' => 'Importing Template...'], 60);
            $history = get_option('rtm_import_template_' . $template, []);
            $history[str_replace(' ', '_', html_entity_decode($result[0]['title']))] = $imported_template_id;
            update_option('rtm_import_template_' . $template, $history);
            $result[0]['edit_url'] = admin_url('post.php?post=' . $imported_template_id . '&action=elementor');
            $result[0]['delete_url'] = get_delete_post_link($imported_template_id);
        }
        delete_transient($transient_id);
        wp_send_json_success($result[0]);
    }

    public function get_import_progress()
    {
        if (!current_user_can('manage_options')) {
            wp_die();
        }
        $template = sanitize_text_field($_POST['template']);
        $template_name = sanitize_text_field($_POST['template_name']);
        $transient_id = 'rtm_import_progress_' . $template . '_' . $template_name;

        $progress = get_transient($transient_id);
        if (!$progress) {
            wp_send_json_error(['progress' => 100, 'message' => 'No progress available.']);
        } else {
            wp_send_json_success($progress);
        }
    }

    public function get_installed_template()
    {
        if (!isset($_POST['wpnonce']) || !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        $hashId = $_POST['template'];

        $upload_dir = wp_upload_dir();
        $rtmTemplateDir = $upload_dir['basedir'] . '/rometheme_template';
        $imported = get_option('rtm_import_template_' . $hashId, []);
        $manifest = json_decode(file_get_contents($rtmTemplateDir . '/' . $hashId . '/manifest.json'), true);
        $rtmTemplateUrl = $upload_dir['baseurl'] . '/rometheme_template/' . $hashId;
        $manifest['path_url'] = $rtmTemplateUrl;

        $data = [
            "imported" => $imported,
            "manifest" => $manifest,
            "description" => $this->get_template_description($this->get_installed_template_id($hashId))
        ];
        wp_send_json_success($data);
    }

    public function get_installed_templates()
    {
        $templates = get_option('rtm_template_installed', []);
        $upload_dir = wp_upload_dir();
        $rtmTemplateDir = $upload_dir['basedir'] . '/rometheme_template';
        $data = [];

        foreach ($templates as $template => $v) {
            $id = $v['template_id'];
            $manifest = json_decode(file_get_contents($rtmTemplateDir . '/' . $template . '/manifest.json'));
            foreach ($manifest->templates as $i => $v) {
                if (stripos($v->name, 'home') !== false) {
                    $preview = $v->preview_url;
                }
            }
            $data[$template] = [
                'id' => $id,
                'name' => $manifest->title,
                'image_preview_url' =>  \RomethemeKit\Template::get_template_image_preview_url($id),
                'preview_url' => $preview
            ];
        }

        wp_send_json_success($data);
    }


    public function get_template_name($hashId)
    {
        $upload_dir = wp_upload_dir();
        $rtmTemplateDir = $upload_dir['basedir'] . '/rometheme_template';

        $manifest = json_decode(file_get_contents($rtmTemplateDir . '/' . $hashId . '/manifest.json'));

        return $manifest->title;
    }

    function template_extract($url, $id)
    {
        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/rometheme_template';
        $tempFile = wp_tempnam($url);

        $hashId = wp_hash($id);
        $targetDir = $custom_dir . '/' . $hashId;

        $response = wp_remote_get($url, ['timeout' => 300]);

        if (is_wp_error($response)) {
            wp_send_json_error($response->get_error_message());
        }

        $fileContent = wp_remote_retrieve_body($response);

        file_put_contents($tempFile, $fileContent);

        $zip = new ZipArchive();
        if ($zip->open($tempFile) === TRUE) {
            wp_mkdir_p($targetDir);
            $zip->extractTo($targetDir);
            $zip->close();
            unlink($tempFile);

            $option = get_option('rtm_template_installed', []); // Default ke array jika tidak ada option
            if (!is_array($option)) {
                $option = []; // Pastikan $option adalah array
            }
            $option[$hashId] = [
                'template_id' => $id
            ];

            update_option('rtm_template_installed', $option); // Simpan kembali ke database

            wp_send_json_success(['message' => 'success extract', 'template' => $hashId]);
        }
    }

    function update_download($id)
    {

        $ch = curl_init();
        // Header untuk meminta respons JSON
        $headers = [
            'Accept: application/json'
        ];
        // Atur opsi cURL
        curl_setopt($ch, CURLOPT_URL, $this->url . '/wp-json/public/updld?id=' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->ck:$this->cs");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Eksekusi permintaan
        $response = json_decode(curl_exec($ch), true);
    }

    function has_installed($hashId)
    {
        $option = get_option('rtm_template_installed');
        if (!is_array($option)) {
            return false;
        } else {
            return (array_key_exists($hashId, $option));
        }
    }

    public static function get_installed_template_id($template)
    {
        $installed_template = get_option('rtm_template_installed', []);

        foreach ($installed_template as $k => $v) {
            if ($k === $template) {
                return $v['template_id'];
            }
        }
    }

    public static function get_template_description($id)
    {
        $f = new self();
        return $f->_get_template_description($id);
    }

    public static function get_template_image_preview_url($id)
    {
        $f = new self();
        $res = $f->_get_template_item_data($id);
        return $res['preview_image_url'];
    }

    public function get_template_content()
    {
        if (!isset($_POST['wpnonce']) ||  !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        $id = absint($_POST['template']);

        $elementorData = get_post_meta($id, '_elementor_data', true);

        $data = ['content' => json_decode($elementorData)];

        wp_send_json_success($data);
    }

    private function _get_template_item_data($id)
    {
        $ch = curl_init();
        // Header untuk meminta respons JSON
        $headers = [
            'Accept: application/json'
        ];
        // Atur opsi cURL
        curl_setopt($ch, CURLOPT_URL, $this->url . '/wp-json/public/template_lib?id=' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->ck:$this->cs");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Eksekusi permintaan
        $response = json_decode(curl_exec($ch), true);

        return $response;
    }

    private function _get_template_description($id)
    {
        $response = $this->_get_template_item_data($id);
        return $response['description'];
    }

    public static function get_template_category()
    {
        $f = new self();
        return $f->_get_template_category();
    }

    public function _get_template_category()
    {
        $ch = curl_init();
        // Header untuk meminta respons JSON
        $headers = [
            'Accept: application/json'
        ];
        // Atur opsi cURL
        curl_setopt($ch, CURLOPT_URL, $this->url . '/wp-json/public/template_lib_cat');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->ck:$this->cs");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Eksekusi permintaan
        $response = json_decode(curl_exec($ch), true);

        return $response;
    }

    public function template_category()
    {
        if (!isset($_POST['wpnonce']) ||  !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        $cat = $this->get_template_category();
        if ($cat) {
            wp_send_json_success($cat);
        } else {
            wp_send_json_error();
        }
    }

    public function delete_template()
    {
        if (!current_user_can('manage_options')) {
            wp_die();
        }

        if (!isset($_POST['wpnonce']) || !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
        require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
        $file_system_direct = new \WP_Filesystem_Direct(false);

        $template = $_POST['template'];

        $upload_dir = wp_upload_dir();
        $custom_dir = $upload_dir['basedir'] . '/rometheme_template';
        $template_dir = $custom_dir . '/' . $template;
        if ($file_system_direct->rmdir($template_dir, true)) {
            $option = get_option('rtm_template_installed');

            unset($option[$template]);
            update_option('rtm_template_installed', $option);
            delete_option('rtm_import_template_' . $template);

            wp_send_json_success('Delete Success');
        } else {
            wp_send_json_error('Failed to Delete Template directory' . $template_dir);
        }
    }

    public function delete_installed_template()
    {
        if (!current_user_can('manage_options')) {
            wp_die();
        }

        if (!isset($_POST['wpnonce']) ||  !wp_verify_nonce($_POST['wpnonce'], 'rtm_template_nonce')) {
            wp_send_json_error('Access Denied');
            wp_die();
        }

        $id = $_POST['template_id'];
        $template = $_POST['template'];
        $op = get_option('rtm_import_template_' . $template, []);

        foreach ($op as $k => $v) {
            if ($id == $v) {
                $keyTemplate  = $k;
            }
        }

        if (wp_delete_post($id)) {
            unset($op[$keyTemplate]);
            update_option('rtm_import_template_' . $template, $op);
            wp_send_json_success('success');
        }
    }

    public static function missing_plugins($required)
    {
        $missing = [];

        foreach ($required as $plugin) {
            if (!is_plugin_active($plugin->file)) {
                array_push($missing, $plugin);
            }
        }
        return $missing;
    }

    public function install_requirements()
    {
        if (!current_user_can('manage_options')) {
            wp_die();
        }

        include_once ABSPATH . 'wp-admin/includes/plugin.php';
        include_once ABSPATH . 'wp-admin/includes/file.php';
        include_once ABSPATH . 'wp-admin/includes/misc.php';
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

        $plugin = $_POST['plugin'];
        $plugin_file = WP_PLUGIN_DIR . '/' . $plugin;
        $plugin_slug = dirname($plugin);

        if (file_exists($plugin_file)) {
            // Activate the plugin if already installed but inactive
            ob_start();
            activate_plugin($plugin);
            ob_clean();
            ob_end_clean();
            wp_send_json_success("Install and Activate Successfully");
        } else {
            ob_start();
            $plugin_download_url = "https://downloads.wordpress.org/plugin/{$plugin_slug}.latest-stable.zip"; // Adjust URL structure
            $upgrader = new \Plugin_Upgrader();
            $result = $upgrader->install($plugin_download_url);

            if (is_wp_error($result)) {
                wp_send_json_error();
            }
            $activate_result = activate_plugin($plugin);
            if (is_wp_error($activate_result)) {
                wp_send_json_error('Plugin installed but failed to activate: ' . $activate_result->get_error_message());
            }

            wp_send_json_success('Plugin installed and activated successfully.');
        }
    }
}
