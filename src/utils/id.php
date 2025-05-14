<?php

function generateID(): string {
	$id = uniqid() . uniqid() . uniqid();
	return substr( $id, 0, 32 );
}

?>
