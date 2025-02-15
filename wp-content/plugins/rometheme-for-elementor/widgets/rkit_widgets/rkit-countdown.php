<?php
class Rkit_Countdown extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'rkit-countdown';
    }

    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['countdown']['name'];
        
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['countdown']['icon'];
        return $icon;
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_keywords()
    {
        return ['countdown', 'time', 'rometheme'];
    }

    public function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/';
    }

    public function get_style_depends()
    {
        return ['rkit-countdown-style'];
    }

    public function get_script_depends()
    {
        return ['countdown-script'];
    } 
    public function get_next_date()
    {
        $nextDate = date('Y-m-d H:i:s', strtotime('+30 days'));
        return $nextDate;
    }


    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',

            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Countdown Timer', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Enter your title', 'rometheme-for-elementor'),
                'description' => esc_html__('Hey! If you dont want the title, you can leave it blank.', 'rometheme-for-elementor'),
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control('html_tag_1', [
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
            'default' => 'h1'
        ]);

        $this->add_control(
            'date',
            [
                'label' => esc_html__('Date due', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
                'default' => $this->get_next_date(),
            ]
        );
        $this->end_controls_section();
        //content countdown-label-satuan
        $this->start_controls_section(
            'time_section',
            [
                'label' => esc_html__('Time Control', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_days',
            [
                'label' => esc_html__('Show Days', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',

            ]
        );


        $this->add_control(
            'show_hours',
            [
                'label' => esc_html__('Show Hours', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_minutes',
            [
                'label' => esc_html__('Show Minutes', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_seconds',
            [
                'label' => esc_html__('Show Seconds', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        //divider control
        $this->add_control(
            'more_options',
            [
                'label' => esc_html__('Label', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Label', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'label_position',
            [
                'label' => esc_html__('Label Potition', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'row' => esc_html__('Center', 'textdomain'),
                    'column'  => esc_html__('Bottom', 'textdomain'),
                ],
                'condition' => [
                    'show_label' => 'yes',
                ],
                'default' => 'column',
                'selectors' => [
                    '  {{WRAPPER}} .countdown-section' => 'flex-direction: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'label_days',
            [
                'label' => esc_html__('Days', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Days', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('', 'rometheme-for-elementor'),
                'condition' => [
                    'show_days' => 'yes',
                    'show_label' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'label_hours',
            [
                'label' => esc_html__('Hours', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Hours', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('', 'rometheme-for-elementor'),
                'condition' => [
                    'show_hours' => 'yes',
                    'show_label' => 'yes',
                ]
            ]
        );



        $this->add_control(
            'label_minutes',
            [
                'label' => esc_html__('Minutes', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Minutes', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('', 'rometheme-for-elementor'),
                'condition' => [
                    'show_minutes' => 'yes',
                    'show_label' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'label_seconds',
            [
                'label' => esc_html__('Seconds', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Seconds', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('', 'rometheme-for-elementor'),
                'condition' => [
                    'show_seconds' => 'yes',
                    'show_label' => 'yes',
                ]
            ]
        );




        $this->end_controls_section();


        //expired action

        $this->start_controls_section(
            'expired_time_section',
            [
                'label' => esc_html__('Expired Action', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'expired_title',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('FINISH!', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control('html_tag_2', [
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
            'default' => 'h1'
        ]);

        $this->add_control(
            'expired_deskripsion',
            [
                'label' => esc_html__('Description', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Description', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('', 'rometheme-for-elementor'),
            ]
        );



        $this->end_controls_section();

        //switch control content hide

        $this->start_controls_section(
            'style_section_time_back',
            [
                'label' => esc_html__('Box', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'label' => esc_html__('Background Color', 'rometheme-for-elementor'),
                'name' => 'background_section',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-countdown-widget',
            ]
        );
        $this->end_controls_section();
        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Title Style', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '  {{WRAPPER}} .countdown-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '   {{WRAPPER}} .countdown-title',
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .countdown-title-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding_title',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown-title-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_margin_title',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'style_section_time',
            [
                'label' => esc_html__('Time Style', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'time_expired_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .time_sett ',
            ]
        );


        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .countdown-days, {{WRAPPER}} .countdown-hours, {{WRAPPER}} .countdown-minutes, {{WRAPPER}} .countdown-seconds' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'more_optionsssssa',
            [
                'label' => esc_html__('Background Time', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'label' => esc_html__('Background time Color', 'rometheme-for-elementor'),
                'name' => 'background_time',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .countdown-section',
            ]
        );

        $this->add_control(
            'more_optionsssssssa',
            [
                'label' => esc_html__('Container Time', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .countdown-section, {{WRAPPER}} .countdown-section-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'item_gap',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown_contain' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown-section, {{WRAPPER}} .countdown-section-row' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section_2',
            [
                'label' => esc_html__('Label Style', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_label' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .countdown-label',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#00CEA6',
                'selectors' => [
                    '{{WRAPPER}} .countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );



        $this->add_control(
            'label_margin',
            [
                'label' => esc_html__('Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => -15,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 10,
                        'step' => 0.1,
                    ],

                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .countdown-label' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        //style section unit



        $this->start_controls_section(
            'style_section_expired_time',
            [
                'label' => esc_html__('Expired Style', 'rometheme-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

   
        $this->add_control(
            'divider_title',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'expired_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .expired-title  ',
            ]
        );

        $this->add_control(
            'title_expired_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expired-title ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exp_title_align',
            [
                'label' => esc_html__('Title Alignment', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .expired-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        
        $this->add_control(
            'expired_title_padding',
            [
                'label' => esc_html__('Tittle Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 15,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 3,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .expired-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
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
                'name' => 'des_expired_typography',
                'label' => esc_html__('Typography', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .expired-description  ',
            ]
        );

        $this->add_control(
            'descrip_expired_color',
            [
                'label' => esc_html__('Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expired-description ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'exp_subs_align',
            [
                'label' => esc_html__('Description Alignment', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} .expired-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'expired_description_padding',
            [
                'label' => esc_html__('Description Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 15,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 3,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .expired-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'divider_background',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'expired_background_color',
            [
                'label' => esc_html__('Body Background Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .expired-time-section' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_section();
    }



    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $date = (!empty($settings['date']) ) ? $settings['date'] : '';

        switch ($settings['html_tag_1']) {
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


        switch ($settings['html_tag_2']) {
            case 'h1':
                $html_tage = 'h1';
                break;
            case 'h2':
                $html_tage = 'h2';
                break;
            case 'h3':
                $html_tage = 'h3';
                break;
            case 'h4':
                $html_tage = 'h4';
                break;
            case 'h5':
                $html_tage = 'h5';
                break;
            case 'h6':
                $html_tage = 'h6';
                break;
            default:
                $html_tage = 'h1';
                break;
        }
?>

        <div class="expired-time-section" style="display:none">
            <?php if (! empty($settings['expired_title'])) : ?>
                <<?php echo esc_html($html_tage); ?> class="expired-title"><?php echo esc_html($settings['expired_title']); ?> </<?php echo esc_html($html_tag); ?>>
            <?php endif; ?>

            <?php if (! empty($settings['expired_deskripsion'])) : ?>
                <p class="expired-description"><?php echo esc_html($settings['expired_deskripsion']); ?></p>
            <?php endif; ?>
        </div>


        <div class="count">
            <div class="rkit-countdown-widget">
                <?php if ($settings['show_title'] === 'yes'): ?>
                    <div class="countdown-title-wrapper" style="width:100%">
                        <<?php echo esc_html($html_tag); ?> class="countdown-title">
                            <?php echo esc_html__($title, 'rometheme-for-elementor'); ?>
                        </<?php echo esc_html($html_tag); ?>>
                    </div>
                <?php endif; ?>

                <div id="countdown" class="countdown_contain" data-date="<?php echo esc_attr($date); ?>">
                    <?php if ('yes' == $settings['show_days']) : ?>
                        <div class="countdown-section days-section">
                            <span class="countdown-days time_sett">00</span>
                            <span class="countdown-label label_days"><?php echo esc_html__($settings['label_days']); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ('yes' == $settings['show_hours']) : ?>
                        <div class="countdown-section hours-section">
                            <span class="countdown-hours time_sett">00</span>
                            <span class="countdown-label label_hours"><?php echo esc_html__($settings['label_hours']); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ('yes' == $settings['show_minutes']) : ?>
                        <div class="countdown-section minutes-section">
                            <span class="countdown-minutes time_sett">00</span>
                            <span class="countdown-label label_minutes"><?php echo esc_html__($settings['label_minutes']); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ('yes' == $settings['show_seconds']) : ?>
                        <div class="countdown-section seconds-section">
                            <span class="countdown-seconds time_sett">01</span>
                            <span class="countdown-label label_second"><?php echo esc_html__($settings['label_seconds']); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
<?php
    }
}

?>