<?php

class HeaderInfo_Rometheme extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'header-info';
    }

    public function get_title()
    {
        return 'Header Info';
    }
    public function get_icon()
    {
        return 'rkit-widget-icon rtmicon rtmicon-header-info';
    }
    public function get_categories()
    {
        return ['romethemekit_header_footer'];
    }
    public function get_keywords()
    {
        return ['header', 'info', 'header info', 'rometheme'];
    }
    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-header-info-widget/';
    }
    public function get_style_depends()
    {
        return ['rkit-headerinfo-style'];
    }
    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => 'Header Info',
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_responsive_control(
            'header_info_layout',
            [
                'label' => esc_html__('Layout', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html('Inline'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                    'column' => [
                        'title' => esc_html('List'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-headerinfo' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $headerinfogroup = new \Elementor\Repeater();
        $headerinfogroup->add_control(
            'rkit_headerinfo_icons',
            [
                'label'         => esc_html__('Icon', 'rometheme-for-elementor'),
                'label_block'   => true,
                'type'          => \Elementor\Controls_Manager::ICONS,
                'default'       => [
                    'value'         => 'rtmicon rtmicon-pin-map-location',
                    'library'       => 'rtmicons-regular',
                ],

            ]
        );

        $headerinfogroup->add_control(
            'rkit_headerinfo_text',
            [
                'label' => esc_html__('Text', 'rometheme-for-elementor'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Pekanbaru, Indonesia',
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );
        $headerinfogroup->add_control(
            'rkit_headerinfo_link',
            [
                'label' => esc_html__('Link', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('example: https://your-link.com', 'rometheme-for-elementor'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'rkit_headerinfo_group',
            [
                'label' => esc_html__('Info', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $headerinfogroup->get_controls(),
                'default' => [
                    [
                        'rkit_headerinfo_text' => esc_html__('Pekanbaru, Indonesia', 'rometheme-for-elementor'),
                    ],

                ],
                'title_field' => '{{{ rkit_headerinfo_text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('style_section', [
            'label' => esc_html__('Header Info', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);


        $this->add_responsive_control(
            'header_info_align',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-headerinfo' => 'justify-content: {{VALUE}}; align-items : {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control('headerinfo-margin', [
            'label' => esc_html__('Margin', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo' => 'margin : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('headerinfo-padding', [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo' => 'padding : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);


        $this->add_responsive_control('headerinfo-row-gap', [
            'label' => esc_html__('Info Row Spacing', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'size' => 10,
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo' => 'row-gap : {{SIZE}}{{UNIT}}'
            ],
        ]);


        $this->add_responsive_control('headerinfo-column-gap', [
            'label' => esc_html__('Info Column Spacing', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'size' => 10,
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo' => 'column-gap : {{SIZE}}{{UNIT}}'
            ],
        ]);


        $this->end_controls_section();

        $this->start_controls_section('text_style', [
            'label' => esc_html('Text'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text-typography',
                'selector' => '{{WRAPPER}} .rkit-headerinfo-text'
            ]
        );

        $this->start_controls_tabs('text-controls');

        $this->start_controls_tab('text-control-normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_control('headerinfo-text-color', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo-text' => 'color : {{VALUE}}',
            ],
        ]);

        $this->add_control('headerinfo-list-background', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-list-headerinfo' => 'background-color: {{VALUE}}'
            ],
        ]);
        $this->end_controls_tab();

        $this->start_controls_tab('text-control-hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_control('hover-text-color', [
            'label' => 'Text Color',
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo-text:hover' => 'color : {{VALUE}}',
            ],
        ]);
        $this->add_control('headerinfo-hover-background', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-list-headerinfo:hover' => 'background-color: {{VALUE}}'
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('icon_style', [
            'label' => esc_html('Icon'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control('headerinfo-iconsize', [
            'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'devices' => ['desktop', 'tablet', 'mobile'],
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 20
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo-icon' => 'font-size: {{SIZE}}{{UNIT}}'
            ],
        ]);

        $this->add_responsive_control('icon-spacing', [
            'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'devices' => ['desktop', 'tablet', 'mobile'],
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'size' => 10,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-list-headerinfo' => 'gap: {{SIZE}}{{UNIT}}'
            ],
        ]);

        $this->start_controls_tabs('icon_tabs');

        $this->start_controls_tab('icon_tab_normal', [
            'label' => esc_html('Normal')
        ]);

        $this->add_control('icon-headerinfo-color', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-headerinfo-icon' => 'color : {{VALUE}}',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('icon_tab_hover', [
            'label' => esc_html('Hover')
        ]);

        $this->add_control('icon-headerinfo-color_hover', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-list-headerinfo:hover .rkit-headerinfo-icon' => 'color : {{VALUE}}',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        echo '<div class="rkit-headerinfo">';
        foreach ($settings['rkit_headerinfo_group'] as $key => $setting) :
            if (!empty($setting['rkit_headerinfo_link']['url'])) {
                $this->add_link_attributes('button-' . $key, $setting['rkit_headerinfo_link']);
            }
?>
            <div class="rkit-list-headerinfo">
                <div class="rkit-headerinfo-icon">
                    <?php Elementor\Icons_Manager::render_icon($setting['rkit_headerinfo_icons'], ['aria-hidden' => 'true']); ?>
                </div>
                <a class="rkit-headerinfo-text" <?php $this->print_render_attribute_string('button-' . $key) ?>> <?php echo esc_html__($setting['rkit_headerinfo_text'], 'rometheme-for-elementor') ?></a>
            </div>
<?php endforeach;
        echo '</div>';
    }
}
