<?php

class Rkit_ProgressBar extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-progress-bar';
    }

    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['progressbar']['name'];

    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['progressbar']['icon'];
        return $icon;
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-progress-bar-widget/';
    }

    public function get_script_depends()
    {
        return [''];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('progress_style', [
            'label' => esc_html('Progress Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'line' => esc_html('Line'),
                'circle' => esc_html('Circle'),
                'half' => esc_html('Half Circle'),
            ],
            'default' => 'line'
        ]);

        $this->add_control('progress-title', [
            'label' => esc_html('Title'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html('Input Your Title Here'),
            'default' => esc_html('Progress'),
        ]);

        $this->add_control(
            'percent',
            [
                'label' => esc_html__('Percentage', 'rometheme-for-elementor'),
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
            ]
        );

        $this->add_control('title_position', [
            'label' => esc_html('Title Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'column' => esc_html('Top'),
                'column-reverse' => esc_html('Bottom')
            ],
            'default' => 'column',
            'selectors' => [
                '{{WRAPPER}} .half-circular-progress .progress-value, {{WRAPPER}} .circular-progress .progress-value' => 'flex-direction:{{VALUE}}'
            ],
            'condition' => [
                'progress_style!' => 'line',
                'progress-title!' => '',
                'show_percentage' => 'yes'
            ]
        ]);

        $this->add_control(
            'show_percentage',
            [
                'label' => esc_html__('Show Percentage', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'animation-duration',
            [
                'label' => esc_html__('Animation Duration (ms)', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2000,
                ],
            ]
        );

        $this->add_control('prefix_text', [
            'label' => esc_html('Prefix Label'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html('Prefix'),
            'condition' => [
                'progress_style' => 'half'
            ]
        ]);

        $this->add_control('postfix_text', [
            'label' => esc_html('Postfix Label'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html('Postfix'),
            'condition' => [
                'progress_style' => 'half'
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('general_style', [
            'label' => esc_html('General'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'progress_align',
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
                    '{{WRAPPER}} .rkit-progress .progress-container' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'progress_style!' => 'line'
                ]
            ]
        );

        $this->add_control(
            'progress_color_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control('progress_color', [
            'label' => esc_html('Progress Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-progress' => '--progress-color:{{VALUE}}'
            ]
        ]);

        $this->add_control('progress_bg_color', [
            'label' => esc_html('Progress Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-progress' => '--secondary-progress-color:{{VALUE}}'
            ]
        ]);

        $this->add_control('bg_color', [
            'label' => esc_html('Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .circular-progress .progress-value , {{WRAPPER}} .half-circular-progress .progress-value' => 'background-color:{{VALUE}}'
            ],
            'condition' => [
                'progress_style!' => 'line'
            ]
        ]);

        $this->add_control(
            'progress_size_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'progress_size',
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
                    '{{WRAPPER}} .circular-progress ,  {{WRAPPER}} .half-circular-progress , {{WRAPPER}} .progress-bar , {{WRAPPER}} .prefix-postfix' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'progress_line_options',
            [
                'label' => esc_html__('Line', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_responsive_control(
            'progress_line_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .progress-bar ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_responsive_control(
            'progress_line_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .progress-bar , {{WRAPPER}} .progress-bar .progress-value' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_control(
            'progress_line_height',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_control(
            'circular_options',
            [
                'label' => esc_html__('Circle', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'progress_style' => 'circle'
                ]
            ]
        );

        $this->add_control(
            'half_circular_options',
            [
                'label' => esc_html__('Half Circle', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'progress_style' => 'half'
                ]
            ]
        );

        $this->add_responsive_control(
            'stroke_width',
            [
                'label' => esc_html__('Stroke Width', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .circular-progress .progress-value , {{WRAPPER}} .half-circular-progress .progress-value' => 'width: calc(100% - {{SIZE}}{{UNIT}} );',
                ],
                'condition' => [
                    'progress_style!' => 'line'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('percentage_style', [
            'label' => esc_html('Percentage'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_percentage' => 'yes'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'percentage_typography',
                'selector' => '{{WRAPPER}} .percentage-label::after',
            ]
        );

        $this->add_control('percen_color', [
            'label' => esc_html('Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .percentage-label::after' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('percen_bg_color', [
            'label' => esc_html('Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .percentage-label::after' => 'background-color:{{VALUE}}'
            ],
            'condition' => [
                'progress_style' => 'line'
            ]
        ]);

        $this->add_control(
            'percen_position',
            [
                'label' => esc_html__('Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .progress-bar.percentage-label::after' => '{{VALUE}}:-25px;',
                ],
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_responsive_control(
            'percentage_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .progress-bar.percentage-label::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_responsive_control(
            'percentage_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .progress-bar.percentage-label::after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_responsive_control(
            'percentage_radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .progress-bar.percentage-label::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'percentage_border',
                'selector' => '{{WRAPPER}} .progress-bar.percentage-label::after',
                'condition' => [
                    'progress_style' => 'line'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('title_style', [
            'label' => esc_html('Title'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'progress-title!' => ''
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .circular-progress .progress-value::before , {{WRAPPER}} .half-circular-progress .progress-value::before , .progress-title',
            ]
        );

        $this->add_control('title_color', [
            'label' => esc_html('Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .circular-progress .progress-value::before , {{WRAPPER}} .half-circular-progress .progress-value::before , {{WRAPPER}} .progress-title' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .circular-progress .progress-value::before , {{WRAPPER}} .half-circular-progress .progress-value::before , {{WRAPPER}} .progress-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .circular-progress .progress-value::before , {{WRAPPER}} .half-circular-progress .progress-value::before , {{WRAPPER}} .progress-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();
   
        $this->start_controls_section('postfix-prefix_style', [
            'label' => esc_html('Prefix & Postfix'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'progress_style' => 'half',
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'postfix-prefix_typography',
                'selector' => '{{WRAPPER}} .prefix-postfix',
            ]
        );

        $this->add_control('postfix-prefix_color', [
            'label' => esc_html('Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .prefix-postfix' => 'color:{{VALUE}}'
            ]
        ]);

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <div class="rkit-progress" style="--value:<?php echo esc_attr($settings['percent']['size']) ?> ; --title: '<?php echo esc_attr($settings['progress-title']) ?>' ; --animation-duration:<?php echo esc_attr($settings['animation-duration']['size']) ?>;">
            <?php switch ($settings['progress_style']) {
                case 'circle': ?>
                    <div class="progress-container">
                        <div class="circular-progress">
                            <div class="progress-value <?php echo ($settings['show_percentage'] === 'yes') ? 'percentage-label' : '' ?>"></div>
                        </div>
                    </div>
                <?php break;
                case 'line': ?>
                    <span class="progress-title"><?php echo esc_html($settings['progress-title']) ?></span>
                    <div class="progress-container">
                        <div class="progress-bar <?php echo ($settings['show_percentage'] === 'yes') ? 'percentage-label' : '' ?>">
                            <div class="progress-value"></div>
                        </div>
                    </div>
                <?php break;
                case 'half': ?>
                    <div class="progress-container">
                        <div class="half-circular-progress">
                            <div class="progress-value <?php echo ($settings['show_percentage'] === 'yes') ? 'percentage-label' : '' ?>"></div>
                        </div>
                        <div class="prefix-postfix">
                            <span><?php echo esc_html($settings['prefix_text']) ?></span>
                            <span><?php echo esc_html($settings['postfix_text']) ?></span>
                        </div>
                    </div>
            <?php break;
            }
            ?>
        </div>
<?php
    }
}
