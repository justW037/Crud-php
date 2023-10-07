<?php  
	session_start();
	if($_SESSION['level'] == 2){
		$id_dm = $_GET['id_dm'];
		$conn = mysqli_connect('localhost', 'root', '', 'nguoidung');
		$sql= "DELETE FROM danhmuc WHERE id_dm='$id_dm'";
		$query= mysqli_query($conn,$sql);
		header('Location: ../index.php?page_layout=danhmuc');
	}else{
		header('location: index.php');
	}
?>