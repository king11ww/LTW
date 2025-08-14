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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đổi Mật Khẩu</title>
	<link rel="stylesheet" href="../css/header_footer.css">
	<script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
	<style>
		body {
			background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
			font-family: 'Courier New', Courier, monospace;
			min-height: 100vh;
			margin: 0;
			padding: 0;
		}

		.change-password-container {
			max-width: 500px;
			margin: 50px auto;
			padding: 0 20px;
		}

		.change-password-card {
			background: white;
			border-radius: 20px;
			box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
			overflow: hidden;
			border: 1px solid #e2e8f0;
		}

		.card-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			padding: 30px;
			text-align: center;
			color: white;
		}

		.card-header h2 {
			margin: 0;
			font-size: 24px;
			font-weight: 600;
		}

		.card-header p {
			margin: 10px 0 0 0;
			opacity: 0.9;
			font-size: 14px;
		}

		.card-body {
			padding: 40px;
		}

		.form-group {
			margin-bottom: 25px;
		}

		.form-group label {
			display: block;
			margin-bottom: 8px;
			font-weight: 600;
			color: #1e293b;
			font-size: 14px;
		}

		.form-group input {
			width: 100%;
			padding: 15px;
			border: 2px solid #e2e8f0;
			border-radius: 12px;
			font-size: 16px;
			transition: all 0.3s ease;
			background: #f8fafc;
			box-sizing: border-box;
		}

		.form-group input:focus {
			outline: none;
			border-color: #667eea;
			background: white;
			box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
		}

		.form-group input::placeholder {
			color: #94a3b8;
		}

		.alert {
			padding: 15px;
			border-radius: 12px;
			margin-bottom: 25px;
			font-weight: 600;
			font-size: 14px;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.alert.error {
			background: #fef2f2;
			color: #dc2626;
			border: 1px solid #fecaca;
		}

		.alert.success {
			background: #f0fdf4;
			color: #16a34a;
			border: 1px solid #bbf7d0;
		}

		.btn-primary {
			width: 100%;
			padding: 15px;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			border: none;
			border-radius: 12px;
			font-size: 16px;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-bottom: 20px;
		}

		.btn-primary:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
		}

		.btn-secondary {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			padding: 12px 20px;
			background: #e2e8f0;
			color: #64748b;
			text-decoration: none;
			border-radius: 10px;
			font-weight: 600;
			font-size: 14px;
			transition: all 0.3s ease;
		}

		.btn-secondary:hover {
			background: #cbd5e1;
			transform: translateY(-2px);
		}

		.password-requirements {
			background: #f8fafc;
			border: 1px solid #e2e8f0;
			border-radius: 12px;
			padding: 20px;
			margin-bottom: 25px;
		}

		.password-requirements h4 {
			margin: 0 0 15px 0;
			color: #1e293b;
			font-size: 16px;
			font-weight: 600;
		}

		.requirements-list {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		.requirements-list li {
			display: flex;
			align-items: center;
			gap: 8px;
			margin-bottom: 8px;
			color: #64748b;
			font-size: 14px;
		}

		.requirements-list li i {
			color: #667eea;
			font-size: 12px;
		}

		@media (max-width: 768px) {
			.change-password-container {
				margin: 30px auto;
				padding: 0 15px;
			}

			.card-header {
				padding: 25px 20px;
			}

			.card-body {
				padding: 30px 20px;
			}

			.card-header h2 {
				font-size: 20px;
			}
		}
	</style>
</head>
<body>
	<div class="change-password-container">
		<div class="change-password-card">
			<div class="card-header">
				<h2><i class="fa-solid fa-key"></i> Đổi mật khẩu</h2>
				<p>Bảo mật tài khoản của bạn</p>
			</div>
			<div class="card-body">
				<?php if ($thong_bao): ?>
					<div class="alert error">
						<i class="fa-solid fa-exclamation-triangle"></i>
						<?php echo $thong_bao; ?>
					</div>
				<?php endif; ?>

				<div class="password-requirements">
					<h4><i class="fa-solid fa-shield-alt"></i> Yêu cầu mật khẩu</h4>
					<ul class="requirements-list">
						<li><i class="fa-solid fa-check"></i> Ít nhất 6 ký tự</li>
						<li><i class="fa-solid fa-check"></i> Nên có chữ hoa và chữ thường</li>
						<li><i class="fa-solid fa-check"></i> Nên có số và ký tự đặc biệt</li>
					</ul>
				</div>

				<form method="post">
					<div class="form-group">
						<label for="old_password">Mật khẩu hiện tại</label>
						<input type="password" name="old_password" id="old_password" placeholder="Nhập mật khẩu hiện tại" required>
					</div>
					
					<div class="form-group">
						<label for="new_password">Mật khẩu mới</label>
						<input type="password" name="new_password" id="new_password" placeholder="Nhập mật khẩu mới" required>
					</div>
					
					<div class="form-group">
						<label for="confirm_password">Xác nhận mật khẩu mới</label>
						<input type="password" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu mới" required>
					</div>
					
					<button type="submit" name="save" class="btn-primary">
						<i class="fa-solid fa-save"></i>
						Lưu thay đổi
					</button>
				</form>
				
				<a href="user.php" class="btn-secondary">
					<i class="fa-solid fa-arrow-left"></i>
					Quay lại trang cá nhân
				</a>
			</div>
		</div>
	</div>
</body>
</html>
