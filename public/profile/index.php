<?php

include_once __DIR__ . "/../../src/repositories/account.php";
include_once __DIR__ . "/../../src/repositories/product.php";
include_once __DIR__ . "/../../src/services/login.php";
include_once __DIR__ . "/../../src/utils/convertor.php";

session_start();

if ( !isset( $_SESSION[ "token" ] ) || !AccountRepository::isValidToken( $_SESSION[ "token" ] ) ) {
	header( "location:./../login/" );
	die;
}

$model = AccountRepository::findByToken( $_SESSION[ "token" ] );
$ownProducts = ProductRepository::findByUserToken( $_SESSION[ "token" ] );

$id = $model->id;
$username = $model->username;
$name = $model->name;
$phone = $model->phone;
$zipcode = $model->zipcode;
$address = $model->address;
$role = convertRolesToString( $model->role );
$date = $model->date;
$isAdmin = $model->role == ACCOUNT_ROLE_ADMIN;

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

		<?php if ( $isAdmin ) { ?>
		<a href="../dashboard/" title="Admin Panel">
			<i class="fa-solid fa-dashboard fa-lg"></i>
		</a>
		<?php } ?>

		<a href="../logout/" title="Logout">
			<i class="fa-solid fa-sign-out fa-lg"></i>
		</a>
	</nav>

	<br />
	<a href="./../index/" class="back-link">برگشت</a>

	<div class="container-profile">
		<div class="container-profile-avatar-name">
			<img src="./../assets/images/avatar/profile.png" alt="Profile Avatar." />
			<span>نام کاربری</span>
		</div>

		<form action="./../../src/controllers/userupdate.php?tid=<?php echo $id; ?>" method="POST" class="container-info">
			<div>
				<div>
					<label for="account-username">نام کاربری:</label>
					<input type="text" id="account-username" name="username" value="<?php echo $username; ?>" spellcheck="false" required />
				</div>
				<div>
					<label for="account-name">نام:</label>
					<input type="text" id="account-name" name="name" value="<?php echo $name; ?>" spellcheck="false" required />
				</div>
				<div>
					<label for="account-phone">تلفن همراه:</label>
					<input type="text" id="account-phone" name="phone" value="<?php echo $phone; ?>" spellcheck="false" required />
				</div>
				<div>
					<label for="account-zipcode">کد پستی:</label>
					<input type="text" id="account-zipcode" name="zipcode" value="<?php echo $zipcode; ?>" spellcheck="false" required />
				</div>
				<div>
					<label for="address">آدرس:</label>
					<textarea id="address" name="address" spellcheck="false" required><?php echo $address; ?></textarea>
				</div>
				<div>
					<label>نوع حساب کاربری:</label>
					<span><?php echo $role; ?></span>
				</div>
				<div>
					<label>تاریخ ایجاد حساب کاربری:</label>
					<span><?php echo $date; ?></span>
				</div>
			</div>

			<button type="submit">ذخیره</button>
		</form>
	</div>

	<div class="container-carts">
		<span class="title">محصولات خود</span>

		<?php
			$totalPrice = 0;
			$totalCount = count( $ownProducts );

			foreach ( $ownProducts as $product ) {
				$totalPrice += $product[ "price" ];
			}
		?>

		<div class="cart">
			<div class="total-price">
				<span>قیمت کل:</span>
				<span class="badge">
					<?php echo convertPriceToReadableFormat( $totalPrice ); ?>
					تومان
				</span>
			</div>

			<div class="total-price">
				<span>تعداد محصولات:</span>
				<span class="badge"><?php echo $totalCount; ?></span>
			</div>

			<div class="actions">
				<a href="./../addprod/">+ ایجاد محصول</a>
			</div>

			<div class="line"></div>

			<div class="products">
				<?php
					if ( $ownProducts != null ) {
						$ownProductsLen = count( $ownProducts );
						foreach ( $ownProducts as $value ) {
							$id = $value[ "id" ];
							$image = $value[ "image" ];
							$name = $value[ "name" ];
							$price = $value[ "price" ];
							$count = $value[ "count" ];
				?>
				<div class="product-card">
					<img src="./../assets/images/products/<?php echo $image; ?>" alt="Product Image." />
					<span class="pro-name"><?php echo $name; ?></span>
					<div class="price">
						<span><?php echo convertPriceToReadableFormat( $price ); ?></span>
						<span class="badge">تومان</span>
					</div>
					<div class="count">
						<span>تعداد:</span>
						<span class="badge"><?php echo $count; ?></span>
					</div>
					<div class="actions">
						<a href="#">+</a>
						<a href="#">-</a>
					</div>
					<div class="btns-row">
						<a href="./../product/?pid=<?php echo $id; ?>" class="btn">مشاهده</a>
						<a href="#" class="btn-danger">حذف</a>
					</div>
				</div>
				<?php } } ?>
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

	<script src="./main.js"></script>
</body>
</html>
