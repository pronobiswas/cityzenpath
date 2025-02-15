<?php


class Rform_Button_Submit extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'rform_button_submit';
    }

    public function get_title()
    {
        return 'RForm - Submit Button';
    }

    public function get_icon()
    {
        return 'rform-widget-icon rtmicon rtmicon-submit-button';
    }

    public function get_categories()
    {
        return ['romethemeform_form_fields'];
    }

    public function show_in_panel()
    {
        return 'romethemeform_form' === get_post_type();
    }
    public function get_keywords()
    {
        return ['text', 'fields', 'input', 'rometheme form'];
    }

    public function get_script_depends()
    {
        return ['rform-script'];
    }

    public function get_style_depends()
    {
        return ['rtform-text-style', 'spinner-style', 'rform-button-style'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_button',
            [
                'label' => __('Button', 'romethemeform'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Submit', 'romethemeform'),
            ]
        );

        $this->add_control(
            'settings_options',
            [
                'label' => esc_html__('Settings', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_fullwidth',
            [
                'label' => esc_html__('Full Width', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'textdomain'),
                'label_off' => esc_html__('No', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'btn_text_align',
            [
                'label' => esc_html__('Button Alignment', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'romethemeform'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'romethemeform'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'romethemeform'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'start',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rform-button-container' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'btn_fullwidth!' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => esc_html__('Icon', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::ICONS,
            ]
        );

        $this->add_control('icon_position', [
            'label' => esc_html__('Icon Position', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'before' => esc_html__('Before', 'romethemeform'),
                'after' => esc_html__('After', 'romethemeform'),
            ],
            'default' => 'before',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('button_style', [
            'label' => esc_html__('Button', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__('Padding', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rform-button-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rform-button-submit , {{WRAPPER}} .loading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .rform-button-submit',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'btn_text_shadow',
                'selector' => '{{WRAPPER}} .rform-button-submit',
            ]
        );

        $this->start_controls_tabs('btn_tabs');
        $this->start_controls_tab('btn_tab_normal', ['label' => esc_html__('Normal', 'romethemeform')]);
        $this->add_control('btn_color_normal', [
            'label' => esc_html__('Text Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-button-submit' => 'color:{{VALUE}}',
                '{{WRAPPER}} #loading' => 'border-top-color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_normal',
                'selector' => '{{WRAPPER}} .rform-button-submit',
            ]
        );

        $this->add_control(
            'border_normal_options',
            [
                'label' => esc_html__('Border', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_normal',
                'selector' => '{{WRAPPER}} .rform-button-submit',
            ]
        );

        $this->add_control(
            'bg_normal_options',
            [
                'label' => esc_html__('Background', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-button-submit , {{WRAPPER}} .loading',
            ]
        );
        $this->end_controls_tab();


        $this->start_controls_tab('btn_tab_hover', ['label' => esc_html__('Hover', 'romethemeform')]);
        $this->add_control('btn_color_hover', [
            'label' => esc_html__('Text Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-button-submit:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_hover',
                'selector' => '{{WRAPPER}} .rform-button-submit:hover',
            ]
        );

        $this->add_control(
            'border_hover_options',
            [
                'label' => esc_html__('Border', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_hover',
                'selector' => '{{WRAPPER}} .rform-button-submit:hover',
            ]
        );
        $this->add_control(
            'bg_hover_options',
            [
                'label' => esc_html__('Background', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-button-submit:hover , {{WRAPPER}} .loading:hover',
            ]
        );
        $this->end_controls_tab();


        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('icon_style', ['label' => esc_html__('Icon', 'romethemeform'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
        $this->add_control('icon_color', [
            'label' => esc_html__('Icon Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-btn-icon' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rform-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_left',
            [
                'label' => esc_html__('Padding Left', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rform-btn-icon' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_position' => 'after'
                ]
            ]
        );

        $this->add_responsive_control(
            'padding_right',
            [
                'label' => esc_html__('Padding Right', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rform-btn-icon' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'icon_position' => 'before'
                ]
            ]
        );


        $this->add_responsive_control(
            'vertical_align',
            [
                'label' => esc_html__('Vertical Align', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => -20,
                        'max' => 20,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => -5,
                        'max' => 5,
                    ],
                    'rem' => [
                        'min' => -5,
                        'max' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rform-btn-icon' => 'transform: translateY({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .rform-btn-icon' => '-webkit-transform: translateY({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>
        <div class="rform-button-container">
            <button class="rform-button-submit <?php echo ($settings['btn_fullwidth'] === 'yes') ? 'rform-btn-fullwidth' : '' ?>" type="button" id="rform-button-submit">
                <?php if ($settings['icon_position'] == 'before') :
                    \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true', 'class' => 'rform-btn-icon']);
                endif; ?>
                <?php echo esc_html__($settings['button_text']); ?>
                <?php if ($settings['icon_position'] == 'after') :
                    \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true', 'class' => 'rform-btn-icon']);
                endif; ?>
                <div class="loading">
                    <div id="loading"></div>
                </div>
            </button>
        </div>


<?php
    }
}
