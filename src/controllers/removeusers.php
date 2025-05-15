<?php

include_once __DIR__ . "/../repositories/account.php";

if ( !isset( $_GET[ "tid" ] ) ) {
	header( "location:./../../public/dashboard/" );
	die;
}

$tid = $_GET[ "tid" ];

AccountRepository::remove( $tid );

header( "location:./../../public/dashboard/" );
die;

?>
