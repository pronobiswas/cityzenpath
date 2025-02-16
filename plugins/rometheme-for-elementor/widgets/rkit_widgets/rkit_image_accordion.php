<?php
class Rkit_image_accordion extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit_image_accordion';
    } 
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['imageaccordion']['name'];
        
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['imageaccordion']['icon'];
        return $icon;
    }

    public function get_keywords()
    {
        return ['rometheme', 'image', 'accordion'];
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
        return ['rkit-image_accordion-style'];
    }

    public function get_script_depends()
    {
        return ['rkit-image_accordion-script'];
    }
 

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('html_tag_accordion' , [
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

        $this->add_control('hover_mode' , [
            'label' => esc_html('Accordion Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '-hover' => esc_html('On Hover'),
                '-click' => esc_html('On Click'), 
            ],
            'default' => '-hover'
        ]);


        $this->add_control('direction' , [
            'label' => esc_html('Direction'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'column' => esc_html('Vertical'),
                'row' => esc_html('Horizontal'), 
            ],
            'default' => 'row',
            'selectors' => [
                    '{{WRAPPER}} .gallery-wrap' => 'flex-direction: {{VALUE}};',
                ],
        ]);
 

        $image_accordion = new \Elementor\Repeater();

        
        $image_accordion->add_control(
            'default_image_open',
            [
                'label' => esc_html__('Default Open', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        
        $image_accordion->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $image_accordion->add_control(
            'image_title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Image Accordion Title', 'textdomain'),
            ]
        );
        
        $image_accordion->add_control(
            'image_description',
            [
                'label' => esc_html__('Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Image Accordion content here! Click edit button to change this text.', 'textdomain'),
            ]
        );

        $image_accordion->add_control(
            'ia_card_link',
            [
                'label' => esc_html__('Link', 'textdomain'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Repeater List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $image_accordion->get_controls(),
                'default' => [
                    [
                        'image_acc' => esc_html__('Image 1', 'textdomain'),
                        'ia_card_link' => [
                            'url' => "#"
                        ]
                       
                    ],
                    [
                        'image_acc' => esc_html__('Image 2', 'textdomain'),
                        'default_image_open' => 'yes',
                        'ia_card_link' => [
                            'url' => "#"
                        ]
                    ],
                    [
                        'image_acc' => esc_html__('Image 3', 'textdomain'),
                        'ia_card_link' => [
                            'url' => "#"
                        ]
                       
                    ],
                    [
                        'image_acc' => esc_html__('Image 4', 'textdomain'),
                        'ia_card_link' => [
                            'url' => "#"
                        ]
                    ],
                ],
                'title_field' => '{{{image_acc}}}',
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
                'default' => 'no',
            ]
        );
    
        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__('Button Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'rtmicon rtmicon-check',
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
                'default' => esc_html__('Accordion', 'rometheme-for-elementor'),
            ]
        );
    
        
    
        $this->end_controls_section();
    



// style ============================================================================================================




$this->start_controls_section('container_style', [
    'label' => esc_html__('Container', 'textdomain'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
]);

 

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'overlay_color',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}}  .background-item-text',
            'fields_options' => [
                'color' => [
                    'label' => esc_html__( 'Overlay Color', 'elementor-pro' ),
                ],
            ],
        ]
    );

    $this->add_control(
        'overlay_opacity',
        [
            'label' => esc_html__('Opacity', 'textdomain'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1,
                    'step' => 0.1,
                ],
            ],
            'default' => [
                'size' => 0.5,
            ],
            'selectors' => [
                '{{WRAPPER}} .background-item-text' => 'opacity: {{SIZE}};',
            ],
            'condition' => [
                'hover_mode' => '-hover'
            ]
        ]
    );

    $this->add_control(
        'overlay_opacity_click',
        [
            'label' => esc_html__('Opacity', 'textdomain'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1,
                    'step' => 0.1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}  .background-item-text' => 'opacity: {{SIZE}};',
            ],
            'condition' => [
                'hover_mode' => '-click'
            ]
        ]
    );
 
            
    $this->add_responsive_control(
        'height',
        [
            'label' => esc_html__('Height', 'textdomain'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%','em','rem'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 2110,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 400
            ],
           'selectors' => [
                    '{{WRAPPER}} .gallery-wrap' => 'height: {{SIZE}}{{UNIT}};',
                ],
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
            'selector' => '{{WRAPPER}}  .item-ia-hover, {{WRAPPER}}  .item-ia-click',

        ]
    );


    $this->add_responsive_control(
        'spacebetween',
        [
            'label' => esc_html__('Spacing', 'textdomain'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0
            ],
            'selectors' => [
                    '{{WRAPPER}} .gallery-wrap' => 'gap: {{SIZE}}{{UNIT}};',
            ]
        ]
    );
    
 

    $this->add_control(
        'border_radius',
        [
            'label' => esc_html__('Border Radius Image', 'textdomain'),
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
                '{{WRAPPER}}  .item-ia-hover, {{WRAPPER}}  .item-ia-click, {{WRAPPER}} .item-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->end_controls_section();

    // text style
    $this->start_controls_section('text_style_section', [
        'label' => esc_html__('Text Style', 'textdomain'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);

    $this->add_control(
        'text_position',
        [
            'label' => esc_html__('Text Position', 'textdomain'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__('Top', 'textdomain'),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'textdomain'),
                    'icon' => 'eicon-v-align-middle',
                ],
                'flex-end' => [
                    'title' => esc_html__('Bottom', 'textdomain'),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .item-text' => 'justify-content: {{VALUE}};',
            ],
            'default' => 'center',
        ]
    );

    $this->add_responsive_control(
        'spacebetween_text_text',
        [
            'label' => esc_html__('Spacing', 'textdomain'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%','em','rem'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0
            ],
           'selectors' => [
                    '{{WRAPPER}} .item-text' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            'description' => esc_html__('Wait or click Image to see changes',  'text-domain'),
        ]
    );
    $this->add_control(
        'hr',
        [
            'type' => \Elementor\Controls_Manager::DIVIDER,
        ]
    );

    // title
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_text_typography',
            'label' => esc_html__('Title Typography', 'textdomain'),
            'selector' => '{{WRAPPER}} .text-title',
            
        ]
    );

    $this->add_control(
        'title_text_color',
        [
            'label' => esc_html__('Title Color', 'textdomain'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .text-title' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'title_text_align',
        [
            'label' => esc_html__('Title Alignment', 'textdomain'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'textdomain'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'textdomain'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'textdomain'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .text-title' => 'text-align: {{VALUE}} !important;',
            ],
            'default' => 'center',
        ]
    );

    $this->add_control(
            'title_text_padding',
            [
                'label' => esc_html__('Title Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-title ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_text_margin',
            [
                'label' => esc_html__('Title Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-title ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'hrdesc',
            [
                'label' => esc_html__('Description', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        // Description
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_text_typography',
                'label' => esc_html__('Desc Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .text-description',
                
            ]
        );

        $this->add_control(
            'desc_text_color',
            [
                'label' => esc_html__('Desc Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_text_align',
            [
                'label' => esc_html__('Desc Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .text-description' => 'text-align: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->add_control(
                'desc_text_padding',
                [
                    'label' => esc_html__('Desc Padding', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .text-description ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
 
            $this->add_control(
                'desc_text_margin',
                [
                    'label' => esc_html__('Desc Margin', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'top' => 0,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .text-description ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .rkit-image-accordion-item-button, {{WRAPPER}}.rkit-button-element-image-accordion',
            ]
        );

  

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' =>  ['px', '%', 'em', 'rem'], 
                'selectors' => [
                    '{{WRAPPER}} .button-element-image-accordion' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'], 
                'selectors' => [
                    '{{WRAPPER}} .button-element-image-accordion' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .rkit-image-accordion-item-button' => 'justify-content: {{VALUE}};',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'button_spacing',
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
                'desktop_default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image-accordion-item-button, {{WRAPPER}} .rkit-button-element-image-accordion' => 'margin-top: {{SIZE}}{{UNIT}};',
                ], 
                 'condition' => [
                    'direction' => 'row'
                ]
            ]
        );

        $this->add_responsive_control(
            'button_spacing_column',
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
                'desktop_default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image-accordion-item-button, {{WRAPPER}} .rkit-button-element-image-accordion' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'direction' => 'column'
                ]
            ]

        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
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
                'selectors' => [
                    ' {{WRAPPER}} .button-element-image-accordion' => 'gap: {{SIZE}}{{UNIT}};',
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
            'selector' => '  {{WRAPPER}} .button-element-image-accordion',
        ]
    );

    $this->add_control('button_text_color_normal', [
        'label' => esc_html('Text Color'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-image-accordion-item-button,  {{WRAPPER}} a' => 'color : {{VALUE}}'
        ]
    ]);

    $this->add_control('button_icon_color_normal', [
        'label' => esc_html('Icon Color'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .icon-button' => 'color : {{VALUE}}'
        ]
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_normal',
            'selector' => '{{WRAPPER}} .rkit-button-element-image-accordion, {{WRAPPER}} a',
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
            'selector' => '{{WRAPPER}} .rkit-button-element-image-accordion, {{WRAPPER}} a',
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
            'selector' => '  {{WRAPPER}} .button-element-image-accordion:hover',
        ]
    );


    $this->add_control('button_text_color_hover', [
        'label' => esc_html('Text Color'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-image-accordion-item-button a:hover' => 'color : {{VALUE}}'
        ]
    ]);

    $this->add_control('button_icon_color_hover', [
        'label' => esc_html('Icon Color'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} a:hover .icon-button  ' => 'color : {{VALUE}}'
        ]
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_hover',
            'selector' => '{{WRAPPER}} .rkit-image-accordion-item-button a:hover',
        ]
    );

    $this->add_control(
        'btn_bg_options_hover',
        [
            'label' => esc_html__('Background', 'textdomain'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'btn_background_hover',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-image-accordion-item-button a:hover',
        ]
    );


    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->end_controls_section();
 

    }




protected function render()
{
    $settings = $this->get_settings_for_display();

    switch ($settings['html_tag_accordion']) {
        case 'h1':
            $html_tag = 'h1';
            break;
        case 'h2':
            $html_tag = 'h2';
            break;
        case 'h3':
            $html_tag = 'h3';
            break;
        case 'h4':
            $html_tag = 'h4';
            break;
        case 'h5':
            $html_tag = 'h5';
            break;
        case 'h6':
            $html_tag = 'h6';
            break;
        default:
            $html_tag = 'h1';
            break;
    }  
 

 
?>

<div class="container-image-accordion"> 
  <div class="gallery-wrap"> 
  <?php  
        $tab = 1;
        foreach ($settings['list'] as $li) :
            if ($li['default_image_open'] == 'yes' ){
                $open_image = "active";
            }else{
                $open_image = "";
            } 


            if (!empty($li['ia_card_link']['url'])) { 
                $this->add_link_attributes('ia_card_link_' . $li['_id'], $li['ia_card_link']);
            }
        ?>
        <?php 
            $image_html_url = \Elementor\Group_Control_Image_Size::get_attachment_image_html($li, 'thumbnail', 'image');
            $image_html_url = str_replace('<img ', '<img class="" ', $image_html_url);
        ?>
    <div class="item-ia<?php echo $settings['hover_mode'] ?> <?php echo $open_image ?> <?php echo $tab++ ?>" style="background-image:url(<?php  echo $li['image']['url']; ?>)">
   
    <div class="item-text">
    <div class="background-item-text"></div>
            <<?php echo esc_html($html_tag) ?>  class="text-title"> <?php echo esc_html($li['image_title']); ?>  </<?php echo esc_html($html_tag) ?>>
                <span class="text-description">
                    <?php echo esc_html($li['image_description']); ?>
                </span>

                <?php if (($settings['show_button']) == 'yes') {  ?>
                        <div class="rkit-image-accordion-item-button">
                            <?php if ($settings['button_icon_position'] == "before") { ?>
                            <a <?php $this->print_render_attribute_string('ia_card_link_' . $li['_id']) ?> class="button-element-image-accordion">
                                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-button"]); ?>
                                <?php echo esc_html($settings['button_text']) ?>
                            </a>
                            <?php } else { ?>
                            <a <?php $this->print_render_attribute_string('ia_card_link_' . $li['_id']) ?> class="button-element-image-accordion">
                                <?php echo esc_html($settings['button_text']) ?>
                                <?php \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => "icon-button"]); ?>
                            </a>
                                <?php } ?>
                                </div>
                        <?php
                        } ?>
        </div>
    </div> 
     <?php endforeach; ?>
  </div>

</div>

 

<?php
    }

}
    ?>