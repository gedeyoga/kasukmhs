		<div class="menu-sidebar">
			<a class="brand d-flex align-items-center" href="">
				<div class="img-brand">
					<img src="<?= $base_url ?>public/img/icon/small-stiki.png">
				</div>
				<span><small>ukm</small><br>
				hardware & software</span>
			</a>
			<nav class="sidebar">
				<ul>
					<li><a <?= ($menu == 'Dashboard') ? 'class="active"' : '' ?> href="<?= $base_url ?>dashboard.php">
						<i class="icon-menu fas fa-tachometer-alt"></i>Beranda</a>
					</li>

					<li><a class="drop <?= ($menu == 'Jurusan' || $menu == 'Jabatan') ? 'active' : '' ?>" href="#"><i class="icon-menu fas fa-boxes"></i>Master Data</a>
						<div class="dropdown  <?= ($menu == 'Jurusan' || $menu == 'Jabatan') ? 'active-drop' : '' ?>">
							<ul>
								<li><a <?= ($menu == 'Jurusan') ? 'class="active"' : '' ?>  href="<?= $base_url ?>jurusan/index.php"><i class="icon-menu far fa-circle"></i>Data Jurusan</a></li>
								<li><a <?= ($menu == 'Jabatan') ? 'class="active"' : '' ?> href="<?= $base_url ?>jabatan/index.php"><i class="icon-menu far fa-circle"></i>Data Jabatan</a></li>
							</ul>
						</div>
					</li>
					<li><a <?= ($menu == 'Anggota') ? 'class="active"' : '' ?> href="<?= $base_url ?>anggota/index.php"><i class="icon-menu fas fa-users"></i>Anggota</a></li>
					<li><a <?= ($menu == 'Kas UKM') ? 'class="active"' : '' ?> href=""><i class="icon-menu fas fa-file-invoice"></i>Kas UKM</a></li>
				</ul>
			</nav>
			<div class="banner d-flex justify-content-center">
				<img src="<?= $base_url ?>public/img/ilustrasi/ilustrasi.png">
			</div>
		</div>
		<div class="content">
			<div class="menu d-flex justify-content-between align-items-center">
				<span><?= tglIndo(date('Y-m-d')) ?></span>
				<div class="d-flex align-items-center">
					<a href="">
						<div class="profile d-flex align-items-center">
							<span><?= $_SESSION['nama'] ?></span>
							<div class="img-profile">
								<img src="<?= $base_url ?>public/img/profile/<?= $_SESSION['avatar'] ?>">
							</div>
						</div>
					</a>
					<a class="logout" href="<?= $base_url ?>logout.php"><i class="icon-menu fas fa-sign-out-alt"></i></a>
				</div>
			</div>