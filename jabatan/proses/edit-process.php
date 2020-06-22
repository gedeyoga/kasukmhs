<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_POST['submit'])) {
		$idJbtn = mysqli_real_escape_string($conn , $_POST['idJbtn']);
		$namaJbtn = mysqli_real_escape_string($conn , $_POST['namaJbtn']);
		if (trim($namaJbtn) && is_string($namaJbtn)) {
			$fetch = mysqli_query($conn , "UPDATE jabatan SET namaJbtn = '$namaJbtn' WHERE idJbtn = '$idJbtn';");
			if ($fetch) {
				setFlashMessage('Data berhasil diperbaharui !' , 'jabatan/index.php');
			}else{
				setFlashMessage('Data gagal diperbaharui oleh sistem !' , 'jabatan/index.php');
			}
		}else{
			setFlashMessage('Data tidak boleh mengandung angka !' , 'jabatan/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>