
  <div class="content">  
      <div class="page-title"> 
        <div class="row-fluid">
			<div class="span8">
				<i class="icon-custom-left"></i><h3>Buku - <span class="semi-bold">Besar dan Neraca Saldo</span></h3>
			</div>
		</div>
      </div>
        <?php require_once("../view/company_profile/report_header.php"); ?> 

	  <!-- BEGIN BASIC FORM ELEMENTS-->
	  <form id="frm_validation" action="#" method='post'>
        <div class="row-fluid">
            <div class="span12">
			
              <div class="grid simple">

        <div class="grid-title no-border bg-green" style="margin-top : 10px">
				  <div class="row-fluid">
					<table width="100%">
						<tr>
							<td width="15%" nowrap><h4>Nama LKM</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata('lkm_name'); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold">Model U-8</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4>Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata('kelurahan_name'); ?></span></h4></td>
              <td width="20%" nowrap align="right"><h4 style="color: #fff;"><span class="semi-bold"><?php echo get_userdata("kota_name"); ?></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">BUKU BESAR DAN NERACA SALDO</span></h2>
            <h4>Tanggal : <?php if($_GET['report_filter_period']) echo date("d-m-Y", strtotime($_GET['report_filter_period'])); else echo date("d-m-Y"); ?></h4>
				  </div>
				  <br>
					
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered no-more-tables" id="example4" width="100%" >
  <tr>
    <th rowspan="2" style="background: #4bd4c9; text-align : center"><div style="margin-top: 15px; color:#fff;"><strong>Kode</strong></div></th>
    <th rowspan="2" style="background: #4bd4c9; text-align : center"><div style="margin-top: 15px; color:#fff;"><strong>Buku Besar</strong></div></th>
    <th rowspan="2" style="background: #4bd4c9; text-align : center"><div style="margin-top: 15px; color:#fff;"><strong>Saldo</strong></div></th>
    <th colspan="2" style="background: #4bd4c9; text-align : center"><div style="color:#fff; text-align:center;"><strong>Mutasi</strong></div></th>
    
  </tr>
  <tr>
    <th style="background: #50aba3; text-align : center"><div style="color:#fff;"><strong>Debet</strong></div></th>
    <th style="background: #50aba3; text-align : center"><div style="color:#fff;"><strong>Kredit</strong></div></th>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="text-align : center"><span class="label label-warning"><strong>AKTIVA</strong></span></td>
    <td style="text-align : center"><span class="label label-warning"><strong>DEBET</strong></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <?php 
    while ($b = mysql_fetch_array($a)) { 
      if($b['clean_credit']) $display_credit = decimal($b['clean_credit']); else{ $display_credit = "-"; $b['clean_credit'] = 0; }
      if($b['clean_debit']) $display_debit = decimal($b['clean_debit']); else{ $display_debit = "-"; $b['clean_debit'] = 0; }

        $saldo = $b['credit'] - $b['debit'];      
        $credit_total += $b['clean_credit'];
        $debit_total += $b['clean_debit'];
        $saldo_total += $saldo;
  ?>
  <tr>
    <td><?php echo "$b[code]"; ?></td>
    <td><?php echo "$b[name]"; ?></td>
    <td style="text-align : right"><?php echo decimal($saldo); ?></td>
    <td style="text-align : right"><?php echo $display_credit; ?></td>
    <td style="text-align : right"><?php echo $display_debit; ?></td>
  </tr>
<?php } ?>
<tr>
    <td>&nbsp;</td>
    <td><strong>JUMLAH</strong></td>
    <td style="text-align : right"><b><?php echo decimal($saldo_total); ?></b></td>
    <td style="text-align : right"><b><?php //echo decimal($credit_total); ?></b></td>
    <td style="text-align : right"><b><?php //echo decimal($debit_total); ?></b></td>
</tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 

  <tr>
    <td>&nbsp;</td>
    <td style="text-align : center"><span class="label label-warning"><strong>PASSIVA</strong></span></td>
    <td style="text-align : center"><span class="label label-warning"><strong>KREDIT</strong></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
  </tr>
  <?php 
      $saldo_total = $credit_total = $debit_total = 0;

      while($b = mysql_fetch_array($aa)){ 
        if($b['id'] == 18){
          $query = get_laba_rugi('pendapatan');
          while($data = mysql_fetch_array($query)) $laba += $data['debit'] - $data['credit']; 
          $query = get_laba_rugi('beban');
          while($data = mysql_fetch_array($query)) $rugi += $data['credit'] - $data['debit']; 
          
          $saldo = $laba - $rugi;
          $saldo_total += $saldo;

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
          $saldo_total += $saldo;
          
          $display_debit = decimal($b['clean_debit']);
          $display_credit = decimal($b['clean_credit']);
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
      <td><?php echo "$b[code]"; ?></td>
      <td><?php echo "$b[name]"; ?></td>
      <td style="text-align : right"><?php echo decimal($saldo); ?></td>
      <td style="text-align : right"><?php echo $display_credit; ?></td>
      <td style="text-align : right"><?php echo $display_debit; ?></td>
    </tr>
  <?php } ?>
  
  <tr>
      <td>&nbsp;</td>
      <td><strong>JUMLAH</strong></td>
      <td style="text-align : right"><b><?php echo decimal($saldo_total); ?></b></td>
      <td style="text-align : right"><b><?php //echo decimal($credit_total); ?></b></td>
      <td style="text-align : right"><b><?php //echo decimal($debit_total); ?></b></td>
  </tr>
 </table>
 
            </div>
          </div>
	<!-- END BASIC FORM ELEMENTS-->	
	
	
	
	
	
	
		
		
		</div>
		</div>
	</div> 