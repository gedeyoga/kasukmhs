<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_POST['submit'])) {
		$nimMhs = mysqli_real_escape_string($conn , $_POST['nimMhs']);
		$namaMhs = mysqli_real_escape_string($conn , $_POST['namaMhs']);
		$tglLahirMhs = mysqli_real_escape_string($conn , $_POST['tglLahirMhs']);
		$jkMhs = mysqli_real_escape_string($conn , $_POST['jkMhs']);
		$telpMhs = mysqli_real_escape_string($conn , $_POST['telpMhs']);
		$emailMhs = mysqli_real_escape_string($conn , $_POST['emailMhs']);
		$idJbtn = mysqli_real_escape_string($conn , $_POST['idJbtn']);
		$idJrs = mysqli_real_escape_string($conn , $_POST['idJrs']);


		if (trim($nimMhs) && trim($namaMhs) && is_numeric($jkMhs) && is_numeric($telpMhs) && trim($emailMhs) && is_numeric($idJbtn) && is_numeric($idJrs) && trim($tglLahirMhs)) {
			$fetch = mysqli_query($conn , "INSERT INTO mahasiswa VALUES ('$nimMhs' , '$namaMhs' , '$tglLahirMhs' , '$jkMhs' , '$telpMhs' , '$emailMhs' , '$idJbtn' , '$idJrs');");
			if ($fetch) {
				setFlashMessage('Data berhasil ditambahkan !' , 'anggota/index.php');
			}else{
				setFlashMessage('Data gagal ditambahkan !' , 'anggota/index.php');
			}
		}else{
			setFlashMessage('Silahkan periksa data anda !' , 'anggota/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>