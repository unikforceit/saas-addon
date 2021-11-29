<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class saas_testimonial extends Widget_Base
{

    public function get_name()
    {
        return 'saas-leader';
    }

    public function get_title()
    {
        return __('Testimonial', 'saas-doctor');
    }

    public function get_categories()
    {
        return ['saaselement-addons'];
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'saas-doctor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'name',
            [
                'label' => __('Name', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Retash Malaka', 'saas-doctor'),
            ]
        );
        $repeater->add_control(
            'designation',
            [
                'label' => __('Designation', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('CEO, ABC Technology', 'saas-doctor'),
            ]
        );
        $repeater->add_control(
            'info',
            [
                'label' => __('Info', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Over the past decade, we’ve helped some of the world’s most influential startups and companies innovate and grow their businesses.', 'saas-doctor'),
            ]
        );
        $this->add_control(
            'testimonial_list',
            [
                'label' => __('Testimonial List', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => __('Retash Malaka', 'saas-doctor'),
                    ],
                    [
                        'name' => __('Retash Malaka', 'saas-doctor'),
                    ],
                    [
                        'name' => __('Retash Malaka', 'saas-doctor'),
                    ],
                    [
                        'name' => __('Retash Malaka', 'saas-doctor'),
                    ],
                    [
                        'name' => __('Retash Malaka', 'saas-doctor'),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'saas-doctor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-testimonial-section .saas-testimonial-item h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_fonts',
                'label' => __('Title Typography', 'saas-doctor'),
                'selector' => '{{WRAPPER}} .saas-testimonial-section .saas-testimonial-item h4',
            ]
        );
        $this->add_control(
            'des_color',
            [
                'label' => __('Designation Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-testimonial-section .saas-testimonial-item p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'des_fonts',
                'label' => __('Designation Typography', 'saas-doctor'),
                'selector' => '{{WRAPPER}} .saas-testimonial-section .saas-testimonial-item p',
            ]
        );
        $this->add_control(
            'desi_color',
            [
                'label' => __('Info Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-testimonial-section .saas-testimonial-item article' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desi_fonts',
                'label' => __('Info Typography', 'saas-doctor'),
                'selector' => '{{WRAPPER}} .saas-testimonial-section .saas-testimonial-item article',
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __('Wrapper', 'saas-doctor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .saas-testimonial-section .saas-testimonial-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo '<div class="saas-testimonial-section">
                        <div class="swiper-button-next"><i class="fas fa-arrow-right"></i></div>
                        <div class="swiper-container testimonial-slider-loop">
                    <div class="saas-testimonial-wrapper swiper-wrapper">';
        if ($settings['testimonial_list']) {
            foreach ($settings['testimonial_list'] as $testimonial) {
                echo '<div class="saas-testimonial-item swiper-slide">
                        <div class="saas-testi-inner">
                          <article>' . $testimonial['info'] . '</article>      
                          <h4>' . $testimonial['name'] . '</h4>      
                          <p>' . $testimonial['designation'] . '</p>      
                        </div>
                    </div>';
            }
        }
        echo '
                    </div>
                    </div>
                </div>';
    }

    protected function _content_template()
    {
    }


    protected function content_template()
    {
    }

    public function render_plain_content($instance = [])
    {
    }

}

Plugin::instance()->widgets_manager->register_widget_type(new saas_testimonial());
?>