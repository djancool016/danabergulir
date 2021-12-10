<?php
	require_once("base_setting.php");
	require_once("../model/bukti_model.php");
	

	if($_GET['halaman'] == "get_register"){
		if($_GET['id_register'] == 2){
			echo get_last_tabungan($_GET['id_ksm']);
		}
		if($_GET['id_register'] == 1){
			echo get_last_loan($_GET['id_ksm']);
		}
	}

	if($_GET['halaman'] == "kas_masuk"){
		$konten = "../view/bukti/kas_masuk.php";
		$ksm = get_ksm();
		$reg = get_register();
		$coa = get_coa_by_register(3);
		
		$code = generate_code("kas_in");

		$code_tab = generate_code("tabungan");
		$code_pinj = generate_code("pinjaman");
		$code_lain = generate_code("lainnya");


		require_once("../view/dashboard.php");
	}
	
	// function baseLoan($idksm){
	// 	$loan = get_loan($idksm);
	// 	$base = $loan["loan_total"]/$loan["loan_duration"];
	// 	return $base;
	// }

	if($_GET['halaman'] == "save_kas"){
		if(($_POST['tahun'] < get_last_accperiod()) or !get_last_accperiod()){
			if($_POST['transaction_type'] == "in") echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/bukti.php?halaman=kas_masuk&error=closed_period");</script>';
			if($_POST['transaction_type'] == "out") echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/bukti.php?halaman=kas_keluar&error=closed_period");</script>';
			
			die;
		}

		if($_POST['transaction_type'] == "out") $_POST['no'] = generate_code("kas_out");
		if($_POST['transaction_type'] == "in") 	$_POST['no'] = generate_code("kas_in");

		$param = array(
			'id_ksm' => $_POST['id_ksm'],
			'id_lkm' => 1,
			'id_coa' => '',
			'id_register' => $_POST['id_register'],
			'is_move' => 0,
			'no_transaksi' => $_POST['no'],
			'no_register' => $_POST['no_register'],
			'type' => $_POST['transaction_type'],
			'base' => '',
			'transaction_date' => $_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal'],
			'remark' => $_POST['remark'],
			'other_ksm' => '',
			'transaction_by' => $_POST['transaction_by'],
			'entry_stamp' => date("Y-m-d H:i:s"),
			'id_admin' => 1
		);

		if($_POST['id_ksm'] == "-") $param['other_ksm'] = $_POST['other_ksm'];
		
		if($_POST['id_register'] == 1){
			$transaction_code = "pinjaman";

			$param['id_coa'] = 3;
			$param['base'] = clean_decimal($_POST['base']);

			if($_POST['transaction_type'] == "out"){ 
				$status = check_first_loan(null, $_POST['id_ksm'], null, $_POST['no_register']);
				
				if($status){
					$param['type'] = 'out';

					$id = save_transaction($param);
					$check = check_first_loan($id, $_POST['id_ksm'], $param['transaction_date'], $_POST['no_register'], $_POST['base']);
					echo $check;
					if($check == "incorrect_total")
						die('<script type="text/javascript">location.replace("'.base_url().'content/controller/bukti.php?halaman=kas_keluar&error=incorrect_loan");</script>');
				}

				$kas = clean_decimal($_POST['base']);
			}

			if($_POST['transaction_type'] == "in"){
				$param['type'] = 'in';
				save_transaction($param);


				$param['id_coa'] = 19;
				$param['type'] = 'in';
				$param['base'] = clean_decimal($_POST['interest']);
				save_transaction($param);

				$kas = clean_decimal($_POST['base']) + clean_decimal($_POST['interest']);

				pay_loan("loan", $param['id_ksm'], clean_decimal($_POST['base']), $_POST['no_register']);
				pay_loan("interest", $param['id_ksm'], clean_decimal($_POST['interest']), $_POST['no_register']);
			}
		}
		else if($_POST['id_register'] == 2){
			$transaction_code = "tabungan";

			$param['id_coa'] = 10;
			$param['base'] = clean_decimal($_POST['tabungan']);
			save_transaction($param);

			$kas = clean_decimal($_POST['tabungan']);
		}
		else if($_POST['id_register'] == 3){
			$transaction_code = "lainnya";

			//$param['type'] = 'out';
			if($_POST['transaction_type'] == "out") $param['type'] = 'out';
			if($_POST['transaction_type'] == "in")  $param['type'] = 'in';

			$param['id_coa'] = $_POST['id_coa'];
			$param['other_ksm'] = $_POST['transaction_by'];
			$param['base'] = clean_decimal($_POST['lainnya']);
			$param['id_ksm'] = '-';
			save_transaction($param);

			$kas = clean_decimal($_POST['lainnya']);
		}

		if($kas){
			if($_POST['transaction_type'] == "out") $param['type'] = 'in';
			if($_POST['transaction_type'] == "in")  $param['type'] = 'out';

			$param['id_coa'] = 1;
			$param['base'] = $kas;
			save_transaction($param);
		}

		/*
		if($_POST['transaction_type'] == "out"){
			$param['id_coa'] = 1;
			$param['base'] = clean_decimal($kas);
			save_transaction($param);
		}
		*/
		
		if($_POST['transaction_type'] == "in") $code = "kas_in";
		if($_POST['transaction_type'] == "out") $code = "kas_out";
		
		update_running_number($code);
		update_running_number($transaction_code);

		if($_POST['transaction_type'] == "in"){
			write_log(get_userdata('name').' berhasil menambah transaksi kas masuk');	
			echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/report.php?halaman=catatan_uang_masuk");</script>';
		}

		if($_POST['transaction_type'] == "out"){
			write_log(get_userdata('name').' berhasil menambah transaksi kas keluar');	
			echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/report.php?halaman=catatan_uang_keluar");</script>';
		}
	}

	if($_GET['halaman'] == "pindah_buku"){
		$coa = get_coa();
		$_coa = get_coa();

		$code = generate_code("pindah_buku");

		$konten = "../view/bukti/pindah_buku.php";
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_pindah_buku"){
		if(($_POST['tahun'] < get_last_accperiod()) or !get_last_accperiod()){
			echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/bukti.php?halaman=pindah_buku&error=closed_period");</script>';
			die;
		}

		$_POST['no'] = generate_code("pindah_buku");

		$param = array(
			'id_ksm' => '-',
			'id_lkm' => 1,
			'id_coa' => $_POST['id_coa_debit'],
			'id_register' => null,
			'is_move' => 1,
			'no' => $_POST['no'],
			'no_register' => '',
			'type' => 'out',
			'base' => clean_decimal($_POST['base_debit']),
			'transaction_date' => $_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal'],
			'remark' => $_POST['remark'],
			'other_ksm' => null,
			'transaction_by' => $_POST['transaction_by'],
			'entry_stamp' => date("Y-m-d H:i:s"),
			'id_admin' => 1
		);	
		save_transaction($param);

		$param['id_coa'] = $_POST['id_coa_credit'];
		$param['type'] = 'in';
		$param['base'] = clean_decimal($_POST['base_debit']);
		save_transaction($param);

		update_running_number("pindah_buku");
		write_log(get_userdata('name').' berhasil menambah transaksi pindah buku');	

		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/report.php?halaman=catatan_pindah_buku");</script>';

	}

	if($_GET['halaman'] == "kas_keluar"){
		$ksm = get_ksm();
		$reg = get_register();
		$coa = get_coa_bukti_keluar();

		$code = generate_code("kas_out");

		$code_tab = generate_code("tabungan");
		$code_pinj = generate_code("pinjaman");
		$code_lain = generate_code("lainnya");

		$konten = "../view/bukti/kas_keluar.php";
		
		require_once("../view/dashboard.php");
	}
?>