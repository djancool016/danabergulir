

   <div class="content">  
      <div class="page-title"> <i class="icon-custom-left"></i>
        <div class="row-fluid">
			<div class="span6">
				<h3>Bukti - <span class="semi-bold">Pindah Buku</span></h3>
			</div>
			<div style="text-align: right;">
				<a href="buku-bank.html"><button class="btn btn-warning btn-cons" type="button"><i class="icon-th-list white-small"></i>Lihat Buku Bank</button></a>
				
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
							<td width="65%" nowrap><h4><span class="semi-bold">: Mawar Melati</span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold">Model C</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4>Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: Sukodono</span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold"></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">BUKTI PINDAH BUKU</span></h2>
						<h4>No. Transaksi: 0001/bp-upk/05/2014</h4>
				  </div>
				  <br>
					
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
					<input type="text" class="span6 auto" id="frm_pindah_buku_debet" name="frm_pindah_buku_debet" placeholder="" data-a-sep="." data-a-dec=",">
					
					</div>
				  </div>
				  


				  <div class="row-fluid">
					<div class="span3"><h4>Kredit</h4></div>
					<div class="span5">
					  <select id="id_coa_kredit" name="id_coa_kredit" style="width:100%">
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
					<input type="text" class="span6 auto" id="frm_pindah_buku_kredit" name="frm_pindah_buku_kredit" placeholder="" data-a-sep="." data-a-dec=",">
					
					</div>
				  </div>
				  
  


				  <div class="row-fluid">
					<div class="span3"><h4>Keterangan Transaksi</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="frm_ket_transaksi" id="frm_ket_transaksi" class="span10-b" placeholder="Uraikan sesuai nominal"></span></div>
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