<?php

include_once __DIR__ . "/../models/carts.php";
include_once __DIR__ . "/../utils/database.php";
include_once __DIR__ . "/product.php";
include_once __DIR__ . "/account.php";

class CartsRepository {
	public static function findByCartId( string $id ): ?array {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `carts` WHERE `carts`.`cart_id`='$id';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			return null;
		}

		$cart = [];

		while ( $row = mysqli_fetch_assoc( $result ) ) {
			array_push( $cart, $row );
		}

		return $cart;
	}

	public static function findByUserId( string $id ): ?array {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `carts` WHERE `carts`.`owner`='$id';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			return null;
		}

		$cart = [];

		while ( $row = mysqli_fetch_assoc( $result ) ) {
			array_push( $cart, $row );
		}

		return $cart;
	}

	public static function findByUserToken( string $token ): ?array {
		$account = AccountRepository::findByToken( $token );

		if ( $account == null ) {
			return null;
		}

		$ownerId = $account->id;

		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `carts` WHERE `carts`.`owner`='$ownerId';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			return null;
		}

		$cart = [];

		while ( $row = mysqli_fetch_assoc( $result ) ) {
			array_push( $cart, $row );
		}

		return $cart;
	}

	public static function findProductsByCartId( string $id ): ?array {
		$cart = CartsRepository::findByCartId( $id );

		if ( $cart == null ) {
			return null;
		}

		$products = [];

		foreach ( $cart as $row ) {
			$product = ProductRepository::findById( $row[ "product_id" ] );

			if ( $product != null ) {
				array_push( $products, $product );
			}
		}

		return $products;
	}

	public static function findProductsByOwner( string $id ): ?array {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `carts` WHERE `carts`.`owner`='$id';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			return null;
		}

		$cart = [];

		while ( $row = mysqli_fetch_assoc( $result ) ) {
			array_push( $cart, $row );
		}

		$products = [];

		foreach ( $cart as $row ) {
			$product = ProductRepository::findById( $row[ "product_id" ] );

			if ( $product != null ) {
				array_push( $products, $product );
			}
		}

		return $products;
	}

	public static function findByProductId( string $id, string $owner ): ?CartsModel {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `carts` WHERE `carts`.`product_id`='$id' AND `carts`.`owner`='$owner';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			return null;
		}

		$data = mysqli_fetch_assoc( $result );
		$model = new CartsModel(
			productId: $data[ "product_id" ],
			count: $data[ "count" ],
			owner: $data[ "owner" ],
		);
		$model->id = $data[ "id" ];
		$model->cart_id = $data[ "cart_id" ];

		return $model;
	}

	public static function isProductInCarts( string $pid, string $owner ): bool {
		$db = new Database();

		if ( !$db->connect() ) {
			return false;
		}

		$result = $db->execute(
			"SELECT id FROM `carts` WHERE `carts`.`product_id`='$pid' AND `carts`.`owner`='$owner';"
		);

		$db->disconnect();

		return ( mysqli_num_rows( $result ) != 0 );
	}

	public static function create( CartsModel $carts ): array {
		$db = new Database();

		if ( !$db->connect() ) {
			return [
				'message' => 'نمی توان به پایگاه داده متصل شد.',
				'result' => false,
			];
		}

		$id = $carts->id;
		$cartId = $carts->cartId;
		$productId = $carts->productId;
		$count = $carts->count;
		$owner = $carts->owner;

		$resultOwner = $db->execute(
			"SELECT `cart_id`, `product_id` FROM `carts` WHERE `carts`.`owner` = '$owner';"
		);

		$resultOwnerRow = mysqli_fetch_assoc( $resultOwner );
		if ( $resultOwnerRow ) {
			$cartId = $resultOwnerRow[ "cart_id" ];
		}
		do {
			if ( $resultOwnerRow != null && $resultOwnerRow[ "product_id" ] == $productId ) {
				$db->disconnect();
				return [
					'message' => 'این محصول قبلا به سبد خرید اضافه شده است.',
					'result' => false,
				];
			}
		}while ( $resultOwnerRow = mysqli_fetch_assoc( $resultOwner ) );

		$result = $db->execute(
			"INSERT INTO `carts` (
				`id`,
				`cart_id`,
				`product_id`,
				`count`,
				`owner`
			) VALUES (
				'$id',
				'$cartId',
				'$productId',
				$count,
				'$owner'
			);"
		);

		$db->disconnect();

		return [
			'message' => $db->error_message,
			'result' => $result,
		];
	}

	public static function update( CartsModel $carts ): array {
		$db = new Database();

		if ( !$db->connect() ) {
			return false;
		}

		$id = $carts->id;
		$pid = $carts->productId;
		$count = $carts->count;

		$result = $db->execute(
			"UPDATE `carts`
			SET
				`product_id`='$pid',
				`count`=$count
			WHERE `carts`.`id`='$id';"
		);

		$db->disconnect();

		return [
			'message' => $db->error_message,
			'result' => $result,
		];
	}

	public static function removeProduct( string $id, string $owner ): bool {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"DELETE FROM `carts` WHERE `carts`.`owner`='$owner' AND `carts`.`product_id`='$id';"
		);

		$db->disconnect();

		return $result;
	}

	public static function removeCart( string $id ): bool {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"DELETE FROM `carts` WHERE `carts`.`owner`='$id';"
		);

		$db->disconnect();

		return $result;
	}
}

?>
