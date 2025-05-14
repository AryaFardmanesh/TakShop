<?php

include_once __DIR__ . "/../utils/id.php";

define( 'ACCOUNT_ROLE_NORMAL', 10 );
define( 'ACCOUNT_ROLE_ADMIN', 20 );

define( 'ACCOUNT_STATUS_OK', 10 );
define( 'ACCOUNT_STATUS_BAN', 20 );

class AccountModel {
	private ?string $error_message = null;

	function __construct(
		public string $username,
		public string $password,
		public string $name,
		public string $phone,
		public string $zipcode,
		public string $address,
		public int $role = ACCOUNT_ROLE_NORMAL,
		public int $status = ACCOUNT_STATUS_OK,
		public string $banMessage = "",
	) {
		$this->id = generateID();
	}
}

?>
