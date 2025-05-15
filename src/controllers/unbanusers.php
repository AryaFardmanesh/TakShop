<?php

include_once __DIR__ . "/../repositories/account.php";

if ( !isset( $_GET[ "tid" ] ) ) {
	header( "location:./../../public/dashboard/" );
	die;
}

$tid = $_GET[ "tid" ];

$model = AccountRepository::findById( $tid );

if ( $model == null ) {
	header( "location:./../../public/dashboard/" );
	die;
}

$model->status = ACCOUNT_STATUS_OK;
print_r( AccountRepository::update( $model ) );

header( "location:./../../public/dashboard/" );
die;

?>
