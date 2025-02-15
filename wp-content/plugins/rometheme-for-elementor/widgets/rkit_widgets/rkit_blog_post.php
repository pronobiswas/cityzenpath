<?php

class Blog_Post_Rkit extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-post-grid-post';
    }
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['blogpost']['name'];
    }
    public function get_keywords()
    {
        return ['blog post'];
    }
    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-post-grid-widget/';
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon ' . \RomethemeKit\RkitWidgets::listWidgets()['blogpost']['icon'];
        return $icon;
    }
    public function get_style_depends()
    {
        return ['rkit-post-grid-style'];
    }

    public function limit_words($phrase, $max_words)
    {
        $phrase_array = explode(' ', $phrase);
        if (count($phrase_array) > $max_words && $max_words > 0)
            $phrase = implode(' ', array_slice($phrase_array, 0, $max_words)) . '...';
        return $phrase;
    }

    public function rkit_get_posts()
    {
        $posts = get_posts(['post_type' => 'post']);
        $list_post = [];
        foreach ($posts as $post) {
            $list_post[$post->ID] = esc_html__($post->post_title);
        }
        return $list_post;
    }

    public function rkit_get_categories()
    {
        $categories = get_categories();
        $list = [];
        foreach ($categories as $cat) {
            $list[$cat->term_id] = $cat->name;
        }
        return $list;
    }

    protected function register_controls()
    {
        $this->start_controls_section('content-section', [
            'label' => esc_html__('Layout', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_responsive_control('show-post-row', [
            'label' => esc_html__('Show Post Per Row'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid' => 'grid-template-columns: repeat({{VALUE}}, 1fr);'
            ],
            'desktop_default' => 3,
            'tablet_default' => 2,
            'mobile_default' => 1,
        ]);

        $this->add_responsive_control('item-spacing', [
            'label' => esc_html__('Item Spacing', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000, 'step' => 2],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 100],
                'rem' => ['min' => 0, 'max' => 100],
            ],
            'default' => ['size' => 30, 'unit' => 'px'],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid' => 'gap:{{SIZE}}{{UNIT}}'
            ],
        ]);

        $this->add_control('show-featured-image', [
            'label' => esc_html__('Show Featured Image', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]);

        $this->add_responsive_control('img-aspect-ratio', [
            'label' => esc_html__('Image Aspect Ratio', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                '1/1' => esc_html__('1 : 1', 'rometheme-for-elementor'),
                '3/2' => esc_html__('3 : 2', 'rometheme-for-elementor'),
                '5/4' => esc_html__('5 : 4', 'rometheme-for-elementor'),
                '16/9' => esc_html__('16 : 9', 'rometheme-for-elementor'),
                '9/16' => esc_html__('9 : 16', 'rometheme-for-elementor'),

            ],
            'default' => '16/9',
            'selectors' => [
                '{{WRAPPER}} .rkit-image-link' => 'aspect-ratio:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'exclude' => ['custom'],
                'include' => [],
                'default' => 'large',
                'condition' => [
                    'show-featured-image' => 'yes'
                ],
            ]
        );

        $this->add_control('show-title', [
            'label' => esc_html__('Show Title', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]);

        $this->add_control('truncate-title', [
            'label' => esc_html__('Crop Title By Word', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'condition' => [
                'show-title' => 'yes'
            ]
        ]);

        $this->add_control('show-content', [
            'label' => esc_html__('Show Content', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]);

        $this->add_control('truncate-content', [
            'label' => esc_html__('Crop Content By Word', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 15,
            'condition' => [
                'show-content' => 'yes'
            ]
        ]);

        $this->add_control('show-read-more', [
            'label' => esc_html__('Show Read More', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]);

        $this->end_controls_section();

        $this->start_controls_section('query-content', [
            'label' => esc_html__('Query', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('post-count', [
            'label' => esc_html__('Post Count', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 3
        ]);

        $this->add_control('select-post', [
            'label' => esc_html__('Select Post By', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'recent' => esc_html__('Recent Post', 'rometheme-for-elementor'),
                'selected_post' => esc_html__('Selected Post', 'rometheme-for-elementor'),
                'category_post' => esc_html__('Category Post', 'rometheme-for-elementor')
            ],
            'default' => 'recent',
        ]);

        $this->add_control('selected-post', [
            'label' => esc_html__('Search and Select', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => $this->rkit_get_posts(),
            'condition' => [
                'select-post' => 'selected_post'
            ]
        ]);

        $this->add_control('selected-category', [
            'label' => esc_html__('Select Categories', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => $this->rkit_get_categories(),
            'condition' => [
                'select-post' => 'category_post'
            ]
        ]);

        $this->add_control('offset', [
            'label' => esc_html__('Offset', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 0
        ]);

        $this->add_control('order-by', [
            'label' => esc_html__('Order By', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'date' => esc_html__('Date', 'rometheme-for-elementor'),
                'title' => esc_html__('Title', 'rometheme-for-elementor'),
                'author' => esc_html__('Author', 'rometheme-for-elementor'),
                'modified' => esc_html__('Modified', 'rometheme-for-elementor'),
                'comment_count' => esc_html__('Comments', 'rometheme-for-elementor')
            ],
            'default' => 'date'
        ]);

        $this->add_control('order', [
            'label' => esc_html__('Order', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'asc' => esc_html__('ASC', 'rometheme-for-elementor'),
                'desc' => esc_html__('DESC', 'rometheme-for-elementor')
            ],
            'default' => 'desc',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('metadata-content', [
            'label' => esc_html__('Meta Data', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('show-floating-date', [
            'label' => esc_html__('Show Floating Date', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]);

        $this->add_control('show-floating-categories', [
            'label' => esc_html__('Show Floating Category', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'no'
        ]);


        $this->add_control('show-metadata', [
            'label' => esc_html__('Show Meta Data', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes'
        ]);

        $this->add_control('meta_position', [
            'label' => esc_html__('Meta Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'before_title' => esc_html__('Before Title', 'rometheme-for-elementor'),
                'after_title' => esc_html__('After Title', 'rometheme-for-elementor'),
                'after_content' => esc_html__('After Content', 'rometheme-for-elementor')
            ],
            'default' => 'before_title',
            'condition' => [
                'show-metadata' => 'yes'
            ]
        ]);

        $this->add_control('metadata-select', [
            'label' => esc_html__('Meta Data', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT2,
            'label_block' => true,
            'multiple' => true,
            'options' => [
                'author' => esc_html__('Author', 'rometheme-for-elementor'),
                'date' => esc_html__('Date', 'rometheme-for-elementor'),
                'category' => esc_html__('Category', 'rometheme-for-elementor'),
                'comment' => esc_html__('Comment', 'rometheme-for-elementor'),
            ],
            'default' => ['author', 'date'],
            'condition' => [
                'show-metadata' => 'yes'
            ]
        ]);

        $this->add_control(
            'author-icon',
            [
                'label' => esc_html__('Author', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-circle-user',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'metadata-select' => 'author'
                ]
            ]
        );

        $this->add_control(
            'date-icon',
            [
                'label' => esc_html__('Date', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-calendar',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'metadata-select' => 'date'
                ]
            ]
        );

        $this->add_control('date_format', [
            'label' => esc_html__('Date Format', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'F d, Y' => esc_html__('January 01 , 2023', 'rometheme-for-elementor'),
                'd F Y' => esc_html__('01 January 2023', 'rometheme-for-elementor'),
                'M j, Y' => esc_html__('Jan 01, 2023', 'rometheme-for-elementor'),
                'd M Y' => esc_html__('01 Jan 2023', 'rometheme-for-elementor'),
                'F jS, Y' => esc_html__('January 1st, 2023', 'rometheme-for-elementor'),
                'd/m/Y' => esc_html__('(Day/Month/Year) - 01/01/2023'),
                'm/d/Y' => esc_html__('(Month/Day/Year) - 01/01/2023'),
                'Y-m-d' => esc_html('(Year-Month-Day) - 2023-01-01'),
            ],
            'default' => 'F d, Y',
            'condition' => [
                'metadata-select' => 'date'
            ]
        ]);

        $this->add_control(
            'category-icon',
            [
                'label' => esc_html__('Category', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-folders',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'metadata-select' => 'category'
                ]
            ]
        );

        $this->add_control(
            'comment-icon',
            [
                'label' => esc_html__('Comments', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-faqs',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'metadata-select' => 'comment'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('read-more-content', ['label' => esc_html__('Read More Button'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);

        $this->add_control(
            'readmore-text',
            [
                'label' => esc_html__('Label', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your label button here', 'rometheme-for-elementor'),
            ]
        );

        $this->add_control(
            'show_icon_readmore',
            [
                'label' => esc_html__('Add Icon ?', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
                'label_off' => esc_html__('No', 'rometheme-for-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'icon_readmore',
            [
                'label' => esc_html__('Icon', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rtmicon rtmicon-arrow-right',
                    'library' => 'rtmicons',
                ],
                'condition' => [
                    'show_icon_readmore' => 'yes'
                ]
            ]
        );

        $this->add_control('icon_position', [
            'label' => esc_html__('Icon Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'after' => esc_html__('After', 'rometheme-for-elementor'),
                'before' => esc_html__('Before', 'rometheme-for-elementor')
            ],
            'default' => 'after',
            'condition' => [
                'show_icon_readmore' => 'yes'
            ]
        ]);

        $this->add_responsive_control(
            'btn_align',
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
                    '{{WRAPPER}} .rkit-readmore-div' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('wrapper_section', ['label' => esc_html__('Wrapper', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->start_controls_tabs('wrapper_tabs');

        $this->start_controls_tab('wrapper_tab_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-post-grid-card',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_boxshadow',
                'selector' => '{{WRAPPER}} .rkit-post-grid-card',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('wrapper_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_control(
            'card_hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-post-grid-card:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wrapper_boxshadow_hover',
                'selector' => '{{WRAPPER}} .rkit-post-grid-card:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'container_options',
            [
                'label' => esc_html__('Container Setting', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control('container_border_radius', [
            'label' => esc_html__('Container Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-card' => 'border-radius : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('container_padding', [
            'label' => esc_html__('Container Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-card' => 'padding : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('container_margin', [
            'label' => esc_html__('Container Margin', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-card' => 'Margin : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .rkit-post-grid-card',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('content_wrapper_setting', ['label' => esc_html__('Content Wrapper ', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
        $this->add_control(
            'content_options',
            [
                'label' => esc_html__('Content Setting', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('wrapper_content_tabs');

        $this->start_controls_tab('content_tab_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-post-grid-body',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_boxshadow',
                'selector' => '{{WRAPPER}} .rkit-post-grid-body',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('content_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-post-grid-card:hover .rkit-post-grid-body',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_boxshadow_hover',
                'selector' => '{{WRAPPER}} .rkit-post-grid-card:hover .rkit-post-grid-body',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control('content-min-height', [
            'label' => esc_html__('Min Height', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000, 'step' => 1],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],

            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-body' => 'min-height:{{SIZE}}{{UNIT}}'
            ]

        ]);

        $this->add_responsive_control('content_border_radius', [
            'label' => esc_html__('Content Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-body' => 'border-radius : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('content_padding', [
            'label' => esc_html__('Content Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default' => [
                'top' => 30,
                'right' => 30,
                'bottom' => 30,
                'left' => 30,
                'unit' => 'px',
                'isLinked' => true
            ],
            'tablet_default' => [
                'top' => 30,
                'right' => 30,
                'bottom' => 30,
                'left' => 30,
                'unit' => 'px',
                'isLinked' => true
            ],
            'mobile_default' => [
                'top' => 20,
                'right' => 20,
                'bottom' => 20,
                'left' => 20,
                'unit' => 'px',
                'isLinked' => true
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-body' => 'padding : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('content_margin', [
            'label' => esc_html__('Content Margin', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-body' => 'Margin : {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .rkit-post-grid-body',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section('featured_image_setting', ['label' => esc_html__('Featured Image', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_responsive_control(
            'min-width-img',
            [
                'label' => esc_html__('Min Width', 'rometheme-for-elementor'),
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
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image-link' => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'max-width-img',
            [
                'label' => esc_html__('Max Width', 'rometheme-for-elementor'),
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
                    'rem' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image-link' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'img_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-image-link',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'img_border',
                'selector' => '{{WRAPPER}} .rkit-image-link',
            ]
        );

        $this->add_responsive_control(
            'img-border-radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'img-margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'img-padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-image-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('featured_image_tabs');

        $this->start_controls_tab('fi-tabs-normal', ['label' => esc_html('Normal')]);

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'featured_image_filter',
                'selector' => '{{WRAPPER}} .rkit-post-grid-card .rkit-post-grid-img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('fi-tabs-hover', ['label' => esc_html('Hover')]);

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'featured_image_filter_hover',
                'selector' => '{{WRAPPER}} .rkit-post-grid-card:hover .rkit-post-grid-img',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('meta_style', ['label' => esc_html__('Meta Data', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);

        $this->add_responsive_control(
            'meta_direction',
            [
                'label' => esc_html__('Direction', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__('Row', 'rometheme-for-elementor'),
                        'icon' => 'eicon-arrow-right',
                    ],
                    'column' => [
                        'title' => esc_html__('Column', 'rometheme-for-elementor'),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-metadata' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .rkit-metadata-item > a , {{WRAPPER}} .rkit-metadata-item > span ',
            ]
        );

        $this->add_responsive_control(
            'meta_align_row',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-metadata' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'meta_direction' => 'row'
                ]
            ]
        );

        $this->add_responsive_control(
            'meta_align_column',
            [
                'label' => esc_html__('Alignment', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-metadata' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'meta_direction' => 'column'
                ]
            ]
        );

        $this->add_responsive_control(
            'meta-margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '0',
                    'right' => '5',
                    'bottom' => '0',
                    'left' => '5',
                    'unit' => 'px',
                    'isLinked' => 'false',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-metadata-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta-padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-metadata-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta-icon-spacing',
            [
                'label' => esc_html__('Icon Spacing', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '0',
                    'right' => '5',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => 'false',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-meta-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control('icon_size', [
            'label' => esc_html__('Icon Size'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .rkit-meta-icon' => 'font-size:{{SIZE}}{{UNIT}}'
            ]
        ]);

        $this->start_controls_tabs('meta-tabs');
        $this->start_controls_tab('meta-tab-normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_control('meta-color-normal', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-item > a , {{WRAPPER}} .rkit-metadata-item > span' => 'color : {{VALUE}}'
            ]
        ]);
        $this->add_control('meta-iconcolor-normal', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-meta-icon' => 'color : {{VALUE}}'
            ]
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'meta_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-metadata-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'meta_border_normal',
                'selector' => '{{WRAPPER}} .rkit-metadata-item',
            ]
        );
        $this->add_responsive_control('meta-borderradius-normal', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'meta_boxshadow_normal',
                'selector' => '{{WRAPPER}} .rkit-metadata-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'meta_textshadow_normal',
                'selector' => '{{WRAPPER}} .rkit-metadata-item > a , {{WRAPPER}} .rkit-metadata-item > span',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('meta-tab-hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_control('meta-color-hover', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-item:hover > a , .rkit-metadata-item:hover > span' => 'color : {{VALUE}}'
            ]
        ]);
        $this->add_control('meta-iconcolor-hover', [
            'label' => esc_html__('Icon Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-item:hover .rkit-meta-icon' => 'color : {{VALUE}}'
            ]
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'meta_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-metadata-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'meta_border_hover',
                'selector' => '{{WRAPPER}} .rkit-metadata-item:hover',
            ]
        );
        $this->add_responsive_control('meta-borderradius-hover', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'meta_boxshadow_hover',
                'selector' => '{{WRAPPER}} .rkit-metadata-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'meta_textshadow_hover',
                'selector' => '{{WRAPPER}} .rkit-metadata-item:hover > a , .rkit-metadata-item:hover > span',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('title_style', ['label' => esc_html__('Title', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rkit-post-grid-title',
            ]
        );

        $this->add_responsive_control(
            'title_align',
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
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-post-grid-title-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-post-grid-title-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Padding', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-post-grid-title-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab('title_tab_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_control('title_color_normal', [
            'label' => esc_html__('Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-title' => 'color:{{VALUE}}',
            ]
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-post-grid-title',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('title_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_control('title_color_hover', [
            'label' => esc_html__('Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-title:hover' => 'color:{{VALUE}}',
            ]
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-post-grid-title:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('content_style', ['label' => esc_html__('Content'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'blog_content_typography',
                'selector' => '{{WRAPPER}} .rkit-post-grid-paragraph',
            ]
        );

        $this->add_responsive_control(
            'content_align',
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
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-post-grid-paragraph' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('content_color', [
            'label' => esc_html__('Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-paragraph' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('content_hover_color', [
            'label' => esc_html__('Hover Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-paragraph:hover' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'paragraph_shadow',
                'selector' => '{{WRAPPER}} .rkit-post-grid-paragraph',
            ]
        );

        $this->add_responsive_control(
            'paragraph_margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-post-grid-paragraph' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr1',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control('show_highlight', [
            'label' => esc_html__('Show Highlight', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'rometheme-for-elementor'),
            'label_off' => esc_html__('Hide', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'no',
        ]);

        $this->add_responsive_control('height_highlight', [
            'label' => esc_html__('Height', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000, 'step' => 1],
                '%' => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-highlight-border::before' => 'height:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'show_highlight' => 'yes'
            ]
        ]);
        $this->add_responsive_control('width_highlight', [
            'label' => esc_html__('Width', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000, 'step' => 1],
                '%' => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-highlight-border::before' => 'width:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'show_highlight' => 'yes'
            ]
        ]);

        $this->add_responsive_control('top_bottom_highlight', [
            'label' => esc_html__('Top Bottom Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => ['min' => -1000, 'max' => 1000, 'step' => 1],
                '%' => ['min' => -100, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-highlight-border::before' => 'top:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'show_highlight' => 'yes'
            ]
        ]);

        $this->add_responsive_control('left_right_highlight', [
            'label' => esc_html__('Left Right Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => ['min' => -1000, 'max' => 1000, 'step' => 1],
                '%' => ['min' => -100, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-post-grid-highlight-border::before' => 'left:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'show_highlight' => 'yes'
            ]
        ]);

        $this->start_controls_tabs('highlight_tabs', [
            'condition' => [
                'show_highlight' => 'yes'
            ]
        ]);
        $this->start_controls_tab('highlight_tab_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'highlight_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-post-grid-highlight-border::before',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('highlight_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'highlight_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-post-grid-card:hover .rkit-post-grid-highlight-border::before',
            ]
        );
        $this->add_control(
            'rkit_highlight_transition',
            [
                'label' => esc_html__('Transition', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => .1,
                        'max' => 5,
                        'step' => .1,
                    ],

                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-post-grid-highlight-border::before' => '-webkit-transition: all {{SIZE}}{{UNIT}}; -o-transition: all {{SIZE}}{{UNIT}}; transition: all {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('button_style', ['label' => esc_html__('Button', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'readmore_button_typography',
                'selector' => '{{WRAPPER}} .rkit-readmore-btn',
            ]
        );
        $this->add_responsive_control('button_padding', [
            'label' => esc_html__('Padding', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-readmore-btn' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
            ]
        ]);
        $this->add_responsive_control('button_border_radius', [
            'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-readmore-btn' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
            ]
        ]);

        $this->add_control(
            'readmore_icon_size',
            [
                'label' => esc_html__('Icon Size    ', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} a.rkit-readmore-btn .rkit-icon-readmore' => 'font-size: {{SIZE}}{{UNIT}}; , width : {{SIZE}}{{UNIT}} ; height : {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon_readmore' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon_spacing',
            [
                'label' => esc_html__('Icon Spacing    ', 'rometheme-for-elementor'),
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
                'selectors' => [
                    '{{WRAPPER}} a.rkit-readmore-btn' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_icon_readmore' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs('button_tabs');
        $this->start_controls_tab('button_tab_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_control('btn_text_color_normal', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-readmore-btn' => 'color : {{VALUE}}'
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-readmore-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_readmore_btn_normal',
                'selector' => '{{WRAPPER}} .rkit-readmore-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rkit-readmore-btn',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('button_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_control('btn_text_color_hover', [
            'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-readmore-btn:hover' => 'color : {{VALUE}}'
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'btn_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rkit-readmore-btn:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_readmore_btn_hover',
                'selector' => '{{WRAPPER}} .rkit-readmore-btn:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-readmore-btn:hover',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('floating_meta_style', ['label' => esc_html__('Floating Date', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE,  'condition' => [
            'show-floating-date' => 'yes'
        ]]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'floating_date_typography',
                'selector' => '{{WRAPPER}} .rkit-float-metawrapper-date',
                'condition' => [
                    'show-floating-date' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'floating_top_bottom_position',
            [
                'label' => esc_html__('Top Bottom Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'bottom',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-float-metawrapper-date' => '{{VALUE}}: 0px;',
                ],
                'condition' => [
                    'show-floating-date' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'floating_left_right_position',
            [
                'label' => esc_html__('Left Right Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-float-metawrapper-date' => '{{VALUE}}: 0px;',
                ],
                'condition' => [
                    'show-floating-date' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'floating-date-width',
            [
                'label' => esc_html__('Width', 'rometheme-for-elementor'),
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
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-float-metawrapper-date' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show-floating-date' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'floating-date-height',
            [
                'label' => esc_html__('Height', 'rometheme-for-elementor'),
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
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-float-metawrapper-date' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show-floating-date' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'floating-date-border-radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-float-metawrapper-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show-floating-date' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'floating-date-margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 0,
                    'right' => 30,
                    'bottom' => -15,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-float-metawrapper-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show-floating-date' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'floating_date_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-float-metawrapper-date',
            ]
        );

        $this->add_control(
            'floating_date_text_color',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-float-metawrapper-date' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'floating_date_background',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .rkit-float-metawrapper-date',
                'condition' => [
                    'show-floating-date' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section('floating_category_style', ['label' => esc_html__('Floating Category', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE,  'condition' => [
            'show-floating-categories' => 'yes'
        ]]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'floating_category_typography',
                'selector' => '{{WRAPPER}} .rkit-floating-category-btn',
                'condition' => [
                    'show-floating-categories' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'floating_top_bottom_position_category',
            [
                'label' => esc_html__('Top Bottom Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-floating-category' => '{{VALUE}}: 0px;',
                ],
                'condition' => [
                    'show-floating-categories' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'floating_left_right_position_category',
            [
                'label' => esc_html__('Left Right Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rometheme-for-elementor'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-floating-category' => '{{VALUE}}: 0px;',
                ],
                'condition' => [
                    'show-floating-categories' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'floating-category-border-radius',
            [
                'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-floating-category-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show-floating-categories' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'floating-category-margin',
            [
                'label' => esc_html__('Margin', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => 1,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 1,
                    'unit' => 'em',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-floating-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show-floating-categories' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs('floating_category_tabs');
        $this->start_controls_tab('floating_category_tab_normal', ['label' => esc_html__('Normal', 'rometheme-for-elementor')]);
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'floating_category_box_shadow',
                'selector' => '{{WRAPPER}} .rkit-floating-category-btn',
            ]
        );

        $this->add_control(
            'floating_category_text_color',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-floating-category-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'floating_category_border_normal',
                'selector' => '{{WRAPPER}} .rkit-floating-category-btn',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'floating_category_background',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .rkit-floating-category-btn',
                'condition' => [
                    'show-floating-categories' => 'yes'
                ]
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('floating_category_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'floating_category_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rkit-floating-category-btn',
            ]
        );

        $this->add_control(
            'floating_category_text_color_hover',
            [
                'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rkit-floating-category-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'floating_category_border_hover',
                'selector' => '{{WRAPPER}} .rkit-floating-category-btn:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'floating_category_background_hover',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .rkit-floating-category-btn:hover',
                'condition' => [
                    'show-floating-categories' => 'yes'
                ]
            ]
        );
        $this->end_controls_tab();


        $this->end_controls_tabs();

        $this->end_controls_section();
    }
    protected function render()
    {
?>
        <div class="rkit-post-grid">
            <?php $this->render_raw() ?>
        </div>
        <?php
    }
    protected function render_raw()
    {
        $settings = $this->get_settings_for_display();
        $arg = [
            'post_type' => 'post',
            'order_by' => $settings['order-by'],
            'order' => $settings['order']
        ];

        $hoverAnimation = ' elementor-animation-' . $settings['card_hover_animation'];

        if (!empty($settings['post-count'])) {
            $arg['posts_per_page'] = $settings['post-count'];
        }

        if (!empty($settings['selected-post'])) {
            $arg['post__in'] = $settings['selected-post'];
        }
        if (!empty($settings['selected-category'])) {
            $arg['category__in'] = $settings['selected-category'];
        }
        if (!empty($settings['offset'])) {
            $arg['offset'] = $settings['offset'];
        }
        $post = new WP_Query($arg);
        if ($post->have_posts()) {
            while ($post->have_posts()) {
                $post->the_post();
                $post_id = intval(get_the_ID());
                $post_content = (get_the_excerpt()) ? get_the_excerpt() : get_the_content();
                $post_title = get_the_title();
        ?>
                <div class="rkit-post-grid-card <?php echo esc_attr($hoverAnimation) ?>">
                    <?php if ('yes' === $settings['show-featured-image']) : ?>
                        <div class="rkit-image-container">
                            <?php
                            if ('yes' === $settings['show-floating-categories']) : ?>
                                <div class="rkit-floating-category">
                                    <?php $categories = get_the_category();
                                    foreach ($categories as $cat) : ?>
                                        <div class="rkit-floating-category-div">
                                            <a class="rkit-floating-category-btn" type="button" href="<?php echo esc_url(get_category_link($cat->term_id)) ?>"><?php echo esc_html__($cat->name, 'rometheme-for-elementor') ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php
                            endif;
                            ?>
                            <a class="rkit-image-link" style="overflow: hidden;" href="<?php esc_url(the_permalink()) ?>">
                                <?php the_post_thumbnail($settings['thumbnail_size'] , ['class' => 'rkit-post-grid-img' ]) ?>
                            </a>
                            <?php if ('yes' === $settings['show-floating-date']) : ?>
                                <div class="rkit-float-metawrapper-date">
                                    <span><?php echo '<strong>' . get_the_date('d') . '</strong>' . get_the_date('M'); ?></span>
                                </div>   
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="rkit-post-grid-body <?php echo ('yes' === $settings['show_highlight']) ? esc_attr('rkit-post-grid-highlight-border') : '' ?>">
                        <?php if ('before_title' === $settings['meta_position']) : ?>
                            <div class="rkit-metadata">
                                <?php
                                if ($settings['metadata-select']) {
                                    foreach ($settings['metadata-select'] as $key => $meta) {
                                        switch ($meta) {
                                            case 'author':
                                ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['author-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <?php the_author_posts_link() ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'date':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['date-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <span><?php echo get_the_date($settings['date_format']) ?></span>
                                                </div>
                                            <?php
                                                break;
                                            case 'category':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['category-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <?php the_category(' | ') ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'comment':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['comment-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <a href="<?php echo esc_url(get_comments_link()) ?>"><?php echo esc_html(get_comments_number()) ?></a>
                                                </div>
                                <?php
                                                break;
                                        }
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if ('yes' === $settings['show-title']) : ?>
                            <div class="rkit-post-grid-title-container">
                                <a class="rkit-post-grid-title" href="<?php the_permalink() ?>"><?php echo esc_html__((empty($settings['truncate-title'])) ? wp_strip_all_tags($post_title) : wp_trim_words(wp_strip_all_tags($post_title), $settings['truncate-title']), 'rometheme-for-elementor') ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if ('after_title' === $settings['meta_position']) : ?>
                            <div class="rkit-metadata">
                                <?php
                                if ($settings['metadata-select']) {
                                    foreach ($settings['metadata-select'] as $key => $meta) {
                                        switch ($meta) {
                                            case 'author':
                                ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['author-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <?php esc_html__(the_author_posts_link(), 'rometheme-for-elementor') ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'date':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['date-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <span><?php echo get_the_date($settings['date_format']) ?></span>
                                                </div>
                                            <?php
                                                break;
                                            case 'category':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['category-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <?php the_category(' | ') ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'comment':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['comment-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <a href="<?php echo esc_url(get_comments_link()) ?>"><?php echo esc_html(get_comments_number()) ?></a>
                                                </div>
                                <?php
                                                break;
                                        }
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if ('yes' === $settings['show-content']) : ?>
                            <div class="rkit-post-grid-content">
                                <p class="rkit-post-grid-paragraph"><?php echo esc_html__((empty($settings['truncate-content'])) ? wp_strip_all_tags($post_content) : wp_trim_words(wp_strip_all_tags($post_content), $settings['truncate-content']), 'rometheme-for-elementor') ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        <?php if ('after_content' === $settings['meta_position']) : ?>
                            <div class="rkit-metadata">
                                <?php
                                if ($settings['metadata-select']) {
                                    foreach ($settings['metadata-select'] as $key => $meta) {
                                        switch ($meta) {
                                            case 'author':
                                ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['author-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <?php esc_html__(the_author_posts_link(), 'rometheme-for-elementor') ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'date':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['date-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <span><?php echo get_the_date($settings['date_format']) ?></span>
                                                </div>
                                            <?php
                                                break;
                                            case 'category':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['category-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <?php the_category(' | ') ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'comment':
                                            ?>
                                                <div class="rkit-metadata-item">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['comment-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon']); ?>
                                                    <a href="<?php echo esc_url(get_comments_link()) ?>"><?php echo esc_html(get_comments_number()) ?></a>
                                                </div>
                                <?php
                                                break;
                                        }
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if ('yes' === $settings['show-read-more']) : ?>
                            <div class="rkit-readmore-div">
                                <a class="rkit-readmore-btn" type="button" href="<?php the_permalink() ?>">
                                    <?php if ('before' === $settings['icon_position']) {
                                        \Elementor\Icons_Manager::render_icon($settings['icon_readmore'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                    } ?>
                                    <?php echo esc_html__($settings['readmore-text'], 'rometheme-for-elementor') ?>
                                    <?php if ('after' === $settings['icon_position']) {
                                        \Elementor\Icons_Manager::render_icon($settings['icon_readmore'], ['aria-hidden' => 'true', 'class' => 'rkit-icon-readmore']);
                                    } ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
<?php
            }
        }
    }
}