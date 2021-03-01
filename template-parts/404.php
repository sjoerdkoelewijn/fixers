<?php
/**
 * 404 template
 *
 * @package roxtar
 */

$options = roxtar_options( false );
?>

<div class="error-404-text has-roxtar-heading-color text-center">
	<?php echo wp_kses_post( $options['error_404_text'] ); ?>
</div>
