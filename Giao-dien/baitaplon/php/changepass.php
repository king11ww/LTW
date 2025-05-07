<?php
session_start();
require_once('../../../ket-noi-co-so-du-lieu.php');

if (!isset($_SESSION['id'])) {
	header("Location: batdau.php");
	exit();
}

$thong_bao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
	$id = $_SESSION['id'];
	$mat_khau_cu = $_POST['old_password'];
	$mat_khau_moi = $_POST['new_password'];
	$xac_nhan = $_POST['confirm_password'];

	$sql = "SELECT mat_khau FROM khachhang WHERE id='$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if ($row['mat_khau'] != $mat_khau_cu) {
		$thong_bao = "Mật khẩu cũ không đúng.";
	} elseif ($mat_khau_moi != $xac_nhan) {
		$thong_bao = "Mật khẩu xác nhận không khớp.";
	} else {
		$update = mysqli_query($conn, "UPDATE khachhang SET mat_khau='$mat_khau_moi' WHERE id='$id'");
		if ($update) {
			$_SESSION['doi-mat-khau-thanh-cong'] = "Đổi mật khẩu thành công.";
			header("Location: user.php");
			exit();
		} else {
			$thong_bao = "Đổi mật khẩu thất bại.";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Đổi Mật Khẩu</title>
	<link rel="stylesheet" href="../css/user.css">
	<style>
		.change-password-form {
			max-width: 400px;
			margin: 50px auto;
			padding: 20px;
			background-color: #f5f5f5;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
		}
		.change-password-form input {
			width: 100%;
			padding: 10px;
			margin: 10px 0;
			border-radius: 5px;
			border: 1px solid #ccc;
		}
		.change-password-form button {
			background-color: #28a745;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		.change-password-form button:hover {
			background-color: #218838;
		}
		.alert {
			color: red;
			font-weight: bold;
			margin: 10px 0;
		}
	</style>
</head>
<body>
	<div class="change-password-form">
		<h2>Đổi mật khẩu</h2>
		<?php if ($thong_bao): ?>
			<div class="alert"><?php echo $thong_bao; ?></div>
		<?php endif; ?>
		<form method="post">
			<input type="password" name="old_password" placeholder="Mật khẩu hiện tại" required>
			<input type="password" name="new_password" placeholder="Mật khẩu mới" required>
			<input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required>
			<button type="submit" name="save">Lưu thay đổi</button>
		</form>
		<br>
		<a href="user.php">← Quay lại trang cá nhân</a>
	</div>
</body>
</html>
