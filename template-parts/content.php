<?php
/**
 * Template used to display post content.
 *
 * @package SKDD
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * Functions hooked in to SKDD_loop_post action.
		 *
		 * @hooked SKDD_post_header_open    - 10
		 * @hooked SKDD_post_structure      - 20
		 * @hooked SKDD_post_header_close   - 30
		 * @hooked SKDD_post_content        - 40
		 */
		do_action( 'SKDD_loop_post' );
	?>

</article>
