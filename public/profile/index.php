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
				<a href="#">خرید</a>
				<a href="#" class="btn-danger">حذف سبد</a>
			</div>

			<div class="line"></div>

			<div class="products">
				<div class="product-card">
					<img src="./../assets/images/logo/logo.png" alt="Product Image." />
					<span class="pro-name">نام محصول</span>
					<div class="price">
						<span>1000</span>
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
					<a href="#" class="btn-danger">حذف از سبد</a>
				</div>
			</div>
		</div>
	</div>

	<script src="./main.js"></script>
</body>
</html>
