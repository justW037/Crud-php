<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap-5.3.2/css/bootstrap.min.css">
</head>

<body>
    <form action="login.php" method="post">
        Username: <input type="text" name="username" size="25" /><br />
        Password: <input type="password" name="password" size="25" /><br />
        <input type="submit" name="ok" value="Đăng nhập" class="btn btn-primary" />
    </form>

</body>

</html>
<?php
session_start();

if (isset($_POST['ok'])) {
    $u = $p = "";

    if ($_POST['username'] == "") {
        echo "Vui lòng nhập tài khoản.<br />";
    } else {
        $u = $_POST['username'];
    }

    if ($_POST['password'] == "") {
        echo "Vui lòng nhập mật khẩu.<br />";
    } else {
        $p = $_POST['password'];
    }

    if (!empty($u) && !empty($p)) {
        $conn = mysqli_connect("localhost", "root", "", "nguoidung") or die("Không thể kết nối đến cơ sở dữ liệu.");
        $u = mysqli_real_escape_string($conn, $u);
        $p = mysqli_real_escape_string($conn, $p);

        $sql = "SELECT * FROM users WHERE username='" . $u . "' AND password='" . $p . "'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            if (mysqli_num_rows($query) == 0) {
                echo "<p>Tài khoản hoặc mật khẩu không đúng.</p>";
            } else {
                $row = mysqli_fetch_assoc($query);
                $_SESSION['userid'] = $row['id'];
                $_SESSION['level'] = $row['level'];
                echo "Đăng nhập thành công!";
                header('Location: index.php');
                exit();
            }
        } else {
            echo "Lỗi truy vấn: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>