<?php 
	include "../../config.php";
	include "../../helper/alert.php";
	if (isset($_POST['submit'])) {
		$nimMhs = mysqli_real_escape_string($conn , $_POST['nimMhs']);
		$bulanByr = mysqli_real_escape_string($conn , $_POST['bulanByr']);
		$tglByr = mysqli_real_escape_string($conn , $_POST['tglByr']);
		$jumlahByr = mysqli_real_escape_string($conn , $_POST['jumlahByr']);

		if (trim($nimMhs) && trim($bulanByr) && trim($tglByr) && is_numeric($jumlahByr)) {
			$fetch = mysqli_query($conn , "INSERT INTO pembayaran VALUES (NULL , '$nimMhs' , '$jumlahByr' , '$bulanByr' , '$tglByr');");
			if ($fetch) {
				setFlashMessage('Berhasil bayar uang kas !' , 'kasukm/index.php');
			}else{
				setFlashMessage('Gagal bayar uang kas !' , 'kasukm/index.php');
			}
		}else{
			setFlashMessage('Periksa data pembayaran kembali ! !' , 'kasukm/index.php');
		}
	}else{
		header('location: ../index.php');
	}

 ?>