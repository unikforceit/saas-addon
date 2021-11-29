<?php
function saasdoctor_welcome_page(){
    require_once 'saas-welcome.php';
}
function ae_demo_importer_function(){
    admin_url( 'admin.php?page=ae-demo-importer' );
}
add_action( 'admin_menu', 'saasdoctor_admin_meu' );
function saasdoctor_admin_meu() {
    // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
    add_menu_page( 'SaaS', 'SaaS', 'administrator', 'saasdoctor-admin-menu', 'saasdoctor_welcome_page', 'dashicons-smiley', 2 );
    add_submenu_page('saasdoctor-admin-menu', 'Theme Options', 'Theme Options', 'manage_options', 'customize.php' );
    add_submenu_page( 'saasdoctor-admin-menu', esc_html__( 'Demo Importer', 'saas-doctor' ), esc_html__( 'Demo Importer', 'saas-doctor' ), 'administrator', 'ae-demo-importer',  'ae_demo_importer_function');
}