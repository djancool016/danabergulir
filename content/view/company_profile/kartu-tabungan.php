<script type="text/javascript">
  $(function(){
    $("#frm_ksm").change(function(){
      var _link = '<?php echo base_url()."content/controller/dashboard.php?halaman=kartu_tabungan&id_ksm="; ?>' + $(this).val();

      location.replace(_link);
    });
  });
</script>

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
        <div class="row-fluid">
			<div class="span8">
				<i class="icon-custom-left"></i><h3>Kartu <span class="semi-bold">Tabungan</span></h3>
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

                <div class="grid-body no-border"> 
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

                <br>
				  <div align="center">
						<h2><span class="semi-bold">KARTU TABUNGAN</span></h2>
						<h4><?php echo $master['name']; ?></h4>
						<h4>No Rekening : <?php echo $master['acc_no']; ?></h4>
				  </div>
				  <br>
					
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered no-more-tables" id="example4" width="100%" >
  <tr>
    <th rowspan="2" style="background: #4bd4c9;"><div style="margin-top: 15px; color:#fff;"><strong>Tanggal</strong></div></th>
    <th rowspan="2" style="background: #4bd4c9;"><div style="margin-top: 15px; color:#fff; text-align:center;"><strong>Uraian</strong></div></th>
    <th rowspan="2" style="background: #4bd4c9;"><div style="margin-top: 15px; color:#fff; text-align:center;"><strong>No. Bukti</strong></div></th>
    <th colspan="2" style="background: #4bd4c9;"><div style="color:#fff; text-align:center;"><strong>Mutasi</strong></div></th>
    <th rowspan="2" style="background: #4bd4c9;"><div style="margin-top: 15px; color:#fff; text-align:center;"><strong>Saldo</strong></div></th>    
  </tr>
  <tr>
    <th style="background: #50aba3;"><div style="color:#fff; text-align:center;"><strong>Debet</strong></div></th>
    <th style="background: #50aba3;"><div style="color:#fff; text-align:center;"><strong>Kredit</strong></div></th>
    
  </tr>

  <?php $ex = get_tabungan_existing($_GET['id_ksm']); ?>
  <tr>
    <td>-</td>
    <td>Saldo Awal</td>
    <td>-</td>
	<td style="text-align : right">-</td>
	<td style="text-align : right"><?php echo decimal($ex['balance']); ?></td>
	<td style="text-align : right"><?php echo decimal($ex['balance']); $credit = $ex['balance']; ?></td>
  </tr>
  <?php while($data = mysql_fetch_array($query)){ ?>
  <tr>
    <td><?php echo date("d/m/Y", strtotime($data['transaction_date'])); ?></td>
    <td><?php echo $data['remark']; ?></td>
    <td><?php echo $data['no']; ?></td>
	<td style="text-align : right"><?php if($data['type'] == "out"){ echo decimal($data[base]); $debit += $data[base]; }else echo "-"; ?></td>
	<td style="text-align : right"><?php if($data['type'] == "in"){ echo decimal($data[base]); $credit += $data[base]; }else echo "-"; ?></td>
	<td style="text-align : right"><?php echo decimal($credit - $debit); ?></td>
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