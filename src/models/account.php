<?php

include_once __DIR__ . "/../utils/id.php";

define( 'ACCOUNT_ROLE_NORMAL', 10 );
define( 'ACCOUNT_ROLE_ADMIN', 10 );

define( 'ACCOUNT_STATUS_OK', 10 );
define( 'ACCOUNT_STATUS_BAN', 20 );

class AccountModel {
	private ?string $error_message = null;

	function __construct(
		public readonly string $username,
		public readonly string $password,
		public readonly string $name,
		public readonly string $phone,
		public readonly string $zipcode,
		public readonly string $address,
		public readonly int $role = ACCOUNT_ROLE_NORMAL,
		public readonly int $status = ACCOUNT_STATUS_OK,
		public readonly string $banMessage = "",
	) {
		$this->id = generateID();
	}
}

?>
