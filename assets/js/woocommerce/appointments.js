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
	


	// Change selected dropdown data attribute value 
	// const totaalPrijs = '999';
	// const prijs_select = document.querySelector('.filter[name="service"]');
	// const prijs_option = prijs_select.options[prijs_select.selectedIndex];
	// prijs_option.setAttribute('data-price', totaalPrijs); 
}

document.addEventListener(
	'DOMContentLoaded',
	function() {
		SKDDAppointmentData();
	}
);