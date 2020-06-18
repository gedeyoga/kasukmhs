<?php 
	include "config.php";
	include 'helper/alert.php';

	if(isset($_POST['submit'])){
		$nimMhs = mysqli_real_escape_string($conn , $_POST['nimMhs']);
		$passUsers = mysqli_real_escape_string($conn , $_POST['passUsers']);

		if(trim($nimMhs) && trim($passUsers)){
			if (is_numeric($nimMhs)) {
				$query = "
					SELECT users.* , mahasiswa.namaMhs FROM users 
					JOIN mahasiswa ON users.nimMhs = mahasiswa.nimMhs
					WHERE users.nimMhs = '$nimMhs' AND users.passUsers = '$passUsers'";
				$fetch = mysqli_query($conn , $query);
				if (mysqli_num_rows($fetch) > 0) {
					$dataUsers = mysqli_fetch_array($fetch);
					$_SESSION['nim'] = $dataUsers['nimMhs'];
					$_SESSION['role'] = $dataUsers['idRole'];
					$_SESSION['avatar'] = $dataUsers['imgUsers'];
					$_SESSION['nim'] = $dataUsers['nimMhs'];
					$_SESSION['nama'] = $dataUsers['namaMhs'];
					header('location: dashboard.php');
				}else{
					setFlashMessage('Login Gagal. Silahkan periksa kembali NIM dan password akun anda !' , 'index.php');
				}

			}else{
				setFlashMessage('NIM harus berupa angka !' , 'index.php');
			}
		}else{
			setFlashMessage('Data tidak boleh kosong !' , 'index.php');
		}

	}else{
		header('location: index.php');
	}
 ?>