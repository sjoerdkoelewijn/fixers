<?php

defined( 'ABSPATH' ) || exit;

// Add shortcodes to reusable block

if ( is_admin() ) {
	add_filter( 'manage_wp_block_posts_columns', 'skdd_reusable_screen_add_column' );
	add_action( 'manage_wp_block_posts_custom_column' , 'skdd_reusable_screen_fill_column', 1000, 2);
}

function skdd_reusable_screen_add_column( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => esc_html__( 'Block title', 'reusable-blocks-extended' ),
		'skdd-reusable-instances' => esc_html__( 'Used in', 'reusable-blocks-extended' ),
		'skdd-reusable-preview' => esc_html__( 'Usage', 'reusable-blocks-extended' ),
		'skdd-date-modified' => esc_html__( 'Last modified', 'reusable-blocks-extended' )
	);
	return $columns;
}

function skdd_reusable_screen_fill_column( $column, $ID ) {
	global $post;
	switch( $column ) {

		case 'skdd-reusable-instances' :

			global $wpdb;
			$tag = '<!-- wp:block {"ref":' . $ID . '}';
			$search = '%' . $wpdb->esc_like($tag) . '%';
			$instances = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_content LIKE '$search' and post_type NOT IN ('revision', 'attachment', 'nav_menu_item')" );
			$count_instances = count( $instances );
			echo '<p class="skdd_instance_label">';
			if ( $count_instances > 0 ) {
				echo '<strong>';
				echo sprintf( 
					_n( 'Used in %s post:', 'Used in %s posts:', $count_instances, 'reusable-blocks-extended' ),
					$count_instances
				);
				echo '</strong>';
			} else {
				esc_html_e( 'Not used yet.', 'reusable-blocks-extended' );
			}
			echo '</p>';
			if ( $instances ) {
				$count = 0;
				$more_items_class = '';
				foreach( $instances as $instance ){
					if ( $count === 5 ) {
						$more_items_class = 'more_items_class';
						?>
						<button type="button" class="button button-secondary button-small skdd_button_more" data-toggle="<?php esc_html_e( 'Fold up', 'reusable-blocks-extended' ) ?>">
							<?php
							$more_instances = $count_instances - $count;
							echo sprintf(
								esc_html__( 'Show %s more instance(s)', 'reusable-blocks-extended' ),
								$more_instances
							);
							?>
						</button>
						<?php
					} 
					echo '<p class="skdd_instance_paragraph ' . $more_items_class . '"><a href="' . get_edit_post_link( $instance->ID ) . '">' . $instance->post_title . ' [' . get_post_type( $instance->ID ) . ']</a></p>';
					$count++;
				}
			}
			break;

		case 'skdd-reusable-preview' :

			echo '<p>' . esc_html__( 'Shortcode:', 'reusable-blocks-extended' ) . ' <code>[skdd id=\'' . $ID . '\']</code></p>';
			echo '<p>' . esc_html__( 'PHP function:', 'reusable-blocks-extended' ) . ' <code>skdd_display_block(' . $ID . ')</code></p>';
		
			break;		

		case 'skdd-date-modified' :

			$d = get_date_from_gmt( $post->post_modified, 'Y-m-d H:i:s' );
			echo sprintf(
				/* translators: %1$s: Date the block was last modified %2$s Time the block was last modified %3$s Author */
				esc_html__( '%1$s at %2$s', 'reusable-blocks-extended' ),
				date_i18n( get_option('date_format'), strtotime( $d ) ),
				date_i18n( get_option('time_format'), strtotime( $d ) )
			);
			if ( get_post_meta( $ID, '_edit_last', true ) ) {
				$last_user = get_userdata( get_post_meta( $ID, '_edit_last', true ) );
				echo ' ' . esc_html__( 'by', 'reusable-blocks-extended' ) . ' ' . $last_user->display_name;
			}
			break;

		default :
			break;
	}
}



function skdd_shortcode( $atts ){
	extract(shortcode_atts(
		array(
			'id' => ''
	), $atts));
	$content = apply_filters( 'the_content', skdd_get_block( $id ) );
	return $content;
}
add_shortcode( 'skdd', 'skdd_shortcode' );