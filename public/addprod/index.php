<?php

include_once __DIR__ . "/../../src/services/addproduct.php";

session_start();

if ( !isset( $_SESSION[ "token" ] ) || !AccountRepository::isValidToken( $_SESSION[ "token" ] ) ) {
	header( "location:./../index/" );
}

$error_message = "";

if ( AddProductService::didSent() ) {
	$result = AddProductService::addProduct();

	if ( $result[ "result" ] == false ) {
		$error_message = $result[ "message" ];
	}else {
		header( "location:./../profile/" );
		die;
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
	<title>TakShop - Add Product</title>
</head>
<body>
	<form action="./" method="POST" enctype="multipart/form-data" class="login-form">
		<div class="login-form-header">
			<span>اضافه کردن محصول</span>
			<img src="./../assets/images/logo/logo.png" alt="Logo image" />
		</div>

		<div class="login-form-input-box">
			<span>تصویر محصول</span>
			<label class="label-for-file" id="label-img-preview" for="prodimg">
				<span>آپلود تصویر</span>
				<img src="./../assets/images/logo/logo.png" style="display: none;" id="imgprev" alt="You product image.">
			</label>
			<input type="file" name="image" id="prodimg" placeholder="نام محصول خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>نام محصول</span>
			<input type="text" name="name" placeholder="نام محصول خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>شرح محصول</span>
			<textarea name="description" placeholder="شرح محصول خود را وارد کنید"></textarea>
		</div>

		<div class="login-form-input-box">
			<span>قیمت</span>
			<input type="text" name="price" placeholder="قیمت فروش مصحول" required />
		</div>

		<div class="login-form-input-box">
			<span>تعداد</span>
			<input type="number" name="count" placeholder="تعداد موجود در انبار" required />
		</div>

		<button type="submit">افزودن</button>
		<button type="button" class="btn-danger" id="back-btn">برگشت</button>

		<div class="login-form-text-center error"><?php echo $error_message; ?></div>
	</form>

	<script src="./../assets/repo/jquery-3.7.1.min.js"></script>
	<script src="./main.js"></script>
</body>
</html>
