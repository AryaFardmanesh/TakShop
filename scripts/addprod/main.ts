import $ from 'jquery';

document.getElementById( 'back-btn' )?.addEventListener( 'click', () => {
	window.history.back();
} );

$( '#prodimg' ).on( 'change', event => {
	const target = event.target as HTMLInputElement;
	const file = target.files?.item( 0 );

	if ( file ) {
		const imageAddress = URL.createObjectURL( file );
		const imgprev = $( '#imgprev' );

		imgprev.attr( 'src', imageAddress );
		imgprev.css( {
			display: 'block'
		} );

		$( '#label-img-preview' ).addClass( 'label-for-file-uploaded' );
		$( '#label-img-preview span' ).remove();
	}
} );
