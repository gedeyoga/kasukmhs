<?php 
	$data = [];
	$data += mysqli_fetch_assoc(mysqli_query($conn , "SELECT SUM(jumlahByr) AS total FROM pembayaran"));
	$data += mysqli_fetch_assoc(mysqli_query($conn , "select sum(jumlahByr) as bulan_ini from pembayaran where bulanByr = '".date('Y-m')."'"));
	$data += mysqli_fetch_assoc(mysqli_query($conn , "SELECT COUNT(nimMhs) AS anggota_ini FROM pembayaran where bulanByr = '".date('Y-m')."'"));
	$data += mysqli_fetch_assoc(mysqli_query($conn , "SELECT COUNT(nimMhs) AS totAnggota FROM mahasiswa"));

 ?>
			<div class="data">
				<div class="title">
					<h3>Beranda</h3>
				</div>
				<div class="row d-flex justify-content-between">
					<div class="col-lg-4">
						<div class="banner d-flex flex-column align-items-center justify-content-center">
							<div class="banner-img">
								<img src="<?= $base_url ?>public/img/ilustrasi/standing.png">
							</div>
							<label>Selamat Datang</label><br>
							<span>Mari atur keuangan ukm kita</span>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="statistic">
							<label>Keuangan</label>
							<div class="row">
								<div class="col-6">
									<div class="box-stats box-white">
										<small>Pemasukan bulan ini</small>
										<label><?= number_format($data['bulan_ini']) ?> IDR</label>
									</div>
								</div>
								<div class="col-6">
									<div class="box-stats box-white">
										<small>Jumlah belum bayar bulan ini</small>
										<label><?= $data['anggota_ini'] ?> orang</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="box-stats box-tosca	">
										<small>Total kas UKM</small>
										<label><?= number_format($data['total']) ?> IDR</label>
									</div>
								</div>
							</div>
							<label>Keanggotaan</label>
							<div class="row">
								<div class="col-6">
									<div class="box-stats box-white">
										<small>Total anggota UKM</small>
										<label><?= $data['totAnggota'] ?> orang</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
