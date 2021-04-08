<?php

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'roxtar_custom_header' ) ) {

	class roxtar_custom_header {

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
			$options = roxtar_options( false );
			$header_layout   = $options['header_layout'];

		    switch ( $header_layout ) {
				default:
                case 'layout-1':                    

                    break;  				
                case 'layout-2':
                    remove_action( 'roxtar_site_header', 'roxtar_site_branding', 20 );
					remove_action( 'roxtar_site_header', 'roxtar_primary_navigation', 30 );

					add_action( 'roxtar_site_header', 'roxtar_site_branding', 30 );
					add_action( 'roxtar_site_header', 'roxtar_primary_navigation', 20 );

                    break;  
            }      
		}

    }

    roxtar_custom_header::get_instance();
}