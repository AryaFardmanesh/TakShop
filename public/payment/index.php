<?php

include_once __DIR__ . "/../../src/repositories/account.php";
include_once __DIR__ . "/../../src/repositories/product.php";
include_once __DIR__ . "/../../src/repositories/carts.php";
include_once __DIR__ . "/../../src/utils/convertor.php";

session_start();

if ( !isset( $_SESSION[ "token" ] ) || !AccountRepository::isValidToken( $_SESSION[ "token" ] ) ) {
	header( "location:./../login/" );
	die;
}

$model = AccountRepository::findByToken( $_SESSION[ "token" ] );
$carts = CartsRepository::findByUserToken( $_SESSION[ "token" ] );

$totalPrice = 0;
$totalCount = 0;

if ( $carts != null ) {
	foreach ( $carts as $cart ) {
		$product = ProductRepository::findById( $cart[ "product_id" ] );
		$totalPrice += ( $product->price * $cart[ "count" ] );
		$totalCount++;
	}
}

$totalPrice = convertPriceToReadableFormat( $totalPrice );

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./../assets/images/logo/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="./main.css">
	<title>TakShop - Payment</title>
</head>
<body>
	<br />
	<a href="./../index/" class="back-link">برگشت</a>

	<div class="container-carts">
		<span class="title">خرید محصولات</span>

		<div class="cart">
			<div class="total-price">
				<span>قیمت کل:</span>
				<span class="badge">
					<?php echo $totalPrice; ?>
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>تعداد محصولات:</span>
				<span class="badge"><?php echo $totalCount; ?></span>
			</div>

			<div class="actions">
				<a href="./../../src/controllers/carts.php?action=BUY&pid=">پرداخت</a>
			</div>

			<div class="line"></div>

			<div class="products">
				<?php
					if ( $carts != null ) {
						foreach ( $carts as $cart ) {
							$product = ProductRepository::findById( $cart[ "product_id" ] );

							if ( $product == null ) {
								continue;
							}

							$id = $product->id;
							$image = $product->image;
							$name = $product->name;
							$price = $product->price;
							$count = $cart[ "count" ];
				?>
				<div class="product-card">
					<img src="./../assets/images/products/<?php echo $image; ?>" alt="Product Image." />
					<span class="pro-name"><?php echo $name; ?></span>
					<div class="price">
						<span><?php echo convertPriceToReadableFormat( $price ) ?></span>
						<span class="badge">تومان</span>
					</div>
					<div class="count">
						<span>تعداد:</span>
						<span class="badge"><?php echo $count ?></span>
					</div>
					<div class="actions">
						<a href="./../../src/controllers/carts.php?action=INC&pid=<?php echo $id; ?>">+</a>
						<a href="./../../src/controllers/carts.php?action=DEC&pid=<?php echo $id; ?>">-</a>
					</div>
					<div class="btns-row">
						<a href="./../product/?pid=<?php echo $id; ?>" class="btn">مشاهده</a>
						<a href="./../../src/controllers/carts.php?action=DEL&pid=<?php echo $id; ?>" class="btn-danger">حذف</a>
					</div>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>

	<script src="./../assets/repo/jquery-3.7.1.min.js"></script>
	<script src="./main.js"></script>
</body>
</html>
