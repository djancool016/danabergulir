<script type="text/javascript">
	function cek_form_ksm(status){
		if($("#nama_ksm").val() == ""){
			alert('"Nama KSM" masih kosong !');
			$("#nama_ksm").focus();
			return false;			
		}

		if($("#alamat_ksm").val() == ""){
			alert('"Alamat KSM" masih kosong !');
			$("#alamat_ksm").focus();
			return false;			
		}

		if(status == "cek_user"){
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
		}

		return true;
	}

	function save_ksm(){
		var cek = cek_form_ksm();
		if(!cek) return;

		location.replace('<?php echo $action_finish; ?>');
	}

	$(function(){
		$('#form-ukm').submit(function(){
			var cek = cek_form_ksm("cek_user");
			if(!cek) return false;

			return true;
		});
	});
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Database <b>KSM</b></div>

<div style="margin-top:20px; margin-left:25px;">

<?php if($_GET['error'] == 'duplicate_id'){ ?>
<span class="label label-info" style="background : #ec3131; width : 95.5%; padding : 10px; margin-bottom : 10px; text-align : center">
	SUDAH TERDAPAT NO. KTP YANG SAMA !
</span>
<?php } ?>


<?php if($_GET['error'] == 'null_data'){ ?>
<span class="label label-info" style="background : #ec3131; width : 95.5%; padding : 10px; margin-bottom : 10px; text-align : center">
	ANDA BELUM MENGISI DATA ANGGOTA KSM !
</span>
<?php } ?>

<form id="form-ukm" method="post" action="<?php echo $action; ?>">
	<table width="97.5%" style="background-color:#fff;">
		<?php require_once("../view/company_profile/ksm-header.php"); ?>
		<tr>
			<td colspan="7" style="padding-left:20px;">&nbsp;</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Isian <b>Data KSM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">ID KSM</td>
		<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" name="id_ksm" value="<?php  echo (!empty($data_ksm['master'])) ? $data_ksm['master']['id_ksm'] : $code; ?>" class="span10-b" placeholder="(otomatis)" readonly ></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama KSM</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="nama_ksm" name="nama_ksm" value="<?php  echo (!empty($data_ksm['master'])) ? $data_ksm['master']['nama_ksm'] : ''; ?>" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Alamat</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="alamat_ksm" name="alamat_ksm" value="<?php  echo (!empty($data_ksm['master'])) ? $data_ksm['master']['alamat_ksm'] : ''; ?>" class="span10-b" placeholder=""></td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Isian Data <b>Anggota KSM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="nama_ukm" name="nama_ukm" class="span10-b" placeholder="Nama"></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Jenis Kelamin</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<select name="sex">
					<option value="wanita">Wanita</option>
					<option value="pria">Pria</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. KTP</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="no_ktp_ukm" name="no_ktp_ukm" class="span10-b" placeholder="No. KTP"></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. PS2</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" id="no_ps2_ukm" name="no_ps2_ukm" class="span10-b" placeholder="No. PS2"></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Status</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<?php if($_SESSION['data_ksm']['has_leader']){ ?>
				<input type="text" name="status_ukm" class="span10-b" value="Anggota" readonly="readonly">
				<?php } else { ?>
				<input type="text" name="status_ukm" class="span10-b" value="Ketua" readonly="readonly">
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td style="font-size:13px;" colspan="8" align="right">
				<button type="submit" name="" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Simpan Data Anggota KSM</button>
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:15%; text-align:center;">Nama</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:15%; text-align:center;">Jenis Kelamin</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:13%; text-align:center;">Status</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:13%; text-align:center;">No. KTP</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:13%; text-align:center;">No. PS2</td>
		</tr>
		<?php //var_dump($data_ksm); exit(); ?>
		<?php if(!empty($data_ksm['detail'])){ ?>
		<?php foreach ($data_ksm['detail'] as $detail) { ?>
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:15%; text-align:center;"><?php echo $detail['nama_ukm']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:15%; text-align:center;"><?php echo $detail['sex']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:13%; text-align:center;"><?php echo $detail['status_ukm']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:13%; text-align:center;"><?php echo $detail['no_ktp_ukm']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 18px 10px 18px; width:13%; text-align:center;"><?php echo $detail['no_ps2_ukm']; ?></td>
		</tr>
		<?php } ?>
		<?php } ?>
		<tr>
			<td style="font-size:13px;" colspan="8" align="right">
				<?php if($_SESSION['data_ksm']){ ?>
				<a onclick="save_ksm()"  class="btn btn-danger btn-cons"><i class="icon-ok"></i> Simpan Data KSM</a>
				<?php } ?>

				<a href="<?php echo $action_clear; ?>"  class="btn btn-white btn-cons" >Batal</a>
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
</div>
</form>
