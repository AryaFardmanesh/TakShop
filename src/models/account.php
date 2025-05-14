<?php

include_once __DIR__ . "/../utils/id.php";

enum AccountRole: int {
	case NORMAL	=	10;
	case ADMIN	=	20;
}

enum AccountStatus: int {
	case OK		=	10;
	case BAN	=	20;
}

class AccountModel {
	private ?string $error_message = null;

	function __construct(
		public readonly string $username,
		public readonly string $password,
		public readonly string $name,
		public readonly string $phone,
		public readonly string $zipcode,
		public readonly string $address,
		public readonly AccountRole $role = AccountRole::NORMAL,
		public readonly AccountStatus $status = AccountStatus::OK,
		public readonly string $banMessage = "",
	) {
		$this->id = generateID();
	}
}

?>
