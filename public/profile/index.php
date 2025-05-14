<?php

include_once __DIR__ . "/../../src/services/login.php";

session_start();

$isLogin = false;

if ( isset( $_SESSION[ "token" ] ) && AccountRepository::isValidToken( $_SESSION[ "token" ] ) ) {
	$isLogin = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./../assets/images/logo/logo.png" type="image/x-icon">
	<link rel="stylesheet" href="./main.css">
	<title>TakShop - Profile</title>
</head>
<body>
	<nav class="nav">
		<a href="../index/" title="Home">
			<i class="fa-solid fa-home fa-lg"></i>
		</a>

		<a href="./" class="active" title="Profile">
			<i class="fa-solid fa-user fa-lg"></i>
		</a>

		<a href="../dashboard/" title="Admin Panel">
			<i class="fa-solid fa-dashboard fa-lg"></i>
		</a>

		<?php
			if ( $isLogin ) {
		?>
		<a href="../logout/" title="Logout">
			<i class="fa-solid fa-sign-out fa-lg"></i>
		</a>
		<?php } ?>
	</nav>

	<br />
	<a href="./../index/" class="back-link">برگشت</a>

	<div class="container-profile">
		<div class="container-profile-avatar-name">
			<img src="./../assets/images/avatar/profile.png" alt="Profile Avatar." />
			<span>نام کاربری</span>
		</div>

		<form class="container-info">
			<div>
				<div>
					<label for="account-username">نام کاربری:</label>
					<input type="text" id="account-username" name="account-username" value="Arya" spellcheck="false" required />
				</div>
				<div>
					<label for="account-name">نام:</label>
					<input type="text" id="account-name" name="account-name" value="آریا فردمنش" spellcheck="false" required />
				</div>
				<div>
					<label for="account-phone">تلفن همراه:</label>
					<input type="text" id="account-phone" name="account-phone" value="09024708900" spellcheck="false" required />
				</div>
				<div>
					<label for="account-zipcode">کد پستی:</label>
					<input type="text" id="account-zipcode" name="account-zipcode" value="1471470890" spellcheck="false" required />
				</div>
				<div>
					<label for="address">آدرس:</label>
					<textarea id="address" name="address" spellcheck="false" required>تهران</textarea>
				</div>
				<div>
					<label>نوع حساب کاربری:</label>
					<span>معمولی</span>
				</div>
				<div>
					<label>تاریخ ایجاد حساب کاربری:</label>
					<span>2025/01/18</span>
				</div>
			</div>

			<button type="submit">ذخیره</button>
		</form>
	</div>

	<div class="container-carts">
		<span class="title">محصولات خود</span>

		<div class="cart">
			<div class="total-price">
				<span>قیمت کل:</span>
				<span class="badge">
					1,000
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>فروش:</span>
				<span class="badge">
					0
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>تعداد محصولات:</span>
				<span class="badge">0</span>
			</div>

			<div class="actions">
				<a href="#">+ ایجاد محصول</a>
			</div>

			<div class="line"></div>

			<div class="products">
				<div class="product-card">
					<img src="./../assets/images/logo/logo.png" alt="Product Image." />
					<span class="pro-name">نام محصول</span>
					<div class="price">
						<span>1,000</span>
						<span class="badge">تومان</span>
					</div>
					<div class="count">
						<span>تعداد:</span>
						<span class="badge">1</span>
					</div>
					<div class="actions">
						<a href="#">+</a>
						<a href="#">-</a>
					</div>
					<div class="btns-row">
						<a href="#" class="btn">مشاهده</a>
						<a href="#" class="btn-danger">حذف</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-carts">
		<span class="title">محصولات حذف شده</span>

		<div class="cart">
			<div class="total-price">
				<span>قیمت کل:</span>
				<span class="badge">
					1,000
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>تعداد محصولات:</span>
				<span class="badge">1</span>
			</div>

			<div class="line"></div>

			<div class="products">
				<div class="product-card">
					<img src="./../assets/images/logo/logo.png" alt="Product Image." />
					<span class="pro-name">نام محصول</span>
					<div class="price">
						<span>1,000</span>
						<span class="badge">تومان</span>
					</div>
					<div class="count">
						<span>تعداد:</span>
						<span class="badge">1</span>
					</div>

					<div class="btns-row">
						<a href="#" class="btn">بازگردانی</a>
						<a href="#" class="btn-danger">حذف</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-carts">
		<span class="title">سبد خرید</span>

		<div class="cart">
			<div class="total-price">
				<span>قیمت کل:</span>
				<span class="badge">
					1,000
					تومان
				</span>
			</div>

			<div class="actions">
				<a href="#">پرداخت</a>
				<a href="#" class="btn-danger">حذف سبد</a>
			</div>

			<div class="line"></div>

			<div class="products">
				<div class="product-card">
					<img src="./../assets/images/logo/logo.png" alt="Product Image." />
					<span class="pro-name">نام محصول</span>
					<div class="price">
						<span>1,000</span>
						<span class="badge">تومان</span>
					</div>
					<div class="count">
						<span>تعداد:</span>
						<span class="badge">1</span>
					</div>
					<div class="actions">
						<a href="#">+</a>
						<a href="#">-</a>
					</div>
					<div class="btns-row">
						<a href="#" class="btn">مشاهده</a>
						<a href="#" class="btn-danger">حذف از سبد</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-carts">
		<span class="title">تاریخچه خرید</span>

		<div class="cart">
			<div class="total-price">
				<span>قیمت کل:</span>
				<span class="badge">
					1,000
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>تاریخ:</span>
				<span class="badge">2025/04/27</span>
			</div>

			<div class="line"></div>

			<div class="products">
				<div class="product-card">
					<img src="./../assets/images/logo/logo.png" alt="Product Image." />
					<span class="pro-name">نام محصول</span>
					<div class="price">
						<span>1,000</span>
						<span class="badge">تومان</span>
					</div>
					<div class="count">
						<span>تعداد:</span>
						<span class="badge">1</span>
					</div>
					<a href="#" class="btn">مشاهده</a>
				</div>
			</div>
		</div>
	</div>

	<script src="./main.js"></script>
</body>
</html>
