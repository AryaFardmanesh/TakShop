export default function changeDemoText() {
	const elm = document.getElementById( 'demo' );

	if ( elm != null ) {
		elm.innerText = 'This is a demo text :)';
	}
}
