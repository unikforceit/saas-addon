<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class saas_listing extends Widget_Base
{

    public function get_name()
    {
        return 'saas-listing';
    }

    public function get_title()
    {
        return __('Listing', 'saas-doctor');
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
        $this->add_control(
            'query_type',
            [
                'label' => __('Query type', 'saas-doctor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'category',
                'options' => [
                    'category' => __('Category', 'saas-doctor'),
                    'individual' => __('Individual', 'saas-doctor'),
                ],
            ]
        );

        $this->add_control(
            'cat_query',
            [
                'label' => __('Category', 'saas-doctor'),
                'type' => Controls_Manager::SELECT2,
                'options' => ae_drop_cat('listing_category'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'query_type' => 'category',
                ],
            ]
        );

        $this->add_control(
            'id_query',
            [
                'label' => __('Posts', 'saas-doctor'),
                'type' => Controls_Manager::SELECT2,
                'options' => ae_drop_posts('mobile_listing'),
                'multiple' => true,
                'label_block' => true,
                'condition' => [
                    'query_type' => 'individual',
                ],
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'saas-doctor'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );
        $this->add_control(
            'currency',
            [
                'label' => __( 'Currency', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'usd',
                'options' => [
                    'usd'  => __( 'USD', 'saas-doctor' ),
                    'euro' => __( 'EURO', 'saas-doctor' ),
                ],
            ]
        );
        $this->add_control(
            'p_title',
            [
                'label' => __('Price Title', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Price', 'saas-doctor'),
            ]
        );
        $this->add_control(
            'btn',
            [
                'label' => __('Button', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Check Details', 'saas-doctor'),
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
            'layout',
            [
                'label' => __( 'Layout', 'saas-doctor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'layout1' => [
                        'title' => __( 'Layout 1', 'saas-doctor' ),
                        'icon' => 'eicon-form-horizontal',
                    ],
                    'layout2' => [
                        'title' => __( 'Layout 2', 'saas-doctor' ),
                        'icon' => 'eicon-post-slider',
                    ],
                    'layout3' => [
                        'title' => __( 'Layout 3', 'saas-doctor' ),
                        'icon' => 'eicon-post-slider',
                    ],
                ],
                'default' => 'layout1',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-listing-section .listing-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_fonts',
                'label' => __('Title Typography', 'saas-doctor'),
                'selector' => '{{WRAPPER}} .saas-listing-section .listing-content h3',
            ]
        );
        $this->add_control(
            'ex_color',
            [
                'label' => __('Excerpt Color', 'saas-doctor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .saas-listing-section .listing-content p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ex_fonts',
                'label' => __('Excerpt Typography', 'saas-doctor'),
                'selector' => '{{WRAPPER}} .saas-listing-section .listing-content p',
            ]
        );
        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label' => __('Wrapper', 'saas-doctor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .saas-listing-section .listing-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $per_page = $settings['posts_per_page'];
        $cat = $settings['cat_query'];
        $id = $settings['id_query'];
        $layout = $settings['layout'];

        if ($layout == 'layout1'){
            $class = 'col-md-6';
        }elseif ($layout == 'layout2'){
            $class = 'col-md-12';
        }else {
            $class = 'related-listing';
        }

        if($settings['query_type'] == 'category'){
            $query_args = array(
                'post_type' => 'mobile_listing',
                'posts_per_page' => $per_page,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'listing_category',
                        'field' => 'term_id',
                        'terms' => $cat,
                    ) ,
                ) ,
            );
        }

        if($settings['query_type'] == 'individual'){
            $query_args = array(
                'post_type' => 'mobile_listing',
                'posts_per_page' => $per_page,
                'post__in' =>$id,
                'orderby' => 'post__in'
            );
        }

        $wp_query = new \WP_Query($query_args);

if ($layout == 'layout1' || $layout == 'layout2') {
    echo '<section class="saas-listing-section">
    <div class="row justify-content-center">';
    if ($wp_query->have_posts()) {
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            ?>
            <article id="listing-<?php the_ID(); ?>" <?php post_class("$class listing-wrapper-loop"); ?>>
                <div class="listing-item">
                    <div class="listing-img">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                    </div>
                    <div class="listing-content">
                        <div class="listing-title-excerpt">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                        <div class="listing-price-btn">
                            <div class="listing-price">
                                <p><?php esc_html_e($settings['p_title'], 'saas-doctor'); ?></p>
                                <ins>
                                    <span><?php esc_html_e($settings['currency'], 'saas-doctor'); ?></span><?php esc_html_e(get_listing_meta('mobile_listing_price'), 'saas-doctor'); ?>
                                </ins>
                            </div>
                            <div class="listing-btn">
                                <a href="<?php the_permalink(); ?>"><?php esc_html_e($settings['btn'], 'saas-doctor'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php }
        wp_reset_postdata();
    }
    echo '</div>
</section>';

} else {
    echo '<section class="saas-listing-section ' . $class . '">
        <div class="swiper-button-next"><i class="fas fa-arrow-right"></i></div>
    <div class="swiper-container related-listing-slider-loop">
    <div class="realted-listing-wrapper swiper-wrapper">';
    if ($wp_query->have_posts()) {
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            ?>
            <article id="listing-<?php the_ID(); ?>" <?php post_class("$class listing-wrapper-loop swiper-slide"); ?>>
                <div class="listing-item">
                    <div class="listing-img">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
                    </div>
                    <div class="listing-content">
                        <div class="listing-title-excerpt">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                        <div class="listing-price-btn">
                            <div class="listing-price">
                                <p><?php esc_html_e($settings['p_title'], 'saas-doctor'); ?></p>
                                <ins>
                                    <span><?php esc_html_e($settings['currency'], 'saas-doctor'); ?></span><?php esc_html_e(get_listing_meta('mobile_listing_price'), 'saas-doctor'); ?>
                                </ins>
                            </div>
                            <div class="listing-btn">
                                <a href="<?php the_permalink(); ?>"><?php esc_html_e($settings['btn'], 'saas-doctor'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        <?php }
        wp_reset_postdata();
    }
    echo '</div>
</div>
</section>';
}
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

Plugin::instance()->widgets_manager->register_widget_type(new saas_listing());
?>