<?php

class Rkit_Imagecomparison extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-imagecomparison';
    } 
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['imagecomparison']['name'];
        
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['imagecomparison']['icon'];
        return $icon;
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    public function get_keywords()
    {
        return ['image', 'slider', 'rometheme'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-image-comparison-widget/';
    }

    public function get_style_depends()
    {
        return ['image_comparison-style'];
    }

    public function get_script_depends()
    {
        return ['rkit-image_comparison-script'];
    }

    
    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html('Content'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control(
            'position_slider',
            [
                'label' => esc_html__('Slider Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'horizontal' => esc_html__('horizontal', 'rometheme-for-elementor'),
                    'vertical' => esc_html__('vertical', 'rometheme-for-elementor'),
                ],
                'default' => 'horizontal',
            ]
            );

        $this->add_control(
            'more_options',
            [
                'label' => esc_html__( 'Icon', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__('Show Icon', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
   
 
 
        $this->add_control(
            'divider_before',
            [
                'label' => esc_html__( 'Control Before Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );  
 
        $this->add_control(
            'show_caption_before',
            [
                'label' => esc_html__('Show Caption', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'before_caption',
            [
                'label' => esc_html__('Caption', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your Caption here', 'textdomain'),
                'condition' => [
                    'show_caption_before' => 'yes'
                ],
                'default' => 'Before',
            ]
        );

        $this->add_control(
            'caption_potition_before',
            [
                'label' => esc_html__('Caption position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__('Top', 'textdomain'),
                    'center' => esc_html__('Center', 'textdomain'),
                    'bottom'  => esc_html__('Bottom', 'textdomain'),
                ],
                'default' => 'bottom',
            ]
        );

        $this->add_control(
            'image_before',
            [
                'label' => esc_html__('Image Before', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'divider_after',
            [
                'label' => esc_html__( 'Control After Image', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );  

        $this->add_control(
            'show_caption_after',
            [
                'label' => esc_html__('Show Caption', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'after_caption',
            [
                'label' => esc_html__('Caption', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your Caption here', 'textdomain'),
                'condition' => [
                    'show_caption_after' => 'yes'
                ],
                'default' => 'After',
            ]
        );

        $this->add_control(
            'caption_potition_after',
            [
                'label' => esc_html__('Caption position', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__('Top', 'textdomain'),
                    'center' => esc_html__('Center', 'textdomain'),
                    'bottom'  => esc_html__('Bottom', 'textdomain'),
                ],
                'default' => 'bottom',
            ]
        );

        $this->add_control(
            'image_after',
            [
                'label' => esc_html__('Image After', 'textdomain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

 
        $this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail_after', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

 
        $this->end_controls_section();

    // style section ======================================================================================

    //style section caption
    $this->start_controls_section(
            'caption_section',
            [
                'label' => esc_html__('Caption Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
    );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'caption_typography',
                'label' => esc_html__('Caption Typography', 'text-domain'),
                'selector' => '{{WRAPPER}} .caption-img-comp',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'caption_stroke_normal',
                'selector' => '{{WRAPPER}} .caption-img-comp',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'caption_shadow_normal',
                'selector' => '{{WRAPPER}} .caption-img-comp',
            ]
        );

        $this->add_control(
            'caption_color',
            [
                'label' => esc_html__('Caption Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .caption-img-comp' => 'color: {{VALUE}};'
                    ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'caption_bg_color',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .caption-img-comp',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'caption_border',
                'label' => esc_html__('Border Caption', 'rometheme-for-elementor'),
                'selector' => '{{WRAPPER}} .caption-img-comp',
            ]
        );

        $this->add_control(
            'caption_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .caption-img-comp' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'desc_con_radius',
            [
                'label' => esc_html__('Border Radius', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .caption-img-comp ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ], 
            ]
        );
        
    $this->end_controls_section();

    //style section caption
    $this->start_controls_section(
        'slider_section',
            [
                'label' => esc_html__('Slider Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
    );

        $this->add_control(
            'slider_color',
            [
                'label' => esc_html__('Circle Color', 'text-domain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                        '{{WRAPPER}} .img-comp-slider' => ' box-shadow: 0 0 0 2px {{VALUE}};'
                    ],
            ]
        );

          
        $this->add_control(
            'border_bottom_color',
            [
                'label' => esc_html__('Line Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR, 
                'selectors' => [
                    '{{WRAPPER}} .img-comp-slider::before, {{WRAPPER}} .img-comp-slider::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_options_normal',
            [
                'label' => esc_html__('circle Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'slider_color_bg',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .img-comp-slider',
            ]
        );

       

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'slider_stroke_normal',
                'selector' => '{{WRAPPER}} .img-comp-slider',
            ]
        );

        
       

       
    $this->end_controls_section();


    //style section Image
    $this->start_controls_section(
        'image_section',
            [
                'label' => esc_html__('Image Style', 'text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
    );


    
   

    $this->add_control(
        'border_radius',
        [
            'label' => esc_html__('Border Radius', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'default' => [
                'top' => 0,
                'right' => 0,
                'bottom' => 0,
                'left' => 0,
                'unit' => 'px',
                'isLinked' => false,
            ],
            'selectors' => [
                '{{WRAPPER}} .img-comp-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );



    $this->start_controls_tabs('image_filter');

        $this->start_controls_tab('img_fltr_before', ['label' => esc_html('Before')]);

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'label' => esc_html__('Image Filter Before', 'textdomain'),
                'name' => 'custom_css_filters_before',
                'selector' => '{{WRAPPER}} .filter-before',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('img_fltr_after', ['label' => esc_html('After')]);
 

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'label' => esc_html__('Image Filter After', 'textdomain'),
                'name' => 'custom_css_filters',
                'selector' => '{{WRAPPER}} .filter-after',
            ]
        );
    
        $this->end_controls_tab();
        $this->end_controls_tab();

 


    $this->end_controls_section();

    }
    
    public function render() {
        $settings = $this->get_settings_for_display();
        $image_before = $settings['image_before'];
        $image_after = $settings['image_after'];   
        ?>    

             
<div class="con-wrap rkit-s-image" >
        <div class="img-comp-container rkit-s-image" data-slider-mode="<?php echo esc_html($settings['position_slider']) ?>"  data-show-icon="<?php echo esc_html($settings['show_icon']); ?>"
        >
           
        <div class="img-comp-img rkit-s-image"   
            >
            <img src="<?php echo esc_url($image_after['url']); ?>" class="filter-after rkit-s-image" >
                <div class="caption-<?php echo  esc_html($settings['caption_potition_after']) ?>-right caption-img-comp">
                    <?php echo  esc_html($settings['after_caption']); ?>
                </div>
            </div>  
            
            <div class="img-comp-img img-divider-<?php echo esc_html($settings['position_slider']); ?>  img-comp-overlay rkit-s-image"  >
            <img src="<?php echo esc_url($image_before['url']); ?>"  class="filter-before rkit-s-image" >
                <div class="caption-<?php echo  esc_html($settings['caption_potition_before']) ?>-left caption-img-comp">
                    <?php echo  esc_html($settings['before_caption']); ?>
                </div>
            </div>  

        </div>  
    </div>

       <?php
    }
    

}

