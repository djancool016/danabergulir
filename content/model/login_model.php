<?php
	
	function cek_login($param = array()){
		$sql = "SELECT a.*, b.name AS lkm_name FROM tb_admin a LEFT JOIN ms_lkm b ON a.id_lkm = b.id WHERE username = ? AND password = ?";
		$sql = query($sql, $param);
		$data = mysql_fetch_array($sql);
		
		if(mysql_num_rows($sql)){
			$_SESSION['login_lkm'] = array(
				'id' => $data['id'],
				'id_role' => $data['id_role'],
				'id_lkm' => $data['id_lkm'],
				'name' => $data['name'],
				'lkm_name' => $data['lkm_name']
			);
			
			return true;
		}
		else return false;
	}

?>