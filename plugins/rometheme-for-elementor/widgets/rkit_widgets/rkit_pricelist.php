<?php
class Rkit_pricelist extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'rkit-pricelisttable';
    }

    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['pricetable']['name'];
        
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['pricetable']['icon'];
        return $icon;
    }


    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_style_depends()
    {
        return ['rkit-pricelisttable-style'];
    }
    public function get_keywords() 
    {
        return ['pricelisttable', 'time', 'rometheme'];
    }

    public function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/pricing-table/';
    }
    protected function register_controls()
    {


        //description TEST
        //content 
        $this->start_controls_section('content_section_new', [
            'label' => esc_html__('Header'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        // Nested repeater for description items


        $this->add_control(
            'card_title',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Type your title here', 'rometheme-for-elementor'),
                'default' => 'Basic',

            ]
        );

        $this->add_control('html_tag_pricelisttable', [
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
            'card_subheading',
            [
                'label' => esc_html__('Sub Heading', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your Sub Heading here', 'rometheme-for-elementor'),
                'default' => 'Sub Heading',

            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'show_sale_price',
            [
                'label' => esc_html__('Show Sale Price', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'currency_icon',
            [
                'label' => __('Select Currency', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '$',
                'options' => [
                    '$' => __('$ - USD', 'rometheme-for-elementor'),
                    '€' => __('€ - EUR', 'rometheme-for-elementor'),
                    '¥' => __('¥ - JPY', 'rometheme-for-elementor'),
                    '¢' => __('¢ - CENT', 'rometheme-for-elementor'),
                    '₹' => __('₹ - INDIA', 'rometheme-for-elementor'),
                    '₽' => __('₽ - RUS', 'rometheme-for-elementor'),
                    '¥' => __('¥ - CNY', 'rometheme-for-elementor'),
                    '₠' => __('₠ - EUR', 'rometheme-for-elementor'),
                    '₣' => __('₣ - FRANC', 'rometheme-for-elementor'),
                    '₤' => __('₤ - LIRA', 'rometheme-for-elementor'),
                    '₥' => __('₥ - Mill', 'rometheme-for-elementor'),
                    '₱' => __('₱ - PESO', 'rometheme-for-elementor'),
                    '₩' => __('₩ - WON', 'rometheme-for-elementor'),
                    '฿' => __('฿ - BATH', 'rometheme-for-elementor'),
                    '﷼' => __('﷼ - Saudi Arabian', 'rometheme-for-elementor'),
                    'Rp' => __('Rp - IDR', 'rometheme-for-elementor'),
                    'costum' => __('Custum Currency', 'rometheme-for-elementor'),
                    // Tambahkan lebih banyak mata uang sesuai kebutuhan...
                ],

            ]
        );
        $this->add_control(
            'costum_currency',
            [
                'label' => esc_html__('Currency', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Currency', 'rometheme-for-elementor'),
                'condition' => [
                    'show_sale_price' => 'yes',
                    'currency_icon' => 'costum',
                ]
            ]
        );


        $this->add_control(
            'card_price',
            [
                'label' => esc_html__('Price', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your Price here', 'rometheme-for-elementor'),
                'default' => '26',
            ]
        );

        $this->add_control(
            'card_price_sale',
            [
                'label' => esc_html__('Sale Price', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your Price here', 'rometheme-for-elementor'),
                'default' => '33',
                'condition' => [
                    'show_sale_price' => 'yes',
                ]
            ],

        );

        $this->add_control(
            'currency_potition',
            [
                'label' => esc_html__('Sale Price Potition', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'column' => esc_html__('Top', 'rometheme-for-elementor'),
                    'row'  => esc_html__('inline', 'rometheme-for-elementor'),
                ],
                'default' => 'row',
                'condition' => [
                    'show_sale_price' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-container' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_sub_title',
            [
                'label' => esc_html__('Period', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your subtitle here', 'rometheme-for-elementor'),
                'default' => '/Month',
            ]
        );

        $this->add_control(
            'period_potition',
            [
                'label' => esc_html__('Period Potition', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'center' => esc_html__('Center', 'rometheme-for-elementor'),
                    'bottom'  => esc_html__('Bottom', 'rometheme-for-elementor'),
                ],
                'default' => 'center',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section('content_descs_new', [
            'label' => esc_html__('Feature'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);


        $description_repeater = new \Elementor\Repeater();

        $this->add_control(
            'more_options_desc',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $description_repeater->add_control(
            'description_item',
            [
                'label' => esc_html__('Description Item', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Type your description item here', 'rometheme-for-elementor'),
            ]
        );

        $description_repeater->add_control(
            'description_icon',
            [
                'label' => esc_html__('Description Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'rtmicon rtmicon-check', 
                    'library' => 'rtmicons',
                ],
            ]
        );

        $this->add_control(
            'description_list',
            [
                'label' => esc_html__('Description List', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $description_repeater->get_controls(),
                'default' => [
                    ['description_item' => esc_html__('Description Item #1.', 'rometheme-for-elementor')],
                    ['description_item' => esc_html__('Description Item #2 ', 'rometheme-for-elementor')],
                    ['description_item' => esc_html__('Description Item #3 ', 'rometheme-for-elementor')],
                    ['description_item' => esc_html__('Description Item #4 ', 'rometheme-for-elementor')],



                ],
                'desc_field' => '{{{ description_item }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_button_new', [
            'label' => esc_html__('Button'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        // Add controls for link, and button
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
                    'value' => 'rtmicon rtmicon-shopping-cart',
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

        $this->add_control('button_position', [
            'label' => esc_html('Button Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'top' => esc_html('Top'),
                'bottom' => esc_html('Bottom')
            ],
            'default' => 'bottom',
        ]);


       


        $this->add_control(
            'card_link_pt',
            [
                'label' => esc_html__('Link', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_rib_new', [
            'label' => esc_html__('Ribbon'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        //more
        $this->add_control(
            'more_options_ribbon',
            [
                'label' => esc_html__('Ribbon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'enable_badge',
            [
                'label' => esc_html__('Enable Ribbon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => __('Ribbon Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Best Seller', 'plugin-name'),
                'placeholder' => __('Enter badge text', 'plugin-name'),
                'condition' => [
                    'enable_badge' => 'yes'
                ]
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
                'condition' => [
                    'enable_badge' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_infob_new', [
            'label' => esc_html__('Footer'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'card_footer',
            [
                'label' => esc_html__('Footer', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your  Footer here', 'rometheme-for-elementor'),
                'default' => 'Expired in 30 Days',

            ]
        );

        $this->end_controls_section();

        // style =======================================================================================================


        // style --------------------------------------------------------------------------------------------

        $this->start_controls_section('Container_style_section', [
            'label' => esc_html__('Container', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);



        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => __('Container Box Shadow', 'plugin-name'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-container',
              'description' => esc_html__('Put 0 for no box shadow ', 'text-domain'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'con_border',
                'label' => esc_html__('Border Button', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-container',
            ]
        );

        $this->add_control(
            'con_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    // '{{WRAPPER}} .rkit-pricelisttable-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'con_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'cont_backgroud',
                'label' => esc_html__('Container Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-container'
                // 'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-description, {{WRAPPER}} .rkit-pricelisttable-item-price-section, {{WRAPPER}} .rkit-pricelisttable-item-footer, {{WRAPPER}} .rkit-pricelisttable-item-button ',

            ]
        );

        $this->end_controls_section();

        // Style Section for Header
        $this->start_controls_section('title_style_section', [
            'label' => esc_html__('Header', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);



        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-title',

            ]
        );
        $this->add_responsive_control(
            'title_align',
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-title' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'Header_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-title-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-pricelisttable-item-title-section' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'header_backgroud',
                'label' => esc_html__('Header Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-title-section',

            ]
        );
        $this->add_control(
            'divider title',
            [
                'label' => esc_html__('Subheading', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // Style Section for subheading


        $this->add_control(
            'subheading_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-sub-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-sub-heading',

            ]
        );

        $this->add_responsive_control(
            'subheading_align',
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-sub-heading' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );


        $this->end_controls_section();

        //style section sale price 
        $this->start_controls_section('sale_price', [
            'label' => esc_html__('Sale Price', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control(
            'saleprice_vertical',
            [
                'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .sale-price-container-inline ' => 'align-self: {{VALUE}};',
                ], 
                'condition' => [ 
                    'currency_potition' => 'row'
                ],
            ]
        );
    


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sale_price_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-sale-price',

            ]
        );
         

        $this->add_control(
            'sale_price_color',
            [
                'label' => esc_html__('Text  Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-sale-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'saleprice_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .price-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_section();

        //style section currency 
        $this->start_controls_section('currency_style_section', [
            'label' => esc_html__('Price', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,

        ]);

        $this->add_responsive_control(
            'currency_vertical',
            [
                'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'flex-start',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-currency' => 'align-self: {{VALUE}};',
                ], 
            ]
        );
    

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'label' => esc_html__('Currency Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-currency',
                'default' => [
                    'font_family' => 'verdana',
                    'font_size' => '30px',
                    'font_weight' => '500',
                    'text_transform' => 'uppercase',
                ],

            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label' => esc_html__('Text Currency Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-currency' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->add_control(
            'divider price',
            [
                'label' => esc_html__('Price', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // Style Section for price

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-price',
                'default' => [
                    'font_family' => 'verdana',
                    'font_size' => '41px',
                    'font_weight' => '500',
                    'text_transform' => 'uppercase',
                ],
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-price' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'price_backgroud',
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-price-section',
            ]
        );

        $this->add_responsive_control(
            'price_align',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-container' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'currency_potition' => 'column', 
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'price_align_all',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .price-container' => 'justify-content: {{VALUE}};',
                ], 
                'condition' => [
                    'currency_potition' => 'row', 
                ],
                'default' => 'center',
            ]
        );

        $this->add_control(
            'price_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-price-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'period_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .period-opsi' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'divider price 2',
            [
                'label' => esc_html__('Period', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        //style section sub title

        $this->add_responsive_control(
            'period_vertical',
            [
                'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'flex-end',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .period-option' => 'align-self: {{VALUE}};',
                ], 
            ]
        );
    

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-sub-title , {{WRAPPER}} .rkit-pricelisttable-item-sub-title-center',

            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-sub-title , {{WRAPPER}} .rkit-pricelisttable-item-sub-title-center' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_title_align',
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-sub-title' => 'text-align: {{VALUE}};',
                ],
                'condition' => [ 
                    'period_potition' => 'bottom',
                ],
                'default' => 'center',
            ]
        );

        $this->add_control(
            'sub_title_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-sub-title , {{WRAPPER}} .rkit-pricelisttable-item-sub-title-center' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section for Description
        $this->start_controls_section('description_style_section', [
            'label' => esc_html__('Feature', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);



        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-description' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'feat_backgroud',
                'label' => esc_html__('Feature Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-description ',

            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'), 
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-description',

            ]
        );

        $this->add_responsive_control(
            'description_content_position',
            [
                'label' => esc_html__('Content Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [ 
                    '{{WRAPPER}} .rkit-item-list-desc' => 'justify-content: {{VALUE}}; text-align: {{VALUE}};',
                ], 
            ]
        );

      

        $this->add_responsive_control(
            'feature_desc_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                
                'selectors' => [
                    '{{WRAPPER}} .rkit-item-list-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label' => esc_html__('Item Spacing', 'rometheme-for-elementor'),
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
                    'size' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-description' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'more_options_icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'feature_icon_vertical',
            [
                'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'flex-start',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .icon-list-feature-pt ' => 'align-self: {{VALUE}};',
                ],  
                'description' => esc_html__('This function if your text more than 1 row', 'text-domain'),
            ]
        );

        $this->add_control(
            'icon_color_feature',
            [
                'label' => esc_html__('icon Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000FF',
                'selectors' => [
                    '{{WRAPPER}} .icon-list-feature-pt' => 'color: {{VALUE}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'icon_feature_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-item-list-desc ' => 'gap: {{SIZE}}{{UNIT}};',
                ],   
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
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
                    '{{WRAPPER}} .icon-list-feature-pt ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'more_options_divider',
            [
                'label' => esc_html__('Divider', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'divider_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%','em','rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'divider-width',
            [
                'label' => esc_html__('Divider Weight', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .divider_desc ' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
      
        

        $this->add_responsive_control(
            'item_spacings',
            [
                'label' => esc_html__('List Gap', 'rometheme-for-elementor'),
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
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider_desc' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        
        $this->add_responsive_control(
            'divider-size',
            [
                'label' => esc_html__('Divider Width', 'rometheme-for-elementor'),
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
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .divider_desc ' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_bottom_color',
            [
                'label'     => __('Divider Color', 'rometheme-for-elementor'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '#bbb8b8',
                'selectors' => [
                    '{{WRAPPER}} .divider_desc' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_divider',
            [
                'label' => esc_html__('Show Divider', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'yes' => esc_html__('show', 'rometheme-for-elementor'),
                'no' => esc_html__('hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
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
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-button .rkit-pricelisttable-item-button-full , {{WRAPPER}} .button-element-price-table',
            ]
        );

      
        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Section Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%','em','rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%','em','rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-button, {{WRAPPER}} .rkit-pricelisttable-item-button-full' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label' => esc_html__('Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-button' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'center',
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

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'button_backgroud',
                'label' => esc_html__('Button Background', 'textdomain'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-button, {{WRAPPER}} .rkit-pricelisttable-item-button-full',

            ]
        );

        $this->add_responsive_control(
            'button-size-pt',
            [
                'label' => esc_html__('Size', 'rometheme-for-elementor'),
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
                    'size' => 50,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .button-element-price-table' => 'width: {{SIZE}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .rkit-pricelisttable-item-button .button-element-price-table' => 'gap: {{SIZE}}{{UNIT}};',
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
                '{{WRAPPER}} .rkit-pricelisttable-item-button, {{WRAPPER}} .rkit-pricelisttable-item-button-full, {{WRAPPER}} a' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border_normal',
                'label' => esc_html__('Border Button', 'textdomain'),
                'selector' => '  {{WRAPPER}} .button-element-price-table',
            ]
        );

        $this->add_control(
            'button_border_radius_normal',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%','em','rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .button-element-price-table ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('button_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .icon-list-button-pt' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal',
                'selector' => '{{WRAPPER}} .button-element-price-table, {{WRAPPER}} a',
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
                'selector' => '{{WRAPPER}} .button-element-price-table, {{WRAPPER}} a',
                'default' => '#FF00C6',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover', ['label' => esc_html('Hover')]);


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border_hover',
                'label' => esc_html__('Border Button', 'textdomain'),
                'selector' => '  {{WRAPPER}} .button-element-price-table:hover',
            ]
        );

        $this->add_control(
            'button_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%','em','rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .button-element-price-table:hover ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control('button_text_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-pricelisttable-item-button a:hover' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a:hover .icon-list-button-pt ' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-button a:hover',
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
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-button a:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();





      
        //wkwkwkw
        $this->start_controls_section(
            'ribbon_style_section',
            [
                'label' => __(' Ribbon Style', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ribbon_typography',
                'label' => __('Typography', 'plugin-name'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-ribbon__inner',
            ]
        );

        $this->add_control(
            'ribbon_text_color',
            [
                'label' => __('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-ribbon__inner' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'more_options_descmoocc',
            [
                'label' => esc_html__('Background Ribbon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ribbon_distance',
            [
                'label' => esc_html__('Distance', 'textdomain'),
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
                    '{{WRAPPER}} .rkit-pricelisttable-ribbon__inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg);',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'ribbom_backgroud',
                'label' => esc_html__('Ribbon Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-ribbon__inner',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ribbon_border',
                'label' => esc_html__('Border  ', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-ribbon__inner',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ribbon_box_shadow',
                'label' => __('Box Shadow', 'plugin-name'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-ribbon__inner',
            ]
        );

        $this->end_controls_section();

          // style for footer
          $this->start_controls_section('footer_style_section', [
            'label' => esc_html__('Footer', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'footer_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-footer',
                'default' => [
                    'font_family' => 'verdana',
                    'font_size' => '12px',
                    'font_weight' => '300',
                    'text_transform' => 'uppercase',
                ],
            ]
        );

        $this->add_responsive_control(
            'footer_align',
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
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-footer' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );


        $this->add_control(
            'footer_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-footer' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'footer_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-pricelisttable-item-footer ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),

            [
                'name' => 'footer_backgroud',
                'label' => esc_html__('Footer Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-pricelisttable-item-footer ',

            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $decodedString = $settings['currency_icon'];
        $item_link = (!empty($settings['card_link_pt']['url']) ? esc_url($settings['card_link_pt']['url']) : '#');
        $badge_classes = 'rkit-pricelisttable-item'; 

        switch ($settings['html_tag_pricelisttable']) {
            case 'h1':
                $html_tages = 'h1';
                break;
            case 'h2':
                $html_tages = 'h2';
                break;
            case 'h3':
                $html_tages = 'h3';
                break;
            case 'h4':
                $html_tages = 'h4';
                break;
            case 'h5':
                $html_tages = 'h5';
                break;
            case 'h6':
                $html_tages = 'h6';
                break;
            default:
                $html_tages = 'h1';
                break;
        }

        if ($settings['button_size_switch'] == 'yes') {
            $class_button = "button-full-size";
        } else {
            $class_button = "";
        }

        if ($settings['show_divider'] != 'yes') {
            $divider_show = "noline";
        } else {
            $divider_show = "";
        }

?>
        <div class="rkit-pricelisttable-container"> 
            <div class="<?php echo esc_attr($badge_classes) ?>">
                <?php if ($settings['enable_badge'] === 'yes') { ?>
                    <div class="rkit-pricelisttable-ribbon rkit-pricelisttable-ribbon__<?php echo esc_html($settings['ribbon_position']); ?>">
                        <div class="rkit-pricelisttable-ribbon__inner">
                            <?php echo esc_html($settings['badge_text']) ?>
                        </div>
                    </div>

                <?php } ?>
                <div class="rkit-pricelisttable-item-inner">
                    <div class="rkit-pricelisttable-item-title-section">
                        <?php if (!empty($settings['card_title'])) { ?>
                            <<?php echo esc_html($html_tages); ?> class="rkit-pricelisttable-item-title"><?php echo esc_html($settings['card_title']) ?> </<?php echo esc_html($html_tages); ?>>
                            <span class="rkit-pricelisttable-item-sub-heading"><?php echo esc_html($settings['card_subheading']) ?></span>
                        <?php  } ?>
                    </div>
                    <div class="rkit-pricelisttable-item-inner-price">
                        <div class="rkit-pricelisttable-item-price-section">
                            <?php if (!empty($settings['card_price'])) {  ?>
                                <div class="price-container">
                                    <?php if ($settings['show_sale_price'] == 'yes') {  ?>
                                        <div class="sale-price-container-inline">
                                            <?php if ($decodedString != 'costum') { ?>
                                                <p class="rkit-pricelisttable-item-sale-price"><?php echo esc_html($decodedString) ?></p>
                                            <?php } else { ?>
                                                <p class="rkit-pricelisttable-item-sale-price"><?php echo esc_html($settings['costum_currency']) ?></p>
                                            <?php } ?>
                                            <p class="rkit-pricelisttable-item-sale-price"><?php echo esc_html($settings['card_price_sale']) ?></p>
                                        </div>
                                    <?php } ?>

                                    <div class="sale-price-container-inline period-opsi">
                                        <?php if ($decodedString != 'costum') { ?>
                                            <div class="currency-option">
                                                <p class="rkit-pricelisttable-item-currency"><?php echo esc_html($decodedString) ?></p>
                                            <?php } else { ?>
                                                <p class="rkit-pricelisttable-item-currency"><?php echo esc_html($settings['costum_currency']) ?></p>
                                            <?php } ?>

                                            <p class="rkit-pricelisttable-item-price"><?php echo esc_html($settings['card_price']) ?></p>
                                            </div>
                                            <?php
                                            if ($settings['period_potition'] == 'center') {
                                                if (!empty($settings['card_sub_title'])) { ?>
                                                    <div class="period-option">
                                                        <p class="rkit-pricelisttable-item-sub-title-center"><?php echo esc_html($settings['card_sub_title']) ?></p>
                                                    </div>
                                            <?php   }
                                            }  ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if ($settings['period_potition'] == 'bottom') {
                                if (!empty($settings['card_sub_title'])) { ?>
                                    <div class="rkit-pricelisttable-item-sub-title"><?php echo esc_html($settings['card_sub_title']) ?></div>
                            <?php   }
                            }
                            ?>
                        </div>
                        <?php if ($settings['button_position'] == 'top') {
                            if (!empty($settings['button_text'])) {  ?>
                                <div class="rkit-pricelisttable-item-button <?php echo esc_html($class_button) ?>">
                                    <?php if ($settings['button_icon_position'] == "before") { ?>
                                        <a href="<?php echo esc_url($item_link); ?>" class=" button-element-price-table">
                                            <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-list-button-pt"]); ?>
                                            <?php echo esc_html($settings['button_text']) ?>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url($item_link); ?>" class=" button-element-price-table">
                                            <?php echo esc_html($settings['button_text']) ?>
                                            <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-list-button-pt"]); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                        <?php
                            }
                        } ?>
                        <?php if (!empty($settings['description_list'])) { ?>
                            <ul class="rkit-pricelisttable-item-description no-icon-hidden">
                                <?php foreach ($settings['description_list'] as $desc_item) { ?>
                                <div class="rkit-item-list-desc">  <?php \Elementor\Icons_Manager::render_icon($desc_item['description_icon'], ['aria-hidden' => 'true', 'class' => "icon-list-feature-pt"]) ?> 
                                         <?php echo  esc_html($desc_item['description_item']) ?>
                                </div> 
                                <li class="divider_desc <?php echo esc_html($divider_show) ?>"> </li>  
                                    <!-- cek -->
                                <?php   } ?>
                            </ul>
                        <?php } ?>
                        <?php if ($settings['button_position'] == 'bottom') {
                            if (!empty($settings['button_text'])) {  ?>
                                <div class="rkit-pricelisttable-item-button <?php echo esc_html($class_button) ?>">
                                    <?php if ($settings['button_icon_position'] == "before") { ?>
                                        <a href="<?php echo esc_url($item_link); ?>" class=" button-element-price-table">
                                            <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-list-button-pt"]); ?>
                                            <?php echo esc_html($settings['button_text']) ?>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo esc_url($item_link); ?>" class=" button-element-price-table">
                                            <?php echo esc_html($settings['button_text']) ?>
                                            <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-list-button-pt"]); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php  }
                        }
                        if (!empty($settings['card_footer'])) { ?>
                            <div class="rkit-pricelisttable-item-footer">
                                <span class="rkit-pricelisttable-item-footer"><?php echo esc_html($settings['card_footer']) ?></span>
                            </div>
                        <?php     } ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
<?php }
}
