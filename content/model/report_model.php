<?php
	
	function get_coa_total($id_coa = ''){
		$sql = "SELECT SUM(base) AS total FROM tr_debit_credit WHERE id_coa = ?";
		$sql = query($sql, array($id_coa));
		$sql = mysql_fetch_array($sql);

		return $sql['total'];
	}

	function get_register_tabungan($type = ''){
			$sql = "SELECT a.*, 
					   b.name, 
					   b.ksm_no,
					   c.name AS register_name,
					   d.code,
					   d.name AS coa_name
					   FROM tr_debit_credit a 
					   LEFT JOIN ms_ksm b ON b.id = a.id_ksm 
					   LEFT JOIN tb_register c ON c.id = a.id_register 
					   LEFT JOIN tb_coa d ON d.id = a.id_coa
					   WHERE 
					   a.type = ? AND a.is_initial = 0 AND a.id_coa <> 1 AND a.is_move = 0 ";

		if($_GET['report_filter_period']) $sql .= " AND a.transaction_date <= '".$_GET['report_filter_period']."' AND YEAR(a.transaction_date) = '".date("Y", strtotime($_GET['report_filter_period']))."'";
	 	else $sql .= " AND a.transaction_date <= '".date(CURRENT_YEAR."-m-d")."' AND YEAR(a.transaction_date) = '".CURRENT_YEAR."'";

	 	$sql .= " ORDER BY a.transaction_date DESC, a.no DESC";
		return query($sql, array($type));		
	}

	function get_pindah_buku($type = ''){
		$sql = "SELECT a.*, 
					   b.name, 
					   b.ksm_no,
					   c.name AS register_name,
					   d.code,
					   d.name AS coa_name
					   FROM tr_debit_credit a 
					   LEFT JOIN ms_ksm b ON b.id = a.id_ksm 
					   LEFT JOIN tb_register c ON c.id = a.id_register 
					   LEFT JOIN tb_coa d ON d.id = a.id_coa
					   WHERE 
					   a.id_coa <> 1 AND a.is_move = 1 ";

		if($_GET['report_filter_period']) $sql .= " AND transaction_date <= '".$_GET['report_filter_period']."' AND YEAR(transaction_date) = '".date("Y", strtotime($_GET['report_filter_period']))."'";
	 	else $sql .= " AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."' AND YEAR(transaction_date) = '".CURRENT_YEAR."'";

	 	$sql .= " ORDER BY transaction_date DESC";

		return query($sql, array($type));		
	}

	function get_saldo_awal($id_coa = ''){
		$sql  = "SELECT base, transaction_date FROM tr_debit_credit WHERE id_coa = ? AND id_lkm = ? AND is_initial = ?"; 
		$sql  = query($sql, array($id_coa, get_userdata('id_lkm'), 1)); 
		$sql  = mysql_fetch_array($sql);
		
		$saldo = $sql['base'];
		$awal = date("Y", strtotime($sql['transaction_date']));
		
		if(get_acc_start() == CURRENT_YEAR) return $saldo;
		
		$sql = "SELECT
					(SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = ? AND id_lkm = ? AND type = ? AND transaction_date < ?) AS credit,
					(SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = ? AND id_lkm = ? AND type = ? AND transaction_date < ?) AS debit ";
		
		$sql = query($sql, array($id_coa, get_userdata('id_lkm'), 'out', CURRENT_YEAR.'-01-01', $id_coa, get_userdata('id_lkm'), 'in', CURRENT_YEAR.'-01-01'));		
		$sql = mysql_fetch_array($sql);
		
		return $sql['credit'] - $sql['debit'];
	}

	function get_laba_rugi_last($is_all = false){
		if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; 
	 	else $add = " AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."' ";

	 	$add .= " AND YEAR(transaction_date) = '".CURRENT_YEAR."' ";

	 	//if($is_all == true) $add = " AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."' ";

		$sql = "SELECT
					(SELECT SUM(base) FROM tr_debit_credit WHERE (id_coa = ? AND id_lkm = ? AND type = ? ".$add.")) AS credit,
					(SELECT SUM(base) FROM tr_debit_credit WHERE (id_coa = ? AND id_lkm = ? AND type = ? ".$add.")) AS debit ";
		
		$sql = query($sql, array(17, get_userdata('id_lkm'), 'out', 17, get_userdata('id_lkm'), 'in'));		
		$sql = mysql_fetch_array($sql);
		
		return $sql['debit'] - $sql['credit'];
	}

	function get_buku($id_coa = ''){
		$sql = "SELECT a.*,
					   b.name,
					   b.ksm_no 
					   FROM tr_debit_credit a
		 			   LEFT JOIN ms_ksm b ON b.id = a.id_ksm
		 			   WHERE id_coa = ? AND is_initial = ? ";

		if($_GET['report_filter_period']) $sql .= " AND transaction_date <= '".$_GET['report_filter_period']."'";
		else $sql .= " AND YEAR(transaction_date) = '".CURRENT_YEAR."' AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."'"; 

		$sql .= " ORDER BY transaction_date ASC";

		return query($sql, array($id_coa, 0));
	}

	function get_buku_bank($param = array()){
		$sql = "SELECT a.*,
					   b.name,
					   b.ksm_no
					   FROM tr_debit_credit a
		 			   LEFT JOIN ms_ksm b ON b.id = a.id_ksm
		 			   WHERE id_coa = ?";

		 if($_GET['report_filter_period']) $sql .= " AND transaction_date <= '".$_GET['report_filter_period']."'";
		 else $sql .= " AND YEAR(transaction_date) = 2016 AND <= '".date("2016-m-d")."'"; 
		 
		 $sql .= "ORDER BY transaction_date ASC";

		return query($sql, array(2));
	}

	function get_buku_inventaris($param = array()){
		$sql = "SELECT a.*,
					   b.name,
					   b.ksm_no
					   FROM tr_debit_credit a
		 			   LEFT JOIN ms_ksm b ON b.id = a.id_ksm
		 			   WHERE id_coa = ?";

		 if($_GET['report_filter_period']) $sql .= " AND transaction_date <= '".$_GET['report_filter_period']."' AND YEAR(transaction_date) = ?";
		 $sql .= "ORDER BY transaction_date ASC";

		$year = CURRENT_YEAR;
		if($_GET['report_filter_period'])
			$year = date('Y', strtotime($_GET['report_filter_period']));


		return query($sql, array(7, $year));
	}

	function get_neraca_saldo_aktiva($param = array()){

	 	if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; 
	 	else $add = " AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."' ";

		$year = CURRENT_YEAR;
		if($_GET['report_filter_period'])
			$year = date('Y', strtotime($_GET['report_filter_period']));

	 	//$year = get_last_accperiod();

		$sql = "SELECT a.id, 
					   a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS credit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_credit

				FROM tb_coa a WHERE a.id IN (?,?,?,?,?,?,?,?)";

		return query($sql, array(in, out, in, $year, out, $year, 1, 2, 3, 4, 5, 6, 7, 8));
	}

	function get_neraca_saldo_passiva($param = array()){

	 	if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; 
	 	else $add = " AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."' ";

	 	$year = CURRENT_YEAR;
		if($_GET['report_filter_period'])
			$year = date('Y', strtotime($_GET['report_filter_period']));

		$sql = "SELECT a.id, 
					   a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS credit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_credit

				FROM tb_coa a WHERE a.id IN (?,?,?,?,?,?,?,?,?,?,?,?)";

		return query($sql, array(in, out, in, $year, out, $year, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 30, 31));
	}

	function get_pendapatan($param = array()){

	 	if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; 
	 	else $add = " AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."' ";

		$year = CURRENT_YEAR;
		if($_GET['report_filter_period'])
			$year = date('Y', strtotime($_GET['report_filter_period']));

		$sql = "SELECT a.id, 
					   a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS credit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_credit

				FROM tb_coa a WHERE a.id IN (?,?,?,?)";

		return query($sql, array(in, $year, out, $year, in, $year, out, $year, 19, 20, 21, 22));
	}

	function get_biaya($param = array()){

	 	if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; 
	 	else $add = " AND transaction_date <= '".date(CURRENT_YEAR."-m-d")."' ";

		$year = CURRENT_YEAR;
		if($_GET['report_filter_period'])
			$year = date('Y', strtotime($_GET['report_filter_period']));

		$sql = "SELECT a.id, 
					   a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS credit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND is_initial = 0 AND id_coa = a.id ".$add." AND YEAR(transaction_date) = ?) AS clean_credit

				FROM tb_coa a WHERE a.id IN (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

		return query($sql, array(in, $year, out, $year, in, $year, out, $year, 23, 24, 25, 26, 27, 28, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45));
	}

	/*
	function get_pendapatan($param = array()){
		if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; else $add = " AND transaction_date <= '".date("Y-m-d")."'";

		$sql = "SELECT a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS credit 

				FROM tb_coa a WHERE a.id IN (?,?,?,?)";

		return query($sql, array(in, out, 19, 20, 21, 22));
	}

	function get_biaya($param = array()){
		if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; else $add = " AND transaction_date <= '".date("Y-m-d")."'";

		$sql = "SELECT a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS credit 

				FROM tb_coa a WHERE a.id IN (?,?,?,?,?,?,?)";

		return query($sql, array(in, out, 23, 24, 25, 26, 27, 28, 29));
	}
	*/

	function get_kolektabilitas($date = ""){
		if($_GET['report_filter_period']) $add = " AND transaction_date <= '".$_GET['report_filter_period']."'"; else $add = " AND transaction_date <= '".date("Y-m-d")."'";

		$sql = "SELECT a.*,
					   b.name AS nama_ksm,
					   (SELECT transaction_date FROM tr_debit_credit WHERE id = a.id_initial_loan) as tanggal_cair  

					   FROM ms_loan a 
					   LEFT JOIN ms_ksm b ON a.id_ksm = b.id 

					   WHERE a.is_finish = ?";
					   
		return query($sql, array(0));
	}

	function get_tunggakan($type = '', $id_loan = '', $range = ''){
		$sql = "SELECT SUM(".$type.") AS total FROM tr_loan_payment WHERE id_loan = ? AND (".$range.")";
		$sql = query($sql, array($id_loan));
		$sql = mysql_fetch_array($sql);

		return $sql['total'];
	}

	function kolektabilitas_status($id_loan = '', $due_date = ''){
		$sql = "SELECT COUNT(id) AS total, SUM(loan_total) loan_total, SUM(loan_remaining) AS loan_remaining FROM tr_loan_payment WHERE id_loan = ? AND loan_remaining > ? AND due_date <= ?";
		$sql = query($sql, array($id_loan, 0, $due_date));
		return mysql_fetch_array($sql);
	}

	function get_laba_rugi($type = '', $second_type = '', $is_all = false){
		$year = CURRENT_YEAR;
		$end = date(CURRENT_YEAR.'-m-d');
		if($is_all) $end = date(CURRENT_YEAR.'-12-31');

		if(get_acc_start() == CURRENT_YEAR) $add = "OR is_initial = 1";

		if($_GET['report_filter_period']){
			$year = date('Y', strtotime($_GET['report_filter_period']));
			$end = date('Y-m-d', strtotime($_GET['report_filter_period']));	
		}
	
		$sql = "SELECT a.name,
					   a.code,
					   a.id,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = a.id AND type = ? AND ((YEAR(transaction_date) = ? AND transaction_date <= ?) ".$add.")) AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = a.id AND type = ? AND ((YEAR(transaction_date) = ? AND transaction_date <= ?) ".$add.")) AS credit 

				FROM tb_coa a WHERE a.type IN (?";
		
		if($second_type) $sql .= ", ?";
		$sql .= ")";
	
		return query($sql, array('in', $year, $end, 'out', $year, $end, $type, $second_type));
	}

	function get_pasiva(){
		$sql = "SELECT a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = a.id AND type = ?) AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = a.id AND type = ?) AS credit

				FROM tb_coa a WHERE a.type IN (?, ?)";

		return query($sql, array('in', 'out', 'hutang', 'modal'));
	}

	function get_in_out($id = ''){
		$sql = "SELECT a.* FROM tr_debit_credit a WHERE a.id = ?";
		$sql = query($sql, array($id));

		return mysql_fetch_array($sql); 

	}

	function get_print_pindah_buku($id = ''){
		$sql = "SELECT a.*,
					(SELECT c.name FROM tr_debit_credit b LEFT JOIN tb_coa c ON b.id_coa = c.id WHERE b.no = a.no AND b.is_move = 1 AND b.type = 'out') AS credit,
					(SELECT e.name FROM tr_debit_credit d LEFT JOIN tb_coa e ON d.id_coa = e.id WHERE d.no = a.no AND d.is_move = 1 AND d.type = 'in') AS debit
				FROM tr_debit_credit a WHERE a.id = ?";

		$sql = query($sql, array($id));
		return mysql_fetch_array($sql); 
	}

	function get_ksm_name($id = ''){
		$sql = "SELECT name FROM ms_ksm WHERE id = ?";
		$sql = query($sql, array($id));
		$sql =  mysql_fetch_array($sql);  

		return $sql['name'];
	}
?>