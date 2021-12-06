<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Manajemen <b>Pengguna</b></div>

<div style="margin-top:20px; margin-left:25px;">

<table width="97.5%" style="background-color:#fff;">
	<?php require_once("../view/setting/user-header.php"); ?>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">Nama</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">Peran</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">Username</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">Password</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">Action</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;" class="table-striped">
	
	<?php while($b = mysql_fetch_array($a)){ ?>
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;"><?php echo $b['name']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 38px; width:10%; text-align:justify;"><?php echo $b['role']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 38px; width:10%; text-align:justify;"><?php echo $b['username']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 38px; width:10%; text-align:justify;"><?php echo $b['password']; ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:10%; text-align:center;">
				<a href="<?php echo base_url(); ?>content/controller/setting.php?halaman=user_form&edit=<?php echo $b['id']; ?>">Edit</a>
			</td>
		</tr>
	<?php } ?>
</table>

</div>