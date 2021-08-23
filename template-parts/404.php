<?php
/**
 * 404 template
 *
 * @package SKDD
 */

$options = SKDD_options( false );
?>

<div class="error-404-text has-skdd-heading-color text-center">
	<?php echo wp_kses_post( $options['error_404_text'] ); ?>
</div>
