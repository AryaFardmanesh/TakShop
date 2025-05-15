<?php

include_once __DIR__ . "/../repositories/account.php";
include_once __DIR__ . "/../utils/jwt.php";

class SignUpService {
	public static function didSent(): bool {
		return $_SERVER[ "REQUEST_METHOD" ] == "POST";
	}

	private static function isDataComplete(): bool {
		return (
			isset( $_POST[ "name" ] ) &&
			isset( $_POST[ "username" ] ) &&
			isset( $_POST[ "password" ] ) &&
			isset( $_POST[ "repeat_password" ] ) &&
			isset( $_POST[ "phone" ] ) &&
			isset( $_POST[ "zipcode" ] ) &&
			isset( $_POST[ "address" ] )
		);
	}

	private static function getData(): array {
		return [
			"name" => $_POST[ "name" ],
			"username" => $_POST[ "username" ],
			"password" => $_POST[ "password" ],
			"repeat_password" => $_POST[ "repeat_password" ],
			"phone" => $_POST[ "phone" ],
			"zipcode" => $_POST[ "zipcode" ],
			"address" => $_POST[ "address" ]
		];
	}

	public static function signup(): array {
		if ( !SignUpService::isDataComplete() ) {
			return [
				"message" => "فرم کامل پر نشده است.",
				"result" => false
			];
		}

		$data = SignUpService::getData();

		if ( $data[ "password" ] != $data[ "repeat_password" ] ) {
			return [
				"message" => "رمز عبور با تکرار رمز عبور یکسان نیست.",
				"result" => false
			];
		}

		$isExists = AccountRepository::findByUsername( $data[ "username" ] );

		if ( $isExists != null ) {
			return [
				"message" => "این نام کاربری قبلا ثبت شده است.",
				"result" => false
			];
		}

		$data[ "password" ] = password_hash( $data[ "password" ], PASSWORD_BCRYPT );

		$model = new AccountModel(
			username: $data[ "username" ],
			password: $data[ "password" ],
			name: $data[ "name" ],
			phone: $data[ "phone" ],
			zipcode: $data[ "zipcode" ],
			address: $data[ "address" ]
		);
		AccountRepository::create( $model );

		$_SESSION[ 'token' ] = JWT::encode( [
			"id" => $model->id,
			"username" => $model->username,
		] );

		return [
			"message" => "",
			"result" => true
		];
	}
}

?>
