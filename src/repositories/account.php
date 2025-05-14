<?php

include_once __DIR__ . "/../models/account.php";
include_once __DIR__ . "/../utils/database.php";
include_once __DIR__ . "/../utils/jwt.php";

class AccountRepository {
	public static function findById( string $id ): ?AccountModel {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `accounts` WHERE `accounts`.`id`='$id';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			$db->disconnect();

			return null;
		}

		$row = mysqli_fetch_assoc( $result );

		$model = new AccountModel(
			username: $row[ "username" ],
			password: $row[ "password" ],
			name: $row[ "name" ],
			phone: $row[ "phone" ],
			zipcode: $row[ "zipcode" ],
			address: $row[ "address" ],
			role: (int)$row[ "role" ],
			status: (int)$row[ "status" ],
			banMessage: $row[ "ban_message" ]
		);

		$model->id = $row[ "id" ];
		$model->date = $row[ "date" ];

		return $model;
	}

	public static function findByUsername( string $username ): ?AccountModel {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$result = $db->execute(
			"SELECT * FROM `accounts` WHERE `accounts`.`username`='$username';"
		);

		$db->disconnect();

		if ( mysqli_num_rows( $result ) == 0 ) {
			$db->disconnect();

			return null;
		}

		$row = mysqli_fetch_assoc( $result );

		$model = new AccountModel(
			username: $row[ "username" ],
			password: $row[ "password" ],
			name: $row[ "name" ],
			phone: $row[ "phone" ],
			zipcode: $row[ "zipcode" ],
			address: $row[ "address" ],
			role: (int)$row[ "role" ],
			status: (int)$row[ "status" ],
			banMessage: $row[ "ban_message" ]
		);

		$model->id = $row[ "id" ];
		$model->date = $row[ "date" ];

		return $model;
	}

	public static function create( AccountModel $account ): array {
		$db = new Database();

		if ( !$db->connect() ) {
			return false;
		}

		$username = $account->username;

		if ( AccountRepository::findByUsername( $username ) != null ) {
			$db->disconnect();

			return [
				'message' => 'این نام کاربری قبلا استفاده شده است.',
				'result' => false,
			];
		}

		$id = $account->id;
		$password = $account->password;
		$name = $account->name;
		$phone = $account->phone;
		$zipcode = $account->zipcode;
		$address = $account->address;
		$role = $account->role;
		$status = $account->status;
		$banMessage = $account->banMessage;

		$result = $db->execute(
			"INSERT INTO `accounts` (
				`id`,
				`username`,
				`password`,
				`name`,
				`phone`,
				`zipcode`,
				`address`,
				`role`,
				`status`,
				`ban_message`,
				`date`
			) VALUES (
				'$id',
				'$username',
				'$password',
				'$name',
				'$phone',
				'$zipcode',
				'$address',
				$role,
				$status,
				'$banMessage',
				current_timestamp()
			);"
		);

		$db->disconnect();

		return [
			'message' => $db->error_message,
			'result' => $result,
		];
	}

	public static function update( AccountModel $account ): array {
		$db = new Database();

		if ( !$db->connect() ) {
			return null;
		}

		$id = $account->id;

		if ( AccountRepository::findById( $id ) == null ) {
			$db->disconnect();

			return [
				'message' => 'این حساب کاربری وجود ندارد.',
				'result' => false,
			];
		}

		$username = $account->username;
		$password = $account->password;
		$name = $account->name;
		$phone = $account->phone;
		$zipcode = $account->zipcode;
		$address = $account->address;
		$role = $account->role;
		$status = $account->status;
		$banMessage = $account->banMessage;

		$result = $db->execute(
			"UPDATE `accounts`
			SET
				`username`='$username',
				`password`='$password',
				`name`='$name',
				`phone`='$phone',
				`zipcode`='$zipcode',
				`address`='$address',
				`role`=$role,
				`status`=$status,
				`ban_message`='$banMessage'
			WHERE `accounts`.`id`='$id';"
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
			"DELETE FROM `accounts` WHERE `accounts`.`id`='$id'"
		);

		$db->disconnect();

		return $result;
	}

	public static function banById( string $id, string $message = "" ): array {
		$model = AccountRepository::findById( $id );

		if ( $model == null ) {
			return [
				'message' => 'کاربر مورد نظر یافت نشد.',
				'result' => false,
			];
		}

		$model->status = ACCOUNT_STATUS_BAN;
		$model->banMessage = $message;

		return AccountRepository::update( $model );
	}

	public static function banByUsername( string $username, string $message = "" ): array {
		$model = AccountRepository::findByUsername( $id );

		if ( $model == null ) {
			return [
				'message' => 'کاربر مورد نظر یافت نشد.',
				'result' => false,
			];
		}

		$model->status = ACCOUNT_STATUS_BAN;
		$model->banMessage = $message;

		return AccountRepository::update( $model );
	}

	public static function makeAdminByUsername( string $username ): array {
		$model = AccountRepository::findByUsername( $username );

		if ( $model == null ) {
			return [
				'message' => 'کاربر مورد نظر یافت نشد.',
				'result' => false,
			];
		}

		$model->role = ACCOUNT_ROLE_ADMIN;

		return AccountRepository::update( $model );
	}

	public static function isValidToken( string $token ): bool {
		$result = JWT::decode( $token );

		if ( $result == null ) {
			return false;
		}

		$model = AccountRepository::findByUsername( $result[ "body" ][ "username" ] );

		return $model != null;
	}
}

?>
