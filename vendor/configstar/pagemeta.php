<?php if ( ! defined( 'ABSPATH' )  ) { die; }

$prefix_page_opts = '_trarchi';


CSF::createMetabox( $prefix_page_opts, array(
  'title'        => 'Page Options',
  'post_type'    => ['page'],
  'show_restore' => false,
  'theme'=> 'light',
) );

//
// Create a section
//
CSF::createSection( $prefix_page_opts, array(
  'title'  => 'General',
  'icon'   => 'fas fa-rocket',
  'fields' => array(

    array(
      'id'    => 'header_switch',
      'type'  => 'switcher',
      'title' => 'Enable custom header',
      'help'  => 'If you want to use custom header other than set in customiser',
    ),
    array(
      'id'          => 'meta_header',
      'type'        => 'select',
      'title'       => 'Select Page header',
      'chosen'      => true,
      'multiple'    => false,
      'dependency' => array('header_switch', '==', 'true' ),
      'options'     => saasdoctorelement_footer_select('saasdoctor_builders'),
    ),

    array(
      'id'    => 'footer_switch',
      'type'  => 'switcher',
      'title' => 'Enable custom footer',
      'help'  => 'If you want to use custom footer other than set in customiser',
    ),
    array(
      'id'          => 'meta_footer',
      'type'        => 'select',
      'title'       => 'Select Page footer',
      'chosen'      => true,
      'multiple'    => false,
      'dependency' => array( 'footer_switch', '==', 'true' ),
      'options'     => saasdoctorelement_footer_select('saasdoctor_builders'),
    ),

  )
) );

