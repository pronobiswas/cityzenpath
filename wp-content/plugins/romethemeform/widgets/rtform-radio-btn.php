<?php

class Rform_Radio_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'rform-radio-widget';
    }

    public function get_title()
    {
        return __('RForm - Radio', 'romethemeform');
    }

    public function get_icon()
    {
        return 'rform-widget-icon rtmicon rtmicon-radio';
    }

    public function get_categories()
    {
        return ['romethemeform_form_fields'];
    }

    public function show_in_panel()
    {
        return 'romethemeform_form' === get_post_type();
    }

    public function get_style_depends()
    {
        return ['rform-radiobutton-style', 'rtform-text-style'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Label', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'romethemeform'),
                'label_off' => esc_html__('Hide', 'romethemeform'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__("for adding label on input turn it on. Don't want to use label? turn it off.", 'romethemeform')
            ]
        );

        $this->add_control('label_position', [
            'label' => esc_html__('Position', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'rform-label-top' => esc_html__('Top', 'romethemeform'),
                'rform-label-left' => esc_html__('Left', 'romethemefom-plugin')
            ],
            'default' => 'rform-label-top',
            'description' => esc_html__('Select label position. where you want to see it. top of the input or left of the input.', 'romethemeform'),
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);

        $this->add_control('label_text', [
            'label' => esc_html__('Label', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Radio', 'romethemeform'),
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);


        $this->add_control('name_input', [
            'label' => esc_html__('Name', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('rform-radiobtn', 'romethemeform'),
            'description' => esc_html__('Name is must required. Enter name without space or any special character. use only underscore/ hyphen (_/-) for multiple word. Name must be different.', 'romethemeform')
        ]);

        $this->add_responsive_control(
            'option_display',
            [
                'label' => esc_html__('Option Display', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__('Vertical', 'romethemeform'),
                        'icon' => 'eicon-arrow-down',
                    ],
                    'row' => [
                        'title' => esc_html__('Horizontal', 'romethemeform'),
                        'icon' => 'eicon-arrow-right',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rform-radio-button' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control('option_text_position', [
            'label' => esc_html('Option Text Position :'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'row' => esc_html('After Radio'),
                'row-reverse' => esc_html('Before Radio'),
            ],
            'default' => 'row',
            'selectors'  => [
                '{{WRAPPER}} .rform-radiobtn-container' => 'flex-direction: {{VALUE}}'
            ]
        ]);


        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'option_text',
            [
                'label' => __('Option Text', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Option', 'elementor'),
                'label_block' => true,
                'description' => esc_html('Select option text that will be show to user.')
            ]
        );

        $repeater->add_control(
            'option_value',
            [
                'label' => __('Option Value', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('option', 'elementor'),
                'label_block' => true,
                'description' => esc_html('Select option value that will be store/mail to desired person..')
            ]
        );

        $repeater->add_control('option_status', [
            'label' => esc_html('Option Status'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html('Active'),
                'disabled' => esc_html('Disable'),
            ],
            'description' => esc_html("Want to make a option? which user can see the option but can't select it. make it disable.")
        ]);

        $repeater->add_control('option_default', [
            'label' => esc_html('Select it default ?'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'romethemeform'),
            'label_off' => esc_html__('No', 'romethemeform'),
            'return_value' => 'yes',
            'default' => 'no',
            'description' => esc_html("Make this option default selected.")
        ]);

        $this->add_control(
            'radio_options',
            [
                'label' => __('Radio Options', 'elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'option_text' => __('Option 1', 'elementor'),
                        'option_value' => 'option_1',
                        'option_default' => 'yes'
                    ],
                    [
                        'option_text' => __('Option 2', 'elementor'),
                        'option_value' => 'option_2',
                    ],
                    [
                        'option_text' => __('Option 3', 'elementor'),
                        'option_value' => 'option_3',
                    ],
                ],
                'title_field' => '{{{ option_text }}}',
            ]
        );

        $this->add_control('help_text', [
            'label' => esc_html__('Help Text', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__('Type your help text here', 'romethemeform'),
        ]);

        $this->end_controls_section();

        $this->start_controls_section('label_style', [
            'label' => esc_html__('Label', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'label_align',
            [
                'label' => esc_html__('Label Position', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Top', 'romethemeform'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'romethemeform'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('Bottom', 'romethemeform'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rform-label-input' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'label_position' => 'rform-label-left'
                ]
            ]
        );

        $this->add_responsive_control('label_width', [
            'label' => esc_html__('Width', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000, 'step' => 1],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'width:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'label_position' => 'rform-label-left'
            ]
        ]);

        $this->add_control('label_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .rform-label-input',
            ]
        );

        $this->add_responsive_control('label_padding', [
            'label' => esc_html__('Padding', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('label_margin', [
            'label' => esc_html__('Margin', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default' => [
                'top' => '0',
                'right' => '0',
                'bottom' => '10',
                'left' => '0',
                'unit' => 'px',
                'isLinked' => 'false',
            ],
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('radio_style', [
            'label' => esc_html('Radio'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'option_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rform-radiobtn-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'option_margin',
            [
                'label' => esc_html__('Margin', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rform-radiobtn-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'option_typography',
				'selector' => '{{WRAPPER}} .rform-radiobtn-container',
			]
		);

        $this->add_control(
			'size_options',
			[
				'label' => esc_html__( 'Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
			'radio_size',
			[
				'label' => esc_html__( 'Radio Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
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
					'{{WRAPPER}} .rform-radio-checkmark' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dot_size',
			[
				'label' => esc_html__( 'Dot Size', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
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
					'{{WRAPPER}} .rform-radiobtn-container .rform-radio-checkmark:after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->start_controls_tabs('option_tabs');

        $this->start_controls_tab('option_tab_normal' , ['label' => esc_html('Normal')]);

        $this->add_control('option_text_color_normal' , [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-radiobtn-container' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('option_radio_color_normal' , [
            'label' => esc_html('Radio Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-radiobtn-container input:not(:checked) ~ .rform-radio-checkmark' => 'background-color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_option_normal',
				'selector' => '{{WRAPPER}} .rform-radiobtn-container input:not(:checked) ~ .rform-radio-checkmark',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab('option_tab_hover' , ['label' => esc_html('Hover')]);

        $this->add_control('option_text_color_hover' , [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-radiobtn-container:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('option_radio_color_hover' , [
            'label' => esc_html('Radio Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-radiobtn-container:hover input:not(:checked) ~ .rform-radio-checkmark' => 'background-color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_option_hover',
				'selector' => '{{WRAPPER}} .rform-radiobtn-container:hover input:not(:checked) ~ .rform-radio-checkmark',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab('option_tab_checked' , ['label' => esc_html('Checked')]);

        $this->add_control('option_radio_color_checked' , [
            'label' => esc_html('Radio Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-radiobtn-container input:checked ~ .rform-radio-checkmark' => 'background-color:{{VALUE}}'
            ]
        ]);

        $this->add_control('option_dot_color_checked' , [
            'label' => esc_html('Radio Dot Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-radiobtn-container input:checked ~ .rform-radio-checkmark:after' => 'background-color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_option_checked',
				'selector' => '{{WRAPPER}} .rform-radiobtn-container input:checked ~ .rform-radio-checkmark',
			]
		);

        $this->end_controls_tab();



        $this->end_controls_tabs();


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $label_text = $settings['label_text'];
        $radio_options = $settings['radio_options'];
?>
        <div class="rform-container">
            <div class="rform-control <?php echo esc_attr($settings['label_position']) ?>">
                <?php if ('yes' === $settings['show_label']) : ?>
                    <label class="rform-label-input" for="rform-input-text-<?php echo $this->get_id_int(); ?>">
                        <?php echo esc_html__($label_text, 'romethemeform') ?>
                        <?php if ( isset($settings['required_input']) and 'yes' == $settings['required_input']) : ?><span> * </span><?php endif; ?>
                    </label>
                <?php endif; ?>
                <div class="rform-radio-button">
                    <?php foreach ($settings['radio_options'] as $option) : ?>
                        <label class="rform-radiobtn-container">
                            <div>
                                <input type="radio" value="<?php echo esc_attr($option['option_value']) ?>" name="<?php echo esc_attr($settings['name_input']) ?>" <?php echo esc_attr($option['option_status']);
                                                                                                                                                                    echo ($option['option_default'] === 'yes') ? esc_attr('checked') : '' ?>>
                                <span class="rform-radio-checkmark"></span>
                            </div>
                            <span class="rform-radio-label"><?php echo esc_html($option['option_text']) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <span role="alert" class="rform-error" id="rform-input-err-<?php echo $this->get_id_int(); ?>"><?php echo esc_html__($settings['warning_message'], 'romethemeform') ?></span>
            <div class="rform-help-text">
                <span><?php echo esc_html__($settings['help_text'], 'romethemeform') ?></span>
            </div>
        </div>
<?php
    }
}
