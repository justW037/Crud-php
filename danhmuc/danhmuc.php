<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
</head>

<body>
    <div class="main">
        <h1>Quản lý danh mục</h1>
        <a href="index.php?page_layout=themdanhmuc" class="btn btn-success">Thêm danh mục</a>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $danhsachdanhmuc = new Danhmuc($conn);
                    $danhMucList = $danhsachdanhmuc->layDanhSachDanhMuc();
                    foreach ($danhMucList as $danhMuc) {
                    ?>
                    <tr>
                        <td><?php echo $danhMuc['id_dm']; ?></td>
                        <td><?php echo $danhMuc['tendm']; ?></td>
                        <td>
                            <a href="index.php?page_layout=suadanhmuc&id_dm=<?php echo $danhMuc['id_dm']; ?>"
                                class='btn btn-primary'>Sửa</a>
                        </td>
                        <td>
                            <a onclick="return xacNhanXoa()"
                                href="./danhmuc/xoadanhmuc.php?id_dm=<?php echo $danhMuc['id_dm']; ?>"
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