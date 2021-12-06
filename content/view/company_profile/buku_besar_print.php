<style type="text/css">
	table{
		border-collapse : collpase;
		border : none; 
	}

	table tr th{
		border : 1px solid #000; 
		padding : 3px;
		background : #eee;
	}

	table tr td{
		border : 1px solid #000; 
		padding : 3px;
	}
</style>

<h3>Buku <span class="semi-bold"> Besar</span></h3>

  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example4" width="100%" >
	<thead>
	  <tr>
		<th>Akun ID</th>
		<th>Nama Akun</th>
		<th>Tipe AKun</th>
		<th><div align="right">Debet</div></th>
		<th><div align="right">Kredit</div></th>
	  </tr>
	</thead>
	<tbody>
	  
	  <?php while($data = mysql_fetch_array($a)){ ?>
	  <tr class="odd gradeX">
		<td><?php echo $data['code']; ?></td>
		<td><?php echo $data['name']; ?></td>
		<td class="center">
			<?php 
				if($data['type'] == "harta") $class = "label-success";
				if($data['type'] == "hutang") $class = "label-danger";
				if($data['type'] == "modal") $class = "label-calm";
				if($data['type'] == "pendapatan") $class = "label-success";												
				if($data['type'] == "beban") $class = "label-danger";	
				if($data['klasifikasi'] == "debit") $inout = "in";
				if($data['klasifikasi'] == "credit") $inout = "out"; 											
			?>
			<span class="label <?php echo $class; ?> tip" data-placement="left" title="" type="button"><?php echo strtoupper($data['type']); ?></span>
			<input type="hidden" name="type[<?php echo $data['id']; ?>]" value="<?php echo $inout; ?>"/>
			<input type="hidden" name="jenis[<?php echo $data['id']; ?>]" value="<?php echo $data['type']; ?>"/>
		</td>
		<td style="text-align : right">
			<?php 
				if($data['klasifikasi'] == "debit"){
					$debit += $fill[$data['id']];
					echo decimal($fill[$data['id']]);
				} 
			?>											
		</td>
		<td style="text-align : right">
			<?php 
				if($data['klasifikasi'] == "credit"){
					$credit += $fill[$data['id']];
					echo decimal($fill[$data['id']]);
				} 
			?>	
		</td>
	  </tr>
	  <?php } ?>
		
	  <tr style="font-weight : bold">
	  	<td colspan="3" style="text-align : right">Total</td>
	  	<td style="text-align : right"><?php echo decimal($debit); ?></td>
		<td style="text-align : right"><?php echo decimal($credit); ?></td>
	  </tr>

	  </tbody>
  </table>