<?php
class Rkit_woo_product_grid extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'rkit-woo_product_grid';
    }

    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['woo_product_grid']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon ' . \RomethemeKit\RkitWidgets::listWidgets()['woo_product_grid']['icon'];
        return $icon;
    }


    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_style_depends()
    {
        return ['rkit-woo-product-grid-style'];
    }
    public function get_keywords()
    {
        return ['product', 'grid', 'time', 'rometheme'];
    }

    public function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/';
    }

    public function rkit_get_product_categories_plain($product, $separator = ', ')
    {
        if (isset($product) && $product instanceof WC_Product) {
            return wc_get_product_category_list(
                $product->get_id(),
                $separator
            );
        }
        return '';
    }

    public function custom_rating_html($html, $rating, $count)
    {
        // Ubah lebar bintang berdasarkan rating
        $width = ($rating / 5) * 100;
        $html = '<div class="star-rating"><span style="width:' . esc_attr($width) . '%;"></span></div>';
        return $html;
    }
    private function get_product_categories()
    {
        $categories = get_terms('product_cat', ['hide_empty' => false]);
        $options = [];
        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->slug] = $category->name;
            }
        }
        return $options;
    }

    protected function register_controls()
    {

        $this->start_controls_section('pwg_general', [
            'label' => esc_html('General'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_responsive_control(
            'product_count',
            [
                'label' => __('Number of Products', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $this->add_responsive_control(
            'product_column',
            [
                'label' => __('Columns', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'selectors' => [
                    ' {{WRAPPER}} .rkit-product-grid-wpg-prem, {{WRAPPER}} .rkit-product-grid-wpg-pro, {{WRAPPER}} .rkit-product-grid-wpg' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_spacing',
            [
                'label' => esc_html__('Items Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 2,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    ' {{WRAPPER}} .rkit-product-grid-wpg-prem, {{WRAPPER}} .rkit-product-grid-wpg-pro, {{WRAPPER}} .rkit-product-grid-wpg' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'query_section',
            [
                'label' => __('Query', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );



        $this->add_control(
            'product_categories',
            [
                'label' => __('Select Categories', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_product_categories(),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->add_control('order_by_wpg', [
            'label' => esc_html__('Order By', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__('Default', 'rometheme-for-elementor'),
                'date' => esc_html__('Date', 'rometheme-for-elementor'),
                'title' => esc_html__('Title', 'rometheme-for-elementor'),
            ],
            'default' => '',
        ]);

        $this->add_control('order_wpg', [
            'label' => esc_html__('Order', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__('Default', 'rometheme-for-elementor'),
                'ASC' => esc_html__('ASC', 'rometheme-for-elementor'),
                'DESC' => esc_html__('DESC', 'rometheme-for-elementor'),
            ],
            'default' => '',
        ]);




        $this->add_control('truncate-content', [
            'label' => esc_html__('Crop Description Word', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 10,
        ]);

        $this->end_controls_section();

        $this->start_controls_section('pwg_layout', [
            'label' => esc_html('Layout'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('option_style', [
            'label' => esc_html('Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html('Style 1'),
                '-pro' => esc_html('Style 2'),
                // '-prem' => esc_html('Style 3'),

            ],
            'default' => ''
        ]);

        $this->add_control('title_wpg_tag', [
            'label' => esc_html('Tag'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'h1' => esc_html('H1'),
                'h2' => esc_html('H2'),
                'h3' => esc_html('H3'),
                'h4' => esc_html('H4'),
                'h5' => esc_html('H5'),
                'h6' => esc_html('H6'),
            ],
            'default' => 'h3'
        ]);

        $this->add_control(
            'show_category',
            [
                'label' => esc_html__('Show Category', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'option_style' => [''],
                ]
            ]
        );

        $this->add_control(
            'show_rating',
            [
                'label' => esc_html__('Show Rating', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_sale',
            [
                'label' => esc_html__('Show Sale', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_button_wgp', [
            'label' => esc_html__('Button'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'show_button_icon_wgp',
            [
                'label' => esc_html__('Show Button Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'option_style!' => '',
                ]
            ]
        );

        $this->add_control(
            'button_icon_wgp',
            [
                'label' => esc_html__('Button Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'rtmicon rtmicon-shopping-cart',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_button_icon_wgp' => 'yes',
                    'option_style!' => ''
                ]
            ]
        );

        $this->add_control(
            'button_icon_position_wgp',
            [
                'label' => esc_html__('Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'before' => [
                        'title' => esc_html__('Before Text', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-start',
                    ],
                    'after' =>  [
                        'title' => esc_html__('After Text', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'default' => 'after',
                'toggle' => true,
                'condition' => [
                    'show_button_icon_wgp' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'button_text_wgp',
            [
                'label' => esc_html__('Button Text', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Add to cart', 'rometheme-for-elementor'),
            ]
        );

        $this->end_controls_section();

        // style --------------------------------------------------------------------------------------------

        $this->start_controls_section('Container_style_section', [
            'label' => esc_html__('Container', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control(
            'show_container_hover',
            [
                'label' => esc_html__('Container Hover', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'yes' => esc_html__('show', 'rometheme-for-elementor'),
                'no' => esc_html__('hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'no',

            ]
        );

        $this->add_control(
            'con_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}}  .rkit-product-card-wpg, {{WRAPPER}}  .rkit-product-card-wpg-pro, 
                {{WRAPPER}} .rkit-product-card-wpg-prem' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'con_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-card-wpg, {{WRAPPER}}  .rkit-product-card-wpg-pro,{{WRAPPER}}  .rkit-product-card-wpg-prem' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // Tabs for Normal and Hover
        $this->start_controls_tabs('container_style_tabs_wpg');

        // Normal Tab
        $this->start_controls_tab('container_normal_tab_wpg', [
            'label' => esc_html__('Normal', 'rometheme-for-elementor'),
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background_wpg',
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-product-card-wpg, {{WRAPPER}} .rkit-product-card-wpg-pro, {{WRAPPER}} .rkit-product-card-wpg-prem',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border_wpg',
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-product-card-wpg, {{WRAPPER}}  .rkit-product-card-wpg-pro, {{WRAPPER}}  .rkit-product-card-wpg-prem',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow_wpg',
                'label' => esc_html__('Box Shadow', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-product-card-wpg, {{WRAPPER}}  .rkit-product-card-wpg-pro, {{WRAPPER}}  .rkit-product-card-wpg-prem',
            ]
        );


        $this->end_controls_tab(); // End Normal Tab

        // Hover Tab
        $this->start_controls_tab('container_hover_tab_wpg', [
            'label' => esc_html__('Hover', 'rometheme-for-elementor'),
            'condition' => [
                'show_container_hover' => 'yes',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'container_background_hover_wpg',
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '
                {{WRAPPER}} .rkit-product-card-wpg:hover, 
                {{WRAPPER}}  .rkit-product-card-wpg-pro:hover, 
                {{WRAPPER}}  .rkit-product-card-wpg-prem:hover',
                'condition' => [
                    'show_container_hover' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border_hover_wpg',
                'label' => esc_html__('Border', 'rometheme-for-elementor'),
                'selector' => '
                {{WRAPPER}} .rkit-product-card-wpg:hover,
                {{WRAPPER}}  .rkit-product-card-wpg-pro:hover, 
                {{WRAPPER}}  .rkit-product-card-wpg-prem:hover',

                'condition' => [
                    'show_container_hover' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow_hover_wpg',
                'label' => esc_html__('Box Shadow', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-product-card-wpg:hover,
             {{WRAPPER}}  .rkit-product-card-wpg-pro:hover,  {{WRAPPER}}  .rkit-product-card-wpg-prem:hover',
                'condition' => [
                    'show_container_hover' => 'yes',
                ],
            ]
        );



        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Tabs

        $this->end_controls_section();


        // image style

        $this->start_controls_section('image_style_section_wpg', [
            'label' => esc_html__('Image', 'textdomain'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('image_aspect_ratio_wpg', [
            'label' => esc_html__('Image Aspect Ratio', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '1/1' => esc_html__('1 : 1', 'rometheme-for-elementor'),
                '3/2' => esc_html__('3 : 2', 'rometheme-for-elementor'),
                '5/4' => esc_html__('5 : 4', 'rometheme-for-elementor'),
                '16/9' => esc_html__('16 : 9', 'rometheme-for-elementor'),
                '9/16' => esc_html__('9 : 16', 'rometheme-for-elementor'),

            ],
            'default' => '1/1',
            'selectors' => [
                '{{WRAPPER}} .rkit-product-image-wpg, .rkit-product-image-wpg img,
                {{WRAPPER}} .rkit-product-image-wpg-pro, .rkit-product-image-wpg-pro img,
                {{WRAPPER}} .rkit-product-image-wpg-prem, .rkit-product-image-wpg-prem img'

                => 'aspect-ratio:{{VALUE}};'
            ]
        ]);


        $this->start_controls_tabs('image_tab');

        $this->start_controls_tab('image_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control(
            'image_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-image-wpg, {{WRAPPER}} .rkit-product-image-wpg-pro, {{WRAPPER}} .rkit-product-image-wpg-prem' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-image-wpg , .rkit-product-image-wpg img, 
                    {{WRAPPER}} .rkit-product-image-wpg-pro, .rkit-product-image-wpg-pro img, 
                    {{WRAPPER}} .rkit-product-image-wpg-prem, .rkit-product-image-wpg-prem img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__('Border  ', 'textdomain'),
                'selector' => '
                {{WRAPPER}} .rkit-product-image-wpg img, 
                    {{WRAPPER}} .rkit-product-image-wpg-pro img, 
                    {{WRAPPER}}  .rkit-product-image-wpg-prem img
                            '

            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('image_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control(
            'image_padding_hover',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-image-wpg:hover, {{WRAPPER}} .rkit-product-image-wpg-pro:hover, {{WRAPPER}} .rkit-product-image-wpg-prem:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-image-wpg:hover img , 
                    {{WRAPPER}} .rkit-product-image-wpg-pro:hover img, 
                    {{WRAPPER}} .rkit-product-image-wpg-prem:hover img,
                    {{WRAPPER}} .rkit-product-image-wpg:hover::after ,
                    {{WRAPPER}} .rkit-product-image-wpg-pro:hover::after ,
                    {{WRAPPER}} .rkit-product-image-wpg-prem:hover::after '
                    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'image_hover_backgroud_wpg',
                'label' => esc_html__('Ribbon Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '  {{WRAPPER}} .rkit-product-image-wpg:hover::after ,
                    {{WRAPPER}} .rkit-product-image-wpg-pro:hover::after ,
                    {{WRAPPER}} .rkit-product-image-wpg-prem:hover::after ',
            ]
        );

        $this->add_responsive_control(
            'image_hover_opacity',
            [
                'label' => esc_html__('Opacity', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'default' => [
                    'size' => 40,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-image-wpg:hover::after ,
                    {{WRAPPER}} .rkit-product-image-wpg-pro:hover::after ,
                    {{WRAPPER}} .rkit-product-image-wpg-prem:hover::after ' => 'opacity: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border_hover',
                'label' => esc_html__('Border  ', 'textdomain'),
                'selector' => '
                {{WRAPPER}} .rkit-product-image-wpg:hover img, 
                    {{WRAPPER}} .rkit-product-image-wpg-pro:hover img, 
                    {{WRAPPER}}  .rkit-product-image-wpg-prem:hover img
                            '

            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // section content title
        // title product style
        $this->start_controls_section('title_text_style_wpg', [
            'label' => esc_html__('Title', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control(
            'divider_list_title_1_wpg',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography_wpg',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),

                'selector' => '{{WRAPPER}} .rkit-product-title-wpg, {{WRAPPER}} .rkit-product-title-wpg-pro, {{WRAPPER}} .rkit-product-title-wpg-prem',

            ]
        );

        $this->add_responsive_control(
            'title_container_width',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                    'size' => 40,
                    'unit' => '%',
                ],
                'condition' => [
                    'option_style' => ['-pro', '-prem'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-info-wpg-pro,
                    {{WRAPPER}} .rkit-product-title-wpg-prem,'
                    => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_bottom_color',
            [
                'label' => __('Title Line Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-title-wpg-prem::after' => 'border-bottom-color: {{VALUE}};',
                ],
                'condition' => [
                    'option_style' => ['-prem'],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'back_title_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-product-card-wpg-prem:hover .rkit-product-details-wpg-prem::before ',
                'condition' => [
                    'option_style' => ['-prem'],
                ],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html('Section Title Background')
                    ]
                ],
            ]
        );

        $this->add_responsive_control(
            'opacity_detail_wpg',
            [
                'label' => esc_html__('Opacity', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'option_style' => ['-prem'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-details-wpg-prem::before '
                    => 'opacity: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'divider_list_desc_price_wpg',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('title_tab');

        $this->start_controls_tab('title_tab_normal', ['label' => esc_html('Normal')]);


        $this->add_control(
            'title_color_wpg',
            [
                'label' => esc_html__('Title Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-title-wpg, {{WRAPPER}} .rkit-product-title-wpg-pro, {{WRAPPER}} .rkit-product-title-wpg-prem' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography_wpg',
                'label' => esc_html__('Desc Typography', 'rometheme-for-elementor'),

                'selector' => '{{WRAPPER}} .rkit-product-text-desc-wpg-pro, {{WRAPPER}} .rkit-product-text-desc-wpg-prem',

            ]
        );

        $this->add_control(
            'desc_color_wpg',
            [
                'label' => esc_html__('Desc Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-text-desc-wpg-pro, {{WRAPPER}} .rkit-product-text-desc-wpg-prem ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('title_tab_hover', ['label' => esc_html('Hover')]);
        $this->add_control(
            'title_color_wpg_hover',
            [
                'label' => esc_html__('Title Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-title-wpg:hover, {{WRAPPER}} .rkit-product-title-wpg-pro:hover, {{WRAPPER}} .rkit-product-title-wpg-prem:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography_wpg_hover',
                'label' => esc_html__('Desc Typography', 'rometheme-for-elementor'),

                'selector' => '{{WRAPPER}} .rkit-product-text-desc-wpg-pro:hover, {{WRAPPER}} .rkit-product-text-desc-wpg-prem:hover',

            ]
        );

        $this->add_control(
            'desc_color_wpg_hover',
            [
                'label' => esc_html__('Desc Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-text-desc-wpg-pro:hover, {{WRAPPER}} .rkit-product-text-desc-wpg-prem:hover ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        //section category style
        $this->start_controls_section('category_text_style_wpg', [
            'label' => esc_html__('Category', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'option_style!' => ['-pro', '-prem'],
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography_wpg',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-product-category-wpg, {{WRAPPER}} .rkit-product-category-wpg-pro, {{WRAPPER}} .rkit-product-category-wpg-prem',
                'condition' => [
                    'option_style!' => ['-pro', '-prem'],
                ],
            ]
        );

        $this->add_control(
            'category_color_wpg',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-category-wpg a, {{WRAPPER}} .rkit-product-category-wpg-pro a, {{WRAPPER}} .rkit-product-category-wpg-prem a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'option_style!' => ['-pro', '-prem'],
                ],
            ]
        );

        $this->end_controls_section();



        // price regular
        $this->start_controls_section('price_text_style_wpg', [
            'label' => esc_html__('Price', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control(
            'divider_list_title_price_wpg',
            [
                'label' => esc_html__('Sale Price Reguler', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography_wpg',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),

                'selector' => '{{WRAPPER}} .rkit-product-price-reguler-wpg span, {{WRAPPER}} .rkit-product-price-reguler-wpg-pro span, {{WRAPPER}} .rkit-product-price-reguler-wpg-prem span',

            ]
        );

        $this->add_control(
            'price_color_wpg',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-price-reguler-wpg span, {{WRAPPER}} .rkit-product-price-reguler-wpg-pro span, {{WRAPPER}} .rkit-product-price-reguler-wpg-prem span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_list_title_sale_price_wpg',
            [
                'label' => esc_html__('Sale Price', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // sale price
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sale_price_typography_wpg',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),

                'selector' => '{{WRAPPER}} .rkit-product-sale-price-wpg, {{WRAPPER}} .rkit-product-sale-price-wpg-pro, {{WRAPPER}} .rkit-product-sale-price-wpg-prem',

            ]
        );

        $this->add_control(
            'sale_price_color_wpg',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-sale-price-wpg, {{WRAPPER}} .rkit-product-sale-price-wpg-pro, {{WRAPPER}} .rkit-product-sale-price-wpg-prem' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'divider_list_title_sale_pricereguler_wpg',
            [
                'label' => esc_html__('Reguler Sale Price', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // sale price reguler
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sale_pricereguler_typography_wpg',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),

                'selector' => '{{WRAPPER}} .rkit-product-sale-price-reguler-wpg, {{WRAPPER}} .rkit-product-sale-price-reguler-wpg-pro, {{WRAPPER}} .rkit-product-sale-price-reguler-wpg-prem',

            ]
        );

        $this->add_control(
            'sale_pricereguler_color_wpg',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-sale-price-reguler-wpg, {{WRAPPER}} .rkit-product-sale-price-reguler-wpg-pro, {{WRAPPER}} .rkit-product-sale-price-reguler-wpg-prem' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //section rating style
        $this->start_controls_section('rating_text_style_wpg', [
            'label' => esc_html__('Rating', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control(
            'rating_size_wpg',
            [
                'label' => esc_html__('Rating Size', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .star-rating-wpg ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rating_color_wpg',
            [
                'label' => esc_html__('Rating Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating-wpg span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'no_rating_color_wpg',
            [
                'label' => esc_html__('No Rating Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .star-rating-wpg' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section for Button
        $this->start_controls_section('button_style_section', [
            'label' => esc_html__('Button', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .rkit-addcart-button-wpg,  {{WRAPPER}} .rkit-addcart-button-wpg-prem',
            ]
        );

        $this->add_responsive_control(
            'icon_size_wpg',
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-icon-readmore ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_button_icon_wgp' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_content_align',
            [
                'label' => esc_html__('Content Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    ' {{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .rkit-addcart-button-wpg,  {{WRAPPER}} .rkit-addcart-button-wpg-prem' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'center',
                'condition' => [
                    'option_style' => ['-pro'],
                ]
            ]
        );

        $this->add_control(
            'gradient_color_one',
            [
                'label' => __('Border Gradient Color 1', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00cea6',
                'selectors' => [
                    '{{WRAPPER}} .gradient-border' => '--gradient-color-one: {{VALUE}};',
                ],
                'condition' => [
                    'option_style' => ['-pro'],
                ]
            ]
        );

        // Kontrol warna kedua
        $this->add_control(
            'gradient_color_two',
            [
                'label' => __('Border Gradient Color 2', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#535353',
                'selectors' => [
                    '{{WRAPPER}} .gradient-border' => '--gradient-color-two: {{VALUE}};',
                ],
                'condition' => [
                    'option_style' => ['-pro'],
                ]
            ]
        );

        $this->add_control(
            'more_options_icon_button_back',
            [
                'label' => esc_html__('Button Container Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );



        $this->add_responsive_control(
            'button_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 2,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    ' {{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .rkit-addcart-button-wpg, {{WRAPPER}} .rkit-addcart-button-wpg-prem' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_button_icon_wgp' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Section Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .gradient-border, {{WRAPPER}} .rkit-addcart-button-wpg,  {{WRAPPER}} .rkit-addcart-button-wpg-prem' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'textdomain'),
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
                    ' {{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .gradient-border, {{WRAPPER}} .rkit-addcart-button-wpg,  {{WRAPPER}} .rkit-addcart-button-wpg-prem' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // /wkwkwkw
        $this->start_controls_tabs('button_tab');

        $this->start_controls_tab('button_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('button_text_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .rkit-addcart-button-wpg, {{WRAPPER}} .rkit-addcart-button-wpg-prem' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'border_bottom_btn_background_normall',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-addcart-button-wpg span::after ',
                'condition' => [
                    'option_style' => [''],
                ],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html('Line Button Color')
                    ]
                ],

            ]
        );


        $this->add_control(
            'button_border_radius_normal',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .gradient-border, {{WRAPPER}} .rkit-addcart-button-wpg,  {{WRAPPER}} .rkit-addcart-button-wpg-prem' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('button_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-icon-readmore' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .rkit-addcart-button-wpg, {{WRAPPER}} .rkit-addcart-button-wpg-prem',
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
                'name' => 'btn_background_normall',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-addcart-button-wpg-pro, {{WRAPPER}} .rkit-addcart-button-wpg, {{WRAPPER}} .rkit-addcart-button-wpg-prem',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('button_text_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a.rkit-addcart-button-wpg-pro:hover, 
        {{WRAPPER}} a.rkit-addcart-button-wpg-prem:hover, 
        {{WRAPPER}} a.rkit-addcart-button-wpg:hover ' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'border_bottom_btn_background_nhover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-addcart-button-wpg:hover span::after ',
                'condition' => [
                    'option_style' => [''],
                ],
                'fields_options' => [
                    'background' => [
                        'label' => esc_html('Line Button Color')
                    ]
                ],
            ]
        );

        $this->add_control(
            'button_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [

                    '{{WRAPPER}} .rkit-addcart-wrap-button-wpg-pro:hover , 
             {{WRAPPER}} .rkit-addcart-button-wpg:hover,
             {{WRAPPER}} .rkit-addcart-button-wpg-prem:hover
             ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control('button_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a:hover .rkit-icon-readmore ' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_hover',
                'selector' => '{{WRAPPER}}.rkit-addcart-button-wpg-pro a:hover,
        {{WRAPPER}} a .rkit-addcart-button-wpg-prem :hover,
         {{WRAPPER}} .rkit-addcart-button-wpg a:hover',
            ]
        );

        $this->add_control(
            'btn_bg_options_hover',
            [
                'label' => esc_html__('Button Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => ' {{WRAPPER}} a.rkit-addcart-button-wpg-prem:hover, {{WRAPPER}} a.rkit-addcart-button-wpg-pro:hover , {{WRAPPER}} a.rkit-addcart-button-wpg:hover
        
        
        ',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();



        //ribbon
        $this->start_controls_section(
            'ribbon_style_section_wpg',
            [
                'label' => __(' Ribbon Style', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ribbon_typography_wpg',
                'label' => __('Typography', 'plugin-name'),
                'selector' => '{{WRAPPER}} .rkit-product-ribbon-wpg,{{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem',
            ]
        );

        $this->add_control(
            'ribbon_text_color_wpg',
            [
                'label' => __('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'more_options_rib_wpg',
            [
                'label' => esc_html__('Background Ribbon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'ribbom_backgroud_wpg',
                'label' => esc_html__('Ribbon Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ribbon_border_wpg',
                'label' => esc_html__('Border  ', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem',
            ]
        );

        $this->add_control(
            'ribbon_radius_wpg',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ribbon_box_shadow_wpg',
                'label' => __('Box Shadow', 'plugin-name'),
                'selector' => '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem',
            ]
        );


        $this->add_control(
            'ribbon_position',
            [
                'label' => esc_html__('Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-start',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => '{{VALUE}}: 0;',
                ],
            ]
        );


        $this->add_responsive_control(
            'ribbon_vertical_distance_wpg',
            [
                'label' => esc_html__('Vertical Distance', 'textdomain'),
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
                    '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ribbon_horizontal_distance_wpg_left',
            [
                'label' => esc_html__('Horizontal Distance', 'textdomain'),
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
                    '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ribbon_position' => 'left',
                ]
            ]
        );

        $this->add_responsive_control(
            'ribbon_horizontal_distance_wpg_right',
            [
                'label' => esc_html__('Horizontal Distance', 'textdomain'),
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
                    '{{WRAPPER}} .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ribbon_position' => 'right',
                ]
            ]
        );

        $this->add_control(
            'ribbon_padding_wpg',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}}  .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ribbon_margin_wpg',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}}  .rkit-product-ribbon-wpg, {{WRAPPER}} .rkit-product-ribbon-wpg-pro, {{WRAPPER}} .rkit-product-ribbon-wpg-prem' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );




        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $product_count = $settings['product_count'];
        add_filter('woocommerce_product_get_rating_html', [$this, 'custom_rating_html'], 10, 3);


        switch ($settings['title_wpg_tag']) {
            case 'h1':
                $wpg_tag = 'h1';
                break;
            case 'h2':
                $wpg_tag = 'h2';
                break;
            case 'h3':
                $wpg_tag = 'h3';
                break;
            case 'h4':
                $wpg_tag = 'h4';
                break;
            case 'h5':
                $wpg_tag = 'h5';
                break;
            case 'h6':
                $wpg_tag = 'h6';
                break;
            default:
                $wpg_tag = 'h3';
                break;
        }

        $args = [
            'post_type' => 'product',
            'posts_per_page' => $product_count,
            'order' => $settings['order_wpg'],
            'orderby' => $settings['order_by_wpg'],
            'tax_query' => [],
        ];

        // Tambahkan kategori jika dipilih
        if (!empty($settings['product_categories'])) {
            $args['tax_query'][] = [
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $settings['product_categories'],
            ];
        }

        $products = new \WP_Query($args);

?>
        <div class="rkit-product-grid-wpg<?php echo esc_attr($settings['option_style']); ?>">
            <?php if ($products->have_posts()) {
                while ($products->have_posts()) {
                    $products->the_post();
                    global $product;

                    $content_descripsonription_wpc =  $product->get_description();
                    $content_descripson_wpc =  esc_html__((empty($settings['truncate-content'])) ? wp_strip_all_tags($content_descripsonription_wpc) : wp_trim_words(wp_strip_all_tags($content_descripsonription_wpc), $settings['truncate-content']), 'rometheme-for-elementor');
                    $average = $product->get_average_rating();
            ?>
                    <div class="rkit-product-card-wpg<?php echo esc_attr($settings['option_style']); ?>">
                        <a href="<?php the_permalink(); ?>">
                            <div class="rkit-product-image-wpg<?php echo esc_attr($settings['option_style']); ?>">

                                <?php
                                if ($settings['show_sale'] == 'yes') {
                                    if ($product->is_on_sale()) {  ?>
                                        <div class="rkit-product-ribbon-wpg<?php echo esc_attr($settings['option_style']); ?>">Sale</div>
                                <?php }
                                } ?>
                                <?php echo woocommerce_get_product_thumbnail(); ?>
                                <?php if ($settings['option_style'] == '') { ?>
                                    <div class="rkit-addcart-wrap-button-wpg">
                                        <a class="rkit-addcart-button-wpg" href="<?php the_permalink() ?>">
                                            <?php if ('before' === $settings['button_icon_position_wgp']) {
                                                \Elementor\Icons_Manager::render_icon($settings['button_icon_wgp'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                            } ?>
                                            <span> <?php echo esc_html__($settings['button_text_wgp'], 'rometheme-for-elementor') ?> </span>
                                            <?php if ('after' === $settings['button_icon_position_wgp']) {
                                                \Elementor\Icons_Manager::render_icon($settings['button_icon_wgp'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                            } ?>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </a>
                        <div class="rkit-product-details-wpg<?php echo esc_attr($settings['option_style']); ?>">
                            <div class="rkit-product-info-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                <<?php echo esc_html($wpg_tag) ?> class="rkit-product-title-wpg<?php echo esc_attr($settings['option_style']); ?>"><?php the_title(); ?> </<?php echo esc_html($wpg_tag) ?>>
                                <?php
                                if ($settings['show_rating'] == 'yes') {
                                    if ($settings['option_style'] == '-prem') { ?>
                                        <div class="rkit-product-rating-wpg">
                                            <div class="star-rating-wpg">
                                                <?php if ($average > 0) : ?>
                                                    <span style="width: <?php echo ($average / 5) * 100; ?>%;">★★★★★</span>
                                                <?php endif; ?>
                                                ★★★★★
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                                <?php
                                if ($settings['show_category'] == 'yes') {
                                    if ($settings['option_style'] == '') { ?>
                                        <p class="rkit-product-category-wpg<?php echo esc_attr($settings['option_style']); ?>"><?php echo  wc_get_product_category_list($product->get_id()); ?></p>

                                <?php }
                                } ?>
                            </div>
                            <div class="rkit-product-feat-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                <?php if ($product->is_on_sale()) {  ?>
                                    <div class="if-sale-price-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                        <span class="rkit-product-sale-price-reguler-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                            <?php echo wc_price($product->get_regular_price())  ?>
                                        </span>
                                        <span class="rkit-product-sale-price-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                            <?php echo wc_price($product->get_sale_price())  ?>
                                        </span>
                                    </div>
                                <?php } else { ?>
                                    <span class="rkit-product-price-reguler-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                        <?php echo wc_price($product->get_price())  ?>
                                    </span>
                                <?php } ?>
                                <?php
                                if ($settings['show_rating'] == 'yes') {
                                    if ($settings['option_style'] != '-prem') { ?>
                                        <div class="rkit-product-rating-wpg">
                                            <div class="star-rating-wpg">
                                                <?php if ($average > 0) : ?>
                                                    <span style="width: <?php echo ($average / 5) * 100; ?>%;">★★★★★</span>
                                                <?php endif; ?>
                                                ★★★★★
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>

                        </div>



                        <?php if ($settings['option_style'] == '-pro') { ?>
                            <div class="rkit-product-desc-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                <span class="rkit-product-text-desc-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                    <?php echo   $content_descripson_wpc; ?>
                                </span>
                            </div>
                            <div class="rkit-addcart-wrap-button-wpg-all<?php echo esc_attr($settings['option_style']); ?>">
                                <div class="rkit-addcart-wrap-button-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                    <div class="gradient-border"></div>
                                    <a class="rkit-addcart-button-wpg<?php echo esc_attr($settings['option_style']); ?>" href="<?php the_permalink() ?>">
                                        <?php if ('before' === $settings['button_icon_position_wgp']) {
                                            \Elementor\Icons_Manager::render_icon($settings['button_icon_wgp'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                        } ?>
                                        <span> <?php echo esc_html__($settings['button_text_wgp'], 'rometheme-for-elementor') ?> </span>
                                        <?php if ('after' === $settings['button_icon_position_wgp']) {
                                            \Elementor\Icons_Manager::render_icon($settings['button_icon_wgp'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                        } ?>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>


                        <?php if ($settings['option_style'] == '-prem') { ?>
                            <div class="rkit-product-hov-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                <div class="rkit-product-desc-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                    <span class="rkit-product-text-desc-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                        <?php echo   $content_descripson_wpc; ?>
                                    </span>
                                </div>
                                <div class="rkit-addcart-wrap-button-wpg<?php echo esc_attr($settings['option_style']); ?>">
                                    <a class="rkit-addcart-button-wpg<?php echo esc_attr($settings['option_style']); ?>" href="<?php the_permalink() ?>">
                                        <?php if ('before' === $settings['button_icon_position_wgp']) {
                                            \Elementor\Icons_Manager::render_icon($settings['button_icon_wgp'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                        } ?>
                                        <span> <?php echo esc_html__($settings['button_text_wgp'], 'rometheme-for-elementor') ?> </span>
                                        <?php if ('after' === $settings['button_icon_position_wgp']) {
                                            \Elementor\Icons_Manager::render_icon($settings['button_icon_wgp'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                        } ?>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>





                <?php
                }
                ?>
        </div>
<?php 
            } else {
                echo __('No products found', 'plugin-name');
            }

            wp_reset_postdata();
            remove_filter('woocommerce_product_get_rating_html', [$this, 'custom_rating_html'], 10);
        }
    }
