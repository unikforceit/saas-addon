<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class saas_team extends Widget_Base {

    public function get_name() {
        return 'saas-leader';
    }

    public function get_title() {
        return __( 'Leader', 'saas-doctor' );
    }
    public function get_categories() {
        return [ 'saaselement-addons' ];
    }
    public function get_icon() {
        return 'eicon-person';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'saas-doctor' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'member_name',
            [
                'label' => __( 'Name', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Hasib Sharif', 'saas-doctor' ),
            ]
        );
        $repeater->add_control(
            'member_designation',
            [
                'label' => __( 'Designation', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Founder & CEO', 'saas-doctor' ),
            ]
        );
        $repeater->add_control(
            'member_info',
            [
                'label' => __( 'Info', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Lorem ipsum dolor sit amet, consec adipiscing elit, sed do eiusmod not incididunt ut labore.', 'saas-doctor' ),
            ]
        );
        $repeater->add_control(
            'team_url',
            [
                'label' => __( 'Link', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'member_photo', [
                'label' => __( 'Photo', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'fb_url',
            [
                'label' => __( 'Facebook', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'tw_url',
            [
                'label' => __( 'Twitter', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'ld_url',
            [
                'label' => __( 'Linkdin', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::URL,
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $this->add_control(
            'member_list',
            [
                'label' => __( 'List', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'member_name' => __( 'Hasib Sharif', 'saas-doctor' ),
                    ],
                    [
                        'member_name' => __( 'Hasib Sharif', 'saas-doctor' ),
                    ],
                    [
                        'member_name' => __( 'Hasib Sharif', 'saas-doctor' ),
                    ],
                    [
                        'member_name' => __( 'Hasib Sharif', 'saas-doctor' ),
                    ],
                    [
                        'member_name' => __( 'Hasib Sharif', 'saas-doctor' ),
                    ],
                    [
                        'member_name' => __( 'Hasib Sharif', 'saas-doctor' ),
                    ],
                ],
                'title_field' => '{{{ member_name }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'saas-doctor' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our-leader .content h4' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_fonts',
                'label' => __( 'Title Typography', 'saas-doctor' ),
                'selector' => '{{WRAPPER}} .our-leader .content h4',
            ]
        );
        $this->add_control(
            'des_color',
            [
                'label' => __( 'Designation Color', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our-leader .content .author-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'des_fonts',
                'label' => __( 'Designation Typography', 'saas-doctor' ),
                'selector' => '{{WRAPPER}} .our-leader .content .author-title',
            ]
        );
        $this->add_control(
            'desi_color',
            [
                'label' => __( 'Info Color', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our-leader .content .text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desi_fonts',
                'label' => __( 'Info Typography', 'saas-doctor' ),
                'selector' => '{{WRAPPER}} .our-leader .content .text',
            ]
        );
        $this->add_control(
            'desib_color',
            [
                'label' => __( 'Button Color', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our-leader .content .default-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desib_fonts',
                'label' => __( 'Button Typography', 'saas-doctor' ),
                'selector' => '{{WRAPPER}} .our-leader .content .default-link',
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __( 'Item Margin', 'saas-doctor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .our-leader .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    echo '<div class="our-leader">
                    <div class="row">';
        if ( $settings['member_list'] ) {
            foreach ($settings['member_list'] as $members) {
            echo'<article class="col-md-4 col-sm-6 col-xs-12">
                            <div class="item">
                                <div class="img-box">
                                     '.get_that_image( $members['member_photo'] ).'
                                    <ul class="caption">
                                        <li class="fb"><a '.get_that_link($members['fb_url']).'><i class="fab fa-facebook"></i></a></li>
                                        <li class="twit"><a '.get_that_link($members['tw_url']).'><i class="fab fa-twitter"></i></a></li>
                                        <li class="link"><a '.get_that_link($members['ld_url']).'><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                                <div class="content">
                                    <h4>'.$members['member_name'].'</h4>
                                    <p class="author-title">'.$members['member_designation'].'</p>
                                    <div class="text">
                                        <p>'.$members['member_info'].'</p>
                                    </div>
                                    <a '.get_that_link($members['team_url']).' class="default-link">'.esc_html('VIEW').'<i class="fas fa-caret-right"></i></a>
                                </div>
                            </div>
                        </article>';
                }
            }
            echo'</div>
                </div>';
    }

    protected function _content_template() {
    }



    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register_widget_type( new saas_team() );
?>