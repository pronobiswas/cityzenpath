<?php

class RForm_Phone extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rform_phone';
    }
    public function get_title()
    {
        return 'RForm - Telephone';
    }
    public function get_categories()
    {
        return ['romethemeform_form_fields'];
    }
    public function get_icon()
    {
        return 'rform-widget-icon rtmicon rtmicon-telephone';
    }

    public function show_in_panel()
    {
        return 'romethemeform_form' === get_post_type();
    }
    public function get_keywords()
    {
        return ['text', 'fields', 'input', 'rometheme form'];
    }

    public function get_script_depends()
    {
        return ['rtform-text-js', 'rform-phone-js'];
    }

    public function get_style_depends()
    {
        return ['rtform-text-style'];
    }

    private function countries()
    {
        $countries = [
            "AF" => "Afghanistan",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas (the)",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "AX" => "Åland Islands",
            "BT" => "Bhutan",
            "BO" => "Bolivia (Plurinational State of)",
            "BQ" => "Bonaire, Sint Eustatius and Saba",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory (the)",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "CV" => "Cabo Verde",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "KY" => "Cayman Islands (the)",
            "CF" => "Central African Republic (the)",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands (the)",
            "CO" => "Colombia",
            "KM" => "Comoros (the)",
            "CD" => "Congo (the Democratic Republic of the)",
            "CG" => "Congo (the)",
            "CK" => "Cook Islands (the)",
            "CR" => "Costa Rica",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CW" => "Curaçao",
            "CY" => "Cyprus",
            "CZ" => "Czechia",
            "CI" => "Côte d'Ivoire",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic (the)",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "SZ" => "Eswatini",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (the) [Malvinas]",
            "FO" => "Faroe Islands (the)",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories (the)",
            "GA" => "Gabon",
            "GM" => "Gambia (the)",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-Bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and McDonald Islands",
            "VA" => "Holy See (the)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran (Islamic Republic of)",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea (the Democratic People's Republic of)",
            "KR" => "Korea (the Republic of)",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic (the)",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands (the)",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia (Federated States of)",
            "MD" => "Moldova (the Republic of)",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands (the)",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger (the)",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MK" => "North Macedonia",
            "MP" => "Northern Mariana Islands (the)",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestine, State of",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines (the)",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RO" => "Romania",
            "RU" => "Russian Federation (the)",
            "RW" => "Rwanda",
            "RE" => "Réunion",
            "BL" => "Saint Barthélemy",
            "SH" => "Saint Helena, Ascension and Tristan da Cunha",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "MF" => "Saint Martin (French part)",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and the Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SX" => "Sint Maarten (Dutch part)",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and the South Sandwich Islands",
            "SS" => "South Sudan",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan (the)",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic (the)",
            "TW" => "Taiwan (Province of China)",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, the United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-Leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands (the)",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates (the)",
            "GB" => "United Kingdom of Great Britain and Northern Ireland (the)",
            "US" => "United States of America (the)",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela (Bolivarian Republic of)",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands (British)",
            "VI" => "Virgin Islands (U.S.)",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara*",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe",
        ];
        return $countries;
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Label', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'romethemeform'),
                'label_off' => esc_html__('Hide', 'romethemeform'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__("for adding label on input turn it on. Don't want to use label? turn it off.", 'romethemeform')
            ]
        );

        $this->add_control('label_position', [
            'label' => esc_html__('Position', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'rform-label-top' => esc_html__('Top', 'romethemeform'),
                'rform-label-left' => esc_html__('Left', 'romethemefom-plugin')
            ],
            'default' => 'rform-label-top',
            'description' => esc_html__('Select label position. where you want to see it. top of the input or left of the input.', 'romethemeform'),
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);

        $this->add_control('label_text', [
            'label' => esc_html__('Label', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Phone Number', 'romethemeform'),
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);

        $this->add_control('name_input', [
            'label' => esc_html__('Name', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('rform-phone', 'romethemeform'),
            'description' => esc_html__('Name is must required. Enter name without space or any special character. use only underscore/ hyphen (_/-) for multiple word. Name must be different.', 'romethemeform')
        ]);

        $this->add_control('placeholder_input', [
            'label' => esc_html__('Placeholder', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Input Number Here', 'romethemeform')
        ]);

        $this->add_control('help_text', [
            'label' => esc_html__('Help Text', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__('Type your help text here', 'romethemeform'),
        ]);

        $this->end_controls_section();

        $this->start_controls_section('settings_section', [
            'label' => esc_html__('Setting', 'rometheme-for-elementor'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);

        $this->add_control('default_countries', [
            'label' => esc_html('Default Country'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => $this->countries(),
            'default' => 'ID'
        ]);


        $this->add_control(
            'required_input',
            [
                'label' => esc_html__('Required ?', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'romethemeform'),
                'label_off' => esc_html__('No', 'romethemeform'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Is this field is required for submit the form?. Make it "Yes".', 'romethemeform')
            ]
        );

        $this->add_control('warning_message', [
            'label' => esc_html__('Warning Message', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('This field is required', 'romethemeform')
        ]);

        $this->end_controls_section();

        $this->start_controls_section('label_style', [
            'label' => esc_html__('Label', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_label' => 'yes'
            ]
        ]);

        $this->add_responsive_control('label_width', [
            'label' => esc_html__('Width', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'em', 'rem'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1000, 'step' => 1],
                '%' => ['min' => 0, 'max' => 100],
                'em' => ['min' => 0, 'max' => 50],
                'rem' => ['min' => 0, 'max' => 50],
            ],
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'width:{{SIZE}}{{UNIT}}'
            ],
            'condition' => [
                'label_position' => 'rform-label-left'
            ]
        ]);

        $this->add_control('label_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .rform-label-input',
            ]
        );

        $this->add_responsive_control('label_padding', [
            'label' => esc_html__('Padding', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('label_margin', [
            'label' => esc_html__('Margin', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default' => [
                'top' => '0',
                'right' => '0',
                'bottom' => '10',
                'left' => '0',
                'unit' => 'px',
                'isLinked' => 'false',
            ],
            'selectors' => [
                '{{WRAPPER}} .rform-label-input' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_control('required_color', [
            'label' => esc_html__('Required Indicator Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-label-input span' => 'color:{{VALUE}}'
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('input_style', [
            'label' => esc_html__('Input', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_responsive_control('input_padding', [
            'label' => esc_html__('Padding', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_responsive_control('input_margin', [
            'label' => esc_html__('Margin', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .rform-input-tel',
            ]
        );

        $this->add_responsive_control('input_border_radius', [
            'label' => esc_html__('Border Radius', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ],
        ]);

        $this->start_controls_tabs('input_tabs');

        $this->start_controls_tab('input_tab_normal', ['label' => esc_html__('Normal', 'romethemeform')]);
        $this->add_control('input_color_normal', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_normal',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-input-tel',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_normal',
                'selector' => '{{WRAPPER}} .rform-input-tel',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_normal',
                'selector' => '{{WRAPPER}} .rform-input-tel',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('input_tab_hover', ['label' => esc_html__('Hover', 'romethemeform')]);
        $this->add_control('input_color_hover', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel:hover' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-input-tel:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_hover',
                'selector' => '{{WRAPPER}} .rform-input-tel:hover',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_hover',
                'selector' => '{{WRAPPER}} .rform-input-tel:hover',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('input_tab_focus', ['label' => esc_html__('Focus', 'romethemeform')]);
        $this->add_control('input_color_focus', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel:focus' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_focus',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-input-tel:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_focus',
                'selector' => '{{WRAPPER}} .rform-input-tel:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_focus',
                'selector' => '{{WRAPPER}} .rform-input-tel:focus',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('input_tab_warning', ['label' => esc_html__('Invalid', 'romethemeform')]);
        $this->add_control('input_color_warning', [
            'label' => esc_html__('Input Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel[aria-invalid="true"]' => 'color:{{VALUE}}'
            ],
        ]);
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_warning',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .rform-input-tel[aria-invalid="true"]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow_warning',
                'selector' => '{{WRAPPER}} .rform-input-tel[aria-invalid="true"]',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_warning',
                'selector' => '{{WRAPPER}} .rform-input-tel[aria-invalid="true"]',
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('placeholder_style', [
            'label' => esc_html__('Placeholder'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE
        ]);

        $this->add_control('placeholder_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-input-tel::placeholder' => 'color:{{VALUE}}',
                '{{WRAPPER}} .rform-input-tel::-webkit-input-placeholder' => 'color:{{VALUE}}',
                '{{WRAPPER}} .rform-input-tel::-ms-input-placeholder' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'placeholder_typography',
                'selector' => '{{WRAPPER}} .rform-input-tel::placeholder',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('flag_style', [
            'label' => esc_html('Flag'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'flag_typography',
                'selector' => '{{WRAPPER}} .iti--separate-dial-code .iti__selected-flag',
            ]
        );

        $this->add_control('flag_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .iti--separate-dial-code .iti__selected-flag' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_flag',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .iti--separate-dial-code .iti__selected-flag',
            ]
        );

        $this->add_responsive_control(
            'margin_flag',
            [
                'label' => esc_html__('Margin', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .iti--separate-dial-code .iti__selected-flag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'border_radius_flag',
            [
                'label' => esc_html__('Border Radius', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .iti--separate-dial-code .iti__selected-flag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'country_options',
            [
                'label' => esc_html__('Country List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('country_list_tabs');

        $this->start_controls_tab('country_list_normal', ['label' => esc_html('Normal')]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_country_list',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .iti__country-list li:not(.iti__divider)',
            ]
        );

        $this->add_control('country_list_color', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .iti__country-list .iti__country-name' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('country_list_dialcode_color', [
            'label' => esc_html('Dial Code Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .iti__country-list .iti__dial-code' => 'color : {{VALUE}}'
            ]
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('country_list_hover', ['label' => esc_html('Hover')]);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_country_list_hover',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .iti__country-list li:not(.iti__divider):hover',
            ]
        );

        $this->add_control('country_list_color_hover', [
            'label' => esc_html('Text Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .iti__country-list li:hover .iti__country-name' => 'color : {{VALUE}}'
            ]
        ]);

        $this->add_control('country_list_dialcode_color_hover', [
            'label' => esc_html('Dial Code Color'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .iti__country-list li:hover .iti__dial-code' => 'color : {{VALUE}}'
            ]
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section('warning_tyle', [
            'label' => esc_html__('Warning', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control(
            'warning_text_align',
            [
                'label' => esc_html__('Alignment', 'romethemeform'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'romethemeform'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'romethemeform'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'romethemeform'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rform-error' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control('warning_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-error' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'warning_typography',
                'selector' => '{{WRAPPER}} .rform-error',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('help_text_style', [
            'label' => esc_html__('Help Text', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            'condition' => [
                'help_text!' => ''
            ]
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'help_text_typography',
                'selector' => '{{WRAPPER}} .rform-help-text',
            ]
        );

        $this->add_control('help_text_color', [
            'label' => esc_html__('Color', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .rform-help-text' => 'color:{{VALUE}}'
            ]
        ]);

        $this->add_responsive_control('help_text_padding', [
            'label' => esc_html__('Padding', 'romethemeform'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors' => [
                '{{WRAPPER}} .rform-help-text' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}'
            ]
        ]);


        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $label_text = $settings['label_text'];

?>
        <div class="rform-container">
            <div class="rform-control <?php echo esc_attr($settings['label_position']) ?>">
                <?php if ('yes' === $settings['show_label']) : ?>
                    <label class="rform-label-input" for="rform-input-tel-<?php echo $this->get_id_int(); ?>">
                        <?php echo esc_html__($label_text, 'romethemeform') ?>
                        <?php if ('yes' === $settings['required_input']) : ?><span> * </span><?php endif; ?>
                    </label>
                <?php endif; ?>
                <input data-default-countries="<?php echo esc_attr($settings['default_countries']) ?>" name="<?php echo esc_attr($settings['name_input']) ?>" placeholder="<?php echo esc_attr($settings['placeholder_input']) ?>" class="rform-input-tel" id="rform-input-tel-<?php echo esc_attr($this->get_id_int()); ?>" type="tel" onblur="validate_input( '<?php echo esc_js('rform-input-tel-') ?>' , '<?php echo esc_js('rform-input-err-') ?>' ,'<?php echo esc_js($this->get_id_int()); ?>')" aria-invalid=false <?php echo ('yes' === $settings['required_input']) ? esc_attr('required') : '' ?> oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
            </div>
            <span role="alert" class="rform-error" id="rform-input-err-<?php echo $this->get_id_int(); ?>"><?php echo esc_html__($settings['warning_message'], 'romethemeform') ?></span>
            <div class="rform-help-text">
                <span><?php echo esc_html__($settings['help_text'], 'romethemeform') ?></span>
            </div>
        </div>
<?php
    }
}
