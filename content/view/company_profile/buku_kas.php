 <div class="content">  
      <div class="page-title"> 
        <div class="row-fluid">
    			<div class="span8">
    				<i class="icon-custom-left"></i><h3>Buku - <span class="semi-bold">Kas</span></h3>
    			</div>
    		</div>
        <div style="font-size : 10px">
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
							<td width="20%" nowrap align="right"><h4><span class="semi-bold">Model U-3</span></h4></td>
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
						<h2><span class="semi-bold">BUKU KAS</span></h2>
						<h4>Tanggal : <?php if($_GET['report_filter_period']) echo date("d-m-Y", strtotime($_GET['report_filter_period'])); else echo date("d-m-Y"); ?></h4>
				  </div>
				  <br>
					
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered no-more-tables" id="table-kas" width="100%" >
  <thead>
    <tr>
      <th style="background: #50aba3; text-align : center"><div style="color:#fff;""><strong>Tanggal<br><span class="label label-warning">1</strong></strong></div></th>
      <th style="background: #50aba3; text-align : center"><div style="color:#fff;""><strong>Uraian<br><span class="label label-warning">2</strong></strong></div></th>
      <th style="background: #50aba3; text-align : center"><div style="color:#fff;""><strong>No. Bukti<br><span class="label label-warning">3</strong></strong></div></th>
      <th style="background: #50aba3; text-align : center"><div style="color:#fff;"><strong>Transaksi <br> Debet<br><span class="label label-warning">4</strong></div></th>
      <th style="background: #50aba3; text-align : center"><div style="color:#fff;"><strong>Transaksi <br> Kredit<br><span class="label label-warning">5</strong></div></th>
      <th style="background: #50aba3; text-align : center"><div style="color:#fff;"><strong>Saldo <br> Debet<br><span class="label label-warning">6</strong></div></th>
    </tr>
    <tr id="table-kas-header">
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php $saldo_awal = get_saldo_awal(1); ?>
  <?php $saldo = get_saldo_awal(1); ?>
  <tr>
    <td>-</td>
    <td>Saldo Awal</td>
    <td>-</td>
    <td style="text-align : right">-</td>
    <td style="text-align : right">-</td>
    <td style="text-align : right"><?php echo decimal($saldo); ?></td>
  </tr>
  <?php 
  	while ($b = mysql_fetch_array($a)) {
		$base = decimal($b[base]);
  ?>

    <tr>
      <td><?php echo $b["transaction_date"]; ?></td>
      <td><?php echo $b["remark"]; ?></td>
      <td><?php echo"$b[no]"; ?></td>
      <td style="text-align : right"><?php if($b['type'] == "out"){ echo $base; $saldo += $b[base]; }else echo "-"; ?></td>
      <td style="text-align : right"><?php if($b['type'] == "in"){ echo $base; $saldo -= $b[base]; }else echo "-"; ?></td>
      <td style="text-align : right"><?php echo decimal($saldo); ?></td>
    </tr>
    <?php } ?>
  </tbody>
 
  <tfoot>
      <tr><th></th><th></th><th></th><th></th><th></th><th></th></tr>
  </tfoot>
</table>
 
            </div>
          </div>
	<!-- END BASIC FORM ELEMENTS-->	
	
	
	
	
	
	
		
		
		</div>
		</div>
	</div> 