<?php
$id_sp = $_GET['id_sp'];
$sqldm = "SELECT * FROM danhmuc";
$querydm = mysqli_query($conn, $sqldm);

$sql = "SELECT * FROM sanpham WHERE id_sp='$id_sp' LIMIT 1";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {
    $tensp = $_POST['tensp'];
    $giasp = $_POST['giasp'];
    $save_anhsp = $row['anhsp'];

    if ($_FILES['anhsp']['name'] !== '') {
        $anhsp = $_FILES['anhsp']['name'];
        $tmp_name = $_FILES['anhsp']['tmp_name'];
        $upload_directory = 'sanpham/uploads/';

        if (move_uploaded_file($tmp_name, $upload_directory . $anhsp)) {
            // File upload was successful
        } else {
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
        // Include your database insert logic here
        $sql = "UPDATE sanpham SET tensp='$tensp', giasp='$giasp', anhsp='$anhsp', id_dm='$id_dm' WHERE id_sp='$id_sp'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            header('Location: ./index.php?page_layout=sanpham');
            exit;
        } else {
            echo "Đã xảy ra lỗi khi sửa sản phẩm: " . mysqli_error($conn);
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
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tensp">Tên sản phẩm</label>
                <input type="text" value="<?php echo $row['tensp'] ?>" id="tensp" class="form-control" name="tensp" required>
            </div>

            <div class="form-group">
                <label for="giasp">Giá sản phẩm</label>
                <input type="text" value="<?php echo $row['giasp'] ?>" id="giasp" class="form-control" name="giasp" required>
            </div>

            <div class="form-group">
                <label for="danhmuc">Danh mục</label>
                <select id="id_dm" name="id_dm" class="form-control" required>
                    <option value="unselect" selected>Chọn danh mục</option>
                    <?php
                    while ($rowdm = mysqli_fetch_array($querydm)) {
                    ?>
                        <option <?php
                                if ($row['id_dm'] == $rowdm['id_dm']) {
                                    echo 'selected="selected"';
                                } ?> value="<?php echo $rowdm['id_dm']; ?>"><?php echo $rowdm['tendm']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="anhsp">Ảnh sản phẩm</label>
                <input type="file" id="anhsp" name="anhsp">
            </div>
            <button type="submit" class="btn" name="submit">Sửa</button>
        </form>
    </div>
</div>

<style>
    .main {
        margin-left: 250px;
        padding: 20px;
    }

    .header {
        display: none;
    }

    .main-body {
        display: none;
    }

    .main .header1 {
        background-color: #f2f2f2;
        padding: 10px;
    }

    .container {
        float: left;
        max-width: 500px;
        margin: 10px auto;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    select.form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    select option {
        height: 40px;
    }

    .btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>