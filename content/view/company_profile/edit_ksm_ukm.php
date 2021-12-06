<script type="text/javascript">
	$(function(){
		$("#form-ukm").submit(function(){
			if($("#nama_ukm").val() == ""){
				alert('"Nama" masih kosong !');
				$("#nama_ukm").focus();
				return false;			
			}

			if($("#no_ktp_ukm").val() == ""){
				alert('"No. KTP" masih kosong !');
				$("#no_ktp_ukm").focus();
				return false;			
			}

			if($("#no_ps2_ukm").val() == ""){
				alert('"No. PS2" masih kosong !');
				$("#no_ps2_ukm").focus();
				return false;			
			}
		});
	});
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;">Database <b>KSM</b></div>

<div style="margin-top:20px; margin-left:25px;">

<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center" style="padding:14px 1px 14px 1px; width:20%; ">Edit Data Anggota KSM</td>
		<td colspan="6" style="background-color:#d1dade; padding-left:20px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<?php $b = mysql_fetch_array($a); ?>

	<form id="form-ukm" action="<?php echo $action_edit; ?>" method="POST">

		<input type="hidden" name="id" value="<?php echo "$b[id]"; ?>" />

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Ubah Data <b>Anggota KSM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="nama_ukm" name="nama_ukm" value="<?php echo "$b[name]"; ?>" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Jenis Kelamin</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<select name="sex">
					<option <?php if($b['sex'] == "pria") echo 'selected="selected"'; ?> value="pria">Pria</option>
					<option <?php if($b['sex'] == "wanita") echo 'selected="selected"'; ?> value="wanita">Wanita</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. KTP</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" id="no_ktp_ukm" name="no_ktp_ukm" value="<?php  echo "$b[id_no]"; ?>" class="span10-b" placeholder="">
				<input type="hidden" name="old_ktp" value="<?php  echo "$b[id_no]"; ?>"/>
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. PS2</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="no_ps2_ukm" name="no_ps2_ukm" value="<?php  echo "$b[ps2_no]"; ?>" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Status</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
			<select name="status_ukm">
				<option <?php if($b['membership_status'] == "Ketua") echo 'selected="selected"'; ?> value="Ketua">Ketua</option>
				<option <?php if($b['membership_status'] == "Anggota") echo 'selected="selected"'; ?> value="Anggota">Anggota</option>
			</select>
			</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="font-size:13px;" colspan="8" align="right">
				<button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Simpan Data Anggota KSM</button>
				<input onclick="location.href = '<?php echo base_url().'content/controller/dashboard.php?halaman=edit_ksm&edit='.$_GET['id_ksm']; ?>'" type="reset" class="btn btn-white btn-cons" value="Batal" >
				<input type="hidden" name="id_ksm" value="<?php echo $_GET['id_ksm']; ?>">
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
	
	</form>
</div>