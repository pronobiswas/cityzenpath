<?php

class CTA_Rkit extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-cta';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['cta']['name'];
    }
    public function get_keywords()
    {
        return ['RTM', 'cta', 'call to action'];
    }
    public function get_icon()
    {
        $icon = 'rkit-widget-icon ' . \RomethemeKit\RkitWidgets::listWidgets()['cta']['icon'];
        return $icon;
    }
    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-call-to-action-widget/';
    }

    public function get_style_depends()
    {
        return ['rkit-cta-style'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('image_settings', ['label' => 'Image', 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('select_skin', [
            'label' => esc_html('Skin'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'classic' => esc_html('Classic'),
                'cover' => esc_html('Cover')
            ],
            'default' => 'classic'
        ]);

        $this->add_responsive_control('position_image', [
            'label' => esc_html__('Image Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'row' => [
                    'title' => esc_html__('Left', 'rometheme-for-elementor'),
                    'icon' => 'eicon-h-align-left',
                ],
                'column' => [
                    'title' => esc_html__('Top', 'rometheme-for-elementor'),
                    'icon' => ' eicon-v-align-top',
                ],
                'row-reverse' => [
                    'title' => esc_html__('Right', 'rometheme-for-elementor'),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'toggle' => true,
            'default' => 'row',
            'mobile_default' => 'column',
            'selectors' => [
                '{{WRAPPER}} .rkit-cta' => 'flex-direction:{{VALUE}}'
            ],
            'condition' => [
                'select_skin' => 'classic'
            ]
        ]);

        $this->add_control(
            'image_background',
            [
                'label' => esc_html__('Choose Image', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_background', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => [],
                'include' => [],
                'default' => 'large',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_settings', ['label' => esc_html('Content'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control(
            'graphic_element',
            [
                'label' => esc_html__('Graphic Element', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'none' => [
                        'title' => esc_html__('None', 'rometheme-for-elementor'),
                        'icon' => 'eicon-ban',
                    ],
                    'image' => [
                        'title' => esc_html__('Image', 'rometheme-for-elementor'),
                        'icon' => 'eicon-image-bold',
                    ],
                    'icon' => [
                        'title' => esc_html__('Icon', 'rometheme-for-elementor'),
                        'icon' => 'eicon-star',
                    ],
                ],
                'default' => 'none',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'graphic_image',
            [
                'label' => esc_html__('Choose Image', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'graphic_element' => 'image'
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
                'condition' => [
                    'graphic_element' => 'image'
                ],
            ]
        );

        $this->add_control(
            'graphic_icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-star',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'graphic_element' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'hr_title',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'content_title',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('This is the heading', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your title here', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control('title_tag', [
            'label' => esc_html__('Title Tag', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'h1' => esc_html('H1'),
                'h2' => esc_html('H2'),
                'h3' => esc_html('H3'),
                'h4' => esc_html('H4'),
                'h5' => esc_html('H5'),
                'h6' => esc_html('H6'),
            ],
            'default' => 'h1'
        ]);

        $this->add_control(
            'content_description',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your description here', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control(
            'hr_button',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Click Here', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your text here', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control(
            'website_link',
            [
                'label' => esc_html__('Link', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'rometheme-for-elementor'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_fullwidth',
            [
                'label' => esc_html__('Fullwidth ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('no', 'rometheme-for-elementor'),
                'return_value' => 'fullwidth',
                'default' => '',
            ]
        );

        $this->add_control(
            'add_btn_icon',
            [
                'label' => esc_html__('Add Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

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
                    '{{WRAPPER}} .rkit-cta a.rkit-cta-button' => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [
                    'add_btn_icon' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-arrow-right',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'add_btn_icon' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('box_style', [
            'label' => esc_html('Box'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'box_direction',
            [
                'label' => esc_html__('Direction', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'column' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-content__wrapper' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_height',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 5,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-container-classic .rkit-cta-content__wrapper' => 'min-height: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .rkit-cta-container-cover .rkit-cta-img__wrapper' => 'min-height:{{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs('box_tabs', ['condition' => [
            'select_skin' => 'classic'
        ]]);

        $this->start_controls_tab('box_tab_normal', ['label' => esc_html("Normal")]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-cta',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('box_tab_hover', ['label' => esc_html("Hover")]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'box_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-cta:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'align_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'content_align_column',
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
                    '{{WRAPPER}} .rkit-cta-content__wrapper' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .rkit-cta-description' => 'text-align : {{VALUE}}',
                    '{{WRAPPER}} .rkit-cta-text' => 'justify-content:{{VALUE}}; text-align:{{VALUE}}'
                ],
                'condition' => [
                    'box_direction!' => 'row'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_align_row',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Justify', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-content__wrapper' => 'justify-content: {{VALUE}};',
                    '{{WRAPPER}} .rkit-cta-description' => 'text-align : {{VALUE}}',
                ],
                'condition' => [
                    'box_direction' => 'row'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_vertical_align_column',
            [
                'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-content__wrapper' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'box_direction!' => 'row'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_vertical_align_row
            ',
            [
                'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-content__wrapper' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'box_direction' => 'row'
                ]
            ]
        );

        $this->add_responsive_control('box_padding', [
            'label' => esc_html('Padding'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-content__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->add_responsive_control('box_radius', [
            'label' => esc_html('Border Radius'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .rkit-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->add_control(
            'img_options',
            [
                'label' => esc_html__('Image', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control('image_radius', [
            'label' => esc_html('Border Radius'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'rem', 'em'],
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-img__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ],
            'condition' => [
                'select_skin' => 'classic',
            ]
        ]);

        $this->add_responsive_control('image_width', [
            'label' => esc_html__('Width', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
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
                '{{WRAPPER}} .rkit-cta-container-classic .rkit-cta-img__wrapper' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'select_skin' => 'classic',
                'position_image!' => 'column'
            ]
        ]);

        $this->add_responsive_control('image_height', [
            'label' => esc_html__('Height', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
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
                '{{WRAPPER}} .rkit-cta-container-classic .rkit-cta-img__wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'select_skin' => 'classic',
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('graphic_element_style', ['label' => esc_html('Graphic Element'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE, 'condition' => ['graphic_element!' => 'none']]);
        $this->add_responsive_control('graphic_element_spacing_column', [
            'label' => esc_html('Spacing'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta__graphic_element' => 'margin-bottom:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'box_direction!' => 'row'
            ]
        ]);

        $this->add_responsive_control('graphic_element_spacing_row', [
            'label' => esc_html('Spacing'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta__graphic_element' => 'margin-inline:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'box_direction' => 'row'
            ]
        ]);

        $this->add_control(
            'graphic_element_img_size',
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
                    '{{WRAPPER}} .rkit-cta__graphic_element img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rkit-cta-icon__graphic_element' => 'font-size: {{SIZE}}{{UNIT}}'
                ],
            ]
        );
        $this->add_control(
            'graphic_element_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-cta__graphic_element' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('graphic_elemen_icon_color', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-icon__graphic_element' => 'color:{{VALUE}}'
            ],
            'condition' => [
                'graphic_element' => 'icon'
            ]
        ]);

        $this->add_control('graphic_elemen_bg_color', [
            'label' => esc_html('Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta__graphic_element' => 'background-color:{{VALUE}}'
            ],
            'condition' => [
                'graphic_element' => 'icon'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_graphic_element',
                'selector' => '{{WRAPPER}} .rkit-cta__graphic_element',
            ]
        );

        $this->add_control(
            'graphic_element_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta__graphic_element' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section('content_style', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control(
            'title_options',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rkit-cta-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .rkit-cta-title',
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
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
                    '{{WRAPPER}} .rkit-cta-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_options',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .rkit-cta-description',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
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
                    '{{WRAPPER}} .rkit-cta-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'box_direction!' => 'row'
                ]
            ]
        );

        $this->add_control(
            'content_color_options',
            [
                'label' => esc_html__('Colors', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('colors_tab');

        $this->start_controls_tab('colors_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('title_color_normal', [
            'label' => esc_html('Title Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-title' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('description_color_normal', [
            'label' => esc_html('Description Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#000',
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-description' => 'color:{{VALUE}}'
            ]
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('colors_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('title_color_hover', [
            'label' => esc_html('Title Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta:hover .rkit-cta-title' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('description_color_hover', [
            'label' => esc_html('Description Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta:hover .rkit-cta-description' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('btn_color_hover', [
            'label' => esc_html__('Button Color', ' rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta:hover .rkit-cta-button' => 'color:{{VALUE}} ; border-color:{{VALUE}}',
            ]
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('ribbon_settings', [
            'label' => esc_html('Ribbon'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('ribbon_text', [
            'label' => esc_html('Title'),
            'type' => \Elementor\Controls_Manager::TEXT
        ]);

        $this->add_control(
            'ribbon_position',
            [
                'label' => esc_html__('Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'rkit-cta-ribbon__left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-start',
                    ],
                    'rkit-cta-ribbon__right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'default' => 'rkit-cta-ribbon__left',
                'toggle' => true,
                'condition' => [
                    'ribbon_text!' => ''
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html('Button'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_responsive_control('btn_spacing_row', [
            'label' => esc_html('Spacing'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-button' => 'margin-inline:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'box_direction' => 'row'
            ]
        ]);


        $this->add_responsive_control(
            'padding_button',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius_button',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .rkit-cta-button',
            ]
        );
        $this->add_control(
            'icon1_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'add_btn_icon' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-button__icon' => 'font-size:{{SIZE}}{{UNIT}} ; width:{{SIZE}}{{UNIT}} ; height: {{SIZE}}{{UNIT}}'
                ],
                'condition' => [
                    'add_btn_icon' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-button' => 'gap: {{SIZE}}{{UNIT}}'
                ],
                'condition' => [
                    'add_btn_icon' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon2_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
                'condition' => [
                    'add_btn_icon' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs('button_tabs');

        $this->start_controls_tab('button_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-cta-button',
            ]
        );

        $this->add_control('btn_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-button' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('btn_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-button__icon' => 'color:{{VALUE}}'
            ],
            'condition' => [
                'add_btn_icon' => 'yes'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_btn',
                'selector' => '{{WRAPPER}} .rkit-cta-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover', ['label' => esc_html('Hover')]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-cta-button:hover',
            ]
        );
        $this->add_control('btn_text_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-button:hover' => 'color:{{VALUE}} !important'
            ]
        ]);

        $this->add_control('btn_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-button:hover .rkit-cta-button__icon' => 'color:{{VALUE}}'
            ],
            'condition' => [
                'add_btn_icon' => 'yes'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_btn_hover',
                'selector' => '{{WRAPPER}} .rkit-cta-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('ribbon_style', [
            'label' => esc_html('Ribbon'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'ribbon_text!' => ''
            ]
        ]);

        $this->add_control('ribbon_bg', [
            'label' => esc_html('Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-ribbon__inner' => 'background-color: {{VALUE}}'
            ]
        ]);


        $this->add_control('ribbon_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-ribbon__inner' => 'color: {{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
            'ribbon_distance',
            [
                'label' => esc_html__('Distance', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-ribbon__inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg);',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ribbon_typography',
                'selector' => '{{WRAPPER}} .rkit-cta-ribbon__inner',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ribbon_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-cta-ribbon__inner',
            ]
        );

        $this->add_responsive_control(
			'ribbon_padding',
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem'],
				'selectors' => [
					'{{WRAPPER}} .rkit-cta-ribbon__inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section('hover_style', [
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'label' => esc_html('Hover Effect')
        ]);

        $this->add_control('effect_select', [
            'label' => esc_html('Hover Effect'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html('None'),
                'zoom-in' => esc_html('Zoom In'),
                'zoom-out' => esc_html('Zoom Out'),
                'move-right' => esc_html('Move Right'),
                'move-left' => esc_html('Move Left'),
                'move-up' => esc_html('Move Up'),
                'move-down' => esc_html('Move Down'),
            ],
            'default' => 'zoom-in'
        ]);

        $this->start_controls_tabs('hover_effect_tabs');

        $this->start_controls_tab('hover_effect_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('overlay_color_normal', [
            'label' => esc_html('Overlay Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta-img__overlay' => 'background-color : {{VALUE}}'
            ]
        ]);

        $this->add_control(
            'overlay_opacity',
            [
                'label' => esc_html__('Opacity', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta-img__overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'custom_css_filters_normal',
                'selector' => '{{WRAPPER}} .rkit-cta-img__image',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border_normal',
                'selector' => '{{WRAPPER}} .rkit-cta',
                'label' => esc_html__('Box Border', 'textdomain'),
                'fields_options' => [
                    'border' => [
                        'label' => esc_html__('Box Border Type', 'textdomain'),
                        // 'default' => 'solid',
                    ]
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('hover_effect_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('overlay_color_hover', [
            'label' => esc_html('Overlay Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-cta:hover .rkit-cta-img__overlay' => 'background-color : {{VALUE}}'
            ]
        ]);

        $this->add_control(
            'overlay_opacity_hover',
            [
                'label' => esc_html__('Opacity', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-cta:hover .rkit-cta-img__overlay' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'custom_css_filters_hover',
                'selector' => '{{WRAPPER}} .rkit-cta:hover .rkit-cta-img__image',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border_hover',
                'selector' => '{{WRAPPER}} .rkit-cta:hover',
                'label' => esc_html__('Box Border', 'textdomain'),
                'fields_options' => [
                    'border' => [
                        'label' => esc_html__('Box Border Type', 'textdomain'),
                        // 'default' => 'solid',
                    ]
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['website_link']['url'])) {
            $this->add_link_attributes('website_link', $settings['website_link']);
        }
        if (!empty($settings['image_background']['id'])) {
            $bg_image = \Elementor\Group_Control_Image_Size::get_attachment_image_src($settings['image_background']['id'], 'image_background', $settings);
        } elseif (!empty($settings['image_background']['url'])) {
            $bg_image = $settings['image_background']['url'];
        }

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
                $title_tag = 'h1';
                break;
        }

?>
        <div class="rkit-cta rkit-cta-container-<?php echo esc_attr($settings['select_skin']) ?>">
            <div class="rkit-cta-img__wrapper">
                <div class="rkit-cta-img__image <?php echo esc_attr($settings['effect_select']) ?>" style="background-image:url('<?php echo esc_url($bg_image) ?>')">
                </div>
                <div class="rkit-cta-img__overlay">
                </div>
            </div>
            <div class="rkit-cta-content__wrapper">
                <?php
                switch ($settings['graphic_element']) {
                    case 'image':
                        echo '<div class="rkit-cta__graphic_element">';
                        echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'graphic_image');
                        echo '</div>';
                        break;
                    case 'icon':
                        echo '<div class="rkit-cta__graphic_element">';
                        \Elementor\Icons_Manager::render_icon($settings['graphic_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-cta-icon__graphic_element']);
                        echo '</div>';
                        break;
                }
                ?>
                <div class="rkit-cta-text">
                    <<?php echo esc_html($title_tag) ?> class="rkit-cta-title"><?php echo esc_html($settings['content_title']) ?></<?php echo esc_html($title_tag) ?>>
                    <div class="rkit-cta-description"><?php echo esc_html($settings['content_description']) ?></div>
                </div>
                <a class="rkit-cta-button <?php echo esc_attr($settings['btn_fullwidth']) ?>" type="button" <?php $this->print_render_attribute_string('website_link') ?>>
                    <?php echo esc_html($settings['button_text']) ?>
                    <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true', 'class' => 'rkit-cta-button__icon']); ?>
                </a>
            </div>
            <div class="rkit-cta-ribbon <?php echo esc_attr($settings['ribbon_position']) ?>">
                <div class="rkit-cta-ribbon__inner">
                    <?php echo esc_html($settings['ribbon_text']) ?>
                </div>
            </div>
        </div>
<?php
    }
}
