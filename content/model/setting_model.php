<?php

	function get_user_list($id = ''){
		$sql = "SELECT a.*, b.name AS role FROM tb_admin a LEFT JOIN tb_role b ON a.id_role = b.id WHERE a.id_lkm = ?";
		return query($sql, array(get_userdata('id_lkm')));
	}

	function get_user($id = ''){
		$sql = "SELECT * FROM tb_admin WHERE id = ?";
		$sql = query($sql, array($id));

		return mysql_fetch_array($sql);
	}

	function get_log(){
		$sql = "SELECT * FROM tr_log";
		return query($sql, array($id));
	}

	function save_change($param = array()){
		$sql = "UPDATE tb_admin SET id_role = ?,
									id_lkm = ?,
									name = ?,
									username = ?, 
									password = ?, 
									edit_stamp = ?

									WHERE id = ?";
		
		query($sql, $param);
	}

	function save_user($param = array()){
		$sql = "INSERT INTO tb_admin (`id_role`, `id_lkm`, `name`, `username`, `password`, `entry_stamp`) VALUES (?,?,?,?,?,?)";
		query($sql, $param);
	}

	function reset_data(){
		query('TRUNCATE ms_kas');
		query('TRUNCATE ms_ksm');
		query('TRUNCATE ms_ksm_member');
		query('TRUNCATE ms_loan');
		query('TRUNCATE ms_saving');
		query('TRUNCATE tr_debit_credit');
		query('TRUNCATE tr_loan_payment');
		query('TRUNCATE tr_log');
		
		$sql = "UPDATE tr_running_number SET last_count = '000', edit_stamp = NULL WHERE 1 = 1";
		query($sql);
	}