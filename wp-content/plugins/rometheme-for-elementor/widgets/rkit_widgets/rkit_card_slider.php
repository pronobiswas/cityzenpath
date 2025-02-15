<?php

class Rkit_CardSlider extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-card-slider';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['cardslider']['name'];
    }
    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['cardslider']['icon'];
        return $icon;
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_keywords()
    {
        return ['card', 'slider', 'carousel', 'rometheme'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-card-slider-widget/';
    }

    public function get_style_depends()
    {
        return ['rkit-card_slider-style', 'rkit-swiper'];
    }

    public function get_script_depends()
    {
        return ['card-slider-script'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('select_style', [
            'label' => esc_html('Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'default' => esc_html('Default'),
                'rkit-cc-overlay' => esc_html('Overlay')
            ],
            'default' => 'default'
        ]);

        $this->add_control('title_tag', [
            'label' => esc_html('Title Tag'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'h1' => esc_html('H1'),
                'h2' => esc_html('H2'),
                'h3' => esc_html('H3'),
                'h4' => esc_html('H4'),
                'h5' => esc_html('H5'),
                'h6' => esc_html('H6'),
                'span' => esc_html('SPAN')
            ],
            'default' => 'h4'
        ]);

        $this->add_control('subheading_position', [
            'label' => esc_html('Sub Heading Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'top' => esc_html('Before Title'),
                'bottom' => esc_html('After Title')
            ],
            'default' => 'bottom'
        ]);

        $card_list = new \Elementor\Repeater();

        $card_list->add_control(
            'initial_slide',
            [
                'label' => esc_html__('Initial Slide ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
            ]
        );

        $card_list->add_control(
            'card_title',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your title here', 'rometheme-for-elementor'),
            ] 
        );

        $card_list->add_control(
            'card_sub_title',
            [
                'label' => esc_html__('Sub Heading', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your title here', 'rometheme-for-elementor'),
            ]
        );

        $card_list->add_control(
            'card_description',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => esc_html__('Type your description here', 'rometheme-for-elementor'),
            ]
        );

        $card_list->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $card_list->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);


        $card_list->add_control(
            'card_link',
            [
                'label' => esc_html__('Link', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Repeater List', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $card_list->get_controls(),
                'default' => [
                    [
                        'card_title' => esc_html__('Title #1', 'rometheme-for-elementor'),
                        'card_sub_title' => esc_html('Sub Heading'),
                        'card_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'rometheme-for-elementor'),
                        'card_link' => [
                            'url' => "#"
                        ]
                    ],
                    [
                        'card_title' => esc_html__('Title #2', 'rometheme-for-elementor'),
                        'card_sub_title' => esc_html('Sub Heading'),
                        'card_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'rometheme-for-elementor'),
                        'card_link' => [
                            'url' => "#"
                        ]
                    ],
                    [
                        'card_title' => esc_html__('Title #3', 'rometheme-for-elementor'),
                        'card_sub_title' => esc_html('Sub Heading'),
                        'card_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'rometheme-for-elementor'),
                        'card_link' => [
                            'url' => "#"
                        ]
                    ],
                    [
                        'card_title' => esc_html__('Title #4', 'rometheme-for-elementor'),
                        'card_sub_title' => esc_html('Sub Heading'),
                        'card_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.', 'rometheme-for-elementor'),
                        'card_link' => [
                            'url' => "#"
                        ]
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('button_settings', [
            'label' => esc_html('Button'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show Button ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('button_text', [
            'label' => esc_html('Text'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html('Type Your Text Here'),
            'default' => esc_html('Read More'),
            'condition' => [
                'show_button' => 'yes'
            ]
        ]);

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-arrow-right',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_button' => 'yes'
                ]
            ]
        );

        $this->add_control('icon_position', [
            'label' => esc_html('Icon Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'row-reverse' => esc_html('Before Text'),
                'row' => esc_html('After Text')
            ],
            'default' => 'row',
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-button a' => 'flex-direction: {{VALUE}}'
            ],
            'condition' => [
                'show_button' => 'yes'
            ]
        ]);

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
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => esc_html__('Next Icon', 'rometheme-for-elementor'),
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
                'label' => esc_html__('Previous Icon', 'rometheme-for-elementor'),
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

        $this->start_controls_section('setting_section', [
            'label' => esc_html('Settings'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_responsive_control(
            'spacebetween',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30
                ]
            ]
        );

        $this->add_responsive_control('slide_to_show', [
            'label' => esc_html('Slide To Show'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 1,
            'default' => 3
        ]);

        $this->add_responsive_control('slide_to_scroll', [
            'label' => esc_html('Slide To Scroll'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 1,
            'default' => 1
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

        $this->add_control('speed', [
            'label' => esc_html('Speed'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 0,
            'default' => 1000,
            'condition' => [
                'autoplay' => 'yes'
            ]
        ]);

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

        $this->add_control('dots_position', [
            'label' => esc_html('Dots Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'top' => esc_html('Top'),
                'bottom' => esc_html('Bottom')
            ],
            'default' => 'bottom',
            'condition' => [
                'show_dots' => 'yes'
            ]
        ]);

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
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('card_style', [
            'label' => esc_html('Card'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-card',
            ]
        );

        $this->add_control(
            'card_bg_options',
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
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-card',
            ]
        );

        $this->add_control(
            'card_border_options',
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
                'selector' => '{{WRAPPER}} .rkit-card',
            ]
        );

        $this->add_control(
            'card_image_options',
            [
                'label' => esc_html__('Card Image', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'select_style' => 'default'
                ]
            ]
        );

        $this->add_control(
            'card_image_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card .card-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('card_image_ratio' , [
            'label' => esc_html('Image Ratio'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '1/1' => esc_html('1 / 1'),
                '3/2' => esc_html('3 / 2'),
                '5/4' => esc_html('5 / 4'),
                '16/9' => esc_html('16 / 9'),
                '2/3' => esc_html('2 / 3'),
                '4/5' => esc_html('4 / 5'),
                '9/16' => esc_html('9 / 16'),
            ],
            'default' => '3/2',
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-image img' => 'aspect-ratio : {{VALUE}}'
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('body_style', [
            'label' => esc_html('Body'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'card_body_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card .card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => 'default'
                ]
            ]
        );

        $this->add_responsive_control(
            'card_body_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card .card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'card_body_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-card .card-body::before',
            ]
        );

        $this->add_control(
            'card_body_opacity',
            [
                'label' => esc_html__('Opacity'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card .card-body::before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'card_title_options',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_text_align',
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
                    '{{WRAPPER}} .rkit-card .card-heading' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_title_typography',
                'selector' => '{{WRAPPER}} .rkit-card .card-title',
            ]
        );

        $this->add_responsive_control(
			'card_title_spacing',
			[
				'label' => esc_html__( 'Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem'],
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
					'{{WRAPPER}} .rkit-card .card-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs('card_title_tabs');

        $this->start_controls_tab('title_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('title_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-title a' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'title_stroke_normal',
                'selector' => '{{WRAPPER}} .rkit-card .card-title a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-card .card-title a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('title_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('title_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-title a:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'title_stroke_hover',
                'selector' => '{{WRAPPER}} .rkit-card .card-title a:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-card .card-title a:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'card_subtitle_options',
            [
                'label' => esc_html__('Sub Heading', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_subtitle_typography',
                'selector' => '{{WRAPPER}} .rkit-card .card-subheading',
            ]
        );

        $this->add_control('card_subtitle_color', [
            'label' => esc_html('Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-subheading' => 'color: {{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
			'card_subheading_spacing',
			[
				'label' => esc_html__( 'Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem'],
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
					'{{WRAPPER}} .rkit-card .card-subheading' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'card_description_options',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'descriptionn_text_align',
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
                        'title' => esc_html__('Justified', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-card .card-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .rkit-card .card-description',
            ]
        );

        $this->add_control('description_color', [
            'label' => esc_html('Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-description' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
			'card_description_spacing',
			[
				'label' => esc_html__( 'Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem'],
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
					'{{WRAPPER}} .rkit-card .card-description' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section('button_style', [
            'label' => esc_html('Button'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_button' => 'yes'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .rkit-card .card-button a',
            ]
        );

        $this->add_control('button_width_select', [
            'label' => esc_html('Button Width'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'auto' => esc_html('Auto'),
                'fullwidth' => esc_html('Full Width'),
                'custom' => esc_html('Custom')
            ]
        ]);

        $this->add_control(
            'button_width',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-card .card-button a' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_width_select' => 'custom'
                ]
            ]
        );


        $this->add_responsive_control(
            'button_align',
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
                    '{{WRAPPER}} .rkit-card .card-button' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'button_width_select!' => 'fullwidth'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card .card-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-card .card-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'card_button_spacing',
			[
				'label' => esc_html__( 'Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem'],
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
					'{{WRAPPER}} .rkit-card .card-button' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'card_button_icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem'],
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
					'{{WRAPPER}} .rkit-card .card-button a' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'card_button_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem'],
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
					'{{WRAPPER}} .rkit-card .card-button a .button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rkit-card .card-button a svg.button-icon' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->start_controls_tabs('button_tab');

        $this->start_controls_tab('button_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('button_text_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-button a' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-button a .button-icon' => 'color : {{VALUE}} ; fill : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-card .card-button a',
            ]
        );

        $this->add_control(
            'btn_bg_options_normal',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-card .card-button a',
            ]
        );

        $this->add_control(
            'btn_border_options_normal',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_normal',
                'selector' => '{{WRAPPER}} .rkit-card .card-button a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('button_text_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-button a:hover' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-card .card-button a:hover .button-icon' => 'color : {{VALUE}} ; fill: {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-card .card-button a:hover',
            ]
        );

        $this->add_control(
            'btn_bg_options_hover',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-card .card-button a:hover',
            ]
        );

        $this->add_control(
            'btn_border_options_hover',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border_hover',
                'selector' => '{{WRAPPER}} .rkit-card .card-button a:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('dot_style', [
            'label' => esc_html('Dot'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_dots' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'dot_alignment',
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
                    '{{WRAPPER}} .rkit-cardslider-pagination' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-cardslider-pagination' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_margin',
            [
                'label' => esc_html__('Dot Wrapper Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cardslider-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('dot_tabs');

        $this->start_controls_tab('dot_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_responsive_control(
            'dot_size_normal',
            [
                'label' => esc_html__('Size', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dot_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet',
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
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet',
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
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dot_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_responsive_control(
            'dot_size_hover',
            [
                'label' => esc_html__('Size', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet:hover' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dot_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet:hover',
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
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet:hover',
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
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('dot_tab_active', ['label' => esc_html('active')]);

        $this->add_responsive_control(
            'dot_size_active',
            [
                'label' => esc_html__('Size', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet.rkit-cardslider-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'dot_box_shadow_active',
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet.rkit-cardslider-bullet-active',
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
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet.rkit-cardslider-bullet-active',
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
                'selector' => '{{WRAPPER}} .rkit-cardslider-pagination .rkit-cardslider-bullet.rkit-cardslider-bullet-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('navigation_style', [
            'label' => esc_html('Navigation'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_navigation' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'nav_width',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-swiper-button-next , {{WRAPPER}} .rkit-swiper-button-prev' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_height',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-swiper-button-next , {{WRAPPER}} .rkit-swiper-button-prev' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_icon_size',
            [
                'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-swiper-button-next , {{WRAPPER}} .rkit-swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-swiper-button-prev , {{WRAPPER}} .rkit-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'nav_margin_options',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'navigation_margin_prev',
            [
                'label' => esc_html__('Margin Previous', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-swiper-button-prev' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_margin_next',
            [
                'label' => esc_html__('Margin Next', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-swiper-button-next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} .rkit-swiper-button-prev , {{WRAPPER}} .rkit-swiper-button-next' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-swiper-button-prev , {{WRAPPER}} .rkit-swiper-button-next',
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
                'selector' => '{{WRAPPER}} .rkit-swiper-button-prev , {{WRAPPER}} .rkit-swiper-button-next',
            ]
        );

        $this->add_control(
            'nav_border_options_normal',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_border_normal',
                'selector' => '{{WRAPPER}} .rkit-swiper-button-prev , {{WRAPPER}} .rkit-swiper-button-next',
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
                '{{WRAPPER}} .rkit-swiper-button-prev:hover , {{WRAPPER}} .rkit-swiper-button-next:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'nav_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-swiper-button-prev:hover , {{WRAPPER}} .rkit-swiper-button-next:hover',
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
                'selector' => '{{WRAPPER}} .rkit-swiper-button-prev:hover , {{WRAPPER}} .rkit-swiper-button-next:hover',
            ]
        );

        $this->add_control(
            'nav_border_options_hover',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'nav_border_hover',
                'selector' => '{{WRAPPER}} .rkit-swiper-button-prev:hover , {{WRAPPER}} .rkit-swiper-button-next:hover',
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
        $initialSlide = $this->initialSlide($settings['list']);

        $config = [
            'rtl'                => is_rtl(),
            'arrows'            => ($settings['show_navigation'] === 'yes') ? true : false,
            'dots'                => ($settings['show_dots'] === 'yes') ? true : false,
            'initial_slide' => $initialSlide,
            'autoplay'            => ($settings['autoplay'] === 'yes') ? [
                'pauseOnMouseEnter' => $pauseOnHover,
            ] : false,
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

        switch ($settings['title_tag']) {
            case 'h1':
                $title_tag = 'h1';
                break;
            case 'h2':
                $title_tag = 'h2';
                break;
            case 'h3':
                $title_tag = 'h3';
                break;
            case 'h4':
                $title_tag = 'h4';
                break;
            case 'h5':
                $title_tag = 'h5';
                break;
            case 'h6':
                $title_tag = 'h6';
                break;
            default:
                $title_tag = 'h3';
                break;
        }

?>
        <div class="rkit-card-slider" data-config="<?php echo esc_attr(json_encode($config)) ?>">
            <!-- Slider main container -->
            <div class="rkit-swiper">
                <?php if ($settings['dots_position'] == 'top') : ?>
                    <div class="rkit-cardslider-pagination"></div>
                <?php endif; ?>
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php foreach ($settings['list'] as $li) :
                        if (!empty($li['card_link']['url'])) {
                            $this->add_link_attributes('card_link_' . $li['_id'], $li['card_link']);
                        }
                    ?>
                        <div class="swiper-slide">
                            <div class="rkit-card <?php echo esc_attr($settings['select_style']) ?>">
                                <div class="card-image">
                                    <?php
                                    $this->add_render_attribute('image', 'src', $li['image']['url']);
                                    $this->add_render_attribute('image', 'alt', \Elementor\Control_Media::get_image_alt($li['image']));
                                    $this->add_render_attribute('image', 'title', \Elementor\Control_Media::get_image_title($li['image']));
                                    echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($li, 'thumbnail', 'image');
                                    ?>
                                </div>
                                <div class="card-body">
                                    <div class="card-heading">
                                        <?php if ($settings['subheading_position'] == 'top') : ?>
                                            <span class="card-subheading"><?php echo esc_html($li['card_sub_title']) ?></span>
                                        <?php endif; ?>
                                        <<?php echo esc_html($title_tag) ?> class="card-title">
                                            <a <?php $this->print_render_attribute_string('card_link_' . $li['_id']) ?>>
                                                <?php echo esc_html($li['card_title']) ?>
                                            </a>
                                        </<?php echo esc_html($title_tag) ?>>
                                        <?php if ($settings['subheading_position'] == 'bottom') : ?>
                                            <span class="card-subheading"><?php echo esc_html($li['card_sub_title']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="card-description"><?php echo esc_html($li['card_description']) ?></p>
                                    <?php if ($settings['show_button'] == 'yes') : ?>
                                        <div class="card-button <?php echo ($settings['button_width_select'] == 'fullwidth') ? 'fullwidth' : '' ?>">
                                            <a <?php $this->print_render_attribute_string('card_link_' . $li['_id']) ?>>
                                                <?php echo esc_html($settings['button_text']) ?>
                                                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => 'button-icon']); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if ($settings['dots_position'] == 'bottom') : ?>
                    <div class="rkit-cardslider-pagination"></div>
                <?php endif; ?>
            </div>
            <?php if ($settings['show_navigation'] === 'yes') : ?>
                <!-- If we need navigation buttons -->
                <div class="rkit-swiper-button-prev"><?php \Elementor\Icons_Manager::render_icon($settings['previous_icon'], ['aria-hidden' => 'true']); ?></div>
                <div class="rkit-swiper-button-next"><?php \Elementor\Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true']); ?></div>
            <?php endif; ?>
        </div>
<?php
    }

    protected function initialSlide($array)
    {
        foreach ($array as $key => $arr) {
            if ($arr['initial_slide'] == 'yes') {
                return $key;
            }
        }
        return null;
    }
}