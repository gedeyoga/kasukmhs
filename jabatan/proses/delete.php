<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_GET['id'])) {
		$fetch = mysqli_query($conn , "DELETE FROM jabatan WHERE idJbtn = ".$_GET['id']);
		if ($fetch) {
			setFlashMessage('Data berhasil dihapus' , 'jabatan/index.php');
		}else{
			setFlashMessage('Data tidak bisa dihapus oleh sistem' , 'jabatan/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>