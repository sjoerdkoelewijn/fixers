<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package roxtar
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to roxtar_page add_action
	 *
	 * @hooked roxtar_page_header  - 10
	 * @hooked roxtar_page_content - 20
	 */
	do_action( 'roxtar_page' );
	?>
</article><!-- #post-## -->
