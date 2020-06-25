<?php 
	function tglIndo($waktu){
	    $hari_array = array(
	        'Minggu',
	        'Senin',
	        'Selasa',
	        'Rabu',
	        'Kamis',
	        'Jumat',
	        'Sabtu'
	    );
	    $hr = date('w', strtotime($waktu));
	    $hari = $hari_array[$hr];
	    $tanggal = date('j', strtotime($waktu));
	    $bulan_array = array(
	        1 => 'Januari',
	        2 => 'Februari',
	        3 => 'Maret',
	        4 => 'April',
	        5 => 'Mei',
	        6 => 'Juni',
	        7 => 'Juli',
	        8 => 'Agustus',
	        9 => 'September',
	        10 => 'Oktober',
	        11 => 'November',
	        12 => 'Desember',
	    );
	    $bl = date('n', strtotime($waktu));
	    $bulan = $bulan_array[$bl];
	    $tahun = date('Y', strtotime($waktu));
	    $jam = date( 'H:i:s', strtotime($waktu));
	    
	    //untuk menampilkan hari, tanggal bulan tahun jam
	    //return "$hari, $tanggal $bulan $tahun $jam";

	    //untuk menampilkan hari, tanggal bulan tahun
	    return "$hari, $tanggal $bulan $tahun";
	}
	function bulanTahunIndo($bulan , $tahun){
		$bulan_array = array(
	        '01' => 'Januari',
	        '02' => 'Februari',
	        '03' => 'Maret',
	        '04' => 'April',
	        '05' => 'Mei',
	        '06' => 'Juni',
	        '07' => 'Juli',
	        '08' => 'Agustus',
	        '09' => 'September',
	        '10' => 'Oktober',
	        '11' => 'November',
	        '12' => 'Desember',
	    );
	    return $bulan_array[$bulan]." ".$tahun;
	}
	function is_login(){
		global $base_url;
		if (!isset($_SESSION['nim'])) {
			header('location: '.$base_url);
		}
	}
	function is_admin(){
		global $base_url;
		if ($_SESSION['role'] != '1') {
			header('location: '.$base_url);
		}
	}
	function is_member(){
		global $base_url;
		if ($_SESSION['role'] != '2') {
			header('location: '.$base_url);
		}
	}
	function comboJurusan($check = ""){
		global $conn;
		$fetch = mysqli_query($conn , "SELECT * FROM jurusan");
		$view = '<div class="form-group">';
		$view .= '<label>Jurusan</label>';
		$view .= '<select name="idJrs" class="form-control">';
		while ($d = mysqli_fetch_assoc($fetch)) {
			$select  = ($d['idJrs'] == $check) ? "selected" : "";
			$view .= "<option class='idJrs' value='".$d['idJrs']."' $select>".$d['namaJrs']."</option>";
		}
		$view .= '</select>';
		$view .= '</div>';
		return $view;
	}
	function comboJabatan($check = ""){
		global $conn;
		$fetch = mysqli_query($conn , "SELECT * FROM jabatan");
		$view = '<div class="form-group">';
		$view .= '<label>Jabatan</label>';
		$view .= '<select name="idJbtn" class="form-control">';
		while ($d = mysqli_fetch_assoc($fetch)) {
			$select  = ($d['idJbtn'] == $check) ? "selected" : "";
			$view .= "<option class='idJbtn' value='".$d['idJbtn']."' $select>".$d['namaJbtn']."</option>";
		}
		$view .= '</select>';
		$view .= '</div>';
		return $view;
	}
?>