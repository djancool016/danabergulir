<script type="text/javascript">
	function delete_data(id, id_ksm){
		var con = confirm("Apakah Anda yakin ingin menghapus data ini ?");

		if(!con) return false;
		location.replace('<?php echo base_url(); ?>content/controller/dashboard.php?halaman=delete_ksm&id=' + id + '&id_ksm=' + id_ksm);
	}

</script>


<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;">Database <b>KSM</b></div>

<div style="margin-top:20px; margin-left:25px;">

<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center" style="padding:14px 1px 14px 1px; width:12%; ">Edit KSM</td>
		<td colspan="6" style="background-color:#d1dade; padding-left:20px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<?php $b = mysql_fetch_array($a); ?>

	<form action="<?php echo $action_edit; ?>" method="POST">

		<input type="hidden" name="id" value="<?php echo "$b[id]"; ?>" />

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Ubah <b>Data KSM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">ID KSM</td>
		<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" name="id_ksm" value="<?php echo "$b[ksm_no]"; ?>" class="span10-b" placeholder="(otomatis)" readonly ></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama KSM</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" name="nama_ksm" value="<?php  echo "$b[name]"; ?>" class="span10-b" placeholder=""></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Alamat</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6"><input type="text" name="alamat_ksm" value="<?php  echo "$b[address]"; ?>" class="span10-b" placeholder=""></td>
		</tr>
	</table>

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="font-size:13px;" colspan="8" align="right">
				<button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Ubah Data KSM</button>
				<input onclick="location.href = '<?php echo base_url().'content/controller/dashboard.php?halaman=ksm'; ?>'" type="reset" class="btn btn-white btn-cons" value="Batal" >
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
	</form>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Edit data <b>Anggota KSM</b></td>
		</tr>
		<tr>
			<td colspan="7" height="30px"></td>
		</tr>
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">NAMA</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">JENIS KELAMIN</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:13%; text-align:center;">NO. KTP</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:13%; text-align:center;">NO. PS2</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">STATUS</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:21%; text-align:center;">AKSI</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;" class="table-striped">
	
	<?php 
		$ukm = get_id_ukm($b[id]);
		while($b = mysql_fetch_array($ukm)){
	?>
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;"><?php echo "$b[name]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;"><?php echo "$b[sex]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:13%; text-align:center;"><?php echo "$b[id_no]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:13%; text-align:center;"><?php echo "$b[ps2_no]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;"><?php echo "$b[membership_status]"; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:21%; text-align:center;">
			<div class="btn-group">
			  <button onclick="location.href = '<?php echo base_url(); ?>content/controller/dashboard.php?halaman=edit_ukm&edit=<?php echo"$b[id]"; ?>&id_ksm=<?php echo $_GET['edit']; ?>'" class="btn btn-small btn-warning'"><i class="icon-cut"></i></button>
			  <button onclick="delete_data('<?php echo"$b[id]"; ?>','<?php echo $_GET['edit']; ?>')" class="btn btn-small btn-warning'" class="btn btn-small btn-danger"><i class="icon-trash"></i></button>
			</div>
			<!--
			<a >Edit</a> |
			<a href="javascript:)">Hapus</a></td>
			-->
		</tr>
	<?php } ?>
</table>

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td align="right">
				<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=tambah_ukm&edit=<?php echo"$b[id]"; ?>&id_ksm=<?php echo $_GET['edit']; ?>" class="btn btn-danger btn-cons" style="position : relative; right : 0px; margin : 20px"> + Tambah Anggota KSM</a>
			</td>
		</tr>
	</table>

</div>