<?php 

/*
 * Knowledge Base shortcut
 */

defined( 'ABSPATH' ) || exit;


// function that runs when shortcode is called
function SKDD_knowledgebase_shortcode() { 

    ob_start();
    
        $cat_terms = get_terms(
            array('tax_knowledge'),
            array(
                    'hide_empty'    => true,
                    'orderby'       => 'name',
                    'order'         => 'ASC'
                )
        ); ?>

        <section class="knowledge_content">

        <?php if( $cat_terms ) :

            foreach( $cat_terms as $term ) : ?>                
                 
                <section class="kennisbank_category">

                <a class="category_header" href="/<?php _e( 'knowledge-base', 'SKDD' ); ?>/<?php echo $term->slug; ?>/">
                    <h2 class="category_header">
                        <?php echo $term->name; ?>
                    </h2>
                </a>  
               

                    <p class="category_description">
                        <?php echo $term->description; ?>
                    </p>             

                    <hr>

                    <?php 
                    
                        $args = array(
                        'post_type'         => 'knowledge',
                        'posts_per_page'    => 3, 
                        'post_status'       => 'publish',
                        'tax_query'         => array(
                                                array(
                                                    'taxonomy' => 'tax_knowledge',
                                                    'field'    => 'slug',
                                                    'terms'    => $term->slug,
                                                    ),
                                                ),
                        'ignore_sticky_posts'   => true 
                        );

                        $posts = new WP_Query( $args );

                        if( $posts->have_posts() ) :
                            
                            while( $posts->have_posts() ) : $posts->the_post(); ?>

                                <a class="post_link_wrap" title="<?php echo get_the_title(); ?>"  href="<?php echo the_permalink(); ?>">

                                    <?php if ( has_post_thumbnail() ) { ?>

                                        <?php $image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>
                                        <div class="image" style="background-image:url('<?php echo $image ?>');"></div>

                                    <?php } else {?>

                                        <div class="image default"></div>

                                    <?php } ?>   
                                    
                                    <div class="text">
                                        <h3>
                                            <?php echo get_the_title(); ?>
                                        </h3>

                                        <?php

                                            $custom_excerpt = get_the_content();

                                            $custom_excerpt = substr( $custom_excerpt, strpos( $custom_excerpt, '<p>' ), (strpos( $custom_excerpt, '</p>' ) + 4) );

                                            $custom_excerpt = wp_trim_words( strip_tags( $custom_excerpt ), 15 );

                                            echo $custom_excerpt;  
                                        
                                        ?>

                                    </div> 

                                </a>
                          
                            <?php endwhile;

                        endif;
                        
                        wp_reset_postdata(); 
                        
                    ?>

                </section>    

            <?php endforeach; 

        endif; ?>
        
    </div>

    <?php

    $output = ob_get_clean( );

    return $output;

}    

// register shortcode
add_shortcode('knowledge-base', 'SKDD_knowledgebase_shortcode'); 