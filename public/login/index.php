<?php

include_once __DIR__ . "/../../src/services/login.php";

session_start();

if ( $_SESSION[ "token" ] && AccountRepository::isValidToken( $_SESSION[ "token" ] ) ) {
	header( "location:./../index/" );
}

$error_message = "";

if ( LoginService::didSent() ) {
	$result = LoginService::login();

	if ( $result[ "result" ] == false ) {
		$error_message = $result[ "message" ];
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
	<title>TakShop - Login</title>
</head>
<body>
	<form action="./" method="POST" class="login-form">
		<div class="login-form-header">
			<span>ورود به حساب کاربری</span>
			<img src="./../assets/images/logo/logo.png" alt="Logo image" />
		</div>

		<div class="login-form-input-box">
			<span>نام کاربری</span>
			<input type="text" name="username" placeholder="نام کاربری خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>رمز عبور</span>
			<input type="password" name="password" placeholder="رمز عبور خود را وارد کنید" required />
		</div>

		<button type="submit">ورود</button>

		<div class="login-form-text-center">اگر حساب کاربری ندارید یکی <a href="./../signup/">ایجاد کنید</a>.</div>

		<div class="login-form-text-center error"><?php echo $error_message; ?></div>
	</form>

	<script src="./../assets/repo/jquery-3.7.1.min.js"></script>
	<script src="./main.js"></script>
</body>
</html>
