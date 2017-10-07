<?php  
/**
 * Plugin Name:   Custom post types Projects
 * Plugin URI:    http://roomwithview.org/custom
 * Description:   Adds a custom Portfolio system
 * Version:       1.0
 * Author:        Konstantinos Pap
 * Author URI:    http://roomwithview.org/
 *
 *
 */


/*******************************************************************************************
playjo_create_post_type - registers the post types
*******************************************************************************************/

function playjo_create_post_type() {
	$labels = array( 
		'name' => __( 'Projects', 'playjo' ),
		'singular_name' => __( 'Project', 'playjo' ),
		'add_new' => __( 'New Project', 'playjo' ),
		'add_new_item' => __( 'Add New Project', 'playjo' ),
		'edit_item' => __( 'Edit Project', 'playjo' ),
		'new_item' => __( 'New Project', 'playjo' ),
		'view_item' => __( 'View Project', 'playjo' ),
		'search_items' => __( 'Search Projects', 'playjo' ),
		'not_found' =>  __( 'No Projects Found', 'playjo' ),
		'not_found_in_trash' => __( 'No Projects found in Trash', 'playjo' ),
	);
	$args = array(
		'labels' => $labels,
		'has_archive' => true,
		'public' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'projects' ),
		'supports' => array(
			'title', 
			'editor', 
			'excerpt', 
			'custom-fields', 
			'thumbnail',
			'page-attributes'
		),
		'taxonomies' => array( 'post_tag', 'category'), 
	);
	register_post_type( 'project', $args );
} 
add_action( 'init', 'playjo_create_post_type' );

/*******************************************************************************************
playjo_register_taxonomy - registers the taxonomies
*******************************************************************************************/
function playjo_register_taxonomy() {

  $labels = array(
		'name'              => __( 'Services', 'playjo' ),
		'singular_name'     => __( 'Service', 'playjo' ),
		'search_items'      => __( 'Search Services', 'playjo' ),
		'all_items'         => __( 'All Services', 'playjo' ),
		'edit_item'         => __( 'Edit Services', 'playjo' ),
		'update_item'       => __( 'Update Services', 'playjo' ),
		'add_new_item'      => __( 'Add New Services', 'playjo' ),
		'new_item_name'     => __( 'New Service Name', 'playjo' ),
		'menu_name'         => __( 'Services', 'playjo' ),
	);
	
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
		'sort' => true,
		'args' => array( 'orderby' => 'term_order' ),
		'rewrite' => array( 'slug' => 'services' ),
		'show_admin_column' => true
	);
	
	register_taxonomy( 'service', array( 'post', 'project' ), $args);
	
}
add_action( 'init', 'playjo_register_taxonomy' );

/*******************************************************************************************
playjo_add_categories_to_pages - registers the category taxonmy to the page post type
*******************************************************************************************/
function playjo_add_categories_to_pages() {
	register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'playjo_add_categories_to_pages' );