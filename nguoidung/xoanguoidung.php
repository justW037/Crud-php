<?php  
	session_start();
	include './classuser.php';
	if($_SESSION['level'] == 2){
		$id = $_GET['id'];
		$conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
		$nguoiDung = new User($conn);
		$result = $nguoiDung->xoaNguoiDung($id);
		if ($result) {
		header('Location: ../index.php?page_layout=nguoidung');
		}
	}else{
		header('location: index.php');
	}
?>