<style type="text/css">
	.gusti{
		border-collapse: collapse;
		border: 1px solid #eee;
		margin-bottom: 50px;
	}
	.gusti tr td{
		border: 1px solid #eee;
	}
</style>

<script type="text/javascript">
	function delete_data(id){
		var con = confirm('Yakin hapus data ?');
		if(!con) return false;

		location.replace('<?php echo base_url(); ?>content/controller/dashboard.php?halaman=delete_tabungan&id=' + id);	
	}
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Register - <b>Tabungan</b></div>

<?php if(!cek_is_used()){ ?>
<button class="btn btn-danger btn-cons" onclick="location.href = '<?php echo base_url(); ?>content/controller/dashboard.php?halaman=tabungan_ksm_lama'" style="float : right; margin-right : 2.5%">Form Tabungan KSM LAMA</button>
<?php } ?>

<div style="margin-top:20px; margin-left:25px;">
<?php $get_lkm = mysql_fetch_array($lkm); ?>
<table width="97.5%" style="background-color:#0aa699; font-size:15px; color:#fff;">
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	<tr>
		<td style="width:17%; padding-left:30px;">Nama LKM</td>
		<td colspan="3" style="width:50%;">: <?php echo get_userdata("lkm_name"); ?></td>
		<td colspan="3" style="padding-right:30px;" align="right">Model LU-04</td>
	</tr>
	<tr>
		<td style="width:17%; padding-left:30px;">Kelurahan/Desa</td>
		<td colspan="3" style="width:50%;">: <?php echo get_userdata("kelurahan_name"); ?></td>
		<td colspan="3" style="padding-right:30px;" align="right"><?php echo get_userdata("kota_name"); ?></td>
	</tr>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td style="font-weight:bold; font-size:32px; text-align:center; padding:25px 0 0 0;">REGISTER TABUNGAN</td>
		</tr>
		<tr>
			<td style="font-size:20px; text-align:center; padding:0 0 25px 0;"> </td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td align="center">
				<table width="95.5%" class="gusti">
					<tr style="background-color:#4bd4c9; color:#fff; text-align:center;">
						<td rowspan="2">NO.</td>
						<td rowspan="2">DATA PENABUNG</td>
						<td colspan="2" style="padding:5px;">MUTASI</td>
						<td rowspan="2">SALDO</td>
						<td rowspan="2">AKSI</td>
					</tr>
					<tr align="center">
						<td style="background-color:#50aba3; color:#fff;">DEBET</td>
						<td style="background-color:#50aba3; color:#fff; padding:5px;">CREDIT</td>
					</tr>			
					<?php
						$urut=0;
						while($b=mysql_fetch_array($a)){ 
							$saldo = ($b['credit'] + $b['balance']) - $b['debit'];
							$total += $saldo;
					?>
					<tr>
						<td align="center" width="8%" style="padding:5px;"><?php echo $urut=$urut+1; ?>.</td>
						<td width="20%" style="padding-left:10px;"><?php echo $b[name]; ?></td>
						<td align="right" width="10%" style="padding-right:10px;"><?php echo decimal($b['debit']); ?></td>
						<td align="right" width="10%" style="padding-right:10px;"><?php echo decimal($b['credit'] + $b['balance']); ?></td>
						<td align="right" width="17%" style="padding-right:10px;"><?php echo decimal($saldo); ?></td>
						<td align="center" width="12%">
						  	<?php if(!$saldo or !cek_is_used()){ ?>
						  	<button onclick="delete_data('<?php echo"$b[id]"; ?>')" class="btn btn-small btn-warning'" class="btn btn-small btn-danger"><i class="icon-trash"></i></button>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="4" align="right"><b>TOTAL</b></td>
						<td align="right"><b><?php echo decimal($total); ?></b></td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
</table>

</div>