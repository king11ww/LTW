<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sữa</title>
</head>
<body>
    <div id="thong-tin-sua" >
        <table border="1">
            <h1>THÔNG TIN SỮA</h1>
            <tr>
                <td>ID</td>
                <td>Tên khách hàng</td>
                <td>Giới tính</td>
                <td>Địa chỉ</td>
                <td>Số địa chỉ</td>
                <td>Email</td>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td><a href="capnhat.php?khoa=<?php echo $row['id']; ?>">Cập nhật</a> </td>
				<td>
					<a href="xoa.php?khoa=<?php echo $row['id']; ?>" 
                    onclick = "confirm('Bạn có chắc chắn muốn xóa hay không')">Xóa</a> 
				</td>
            </tr>
        </table>
        <button><a href="them-sua.php">Thêm</a></button>
    </div>
</body>
</html>