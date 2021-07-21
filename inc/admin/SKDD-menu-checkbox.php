<?php
/**
 * SKDD Menu checkbox
 */

defined( 'ABSPATH' ) || exit;


if ( ! function_exists( 'SKDD_add_menu_checkboxes' ) ) {

    function SKDD_add_menu_checkboxes($item_id, $item) {

        $options = SKDD_options( false );

        $show_as_button = get_post_meta($item_id, '_show-as-button', true);
        $show_as_megamenu = get_post_meta($item_id, '_show-as-megamenu', true);
        
        ?>

        <input type="hidden" name="nav-menu-nonce" value="<?php echo esc_attr( wp_create_nonce( 'nav-menu-nonce-name' ) ); ?>" />

        <p class="SKDD-show-as-button description description-wide">
            <label for="SKDD-menu-item-button-<?php echo $item_id; ?>" >
                <input type="checkbox" 
                    id="SKDD-menu-item-button-<?php echo $item_id; ?>" 
                    name="SKDD-menu-item-button[<?php echo $item_id; ?>]" 
                    <?php checked($show_as_button, true); ?> 
                /><?php _e('Show as a button', 'SKDD'); ?>
            </label>
        </p>

        <?php if ( $options['header_mega_menu'] ) { ?>

            <p class="SKDD-show-as-megamenu description description-wide">
                <label for="SKDD-menu-item-megamenu-<?php echo $item_id; ?>" >
                    <input type="checkbox" 
                        id="SKDD-menu-item-megamenu-<?php echo $item_id; ?>" 
                        name="SKDD-menu-item-megamenu[<?php echo $item_id; ?>]" 
                        <?php checked($show_as_megamenu, true); ?> 
                    /><?php _e('Show sub as mega menu', 'SKDD'); ?>
                </label>
            </p>

        <?php }

    }

    add_action('wp_nav_menu_item_custom_fields', 'SKDD_add_menu_checkboxes', 10, 2);

}

if ( ! function_exists( 'SKDD_save_menu_item_checkbox' ) ) {

    function SKDD_save_menu_item_checkbox($menu_id, $menu_item_db_id) {

        if ( ! isset( $_POST['nav-menu-nonce'] ) || ! wp_verify_nonce( wp_unslash( $_POST['nav-menu-nonce'] ), 'nav-menu-nonce-name' ) ) {
            return;
        }

        $button_value = (isset($_POST['SKDD-menu-item-button'][$menu_item_db_id]) && $_POST['SKDD-menu-item-button'][$menu_item_db_id] == 'on') ? true : false;
        update_post_meta($menu_item_db_id, '_show-as-button', $button_value);

        $header_value = (isset($_POST['SKDD-menu-item-header'][$menu_item_db_id]) && $_POST['SKDD-menu-item-header'][$menu_item_db_id] == 'on') ? true : false;
        update_post_meta($menu_item_db_id, '_show-as-header', $header_value);
        
        $options = SKDD_options( false );

        if ( $options['header_mega_menu'] ) { 

            $megamenu_value = (isset($_POST['SKDD-menu-item-megamenu'][$menu_item_db_id]) && $_POST['SKDD-menu-item-megamenu'][$menu_item_db_id] == 'on') ? true : false;
            update_post_meta($menu_item_db_id, '_show-as-megamenu', $megamenu_value);

        }    
    }
    
    add_action('wp_update_nav_menu_item', 'SKDD_save_menu_item_checkbox', 10, 2);

}