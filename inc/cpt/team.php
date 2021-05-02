<?php 

/* ----------  Team ------------------- */

function cpt_team() {

	$options = SKDD_options( false );

	if ( $options['cpt_team_has_archive'] ) {
		$has_archive =	__( 'team', 'SKDD' );
	} else {
		$has_archive =	false;
	}

	if ( $options['cpt_team_has_tax'] ) {
		$slug = __( 'team', 'SKDD' ) . '/' . '%tax_team%';
	} else {
		$slug =	__( 'team', 'SKDD' );
	}

	$labels = array(
			'name'                  => __( 'Team', 'Post Type General Name', 'SKDD' ),
			'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'SKDD' ),
			'menu_name'             => __( 'Team', 'SKDD' ),
			'name_admin_bar'        => __( 'Team Members', 'SKDD' ),
			'archives'              => __( 'Member Archives', 'SKDD' ),
			'attributes'            => __( 'Member Attributes', 'SKDD' ),
			'parent_item_colon'     => __( 'Parent Member:', 'SKDD' ),
			'all_items'             => __( 'Team Members', 'SKDD' ),
			'add_new_item'          => __( 'Add New Member', 'SKDD' ),
			'add_new'               => __( 'Add New', 'SKDD' ),
			'new_item'              => __( 'New Member', 'SKDD' ),
			'edit_item'             => __( 'Edit Member', 'SKDD' ),
			'update_item'           => __( 'Update Member', 'SKDD' ),
			'view_item'             => __( 'View Member', 'SKDD' ),
			'view_items'            => __( 'View Members', 'SKDD' ),
			'search_items'          => __( 'Search Member', 'SKDD' ),
			'not_found'             => __( 'Not found', 'SKDD' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'SKDD' ),
			'featured_image'        => __( 'Featured Image', 'SKDD' ),
			'set_featured_image'    => __( 'Set featured image', 'SKDD' ),
			'remove_featured_image' => __( 'Remove featured image', 'SKDD' ),
			'use_featured_image'    => __( 'Use as featured image', 'SKDD' ),
			'insert_into_item'      => __( 'Insert into item', 'SKDD' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'SKDD' ),
			'items_list'            => __( 'Member list', 'SKDD' ),
			'items_list_navigation' => __( 'Members list navigation', 'SKDD' ),
			'filter_items_list'     => __( 'Filter items list', 'SKDD' ),
	);

	$rewrite = array(
			'slug'                  => $slug,
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
	);

	$args = array(
			'label'                 => __( 'Team', 'SKDD' ),
			'description'           => __( 'Team', 'SKDD' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 2,
			'menu_icon'             => 'dashicons-admin-users',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => $has_archive,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
			//'query_var'           	=> true,
	);
	register_post_type( 'team', $args );

}
add_action( 'init', 'cpt_team', 10 );

function cpt_team_taxonomy() { 
 
	$labels = array(
	  'name' => _x( 'Team categories', 'taxonomy general name', 'SKDD' ),
	  'singular_name' => _x( 'Team Category', 'taxonomy singular name', 'SKDD' ),
	  'search_items' =>  __( 'Search Categories', 'SKDD' ),
	  'all_items' => __( 'All Categories', 'SKDD' ),
	  'parent_item' => __( 'Parent Category', 'SKDD' ),
	  'parent_item_colon' => __( 'Parent Category:', 'SKDD' ),
	  'edit_item' => __( 'Edit Category', 'SKDD' ), 
	  'update_item' => __( 'Update Category', 'SKDD' ),
	  'add_new_item' => __( 'Add New Category', 'SKDD' ),
	  'new_item_name' => __( 'New Category Name', 'SKDD' ),
	  'menu_name' => __( 'Categories', 'SKDD' ),
	);    
	
	register_taxonomy('tax_team', array('team'), array(
	  'hierarchical' 		=> true,
	  'public'        		=> true,
	  'labels' 				=> $labels,
	  'show_ui' 			=> true,
	  'show_admin_column' 	=> true,
	  'query_var' 			=> true,
	  'show_in_rest'      	=> true,
	  'rewrite' 			=> array( 'slug' => __( 'team', 'SKDD' ) ),
	));
   
}

if ( $options['cpt_team_has_tax'] ) {
  add_action( 'init', 'cpt_team_taxonomy', 0 );
}