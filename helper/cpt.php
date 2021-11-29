<?php

	class saas_custom_post_type {
		
		function __construct() {
			
			add_action('init', array(&$this,'saas_builder_post_type'));
			add_action('init', array(&$this,'create_builder_post_taxonomy'));
            add_action('init', array(&$this, 'create_mobile_listing_cpt'));
            add_action('init', array(&$this, 'mobile_listing_taxonomy'), 0);

        }
	  // Builder Post Type
		function saas_builder_post_type() {
        $labels = array(
            'name' => __('SaaS Builder', 'saas-doctor'),
            'singular_name' => __('SaaS Builder', 'saas-doctor'),
            'add_new' => __('Add SaaS builder', 'saas-doctor'),
            'add_new_item' => __('Add SaaS builder', 'saas-doctor'),
            'edit_item' => __('Edit SaaS builder', 'saas-doctor'),
            'new_item' => __('New SaaS builder', 'saas-doctor'),
            'all_items' => __('All SaaS builder', 'saas-doctor'),
            'view_item' => __('View SaaS builder', 'saas-doctor'),
            'search_items' => __('Search SaaS builder', 'saas-doctor'),
            'not_found' => __('No SaaS builder found', 'saas-doctor'),
            'not_found_in_trash' => __('No portfolio found in the trash', 'saas-doctor'),
            'parent_item_colon' => '',
            'menu_name' => __('SaaS Theme Builder', 'saas-doctor')
        );
        $args = array(
            'labels' => $labels,
            'public' => true,
            'menu_position' => 4,
            'menu_icon' => 'dashicons-admin-multisite',
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt','elementor'),
            'has_archive' => false,
        );
            register_post_type('saas_builders', $args);
        }

        function create_builder_post_taxonomy() {
            $labels = array(
                'name' => __('Category', 'saas-doctor'),
                'singular_name' => __('Category', 'saas-doctor'),
                'search_items' => __('Search categories', 'saas-doctor'),
                'all_items' => __('Categories', 'saas-doctor'),
                'parent_item' => __('Parent category', 'saas-doctor'),
                'parent_item_colon' => __('Parent category:', 'saas-doctor'),
                'edit_item' => __('Edit category', 'saas-doctor'),
                'update_item' => __('Update category', 'saas-doctor'),
                'add_new_item' => __('Add category', 'saas-doctor'),
                'new_item_name' => __('New category', 'saas-doctor'),
                'menu_name' => __('Category', 'saas-doctor'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'rewrite' => array('slug' => 'saas_builder_cat'),
            );
            register_taxonomy('saas_builder_cat', 'saas_builders', $args);
        }

        // Services Post type
        function create_mobile_listing_cpt() {
            $labels = array(
                'name' => __('Mobile Listing', 'saas-doctor'),
                'singular_name' => __('Listing', 'saas-doctor'),
                'add_new' => __('Add Listing', 'saas-doctor'),
                'add_new_item' => __('Add Listing', 'saas-doctor'),
                'edit_item' => __('Edit Listing', 'saas-doctor'),
                'new_item' => __('New Listing', 'saas-doctor'),
                'all_items' => __('All Listing', 'saas-doctor'),
                'view_item' => __('View Listing', 'saas-doctor'),
                'search_items' => __('Search Listing', 'saas-doctor'),
                'not_found' => __('No Listing found', 'saas-doctor'),
                'not_found_in_trash' => __('No portfolio found in the trash', 'saas-doctor'),
                'parent_item_colon' => '',
                'supports' => array('post-formats'),
                'menu_name' => __('Mobile Listing', 'saas-doctor')
            );
            $args = array(
                'labels' => $labels,
                'public' => true,
                'menu_position' => 5,
                'menu_icon' => 'dashicons-megaphone',
                'taxonomies' => array('listing_category'),
                'supports' => array('title', 'editor', 'thumbnail', 'excerpt','elementor', 'post-formats'),
                'has_archive' => true,
            );
            register_post_type('mobile_listing', $args);
        }

        function mobile_listing_taxonomy() {
            $labels = array(
                'name' => __('Category', 'saas-doctor'),
                'singular_name' => __('Category', 'saas-doctor'),
                'search_items' => __('Search categories', 'saas-doctor'),
                'all_items' => __('Categories', 'saas-doctor'),
                'parent_item' => __('Parent category', 'saas-doctor'),
                'parent_item_colon' => __('Parent category:', 'saas-doctor'),
                'edit_item' => __('Edit category', 'saas-doctor'),
                'update_item' => __('Update category', 'saas-doctor'),
                'add_new_item' => __('Add category', 'saas-doctor'),
                'new_item_name' => __('New category', 'saas-doctor'),
                'menu_name' => __('Category', 'saas-doctor'),
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => true,
                'show_ui' => true,
                'show_admin_column' => true,
                'rewrite' => array('slug' => 'listing_category'),
            );
            register_taxonomy('listing_category', 'mobile_listing', $args);
        }
					
	}  

    new saas_custom_post_type();

