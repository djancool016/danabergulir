<script type="text/javascript">
	function checkDateRange(start, end) {
	   // Parse the entries
	   var startDate = Date.parse(start);
	   var endDate = Date.parse(end);
	   // Make sure they are valid
	    if (isNaN(startDate)) {
	      alert("The start date provided is not valid, please enter a valid date.");
	      return false;
	   }
	   if (isNaN(endDate)) {
	       alert("The end date provided is not valid, please enter a valid date.");
	       return false;
	   }
	   // Check the date range, 86400000 is the number of milliseconds in one day
	   var difference = (endDate - startDate) / (86400000 * 7);
	   if (difference < 0) {
	       alert("The start date must come before the end date.");
	       return false;
	   }
	   if (difference <= 1) {
	       alert("The range must be at least seven days apart.");
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

		$("#loan_duration").keyup(function(){
			if($("#loan_total").val() && $("#loan_duration").val()){
				$("#angsuran_pokok").val(parseInt($("#loan_total").val() / $("#loan_duration").val()));

				var _total = $("#loan_total").val();
					_total = _total.replace(/\./g, '');
					_total = _total.replace(/\,/g, '.');

				var _duration = $("#loan_duration").val();

				var _month = parseFloat(_total / _duration);
				console.log(_total);

				$('#angsuran_pokok').val(_month).number(true , 0);
			}
		});

		
		$("#loan_interest").keyup(function(){
			var _total = $("#angsuran_pokok").val();
				_total = _total.replace(/\./g, '');
				_total = _total.replace(/\,/g, '.');

			var _int = $("#loan_interest").val();
				_int = _int.replace(/\./g, '');
				_int = _int.replace(/\,/g, '.');

			var _intTot = parseFloat((_total /100) *  _int);
			
			$('#angsuran_jasa').val(_intTot).number(true , 0);	
		});

		$("#form-pinjaman").submit(function(){

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
				alert('"Bunga Pinjaman (% per bulan)" masih kosong !');
				$("#loan_interest").focus();
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
	
<?php if(!$is_used){ ?>
<table width="97.5%" style="background-color:#fff;">
	<tr>
		<td>
			<div style="padding : 20px; text-align : center">
				<h4>Silakan mengisi <span class="semi-bold"> Buku Besar</span> sebelum mengisi pinjaman KSM Baru</h4>
			</div>
		</td>
	</tr>
	</table>
<?php } else { ?>
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
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Besar Pinjaman</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="loan_total" id="loan_total" name="loan_total" placeholder="Rp." data-a-sep="." data-a-dec="," style="width:220px;">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Waktu Pinjaman (bulan)</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="loan_duration" name="loan_duration" placeholder="(bulan)" data-a-sep="." data-a-dec="," style="width:220px;">
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Angsuran Pokok</td>
			<td style="font-size:15px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6 auto" id="angsuran_pokok" name="angsuran_pokok"readonly="readonly" placeholder="Rp." data-a-sep="." data-a-dec="," style="width:220px;" readonly> per bulan.
			</td>
		</tr>
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Bunga Pinjaman (% per bulan)</td>
			<td style="font-size:13px; padding:0 26px 10px 42px; width:67.5%;" colspan="6">
				<input type="text" class="count span6" id="loan_interest" name="loan_interest" placeholder="%" data-a-sep="." data-a-dec="," style="width:220px;">
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
				<select name="tanggal_pinjaman">
					<?php
						for ($tgl =  1; $tgl <= 31; $tgl++){ ?>
						<option value="<?php echo "$tgl"; ?>" <?php if(date("d") == $tgl) echo 'selected="selecter"'; ?>><?php echo "$tgl"; ?></option>
					<?php } ?>
				</select>

				<select name="bulan_pinjaman">
					<?php
						for ($bln = 1; $bln <= 12; $bln++){ ?>
						<option value="<?php echo "$bln"; ?>" <?php if(date("m") == $bln) echo 'selected="selecter"'; ?>><?php echo "$bln"; ?></option>
					<?php } ?>
				</select>
				
				<select name="tahun_pinjaman">
					<?php
						for ($thn = 2001; $thn <= CURRENT_YEAR; $thn++){
					?>
						<option value="<?php echo "$thn"; ?>" <?php if(date("Y") == $thn) echo 'selected="selecter"'; ?>><?php echo "$thn"; ?></option>
					<?php } ?>
				</select>
			</td>
		</td>
		</tr>
		
		<!--
		<tr>
			<td style="padding:0 25px 10px 25px; width:15%; font-size:18px;" colspan="2">Tanggal Jatuh Tempo</td>
			<td style="font-size:13px; padding:0 26px 10px 35px; width:67.5%;" colspan="6">
				<select name="tanggal_tempo">
					<?php
						for ($tgl =  1; $tgl <= 31; $tgl++){ ?>
						<option value="<?php echo "$tgl"; ?>"><?php echo "$tgl"; ?></option>
					<?php } ?>
				</select>

				<select name="bulan_tempo">
					<?php
						for ($bln = 1; $bln <= 12; $bln++){ ?>
						<option value="<?php echo "$bln"; ?>";><?php echo "$bln"; ?></option>
					<?php } ?>
				</select>
				
				<select name="tahun_tempo">
					<?php
						for ($thn = 2001; $thn <= 2025; $thn++){
					?>
						<option value="<?php echo "$thn"; ?>"><?php echo "$thn"; ?></option>
					<?php } ?>
				</select>
			</td>
		</td>
		</tr>
		-->
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
<?php } ?>

</div>