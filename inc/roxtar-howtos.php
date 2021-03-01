<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'roxtar_customer_service_submenu' ) ) {

  function roxtar_customer_service_submenu() {
    add_submenu_page(
          'options-general.php',
          'customer-service',
          'Customer Service',
          'administrator',
          'roxtar-customer-service',
          'roxtar_customer_service_page' );
  }

}

if ( ! class_exists( 'roxtar_customer_service_page' ) ) {

  function roxtar_customer_service_page() { ?>

<h1>Roxtar Online Marketing - Customer Service</h1>

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/-wKiNZ-u-HA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



  <?php } 

}