<?php 
	
	include "../../config.php";

	if (isset($_GET['id'])) {
		$fetch = mysqli_query($conn , "SELECT * FROM jurusan WHERE idJrs = ".$_GET['id']);
		$data = mysqli_fetch_assoc($fetch);
		echo json_encode($data);
	}

 ?>