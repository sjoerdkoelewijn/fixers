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
        
        'edit.php?post_type=ghostkit_template', // Block Templates
        'edit.php?post_type=wp_block', // Re-usable Blocks
        'edit.php?post_type=page',         
        'edit.php?post_type=portfolio', 
        'edit.php?post_type=services', 
        'edit.php?post_type=knowledge', 
        'edit.php?post_type=support', 
        'edit.php?post_type=location', 
        'edit.php?post_type=team', 
        'edit.php', // Posts
        'edit-comments.php', // Comments
        'upload.php', // Media
                
        'separator2', // Second separator
        
        'nav-menus.php', // Menus
        'customize.php', // Customizer
        'options-general.php', // Settings
        
        'separator-last', // Last separator
    );
}
add_filter( 'custom_menu_order', 'SKDD_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'SKDD_custom_menu_order', 10, 1 );


function get_customizer_link() {
    $link = add_query_arg(
        array(
            'url'             => urlencode( site_url( '/?mailtpl_display=true' ) ),
            'return'          => urlencode( admin_url() ),
            'mailtpl_display' => 'true'
        ),
        'customize.php'
    );

    return $link;
}

function SKDD_move_admin_menu_items()
{
    // Remove existing parent menu.
    remove_menu_page( 'users.php' );
    remove_menu_page( 'tools.php' );
    remove_menu_page( 'themes.php' );
    remove_menu_page( 'plugins.php' );

    add_menu_page(
        __( 'Customizer', 'SKDD' ), //$page_title
        __( 'Customizer', 'SKDD' ), //$menu_title
        'manage_options',
        'customize.php',
        '',
        'dashicons-admin-appearance',
        2
    );

    add_menu_page(
        __( 'Menus', 'SKDD' ), //$page_title
        __( 'Menus', 'SKDD' ), //$menu_title
        'manage_options',
        'nav-menus.php',
        '',
        'dashicons-menu',
        2
    );

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

    if ( class_exists( 'Better_Search_Replace' ) ) {

        add_submenu_page(
            'options-general.php', //$parent_slug
            __( 'Search & Replace', 'SKDD' ), //$page_title
            __( 'Search & Replace', 'SKDD' ), //$menu_title
            'activate_plugins', //$capability
            'tools.php?page=better-search-replace' //$menu_slug
        );

    }

    if ( class_exists( 'Mailtpl_Mailer' ) ) {

        add_submenu_page(
            'options-general.php', //$parent_slug
            __( 'Email Template Options', 'SKDD' ), //$page_title
            __( 'Email Template', 'SKDD' ), //$menu_title
            'edit_theme_options', //$capability
            get_customizer_link()
            
        );

    }

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

