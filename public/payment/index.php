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
					1,000
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>تعداد محصولات:</span>
				<span class="badge">0</span>
			</div>

			<div class="actions">
				<a href="#">پرداخت</a>
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

	<script src="./../assets/repo/jquery-3.7.1.min.js"></script>
	<script src="./main.js"></script>
</body>
</html>
