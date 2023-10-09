<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="main">
        <h1>Quản lý người dùng</h1>
        <div class="container">
            <a href="index.php?page_layout=themnguoidung" class="btn btn-success">Thêm người dùng</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Quyền</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $danhsachnguoidung = new User($conn);
                    $nguoiDungList = $danhsachnguoidung->layDanhSachNguoiDung();
                    foreach ($nguoiDungList as $nguoiDung) {
                    ?>
                    <tr>
                        <td><?php echo $nguoiDung['id']; ?></td>
                        <td><?php echo $nguoiDung['username']; ?></td>
                        <td>
                            <?php
                            if ($nguoiDung['level'] == 2) {
                                echo "Admin";
                            } elseif ($nguoiDung['level'] == 1) {
                                echo "Khách hàng";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="index.php?page_layout=suanguoidung&id=<?php echo $nguoiDung['id']; ?>"
                                class='btn btn-primary'>Sửa</a>
                        </td>
                        <td>
                            <a onclick="return xacNhanXoa()"
                                href="./nguoidung/xoanguoidung.php?id=<?php echo $nguoiDung['id']; ?>"
                                class='btn btn-danger'>Xóa</a>

                        </td>
                    </tr>
                    <?php
                    }
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="../js/app.js"></script>

</html>