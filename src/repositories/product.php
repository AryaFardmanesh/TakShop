<?php

include_once __DIR__ . "/../models/product.php";
include_once __DIR__ . "/../utils/database.php";
include_once __DIR__ . "/../utils/jwt.php";
include_once __DIR__ . "/account.php";

class ProductRepository {
	public static function getAllProducts(): ?array {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute( "SELECT * FROM `products`;" );

		if ( mysqli_num_rows( $result ) == 0 ) {
			return null;
		}

		$products = [];

		while ( $row = mysqli_fetch_assoc( $result ) ) {
			array_push( $products, $row );
		}

		$db->disconnect();

		return $products;
	}

	public static function findById( string $id ): ?ProductModel {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `products` WHERE `products`.`id`='$id';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			$db->disconnect();

			return null;
		}

		$row = mysqli_fetch_assoc( $result );

		$model = new ProductModel(
			owner: $row[ "owner" ],
			name: $row[ "name" ],
			description: $row[ "description" ],
			price: $row[ "price" ],
			count: $row[ "count" ],
			image: $row[ "image" ],
			status: $row[ "status" ],
			banMessage: $row[ "ban_message" ],
		);

		$model->id = $row[ "id" ];

		return $model;
	}

	public static function findByUserToken( string $token ): ?array {
		$account = AccountRepository::findByToken( $token );

		if ( $account == null ) {
			return null;
		}

		$accountId = $account->id;

		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `products` WHERE `products`.`owner`='$accountId';"
		);

		$products = [];

		while ( $row = mysqli_fetch_assoc( $result ) ) {
			array_push( $products, $row );
		}

		$db->disconnect();

		return $products;
	}

	public static function create( ProductModel $product ): array {
		$db = new Database();

		if ( !$db->connect() ) {
			return false;
		}

		$id = $product->id;
		$owner = $product->owner;
		$name = $product->name;
		$description = $product->description;
		$price = $product->price;
		$count = $product->count;
		$image = $product->image;
		$status = $product->status;
		$banMessage = $product->banMessage;

		$result = $db->execute(
			"INSERT INTO `products` (
				`id`,
				`owner`,
				`name`,
				`description`,
				`price`,
				`count`,
				`image`,
				`status`,
				`ban_message`
			) VALUES (
				'$id',
				'$owner',
				'$name',
				'$description',
				$price,
				$count,
				'$image',
				$status,
				'$banMessage'
			);"
		);

		$db->disconnect();

		return [
			'message' => $db->error_message,
			'result' => $result,
		];
	}

	public static function update( ProductModel $product ): array {
		$db = new Database();

		if ( !$db->connect() ) {
			return false;
		}

		$id = $product->id;
		$name = $product->name;
		$description = $product->description;
		$price = $product->price;
		$count = $product->count;
		$image = $product->image;
		$status = $product->status;
		$banMessage = $product->banMessage;

		$result = $db->execute(
			"UPDATE `products`
			SET
				`name`='$name',
				`description`='$description',
				`price`='$price',
				`count`='$count',
				`image`='$image',
				`status`=$status,
				`ban_message`='$banMessage'
			WHERE `products`.`id`='$id';"
		);

		$db->disconnect();

		return [
			'message' => $db->error_message,
			'result' => $result,
		];
	}

	public static function remove( string $id ): bool {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"DELETE FROM `products` WHERE `products`.`id`='$id'"
		);

		$db->disconnect();

		return $result;
	}

	public static function ban( string $id, string $message = "" ): array {
		$model = ProductRepository::findById( $id );

		if ( $model == null ) {
			return [
				'message' => 'محصول مورد نظر یافت نشد.',
				'result' => false,
			];
		}

		$model->status = PRODUCT_STATUS_BAN;
		$model->banMessage = $message;

		return ProductRepository::update( $model );
	}

	public static function unban( string $id ): array {
		$model = ProductRepository::findById( $id );

		if ( $model == null ) {
			return [
				'message' => 'محصول مورد نظر یافت نشد.',
				'result' => false,
			];
		}

		$model->status = PRODUCT_STATUS_OK;

		return ProductRepository::update( $model );
	}
}

?>
