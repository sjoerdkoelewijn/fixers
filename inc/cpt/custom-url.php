<?php 

// Adds the current category in the URL.

add_filter('post_type_link', 'sk_update_permalink_structure', 10, 2);

function sk_update_permalink_structure( $post_link, $post )
{
    $options = SKDD_options( false );

    if ( false !== strpos( $post_link, '%tax_portfolio%' ) && $options['cpt_portfolio_has_tax'] ) {

		$taxonomy_terms = get_the_terms( $post->ID, 'tax_portfolio' );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                $post_link = str_replace( '%tax_portfolio%', $term->slug, $post_link );
            }
        } 
	}

	if ( false !== strpos( $post_link, '%services%' ) && $options['cpt_services_has_tax'] ) {

		$taxonomy_terms = get_the_terms( $post->ID, 'services' );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                // $post_link = str_replace( '%services%', $term->slug, $post_link );
            }
        } 
	}

	if ( false !== strpos( $post_link, '%tax_knowledge%' ) && $options['cpt_knowledge_has_tax'] ) {

		$taxonomy_terms = get_the_terms( $post->ID, 'tax_knowledge' );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                $post_link = str_replace( '%tax_knowledge%', $term->slug, $post_link );
            }
        } 
	}

    if ( false !== strpos( $post_link, '%team%' ) && $options['cpt_team_has_tax'] ) {

		$taxonomy_terms = get_the_terms( $post->ID, 'team' );
		
        foreach ((array) $taxonomy_terms as $term ) { 
            if ( ! $term->parent ) {
                // $post_link = str_replace( '%team%', $term->slug, $post_link );
            }
        } 
	}
	
    return $post_link;
}