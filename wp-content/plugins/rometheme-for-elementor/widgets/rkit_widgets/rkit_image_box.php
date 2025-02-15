<?php

class Rkit_image_box extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit_image_box';
    } 
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['imagebox']['name'];
        
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['imagebox']['icon'];
        return $icon;
    }
    public function get_keywords()
    {
        return ['rometheme', 'image', 'box','image-box', 'card image', ' image box'];
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
        return ['rkit-image_box-style'];
    }
    protected function register_controls()
    {
        $this->start_controls_section('imagebox_content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_responsive_control('select_style', [
            'label' => esc_html('Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'def-card' => esc_html('Style 1'), 
                'default' => esc_html('Style 2'), 
                'overlay' => esc_html('Style 3'), 
                'float-card' => esc_html('Style 4'),
            ],
            'default' => 'def-card'
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
    
            [
                'name' => 'cont_backgroud_overlay',
                'label' => esc_html__('Container Background', 'rometheme-for-elementor'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}}  .bg_overlay ',
                // 'selector' => '{{WRAPPER}} .rkit-pricelist-item-description, {{WRAPPER}} .rkit-pricelist-item-price-section, {{WRAPPER}} .rkit-pricelist-item-footer, {{WRAPPER}} .rkit-pricelist-item-button ',
                'condition' => [
                    'select_style' => 'overlay',
                ]
            ]
        );
  

        $this->add_control(
            'background_opacity',
            [
                'label' => __('Background Opacity', 'plugin-name'),
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
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bg_overlay' => 'opacity:  {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                     'select_style' => 'overlay',
                ]
            ]
        );

        $this->add_responsive_control(
            'imagebox_direction',
            [
                'label' => esc_html__('Direction', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__('Column', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-space-evenly-h',
                    ],
                    'row' => [
                        'title' => esc_html__('Row', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-space-evenly-v',
                    ],
                ],
                'default' => 'column',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-image_box-card' => 'flex-direction: {{VALUE}};',
                    // '{{WRAPPER}} .rkit-image_box__detail' => 'justify-content: center;',
                ],
                'condition' => [
                    'select_style' => 'default', 
                ]
            ]
        );

        $this->add_responsive_control(
            'desc_content_position',
            [
                'label' => esc_html__('Content Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image_box__detail' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'center',

                'condition' => [
                    'imagebox_direction' => 'row'
                ]
            ]
        );
    


        $this->add_responsive_control('image_position_column', [
            'label' => esc_html('Image Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '0' => esc_html('Top'), 
                '1' => esc_html('Bottom'),
            ],
            'default' => '0',
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box__img' => 'order: {{VALUE}};',
            ],
            'condition' => [
                'imagebox_direction' => 'column', 
                    'select_style' => 'default',  
            ]
        ]);

        $this->add_responsive_control('image_position_row', [
            'label' => esc_html('Image Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '0' => esc_html('Right'), 
                '1' => esc_html('Left'),
            ],
            'default' => '0',
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box__img' => 'order: {{VALUE}};',
            ],
            'condition' => [
                'select_style' => 'default',
                'imagebox_direction' => 'row',
            ]
        ]);

        $this->add_control(
            'imagebox_image',
            [
                'label' => esc_html__('Choose Image', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        
        $this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Hover Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                'default' => 'grow',
			]
		);


        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',  
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
            ]
        );


        $this->add_responsive_control('img-aspect-ratio-ib', [
            'label' => esc_html__('Image Aspect Ratio', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '1/1' => esc_html__('1 : 1', 'rometheme-for-elementor'),
                '3/2' => esc_html__('3 : 2', 'rometheme-for-elementor'),
                '5/4' => esc_html__('5 : 4', 'rometheme-for-elementor'),
                '16/9' => esc_html__('16 : 9', 'rometheme-for-elementor'),
                '9/16' => esc_html__('9 : 16', 'rometheme-for-elementor'),

            ],  
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box__img, {{WRAPPER}} .rkit-image_box__img img' => 'aspect-ratio:{{VALUE}}'
            ]
        ]);


        $this->add_responsive_control('image_box_title_tag', [
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
            'default' => 'h4'
        ]);

        $this->add_control(
            'imagebox_title',
            [
                'label' => esc_html__('imagebox Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Example Title', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type Title here', 'rometheme-for-elementor'),
            ]
        );

      

        $this->add_control(
            'imagebox_description',
            [
                'label' => esc_html__('imagebox Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your description here', 'rometheme-for-elementor'),
            ]
        );
        $this->add_control(
            'show_icon_container_top',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes', 
            ]
        );
    
    
        $this->add_control(
            'icon_container',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-badge-check',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                        'show_icon_container_top' => 'yes'
                    ]
            ]
        );

        // $this->add_responsive_control(
        //     'icon_position',
        //     [
        //         'label' => esc_html__('Icon Position', 'rometheme-for-elementor'),
        //         'type' => \Elementor\Controls_Manager::CHOOSE,
        //         'options' => [
        //             'start' => [
        //                 'title' => esc_html__('Top', 'rometheme-for-elementor'),
        //                 'icon' => 'eicon-v-align-top',
        //             ],
        //             'center' => [
        //                 'title' => esc_html__('Center', 'rometheme-for-elementor'),
        //                 'icon' => 'eicon-v-align-middle',
        //             ],
        //             'end' => [
        //                 'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
        //                 'icon' => 'eicon-v-align-bottom',
        //             ],
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .rkit-image_box__detail' => 'justify-content: {{VALUE}};',
        //         ],
        //         'default' => 'center',
        //         'condition' => [
        //             'imagebox_direction' => 'row'
        //         ]
        //     ]
        // );


        $this->end_controls_section();
    

    $this->start_controls_section('read-more-content',
     ['label' => esc_html__('Read More Button'), 
     'tab' => \Elementor\Controls_Manager::TAB_CONTENT
    ]);

    $this->add_control(
        'imagebox_show_button_readmore',
        [
            'label' => esc_html__('Show Button', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes', 
        ]
    );
    
    $this->add_responsive_control('button_position', [
        'label' => esc_html__('Button Position', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
                'top' => [
                    'title' => esc_html__('Top', 'rometheme-for-elementor'),
                    'icon' => 'eicon-arrow-up',
                ],
                'bottom' => [
                    'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                    'icon' => 'eicon-arrow-down',
                ],
            ],
        'default' => 'top',  
        'condition' => [
            'imagebox_show_button_readmore' => 'yes'
        ]
    ]);

 


    $this->add_control(
        'imagebox_readmore_text',
        [
            'label' => esc_html__('Label', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Read More', 'rometheme-for-elementor'),
            'placeholder' => esc_html__('Type your label button here', 'rometheme-for-elementor'),
            'condition' => [
                'button_position' => 'bottom'
            ]
        ]
    );
    $this->add_control(
        'ib_link',
        [
            'label' => esc_html__('Link', 'textdomain'),
            'type' => \Elementor\Controls_Manager::URL,
            'options' => ['url', 'is_external', 'nofollow'],
            'label_block' => true,
            'condition' => [
                'imagebox_show_button_readmore' => 'yes'
            ] 
        ]
    );
    $this->add_control(
        'imagebox_show_icon_readmore',
        [
            'label' => esc_html__('Add Icon ?', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes', 
            'condition' => [
                'imagebox_show_button_readmore' => 'yes'
            ] 
        ]
    );
 
    $this->add_control(
        'imagebox_icon_readmore',
        [
            'label' => esc_html__('Icon sss', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'rtmicon rtmicon-arrow-right',
                'library' => 'rtmicons',
            ],
            'condition' => [
                'imagebox_show_icon_readmore' => 'yes',
                'imagebox_show_button_readmore' => 'yes'
            ]
        ]
    );

    $this->add_control('imagebox_icon_position', [
        'label' => esc_html__('Icon Position', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
                'row' => [
                    'title' => esc_html__('Left', 'rometheme-for-elementor'),
                    'icon' => 'eicon-arrow-left',
                ],
                'row-reverse' => [
                    'title' => esc_html__('Right', 'rometheme-for-elementor'),
                    'icon' => 'eicon-arrow-right',
                ],
            ],
        'default' => 'row-reverse',
        'condition' => [
            'imagebox_show_icon_readmore' => 'yes',
                'button_position' => 'bottom' ,
        ],
        'selectors' => [
                '{{WRAPPER}} a.rkit-readmore-imagebox-btn' => 'flex-direction: {{VALUE}};',
            ],
    ]);

    $this->add_responsive_control(
        'imagebox_btn_align',
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
                '{{WRAPPER}} .rkit-readmore-imagebox-div' => 'justify-content: {{VALUE}};',
            ],
            'condition' => [
                'button_position' => 'bottom',
                'imagebox_show_button_readmore' => 'yes'
            ]
        ]
    );

    $this->end_controls_section();

    // style =================================================================================================================================

    $this->start_controls_section('Container_style_section', [
        'label' => esc_html__('Container', 'rometheme-for-elementor'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);



    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'container_box_shadow',
            'label' => __('Container Box Shadow', 'plugin-name'),
            'selector' => '{{WRAPPER}} .rkit-image_box-card',
        ]
    );

    
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'containe_imagebox_border',
            'label' => esc_html__('Border  ', 'textdomain'),
            'selector' => '{{WRAPPER}} .rkit-image_box-card',
            'condition' => [
                        'select_style!' => 'float-card', 
                    ]
        ]
);
 

    $this->add_responsive_control(
        'con_padding',
        [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'], 
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'con_radius',
        [
            'label' => esc_html__('Border Radius', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%','em','rem'], 
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),

        [
            'name' => 'cont_backgroud_wrapper',
            'label' => esc_html__('Container Background', 'rometheme-for-elementor'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-image_box-card'
            // 'selector' => '{{WRAPPER}} .rkit-pricelist-item-description, {{WRAPPER}} .rkit-pricelist-item-price-section, {{WRAPPER}} .rkit-pricelist-item-footer, {{WRAPPER}} .rkit-pricelist-item-button ',

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
                    'selector' => '{{WRAPPER}} .rkit-image_box__img img ',
                    'condition' => [
                        'select_style' => 'float-card', 
                    ]
                ]
    );
  
    
    $this->add_responsive_control(
        'padding',
        [
            'label' => esc_html__('Padding Image', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%','em','rem'], 
            'selectors' => [
                '{{WRAPPER}}  .rkit-image_box__img  ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->add_responsive_control(
        'border_radius',
        [
            'label' => esc_html__('Border Radius Image', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%','em','rem'], 
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box__img, {{WRAPPER}}  .rkit-image_box__img img, {{WRAPPER}} .rkit-image_box__overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
 
 

    $this->add_group_control(
        \Elementor\Group_Control_Css_Filter::get_type(),
        [
            'label' => esc_html__('Image Filter', 'textdomain'),
            'name' => 'image_filters',
            'selector' => '{{WRAPPER}} .rkit-image_box__img img ',
        ]
    );
    
    $this->end_controls_section();

    
    $this->start_controls_section('Desc_style_section', [
        'label' => esc_html__('Content', 'rometheme-for-elementor'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_typography',
            'label' => esc_html__('Title Typography', 'rometheme-for-elementor'),
            'selector' => '{{WRAPPER}} .rkit-image_box__title', 
        ]
    );

    $this->add_responsive_control('title_color', [
        'label' => esc_html__('Title Color', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-image_box__title' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_responsive_control(
        'default_align',
        [
            'label' => esc_html__('Title Alignment', 'rometheme-for-elementor'),
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
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box__title ' => 'text-align: {{VALUE}}; justify-content: {{VALUE}}; align-items: {{VALUE}} ',
            ],
            'default' => 'center',
            
        ]
    );

    $this->add_responsive_control(
        'margin_title',
        [
            'label' => esc_html__('Margin', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'], 
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

// desc

$this->add_control(
    'divider_desc',
    [
        'label' => esc_html__('Description', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before', 
    ]
);
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'desc_typography',
            'label' => esc_html__('Typography', 'rometheme-for-elementor'),
            'selector' => '{{WRAPPER}} .rkit-image_box__description', 
        ]
    );

    $this->add_control('desc_color', [
        'label' => esc_html__('Color', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-image_box__description' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_responsive_control(
        'description_content_align',
        [
            'label' => esc_html__('Desc Alignment', 'rometheme-for-elementor'),
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
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box__description ' => 'text-align: {{VALUE}}; justify-content: {{VALUE}}; align-items: {{VALUE}} ', 
            ],
            'default' => 'center', 
        ]
    );

   

  

    $this->add_responsive_control(
        'desc_content_spacing',
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
                '{{WRAPPER}} .rkit-image_box__detail, {{WRAPPER}} .image-box-item-desc ' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]
    );


    $this->add_responsive_control(
        'desc_con_paddingdet',
        [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'], 
            'selectors' => [
                '{{WRAPPER}} .rkit-image_box_det' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
 
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),

        [
            'name' => 'desc_cont_backgroud',
            'label' => esc_html__('Container Background', 'rometheme-for-elementor'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-image_box__detail',
             'fields_options' => [
                    'background' => [
                        'label' => esc_html('Background Color')
                    ]
                    ],
            'condition' => [
                    'select_style!' => 'float-card', 
                ]
        ]
    );


    

    // float container
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),

        [
            'name' => 'defdesc_cont_backgroud_def',
            'label' => esc_html__('Container Background', 'rometheme-for-elementor'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .float-detail ',
            'fields_options' => [
                    'background' => [
                        'label' => esc_html('Background Color')
                    ]
                    ],
            'condition' => [
                    'select_style' => 'float-card', 
                ]
             
        ]
    );

    $this->add_control(
        'floating_card',
        [
            'label' => esc_html__('Container Float', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'select-style' => 'float-card'
            ]
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'desc_container_box_shadow',
            'label' => __('Container Box Shadow', 'plugin-name'),
            'selector' => '{{WRAPPER}} .float-detail ',
            'condition' => [
                    'select_style' => 'float-card', 
                ]
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'desc_con_border',
            'label' => esc_html__('Border Button', 'rometheme-for-elementor'),
            'selector' => '{{WRAPPER}} .float-detail ',
            'condition' => [
                    'select_style' => 'float-card', 
                ]
        ]
    );

    $this->add_responsive_control(
        'desc_con_padding',
        [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'], 
            'selectors' => [
                '{{WRAPPER}} .float-detail ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                    'select_style' => 'float-card', 
                ]
        ]
    );

    $this->add_responsive_control(
        'desc_con_radius',
        [
            'label' => esc_html__('Border Radius', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%','em','rem'], 
            'selectors' => [
                '{{WRAPPER}} .float-detail ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                    'select_style' => 'float-card', 
                ]
        ]
    );



    $this->add_control(
        'deffloating_card',
        [
            'label' => esc_html__('Container Center', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'select_style' => 'def-card', 
            ]
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'defdesc_container_box_shadow',
            'label' => __('Container Box Shadow', 'plugin-name'),
            'selector' => '{{WRAPPER}} .def-detail ',
            'condition' => [
                    'select_style' => 'def-card', 
                ]
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'defdesc_con_border',
            'label' => esc_html__('Border Button', 'rometheme-for-elementor'),
            'selector' => '{{WRAPPER}} .def-detail ',
            'condition' => [
                    'select_style' => 'def-card', 
                ]
        ]
    );

    $this->add_responsive_control(
        'defdesc_con_padding',
        [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'], 
            'selectors' => [
                '{{WRAPPER}} .def-detail ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                    'select_style' => 'def-card', 
                ]
        ]
    );

    $this->add_responsive_control(
        'defdesc_con_radius',
        [
            'label' => esc_html__('Border Radius', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%','em','rem'], 
            'selectors' => [
                '{{WRAPPER}} .def-detail ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                    'select_style' => 'def-card', 
                ]
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),

        [
            'name' => 'defdesc_cont_backgroud_float',
            'label' => esc_html__('Container Background', 'rometheme-for-elementor'),
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .def-detail ',
            'condition' => [
                    'select_style' => 'def-card', 
                ]
             
        ]
    );


    // icon

    $this->add_control(
        'divider_icon',
        [
            'label' => esc_html__('Icon', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before', 
            'condition' => [
                'show_icon_container_top' => 'yes'
            ]
        ]
    );


    $this->add_responsive_control(
        'icon_desc_size',
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
                '{{WRAPPER}} .rkit-icon-top ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],  
            'condition' => [
                'show_icon_container_top' => 'yes'
            ]
        ]
    );

    $this->add_control(
        'icon_desc_color',
        [
            'label' => esc_html__('Desc icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#000000FF',
            'selectors' => [
                '{{WRAPPER}} .rkit-icon-top' => ' color: {{VALUE}}; fill: {{VALUE}};',
            ],
            'condition' => [
                'show_icon_container_top' => 'yes'
            ]
            
        ]
    );

    $this->add_responsive_control(
        'icon_align',
        [
            'label' => esc_html__('Icon Alignment', 'rometheme-for-elementor'),
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
                '{{WRAPPER}} .left ' => 'text-align: {{VALUE}}; width : 100%',
            ],
            'default' => 'center',
            'condition' => [
                'show_icon_container_top' => 'yes',
                'button_position' => 'bottom',
            ]
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section('button_style', ['label' => esc_html__('Button', 'rometheme-for-elementor'), 
    'condition' => [
        'button_position' => 'bottom'
    ],'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'readmore_button_typography',
            'selector' => '{{WRAPPER}} .rkit-readmore-imagebox-btn',
        ]
    );
    $this->add_responsive_control('button_padding', [
        'label' => esc_html__('Padding', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem'],
        'selectors' => [
            '{{WRAPPER}} .rkit-readmore-imagebox-btn' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
        ]
    ]);
    $this->add_responsive_control('button_border_radius', [
        'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem'],
        'selectors' => [
            '{{WRAPPER}} .rkit-readmore-imagebox-btn' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
        ]
    ]);

    $this->add_responsive_control(
        'icon_spacing',
        [
            'label' => esc_html__( 'Icon Spacing    ', 'textdomain' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                '{{WRAPPER}} a.rkit-readmore-imagebox-btn' => 'gap: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'show_icon_readmore' => 'yes'
            ]
        ]
    );

    $this->add_responsive_control(
        'icon_rm_s',
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
                '{{WRAPPER}} .rkit-icon-readmore-ib ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],  
        ]
    );

    $this->start_controls_tabs('button_tabs_normal');
    $this->start_controls_tab('button_tab_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
    $this->add_control('btn_text_color_normal', [
        'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-readmore-imagebox-btn' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'btn_background_normal',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-readmore-imagebox-btn',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border_readmore_btn_normal',
            'selector' => '{{WRAPPER}} .rkit-readmore-imagebox-btn',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_normal',
            'selector' => '{{WRAPPER}} .rkit-readmore-imagebox-btn',
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab('button_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
    $this->add_control('btn_text_color_hover', [
        'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-readmore-imagebox-btn:hover' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'btn_background_hover',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-readmore-imagebox-btn:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border_readmore_btn_hover',
            'selector' => '{{WRAPPER}} .rkit-readmore-imagebox-btn:hover',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_hover',
            'selector' => '{{WRAPPER}} .rkit-readmore-imagebox-btn:hover',
        ]
    );
    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->end_controls_section();



    // button top 
    $this->start_controls_section('button_style_top', 
    [
    'label' => esc_html__('Button', 'rometheme-for-elementor'),
    'condition' => [
        'button_position' => 'top'
    ], 
    'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'readmore_button_typography_top',
            'selector' => '{{WRAPPER}} .rkit-button-top',
        ]
    );
    $this->add_responsive_control('button_padding_top', [
        'label' => esc_html__('Padding', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem'],
        'selectors' => [
            '{{WRAPPER}} .rkit-button-top' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
        ]
    ]);
    $this->add_responsive_control('button_border_radius_top', [
        'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem'],
        'selectors' => [
            '{{WRAPPER}} .rkit-button-top' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
        ]
    ]);


    $this->add_responsive_control(
        'icon_rm_sss',
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
                '{{WRAPPER}}   .rkit-icon-readmore-ib ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],  
        ]
    );

    $this->add_responsive_control(
        'btn_rm_top',
        [
            'label' => esc_html__('Button Size', 'rometheme-for-elementor'),
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
                '{{WRAPPER}} .rkit-button-top ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],  
        ]
    );
 

    $this->start_controls_tabs('button_tabs');
    $this->start_controls_tab('button_tab_normal_top', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
    $this->add_control('btn_text_color_normal_top', [
        'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-button-top' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'btn_background_normal_top',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-button-top',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border_readmore_btn_normal_top',
            'selector' => '{{WRAPPER}} .rkit-button-top',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_normal_top',
            'selector' => '{{WRAPPER}} .rkit-button-top',
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab('button_tab_hover_top', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
    $this->add_control('btn_text_color_hover_top', [
        'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-button-top:hover' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'btn_background_hover_top',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-button-top:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border_readmore_btn_hover_top',
            'selector' => '{{WRAPPER}} .rkit-button-top:hover',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_hover_top',
            'selector' => '{{WRAPPER}} .rkit-button-top:hover',
        ]
    );
    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->end_controls_section();



}

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['ib_link']['url'])) {
            $this->add_link_attributes('ib_link_', $settings['ib_link']);
        }

        switch ($settings['image_box_title_tag']) {
            case 'h1':
                $name_tag = 'h1';
                break;
            case 'h2':
                $name_tag = 'h2';
                break;
            case 'h3':
                $name_tag = 'h3';
                break;
            case 'h4':
                $name_tag = 'h4';
                break;
            case 'h5':
                $name_tag = 'h5';
                break;
            case 'h6':
                $name_tag = 'h6';
                break;
            default:
                $name_tag = 'h1';
                break;
        }

        if($settings['select_style'] == 'overlay'){
            $flex = "rkit-direction";
            $background = "bg_overlay";
        }else{
            $flex = "";
            $background = "";
        }


        if($settings['select_style'] == 'float-card'){
            $wrapper_cont = "float-card";
            $wrapper_box = "float-detail";
            $wrapper_desc = " float-card-desc-ext";
        } elseif($settings['select_style'] == 'def-card'){
            $wrapper_cont = "def-card";
            $wrapper_box = "def-detail"; 
            $wrapper_desc = " def-card-desc-ext";
        }else{
            $wrapper_cont = "";
            $wrapper_box = "";
            $wrapper_desc = "";
        }
 
?>
        <div class="rkit-image_box rkit-image_box__<?php echo esc_html($settings['select_style'])?>  ">
            
            <div class="rkit-image_box-card">
                    <div class="rkit-image_box__img">
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'imagebox_image' ); ?>
                    </div> 
      

                
                <div class="rkit-image_box_det <?php echo esc_html($wrapper_cont ) ?>">
                    <div class="rkit-image_box__detail <?php echo esc_html($wrapper_box ) ?> <?php echo esc_html($flex ) ?>">

                    <div class="rkit-container-top">
                        <div class="left"> 
                            <?php
                                \Elementor\Icons_Manager::render_icon($settings['icon_container'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-top']);
                            ?>
                        </div>    
                           
                        <?php
                        if ($settings['imagebox_show_button_readmore'] == 'yes') :
                        if($settings['button_position'] == 'top') : ?>
                            <div class="right"> 
                                <a  <?php  $this->print_render_attribute_string('ib_link_') ?> class="rkit-button-top" type="button" >
                                    <?php
                                        \Elementor\Icons_Manager::render_icon($settings['imagebox_icon_readmore'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore-ib']);
                                    ?>
                                </a>
                            </div>
                        <?php 
                            endif;
                            endif; 
                        ?>
                
                    </div>
                        <<?php echo $name_tag ?> class="rkit-image_box__title"><?php echo esc_html($settings['imagebox_title']) ?></<?php echo esc_html($name_tag  ) ?>> 
                    <div class ="image-box-item-desc <?php echo esc_html($wrapper_desc ) ?> ">   
                        <span class="rkit-image_box__description"><?php echo esc_html($settings['imagebox_description']) ?></span>
                        <?php 
                        if ($settings['imagebox_show_button_readmore'] == 'yes') :
                        if($settings['button_position'] == 'bottom') : ?>
                            <div class="rkit-readmore-imagebox-div">
                                        <a  <?php $this->print_render_attribute_string('ib_link_') ?> class="rkit-readmore-imagebox-btn" type="button" >
                                            <?php
                                                \Elementor\Icons_Manager::render_icon($settings['imagebox_icon_readmore'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore-ib']);
                                            ?>
                                            <?php echo esc_html__($settings['imagebox_readmore_text'], 'rometheme-for-elementor') ?>
                                        </a>
                            </div>
                        <?php endif; endif; ?>
                    </div>
                    </div>
                </div>
                 
                <div class="<?php echo esc_attr($background)?>"></div>
            </div>
        </div>
<?php
    }

}
    ?>