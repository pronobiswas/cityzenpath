<?php

class Rkit_Accordion extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-accordion';
    }

    public function get_title()
    {  
        return \RomethemeKit\RkitWidgets::listWidgets()['accordion']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['accordion']['icon'];
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
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-accordion-widget/';
    }

    public function get_style_depends()
    {
        return ['rkit-accordion-style'];
    }

    public function get_script_depends()
    {
        return ['accordion-script'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('accordion', ['label' => esc_html('Accordion'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $list = new \Elementor\Repeater();

        $list->add_control('accordion_title', [
            'label' => esc_html('Title'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html('Input Your Title Here')
        ]);

        $list->add_control(
            'open_default',
            [
                'label' => esc_html__('Default Open ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
            ]
        );

        $list->add_control(
            'item_description',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__('Type your description here', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control('list_items', [
            'label' => esc_html('Content'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $list->get_controls(),
            'default' => [
                [
                    'accordion_title' => esc_html('Accordion #1'),
                    'open_default' => 'yes',
                    'item_description' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non lacus quam. Donec est velit, condimentum vitae tempor eget, pretium et massa. Integer velit dui, lacinia non turpis at, lobortis tincidunt risus. Donec ut cursus urna. Praesent luctus interdum ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ],
                [
                    'accordion_title' => esc_html('Accordion #2'),
                    'item_description' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non lacus quam. Donec est velit, condimentum vitae tempor eget, pretium et massa. Integer velit dui, lacinia non turpis at, lobortis tincidunt risus. Donec ut cursus urna. Praesent luctus interdum ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ],
                [
                    'accordion_title' => esc_html('Accordion #3'),
                    'item_description' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non lacus quam. Donec est velit, condimentum vitae tempor eget, pretium et massa. Integer velit dui, lacinia non turpis at, lobortis tincidunt risus. Donec ut cursus urna. Praesent luctus interdum ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ],
            ],
            'title_field' => '{{{ accordion_title }}}'
        ]);

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'show_loop_count',
            [
                'label' => esc_html__('Show Loop Count ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );


        $this->add_control('title_tag', [
            'label' => esc_html('Title HTML Tag'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'h1' => esc_html('H1'),
                'h2' => esc_html('H2'),
                'h3' => esc_html('H3'),
                'h4' => esc_html('H4'),
                'h5' => esc_html('H5'),
                'h6' => esc_html('H6'),
                'span' => esc_html('Span'),
                'div' => esc_html('DIV')
            ],
            'default' => 'h4'
        ]);

        $this->end_controls_section();

        $this->start_controls_section('icons_content', [
            'label' => esc_html('Icon'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__('Icon Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row-reverse' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion-header' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_close',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-chevron-down',
                    'library' => 'rtmicons',
                ],
            ]
        );

        $this->add_control(
            'icon_open',
            [
                'label' => esc_html__('Icon Active', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-chevron-up',
                    'library' => 'rtmicons',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('accordion_style', [
            'label' => esc_html('Accordion'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
			'accordion_spacing',
			[
				'label' => esc_html__( 'Spacing', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rkit-accordion' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section('title_style', [
            'label' => esc_html('Title'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
			'title_text_align',
			[
				'label' => esc_html__( 'Alignment', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rometheme-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rometheme-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rometheme-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rkit-accordion__title' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rkit-accordion__title',
            ]
        );

        $this->start_controls_tabs('title_tabs');

        $this->start_controls_tab('title_tab_close', ['label' => esc_html('Close')]);

        $this->add_responsive_control(
            'title_radius_close',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('text_color_close', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-accordion__title' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'accordion_box_shadow_close',
                'selector' => '{{WRAPPER}} .rkit-accordion-header',
            ]
        );

        $this->add_control(
            'acc_bg_hr_close',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'acc_background_close',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-accordion-header',
            ]
        );

        $this->add_control(
            'acc_border_hr_close',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'acc_border_close',
                'selector' => '{{WRAPPER}} .rkit-accordion-header',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('title_tab_open', ['label' => esc_html('Open')]);

        $this->add_responsive_control(
            'title_radius_open',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('text_color_open', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion__title' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'accordion_box_shadow_open',
                'selector' => '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion-header',
            ]
        );

        $this->add_control(
            'acc_bg_hr_open',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'acc_background_open',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion-header',
            ]
        );

        $this->add_control(
            'acc_border_hr_open',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'acc_border_open',
                'selector' => '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion-header',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('title_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_responsive_control(
            'title_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion-header:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('text_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-accordion-header:hover .rkit-accordion__title' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'accordion_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-accordion-header:hover',
            ]
        );

        $this->add_control(
            'acc_bg_hr_hover',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'acc_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-accordion-header:hover',
            ]
        );

        $this->add_control(
            'acc_border_hr_hover',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'acc_border_hover',
                'selector' => '{{WRAPPER}} .rkit-accordion-header:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('icon_style', [
            'label' => esc_html('Icon'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-accordion__icon .icon_open , .rkit-accordion__icon .icon_close' => 'font-size: {{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}} ; height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_box_width',
            [
                'label' => esc_html__('Box Width', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-accordion__icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_box_height',
            [
                'label' => esc_html__('Box height', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-accordion__icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_box_margin',
            [
                'label' => esc_html__('Box Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion__icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_box_radius',
            [
                'label' => esc_html__('Box Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('icon_tabs');

        $this->start_controls_tab('icon_tab_close', ['label' => esc_html('Close')]);

        $this->add_control('icon_color_close', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-accordion__icon .icon_close , .rkit-accordion__icon .icon_open' => 'color:{{VALUE}} ; fill:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow_close',
                'selector' => '{{WRAPPER}} .rkit-accordion__icon',
            ]
        );

        $this->add_control(
            'icon_bg_hr_close',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_background_close',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-accordion__icon',
            ]
        );

        $this->add_control(
            'icon_border_hr_close',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border_close',
                'selector' => '{{WRAPPER}} .rkit-accordion__icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('icon_tab_open', ['label' => esc_html('Open')]);

        $this->add_control('icon_color_open', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion__icon .icon_open , .rkit-accordion-item.open .rkit-accordion__icon .icon_close' => 'color:{{VALUE}} ; fill:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow_open',
                'selector' => '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion__icon',
            ]
        );

        $this->add_control(
            'icon_bg_hr_open',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_background_open',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion__icon',
            ]
        );

        $this->add_control(
            'icon_border_hr_open',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border_open',
                'selector' => '{{WRAPPER}} .rkit-accordion-item.open .rkit-accordion__icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('icon_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-accordion-header:hover .rkit-accordion__icon .icon_close , .rkit-accordion-header:hover .rkit-accordion__icon .icon_open' => 'color:{{VALUE}} ; fill:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-accordion-header:hover .rkit-accordion__icon',
            ]
        );

        $this->add_control(
            'icon_bg_hr_hover',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'icon_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-accordion-header:hover .rkit-accordion__icon',
            ]
        );

        $this->add_control(
            'icon_border_hr_hover',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border_hover',
                'selector' => '{{WRAPPER}} .rkit-accordion-header:hover .rkit-accordion__icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('content_style', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
            'content_text_align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion__content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .rkit-accordion__content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-accordion__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('content_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-accordion__content' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'content_text_shadow',
                'selector' => '{{WRAPPER}} .rkit-accordion__content',
            ]
        );

        $this->add_control(
            'bg_content_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-accordion__content',
            ]
        );

        $this->add_control(
            'border_content_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_content',
                'selector' => '{{WRAPPER}} .rkit-accordion__content',
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $no = 0;

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
            case 'span':
                $title_tag = 'span';
                break;
            case 'div':
                $title_tag = 'div';
                break;
            default:
                $title_tag = 'h3';
                break;
        }
?>

        <div class="rkit-accordion">
            <?php foreach ($settings['list_items'] as $item) : $no = $no + 1; ?>
                <div class="rkit-accordion-item <?php echo ($item['open_default'] === 'yes') ? 'open' : ''  ?>">
                    <div class="rkit-accordion-header">
                        <<?php echo esc_attr($title_tag) ?> class="rkit-accordion__title">
                            <?php
                            if ($settings['show_loop_count'] === 'yes') {
                                echo esc_html($no . '. ');
                            }
                            echo esc_html($item['accordion_title'])
                            ?>
                        </<?php echo esc_attr($title_tag) ?>>
                        <div class="rkit-accordion__icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['icon_close'], ['aria-hidden' => 'true', 'class' => 'icon_close']); ?>
                            <?php \Elementor\Icons_Manager::render_icon($settings['icon_open'], ['aria-hidden' => 'true', 'class' => 'icon_open']); ?>
                        </div>
                    </div>
                    <div class="rkit-accordion-content">
                        <div class="rkit-accordion__content">
                            <?php echo wp_kses_post($item['item_description'] )?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

<?php
    }
}
