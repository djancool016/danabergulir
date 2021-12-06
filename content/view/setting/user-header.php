<tr style="background-color : #d1dade">
	<td align="center" style="<?php if($_GET['halaman'] == "user") echo 'background : #fff; '; ?>padding:14px 1px 14px 1px; width:12%">
		<a href="<?php echo base_url(); ?>content/controller/setting.php?halaman=user">User</a>
	</td>
	<td align="center" style="<?php if($_GET['halaman'] == "user_form") echo 'background : #fff; '; ?>padding:14px 1px 14px 1px; width:12%; ">
		<a href="<?php echo base_url(); ?>content/controller/setting.php?halaman=user_form">Tambah User</a>
	</td>
</tr>