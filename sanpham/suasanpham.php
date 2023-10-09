<?php
$id_sp = $_GET['id_sp'];

$sanPham = new Sanpham($conn);
$row = $sanPham->laySanPham($id_sp);

if (isset($_POST['submit'])) {
    $tensp = $_POST['tensp'];
    $giasp = $_POST['giasp'];
    $des = $_POST['des'];
    $save_anhsp = $row['anhsp'];

    if ($_FILES['anhsp']['name'] !== '') {
        $anhsp = $_FILES['anhsp']['name'];
        $tmp_name = $_FILES['anhsp']['tmp_name'];
        $upload_directory = 'sanpham/uploads/';

        if (!move_uploaded_file($tmp_name, $upload_directory . $anhsp)) {
            echo "Đã xảy ra lỗi khi lưu file ảnh.";
        }
    }
    else {
        $anhsp = $save_anhsp;
    }
    if ($_POST['id_dm'] == 'unselect') {
        $error_id_dm = '<span style="color: red;">(*)</span>';
    } else {
        $id_dm = $_POST['id_dm'];
    }
    if (isset($tensp) && isset($giasp) && isset($anhsp) && isset($id_dm)) {
        $result = $sanPham->checkTonTai($tensp,$anhsp);
        if($result){
          echo "<h1>Sản phẩm đã tồn tại</h1>";
        }
        else {
          $result2 = $sanPham->suaSanPham($id_sp,$tensp,$giasp,$anhsp,$id_dm,$des);
          if ($result2) {
            header('Location: ./index.php?page_layout=sanpham');
            exit;
          } else {
            echo "Đã xảy ra lỗi khi thêm mới sản phẩm: " . mysqli_error($conn);
          }
        }
    }
}
?>

<div class="main">
    <div class="header1">
        <div>
            <h1>Sửa sản phẩm</h1>
        </div>
    </div>
    <div class="container">
        <form method="post" enctype="multipart/form-data" class="container-form">
            <a href="./index.php?page_layout=sanpham"><button type="button" class="btn btn-dark">Quay
                    lại</button></a>
            <div class="form-group">
                <label for="tensp">Tên sản phẩm</label>
                <input type="text" value="<?php echo $row['tensp'] ?>" id="tensp" class="form-control" name="tensp"
                    required>
            </div>

            <div class="form-group">
                <label for="giasp">Giá sản phẩm</label>
                <input type="text" value="<?php echo $row['giasp'] ?>" id="giasp" class="form-control" name="giasp"
                    required>
            </div>

            <div class="form-group">
                <label for="giasp">Mô tả sản phẩm</label>
                <input type="text" value="<?php echo $row['des'] ?>" id="giasp" class="form-control" name="des"
                    required>
            </div>

            <div class="form-group">
                <label for="danhmuc">Danh mục</label>
                <select id="id_dm" name="id_dm" class="btn btn-light dropdown-toggle" type="button"
                    data-toggle="dropdown" required>
                    <?php
                            $danhsachdanhmuc = new Danhmuc($conn);
                            $danhMucList = $danhsachdanhmuc->layDanhSachDanhMuc();
                            foreach ( $danhMucList as $danhMuc) { 
                            ?>
                    <option value="<?php echo $danhMuc['id_dm']; ?>"><?php echo $danhMuc['tendm']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="anhsp">Ảnh sản phẩm</label>
                <input type="file" id="anhsp" name="anhsp">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Lưu</button>
        </form>
    </div>
</div>