<?php

include_once __DIR__ . "/../../src/repositories/product.php";
include_once __DIR__ . "/../../src/utils/convertor.php";

session_start();

$isLogin = false;
$isAdmin = false;

if ( isset( $_SESSION[ "token" ] ) && AccountRepository::isValidToken( $_SESSION[ "token" ] ) ) {
	$isLogin = true;

	if ( AccountRepository::findByToken( $_SESSION[ "token" ] )->role == ACCOUNT_ROLE_ADMIN ) {
		$isAdmin = true;
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
	<title>TakShop - Home</title>
</head>
<body>
	<nav class="nav">
		<a href="./" class="active" title="Home">
			<i class="fa-solid fa-home fa-lg"></i>
		</a>

		<?php
			if ( $isLogin ) {
		?>
		<a href="../profile/" title="Profile">
			<i class="fa-solid fa-user fa-lg"></i>
		</a>
		<?php } ?>

		<?php
			if ( $isLogin && $isAdmin ) {
		?>
		<a href="../dashboard/" title="Admin Panel">
			<i class="fa-solid fa-dashboard fa-lg"></i>
		</a>
		<?php } ?>

		<?php
			if ( $isLogin ) {
		?>
		<a href="../logout/" title="Logout">
			<i class="fa-solid fa-sign-out fa-lg"></i>
		</a>
		<?php } ?>

		<?php
			if ( !$isLogin ) {
		?>
		<a href="../login/" title="Login">
			<i class="fa-solid fa-sign-in fa-lg"></i>
		</a>
		<?php } ?>
	</nav>

	<div class="header-box">
		<h1>به فروشگاه آنلاین تک شاپ خوش آمدید.</h1>
		<p>
			در این فروشگاه می توانید محصولات مختلفی را خیلی راحت خریداری کنید و یا حتی اگر محصولی برای فروش دارید آن را در این وبسایت به فروش برسانید.
		</p>
	</div>

	<hr />

	<div class="container-products">
		<?php
			$products = ProductRepository::getAllProducts();

			if ( $products != null ) {
				foreach ( $products as $product ) {
		?>
		<div class="container-product">
			<img src="./../assets/images/products/<?php echo $product[ "image" ]; ?>" alt="Product image." />
			<span class="pro-name"><?php echo $product[ "name" ]; ?></span>
			<span class="price">
				<span><?php echo convertPriceToReadableFormat( $product[ "price" ] ); ?></span>
				<span class="badge">تومان</span>
			</span>
			<a href="./../product/?pid=<?php echo $product[ "id" ]; ?>">مشاهده</a>
		</div>
		<?php } } ?>
	</div>

	<script src="./main.js"></script>
</body>
</html>
