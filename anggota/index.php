<?php 
	include "../config.php";
	include '../helper/alert.php'; 
	include '../helper/general.php';

	is_login();
	is_admin();

	$menu = "Anggota";
	include "../template/header.php";
	include "../template/sidebar.php";

	$search = "";
	if (isset($_GET['search'])) {
		$search .= "WHERE namaMhs LIKE '%".$_GET['search']."%' OR namaJbtn LIKE '%".$_GET['search']."%' OR namaJrs LIKE '%".$_GET['search']."%'";
	}

	$halaman = 6; //batasan halaman
	$page  = isset($_GET['page'])? (int)$_GET["page"]:1;
	$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
	$query = "SELECT * FROM mahasiswa 
			  JOIN jurusan ON mahasiswa.idJrs = jurusan.idJrs
			  JOIN jabatan ON mahasiswa.idJbtn = jabatan.idJbtn
			 ".$search." ORDER BY nimMhs DESC LIMIT $mulai, $halaman";
	$fetch = mysqli_query($conn , $query);
	$total = mysqli_num_rows($fetch);
	$pages = ceil($total/$halaman); 

?>
<div class="data">
	<div class="title d-flex justify-content-between">
		<h3>Data <?= $menu ?></h3>
		<div class="d-flex align-items-center">
			<button class="btn btn-primary btn-radius" data-toggle="modal" data-target="#formTambah"><i class="fas fa-plus"></i></button>
			<div class="search ml-2">
				<form name="formSearch" method="get" acction="<?= $base_url ?>jurusan/index.php">
					<input type="text" name="search" placeholder="Cari sesuatu...">
				</form>
			</div>
		</div>
	</div>
	<div class='row mb-4'>
		<?php
			if(mysqli_num_rows($fetch) > 0) :
				$i = 0;
				while($data = mysqli_fetch_assoc($fetch)) :
		?>
			<div class="col-lg-4">
				<div class="box-data box-white">
					<div class="d-flex align-items-center">
						<div class="img-data">
							<img src="<?= $base_url ?>public/img/profile/default.jpg">
						</div>
						<div class="name-data">
							<h6 class="limit-name"><?= $data['namaMhs'] ?></h6>
							<div class="d-flex justify-content-between">
								<span><?= $data['nimMhs'] ?></span>
								<span><?= ($data['jkMhs'] == '0') ? "Wanita" : "Pria" ?></span>
							</div>
						</div>
					</div>
					<div class="other-data">
						<label><?= $data['namaJrs'] ?></label><br>
						<small><?= $data['namaJbtn'] ?></small>
					</div>
					<div class="btn-data d-flex justify-content-end">
						<a class="btn-tosca" href="">Profile</a>
						<a class="btn-grey" href=""><i class="fas fa-pencil-alt"></i></a>
						<a class="btn-red" href="proses/delete.php?id=<?= $data['nimMhs'] ?>"><i class="fas fa-trash"></i></a>
					</div>
				</div>
			</div>
		<?php
					$i++;
					if ($i % 3 == 0) {echo '</div><div class="row mb-4">';}
				endwhile;
			else :
				echo "Data tidak ada !";
			endif;
		?>
	</div>
	
	<nav aria-label="...">
		<ul class="pagination justify-content-center">
			<?php
			for ($i=1; $i<=$pages ; $i++){ ?>
			 <li class="page-item <?= ($_GET['page'] == $i ) ? "active" : "" ?>"><a class="page-link" href="?<?= (isset($_GET['search'])) ? "search=".$_GET['search']."&" : "" ?>page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			 <?php } ?>
		</ul>
	</nav>
</div>

<!-- Modal FORM TAMBAH-->
<div class="modal fade" id="formTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $base_url ?>anggota/proses/add-process.php" method="post">
	      <div class="modal-body">
			  <div class="form-group">
			    <label>NIM</label>
			    <input name="nimMhs" type="text" class="form-control" placeholder="Contoh: 19101290" required>
			  </div>
			  <div class="form-group">
			    <label>Nama Mahasiswa</label>
			    <input name="namaMhs" type="text" class="form-control" placeholder="Aristoteles Bell" required>
			  </div>
			  <div class="form-row">
			    <div class="col">
			    	<label>Jenis Kelamin</label><br>
				    <input name="jkMhs" type="radio" value="0"><span class="ml-2">Wanita</span>
				    <input class="ml-4" name="jkMhs" type="radio" value="1"><span class="ml-2">Pria</span>
			    </div>
			    <div class="col">
			    	<label>Tanggal Lahir</label><br>
			    	<input class="form-control" name="tglLahirMhs" type="date" value="0">
			    </div>
			  </div>
			  <div class="form-row">
			  	<div class="col">
			    	<label>Email</label>
			    	<input name="emailMhs" type="email" class="form-control" placeholder="example@gmail.com" required>
			    </div>
			    <div class="col">
			    	<label>Telp</label>
			    	<input name="telpMhs" type="number" class="form-control" placeholder="081xxxx" required>
			    </div>
			  </div>
			  <?= comboJurusan() ?>
			  <?= comboJabatan() ?>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" name="submit" class="btn btn-primary" value="Tambah">
	      </div>
  	  </form>
    </div>
  </div>
</div>

<!-- Modal FORM EDIT-->
<div class="modal fade" id="formEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $base_url ?>jurusan/proses/edit-process.php" method="post">
	      <div class="modal-body">
			  <div class="form-group">
			    <label>Nama Jurusan</label>
			    <input id="namaJrs" name="namaJrs" type="text" class="form-control" placeholder="Contoh: Teknik Informatika" required>
			    <input id="idJrs" name="idJrs" type="hidden" class="form-control">
			  </div>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" name="submit" class="btn btn-primary" value="Ubah Data">
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
					$('#namaJrs').val(objData.namaJrs);
					$('#idJrs').val(objData.idJrs);
				});
	}
</script>
<?= alert(); ?>	
<?php include "../template/footer.php"; ?>