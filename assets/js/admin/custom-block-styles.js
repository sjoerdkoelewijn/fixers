// Add responsive options to the spacer block

wp.domReady( () => {

	wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'default',
		label: 'Default',		
	});

     wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'responsive-medium',
		label: 'Responsive Medium',
	} );

     wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'responsive-small',
		label: 'Responsive Small',
		isDefault: true,
	} );

	wp.blocks.registerBlockStyle( 'core/spacer', {
		name: 'responsive-hidden',
		label: 'Responsive Hidden',
	} );

	wp.blocks.registerBlockStyle( 'ghostkit/carousel', { 
		name: 'cut-off-right',
		label: 'Cut Off',
	} );

	wp.blocks.registerBlockStyle( 'ghostkit/carousel', { 
		name: 'cut-off-right-mobile',
		label: 'Cut Off Mobile',
	} );

	wp.blocks.registerBlockStyle( 'core/list', { 
		name: 'align-right',
		label: 'Align Right',
	} );

	wp.blocks.registerBlockStyle( 'core/search', { 
		name: 'no-button',
		label: 'No Button',
	} );

	wp.blocks.registerBlockStyle( 'rank-math/faq-block', { 
		name: 'default-2',
		label: 'Default 2',
	} );

	wp.blocks.registerBlockStyle( 'rank-math/faq-block', { 
		name: 'accordion-1',
		label: 'Accordion 1',
	} );

	wp.blocks.registerBlockStyle( 'rank-math/faq-block', { 
		name: 'accordion-2',
		label: 'Accordion 2',
	} );

} );