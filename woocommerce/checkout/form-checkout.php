<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<h1 class="title">

	<?php esc_html_e( 'Kies uit de onderstaande mogelijkheden', 'woocommerce' ); ?>

</h1>

<div class="afspraken_wrap">	

	<div class="column options">

		<div class="checkout_option close">


			<?php dynamic_sidebar( 'checkout_afspraak' ); ?>

		</div>

		<div class="checkout_option close">

		

			<?php dynamic_sidebar( 'checkout_ophalen' ); ?>

	

		</div>

		<div class="checkout_option close">

			<?php dynamic_sidebar( 'checkout_versturen' ); ?>			

		</div>

		<div class="checkout_option close">	

			<?php dynamic_sidebar( 'checkout_winkel' ); ?>

		</div>

		

	</div>

	<div class="column">

		<div class="kostenoverzicht">

			<h2 class="title">
				<?php esc_html_e( 'Kostenoverzicht', 'woocommerce' ); ?>
			</h2>	
			<p>
				<?php esc_html_e( 'Gebaseerd op de gekozen opties zijn dit de reparatie kosten.', 'woocommerce' ); ?>
			</p>

			<hr>
			
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>

			<?php dynamic_sidebar( 'checkout_onder_kostenoverzicht' ); ?>

		</div>		

	</div>

</div>



		


