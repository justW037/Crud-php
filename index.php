<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
if (!$conn) {
  die("Không thể kết nối: " . mysqli_connect_error());
}
if (!isset($_SESSION['userid'])) {
  header('location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <style>
    /* CSS cho thanh slidebar */
    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #f1f1f1;
        position: fixed;
        top: 0;
        left: 0;
        overflow-x: hidden;
        padding-top: 20px;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
        padding-bottom: 20px;
        text-transform: uppercase;
        font-size: 20px;
        border-bottom: 1px solid #000;
    }

    .sidebar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .sidebar li {
        padding: 10px;
        font-size: 18px;

    }

    .sidebar li:hover {
        background-color: #ddd;
        cursor: pointer;
    }

    a {
        text-decoration: none;
    }

    .sidebar h2 a {
        color: #000;
    }

    .sidebar li a {
        color: #000;
        display: block;
    }

    .main {
        margin-left: 250px;
    }

    .header {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Trang quản trị</h2>
        <ul>
            <li><a href="index.php?page_layout=danhmuc">Quản lý danh mục</a></li>
            <li><a href="index.php?page_layout=sanpham">Quản lý sản phẩm</a></li>
            <li><a href="index.php?page_layout=thongtin">Quản lý thành viên</a></li>
        </ul>
    </div>
</body>



</html>

<?php
include './danhmuc/classdanhmuc.php';
if (isset($_GET['page_layout'])) {
  switch ($_GET['page_layout']) {
    case 'danhmuc':
      include_once 'danhmuc/danhmuc.php';
      break;
    case 'suadanhmuc':
      include_once 'danhmuc/suadanhmuc.php';
      break;
    case 'themdanhmuc':
      include_once 'danhmuc/themdanhmuc.php';
      break;
    case 'sanpham':
      include_once 'sanpham/sanpham.php';
      break;
    case 'themsanpham':
      include_once 'sanpham/themsanpham.php';
      break;
    case 'suasanpham':
      include_once 'sanpham/suasanpham.php';
      break;
    case 'locsanpham':
      include_once 'sanpham/locsanpham.php';
      break;
    case 'timkiemsp':
      include_once 'sanpham/timkiemsanpham.php';
      break;
    case 'thongtin':
      include_once 'nguoidung/thongtin.php';
      break;
    default:
      include_once 'index.php';
  }
} else {
  echo "Xảy ra lỗi!";
}
?>