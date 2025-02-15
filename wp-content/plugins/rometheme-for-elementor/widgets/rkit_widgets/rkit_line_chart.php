<?php

class Rkit_LineChart extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-line-chart';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['linechart']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon ' . \RomethemeKit\RkitWidgets::listWidgets()['linechart']['icon'];
        return $icon;
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-line-chart-widget/';
    }

    public function get_script_depends()
    {
        return ['line_chart-script'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('data_name', [
            'label' => esc_html('Data Name'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'placeholder' => esc_html('Input Your Data Name Here'),
            'default' => esc_html('Data Example')
        ]);

        $item = new \Elementor\Repeater();

        $item->add_control('item_label', [
            'label' => esc_html('Label'),
            'type' => \Elementor\Controls_Manager::TEXT
        ]);

        $item->add_control('item_value', [
            'label' => esc_html('Label'),
            'type' => \Elementor\Controls_Manager::NUMBER
        ]);

        $this->add_control('item_list', [
            'label' => esc_html('Data List'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $item->get_controls(),
            'default' => [
                [
                    'item_label' => esc_html('Data 1'),
                    'item_value' => 50
                ],
                [
                    'item_label' => esc_html('Data 2'),
                    'item_value' => 90
                ],
                [
                    'item_label' => esc_html('Data 3'),
                    'item_value' => 100
                ],
                [
                    'item_label' => esc_html('Data 4'),
                    'item_value' => 30
                ],
                [
                    'item_label' => esc_html('Data 5'),
                    'item_value' => 120
                ]
            ],
            'title_field' => '{{{ item_label }}}'
        ]);

        $this->end_controls_section();

        $this->start_controls_section('line_style', [
            'label' => esc_html('line'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
            'custom_panel_notice',
            [
                'type' => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'warning',
                'dismissible' => true,
                'heading' => esc_html__('Global Color Not Working', 'rometheme-for-elementor'),
                'content' => esc_html__('Global color is not working or has no effect on this element, possibly due to unsupported settings or limitations of the element.', 'textdomain'),
            ]
        );

        $this->add_control(
            'fill_bg',
            [
                'label' => esc_html__('Fill Background ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('fill_bg_color', [
            'label' => esc_html('Background Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => 'rgba(75, 192, 192 , 0.1)',
            'condition' => [
                'fill_bg' =>  'yes'
            ]
        ]);

        $this->add_control(
            'tension',
            [
                'label' => esc_html__('Tension', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
            ]
        );

        $this->add_control('point_style', [
            'label' => esc_html('Point Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'circle' => esc_html('Circle'),
                'cross' => esc_html('Cross'),
                'crossRot' => esc_html('Cross Rotate'),
                'dash' => esc_html('Dash'),
                'line' => esc_html('Line'),
                'rect' => esc_html('Rectangle'),
                'rectRounded' => esc_html('Rectangle Rounded'),
                'rectRot' => esc_html('Rectangle Rotate'),
                'star' => esc_html('Star'),
            ],
            'default' => 'circle'
        ]);

        $this->start_controls_tabs('line_tabs');

        $this->start_controls_tab('line_tab_normal', [
            'label' => esc_html('Normal')
        ]);

        $this->add_control(
            'point_size_normal',
            [
                'label' => esc_html__('Point Size', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
            ]
        );


        $this->add_control('line_bg_normal', [
            'label' => esc_html('Point Background'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => 'rgba(75, 192, 192, 0.2)'
        ]);

        $this->add_control(
            'border_width_normal',
            [
                'label' => esc_html__('Border Width', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
            ]
        );

        $this->add_control('line_border_normal', [
            'label' => esc_html('Border Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => 'rgba(75, 192, 192, 1)'
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('line_tab_hover', [
            'label' => esc_html('Hover')
        ]);

        $this->add_control(
            'point_size_hover',
            [
                'label' => esc_html__('Point Size', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
            ]
        );

        $this->add_control('line_bg_hover', [
            'label' => esc_html('Point Background'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => 'rgba(75, 192, 192, 1)'
        ]);

        $this->add_control(
            'border_width_hover',
            [
                'label' => esc_html__('Border Width', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
            ]
        );

        $this->add_control('line_border_hover', [
            'label' => esc_html('Border Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => 'rgba(75, 192, 192, 1)'
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('scale_style', [
            'label' => esc_html('Scale'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
            'scale_x_style_option',
            [
                'label' => esc_html__('Scale X', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_scale_x',
            [
                'label' => esc_html__('Show Scale X', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('scale_x_font_size', [
            'label'  => esc_html('Font Size'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'condition' => [
                'show_scale_x' => 'yes'
            ]
        ]);

        $this->add_control('scale_x_color', [
            'label'  => esc_html('Font Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'show_scale_x' => 'yes'
            ]
        ]);

        $this->add_control(
            'scale_x_font_family',
            [
                'label' => esc_html__('Font Family', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::FONT,
                'default' => "'Open Sans', sans-serif",
                'condition' => [
                    'show_scale_x' => 'yes'
                ]
            ]
        );

        $this->add_control('scale_x_font_style', [
            'label'  => esc_html('Font Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'normal' => esc_html('Normal'),
                'italic' => esc_html('Italic'),
            ],
            'default'  => 'normal',
            'condition' => [
                'show_scale_x' => 'yes'
            ]
        ]);

        $this->add_control('scale_x_font_weight', [
            'label'  => esc_html('Font Weight'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '100' => esc_html('100 (Thin)'),
                '200' => esc_html('200 (Extra Light)'),
                '300' => esc_html('300 (Light)'),
                '400' => esc_html('400 (Normal)'),
                '500' => esc_html('500 (Medium)'),
                '600' => esc_html('600 (Semi Bold)'),
                '700' => esc_html('700 (Bold)'),
                '800' => esc_html('800 (Extra Bold)'),
                '900' => esc_html('900 (Black)'),
            ],
            'default'  => '400',
            'condition' => [
                'show_scale_x' => 'yes'
            ]
        ]);

        $this->add_control(
            'scale_y_style_option',
            [
                'label' => esc_html__('Scale Y', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_scale_y',
            [
                'label' => esc_html__('Show Scale Y', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('scale_y_font_size', [
            'label'  => esc_html('Font Size'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'condition' => [
                'show_scale_y' => 'yes'
            ]
        ]);

        $this->add_control('scale_y_color', [
            'label'  => esc_html('Font Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'show_scale_y' => 'yes'
            ]
        ]);

        $this->add_control(
            'scale_y_font_family',
            [
                'label' => esc_html__('Font Family', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::FONT,
                'default' => "'Open Sans', sans-serif",
                'condition' => [
                    'show_scale_y' => 'yes'
                ]
            ]
        );

        $this->add_control('scale_y_font_style', [
            'label'  => esc_html('Font Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'normal' => esc_html('Normal'),
                'italic' => esc_html('Italic'),
            ],
            'default'  => 'normal',
            'condition' => [
                'show_scale_y' => 'yes'
            ]
        ]);

        $this->add_control('scale_y_font_weight', [
            'label'  => esc_html('Font Weight'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '100' => esc_html('100 (Thin)'),
                '200' => esc_html('200 (Extra Light)'),
                '300' => esc_html('300 (Light)'),
                '400' => esc_html('400 (Normal)'),
                '500' => esc_html('500 (Medium)'),
                '600' => esc_html('600 (Semi Bold)'),
                '700' => esc_html('700 (Bold)'),
                '800' => esc_html('800 (Extra Bold)'),
                '900' => esc_html('900 (Black)'),
            ],
            'default'  => '400',
            'condition' => [
                'show_scale_y' => 'yes'
            ]
        ]);

        $this->add_control(
            'grid_x_options',
            [
                'label' => esc_html__('Grid X', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_grid_x',
            [
                'label' => esc_html__('Show Grid X', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('grid_x_color', [
            'label' => esc_html('Grid X Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#aaaaaa',
            'condition' => [
                'show_grid_x' => 'yes'
            ]
        ]);

        $this->add_control(
            'grid_y_options',
            [
                'label' => esc_html__('Grid Y', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_grid_y',
            [
                'label' => esc_html__('Show Grid Y', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('grid_y_color', [
            'label' => esc_html('Grid X Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#aaaaaa',
            'condition' => [
                'show_grid_y' => 'yes'
            ]
        ]);


        $this->end_controls_section();

        $this->start_controls_section('legend_style', [
            'label' => esc_html('Legend'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
            'show_legend',
            [
                'label' => esc_html__('Show Legend', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control('legend_font_size', [
            'label'  => esc_html('Font Size'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'condition' => [
                'show_legend' => 'yes'
            ]
        ]);

        $this->add_control('legend_color', [
            'label'  => esc_html('Font Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#000000',
            'condition' => [
                'show_legend' => 'yes'
            ]
        ]);

        $this->add_control('legend_position', [
            'label' => esc_html('Position'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'top' => esc_html('Top'),
                'left' => esc_html('Left'),
                'right' => esc_html('Right'),
                'bottom' => esc_html('Bottom'),
            ],
            'default'  => 'top',
            'condition'  => [
                'show_legend' => 'yes'
            ]
        ]);

        $this->add_control(
            'legend_font_family',
            [
                'label' => esc_html__('Font Family', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::FONT,
                'default' => "'Open Sans', sans-serif",
                'condition' => [
                    'show_legend' => 'yes'
                ]
            ]
        );

        $this->add_control('legend_font_style', [
            'label'  => esc_html('Font Style'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'normal' => esc_html('Normal'),
                'italic' => esc_html('Italic'),
            ],
            'default'  => 'normal',
            'condition' => [
                'show_legend' => 'yes'
            ]
        ]);

        $this->add_control('legend_font_weight', [
            'label'  => esc_html('Font Weight'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '100' => esc_html('100 (Thin)'),
                '200' => esc_html('200 (Extra Light)'),
                '300' => esc_html('300 (Light)'),
                '400' => esc_html('400 (Normal)'),
                '500' => esc_html('500 (Medium)'),
                '600' => esc_html('600 (Semi Bold)'),
                '700' => esc_html('700 (Bold)'),
                '800' => esc_html('800 (Extra Bold)'),
                '900' => esc_html('900 (Black)'),
            ],
            'default'  => '400',
            'condition' => [
                'show_legend' => 'yes'
            ]
        ]);

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $label = [];
        $value = [];

        foreach ($settings['item_list'] as $item) {
            array_push($label, $item['item_label']);
            array_push($value, $item['item_value']);
        }

        $datasets = [
            'label' => $settings['data_name'],
            'data' => $value,
            'pointBackgroundColor' => $settings['line_bg_normal'],
            'borderColor' => $settings['line_border_normal'],
            'borderWidth' => !empty($settings['border_width_normal']['size']) ? $settings['border_width_normal']['size'] : 1,
            'hoverBackgroundColor' => $settings['line_bg_hover'],
            'hoverBorderColor' => $settings['line_border_hover'],
            'hoverBorderWidth' => $settings['border_width_hover']['size'],
            'pointRadius' => !empty($settings['point_size_normal']['size']) ? $settings['point_size_normal']['size'] : 3,
            'pointHoverRadius' => !empty($settings['point_size_hover']['size']) ? $settings['point_size_hover']['size'] : 4,
            'pointStyle' => $settings['point_style'],
            'tension' => !empty($settings['tension']['size']) ? floatval($settings['tension']['size'] / 100) : 0.1,
            'fill' => ($settings['fill_bg'] === 'yes') ? true : false,
            'backgroundColor' => $settings['fill_bg_color'],
            'showLine' => true
        ];

        $scales = [
            'x' => [
                'beginAtZero' => true,
                'display' => ($settings['show_scale_x'] === 'yes') ? true : false,
                'ticks' => [
                    'color' => $settings['scale_x_color'],
                    'font' => [
                        'family' => $settings['scale_x_font_family'],
                        'size'  => !empty($settings['scale_x_font_size']['size']) ? $settings['scale_x_font_size']['size'] : 12,
                        'style' => $settings['scale_x_font_style'],
                        'weight' => $settings['scale_x_font_weight'],
                    ]
                ],
                'grid' => [
                    'display'  => ($settings['show_grid_x'] === 'yes') ? true : false,
                    'color' => $settings['grid_x_color']
                ],
            ],
            'y' => [
                'beginAtZero' => true,
                'display' => ($settings['show_scale_y'] === 'yes') ? true : false,
                'ticks' => [
                    'color' => $settings['scale_y_color'],
                    'font' => [
                        'family' => $settings['scale_y_font_family'],
                        'size'  => !empty($settings['scale_y_font_size']['size']) ? $settings['scale_y_font_size']['size'] : 12,
                        'style' => $settings['scale_y_font_style'],
                        'weight' => $settings['scale_y_font_weight'],
                    ],
                ],
                'grid' => [
                    'display'  => ($settings['show_grid_y'] === 'yes') ? true : false,
                    'color' => $settings['grid_y_color']
                ],
            ],
        ];

        $legend = [
            'display' => ($settings['show_legend'] === 'yes') ? true : false,
            'position' => $settings['legend_position'],
            'labels' => [
                'color'  => $settings['legend_color'],
                'font' => [
                    'family' => $settings['legend_font_family'],
                    'size'  => !empty($settings['legend_font_size']['size']) ? $settings['legend_font_size']['size'] : 12,
                    'style' => $settings['legend_font_style'],
                    'weight' => $settings['legend_font_weight'],
                ]
            ]
        ]

?>
        <div class="rkit-linechart-container">
            <canvas id="lineChart" width="600" height="400" data-name="<?php echo esc_attr($settings['data_name']) ?>" data-label="<?php echo esc_attr(json_encode($label));  ?>" data-datasets="<?php echo esc_attr(json_encode($datasets)) ?>" data-scales="<?php echo esc_attr(json_encode($scales)) ?>" data-legend="<?php echo esc_attr(json_encode($legend)) ?>" style="width: 100%; aspect-ratio:3/2;"></canvas>
        </div>
<?php
    }
}
