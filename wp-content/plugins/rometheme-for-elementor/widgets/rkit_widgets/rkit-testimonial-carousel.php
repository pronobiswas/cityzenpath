<?php

class Rkit_TestimonialCarousel extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-testimonial-carousel';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['testimonialcarousel']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon ' . \RomethemeKit\RkitWidgets::listWidgets()['testimonialcarousel']['icon'];
        return $icon;
    }
    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_keywords()
    {
        return ['accordion', 'rometheme'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-testimonial-carousel-widget/';
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', ['label' => 'Testimonial', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('layout_style', [
            'label' => esc_html('Layout Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'style_1' => esc_html('Layout Style 1'),
                'style_2' => esc_html('Layout Style 2'),
                'style_3' => esc_html('Layout Style 3'),
                'style_4' => esc_html('Layout Style 4'),
                'style_5' => esc_html('Layout Style 5'),
            ],
            'default' => 'style_2'
        ]);

        $this->add_control(
            'show_quote',
            [
                'label' => esc_html__('Show Quote Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label' => esc_html__('Quote Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-quote',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_quote' => 'yes'
                ]
            ]
        );

        $item = new \Elementor\Repeater();

        $item->add_control('author_name', [
            'label' => esc_html('Author'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html('Input Author Name Here')
        ]);

        $item->add_control('author_occupation', [
            'label' => esc_html('Author Occupation'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html('Input Author Occupation Here')
        ]);

        $item->add_control('testimonial_review', [
            'label' => esc_html('Testimonial Review'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'placeholder' => esc_html('Input Testimonial Review Here')
        ]);

        $item->add_control('testimonial_rating', [
            'label' => esc_html('Rating'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '1' => esc_html('1'),
                '2' => esc_html('2'),
                '3' => esc_html('3'),
                '4' => esc_html('4'),
                '5' => esc_html('5'),
            ],
            'default' => '5'
        ]);

        $item->add_control(
            'client_avatar',
            [
                'label' => esc_html__('Client Avatar', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $item->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .rkit-testimonial-card',
            ]
        );

        $this->add_control('testi_list', [
            'label' => esc_html('Testimonial'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $item->get_controls(),
            'default' => [
                [
                    'author_name' => esc_html('Author #1'),
                    'author_occupation' => esc_html('Designation'),
                    'testimonial_review' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida malesuada cursus. Vivamus iaculis tristique semper. '),
                    'testimonial_rating' => '5'
                ],
                [
                    'author_name' => esc_html('Author #2'),
                    'author_occupation' => esc_html('Designation'),
                    'testimonial_review' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida malesuada cursus. Vivamus iaculis tristique semper. '),
                    'testimonial_rating' => '5'
                ],
                [
                    'author_name' => esc_html('Author #3'),
                    'author_occupation' => esc_html('Designation'),
                    'testimonial_review' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida malesuada cursus. Vivamus iaculis tristique semper. '),
                    'testimonial_rating' => '5'
                ],
                [
                    'author_name' => esc_html('Author #4'),
                    'author_occupation' => esc_html('Designation'),
                    'testimonial_review' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida malesuada cursus. Vivamus iaculis tristique semper. '),
                    'testimonial_rating' => '5'
                ],
                [
                    'author_name' => esc_html('Author #5'),
                    'author_occupation' => esc_html('Designation'),
                    'testimonial_review' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida malesuada cursus. Vivamus iaculis tristique semper. '),
                    'testimonial_rating' => '5'
                ],
            ],
            'title_field' => '{{{ author_name }}}'
        ]);


        $this->end_controls_section();

        $this->start_controls_section('rating_settings' , [
            'label' => esc_html('Rating'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'show_rating',
            [
                'label' => esc_html__('Show Rating ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'custom_icon_rating',
            [
                'label' => esc_html__('Custom Rating Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'show_rating' => 'yes'
                ]
            ]
        );


        $this->add_control(
            'rating_icon',
            [
                'label' => esc_html__('Rating Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'custom_icon_rating' => 'yes'
                ]
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
                'label' => esc_html__('Show Navigation', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('no', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => esc_html__('Next Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-chevron-right',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_navigation' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'prev_icon',
            [
                'label' => esc_html__('Prev Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-chevron-left',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_navigation' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('setttings_section', ['label' => esc_html('Settings'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_responsive_control(
            'spacebetween',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_to_show',
            [
                'label' => esc_html__('Slide To Show', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1
            ]
        );

        $this->add_responsive_control(
            'slide_to_scroll',
            [
                'label' => esc_html__('Slide To Scroll', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'desktop_default' => 1,
                'tablet_default' => 1,
                'mobile_default' => 1
            ]
        );

        $this->add_control('speed', [
            'label' => esc_html('Speed'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 100,
            'max' => 5000,
            'step' => 100,
            'default' => 1000
        ]);

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => esc_html__('Show Dots', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('wrapper_style', [
            'label' => esc_html('Wrapper'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 1,
                    'bottom' => 0,
                    'left' => 1,
                    'unit' => 'em',
                    'isLinked' => false,
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'em',
                    'isLinked' => false,
                ],
                'mobile_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'em',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-carousel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_wrapper_style', ['label' => esc_html('Content Style'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style!' => 'style_5'
                ]
            ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'card_height',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem',],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-wrapper.style_5 .rkit-testimonial-card' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style' => 'style_5'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-testimonial-card',
            ]
        );

        $this->add_control(
            'card_bg_option',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'card_background',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .rkit-testimonial-card',
                'condition' => [
                    'layout_style!' => 'style_5'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'card_background_st_5',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .testimonial_body', 
                'condition' => [
                    'layout_style' => 'style_5'
                ],
                'description' => esc_html__('Use the slide below the color options to adjust the opacity', 'text-domain'),
              

            ]
        );

        

        $this->add_control(
            'card_border_option',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .rkit-testimonial-card',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('body_style', ['label' => esc_html('Body Style'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_responsive_control(
            'body_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-card .testimonial_body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'body_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-card .testimonial_body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'body_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-testimonial-card .testimonial_body',
            ]
        );

        $this->add_control(
            'body_background_option',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_body',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .rkit-testimonial-card .testimonial_body',
            ]
        );

        $this->add_control(
            'body_border_option',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_body',
                'selector' => '{{WRAPPER}} .rkit-testimonial-card .testimonial_body',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('description_style', [
            'label' => esc_html('Description'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'review_align',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial_description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'review_typography',
                'selector' => '{{WRAPPER}} .testimonial_description',
            ]
        );

        $this->add_control('review_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .testimonial_description' => 'color:{{VALUE}}'
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('author_style', [
            'label' => esc_html('Author'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'author_align',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-author' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .rkit-testimonial-wrapper.style_4 .testimonial_header' => 'justify-content:{{VALLUE}}'
                ],
            ]
        );

        $this->add_control(
            'author_name_option',
            [
                'label' => esc_html__('Author Name', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'selector' => '{{WRAPPER}} .testimonial-author strong',
            ]
        );

        $this->add_control('author_name_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .testimonial-author strong' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control(
            'author_occupation_option',
            [
                'label' => esc_html__('Author Occupation', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_occupation_typography',
                'selector' => '{{WRAPPER}} .testimonial-author span',
            ]
        );

        $this->add_control('author_occupation_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .testimonial-author span' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control(
            'author_avatar_option',
            [
                'label' => esc_html__('Author Avatar', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'avatar_width',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .testimonial-client-img img' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style!' => ['style_1', 'style_5'],
                ]
            ]
        );

        $this->add_responsive_control(
            'avatar_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-client-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style!' => ['style_1', 'style_5'],
                ]
            ]
        );

        $this->add_responsive_control(
            'avatar_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-client-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style!' => ['style_1', 'style_5'],
                ]
            ]
        );

        $this->add_responsive_control(
            'avatar_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-client-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style!' => 'style_5',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .testimonial-client-img img',
            ]
        );

        $this->add_control(
            'author_avatar_border_option',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_avatar',
                'selector' => '{{WRAPPER}} .testimonial-client-img img',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('quote_style', [
            'label' => esc_html('Quote Icon'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_quote' => 'yes',
                'layout_style!' => 'style_5'
            ]
        ]);

        $this->add_control(
            'quote_top-bottom_position',
            [
                'label' => esc_html__('Top Bottom Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial_quote_wrapper' => '{{VALUE}}:0;',
                ],
                'default' => 'bottom',
                'condition' => [
                    'layout_style' => 'style_1'
                ]
            ]
        );

        $this->add_control(
            'quote_left-right_position',
            [
                'label' => esc_html__('Top Bottom Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .testimonial_quote_wrapper' => '{{VALUE}}:0;',
                ],
                'condition' => [
                    'layout_style' => 'style_1'
                ]
            ]
        );

        $this->add_control(
            'quote_align',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial_quote_wrapper' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'layout_style!' => ['style_1', 'style_5']
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_quote_size',
            [
                'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
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
                    'size' => 40
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial_quote_icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_quote_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial_quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_quote_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial_quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_quote_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial_quote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('quote_color', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .testimonial_quote' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control(
            'quote_bg_options',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'quote_background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .testimonial_quote',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('rating_style', [
            'label' => esc_html('Rating'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_rating' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'rating_align',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-rating' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'layout_style!' => 'style_4'
                ]
            ]
        );

        $this->add_responsive_control(
            'rating_icon_size',
            [
                'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-rate_icon' => 'font-size: {{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_icon_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px',  'em', 'rem', 'custom'],
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
                    '{{WRAPPER}} .testimonial-rating' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('rating_color', [
            'label' => esc_html('Rated Color'),
            'type' =>  \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rated .rkit-testimonial-rate_icon' => 'color:{{VALUE}} ; fill : {{VALUE}}'
            ]
        ]);

        $this->add_control('unrating_color', [
            'label' => esc_html('Unrated Color'),
            'type' =>  \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .unrated .rkit-testimonial-rate_icon' => 'color:{{VALUE}} ; fill : {{VALUE}}'
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('dots_style',  [
            'label' => esc_html('Dots'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_dots' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'dot_align',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-pagination' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('dot_tab');

        $this->start_controls_tab('dot_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control(
            'dot_width',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_height',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dot_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet',
            ]
        );

        $this->add_control(
            'dot_bg_options_normal',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_background_normal',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet',
            ]
        );

        $this->add_control(
            'dot_border_options_normal',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dot_border_normal',
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dot_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control(
            'dot_width_hover',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pagination-bullet:hover' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_height_hover',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pagination-bullet:hover' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dot_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet:hover',
            ]
        );

        $this->add_control(
            'dot_bg_options_hover',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_background_hover',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet:hover',
            ]
        );

        $this->add_control(
            'dot_border_options_hover',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dot_border_hover',
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dot_tab_active', ['label' => esc_html('Active')]);

        $this->add_control(
            'dot_width_active',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pagination-bullet.rkit-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_height_active',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pagination-bullet.rkit-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dot_box_shadow_active',
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet.rkit-pagination-bullet-active',
            ]
        );

        $this->add_control(
            'dot_bg_options_active',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'dot_background_active',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet.rkit-pagination-bullet-active',
            ]
        );

        $this->add_control(
            'dot_border_options_active',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dot_border_active',
                'selector' => '{{WRAPPER}} .rkit-pagination-bullet.rkit-pagination-bullet-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('arrow_style', [
            'label' => esc_html('Arrow'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_navigation' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'nav_icon_size',
            [
                'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-navigation' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'nav_margin_next',
            [
                'label' => esc_html__('Margin Next Button', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-next-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_margin_prev',
            [
                'label' => esc_html__('Margin Previous Button', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-prev-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-testimonial-navigation' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('nav_tabs');

        $this->start_controls_tab('nav_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('nav_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-testimonial-navigation .navigation-icon' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-testimonial-navigation',
            ]
        );

        $this->add_control(
            'nav_bg_options_normal',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'nav_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-testimonial-navigation',
            ]
        );

        $this->add_control(
            'nav_border_options_normal',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_border_normal',
                'selector' => '{{WRAPPER}} .rkit-testimonial-navigation',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('nav_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('nav_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-testimonial-navigation:hover .navigation-icon' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-testimonial-navigation:hover',
            ]
        );

        $this->add_control(
            'nav_bg_options_hover',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'nav_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-testimonial-navigation:hover',
            ]
        );

        $this->add_control(
            'nav_border_options_hover',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_border_hover',
                'selector' => '{{WRAPPER}} .rkit-testimonial-navigation:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $config = [
            'rtl'                => is_rtl(),
            'arrows'            => ($settings['show_navigation'] === 'yes') ? true : false,
            'dots'                => ($settings['show_dots'] === 'yes') ? true : false,
            'pauseOnHover'        => ($settings['pause_on_hover'] === 'yes') ? true : false,
            'autoplay'            => ($settings['autoplay'] === 'yes') ? true : false,
            'speed'                => $settings['speed'],
            'slidesPerGroup'    => !empty($settings['slide_to_scroll']) ? (int) $settings['slide_to_scroll'] : 1,
            'slidesPerView'        => !empty((int) $settings['slide_to_show']) ? (int) $settings['slide_to_show'] : 1,
            'loop'                => ($settings['loop'] === 'yes') ? true : false,
            'breakpoints'        => [
                320 => [
                    'slidesPerView'      => !empty($settings['slide_to_show_mobile']) ? $settings['slide_to_show_mobile'] : 1,
                    'slidesPerGroup'     => !empty($settings['slide_to_scroll_mobile']) ? $settings['slide_to_scroll_mobile'] : 1,
                    'spaceBetween'       => !empty($settings['spacebetween_mobile']['size']) ? $settings['spacebetween_mobile']['size']  : 10,
                ],
                768 => [
                    'slidesPerView'      => !empty($settings['slide_to_show_tablet']) ? $settings['slide_to_show_tablet'] : 2,
                    'slidesPerGroup'     => !empty($settings['slide_to_scroll_tablet']) ? $settings['slide_to_scroll_tablet'] : 1,
                    'spaceBetween'       => !empty($settings['spacebetween_tablet']['size']) ? $settings['spacebetween_tablet']['size'] : 10,
                ],
                1024 => [
                    'slidesPerView'      => !empty($settings['slide_to_show']) ? $settings['slide_to_show'] : 3,
                    'slidesPerGroup'     => !empty($settings['slide_to_scroll']) ? $settings['slide_to_scroll'] : 1,
                    'spaceBetween'        => !empty($settings['spacebetween']['size']) ? $settings['spacebetween']['size'] : 15,
                ]
            ],
        ];
?>
        <div class="rkit-testimonial-carousel" data-config="<?php echo esc_attr(json_encode($config)) ?>">
            <div class="testimonial-container">
                <?php if ($settings['show_navigation'] === 'yes') : ?>
                    <div class="testimonial-prev-wrapper">
                        <div class="rkit-testimonial-navigation rkit-testimonial-button-prev">
                            <?php \Elementor\Icons_Manager::render_icon($settings['prev_icon'], ['aria-hidden' => 'true', 'class' => 'navigation-icon']); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="swiper-wrapper rkit-testimonial-wrapper <?php echo esc_attr($settings['layout_style']) ?>">
                    <?php foreach ($settings['testi_list'] as $list) : ?>
                        <?php switch ($settings['layout_style']) {
                            case 'style_1': ?>
                                <div class="swiper-slide rkit-testimonial-card">
                                    <div class="testimonial_header">
                                        <div class="testimonial-client-img">
                                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($list, 'thumbnail', 'client_avatar'); ?>
                                        </div>
                                        <?php if ($settings['show_quote'] === 'yes') : ?>
                                            <div class="testimonial_quote_wrapper">
                                                <div class="testimonial_quote">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true', 'class' => 'testimonial_quote_icon']); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="testimonial_body">
                                        <div class="testimonial_description">
                                            <span><?php echo esc_html($list['testimonial_review']) ?></span>
                                        </div>
                                        <div class="testimonial-author">
                                            <strong><?php echo esc_html($list['author_name']) ?></strong>
                                            <span><?php echo esc_html($list['author_occupation']) ?></span>
                                        </div>
                                        <?php if ($settings['show_rating'] === 'yes') : ?>
                                            <div class="testimonial-rating">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <a class="<?php echo ($i <= $list['testimonial_rating']) ? 'rated' : 'unrated' ?>">
                                                        <?php
                                                        if ($settings['custom_icon_rating'] === 'yes') :
                                                            \Elementor\Icons_Manager::render_icon($settings['rating_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        else :
                                                            $icon = [
                                                                'value' => 'fas fa-star',
                                                                'library' => 'fa-solid',
                                                            ];
                                                            \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        endif;
                                                        ?>
                                                    </a>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php break;
                            case 'style_2': ?>
                                <div class="swiper-slide rkit-testimonial-card">
                                    <div class="testimonial_body">
                                        <?php if ($settings['show_quote'] === 'yes') : ?>
                                            <div class="testimonial_quote_wrapper">
                                                <div class="testimonial_quote">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true', 'class' => 'testimonial_quote_icon']); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="testimonial_description">
                                            <span><?php echo esc_html($list['testimonial_review']) ?></span>
                                        </div>
                                    </div>
                                    <div class="testimonial_header">
                                        <div class="testimonial-client-img">
                                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($list, 'thumbnail', 'client_avatar'); ?>
                                        </div>
                                        <div class="testimonial-author">
                                            <strong><?php echo esc_html($list['author_name']) ?></strong>
                                            <span><?php echo esc_html($list['author_occupation']) ?></span>
                                        </div>
                                        <?php if ($settings['show_rating'] === 'yes') : ?>
                                            <div class="testimonial-rating">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <a class="<?php echo ($i <= $list['testimonial_rating']) ? 'rated' : 'unrated' ?>">
                                                        <?php
                                                        if ($settings['custom_icon_rating'] === 'yes') :
                                                            \Elementor\Icons_Manager::render_icon($settings['rating_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        else :
                                                            $icon = [
                                                                'value' => 'fas fa-star',
                                                                'library' => 'fa-solid',
                                                            ];
                                                            \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        endif;
                                                        ?>
                                                    </a>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php break;
                            case 'style_3': ?>
                                <div class="swiper-slide rkit-testimonial-card">
                                    <div class="testimonial_header">
                                        <div class="testimonial-client-img">
                                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($list, 'thumbnail', 'client_avatar'); ?>
                                        </div>
                                    </div>
                                    <div class="testimonial_body">
                                        <?php if ($settings['show_quote'] === 'yes') : ?>
                                            <div class="testimonial_quote_wrapper">
                                                <div class="testimonial_quote">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true', 'class' => 'testimonial_quote_icon']); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="testimonial_description">
                                            <span><?php echo esc_html($list['testimonial_review']) ?></span>
                                        </div>
                                        <div class="testimonial-author">
                                            <strong><?php echo esc_html($list['author_name']) ?></strong>
                                            <span><?php echo esc_html($list['author_occupation']) ?></span>
                                        </div>
                                        <?php if ($settings['show_rating'] === 'yes') : ?>
                                            <div class="testimonial-rating">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <a class="<?php echo ($i <= $list['testimonial_rating']) ? 'rated' : 'unrated' ?>">
                                                        <?php
                                                        if ($settings['custom_icon_rating'] === 'yes') :
                                                            \Elementor\Icons_Manager::render_icon($settings['rating_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        else :
                                                            $icon = [
                                                                'value' => 'fas fa-star',
                                                                'library' => 'fa-solid',
                                                            ];
                                                            \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        endif;
                                                        ?>
                                                    </a>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php break;
                            case 'style_4': ?>
                                <div class="swiper-slide rkit-testimonial-card">
                                    <div class="testimonial_body">
                                        <?php if ($settings['show_quote'] === 'yes') : ?>
                                            <div class="testimonial_quote_wrapper">
                                                <div class="testimonial_quote">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true', 'class' => 'testimonial_quote_icon']); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="testimonial_description">
                                            <span><?php echo esc_html($list['testimonial_review']) ?></span>
                                        </div>
                                    </div>
                                    <div class="testimonial_header">
                                        <div class="testimonial-client-img">
                                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($list, 'thumbnail', 'client_avatar'); ?>
                                        </div>
                                        <div class="testimonial-author">
                                            <strong><?php echo esc_html($list['author_name']) ?></strong>
                                            <span><?php echo esc_html($list['author_occupation']) ?></span>
                                            <?php if ($settings['show_rating'] === 'yes') : ?>
                                                <div class="testimonial-rating">
                                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                        <a class="<?php echo ($i <= $list['testimonial_rating']) ? 'rated' : 'unrated' ?>">
                                                            <?php
                                                            if ($settings['custom_icon_rating'] === 'yes') :
                                                                \Elementor\Icons_Manager::render_icon($settings['rating_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                            else :
                                                                $icon = [
                                                                    'value' => 'fas fa-star',
                                                                    'library' => 'fa-solid',
                                                                ];
                                                                \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                            endif;
                                                            ?>
                                                        </a>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php break;
                            case 'style_5': ?>
                                <div class="swiper-slide rkit-testimonial-card">
                                    <div class="testimonial_header">
                                        <div class="testimonial-client-img">
                                            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($list, 'thumbnail', 'client_avatar'); ?>
                                        </div>
                                    </div>
                                    <div class="testimonial_body">
                                        <?php if ($settings['show_rating'] === 'yes') : ?>
                                            <div class="testimonial-rating">
                                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                    <a class="<?php echo ($i <= $list['testimonial_rating']) ? 'rated' : 'unrated' ?>">
                                                        <?php
                                                        if ($settings['custom_icon_rating'] === 'yes') :
                                                            \Elementor\Icons_Manager::render_icon($settings['rating_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        else :
                                                            $icon = [
                                                                'value' => 'fas fa-star',
                                                                'library' => 'fa-solid',
                                                            ];
                                                            \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true', 'class' => 'rkit-testimonial-rate_icon']);
                                                        endif;
                                                        ?>
                                                    </a>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="testimonial_description">
                                            <span><?php echo esc_html($list['testimonial_review']) ?></span>
                                        </div>
                                        <div class="testimonial-author">
                                            <strong><?php echo esc_html($list['author_name']) ?></strong>
                                            <span><?php echo esc_html($list['author_occupation']) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php break; ?>
                        <?php
                        } ?>
                    <?php endforeach; ?>
                </div>
                <?php if ($settings['show_navigation'] === 'yes') : ?>
                    <div class="testimonial-next-wrapper">
                        <div class="rkit-testimonial-navigation rkit-testimonial-button-next">
                            <?php \Elementor\Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true', 'class' => 'navigation-icon']); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- Add pagination -->
                <?php if ($settings['show_dots'] === 'yes') : ?>
                    <div class="rkit-testimonial-pagination"></div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }
}
