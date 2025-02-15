<?php

class Rkit_PieChart extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-pie-chart';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['piechart']['name'];
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['piechart']['icon'];
        return $icon;
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-pie-chart-widget/';
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_script_depends()
    {
        return ['pie_chart-script'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('chart_type', [
            'label' => esc_html('Chart Type'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'pie' => esc_html('Pie'),
                'doughnut' => esc_html('Doughnut')
            ],
            'default' => 'pie',
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

        $item->start_controls_tabs('item_tabs');

        $item->start_controls_tab('item_tab_normal', ['label' => esc_html('Normal')]);

        $item->add_control('item_bg_normal', [
            'label' => esc_html('Background'),
            'type' => \Elementor\Controls_Manager::COLOR
        ]);

        $item->add_control('item_border_color_normal', [
            'label' => esc_html('Background'),
            'type' => \Elementor\Controls_Manager::COLOR
        ]);

        $item->add_control('offset_normal', [
            'label' => esc_html('Offset'),
            'type' => \Elementor\Controls_Manager::SLIDER,
        ]);

        $item->end_controls_tab();

        $item->start_controls_tab('item_tab_hover', ['label' => esc_html('Hover')]);

        $item->add_control('item_bg_hover', [
            'label' => esc_html('Background'),
            'type' => \Elementor\Controls_Manager::COLOR
        ]);

        $item->add_control('item_border_color_hover', [
            'label' => esc_html('Background'),
            'type' => \Elementor\Controls_Manager::COLOR
        ]);

        $item->add_control('offset_hover', [
            'label' => esc_html('Offset'),
            'type' => \Elementor\Controls_Manager::SLIDER,
        ]);


        $item->end_controls_tab();

        $item->end_controls_tabs();

        $this->add_control('item_list', [
            'label' => esc_html('Data List'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $item->get_controls(),
            'default' => [
                [
                    'item_label' => esc_html('Data 1'),
                    'item_value' => 50,
                    'item_bg_normal' => 'rgb(255, 99, 132)',
                    'item_bg_hover' => 'rgb(255, 99, 132)',
                ],
                [
                    'item_label' => esc_html('Data 2'),
                    'item_value' => 90,
                    'item_bg_normal' => 'rgb(54, 162, 235)',
                    'item_bg_hover' => 'rgb(54, 162, 235)',
                ],
                [
                    'item_label' => esc_html('Data 3'),
                    'item_value' => 100,
                    'item_bg_normal' => 'rgb(255, 205, 86)',
                    'item_bg_hover' => 'rgb(255, 205, 86)',
                ],
                [
                    'item_label' => esc_html('Data 4'),
                    'item_value' => 30,
                    'item_bg_normal' => '#91C8E4',
                    'item_bg_hover' => '#91C8E4',
                ],
                [
                    'item_label' => esc_html('Data 5'),
                    'item_value' => 120,
                    'item_bg_normal' => '#9DB2BF',
                    'item_bg_hover' => '#9DB2BF',
                ]
            ],
            'title_field' => '{{{ item_label }}}'
        ]);

        $this->end_controls_section();

        $this->start_controls_section('pie_style', [
            'label' => esc_html('Chart'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control(
			'custom_panel_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'warning',
				'dismissible' => true,
				'heading' => esc_html__( 'Global Color Not Working', 'rometheme-for-elementor' ),
				'content' => esc_html__( 'Global color is not working or has no effect on this element, possibly due to unsupported settings or limitations of the element.', 'textdomain' ),
			]
		);

        $this->add_control('border_radius', [
            'label' => esc_html('Border Radius'),
            'type' => \Elementor\Controls_Manager::SLIDER
        ]);

        $this->add_control('spacing', [
            'label' => esc_html('Spacing'),
            'type' => \Elementor\Controls_Manager::SLIDER
        ]);

        $this->add_control('rotation', [
            'label' => esc_html('Rotation'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -100,
                    'max' => 100
                ]
            ]
        ]);

        $this->start_controls_tabs('pie_tabs');

        $this->start_controls_tab('pie_tab_normal', [
            'label' => esc_html('Normal')
        ]);
        $this->add_control(
            'border_width_normal',
            [
                'label' => esc_html__('Border Width', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('pie_tab_hover', [
            'label' => esc_html('Hover')
        ]);

        $this->add_control(
            'border_width_hover',
            [
                'label' => esc_html__('Border Width', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

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
        $background = [];
        $backgroundHover = [];
        $borderColor = [];
        $hoverBorderColor = [];
        $offset = [];
        $hoverOffset = [];

        foreach ($settings['item_list'] as $item) {
            array_push($label, $item['item_label']);
            array_push($value, $item['item_value']);
            array_push($background, $item['item_bg_normal']);
            array_push($backgroundHover, $item['item_bg_hover']);
            array_push($borderColor, $item['item_border_color_normal']);
            array_push($hoverBorderColor, $item['item_border_color_hover']);
            array_push($offset, $item['offset_normal']['size']);
            array_push($hoverOffset, $item['offset_hover']['size']);
        }

        $datasets = [
            'label' => $settings['data_name'],
            'data' => $value,
            'borderRadius' => !empty($settings['border_radius']['size']) ? $settings['border_radius']['size'] : 0,
            'backgroundColor' => $background,
            'hoverBackgroundColor' => $backgroundHover,
            'borderColor' => $borderColor,
            'borderWidth' => $settings['border_width_normal']['size'],
            'hoverBorderColor' => $hoverBorderColor,
            'hoverBorderWidth' => $settings['border_width_hover']['size'],
            'offset' => $offset,
            'hoverOffset' => $hoverOffset,
            'spacing' => !empty($settings['spacing']['size']) ? $settings['spacing']['size'] : 0,
            'rotation' => !empty($settings['rotation']['size']) ? $settings['rotation']['size'] : 0,
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
        <div class="rkit-piechart-container">
            <canvas id="pieChart" width="600" height="400" data-type="<?php echo esc_attr($settings['chart_type']) ?>" data-name="<?php echo esc_attr($settings['data_name']) ?>" data-label="<?php echo esc_attr(json_encode($label));  ?>" data-datasets="<?php echo esc_attr(json_encode($datasets)) ?>" data-legend="<?php echo esc_attr(json_encode($legend)) ?>" style="width: 100%; aspect-ratio:3/2;"></canvas>
        </div>
<?php
    }
}
