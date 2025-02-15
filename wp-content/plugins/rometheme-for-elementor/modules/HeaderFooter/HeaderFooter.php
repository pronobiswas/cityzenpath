<?php

namespace Rometheme\HeaderFooter;

class HeaderFooter
{

    public $dir;
    public $url;

    function __construct()
    {
        add_action('init', [$this, 'rometheme_header_post_type']);
        add_action('rest_api_init' , [$this , 'cpt_rest_init']);
        add_action('admin_footer', [$this, 'menu_ui']);
        $this->dir = dirname(__FILE__) . '/';
        $this->url = \RomeTheme::module_url() . 'HeaderFooter/';
        add_action('admin_enqueue_scripts', [$this, 'enqueue_style']);
        add_filter('single_template', array($this, 'load_canvas_template'));
        add_action("wp_ajax_updatepost", [$this, "updatepost"]);
        add_action("wp_ajax_addNewPost", [$this, "addNewPost"]);
        add_action('wp', [$this, 'header_footer_template']);
    }

    public function header_footer_template()
    {
        if ($this->get_header_template()) {
            add_action('get_header', array($this, 'override_header_template'), 99);
            add_action('romethemekit_header', array($this, 'render_header'));
        }
        if ($this->get_footer_template()) {
            add_action('get_footer', array($this, 'override_footer_template'), 99);
            add_action('romethemekit_footer', array($this, 'render_footer'));
        }
    }

    function rometheme_header_post_type()
    {
        $labels = array(
            'name'               => esc_html__('Rometheme Templates', 'rometheme-for-elementor'),
            'singular_name'      => esc_html__('Templates', 'rometheme-for-elementor'),
            'menu_name'          => esc_html__('Header Footer', 'rometheme-for-elementor'),
            'name_admin_bar'     => esc_html__('Header Footer', 'rometheme-for-elementor'),
            'add_new'            => esc_html__('Add New', 'rometheme-for-elementor'),
            'add_new_item'       => esc_html__('Add New Template', 'rometheme-for-elementor'),
            'new_item'           => esc_html__('New Template', 'rometheme-for-elementor'),
            'edit_item'          => esc_html__('Edit Template', 'rometheme-for-elementor'),
            'view_item'          => esc_html__('View Template', 'rometheme-for-elementor'),
            'all_items'          => esc_html__('All Templates', 'rometheme-for-elementor'),
            'search_items'       => esc_html__('Search Templates', 'rometheme-for-elementor'),
            'parent_item_colon'  => esc_html__('Parent Templates:', 'rometheme-for-elementor'),
            'not_found'          => esc_html__('No Templates found.', 'rometheme-for-elementor'),
            'not_found_in_trash' => esc_html__('No Templates found in Trash.', 'rometheme-for-elementor'),
        );

        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'rewrite'             => false,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'show_in_nav_menus'   => false,
            'exclude_from_search' => true,
            'capability_type'     => 'page',
            'hierarchical'        => false,
            'show_in_rest' => true,
            'supports'            => array('title', 'thumbnail', 'elementor'),
        );
        register_post_type('rometheme_template', $args);
    }

    function menu_ui()
    {
        $screen = get_current_screen();
        if ($screen->id == 'rometheme-kit_page_header-footer') {
            require_once $this->dir . 'views/add_edit.php';
        }
    }

    function load_canvas_template($single_template)
    {

        global $post;

        if ('rometheme_template' == $post->post_type) {

            $elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

            if (file_exists($elementor_2_0_canvas)) {
                return $elementor_2_0_canvas;
            } else {
                return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
            }
        }

        return $single_template;
    }

    function enqueue_style()
    {

        $nonce = wp_create_nonce('rtm_ajax_nonce');

        $screen = get_current_screen();
        if ($screen->id == 'romethemekit_page_themebuilder' or $screen->id == 'rometheme_template') {
            wp_enqueue_style('style.css', \RomeTheme::plugin_url() . 'bootstrap/css/bootstrap.css');
            wp_enqueue_script('bootstrap.js', \RomeTheme::plugin_url() . 'bootstrap/js/bootstrap.min.js');
            wp_enqueue_style('style', $this->url . 'assets/css/style.css');
            wp_enqueue_script('js', $this->url . 'assets/js/style.js', null, false);
            wp_register_script('js', $this->url  . 'assets/js/style.js');
            wp_localize_script('js', 'rometheme_ajax_url', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => $nonce

            ));
            wp_localize_script('js', 'rometheme_url', ['themebuilder_url' =>  admin_url() . 'admin.php?page=themebuilder']);
        }
    }

    function updatepost()
    {
        $condition = [];

        $postId = sanitize_text_field($_POST['id']);

        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'rtm_ajax_nonce')) {
            wp_send_json_error('Invalid nonce.');
            wp_die();
        }

        if (!current_user_can('edit_posts', $postId)) {
            wp_send_json_error('Access Denied.');
            wp_die();
        }

        if (isset($_POST['include'])) {
            $condition['include'] = $_POST['include'];
        }

        if (isset($_POST['exclude'])) {
            $condition['exclude'] = $_POST['exclude'];
        }

        $data = [
            'ID' => $postId,
            'post_title' => sanitize_text_field($_POST['title']),
            'post_status' => 'publish',
            'meta_input' => [
                'rometheme_template_type' => sanitize_text_field($_POST['type']),
                'rometheme_template_active' => (!isset($_POST['active']) || sanitize_text_field($_POST['active']) == null) ? 'false' : 'true',
                'rometheme_template_condition' => $condition
            ]
        ];

        wp_update_post($data, false, true);
        exit;
    }

    public function addNewPost()
    {

        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'rtm_ajax_nonce')) {
            wp_send_json_error('Invalid nonce.');
            wp_die();
        }

        if (!current_user_can('publish_posts')) {
            wp_send_json_error('Access Denied.');
            wp_die();
        }

        $data = [
            'post_author' => get_current_user_id(),
            'post_title' => sanitize_text_field($_POST['title']),
            'post_type' => 'rometheme_template',
            'post_status' => 'publish'
        ];

        $condition = [];

        if (isset($_POST['include'])) {
            $condition['include'] = $_POST['include'];
        }

        if (isset($_POST['exclude'])) {
            $condition['exclude'] = $_POST['exclude'];
        }

        $post_id = wp_insert_post($data);

        if ($post_id) {
            add_post_meta($post_id, 'rometheme_template_type', sanitize_text_field($_POST['type']));
            add_post_meta($post_id, 'rometheme_template_active', sanitize_text_field($_POST['active']));

            if (!empty($condition)) {
                add_post_meta($post_id, 'rometheme_template_condition', $condition);
            }

            if ($_POST['type'] != '404') {
                add_post_meta($post_id, '_elementor_template_type', 'error-404');
            }

            // Menambahkan respon JSON jika penyisipan posting berhasil
            wp_send_json_success('success');
        } else {
            // Menambahkan respon JSON jika penyisipan posting gagal
            wp_send_json_error('Failed Save Template');
        }
    }

    public function get_header_template()
    {
        $args = [
            'post_type' => 'rometheme_template',
            'post_status' => 'publish',
            'meta_query' => [
                'relations' => 'AND',
                [
                    'key' => 'rometheme_template_type',
                    'value' => 'header'
                ],
                [
                    'key' => 'rometheme_template_active',
                    'value' => 'true'
                ]
            ]
        ];
        $header = get_posts($args);
        return $header;
    }

    function get_footer_template()
    {
        $args = [
            'post_type' => 'rometheme_template',
            'post_status' => 'publish',
            'meta_query' => [
                'relations' => 'AND',
                [
                    'key' => 'rometheme_template_type',
                    'value' => 'footer'
                ],
                [
                    'key' => 'rometheme_template_active',
                    'value' => 'true'
                ]
            ]
        ];
        $footer = get_posts($args);
        return $footer;
    }
    public function get_header_content($header_id)
    {
        return \Elementor\Plugin::instance()->frontend->get_builder_content($header_id);
    }

    public function get_footer_content($footer_id)
    {
        return \Elementor\Plugin::instance()->frontend->get_builder_content($footer_id);
    }

    public function override_header_template()
    {
        load_template($this->dir . 'templates/header_template.php');
        $templates   = array();
        $templates[] = 'header.php';
        remove_all_actions('wp_head');
        ob_start();
        locate_template($templates, true);
        ob_get_clean();
    }

    public function override_footer_template()
    {
        load_template($this->dir . 'templates/footer_template.php');
        $templates   = array();
        $templates[] = 'footer.php';
        remove_all_actions('wp_footer');
        ob_start();
        locate_template($templates, true);
        ob_get_clean();
    }

    public function render_header()
    {
        $headers = $this->get_header_template();

        foreach ($headers as $header) {
            $header_id = $header->ID;
            $condition = get_post_meta($header_id, 'rometheme_template_condition', true);
            if ($this->rtm_location_template($condition)) {
                $header_html = '<header id="masthead" itemscope="itemscope" itemtype="https://schema.org/WPHeader">%s</header>';
                echo sprintf($header_html, $this->get_header_content($header_id));
            }
        }
    }

    public function render_footer()
    {
        $footers = $this->get_footer_template();
        foreach ($footers as $footer) {
            $footer_id = $footer->ID;
            $condition = get_post_meta($footer_id, 'rometheme_template_condition', true);
            if ($this->rtm_location_template($condition)) {
                $footer_html = '<footer itemscope="itemscope" itemtype="https://schema.org/WPFooter">%s</footer>';
                echo sprintf($footer_html, $this->get_footer_content($footer_id));
            }
        }
    }

    public static function get_restore_post_link($post_id)
    {
        $nonce = wp_create_nonce('untrash-post_' . $post_id);
        $url = wp_nonce_url(admin_url('post.php?post=' . $post_id . '&action=untrash'), 'untrash-post_' . $post_id, '_wpnonce');
        return $url;
    }

    public static function get_delete_permanent_link($post_id)
    {
        $nonce = wp_create_nonce('delete-post_' . $post_id);
        $url = wp_nonce_url(admin_url('post.php?post=' . $post_id . '&action=delete'), 'delete-post_' . $post_id, '_wpnonce');
        return $url;
    }

    public function rtm_location_template($condition)
    {
        if (isset($condition['include']) && isset($condition['exclude'])) {
            if ((is_archive() || is_home())) {
                if (in_array('archive', $condition['include'])) {
                    return true;
                } elseif (in_array('archive', $condition['exclude'])) {
                    return false;
                } else {
                    return true;
                }
            } elseif (is_single()) {
                if (in_array('singular', $condition['include'])) {
                    return true;
                } elseif (in_array('singular', $condition['exclude'])) {
                    return false;
                } else {
                    return true;
                }
            } elseif (is_search()) {
                if (in_array('archive', $condition['include'])) {
                    return true;
                } elseif (in_array('archive', $condition['exclude'])) {
                    return false;
                } else {
                    return true;
                }
            } elseif (is_404()) {
                if (in_array('404', $condition['include'])) {
                    return true;
                } elseif (in_array('404', $condition['exclude'])) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (in_array('all', $condition['include'])) {
                    return true;
                } elseif (in_array('all', $condition['exclude'])) {
                    return false;
                }
            }
        } elseif (isset($condition['include'])) {
            if ((is_archive() || is_home()) && in_array('archive', $condition['include'])) {
                return true;
            } elseif (is_single() && in_array('singular', $condition['include'])) {
                return true;
            } elseif (is_search() && in_array('archive', $condition['include'])) {
                return true;
            } elseif (is_404() && in_array('404', $condition['include'])) {
                return true;
            } elseif (in_array('all', $condition['include'])) {
                return true;
            } else {
                return true;
            }
        } elseif (isset($condition['exclude'])) {
            if ((is_archive() || is_home()) && in_array('archive', $condition['exclude'])) {
                return false;
            } elseif (is_single() && in_array('singular', $condition['exclude'])) {
                return false;
            } elseif (is_search() && in_array('archive', $condition['exclude'])) {
                return false;
            } elseif (is_404() && in_array('404', $condition['exclude'])) {
                return false;
            } elseif (in_array('all', $condition['exclude'])) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function cpt_rest_init()
    {
        // Nama CPT, ganti dengan slug CPT Anda
        $cpt_slug = 'rometheme_template';

        // Tambahkan post meta ke dalam respons REST API untuk CPT
        register_rest_field($cpt_slug, 'metadata', [
            'get_callback' => function ($object) {
                // Ambil semua meta terkait post ini
                return get_post_meta($object['id']);
            },
            'update_callback' => null, // Opsional: bisa ditambahkan jika ingin mengubah meta
            'schema' => null,
        ]);
    }
}
