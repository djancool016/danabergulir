<div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3></h3>
      </div>
      <div class="modal-body"></div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
      <div class="page-title"> 
        <div class="row-fluid">
			<div class="span8">
				<i class="icon-custom-left"></i><h3>Laporan - <span class="semi-bold">Neraca</span></h3>
			</div>
		</div>
      </div>

	  <!-- BEGIN BASIC FORM ELEMENTS-->
     <?php require_once("../view/company_profile/report_header.php"); ?>		

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
						<h2><span class="semi-bold">LAPORAN NERACA</span></h2>
						<h4>Per Tanggal : <?php if($_GET['report_filter_period']) echo date("d-m-Y", strtotime($_GET['report_filter_period'])); else echo date("d-m-Y"); ?></h4>
				  </div>
				  <br>

<div class="row-fluid">	
	<div class="span2"></div>
	<div class="span8">	
	
					<table cellpadding="0" cellspacing="0" border="0" class="table no-border no-more-tables" id="laporan" width="100%" >


					  <tr>
						<td>&nbsp;</td>
						<td><span class="label label-success"><strong>AKTIVA</strong></span></td>
						<td><span class="label label-warning"><strong>Rp</strong></span></td>

						
					  </tr>
					  <?php 
					  	$total = 0; 
					 	while ($data = mysql_fetch_array($a)){ 
					  ?>
						  <tr>
							<td><?php echo $data['code']; ?></td>
							<td><?php echo $data['name']; ?></td>
							<td style="text-align : right">
								<?php 
									$subtotal = $data['credit'] - $data['debit'];
									echo decimal($subtotal, 0);
									$total += $subtotal; 
								?>
							</td>							
						  </tr>
					  	<?php } ?>

					   <tr>
						<td>&nbsp;</td>
						<td><strong>JUMLAH</strong></td>
						<td style="text-align : right"><b><?php echo decimal($total); $aktiva = $total; ?></b></td>

						
					  </tr> 
					  <tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>

						
					  </tr> 
					  <tr>
						<td>&nbsp;</td>
						<td><span class="label label-danger"><strong>PASIVA</strong></span></td>
						<td>&nbsp;</span></td>

						
					  </tr>
					  <?php 
					      $total = 0;

					      while($b = mysql_fetch_array($aa)){ 
					        if($b['id'] == 18){
					          $query = get_laba_rugi('pendapatan');
					          while($data = mysql_fetch_array($query)) $laba += $data['debit'] - $data['credit']; 
					          $query = get_laba_rugi('beban');
					          while($data = mysql_fetch_array($query)) $rugi += $data['credit'] - $data['debit']; 
					          
					          $saldo = $laba - $rugi;
					          $total += $saldo;

					          if($saldo < 0){
					            $display_credit = decimal($saldo * -1);
					            $display_debit = '-';
					          }
					          else{
					            $display_debit = decimal($saldo);
					            $display_credit = '-';
					          }
					        }
					        else if($b['id'] == 17){
					          $saldo = get_laba_rugi_last();
					          $total += $saldo;

					          if($saldo < 0){
					            $display_credit = decimal($saldo * -1);
					            $display_debit = '-';
					          }
					          else{
					            $display_debit = decimal($saldo);
					            $display_credit = '-';
					          }
					        }
					        else{          
					          if($b['clean_credit']) $display_credit = decimal($b['clean_credit']); else{ $display_credit = "-"; $b['clean_credit'] = 0; }
					          if($b['clean_debit']) $display_debit = decimal($b['clean_debit']); else{ $display_debit = "-"; $b['clean_debit'] = 0; }

					          $saldo = $b['debit'] - $b['credit'];      
					          $credit_total += $b['clean_credit'];
					          $debit_total += $b['clean_debit'];
					          $saldo_total += $saldo;
					        }
					    ?>
						<tr>
							<td><?php echo $b['code']; ?></td>
							<td><?php echo $b['name']; ?></td>
							<td style="text-align : right">
								<?php 
									echo decimal($saldo, 0);
									$pasiva_total += $saldo; 
								?>
							</td>							
						  </tr>
						  <?php } ?>
					   <tr>
						<td>&nbsp;</td>
						<td><strong>JUMLAH</strong></td>
						<td style="text-align : right"><b><?php echo decimal($pasiva_total); $pasiva = $total; ?></b></td>

						
					  </tr> 
					  <tr>
						<td colspan="3"style="text-align : center">
							
							<div class="label label-success" style="font-size : 15px; padding : 10px; margin-bottom : 20px; margin-top : 20px">
								<?php
									$query = get_laba_rugi('pendapatan');
						  			while($data = mysql_fetch_array($query)) $_laba += $data['debit'] - $data['credit']; 
						  			$query = get_laba_rugi('beban');
						  			while($data = mysql_fetch_array($query)) $_rugi += $data['credit'] - $data['debit'];
						  			$modal = get_coa_total('14');

						  		?>
								 
								ROI : <?php echo "((Laba-Rugi/Modal PNPM) x 12)) / ".date("n")." = ".decimal((((($_laba - $_rugi)/$modal) * 12) / date("n")) * 100)." %"; ?>
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