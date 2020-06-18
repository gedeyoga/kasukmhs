<?php 
	include "config.php";
	include 'helper/alert.php'; 
	include "template/header.php";
	include "template/sidebar.php";
	if ($_SESSION['role'] == 1) {
		include "template/dashboard/admin.php";
	}else{
		include "template/dashboard/member.php";
	}
	include "template/footer.php";

 ?>