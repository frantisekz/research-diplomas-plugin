<?php
/*
Plugin Name: Diplomas
Version: 1.0
Description: Diploma Thesis Management System
Text Domain: diplomas
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
function topics_create_cpt_and_taxos() {

	// Taxonomies
  	register_taxonomy('parrent_university', 'diplomas', array('label' => __('Parrent University of Diploma Thesis')));
	register_taxonomy('home_city', 'diplomas', array('label' => __('Location of leading Red Hat office')));
	register_taxonomy('these_tags', 'diplomas', array('label' => __('Thesis tags')));
	register_taxonomy('these_category', 'diplomas', array('label' => __('Thesis category')));
	register_taxonomy('these_type', 'diplomas', array('label' => __('Thesis type')));
	register_taxonomy('topic_allowed_applicants', 'diplomas', array('label' => __('Amount of possible applicants')));

	$labels = array(
    'name'                => _x( 'Diploma Topics', 'Post Type General Name', 'va_domain' ),
    'singular_name'       => _x( 'Diploma Topic', 'Post Type Singular Name', 'va_domain' ),
    'menu_name'           => __( 'Diploma Topics', 'va_domain' ),
    'name_admin_bar'      => __( 'Diploma Topics', 'va_domain' ),
    'parent_item_colon'   => __( 'Parent Diploma Topic:', 'va_domain' ),
    'all_items'           => __( 'All Diploma Topics', 'va_domain' ),
    'add_new_item'        => __( 'Add Diploma Topic', 'va_domain' ),
    'add_new'             => __( 'Add New', 'va_domain' ),
    'new_item'            => __( 'New Diploma Topic', 'va_domain' ),
    'edit_item'           => __( 'Edit Diploma Topic', 'va_domain' ),
    'update_item'         => __( 'Update Diploma Topic', 'va_domain' ),
    'view_item'           => __( 'View Diploma Topic', 'va_domain' ),
    'search_items'        => __( 'Search Diploma Topics', 'va_domain' ),
    'not_found'           => __( 'Not found', 'va_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'va_domain' ),
	);
	$args = array(
		'label'               => __( 'diplomky', 'va_domain' ),
		'description'         => __( 'Post Type Description', 'va_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author'),
		'taxonomies'          => array( 'parrent_university', 'home_city', 'these_tags', 'these_category', 'these_type', 'topic_allowed_applicants'),
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

function theses_create_cpt_and_taxos() {

	// Taxonomies
  	register_taxonomy('parrent_university_student', 'theses', array('label' => __('Parent University of Student')));
	register_taxonomy('student_grade', 'theses', array('label' => __('Grade (A,B,...)')));
	register_taxonomy('these_type_student', 'theses', array('label' => __('Thesis type (Bachelor/Diploma)')));
	register_taxonomy('technical_supervisor', 'theses', array('label' => __('Technical Leader')));
	register_taxonomy('university_supervisor', 'theses', array('label' => __('Academic Leader')));
	register_taxonomy('defence_date', 'theses', array('label' => __('Thesis Defence Date')));
	// Connection with Topic is handled by plugin - CPT-ONOMIES

	$labels = array(
    'name'                => _x( 'Diploma Theses', 'Post Type General Name', 'va_domain' ),
    'singular_name'       => _x( 'Diploma Thesis', 'Post Type Singular Name', 'va_domain' ),
    'menu_name'           => __( 'Diploma Theses', 'va_domain' ),
    'name_admin_bar'      => __( 'Diploma Theses', 'va_domain' ),
    'parent_item_colon'   => __( 'Parent Diploma Thesis:', 'va_domain' ),
    'all_items'           => __( 'All Theses', 'va_domain' ),
    'add_new_item'        => __( 'Add Thesis', 'va_domain' ),
    'add_new'             => __( 'Add New', 'va_domain' ),
    'new_item'            => __( 'New Diploma Thesis', 'va_domain' ),
    'edit_item'           => __( 'Edit Diploma Thesis', 'va_domain' ),
    'update_item'         => __( 'Update Diploma Thesis', 'va_domain' ),
    'view_item'           => __( 'View Diploma Thesis', 'va_domain' ),
    'search_items'        => __( 'Search Diploma Theses', 'va_domain' ),
    'not_found'           => __( 'Not found', 'va_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'va_domain' ),
	);
	$args = array(
		'label'               => __( 'diplomky', 'va_domain' ),
		'description'         => __( 'Post Type Description', 'va_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'subscriber'),
		'taxonomies'          => array( 'parrent_university_student', 'student_grade', 'these_type_student', 'technical_supervisor', 'defence_date'),
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
		'map_meta_cap' => true,
		'capability_type'     => 'post',
        'capabilities' => array(
			'create_posts' => 'do_not_allow'
		));
	register_post_type( 'theses', $args );
}

add_action( 'init', 'topics_create_cpt_and_taxos', 0 );
add_action( 'init', 'theses_create_cpt_and_taxos', 0 );
?>
