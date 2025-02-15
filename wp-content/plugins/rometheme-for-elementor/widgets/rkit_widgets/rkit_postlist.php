<?php
class Rkit_Postlist extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rkit-postlist';
    } 
    public function get_title()
    {
        return \RomethemeKit\RkitWidgets::listWidgets()['postlist']['name'];
        
    }

    public function get_icon()
    {
        $icon = 'rkit-widget-icon '. \RomethemeKit\RkitWidgets::listWidgets()['postlist']['icon'];
        return $icon;
    }

    public function get_categories()
    {
        return ['romethemekit_widgets'];
    }
 
    public function get_keywords()
    {
        return ['post', 'postlist', 'blog', 'rometheme'];
    }

    function get_custom_help_url()
    {
        return 'https://support.rometheme.net/docs/romethemekit/widgets/how-to-use-ezd_ampersand-customize-post-list-widget/';
    }

    public function get_style_depends()
    {
        return ['rkit-postlist-style'];
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
       

        $this->start_controls_section('content', [
            'label' => esc_html__('Content', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);
        

        $this->add_responsive_control(
            'content_align_self',
            [
                'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    
                    'center' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Center', 'rometheme-for-elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'default' => 'row',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-item-content' => 'align-self: {{VALUE}};',
                ], 
            ]
        );

        $this->add_responsive_control(
            'content_direction',
            [
                'label' => esc_html__('Direction', 'text-domain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__('Column', 'text-domain'),
                        'icon' => 'eicon-section',
                    ],
                    'row' => [
                        'title' => esc_html__('Row', 'text-domain'),
                        'icon' => 'eicon-column',
                    ],
                    
                ],
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}} .rkit-item-postlist' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
            'show_title_post_tlist',
            [
                'label' => esc_html__('Show Title', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'show_category_box',
            [
                'label' => esc_html__('Show Category box', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        // $this->add_control(
        //     'title_position',
        //     [
        //         'label' => esc_html__('Title Position', 'text-domain'),
        //         'type' => \Elementor\Controls_Manager::SWITCHER,
        //         'label_on' => esc_html__('Top', 'text-domain'),
        //         'label_off' => esc_html__('Bottom', 'text-domain'),
        //         'return_value' => 'yes',
        //         'default' => 'yes',
        //     ]
        // );

        $this->add_control(
            'title_position',
            [
                'label' => esc_html__('Title Potition', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [ 
                    'yes' => esc_html__('Top', 'rometheme-for-elementor'),
                    'no'  => esc_html__('Bottom', 'rometheme-for-elementor'),
                ],
                'default' => 'yes', 
            ]
        );

        $this->add_control('truncate-title', [
            'label' => esc_html__('Crop Title By Word', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 3,
          
        ]);

        $this->add_control('truncate-content', [
            'label' => esc_html__('Crop Content By Word', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 10,
            'condition' => [
                'show_content_post_list' => 'yes'
            ]
        ]);

        $this->add_control(
            'show_image_content',
            [
                'label' => esc_html__('Show Featured Image', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'container_title',
            [
                'label' => esc_html__('Title', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Type your Title here', 'textdomain'),
                'condition' => [
                    'show_title_post_tlist' => 'yes'
                ],
                'default' => 'Popular Post',
            ]
        );
        
        $this->add_control(
            'show_content_post_list',
            [
                'label' => esc_html__('Show Content', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
   

        $this->add_control(
            'show_divider',
            [
                'label' => esc_html__('Show Divider', 'text-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'text-domain'),
                'label_off' => esc_html__('Hide', 'text-domain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section('query-content', [
            'label' => esc_html__('Query', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('title_postlist_tag' , [
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
            'default' => 'h5'
        ]);
    

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'text-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );


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


        $this->add_control('show-metadata', [
            'label' => esc_html__('Show Meta Data', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'yes'
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


        $this->add_control('show-read-more-postlist', [
            'label' => esc_html__('Show Read More', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'rometheme-for-elementor'),
            'label_off' => esc_html__('No', 'rometheme-for-elementor'),
            'return_value' => 'yes',
            'default' => 'no'
        ]);

        $this->add_control(
            'readmore-text',
            [
                'label' => esc_html__('Label', 'rometheme-for-elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'rometheme-for-elementor'),
                'placeholder' => esc_html__('Type your label button here', 'rometheme-for-elementor'),
                'condition' => [
                    'show-read-more-postlist' => 'yes'
                ],
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
                'condition' => [
                    'show-read-more-postlist' => 'yes'
                ],
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rkit-readmore-postlist-div' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'show-read-more-postlist' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();



        // style section =========================================================================================================================================

        //container style
    $this->start_controls_section('container_style', [
        'label' => esc_html('Container'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'container_border',
            'label' => esc_html__('Border', 'textdomain'),
            'selector' => '{{WRAPPER}} .rkit-item-postlist  ',
        ]
    );

    $this->add_control(
        'container_background',
        [ 
            'label' => esc_html__( 'Container Background', 'textdomain' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'background_container',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-item-postlist ',
        ]
    );

    $this->add_control(
        'hover_background',
        [ 
            'label' => esc_html__( 'Hover Background', 'textdomain' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'background_hover',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-item-postlist:hover ',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'box_shadow_normal',
            'selector' => '{{WRAPPER}} .rkit-item-postlist',
        ]
    );

    $this->add_responsive_control(
        'cont_spacing',
        [
            'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
              'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 2,
                ],
                '%' => [
                    'min' => 10,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-item-postlist' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'contaoner_padding',
        [
            'label' => esc_html__('Padding', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default' => [
                'top' => 5,
                'right' => 0,
                'bottom' => 0,
                'left' => 0,
                'unit' => 'px',
                'isLinked' => true,
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-item-postlist ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();



          //image style
    $this->start_controls_section('image_style', [
        'label' => esc_html('Image'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
            'show_image_content' => 'yes'
        ],
    ]);


    $this->add_responsive_control(
        'image_position',
        [
            'label' => esc_html__('Image Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'row' => [
                    'title' => esc_html__('Left', 'rometheme-for-elementor'),
                    'icon' => 'eicon-chevron-left',
                ],
                
                'row-reverse' => [
                    'title' => esc_html__('Right', 'rometheme-for-elementor'),
                    'icon' => 'eicon-chevron-right',
                ],
            ], 
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .rkit-item-postlist' => 'flex-direction: {{VALUE}};', 
            ], 
        ]
    );


     $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'label' => esc_html__('Border  ', 'textdomain'),
                    'selector' => '{{WRAPPER}} .rkit-item-thumbnail img ',
                ]
            );
  


    $this->add_control(
        'padding',
        [
            'label' => esc_html__('Padding Image', 'textdomain'),
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
                '{{WRAPPER}}  .rkit-item-thumbnail img  ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->add_control(
        'border_radius',
        [
            'label' => esc_html__('Border Radius Image', 'textdomain'),
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
                '{{WRAPPER}}  .rkit-item-thumbnail img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );


    $this->add_group_control(
        \Elementor\Group_Control_Image_Size::get_type(),
        [
            'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
            'exclude' => ['custom'],
            'include' => [],
            'default' => 'large', 
        ]
    );

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
        'selectors' => [
            '{{WRAPPER}} .rkit-item-thumbnail img' => 'aspect-ratio:{{VALUE}}'
        ]
    ]);

    $this->add_responsive_control(
        'image_width',
        [
            'label' => esc_html__('Width', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
              'px' => [
                    'min' => 0,
                    'max' => 2000,
                    'step' => 2,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-item-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'image_align_self',
        [
            'label' => esc_html__('Vertical Position', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__('Top', 'rometheme-for-elementor'),
                    'icon' => 'eicon-v-align-top',
                ],
                
                'center' => [
                    'title' => esc_html__('Center', 'rometheme-for-elementor'),
                    'icon' => 'eicon-v-align-middle',
                ],
                'flex-end' => [
                    'title' => esc_html__('Center', 'rometheme-for-elementor'),
                    'icon' => 'eicon-v-align-bottom',
                ]
            ],
            'default' => 'row',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .rkit-item-thumbnail' => 'align-self: {{VALUE}};',
            ], 
        ]
    );


    $this->add_group_control(
        \Elementor\Group_Control_Css_Filter::get_type(),
        [
            'label' => esc_html__('Image Filter', 'textdomain'),
            'name' => 'image_filters',
            'selector' => '{{WRAPPER}} .rkit-item-thumbnail img ',
        ]
    );
    
    $this->end_controls_section();



        // title container
        $this->start_controls_section('title_container_section', [
            'label' => esc_html__('Title Container', 'textdomain'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_title_post_tlist' => 'yes'
            ],
           
        ]);
       

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_cont_typography',
                'label' => esc_html__('Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .f-title',
               
            ]
        );

        $this->add_responsive_control(
            'title_cont_align',
            [
                'label' => esc_html__('Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .f-title'=> 'text-align: {{VALUE}};',
                ],
                'default' => 'start',
            ]
        );

        $this->add_control(
            'title_cont',
            [
                'label' => esc_html__('Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .f-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_cont_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .f-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_title_container',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .f-title',
            ]
        );

    $this->end_controls_section();

         //style section title post
         $this->start_controls_section('title_post_section', [
            'label' => esc_html__('Title Post', 'textdomain'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
           
        ]);
       

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_post_typography',
                'label' => esc_html__('Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .title-item',
               
            ]
        );

        $this->add_responsive_control(
            'title_pots_align',
            [
                'label' => esc_html__('Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rkit-title-postlist'=> 'text-align: {{VALUE}};',
                ],
                'default' => 'start',
            ]
        );

        $this->add_control(
            'title_post',
            [
                'label' => esc_html__('Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_posts_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .rkit-title-postlist' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    $this->end_controls_section();

        
    $this->start_controls_section('date_post_section', [
        'label' => esc_html__('Meta Data', 'textdomain'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
       
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'date_post_typography',
            'label' => esc_html__('Typography', 'textdomain'),
            'selector' => '{{WRAPPER}} .rkit-metadata-postlist-row ',
           
        ]
    );

    $this->add_responsive_control(
        'date_pots_align',
        [
            'label' => esc_html__('Alignment', 'textdomain'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'start' => [
                    'title' => esc_html__('Left', 'textdomain'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'textdomain'),
                    'icon' => 'eicon-text-align-center',
                ],
                'end' => [
                    'title' => esc_html__('Right', 'textdomain'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-postlist-row '=> 'justify-content: {{VALUE}};',
            ],
            'default' => 'start',
        ]
    );

    $this->add_control(
        'date_post',
        [
            'label' => esc_html__('Color', 'textdomain'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-item-postlist a,{{WRAPPER}} .rkit-metadata-postlist-row, {{WRAPPER}} .rkit-meta-icon-postlist   ' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'date_posts_padding',
        [
            'label' => esc_html__('Padding', 'textdomain'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rkit-metadata-postlist-row ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'more_options_category',
        [
            'label' => esc_html__( 'Category', 'rometheme-for-elementor' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );  

    $this->add_control(
        'category_color',
        [
            'label' => esc_html__('Color', 'textdomain'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cat_postlist a ' => 'color: {{VALUE}};',
            ],
        ]
    );

        $this->end_controls_section();
        
          //style section content post
          $this->start_controls_section('content_post_section', [
            'label' => esc_html__('Content Post', 'textdomain'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_content_post_list' => 'yes'
            ],
           
        ]);
       

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_post_typography',
                'label' => esc_html__('Typography', 'textdomain'),
                'selector' => '{{WRAPPER}} .content_descripson',
               
            ]
        );

        $this->add_responsive_control(
            'content_post_align',
            [
                'label' => esc_html__('Alignment', 'textdomain'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Left', 'textdomain'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'textdomain'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('Right', 'textdomain'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content_descripson'=> 'text-align: {{VALUE}};',
                ],
                'default' => 'start',
            ]
        );

        $this->add_control(
            'content_post',
            [
                'label' => esc_html__('Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content_descripson' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
                'content_post_padding',
            [
                'label' => esc_html__('Padding', 'textdomain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' =>['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .content_descripson' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

    $this->end_controls_section();
    

    //button style
    $this->start_controls_section('button_style', ['label' => esc_html__('Button', 'rometheme-for-elementor'), 'tab' => \Elementor\Controls_Manager::TAB_STYLE]);
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'readmore_button_typography',
            'selector' => '{{WRAPPER}} .rkit-readmore-postlist-btn',
        ]
    );
    $this->add_responsive_control('button_padding', [
        'label' => esc_html__('Padding', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem'],
        'selectors' => [
            '{{WRAPPER}} .rkit-readmore-postlist-btn' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
        ]
    ]);
    $this->add_responsive_control('button_border_radius', [
        'label' => esc_html__('Border Radius', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%', 'em', 'rem'],
        'selectors' => [
            '{{WRAPPER}} .rkit-readmore-postlist-btn' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}'
        ]
    ]);

    $this->add_control(
        'icon_spacing',
        [
            'label' => esc_html__( 'Icon Spacing    ', 'textdomain' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                '{{WRAPPER}} a.rkit-readmore-postlist-btn' => 'gap: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'show_icon_readmore' => 'yes'
            ]
        ]
    );

    $this->add_responsive_control(
        'icon_button_size',
        [
            'label' => esc_html__('Icon Size', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
              'px' => [
                    'min' => 0,
                    'max' => 2000,
                    'step' => 2,
                ],
            ], 
            'default' => [
                'size' => 20,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .rkit-icon-readmore' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
            '{{WRAPPER}} .rkit-readmore-postlist-btn' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'btn_background_normal',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-readmore-postlist-btn',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border_readmore_btn_normal',
            'selector' => '{{WRAPPER}} .rkit-readmore-postlist-btn',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_normal',
            'selector' => '{{WRAPPER}} .rkit-readmore-postlist-btn',
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab('button_tab_hover', ['label' => esc_html__('Hover', 'rometheme-for-elementor')]);
    $this->add_control('btn_text_color_hover', [
        'label' => esc_html__('Text Color', 'rometheme-for-elementor'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .rkit-readmore-postlist-btn:hover' => 'color : {{VALUE}}'
        ],
    ]);

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'btn_background_hover',
            'types' => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .rkit-readmore-postlist-btn:hover',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'border_readmore_btn_hover',
            'selector' => '{{WRAPPER}} .rkit-readmore-postlist-btn:hover',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'btn_box_shadow_hover',
            'selector' => '{{WRAPPER}} .rkit-readmore-postlist-btn:hover',
        ]
    );
    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->end_controls_section();

   
    $this->start_controls_section('divider_style', [
        'label' => esc_html('Divider'),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE
    ]);
  
    $this->add_responsive_control(
        'divider_width',
        [
            'label' => esc_html__('Width', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' =>['px', '%', 'em', 'rem'],
            'range' => [
              'px' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .divider_line' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'divider_color',
        [
            'label' => esc_html__('Color', 'textdomain'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .divider_line' => 'border-bottom-color: {{VALUE}};',
            ],
        ]
    );

    
    $this->add_responsive_control(
        'divider_spacing',
        [
            'label' => esc_html__('Spacing', 'rometheme-for-elementor'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
              'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 2,
                ],
                '%' => [
                    'min' => 10,
                    'max' => 100,
                ],
            ], 
          'selectors' => [
                '{{WRAPPER}} .divider_line' => 'padding-block-start: {{SIZE}}{{UNIT}}; padding-block-end: {{SIZE}}{{UNIT}};',
            ],

        ]
    );
    $this->end_controls_section();
    }

 
    public function render() {
        $settings = $this->get_settings_for_display();
        $posts_per_page = $settings['posts_per_page'];
        $category = !empty($settings['selected-category']) ? $settings['selected-category'] : '';
        $selected_post = !empty($settings['selected-pots']) ? $settings['selected-post'] : '';

    
        // WP_Query arguments
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page, 
            'order_by' => $settings['order-by'],
            'order' => $settings['order'], 
        ];
      

        if (!empty($settings['post-count'])) {
            $args['posts_per_page'] = $settings['post-count'];
        }

        if (!empty($settings['selected-post'])) {
            $args['post__in'] = $settings['selected-post'];
        }
        if (!empty($settings['selected-category'])) {
            $args['category__in'] = $settings['selected-category'];
        }
        if (!empty($settings['offset'])) {
            $args['offset'] = $settings['offset'];
        } 
         
        switch ($settings['title_postlist_tag']) {
            case 'h1':
                $html_tager = 'h1';
                break;
            case 'h2':
                $html_tager = 'h2';
                break;
            case 'h3':
                $html_tager = 'h3';
                break;
            case 'h4':
                $html_tager = 'h4';
                break;
            case 'h5':
                $html_tager = 'h5';
                break;
            case 'h6':
                $html_tager = 'h6';
                break;
            default:
                $html_tager = 'h1';
                break;
        }


        // The Query
        $query = new \WP_Query( $args );


        if($settings['show_divider'] == 'yes'){
            $divider_on = "divider_line";
        }else{
            $divider_on = "";
        }
 
        ?>
     
       <?php if ( $query->have_posts() ) {
            if($settings['show_title_post_tlist'] == 'yes'){ ?> 
        <div class="f-title"><p><?= esc_attr($settings['container_title']) ?></p></div>
            <?php } ?>
                <div class="widget-content popular-posts">
            <?php 
            while ( $query->have_posts() ) { 
                $query->the_post();
                $title_trunscate_postlist = get_the_title(); 
                $content_descripsonription =  (get_the_excerpt()) ? get_the_excerpt() : get_the_content();
                $content_descripson =  esc_html__((empty($settings['truncate-content'])) ? wp_strip_all_tags($content_descripsonription) : wp_trim_words(wp_strip_all_tags($content_descripsonription), $settings['truncate-content']), 'rometheme-for-elementor') ;
                $category_post = get_the_category();
                $post_title = esc_html__((empty($settings['truncate-title'])) ? wp_strip_all_tags($title_trunscate_postlist) : wp_trim_words(wp_strip_all_tags($title_trunscate_postlist), $settings['truncate-title']), 'rometheme-for-elementor') ;
               
                $post_url = get_the_permalink();
                $thumbnail_url = get_the_post_thumbnail(
                    get_the_ID(),        
                    'thumbnail',
                    [ 
                        'alt'   => $post_title, // Teks alternatif
                        'loading' => 'lazy',  
                    ]
                );
                

                 

          
            ?> 
                <li class="<?php echo esc_html($divider_on) ?>">  
                        <div class="rkit-item-postlist">
                        <?php if($settings['show_image_content'] == 'yes') { ?>
                        <div class="rkit-item-thumbnail">
                            <a href="<?= esc_url( $post_url ) ?>" target="_blank" >
                                <?php   echo $thumbnail_url; ?>
                            </a> 
                        </div>
                        <?php } ?>

                        <div class="rkit-item-content ">
                            <?php if($settings['show_category_box'] == 'yes'){ ?>
                                <span class="category_post"> <?= esc_html( $category_post[0]->name ) ?></span>
                            <?php  } ?>
                           <?php if($settings['title_position'] == 'yes'){?>
                                <<?php echo esc_html($html_tager); ?> class="rkit-title-postlist"><a href="<?= esc_url( $post_url ) ?>" class="title-item" ><?= esc_html( $post_title ) ?></a></<?php echo esc_html($html_tager); ?>>  
                                <div class="rkit-metadata-postlist-row">
                                <?php
                                    if ($settings['metadata-select']) {
                                        foreach ($settings['metadata-select'] as $key => $meta) {
                                            switch ($meta) {
                                                case 'author':
                                    ?>
                                                    <div class="rkit-metadata-item-postlist">
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['author-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                        <?php esc_html__(the_author_posts_link(), 'rometheme-for-elementor') ?>
                                                    </div>
                                                <?php
                                                    break;
                                                case 'date':
                                                ?>
                                                    <div class="rkit-metadata-item-postlist">
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['date-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                        <span><?php echo get_the_date($settings['date_format']) ?></span>
                                                    </div>
                                                <?php
                                                    break;
                                                case 'category':
                                                ?>
                                                    <div class="rkit-metadata-item-postlist ">
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['category-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                       <span class="cat_postlist"> <?php the_category(' | ') ?></span>
                                                    </div>
                                                <?php
                                                    break;
                                                case 'comment':
                                                ?>
                                                    <div class="rkit-metadata-item-postlist">
                                                        <?php \Elementor\Icons_Manager::render_icon($settings['comment-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                        <a href="<?php echo esc_url(get_comments_link()) ?>"><?php echo esc_html(get_comments_number()) ?></a>
                                                    </div>
                                    <?php
                                                    break;
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                         
                                <?php if($settings['show_content_post_list'] == "yes"){  ?>
                                <p class="content_descripson"><?= esc_html( $content_descripson ) ?></p>
                                <?php  } ?> 
                        
                           <?php }else{ ?>
                            <div class="rkit-item-content">
                            <div class="rkit-metadata-postlist-row">
                            <?php
                                if ($settings['metadata-select']) {
                                    foreach ($settings['metadata-select'] as $key => $meta) {
                                        switch ($meta) {
                                            case 'author':
                                ?>
                                                <div class="rkit-metadata-item-postlist">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['author-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                    <?php esc_html__(the_author_posts_link(), 'rometheme-for-elementor') ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'date':
                                            ?>
                                                <div class="rkit-metadata-item-postlist">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['date-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                    <span><?php echo get_the_date($settings['date_format']) ?></span>
                                                </div>
                                            <?php
                                                break;
                                            case 'category':
                                            ?>
                                                <div class="rkit-metadata-item-postlist">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['category-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                    <?php the_category(' | ') ?>
                                                </div>
                                            <?php
                                                break;
                                            case 'comment':
                                            ?>
                                                <div class="rkit-metadata-item-postlist">
                                                    <?php \Elementor\Icons_Manager::render_icon($settings['comment-icon'], ['aria-hidden' => 'true', 'class' => 'rkit-meta-icon-postlist']); ?>
                                                    <a href="<?php echo esc_url(get_comments_link()) ?>"><?php echo esc_html(get_comments_number()) ?></a>
                                                </div>
                                <?php
                                                break;
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <<?php echo esc_html($html_tager); ?> class="rkit-title-postlist"><a href="<?= esc_url( $post_url ) ?>" class="title-item"><?= esc_html( $post_title ) ?></a></<?php echo esc_html($html_tager); ?>>  
                               
                            <?php if($settings['show_content_post_list'] == "yes"){  ?>
                                <p class="content_descripson"><?= esc_html( $content_descripson ) ?></p>
                                <?php  } ?> 
                          <?php } ?>

                          <?php if ('yes' === $settings['show-read-more-postlist']) : ?>
                            <div class="rkit-readmore-postlist-div">
                                <a class="rkit-readmore-postlist-btn" type="button" href="<?php esc_url(the_permalink()) ?>">
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
                        <div style="clear: both;"></div>
                    </li> 
            <?php } ?>
    
            </div> 
        <?php } else { ?>
            <p>No popular posts found</p>
        <?php } ?>
      
        <?php wp_reset_postdata(); ?>
<?php    }    

    // private function get_available_categories() {
    //     $categories = get_categories();
    //     $category_options = [];

    //     if (!empty($categories)) {
    //         foreach ($categories as $category) {
    //             $category_options[$category->term_id] = $category->name;
    //         }
    //     }

    //     return $category_options;
    // }
    
}