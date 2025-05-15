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

?>
