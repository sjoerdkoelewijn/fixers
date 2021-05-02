<?php 

// Adds the current category in the URL.

add_filter('post_type_link', 'sk_update_permalink_structure', 10, 2);

function sk_update_permalink_structure( $post_link, $post )
{
    if ( false !== strpos( $post_link, '%tax_portfolio%' ) ) {

		$taxonomy_terms = get_the_terms( $post->ID, __( 'tax_portfolio', 'SKDD' ) );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                $post_link = str_replace( '%tax_portfolio%', $term->slug, $post_link );
            }
        } 
	}

	if ( false !== strpos( $post_link, '%tax_knowledge%' ) ) {

		$taxonomy_terms = get_the_terms( $post->ID, __( 'tax_knowledge', 'SKDD' ) );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                $post_link = str_replace( '%tax_knowledge%', $term->slug, $post_link );
            }
        } 
	}
	
    return $post_link;
}