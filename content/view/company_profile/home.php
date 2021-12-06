<!--
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
        <td style="text-align : right"><?php if(!$status['total']){ echo decimal($sesungguhnya); $lancar += $sesungguhnya; } ?></td>
        <td style="text-align : right"><?php if($status['total'] >= 1 and $status['total'] < 3){ echo decimal($sesungguhnya); $dpk += $sesungguhnya; } ?></td>
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

        $par *= 100;
        $lar *= 100;
    ?>
-->
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/highcharts/js/highcharts.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/highcharts/js/highcharts-more.js"></script>

	<script type="text/javascript">
		$(function(){
		    $('#status-pinjaman').highcharts({
		        chart: {
		            plotBackgroundColor: null,
		            plotBorderWidth: null,
		            plotShadow: false,
		            type: 'pie'
		        },
		        title: {
		            text: ' '
		        },
		        tooltip: {
		            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br>Jumlah Rinjaman : <b>Rp.{point.y}</b>'
		        },
		        plotOptions: {
		            pie: {
		                allowPointSelect: true,
		                cursor: 'pointer',
		                dataLabels: {
		                    enabled: true,
		                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		                    style: {
		                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		                    }
		                }
		            }
		        },
		        series: [{
		            name: "Status Pinjaman KSM",
		            colorByPoint: true,
		            data: [{
		                name: "LANCAR",
		                y: <?php echo $lancar; ?>
		            }, {
		                name: "DPK",
		                y: <?php echo $dpk; ?>
		            }, {
		                name: "KL",
		                y: <?php echo $kl; ?>
		            }, {
		                name: "DIRAGUKAN",
		                y: <?php echo $ragu; ?>
		            }, {
		                name: "MACET",
		                y: <?php echo $macet; ?>
		            }]
		        }]
		    });

			$('#idle-money').highcharts({
		        title: {
		            text: ' '
		        },
		        xAxis: {
		            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		        },
		        yAxis: {
		            title: {
		                text: ' '
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        legend: {
		            enabled : false
		        },
		        series: [{
		            name: 'Iddle Money',
		            data: [<?php 
		            	$last = 0;
		            	for($i=1;$i<=12;$i++){
		            		$curr = $kas = $bank = $out = 0;

		            		$kas  = get_neraca_saldo(1, $i);
							$bank = get_neraca_saldo(2, $i);
							$out  = get_neraca_saldo(9, $i) + 
									get_neraca_saldo(10, $i) + 
									get_neraca_saldo(11, $i);
		            				 
		            		$last = ($kas + $bank) - $out;

		            		echo $last.", ";
		            	}

		            ?>]
		        }]
		    });

			$('#pinjaman').highcharts({
		        title: {
		            text: ' '
		        },
		        xAxis: {
		            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		        },
		        yAxis: {
		            title: {
		                text: ' '
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        legend: {
		            enabled : false
		        },
		        series: [{
		            name: 'Pinjaman',
		            data: [<?php 
		            	$last = 0;
		            	for($i=1;$i<=12;$i++){
		            		$kas  = get_neraca_saldo(3, $i);
		            		$last = $kas;

		            		echo $last.", ";
		            	}

		            ?>]
		        }]
		    });

		    $('#simpanan').highcharts({
		        title: {
		            text: ' '
		        },
		        xAxis: {
		            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		        },
		        yAxis: {
		            title: {
		                text: ' '
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        legend: {
		            enabled : false
		        },
		        series: [{
		            name: 'Simpanan',
		            data: [<?php 
		            	$last = 0;
		            	for($i=1;$i<=12;$i++){
		            		$kas  = get_neraca_saldo(10, $i);
		            		$last = $kas;

		            		echo $last.", ";
		            	}

		            ?>]
		        }]
		    });
		});
	</script>

	<?php
	get_neraca_saldo(1, 4);
	get_neraca_saldo(2, 4);
	get_neraca_saldo(9, 4); 
	get_neraca_saldo(10, 4);
	get_neraca_saldo(11, 4);

	?>
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">  
		<div class="page-title">	
			<h3>Dashboard</h3>		
		</div>
		<div id="container">

		<?php if(cek_is_used() and get_last_accperiod() != date("Y")){ ?>
		<span class="label label-info" style="background : #ec3131; width : 99%; padding : 10px; margin-bottom : 10px; text-align : center">
			TRANSAKSI ANDA SUDAH MELEWATI TAHUN <?php echo date("Y") - 1; ?>. SEGERA LAKUKAN TUTUP BUKU !
		</span>
		<?php } ?>

		<div class="row-fluid spacing-bottom 2col">	
			<div class="span3">
				<?php 
					if($lar <= 10){ $color = '#40e848'; $words = 'Memuaskan'; }
					if($lar > 10 and $lar < 20){ $color = '#fcc94f'; $words = 'Minimum'; }
					if($lar >= 20){ $color = '#ea3a3a'; $words = 'Penundaan'; }
				?>
				<div class="tiles blue added-margin" style="background : <?php echo $color; ?>">
				  <div class="tiles-body">
					<div class="controller">								
						<a href="javascript:;" class="reload"></a>
						<a href="javascript:;" class="remove"></a>		
					</div>		
					<div class="heading">
						LAR
					</div>	
					<div class="heading">
					<?php echo decimal($lar); ?>%
											
					</div>
					</div>	
				</div>
				<div class="tiles white added-margin">
						  <div class="tiles-body">
							<div class="tiles-title">
								<span class="label label-info" style="background : <?php echo $color; ?>"><?php echo $words; ?></span>
							</div>	
						</div>
				</div>				
			</div>
			<?php 
				if($par <= 10){ $color = '#40e848'; $words = 'Memuaskan'; }
				if($par > 10 and $par < 20){ $color = '#fcc94f'; $words = 'Minimum'; }
				if($par >= 20){ $color = '#ea3a3a'; $words = 'Penundaan'; }
			?>
			<div class="span3 ">	
				<div class="tiles green added-margin" style="background : <?php echo $color; ?>">
				  <div class="tiles-body">
					<div class="controller">								
						<a href="javascript:;" class="reload"></a>
						<a href="javascript:;" class="remove"></a>		
					</div>		
					<div class="heading">
						PAR
					</div>	
					<div class="heading">
					<?php echo decimal($par); ?>%
											
					</div>
					</div>	
				</div>
				<div class="tiles white added-margin">
						  <div class="tiles-body">
							<div class="tiles-title">
								<span class="label label-warning" style="background : <?php echo $color; ?>"><?php echo $words; ?></span>
							</div>	
						</div>
				</div>				
			</div>
			
			<?php
				$query = get_laba_rugi('pendapatan');
	  			while($data = mysql_fetch_array($query)) $_laba += $data['credit'] - $data['debit']; 
	  			$query = get_laba_rugi('beban');
	  			while($data = mysql_fetch_array($query)){
	  				$_rugi += $data['debit'] - $data['credit'];
	  				if($data['code'] == "51050" or $data['code'] == "51060") $less_rugi += $data['debit'] - $data['credit'];
	  			}

	  			$modal = get_coa_total('14');

	  			$roi = decimal((((($_laba - $_rugi)/$modal) * 12) / date("n")) * 100); 
	  			$ccr = decimal(($_laba/($_rugi - $less_rugi) * 100));

				if($ccr >= 125){ $color = '#40e848'; $words = 'Memuaskan'; }
				if($ccr >= 100 and $ccr < 125){ $color = '#fcc94f'; $words = 'Minimum'; }
				if($ccr < 100){ $color = '#ea3a3a'; $words = 'Penundaan'; }
			?>
			<div class="span3 ">	
				<div class="tiles purple added-margin" style="background : <?php echo $color; ?>">
				  <div class="tiles-body">
					<div class="controller">								
						<a href="javascript:;" class="reload"></a>
						<a href="javascript:;" class="remove"></a>		
					</div>		
					<div class="heading">
						CCr
					</div>	
					<div class="heading">
					<span class="animate-number" data-value="<?php echo $ccr; ?>" data-animation-duration="1200">0</span>%
											
					</div>
					</div>	
				</div>
				<div class="tiles white added-margin">
						  <div class="tiles-body">
							<div class="tiles-title">
								<span class="label label-info" style="background : <?php echo $color; ?>"><?php echo $words; ?></span>
							</div>	
						</div>
				</div>				
			</div>
			<?php	  		
				if($roi >= 10){ $color = '#40e848'; $words = 'Memuaskan'; }
				if($roi >= 0 and $roi < 10){ $color = '#fcc94f'; $words = 'Minimum'; }
				if($roi < 0){ $color = '#ea3a3a'; $words = 'Penundaan'; }
	  		?>

			<div class="span3">	
				<div class="tiles red added-margin" style="background : <?php echo $color; ?>">
				  <div class="tiles-body">
					<div class="controller">								
						<a href="javascript:;" class="reload"></a>
						<a href="javascript:;" class="remove"></a>		
					</div>		
					<div class="heading">
						ROI
					</div>	
					<div class="heading">
					<span class="animate-number" data-value="<?php echo $roi; ?>" data-animation-duration="1200">0</span>%
											
					</div>
					</div>	
				</div>
				<div class="tiles white added-margin">
						  <div class="tiles-body">
							<div class="tiles-title">
								<span class="label label-important" style="background : <?php echo $color; ?>"><?php echo $words; ?></span>
							</div>	
						</div>
				</div>				
			</div>
		</div>  
	  <div class="row-fluid">
		<div class="span6">
			<div class="grid simple">
			  <div class="grid-title no-border">
				<h4 style="text-align : center">Idle <span class="semi-bold"> Money</span></h4>
				<div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			  </div>
			  <div class="grid-body no-border">
				<div class="row-fluid" style="text-align : center">		
				<h4 style="text-align : center; font-size : 12px; color : #fff" class="label label-info">idle money = (kas + bank) - total kewajiban</h4>
				<br>
					<div id="idle-money"></div>
					
				</div>
			 </div>
		   </div>
		</div>
		<div class="span6">
			<div class="grid simple">
			  <div class="grid-title no-border">
				<h4>Status <span class="semi-bold"> Pinjaman KSM</span></h4>
				<div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			  </div>
			  <div class="grid-body no-border">
				<div class="row-fluid" style="text-align : center">		
				<br>				
					<div id="status-pinjaman"></div>
				</div>
			 </div>
		   </div>			
		</div>
		</div>

		<div class="row-fluid">
		<div class="span6">
			<div class="grid simple">
			  <div class="grid-title no-border">
				<h4>Pinjaman <span class="semi-bold"> KSM</span></h4>
				<div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			  </div>
			  <div class="grid-body no-border">
				<div class="row-fluid" style="text-align : center">		
				<br>				
					<div id="pinjaman"></div>
				</div>
			 </div>
		   </div>			
		</div>
		<div class="span6">
			<div class="grid simple">
			  <div class="grid-title no-border">
				<h4>Tabungan <span class="semi-bold"> KSM</span></h4>
				<div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
			  </div>
			  <div class="grid-body no-border">
				<div class="row-fluid" style="text-align : center">		
				<br>				
					<div id="simpanan"></div>
				</div>
			 </div>
		   </div>			
		</div>		
	  </div>
		
		
		</div>
	</div>