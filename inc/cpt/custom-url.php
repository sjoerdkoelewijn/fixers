<?php 

// Adds the current category in the URL.

add_filter('post_type_link', 'sk_update_permalink_structure', 10, 2);

function sk_update_permalink_structure( $post_link, $post )
{
    if ( false !== strpos( $post_link, '%portfolio%' ) ) {

		$taxonomy_terms = get_the_terms( $post->ID, 'portfolio' );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                $post_link = str_replace( '%portfolio%', $term->slug, $post_link );
            }
        } 
	}

	if ( false !== strpos( $post_link, '%services%' ) ) {

		$taxonomy_terms = get_the_terms( $post->ID, 'services' );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                $post_link = str_replace( '%services%', $term->slug, $post_link );
            }
        } 
	}

	if ( false !== strpos( $post_link, '%knowledge%' ) ) {

		$taxonomy_terms = get_the_terms( $post->ID, 'knowledge-base' );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                $post_link = str_replace( '%knowledge%', $term->slug, $post_link );
            }
        } 
	}
	
    return $post_link;
}