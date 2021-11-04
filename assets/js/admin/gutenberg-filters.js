// Add shuffle slide order checkbox to the ghostkit carousel

function addshuffleAttribute(settings, name) {
	if (typeof settings.attributes !== 'undefined') {
		if (name == 'ghostkit/carousel') {
			settings.attributes = Object.assign(settings.attributes, {
				shuffleOrder: {
					type: 'boolean',
				}
			});
		}
	}
	return settings;
}
 
wp.hooks.addFilter(
	'blocks.registerBlockType',
	'skdd/shuffle-custom-attribute',
	addshuffleAttribute
);

const carouselAdvancedControlsOrder = wp.compose.createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { Fragment } = wp.element;
		const { ToggleControl } = wp.components;
		const { InspectorAdvancedControls } = wp.blockEditor;
		const { attributes, setAttributes, isSelected } = props;
		return (
			React.createElement(Fragment, null, 
                React.createElement(BlockEdit, props), 
                isSelected && props.name == 'ghostkit/carousel' && 
                React.createElement(InspectorAdvancedControls, null, 
                React.createElement(ToggleControl, {
                    label: wp.i18n.__('Shuffle Order', 'skdd'),
                    checked: !!attributes.shuffleOrder,
                    onChange: newval => setAttributes({
                    shuffleOrder: !attributes.shuffleOrder
                })
              })))
		);
	};
}, 'carouselAdvancedControls');
 
wp.hooks.addFilter(
	'editor.BlockEdit',
	'skdd/carousel-advanced-control-order',
	carouselAdvancedControlsOrder
);



function carouselApplyExtraClassOrder(extraProps, blockType, attributes) {
	const { shuffleOrder } = attributes;
 
	if (typeof shuffleOrder !== 'undefined' && shuffleOrder) {
		extraProps.className = extraProps.className + ' is-style-order-random';
	}
	return extraProps;
}
 
wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'skdd/carousel-apply-class-order',
	carouselApplyExtraClassOrder
);











// Add arrows at bottom checkbox to the ghostkit carousel

function addArrowAttribute(settings, name) {
	if (typeof settings.attributes !== 'undefined') {
		if (name == 'ghostkit/carousel') {
			settings.attributes = Object.assign(settings.attributes, {
				arrowPosition: {
					type: 'boolean',
				}
			});
		}
	}
	return settings;
}
 
wp.hooks.addFilter(
	'blocks.registerBlockType',
	'skdd/arrow-custom-attribute',
	addArrowAttribute
);

const carouselAdvancedControlsArrows = wp.compose.createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { Fragment } = wp.element;
		const { ToggleControl } = wp.components;
		const { InspectorAdvancedControls } = wp.blockEditor;
		const { attributes, setAttributes, isSelected } = props;
		return (
			React.createElement(Fragment, null, 
                React.createElement(BlockEdit, props), 
                isSelected && props.name == 'ghostkit/carousel' && 
                React.createElement(InspectorAdvancedControls, null, 
                React.createElement(ToggleControl, {
                    label: wp.i18n.__('Arrows at bottom', 'skdd'),
                    checked: !!attributes.arrowPosition,
                    onChange: newval => setAttributes({
                    arrowPosition: !attributes.arrowPosition
                })
              })))
		);
	};
}, 'carouselAdvancedControlsArrows');
 
wp.hooks.addFilter(
	'editor.BlockEdit',
	'skdd/carousel-advanced-control-arrows',
	carouselAdvancedControlsArrows
);



function carouselApplyExtraClassArrows(extraProps, blockType, attributes) {
	const { arrowPosition } = attributes;
 
	if (typeof arrowPosition !== 'undefined' && arrowPosition) {
		extraProps.className = extraProps.className + ' arrows-at-bottom';
	}
	return extraProps;
}
 
wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'skdd/carousel-apply-class-arrows',
	carouselApplyExtraClassArrows
);



// Remove Arrows on Mobile

function addRemoveArrowAttribute(settings, name) {
	if (typeof settings.attributes !== 'undefined') {
		if (name == 'ghostkit/carousel') {
			settings.attributes = Object.assign(settings.attributes, {
				removeArrowMobile: {
					type: 'boolean',
				}
			});
		}
	}
	return settings;
}
 
wp.hooks.addFilter(
	'blocks.registerBlockType',
	'skdd/removearrow-custom-attribute',
	addRemoveArrowAttribute
);


const carouselAdvancedControlsRemoveArrows = wp.compose.createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { Fragment } = wp.element;
		const { ToggleControl } = wp.components;
		const { InspectorAdvancedControls } = wp.blockEditor;
		const { attributes, setAttributes, isSelected } = props;
		return (
			React.createElement(Fragment, null, 
                React.createElement(BlockEdit, props), 
                isSelected && props.name == 'ghostkit/carousel' && 
                React.createElement(InspectorAdvancedControls, null, 
                React.createElement(ToggleControl, {
                    label: wp.i18n.__('Remove Arrows on Mobile', 'skdd'),
                    checked: !!attributes.removeArrowMobile,
                    onChange: newval => setAttributes({
					removeArrowMobile: !attributes.removeArrowMobile
                })
              })))
		);
	};
}, 'carouselAdvancedControlsRemoveArrows');
 
wp.hooks.addFilter(
	'editor.BlockEdit',
	'skdd/carousel-advanced-control-remove-arrows',
	carouselAdvancedControlsRemoveArrows
);



function carouselApplyExtraClassRemoveArrows(extraProps, blockType, attributes) {
	const { removeArrowMobile } = attributes;
 
	if (typeof removeArrowMobile !== 'undefined' && removeArrowMobile) {
		extraProps.className = extraProps.className + ' remove-arrows-on-mobile';
	}
	return extraProps;
}
 
wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'skdd/carousel-apply-class-RemoveArrows',
	carouselApplyExtraClassRemoveArrows
);
