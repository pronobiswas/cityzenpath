<?php

class Rkit_AnimatedHeading extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-animated-heading';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['animatedheading']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['animatedheading']['icon'];
        return $icon;
    }

    public function get_keywords()
    {
        return ['rometheme', 'heading', 'animation', 'animation text', 'animation heading'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-animated-heading-widget/';
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_style_depends()
    {
        return ['rkit-animated_heading-style'];
    }

    public function get_script_depends()
    {
        return ['animated-heading-script'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', ['label' => esc_html('Content'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control('style_select', [
            'label' => esc_html('Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'highlighted' => esc_html('Higlighted'),
                'rotating' => esc_html('Rotating'),
            ],
            'default' => 'rotating'
        ]);

        $this->add_control('animation_select', [
            'label' => esc_html('Animation'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'text-writing' => esc_html('Typing'),
                'text-flipping' => esc_html('Flip'),
                'text-sliding_down' => esc_html('Slide Down'),
                'text-sliding_up' => esc_html('Slide Up'),
                'text-drop-in' => esc_html('Drop In'),
                'text-drop-out' => esc_html('Drop Out'),
            ],
            'default' => 'text-sliding_down',
            'condition' => [
                'style_select' => 'rotating'
            ]
        ]);

        $this->add_control('highlight_select', [
            'label' => esc_html('Shape'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'circle' => esc_html('Circle'),
                'curly' => esc_html('Curly'),
                'underline' => esc_html('Underline'),
                'double' => esc_html('Double'),
                'double_underline' => esc_html('Double Underline'),
                'underline_zigzag' => esc_html('Underline Zigzag'),
                'diagonal' => esc_html('Diagonal'),
                'strikethrough' => esc_html('Strikethrough'),
                'x' => esc_html('X')
            ],
            'default' => 'circle',
            'condition' => [
                'style_select' => 'highlighted'
            ]
        ]);

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Example {{Heading 1, Heading 2, Heading 3}} for this {{ Faster , Bigger, Better}} page', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your text here', 'rometheme-for-elementor'),
                'description' => esc_html('The {{ }} symbols are used to indicate that the text will be given animation effects. If there are multiple texts, separate them with commas inside the {{ }}.')
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'duration',
            [
                'label' => esc_html__('Duration (ms)', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'step' => 5,
                'default' => 2000,
            ]
        );

        $this->add_control(
            'hr_link',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'rometheme-for-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'rometheme-for-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'rometheme-for-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rkit-animated-heading' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            '_link',
            [
                'label' => esc_html__('Link', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'rometheme-for-elementor'),
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    // 'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );

        $this->add_control('html_tag' , [
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

        $this->end_controls_section();

        $this->start_controls_section('shape_style' , [
            'label' => esc_html('Shape'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'style_select' => 'highlighted'
            ]
        ]);

        $this->add_control('shape_color' , [
            'label' => esc_html('Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-animated-heading__text svg' => 'stroke:{{VALUE}}'
            ]
        ]);

        $this->add_control('shape_width' , [
            'label' => esc_html('Width'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .rkit-animated-heading__text svg' => 'stroke-width: {{SIZE}}{{UNIT}};'
            ]
        ]);

        $this->add_control(
			'bring_to_front',
			[
				'label' => esc_html__( 'Bring to Front', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'rometheme-for-elementor' ),
				'label_off' => esc_html__( 'No', 'rometheme-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section('headline_style' , [
            'label' => esc_html('Headline'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'headline_typography',
				'selector' => '{{WRAPPER}} .rkit-animated-heading',
			]
		);

        $this->add_control('headline_color' , [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-animated-heading' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'headline_text_stroke',
				'selector' => '{{WRAPPER}} .rkit-animated-heading',
			]
		);

        $this->add_control(
			'animation_options',
			[
				'label' => esc_html__( 'Animated Text', 'rometheme-for-elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'animated_typography',
				'selector' => '{{WRAPPER}} .rkit-animated-heading__text',
			]
		);

        $this->add_control('animated_color' , [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-animated-heading__text' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'animated_text_stroke',
				'selector' => '{{WRAPPER}} .rkit-animated-heading__text',
			]
		);
        
        $this->end_controls_section();


    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $string = $settings['text'];
        if ($settings['style_select'] == 'highlighted') {
            switch ($settings['highlight_select']) {
                case 'circle':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M325,18C228.7-8.3,118.5,8.3,78,21C22.4,38.4,4.6,54.6,5.6,77.6c1.4,32.4,52.2,54,142.6,63.7 c66.2,7.1,212.2,7.5,273.5-8.3c64.4-16.6,104.3-57.6,33.8-98.2C386.7-4.9,179.4-1.4,126.3,20.7"></path></svg>';
                    break;
                case 'curly':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M3,146.1c17.1-8.8,33.5-17.8,51.4-17.8c15.6,0,17.1,18.1,30.2,18.1c22.9,0,36-18.6,53.9-18.6 c17.1,0,21.3,18.5,37.5,18.5c21.3,0,31.8-18.6,49-18.6c22.1,0,18.8,18.8,36.8,18.8c18.8,0,37.5-18.6,49-18.6c20.4,0,17.1,19,36.8,19 c22.9,0,36.8-20.6,54.7-18.6c17.7,1.4,7.1,19.5,33.5,18.8c17.1,0,47.2-6.5,61.1-15.6"></path></svg>';
                    break;
                case 'underline':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7"></path></svg>';
                    break;
                case 'double':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M8.4,143.1c14.2-8,97.6-8.8,200.6-9.2c122.3-0.4,287.5,7.2,287.5,7.2"></path><path d="M8,19.4c72.3-5.3,162-7.8,216-7.8c54,0,136.2,0,267,7.8"></path></svg>';
                    break;
                case 'double_underline':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M5,125.4c30.5-3.8,137.9-7.6,177.3-7.6c117.2,0,252.2,4.7,312.7,7.6"></path><path d="M26.9,143.8c55.1-6.1,126-6.3,162.2-6.1c46.5,0.2,203.9,3.2,268.9,6.4"></path></svg>';
                    break;
                case 'underline_zigzag':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path></svg>';
                    break;
                case 'diagonal':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M13.5,15.5c131,13.7,289.3,55.5,475,125.5"></path></svg>';
                    break;
                case 'strikethrough':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M3,75h493.5"></path></svg>';
                    break;
                case 'x':
                    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none"><path d="M497.4,23.9C301.6,40,155.9,80.6,4,144.4"></path><path d="M14.1,27.6c204.5,20.3,393.8,74,467.3,111.7"></path></svg>';
                    break;
            }
        } else {
            $svg = '';
        }

        $newString = preg_replace_callback(
            '/\{\{([^}]+)\}\}/',
            function ($matches) use ($settings, $svg) {
                $innerString = $matches[1];
                $arrayData = explode(', ', $innerString);
                $dataAttribute = json_encode($arrayData);
                $css = ($settings['style_select'] == 'rotating') ? $settings['animation_select'] : ( ($settings['bring_to_front'] === 'yes') ? 'rkit-highlighted in_front' : 'rkit-highlighted' );
                return "<p class='rkit-animated-heading__text " . esc_attr($css) . "' data-type='" . esc_attr($dataAttribute) . "'>" . $svg . "</p>";
            },
            $string
        );

        if (!empty($settings['_link']['url'])) {
            $this->add_link_attributes('_link', $settings['_link']);
        }

        switch ($settings['html_tag']) {
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
        <a <?php echo esc_attr($this->get_render_attribute_string( '_link' )) ?>>
            <<?php echo esc_html($html_tag) ?> class="rkit-animated-heading" data-duration="<?php echo esc_attr($settings['duration']) ?>">
                <?php
                echo $newString;
                ?>
            </<?php echo esc_html($html_tag) ?>>
        </a>
<?php
    }
}
