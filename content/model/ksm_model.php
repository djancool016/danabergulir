<?php
	function get_coa($is_not = ''){
		$sql = "SELECT * FROM tb_coa";
		$sql .= " WHERE id <> ".$is_not; 
		
		return query($sql);
	}

	function get_provinsi(){
		$sql = "SELECT * FROM tb_provinsi";
		return query($sql);
	}

	function get_kota($id_provinsi = ''){
		$sql = "SELECT * FROM tb_kota WHERE id_provinsi = ?";
		return query($sql, array($id_provinsi));
	}

	function get_kecamatan($id_kota = ''){
		$sql = "SELECT * FROM tb_kecamatan WHERE id_kota = ?";
		return query($sql, array($id_kota));
	}

	function get_kelurahan($id_kecamatan = ''){
		$sql = "SELECT * FROM tb_kelurahan WHERE id_kecamatan = ?";
		return query($sql, array($id_kecamatan));
	}

	function get_lkm($id = ''){
		$sql = "SELECT * FROM ms_lkm WHERE id = ?";
		$sql = query($sql, array($id));
		
		return mysql_fetch_array($sql);
	}

	function save_ksm($param = array()){
		$sql = "INSERT INTO ms_ksm (`ksm_no`,`name`,`address`,`ketua`,`status`,`entry_stamp`,`id_admin`) VALUES (?,?,?,?,?,?,?)";
									  
		query($sql, $param);

		return mysql_insert_id();
	}

	function save_ksm_ukm($param = array()){
		if($param['status_ukm'] == "Ketua"){
			$sql = "UPDATE ms_ksm_member SET membership_status = ? WHERE id_ksm = ?";
			query($sql, array('Anggota', $param['id_ksm']));
		}

		$sql = "INSERT INTO ms_ksm_member (`id_ksm`,`name`,`sex`,`id_no`,`ps2_no`,`membership_status`,`entry_stamp`,`id_admin`,`id_lkm`) VALUES (?,?,?,?,?,?,?,?,?)";
									  
		query($sql, $param);
	}

	function get_anggota(){
		$sql = "SELECT a.*, 
					(select name from ms_ksm_member where id_ksm = a.id and membership_status = ?) as ketua_name,
					(select COUNT(id) from tr_debit_credit where id_ksm = a.id) as transaction_number 

					from ms_ksm a order by a.id desc";
		return query($sql, array('Ketua'));
	}

	function clear_ksm_ukm($param = array()){
		query($param);
	}

	function get_delete_ukm(){
		$sql = "DELETE from ms_ksm_member where id ='".$_GET['id']."'";
		return query($sql);
	}

	function hapus_ksm($id = ''){
		$sql = "DELETE FROM ms_ksm_member WHERE id_ksm = ?";
		query($sql, array($id));

		$sql = "DELETE FROM ms_ksm WHERE id = ?";
		query($sql, array($id));
	}

	function get_id_ksm(){
		$sql = "SELECT * from ms_ksm where id ='".$_GET['edit']."'";
		return query($sql);
	}

	function get_id_ukm($id_ksm = ''){
		$sql = "SELECT * from ms_ksm_member where id_ksm = ?";
		return query($sql, array($id_ksm));
	}

	function get_id_ukm_ksm(){
		$sql = "SELECT * from ms_ksm_member where id ='".$_GET['edit']."'";
		return query($sql);
	}

	function save_edit_ksm($param = array()){
		$sql = "UPDATE ms_ksm SET ksm_no = ?,
								  name = ?,
								  address = ?, 
								  ketua = ?
								  								   
								  WHERE id = ? ";

									  
		query($sql, $param);
	}

	function save_edit_ukm($param = array(), $id_ksm = ''){
		if($param['membership_status'] == "Ketua"){
			$sql = "UPDATE ms_ksm_member SET membership_status = ? WHERE id_ksm = ?";
			query($sql, array('Anggota', $id_ksm));
		}

		$sql = "UPDATE ms_ksm_member SET name = ?,
									  sex = ?,
									  id_no = ?,
									  ps2_no = ?,
									  membership_status = ?

									  WHERE id = ? ";
									  
		query($sql, $param);
	}

	function get_id_lkm(){
		$sql = "SELECT * from ms_data_lkm where id = '".$_GET['edit']."' ";
		return query($sql);
	}


	function edit_lkm($param = array()){
		$sql = "UPDATE ms_lkm SET name = ?,
								  id_provinsi = ?,
								  id_kota = ?,
								  id_kecamatan = ?,
								  id_kelurahan = ?,
								  alamat = ?,
								  acc_period_start = ?,
								  edit_stamp = ? 

								  WHERE id = ? ";
		query($sql, $param);
	}

	function simpan_loan_payment($param = array()){
		$sql = "INSERT INTO tr_loan_payment (`id_ksm`,`id_lkm`,`id_loan`,`payment_no`,`due_date`,`loan_total`,`loan_remaining`,`interest_total`,`interest_remaining`,`entry_stamp`,`id_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
									  
		query($sql, $param);
	}

	function simpan_pinjaman_ksm($param = array()){
		$sql = "INSERT INTO ms_loan (`id_ksm`,`id_lkm`,`loan_no`, `loan_total`,`loan_duration`,`loan_interest`,`loan_start`,`loan_end`,`entry_stamp`,`id_admin`) VALUES (?,?,?,?,?,?,?,?,?,?)";							  
		query($sql, $param);
		$id = mysql_insert_id();
		
		$sql = "SELECT id, loan_total FROM ms_ksm WHERE id = ?";
		$sql = query($sql, array($param['id_ksm']));
		$sql = mysql_fetch_array($sql);
		$total = $sql['loan_total'] + 1;

		query("UPDATE ms_ksm SET loan_total = ? WHERE id = ?", array($total, $sql['id']));
		return $id; 
	}

	function simpan_pinjaman_ksm_lama($param = array(), $loan_total = 1){
		$sql = "INSERT INTO ms_loan (`id_ksm`,`id_lkm`,`loan_no`, `loan_total`,`loan_duration`,`loan_interest`,`loan_start`,`loan_end`,`realization_date`,`realization_value`,`entry_stamp`,`id_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";							  
		query($sql, $param);
		$id = mysql_insert_id();

		$sql = "SELECT id, loan_total FROM ms_ksm WHERE id = ?";
		$sql = query($sql, array($param['id_ksm']));
		$sql = mysql_fetch_array($sql);
		$total = $sql['loan_total'] + $loan_total;

		query("UPDATE ms_ksm SET loan_total = ? WHERE id = ?", array($total, $sql['id']));
		return $id; 
	}

	function set_existing_loan($id = '', $angsuran_sesungguhnya = '', $denda_sesungguhnya = ''){
		query("UPDATE ms_loan SET is_existing = ? WHERE id = ?", array(1, $id));

		$sql = query("SELECT * FROM ms_loan WHERE id = ?", array($id));
		$data = mysql_fetch_array($sql);

		$duration = $data['loan_duration'];

		$orig_loan = $data['loan_total'] / $data['loan_duration'];
		$orig_int = (($loan / 100) * $data['loan_interest']);

		for($i=1;$i<=$duration;$i++){

			if($angsuran_sesungguhnya >= $orig_loan){
				$loan = 0;
			}
			else{
				$loan = $angsuran_sesungguhnya;
			}

			$angsuran_sesungguhnya -= $orig_loan;
			
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

	function simpan_debit_credit($param = array()){
		$sql = "INSERT INTO tr_debit_credit (`id_ksm`,`id_lkm`,`id_coa`,`id_register`,`type`,`base`,`interest`,`transaction_date`,`remark`,`entry_stamp`,`id_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
									  
		query($sql, $param);
	}

	function join_register_pinjaman(){
		$sql = "SELECT a.*, 
					   b.name, 
					   b.ksm_no, 
					   b.loan_total AS loan_no, 
					   (SELECT transaction_date FROM tr_debit_credit WHERE id = a.id_initial_loan) as tanggal_cair,
					   (SELECT COUNT(id) FROM tr_debit_credit WHERE id_ksm = a.id_ksm AND no_register = a.loan_no) AS transaction_number

					   FROM ms_loan a 

					   LEFT JOIN ms_ksm b ON b.id = a.id_ksm 
					   ORDER BY id DESC";

		return query($sql, array(3, 'out'));
	}

	function get_data_lkm(){
		$sql = "SELECT * FROM ms_ksm";
		return query($sql);
	}

	function save_saldo_awal($param = array()){
		$sql = "INSERT INTO ms_saving (`id_ksm`,`id_lkm`,`balance`,`acc_no`,`opening_date`,`is_existing`,`entry_stamp`,`id_admin`) VALUES (?,?,?,?,?,?,?,?)";
									  
		query($sql, $param);
	}

	function get_register_tabungan($param = array()){
		$sql = "SELECT a.*, 
					   b.name, 
					   (SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = ? AND id_ksm = a.id_ksm AND type = ?) AS credit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE id_coa = ? AND id_ksm = a.id_ksm AND type = ?) AS debit,
					   b.ksm_no 

					   FROM ms_saving a 

					   LEFT JOIN ms_ksm b ON b.id = a.id_ksm ORDER BY a.id DESC";

		return query($sql, array(10, 'in', 10, 'out'));
	}

	function save_transaction($param = array()){
		$sql = "INSERT INTO tr_debit_credit (`id_ksm`,
											 `id_lkm`,
											 `id_coa`,
											 `id_register`,
											 `is_move`,
											 `no`,
											 `type`,
											 `base`,
											 `transaction_date`,
											 `remark`,
											 `other_ksm`,
											 `transaction_by`,
											 `is_initial`,
											 `entry_stamp`,
											 `id_admin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		query($sql, $param);
	}

	function get_kartu_pinjaman($id_ksm = ''){
		$sql = "SELECT a.* FROM tr_loan_payment a LEFT JOIN ms_loan b ON a.id_loan = b.id WHERE b.id_ksm = ? AND is_finish = 0"; //AND a.due_date <= ?"; 
		
		return query($sql, array($id_ksm));
	}

	function get_saving($id_ksm = ''){
		$sql = "SELECT a.*,
					   b.name 
					   FROM ms_saving a LEFT JOIN ms_ksm b ON a.id_ksm = b.id WHERE a.id_ksm = ?"; 
					   
		$sql = query($sql, array($id_ksm));

		return mysql_fetch_array($sql);
	}

	function get_loan($id_ksm = ''){
		$sql = "SELECT a.*,
					   a.loan_start AS akad_date,
					   (SELECT transaction_date FROM tr_debit_credit WHERE id = a.id_initial_loan) AS loan_start, 
					   b.name FROM ms_loan a LEFT JOIN ms_ksm b ON a.id_ksm = b.id WHERE a.id_ksm = ? AND is_finish = ?"; 
		$sql = query($sql, array($id_ksm, 0));

		return mysql_fetch_array($sql);
	}

	function get_tabungan($id_ksm = ''){
		$sql = "SELECT * FROM tr_debit_credit WHERE id_coa = ? AND id_ksm = ?";
		return query($sql, array(10, $id_ksm));
	}

	function get_tabungan_existing($id_ksm = ''){
		$sql = "SELECT * FROM ms_saving WHERE id_ksm = ? AND is_existing = ?";
		$sql = query($sql, array($id_ksm, 1));

		return mysql_fetch_array($sql);
	}

	function cek_is_used(){
		$sql = "SELECT COUNT(id) AS total FROM tr_debit_credit WHERE is_initial = ?";
		$sql = query($sql, array(0));

		$sql = mysql_fetch_array($sql);
		return $sql['total'];
	}

	function truncate_transaction(){
		$sql = "TRUNCATE tr_debit_credit";
		$sql = query($sql);
	}

	function get_buku_besar(){
		$sql = "SELECT * FROM tr_debit_credit WHERE is_initial = ? ORDER BY id_coa ASC";
		$sql = query($sql, array(1));

		$return = array();
		while($data = mysql_fetch_array($sql))
			$return[$data['id_coa']] = $data['base'];
		
		return $return;
	}

	function cek_pinjaman($id_ksm = ''){
		$sql = "SELECT loan_total, (SELECT COUNT(id) FROM ms_loan WHERE id_ksm = ? AND is_finish = ?) AS unfinished FROM ms_ksm WHERE id = ?";
		$sql = query($sql, array($id_ksm, 0, $id_ksm));
		$data = mysql_fetch_array($sql);

		//print_r($data);

		if($data['unfinished'] or $data['loan_total'] == 1000) return false;
		else return true;
	}

	function get_ksm_saving(){
		$sql = "SELECT a.id_ksm AS id, b.name FROM ms_saving a LEFT JOIN ms_ksm b ON a.id_ksm = b.id GROUP BY a.id_ksm"; 
		return query($sql);
	}

	function get_ksm_list(){
		$sql = "SELECT a.id_ksm AS id, b.name FROM ms_loan a LEFT JOIN ms_ksm b ON a.id_ksm = b.id GROUP BY a.id_ksm"; 
		return query($sql);
	}

	function cek_ktp($no_ktp = ''){
		$sql = "SELECT COUNT(a.id) as total FROM ms_ksm_member a LEFT JOIN ms_ksm b ON a.id_ksm = b.id WHERE a.id_no = ? AND b.status = ?";
		$sql = query($sql, array($no_ktp, 1));
		$sql = mysql_fetch_array($sql);

		if($sql['total']) return false;
		else return true;
	}

	function set_exsisting_loan($id = '', $angsuran_sesungguhnya = '', $jasa_sesungguhnya = ''){
		$sql = query("SELECT * FROM ms_loan WHERE id = ?", array($id));
		$data = mysql_fetch_array($sql);

		$angsuran_sesungguhnya = clean_decimal($angsuran_sesungguhnya);
		$jasa_sesungguhnya = clean_decimal($jasa_sesungguhnya);

		$angsuran_sesungguhnya = $data['loan_total'] - $angsuran_sesungguhnya ;
		$jasa_sesungguhnya = (($data['loan_total'] / 100) * $data['loan_interest']) - $jasa_sesungguhnya;
		
		$duration = $data['loan_duration'];
		$date = $data['realization_date'];

		$orig_loan = $data['loan_total'] / $data['loan_duration'];
		$orig_int = (($orig_loan / 100) * $data['loan_interest']);

		for($i=1;$i<=$duration;$i++){

			if($angsuran_sesungguhnya >= $orig_loan) $loan = 0;
			else if($angsuran_sesungguhnya < $orig_loan){
				$loan = $angsuran_sesungguhnya;

				if($loan >= $orig_loan) $loan = $orig_loan;
				else $loan = $orig_loan - $angsuran_sesungguhnya;
			}
			if($angsuran_sesungguhnya < 0){
				$angsuran_sesungguhnya_ *= -1;
				if($angsuran_sesungguhnya_ < $orig_loan)
					$loan = $orig_loan;
			}
			$angsuran_sesungguhnya -= $orig_loan;

			if($jasa_sesungguhnya >= $orig_int) $int = 0;
			else if($jasa_sesungguhnya < $orig_int){
				$int = $jasa_sesungguhnya;

				if($int >= $orig_int) $int = $orig_int;
				else $int = $orig_int - $jasa_sesungguhnya;
			}
			if($jasa_sesungguhnya < 0){
				$jasa_sesungguhnya_ *= -1;
				if($jasa_sesungguhnya_ < $orig_int)
					$int = $orig_int;
			}
			$jasa_sesungguhnya -= $orig_int;

			
			$_param = array(
				'id_ksm' => $data['id_ksm'],
				'id_lkm' => get_userdata('id_lkm'),
				'id_loan' => $data['id'],
				'payment_no' => $i,
				'due_date' => date("Y-m-d", strtotime($date." + ".$i." month")),
				'loan_total' => $orig_loan,
				'loan_remaining' => $loan,
				'interest_total' => $orig_int,
				'interest_remaining' => $int,
				'entry_stamp' => date('Y-m-d H:i:s'),
				'id_admin' => get_userdata('id')
			);

			simpan_loan_payment($_param);
		}		
	}

	function get_total_existing(){
		$sql = "SELECT SUM(realization_value) AS total FROM ms_loan";
		$sql = mysql_query($sql);
		$sql = mysql_fetch_array($sql);
		
		return $sql['total'];
	}

	function get_existing_saving(){
		$sql = "SELECT SUM(balance) AS total FROM ms_saving WHERE is_existing = 1";
		$sql = mysql_query($sql);
		$sql = mysql_fetch_array($sql);
		
		return $sql['total'];
	}

	function get_kolektabilitas($date = ""){
		$sql = "SELECT a.*,
					   b.name AS nama_ksm,
					   (SELECT transaction_date FROM tr_debit_credit WHERE id = a.id_initial_loan) as tanggal_cair  

					   FROM ms_loan a 
					   LEFT JOIN ms_ksm b ON a.id_ksm = b.id 

					   WHERE a.is_finish = ?";
					   
		return query($sql, array(0));
	}

	function kolektabilitas_status($id_loan = '', $due_date = ''){
		$sql = "SELECT COUNT(id) AS total, SUM(loan_total) loan_total, SUM(loan_remaining) AS loan_remaining FROM tr_loan_payment WHERE id_loan = ? AND loan_remaining > ? AND due_date <= ?";
		$sql = query($sql, array($id_loan, 0, $due_date));
		return mysql_fetch_array($sql);
	}

	function get_tunggakan($type = '', $id_loan = '', $range = ''){
		$sql = "SELECT SUM(".$type.") AS total FROM tr_loan_payment WHERE id_loan = ? AND (".$range.")";
		$sql = query($sql, array($id_loan));
		$sql = mysql_fetch_array($sql);

		return $sql['total'];
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

	function get_coa_total($id_coa = ''){
		$sql = "SELECT SUM(base) AS total FROM tr_debit_credit WHERE id_coa = ?";
		$sql = query($sql, array($id_coa));
		$sql = mysql_fetch_array($sql);

		return $sql['total'];
	}


	function get_neraca_saldo($id = '', $month = ''){
		$add = " AND transaction_date <= '".date("Y-m-d", strtotime(CURRENT_YEAR."-".$month."-31"))."' ";
		$year = CURRENT_YEAR;

		$sql = "SELECT a.id, 
					   a.name,
					   a.code,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS debit,
					   (SELECT SUM(base) FROM tr_debit_credit WHERE type = ? AND id_coa = a.id ".$add.") AS credit
				
				FROM tb_coa a WHERE a.id = ?";

		$sql = query($sql, array(in, out, $id));
		$sql = mysql_fetch_array($sql);

		if($id == 1 or $id == 2 or $id == 3) return ($sql['credit'] - $sql['debit']);
		else return ($sql['debit'] - $sql['credit']);
	}

	/*
	function get_idle_money($id_coa = '', $month = '', $year = ''){
		$sql = "SELECT klasifikasi FROM tb_coa WHERE id = ?";
		$sql = query($sql, array($id_coa));
		$sql = mysql_fetch_array($sql);
		$klasifikasi = $sql['klasifikasi'];

		$sql = "SELECT SUM(base) AS total FROM tr_debit_credit WHERE type = ? AND id_coa = ? AND ";
		if($month == 1) $sql .= " transaction_date <= '".$year."-01-31'";
		else $sql .= "(MONTH(transaction_date) = ? AND YEAR(transaction_date) = ?)";
		$sql = query($sql, array('in', $id_coa, $month, $year));
		$sql = mysql_fetch_array($sql);
		$in = $sql['total'];


		$sql = "SELECT SUM(base) AS total FROM tr_debit_credit WHERE type = ? AND id_coa = ? AND ";
		if($month == 1) $sql .= " transaction_date <= '".$year."-01-31'";
		else $sql .= "(MONTH(transaction_date) = ? AND YEAR(transaction_date) = ?)";
		$sql = query($sql, array('out', $id_coa, $month, $year));
		$sql = mysql_fetch_array($sql);
		$out = $sql['total'];
		
		//echo "[".$in." - ".$out." ] ";

		if($klasifikasi == "debit")
			$return = $out - $in;
		else
			$return = $in - $out;

		return $return;
	}
	*/

	function close_period(){
		$sql = "UPDATE ms_lkm SET current_year = ? WHERE id = ?";
		query($sql, array(CURRENT_YEAR, get_userdata('id_lkm')));
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

		$sql = "UPDATE ms_lkm SET current_year = null WHERE id = ?";
		query($sql, array(get_userdata('id_lkm')));
		
		write_log(get_userdata('name').' berhasil mereset data aplikasi');	
	}

	function get_user(){
		$sql = "SELECT * FROM tb_admin WHERE id_lkm = ?";
		$sql = query($sql, array(get_userdata('id_lkm')));

		return mysql_fetch_array($sql);
	}

	function delete_pinjaman($id = ''){
		$sql = "DELETE FROM tr_loan_payment WHERE id_loan = ?";
		query($sql, array($id));		

		$sql = "DELETE FROM ms_loan WHERE id = ?";
		query($sql, array($id));
	}

	function delete_tabungan($id = ''){
		$sql = "DELETE FROM ms_saving WHERE id = ?";
		query($sql, array($id));		
	}

	function cek_tabungan($id = ''){
		$sql = "SELECT id FROM ms_saving WHERE id_ksm = ?";
		$sql = query($sql, array($id));

		return mysql_num_rows($sql);
	}
?>