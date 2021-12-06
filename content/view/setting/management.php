<script type="text/javascript">
	$(function(){
		$("#management-form").submit(function(){
			if($("#name").val() == ""){
				alert('Data "Nama" tidak boleh kosong !');
				$("#name").focus();
			}

			if($("#name").val() == ""){
				alert('Data "Nama" tidak boleh kosong !');
				$("#name").focus();
			}

		});
	});
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Manajemen Pengguna</div>
<div style="margin-top:20px; margin-left:25px">

	<form id="management-form" action="<?php echo base_url(); ?>content/controller/setting.php?halaman=save_user" method="POST">

	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; padding-top : 30px; font-size:23px;">Management <b>Pengguna</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<input type="text" id="name" name="name" value="<?php echo $fill['name']; ?>" class="span10-b" placeholder="Username" style="width : 300px">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Username</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<input type="text" id"username" name="username" value="<?php echo $fill['username']; ?>" class="span10-b" placeholder="Nama" style="width : 300px">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Password</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<input type="password" id="password" name="password" value="<?php echo $fill['password']; ?>" class="span10-b" style="width : 200px">
			</td>
		</tr>
	</table>
	
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td align="left" class="form-actions">
				<button type="button" id="reset-data" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Reset data</button>
			</td>
			<td style="font-size:13px;" align="right" class="form-actions">
				<button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Simpan</button>
				<input type="reset" class="btn btn-white btn-cons" value="Batal" >
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
	
	</form>
</div>