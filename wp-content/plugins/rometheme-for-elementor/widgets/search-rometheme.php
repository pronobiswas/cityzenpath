<?php

use Elementor\Conditions;

class Search_Rometheme extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-search';
    }

    public function get_title()
    {
        return 'Search';
    }

    public function get_icon()
    {
        return 'rkit-widget-icon rtmicon rtmicon-search';
    }

    public function get_categories()
    {
        return ['romethemekit_header_footer'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-search-widget/';
    }

    public function get_style_depends()
    {
        return ['rkit-search-style'];
    }

    public function get_keywords()
    {
        return ['search', 'rometheme'];
    }

    public function register_controls()
    {
        $this->start_controls_section('search_setting', [
            'label' => esc_html__('Search Setting', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'search_text',
            [
                'label' => esc_html__('Sumbit Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Search', 'textdomain'),
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__('Submit Icon', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('search_icon', [
            'label' => esc_html__('Search Icon', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'rtmicon rtmicon-search',
                'library' => 'rtmicons'
            ],
            'condition' => [
                'show_icon' => 'yes'
            ]
        ]);

        $this->add_control('search-position', [
            'label' => esc_html__('Search Button Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'row-reverse' => 'Start',
                'row' => 'End',
            ],
            'default' => 'row',
            'selectors' => [
                '{{WRAPPER}} .rkit-search' => 'flex-direction:{{VALUE}}'
            ]
        ]);

        $this->add_control('input-placeholder', [
            'label' => esc_html__('Placeholder', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Type to start searching...',
            'placeholder' => 'Type your Input Placeholder Here'
        ]);

        $this->add_control(
            'autocomplete',
            [
                'label' => esc_html__('Autocomplete', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'description' => esc_html('The autocomplete feature enables the browser to match patterns against a list of values that are locally kept with the browser and provides the relevant value when the input is programmatically tagged.'),
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section('search-style', [
            'label' => esc_html__('Search Field', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .rkit-search-input',
            ]
        );


        $this->add_control('placeholder-color', [
            'label' => esc_html__('Placeholder Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#b0b0b0',
            'selectors' => [
                '{{WRAPPER}} .rkit-search-input::placeholder' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('search-borderradius', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('searchinput-padding', [
            'label' => esc_html__('Input Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->add_control(
			'input_spacing',
			[
				'label' => esc_html__( 'Gap between input and button', 'textdomain' ),
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
					'{{WRAPPER}} .rkit-search' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs('search-setting');
        $this->start_controls_tab('input-style', [
            'label' => esc_html__('Normal', 'rometheme-for-elementor')
        ]);

        $this->add_control('input-text-color', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-search-input' => 'color:{{VALUE}}'
            ]
        ]);



        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input-bgcolor',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-search-input',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => esc_html__('box-shadow-field', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-search-input',
            ]
        );


        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'Border',
            'selector' => '{{WRAPPER}} .rkit-search-input',
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('input-focus', ['label' => 'Focus']);

        $this->add_control('input-text-color-focus', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-search-input:focus' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input-focus-bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-search-input:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => esc_html__('box-shadow-focus', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-search-input:focus',
            ]
        );

        $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
            'name' => 'Border_focus',
            'selector' => '{{WRAPPER}} .rkit-search-input:focus',
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section('search-submit-setting', [
            'label' => esc_html__('Submit Button', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'submit_typography',
                'selector' => '{{WRAPPER}} .rkit-search-button',
                'condition' => [
                    'search_text!' => ''
                ]
            ]
        );

        $this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-h-align-left',
					],
					'row-reverse' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rkit-search-button' => 'flex-direction: {{VALUE}};',
				],
                'condition' => [
                    'show_icon'  => 'yes'
                ]
			]
		);

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-search .rkit-search-button' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon' => 'yes',
                    'search_text!' => ''
                ]
            ]
        );


        $this->add_responsive_control(
            'search_icon_size',
            [
                'label' => esc_html__('Icon Size', 'textdomain'),
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
                    '{{WRAPPER}} .rkit-search-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control('searchicon-padding', [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-search-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->add_responsive_control('search-button-radius', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-search-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->start_controls_tabs('icon-setting-tab');

        $this->start_controls_tab('icon-tab-normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);


        $this->add_control('searchtext-color', [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            // 'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .rkit-search-button' => 'color : {{VALUE}}',
            ],
            'condition' => [
                'search_text!' => ''
            ]
        ]);

        $this->add_control('searchicon-color', [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            // 'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .rkit-search-button .rkit-search-icon  ' => 'color : {{VALUE}}',
            ],
            'condition' => [
                'show_icon' => 'yes'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button-background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-search-button',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab('icon-tab-hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);

        $this->add_control('searchtext-color-hover', [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            // 'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .rkit-search-button:hover' => 'color : {{VALUE}}',
            ],
            'condition' => [
                'search_text!' => ''
            ]
        ]);

        $this->add_control('searchicon-color-hover', [
            'type' => \Elementor\Controls_Manager::COLOR,
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            // 'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .rkit-search-button:hover .rkit-search-icon' => 'color : {{VALUE}}',
            ],
            'condition' => [
                'show_icon' => 'yes'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button-background-hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-search-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $autocomplete = ($settings['autocomplete'] === 'yes') ? 'on' : 'off';
?>
        <form action="<?php echo esc_url(get_home_url()) ?>" method="get">
            <div class="rkit-search">
                <input class="rkit-search-input" type="text" name="s" id="s" autocomplete="<?php echo esc_attr($autocomplete) ?>" placeholder="<?php echo esc_attr__($settings['input-placeholder'], 'rometheme-for-elementor'); ?>">
                <button class="rkit-search-button" type="submit">
                    <?php \Elementor\Icons_Manager::render_icon($settings['search_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-search-icon']); ?>
                    <?php echo esc_html($settings['search_text']) ?>
                </button>
            </div>
        </form>
<?php
    }
}
