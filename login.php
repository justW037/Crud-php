<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap-5.3.2/css/bootstrap.min.css">
</head>

<body>
    <form method="POST" action="" class="form-group">
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
    $conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $username;

            echo "đăng nhập thành công";
            if ($row['level'] == 2) {
                $_SESSION['level'] = 2;
               header("Location: index.php"); 
            } else {
                header("Location: userPage.php");
            }
        } else {
            echo "Tên đăng nhập hoặc mật khẩu không đúng.";
        }
    }
    mysqli_close($conn);
?>