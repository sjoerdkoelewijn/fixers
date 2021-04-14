<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package SKDD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to SKDD_page add_action
	 *
	 * @hooked SKDD_page_header  - 10
	 * @hooked SKDD_page_content - 20
	 */
	do_action( 'SKDD_page' );
	?>
</article><!-- #post-## -->
