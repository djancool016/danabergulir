<div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3> </h3>
      </div>
      <div class="modal-body"> </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
      <div class="page-title"> 
        <div class="row-fluid">
			<div class="span8">
				<i class="icon-custom-left"></i><h3>Laporan - <span class="semi-bold">Laba Rugi</span></h3>
			</div>
		</div>
      </div>

	  <?php require_once("../view/company_profile/report_header.php"); ?>			

	  <!-- BEGIN BASIC FORM ELEMENTS-->
	  <form id="frm_validation" action="#" method='post'>
        <div class="row-fluid">
            <div class="span12">
			
              <div class="grid simple">

				<div class="grid-title no-border bg-green">
				  <div class="row-fluid">
					<table width="100%">
						<tr>
							<td width="15%" nowrap><h4>Nama LKM</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata('lkm_name'); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold">Model LU-01</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4>Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata('kelurahan_name'); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold"></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">LAPORAN LABA RUGI</span></h2>
						<h4>Tanggal : <?php if($_GET['report_filter_period']) echo date("d-m-Y", strtotime($_GET['report_filter_period'])); else echo date("d-m-Y"); ?></h4>
				  </div>
				  <br>

<div class="row-fluid">	
	<div class="span2"></div>
	<div class="span8">	
	
					<table cellpadding="0" cellspacing="0" border="0" class="table no-border no-more-tables" id="laporan" width="100%" >


					  <tr>
						<td>&nbsp;</td>
						<td><span class="label label-success"><strong>PENDAPATAN</strong></span></td>
						<td style="text-align : right"><span class="label label-warning"><strong>JUMLAH (Rp)</strong></span></td>

						
					  </tr>
					  <?php 
					  	$total = 0; 
					  	$query = get_laba_rugi('pendapatan');

					  	while($data = mysql_fetch_array($query)){ 
					  ?>
						  <tr>
							<td><?php echo $data['code']; ?></td>
							<td><?php echo $data['name']; ?></td>
							<td style="text-align : right">
								<?php 
									$subtotal = $data['debit'] - $data['credit']; 
									echo decimal($subtotal);
									$total += $subtotal; 
								?>
							</td>							
						  </tr>
					  	<?php } ?>

					   <tr>
						<td>&nbsp;</td>
						<td><strong>JUMLAH</strong></td>
						<td style="text-align : right"><b><?php echo decimal($total); $laba = $total; ?></b></td>

						
					  </tr> 
					  <tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>

						
					  </tr> 
					  <tr>
						<td>&nbsp;</td>
						<td><span class="label label-danger"><strong>BIAYA</strong></span></td>
						<td>&nbsp;</span></td>

						
					  </tr>
					   <?php 
					  	$total = 0; 
					  	$query = get_laba_rugi('beban');

					  	while($data = mysql_fetch_array($query)){ 
			
					  ?>
						  <tr>
							<td><?php echo $data['code']; ?></td>
							<td><?php echo $data['name']; ?></td>
							<td style="text-align : right">
								<?php 
									$subtotal = $data['credit'] -  $data['debit']; 
									

									echo decimal($subtotal);
									$total += $subtotal; 
									if($data['code'] == "51050" or $data['code'] == "51060") $less_beban += $subtotal;
								?>
							</td>
						  </tr>
					  	<?php } ?>

					   <tr>
						<td>&nbsp;</td>
						<td><strong>JUMLAH</strong></td>
						<td style="text-align : right"><b><?php echo decimal($total); $rugi = $total; ?></b></td>

						
					  </tr> 
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>

						
					  </tr> 
					  <tr>
						<td>&nbsp;</td>
						<td><strong>LABA-RUGI</strong></td>
						<td style="text-align : right"><b><?php echo decimal($laba - $rugi); ?></b></td>

						
					  </tr> 
					  <tr>
						<td colspan="3" style="text-align : center">
							<div style="margin-top : 10px">
								<b class="label label-success" style="font-size : 15px; padding : 10px; margin-bottom : 20px">Ccr [Pendapatan / (Beban - Akun 51050 - Akun 51060)] = <?php echo decimal(($laba/($rugi - $less_beban) * 100))." %"; ?></b>
							</div>
						</td>

						
					  </tr> 
					</table>
					
	</div>
</div>	
<div class="span2"></div> 

          </div>
            </div>

         
	<!-- END BASIC FORM ELEMENTS-->		
		
		</div>
		</div>
	</div> 
  </div>
  </div>
 </div>