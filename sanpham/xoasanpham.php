<?php  
	session_start();
	if($_SESSION['level'] == 2){
		$id_sp = $_GET['id_sp'];
		$conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
		$sql= "DELETE FROM sanpham WHERE id_sp='$id_sp'";
		$query= mysqli_query($conn,$sql);
		header('Location: ../index.php?page_layout=sanpham');
	}else{
		header('location: index.php');
	}
?>