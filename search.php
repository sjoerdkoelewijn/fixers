<?php
/**
 * The template for displaying search results pages.
 *
 * @package SKDD
 */

get_header(); ?>

	<div id="primary" class="content-area">		

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title entry-title">
					<?php
						/* translators: %s: search term */
						printf( esc_html__( 'Search Results for: %s', 'SKDD' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->


			<?php get_search_form(); ?>

			<main id="main" class="site-main">

				<?php get_template_part( 'template-parts/loop' ); ?>

			</div>

		<?php else : ?>

			<main id="main" class="site-main">

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			</div>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
do_action( 'SKDD_sidebar' );
get_footer();
