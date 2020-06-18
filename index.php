<?php 
	include 'config.php';
	include 'helper/alert.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= $base_url ?>public/css/style.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/vendor/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>public/vendor/fontawesome/css/all.min.css">
    <script src="<?= $base_url ?>public/vendor/jquery/jquery.js"></script>
    <script src="<?= $base_url ?>public/vendor/bootstrap/js/bootstrap.min.js"></script>
    <title>Login - UKM HARDWARE SOFTWARE</title>
</head>
<body>
	
	<div class="d-flex">
		<section class="d-flex align-items-center flex-column justify-content-between">
			<div class="head">
				<img src="<?= $base_url ?>public/img/icon/medium-stiki.png">
				<h2>ukm - hardware & software</h2>
			</div>
			<div class="bottom">
				<img src="<?= $base_url ?>public/img/ilustrasi/city.svg">
			</div>
		</section>
		<section class="d-flex justify-content-center align-items-center">
				<div class="form-login">
					<h2>Masuk <br> UKM Hardware & Software</h2>
					<form action="proses-login.php" method="post">
						<div class="form-group">
						    <label>Nomor Induk Mahasiswa</label>
						    <input name="nimMhs" type="number" class="form-control c-input">
					  	</div>
					  	<div class="form-group">
						    <label>Kata Sandi</label>
						    <input name="passUsers" type="password" class="form-control c-input">
					  	</div>
					  	<button name="submit" type="submit" class="btn">Masuk Sekarang</button>
					</form>
				</div>
		</section>
	</div>
	<?= alert(); ?>
</body>
</html>