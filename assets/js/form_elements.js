//Cool ios7 switch - Beta version
//Done using pure Javascript

		
  
$(document).ready(function(){


		//Clear form
		$("#clear, #clear2, #clear3").click(function() {
			$(this).closest('form').find("input[type=text], textarea").val("");
		});
		

		
		
	  //Date Pickers
	  $('.input-append.date').datepicker({
				autoclose: true,
				todayHighlight: true
	   });


	   
	 $('#dp5').datepicker();
	 $('#dp_buku_kas').datepicker({
			format: "MM-yyyy",
			autoclose: true,
			todayHighlight: true,
			minViewMode: "months",
			viewMode: "months"	
	 });
	 $('#dp_buku_bank_container').datepicker({
			format: "MM-yyyy",
			autoclose: true,
			todayHighlight: true,
			minViewMode: "months"	
	 });
	 $('#dp_buku_bank').datepicker({
			format: "MM-yyyy",
			autoclose: true,
			todayHighlight: true,
			minViewMode: "months"	
	 });	
	 $('#dp_neraca').datepicker({
			autoclose: true,
			todayHighlight: true
	 });	 
	 
	 $('#sandbox-advance').datepicker({
			format: "dd-mm-yyyy",
			startView: 1,
			daysOfWeekDisabled: "3,4",
			autoclose: true,
			todayHighlight: true,
			minViewMode: "months"
    });
	 $('#sandbox-advance2').datepicker({
			format: "dd-mm-yyyy",
			startView: 1,
			daysOfWeekDisabled: "3,4",
			autoclose: true,
			todayHighlight: true,
			minViewMode: "years"
    });

	
	//Disabling dates in the past and dependent disabling.
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var day = $.datepicker.formatDate('yy,mm,dd', new Date());

    var checkin = $('#frm_tanggalxx').datepicker({
		onRender: function(date) {
					return date.valueOf() < now.valueOf() ? 'disabled' : '';
					}
    }).on('changeDate', function(ev) {
		if (ev.date.valueOf() > checkout.date.valueOf()) {
		var newDate = new Date(ev.date)
		newDate.setDate(newDate.getDate() + 1);
		checkout.setValue(newDate);
    }
    checkin.hide();
    $('#frm_tanggal2xx')[0].focus();
    }).data('datepicker');
    var checkout = $('#frm_tanggal2xx').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout.hide();
    }).data('datepicker');


	

	  //Dropdown menu - select2 plug-in
		
		
		//validasi Form Kas Masuk dan Kas Keluar
		$("#frm_nomor_reg").select2();
		$("#frm_akun").select2();
		$("#frm_akun2").select2();
		$("#frm_akun3").select2();
		$("#frm_ksm").select2();
		$("#frm_jabatan").select2();
		$("#frm_propinsi").select2();
		$("#frm_no_pinjaman").select2();
	
		
		

		
		//Form Kas Masuk 
		$('#frm_terima_dari').hide();
		$('#frm_ksm').change(function(){
			if($('#frm_ksm').val() == 'lainnya'){
				//insert text field bila milih "Lainnya"
				//$( "<input id=\"frm_terima_dari\" style=\"margin-left:5px;\" type=\"text\" class=\"span5\">" ).insertAfter( "#frm_kas_masuk_pilih_ksm" );
			    $('#frm_terima_dari').show();
				$('#icon_frm_terima_dari').show();
			} else {
				//$('#frm_terima_dari').remove();
				$('#frm_terima_dari').hide();
				$('#icon_frm_terima_dari').hide();
				$('#frm_terima_dari').val("");
		}
		});	  

		//Form Kas Keluar 
		$('#frm_dibayar_ke').hide();
		$('#frm_ksm2').change(function(){
			if($('#frm_ksm2').val() == 'lainnya'){
				//insert text field bila milih "Lainnya"
				//$( "<input id=\"frm_dibayar_ke\" style=\"margin-left:5px;\" type=\"text\" class=\"span5\">" ).insertAfter( "#frm_kas_keluar_pilih_ksm" );
			    $('#frm_dibayar_ke').show();
				$('#icon_frm_dibayar_ke').show();
			} else {
				$('#frm_dibayar_ke').hide();
				$('#icon_frm_dibayar_ke').hide();
				$('#frm_dibayar_ke').val("");

		}
		});	  		
	
		//Form Kas Masuk
		$('#frm_angs_pokok, #frm_bunga_jasa').keyup(function(){
				$('#frm_lainnya').val("");
				//$('#frm_akun3').val([]);
				//$('#frm_akun3').prop('selectedIndex', -1);
				//$('#frm_akun3').val('').trigger('liszt:updated');
				//$('#frm_akun3').find('option:selected').removeAttr('selected');
				$("#frm_akun3").select2("val", "");
		});	
		//Form Kas Masuk
		$('#frm_lainnya, #frm_akun3').keyup(function(){
				$('#frm_angs_pokok, #frm_bunga_jasa').val("");
		});	

		//Penjumlahan di Form Kas Masuk
		var $form = $('#frm_validation'),
			//$summands = $form.find('.count'),
			$summands = $form.find('.count'),
			$sumDisplay = $('#frm_jumlah');

		$form.delegate('.count', 'keyup', function ()
		{
			var sum = 0;
			$summands.each(function ()
			{
				
				//var value = parseInt($(this).val().replace(/[^\d]/g, ""));	
				//var value = Number($(this).val());
				var value = Number($(this).autoNumeric('get'));
				if (!isNaN(value)) sum += value;
			});

			//$sumDisplay.val(sum);
			//$sumDisplay.val(sum);
			$sumDisplay.autoNumeric('set', sum);
		});
		
		
		//Penjumlahan Master GL
		var $form = $('#frm_validation5'),
			$summands_gl_debet = $form.find('.debet'),
			$sumDisplay_gl_debet = $('#frm_gl_debet_total');

		$form.delegate('.debet', 'keyup', function ()
		{
			var sum = 0;
			$summands_gl_debet.each(function ()
			{
				//var value = parseInt($(this).val().replace(/[^\d]/g, ""));	
				//var value = Number($(this).val());
				var value = Number($(this).autoNumeric('get'));
				if (!isNaN(value)) sum += value;
			});

			//$sumDisplay_gl_debet.val(sum);
			$sumDisplay_gl_debet.autoNumeric('set', sum);
		});		

			$summands_gl_kredit = $form.find('.kredit'),
			$sumDisplay_gl_kredit = $('#frm_gl_kredit_total');

		$form.delegate('.kredit', 'keyup', function ()
		{
			var sum = 0;
			$summands_gl_kredit.each(function ()
			{
				//var value = parseInt($(this).val().replace(/[^\d]/g, ""));	
				//var value = Number($(this).val());
				var value = Number($(this).autoNumeric('get'));
				if (!isNaN(value)) sum += value;
			});

			//$sumDisplay_gl_kredit.val(sum);
			$sumDisplay_gl_kredit.autoNumeric('set', sum);
		});			


		////////////////////Database KSM////////////////////////
		var $form = $('#frm_validation3');
		
		//Setting otomatis Tanggal Awal Pinjaman dan Jatuh Tempo	
		
			//set 'Tanggal Awal Pinjaman'
			//var awalpinjaman = $.datepicker.formatDate('dd/mm/yy', new Date());
			//$("#frm_tanggal").val(awalpinjaman);		

		//Penjumlahan di Database KSM
		$form.delegate('.total_pinjaman, .wkt_pinjaman, .bunga_pinjaman', 'change', function ()
		{
			
			//$("#frm_waktu_pinjaman").keyup(function() {
				var angs = $('#frm_total_pinjaman').val() / $('#frm_waktu_pinjaman').val();
				$('#frm_angs_pokok').val (angs);
				//var angs = $('#frm_total_pinjaman').autoNumeric('get') / $('#frm_waktu_pinjaman').val();
				//alert (angs);
				//$('#frm_angs_pokok').autoNumeric('set', angs);
			//});	

				var angs_bunga = $('#frm_angs_pokok').val() * $('#frm_bunga_pinjaman').val() / 100;
				$('#frm_angs_bunga').val (angs_bunga);			
			
		});
		
			
			//set 'Tanggal Jatuh Tempo" sesuai waktu pinjaman
					
					//$('#frm_waktu_pinjaman').change(function() {   //auto-update di Tanggal Jatuh Tempo 
					//  var date2 = $('#frm_tanggal').datepicker('getDate'); 
					  //var wkt = $('#frm_waktu_pinjaman').val();
					  //date2.setMonth(date2.getMonth()+ wkt); 
					//  $('#frm_tanggal2').val(date2);
					//});
			
			

			
			//get current date
			var startDate = $.datepicker.formatDate('dd,mm,yy', new Date());
			var endDate = $.datepicker.formatDate('dd,mm,yy', new Date());
			//var endDate = new Date(2012,1,25);
			//hide alert placeholder
			$('#alert').hide();
			
			$('#frm_tanggal').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() > endDate.valueOf()){
						$('#alert').show().find('strong').text('Tanggal akad pinjaman tidak dapat melampaui tanggal jatuh tempo');
					} else {
						$('#alert').hide();
						startDate = new Date(ev.date);
						$('#startDate').text($('#frm_tanggal').data('date'));
					}
					$('#frm_tanggal').datepicker('hide');
				});
			$('#frm_tanggal2').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() < startDate.valueOf()){
						$('#alert').show().find('strong').text('Tanggal jatuh tempo tidak dapat sebelum tanggal akad pinjaman');
					} else {
						$('#alert').hide();
						endDate = new Date(ev.date);
						$('#endDate').text($('#frm_tanggal2').data('date'));
					}
					$('#frm_tanggal2').datepicker('hide');
				});			
		
		
		
		
		

	//Database KSM - Tambah Anggota

	var template = jQuery.validator.format($.trim($("#template_anggota").val()));
	function addRow() {
		$(template(i++)).appendTo("#tambah_anggota_placeholder");
	}

	var i = 3;
	// start with one row
	addRow();
	// add more rows on click
	$("#tambah").click(addRow);	


	
	  
	  
	  //Multiselect - Select2 plug-in
	  $("#multi").val(["Jim","Lucy"]).select2();
	  
	  //Date Pickers
	  $('.input-append.date').datepicker({
				autoclose: true,
				todayHighlight: true
	   });
	 
	 $('#dp5').datepicker();
	 
	 $('#sandbox-advance').datepicker({
			format: "dd/mm/yyyy",
			startView: 1,
			daysOfWeekDisabled: "3,4",
			autoclose: true,
			todayHighlight: true
    });
	
	//Time pickers
	$('.timepicker-default').timepicker();
    $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
     });
	//Color pickers
	$('.my-colorpicker-control').colorpicker()
	
	//Input mask - Input helper
	$(function($){
	   $("#date").mask("99/99/9999");
	   $("#phone").mask("(999) 999-9999");
	   $("#tin").mask("99-9999999");
	   $("#ssn").mask("999-99-9999");
	});
	
	//Autonumeric plug-in - automatic addition of dollar signs,etc controlled by tag attributes
	$('.auto').attr({ 
		'data-a-dec' : ',',
		'data-a-sep' : '.',
		'data-v-max' : '99999999999',
		'data-v-min' : '-99999999999'
	});
	$('.auto').autoNumeric('init', { dGroup : 0 });
	
	$('#loan_interest').attr({ 
		'data-a-dec' : ',',
		'data-a-sep' : '.',
		'data-v-max' : '99.99',
		'data-v-min' : '0.00'
	});
	$('#loan_interest').autoNumeric('init', { dGroup : 3 });

	$('select').css({ 
		'padding-right' : '15px',
		'margin-right' : '-15px'
	});

	//HTML5 editor
	$('#text-editor').wysihtml5();
	
	//Drag n Drop up-loader
	$("div#myId").dropzone({ url: "/file/post" });
	
	//Single instance of tag inputs  -  can be initiated with simply using data-role="tagsinput" attribute in any input field
	$('#source-tags').tagsinput({
		typeahead: {
			source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
		}	
	});
});