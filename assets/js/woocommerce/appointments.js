/**
 * Appointment Data
 * Easy Appointments
 * 
 * @package SKDD
 */


'use strict';



// Multi step checkout.
var SKDDAppointmentData = function() {

	const reparaties_input = document.querySelector('.ea-standard');
	const forminator = document.querySelector('.forminator-custom-form');

	const cartInhoudInnerHTML = document.querySelector('.woocommerce-checkout-review-order-table').innerText;
	  
	reparaties_input.querySelector('.custom-field[name="description"').value = cartInhoudInnerHTML;

	forminator.querySelectorAll('#textarea-2').value = cartInhoudInnerHTML;	

	reparaties_input.querySelector('.custom-field[name="prijs"').value = totaalPrijs;
	
}

document.addEventListener(
	'DOMContentLoaded',
	function() {
		SKDDAppointmentData();
	}
);




var checkoutOption = document.getElementsByClassName('checkout_option');
var checkoutOptionHeading = document.getElementsByClassName('checkout_option_heading');

for (let i = 0; i < checkoutOption.length; i++) {
	checkoutOptionHeading[i].addEventListener('click', toggleItem, false);
}
	


function toggleItem() {
	var itemClass = this.parentNode.className;
	for (let i = 0; i < checkoutOption.length; i++) {
		checkoutOption[i].className = 'checkout_option close';
	}
	if (itemClass == 'checkout_option close') {
		this.parentNode.className = 'checkout_option active';
	}
}