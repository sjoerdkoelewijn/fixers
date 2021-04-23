<?php 

/* ----------  Knowledge Base ------------------- */

function cpt_knowledge() {

	$labels = array(
			'name'                  => __( 'Knowledge Base', 'Post Type General Name', 'SKDD' ),
			'singular_name'         => _x( 'Knowledge Base', 'Post Type Singular Name', 'SKDD' ),
			'menu_name'             => __( 'Knowledge Base', 'SKDD' ),
			'name_admin_bar'        => __( 'Knowledge Base Item', 'SKDD' ),
			'archives'              => __( 'Item Archives', 'SKDD' ),
			'attributes'            => __( 'Item Attributes', 'SKDD' ),
			'parent_item_colon'     => __( 'Parent Item:', 'SKDD' ),
			'all_items'             => __( 'Knowledge Base Items', 'SKDD' ),
			'add_new_item'          => __( 'Add New Info Item', 'SKDD' ),
			'add_new'               => __( 'Add New', 'SKDD' ),
			'new_item'              => __( 'New Item', 'SKDD' ),
			'edit_item'             => __( 'Edit Item', 'SKDD' ),
			'update_item'           => __( 'Update Item', 'SKDD' ),
			'view_item'             => __( 'View Item', 'SKDD' ),
			'view_items'            => __( 'View Items', 'SKDD' ),
			'search_items'          => __( 'Search Item', 'SKDD' ),
			'not_found'             => __( 'Not found', 'SKDD' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'SKDD' ),
			'featured_image'        => __( 'Featured Image', 'SKDD' ),
			'set_featured_image'    => __( 'Set featured image', 'SKDD' ),
			'remove_featured_image' => __( 'Remove featured image', 'SKDD' ),
			'use_featured_image'    => __( 'Use as featured image', 'SKDD' ),
			'insert_into_item'      => __( 'Insert into item', 'SKDD' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'SKDD' ),
			'items_list'            => __( 'Items list', 'SKDD' ),
			'items_list_navigation' => __( 'Items list navigation', 'SKDD' ),
			'filter_items_list'     => __( 'Filter items list', 'SKDD' ),
	);

	$rewrite = array(
			'slug'                  => __( 'knowledge-base', 'SKDD' ),
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
	);

	$args = array(
			'label'                 => __( 'Knowledge Base', 'SKDD' ),
			'description'           => __( 'Knowledge Base', 'SKDD' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 2,
			'menu_icon'             => 'dashicons-welcome-learn-more',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => __( 'knowledge-base', 'SKDD' ),
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			//'query_var'           	=> true,
	);
	register_post_type( 'knowledge', $args );

}
add_action( 'init', 'cpt_knowledge', 10 );


function cpt_knowledge_taxonomy() { 
 
	  $labels = array(
		'name' => _x( 'Knowledge Base categories', 'taxonomy general name', 'SKDD' ),
		'singular_name' => _x( 'Knowledge Base Category', 'taxonomy singular name', 'SKDD' ),
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
	  
	  register_taxonomy('tax_knowledge', array('knowledge'), array(
		'hierarchical' 		=> true,
		'public'        	=> true,
		'labels' 			=> $labels,
		'show_ui' 			=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'show_in_rest'      => true,
		'rewrite' 			=> array( 'slug' => __( 'knowledge-base', 'SKDD' ) ),
	  ));
	 
}
add_action( 'init', 'cpt_knowledge_taxonomy', 0 );