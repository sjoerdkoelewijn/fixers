<?php 

/*
 * Knowledge Base shortcut
 */

defined( 'ABSPATH' ) || exit;

// function that runs when shortcode is called
function SKDD_readspeaker_shortcode( $atts ) { 
    $options = SKDD_options( false );
    $readspeaker = $options['readspeaker_enabled'];

    if ( ! $readspeaker ) {
        return;
    } else {

        global $wp;

        $page_url = urlencode(trailingslashit(home_url( $wp->request )));
 
        
        $readspeaker_id = $options['readspeaker_id'];
    
        $a = shortcode_atts( array(
            'language' => 'NL',
            'button_id' => 'readspeaker_button1',       
            'container_id' => 'primary'
         ), $atts );
    
    
        ob_start(); ?>                
                     
        <div id="<?php echo $a['button_id'] ?>" class="rs_skip rsbtn rs_preserve">
    
            <a class="rsbtn_play" accesskey="L" rel="nofollow" title="<?php _e( 'Luister naar deze pagina', 'SKDD' ) ?>" href="//app-eu.readspeaker.com/cgi-bin/rsent?customerid=13159&amp;lang=NL&amp;readid=<?php echo $a['container_id'] ?>&amp;url=<?php echo $page_url ?>">
    
                <span class="rsbtn_left rsimg rspart">
                    <span class="rsbtn_text">
                        <span><?php _e( 'Luister', 'SKDD' ) ?></span>
                    </span>
                </span>
                <span class="rsbtn_right rsimg rsplay rspart"></span>
            </a>
    
        </div>
            
    
        <?php
    
        $output = ob_get_clean( );
    
        return $output;

    }

}    

// register shortcode
add_shortcode('readspeaker', 'SKDD_readspeaker_shortcode'); 