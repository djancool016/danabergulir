<style type="text/css">
	#tab4Pengguna tr:hover td{
		background : #b2cfed; 
	}	
</style>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Pengaturan</div>
<div style="margin-top:20px; margin-left:25px;">
<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center" style="background-color:#d1dade; padding:14px 1px 14px 1px; width:12%; ">
			<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=pengaturan&edit=1">Data LKM</a>
		</td>
		<td align="center" style="background-color:#FFFFFF; padding:14px 1px 14px 1px; width:12%">
			<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=buku_besar">Buku Besar</a>
		</td>
		<td colspan="5" style="background-color:#d1dade; padding-left:20px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<?php 
		$num = get_ksm_list();
		$num = mysql_num_rows($num);

		$sav = get_ksm_saving();
		$sav = mysql_num_rows($sav);

		if(!$num and !$sav){
	?>
	<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center">
			<div style="padding : 20px; text-align : center; margin-top : -20px">
				<h4>Silakan isi <span class="semi-bold"> Database KSM</span> terlebih dahulu</h4>
				<div style="display : inline-block">
					Untuk memperoleh saldo awal akun <b>11030 - Pinjaman KSM</b> dan akun <b>21020 - Tabungan KSM</b>
				</div>
			</div>
		</td>
	</tr>
	</table>
	<?php } else { ?>
	<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td>
			<div style="padding : 20px">
				<form id="frm_validation5" action="<?php echo base_url()."content/controller/dashboard.php?halaman=save_buku_besar" ;?>" method='post'>
					<h3>Buku <span class="semi-bold"> Besar</span></h3>

					<div style="float : right; margin-top : -20px">
						<span class="label label-info" style="margin : 3px; float : right">
							<a href="?halaman=<?php echo $_GET['halaman']; ?>&print=xls">Print XLS</a>
						</span>
						<span class="label label-info" style="margin : 3px; float : right">
							<a href="?halaman=<?php echo $_GET['halaman']; ?>&print=pdf">Print PDF</a>
						</span>
					</div>
					<hr noshade>

					<div class="tab-pane" id="tab4Pengguna" style="background-color : #fff">
				
						  <div class="row-fluid">
							<div class="span12">
							  <div class="grid simple ">
								<div class="grid-body no-border no-padding ">
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
								</div>
							  </div>
							</div>
						  </div>
					
					</div>											
						
					</form>
				</div>
			</td>
		</tr>
	</table>

	<?php } ?>
</div>