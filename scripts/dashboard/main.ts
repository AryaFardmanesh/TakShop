import $ from 'jquery';

$( () => {

	const sliderButton = $( '.sidebar button' );

	sliderButton.on( 'click', ( e ) => {
		const tid = $( e.target ).attr( 'tid' );

		sliderButton.removeClass( 'active' );
		$( e.target ).addClass( 'active' );

		$( '.tab' ).removeClass( 'active' );
		$( `#${ tid }` ).addClass( 'active' );
	} )

} );
