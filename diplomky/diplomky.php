<?php
/*
Plugin Name: Diplomas
Version: 1.0
Description: Diploma Thesis Management System
Text Domain: projects
Author: František Zatloukal
Author URI: http://frantisek.zatloukalu.eu
Plugin URI: http://research.redhat.com
License: GNU GPL2
*/

function diplomas_plugin_init() {
  load_plugin_textdomain( 'diplomas', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}

add_action('plugins_loaded', 'projects_plugin_init');

// CPT and taxonomies
function diplomas_create_cpt_and_taxos() {

  // Taxonomies
  register_taxonomy('parrent_university', 'diplomas', array('label' => __('Parrent University of Diploma These')));
  register_taxonomy('home_city', 'diplomas', array('label' => __('Location of leading Red Hat office')));
  register_taxonomy('these_tags', 'diplomas', array('label' => __('These tags')));
  register_taxonomy('these_not_full', 'diplomas', array('label' => __('Accepting new applicants?'), 'meta_box_cb' => 'post_categories_meta_box', 'hierarchical' => true));

	$labels = array(
    'name'                => _x( 'Diploma Theses', 'Post Type General Name', 'va_domain' ),
    'singular_name'       => _x( 'Diploma These', 'Post Type Singular Name', 'va_domain' ),
    'menu_name'           => __( 'Diploma Theses', 'va_domain' ),
    'name_admin_bar'      => __( 'Diploma Theses', 'va_domain' ),
    'parent_item_colon'   => __( 'Parent Diploma These:', 'va_domain' ),
    'all_items'           => __( 'All Diploma Theses', 'va_domain' ),
    'add_new_item'        => __( 'Add Diploma These', 'va_domain' ),
    'add_new'             => __( 'Add New', 'va_domain' ),
    'new_item'            => __( 'New Diploma These', 'va_domain' ),
    'edit_item'           => __( 'Edit Diploma These', 'va_domain' ),
    'update_item'         => __( 'Update Diploma These', 'va_domain' ),
    'view_item'           => __( 'View Diploma These', 'va_domain' ),
    'search_items'        => __( 'Search Diploma Theses', 'va_domain' ),
    'not_found'           => __( 'Not found', 'va_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'va_domain' ),
	);
	$args = array(
		'label'               => __( 'diplomky', 'va_domain' ),
		'description'         => __( 'Post Type Description', 'va_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author'),
		'taxonomies'          => array( 'parrent_university', 'home_city', 'these_tags', 'these_not_full' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'diplomas', $args );
}
add_action( 'init', 'diplomas_create_cpt_and_taxos', 0 );
?>