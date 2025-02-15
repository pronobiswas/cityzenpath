<?php

class Rkit_Tabs extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-tabs';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['tabs']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['tabs']['icon'];
        return $icon;
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-advanced-tabs-widget/';
    }

    public function get_script_depends()
    {
        return [''];
    }

    public function get_elementor_template()
    {
        $template = get_posts([
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
            'meta_query' => [
                [
                    'key' => '_elementor_template_type',
                    'value' => 'kit',
                    'compare' => '!=',
                ],
            ],
        ]);
        $list = [];
        if ($template) {
            foreach ($template as $template) {
                $list[intval($template->ID)] = esc_html__($template->post_title, 'rometheme-for-elementor');
            }
        }
        return $list;
    }

    protected function register_controls()
    {

        $this->start_controls_section('setting_section', [
            'label' => esc_html('Settings'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('layout', [
            'label' => esc_html('Layout'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'horizontal' => esc_html('Horizontal'),
                'vertical' => esc_html('Vertical'),
            ],
            'default' => 'horizontal'
        ]);

        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__('Enable Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->add_control('icon_position', [
            'label' => esc_html('Icon Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'column' => esc_html('Stacked'),
                'row' => esc_html('Inline'),
            ],
            'default' => 'row',
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-btn-item' => 'flex-direction:{{VALUE}}'
            ],
            'condition' => [
                'show_icon' => 'yes'
            ]
        ]);

        $this->add_control(
            'icon_align',
            [
                'label' => esc_html__('Icon Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'ltr' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'rtl' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'ltr',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-btn-item' => 'direction: {{VALUE}};',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                    'icon_position' => 'row'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $item = new \Elementor\Repeater();

        $item->add_control(
            'active_default',
            [
                'label' => esc_html__('Active Default', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
            ]
        );

        $item->add_control(
            'icon_tab',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-home',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $item->add_control('tab_title', [
            'label' => esc_html('Tab Title'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html('Input Your Title Here'),
        ]);

        $item->add_control('title_tag', [
            'label' => esc_html('Title Tag HTML'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'h1' => esc_html('H1'),
                'h2' => esc_html('H2'),
                'h3' => esc_html('H3'),
                'h4' => esc_html('H4'),
                'h5' => esc_html('H5'),
                'h6' => esc_html('H6'),
                'div' => esc_html('div'),
                'span' => esc_html('span'),
            ],
            'default' => 'span'
        ]);

        $item->add_control('content_type', [
            'label' => esc_html('Content Type'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'content' => esc_html('Content'),
                'template' => esc_html('Saved Template'),
            ],
            'default' => 'content'
        ]);

        $item->add_control(
            'item_content',
            [
                'label' => esc_html__('Content', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__('Type your description here', 'rometheme-for-elementor'),
                'condition' => [
                    'content_type' => 'content'
                ]
            ]
        );

        $item->add_control('item_template',  [
            'label' => esc_html('Choose Templates'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $this->get_elementor_template(),
            'condition' => [
                'content_type' => 'template'
            ]
        ]);

        $this->add_control('tab_list', [
            'label' => esc_html('Tabs List'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $item->get_controls(),
            'default' => [
                [
                    'tab_title' => esc_html('Tab 1'),
                    'active_default' => 'yes',
                    'item_content' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id sapien ultricies, varius augue eu, tincidunt urna. Donec nec nisl consectetur, sagittis leo quis, dignissim lacus. Suspendisse maximus, lorem at porttitor lacinia, tortor ante aliquam purus, molestie lacinia dolor nibh ut ex. Quisque id rutrum tortor. Duis a ornare leo, at consequat leo. Morbi non ornare nisi. Nam eu accumsan sem, ut posuere augue. Morbi lacinia nulla metus, quis cursus velit lacinia vel. Vestibulum tristique et purus eget lobortis. Morbi hendrerit eu turpis nec maximus. Sed et scelerisque nibh, non scelerisque nibh. Nullam quis iaculis libero. Etiam quis dui varius, blandit metus at, convallis nisl. Cras dictum est vitae dui lacinia, vitae pharetra ante finibus. In sollicitudin risus nec turpis sollicitudin, in commodo ex viverra.'),
                ],
                [
                    'tab_title' => esc_html('Tab 2'),
                    'active_default' => '',
                    'item_content' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id sapien ultricies, varius augue eu, tincidunt urna. Donec nec nisl consectetur, sagittis leo quis, dignissim lacus. Suspendisse maximus, lorem at porttitor lacinia, tortor ante aliquam purus, molestie lacinia dolor nibh ut ex. Quisque id rutrum tortor. Duis a ornare leo, at consequat leo. Morbi non ornare nisi. Nam eu accumsan sem, ut posuere augue. Morbi lacinia nulla metus, quis cursus velit lacinia vel. Vestibulum tristique et purus eget lobortis. Morbi hendrerit eu turpis nec maximus. Sed et scelerisque nibh, non scelerisque nibh. Nullam quis iaculis libero. Etiam quis dui varius, blandit metus at, convallis nisl. Cras dictum est vitae dui lacinia, vitae pharetra ante finibus. In sollicitudin risus nec turpis sollicitudin, in commodo ex viverra.'),
                ],
                [
                    'tab_title' => esc_html('Tab 3'),
                    'active_default' => '',
                    'item_content' => esc_html('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id sapien ultricies, varius augue eu, tincidunt urna. Donec nec nisl consectetur, sagittis leo quis, dignissim lacus. Suspendisse maximus, lorem at porttitor lacinia, tortor ante aliquam purus, molestie lacinia dolor nibh ut ex. Quisque id rutrum tortor. Duis a ornare leo, at consequat leo. Morbi non ornare nisi. Nam eu accumsan sem, ut posuere augue. Morbi lacinia nulla metus, quis cursus velit lacinia vel. Vestibulum tristique et purus eget lobortis. Morbi hendrerit eu turpis nec maximus. Sed et scelerisque nibh, non scelerisque nibh. Nullam quis iaculis libero. Etiam quis dui varius, blandit metus at, convallis nisl. Cras dictum est vitae dui lacinia, vitae pharetra ante finibus. In sollicitudin risus nec turpis sollicitudin, in commodo ex viverra.'),
                ],
            ],
            'title_field' => '{{{ tab_title }}}'
        ]);

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
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'wrapper_border',
                'selector' => '{{WRAPPER}} .rkit-tab-container',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-tab-container',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('tab_title_style', [
            'label' => esc_html('Tab Title'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
			'tab_title_align',
			[
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rkit-tab-btn-item' => 'justify-content: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item',
            ]
        );

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .tab-title-icon' => 'font-size: {{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'show_icon' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-tab-btn-item' => 'gap: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'show_icon' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tab-title-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-btn-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-btn-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-btn-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('title_tabs');

        $this->start_controls_tab('title_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('title_text_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-btn-item' => 'color:{{VALUE}};'
            ]
        ]);

        $this->add_control('title_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-btn-item .tab-title-icon' => 'color:{{VALUE}}; fill:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item',
            ]
        );

        $this->add_control(
            'title_bg_options_normal',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item',
            ]
        );

        $this->add_control(
            'title_border_options_normal',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'title_border_normal',
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('title_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('title_text_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-btn-item:hover' => 'color:{{VALUE}};'
            ]
        ]);

        $this->add_control('title_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-btn-item:hover .tab-title-icon' => 'color:{{VALUE}};fill:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item:hover',
            ]
        );

        $this->add_control(
            'title_bg_options_hover',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item:hover',
            ]
        );

        $this->add_control(
            'title_border_options_hover',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'title_border_hover',
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('title_tab_active', ['label' => esc_html('Active')]);

        $this->add_control('title_text_color_active', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-btn-item.active' => 'color:{{VALUE}};'
            ]
        ]);

        $this->add_control('title_icon_color_active', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-btn-item.active .tab-title-icon' => 'color:{{VALUE}};fill:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'title_box_shadow_active',
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item.active',
            ]
        );

        $this->add_control(
            'title_bg_options_active',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_background_active',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item.active',
            ]
        );

        $this->add_control(
            'title_border_options_active',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'title_border_active',
                'selector' => '{{WRAPPER}} .rkit-tab-btn-item.active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('content_style', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .rkit-tab-content-container',
            ]
        );

        $this->add_control('content_text_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-tab-content' => 'color: {{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-content-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-tab-content-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .rkit-tab-content-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-tab-content-container',
            ]
        );

        $this->add_control(
            'content_bg_options',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-tab-content-container',
            ]
        );

        $this->add_control(
            'content_border_options',
            [
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .rkit-tab-content-container',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <div class="rkit-tab-container <?php echo esc_attr($settings['layout']) ?>">
            <div class="rkit-tab-nav-container">
                <ul class="rkit-tab-nav">
                    <?php foreach ($settings['tab_list'] as $key => $tab) :
                        switch ($tab['title_tag']) {
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
                            default:
                                $title_tag = 'span';
                                break;
                        }

                    ?>
                        <li class="rkit-tab-btn-item <?php echo ($tab['active_default'] === 'yes') ? 'active' : ''; ?>" role="tab" data-tab="tab-<?php echo esc_attr($key) ?>">
                            <?php if ($settings['show_icon'] === 'yes') {
                                \Elementor\Icons_Manager::render_icon($tab['icon_tab'], ['aria-hidden' => 'true', 'class' => 'tab-title-icon']);
                            } ?>
                            <<?php echo esc_html($title_tag) ?> class="tab-title-text">
                                <?php echo esc_html($tab['tab_title']) ?>
                            </<?php echo esc_html($title_tag) ?>>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="rkit-tab-content-container">
                <?php foreach ($settings['tab_list'] as $key => $tab) : ?>
                    <div id="tab-<?php echo esc_attr($key) ?>" class="rkit-tab-content <?php echo ($tab['active_default'] === 'yes') ? 'active' : ''; ?>">
                        <?php
                        if ($tab['content_type'] == 'content') {
                            echo $tab['item_content'];
                        } else {
                            $template = get_post($tab['item_template']);
                            if (!empty($template)) {
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($tab['item_template']);
                            }
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
}
