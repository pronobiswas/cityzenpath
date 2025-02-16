<?php

class RTForm_select extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'select';
    }
    public function get_title()
    {
        return 'RForm - select';
    }
    public function get_categories()
    {
        return ['romethemeform_form_fields'];
    }
    public function get_icon()
    {
        return 'rform-widget-icon rtmicon rtmicon-select';
    }

    public function show_in_panel()
    {
        return 'romethemeform_form' === get_post_type();
    }
    public function get_keywords()
    {
        return ['select', 'fields', 'input', 'rometheme form'];
    }

    public function get_script_depends()
    {
        return ['rform-select-js' , 'rtform-text-js'];
    }

    public function get_style_depends()
    {
        return ['rtform-text-style', 'rform-select-style'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
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
            'default' => esc_html__('Select', 'romethemeform'),
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);

        $this->add_control('name_input', [
            'label' => esc_html__('Name', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('rform-select', 'romethemeform'),
            'description' => esc_html__('Name is must required. Enter name without space or any special character. use only underscore/ hyphen (_/-) for multiple word. Name must be different.', 'romethemeform')
        ]);

        $this->add_control('placeholder_input', [
            'label' => esc_html__('Placeholder', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Please Choose Option Here', 'romethemeform')
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'option_text',
            [
                'label' => esc_html__('Input Field Text', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'option_value',
            [
                'label' => esc_html__('Input Field Value', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'option_status',
            [
                'label' => esc_html('Status'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html('Enable'),
                    'disabled' => esc_html('Disable')
                ]
            ]
        );

        $this->add_control(
            'options',
            [
                'label' => esc_html__('Option List', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'option_text' => esc_html__('Item 1', 'romethemeform'),
                        'option_value' => esc_html__('item-1', 'romethemeform'),
                        'option_status' => ''
                    ],
                    [
                        'option_text' => esc_html__('Item 2', 'romethemeform'),
                        'option_value' => esc_html__('item-2', 'romethemeform'),
                        'option_status' => ''
                    ],
                    [
                        'option_text' => esc_html__('Item 3', 'romethemeform'),
                        'option_value' => esc_html__('item-3', 'romethemeform'),
                        'option_status' => ''
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

        $this->start_controls_section('settings_section', [
            'label' => esc_html__('Setting', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control(
            'required_input',
            [
                'label' => esc_html__('Required ?', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'romethemeform'),
                'label_off' => esc_html__('No', 'romethemeform'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Is this field is required for submit the form?. Make it "Yes".', 'romethemeform')
            ]
        );

        $this->add_control('warning_message', [
            'label' => esc_html__('Warning Message', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('This field is required', 'romethemeform'),
            'condition' => [
                'required_input' => 'yes'
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('label_style', [
            'label' => esc_html__('Label', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);

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
                '{{WRAPPER}} .rform-label-select' => 'width:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'label_position' => 'rform-label-left'
            ]
        ]);

        $this->add_control('label_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-label-select' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .rform-label-select',
            ]
        );

        $this->add_responsive_control('label_padding', [
            'label' => esc_html__('Padding', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-label-select' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
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
                '{{WRAPPER}} .rform-label-select' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_control('required_color', [
            'label' => esc_html__('Required Indicator Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-label-select span' => 'color:{{VALUE}}'
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('input_style', [
            'label' => esc_html__('Input', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control('input_padding', [
            'label' => esc_html__('Padding', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-select' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('input_margin', [
            'label' => esc_html__('Margin', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-select' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .rform-select',
            ]
        );

        $this->add_responsive_control('input_border_radius', [
            'label' => esc_html__('Border Radius', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-select' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);

        $this->start_controls_tabs('input_tabs');

        $this->start_controls_tab('input_tab_normal', ['label' => esc_html__('Normal', 'romethemeform')]);
        $this->add_control('input_color_normal', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-select' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-select',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rform-select',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_normal',
                'selector' => '{{WRAPPER}} .rform-select',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('input_tab_hover', ['label' => esc_html__('Hover', 'romethemeform')]);
        $this->add_control('input_color_hover', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-select:hover' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-select:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rform-select:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_hover',
                'selector' => '{{WRAPPER}} .rform-select:hover',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('input_tab_focus', ['label' => esc_html__('Focus', 'romethemeform')]);
        $this->add_control('input_color_focus', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-select:focus' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_focus',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-select:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_focus',
                'selector' => '{{WRAPPER}} .rform-select:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_focus',
                'selector' => '{{WRAPPER}} .rform-select:focus',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('input_tab_warning', ['label' => esc_html__('Invalid', 'romethemeform')]);
        $this->add_control('input_color_warning', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-select[aria-invalid="true"]' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_warning',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-select[aria-invalid="true"]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_warning',
                'selector' => '{{WRAPPER}} .rform-select[aria-invalid="true"]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_warning',
                'selector' => '{{WRAPPER}} .rform-select[aria-invalid="true"]',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('placeholder_style', [
            'label' => esc_html__('Placeholder'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control('placeholder_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-select::placeholder' => 'color:{{VALUE}}',
                '{{WRAPPER}} .rform-select::-webkit-input-placeholder' => 'color:{{VALUE}}',
                '{{WRAPPER}} .rform-select::-ms-input-placeholder' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'placeholder_typography',
				'selector' => '{{WRAPPER}} .rform-select::placeholder',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section('option_style', [
            'label' => esc_html__('Option'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
			'option_padding',
			[
				'label' => esc_html__( 'Padding', 'romethemeform' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [    
					'{{WRAPPER}} .rform-options-container ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'option-border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'romethemeform' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors' => [    
					'{{WRAPPER}} .rform-options-container ul' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_option',
				'selector' => '{{WRAPPER}} .rform-options-container ul',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border_option',
				'selector' => '{{WRAPPER}} .rform-options-container ul',
			]
		);

        $this->start_controls_tabs('options_tabs');

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'option_typography',
                'selector' => '{{WRAPPER}} .rform-option',
            ]
        );

        $this->start_controls_tab('option_tab_normal', ['label' => esc_html('Normal')]);

        $this->add_control('option_color_normal', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-option' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('option_bg_normal', [
            'label' => esc_html('Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-option' => 'background-color: {{VALUE}}'
            ]
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('option_tab_hover', ['label' => esc_html('Hover')]);

        $this->add_control('option_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-option:hover' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('option_bg_hover', [
            'label' => esc_html('Backgrounf Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-option:hover' => 'background-color: {{VALUE}}'
            ]
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('warning_tyle', [
            'label' => esc_html__('Warning', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control(
            'warning_text_align',
            [
                'label' => esc_html__('Alignment', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'romethemeform'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'romethemeform'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'romethemeform'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rform-error' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('warning_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-error' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'warning_typography',
                'selector' => '{{WRAPPER}} .rform-error',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('help_text_style', [
            'label' => esc_html__('Help Text', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'help_text!' => ''
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'help_text_typography',
                'selector' => '{{WRAPPER}} .rform-help-text',
            ]
        );

        $this->add_control('help_text_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-help-text' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_responsive_control('help_text_padding', [
            'label' => esc_html__('Padding', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-help-text' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);


        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $label_text = $settings['label_text'];

?>
        <div class="rform-container">
            <div class="rform-control <?php echo esc_attr($settings['label_position']) ?>">
                <?php if ('yes' === $settings['show_label']) : ?>
                    <label class="rform-label-select" for="rform-select-<?php echo esc_attr($this->get_id_int()); ?>">
                        <?php echo esc_html__($label_text, 'romethemeform') ?>
                        <?php if ('yes' === $settings['required_input']) : ?><span> * </span><?php endif; ?>
                    </label>
                <?php endif; ?>
                <div class="rform-select-container">
                    <div class="rform-select-div">
                        <input id="rform-select-<?php echo esc_attr($this->get_id_int()); ?>" 
                        class="rform-select" type="text"
                        placeholder="<?php echo esc_attr($settings['placeholder_input']) ?>"
                        readonly <?php echo ('yes' === $settings['required_input']) ? esc_attr('required') : '' ?>
                        >
                        <input class="rform-select-input" type="text" name="<?php echo esc_attr($settings['name_input']) ?>" value="" hidden >
                    </div>
                    <div class="rform-options-container">
                        <ul>
                            <?php foreach ($settings['options'] as $option) : ?>
                                <li class="rform-option" data-value="<?php echo $option['option_value']; ?>" <?php echo esc_attr($option['option_status']) ?>><?php echo $option['option_text'] ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <span role="alert" class="rform-error" id="rform-select-err-<?php echo $this->get_id_int(); ?>"><?php echo esc_html__($settings['warning_message'], 'romethemeform') ?></span>
            <div class="rform-help-text">
                <span><?php echo esc_html__($settings['help_text'], 'romethemeform') ?></span>
            </div>
        </div>
<?php
    }
}
