<?php
	require_once("base_setting.php");
	require_once("../model/setting_model.php");
	
	if($_GET['halaman'] == "user_form"){
		$action =  'save_user';
		if($_GET['edit']){ $fill = get_user($_GET['edit']); $action = 'save_change'; }

		$konten = "../view/setting/user-form.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_change"){
		
		$param = array(
			'id_role' => $_POST['id_role'],
			'id_lkm' => get_userdata('id_lkm'),
			'name' => $_POST['name'],
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'edit_stamp' => date("Y-m-d H:i:s"),
			'id' => $_POST['id']		
		);
		save_change($param);
		write_log(get_userdata('name').' berhasil mengedit user '.$_POST['name']);	

		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/setting.php?halaman=user");</script>';
	}

	if($_GET['halaman'] == "reset_data"){
		reset_data();		
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/setting.php?halaman=management");</script>';
	}

	if($_GET['halaman'] == "user"){
		$a = get_user_list();
		$konten = "../view/setting/user.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "log"){
		$a = get_log();
		$konten = "../view/setting/log.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_user"){

		$param = array(
			'id_role' => $_POST['id_role'],
			'id_lkm' => get_userdata('id_lkm'),
			'name' => $_POST['name'],
			'username' => $_POST['username'],
			'password' => $_POST['password'],	
			'entry_stamp' => date("Y-m-d H:i:s")	
		);
		save_user($param);
		write_log(get_userdata('name').' berhasil menambah user '.$_POST['name']);	

		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/setting.php?halaman=user");</script>';
	}