<?php
/*
Plugin Name: Saas Doctor Core
Plugin URI: https://unikforce.com/
Description: Saas Doctor Core.
Author: UnikForce IT
Author URI: https://unikforce.com
Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'SAAS_VERSION', '1.0.0' );
define( 'PLUG_DIR', dirname(__FILE__).'/' );
define('PLUG_URL', plugin_dir_url(__FILE__));
define('BUILDER_PATH', plugin_dir_path(__FILE__). 'vendor/builder');
define('DEMO_FILES', plugin_dir_url(__FILE__). 'vendor/demo/data/xml/');
define('DEMO_SLIDER', plugin_dir_path(__FILE__). 'vendor/demo/data/xml/');

function cs_framework_init_check() {
    if( ! class_exists( 'SaaSdoctor_Elementor_Addons' ) ) {
        require_once PLUG_DIR .'/saasdoctorelement/index.php';
        require_once PLUG_DIR. '/helper/customiser-extra.php';
        require_once PLUG_DIR. '/helper/cpt.php';
    }
    if( ! function_exists( 'cs_framework_init' ) && ! class_exists( 'CSFramework' ) ) {
         
          require_once PLUG_DIR .'/vendor/codestar-framework/codestar-framework.php';
          require_once PLUG_DIR .'/vendor/configstar/customiser.php';
          require_once PLUG_DIR .'/vendor/configstar/pagemeta.php';
          require_once PLUG_DIR . '/vendor/configstar/listingmeta.php';
          require_once PLUG_DIR .'/vendor/admin-pages/admin.php';
          require_once PLUG_DIR . '/vendor/demo/includes/demo-importer.php';

    }

}

add_action( 'plugins_loaded', 'cs_framework_init_check' );

function saasdoctorelement_footer_select($type='') {

        $type = $type ? $type :'elementor_library';
        global $post;
        $args = array('numberposts' => -1,'post_type' => $type,);
        $posts = get_posts($args);  
        $categories = array(
        ''  => __( 'Select', 'saas-doctor' ),
        );
        foreach ($posts as $pn_cat) {
            $categories[$pn_cat->ID] = get_the_title($pn_cat->ID);
        }
        return $categories;   
}


if (class_exists('ELEMENTOR')){
    add_action( 'template_redirect', function() {
        $instance = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' );
        remove_action( 'template_redirect', [ $instance, 'block_template_frontend' ] );
    }, 9 );
}

?>