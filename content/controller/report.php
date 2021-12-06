<?php
	require_once("base_setting.php");
	require_once("../model/report_model.php");
	require_once("../dompdf/dompdf_config.inc.php");
	require_once("../dompdf/include/autoload.inc.php");

	$paper = 'portrait';

	if($_GET['halaman'] == "kas_masuk"){
		$konten = "../view/company_profile/kas_masuk.php";
	}

	if($_GET['halaman'] == "kas_keluar"){
		$konten = "../view/company_profile/kas_keluar.php";
	}

	if($_GET['halaman'] == "catatan_uang_masuk"){
		$a = get_register_tabungan('in');
		$konten = "../view/company_profile/catatan_uang_masuk.php";

		$paper = 'landscape';
	}

	if($_GET['halaman'] == "catatan_uang_keluar"){
		$a = get_register_tabungan('out');
		$konten = "../view/company_profile/catatan_uang_keluar.php";

		$paper = 'landscape';
	}

	if($_GET['halaman'] == "catatan_pindah_buku"){
		$a = get_pindah_buku('in');
		$konten = "../view/company_profile/catatan_pindah_buku.php";

		$paper = 'landscape';
	}

	if($_GET['halaman'] == "laba_rugi"){
		$konten = "../view/report/laba-rugi.php";
	}

	if($_GET['halaman'] == "neraca"){
		$a = get_neraca_saldo_aktiva();		
		$aa = get_neraca_saldo_passiva();

		$konten = "../view/report/aktiva-pasiva.php";
	}

	if($_GET['halaman'] == "buku_kas"){
		$a = get_buku(1);
		$konten = "../view/company_profile/buku_kas.php";
	}

	if($_GET['halaman'] == "buku_bank"){
		$a = get_buku(2);
		$konten = "../view/company_profile/buku_bank.php";
	}

	if($_GET['halaman'] == "buku_inventaris"){
		$a = get_buku(7);
		$konten = "../view/company_profile/buku_inventaris.php";
	}

	if($_GET['halaman'] == "buku_neraca_saldo"){
		$a = get_neraca_saldo_aktiva();		
		$aa = get_neraca_saldo_passiva();
		
		$konten = "../view/company_profile/buku_neraca_saldo.php";
	}

	if($_GET['halaman'] == "buku_pendapatan_biaya"){
		$date = date("Y-m-d");
		if($_GET['report_filter_period']) $date = $_GET['report_filter_period'];
		$a = get_pendapatan();
		$aa = get_biaya();

		//$a = get_pendapatan();
		//$aa = get_biaya();

		$konten = "../view/company_profile/buku_pendapatan_biaya.php";
	}

	if($_GET['halaman'] == "kolektabilitas"){
		$date = date("Y-m-d");
		if($_GET['report_filter_period']) $date = $_GET['report_filter_period'];

		$query = get_kolektabilitas();
		$konten = "../view/report/kolektabilitas.php";

		$paper = 'landscape';
	}

	if($_GET['halaman'] == "bukti_kas_masuk"){
		$fill = get_in_out($_GET['id']);
		$konten = "../view/report/kas-in-printable.php";
		$paper = 'landscape';

	}

	if($_GET['halaman'] == "bukti_kas_keluar"){
		$fill = get_in_out($_GET['id']);
		$konten = "../view/report/kas-out-printable.php";
	}

	if($_GET['halaman'] == "bukti_pindah_buku"){
		$fill = get_print_pindah_buku($_GET['id']);
		$konten = "../view/report/pindah-buku-printable.php";
	}

	if($_GET['print'] == "xls"){
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;Filename=report.xls");

		return require_once($konten);
	}

	if($_GET['print'] == "pdf"){
		$dompdf = new DOMPDF();

		ob_start();

		require_once($konten);
		$html = ob_get_clean();

		$dompdf->load_html($html);

		$dompdf->set_paper('A4', $paper);

		$dompdf->render();
		$dompdf->stream("report.pdf", array("Attachment"=>false));

		return;	
	}

	require_once("../view/dashboard.php");
?>