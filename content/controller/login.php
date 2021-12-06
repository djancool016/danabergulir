<?php
	require_once("base_setting.php");
	require_once("../model/login_model.php");
	
	if(!$_GET['halaman']){		
		$action = base_url()."content/controller/login.php?halaman=proses_login";
		require_once("../view/login.php");
	}
	if($_GET['halaman'] == "proses_login"){	
		if(!$_POST['username'] or !$_POST['password'])
			echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/login.php");</script>';

		$param = array(
			'username' => $_POST['username'],
			'password' => $_POST['password']
		);
		
		$status = cek_login($param);
		if($status){
			write_log(get_userdata('name').' berhasil login');
			echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php");</script>';
		}
	}

	if($_GET['halaman'] == "logout"){
		write_log(get_userdata('name').' berhasil logout');	
		session_destroy();

		die ('<script type="text/javascript">location.replace("'.base_url().'content/controller/login.php");</script>');
	}
?>