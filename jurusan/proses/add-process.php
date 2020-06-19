<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_POST['submit'])) {
		$namaJrs = mysqli_real_escape_string($conn , $_POST['namaJrs']);
		if (trim($namaJrs) && is_string($namaJrs)) {
			$fetch = mysqli_query($conn , "INSERT INTO jurusan VALUES (NULL , '$namaJrs');");
			if ($fetch) {
				setFlashMessage('Data berhasil ditambahkan !' , 'jurusan/index.php');
			}else{
				setFlashMessage('Data gagal ditambahkan !' , 'jurusan/index.php');
			}
		}else{
			setFlashMessage('Data tidak boleh mengandung angka !' , 'jurusan/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>