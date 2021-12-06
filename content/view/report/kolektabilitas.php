<style type="text/css">
    .table-header-color1{
        background : #c2c2c2; 
    }

    .table-header-color2{
        background : #b0b0b0; 
    }
    
</style>

<div style="padding : 20px">
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
							<td width="20%" nowrap style="text-align : right"><h4><span class="semi-bold">Model LU-02</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4>Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata('kelurahan_name'); ?></span></h4></td>
							<td width="20%" nowrap style="text-align : right"><h4><span class="semi-bold"></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">LAPORAN KOLEKTABILITAS<br>PERHITUNGAN LAR, PAR DAN NILAI RESIKO SALDO PINJAMAN</span></h2>
                        <h4>Tanggal : <?php if($_GET['report_filter_period']) echo date("d-m-Y", strtotime($_GET['report_filter_period'])); else echo date("d-m-Y"); ?></h4>
				  </div>
				  <br>

    <div class="row-fluid">	
    	<div class="span12" style="overflow-x : scroll">	
    	
    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered no-more-tables" id="example4" width="100%" >
      <tr>
        <td style="text-align:center;" rowspan="2" class="table-header-color1">No</td>
        <td style="text-align:center;" rowspan="2" class="table-header-color1">Nama KSM</td>
        <td style="text-align:center;" colspan="2" class="table-header-color1">Tanggal Pinjaman</td>
        <td style="text-align:center;" rowspan="2" class="table-header-color1">Besar Pinjaman</td>
        <td style="text-align:center;" rowspan="2" class="table-header-color1">Angsuran per bulan</td>
        <td style="text-align:center;" colspan="2" class="table-header-color1">Saldo Pinjaman</td>
        <td style="text-align:center;" colspan="2" class="table-header-color1">Tunggakan</td>
        <td style="text-align:center;" colspan="5" class="table-header-color1">Kolektabilitas</td>
      </tr>
      <tr>
        <td style="text-align:center;" class="table-header-color2">Pencairan</td>
        <td style="text-align:center;" class="table-header-color2">Jatuh Tempo</td>
        <td style="text-align:center;" class="table-header-color2">Seharusnya</td>
        <td style="text-align:center;" class="table-header-color2">Sesungguhnya</td>
        <td style="text-align:center;" class="table-header-color2">&lt;3 bln / xAngsr</td>
        <td style="text-align:center;" class="table-header-color2">&gt;=3bln / xAngsr</td>
        <td style="text-align:center;" class="table-header-color2">Lancar</td>
        <td style="text-align:center;" class="table-header-color2">DPK<br />
        (<3 bln)</td>
        <td style="text-align:center;" class="table-header-color2">KL<br />
        (3-6 bln)</td>
        <td style="text-align:center;" class="table-header-color2">Diragu kan<br />
        (>6-9 bln)</td>
        <td style="text-align:center;" class="table-header-color2">Macet<br />
        (>9 bln)</td>
      </tr>
      <tr class="table-header-color4">
        <td style="text-align:center;"><span class="label label-warning">1</span></td>
        <td style="text-align:center;"><span class="label label-warning">2</span></td>
        <td style="text-align:center;"><span class="label label-warning">3</span></td>
        <td style="text-align:center;"><span class="label label-warning">4</span></td>
        <td style="text-align:center;"><span class="label label-warning">5</span></td>
        <td style="text-align:center;"><span class="label label-warning">6</span></td>
        <td style="text-align:center;"><span class="label label-warning">7</span></td>
        <td style="text-align:center;"><span class="label label-warning">8</span></td>
        <td style="text-align:center;"><span class="label label-warning">9</span></td>
        <td style="text-align:center;"><span class="label label-warning">10</span></td>
        <td style="text-align:center;"><span class="label label-warning">11</span></td>
        <td style="text-align:center;"><span class="label label-warning">12</span></td>
        <td style="text-align:center;"><span class="label label-warning">13</span></td>
        <td style="text-align:center;"><span class="label label-warning">14</span></td>
        <td style="text-align:center;"><span class="label label-warning">15</span></td>
      </tr>
        <?php 
            $x = 1; 
            $besar_pinjaman = $ksm_total = $ksm_nunggak = $seharusnya_tot = $sesungguhnya_tot = $lancar = $dpk = $kl = $ragu = $macet = 0;

            while($data = mysql_fetch_array($query)){ 
                if($data['tanggal_cair'] or $data['realization_value']){
                    if($data['realization_date']) $data['tanggal_cair'] = $data['realization_date'];
                //$lancar = $dpk = $kl = $ragu = $macet = 0;
        ?>
      <tr>
        <td><?php echo $x; ?></td>
        <td><?php echo $data['nama_ksm']; ?></td>
        <td><?php echo date("d/m/Y", strtotime($data['tanggal_cair'])); ?></td>
        <td><?php echo date("d/m/Y", strtotime($data['tanggal_cair']." + ".$data['loan_duration']." month")); ?></td>
        <td style="text-align : right"><?php echo decimal($data['loan_total']); $besar_pinjaman += $data['loan_total']; ?></td>
        <td style="text-align : right"><?php echo decimal($angsuran = $data['loan_total'] / $data['loan_duration']); ?></td>
        <?php 
            $now = $date;
            $last = date("Y-m-d", strtotime($data['tanggal_cair']." + ".$data['loan_duration']." month"));
            $status = kolektabilitas_status($data['id'], $now);

            $seharusnya = $data['loan_total'] - get_tunggakan('loan_total', $data['id'], " due_date >= '".$data['tanggal_cair']."' AND due_date <= '".$now."'");
            $sesungguhnya = get_tunggakan('loan_remaining', $data['id'], " 1 = 1 ");
           
            $tunggakan = get_tunggakan('loan_remaining', $data['id'], "due_date <= '".$now."'");
            $tunggakan = $tunggakan / $angsuran; //tentatip

            //$_tunggakan = get_tunggakan('loan_remaining', $data['id'], "due_date < '".date("Y-m-d", strtotime($now." - 3 month"))."'");
        ?>
        <td style="text-align : right"><?php echo decimal($seharusnya); $seharusnya_tot += $seharusnya; ?></td>
        <td style="text-align : right"><?php echo decimal($sesungguhnya); $sesungguhnya_tot += $sesungguhnya; ?></td>
        <td style="text-align : right"><?php if($tunggakan < 3){ echo decimal($tunggakan); $tunggakan_1 += $tunggakan; } ?></td>
        <td style="text-align : right"><?php if($tunggakan >= 3){ echo decimal($tunggakan); $tunggakan_2 += $tunggakan;  } ?></td>
<!-- REVISI KOLEKTIBILITAS Oleh DWI-->
<!-- <td style="text-align : right"><?php //if(!$status['total']){ echo decimal($sesungguhnya); $lancar += $sesungguhnya; } ?></td> -->
        <td style="text-align : right"><?php if($status['total'] >= 0 and $status['total'] < 2){ echo decimal($sesungguhnya); $lancar += $sesungguhnya; } ?></td>
        <td style="text-align : right"><?php if($status['total'] >= 2 and $status['total'] < 3){ echo decimal($sesungguhnya); $dpk += $sesungguhnya; } ?></td>
        <td style="text-align : right"><?php if($status['total'] >= 3 and $status['total'] < 6){ echo decimal($sesungguhnya); $kl += $sesungguhnya; $ksm_nunggak++; } ?></td>
        <td style="text-align : right"><?php if($status['total'] >= 6 and $status['total'] < 9){  echo decimal($sesungguhnya); $ragu += $sesungguhnya; $ksm_nunggak++; } ?></td>
        <td style="text-align : right"><?php if($status['total'] >= 9){ echo decimal($sesungguhnya); $macet += $sesungguhnya; $ksm_nunggak++; } ?></td>
      </tr>
      <?php $x++; $ksm_total++; }} ?>
      <tr style="background : #f1f1f1">
        <td colspan="4" style="text-align : right"><strong style="align : right">JUMLAH</strong></td>
        <td style="text-align : right"><b><?php echo decimal($besar_pinjaman); ?></b></td>
        <td>&nbsp;</td>
        <td style="text-align : right"><b><?php echo decimal($seharusnya_tot); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($sesungguhnya_tot); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($tunggakan_1); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($tunggakan_2); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($lancar); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($dpk); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($kl); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($ragu); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($macet); ?></b></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="6" style="text-align:right;"><strong>Presentase Resiko Tunggakan</strong></td>
        <td style="text-align : center"><strong>0.5%</strong></td>
        <td style="text-align : center"><strong>0.5%</strong></td>
        <td style="text-align : center"><strong>10%</strong></td>
        <td style="text-align : center"><strong>50%</strong></td>
        <td style="text-align : center"><strong>100%</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="6" style="text-align:right;"><strong>Jumlah Resiko (Jumlah kolom kolektabilitas x % Resiko)</strong></td>
        <td style="text-align : right"><b><?php echo decimal($lancar * 0.05); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($dpk * 0.05); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($kl * 0.1); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($ragu * 0.5); ?></b></td>
        <td style="text-align : right"><b><?php echo decimal($macet * 1); ?></b></td>
      </tr>
    </table>
    <?php
        $par = ($kl + $ragu + $macet) / $sesungguhnya_tot;
        $lar = $ksm_nunggak / $ksm_total;
    ?>
    <div><b>PAR : </b> <?php echo decimal($par * 100); ?>%</div>
    <div><b>LAR : </b> <?php echo decimal($lar * 100); ?>%</div>
    <br>
    <p><strong>Catatan:</strong></p>
    <p>

    PAR - (Pinjaman menunggak >= 3 bulan / jumlah pinjaman) x 100% = ..........%<br>
    LAR - (Jumlah KSM yang menunggak >= 3 bulan / jumlah KSM aktif) x 100% = .........%<br>

        </div>
    </div>	

                </div>
              </div>
</div>