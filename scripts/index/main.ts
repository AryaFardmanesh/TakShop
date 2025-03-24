import changeDemoText from './mod';

const btn = document.getElementById( 'btn' );

if ( btn != null ) {
	btn.addEventListener( 'click', () => {
		changeDemoText();
	} );
}
