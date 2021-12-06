<script type="text/javascript">
	$(function(){
		$("#tutup-buku").click(function(){
			var con = confirm('Yakin tutup buku ?');	
			
			if(con){
				var pass = "<?php echo $user['password']; ?>";
				var pr = prompt("Masukan password untuk melanjutkan");

				if(pr != pass){
					alert("Password anda salah !");
				}else 
					location.replace('<?php echo base_url(); ?>content/controller/dashboard.php?halaman=tutup_buku');
			}
		});

		$("#reset-data").click(function(){
			var con = confirm('Seluruh transaksi di sistem ini akan di hapus. Yakin lanjutkan ?');	
			
			if(con){
				var pass = "<?php echo $user['password']; ?>";
				var pr = prompt("Masukan password untuk melanjutkan");

				if(pr != pass){
					alert("Password anda salah !");
				}else 
					location.replace('<?php echo base_url(); ?>content/controller/dashboard.php?halaman=reset_data');
			}	
		});

		$(".kota-selector").change(function(){
			location.replace('?halaman=pengaturan&id_provinsi=' + $("#provinsi_lkm").val() + '&id_kota=' + $("#kota_lkm").val() + '&id_kecamatan=' + $("#kecamatan_lkm").val());
		});
	});
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Pengaturan</div>
<div style="margin-top:20px; margin-left:25px;">

<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center" style="padding:14px 1px 14px 1px; width:12%; ">Data LKM</td>
		<td align="center" style="background-color:#d1dade; padding:14px 1px 14px 1px; width:12%">
			<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=buku_besar">Buku Besar</a>
		</td>
		<td colspan="5" style="background-color:#d1dade; padding-left:20px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>

	<form action="<?php echo $action; ?>" method="POST">

		<input type="hidden" name="id" value="<?php echo "$b[id]"; ?>" />

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Data <b>LKM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama LKM</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6"><input type="text" name="nama_lkm" value="<?php echo $fill['name']; ?>" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Propinsi</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
			
				<select name="provinsi_lkm" id="provinsi_lkm" class="kota-selector">
					<?php
						while($data = mysql_fetch_array($provinsi)){
					?>
					<option value="<?php echo $data['id'];  ?>" <?php if($id_provinsi == $data['id']) echo 'selected="selected"'; ?>><?php echo $data['name']; ?></option>
					<?php } ?>
				</select>
			</td>

		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Kota/Kabupaten</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
			
				<select name="kota_lkm" id="kota_lkm" class="kota-selector">
					<?php
						while($data = mysql_fetch_array($kota)){
					?>
					<option value="<?php echo $data['id'];  ?>" <?php if($id_kota == $data['id']) echo 'selected="selected"'; ?>><?php echo $data['name']; ?></option>
					<?php } ?>
				</select>
			</td>

		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Kecamatan</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
			
				<select name="kecamatan_lkm" id="kecamatan_lkm" class="kota-selector">
					<?php
						while($data = mysql_fetch_array($kecamatan)){
					?>
					<option value="<?php echo $data['id'];  ?>" <?php if($id_kecamatan == $data['id']) echo 'selected="selected"'; ?>><?php echo $data['name']; ?></option>
					<?php } ?>
				</select>
			</td>

		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Kelurahan/Desa</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<select name="kelurahan_lkm" id="kelurahan_lkm">
					<?php
						while($data = mysql_fetch_array($kelurahan)){
					?>
					<option value="<?php echo $data['id'];  ?>" <?php if($id_kelurahan == $data['id']) echo 'selected="selected"'; ?>><?php echo $data['name']; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Alamat</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6"><input type="text" name="alamat_lkm" value="<?php echo $fill['alamat']; ?>" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:23px;" colspan="2">Periode <b>Akuntansi</b></td>
			<td style="font-size:13px; padding:0 26px 0 35px; width:67.5%;" colspan="6">&nbsp;</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Awal Periode</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<select name="tanggal">
						<option value="<?php echo "$b[tanggal]"; ?>"><?php echo "$b[tanggal]"; ?></option>
						<option readonly></option>
					<?php
						$day = 1;
						$month = 1;
						$year = date("Y");

						for ($tgl =  1; $tgl <= 31; $tgl++){ ?>
						<option <?php if($day == $tgl) echo 'selected="selected"'; ?> value="<?php echo "$tgl"; ?>"><?php echo "$tgl"; ?></option>
					<?php } ?>
				</select>

				<select name="bulan">
						<option value=""> - Pilih -</option>
					<?php
						$a = array ("", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
						for ($bln = 1; $bln <= 12; $bln++){ ?>
						<option <?php if($month == $bln) echo 'selected="selected"'; ?> value="<?php echo $bln; ?>";><?php echo "$a[$bln]"; ?></option>
					<?php } ?>
				</select>
				
				<select name="tahun">
						<option value="<?php echo "$b[tahun]"; ?>"><?php echo "$b[tahun]"; ?></option>
						<option readonly></option>
					<?php
						for ($thn = 2001; $thn <= date('Y'); $thn++){
					?>
						<option <?php if($year == $thn) echo 'selected="selected"'; ?> value="<?php echo "$thn"; ?>"><?php echo "$thn"; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
	</table>

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px">
				<input id="reset-data" type="button" class="btn btn-danger btn-cons" style="font-size : 18px; margin-right : 20px" value="Reset Data"/>
				<?php if(cek_is_used() and get_last_accperiod() != CURRENT_YEAR){ ?>
				<input id="tutup-buku" type="button" class="btn btn-cons" style="font-size : 18px; background : #6acbef; color : #fff" value="Tutup Buku Tahun <?php echo CURRENT_YEAR - 1; ?>"/>
				<?php } ?>
			</td>
		</tr>				
		<tr>
			<td style="font-size:13px;" colspan="8" align="right" class="form-actions">
				<button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Simpan</button>
				<input type="reset" class="btn btn-danger btn-cons" value="Batal" >
				<input type="hidden" name="id_ksm" value="<?php echo $_GET['id_ksm']; ?>">
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
	
	</form>
</div>