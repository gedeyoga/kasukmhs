<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_POST['submit'])) {
		$namaJbtn = mysqli_real_escape_string($conn , $_POST['namaJbtn']);
		if (trim($namaJbtn) && is_string($namaJbtn)) {
			$fetch = mysqli_query($conn , "INSERT INTO jabatan VALUES (NULL , '$namaJbtn');");
			if ($fetch) {
				setFlashMessage('Data berhasil ditambahkan !' , 'jabatan/index.php');
			}else{
				setFlashMessage('Data gagal ditambahkan !' , 'jabatan/index.php');
			}
		}else{
			setFlashMessage('Data tidak boleh mengandung angka !' , 'jabatan/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>