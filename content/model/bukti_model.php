<?php
	
	function get_ksm(){
		$sql = "SELECT * FROM ms_ksm";
		return query($sql);
	}

	function get_register(){
		$sql = "SELECT * FROM tb_register";
		return query($sql);
	}

	function get_coa(){
		$sql = "SELECT * FROM tb_coa";
		return query($sql);
	}

	function get_coa_by_register($id = ""){
		$sql = "SELECT * FROM tb_coa WHERE id_register = ?";
		return query($sql, array($id));
	}

	function get_coa_bukti_keluar(){
		$sql = "SELECT * FROM tb_coa WHERE id IN(2, 7, 9, 11, 23, 24, 25, 26, 29, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45)";
		return query($sql);
	}

	function get_last_tabungan($id_ksm = ''){
		$sql = "SELECT acc_no FROM ms_saving WHERE id_ksm = ? ORDER BY id DESC LIMIT 0,1";
		$sql = query($sql, array($id_ksm));
		$sql = mysql_fetch_array($sql);

		return $sql['acc_no'];
	}


	function get_last_loan($id_ksm = ''){
		$sql = "SELECT loan_no FROM ms_loan WHERE id_ksm = ? AND is_finish = ? ORDER BY id DESC LIMIT 0,1";
		$sql = query($sql, array($id_ksm, 0));
		$sql = mysql_fetch_array($sql);
		
		return $sql['loan_no'];
	}

	function save_transaction($param = array()){
		$sql = "INSERT INTO tr_debit_credit (`id_ksm`,
											 `id_lkm`,
											 `id_coa`,
											 `id_register`,
											 `is_move`,
											 `no`,
											 `no_register`,
											 `type`,
											 `base`,
											 `transaction_date`,
											 `remark`,
											 `other_ksm`,
											 `transaction_by`,
											 `entry_stamp`,
											 `id_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		query($sql, $param);
		return mysql_insert_id();
	}

	function check_first_loan($id = '', $id_ksm = '', $date = '', $no_register = '', $total = ''){
		$sql = "SELECT id, loan_total FROM ms_loan WHERE id_ksm = ? AND id_initial_loan = ? AND loan_no = ?";
		$sql = query($sql, array($id_ksm, 0, $no_register));
		$sql = mysql_fetch_array($sql);
		
		if(!$sql['id'])
			return false;
		else{
			if($id){
				if($sql['loan_total'] != $total)
					return 'incorrect_total';

				query("UPDATE ms_loan SET id_initial_loan = ? WHERE id = ?", array($id, $sql['id']));

				$sql = query("SELECT * FROM ms_loan WHERE id = ?", array($sql['id']));
				$data = mysql_fetch_array($sql);

				$duration = $data['loan_duration'];
				$loan = $data['loan_total'] / $data['loan_duration'];
				$int = (($loan / 100) * $data['loan_interest']);

				for($i=1;$i<=$duration;$i++){
					$_param = array(
						'id_ksm' => $data['id_ksm'],
						'id_lkm' => get_userdata('id_lkm'),
						'id_loan' => $data['id'],
						'payment_no' => $i,
						'due_date' => date("Y-m-d", strtotime($date." + ".$i." month")),
						'loan_total' => $loan,
						'loan_remaining' => $loan,
						'interest_total' => $int,
						'interest_remaining' => $int,
						'entry_stamp' => date('Y-m-d H:i:s'),
						'id_admin' => get_userdata('id')
					);

					simpan_loan_payment($_param);
				}
			}
			else 
				return true;
		}
	}

	function save_kas($param){
		$sql = "SELECT * FROM ms_kas WHERE id_lkm = ?";
		$sql = query($sql, array($param['id_lkm']));
		$data = mysql_fetch_array($sql); 

		if($data){
			$sql = "UPDATE ms_kas SET `".$param['type']."` = ?,
									  `edit_stamp` = ?,
									  `id_admin` = ? 
									 
									  WHERE `id_lkm` = ?";

			 $param = array(
				($data[$param['type']] + $param['value']), 
				$param['entry_stamp'],
				$param['id_admin'],
				$param['id_lkm']
			);		
		}
		else{
			$sql = "INSERT INTO ms_kas (`id_lkm`,
										`value`,
										`start_value`,
										`entry_stamp`,
									  	`id_admin`) VALUES (?,?,?,?,?)";
			
			$param = array(
				$param['id_lkm'], 
				$param['value'], 
				$param['start_value'],
				$param['entry_stamp'],
				$param['id_admin']
			);							 
		}

		query($sql, $param);
	}

	function pay_loan($type = "", $id_ksm = "", $value = "", $loan_no = ""){
		$sql = "SELECT id FROM ms_loan WHERE loan_no = ?";
		$sql = query($sql, array($loan_no));		
		$id = mysql_fetch_array($sql);
		$id = $id['id'];

		$sql = "SELECT * FROM tr_loan_payment WHERE id_loan = ? AND ".$type."_remaining > ? ORDER BY id ASC";
		$sql = query($sql, array($id, 0));

		while($data = mysql_fetch_array($sql)){
			$total = $data[$type."_remaining"];
			if($value <= 0) return;

			if($value >= $total){
				$paid = 0;
				$is_settled = 1;
			}
			else{
				$paid = $total - $value;
				$is_settled = 0;
			}

			$value -= $total;

			$_sql = "UPDATE tr_loan_payment SET ".$type."_remaining = ?, is_settled = ?, edit_stamp = ? WHERE id = ?";
			query($_sql, array($paid, $is_settled, date("Y-m-d H:i:s"), $data['id']));
		}
		
		$sql = "SELECT SUM(loan_remaining) AS loan, SUM(interest_remaining) AS interest FROM tr_loan_payment WHERE id_loan = ?";
		$sql = query($sql, array($id));
		$sql = mysql_fetch_array($sql);	
		
		
		if($sql['loan'] == 0 and $sql['interest'] == 0){
			$sql = "UPDATE ms_loan SET is_finish = ? WHERE id = ?";
			echo "abel ".$id;

			query($sql, array(1, $id));
		}
	}

	function simpan_loan_payment($param = array()){
		$sql = "INSERT INTO tr_loan_payment (`id_ksm`,`id_lkm`,`id_loan`,`payment_no`,`due_date`,`loan_total`,`loan_remaining`,`interest_total`,`interest_remaining`,`entry_stamp`,`id_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
									  
		query($sql, $param);
	}
?>
