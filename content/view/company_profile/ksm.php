<script type="text/javascript">
	function delete_data(id){
		var con = confirm('Yakin hapus data ?');
		if(!con) return false;

		location.replace('<?php echo base_url(); ?>content/controller/dashboard.php?halaman=hapus_ksm&id=' + id);
	}
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Database <b>KSM</b></div>

<div style="margin-top:20px; margin-left:25px;">

<table width="97.5%" style="background-color:#fff;">
	<?php require_once("../view/company_profile/ksm-header.php"); ?>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">No. KSM</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">Nama KSM</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">Ketua</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">Alamat</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">Pinjaman Ke</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:21%; text-align:center;">AKSI</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;" class="table-striped">
	
	<?php while($b = mysql_fetch_array($a)){ ?>
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;"><?php echo "$b[ksm_no]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 38px; width:15%; text-align:justify;"><?php echo "$b[name]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 38px; width:15%; text-align:justify;"><?php echo "$b[ketua_name]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;"><?php echo "$b[address]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;"><?php echo "$b[loan_total]"; ?></td>			
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:21%; text-align:center;">
			<?php if(!$b['loan_total'] and !$b['transaction_number']){ ?>
				<button onclick="location.href = '<?php echo base_url(); ?>content/controller/dashboard.php?halaman=edit_ksm&edit=<?php echo"$b[id]"; ?>'" class="btn btn-small btn-warning'"><i class="icon-cut"></i></button>
			  	<button onclick="delete_data('<?php echo"$b[id]"; ?>')" class="btn btn-small btn-warning'" class="btn btn-small btn-danger"><i class="icon-trash"></i></button>
			<?php } else echo '<a href="'.base_url().'content/controller/dashboard.php?halaman=view_ksm&edit='.$b['id'].'">Lihat</a>'; ?>			
			</td>
		</tr>
	<?php } ?>
</table>

</div>