<script type="text/javascript">
	$(function(){
		<?php if($is_used){ ?>	
		$('#frm_validation5 input').attr('disabled', 'disabled');
		$("#trfoot-buku-besar").hide();
		<?php } ?>
		
		var sum = 0;
		 $('.debet').each(function() {
	        sum += parseInt($(this).val());
	    });
		$("#frm_gl_debet_total").val(sum);

		var sum = 0;
		$('.kredit').each(function() {
	        sum += parseInt($(this).val());
	    });
		$("#frm_gl_kredit_total").val(sum);

		$("#frm_validation5").submit(function(){
			var is_empty = false;

			$(".input-buku-besar").each(function(){
				if($(this).val() == ""){ 
					alert("Data belum lengkap !, silahkan isi data yang masih kosong atau isi dengan angka nol");
					$(this).focus().css({ 'background' : '#edc3d1' });
					
					is_empty = true;
					return false;
				}
			});

			if(is_empty) return false;

			if($("#frm_gl_kredit_total").val() != $("#frm_gl_debet_total").val()){
				alert('Perhitungan belum balance !');
				return false;
			}else{
				alert('Perhitungan sudah balance. Data disimpan');
			}
		});
	});	
</script>

<style type="text/css">
	#tab4Pengguna tr:hover td{
		background : #b2cfed; 
	}	
</style>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Pengaturan</div>
<div style="margin-top:20px; margin-left:25px;">
<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center" style="background-color:#d1dade; padding:14px 1px 14px 1px; width:12%; ">
			<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=pengaturan&edit=1">Data LKM</a>
		</td>
		<td align="center" style="background-color:#FFFFFF; padding:14px 1px 14px 1px; width:12%">
			<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=buku_besar">Buku Besar</a>
		</td>
		<td colspan="5" style="background-color:#d1dade; padding-left:20px;">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
	</table>
	
	<?php 
		$num = get_ksm_list();
		$num = mysql_num_rows($num);

		$sav = get_ksm_saving();
		$sav = mysql_num_rows($sav);

		if(!$num and !$sav){
	?>
	<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td align="center">
			<div style="padding : 20px; text-align : center; margin-top : -20px">
				<h4>Silakan isi <span class="semi-bold"> Database KSM</span> terlebih dahulu</h4>
				<div style="display : inline-block">
					Untuk memperoleh saldo awal akun <b>11030 - Pinjaman KSM</b> dan akun <b>21020 - Tabungan KSM</b>
				</div>
			</div>
		</td>
	</tr>
	</table>
	<?php } else { ?>
	<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td>
			<div style="padding : 20px">
				<form id="frm_validation5" action="<?php echo base_url()."content/controller/dashboard.php?halaman=save_buku_besar" ;?>" method='post'>
					<h3>Buku <span class="semi-bold"> Besar</span></h3>
					<hr noshade>


					<div class="tab-pane" id="tab4Pengguna" style="background-color : #fff">
				
						  <div class="row-fluid">
							<div class="span12">
							  <div class="grid simple ">
								<div class="grid-body no-border no-padding ">
								  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example4" width="100%" >
									<thead>
									  <tr>
										<th>Akun ID</th>
										<th>Nama Akun</th>
										<th>Tipe AKun</th>
										<th><div align="center">Debet</div></th>
										<th><div align="center">Kredit</div></th>
									  </tr>
									</thead>
									<tbody>
									  
									  <?php while($data = mysql_fetch_array($a)){ ?>
									  <tr class="odd gradeX">
										<td><?php echo $data['code']; ?></td>
										<td><?php echo $data['name']; ?></td>
										<td class="center">
											<?php 
												if($data['type'] == "harta") $class = "label-success";
												if($data['type'] == "hutang") $class = "label-danger";
												if($data['type'] == "modal") $class = "label-calm";
												if($data['type'] == "pendapatan") $class = "label-success";												
												if($data['type'] == "beban") $class = "label-danger";	
												if($data['klasifikasi'] == "debit") $inout = "in";
												if($data['klasifikasi'] == "credit") $inout = "out"; 											
											?>
											<span class="label <?php echo $class; ?> tip" data-placement="left" title="" type="button"><?php echo strtoupper($data['type']); ?></span>
											<input type="hidden" name="type[<?php echo $data['id']; ?>]" value="<?php echo $inout; ?>"/>
											<input type="hidden" name="jenis[<?php echo $data['id']; ?>]" value="<?php echo $data['type']; ?>"/>
										</td>
										<td>
											<?php if($data['klasifikasi'] == "debit"){ ?>
											<div class="input-prepend span9 primary input-with-icon right2" >
												<span class="add-on">
													<div>Rp</div>
													<span class="arrow"></span>
												</span>
												<input type="text" class="input-buku-besar debet span12 auto <?php echo $data['type']; ?>" id="frm_<?php echo $data['id']; ?>" value="<?php if($fill[$data['id']]) echo $fill[$data['id']]; else{ if($data['id'] == 3){ echo get_total_existing(); } else if($data['id'] == 10){ echo get_existing_saving(); } else echo $fill[$data['id']]; } ?>" name="id_coa[<?php echo $data['id']; ?>]" placeholder="">
											</div>	
											<?php } ?>											
										</td>
										<td>
											<?php if($data['klasifikasi'] == "credit"){ ?>
											<div class="input-prepend span9 primary input-with-icon right2" >
												<span class="add-on">
													<div>Rp</div>
													<span class="arrow"></span>
												</span>
												<input type="text" class="input-buku-besar kredit span12 auto" id="frm_<?php echo $data['id']; ?>" value="<?php if($fill[$data['id']]) echo $fill[$data['id']]; else{ if($data['id'] == 3){ echo get_total_existing(); } else if($data['id'] == 10){ echo get_existing_saving(); } else echo $fill[$data['id']]; } ?>" name="id_coa[<?php echo $data['id']; ?>]" placeholder="" data-a-sep="." data-a-dec=",">
											</div>	
											<?php } ?>
										</td>
									  </tr>
									  <?php } ?>
										
									  <tr>
									  	<td colspan="5" height="75"></td>
									  </tr>

									  <tfoot id="trfoot-buku-besar" style="position:fixed; z-index:100; bottom:0px; background-color:#fff; right:4%; border: 1px solid #0AA699;">  
									  <tr class="odd gradeX">
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="center"><h4 style="padding-right: 40px;">TOTAL</h4></td>
										<td>
											<div class="input-prepend span9 primary input-with-icon right2" >
												
												<span class="add-on">
													<div>Rp</div>
													<span class="arrow"></span>
												</span>
												
												<input type="text" class="span12 auto" id="frm_gl_debet_total" name="frm_gl_debet_total" placeholder="" data-a-sep="." data-a-dec="," readonly="">
											</div>												
										</td>
										<td>
											<div class="input-prepend span9 primary input-with-icon right2" >
												<i class="" style="margin-right:10px;"></i>
												<span class="add-on">
													<div>Rp</div>
													<span class="arrow"></span>
												</span>
												
												<input type="text" class="span12 auto" id="frm_gl_kredit_total" equalTo="frm_gl_debet_total" name="frm_gl_kredit_total" placeholder="" data-a-sep="." data-a-dec="," readonly="">
											</div>	
										</td>
									  </tr>
									  <tr>
									  	<td colspan="5" align="center">
									  		<div style="text-align : right">
										  		<button class="btn btn-danger btn-cons" id="button-submit" type="submit" style="display : inline-block"><i class="icon-ok"></i> Simpan</button>
							  					<button class="btn btn-white btn-cons" type="button" style="display : inline-block" id="clear2">Batal</button>
									  		</div>
									  	</td>
									  </tr>
									  </tfoot>
									  </tbody>
								  </table>
								</div>
							  </div>
							</div>
						  </div>
					
					</div>											
						
					</form>
				</div>
			</td>
		</tr>
	</table>

	<?php } ?>
</div>