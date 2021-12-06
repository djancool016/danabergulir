<script type="text/javascript">
  $(function(){
    $("#frm_ksm").change(function(){
      var _link = '<?php echo base_url()."content/controller/dashboard.php?halaman=kartu_pinjaman&id_ksm="; ?>' + $(this).val();

      location.replace(_link);
    });
  });
</script>

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
				<i class="icon-custom-left"></i><h3>Kartu <span class="semi-bold">Pinjaman</span></h3>
			</div>
			<div class="span4">
        <div class="row-fluid">
          <div class="span12" id="frm_kas_masuk_pilih_ksm">
					  <?php if($id_ksm){ ?>
            <select id="frm_ksm" style="width:100%">
  						<optgroup label="KSM">
  						<?php while($data = mysql_fetch_array($ksm)){ ?>
                <option <?php if($id_ksm == $data['id']) echo 'selected="selected"'; ?> value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
              <?php } ?>
  						</optgroup>
  					 </select>
             <?php } ?>
          </div>
       
      </div>
				
				
			
				
				
			</div>			
		</div>
      </div>

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
							<td width="20%" nowrap align="right"><h4><span class="semi-bold">Model U-7B</span></h4></td>
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
          <?php if(!$id_ksm){ ?>
          <div style="text-align : center">
            <h2><span class="semi-bold">Silahkan Pilih KSM</span></h2>
            <select id="frm_ksm" style="width:100%">
             <option value=""> --- Pilih KSM --- </option>   
              <optgroup label="KSM">
              <?php while($data = mysql_fetch_array($ksm)){ ?>
                <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
              <?php } ?>
              </optgroup>
             </select>
          </div>        
          <?php } else { ?>
          <div align="center">
						<h2><span class="semi-bold">KARTU PINJAMAN</span></h2>
						<h4><?php echo $master['name']; ?></h4>
				  </div>
				  <br>

<table width="90%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="12%" nowrap="nowrap">Besar Pinjaman</td>
    <td width="24%" nowrap="nowrap">: <?php echo decimal($master['loan_total']); $harusnya = $master['loan_total']; ?></td>
    <td width="38%" nowrap="nowrap">&nbsp;</td>
    <td width="16%" nowrap="nowrap">Jangka Waktu</td>
    <td width="10%" nowrap="nowrap">: <?php echo $master['loan_duration']; ?></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Sistem Angsuran</td>
    <td nowrap="nowrap">: bulan</td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">Bunga Pinjaman</td>
    <td nowrap="nowrap">: <?php echo decimal($master['loan_interest'], 2); ?>%</td>
  </tr>
  <tr>
    <td nowrap="nowrap">Besar Angsuran</td>
    <td nowrap="nowrap">: 
    <?php 
      $monthly =  $master['loan_total'] / $master['loan_duration']; 
      $interest = ($monthly / 100) * $master['loan_interest']; 
      $interest_total = $interest * $master['loan_duration'];

      echo decimal($monthly + $interest);
     ?></td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">No. Pinjaman</td>
    <td nowrap="nowrap">: <?php echo $master['loan_no']; ?></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Angsuran Pokok</td>
    <td nowrap="nowrap">: <?php echo decimal($monthly); ?></td>
    <td nowrap="nowrap">&nbsp;</td>
    <td nowrap="nowrap">Tanggal Akad Pinjaman</td>
    <td nowrap="nowrap">: <?php echo date("d/m/Y", strtotime($master['akad_date'])); ?></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Angsuran Jasa/Bunga</td>
    <td nowrap="nowrap">: <?php echo decimal($interest); ?></td>
    <td nowrap="nowrap"> </td>
    <td nowrap="nowrap">Tanggal Jatuh Tempo</td>
    <td nowrap="nowrap">: 
      <?php 
          if($master['realization_date'])
            echo date("d/m/Y", strtotime($master['realization_date']." + ".$master['loan_duration']." month")); 
          else if($master['loan_start'])
            echo date("d/m/Y", strtotime($master['loan_start']." + ".$master['loan_duration']." month")); 
          else echo " - ";
      ?>
    </td>
  </tr>
</table>
<br><br>
				  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered no-more-tables" id="example4" width="100%" >
  <tr>
    <td style="color:#fff; text-align:center;" rowspan="3" class="table-header-color1">Tanggal</td>
    <td style="color:#fff; text-align:center;" colspan="2" rowspan="2" class="table-header-color1">ANGSURAN</td>
    <td style="color:#fff; text-align:center;" colspan="4" class="table-header-color1">SALDO</td>
    <td style="color:#fff; text-align:center;" colspan="2" rowspan="2" class="table-header-color1">TUNGGAKAN</td>
  </tr>
  <tr class="table-header-color2">
    <td style="color:#fff; text-align:center;" colspan="2">Harusnya</td>
    <td style="color:#fff; text-align:center;" colspan="2">Realisasi</td>
  </tr>
  <tr class="table-header-color3">
    <td style="color:#fff; text-align:center;">Pokok</td>
    <td style="color:#fff; text-align:center;">Jasa</td>
    <td style="color:#fff; text-align:center;">Pokok</td>
    <td style="color:#fff; text-align:center;">Jasa</td>
    <td style="color:#fff; text-align:center;">Pokok</td>
    <td style="color:#fff; text-align:center;">Jasa</td>
    <td style="color:#fff; text-align:center;">Pokok</td>
    <td style="color:#fff; text-align:center;">Jasa</td>
  </tr>
  <tr class="table-header-color4">
    <td style="color:#fff; text-align:center;"><span class="label label-warning">1</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">2</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">3</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">4</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">5</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">6</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">7</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">8</span></td>
    <td style="color:#fff; text-align:center;"><span class="label label-warning">9</span></td>
  </tr>
  <?php 
    if($master['realization_date'] or $master['loan_start']){ 
    if($master['realization_date']) $master['loan_start'] = $master['realization_date'];
  ?>
  <tr>
    <td style="text-align:center;" class="table-body1"><?php echo date("d/m/Y", strtotime($master['loan_start'])); ?></td>
    <td style="text-align:right;" class="table-body2"></td>
    <td style="text-align:right;" class="table-body2"></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($master['loan_total']); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($interest_total); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($master['loan_total']); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($interest_total); ?></td>
    <td style="text-align:right;" class="table-body2"></td>
    <td style="text-align:right;" class="table-body2"></td>
  </tr>
  <?php } else { ?>
  <tr>
    <td colspan="9" style="text-align : center"><i>Belum ada perguliran dana</i></td>
  </tr>
  <?php } ?>
  <?php 
    $int_total = $interest_total;
    $pokok_total = $master['loan_total'];

    while ($data = mysql_fetch_array($query)){ 
        $harusnya -= $data['loan_total'];
        $interest_total -= $data['interest_total'];
        $harusnya - ($data['loan_total'] - $data['loan_remaining']);
        
        $realisasi_pokok = $pokok_total - ($data['loan_total'] - $data['loan_remaining']);
        $realisasi_int = $int_total - ($data['interest_total'] - $data['interest_remaining']);
        
        $pokok_total =  $realisasi_pokok;
        $int_total = $realisasi_int;

        $tunggakan += $data['loan_remaining'];
        $tunggakan_int += $data['interest_remaining'];
  ?> 
  <tr>
    <td style="text-align:center;" class="table-body1"><?php echo date("d/m/Y", strtotime($data['due_date'])); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($data['loan_total']); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($data['interest_total']); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($harusnya); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($interest_total); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($realisasi_pokok); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($realisasi_int); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($tunggakan); ?></td>
    <td style="text-align:right;" class="table-body2"><?php echo decimal($tunggakan_int);?></td>
  </tr>
  <?php } ?>
</table>
<?php } ?>
 
            </div>
          </div>
	<!-- END BASIC FORM ELEMENTS-->	
	
	
	
	
	
	
		
		
		</div>
		</div>
	</div> 
  </div>
  </div>