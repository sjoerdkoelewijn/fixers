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
	reparaties_input.querySelector('.custom-field[name="description"').value = cartInhoud;
	


	const prijs_input = document.querySelector('.ea-standard');
	prijs_input.querySelector('.custom-field[name="prijs"').value = totaalPrijs;
	
	


	const reparaties_input_forminator = document.getElementsByClassName('forminator-custom-form');
	reparaties_input_forminator.getElementById('#textarea-2').value = cartInhoud;
	
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