<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.2/css/bootstrap.min.css">
    <title>Document</title>
    <style>

    </style>
</head>

<body>
    <div class="main">
        <div class="header1">
            <div>
                <h1>Thêm người dùng</h1>
            </div>
        </div>
        <form method="POST" action="" class="form-group">
            <a href="./index.php?page_layout=nguoidung"><button type="button" class="btn btn-dark"
                    style="margin-bottom: 20px;">Quay
                    lại</button></a><br>
            <label for="username">Tên người dùng:</label>
            <input type="text" name="username" class="form-control" required><br>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" class="form-control" required><br>

            <label for="confirm_password">Xác nhận mật khẩu:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required><br>

            <label>Chọn quyền:</label><br>
            <div class="radio">
                <input type="radio" id="user" name="level" value="1" required>
                <label for="user">User</label><br>
            </div>

            <div class="radio">
                <input type="radio" id="admin" name="level" value="2" required>
                <label for="admin">Admin</label><br>
            </div>



            <input type="submit" name="add_new" value="Thêm mới" class="btn btn-primary">
        </form>
    </div>
    <script src="../js/app.js"></script>

</body>

</html>

<?php
    if (isset($_POST['add_new'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];
        $nguoiDung = new User($conn);
        $result = $nguoiDung->checkTontai($username);
        if($result){
            echo "<h1>Người dùng đã tồn tại.</h1>";
        }
        else {
            $result2 = $nguoiDung->themNguoiDung($username,$password,$level);
            if ($result2) {
            header('Location: ./index.php?page_layout=nguoidung');
            exit;
            }
        }
    }
?>