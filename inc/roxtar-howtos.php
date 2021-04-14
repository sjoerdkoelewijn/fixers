<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'SKDD_customer_service_submenu' ) ) {

  function SKDD_customer_service_submenu() {
    add_submenu_page(
          'options-general.php',
          'customer-service',
          'Customer Service',
          'administrator',
          'SKDD-customer-service',
          'SKDD_customer_service_page' );
  }

}

if ( ! class_exists( 'SKDD_customer_service_page' ) ) {

  function SKDD_customer_service_page() { ?>

<h1>SKDD Online Marketing - Customer Service</h1>

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/-wKiNZ-u-HA" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



  <?php } 

}