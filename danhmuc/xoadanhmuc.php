<?php  
	session_start();
	include './classdanhmuc.php';
	if($_SESSION['level'] == 2){
		$id_dm = $_GET['id_dm'];
		$conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
		$danhMuc = new Danhmuc($conn);
		$result = $danhMuc->xoaDanhMuc($id_dm);
		if ($result) {
		header('Location: ../index.php?page_layout=danhmuc');
		}
	}else{
		header('location: index.php');
	}
?>