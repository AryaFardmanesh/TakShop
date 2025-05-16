<?php

include_once __DIR__ . "/../models/account.php";

function convertRolesToString( int $role ): string {
	switch ( $role ) {
		case ACCOUNT_ROLE_NORMAL:
			return "عادی";
		case ACCOUNT_ROLE_ADMIN:
			return "مدیر";
		default:
			return "نامشخص";
	}
}

function convertStatusToString( int $status ): string {
	switch ( $status ) {
		case ACCOUNT_STATUS_OK:
			return "عادی";
		case ACCOUNT_STATUS_BAN:
			return "مسدود شده";
		default:
			return "نامشخص";
	}
}

function convertPriceToReadableFormat( int | string $price ): string {
	$price = "$price";
	$newPrice = "";
	$counter = 1;

	for ( $i = strlen( $price ) - 1; $i >= 0; $i-- ) {
		$newPrice = $newPrice . $price[ $i ];

		if ( $counter == 3 ) {
			$counter = 0;
			$newPrice = $newPrice . ",";
		}

		$counter++;
	}

	$newPrice = strrev( $newPrice );
	if ( $newPrice[ 0 ] == "," ) {
		$newPrice = substr( $newPrice, 1 );
	}

	return $newPrice;
}

?>
