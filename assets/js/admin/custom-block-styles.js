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
		name: 'order-random',
		label: 'Shuffle',
	} );

	wp.blocks.registerBlockStyle( 'core/list', { 
		name: 'align-right',
		label: 'Align Right',
	} );

	wp.blocks.registerBlockStyle( 'core/search', { 
		name: 'no-button',
		label: 'No Button',
	} );

} );