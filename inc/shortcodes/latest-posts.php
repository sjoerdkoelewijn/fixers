<?php 

/*
 * Knowledge Base shortcut
 */

defined( 'ABSPATH' ) || exit;


// function that runs when shortcode is called
function SKDD_latestposts_shortcode( $atts ) { 

        $a = shortcode_atts( array(
           'posttype' => 'post',
           'amount' => '3'
        ), $atts );
    
    ob_start(); ?>                
                 
        <section class="shortcode latest_posts">                
    

            <?php 
            
                $args = array(
                'post_type'         => $a['posttype'],
                'posts_per_page'    => $a['amount'], 
                'post_status'       => 'publish',
                'ignore_sticky_posts'   => true 
                );

                $posts = new WP_Query( $args );

                if( $posts->have_posts() ) :
                    
                    while( $posts->have_posts() ) : $posts->the_post(); ?>

                        <div class="post">

                            <a class="image_link_wrap" title="<?php echo get_the_title(); ?>" href="<?php echo the_permalink(); ?>">

                                <?php if ( has_post_thumbnail() ) { ?>

                                    <?php $image = get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>
                                    <div class="post-cover-image">
                                        <img src="<?php echo $image ?>" />
                                    </div>

                                <?php } else {?>

                                    <div class="image default"></div>

                                <?php } ?>
                                
                            </a>    
                            
                            <div class="text">

                                <a class="image_link_wrap" title="<?php echo get_the_title(); ?>" href="<?php echo the_permalink(); ?>">

                                    <h3>
                                        <?php echo get_the_title(); ?>
                                    </h3>
                                    
                                </a> 
                                    

                                <?php

                                    $custom_excerpt = get_the_content();

                                    $custom_excerpt = substr( $custom_excerpt, strpos( $custom_excerpt, '<p>' ), (strpos( $custom_excerpt, '</p>' ) + 4) );

                                    $custom_excerpt = wp_trim_words( strip_tags( $custom_excerpt ), 15 );

                                    echo $custom_excerpt;  
                                
                                ?>

                                <div class="post-read-more">

                                    <a class="button" title="<?php echo get_the_title(); ?>" href="<?php echo the_permalink(); ?>">

                                    <?php _e( 'Read More', 'SKDD' ) ?>                

                                    </a>

                                </div>


                            </div> 

                            
                            
                        </div>    

                        
                    
                    <?php endwhile;

                endif;
                
                wp_reset_postdata(); 
                
            ?>

        </section>    
        

    <?php

    $output = ob_get_clean( );

    return $output;

}    

// register shortcode
add_shortcode('latest-posts', 'SKDD_latestposts_shortcode'); 