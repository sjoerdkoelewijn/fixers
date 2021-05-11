<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'SKDD_custom_header' ) ) {

	class SKDD_custom_header {

		private static $instance;

		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

        public function __construct() {
			add_action( 'wp', array( $this, 'wp_action' ) );
		}

        public function wp_action() {
			$options = SKDD_options( false );
			$header_layout   = $options['header_layout'];

		    switch ( $header_layout ) {
				default:
                case 'layout-1':                    

                    break;  
									
                case 'layout-2':
                    remove_action( 'SKDD_site_header', 'SKDD_site_branding', 20 );
					remove_action( 'SKDD_site_header', 'SKDD_primary_navigation', 30 );

					add_action( 'SKDD_site_header', 'SKDD_site_branding', 30 );
					add_action( 'SKDD_site_header', 'SKDD_primary_navigation', 20 );

                    break;  

				case 'layout-3':
					
					remove_action( 'SKDD_site_header', 'SKDD_menu_toggle_btn', 10 );
					add_action( 'SKDD_site_header', 'SKDD_mobile_menu_widget', 50 );
					add_action( 'SKDD_site_header', 'SKDD_menu_toggle_btn', 60 );

					break; 

				case 'layout-4':
					remove_action( 'SKDD_site_header', 'SKDD_menu_toggle_btn', 10 );
					add_action( 'SKDD_site_header', 'SKDD_menu_toggle_btn', 60 );					

					break;  		
            }      
		}

    }

    SKDD_custom_header::get_instance();
}