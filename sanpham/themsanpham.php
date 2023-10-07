<div class="main">
    <?php
  $sqldm = "SELECT * FROM danhmuc";
  $querydm = mysqli_query($conn, $sqldm);
  if (isset($_POST['submit'])) {
    $tensp = $_POST['tensp'];
    $giasp = $_POST['giasp'];
    $anhsp = $_FILES['anhsp']['name'];
    $tmp_name = $_FILES['anhsp']['tmp_name'];
    $upload_directory = 'sanpham/uploads/';
    if (move_uploaded_file($tmp_name, $upload_directory . $anhsp)) {
    } else {
      echo "Đã xảy ra lỗi khi lưu file ảnh.";
    }
    if ($_POST['id_dm'] == 'unselect') {
      $error_id_dm = '<span style="color: red;">(*)</span>';
    } else {
      $id_dm = $_POST['id_dm'];
    }

    if (isset($tensp) && isset($giasp) && isset($anhsp) && isset($id_dm)) {
      // Include your database insert logic here
      $sql = "INSERT INTO sanpham(tensp, giasp, anhsp, id_dm) VALUES ('$tensp', '$giasp', '$anhsp', '$id_dm')";
      $query = mysqli_query($conn, $sql);
      if ($query) {
        header('Location: ./index.php?page_layout=sanpham');
        exit;
      } else {
        echo "Đã xảy ra lỗi khi thêm mới sản phẩm: " . mysqli_error($conn);
      }
    }
  }
  ?>
    <div class="header1">
        <div>
            <h1>Thêm sản phẩm</h1>
        </div>
    </div>
    <div class="container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tensp">Tên sản phẩm</label>
                <input type="text" id="tensp" class="form-control" name="tensp" required>
            </div>

            <div class="form-group">
                <label for="giasp">Giá sản phẩm</label>
                <input type="text" id="giasp" class="form-control" name="giasp" required>
            </div>

            <div class="form-group">
                <label for="danhmuc">Danh mục</label>
                <select id="id_dm" name="id_dm" class="form-control" required>
                    <option value="unselect" selected>Chọn danh mục</option>
                    <?php
          while ($rowdm = mysqli_fetch_array($querydm)) {
          ?>
                    <option value="<?php echo $rowdm['id_dm']; ?>"><?php echo $rowdm['tendm']; ?></option>
                    <?php
          }
          ?>
                </select>
            </div>

            <div class="form-group">
                <label for="anhsp">Ảnh sản phẩm</label>
                <input type="file" id="anhsp" name="anhsp">
            </div>
            <button type="submit" class="btn" name="submit">Thêm mới</button>
        </form>
    </div>
</div>