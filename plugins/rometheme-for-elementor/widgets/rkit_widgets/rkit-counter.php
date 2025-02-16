<?php

class Rkit_Counter extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-counter';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['counter']['name'];
    }
    public function get_keywords()
    {
        return ['rtm', 'counter'];
    }
    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['counter']['icon'];
        return $icon;
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-counter-widget/';
    }
    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }
    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('starting_number', [
            'label' => esc_html('Starting Number'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 0
        ]);

        $this->add_control('ending_number', [
            'label' => esc_html('Ending Number'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 1000
        ]);

        $this->add_control('increment_step', [
            'label' => esc_html('Increment Step'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 10
        ]);

        $this->add_control('number_suffix', [
            'label' => esc_html('Number Suffix'),
            'type' => \Elementor\Controls_Manager::TEXT
        ]);

        $this->add_control(
            'counter_duration',
            [
                'label' => esc_html__('Animation Duration', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1000
                ]
            ]
        );

        $this->add_control(
            'thousand_separator',
            [
                'label' => esc_html__('Thousand Separator', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('separator', [
            'label' => esc_html('Separator'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'comma' => esc_html('Comma'),
                'dot' => esc_html('Dot'),
                'space' => esc_html('Space'),
                'underline' => esc_html('Underline'),
                'apostrophe' => esc_html('Apostrophe')
            ],
            'default' => 'comma',
            'condition' => [
                'thousand_separator' => 'yes'
            ]
        ]);

        $this->add_control('text_title', [
            'label' => esc_html('Title'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html('Great Number')
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html('General'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'counter_align',
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-counter' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_options',
            [
                'label' => esc_html__('Number', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('number_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-counter .counter' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .rkit-counter .counter',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'number_text_stroke',
                'selector' => '{{WRAPPER}} .rkit-counter .counter',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'number_text_shadow',
                'selector' => '{{WRAPPER}} .rkit-counter .counter',
            ]
        );

        $this->add_control(
            'title_options',
            [
                'label' => esc_html__('Title', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'rometheme-for-elementor' ),
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
					'{{WRAPPER}} .rkit-counter .counter-container' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control('title_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-counter .counter-title' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rkit-counter .counter-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'title_text_stroke',
                'selector' => '{{WRAPPER}} .rkit-counter .counter-title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .rkit-counter .counter-title',
            ]
        );

        $this->add_control(
            'suffix_options',
            [
                'label' => esc_html__('Suffix', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'number_suffix!' => '' 
                ]
            ]
        );

        $this->add_responsive_control(
			'suffix_spacing',
			[
				'label' => esc_html__( 'Suffix Spacing', 'rometheme-for-elementor' ),
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
					'{{WRAPPER}} .rkit-counter .counter-container .counter' => 'gap: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'number_suffix!' => '' 
                ]
			]
		);
        $this->add_control('suffix_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-counter .counter-suffix' => 'color:{{VALUE}}'
            ]
        ]);

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $thousand = [
            'thousand_separator' => ($settings['thousand_separator'] === 'yes') ? true : false,
            'separator' => $settings['separator']
        ];
?>
        <div class="rkit-counter" data-start="<?php echo esc_attr($settings['starting_number']) ?>" data-value="<?php echo esc_attr($settings['ending_number']) ?>" data-duration="<?php echo esc_attr($settings['counter_duration']['size']) ?>" data-step="<?php echo esc_attr($settings['increment_step']) ?>" data-separator="<?php echo esc_attr(json_encode($thousand)) ?>">
            <div class="counter-container">
                <div class="counter">
                    <span class="count"></span>
                    <span class="counter-suffix"><?php echo esc_html($settings['number_suffix']) ?></span>
                </div>
                <span class="counter-title"><?php echo esc_html($settings['text_title']) ?></span>
            </div>
        </div>
<?php
    }
}
