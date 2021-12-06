<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Catatan <b>Aktifitas</b></div>

<div style="margin-top:20px; margin-left:25px;">

<table width="97.5%" style="background-color:#fff;">
	<?php //require_once("../view/setting/user-header.php"); ?>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">Tanggal</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;">Jam</td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:70%; text-align:center;">Aktifitas</td>
		</tr>
	</table>
	
	<table width="97.5%" style="background-color:#fff;" class="table-striped">
	
	<?php while($b = mysql_fetch_array($a)){ ?>
		<tr>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;"><?php echo date("d/M/Y", strtotime($b['entry_stamp'])); ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 8px; width:15%; text-align:center;"><?php echo date("H:i:s", strtotime($b['entry_stamp'])); ?></td>
			<td style="font-weight:bold; font-size:12px; padding:5px 8px 10px 38px; width:70%; text-align:justify;"><?php echo $b['remark']; ?></td>
		</tr>
	<?php } ?>
</table>

</div>