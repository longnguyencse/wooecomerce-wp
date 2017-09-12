( function( api ) {

	// Extends our custom "envo-store" section.
	api.sectionConstructor['envo-store'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
