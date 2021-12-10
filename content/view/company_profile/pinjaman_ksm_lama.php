<script type="text/javascript">
	function checkDateRange(start, end){
	   // Parse the entries
	   var startDate = Date.parse(start);
	   var endDate = Date.parse(end);
	   // Make sure they are valid
	   
	   // Check the date range, 86400000 is the number of milliseconds in one day
	   var difference = (endDate - startDate) / (86400000 * 7);
	   if (difference < 0) {
	      alert("Tanggal realisasi mendahului tanggal akad pinjaman !");
	       return false;
	   }

	   return true;
	}

	$(function(){
		$("#loan_total").keyup(function(){
			if($("#loan_total").val() && $("#loan_duration").val()){
				$("#angsuran_pokok").val(parseInt($("#loan_total").val() / $("#loan_duration").val()));

				var _total = $("#loan_total").val();
					_total = _total.replace(/\./g, '');
					_total = _total.replace(/\,/g, '.');

				var _duration = $("#loan_duration").val();

				var _month = parseFloat(_total / _duration);

				$('#angsuran_pokok').val(_month).number(true , 0);
			}
		});

		$("#loan_total,#loan_duration").keyup(function(){
			if($("#loan_total").val() && $("#loan_duration").val()){
				$("#angsuran_pokok").val(parseInt($("#loan_total").val() / $("#loan_duration").val()));

				var _total = $("#loan_total").val();
					_total = _total.replace(/\./g, '');
					_total = _total.replace(/\,/g, '.');

				var _duration = $("#loan_duration").val();

				var _month = parseFloat(_total / _duration);
				console.log(_total);

				var _totalDurasi = parseFloat(Math.round(_month*_duration))

				$('#angsuran_pokok').val(_month).number(true , 0);
				$('#angsuran_sesungguhnya').val(_totalDurasi);
			}
		});

		
		$("#loan_total,#loan_interest").keyup(function(){
			var _total = $("#angsuran_pokok").val();
				_total = _total.replace(/\./g, '');
				_total = _total.replace(/\,/g, '.');

			var _int = $("#loan_interest").val();
				_int = _int.replace(/\./g, '');
				_int = _int.replace(/\,/g, '.');

			var _duration = $("#loan_duration").val();
			var _intTot = parseFloat((_total /100) *  _int);
			var _intTotDurasi = parseFloat(Math.round(_intTot) * _duration );

			console.log(_intTot);
			
			$('#angsuran_jasa').val(_intTot).number(true , 0);	
			$('#jasa_sesungguhnya').val(_intTotDurasi);
			
		});

		$("#loan_total,#form-pinjaman").submit(function(){
			if($("#loan_total").val() == ""){
				alert('"Besar Pinjaman" masih kosong !');
				$("#loan_total").focus();
				return false;			
			}

			if($("#loan_duration").val() == ""){
				alert('"Waktu Pinjaman (bulan)" masih kosong !');
				$("#loan_duration").focus();
				return false;			
			}

			if($("#loan_interest").val() == ""){
				alert('"Bunga Pinjaman (% per tahun)" masih kosong !');
				$("#loan_interest").focus();
				return false;			
			}
			
			var _pinjaman = $("#tahun_pinjaman").val() + '-' + $("#bulan_pinjaman").val() + '-' + $("#tanggal_pinjaman").val();
			var _realisasi = $("#tahun_realisasi").val() + '-' + $("#bulan_realisasi").val() + '-' + $("#tanggal_realisasi").val();

			if(!checkDateRange(_pinjaman, _realisasi)){
				return false;
			}			
		});
	});
</script>

<div style="margin-top:25px; margin-top:25px; margin-left:25px; font-size:23px;"><i class="icon-custom-left"></i> Database <b>KSM</b></div>
<div style="margin-top:20px; margin-left:25px;">

<?php if($_GET['error'] == 'active_ksm'){ ?>
<span class="label label-info" style="background : #ec3131; width : 95.5%; padding : 10px; margin-bottom : 10px; text-align : center">
	KSM MASIH MEMILIKI PINJAMAN AKTIF ATAU KSM SUDAH MEMINJAM SEBANYAK 4 KALI ! 
</span>
<?php } ?>

<table width="97.5%" style="background-color:#fff;">
	<?php require_once("../view/company_profile/ksm-header.php"); ?>
	<tr>
		<td colspan="7" style="padding-left:20px;">&nbsp;</td>
	</tr>
</table>


<form id="form-pinjaman" action="<?php echo $action; ?>" method="POST">
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td colspan="7" style="padding-left:20px; font-size:23px;">Pinjaman <b>KSM</b></td>
		</tr>
		<tr>
			<td colspan="8" style="padding-left:20px; padding-right:20px;"><hr></td>
		</tr>
		<!--
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Pinjaman ke</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">&nbsp;</td>
		</tr>
		-->
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Nama KSM</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<select name="id_ksm">
					<?php while($b=mysql_fetch_array($a)){ ?>
						<option value="<?php echo "$b[id]"; ?>"><?php echo "$b[name]"; ?></option>
					<?php } ?>
				</select>
				<input type="hidden" value="1" name="id_lkm">
				<input type="hidden" value="1" name="id_admin">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">No. </td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" value="<?php echo $code; ?>" name="loan_no" readonly="readonly">
			</td>
		</tr>
		<!-- <tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Pinjaman Ke</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<select name="loan_ke">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
			</td>
		</tr> -->
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Besar Pinjaman</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="loan_total" id="loan_total" name="loan_total" placeholder="Rp." data-a-sep="." data-a-dec="," style="width:220px;">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Waktu Pinjaman (bulan)</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="loan_duration" name="loan_duration" placeholder="(bulan)" data-a-sep="." data-a-dec="," style="width:220px; " value="12">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Angsuran Pokok</td>
			<td style="font-size:15px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="angsuran_pokok" name="angsuran_pokok"readonly="readonly" placeholder="Rp." data-a-sep="." data-a-dec="," style="width:220px;" readonly> per bulan.
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Bunga Pinjaman (% per tahun)</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6" id="loan_interest" name="loan_interest" placeholder="%" data-a-sep="." data-a-dec="," style="width:220px;" value="18,00">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Angsuran Jasa/Bunga</td>
			<td style="font-size:15px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="angsuran_jasa" name="angsuran_jasa" readonly="readonly" data-a-sep="." data-a-dec="," style="width:220px;">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Tanggal Akad Pinjaman</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<select name="tanggal_pinjaman" id="tanggal_pinjaman">
					<?php
						for ($tgl =  1; $tgl <= 31; $tgl++){ ?>
						<option value="<?php echo "$tgl"; ?>" <?php if(date("d") == $tgl) echo 'selected="selected"'; ?>><?php echo "$tgl"; ?></option>
					<?php } ?>
				</select>

				<select name="bulan_pinjaman" id="bulan_pinjaman">
					<?php
						for ($bln = 1; $bln <= 12; $bln++){ ?>
						<option value="<?php echo "$bln"; ?>" <?php if(date("m") == $bln) echo 'selected="selected"'; ?>><?php echo "$bln"; ?></option>
					<?php } ?>
				</select>
				
				<select name="tahun_pinjaman" id="tahun_pinjaman">
					<?php
						for ($thn = 2001; $thn <= date('Y'); $thn++){
					?>
						<option value="<?php echo "$thn"; ?>" <?php if(date("Y") == $thn) echo 'selected="selected"'; ?>><?php echo "$thn"; ?></option>
					<?php } ?>
				</select>
			</td>
		</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Tanggal Realisasi Pinjaman</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<select name="tanggal_realisasi" id="tanggal_realisasi">
					<?php
						for ($tgl =  1; $tgl <= 31; $tgl++){ ?>
						<option value="<?php echo "$tgl"; ?>" <?php if(date("d") == $tgl) echo 'selected="selected"'; ?>><?php echo "$tgl"; ?></option>
					<?php } ?>
				</select>

				<select name="bulan_realisasi" id="bulan_realisasi">
					<?php
						for ($bln = 1; $bln <= 12; $bln++){ ?>
						<option value="<?php echo "$bln"; ?>" <?php if(date("m") == $bln) echo 'selected="selected"'; ?>><?php echo "$bln"; ?></option>
					<?php } ?>
				</select>
				
				<select name="tahun_realisasi" id="tahun_realisasi">
					<?php
						for ($thn = 2001; $thn <= date('Y'); $thn++){
					?>
						<option value="<?php echo "$thn"; ?>" <?php if(date("Y") == $thn) echo 'selected="selected"'; ?>><?php echo "$thn"; ?></option>
					<?php } ?>
				</select>
			</td>
		</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Saldo Pinjaman Sesungguhnya</td>
			<td style="font-size:15px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="angsuran_sesungguhnya" name="angsuran_sesungguhnya" placeholder="Rp." data-a-sep="." data-a-dec="," style="width:220px;">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Saldo Jasa Sesungguhnya</td>
			<td style="font-size:15px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="jasa_sesungguhnya" name="jasa_sesungguhnya" placeholder="Rp." data-a-sep="." data-a-dec="," style="width:220px;">
			</td>
		</tr>
	</table>
	<table width="97.5%" style="background-color:#fff;">
		<tr>
			<td style="font-size:13px;" colspan="7" align="right">
				<button type="submit" class="btn btn-danger btn-cons"><i class="icon-ok"></i> Simpan</button> 
				<button type="reset" class="btn btn-white btn-cons" >Batal</button>  
				<span style="margin-left:30px;">&nbsp;</span>
			</td>
		</tr>
	</table>
</form>

</div>