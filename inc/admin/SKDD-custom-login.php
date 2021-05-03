<?php

$options = SKDD_options( false );

function SKDD_login_logo() { 
    $options = SKDD_options( false );

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $normal_logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );	
    

?>

    <style type="text/css">
        #login h1 a, .login h1 a {
        background: url(<?php echo $normal_logo[0]; ?>) center center;
		max-height:65px;
		width:320px;
		background-size: 320px 65px;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }

        body.login {
            background-color:<?php echo esc_attr( $options['background_color'] ) ?>; 
        }

        .login #backtoblog a, .login #nav a {
            color:<?php echo esc_attr( $options['offset_color'] ) ?> !important;
        }

        .login form {
            background:<?php echo esc_attr( $options['second_background_color'] ) ?> !important;
            color:<?php echo esc_attr( $options['text_color'] ) ?> !important; 
            border-radius: <?php echo esc_attr( $options['border_radius'] ) . 'px' ?> !important;
            border:0px !important;
        }

        .login form .input, .login form input[type=checkbox], .login input[type=text] {
            background: <?php echo esc_attr( $options['background_color'] ) ?> !important;
            border:0px !important;
            color:<?php echo esc_attr( $options['offset_color'] ) ?>;
        }

        .dashicons-visibility, .dashicons-hidden {
            color:<?php echo esc_attr( $options['theme_color'] ) ?> !important;
        }

        .wp-core-ui .button-primary {
            background:<?php echo esc_attr( $options['theme_color'] ) ?> !important;
            border:0px !important;
            color:<?php echo esc_attr( $options['background_color'] ) ?> !important;
            border-radius: <?php echo esc_attr( $options['buttons_border_radius'] ) . 'px' ?> !important;
        }

        input[type=password]:focus, input[type=radio]:focus, input[type=text]:focus, input[type=checkbox]:focus {
            box-shadow: 0 0 0 1px <?php echo esc_attr( $options['theme_color'] ) ?> !important;
        } 

        input[type=checkbox]:checked::before {
            fill:<?php echo esc_attr( $options['theme_color'] ) ?> !important;
        }
        
    </style>

<?php }

if ( $options['logo_mobile'] ) {
    add_action( 'login_enqueue_scripts', 'SKDD_login_logo' );
}