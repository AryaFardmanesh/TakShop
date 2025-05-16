<?php

include_once __DIR__ . "/../utils/id.php";

define( 'PRODUCT_STATUS_OK', 10 );
define( 'PRODUCT_STATUS_BAN', 20 );

class ProductModel {
	function __construct(
		public string $owner,
		public string $name,
		public string $description,
		public int $price,
		public int $count,
		public string $image,
		public int $status = PRODUCT_STATUS_OK,
		public string $banMessage = "",
	) {
		$this->id = generateID();
	}
}

?>
