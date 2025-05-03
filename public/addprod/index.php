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
	<form action="#" method="GET" class="login-form">
		<div class="login-form-header">
			<span>اضافه کردن محصول</span>
			<img src="./../assets/images/logo/logo.png" alt="Logo image" />
		</div>

		<div class="login-form-input-box">
			<span>تصویر محصول</span>
			<label class="label-for-file --label-for-file-uploaded" for="prodimg">
				آپلود تصویر
				<!-- <img src="./../assets/images/logo/logo.png" alt="You product image."> -->
			</label>
			<input type="file" id="prodimg" placeholder="نام محصول خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>نام محصول</span>
			<input type="text" placeholder="نام محصول خود را وارد کنید" required />
		</div>

		<div class="login-form-input-box">
			<span>شرح محصول</span>
			<textarea placeholder="شرح محصول خود را وارد کنید"></textarea>
		</div>

		<div class="login-form-input-box">
			<span>قیمت</span>
			<input type="text" placeholder="قیمت فروش مصحول" required />
		</div>

		<div class="login-form-input-box">
			<span>تعداد</span>
			<input type="number" placeholder="تعداد موجود در انبار" required />
		</div>

		<button type="submit">افزودن</button>
		<button type="button" class="btn-danger" id="back-btn">برگشت</button>

		<!-- <div class="login-form-text-center error">خطلا رمز عبور اشتباه است</div> -->
	</form>

	<script src="./../assets/repo/jquery-3.7.1.min.js"></script>
	<script src="./main.js"></script>
</body>
</html>
