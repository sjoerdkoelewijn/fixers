<?php
/**
 * Template used to display post content on single pages.
 *
 * @package SKDD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * Functions hooked into SKDD_single_post add_action
	 *
	 * @hooked SKDD_post_single_structure   - 10
	 * @hooked SKDD_post_content            - 20
	 * @hooked SKDD_post_tags               - 30
	 */
	do_action( 'SKDD_single_post' );
	?>

</article><!-- #post-## -->
