<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap-5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/layout.css">
</head>

<body>
    <form method="POST" action="" class="form-group" id="login-form">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" class="form-control" required>
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" class="form-control" required>
        <button type="submit" id="button" class="btn btn-primary">Đăng nhập</button>
    </form>

</body>

</html>
<?php
    session_start();
    include './nguoidung/classuser.php';
    $conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = new User($conn);
        $login = $user->login($username,$password);
    }
    mysqli_close($conn);
?>