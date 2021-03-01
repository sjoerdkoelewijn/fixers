<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package roxtar
 */

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content', get_post_format() );
endwhile;

/**
 * Functions hooked in to roxtar_paging_nav action
 *
 * @hooked roxtar_paging_nav - 10
 */
do_action( 'roxtar_loop_after' );
