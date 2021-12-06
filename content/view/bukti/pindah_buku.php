<script type="text/javascript">
	$(function(){
		$("#id_coa_credit").change(function(){
			if($("#id_coa_debit").val() == $(this).val()){
				$("#id_coa_debit").val('').change();
			}

			$("#id_coa_debit option").removeAttr("disabled");
			$("#id_coa_debit option[value='" + $(this).val() + "']").attr("disabled", "disabled");
		});

		$("#id_coa_debit").change(function(){
			if($("#id_coa_credit").val() == $(this).val()){
				$("#id_coa_credit").val('').change();
			}

			$("#id_coa_credit option").removeAttr("disabled");
			$("#id_coa_credit option[value='" + $(this).val() + "']").attr("disabled", "disabled");
		});

		$("#base_credit").keyup(function(){
			var _base = $(this).val(); 
				_base = parseInt(_base.replace(/\./g, ''));

			$("#base_debit").val(_base);
			$('#base_debit').number(true , 0);
		});

		$("#base_debit").keyup(function(){
			var _base = $(this).val(); 
				_base = parseInt(_base.replace(/\./g, ''));

			$("#base_credit").val(_base);
			$('#base_credit').number(true , 0);
		});

		$('#form-pindah-buku').submit(function(){
			if($("#remark").val() == ""){
				alert('"Keterangan Transaksi" masih kosong !');
				$("#remark").focus();
				return false;			
			}
		});
	});
</script>

   <div class="content">  
   <?php if($_GET['error'] == 'closed_period'){ ?>
	<span class="label label-info" style="background : #ec3131; width : 95.5%; padding : 10px; margin-bottom : 10px; text-align : center">
		BUKU BESAR BELUM DISIMPAN ATAU SUDAH MELEWATI PERIODE BUKU !
	</span>
	<?php } ?>
	
      <div class="page-title"> <i class="icon-custom-left"></i>
        <div class="row-fluid">
			<div class="span6">
				<h3>Bukti - <span class="semi-bold">Pindah Buku</span></h3>
			</div>
		</div>
      </div>

	  <!-- BEGIN BASIC FORM ELEMENTS-->
	  <form id="form-pindah-buku" action="<?php echo base_url(); ?>content/controller/bukti.php?halaman=save_pindah_buku" method="post">
        <div class="row-fluid">
            <div class="span12">
			
              <div class="grid simple">

				<div class="grid-title no-border bg-blue">
				  <div class="row-fluid">
					<table width="100%">
						<tr>
							<td width="15%" nowrap><h4>Nama LKM</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata("lkm_name"); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold">Model C</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4>Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata("kelurahan_name"); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold"><?php echo get_userdata("kota_name"); ?></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">BUKTI PINDAH BUKU</span></h2>
						<h4>No. Transaksi: <?php echo $code; ?></h4>
						<input type="hidden" value="<?php echo $code; ?>" name="no"/>
				  </div>
				  <br>
					
					<div class="row-fluid">
					<div class="span3"><h4>Tanggal</h4></div>
                    <div class="span4">
                    	<select name="tanggal">
							<?php
								for ($tgl =  1; $tgl <= 31; $tgl++){ ?>
								<option value="<?php echo "$tgl"; ?>" <?php if(date("d") == $tgl) echo 'selected="selecter"'; ?>><?php echo "$tgl"; ?></option>
							<?php } ?>
						</select>

						<select name="bulan">
							<?php
								for ($bln = 1; $bln <= 12; $bln++){ ?>
								<option value="<?php echo "$bln"; ?>" <?php if(date("m") == $bln) echo 'selected="selecter"'; ?>><?php echo "$bln"; ?></option>
							<?php } ?>
						</select>
						 
						<select name="tahun">
							<?php
								for ($thn = 2001; $thn <= CURRENT_YEAR; $thn++){
							?>
								<option value="<?php echo "$thn"; ?>" <?php if(date("Y") == $thn) echo 'selected="selecter"'; ?>><?php echo "$thn"; ?></option>
							<?php } ?>
						</select>
                    </div>
                   </div>
                   
				  <div class="row-fluid">
					<div class="span3"><h4>Debet</h4></div>
					<div class="span5">
					  <select id="id_coa_debit" name="id_coa_debit" style="width:100%">
						<option value="">-- pilih salah satu --</option>  	
					  	<?php while($data = mysql_fetch_array($coa)){ ?>
						<option value="<?php echo $data['id']; ?>"><?php echo $data['code']." - ".$data['name']; ?></option>
						<?php } ?>
					  </select>
                    </div>
					<div class="input-prepend span4 primary input-with-icon right2" style="margin-left:5px;">
					
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					<input type="text" class="span6 auto" id="base_debit" name="base_debit" placeholder="" data-a-sep="." data-a-dec=",">
					
					</div>
				  </div>
				  


				  <div class="row-fluid">
					<div class="span3"><h4>Kredit</h4></div>
					<div class="span5">
					  <select id="id_coa_credit" name="id_coa_credit" style="width:100%">
						<option value="">-- pilih salah satu --</option>
					  	<?php while($data = mysql_fetch_array($_coa)){ ?>
						<option value="<?php echo $data['id']; ?>"><?php echo $data['code']." - ".$data['name']; ?></option>
						<?php } ?>
					  </select>
                    </div>
					<div class="input-prepend span4 primary input-with-icon right2" style="margin-left:5px;">
					
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					<input type="text" class="span6 auto" id="base_credit" name="base_credit" placeholder="" data-a-sep="." data-a-dec=",">
					
					</div>
				  </div>
				  
  


				  <div class="row-fluid">
					<div class="span3"><h4>Keterangan Transaksi</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="remark" id="remark" class="span10-b" placeholder="Uraikan sesuai nominal"></span></div>
				  </div>
				  

				<div class="form-actions">
					<div class="pull-right">
					  <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Simpan</button>
					  <button class="btn btn-white btn-cons" type="button" id="clear">Batal</button>
					</div>
				  </div>				  
				
                </div>
              </div>
 
            </div>
          </div>
	<!-- END BASIC FORM ELEMENTS-->	
	
	
	
	
	
	
		
		
		</div>
		</div>
	</div> 