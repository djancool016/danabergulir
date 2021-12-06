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

<?php if($_GET['error'] == 'duplicate_id'){ ?>
<span class="label label-info" style="background : #ec3131; width : 95.5%; padding : 10px; margin-bottom : 10px; text-align : center">
	SUDAH TERDAPAT NO. KTP YANG SAMA !
</span>
<?php } ?>

<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center" style="padding:14px 1px 14px 1px; width:20%; ">Tambah Data Anggota KSM</td>
		<td colspan="6" style="background-color:#d1dade; padding-left:20px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<?php $b = mysql_fetch_array($a); ?>

	<form id="form-ukm" action="<?php echo $action_add; ?>" method="POST">

		<input type="hidden" name="id" value="<?php echo $_GET['id_ksm']; ?>" />

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Tambah Data <b>Anggota KSM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="nama_ukm" name="nama_ukm" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Jenis Kelamin</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<select name="sex" id="sex">
					<option value="wanita">Wanita</option>
					<option value="pria">Pria</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. KTP</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="no_ktp_ukm" name="no_ktp_ukm" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. PS2</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="no_ps2_ukm" name="no_ps2_ukm" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Status</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<select name="status_ukm">
					<option value="Ketua">Ketua</option>
					<option selected="selected" value="Anggota">Anggota</option>
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
				<button type="submit" class="btn btn-danger btn-cons">Simpan Data Anggota UKM</button>
				<input type="reset" class="btn btn-white btn-cons" value="Batal" >
				<input type="hidden" name="id_ksm" value="<?php echo $_GET['id_ksm']; ?>">
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
	
	</form>
</div>