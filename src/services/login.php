<?php

include_once __DIR__ . "/../repositories/account.php";
include_once __DIR__ . "/../utils/jwt.php";

class LoginService {
	public static function didSent(): bool {
		return $_SERVER[ "REQUEST_METHOD" ] == "POST";
	}

	private static function isDataComplete(): bool {
		return (
			isset( $_POST[ "username" ] ) &&
			isset( $_POST[ "password" ] )
		);
	}

	private static function getData(): array {
		return [
			"username" => $_POST[ "username" ],
			"password" => $_POST[ "password" ]
		];
	}

	public static function login(): array {
		if ( !LoginService::isDataComplete() ) {
			return [
				"message" => "فرم کامل پر نشده است.",
				"result" => false
			];
		}

		$data = LoginService::getData();
		$model = AccountRepository::findByUsername( $data[ "username" ] );

		if ( $model == null ) {
			return [
				"message" => "نام کاربری اشتباه است.",
				"result" => false
			];
		}

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
