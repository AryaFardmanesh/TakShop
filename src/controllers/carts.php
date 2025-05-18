<?php

include_once __DIR__ . "/../repositories/account.php";
include_once __DIR__ . "/../repositories/product.php";
include_once __DIR__ . "/../repositories/carts.php";
include_once __DIR__ . "/../utils/back.php";

session_start();

define( 'CARTS_ACTION_BUY', 'BUY' );
define( 'CARTS_ACTION_ADD', 'ADD' );
define( 'CARTS_ACTION_DEL', 'DEL' );
define( 'CARTS_ACTION_CLS', 'CLS' );
define( 'CARTS_ACTION_INC', 'INC' );
define( 'CARTS_ACTION_DEC', 'DEC' );

if ( !isset( $_REQUEST[ "action" ] ) || !isset( $_REQUEST[ "pid" ] ) ) {
	back();
}

if ( !isset( $_SESSION[ "token" ] ) ) {
	header( "location:./../../public/login/" );
	die;
}

$account = AccountRepository::findByToken( $_SESSION[ "token" ] );
$action = $_REQUEST[ "action" ];
$pid = $_REQUEST[ "pid" ];

if ( $account == null ) {
	header( "location:./../../public/login/" );
	die;
}

$product = ProductRepository::findById( $pid );

if ( $action == CARTS_ACTION_BUY ) {
	$carts = CartsRepository::findByUserId( $account->id );

	if ( $carts == null ) {
		back();
	}

	foreach ( $carts as $cart ) {
		$product = ProductRepository::findById( $cart[ "product_id" ] );
		if ( ( $product->count - $cart[ "count" ] ) < 0 ) {
			$product->count = 0;
		}else {
			$product->count -= $cart[ "count" ];
		}
		ProductRepository::update( $product );
	}

	CartsRepository::removeCart( $account->id );

	back();
}else if ( $action == CARTS_ACTION_ADD ) {
	$count = 1;

	if ( isset( $_REQUEST[ "count" ] ) ) {
		$count = $_REQUEST[ "count" ];
	}

	$model = new CartsModel(
		productId: $pid,
		count: (int)$count,
		owner: $account->id
	);

	CartsRepository::create( $model );

	back();
}else if ( $action == CARTS_ACTION_DEL ) {
	CartsRepository::removeProduct( $pid, $account->id );
	back();
}else if ( $action == CARTS_ACTION_CLS ) {
	CartsRepository::removeCart( $account->id );
	back();
}else if ( $action == CARTS_ACTION_INC ) {
	$carts = CartsRepository::findByProductId( $pid, $account->id );
	if ( $product != null && $product->count >= ( $carts->count + 1 ) ) {
		$carts->count++;
		CartsRepository::update( $carts );
	}
	back();
}else if ( $action == CARTS_ACTION_DEC ) {
	$carts = CartsRepository::findByProductId( $pid, $account->id );
	if ( ( $carts->count - 1 ) > 0 ) {
		$carts->count--;
		CartsRepository::update( $carts );
	}
	back();
}

back();

?>
