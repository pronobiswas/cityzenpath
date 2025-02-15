<?php

class Nav_Menu_Rometheme extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rtm-navmenu';
    }
    public function get_title()
    {
        return 'Nav Menu';
    }
    public function get_categories()
    {
        return ['romethemekit_header_footer'];
    }
    public function get_icon()
    {
        return 'rkit-widget-icon rtmicon rtmicon-nav-menu';
    }
    public function get_keywords()
    {
        return ['nav', 'menu', 'navmenu', 'rometheme'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-nav-menu-widget/';
    }

    public function get_style_depends()
    {
        return ['navmenu-rkit-style'];
    }

    public function get_script_depends()
    {
        return ['navmenu-rkit-script'];
    }

    public function get_menus()
    {
        $list = [];
        $menus = wp_get_nav_menus();
        foreach ($menus as $menu) {
            $list[$menu->slug] = esc_html__($menu->name, 'rometheme-for-elementor');
        }

        return $list;
    }

    function wp_get_menu_array($current_menu)
    {
        // Mengambil item menu dari ID menu yang diberikan
        $array_menu = wp_get_nav_menu_items($current_menu);
        $menu = array();

        // Buat array lookup untuk menyimpan semua menu item
        $item_lookup = array();

        // Pertama, buat struktur untuk top-level menu
        foreach ($array_menu as $m) {
            $item_lookup[$m->ID] = $m;
            if (empty($m->menu_item_parent)) {
                // Jika tidak memiliki parent (top-level menu)
                $menu[$m->ID] = array(
                    'ID' => $m->ID,
                    'title' => $m->title,
                    'url' => $m->url,
                    'children' => array()
                );
            }
        }

        // Lalu, tambahkan submenu dan subkategori ke menu induk (level 1, 2, dan 3)
        foreach ($array_menu as $m) {
            if (!empty($m->menu_item_parent)) {
                // Jika item ini memiliki parent
                if (isset($menu[$m->menu_item_parent])) {
                    // Submenu level 1
                    $menu[$m->menu_item_parent]['children'][$m->ID] = array(
                        'ID' => $m->ID,
                        'title' => $m->title,
                        'url' => $m->url,
                        'children' => array()
                    );
                } else {
                    // Proses untuk submenu level 2 dan level 3
                    foreach ($menu as &$top_level_menu) {
                        if (isset($top_level_menu['children'][$m->menu_item_parent])) {
                            // Submenu level 2
                            $top_level_menu['children'][$m->menu_item_parent]['children'][$m->ID] = array(
                                'ID' => $m->ID,
                                'title' => $m->title,
                                'url' => $m->url,
                                'children' => array()
                            );
                            break;
                        } else {
                            // Submenu level 3
                            foreach ($top_level_menu['children'] as &$sub_menu) {
                                if (isset($sub_menu['children'][$m->menu_item_parent])) {
                                    $sub_menu['children'][$m->menu_item_parent]['children'][$m->ID] = array(
                                        'ID' => $m->ID,
                                        'title' => $m->title,
                                        'url' => $m->url,
                                        'children' => array()
                                    );
                                    break 2;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $menu;
    }


    function check_active_menu($menu_item, $class = '')
    {
        $actual_link = esc_url((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        if ($actual_link == $menu_item['url']) {
            return $class . '-active';
        }
        return '';
    }

    function hasChildren($menu)
    {
        $c = count($menu);

        return ($c == 0) ? false  : true;
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_setion', [
            'label' => esc_html__('Menu Setting', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('menu-select', [
            'label' => esc_html__('Menu Select', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $this->get_menus(),
            'description' => sprintf(esc_html__('Go to the %sMenus screen%s to manage your menus.', 'rometheme-for-elementor'), '<a href="' . esc_url(admin_url('nav-menus.php')) . '">', '</a>'),
            'default' => array_keys($this->get_menus())[0],
        ]);

        $this->add_control('submenu-open', [
            'label' => esc_html__('Dropdown as open'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'hover' => esc_html__('Hover', 'rometheme-for-elementor'),
                'click' => esc_html__('Click', 'rometheme-for-elementor'),
            ],
            'default' => 'hover',
            // 'description' => esc_html__('This setting for open the submenu in desktop and has no effect on the mobile view ,If you choose "Click", the menu will not link to the menu page.')
        ]);

        $this->add_control('pointer_select', [
            'label' => esc_html__('Pointer', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__('None', 'rometheme-for-elementor'),
                'pointer-underline' => esc_html__('Underline', 'rometheme-for-elementor'),
                'pointer-overline' => esc_html__('Overline', 'rometheme-for-elementor'),
                'pointer-doubleline' => esc_html__('Double Line', 'rometheme-for-elementor'),
                'pointer-framed' => esc_html__('Framed', 'rometheme-for-elementor'),
                'pointer-bg' => esc_html__('Background', 'rometheme-for-elementor'),
            ],
            'default' => '',
        ]);

        $this->add_control('pointer_width', [
            'label' => esc_html__('Pointer Width', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem', 'custom'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pointer-underline, {{WRAPPER}} .pointer-overline, {{WRAPPER}} .pointer-doubleline, {{WRAPPER}} .pointer-framed ' => '--pointer-width: {{SIZE}}{{UNIT}};',

            ],
            'condition' => [
                'pointer_select!' => ['', 'pointer-bg'],
            ]
        ]);

        $this->add_control(
            'mobile_options',
            [
                'label' => esc_html__('Mobile Options', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control('responsive-breakpoint', [
            'label' => esc_html__('Responsive Breakpoint'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'tablet' => esc_html__('Tablet', 'rometheme-for-elementor'),
                'mobile' => esc_html__('Mobile', 'rometheme-for-elementor'),
            ],
            'default' => 'tablet',
        ]);

        $this->add_responsive_control(
            'menu_spacing',
            [
                'label' => esc_html__('Menu Distance', 'rometheme-for-elementor'),
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
                'tablet_default' => [
                    'size' => 0,
                    'unit' => 'px'
                ],
                'mobile_default' => [
                    'size' => 0,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-responsive-menu' => '--menu-distance: {{SIZE}}{{UNIT}};',
                ],
                'description' => "This is for responsive menu distance and it doesn't have any effect in desktop mode.",
            ]
        );

        $this->add_control(
            'full_width',
            [
                'label' => esc_html__('Full Width', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('Custom', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );



        $this->add_responsive_control(
            'menu-order-position',
            [
                'label' => esc_html__('Menu Order Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('From Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'right' => [
                        'title' => esc_html__('From Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-justify-end-h',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-responsive-tablet , {{WRAPPER}} .rkit-responsive-mobile' => '{{VALUE}}:0px;',
                ],
                'condition' => [
                    'full_width!' => 'yes'
                ]
            ]
        );




        $this->add_responsive_control('menu-width', [
            'label' => esc_html__('Menu Width', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'vw'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                '%' => ['min' => 0, 'max' => 100],
                'vw' => ['min' => 0, 'max' => 100],
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'default' => [
                'size' => 100,
                'unit' => '%'
            ],
            'tablet_default' => [
                'size' => 100,
                'unit' => '%'
            ],
            'mobile_default' => [
                'size' => 100,
                'unit' => '%'
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-navmenu' => 'width:{{SIZE}}{{UNIT}};'
            ],
            'condition' => [
                'full_width!' => 'yes'
            ]
        ]);

        $this->end_controls_section();

        $this->start_controls_section('submenu-content', [
            'label' => esc_html__('Submenu Content', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control(
            'submenu_icon_options',
            [
                'label' => esc_html__('Sub Menu Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'submenu_icon_spacing',
            [
                'label' => esc_html__('Sub Menu Icon Spacing', 'rometheme-for-elementor'),
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
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-nav-link ' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'submenu-icon',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-chevron-down',
                    'library' => 'rtmicons',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section('hamburger-content', [
            'label' => esc_html__('Hamburger Setting'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control(
            'icon-open',
            [
                'label' => esc_html__('Hamburger Icon Open', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-grid-rounds',
                    'library' => 'rtmicons',
                ],
            ]
        );
        $this->add_control(
            'icon-close',
            [
                'label' => esc_html__('Hamburger Icon Close', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-xmark',
                    'library' => 'rtmicons',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section('menu-wrapper-style', [
            'label' => esc_html__('Menu Wrapper', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
            'bg_options',
            [
                'label' => esc_html__('Menu Wrapper Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'menu_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-navmenu',
                'fields_options' => [
                    'color' => [
                        'responsive' => true,
                        'desktop_default' => '#ffffff00',
                        'tablet_default' => '#eeeeee',
                        'meobile_default' => '#eeeeee',
                    ],
                    'color_b' => [
                        'responsive' => true,
                    ],
                    'background' => [
                        'responsive' => true,
                        'default' => 'classic'
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('menu_style', [
            'label' => esc_html__('Menu Style', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .rkit-menu-item .rkit-nav-link'
            ]
        );

        $this->add_responsive_control('menu-position', [
            'label' => esc_html__('Menu Position'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'start' => [
                    'title' => esc_html__('Left', 'textdomain'),
                    'icon' => 'eicon-justify-start-h',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'textdomain'),
                    'icon' => 'eicon-justify-center-h',
                ],
                'end' => [
                    'title' => esc_html__('Right', 'textdomain'),
                    'icon' => 'eicon-justify-end-h',
                ],
                'space-between' => [
                    'title' => esc_html__('Justified', 'textdomain'),
                    'icon' => 'eicon-justify-space-between-h',
                ],
            ],
            'default' => 'start',
            'selectors' => [
                '{{WRAPPER}} .rkit-navmenu .rkit-menu-container , .rkit-menu-item > .rkit-nav-link' => 'justify-content : {{VALUE}};',
            ]
        ]);

        $this->add_responsive_control(
            'menu_horizontal_padding',
            [
                'label' => esc_html__('Horizontal Padding', 'rometheme-for-elementor'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-menu-item > .rkit-nav-link' => 'padding-inline: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_vertical_padding',
            [
                'label' => esc_html__('Vertical Padding', 'rometheme-for-elementor'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-menu-item  > .rkit-nav-link' => 'padding-block: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_space_between',
            [
                'label' => esc_html__('Space Between', 'rometheme-for-elementor'),
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
                'dekstop_default' => [
                    'size' => 5,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-menu-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('menu-item-radius', [
            'label' => esc_html__('Item Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]);

        $this->add_control('pointer_color', [
            'label' => esc_html('Pointer Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-menu-item' => '--pointer-color : {{VALUE}}'
            ],
            'condition' => [
                'pointer_select!' => ''
            ]
        ]);

        $this->start_controls_tabs('menu-style-tab');

        $this->start_controls_tab('menu-normal', [
            'label' => esc_html__('Normal', 'rometheme-for-elementor')
        ]);

        $this->add_control('text-color', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-menu-item > .rkit-nav-link' => 'color: {{VALUE}}',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item-background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-menu-item',
                'fields_options' => [
                    'color' => [
                        'responsive' => true,
                    ],
                    'color_b' => [
                        'responsive' => true,
                    ],
                    'background' => [
                        'responsive' => true,
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item-border',
                'selector' => '{{WRAPPER}} .rkit-menu-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('menu-hover', [
            'label' => esc_html__('Hover', 'rometheme-for-elementor')
        ]);

        $this->add_control('text-hover-color', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-menu-item:hover > .rkit-nav-link' => 'color: {{VALUE}}',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item-background-hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-menu-item:hover',
                'fields_options' => [
                    'color' => [
                        'responsive' => true,
                    ],
                    'color_b' => [
                        'responsive' => true,
                    ],
                    'background' => [
                        'responsive' => true,
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item-border-hover',
                'selector' => '{{WRAPPER}} .rkit-menu-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('menu-active', ['label' => esc_html__('Active', 'rometheme-for-elementor')]);

        $this->add_control('active-text-color', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-menu-item.rkit-menu-active > .rkit-nav-link' => 'color: {{VALUE}}',
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'item-background-active',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-menu-item.rkit-menu-active',
                'fields_options' => [
                    'color' => [
                        'responsive' => true,
                    ],
                    'color_b' => [
                        'responsive' => true,
                    ],
                    'background' => [
                        'responsive' => true,
                    ],
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item-border-active',
                'selector' => '{{WRAPPER}} .rkit-menu-item.rkit-menu-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section('submenu-style-setting', [
            'label' => esc_html__('Submenu Style', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'submenu_typography',
                'selector' => '{{WRAPPER}} .rkit-submenu-item .rkit-nav-link'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .rkit-submenu-item',
            ]
        );

        $this->add_responsive_control(
            'submenu_horizontal_padding',
            [
                'label' => esc_html__('Horizontal Padding', 'rometheme-for-elementor'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 35,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-submenu-item  > .rkit-nav-link' => 'padding-inline: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_vertical_padding',
            [
                'label' => esc_html__('Vertical Padding', 'rometheme-for-elementor'),
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
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-submenu-item > .rkit-nav-link' => 'padding-block: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submenu_space_between',
            [
                'label' => esc_html__('Space Between', 'rometheme-for-elementor'),
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
                    '{{WRAPPER}} .rkit-navmenu-dropdown' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_options',
            [
                'label' => esc_html__('Submenu Icon Style', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-submenu-icon' => 'color: {{VALUE}} ; fill:{{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control('submenu-icon-size', [
            'label' => esc_html__('Submenu Icon Size', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000, 'step' => 1],
                '%' =>  ['min' => 0, 'max' => 100],
                'em' =>  ['min' => 0, 'max' => 30],
                'rem' =>  ['min' => 0, 'max' => 30],
            ],
            'default' => [
                'size' => 0.6,
                'unit' => 'rem'
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-submenu-icon' => 'font-size:{{SIZE}}{{UNIT}} ; width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};'
            ]
        ]);

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );


        $this->add_responsive_control(
            'submenu_text_align',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-justify-center-h',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-justify-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Justified', 'textdomain'),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                ],
                'default' => 'start',
                'toggle' => true,
                // 'description' => esc_html__('`The alignment settings will only affect the responsive mode and will not have any effect on the desktop mode.`', 'rometheme-for-elementor'),
                'selectors' => [
                    '{{WRAPPER}} .rkit-submenu-item > .rkit-nav-link' => 'justify-content: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control('submenu-radius', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-navmenu-dropdown > .rkit-submenu-item:first-child' => 'border-top-left-radius:{{TOP}}{{UNIT}} ; border-top-right-radius: {{RIGHT}}{{UNIT}} ',
                '{{WRAPPER}} .rkit-navmenu-dropdown > .rkit-submenu-item:last-child' => 'border-bottom-left-radius:{{BOTTOM}}{{UNIT}} ; border-bottom-right-radius: {{LEFT}}{{UNIT}} ',
                '{{WRAPPER}} .rkit-navmenu-dropdown' => 'border-radius:calc( {{TOP}}{{UNIT}}  + 1% ) calc({{RIGHT}}{{UNIT}} + 1% ) calc({{BOTTOM}}{{UNIT}} + 1%) calc({{LEFT}}{{UNIT}} + 1%);'
            ],
        ]);

        $this->add_control(
            'bg-separator',
            [
                'label' => esc_html__('Background', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('submenu_bg_tabs');
        $this->start_controls_tab('submenu_bg_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_responsive_control('submenu-textcolor', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-submenu-item > .rkit-nav-link' => 'color:{{VALUE}}',
            ]
        ]);

        $this->add_responsive_control('submenu-bgcolor', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-submenu-item' => 'background-color:{{VALUE}}',
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_border_normal',
                'selector' => '{{WRAPPER}} .rkit-submenu-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('submenu_bg_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_responsive_control('submenu-textcolor-   ', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-submenu-item:hover > .rkit-nav-link' => 'color:{{VALUE}}',
            ]
        ]);

        $this->add_responsive_control('submenu-bgcolor-hover', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-submenu-item:hover' => 'background-color:{{VALUE}}',
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_border_hover',
                'selector' => '{{WRAPPER}} .rkit-submenu-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('submenu_bg_active', ['label' => esc_html__('Active', 'rometheme-for-elementor')]);
        $this->add_responsive_control('submenu-textcolor-active', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-submenu-item.rkit-submenu-active > .rkit-nav-link' => 'color:{{VALUE}}',
            ]
        ]);

        $this->add_responsive_control('submenu-bgcolor-active', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-submenu-active' => 'background-color:{{VALUE}}',
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'submenu_border_active',
                'selector' => '{{WRAPPER}} .rkit-submenu-active',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

        $this->start_controls_section('hamburger-style-setting', [
            'label' => esc_html__('Hamburger Style', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);


        $this->add_responsive_control('hamburger-position', [
            'label' => esc_html__('Menu Icon Alignment', 'rometheme-for-elementor'),
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
            'default' => 'end',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .rkit-hamburger-tablet' => 'justify-content: {{VALUE}}',
                '{{WRAPPER}} .rkit-hamburger-mobile' => 'justify-content: {{VALUE}}',
            ],
        ]);


        $this->add_responsive_control('hamburger-icon-padding', [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default' => [
                'top' => 10,
                'right' => 10,
                'bottom' => 10,
                'left' => 10,
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-btn-hamburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
            ],
        ]);

        $this->add_responsive_control('hamburger-border-radius', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-btn-hamburger' => 'border-radius : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('hamburger-icon-size', [
            'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 500, 'step' => 1],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 24
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-btn-hamburger' => 'font-size:{{SIZE}}{{UNIT}}'
            ]
        ]);

        $this->start_controls_tabs('btn-hamburger');

        $this->start_controls_tab('btn-hamburger-normal', ['label' => 'Normal']);

        $this->add_responsive_control('btn-hamburger-bg', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-btn-hamburger' => 'background-color:{{VALUE}}'
            ]
        ]);

        $this->add_responsive_control('btn-hamburger-color', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-btn-hamburger' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn-hamburger-border',
                'selector' => '{{WRAPPER}} .rkit-btn-hamburger',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('btn-hamburger-hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);

        $this->add_responsive_control('btn-hamburger-hoverbg', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-btn-hamburger:hover' => 'background-color:{{VALUE}}'
            ]
        ]);

        $this->add_responsive_control('btn-hamburger-hovercolor', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-btn-hamburger:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn-hamburger-hoverborder',
                'selector' => '{{WRAPPER}} .rkit-btn-hamburger:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $menu_slug = $settings['menu-select'];
        $menu = wp_get_nav_menu_object($menu_slug);
        $current_menu = $menu->slug;
        $menu_parent = $this->wp_get_menu_array($current_menu);
        $id = $this->get_id_int();
        $drClass = 'rkit-dropdown-' . $settings['submenu-open'];
        // $sbDrClass = 'rkit-subdropdown-' . $settings['submenu-open'];
?>
        <div class="rkit-navmenu-container" data-responsive="<?php echo esc_attr($settings['responsive-breakpoint']) ?>">
            <div class="rkit-hamburger rkit-hamburger-<?php echo esc_attr($settings['responsive-breakpoint']) ?>">
                <a class="rkit-btn-hamburger">
                    <?php \Elementor\Icons_Manager::render_icon($settings['icon-open'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-open', 'id' => 'rkit-icon-open' . $this->get_id_int()]); ?>
                    <?php \Elementor\Icons_Manager::render_icon($settings['icon-close'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-close', 'id' => 'rkit-icon-close' . $this->get_id_int()]); ?>

                </a>
            </div>
            <div class="rkit-navmenu rkit-responsive-menu rkit-responsive-<?php echo esc_attr($settings['responsive-breakpoint']) ?>  <?php echo ($settings['full_width'] === 'yes') ? esc_attr('rkit-navmenu-fullwidth') : '' ?>">
                <ul class="rkit-menu-container">
                    <?php
                    foreach ($menu_parent as $mn) : ?>
                        <li class="rkit-menu-item <?php echo esc_attr($this->check_active_menu($mn, 'rkit-menu')) ?> <?php echo ($this->hasChildren($mn['children'])) ? esc_attr($drClass) : '' ?> <?php echo esc_attr($settings['pointer_select']) ?>">
                            <a class="rkit-nav-link" href="<?php echo esc_url($mn['url']) ?>">
                                <?php echo esc_html($mn['title']) ?>
                                <?php if ($this->hasChildren($mn['children'])) :
                                    \Elementor\Icons_Manager::render_icon($settings['submenu-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-submenu-icon']);
                                endif;
                                ?>
                            </a>
                            <?php if ($this->hasChildren($mn['children'])) : ?>
                                <ul class="rkit-navmenu-dropdown">
                                    <?php foreach ($mn['children'] as $m) : ?>
                                        <li class="rkit-submenu-item <?php echo esc_attr($this->check_active_menu($m, 'rkit-submenu')) ?> <?php echo ($this->hasChildren($m['children'])) ? esc_attr($drClass) : '' ?>">
                                            <a href="<?php echo esc_url($m['url']) ?>" class="rkit-nav-link">
                                                <?php echo esc_html($m['title']) ?>
                                                <?php if ($this->hasChildren($m['children'])) :
                                                    \Elementor\Icons_Manager::render_icon($settings['submenu-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-submenu-icon']);
                                                endif;
                                                ?>
                                            </a>
                                            <?php if ($this->hasChildren($m['children'])) : ?>
                                                <ul class="rkit-navmenu-dropdown">
                                                    <?php foreach ($m['children'] as $sm) : ?>
                                                        <li class="rkit-submenu-item <?php echo esc_attr($this->check_active_menu($sm, 'rkit-submenu')) ?> <?php echo ($this->hasChildren($sm['children'])) ? esc_attr($drClass) : '' ?>">
                                                            <a href="<?php echo esc_url($sm['url']) ?>" class="rkit-nav-link">
                                                                <?php echo esc_html($sm['title']) ?>
                                                                <?php if ($this->hasChildren($sm['children'])) :
                                                                    \Elementor\Icons_Manager::render_icon($settings['submenu-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-submenu-icon']);
                                                                endif;
                                                                ?>
                                                            </a>
                                                            <?php if ($this->hasChildren($sm['children'])) : ?>
                                                                <ul class="rkit-navmenu-dropdown">
                                                                    <?php foreach ($sm['children'] as $ms) : ?>
                                                                        <li class="rkit-submenu-item">
                                                                            <a href="<?php echo esc_url($ms['url']) ?>" class="rkit-nav-link"><?php echo esc_html($ms['title']) ?></a>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
<?php
    }
}
