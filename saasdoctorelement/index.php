<?php

if (!defined('ABSPATH')) {
    exit;
}
if (class_exists('ELEMENTOR')) {
    return;
}
if (!class_exists('SaaSdoctor_Elementor_Addons')) :

    /**
     * Main SaaSdoctor_Elementor_Addons Class
     *
     */
    final class SaaSdoctor_Elementor_Addons
    {

        /** Singleton *************************************************************/

        private static $instance;

        /**
         * Main SaaSdoctor_Elementor_Addons Instance
         *
         * Insures that only one instance of SaaSdoctor_Elementor_Addons exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance()
        {

            if (!isset(self::$instance) && !(self::$instance instanceof SaaSdoctor_Elementor_Addons)) {

                self::$instance = new SaaSdoctor_Elementor_Addons;

                self::$instance->setup_constants();

                self::$instance->includes();

                self::$instance->hooks();

            }
            return self::$instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone()
        {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'saasdoctorelement'), SAAS_VERSION);
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup()
        {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'saasdoctorelement'), SAAS_VERSION);
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants()
        {

            // Plugin Folder Path
            if (!defined('SaaS_PLUGIN_DIR')) {
                define('SaaS_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            // Plugin Folder URL
            if (!defined('SaaS_PLUGIN_URL')) {
                define('SaaS_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            // Plugin Folder Path
            if (!defined('SaaS_ADDONS_DIR')) {
                define('SaaS_ADDONS_DIR', plugin_dir_path(__FILE__) . 'includes/widgets/');
            }

            // Plugin Folder Path
            if (!defined('SaaS_ADDONS_URL')) {
                define('SaaS_ADDONS_URL', plugin_dir_url(__FILE__) . 'includes/widgets/');
            }

        }

        /**
         * Include required files
         *
         */
        private function includes()
        {


            require_once SaaS_PLUGIN_DIR . 'includes/helper-functions.php';
            require_once SaaS_PLUGIN_DIR . 'includes/query-functions.php';
            require_once SaaS_PLUGIN_DIR . 'includes/template-lib.php';
            require_once BUILDER_PATH . '/themes/theme.php';
            require_once BUILDER_PATH . '/frontend.php';

        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks()
        {
            add_action('elementor/frontend/after_register_scripts', array($this, 'register_frontend_scripts'), 10);
            add_action('elementor/frontend/after_enqueue_styles', array($this, 'register_frontend_styles'), 10);
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'register_elementor_editor_css'), 10);
            add_action('elementor/init', array($this, 'add_elementor_category'));
            add_action('elementor/widgets/widgets_registered', array($this, 'include_widgets'));
            add_filter('elementor/icons_manager/additional_tabs', array($this, 'add_material_icons_tabs'));
            add_action('elementor/element/section/section_layout/after_section_end', array($this, 'register_section'), 10, 2);

        }

        public function register_section($element, $args)
        {

            $element->start_controls_section(
                'saasdoctor_parallax',
                array(
                    'label' => esc_html__('Parallax', 'saas-doctor'),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                )
            );

            $element->add_control(
                'saasdoctor_parallax_on',
                array(
                    'label' => esc_html__('Parallax', 'saas-doctor'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Yes', 'saas-doctor'),
                    'label_off' => esc_html__('No', 'saas-doctor'),
                    'return_value' => 'true',
                    'default' => 'false',
                    'prefix_class' => 'xld-parallax',
                )
            );

            $element->end_controls_section();

        }

        public function add_material_icons_tabs($tabs = array())
        {
            $tabs['saasdoctoricon'] = array(
                'name' => 'saasdoctoricon',
                'label' => esc_html__('SaaS Doctor', 'icon-element'),
                'labelIcon' => 'icon-chart',
                'prefix' => 'icon-',
                'displayPrefix' => 'saas',
                'url' => SaaS_PLUGIN_URL . 'assets/css/saasdoctor/saasdoctor.css',
                'fetchJson' => SaaS_PLUGIN_URL . 'assets/css/saasdoctor/fonts/saasdoctor.json',
                'ver' => '3.0.1',
            );
            return $tabs;
        }

        /**
         * Load Frontend Scripts
         *
         */
        public function register_frontend_scripts()
        {
            wp_enqueue_script('saasdoctor-owl-carousel', SaaS_PLUGIN_URL . 'assets/js/owl-carousel.min.js', array('jquery'), SAAS_VERSION, true);
            wp_enqueue_script('saasdoctor-main', SaaS_PLUGIN_URL . 'assets/js/x-saas.js', array('jquery'), SAAS_VERSION, true);
        }

        public function register_elementor_editor_css()
        {
            wp_enqueue_style('elementor-custom-editor', SaaS_PLUGIN_URL . 'assets/css/elementor/elementor-custom-editor.css');
        }

        public function register_frontend_styles()
        {
            wp_enqueue_style('saasdoctor-icon', SaaS_PLUGIN_URL . 'assets/css/saasdoctor/saasdoctor.css', array(), SAAS_VERSION, 'all');
            wp_enqueue_style('fa5', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0', 'all');
            wp_enqueue_style('fa5-v4-shims', 'https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css', array(), '5.13.0', 'all');
            wp_enqueue_style('saasdoctor-owl-carousel', SaaS_PLUGIN_URL . 'assets/css/owl-carousel.min.css', array(), SAAS_VERSION, 'all');
            wp_enqueue_style('saasdoctor-owl-default', SaaS_PLUGIN_URL . 'assets/css/owl-default.css', array(), SAAS_VERSION, 'all');
            wp_enqueue_style('saasdoctor-main', SaaS_PLUGIN_URL . 'assets/css/x-saas.css', array(), SAAS_VERSION, 'all');
        }

        public function add_elementor_category()
        {
            \Elementor\Plugin::instance()->elements_manager->add_category(
                'saaselement-addons',
                array(
                    'title' => __('Saas Doctor Cores', 'saasdoctorelement'),
                    'icon' => 'fa fa-plug',
                ),
                1);
        }

        public function include_widgets($widgets_manager)
        {
            $widgets[] = '';
            foreach (glob(PLUG_DIR . 'saasdoctorelement/includes/widgets/*') as $file) {

                $widgets[] = substr($file, strrpos($file, '/') + 1);
            }

            if (is_array($widgets)) {
                $widgets = array_filter($widgets);
                foreach ($widgets as $key => $value) {
                    if (!empty($value)) {
                        require_once SaaS_ADDONS_DIR . '' . $value . '/index.php';
                    }

                }

            }

        }

    }

endif; // End if class_exists check


/**
 * The main function responsible for returning the one true SaaSdoctor_Elementor_Addons
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $ae = SaaS(); ?>
 */
function SaaS()
{
    return SaaSdoctor_Elementor_Addons::instance();
}

// Get SaaS Running
SaaS();





