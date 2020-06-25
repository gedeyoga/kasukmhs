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
			$query = "UPDATE mahasiswa SET 
					  namaMhs = '$namaMhs',
					  tglLahirMhs = '$tglLahirMhs',
					  jkMhs = '$jkMhs',
					  telpMhs = '$telpMhs',
					  emailMhs = '$emailMhs',
					  idJbtn = '$idJbtn',
					  idJrs = '$idJrs'
					  WHERE nimMhs = '$nimMhs'
			";
			$fetch = mysqli_query($conn , $query);
			if ($fetch) {
				$idRole = ($idJbtn != 7) ? "1" : "2";

				$fetch = mysqli_query($conn , "UPDATE users SET idRole = '$idRole' WHERE nimMhs = '$nimMhs'");
				setFlashMessage('Data berhasil diubah !' , 'anggota/index.php');
			}else{
				setFlashMessage('Data gagal diubah !' , 'anggota/index.php');
			}
		}else{
			setFlashMessage('Silahkan periksa data anda !' , 'anggota/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>