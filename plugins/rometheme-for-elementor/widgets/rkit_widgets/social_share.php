<?php

class Rkit_SocialShare extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rtm-social_share';
    }

    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['socialshare']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon ' . \RomethemeKit\RkitWidgets::listWidgets()['socialshare']['icon'];
        return $icon;
    }

    public function get_keywords()
    {
        return ['social', 'rtm', 'share', 'social share'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-social-share-widget/';
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_style_depends()
    {
        return ['rkit-social-share'];
    }

    public function get_script_depends()
    {
        return ['social-share-script'];
    }
    protected function register_controls()
    {
        $this->start_controls_section('social_content', [
            'label' => esc_html('Social Media'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('select_style', [
            'label' => esc_html__('Choose Style', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'icon' => esc_html('Icon'),
                'text' => esc_html('Text'),
                'both' => esc_html('Both')
            ],
            'default' => 'both'
        ]);

        $this->add_control('select_skin', [
            'label' => esc_html__('Choose Skin', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'outline' => esc_html('Outline'),
                'framed' => esc_html('Framed'),
                'flat' => esc_html('Flat'),
                'flat-on-hover' => esc_html('Flat On Hover'),
                'pointer' => esc_html('Pointer'),
                'pointer-on-hover' => esc_html('Pointer On Hover'),
            ],
            'default' => 'flat',
            'condition' => [
                'select_color' => 'official'
            ]
        ]);

        $ss = new \Elementor\Repeater();

        $ss->add_control(
            'social_icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
            ]
        );

        $ss->add_control('social_select', [
            'label' => esc_html__('Social Media', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'facebook',
            'options' => [
                'facebook'      => esc_html__('Facebook', 'rometheme-for-elementor'),
                'twitter'       => esc_html__('Twitter', 'rometheme-for-elementor'),
                'pinterest'     => esc_html__('Pinterest', 'rometheme-for-elementor'),
                'linkedin'      => esc_html__('Linkedin', 'rometheme-for-elementor'),
                'quora'      => esc_html__('Quora', 'rometheme-for-elementor'),
                // 'tumblr'        => esc_html__('Tumblr', 'rometheme-for-elementor'),
                // 'snapchat'        => esc_html__( 'Snapchat', 'rometheme-for-elementor' ),
                // 'flicker'        => esc_html__('Flicker', 'rometheme-for-elementor'),
                // 'vkontakte'     => esc_html__('Vkontakte', 'rometheme-for-elementor'),
                // 'odnoklassniki' => esc_html__('Odnoklassniki', 'rometheme-for-elementor'),
                // 'moimir'        => esc_html__('Moimir', 'rometheme-for-elementor'),
                // 'live journal'   => esc_html__('Live journal', 'rometheme-for-elementor'),
                // 'blogger'       => esc_html__('Blogger', 'rometheme-for-elementor'),
                // 'digg'          => esc_html__('Digg', 'rometheme-for-elementor'),
                // 'evernote'      => esc_html__('Evernote', 'rometheme-for-elementor'),
                'reddit'        => esc_html__('Reddit', 'rometheme-for-elementor'),
                // 'delicious'     => esc_html__('Delicious', 'rometheme-for-elementor'),
                // 'stumbleupon'   => esc_html__('Stumbleupon', 'rometheme-for-elementor'),
                // 'pocket'        => esc_html__('Pocket', 'rometheme-for-elementor'),
                // 'surfingbird'   => esc_html__('Surfingbird', 'rometheme-for-elementor'),
                // 'liveinternet'  => esc_html__('Liveinternet', 'rometheme-for-elementor'),
                // 'buffer'        => esc_html__('Buffer', 'rometheme-for-elementor'),
                // 'instapaper'    => esc_html__('Instapaper', 'rometheme-for-elementor'),
                // 'xing'          => esc_html__('Xing', 'rometheme-for-elementor'),
                // 'wordpress'     => esc_html__('WordPress', 'rometheme-for-elementor'),
                // 'baidu'         => esc_html__('Baidu', 'rometheme-for-elementor'),
                // 'renren'        => esc_html__('Renren', 'rometheme-for-elementor'),
                // 'weibo'         => esc_html__('Weibo', 'rometheme-for-elementor'),
                // 'skype'         => esc_html__('Skype', 'rometheme-for-elementor'),
                'telegram'      => esc_html__('Telegram', 'rometheme-for-elementor'),
                'viber'         => esc_html__('Viber', 'rometheme-for-elementor'),
                'whatsapp'      => esc_html__('Whatsapp', 'rometheme-for-elementor'),
                'line'          => esc_html__('Line', 'rometheme-for-elementor'),
            ],
        ]);

        $ss->add_control('label_social', [
            'label' => esc_html__('Label', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $this->add_control('social_media', [
            'label' => esc_html('Add Social Media'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $ss->get_controls(),
            'default' => [
                [
                    'label_social' => 'Facebook',
                    'social_select' => 'facebook',
                    'social_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'fa-brands'],
                ],
                [
                    'label_social' => 'Twitter',
                    'social_select' => 'twitter',
                    'social_icon' => ['value' => 'fab fa-x-twitter', 'library' => 'fa-brands'],
                ],
                [
                    'label_social' => 'Whatsapp',
                    'social_select' => 'whatsapp',
                    'social_icon' => ['value' => 'fab fa-whatsapp', 'library' => 'fa-brands'],
                ],
                [
                    'label_social' => 'Telegram',
                    'social_select' => 'telegram',
                    'social_icon' => ['value' => 'fab fa-telegram-plane', 'library' => 'fa-brands'],
                ],
            ],
            'title_field' => '{{{ label_social }}}',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('social_media_style', ['label' => esc_html('Social Media'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'social_typography',
                'selector' => '{{WRAPPER}} .rkit-social-share__link',
            ]
        );

        $this->add_responsive_control(
            'social_direction',
            [
                'label' => esc_html__('Direction', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Horizontal', 'rometheme-for-elementor'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'column' => [
                        'title' => esc_html__('Vertical', 'rometheme-for-elementor'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-media__list' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_fullwidth',
            [
                'label' => esc_html__('Fullwidth ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'fullwidth',
                'default' => '',
                'condition' => [
                    'social_direction' => 'column'
                ]
            ]
        );

        $this->add_responsive_control(
            'social_alignment',
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
                    '{{WRAPPER}} .rkit-social-media__list' => 'justify-content: {{VALUE}};'
                ],
                'condition' => [
                    'social_direction' => 'row'
                ]
            ]
        );

        $this->add_responsive_control(
            'social_alignment_column',
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
                    '{{WRAPPER}} .rkit-social-media__list' => 'align-items: {{VALUE}};'
                ],
                'condition' => [
                    'social_direction' => 'column',
                    'social_fullwidth' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'social_spacing',
            [
                'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-media__list' => 'gap: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'border_size',
            [
                'label' => esc_html__('Border Size', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-share.outline .rkit-social-share__link , {{WRAPPER}} .rkit-social-share.framed .rkit-social-share__link ' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_skin' => ['framed', 'outline']
                ]
            ]
        );

        $this->add_responsive_control(
            'pointer_size',
            [
                'label' => esc_html__('Pointer Size', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-share.pointer .rkit-social-share__link , {{WRAPPER}} .rkit-social-share.pointer-on-hover .rkit-social-share__link' => '--pointer-width : {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_skin' => ['pointer', 'pointer-on-hover']
                ]
            ]
        );

        $this->add_responsive_control(
            'border-radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-share__link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rkit-social-share.pointer .rkit-social-share__link::after , {{WRAPPER}} .rkit-social-share.pointer-on-hover .rkit-social-share__link::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-share__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_options',
            [
                'label' => esc_html__('Icon ', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'select_style' => ['icon', 'both']
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
                    'size' => 10,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-share__icon' => 'font-size: {{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}} ; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style!' => 'text'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
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
                    'size' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-social-share__icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'select_style' => 'both'
                ]
            ]
        );

        $this->add_control(
            'hr_color',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control('select_color', [
            'label' => esc_html('Color'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'official' => esc_html('Official'),
                'custom' => esc_html('Custom')
            ],
            'default' => 'official'
        ]);

        $this->start_controls_tabs('color_tabs', ['condition' => ['select_color' => 'custom']]);

        $this->start_controls_tab('color_tab_normal', [
            'label' => esc_html('Normal')
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social_bg_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-social-share__link',
            ]
        );

        $this->add_control(
            'hr_bg_normal',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'social_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-social-share__link',
            ]
        );

        $this->add_control('social_text_color_normal', [
            'label' => esc_html('Text Color'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-social-share__link' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('social_icon_color_normal', [
            'label' => esc_html('Icon Color'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-social-share__icon' => 'color:{{VALUE}} ; fill:{{VALUE}}'
            ],
            'condition' => [
                'select_style!' => 'text'
            ]
        ]);

        $this->add_control(
            'hr_border_normal',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'social_border_normal',
                'selector' => '{{WRAPPER}} .rkit-social-share__link',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('color_tab_hover', [
            'label' => esc_html('Hover')
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'social_bg_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-social-share__link:hover',
            ]
        );

        $this->add_control(
            'hr_bg_hover',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'social_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-social-share__link:hover',
            ]
        );

        $this->add_control('social_text_color_hover', [
            'label' => esc_html('Text Color'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-social-share__link:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_control('social_icon_color_hover', [
            'label' => esc_html('Icon Color'),
            'type'  => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-social-share__link:hover .rkit-social-share__icon' => 'color:{{VALUE}} ; fill:{{VALUE}}'
            ],
            'condition' => [
                'select_style!' => 'text'
            ]
        ]);

        $this->add_control(
            'hr_border_hover',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'social_border_hover',
                'selector' => '{{WRAPPER}} .rkit-social-share__link:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="rkit-social-share <?php echo esc_attr($settings['select_skin']) ?> <?php echo esc_attr($settings['social_fullwidth']) ?>">
            <?php
            if ($settings['social_media']) {
                echo '<dl class="rkit-social-media__list">';
                foreach ($settings['social_media'] as $sm) {
            ?>
                    <dt class="elementor-repeater-item-<?php echo esc_attr($sm['_id']); ?>">
                        <?php
                        switch ($settings['select_style']) {
                            case 'icon':
                        ?>
                                <a type="button" data-social-media="<?php echo esc_attr($sm['social_select']) ?>" class="rkit-social-share__link <?php echo ($settings['select_color'] == 'official') ? esc_attr($sm['social_select']) : '' ?>">
                                    <?php \Elementor\Icons_Manager::render_icon($sm['social_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-social-share__icon']); ?>
                                </a>
                            <?php
                                break;
                            case 'text':
                            ?>
                                <a type="button" data-social-media="<?php echo esc_attr($sm['social_select']) ?>" class="rkit-social-share__link <?php echo ($settings['select_color'] == 'official') ? esc_attr($sm['social_select']) : '' ?>">
                                    <?php echo ($sm['label_social']) ? esc_html($sm['label_social']) : esc_html(ucwords($sm['social_select'])) ?>
                                </a>
                            <?php
                                break;
                            case 'both':
                            ?>
                                <a type="button" data-social-media="<?php echo esc_attr($sm['social_select']) ?>" class="rkit-social-share__link <?php echo ($settings['select_color'] == 'official') ? esc_attr($sm['social_select']) : '' ?>">
                                    <?php \Elementor\Icons_Manager::render_icon($sm['social_icon'], ['aria-hidden' => 'true', 'class' => 'rkit-social-share__icon']); ?>
                                    <?php echo ($sm['label_social']) ? esc_html($sm['label_social']) : esc_html(ucwords($sm['social_select'])) ?>
                                </a>
                        <?php
                                break;
                        }
                        ?>
                    </dt>
            <?php
                }
                echo '</dl>';
            }
            ?>
        </div>
<?php
    }
}
