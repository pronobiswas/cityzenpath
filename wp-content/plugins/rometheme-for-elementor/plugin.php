<?php
namespace RomethemePlugin;

use Custom_Template_Control;
use RomeTheme;
use Rometheme\HeaderFooter\HeaderFooter;
use RomethemeKit\Autoloader;
use RomethemePro;

class Plugin
{
    public static function register_autoloader()
    {
        require_once \RomeTheme::plugin_dir() . '/autoloader.php';
        Autoloader::run();
    }

    public static function load_header_footer()
    {
        require_once \RomeTheme::module_dir() . 'HeaderFooter/HeaderFooter.php';
        new HeaderFooter();
    }

    public static function register_widget_styles()
    {
        wp_enqueue_style('rkit-offcanvas-style', \RomeTheme::widget_url() . 'assets/css/offcanvas.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-navmenu-style', \RomeTheme::widget_url() . 'assets/css/navmenu.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-headerinfo-style', \RomeTheme::widget_url() . 'assets/css/headerinfo.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('navmenu-rkit-style', \RomeTheme::widget_url() . 'assets/css/rkit-navmenu.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-search-style', \RomeTheme::widget_url() . 'assets/css/search.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-sitelogo-style', \RomeTheme::widget_url() . 'assets/css/site_logo.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-post-grid-style', \RomeTheme::widget_url() . 'assets/css/rkit-blog-post.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-post-block-style', \RomeTheme::widget_url() . 'assets/css/rkit-post-block.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-cta-style', \RomeTheme::widget_url() . 'assets/css/cta.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-blockquote', \RomeTheme::widget_url() . 'assets/css/blockquote.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-social-share', \RomeTheme::widget_url() . 'assets/css/social_share.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-team-style', \RomeTheme::widget_url() . 'assets/css/rkit_team.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-running_text-style', \RomeTheme::widget_url() . 'assets/css/running_text.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-animated_heading-style', \RomeTheme::widget_url() . 'assets/css/animated_heading.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-card_slider-style', \RomeTheme::widget_url() . 'assets/css/card_slider.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-accordion-style', \RomeTheme::widget_url() . 'assets/css/accordion.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-testimonial_carousel-style', \RomeTheme::widget_url() . 'assets/css/testimonial_carousel.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-swiper', \RomeTheme::widget_url() . 'assets/css/swiper-bundle.min.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-tabs-style', \RomeTheme::widget_url() . 'assets/css/tabs.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-progress-style', \RomeTheme::widget_url() . 'assets/css/progress-bar.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('counter-style', \RomeTheme::widget_url() . 'assets/css/counter.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('countdown-style', \RomeTheme::widget_url() . 'assets/css/countdown.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-pricelist-style', \RomeTheme::widget_url() . 'assets/css/pricelist.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('advanced_heading-style', \RomeTheme::widget_url() . 'assets/css/advanced_heading.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('image_comparison-style', \RomeTheme::widget_url() . 'assets/css/image_comparison.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-client_carousel-style', \RomeTheme::widget_url() . 'assets/css/client_carousel.css', '', \RomeTheme::rt_version());
         wp_enqueue_style('postlist-style', \RomeTheme::widget_url() . 'assets/css/postlist.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('pricebox-style', \RomeTheme::widget_url() . 'assets/css/pricingbox.css', '', \RomeTheme::rt_version());
        // wp_enqueue_style('post_carousel-style', \RomeTheme::widget_url() . 'assets/css/post_carousel.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('advanced_heading-style', \RomeTheme::widget_url() . 'assets/css/advanced_heading.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-image_box-style', \RomeTheme::widget_url() . 'assets/css/image_box.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-image_accordion-style', \RomeTheme::widget_url() . 'assets/css/image_accordion.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-dual_button-style', \RomeTheme::widget_url() . 'assets/css/dual_button.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('price_list-style', \RomeTheme::widget_url() . 'assets/css/price_list.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-image_gallery-style', \RomeTheme::widget_url() . 'assets/css/image_gallery.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-home-slider-style', \RomeTheme::widget_url() . 'assets/css/home_slider.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-woo_product_grid-style', \RomeTheme::widget_url() . 'assets/css/woo_product_grid.css', '', \RomeTheme::rt_version());
    
    }

    public static function register_widget_scripts()
    {
        wp_enqueue_script('rkit-offcanvas-script', \RomeTheme::widget_url() . 'assets/js/offcanvas.js' ,  ['jquery'], \RomeTheme::rt_version(), true );
        wp_enqueue_script('rkit-navmenu-script', \RomeTheme::widget_url() . 'assets/js/navmenu.js',  ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('navmenu-rkit-script', \RomeTheme::widget_url() . 'assets/js/rkit-navmenu.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('social-share-script', \RomeTheme::widget_url() . 'assets/js/social_share.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('running-text-script', \RomeTheme::widget_url() . 'assets/js/running_text.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('card-slider-script', \RomeTheme::widget_url() . 'assets/js/card_slider.js', ['jquery'], \RomeTheme::rt_version(), false);
        wp_enqueue_script('animated-heading-script', \RomeTheme::widget_url() . 'assets/js/animated_heading.js', ['jquery'], \RomeTheme::rt_version(), false);
        wp_enqueue_script('accordion-script', \RomeTheme::widget_url() . 'assets/js/accordion.js', ['jquery'], \RomeTheme::rt_version(), false);
        wp_enqueue_script('bar_chart-script', \RomeTheme::widget_url() . 'assets/js/bar_chart.js', ['jquery'], \RomeTheme::rt_version(), false);
        wp_enqueue_script('line_chart-script', \RomeTheme::widget_url() . 'assets/js/line_chart.js', ['jquery'], \RomeTheme::rt_version(), false);
        wp_enqueue_script('pie_chart-script', \RomeTheme::widget_url() . 'assets/js/pie_chart.js', ['jquery'], \RomeTheme::rt_version(), false);
        wp_enqueue_script('chartjs', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js', [], \RomeTheme::rt_version(), true);
        wp_enqueue_script('swiperjs', \RomeTheme::widget_url() . 'assets/js/swiper-bundle.min.js',  [], \RomeTheme::rt_version(), false);
        wp_enqueue_script('rkit-testimonial_carousel', \RomeTheme::widget_url() . 'assets/js/testimonial_carousel.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('rkit-tabs-script', \RomeTheme::widget_url() . 'assets/js/tabs.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('progress-script', \RomeTheme::widget_url() . 'assets/js/progress.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('rkit-counter-script', \RomeTheme::widget_url() . 'assets/js/counter.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('rkit-countdown-script', \RomeTheme::widget_url() . 'assets/js/countdown.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('rkit-image-comparison-script', \RomeTheme::widget_url() . 'assets/js/image_comparison.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('clientlogo-script', \RomeTheme::widget_url() . 'assets/js/client_carousel.js', ['jquery'], \RomeTheme::rt_version(), true);
        wp_enqueue_script('rkit-image_comparison-script', \RomeTheme::widget_url() . 'assets/js/image_comparison.js', ['jquery'], \RomeTheme::rt_version(), true);
        // wp_enqueue_script('rkit-post_carousel-script', \RomeTheme::widget_url() . 'assets/js/post_carousel.js', ['jquery'], \RomeTheme::rt_version(),true);
        wp_enqueue_script('rkit-image_accordion-script', \RomeTheme::widget_url() . 'assets/js/image_accordion.js', ['jquery'], \RomeTheme::rt_version(),true);
        wp_enqueue_script('rkit-image_gallery-script', \RomeTheme::widget_url() . 'assets/js/image_gallery.js', ['jquery'], \RomeTheme::rt_version(),true);
        wp_enqueue_script('rkit-image_gallery_masonry-script', \RomeTheme::widget_url() . 'assets/js/masonry.pkgd.min.js', ['jquery'], \RomeTheme::rt_version(),true);
        wp_enqueue_script('rkit-image_gallery_masonry_loaded-script', \RomeTheme::widget_url() . 'assets/js/imagesloaded.pkgd.min.js', ['jquery'], \RomeTheme::rt_version(),true);
        wp_enqueue_script('rkit-home-slider-script', \RomeTheme::widget_url() . 'assets/js/home_slider.js', ['jquery'], \RomeTheme::rt_version(),true);
    }

    public static function  add_elementor_widget_categories($elements_manager)
    {
        $elements_manager->add_category(
            'romethemekit_header_footer',
            [
                'title' => esc_html__('Rometheme Header & Footer', 'rometheme-for-elementor')
            ]
        );

        $elements_manager->add_category(
            'romethemekit_widgets',
            [
                'title' => esc_html__('Romethemekit', 'rometheme-for-elementor')
            ]
        );

        $elements_manager->add_category(
            'romethemekit_widgets_pro',
            [
                'title' => esc_html__('Romethemekit Pro', 'rometheme-for-elementor')
            ]
        );
    }

    public static function rkit_notice_raw()
    {
        $btn1 = [
            'default_class' => 'button',
            'class' => 'button-primary',
            'text' => esc_html__('Yes, I Deserve it', 'rometheme-for-elementor'),
            'url' => sanitize_url('https://wordpress.org/support/plugin/rometheme-for-elementor/reviews/')
        ];

        $btn2 = [
            'default_class' => 'button',
            'class' => 'rkit-button-link',
            'target' => '_blank',
            'text' => esc_html__('I Need Help', 'rometheme-for-elementor'),
            'url' => sanitize_url('https://rometheme.net/contact-us/')
        ];
        $message = sprintf(
            '%1$s',
            'Hi there, Thanks for using RomethemeKit For Elementor. we hope our plugin helpful in building your website. please let us know what you think of RomethemeKit For Elementor by leaving a rating, This would boost our motivation and help other users make a comfortable decision while choosing the RomethemeKit For Elementor.'
        );
        $logo = \RomeTheme::plugin_url() . 'view/images/rometheme.png';
        $rkit_hasbeen_rated = get_user_meta(get_current_user_id(), 'rkit-hasbeen-rated');
?>
        <div id="rkit-notices" class="notice rkit-notice notice-info is-dismissible">
            <img src="<?php echo esc_attr($logo) ?>" style="width:5rem;height:5rem;" alt="">
            <div>
                <div class="rkit-notice-body">
                    <?php echo esc_html($message) ?>
                </div>
                <div class="rkit-notice-footer">
                    <form method="POST">
                        <button onclick="remove_notice('<?php echo esc_attr($btn1['url']) ?>')" type="button" class="button <?php echo esc_attr($btn1['class']) ?> "><?php echo esc_html($btn1['text']) ?></button>
                    </form>
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
            .rkit-notice {
                display: flex !important;
                flex-direction: row !important;
                padding: .5rem;
                gap: 1rem;
                align-items: center;
            }

            .rkit-notice-body {
                margin-bottom: 0.8rem;
            }

            .rkit-notice-footer {
                display: flex;
                flex-direction: row;
                gap: .5rem;
            }

            .rkit-button-link {
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

    public static function register_icon_pack_to_elementor($font)
    {
        unset($font['rtmicons']);
        unset($font['rtmicons-thin']);
        $font_new['rtmicons'] = array(
            'name'          => 'rtmicons',
            'label'         => esc_html__('RomethemeKit - Regular', 'rometheme-for-elementor'),
            'url'           => \RomeTheme::plugin_url() . 'assets/css/rtmicon-regular.css',
            'prefix'        => 'rtmicon-',
            'displayPrefix' => 'rtmicon',
            'labelIcon'     => 'rtmicon rtmicon-romethemekit',
            'ver'           => \RomeTheme::rt_version(),
            'fetchJson'     => \RomeTheme::plugin_url() . 'assets/js/rtmicon.json',
            'native'        => true,
        );
        $font_new['rtmicons-thin'] = array(
            'name'          => 'rtmicons-thin',
            'label'         => esc_html__('RomethemeKit - Thin', 'rometheme-for-elementor'),
            'url'           => \RomeTheme::plugin_url() . 'assets/css/rtmicon-thin.css',
            'prefix'        => 'rtmicon-',
            'displayPrefix' => 'rtmicon-thin',
            'labelIcon'     => 'rtmicon-thin rtmicon-romethemekit',
            'ver'           => \RomeTheme::rt_version(),
            'fetchJson'     => \RomeTheme::plugin_url() . 'assets/js/rtmicon-thin.json',
            'native'        => true,
        );
        return array_merge($font, $font_new);
    }

    public static function enqueue_frontend()
    {
        wp_enqueue_style('elementor-icons-rtmicon', \RomeTheme::plugin_url() . 'assets/css/rtmicons.css', '', \RomeTheme::rt_version());
        wp_enqueue_style('rkit-widget-style', \RomeTheme::plugin_url() . 'assets/css/rkit.css', '', \RomeTheme::rt_version());
    }

    public static function isProActive(){
        if (class_exists('RomethemePro')) {
            if(RomethemePro\RproLicense::get_subs_status() === 'active') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
