<?php

class Rkit_advanced_heading extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit_advanced_heading';
    }
    public function get_title()
    {
        return 'Advanced Heading';
    }

    public function get_icon()
    {
        return 'rkit-widget-icon eicon-animated-headline';
    }

    public function get_keywords()
    {
        return ['rometheme', 'heading', 'animation', 'advanced', 'animation text', ' heading'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-advanced-heading-widget/';
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_style_depends()
    {
        return ['rkit-advanced_heading-style'];
    }
    protected function is_dynamic_content(): bool
    {
        return false;
    }
    protected function register_controls()
    {
        $this->start_controls_section('content_section', ['label' => esc_html('Content'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Rometheme Studio {{Widget Plugin}}', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your text here', 'rometheme-for-elementor'),
                'description' => esc_html('The {{ }} symbols are used to indicate that the text will be given animation effects. If there are multiple texts, separate them with commas inside the {{ }}.')
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
                'label' => esc_html__('Text Alignment', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-advanced-heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_align',
            [
                'label' => esc_html__('Content Position', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-advanced-heading' => 'justify-content: {{VALUE}};',
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

        $this->add_control('html_tag', [
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

        // stylee ========================================================================================

        $this->start_controls_section('Container', [
            'label' => esc_html('Container'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);



        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'cont_advanced',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .rkit-advanced-heading',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow_ah',
                'label' => __('Container Box Shadow', 'plugin-name'),
                'selector' => '{{WRAPPER}} .rkit-advanced-heading',
                'description' => esc_html__('Put 0 for no box shadow ', 'text-domain'),
            ]
        );

        $this->add_control(
            'cont_advanced_padding',
            [
                'label' => esc_html__('Container Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-advanced-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cont_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-advanced-heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();





        // style headline text
        $this->start_controls_section('headline_text_style', [
            'label' => esc_html('Headline'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'head_typography',
                'selector' => '{{WRAPPER}} .headline_text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'head_text_stroke',
                'selector' => '{{WRAPPER}} .headline_text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'head_text_shadow',
                'selector' => '{{WRAPPER}} .headline_text',
            ]
        );

        $this->add_control(
            'headtext_padding',
            [
                'label' => esc_html__('Text head Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .headline_text ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'head_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .bg-headline' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'textcolorhead',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'headtext_background',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .headline_text',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html('Text Color')
                    ]
                ]
            ]
        );

        $this->add_control(
            'bgtextcolorhead',
            [
                'label' => esc_html__('Container Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'bg_head',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .bg-headline',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html('Background Color'),
                    ]
                ]
            ]
        );

        $this->end_controls_section();

        // style wrap headline text
        $this->start_controls_section('wrap_headline_text_style', [
            'label' => esc_html('Headline Standart'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'wrap_head_typography',
                'selector' => '{{WRAPPER}} .std-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'wrap_head_text_stroke',
                'selector' => '{{WRAPPER}} .std-text',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'wrap_head_text_shadow',
                'selector' => '{{WRAPPER}} .std-text',
            ]
        );

        $this->add_control(
            'wrap_headtext_padding',
            [
                'label' => esc_html__('Text head Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .std-text ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'wrap_textcolorhead',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'wrap_headtext_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .std-text',
                'fields_options' => [
                    'background' => [
                        'label' => esc_html('Text Color')
                    ]
                ]
            ]
        );



        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $string = $settings['text'];
        $newString = preg_replace_callback(
            '/\{\{([^}]+)\}\}/',
            function ($matches) use ($settings) {
                $innerString =  str_replace(['[', ']'], '', $matches[1]);
                $arrayData = explode(', ', $innerString);
                $dataAttribute = json_encode($arrayData);
                return " <span class='bg-headline'>
                            <span class='headline_text'> " . esc_attr($innerString) . "</span>
                        </span>";
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
        <a <?php $this->print_render_attribute_string('_link') ?>>
            <<?php echo $html_tag ?> class="rkit-advanced-heading">

                <span class="std-text rkit-trp-text"> <?php echo $newString; ?> </span>

            </<?php echo $html_tag ?>>
        </a>


<?php
    }
}
?>