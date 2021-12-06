<?php	
	date_default_timezone_set('Asia/Jakarta');
	session_start();

	error_reporting(E_ERROR);
	
	mysql_connect('localhost', 'root', '');
	mysql_select_db('cdb1');
	
	define('CURRENT_YEAR', date("Y"));

	function base_url(){
		return "http://".$_SERVER['SERVER_ADDR']."/danabergulir/";
	}
	
	function query($sql = '', $param = array()){
		$array = explode('?', $sql);
		$x = 1;
		$total = count($array);
		
		foreach($array as $data){
			$haystack .= $data;
			if($x < count($array)) $haystack .= "'".mysql_real_escape_string($param[key($param)])."'";
			
			next($param);
			$x++;
		}
		
		return mysql_query($haystack);
	}
	
	function get_userdata($index = ''){
		$sql = "SELECT a.*, 
					   b.name AS lkm_name,
					   c.name AS kelurahan_name,
					   e.name AS kota_name 

					   FROM tb_admin a 

					   LEFT JOIN ms_lkm b ON a.id_lkm = b.id 
					   LEFT JOIN tb_kelurahan c ON c.id = b.id_kelurahan 
					   LEFT JOIN tb_kecamatan d ON d.id = c.id_kecamatan  
					   LEFT JOIN tb_kota e ON e.id = d.id_kota   

					   WHERE a.id = ?";

		$sql = query($sql, array($_SESSION['login_lkm']['id']));
		$data = mysql_fetch_array($sql);
		
		return $data[$index];
	}

	function sessionid(){
		$return = '';
		for($i=0;$i<10;$i++){
			$return .= rand(0,9);
		}
		return $return;
	}
	
	function fetch_row($sql = ''){		
		$return = array();
		while($data = mysql_fetch_array($sql)){
			for($i=0;$i<count($data);$i++){
				if($i % 2 != 0){
					$key = key($data);
					$return[$key] = $data[$key];
				}
				next($data);
			}
			break;
		}
		
		return $return;
	}
	
	function generatename($name){
		$array = explode('.' , $name);
		$length = count($array)-1;	
		
		$tgl = date("d");
		$bln = date("m");
		$thn = date("y");
		
		$jam = date("h");
		$mnt = date("i");
		$dtk = date("s");
		
		for($i=0;$i<3;$i++)
			$rand .= rand(0,9);
			 
		$ext = $array[$length];
		$new = $tgl.$bln.$thn."_".$jam.$mnt.$dtk."_".$rand.".".$ext;
		return $new; 
	}
	
	function clean_decimal($param = ''){
		$param = str_replace(".", "", $param);
		$param = str_replace(",", ".", $param);

		return $param;
	}

	function generate_code($type = ""){
		$sql = "SELECT id, code, last_count, edit_stamp FROM tr_running_number WHERE type = ?";
		$sql = query($sql, array($type));
		$data = mysql_fetch_array($sql);

		if(date(m) != date("m", strtotime($data['edit_stamp']))){
			$data['last_count'] = "000";
			
			query("UPDATE tr_running_number SET edit_stamp = ? WHERE id = ?", array(date("Y-m-d H:i:s"), $data['id']));
		}

		$number = $data['last_count'] + 1;
		for($i=0; $i < (3 - strlen($number)); $i++)
			$return .= "0";
		
		$number = $return.$number;
		
		if($type == "kas_in" or  $type == "kas_out" or $type == "pindah_buku")
			return $data['code']."/".date("Y-m")."/".$number;
		else if($type == "ksm" or  $type == "pinjaman" or $type == "tabungan" or $type == "lainnya")
			return $data['code']."/".date("Y")."/".$number; 
	}

	function update_running_number($type = ""){
		$sql = "SELECT id, code, last_count, edit_stamp FROM tr_running_number WHERE type = ?";
		$sql = query($sql, array($type));
		$data = mysql_fetch_array($sql);

		$number = $data['last_count'] + 1;
		for($i=0; $i < (3 - strlen($number)); $i++)
			$return .= "0";

		$number = $return.$number;
		
		query("UPDATE tr_running_number SET last_count = ?, edit_stamp = ? WHERE id = ?", array($number, date("Y-m-d H:i:s"), $data['id']));
	} 

	function decimal($number = '', $dec = '0'){
		if($number < 0) $is_dec = 1;
		
		if($is_dec) $return .= '(';

		$disp_number = $number;
		if($is_dec) $disp_number = $number * -1;

		$return .= number_format($disp_number, $dec, ",", ".");

		if($is_dec) $return .= ')';

		return $return;
	}

	function get_last_accperiod(){
		$sql = "SELECT current_year FROM ms_lkm WHERE id = ?";
		$sql = query($sql, array(get_userdata('id')));
		$sql = mysql_fetch_array($sql);
		
		return $sql['current_year'];
	}

	function get_acc_start(){
		$sql = "SELECT acc_period_start FROM ms_lkm WHERE id = ?";
		$sql = query($sql, array(get_userdata('id')));
		$sql = mysql_fetch_array($sql);
		
		return date("Y", strtotime($sql['acc_period_start']));
	}

	function terbilang($x){
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		
		if ($x < 12)
		return " " . $abil[$x];
		elseif ($x < 20)
		return terbilang($x - 10) . "belas";
		elseif ($x < 100)
		return terbilang($x / 10) . " puluh" . terbilang($x % 10);
		elseif ($x < 200)
		return " seratus" . terbilang($x - 100);
		elseif ($x < 1000)
		return terbilang($x / 100) . " ratus" . terbilang($x % 100);
		elseif ($x < 2000)
		return " seribu" . terbilang($x - 1000);
		elseif ($x < 1000000)
		return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
		elseif ($x < 1000000000)
		return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
		elseif ($x < 1000000000000)
		return terbilang($x / 1000000000) . " milyar" . terbilang($x % 1000000000);
		elseif ($x < 1000000000000000)
		return terbilang($x / 1000000000000) . " trilyun" . terbilang($x % 1000000000000);
	}

	function write_log($remark = ''){
		$sql = "INSERT INTO tr_log (`remark`, `id_admin`, `entry_stamp`) VALUES (?,?,?)";
		query($sql, array($remark, get_userdata('id'), date("Y-m-d H:i:s")));
	}

	function log_ksm_name($id = ''){
		$sql = "SELECT name FROM ms_ksm WHERE id = ?";
		$sql = query($sql, array($id));
		$data = mysql_fetch_array($sql);

		return $data['name'];
	}
?>