<?php

include_once __DIR__ . "/../repositories/account.php";
include_once __DIR__ . "/../repositories/product.php";
include_once __DIR__ . "/../utils/back.php";

session_start();

define( 'PRODUCT_ACTION_DEL', 'PRODUCT_ACTION_DEL' );
define( 'PRODUCT_ACTION_INC', 'PRODUCT_ACTION_INC' );
define( 'PRODUCT_ACTION_DEC', 'PRODUCT_ACTION_DEC' );

if ( !isset( $_REQUEST[ "action" ] ) || !isset( $_REQUEST[ "pid" ] ) || !isset( $_SESSION[ "token" ] ) ) {
	back();
}

$account = AccountRepository::findByToken( $_SESSION[ "token" ] );

if ( $account == null ) {
	back();
}

$action = $_REQUEST[ "action" ];
$pid = $_REQUEST[ "pid" ];
$product = ProductRepository::findById( $pid );

if ( $product == null ) {
	back();
}

if ( $account->role != ACCOUNT_ROLE_ADMIN && $account->id != $pid ) {
	back();
}

if ( $action == PRODUCT_ACTION_DEL ) {
	ProductRepository::remove( $pid );
	back();
}else if ( $action == PRODUCT_ACTION_INC ) {
	$product->count++;
	ProductRepository::update( $product );
	back();
}else if ( $action == PRODUCT_ACTION_DEC ) {
	$product->count--;
	ProductRepository::update( $product );
	back();
}

back();

?>
