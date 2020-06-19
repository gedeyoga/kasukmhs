<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_POST['submit'])) {
		$idJrs = mysqli_real_escape_string($conn , $_POST['idJrs']);
		$namaJrs = mysqli_real_escape_string($conn , $_POST['namaJrs']);
		if (trim($namaJrs) && is_string($namaJrs)) {
			$fetch = mysqli_query($conn , "UPDATE jurusan SET namaJrs = '$namaJrs' WHERE idJrs = '$idJrs';");
			if ($fetch) {
				setFlashMessage('Data berhasil diperbaharui !' , 'jurusan/index.php');
			}else{
				setFlashMessage('Data gagal diperbaharui oleh sistem !' , 'jurusan/index.php');
			}
		}else{
			setFlashMessage('Data tidak boleh mengandung angka !' , 'jurusan/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>