<?php
/**
 * Template used to display post content on single pages.
 *
 * @package roxtar
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked into roxtar_single_post add_action
	 *
	 * @hooked roxtar_post_single_structure   - 10
	 * @hooked roxtar_post_content            - 20
	 * @hooked roxtar_post_tags               - 30
	 */
	do_action( 'roxtar_single_post' );
	?>

</article><!-- #post-## -->
