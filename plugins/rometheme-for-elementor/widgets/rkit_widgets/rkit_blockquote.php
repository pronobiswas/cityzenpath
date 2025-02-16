<?php

class Rkit_BLockQuote extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rtm_blockquote';
    }

    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['blockquote']['name'];
    }
    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['blockquote']['icon'];
        return $icon;
    }
    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }
    public function get_keywords()
    {
        return ['rtm', 'quote', 'blockquote'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-blockquote-widget/';
    }

    public function get_style_depends()
    {
        return ['rkit-blockquote'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('select_layout', [
            'label' => esc_html('Layout'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'top' => esc_html('Top'),
                'inline' => esc_html('Inline'),
                'absolute' => esc_html('Absolute')
            ],
            'default' => 'top'
        ]);

        $this->add_control('text_tag', [
            'label' => esc_html('Text Tag'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'h1' => esc_html('H1'),
                'h2' => esc_html('H2'),
                'h3' => esc_html('H3'),
                'h4' => esc_html('H4'),
                'h5' => esc_html('H5'),
                'h6' => esc_html('H6'),
                'span' => esc_html('SPAN'),
            ],
            'default' => 'span'
        ]);

        $this->add_control('quote_author' , [
            'label' => esc_html('Author'),
            'type' => \Elementor\Controls_Manager::TEXT ,
            'default' => esc_html('John Doe')
        ]);

        $this->add_control(
            'quote_text',
            [
                'label' => esc_html__('Text', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus ultrices erat ut ante fermentum, sed molestie tellus luctus. Donec et dignissim nunc. Morbi aliquet risus eu odio efficitur vehicula. Duis ac scelerisque quam, at placerat diam.', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your text here', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control(
            'quote_icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-quote',
                    'library' => 'rtmicons',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html('Style'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .rkit-blockquote',
            ]
        );

        $this->add_responsive_control(
			'blockquote_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rkit-blockquote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'selector' => '{{WRAPPER}} .rkit-blockquote',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('text_style', [
            'label' => esc_html('Text Style'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'text_align',
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
                    'justify' => [
                        'title' => esc_html__('Justify', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ]
                ],
                'default' => 'justify',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-blockquote' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .rkit-blockquote',
            ]
        );

        $this->add_control('text_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-blockquote' => 'color:{{VALUE}}'
            ]
        ]);
        $this->end_controls_section();

        $this->start_controls_section('author_style' , [
            'label' => esc_html('Author'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control('author_color' , [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-quote-author' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'selector' => '{{WRAPPER}} .rkit-quote-author',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section('icon_style', [
            'label' => esc_html('Icon Style'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rometheme-for-elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rometheme-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rometheme-for-elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rkit-quote-icon' => 'justify-content: {{VALUE}};',
				],
                'condition' => [
                    'select_layout!' => 'inline'
                ]
			]
		);

        $this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Position', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'rometheme-for-elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rometheme-for-elementor' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'rometheme-for-elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rkit-quote-icon' => 'align-items: {{VALUE}};',
				],
                'condition' => [
                    'select_layout' => 'absolute'
                ]
			]
		);

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control('icon_color', [
            'label' => esc_html('Icon Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-quote-icon .rkit-blockquote__icon' => 'color:{{VALUE}}'
            ]
        ]);
        

        $this->end_controls_section();

        $this->start_controls_section('spacing_section', [
            'label' => esc_html('Spacing'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control(
            'holder_padding',
            [
                'label' => esc_html__('Holder Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'top_margin',
            [
                'label' => esc_html__('Top Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem'],
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
                    '{{WRAPPER}} .rkit-blockquote' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-quote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'author_gap',
			[
				'label' => esc_html__( 'Author Gap', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
                'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .rkit-quote-author' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        switch ($settings['text_tag']) {
            case 'h1':
                $text_tag = 'h1';
                break;
            case 'h2':
                $text_tag = 'h2';
                break;
            case 'h3':
                $text_tag = 'h3';
                break;
            case 'h4':
                $text_tag = 'h4';
                break;
            case 'h5':
                $text_tag = 'h5';
                break;
            case 'h6':
                $text_tag = 'h6';
                break;
            case 'span' :
                $text_tag = 'span';
                break;
            default:
                $text_tag = 'span';
                break;
        }
?>

        <div class="rkit-blockquote <?php echo esc_attr('blockquote-' . $settings['select_layout']) ?>">
            <?php
            switch ($settings['select_layout']) {
                case 'inline':
            ?>
                    <<?php echo esc_html($text_tag) ?>>
                        <span class="rkit-quote-icon">
                            <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-blockquote__icon']); ?>
                        </span>
                        <?php echo esc_html($settings['quote_text']) ?>
                    </<?php echo esc_html($text_tag) ?>>
                    <span class="rkit-quote-author">
                        <?php echo esc_html($settings['quote_author']) ?>
                    </span>
                    
                <?php
                    break;
                default:
                ?>
                    <div class="rkit-quote-icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['quote_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-blockquote__icon']); ?>
                    </div>
                    <<?php echo esc_html($text_tag) ?>><?php echo esc_html($settings['quote_text']) ?></<?php echo esc_html($text_tag) ?>>
                    <span class="rkit-quote-author">
                        <?php echo esc_html($settings['quote_author']) ?>
                    </span>
            <?php
                    break;
            }

            ?>
        </div>

<?php
    }
}
