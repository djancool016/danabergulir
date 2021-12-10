<div class="content">  
      <div class="page-title"> <i class="icon-custom-left"></i>
        <div class="row-fluid">
			<div class="span6">
				<h3>Bukti - <span class="semi-bold">Kas Masuk</span></h3>
			</div>
			<div style="text-align: right;">
				<a href="<?php echo base_url(); ?>content/controller/report.php?halaman=catatan_uang_masuk"><button class="btn btn-warning btn-cons" type="button"><i class="icon-th-list white-small"></i>Lihat Catatan Uang Masuk</button></a>
				
			</div>			
		</div>
      </div>

	  <!-- BEGIN BASIC FORM ELEMENTS-->
	  <form id="frm_validation" action="#" method="post">
        <div class="row-fluid">
            <div class="span12">
			
              <div class="grid simple">

				<div class="grid-title no-border bg-green">
				  <div class="row-fluid">
					<table width="100%">
						<tr>
							<td width="15%" nowrap><h4>Nama LKM</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata("lkm_name"); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold">Model A-L1</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4>Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4><span class="semi-bold">: -</span></h4></td>
							<td width="20%" nowrap align="right"><h4><span class="semi-bold"></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">BUKTI KAS MASUK</span></h2>
						<h4>
							No. Transaksi : <?php echo $code; ?>
							<input type="hidden" value="<?php echo $code; ?>" name="no"/>
						</h4>
				  </div>
				  <br>
					
				  <div class="row-fluid">
					<div class="span3"><h4>Terima dari</h4></div>
                    <div class="span4" id="frm_kas_masuk_pilih_ksm">
					  <select id="frm_ksm" style="width:100%">
					  
						<optgroup label="KSM">
						
						<option value="AK">KSM Durian</option>
						<option value="HI">KSM Semangka</option>
						<option value="HI">KSM Anggur</option>
						<option value="HI">KSM Apel</option>
						<option value="HI">KSM Duku</option>
						<option value="HI">KSM Bengkoang</option>
						<option value="HI">KSM Cempedak</option>
						<option value="HI">KSM Jambu</option>
						</optgroup>
						<optgroup label="Lainnya">
						<option value="lainnya">Lainnya</option>
						</optgroup>
					  </select>
                    </div>
                   <div class="span5 input-with-icon right"><i class="" id="icon_frm_terima_dari"></i><input style="margin-left:-20px;" type="text" name="frm_terima_dari" id="frm_terima_dari" class="span12" placeholder="Uraikan"></span></div>
					
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Nomor Register</h4></div>
                    <div class="span4">
					  <select id="frm_nomor_reg" style="width:100%">
					  
						<option value="pinjaman">Pinjaman</option>
						<option value="simpanan">Simpanan</option>
						<option value="lainnya">Lainnya</option>
					  </select>
                    </div>
					<input id="no_reg" name="no_reg" style="margin-left:5px;" type="text" class="span5" placeholder="(otomatis)" disabled="disabled">
				  </div>			  

				  
				  <div class="row-fluid">
					<div class="span3"><h4>Untuk realisasi pembayaran</h4></div>
                    <div class="span9 input-with-icon right"><i class=""></i><input type="text" name="frm_realisasi" id="frm_realisasi" class="span10-b" placeholder="Uraikan"></span></div>
				  </div>

				  <div class="row-fluid">
					<div class="span3"><h4>Angsuran Pokok</h4></div>
					<div class="span4"><input type="text" class="span12" placeholder="11030 - Pinjaman KSM (Piutang)" disabled="disabled"></div>
					<div class="input-prepend span5 primary" style="margin-left:5px;">
						
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					   
						<input type="text" class="count span6 auto" id="frm_angs_pokok" name="frm_angs_pokok" placeholder="" data-a-sep="." data-a-dec=",">
					</div>
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Bunga/Jasa</h4></div>
					<div class="span4"><input type="text" class="span12" placeholder="41010 - Bunga/Jasa" disabled="disabled"></div>
					<div class="input-prepend span5 primary" style="margin-left:5px;">
						
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					
					 <input type="text" class="count span6 auto" id="frm_bunga_jasa" name="frm_bunga_jasa" placeholder="" data-a-sep="." data-a-dec=",">
					</div>
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Lainnya</h4></div>
					<div class="span4">
					  <select id="frm_akun3" style="width:100%">
					  
						<option value="AK">11021 - Bank UPK</option>
						<option value="HI">21020 - Tabungan KSM</option>
						<option value="HI">31010 - Modal PB Awal KSM</option>
						<option value="HI">31020 - Modal PNPM</option>
						<option value="HI">41020 - Pendapatan Lain dari Pinjaman</option>
					  </select>
                    </div>
					<div class="input-prepend span5 primary" style="margin-left:5px;">
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					<input type="text" class="count span6 auto" id="frm_lainnya" name="frm_lainnya" placeholder="" data-a-sep="," data-a-dec=".">
					
					</div>
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Jumlah</h4></div>
					<div class="span4"><input type="text" class="span12" placeholder="11010 - Kas UPK" disabled="disabled"></div>
					<div class="input-prepend span5 primary" style="margin-left:5px;">
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					<input disabled="disabled" id="frm_jumlah" name="frm_jumlah" placeholder="" type="text" class="span6 auto" data-a-sep="." data-a-dec=",">
					</div>
				  </div>

				  <div class="row-fluid">
					<div class="span3"><h4>Terbilang</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="frm_terbilang" id="frm_terbilang" class="span10-b" placeholder="Uraikan sesuai nominal"></span></div>
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Penyetor</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="frm_penyetor" id="frm_penyetor" class="span10-b" placeholder="Uraikan sesuai nominal"></span></div>
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
		</form>  
	<!-- END BASIC FORM ELEMENTS-->	
	
	
	
	
	
	
		
		
		</div>
		</div>
	</div> 


