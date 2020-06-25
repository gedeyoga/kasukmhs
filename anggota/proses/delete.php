<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_GET['id']) && ($_SESSION['nim'] != $_GET['id'])) {
		$fetch = mysqli_query($conn , "DELETE FROM mahasiswa WHERE nimMhs = ".$_GET['id']);
		if ($fetch) {
			$fetch = mysqli_query($conn , "DELETE FROM users WHERE nimMhs = ".$_GET['id']);
			setFlashMessage('Data berhasil dihapus' , 'anggota/index.php');
		}else{
			setFlashMessage('Data tidak bisa dihapus oleh sistem' , 'anggota/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>