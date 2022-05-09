<?php
/**
 * The header for our theme.
 *
 * @package SKDD
 */

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head><?php wp_head(); ?></head>

	<body <?php body_class(); ?>>
		<?php
			wp_body_open();
			do_action( 'SKDD_GTM' );
			do_action( 'SKDD_theme_header' );
