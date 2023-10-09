<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
</head>

<body>
    <div class="main">
        <h1>Quản lý sản phẩm</h1>
        <div class="info">
            <a href="index.php?page_layout=themsanpham" class="btn btn-success">Thêm sản phẩm</a>
            <div class="search-filter">
                <form action="" method="POST">
                    <input type="text" name="search" placeholder="Tìm kiếm sản phẩm" class="form-control mr-sm-2">
                    <button type="submit" name="search-submit" class="btn btn-outline-success my-2 my-sm-0">Tìm
                        kiếm</button>
                </form>
            </div>
            <div class="dropdown">
                <form method="post" action="">
                    <label for="id_dm" style="margin-top:5px">Lọc sản phẩm:</label>
                    <div class="btn btn-light" style="padding: 0px;">
                        <select id="id_dm" name="id_dm" class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" required>
                            <option value="unselect" selected>Tất cả</option>
                            <?php
                            $danhsachdanhmuc = new Danhmuc($conn);
                            $danhMucList = $danhsachdanhmuc->layDanhSachDanhMuc();
                            foreach ($danhMucList as $danhMuc) {
                            ?>
                                <option value="<?php echo $danhMuc['id_dm']; ?>"><?php echo $danhMuc['tendm']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="loc" value="Lọc" class="btn btn-secondary">
                </form>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $danhSachSanPham = new Sanpham($conn);
                $sanPhamList = $danhSachSanPham->layDanhSachSanPham();
                if (isset($_POST['loc'])) {
                    $id_dm = $_POST['id_dm'];
                    if ($id_dm == 'unselect') {
                        $sanPhamList = $danhSachSanPham->layDanhSachSanPham();
                    } else {
                        $sanPhamList = $danhSachSanPham->locSanPham($id_dm);
                    }
                }
                if (isset($_POST['search-submit'])) {
                    $search = $_POST['search'];
                    $sanPhamList = $danhSachSanPham->timKiemSanPham($search);
                }
                foreach ($sanPhamList as $sanPham) {
                ?>
                    <tr>
                        <td><?php echo $sanPham['id_sp']; ?></td>
                        <td><?php echo $sanPham['tensp']; ?></td>
                        <td><?php echo $sanPham['tendm']; ?></td>
                        <td><img width="auto" height="150px" src="sanpham/uploads/<?php echo $sanPham['anhsp']; ?>"></img>
                        </td>
                        <td><?php echo number_format($sanPham['giasp']); ?> VNĐ</td>
                        <td><?php echo $sanPham['des']; ?></td>
                        <td><a href="index.php?page_layout=suasanpham&id_sp=<?php echo $sanPham['id_sp']; ?>" class="btn btn-primary">Sửa</a></td>
                        <td>
                            <a onclick="return xacNhanXoa();" href="sanpham/xoasanpham.php?id_sp=<?php echo $sanPham['id_sp']; ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</body>
<script src="../js/app.js"></script>

</html>