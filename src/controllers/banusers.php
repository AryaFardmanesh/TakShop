<?php

include_once __DIR__ . "/../repositories/account.php";

if ( !isset( $_GET[ "tid" ] ) ) {
	header( "location:./../../public/dashboard/" );
	die;
}

$tid = $_GET[ "tid" ];
$message = "";

if ( isset( $_GET[ "msg" ] ) ) {
	$message = $_GET[ "msg" ];
}

AccountRepository::banById( $tid, $message );

header( "location:./../../public/dashboard/" );
die;

?>
