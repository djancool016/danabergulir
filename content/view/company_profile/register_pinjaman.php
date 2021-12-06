<style type="text/css">
	.gusti{
		border-collapse: collapse;
		border: 1px solid #eee;
		padding: 5px;
	}
	.gusti tr td{
		border: 1px solid #eee;
		padding: 5px;
	}
</style>

<script type="text/javascript">
	function delete_data(id){
		var con = confirm('Yakin hapus data ?');
		if(!con) return false;

		location.replace('<?php echo base_url(); ?>content/controller/dashboard.php?halaman=delete_pinjaman&id=' + id);	
	}
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Register - <b>Pengguliran Pinjaman KSM</b></div>

<?php if(!cek_is_used()){ ?>
<button class="btn btn-danger btn-cons" onclick="location.href = '<?php echo base_url(); ?>content/controller/dashboard.php?halaman=pinjaman_ksm_lama'" style="float : right; margin-right : 2.5%">Form Pinjaman KSM LAMA</button>
<?php } ?>

<div style="margin-top:20px; margin-left:25px;">
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
			<td style="font-weight:bold; font-size:32px; text-align:center; padding:25px 0 25px 0;">REGISTER PERGULIRAN PINJAMAN</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td align="center">
				<table width="97.5%">
					
				</table>
				<table width="97.5%" class="gusti" style="margin-bottom:40px;">
					<tr style="background-color:#4bd4c9;">
						<td style="text-align:center; color:#fff; padding:0 0 20px 10px;" width="5%">NO.</td>
						<td style="text-align:center; color:#fff; padding:0 0 20px 0;" width="12%">DATA KSM</td>
						<td style="text-align:center; color:#fff; padding:0 0 20px 0;" width="12%">NO KSM</td>
						<td style="text-align:center; color:#fff; padding:0 0 20px 0;" width="17%">TANGGAL REALISASI</td>
						<td style="text-align:center; color:#fff; padding:0 0 20px 0;" width="12%">PINJAMAN KE</td>
						<td style="text-align:center; color:#fff; padding:0 0 20px 0;" width="12%">PINJAMAN POKOK</td>
						<td style="text-align:center; color:#fff; padding:15px 0 15px 0;" width="12%">JASA<BR>(%)</td>
						<td style="text-align:center; color:#fff; padding:15px 0 15px 0;" width="12%">JANGKA WAKTU<BR>(BULAN)</td>
						<td style="text-align:center; color:#fff; padding:15px 0 15px 0;" width="12%">STATUS</td>		
						<td style="text-align:center; color:#fff; padding:15px 0 15px 0;" width="12%">AKSI</td>
					</tr>
					<?php
						$urut=0;
						while($b=mysql_fetch_array($a)){ 
						if(!$no_urut[$b['id_ksm']]) $no_urut[$b['id_ksm']] = $b['loan_no'];
					?>
						<tr>
							<td align="center" width="5%"><?php echo $urut=$urut+1; ?></td>
							<td align="center" width="12%"><?php echo $b[name]; ?></td>
							<td align="center" width="12%"><?php echo $b[ksm_no]; ?></td>
							<td align="center" width="17%">
								<?php 
									if($b[realization_date])
										echo $b[realization_date]; 
									else if($b[tanggal_cair]) 
										echo $b[tanggal_cair]; 
									else 
										echo "-"; 

									$total += $b[loan_total];
								?>
							</td>
							<td align="center" width="12%"><?php echo $no_urut[$b['id_ksm']]--; ?></td>
							<td align="center" width="12%"><?php echo decimal($b[loan_total]); ?></td>
							<td align="center" width="12%"><?php echo decimal($b[loan_interest], 2); ?></td>
							<td align="center" width="12%"><?php echo $b[loan_duration]; ?></td>
							<td align="center" width="12%">
								<?php 
									if(!$b[is_finish]) 
										echo '<div style="background : red; width : 20px; height : 20px; border-radius : 50px"></div>'; 
									else 
										echo '<div style="background : green; width : 20px; height : 20px; border-radius : 50px"></div>'; 
								?>
							</td>
							<td align="center" width="12%">
							  	<?php if((!$b[tanggal_cair] and !$b[realization_date] and !$b['transaction_number']) or !cek_is_used()){ ?>
							  	<button onclick="delete_data('<?php echo"$b[id]"; ?>')" class="btn btn-small btn-warning'" class="btn btn-small btn-danger"><i class="icon-trash"></i></button>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="5" align="right"><b>TOTAL</b></td>
						<td align="center"><b><?php echo decimal($total); ?></b></td>
						<td colspan="3"></td>
					</tr>
				</table>
			</td>
		</tr>
</table>

</div>