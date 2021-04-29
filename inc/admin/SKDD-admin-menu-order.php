<?php

function SKDD_custom_menu_order( $menu_order ) {
    if ( !$menu_order ) return true;

    return array(
        'index.php', // Dashboard
        'woocommerce', 
        'edit.php?post_type=product',
        'wc-admin&path=/analytics/overview', 
        'woocommerce-marketing',

        'separator1', // First separator 
        'edit.php?post_type=page',         
        'edit.php?post_type=portfolio', 
        'edit.php?post_type=services', 
        'edit.php?post_type=knowledge', 
        'edit.php?post_type=team', 
        'edit.php', // Posts
        'edit-comments.php', // Comments
        'separator2', // Second separator 
        
        'edit.php?post_type=ghostkit_template', // Block Templates
        'edit.php?post_type=wp_block', // Re-usable Blocks
        'upload.php', // Media
        'separator-last', // Last separator
        'options-general.php', // Settings
    );
}
add_filter( 'custom_menu_order', 'SKDD_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'SKDD_custom_menu_order', 10, 1 );


function SKDD_move_admin_menu_items()
{
    // Remove existing parent menu.
    remove_menu_page( 'users.php' );
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'themes.php' );
    remove_menu_page( 'plugins.php' );

    add_submenu_page(
        'options-general.php', //$parent_slug
        __( 'Users', 'SKDD' ), //$page_title
        __( 'Users', 'SKDD' ), //$menu_title
        'edit_posts', //$capability
        'users.php' //$menu_slug
    );

    add_submenu_page(
        'options-general.php', //$parent_slug
        __( 'Tools', 'SKDD' ), //$page_title
        __( 'Tools', 'SKDD' ), //$menu_title
        'edit_posts', //$capability
        'tools.php' //$menu_slug
    );

    add_submenu_page(
        'options-general.php', //$parent_slug
        __( 'Themes', 'SKDD' ), //$page_title
        __( 'Themes', 'SKDD' ), //$menu_title
        'edit_posts', //$capability
        'themes.php' //$menu_slug
    );

    add_menu_page(
        'options-general.php', //$parent_slug
        __( 'Customizer', 'SKDD' ), //$page_title
        __( 'Customizer', 'SKDD' ), //$menu_title
        'edit_posts', //$capability
        'customize.php' //$menu_slug
    );

    add_menu_page(
        __( 'Customizer', 'SKDD' ), //$page_title
        __( 'Customizer', 'SKDD' ), //$menu_title
        'manage_options',
        'customize.php',
        '',
        'dashicons-admin-appearance',
        20
    );

    add_submenu_page(
        'options-general.php', //$parent_slug
        __( 'Menus', 'SKDD' ), //$page_title
        __( 'Menus', 'SKDD' ), //$menu_title
        'edit_posts', //$capability
        'nav-menus.php' //$menu_slug
    );

    add_submenu_page(
        'options-general.php', //$parent_slug
        __( 'Widgets', 'SKDD' ), //$page_title
        __( 'Widgets', 'SKDD' ), //$menu_title
        'edit_posts', //$capability
        'widgets.php' //$menu_slug
    );
    
    add_submenu_page(
        'options-general.php', //$parent_slug
        __( 'Plugins', 'SKDD' ), //$page_title
        __( 'Plugins', 'SKDD' ), //$menu_title
        'edit_posts', //$capability
        'plugins.php' //$menu_slug
    );


}

add_action( 'admin_menu', 'SKDD_move_admin_menu_items' );

