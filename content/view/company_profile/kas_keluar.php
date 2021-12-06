<div class="content">  
      <div class="page-title"> <i class="icon-custom-left"></i>
        <div class="row-fluid">
			<div class="span6">
				<h3>Bukti - <span class="semi-bold">Kas Keluar</span></h3>
			</div>
			<div style="text-align: right;">
				<a href="<?php echo base_url(); ?>content/controller/report.php?halaman=catatan_uang_keluar"><button class="btn btn-warning btn-cons" type="button"><i class="icon-th-list white-small"></i>Lihat Catatan Uang Keluar</button></a>
				
			</div>			
		</div>
      </div>

	  <!-- BEGIN BASIC FORM ELEMENTS-->
	  <form id="frm_validation" action="#" method='post'>
        <div class="row-fluid">
            <div class="span12">
			
              <div class="grid simple">
				<div class="grid-title no-border bg-red">
				  <div class="row-fluid">
					<table width="100%">
						<tr>
							<td width="15%" nowrap><h4 style="color: #fff;">Nama LKM</h4></td>
							<td width="65%" nowrap><h4 style="color: #fff;"><span class="semi-bold">: Mawar Melati</span></h4></td>
							<td width="20%" nowrap align="right"><h4 style="color: #fff;"><span class="semi-bold">Model B-L1</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4 style="color: #fff;">Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4 style="color: #fff;"><span class="semi-bold">: Sukodono</span></h4></td>
							<td width="20%" nowrap align="right"><h4 style="color: #fff;"><span class="semi-bold"></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>			  

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">BUKTI KAS KELUAR</span></h2>
						<h4>No. Transaksi: 0001/uk-upk/05/2014</h4>
				  </div>
				  <br>
					
				  <div class="row-fluid">
					<div class="span3"><h4>Dibayarkan kepada</h4></div>
                    <div class="span4" id="frm_kas_keluar_pilih_ksm">
					  <select id="frm_ksm2" style="width:100%">
					  
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
                   <div class="span5 input-with-icon right"><i class="" id="icon_frm_dibayar_ke"></i><input style="margin-left:-20px;" type="text" name="frm_dibayar_ke" id="frm_dibayar_ke" class="span12" placeholder="Uraikan"></span></div>					
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
                    <div class="span4">
					  <select id="frm_akun" style="width:100%">
					  
						<option value="AK">11010 - Kas</option>
						<option value="AK">11021 - Bank UPK</option>
						<option value="AK">11030 - Pinjaman KSM (Piutang)</option>
						<option value="AK">12010 - Inventaris dan Harta Tetap</option>
						<option value="HI">21020 - Tabungan KSM</option>
						<option value="HI">51010 - Insentif Karyawan UPK</option>
						<option value="HI">51030 - Biaya Kantor</option>
						<option value="HI">51040 - Biaya Transport</option>
						<option value="HI">51050 - Biaya Rapat</option>
						<option value="HI">52010 - Biaya Non Operasional</option>
					  </select>
                    </div>
					
					<div class="span5 input-with-icon right"><i class=""></i><input style="margin-left:-20px;" type="text" name="frm_realisasi" id="frm_realisasi" class="span12" placeholder="Uraikan"></span></div>					
				  </div>

				  <div class="row-fluid">
					<div class="span3"><h4>Jumlah</h4></div>
					<div class="input-prepend span6 primary input-with-icon right2">
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					<input id="frm_kas_keluar_jumlah" name="frm_kas_keluar_jumlah" placeholder="" type="text" class="span7 auto" data-a-sep="." data-a-dec=",">
					</div>
				  </div>
 

				  <div class="row-fluid">
					<div class="span3"><h4>Terbilang</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="frm_terbilang" id="frm_terbilang" class="span10-b" placeholder="Uraikan sesuai nominal"></span></div>
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Penerima</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="frm_penerima" id="frm_penerima" class="span10-b" placeholder="Penerima kas"></span></div>
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