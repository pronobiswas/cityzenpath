<?php

class RForm extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'rform';
    }
    public function get_title()
    {
        return 'RForm';
    }
    public function get_icon()
    {
        return 'rform-widget-icon rtmicon rtmicon-form';
    }
    public function get_categories()
    {
        return ['romethemeform_form_fields'];
    }
    public function show_in_panel()
    {
        return 'romethemeform_form' != get_post_type();
    }

    public function get_style_depends()
    {
        return ['rform-style'];
    }

    public function get_keywords()
    {
        return ['rometheme form'];
    }
    protected function register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Form', 'romethemeform'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT
        ]);
        $this->add_control('form-control', [
            'label' => esc_html('Select Form'),
            'type' => 'rform_control',
        ]);
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $form_id = $settings['form-control'];
        $shortcode = '[rform form_id=' . $form_id . ']';
        echo do_shortcode($shortcode);
    }
}
