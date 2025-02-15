<?php
class Rkit_dual_button extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit_dual_button';
    }
  
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['dualbutton']['name'];
        
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['dualbutton']['icon'];
        return $icon;
    }

    
    public function get_keywords()
    {
        return ['rometheme', 'button', 'dual-button'];
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
        return ['rkit-dual-button-style'];
    }



    protected function register_controls()
    {

        $this->start_controls_section('general_section', [
            'label' => esc_html('General'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_responsive_control(
            'layout_db',
            [
                'label' => esc_html__('Layout', 'text-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__('vertical', 'text-domain'),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'row' => [
                        'title' => esc_html__('Horizontal', 'text-domain'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
				 
                'desktop_default' =>  'row', 
                'tablet_default' =>  'row', 
				'mobile_default' =>  'column', 
                'selectors' => [
                    '{{WRAPPER}} .dual-button-inner-wrapper' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

      

        $this->add_control(
            'button_align',
            [
                'label' => esc_html__(' Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dual-button-outer-wrapper' => 'justify-content: {{VALUE}} ;',
                ],
                'default' => 'center',
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => esc_html__('Button Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                        '{{WRAPPER}} .dual-left, {{WRAPPER}} .dual-right' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('button_left', [
            'label' => esc_html('Button 1'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
 
        $this->add_control(
            'left_button_text',
            [
                    'label' => esc_html__('Button 1', 'rometheme-for-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'rows' => 10,
                    'default' => esc_html__('Rometheme ', 'rometheme-for-elementor'),
                    'placeholder' => esc_html__('Type your text here', 'rometheme-for-elementor'),
                ]
        );

        $this->add_control(
            'left_button_icon',
            [
                'label' => esc_html__('Add Icon ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes', 
            ]
        );
     
        $this->add_control(
            'left_icon_readmore',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-arrow-right',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'left_button_icon' => 'yes',
                ]
            ]
        );
    
        $this->add_control('left_button_icon_position', [
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
                'left_button_icon' => 'yes', 
            ],
            'selectors' => [
                    '{{WRAPPER}} .left_button' => 'flex-direction: {{VALUE}};',
                ],
        ]);
    
        $this->add_responsive_control(
            'button_left_icon_spacing',
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
                'selectors' => [
                        '{{WRAPPER}} .left_button' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'left_button_link',
            [
                'label' => esc_html__('Link', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );
        

        $this->end_controls_section();

        $this->start_controls_section('button_right', [
            'label' => esc_html('Button 2'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
  

        $this->add_control(
            'right_button_text',
            [
                    'label' => esc_html__('Button 2', 'rometheme-for-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'rows' => 10,
                    'default' => esc_html__('Studio ', 'rometheme-for-elementor'),
                    'placeholder' => esc_html__('Type your text here', 'rometheme-for-elementor'),
                ]
        );
        $this->add_control(
            'right_button_icon',
            [
                'label' => esc_html__('Add Icon ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes', 
            ]
        );
     
        $this->add_control(
            'right_icon_readmore',
            [
                'label' => esc_html__('Icon sss', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-arrow-right',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'right_button_icon' => 'yes',
                ]
            ]
        );
    
        $this->add_control('right_button_icon_position', [
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
                'right_button_icon' => 'yes', 
            ],
            'selectors' => [
                    '{{WRAPPER}} .right_button' => 'flex-direction: {{VALUE}};',
                ],
        ]);
    
        $this->add_responsive_control(
            'button_right_icon_spacing',
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
                'selectors' => [
                        '{{WRAPPER}} .right_button' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'right_button_link',
            [
                'label' => esc_html__('Link', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'label_block' => true,
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section('separator', [
            'label' => esc_html('Separator'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
   
       
        $this->add_control(
            'middle_button',
            [
                'label' => esc_html__('Middle Button', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'yes', 
            ]
        );
         
        $this->add_control(
            'middle_button_text',
            [
                    'label' => esc_html__('Middle Text Button', 'rometheme-for-elementor'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'rows' => 10,
                    'default' => esc_html__('or ', 'rometheme-for-elementor'),
                    'placeholder' => esc_html__('Type your text here', 'rometheme-for-elementor'),
                    'condition' => [
                        'middle_button' => 'yes',
                        'midle_button_icon!' => 'yes' 
                    ]
                ]
        );
        
        $this->add_control(
            'midle_button_icon',
            [
                'label' => esc_html__('Add Icon ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'no', 
            ]
        );
     
        $this->add_control(
            'midle_icon_readmore',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-play',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'midle_button_icon' => 'yes',
                ]
            ]
        );
    


        $this->end_controls_section();

        // style ============================================================================================================




    $this->start_controls_section('general_style', [
        'label' => esc_html__('General', 'textdomain'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);

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
                'condition' => [
                    'layout_db' => 'row',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0 
                ],
                'selectors' => [
                        '{{WRAPPER}} .dual-button-inner-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'spacebetween_column',
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
                'condition' => [
                    'layout_db' => 'column',
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1 
                ],
                'selectors' => [
                        '{{WRAPPER}} .dual-button-inner-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .dual-button-inner-wrapper ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .left_button, {{WRAPPER}} .dual-left' => 'border-radius: {{TOP}}{{UNIT}} 0{{UNIT}} 0{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .right_button, {{WRAPPER}} .dual-right' => 'border-radius: 0{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_button',
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
                    '{{WRAPPER}}  .dual-button-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 


        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => __('Box Shadow', 'plugin-name'),
                'selector' => '{{WRAPPER}} .dual-button-inner-wrapper',
            ]
        );

    $this->end_controls_section();

          // Style Section for Button left
          $this->start_controls_section('button_left_style_section', [
            'label' => esc_html__('Button 1', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                    'selector' => '{{WRAPPER}} .left_button',
                ]
            );

            $this->add_responsive_control(
                'button_border_radius_left',
                [
                    'label' => esc_html__('Border Radius', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em', 'rem'],
                    'default' => [
                        'top' => 30,
                        'right' => 0,
                        'bottom' => 0,
                        'left' => 30,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .left_button, {{WRAPPER}} .dual-left' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout_db' => 'row'
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_border_radius_left_vertical',
                [
                    'label' => esc_html__('Border Radius', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em', 'rem'],
                    'default' => [
                        'top' => 30,
                        'right' => 30,
                        'bottom' => 30,
                        'left' => 30,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [ 
                        '{{WRAPPER}} .left_button, {{WRAPPER}} .dual-left' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'layout_db' => 'column'
                    ],
                ]
            );
          
            $this->add_responsive_control(
                'button_padding',
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
                        '{{WRAPPER}} .dual-left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_align_left_left',
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
                        '{{WRAPPER}} .left_button' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            );
           
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'button_border_left',
                    'label' => esc_html__('Border Button', 'textdomain'),
                    'selector' => '  {{WRAPPER}} .left_button',
                ]
            );

          
        // /wkwkwkw
        $this->start_controls_tabs('button_tab');

        $this->start_controls_tab('button_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('button_text_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .left_button' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-icon-left-button' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
            'left_db_icon_size',
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
                    '{{WRAPPER}} .rkit-icon-left-button ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

 

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal',
                'selector' => '{{WRAPPER}} .dual-left, {{WRAPPER}} a',
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
                'selector' => '{{WRAPPER}} .dual-left ',
                'default' => '#FF00C6',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('button_text_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a:hover  .left_button  ' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a:hover .rkit-icon-left-button ' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
            'left_db_icon_size_hover',
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
                    '{{WRAPPER}} a:hover .rkit-icon-left-button ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_hover',
                'selector' => '{{WRAPPER}} .dual-left:hover',
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
                'selector' => '{{WRAPPER}} .dual-left:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

          // Style Section for Button _right
          $this->start_controls_section('button_right_style_section', [
            'label' => esc_html__('Button 2', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography_right',
                    'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                    'selector' => '{{WRAPPER}} .right_button',
                ]
            );

            

            $this->add_responsive_control(
                'button_border_radius_right',
                [
                    'label' => esc_html__('Border Radius', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em', 'rem'],
                    'default' => [
                        'top' => 0,
                        'right' => 30,
                        'bottom' => 30,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [  
                        '{{WRAPPER}} .right_button, {{WRAPPER}} .dual-right' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition' => [
                        'layout_db' => 'row'
                    ],
                ]
            );

            $this->add_responsive_control(
                'button_border_radius_right_vertical',
                [
                    'label' => esc_html__('Border Radius', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em', 'rem'],
                    'default' => [
                        'top' => 30,
                        'right' => 30,
                        'bottom' => 30,
                        'left' => 30,
                        'unit' => 'px',
                        'isLinked' => true,
                    ],
                    'selectors' => [  
                        '{{WRAPPER}} .right_button, {{WRAPPER}} .dual-right' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                    ],
                    'condition' => [
                        'layout_db' => 'column'
                    ],
                ]
            );
          
            $this->add_responsive_control(
                'button_padding_right',
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
                        '{{WRAPPER}} .dual-right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'button_align_right_right',
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
                        '{{WRAPPER}} .right_button' => 'justify-content: {{VALUE}};',
                    ],
                    'default' => 'center',
                ]
            ); 

                       
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'button_border_right',
                    'label' => esc_html__('Border Button', 'textdomain'),
                    'selector' => '  {{WRAPPER}} .right_button',
                ]
            );

          
        // /wkwkwkw
        $this->start_controls_tabs('button_tab_right');

        $this->start_controls_tab('button_tab_normal_right', ['label' => esc_html('Normal')]);

        $this->add_control('button_text_color_normal_right', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .right_button' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_normal_right', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-icon-right-button' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
            'right_db_icon_size',
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
                    '{{WRAPPER}} .rkit-icon-right-button ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal_right',
                'selector' => '{{WRAPPER}} .dual-right, {{WRAPPER}} a',
            ]
        );

        $this->add_control(
            'btn_bg_options_normal_right',
            [
                'label' => esc_html__('Button Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_normal_right',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dual-right ',
                'default' => '#FF00C6',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover_right', ['label' => esc_html('Hover')]);

        $this->add_control('button_text_color_hover_right', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a:hover  .right_button  ' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('button_icon_color_hover_right', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} a:hover .rkit-icon-right-button ' => 'color : {{VALUE}}'
            ]
        ]);
 
        $this->add_responsive_control(
            'right_db_icon_size_hover',
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
                    '{{WRAPPER}} a:hover     .rkit-icon-right-button ' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_hover_right',
                'selector' => '{{WRAPPER}} .dual-right:hover',
            ]
        );

        $this->add_control(
            'btn_bg_options_hover_right',
            [
                'label' => esc_html__('Button Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover_right',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .dual-right:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

                  // Style Section for Button middle
                  $this->start_controls_section('button_middle_style_section', [
                    'label' => esc_html__('Separator', 'rometheme-for-elementor'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]);
        
                    $this->add_group_control(
                        \Elementor\Group_Control_Typography::get_type(),
                        [
                            'name' => 'button_typography_middle',
                            'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                            'selector' => '{{WRAPPER}} .middle, {{WRAPPER}} .middle-button ',
                        ]
                    );
        
                    
        
                    $this->add_responsive_control(
                        'button_border_radius_middle',
                        [
                            'label' => esc_html__('Border Radius', 'textdomain'),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%', 'em', 'rem'], 
                            'selectors' => [
                                '{{WRAPPER}} .middle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );     

                    $this->add_responsive_control(
                        'middle_width',
                        [
                            'label' => esc_html__('Width', 'textdomain'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 25
                            ],
                            'selectors' => [
                                    '{{WRAPPER}} .middle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'middle_width_icon',
                        [
                            'label' => esc_html__('Icon Size', 'textdomain'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 500,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 12
                            ],
                            'selectors' => [
                                    '{{WRAPPER}} .rkit-icon-middle-button' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                            ]
                        ]
                    );
            
                    $this->add_control('button_text_color_normal_middle', [
                        'label' => esc_html('Text Color'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .middle' => 'color : {{VALUE}}'
                        ]
                    ]);
            
                    $this->add_control('button_icon_color_normal_middle', [
                        'label' => esc_html('Icon Color'),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rkit-icon-middle-button' => 'color : {{VALUE}}'
                        ]
                    ]);
            
            
                    $this->add_group_control(
                        \Elementor\Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border_middle',
                            'label' => esc_html__('Border Button', 'textdomain'),
                            'selector' => '  {{WRAPPER}} .middle',
                        ]
                    );

                    $this->add_group_control(
                        \Elementor\Group_Control_Background::get_type(),
                        [
                            'name' => 'btn_background_hover_middle',
                            'types' => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .middle',
                        ]
                    );
            
               
                $this->end_controls_section();
}




    protected function render()
    {
        $settings = $this->get_settings_for_display();


        if (!empty($settings['left_button_link']['url'])) {
            $this->add_link_attributes('left_button_link', $settings['left_button_link']);
        }
        if (!empty($settings['right_button_link']['url'])) {
            $this->add_link_attributes('right_button_link', $settings['right_button_link']);
        }
  
?>

<div class="dual-button-outer-wrapper">
  <div class="dual-button-inner-wrapper <?php echo esc_attr($settings['layout_db']); ?>">
    <a class="dual-left-outer" <?php $this->print_render_attribute_string( 'left_button_link' ) ?> >
    <div class="dual-button dual-left">
      <span class="dual-text left_button"><?php
        \Elementor\Icons_Manager::render_icon($settings['left_icon_readmore'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-left-button']);
        echo esc_html($settings['left_button_text']) ?></span>    
    </div>
    </a>
    <?php if($settings['middle_button'] == 'yes') : ?> 
        <div class="middle-button">
            <span class="middle">
                <?php \Elementor\Icons_Manager::render_icon($settings['midle_icon_readmore'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-middle-button']);
                echo esc_html($settings['middle_button_text']) ?>
            </span>
        </div> 
      <?php endif; ?>

    <a class="dual-right-outer" <?php  $this->print_render_attribute_string( 'right_button_link' ) ?> >
        <div class="dual-button dual-right">
        <span class="dual-text right_button"><?php
            \Elementor\Icons_Manager::render_icon($settings['right_icon_readmore'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-right-button']);
            echo esc_html($settings['right_button_text']) ?></span>
        </div>
    </a>
  </div>
</div>


<?php
    }

}
    ?>