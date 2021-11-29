<?php if ( ! defined( 'ABSPATH' )  ) { die; }

$prefix_page_opts = '_mobile_listing_meta';


CSF::createMetabox( $prefix_page_opts, array(
  'title'        => 'Listing Options',
  'post_type'    => ['mobile_listing'],
  'show_restore' => false,
  'theme'=> 'light',
  'context'=> 'normal',
) );

//
// Create a section
//
CSF::createSection( $prefix_page_opts, array(
  'title'  => 'Gallery Image',
  'icon'   => 'fas fa-rocket',
  'fields' => array(
      array(
          'id'    => 'mobile_listing_price',
          'type'  => 'text',
          'title' => 'Price',
      ),
      array(
          'id'    => 'mobile_listing_link',
          'type'  => 'link',
          'title' => 'Download Link',
      ),
      array(
          'id'    => 'mobile_listing_gallery',
          'type'  => 'gallery',
          'title' => 'Gallery',
      ),
  )
) );

