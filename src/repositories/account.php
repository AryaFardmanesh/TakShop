<?php

include_once "./../models/account.php";

class AccountRepository {
	public static function findById( string $id ): ?AccountModel {}

	public static function findByUsername( string $username ): ?AccountModel {}

	public static function create( AccountModel $account ): bool {}

	public static function update( AccountModel $account ): bool {}

	public static function remove( AccountModel $account ): bool {}

	public static function banById( string $id, string $message = "" ): bool {}

	public static function banByUsername( string $username, string $message = "" ): bool {}
}

?>
