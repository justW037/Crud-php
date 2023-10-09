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
    <link rel="stylesheet" href="./css/layout.css">
    <link rel="stylesheet" href="./bootstrap-5.3.2/css/bootstrap.min.css">
</head>

<body>
    <div class="sidebar">
        <h2>H-zone</h2>
        <ul>
            <li><a href="index.php?page_layout=danhmuc">Quản lý danh mục</a></li>
            <li><a href="index.php?page_layout=sanpham">Quản lý sản phẩm</a></li>
            <li><a href="index.php?page_layout=nguoidung">Quản lý thành viên</a></li>
        </ul>
    </div>
</body>



</html>

<?php
include './danhmuc/classdanhmuc.php';
include './sanpham/classsanpham.php';
include './nguoidung/classuser.php';
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
    case 'nguoidung':
      include_once 'nguoidung/nguoidung.php';
      break;
    case 'themnguoidung':
        include_once 'nguoidung/themnguoidung.php';
    break;
    case 'suanguoidung':
        include_once 'nguoidung/suanguoidung.php';
    break;
    default:
      include_once 'index.php';
  }
} else {
  echo "<h1>Trang bán thiết bị điện tử H-zone";
}
?>