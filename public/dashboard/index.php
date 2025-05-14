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
	<title>TakShop - Dashboard</title>
</head>
<body>
	<nav class="nav">
		<a href="../index/" title="Home">
			<i class="fa-solid fa-home fa-lg"></i>
		</a>

		<a href="../profile/" title="Profile">
			<i class="fa-solid fa-user fa-lg"></i>
		</a>

		<a href="../dashboard/" class="active" title="Admin Panel">
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

	<div class="sidebar">
		<button tid="users" class="active">کاربران</button>
		<button tid="orders">سفارشات</button>
		<button tid="financial">مالی</button>
		<button tid="docs">مستندات</button>
	</div>

	<!-- Users Section -->
	<section id="users" class="tab active">
		<h1>لیست تمامی کاربران سایت</h1>

		<table class="user-table">
			<tr>
				<th>#</th>
				<th>شناسه</th>
				<th>نام کاربری</th>
				<th>اسم</th>
				<th>شماره تلفن</th>
				<th>کد پستی</th>
				<th>آدرس</th>
				<th>نقش</th>
				<th>وضعیت</th>
				<th>توضیحات</th>
				<th>تاریخ ایجاد حساب</th>
				<th>تغییر وضعیت</th>
				<th>حذف حساب</th>
			</tr>

			<tr>
				<td>1</td>
				<td>012345</td>
				<td>Arya</td>
				<td>آریا فردمنش</td>
				<td>09024708900</td>
				<td>147708914</td>
				<td>تهران, میدان دانشگاه, خیابان ستاری...</td>
				<td>
					<span class="badge">مدیر</span>
				</td>
				<td>
					<span class="badge">عادی</span>
				</td>
				<td>
					<textarea placeholder="توضیحات..."></textarea>
				</td>
				<td>
					<span class="badge">1404/02/21</span>
				</td>
				<td>
					<a href="#">مسدود کردن</a>
				</td>
				<td>
					<a href="#">حذف کردن</a>
				</td>
			</tr>
		</table>
	</section>

	<!-- Orders Section -->
	<section id="orders" class="tab activex">
		<h1>لیست تمامی سفارشات</h1>

		<table class="user-table">
			<tr>
				<th>#</th>
				<th>شناسه</th>
				<th>شناسه سبد</th>
				<th>قیمت کل</th>
				<th>وضعیت</th>
			</tr>

			<tr>
				<td>1</td>
				<td>012345</td>
				<td>912891</td>
				<td>
					<span class="badge">
						1,000
						تومان
					</span>
				</td>
				<td>
					<span class="badge">آماده</span>
				</td>
			</tr>
		</table>
	</section>

	<!-- Financial Section -->
	<section id="financial" class="tab activex">
		<h1>مالی</h1>

		<div class="card">
			<div>
				<span>درآمد کل:</span>
				<span class="badge">
					1,000
					تومان
				</span>
			</div>
			<div>
				<span>تعداد کل کالا ها:</span>
				<span class="badge">100</span>
			</div>
			<div>
				<span>قیمت کل کالا ها:</span>
				<span class="badge">
					1,000
					تومان
				</span>
			</div>
			<div>
				<span>تعداد کالا های فروخته شده:</span>
				<span class="badge">100</span>
			</div>
		</div>
	</section>

	<!-- Docs Section -->
	<section id="docs" class="tab activex docs">
		<?php
			$docs_dir = "./../../DOCS/";

			if ( is_dir( $docs_dir ) ) {
				if ( $dh = opendir( $docs_dir ) ) {
					while ( ( $filename = readdir( $dh ) ) !== false ) {
						if ( str_ends_with( $filename, '.md' ) ) {
							$file_address = $docs_dir . $filename;
							$file = fopen( $file_address, "r" ) or die( "Unable to open file!" );

							echo "<h1>" . $filename . "</h1>";

							$content = fread( $file, filesize( $file_address ) );
							$content = nl2br( $content );
							echo $content;

							echo "<hr />";

							fclose( $file );
						}
					}

					closedir( $dh );
				}
			}
		?>
	</section>

	<script src="./../assets/repo/jquery-3.7.1.min.js"></script>
	<script src="./main.js"></script>
</body>
</html>
