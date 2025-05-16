<?php

include_once __DIR__ . "/../repositories/account.php";
include_once __DIR__ . "/../repositories/product.php";

class AddProductService {
	public static function didSent(): bool {
		return $_SERVER[ "REQUEST_METHOD" ] == "POST";
	}

	private static function isDataComplete(): bool {
		return (
			isset( $_FILES[ "image" ] ) &&
			isset( $_POST[ "name" ] ) &&
			isset( $_POST[ "description" ] ) &&
			isset( $_POST[ "price" ] ) &&
			isset( $_POST[ "count" ] )
		);
	}

	private static function getData(): array {
		return [
			"image" => $_FILES[ "image" ],
			"name" => $_POST[ "name" ],
			"description" => $_POST[ "description" ],
			"price" => $_POST[ "price" ],
			"count" => $_POST[ "count" ]
		];
	}

	public static function addProduct(): array {
		if ( !AddProductService::isDataComplete() ) {
			return [
				"message" => "فرم کامل پر نشده است.",
				"result" => false
			];
		}

		if ( !isset( $_SESSION[ "token" ] ) ) {
			return [
				"message" => "توکن ورود ثبت نشده است.",
				"result" => false
			];
		}

		$data = AddProductService::getData();
		$account = AccountRepository::findByToken( $_SESSION[ "token" ] );

		if ( $account == null ) {
			return [
				"message" => "توکن ورود اشتباه است.",
				"result" => false
			];
		}

		$targetImageDir = __DIR__ . "/../../public/assets/images/products/";
		$imageName = date( 'Ymds' ) . '-' . $data[ "image" ][ "name" ];
		$imageAddress = $targetImageDir . $imageName;

		move_uploaded_file(
			$data[ "image" ][ "tmp_name" ],
			$imageAddress
		);

		$model = new ProductModel(
			owner: $account->id,
			name: $data[ "name" ],
			description: $data[ "description" ],
			price: $data[ "price" ],
			count: $data[ "count" ],
			image: $imageAddress,
		);

		return ProductRepository::create( $model );
	}
}

?>
