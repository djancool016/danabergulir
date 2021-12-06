<?php
	require_once("base_setting.php");
	require_once("../model/ksm_model.php");

	if(!$_GET['halaman']){
		$konten = "../view/company_profile/home.php";
		$date = date("Y-m-d");
		$query = get_kolektabilitas();
		$month = array('Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "ksm"){
		$a = get_anggota();
		$edit = get_id_ksm();
		$id = get_delete_ukm();
		$konten = "../view/company_profile/ksm.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "edit_ksm"){
		$a = get_id_ksm();
		$konten = "../view/company_profile/edit_ksm.php";
		$action_edit = base_url()."content/controller/dashboard.php?halaman=save_edit_ksm";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "view_ksm"){
		$a = get_id_ksm();
		$konten = "../view/company_profile/view_ksm.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "kartu_pinjaman"){
		$id_ksm = $_GET['id_ksm'];

		$master = get_loan($id_ksm);
		$query = get_kartu_pinjaman($id_ksm);

		$ksm = get_ksm_list();

		$konten = "../view/company_profile/kartu-pinjaman.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "kartu_tabungan"){
		$id_ksm = $_GET['id_ksm'];

		$master = get_saving($id_ksm);

		$query = get_tabungan($id_ksm);
		$ksm = get_ksm_saving();

		$konten = "../view/company_profile/kartu-tabungan.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_edit_ksm"){
		$param = array(
			'no_ksm' => $_POST['id_ksm'],
			'nama_ksm' => $_POST['nama_ksm'],
			'alamat_ksm' => $_POST['alamat_ksm'],
			'ketua' => $_POST['ketua_ksm'],
			'id' => $_POST['id']
		);

		save_edit_ksm($param);

		write_log(get_userdata('name').' berhasil mengedit data KSM '.$_POST['nama_ksm']);	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=ksm");</script>';
	}

	if($_GET['halaman'] == "tabungan_awal_ksm"){
		$a = get_anggota();
		$action = base_url()."content/controller/dashboard.php?halaman=save_tabungan_awal_ksm";	
		$code = generate_code("tabungan");

		$konten = "../view/company_profile/tabungan_awal_ksm.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "tabungan_ksm_lama"){
		$a = get_anggota();
		$action = base_url()."content/controller/dashboard.php?halaman=save_tabungan_awal_ksm";	
		$code = generate_code("tabungan");

		$konten = "../view/company_profile/tabungan_ksm_lama.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "edit_ukm"){
		$a = get_id_ukm_ksm();
		$konten = "../view/company_profile/edit_ksm_ukm.php";
		$action_edit = base_url()."content/controller/dashboard.php?halaman=save_edit_ukm";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_edit_ukm"){
		if($_POST['no_ktp_ukm'] != $_POST['old_ktp']){
			if(!cek_ktp($_POST['no_ktp_ukm']))
				die('<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=edit_ukm&edit='.$_POST['id'].'&id_ksm='.$_POST['id_ksm'].'&error=duplicate_id");</script>');
		}

		$param = array(
			'name' => $_POST['nama_ukm'],
			'sex' => $_POST['sex'],
			'id_no' => $_POST['no_ktp_ukm'],
			'ps2_no' => $_POST['no_ps2_ukm'],
			'membership_status' => $_POST['status_ukm'],
			'id' => $_POST['id']
		);

		save_edit_ukm($param, $_POST['id_ksm']);

		write_log(get_userdata('name').' berhasil mengedit data UKM '.$_POST['nama_ukm']);	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=edit_ksm&edit='.$_POST[id_ksm].'");</script>';
	}

	if($_GET['halaman'] == "tambah_ukm"){
		$a = get_id_ukm_ksm();
		$konten = "../view/company_profile/tambah_ukm.php";
		$action_add = base_url()."content/controller/dashboard.php?halaman=save_action_add_ukm";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_action_add_ukm"){
		if(!cek_ktp($_POST['no_ktp_ukm']))
			die('<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=tambah_ukm&edit=&id_ksm='.$_POST['id'].'&error=duplicate_id");</script>');

		$param = array(
			'id_ksm' => $_POST['id'],
			'nama_ukm' => $_POST['nama_ukm'],
			'sex' => $_POST['sex'],
			'no_ktp_ukm' => $_POST['no_ktp_ukm'],
			'no_ps2_ukm' => $_POST['no_ps2_ukm'],
			'status_ukm' => $_POST['status_ukm'],
			'date_created' => date('Y-m-d H:i:s')
		);

		save_ksm_ukm($param);

		write_log(get_userdata('name').' berhasil menyimpan data UKM '.$_POST['nama_ukm']);	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=edit_ksm&edit='.$_POST[id_ksm].'");</script>';
	}

	if($_GET['halaman'] == "hapus_ksm"){
		write_log(get_userdata('name').' berhasil menyimpan menghapus KSM '.log_ksm_name($_GET['id']));	

		$id = hapus_ksm($_GET['id']);		
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=ksm");</script>';
	}

	if($_GET['halaman'] == "delete_ksm"){
		$id = get_delete_ukm();		
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=edit_ksm&edit='.$_GET[id_ksm].'");</script>';
	}

	if($_GET['halaman'] == "pengaturan"){
		$user = get_user();

		$fill = get_lkm(get_userdata('id_lkm'));
		
		$provinsi 	= get_provinsi();

		if(!$_GET['id_provinsi']) $id_provinsi = $fill['id_provinsi'];
		else $id_provinsi = $_GET['id_provinsi'];

		if(!$_GET['id_kota']) $id_kota = $fill['id_kota'];
		else $id_kota = $_GET['id_kota'];

		if(!$_GET['id_kecamatan']) $id_kecamatan = $fill['id_kecamatan'];
		else $id_kecamatan = $_GET['id_kecamatan'];

		if($id_provinsi)	{ $kota = get_kota($id_provinsi); }
		if($id_kota)		{ $kecamatan = get_kecamatan($id_kota); }
		if($id_kecamatan)	{ $kelurahan = get_kelurahan($id_kecamatan); }
						
		$id_kelurahan = $fill['id_kelurahan'];

		$konten = "../view/company_profile/pengaturan.php";
		$action = base_url()."content/controller/dashboard.php?halaman=save_edit_lkm";

		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_edit_lkm"){
		$param = array(
			'nama_lkm' => $_POST['nama_lkm'],
			'id_provinsi' => $_POST['provinsi_lkm'],
			'id_kota' => $_POST['kota_lkm'],
			'id_kecamatan' => $_POST['kecamatan_lkm'],
			'id_kelurahan' => $_POST['kelurahan_lkm'],
			'alamat_lkm' => $_POST['alamat_lkm'],
			'acc_period_start' => date("Y-m-d", strtotime($_POST['tahun']."-".$_POST['bulan']."-".$_POST['tanggal'])),
			'edit_stamp' => date("Y-m-d"),
			'id' => get_userdata("id_lkm")
		);
		edit_lkm($param);
		
		write_log(get_userdata('name').' berhasil mengedit data LKM '.$_POST['nama_lkm']);	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=buku_besar");</script>';
	}

	if($_GET['halaman'] == "tambah_ksm"){
		//unset($_SESSION['data_ksm']);

		$code = generate_code("ksm");

		$konten = "../view/company_profile/tambah_ksm.php";
		$action = base_url()."content/controller/dashboard.php?halaman=save_tambah_ksm";
		$action_finish = base_url()."content/controller/dashboard.php?halaman=save_ksm_finish";
		$action_clear = base_url()."content/controller/dashboard.php?halaman=clear_ksm_finish";
		$data_ksm = array(
			'master' => $_SESSION['data_ksm']['master'],
			'detail' => $_SESSION['data_ksm']['detail']
		);
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_tambah_ksm"){
		$master = array(
			'id_ksm' => $_POST['id_ksm'],
			'nama_ksm' => $_POST['nama_ksm'],
			'alamat_ksm' => $_POST['alamat_ksm'],
			'ketua_ksm' => $_POST['ketua_ksm']
		);		

		$_SESSION['data_ksm']['master'] = $master;

		if(!empty($_SESSION['data_ksm']['detail']))
			$detail = $_SESSION['data_ksm']['detail'];
		else
			$detail = array();

		if(!cek_ktp($_POST['no_ktp_ukm']))
			die('<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=tambah_ksm&error=duplicate_id");</script>');

		foreach($_SESSION['data_ksm']['detail'] as $data){
			if($data['no_ktp_ukm'] == $_POST['no_ktp_ukm'])	
				die('<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=tambah_ksm&error=duplicate_id");</script>');
		}

		
		array_push($detail, array(
			'nama_ukm' => $_POST['nama_ukm'],
			'sex' => $_POST['sex'],
			'no_ktp_ukm' => $_POST['no_ktp_ukm'],
			'no_ps2_ukm' => $_POST['no_ps2_ukm'],
			'status_ukm' => $_POST['status_ukm']
		));

		$_SESSION['data_ksm']['detail'] = $detail;
		if($_POST['status_ukm'] == "Ketua") $_SESSION['data_ksm']['has_leader'] = 1;


		//var_dump($detail);
		//save_guestbook($param);
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=tambah_ksm");</script>';
	}

	if($_GET['halaman'] == "save_ksm_finish"){

		$master = $_SESSION['data_ksm']['master'];
		$detail = $_SESSION['data_ksm']['detail'];

		if(!$detail) echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=tambah_ksm&error=null_data");</script>';

		$param = array(
			'ksm_no' => $master['id_ksm'],
			'name' => $master['nama_ksm'],
			'address' => $master['alamat_ksm'],
			'ketua' => $master['ketua_ksm'],
			'status' => 1,
			'entry_stamp' => date('Y-m-d H:i:s'),
			'id_admin' => $_SESSION['id_admin']
		);

		$id_ksm = save_ksm($param);
		
		foreach($detail as $row) {
			$param = array(
				'id_ksm' => $id_ksm,
				'name' => $row['nama_ukm'],
				'sex' => $row['sex'],
				'id_no' => $row['no_ktp_ukm'],
				'ps2_no' => $row['no_ps2_ukm'],
				'membership_status' => $row['status_ukm'],
				'entry_stamp' => date('Y-m-d H:i:s'),
				'id_admin' => get_userdata('id'),
				'id_lkm' => get_userdata('id_lkm')
			);	
			save_ksm_ukm($param);

			unset($_SESSION['data_ksm']);

			write_log(get_userdata('name').' berhasil menyimpan data KSM '.$master['nama_ksm']);	
			echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=ksm");</script>';
		}

		update_running_number("ksm");
	}
	
	if($_GET['halaman'] == "clear_ksm_finish"){		
		clear_ksm_ukm($param);
		unset($_SESSION['data_ksm']);

		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=ksm");</script>';
	}

	if($_GET['halaman'] == "edit_ksm_ukm"){
		$master = $_SESSION['data_ksm']['master'];
		$detail = $_SESSION['data_ksm']['detail'];
		
		clear_ksm_ukm($param);
		$_SESSION['data_ksm']['master'] = '';
		$_SESSION['data_ksm']['detail'] = '';
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=tambah_ksm");</script>';
	}	

	if($_GET['halaman'] == "pinjaman_ksm"){
		$a = get_anggota();		
		$konten = "../view/company_profile/pinjaman_ksm.php";
		$action = base_url()."content/controller/dashboard.php?halaman=save_pinjaman_ksm";
		$is_used = cek_is_used();


		$code = generate_code("pinjaman");

		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "pinjaman_ksm_lama"){
		$a = get_anggota();		
		$konten = "../view/company_profile/pinjaman_ksm_lama.php";
		$action = base_url()."content/controller/dashboard.php?halaman=save_pinjaman_ksm_lama";
		
		$code = generate_code("pinjaman");

		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_pinjaman_ksm"){

		if(!cek_pinjaman($_POST['id_ksm']))
			die('<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=pinjaman_ksm&error=active_ksm");</script>');
		
		$loan_start = $_POST['tahun_pinjaman'].'-'.$_POST['bulan_pinjaman'].'-'.$_POST['tanggal_pinjaman'];
		
		$param = array(
			'id_ksm' => $_POST['id_ksm'],
			'id_lkm' => get_userdata('id_lkm'),
			'loan_no' => $_POST['loan_no'],
			'loan_total' => clean_decimal($_POST['loan_total']),
			'loan_duration' => $_POST['loan_duration'],
			'loan_interest' => clean_decimal($_POST['loan_interest']),
			'loan_start' => $loan_start,
			'loan_end' => date("Y-m-d", strtotime($loan_start.' + '.$_POST['loan_duration'].' month')),
			'entry_stamp' => date('Y-m-d H:i:s'),
			'id_admin' => get_userdata('id')
		);
		
		$id = simpan_pinjaman_ksm($param);
		
		update_running_number("pinjaman");

		write_log(get_userdata('name').' berhasil menyimpan pinjaman KSM '.log_ksm_name($_POST['id_ksm']));	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=register_pinjaman");</script>';
	}

	if($_GET['halaman'] == "save_pinjaman_ksm_lama"){

		if(!cek_pinjaman($_POST['id_ksm']))
			die('<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=pinjaman_ksm_lama&error=active_ksm");</script>');

		$loan_start = $_POST['tahun_pinjaman'].'-'.$_POST['bulan_pinjaman'].'-'.$_POST['tanggal_pinjaman'];
		$loan_acc = $_POST['tahun_realisasi'].'-'.$_POST['bulan_realisasi'].'-'.$_POST['tanggal_realisasi'];

		$param = array(
			'id_ksm' => $_POST['id_ksm'],
			'id_lkm' => get_userdata('id_lkm'),
			'loan_no' => $_POST['loan_no'],
			'loan_total' => clean_decimal($_POST['loan_total']),
			'loan_duration' => $_POST['loan_duration'],
			'loan_interest' => clean_decimal($_POST['loan_interest']),
			'loan_start' => $loan_start,
			'loan_end' => date("Y-m-d", strtotime($loan_start.' + '.$_POST['loan_duration'].' month')),
			'realization_date' => $loan_acc,
			'realization_value' => clean_decimal($_POST['angsuran_sesungguhnya']),
			'entry_stamp' => date('Y-m-d H:i:s'),
			'id_admin' => get_userdata('id')
		);

		$id = simpan_pinjaman_ksm_lama($param, $_POST['loan_ke']);
		update_running_number("pinjaman");

		set_exsisting_loan($id, $_POST['angsuran_sesungguhnya'], $_POST['jasa_sesungguhnya']);
		write_log(get_userdata('name').' berhasil menyimpan pinjaman awal KSM '.log_ksm_name($_POST['id_ksm']));	

		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=register_pinjaman");</script>';
	}

	if($_GET['halaman'] == "register_pinjaman"){
		$a = join_register_pinjaman();		
		$konten = "../view/company_profile/register_pinjaman.php";
		
		require_once("../view/dashboard.php");
	}


	if($_GET['halaman'] == "delete_pinjaman"){
		delete_pinjaman($_GET['id']);
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=register_pinjaman");</script>';
	}

	if($_GET['halaman'] == "delete_tabungan"){
		delete_tabungan($_GET['id']);
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=register_tabungan");</script>';
	}

	if($_GET['halaman'] == "register_tabungan"){
		$a = get_register_tabungan();
		$lkm = get_data_lkm();		

		$konten = "../view/company_profile/register_tabungan.php";
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "buku_besar"){
		$a = get_coa('18');
		$fill = get_buku_besar();

		$is_used = cek_is_used();
		$konten = "../view/company_profile/buku_besar.php";
		if($is_used)
			$konten = "../view/company_profile/buku_besar_view.php";
	

		if($_GET['print'] == "xls"){
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment;Filename=report.xls");

			$konten = "../view/company_profile/buku_besar_print.php";

			return require_once($konten);
		}
		else if($_GET['print'] == "pdf"){
			require_once("../dompdf/dompdf_config.inc.php");

			$konten = "../view/company_profile/buku_besar_print.php";
			$dompdf = new DOMPDF();

			ob_start();
			require_once($konten);
			$html = ob_get_clean();

			$dompdf->load_html($html);

			$dompdf->render();
			$dompdf->stream("report.pdf");

			return;	
		}
		
		require_once("../view/dashboard.php");
	}

	if($_GET['halaman'] == "save_tabungan_awal_ksm"){
		$cek = cek_tabungan($_POST['id_ksm']);
		if($cek)
			die('<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=tabungan_awal_ksm&error=duplicate_id");</script>');

		$param = array(
			'id_ksm' => $_POST['id_ksm'],
			'id_lkm' => get_userdata('id_lkm'),
			'balance' =>  clean_decimal($_POST['balance']),
			'acc_no' => $_POST['acc_no'],
			'opening_date' => date('Y-m-d'),
			'is_existing' => $_POST['is_existing'],
			'entry_stamp' => date('Y-m-d H:i:s'),
			'id_admin' => get_userdata('id')
		);	
		save_saldo_awal($param);

		/*
		$param = array(
			'id_ksm' => $_POST['id_ksm'],
			'id_lkm' => get_userdata('id_lkm'),
			'id_coa' => "3",
			'id_register' => "2",
			'type' => 'credit',
			'base' => $_POST['balance'],
			'interest' => "0",
			'transaction_date' => date('Y-m-d'),
			'remark' => "",
			'entry_stamp' => date('Y-m-d H:i:s'),
			'id_admin' => get_userdata('id')
		);

		simpan_debit_credit($param);
		*/
		update_running_number("tabungan");

		write_log(get_userdata('name').' berhasil menyimpan tabungan awal KSM '.log_ksm_name($_POST['id_ksm']));	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=register_tabungan");</script>';

	}

	if($_GET['halaman'] == "save_buku_besar"){
		truncate_transaction();
		$fill = get_lkm(get_userdata('id_lkm'));

		//print_r($fill);
		//return;

		foreach($_POST['id_coa'] as $index => $data){
			$total[$_POST['jenis'][$index]] += clean_decimal($data);

			if($_POST['type'][$index] == "in")  $type = "out"; 
			if($_POST['type'][$index] == "out") $type = "in"; 

			$param = array(
				'id_ksm' => '-',
				'id_lkm' => get_userdata('id_lkm'),
				'id_coa' => $index,
				'id_register' => null,
				'is_move' => null,
				'no' => null,
				'type' => $type,
				'base' => clean_decimal($data),
				'transaction_date' => $fill['acc_period_start'],
				'remark' => $_POST['remark'],
				'other_ksm' => null,
				'transaction_by' => $_POST['transaction_by'],
				'is_initial' => 1,
				'entry_stamp' => date("Y-m-d H:i:s"),
				'id_admin' => get_userdata('id')
			);	
			save_transaction($param);
		}

		$param = array(
			'id_ksm' => '-',
			'id_lkm' => get_userdata('id_lkm'),
			'id_coa' => 18,
			'id_register' => null,
			'is_move' => null,
			'no' => null,
			'type' => 'in',
			'base' => clean_decimal($total['harta'] - $total['beban']),
			'transaction_date' => $fill['acc_period_start'],
			'remark' => null,
			'other_ksm' => null,
			'transaction_by' => null,
			'is_initial' => 1,
			'entry_stamp' => date("Y-m-d H:i:s"),
			'id_admin' => get_userdata('id')
		);	
		save_transaction($param);
		close_period();

		write_log(get_userdata('name').' berhasil menyimpan buku besar');	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=buku_besar");</script>';
	}

	if($_GET['halaman'] == "tutup_buku"){
		$query = get_laba_rugi('pendapatan', true);
		while($data = mysql_fetch_array($query)) $laba += $data['debit'] - $data['credit']; 
		$query = get_laba_rugi('beban', true);
		while($data = mysql_fetch_array($query)) $rugi +=  $data['credit'] - $data['debit'];
		
		$posisi = $laba - $rugi;

		//$last_laba_rugi = get_laba_rugi_last(true);
		//$posisi = $posisi + $last_laba_rugi;

		if($posisi >= 0) $type = "in";
		else{ $type = "out"; $posisi *= -1; }

		$param = array(
			'id_ksm' => '-',
			'id_lkm' => get_userdata('id_lkm'),
			'id_coa' => 17,
			'id_register' => null,
			'is_move' => null,
			'no' => null,
			'type' => $type,
			'base' => $posisi,
			'transaction_date' => date(CURRENT_YEAR."-01-01"),
			'remark' => null,
			'other_ksm' => null,
			'transaction_by' => null,
			'is_initial' => 0,
			'entry_stamp' => date("Y-m-d H:i:s"),
			'id_admin' => get_userdata('id')
		);	
		save_transaction($param);
		close_period();

		write_log(get_userdata('name').' berhasil menutup buku tahun '.CURRENT_YEAR);	
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=pengaturan");</script>';
	}

	if($_GET['halaman'] == "reset_data"){
		reset_data();		
		echo '<script type="text/javascript">location.replace("'.base_url().'content/controller/dashboard.php?halaman=pengaturan");</script>';
	}
?>