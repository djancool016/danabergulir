<script type="text/javascript">
	var _kode = ["", "<?php echo $code_pinj; ?>", "<?php echo $code_tab; ?>", "<?php echo $code_lain; ?>"];
	function load_register(){
		$.ajax({
			url: "<?php echo base_url(); ?>content/controller/bukti.php?halaman=get_register&id_ksm=" + $("#id_ksm").val() + "&id_register=" + $("#type").val(),
			context: document.body
		}).done(function(data){
		  	$("#no_register").val(data);
		});
	}

	$(function(){
		$("#pinjaman-container, #simpanan-container, #lainnya-container, #other_ksm").hide();

		$("#type, #id_ksm").change(function(){
			load_register();
		});

		$("#base, #lainnya, #tabungan").keyup(function(){
			if(!$("#base").val()) 		var _base = 0; 		else var _base = $("#base").val();
			if(!$("#lainnya").val()) 	var _lainnya = 0; 	else var _lainnya = $("#lainnya").val();
			if(!$("#tabungan").val()) 	var _tabungan = 0; 	else var _lainnya = $("#tabungan").val();
			
			var _total = 0;

			if(_base) _total = parseFloat(_total) + parseFloat(_base.replace(/\./g, ''));
			if(_lainnya) _total = parseFloat(_total) + parseFloat(_lainnya.replace(/\./g, ''));
			if(_tabungan) _total = parseFloat(_total) + parseFloat(_tabungan.replace(/\./g, ''));

			$("#jumlah, #jumlah-helper").val(parseFloat(_total));
			$('#jumlah').number(true , 2);

			console.log(_total);

			$("#terbilang").html(terbilang());
		});


		$("#type").change(function(){
			if($(this).val() == "1"){
				$("#pinjaman-container").show();
				$("#simpanan-container").hide();
				$("#lainnya-container").hide();	
			}
			if($(this).val() == "2"){
				$("#pinjaman-container").hide();
				$("#simpanan-container").show();
				$("#lainnya-container").hide();	
			}
			if($(this).val() == "3"){
				$("#pinjaman-container").hide();
				$("#simpanan-container").hide();
				$("#lainnya-container").show();	
			}
		});

		$("#frm_akun3").change(function(){
			if($("#id_ksm option:selected").text() == "Lainnya"){
				$("#remark").val($("#frm_akun3 option:selected").text().slice(8,))
			}else{
				$("#remark").val($("#frm_akun3 option:selected").text().slice(8,)+" "+$("#id_ksm option:selected").text())
			}
			
			
		});


		$("#id_ksm").change(function(){
			$("#other_ksm").val('');

			if($(this).val() == "-") $("#other_ksm").show();
			else $("#other_ksm").hide();
		});

		$('#form-kas-keluar').submit(function(){
			if($("#id_ksm").val() == ""){
				alert('"Dibayarkan kepada" masih kosong !');
				$("#id_ksm").focus();
				return false;			
			}

			if($("#type").val() == ""){
				alert('"Nomor Register" masih kosong !');
				$("#type").focus();
				return false;			
			}

			
			if($("#remark").val() == ""){
				alert('"Untuk realisasi pembayaran" masih kosong !');
				$("#remark").focus();
				return false;			
			}

			if($("#base").val() == "" && $("#tabungan").val() == "" && $("#lainnya").val() == ""){
				alert('Anda belum memasukan jumlah kas keluar !');
				$("#jumlah").focus();
				return false;			
			}

			if($("#no_register").val() == "" && $("#type").val() != 3){
				alert('Tidak terdapat nomor register !');
				$("#no_register").focus();
				return false;			
			}

			if($("#transaction_by").val() == ""){
				alert('"Penerima" masih kosong !');
				$("#transaction_by").focus();
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

	<?php if($_GET['error'] == 'incorrect_loan'){ ?>
	<span class="label label-info" style="background : #ec3131; width : 95.5%; padding : 10px; margin-bottom : 10px; text-align : center">
		JUMLAH TIDAK SESUAI DENGAN TOTAL PINJAMAN !
	</span>
	<?php } ?>

      <div class="page-title"> <i class="icon-custom-left"></i>
        <div class="row-fluid">
			<div class="span6">
				<h3>Bukti - <span class="semi-bold">Kas Keluar</span></h3>
			</div>
			<div style="text-align: right;"></div>			
		</div>
      </div>

	  <form id="form-kas-keluar" action="<?php echo base_url(); ?>content/controller/bukti.php?halaman=save_kas" method="post">
        <div class="row-fluid">
            <div class="span12">
			
              <div class="grid simple">
				<div class="grid-title no-border bg-red">
				  <div class="row-fluid">
					<table width="100%">
						<tr>
							<td width="15%" nowrap><h4 style="color: #fff;">Nama LKM</h4></td>
							<td width="65%" nowrap><h4 style="color: #fff;"><span class="semi-bold">: <?php echo get_userdata("lkm_name"); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4 style="color: #fff;"><span class="semi-bold">Model B-L1</span></h4></td>
						</tr>
						<tr>
							<td width="15%" nowrap><h4 style="color: #fff;">Kelurahan/Desa</h4></td>
							<td width="65%" nowrap><h4 style="color: #fff;"><span class="semi-bold">: <?php echo get_userdata("kelurahan_name"); ?></span></h4></td>
							<td width="20%" nowrap align="right"><h4 style="color: #fff;"><span class="semi-bold"><?php echo get_userdata("kota_name"); ?></span></h4></td>
						</tr>
						</table>	
				  </div>
				</div>			  

                <div class="grid-body no-border"> <br>
				  <div align="center">
						<h2><span class="semi-bold">BUKTI KAS KELUAR</span></h2>
						<h4>
							No. Transaksi : <?php echo $code; ?>
							<input type="hidden" value="<?php echo $code; ?>" name="no"/>
						</h4>
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
					<div class="span3"><h4>Dibayarkan kepada</h4></div>
                    <div class="span4" id="frm_kas_masuk_pilih_ksm">
					  <select id="id_ksm" name="id_ksm" style="width:100%">
					  
						<option value="">-- pilih salah satu --</option>
						<optgroup label="KSM">
							<?php while($data = mysql_fetch_array($ksm)){ ?>
							<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
							<?php } ?>
						</optgroup>
						
						<optgroup label="Lainnya">
							<option value="-">Lainnya</option>
						</optgroup>
					  </select>
                    </div>
					<!-- <input id="other_ksm" name="other_ksm" style="margin-left:5px;" type="text" placeholder="Sumber lainnya"> -->
					
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Nomor Register</h4></div>
                    <div class="span4">
					  <select name="id_register" id="type" style="width:100%">
					 	<option value="">-- pilih salah satu --</option>
						<?php while($data = mysql_fetch_array($reg)){ ?>
						<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
						<?php } ?>
					  </select>
                    </div>
					<input id="no_register" name="no_register" style="margin-left:5px;" type="text" class="span5" placeholder="(otomatis)" readonly="readonly">
				  </div>			  

				  
				  <div class="row-fluid">
					<div class="span3"><h4>Untuk realisasi pembayaran</h4></div>
                    <div class="span9 input-with-icon right"><i class=""></i><input type="text" name="remark" id="remark" class="span10-b" placeholder="Uraikan"></span></div>
				  </div>

				  <div id="pinjaman-container">
					  <div class="row-fluid">
						<div class="span3"><h4>Jumlah</h4></div>
						<div class="span4"><input type="text" class="span12" placeholder="11030 - Pinjaman KSM (Piutang)" disabled="disabled"></div>
						<div class="input-prepend span5 primary" style="margin-left:5px;">
							
							<span class="add-on">
								<div>Rp</div>
								<span class="arrow"></span>
							</span>
						   
							<input type="text" class="count span6 auto" id="base" name="base" placeholder="" data-a-sep="." data-a-dec=",">
						</div>
					  </div>
				  </div>

					<div id="simpanan-container">
					  <div class="row-fluid">
						<div class="span3"><h4>Jumlah</h4></div>
						<div class="span4"><input type="text" class="span12" placeholder="21020 - Tabungan" disabled="disabled"></div>
						<div class="input-prepend span5 primary" style="margin-left:5px;">
							
							<span class="add-on">
								<div>Rp</div>
								<span class="arrow"></span>
							</span>
						   
							<input type="text" class="count span6 auto" id="tabungan" name="tabungan" placeholder="" data-a-sep="." data-a-dec=",">
						</div>
					  </div>
					</div>


				  <div id="lainnya-container">
					  <div class="row-fluid">
						<div class="span3"><h4>Lainnya</h4></div>
						<div class="span4">
						  <select id="frm_akun3" name="id_coa" style="width:100%">
						  	<?php while($data = mysql_fetch_array($coa)){ ?>
							<option value="<?php echo $data['id']; ?>"><?php echo $data['code']." - ".$data['name']; ?></option>
							<?php } ?>
						  </select>
	                    </div>
						<div class="input-prepend span5 primary" style="margin-left:5px;">
							<span class="add-on">
								<div>Rp</div>
								<span class="arrow"></span>
							</span>
						<input type="text" class="count span6 auto" id="lainnya" name="lainnya" placeholder="" data-a-sep="." data-a-dec=",">
						
						</div>
					  </div>
				  </div>

				  <div class="row-fluid">
					<div class="span3"><h4>Terbilang</h4></div>
					<div class="span9 input-with-icon right">
						<i class=""></i>
						<input type="hidden" value="" id="jumlah-helper"/>
						<div style="text-weight : bold; color : #000; font-size : 20px" id="terbilang"></div>
					</span>
					</div>
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Penerima</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="transaction_by" id="transaction_by" class="span10-b" placeholder="Nama Penerima"></span></div>
				  </div>				  

				<div class="form-actions">
					<div class="pull-right">
					  <input type="hidden" value="in" name="type"/>
					  <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Simpan</button>
					  <button class="btn btn-white btn-cons" type="button" id="clear">Batal</button>
					</div>
				  </div>				  
				
                </div>
              </div>
 
            </div>
          </div>
          <input type="hidden" name="transaction_type" value="out"/>
		</form>  
	<!-- END BASIC FORM ELEMENTS-->	
	
		</div>
		</div>
	</div> 

<!--
<div class="content">  
      <div class="page-title"> <i class="icon-custom-left"></i>
        <div class="row-fluid">
			<div class="span6">
				<h3>Bukti - <span class="semi-bold">Kas Keluar</span></h3>
			</div>
			<div style="text-align: right;">
				<a href="catatan-uang-keluar.html"><button class="btn btn-warning btn-cons" type="button"><i class="icon-th-list white-small"></i>Lihat Catatan Uang Keluar</button></a>
				
			</div>			
		</div>
      </div>

	  <form action="<?php echo base_url(); ?>content/controller/bukti.php?halaman=save_kas" method="post">
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
					  <select name="id_ksm" style="width:100%">
					  
						<option value="">-- pilih salah satu --</option>
						<optgroup label="KSM">
							<?php while($data = mysql_fetch_array($ksm)){ ?>
							<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
							<?php } ?>
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
					 <select name="id_register" id="type" style="width:100%">
					 	<option value="">-- pilih salah satu --</option>
						<?php while($data = mysql_fetch_array($reg)){ ?>
						<option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
						<?php } ?>
					  </select>
                    </div>
					<input id="no_reg" name="no_reg" style="margin-left:5px;" type="text" class="span5" placeholder="(otomatis)" disabled="disabled">
				  </div>	

				  
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Untuk realisasi pembayaran</h4></div>
                    <div class="span4">
					  <select name="id_coa" id="frm_akun" style="width:100%">
					  	<option value="">-- pilih salah satu --</option>
						<?php while($data = mysql_fetch_array($coa)){ ?>
						<option value="<?php echo $data['id']; ?>"><?php echo $data['code']." - ".$data['name']; ?></option>
						<?php } ?>
					  </select>
                    </div>
					
					<div class="span5 input-with-icon right"><i class=""></i><input style="margin-left:-20px;" type="text" name="remark" id="frm_realisasi" class="span12" placeholder="Uraikan"></span></div>					
				  </div>

				  <div class="row-fluid">
					<div class="span3"><h4>Jumlah</h4></div>
					<div class="input-prepend span6 primary input-with-icon right2">
						<span class="add-on">
							<div>Rp</div>
							<span class="arrow"></span>
						</span>
					<input id="frm_kas_keluar_jumlah" name="base" placeholder="" type="text" class="span7 auto" data-a-sep="." data-a-dec=",">
					</div>
				  </div>
 

				  <div class="row-fluid">
					<div class="span3"><h4>Terbilang</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="frm_terbilang" id="frm_terbilang" class="span10-b" placeholder="Uraikan sesuai nominal"></span></div>
				  </div>
				  
				  <div class="row-fluid">
					<div class="span3"><h4>Penerima</h4></div>
					<div class="span9 input-with-icon right"><i class=""></i><input type="text" name="transaction_by" id="frm_penerima" class="span10-b" placeholder="Penerima kas"></span></div>
				  </div>				  

				<div class="form-actions">
					<div class="pull-right">
					  <input type="hidden" value="out" name="type"/>
					  <button class="btn btn-danger btn-cons" type="submit"><i class="icon-ok"></i> Simpan</button>
					  <button class="btn btn-white btn-cons" type="button" id="clear">Batal</button>
					</div>
				  </div>				  
				
                </div>
              </div>
 
            </div>
          </div>			
		</div>
		</div>
	</div>
-->

