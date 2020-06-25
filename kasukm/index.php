	<?php 
		include "../config.php";
		include '../helper/alert.php'; 
		include '../helper/general.php';

		is_login();
		is_admin();

		$menu = "Kas UKM";
		include "../template/header.php";
		include "../template/sidebar.php";

		$search = "";
		$bulanTahun = "";
		if (isset($_GET['bulan']) && isset($_GET['tahun'])) {
			$date   = $_GET['tahun'].'-'.$_GET['bulan'];
			$bulanTahun .= bulanTahunIndo($_GET['bulan'] , $_GET['tahun']);
			$search .= "WHERE bulanByr = '$date'";
		}else{
			$search .= "WHERE bulanByr = '".date('Y-m')."'";
			$bulanTahun .= bulanTahunIndo($_GET['bulan'] , date('Y'));
		}
	?>
	<div class="data">
		<div class="title d-flex justify-content-between">
			<h3>Data <?= $menu ?></h3>
			<form class="d-flex align-items-center" name="formSearch" method="get" acction="<?= $base_url ?>jurusan/index.php">
				<select name="bulan" class="form-control mr-2">
					<option value="01">Januari</option>
					<option value="02">Februari</option>
					<option value="03">Maret</option>
					<option value="04">April</option>
					<option value="05">Mei</option>
					<option value="06">Juni</option>
					<option value="07">Juli</option>
					<option value="08">Agustus</option>
					<option value="09">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option>
					<option value="12">Desember</option>
				</select>
				<script type="text/javascript">
					$(document).ready(function(){
						$('[name="bulan"] option').each(function(){
							if ($(this).val() == <?= (isset($_GET['bulan']) && isset($_GET['tahun'])) ? $_GET['bulan'] : date('m') ?>) {
								$(this).attr('selected','');
							}
						});
					});
				</script>
				<select name="tahun" class="form-control mr-2">
					<?php
						for ($i=2019; $i <= date('Y'); $i++) { 
							$selected = ($i == date('Y')) ? 'selected' : '';
							echo "<option ".$selected." value='$i' >$i</option>";
						}
					?>
				</select>
				<button class="btn btn-primary btn-radius"><i class="fas fa-search"></i></button>
			</form>
		</div>
		<p id="judul" align="center">Data Bulan <?= $bulanTahun ?></p>
		<div class="row mt-4">
			<div class="col-lg-6">
				<label>Belum Bayar</label>
				<div style="overflow-y: scroll; height: 300px;" class="list-group list-group-flush">
					<?php 
						$query = "SELECT mahasiswa.namaMhs FROM mahasiswa WHERE nimMhs NOT IN (SELECT nimMhs FROM pembayaran $search)";
						$fetch = mysqli_query($conn , $query);	
						while($d = mysqli_fetch_assoc($fetch)) :
					?>
						<li class="list-group-item list-group-item-danger d-flex justify-content-between"><?= $d['namaMhs'] ?> <button class="btn btn-primary btn-sm" onclick="bayar(<?= $d['nimMhs'] ?>)" data-toggle="modal" data-target="#formBayar">Bayar</button></li>
					<?php endwhile; ?>
					
				</div>
			</div>
			<div class="col-lg-6">
				<label>Sudah Bayar</label>
				<div style="overflow-y: scroll; height: 300px;" class="list-group list-group-flush">
					<?php 
						$query = "SELECT mahasiswa.namaMhs FROM mahasiswa WHERE nimMhs IN (SELECT nimMhs FROM pembayaran $search)";
						$fetch = mysqli_query($conn , $query);	
						while($d = mysqli_fetch_assoc($fetch)) :
					?>
					<li class="list-group-item d-flex justify-content-between"><?= $d['namaMhs'] ?> <span><b>Lunas</b></span></li>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $base_url ?>anggota/proses/edit-process.php" method="post">
	      <div class="modal-body">
			  <div class="form-group">
			    <label>NIM</label>
			    <input id="nimMhs" name="nimMhs" type="text" class="form-control" placeholder="Contoh: 19101290" readonly="">
			  </div>
			  <div class="form-group">
			    <label>Nama Mahasiswa</label>
			    <input id="namaMhs" name="namaMhs" type="text" class="form-control" placeholder="Aristoteles Bell" required>
			  </div>
			  <div class="form-row">
			    <div class="col">
			    	<label>Jenis Kelamin</label><br>
				    <input class="jkMhs" name="jkMhs" type="radio" value="0"><span class="ml-2">Wanita</span>
				    <input class="jkMhs ml-4" name="jkMhs" type="radio" value="1"><span class="ml-2">Pria</span>
			    </div>
			    <div class="col">
			    	<label>Tanggal Lahir</label><br>
			    	<input id="tglLahirMhs" class="form-control" name="tglLahirMhs" type="date" value="0">
			    </div>
			  </div>
			  <div class="form-row">
			  	<div class="col">
			    	<label>Email</label>
			    	<input id="emailMhs" name="emailMhs" type="email" class="form-control" placeholder="example@gmail.com" required>
			    </div>
			    <div class="col">
			    	<label>Telp</label>
			    	<input id="telpMhs" name="telpMhs" type="number" class="form-control" placeholder="081xxxx" required>
			    </div>
			  </div>
			  <?= comboJurusan() ?>
			  <?= comboJabatan() ?>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" name="submit" class="btn btn-primary" value="Ubah">
	      </div>
  	  </form>
    </div>
  </div>
</div>
<script type="text/javascript">
	function edit(id){
		$.get("proses/edit.php", {id: id}) // request get -> menentukan nama url -> data yang dikirimkan
				.done(function(data){
					var objData = JSON.parse(data);
					$('#nimMhs').val(objData.nimMhs);
					$('#namaMhs').val(objData.namaMhs);
					$('#emailMhs').val(objData.emailMhs);
					$('#tglLahirMhs').val(objData.tglLahirMhs);
					$('#telpMhs').val(objData.telpMhs);
					$('.jkMhs').each(function(){
						if($(this).val() == objData.jkMhs){
							$(this).attr('checked','checked');
						}
					});
					$('.idJrs').each(function(){
						if($(this).val() == objData.idJrs){
							$(this).attr('selected','');
						}
					});
					$('.idJbtn').each(function(){
						if($(this).val() == objData.idJbtn){
							$(this).attr('selected','');
						}
					});
				});
	}
</script>
<?= alert(); ?>	
<?php include "../template/footer.php"; ?>
