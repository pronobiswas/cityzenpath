<?php
class Rkit_home_slider extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-home-slider';
    }

    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['home_slider']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon ' . \RomethemeKit\RkitWidgets::listWidgets()['home_slider']['icon'];
        return $icon;
    }


    public function get_keywords()
    {
        return ['rometheme', 'slider', 'home_slider'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/';
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_style_depends()
    {
        return ['rkit-home-slider-style'];
    }

    public function get_script_depends()
    {
        return ['rkit-home-slider-script'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'slide_style',
            [
                'label' => esc_html__('Slide Style', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Slide', 'textdomain'),
                    'fade' => esc_html__('Fade', 'textdomain'),
                ],
                'default' => '',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
            ]
        );

        $home_slider_list = new \Elementor\Repeater();

        $home_slider_list->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $home_slider_list->add_control(
            'home_slider_sub_title',
            [
                'label' => esc_html__('Sub Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Your Sub Title', 'textdomain'),
            ]
        );

        // icon subtitle
        $home_slider_list->add_control(
            'show_subtitle_icon',
            [
                'label' => esc_html__('Show Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $home_slider_list->add_control(
            'subtitle_icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'rtmicon rtmicon-badge-check',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_subtitle_icon' => 'yes',
                ]
            ]
        );




        $home_slider_list->add_control(
            'home_slider_title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Your Title', 'textdomain'),
            ]
        );

        $home_slider_list->add_control(
            'home_slider_description',
            [
                'label' => esc_html__('Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Description For Your Home Slider.', 'textdomain'),
            ]
        );


        $home_slider_list->add_control(
            'hs_link',
            [
                'label' => esc_html__('Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'hs_list',
            [
                'label' => esc_html__('Repeater List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $home_slider_list->get_controls(),
                'default' => [
                    [
                        'home_slider_title' => esc_html__('Slide Title #1', 'textdomain'),
                        'home_slider_description' => esc_html__('Your slide Description #1', 'textdomain'),
                        'hs_link' => [
                            'url' => "#"
                        ]

                    ],
                    [
                        'home_slider_title' => esc_html__('Slide Title #2', 'textdomain'),
                        'home_slider_description' => esc_html__('Your slide Description #2', 'textdomain'),
                        'hs_link' => [
                            'url' => "#"
                        ]
                    ],
                    [
                        'home_slider_title' => esc_html__('Slide Title #3', 'textdomain'),
                        'home_slider_description' => esc_html__('Your slide Description #3', 'textdomain'),
                        'hs_link' => [
                            'url' => "#"
                        ]
                    ],
                    [
                        'home_slider_title' => esc_html__('Slide Title #4', 'textdomain'),
                        'home_slider_description' => esc_html__('Your slide Description #4', 'textdomain'),
                        'hs_link' => [
                            'url' => "#"
                        ]
                    ],
                ],
                'title_field' => '{{{home_slider_title}}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('navigation_settings', [
            'label' => esc_html('Navigation'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'show_navigation',
            [
                'label' => esc_html__('Show Navigation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => esc_html__('Next Icon', 'textdomain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-chevron-right',
                    'library' => 'rtmicon',
                ],
                'condition' => [
                    'show_navigation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'previous_icon',
            [
                'label' => esc_html__('Previous Icon', 'textdomain'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-chevron-left',
                    'library' => 'rtmicon',
                ],
                'condition' => [
                    'show_navigation' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_button_new', [
            'label' => esc_html__('Button'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show Button', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        //divider control
        $this->add_control(
            'more_options',
            [
                'label' => esc_html__('Button', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_button_icon',
            [
                'label' => esc_html__('Show Button Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Button Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'rtmicon rtmicon-arrow-long-right',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_button_icon' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label' => esc_html__('Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'before' => [
                        'title' => esc_html__('Before Text', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-start',
                    ],
                    'after' => [
                        'title' => esc_html__('After Text', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'default' => 'after',
                'toggle' => true,
                'condition' => [
                    'show_button_icon' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Buy Now', 'rometheme-for-elementor'),
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section('setting_section', [
            'label' => esc_html('Settings'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('speed', [
            'label' => esc_html('Speed'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 2000,
            'condition' => [
                'autoplay' => 'yes'
            ]
        ]);

        $this->add_control(
            'show_dots',
            [
                'label' => esc_html__('Show Dots', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

        // style section ================================================================================================

        //container style
        $this->start_controls_section('Container_style_section', [
            'label' => esc_html__('Container', 'textdomain'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control(
            'Header_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .container-image-hsl' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => __('Container Box Shadow', 'plugin-name'),
                'selector' => '{{WRAPPER}} .rkit-hs-client ',
                'description' => esc_html__('Give the container padding to see the results', 'text-domain'),
            ]
        );

        $this->add_control(
            'background_container',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_container_all',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .container-image-hsl',
            ]
        );

        $this->end_controls_section();

        //image style
        $this->start_controls_section('image_style', [
            'label' => esc_html('Image'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__('Border  ', 'textdomain'),
                'selector' => '{{WRAPPER}} .image-container-hsl , {{WRAPPER}} .image-cover-hsl'

            ]
        );


        $this->add_responsive_control(
            'imagewidth',
            [
                'label' => esc_html__('Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['vw', 'px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-container-hsl' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'imageheight',
            [
                'label' => esc_html__('Height', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['vh', 'px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 90,
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-container-hsl' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}}  .image-container-hsl' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        //content style
        $this->start_controls_section('content_style_section', [
            'label' => esc_html__('Content', 'textdomdomain: ain'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control(
            'content_align_horizontal',
            [
                'label' => esc_html__('Horizontal Alignment', 'text-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'text-domain'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'text-domain'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'text-domain'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'start',
                'selectors' => [
                    '{{WRAPPER}} .hs-content' => 'align-items: {{VALUE}}; text-align : {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_align_vertical',
            [
                'label' => esc_html__('Vertical Alignment', 'text-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'text-domain'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'text-domain'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'text-domain'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .hs-content' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'gap',
            [
                'label' => esc_html__('Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hs-content' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],

                'selectors' => [
                    '{{WRAPPER}} .hs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_container_all_content',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hs-content-background',
            ]
        );

        $this->add_responsive_control(
            'backgroun_opacity',
            [
                'label' => esc_html__('Opacity', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hs-content-background' => 'opacity: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();



        // sub title style
        $this->start_controls_section(
            'style_section_subtitle',
            [
                'label' => esc_html__('Sub Title', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'subtitle_animation',
            [
                'label' => esc_html__('Animation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'hs-animation-1-subtitle',
                'options' => [
                    '' => esc_html__('Default', 'textdomain'),
                    'hs-animation-1-subtitle' => esc_html__('Word Staggered', 'textdomain'),
                    // 'hs-animation-2-subtitle' => esc_html__( 'TypeWriter', 'textdomain' ), 
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__('Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .hs-sub-title',
            ]
        );

        $this->add_control(
            'subtitle_color_external',
            [
                'label' => esc_html__('Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hs-sub-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'subtitle_stroke_normal',
                'selector' => '{{WRAPPER}} .hs-subtitle-section ',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subtitle_shadow_normal',
                'selector' => '{{WRAPPER}} .hs-subtitle-section ',
            ]
        );

        $this->add_control(
            'subtitle_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],

                'selectors' => [
                    '{{WRAPPER}} .hs-subtitle-section ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],

                'selectors' => [
                    '{{WRAPPER}} .hs-subtitle-section ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'subtitle_borderwidth',
                'label' => esc_html__('Border', 'textdomain'),
                'selector' => '{{WRAPPER}} .hs-subtitle-section ',

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'subtitle_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .hs-subtitle-section ',
            ]
        );

        $this->add_responsive_control(
            'subtitle_icon_position',
            [
                'label' => esc_html__('icon Position', 'text-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row-reverse' => [
                        'title' => esc_html__('Before Text', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-start',
                    ],
                    'row' => [
                        'title' => esc_html__('After Text', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hs-subtitle-section' => 'flex-direction: {{VALUE}};',
                ],
                'default' => 'row',
            ]
        );
        $this->add_responsive_control(
            'gap_subtitle_icon',
            [
                'label' => esc_html__('Icon Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hs-subtitle-section ' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('subtitle_icon_color', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#FFFFFFFF',
            'selectors' => [
                '{{WRAPPER}} .icon-subtitle-hs' => 'color : {{VALUE}}'
            ]
        ]);


        $this->add_responsive_control(
            'subtitle_hs_icon_size',
            [
                'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 2,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .icon-subtitle-hs ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // title style
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Title', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_animation',
            [
                'label' => esc_html__('Animation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'textdomain'),
                    'hs-animation-1-title' => esc_html__('Word Staggered', 'textdomain'),
                    // 'hs-animation-2-title' => esc_html__( 'TypeWriter', 'textdomain' ), 
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .hs-title',
            ]
        );

        $this->add_control(
            'title_color_external',
            [
                'label' => esc_html__('Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hs-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'title_stroke_normal',
                'selector' => '{{WRAPPER}} .hs-title ',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow_normal',
                'selector' => '{{WRAPPER}} .hs-title',
            ]
        );

        $this->add_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],

                'selectors' => [
                    '{{WRAPPER}} .hs-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'maxwidthtitle',
            [
                'label' => esc_html__('Max Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'desktop_default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'tablet_default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'mobile_default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hs-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // description style
        $this->start_controls_section(
            'style_section_desc',
            [
                'label' => esc_html__('Description', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_animation',
            [
                'label' => esc_html__('Animation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('Default', 'textdomain'),
                    'hs-animation-1-desc' => esc_html__('Word Staggered', 'textdomain'),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .hs-description',
            ]
        );

        $this->add_control(
            'desc_color_external',
            [
                'label' => esc_html__('Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hs-description' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'description_stroke_normal',
                'selector' => '{{WRAPPER}} .hs-description ',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'description_shadow_normal',
                'selector' => '{{WRAPPER}} .hs-description',
            ]
        );



        $this->add_responsive_control(
            'maxwidthdesc',
            [
                'label' => esc_html__('Max Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'desktop_default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'tablet_default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'mobile_default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hs-description' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],

                'selectors' => [
                    '{{WRAPPER}} .hs-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Style Section for Button
        $this->start_controls_section('button_style_section', [
            'label' => esc_html__('Button', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_button' => 'yes',
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-homeslider-item-button, {{WRAPPER}}.rkit-button-element-homeslider',
            ]
        );



        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-item-button .button-element-homeslider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-item-button .button-element-homeslider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-item-button, {{WRAPPER}} .rkit-button-element-homeslider' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'gap_button_icon',
            [
                'label' => esc_html__('Icon Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .button-element-homeslider' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        // /wkwkwkw
        $this->start_controls_tabs('button_tab');

        $this->start_controls_tab('button_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border Button', 'textdomain'),
                'selector' => '  {{WRAPPER}} .rkit-homeslider-item-button .button-element-homeslider',
            ]
        );

        $this->add_control('button_text_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .button-element-homeslider,  {{WRAPPER}} a' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .icon-list-button-hs' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-button-element-homeslider, {{WRAPPER}} a',
            ]
        );

        $this->add_control(
            'btn_bg_options_normal',
            [
                'label' => esc_html__('Button Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-button-element-homeslider, {{WRAPPER}} a',
                'default' => '#00cea6',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border_hover',
                'label' => esc_html__('Border Button (Hover)', 'textdomain'),
                'selector' => '{{WRAPPER}} .rkit-homeslider-item-button .button-element-homeslider:hover',
            ]
        );

        $this->add_control('button_text_color_hover', [
            'label' => esc_html__('Text Color (Hover)', 'textdomain'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .button-element-homeslider:hover,  {{WRAPPER}} a:hover' => 'color : {{VALUE}}'
            ],
        ]);

        $this->add_control('button_icon_color_hover', [
            'label' => esc_html__('Icon Color (Hover)', 'textdomain'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                ' {{WRAPPER}} a:hover .icon-list-button-hs' => 'color : {{VALUE}}'
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-button-element-homeslider:hover, {{WRAPPER}} a:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-button-element-homeslider:hover, {{WRAPPER}} a:hover',
            ]
        );



        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        //dot style
        $this->start_controls_section('dot_style', [
            'label' => esc_html('Dot'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_dots' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'dot_position_vertical',
            [
                'label' => esc_html__('Vertical Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'desktop_default' => [
                        'unit' => '%',
                        'size' => 95,
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                        'size' => 95,
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                        'size' => 92,
                    ],
                ],

                'selectors' => [
                    '{{WRAPPER}} .swiper-bullet-cont' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_position_horizontal',
            [
                'label' => esc_html__('Horizontal Position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'desktop_default' => [
                        'unit' => '%',
                        'size' => 48,
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                        'size' => 44,
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                        'size' => 37,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-bullet-cont' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_spacing',
            [
                'label' => esc_html__('Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_margin',
            [
                'label' => esc_html__('Dot Wrapper Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('dot_tabs');

        $this->start_controls_tab('dot_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_responsive_control(
            'dot_size_normal',
            [
                'label' => esc_html__('Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'dot_bg_options_normal',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet',
            ]
        );

        $this->add_control(
            'dot_border_options_normal',
            [
                'label' => esc_html__('Border', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dot_border_normal',
                'selector' => '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dot_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_responsive_control(
            'dot_size_hover',
            [
                'label' => esc_html__('Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet:hover' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->add_control(
            'dot_bg_options_hover',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet:hover',
            ]
        );

        $this->add_control(
            'dot_border_options_hover',
            [
                'label' => esc_html__('Border', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dot_border_hover',
                'selector' => '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dot_tab_active', ['label' => esc_html('active')]);

        $this->add_responsive_control(
            'dot_size_active',
            [
                'label' => esc_html__('Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet.rkit-homeslider-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->add_control(
            'dot_bg_options_active',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_background_active',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet.rkit-homeslider-bullet-active',
            ]
        );

        $this->add_control(
            'dot_border_options_active',
            [
                'label' => esc_html__('Border', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dot_border_active',
                'selector' => '{{WRAPPER}} .rkit-homeslider-pagination .rkit-homeslider-bullet.rkit-homeslider-bullet-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // style navigation
        $this->start_controls_section('navigation_style', [
            'label' => esc_html('Navigation'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);


        $this->add_responsive_control(
            'navigation_align_horizontal',
            [
                'label' => esc_html__('Horizontal Alignment', 'text-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'text-domain'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'text-domain'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'text-domain'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .swiper-nav-cont' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_align_vertical',
            [
                'label' => esc_html__('Vertical Alignment', 'text-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'text-domain'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'text-domain'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'text-domain'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'flex-end',
                'selectors' => [
                    '{{WRAPPER}} .swiper-nav-cont' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_navigation_spacing',
            [
                'label' => esc_html__('Manual adjustments Navigation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->add_responsive_control(
            'nav_spacing',
            [
                'label' => esc_html__('Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2080,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-nav-cont' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_navigation_spacing' => 'yes',
                ]
            ]
        );


        $this->add_responsive_control(
            'nav_icon_size',
            [
                'label' => esc_html__('Icon Size', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-swiper-hs-button-next , {{WRAPPER}} .rkit-swiper-hs-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-swiper-hs-button-prev , {{WRAPPER}} .rkit-swiper-hs-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-swiper-hs-button-prev , {{WRAPPER}} .rkit-swiper-hs-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('nav_tabs');

        $this->start_controls_tab('nav_tab_normal', [
            'label' => esc_html('Normal')
        ]);

        $this->add_control('icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-swiper-hs-button-prev , {{WRAPPER}} .rkit-swiper-hs-button-next' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-swiper-hs-button-prev , {{WRAPPER}} .rkit-swiper-hs-button-next',
            ]
        );

        $this->add_control(
            'nav_bg_options_normal',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'nav_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-swiper-hs-button-prev , {{WRAPPER}} .rkit-swiper-hs-button-next',
            ]
        );

        $this->add_control(
            'nav_border_options_normal',
            [
                'label' => esc_html__('Border', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_border_normal',
                'selector' => '{{WRAPPER}} .rkit-swiper-hs-button-prev , {{WRAPPER}} .rkit-swiper-hs-button-next',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('nav_tab_hover', [
            'label' => esc_html('Hover')
        ]);

        $this->add_control('icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-swiper-hs-button-prev:hover , {{WRAPPER}} .rkit-swiper-hs-button-next:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-swiper-hs-button-prev:hover , {{WRAPPER}} .rkit-swiper-hs-button-next:hover',
            ]
        );

        $this->add_control(
            'nav_bg_options_hover',
            [
                'label' => esc_html__('Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'nav_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-swiper-hs-button-prev:hover , {{WRAPPER}} .rkit-swiper-hs-button-next:hover',
            ]
        );

        $this->add_control(
            'nav_border_options_hover',
            [
                'label' => esc_html__('Border', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_border_hover',
                'selector' => '{{WRAPPER}} .rkit-swiper-hs-button-prev:hover , {{WRAPPER}} .rkit-swiper-hs-button-next:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $pauseOnHover = ($settings['pause_on_hover'] === 'yes') ? true : false;


        $config = [
            'rtl'                => is_rtl(),
            'arrows'            => ($settings['show_navigation'] === 'yes') ? true : false,
            'dots'                => ($settings['show_dots'] === 'yes') ? true : false,
            'autoplay'            => ($settings['autoplay'] === 'yes') ? [
                'pauseOnMouseEnter' => $pauseOnHover,
            ] : false,
            'speed'                => $settings['speed'],
            'slidesPerGroup'    =>   1,
            'slidesPerView'        =>   1,
            'loop'                => ($settings['loop'] === 'yes') ? true : false,
            'slideStyle' => $settings['slide_style']
        ];


?>
        <div class="rkit-homeslider-slider" data-config="<?php echo esc_attr(json_encode($config)) ?>">
            <!-- Slider main container -->
            <div class="rkit-swiper-hs">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php

                    foreach ($settings['hs_list'] as $li) :
                        if (!empty($li['hs_link']['url'])) {
                            $this->add_link_attributes('hs_link_' . $li['_id'], $li['hs_link']);
                        }
                    ?>
                        <div class="swiper-slide container-image-hsl">
                            <div class="rkit-hs-client ">
                                <div class="image-container-hsl">
                                    <?php
                                    $image_html_url = \Elementor\Group_Control_Image_Size::get_attachment_image_html($li, 'thumbnail', 'image');
                                    $image_html_url = str_replace('<img ', '<img class="image-cover-hsl" ', $image_html_url);
                                    echo $image_html_url;
                                    ?>
                                    <div class="hs-content">
                                        <div class="hs-content-background"></div>
                                        <div class="hs-subtitle-section ">
                                            <span class="hs-sub-title hs-mw <?php echo esc_attr($settings['subtitle_animation']); ?>">
                                                <?php echo esc_html($li['home_slider_sub_title']);   ?> </span>
                                            <span class="icon-subtitle-hs"> <?php \Elementor\Icons_Manager::render_icon($li['subtitle_icon'], ['aria-hidden' => 'true', 'class' => "icon-subtitle-hs"]); ?> </span>
                                        </div>
                                        <span class="hs-title hs-mw <?php echo $settings['title_animation'] ?>"><?php echo esc_html($li['home_slider_title']); ?></span>
                                        <span class="hs-description hs-mw <?php echo $settings['description_animation'] ?> "><?php echo esc_html($li['home_slider_description']); ?></span>
                                        <?php if (($settings['show_button']) == 'yes') {  ?>
                                            <div class="rkit-homeslider-item-button">
                                                <?php if ($settings['button_icon_position'] == "before") { ?>
                                                    <a <?php $this->print_render_attribute_string('hs_link_' . $li['_id']) ?> class="button-element-homeslider">
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-list-button-hs"]); ?>
                                                        <?php echo esc_html($settings['button_text']) ?>
                                                    </a>
                                                <?php } else {
                                                ?>
                                                    <a <?php $this->print_render_attribute_string('hs_link_' . $li['_id']) ?> class="button-element-homeslider">
                                                        <?php echo esc_html($settings['button_text']) ?>
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-list-button-hs"]); ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        <?php

                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
                <div class="swiper-bullet-cont">
                    <div class="rkit-homeslider-pagination"></div>
                </div>
            </div>
            <?php if ($settings['show_navigation'] === 'yes') : ?>
                <div class="swiper-nav-cont">
                    <div class="rkit-swiper-hs-button-prev"><?php \Elementor\Icons_Manager::render_icon($settings['previous_icon'], ['aria-hidden' => 'true']); ?></div>
                    <div class="rkit-swiper-hs-button-next"><?php \Elementor\Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true']); ?></div>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}

?>