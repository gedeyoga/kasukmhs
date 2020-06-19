<?php 
	include "../config.php";
	include '../helper/alert.php'; 
	include '../helper/general.php';

	is_login();
	is_admin();

	$menu = "Jurusan";
	include "../template/header.php";
	include "../template/sidebar.php";
	
	include "../template/footer.php";

 ?>