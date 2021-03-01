<?php
/**
 * Template used to display post content.
 *
 * @package roxtar
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * Functions hooked in to roxtar_loop_post action.
		 *
		 * @hooked roxtar_post_header_open    - 10
		 * @hooked roxtar_post_structure      - 20
		 * @hooked roxtar_post_header_close   - 30
		 * @hooked roxtar_post_content        - 40
		 */
		do_action( 'roxtar_loop_post' );
	?>

</article>
