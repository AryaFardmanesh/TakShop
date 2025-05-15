<?php

include_once __DIR__ . "/../../src/services/login.php";
include_once __DIR__ . "/../../src/utils/convertor.php";

session_start();

if ( !isset( $_SESSION[ "token" ] ) ) {
	header( "location:./../index/" );
	die;
}

$user = AccountRepository::findByToken( $_SESSION[ "token" ] );

if ( $user == null || $user->role != ACCOUNT_ROLE_ADMIN ) {
	header( "location:./../index/" );
	die;
}

$allUsers = AccountRepository::getAllUser() ?? [];

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

		<a href="../logout/" title="Logout">
			<i class="fa-solid fa-sign-out fa-lg"></i>
		</a>
	</nav>

	<div class="sidebar">
		<button tid="allUsers" class="active">کاربران</button>
		<button tid="orders">سفارشات</button>
		<button tid="financial">مالی</button>
		<button tid="docs">مستندات</button>
	</div>

	<!-- allUsers Section -->
	<section id="allUsers" class="tab active">
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
				<!-- <th>توضیحات</th> -->
				<th>تاریخ ایجاد حساب</th>
				<th>تغییر وضعیت</th>
				<th>حذف حساب</th>
			</tr>

			<?php
				$allUsersLen = count( $allUsers );
				for ( $i = 0; $i < $allUsersLen; $i++ ) {
					$id = substr( $allUsers[ $i ][ "id" ], 0, 8 ) . "...";
					$username = $allUsers[ $i ][ "username" ];
					$name = $allUsers[ $i ][ "name" ];
					$phone = $allUsers[ $i ][ "phone" ];
					$zipcode = $allUsers[ $i ][ "zipcode" ];
					$address = substr( $allUsers[ $i ][ "address" ], 0, 18 ) . "...";
					$role = convertRolesToString ( $allUsers[ $i ][ "role" ] );
					$status = convertStatusToString ( $allUsers[ $i ][ "status" ] );
					$banMsg = $allUsers[ $i ][ "ban_message" ];
					$date = $allUsers[ $i ][ "date" ];
					$isBan = $allUsers[ $i ][ "status" ] == ACCOUNT_STATUS_BAN;
			?>
			<tr>
				<td><?php echo ( $i + 1 ); ?></td>
				<td><?php echo $id; ?></td>
				<td><?php echo $username; ?></td>
				<td><?php echo $name; ?></td>
				<td><?php echo $phone; ?></td>
				<td><?php echo $zipcode; ?></td>
				<td><?php echo $address; ?></td>
				<td>
					<span class="badge"><?php echo $role; ?></span>
				</td>
				<td>
					<span class="badge"><?php echo $status; ?></span>
				</td>
				<!-- <td>
					<textarea placeholder="توضیحات..."><?php /* echo $banMsg; */ ?></textarea>
				</td> -->
				<td>
					<span class="badge"><?php echo $date; ?></span>
				</td>
				<td>
					<?php if ( $isBan ) { ?>
					<a href="./../../src/controllers/unbanusers.php?tid=<?php echo $allUsers[ $i ][ "id" ]; ?>" disabled>مسدود کردن</a>
					<?php }else { ?>
					<a href="./../../src/controllers/banusers.php?tid=<?php echo $allUsers[ $i ][ "id" ]; ?>" disabled>آزاد سازی</a>
					<?php } ?>
				</td>
				<td>
					<a href="./../../src/controllers/removeusers.php?tid=<?php echo $allUsers[ $i ][ "id" ]; ?>" disabled>حذف کردن</a>
				</td>
			</tr>
			<?php } ?>
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
