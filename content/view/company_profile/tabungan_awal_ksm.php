<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Database <b>KSM</b></div>

<div style="margin-top:20px; margin-left:25px;">

<table width="97.5%" style="background-color:#fff;">
	<?php require_once("../view/company_profile/ksm-header.php"); ?>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
</table>

	
<form action="<?php echo $action; ?>" method="POST">
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">
				<?php if($_GET['error'] == 'duplicate_id'){ ?>
				<span class="label label-info" style="background : #ec3131; width : 95.5%; padding : 10px; margin-bottom : 10px; text-align : center">
					REGISTER TABUNGAN UNTUK KSM BERSANGKUTAN SUDAH ADA ! 
				</span>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Tabungan Awal <b>KSM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama KSM</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<select name="id_ksm">
					<?php while($b=mysql_fetch_array($a)){ ?>
						<option value="<?php echo "$b[id]"; ?>"><?php echo "$b[name]"; ?></option>
					<?php } ?>
				</select>
				<input type="hidden" value="1" name="id_lkm">
				<input type="hidden" value="1" name="id_admin">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. </td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" value="<?php echo $code; ?>" name="acc_no" readonly="readonly">
			</td>
		</tr>
		<!--
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Saldo Awal Tabungan</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="balance" name="balance" placeholder="" data-a-sep="." data-a-dec=",">
			</td>
		</tr>
		-->
	</table>
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td style="font-size:13px;" colspan="7" align="right">
				<button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Simpan</button> 
				<button type="reset" class="btn btn-white btn-cons" >Batal</button>  
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
</form>

</div>