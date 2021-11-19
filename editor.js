wp.domReady( () => {

	wp.blocks.registerBlockStyle(
		'core/paragraph',
		[
			{
				name: 'left-red',
				label: 'left-red',
			}
		]
	);

	wp.blocks.registerBlockStyle(
		'core/group',
		[
			{
				name: 'sanded',
				label: 'sanded',
			}
		]
	);
} );