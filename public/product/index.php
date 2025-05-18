<?php

include_once __DIR__ . "/../../src/repositories/product.php";
include_once __DIR__ . "/../../src/repositories/account.php";
include_once __DIR__ . "/../../src/repositories/carts.php";
include_once __DIR__ . "/../../src/utils/convertor.php";

session_start();

if ( !isset( $_REQUEST[ "pid" ] ) ) {
	header( "location:./../index/" );
	die;
}

$pid = $_REQUEST[ "pid" ];
$product = ProductRepository::findById( $pid );

if ( $product == null ) {
	header( "location:./../index/" );
	die;
}

$isInCarts = false;

if ( isset( $_SESSION[ "token" ] ) ) {
	$account = AccountRepository::findByToken( $_SESSION[ "token" ] );

	if ( $account != null ) {
		$isInCarts = CartsRepository::isProductInCarts( $pid, $account->id );
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./../assets/images/logo/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="./main.css">
	<title>TakShop - Product</title>
</head>
<body>
	<br />
	<a href="./../index/" class="back-link">برگشت</a>

	<div class="container-carts">
		<span class="title"><?php echo $product->name; ?></span>
		<br />
		<span class="description"><?php echo $product->description; ?></span>

		<div class="cart">
			<div class="total-price">
				<span>قیمت:</span>
				<span class="badge">
					<?php echo convertPriceToReadableFormat( $product->price ); ?>
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>تعداد موجود در انبار:</span>
				<span class="badge"><?php echo $product->count; ?></span>
			</div>

			<?php if ( $isInCarts ) { ?>
			<div class="total-price">
				<span>تعداد سفارش شما:</span>
				<span class="badge">0</span>
			</div>
			<?php } ?>

			<div class="product-img">
				<img src="./../assets/images/products/<?php echo $product->image; ?>" alt="Product Image." />
			</div>

			<div class="actions">
				<?php if ( !$isInCarts ) { ?>
				<a href="./../../src/controllers/carts.php?action=ADD&pid=<?php echo $pid; ?>">افزودن به سبد خرید</a>
				<?php } else { ?>
				<div>
					<a href="#" class="btn-danger">حذف از سبد خرید</a>
					<a href="#">+</a>
					<a href="#" class="btn-danger">-</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<script src="./main.js"></script>
</body>
</html>
