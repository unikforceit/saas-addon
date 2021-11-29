<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class saas_hero extends Widget_Base
{

    public function get_name()
    {
        return 'saas-hero';
    }

    public function get_title()
    {
        return __('Hero', 'saas-doctor');
    }

    public function get_categories()
    {
        return ['saaselement-addons'];
    }

    public function get_icon()
    {
        return 'fas fa-star';
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
        $this->add_control(
            'heading',
            [
                'label' => __('Heading', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('We make it happens', 'saas-doctor'),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Websites', 'saas-doctor'),
            ]
        );
        $repeater->add_control(
            'video',
            [
                'label' => __('Choose Image', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'media_type' => 'video',
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'saas-doctor'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'title_list',
            [
                'label' => __('Title List', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => __('Websites', 'saas-doctor'),
                    ],
                    [
                        'title' => __('Apps', 'saas-doctor'),
                    ],
                    [
                        'title' => __('Branding', 'saas-doctor'),
                    ],
                ],
                'title_field' => '{{{ title }}}',
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
        $this->start_controls_tabs('title_style');
        $this->start_controls_tab(
            'title_normal',
            [
                'label' => __('Normal', 'appilo'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_fonts',
                'label' => __('Title Typography', 'saas-doctor'),
                'selector' => '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a',
            ]
        );
        $this->add_control(
            'text_sra',
            [
                'label' => __('Text Stroke', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            's_fill_colora',
            [
                'label' => __('Fill Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a' => '-webkit-text-fill-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            's_widtha',
            [
                'label' => __('Stroke Width', 'appilo'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => .5,
                        'max' => 100,
                        'step' => .5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            's_text_colora',
            [
                'label' => __('Stroke Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover',
            [
                'label' => __('Hover', 'appilo'),
            ]
        );
        $this->add_control(
            'title_colorh',
            [
                'label' => __('Title Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'text_sra',
            [
                'label' => __('Text Stroke', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            's_fill_colorah',
            [
                'label' => __('Fill Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a:hover' => '-webkit-text-fill-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            's_widthah',
            [
                'label' => __('Stroke Width', 'appilo'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => .5,
                        'max' => 100,
                        'step' => .5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a:hover' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            's_text_colorah',
            [
                'label' => __('Stroke Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list .hero-title a:hover' => '-webkit-text-stroke-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __('Wrapper', 'saas-doctor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .saas-hero-section .hero-title-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        echo '<div class="saas-hero-section">
                      <div class="saas-hero-wrapper">
                      ' . saas_render_wrapper_tag($settings['heading'], 'h3', 'hero-heading') . '
                      
                      <div class="hero-title-list">';
        if ($settings['title_list']) {
            foreach ($settings['title_list'] as $title) {

                echo '<div class="hero-content-inner">
                <video class="hero-video" id="' . $title['video']['id'] . '" src="' . $title['video']['url'] . '" autoplay="autoplay" loop="loop" controls="" muted="muted"></video>';
                echo '<div class="hero-title">
                    <a ' . get_that_link($title['link']) . '>' . $title['title'] . '</a>
                    </div></div>';
            }
        }
        echo '</div>
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

Plugin::instance()->widgets_manager->register_widget_type(new saas_hero());
?>