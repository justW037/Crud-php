<?php  
	session_start();
	include './classsanpham.php';
	if($_SESSION['level'] == 2){
		$id_sp = $_GET['id_sp'];
		$conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
		$sanPham = new Sanpham($conn);
		$result = $sanPham->xoaSanPham($id_sp);
		if ($result) {
		header('Location: ../index.php?page_layout=sanpham');
		}
	}else{
		header('location: index.php');
	}
?>