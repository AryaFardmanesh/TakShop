<?php

include_once __DIR__ . "/../repositories/account.php";

function getData( string $name ): ?string {
	if ( isset( $_POST[ $name ] ) )
		return $_POST[ $name ];
	return null;
}

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

$username = getData( "username" );
if ( $username )
	$model->username = $username;

$name = getData( "name" );
if ( $name )
	$model->name = $name;

$phone = getData( "phone" );
if ( $phone )
	$model->phone = $phone;

$zipcode = getData( "zipcode" );
if ( $zipcode )
	$model->zipcode = $zipcode;

$address = getData( "address" );
if ( $address )
	$model->address = $address;

AccountRepository::update( $model );

header( "location:./../../public/profile/" );
die;

?>
