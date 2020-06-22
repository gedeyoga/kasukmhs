<?php 
	include "../config.php";
	include '../helper/alert.php'; 
	include '../helper/general.php';

	is_login();
	is_admin();

	$menu = "Jabatan";
	include "../template/header.php";
	include "../template/sidebar.php";

	$search = "";
	if (isset($_GET['search'])) {
		$search .= "WHERE namaJbtn LIKE '%".$_GET['search']."%'";
	}
	$halaman = 5; //batasan halaman
	$page  = isset($_GET['page'])? (int)$_GET["page"]:1;
	$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
	$fetch = mysqli_query($conn , "SELECT * FROM jabatan ".$search." ORDER BY idJbtn DESC LIMIT $mulai, $halaman");
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
	<table class="table table-striped">
	  <thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Jurusan</th>
	      <th scope="col">Aksi</th>
	    </tr>
	  </thead>
	  <tbody>
	    <?php 

	    	if (mysqli_num_rows($fetch) > 0) : 
	    		$no = 1;
	    		while($data = mysqli_fetch_array($fetch)) :
	    		?>
	    			<tr>
				      <th scope="row"><?= $no ?></th>
				      <td><?= $data['namaJbtn'] ?></td>
				      <td>
				      	<button class="btn btn-primary btn-sm" onclick="edit(<?= $data['idJbtn'] ?>)" data-toggle="modal" data-target="#formEdit"><i class="fas fa-pencil-alt"></i></button>
				      	<a class="btn btn-danger btn-sm" href="<?= $base_url ?>jabatan/proses/delete.php?id=<?= $data['idJbtn'] ?>"><i class="fas fa-trash"></i></a>
				      </td>
				    </tr>
	    		<?php
	    			$no++;
	    		endwhile;
	    	else :
	    ?>
			<tr>
				<td colspan="3"><p align="center">Data tidak ditemukan !</p></td>
			</tr>
	    <?php endif; ?>
	  </tbody>
	</table>
	<nav aria-label="...">
		<ul class="pagination justify-content-center">
			<?php
			for ($i=1; $i<=$pages ; $i++){ ?>
			 <li class="page-item <?= ($_GET['page'] == $i ) ? "active" : "" ?>"><a class="page-link" href="?<?= (isset($_GET['search'])) ? "search=".$_GET['search']."&" : "" ?>page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			 <?php } ?>
			
			<!-- <li class="page-item active" aria-current="page">
			  <span class="page-link">
			    2
			    <span class="sr-only">(current)</span>
			  </span>
			</li>
			<li class="page-item"><a class="page-link" href="#">3</a></li> -->
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
      <form action="<?= $base_url ?>jabatan/proses/add-process.php" method="post">
	      <div class="modal-body">
			  <div class="form-group">
			    <label>Nama Jabatan</label>
			    <input name="namaJbtn" type="text" class="form-control" placeholder="Contoh: Ketua" required>
			  </div>
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
      <form action="<?= $base_url ?>jabatan/proses/edit-process.php" method="post">
	      <div class="modal-body">
			  <div class="form-group">
			    <label>Nama Jabatan</label>
			    <input id="namaJbtn" name="namaJbtn" type="text" class="form-control" placeholder="Contoh: Ketua" required>
			    <input id="idJbtn" name="idJbtn" type="hidden" class="form-control">
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
					$('#namaJbtn').val(objData.namaJbtn);
					$('#idJbtn').val(objData.idJbtn);
				});
	}
</script>
<?= alert(); ?>	
<?php include "../template/footer.php"; ?>