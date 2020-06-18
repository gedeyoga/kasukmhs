<?php 
	
	function setFlashMessage($message , $link){
		global $base_url;
		$_SESSION['alert'] = $message;
		return header('Location: '.$base_url.$link);
	}
	function alert(){
		
		if (isset($_SESSION['alert'])) {
			$message = $_SESSION['alert'];
			unset($_SESSION['alert']);
			$alert = '
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        '.$message.'
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				      </div>
				    </div>
				  </div>
				</div>
				<script>
					$("#myModal").modal("show");
				</script>
			';
			return $alert;
		}
	}

 ?>