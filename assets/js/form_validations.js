$(document).ready(function() {				
	//$(".select2").select2();
	
	
  var $select = $('select').select2({
    placeholder: 'Pilih',
    allowClear: false
  });
  
  /*
   * When you change the value the select via select2, it triggers
   * a 'change' event, but the jquery validation plugin
   * only re-validates on 'blur'
   */
  //$select.on('change', function() {
  //  $(this).trigger('blur');
  //});  
			 	
		//Kas Masuk, Keluar, Pindah Buku
	   $('#frm_validation').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
				//ignore: "",
                rules: {
                    frm_realisasi: {
                        minlength: 2,
                        required: true
                    },
					frm_terbilang: {
                        minlength: 5,
                        required: true
                    },
					frm_penyetor: {
                        minlength: 2,
                        required: true
                    },
					frm_penerima: {
                        minlength: 2,
                        required: true
                    },
					frm_ket_transaksi: {
                        minlength: 2,
                        required: true
                    },
					frm_dibayar_ke: {
                        minlength: 2,
                        required: true
                    },
					frm_terima_dari: {
                        minlength: 2,
                        required: true
                    },
	
					frm_kas_keluar_jumlah: {
                        minlength: 1,
                        required: true
						
                    },				
					frm_nomor_reg: {
                        required: true
                    },

					frm_pindah_buku_debet: {
						minlength: 1,
                        required: true
						
                    },
					frm_pindah_buku_kredit: {
						minlength: 1,
                        required: true
						
                    },
					frm_checkbox: {
                        required: true
                    },

					frm_ksm: {
                        required: true
                    },
					
                },
				

                invalidHandler: function (event, validator) {
					//display error alert on form submit    

                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('icon-ok').addClass('icon-exclamation');  
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
					var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("icon-exclamation").addClass('icon-ok');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
					//var uang = $('#frm_kas_keluar_jumlah').autoNumeric('get');
					var x = "UPK berhasil mengeluarkan uang sejumah Rp " + $('#frm_kas_keluar_jumlah').val() + "!";
					alert(x); 
					//form.submit();
                }
            });
			
			
			
		//$select.rules('add', 'required');	
			
		//Pengaturan	
	   $('#frm_validation2').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {


					//Pengaturan - Data Pengguna
					frm_username: {
						minlength: 1,
                        required: true
                    },
					frm_nama_pengguna: {
						minlength: 1,
                        required: true
                    },
					//frm_sandi: {
					//	minlength: 1,
                    //    required: true
                    //},
					//frm_sandi2: {
					//	minlength: 1,
                    //    required: true
                    //},
					password: {
						minlength: 6,
						required: true
					},
					password2: {
						minlength: 6,
						equalTo: "#password",
						required: true
					},
				},	
				messages: {
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long"
					},
					password2: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long",
						equalTo: "Please enter the same password as above"
					}
				},

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (label, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('icon-ok').addClass('icon-exclamation');  
                    parent.removeClass('success-control').addClass('error-control');  
					//$('<span class="error"></span>').insertAfter(element).append(label);
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
					var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("icon-exclamation").addClass('icon-ok');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
					alert ("yippe");
                }
            });	

		//Database KSM Validation
	   $('#frm_validation3').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {

					// Database KSM
					frm_nama_ksm: {
						minlength: 1,
                        required: true
                    },
					frm_no_pinjaman_ksm: {
						minlength: 1,
                        required: true
                    },
					frm_no_simpanan_ksm: {
						minlength: 1,
                        required: true
                    },
					frm_nama1: {
						minlength: 1,
                        required: true
                    },
					frm_ktp1: {
						minlength: 1,
						number: true,
                        required: true
                    },	
					frm_nama2: {
						minlength: 1,
                        required: true
                    },
					frm_ktp2: {
						minlength: 1,
						number: true,
                        required: true
                    },	
					frm_nama3: {
						minlength: 1,
                        required: true
                    },
					frm_ktp3: {
						minlength: 1,
						number: true,
                        required: true
                    },					
					frm_total_pinjaman: {
						minlength: 3,
                        required: true
                    },					
					frm_waktu_pinjaman: {
						minlength: 1,
                        required: true
                    },
					frm_bunga_pinjaman: {
						minlength: 1,
                        required: true
                    },
					frm_tanggal: {
						minlength: 1,
                        required: true
                    },
					frm_tanggal2: {
						minlength: 1,
                        required: true
                    },	
					frm_saldo_awal_tabungan: {
						minlength: 1,
                        required: true
                    },					
                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('icon-ok').addClass('icon-exclamation');  
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
					var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("icon-exclamation").addClass('icon-ok');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
                
                }
            });				
			
		// Data LKM
	   $('#frm_validation4').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {

					// Pengaturan
					frm_nama_lkm: {
						minlength: 1,
                        required: true
                    },
					frm_kel_desa: {
						minlength: 1,
                        required: true
                    },
					frm_alamat: {
						minlength: 1,
                        required: true
                    },	
					frm_tanggal: {
						minlength: 1,
                        required: true
                    },


                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('icon-ok').addClass('icon-exclamation');  
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
					var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("icon-exclamation").addClass('icon-ok');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
					alert ("Terkirim");
                }
            });	

			
	   /*
		// Master GL
	   $('#frm_validation5').validate({
                errorElement: 'span', 
                errorClass: 'error', 
                focusInvalid: false, 
                ignore: "",
                rules: {

					// Master GL
					frm_11010: { required: true },
					frm_11021: { required: true },
					frm_11030: { required: true },
					frm_12010: { required: true },
					frm_12020: { required: true },
					frm_12021: { required: true },
					frm_21010: { required: true },
					frm_21020: { required: true },
					frm_21030: { required: true },
					frm_31010: { required: true },
					frm_31020: { required: true },
					frm_31030: { required: true },
					frm_31050: { required: true },
					frm_31060: { required: true },
					frm_31070: { required: true },
					frm_41010: { required: true },
					frm_41020: { required: true },
					frm_42010: { required: true },
					frm_51010: { required: true },
					frm_51030: { required: true },
					frm_51040: { required: true },
					frm_51050: { required: true },
					frm_51080: { required: true },
					frm_51090: { required: true },
					frm_52010: { required: true },
					
					frm_gl_debet_total: {
						
						required: true
					},
					frm_gl_kredit_total: {
						
						equalTo: "#frm_gl_debet_total",
						required: true
					},

                },

                invalidHandler: function (event, validator) {
					//display error alert on form submit    
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-with-icon').children('i');
                    var parent = $(element).parent('.input-with-icon');
                    icon.removeClass('icon-ok').addClass('icon-exclamation');  
                    parent.removeClass('success-control').addClass('error-control');  
                },

                highlight: function (element) { // hightlight error inputs
					
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-with-icon').children('i');
					var parent = $(element).parent('.input-with-icon');
                    icon.removeClass("icon-exclamation").addClass('icon-ok');
					parent.removeClass('error-control').addClass('success-control'); 
                },

                submitHandler: function (form) {
					alert ("Berhasil, sudah balanced !");
                }
            });	
            */
});	
	 