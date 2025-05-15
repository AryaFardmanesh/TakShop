<?php

include_once __DIR__ . "/../../src/services/signup.php";

session_start();

if ( isset( $_SESSION[ "token" ] ) && AccountRepository::isValidToken( $_SESSION[ "token" ] ) ) {
	header( "location:./../index/" );
}

$error_message = "";

if ( SignUpService::didSent() ) {
	$result = SignUpService::signup();

	if ( $result[ "result" ] == false ) {
		$error_message = $result[ "message" ];
	}else {
		header( "location:./../index/" );
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
	<title>TakShop - Sign Up</title>
</head>
<body>
	<form action="./" method="POST" class="login-form">
		<div class="login-form-header">
			<span>ایجاد حساب کاربری</span>
			<img src="./../assets/images/logo/logo.png" alt="Logo image" />
		</div>

		<div class="login-form-input-box">
			<span>نام و نام خانوادگی</span>
			<input type="text" name="name" placeholder="نام و نام خانوادگی خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>نام کاربری</span>
			<input type="text" name="username" placeholder="نام کاربری خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>رمز عبور</span>
			<input type="password" name="password" placeholder="رمز عبور خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>تکرار رمز عبور</span>
			<input type="password" name="repeat_password" placeholder="رمز عبور خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>تلفن همراه</span>
			<input type="text" name="phone" placeholder="شماره تلفن هراه خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>کد پستی</span>
			<input type="text" name="zipcode" placeholder="کد پستی خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>آدرس</span>
			<textarea name="address" placeholder="آدرس محل سکونت خود را وارد کنید" required></textarea>
			<!-- <input type="text" placeholder="آدرس محل سکونت خود را وارد کنید" /> -->
		</div>

		<button type="submit">ثبت نام</button>

		<div class="login-form-text-center">اگر حساب کاربری دارد <a href="./../login/">وارد شوید</a>.</div>

		<div class="login-form-text-center error"><?php echo $error_message; ?></div>
	</form>

	<script src="./../assets/repo/jquery-3.7.1.min.js"></script>
	<script src="./main.js"></script>
</body>
</html>
