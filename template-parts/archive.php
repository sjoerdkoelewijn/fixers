<?php
/**
 * Archive template
 *
 * @package SKDD
 */

?>

<div id="primary" class="content-area">
	

		<?php 
		global $post;
		$page_for_posts_id = get_option('page_for_posts');
		if ( $page_for_posts_id ) {
			$post = get_page($page_for_posts_id);
			setup_postdata($post);
			?>
			<div id="post-<?php the_ID(); ?>">
				
					<?php the_content(); ?>					
				
			</div>
			<?php
			rewind_posts();
		} else { ?>

			<div class="category_heading">
				<h1>
					<?php echo single_cat_title(); ?>
				</h1>
				<?php echo category_description(); ?>
			</div>

		<?php } ?>
			

		<main id="main" class="site-main">

		<?php
		
		if ( have_posts() ) :
			get_template_part( 'template-parts/loop' );
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>

		</main>
	</div>

<?php
do_action( 'SKDD_sidebar' );
