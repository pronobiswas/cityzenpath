<?php

use Elementor\Plugin;
use Romethemekits\Modules\Controls\Widget_Area_Utils;

class Offcanvas_Rometheme extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rtm-offcanvas';
    }
    public function get_title()
    {
        return 'Header Offcanvas';
    }

    public function get_icon()
    {
        return 'rkit-widget-icon rtmicon rtmicon-header-offcanvas';
    }
    public function get_categories()
    {
        return ['romethemekit_header_footer'];
    }
    public function get_keywords()
    {
        return ['nav menu', 'header', 'rometheme'];
    }

    function get_custom_help_url()
    {
        return 'https://rometheme.net/docs-category/get-started-with-romethemekit/';
    }

    public function get_style_depends()
    {
        return ['rkit-offcanvas-style'];
    }

    public function get_script_depends()
    {
        return ['rkit-offcanvas-script'];
    }
    public function get_menus()
    {
        $list = [];
        $menus = wp_get_nav_menus();
        foreach ($menus as $menu) {
            $list[$menu->slug] = $menu->name;
        }

        return $list;
    }


    public function get_elementor_template()
    {
        $template = new WP_Query(['post_type' => 'elementor_library']);
        $list = [];
        if ($template->have_posts()) {
            while ($template->have_posts()) {
                $template->the_post();
                $list[intval(get_the_ID())] = esc_html__(get_the_title(), 'rometheme-for-elementor');
            }
        }
        return $list;
    }

    protected function register_controls()
    {
        $this->start_controls_section('content-section', [
            'label' => esc_html__('Menu Content', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        $this->add_control('menu-select', [
            'label' => esc_html__('Select Template', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $this->get_elementor_template(),
        ]);

        $this->add_control(
            'important_note',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => esc_html__('**You create from elementor template first', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control('icon-select', [
            'label' => esc_html__('Menu Icon', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => ['value' => 'rtmicon rtmicon-grid-rounds', 'library' => 'rtmicons'],
        ]);

        $this->end_controls_section();
        $this->start_controls_section('style-section', [
            'label' => esc_html__('Style Setting', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
            'btn-position',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-start',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-btn-container' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('menu-icon-size', [
            'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 24
            ],
            'selectors' => [
                '{{WRAPPER}} .menu-button-rometheme .rkit-offcanvas-icon' => 'font-size : {{SIZE}}{{UNIT}}; width:{{SIZE}}{{UNIT}} ; height: {{SIZE}}{{UNIT}} '
            ]
        ]);


        $this->add_control('padding-icon', [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .menu-button-rometheme' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->add_control('border-radius-icon', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .menu-button-rometheme' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->start_controls_tabs('menu-tabs');
        $this->start_controls_tab('menu-tab-normal', ['label' => esc_html__('Normal',  'rometheme-for-elementor')]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button-background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .menu-button-rometheme',
            ]
        );

        $this->add_control('icon-color', [
            'label' => esc_html__('Icon Color',  'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .menu-button-rometheme .rkit-offcanvas-icon' => 'color: {{VALUE}} ; fill : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'menu-border',
                'selector' => '{{WRAPPER}} .menu-button-rometheme',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('menu-tab-hover', ['label' => esc_html__('Hover',  'rometheme-for-elementor')]);


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button-hover-background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .menu-button-rometheme:hover',
            ]
        );

        $this->add_control('icon-hover-color', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .menu-button-rometheme:hover .rkit-offcanvas-icon' => 'color: {{VALUE}} ;  fill : {{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'menu-border-hover',
                'selector' => '{{WRAPPER}} .menu-button-rometheme:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section('offcanvas_setting', [
            'label' => esc_html__('Offcanvas Setting', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .menu-offcanvas-rometheme',
            ]
        );

        $this->add_control('offcanvas-position', [
            'label' => esc_html__('Offcanvas Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'offcanvas-right' => 'Right',
                'offcanvas-left' => 'Left',
            ],
            'default' => 'offcanvas-left'
        ]);

        $this->add_responsive_control('responsive-width-offcanvas', [
            'label' => esc_html__('Width Offcanvas Menu', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 5
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .menu-offcanvas-rometheme' => 'width : {{SIZE}}{{UNIT}}'
            ]
        ]);
        $this->end_controls_section();

        $this->start_controls_section('offcanvas-close', [
            'label' => esc_html__('Offcanvas Close Button', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control('close-icon', [
            'label' => esc_html__('Icon', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => ['value' => 'rtmicon rtmicon-xmark', 'library' => 'rtmicons'],
        ]);

        $this->add_control('closeIcon-size', [
            'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'default' => [
                'size' => 48,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close .offcanvas-close-icon' => 'font-size : {{SIZE}}{{UNIT}};' ,
                '{{WRAPPER}} .rkit-offcanvas-close svg.offcanvas-close-icon' => 'width: {{SIZE}}{{UNIT}} ; height:{{SIZE}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('margin-close', [
            'label' => esc_html__('Margin', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close' => 'margin : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->add_responsive_control('border-radius-close', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default' => [
                'size' => '0',
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close' => 'border-radius : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);


        $this->add_responsive_control('padding-close', [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default' => [
                'top' => 1,
                'right' => 1,
                'bottom' => 1,
                'left' => 1,
                'unit' => 'rem',
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close' => 'padding : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
            ]
        ]);

        $this->start_controls_tabs('offcanvas-close-tabs');

        $this->start_controls_tab('offcanvas-close-normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_control('icon-color-close', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close .offcanvas-close-icon' => 'color: {{VALUE}} ; fill : {{VALUE}}'
            ],
        ]);

        $this->add_control('close-background', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            // 'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close' => 'background-color : {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => esc_html__('border-close-normal', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-offcanvas-close',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('offcanvas-close-hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_control('icon-color-hoverclose', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close:hover .offcanvas-close-icon' => 'color: {{VALUE}} ; fill:{{VALUE}}'
            ],
        ]);

        $this->add_control('close-background-hover', [
            'label' => esc_html__('Background', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-offcanvas-close:hover' => 'background-color : {{VALUE}};'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => esc_html__('border-close-hover', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .rkit-offcanvas-close:hover',
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

        <div class="rkit-offcanvas <?php echo esc_attr__($settings['offcanvas-position'], 'rometheme-for-elementor') ?>">
            <div class="rkit-btn-container">
                <button class="menu-button-rometheme"><?php \Elementor\Icons_Manager::render_icon($settings['icon-select'], ['aria-hidden' => 'true', 'class' => 'rkit-offcanvas-icon']) ?></button>
            </div>
            <div class="offcanvas-navmenu-rometheme">
                <div class="menu-offcanvas-rometheme">
                    <div class="rkit-offcanvas-header">
                        <button class="rkit-offcanvas-close"><?php \Elementor\Icons_Manager::render_icon($settings['close-icon'], ['aria-hidden' => 'true', 'class' => 'offcanvas-close-icon']) ?></button>
                    </div>
                    <div class="rkit-offcanvas-body">
                        <?php
                        $template = get_post($settings['menu-select']);
                        if (!empty($template)) {
                            $status = get_post_status($settings['menu-select']);
                            if ($status == 'publish') {
                                echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($settings['menu-select']);
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="overlay-rometheme">
                </div>
            </div>
        </div>
<?php
    }
}
