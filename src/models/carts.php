<?php

include_once __DIR__ . "/../utils/id.php";

class CartsModel {
	function __construct(
		public string $productId,
		public int $count,
		public string $owner
	) {
		$this->id = generateID();
		$this->cartId = generateID();
	}
}

?>
