<?php if (!$_SESSION['login_lkm'])
  die ('<script type="text/javascript">location.replace("'.base_url().'content/controller/login.php");</script>');
  ?>
<!DOCTYPE html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8" />
<title>Dana Bergulir</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />

<script src="<?php echo base_url(); ?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>

<!-- BEGIN PLUGIN CSS -->
<link href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/dropzone/css/dropzone.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/ios-switch/ios7-switch.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8">
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo base_url(); ?>assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>
<!-- END PLUGIN CSS -->

<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
<!-- END CORE CSS FRAMEWORK -->

<!-- BEGIN CSS TEMPLATE -->
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<!-- END CSS TEMPLATE -->

<link href="<?php echo base_url(); ?>assets/plugins/boostrap-slider/css/slider.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jterbilang.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-number/jquery.number.js"></script>
<script type="text/javascript">
  /*
  window.onbeforeunload = function (e) {
  var message = "Apakah anda yakin meninggalkan halaman ?",
  e = e || window.event;
  // For IE and Firefox
  if (e)
    e.returnValue = message;

  // For Safari
  return message;
  };
  */
</script>

<!-- Test Datatable -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/datatables.min.js"></script>


<!-- end datatable -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
          <div class="iconset top-menu-toggle-white"></div>
          </a> </li>
      </ul>
      <!-- BEGIN LOGO -->
      <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" class="logo" width="106" height="92"/></a>
      <!-- END LOGO -->
      <!-- 
      <ul class="nav pull-right notifcation-center">
        <li class="dropdown" id="header_task_bar"> <a href="dashboard.html" class="dropdown-toggle active" data-toggle="">
          <div class="iconset top-home"></div> 
          </a> </li>

      </ul>
      -->
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="header-quick-nav" >
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
            <div class="iconset top-menu-toggle-dark"></div>
            </a>
			</li>		
        </ul>
		
        <ul class="nav quick-section">
          <li class="quicklinks"> 
            <!-- <div class="iconset-pu-pnpm"></div> -->
            <img src="<?php echo base_url(); ?>assets/img/logo-new.png" style="height : 40px; margin-top : -7px"/>
			</li>			
        </ul>		

      </div>
      <!-- END TOP NAVIGATION MENU -->
      	 <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right"> 
		<div class="chat-toggler">	
				<a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom">
					<div class="user-details"> 
						<div style="position : relative; right : 0px; padding : 0px">
							<b><?php echo get_userdata('lkm_name'); ?></b>							
						</div>						
					</div> 
				</a>						
			</div>
		 <ul class="nav quick-section ">
			<li class="quicklinks"> <span class="h-seperate"></span></li> 		 
			<li class="quicklinks"> 
				<a data-toggle="dropdown" class="dropdown-toggle  pull-right" href="#">						
					<div class="iconset top-settings-dark "></div> 	
				</a>
				<ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="dropdownMenu">
              <?php if(get_userdata('id_role') == 1 or get_userdata('id_role') == 2){ ?>
              <li><a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=pengaturan"> Pengaturan</a></li>
              <?php } ?>

              <?php if(get_userdata('id_role') == 1){ ?>
              <li><a href="<?php echo base_url(); ?>content/controller/setting.php?halaman=user"> Manajemen Pengguna</a></li>
              <?php } ?>

              <li><a href="<?php echo base_url(); ?>content/controller/setting.php?halaman=log"> Catatan Aktivitas</a></li>
              <li><a href="<?php echo base_url(); ?>content/controller/login.php?halaman=logout"><i class="icon-off"></i>&nbsp;&nbsp;Log Out</a></li>
           </ul>
			</li> 


		</ul>
      </div>
	   <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <!--
    <div class="user-info-wrapper">
      <div class="user-info">
        <div class="username"><?php echo get_userdata('lkm_name'); ?><br/> <span class="semi-bold">Sidoarjo</span></div>
        <div class="status">Status<a href="#">
          <div class="status-icon green"></div>
          Online</a></div>
      </div>
     </div>
    -->

    <!-- END MINI-PROFILE -->
    <!-- BEGIN MINI-WIGETS -->
    <!-- END MINI-WIGETS -->
    <!-- BEGIN SIDEBAR MENU -->
    <p class="menu-title">BROWSE <span class="pull-right"><i class="icon-refresh"></i></span></p>
    <ul>
      <li class="start active "> <a href="<?php echo base_url(); ?>content/controller/dashboard.php"> <i class="icon-custom-home"></i> <span class="title">Dashboard</span> <span class="selected"></span></a> </li>
      
      <?php if(get_userdata('id_role') == 1 or get_userdata('id_role') == 2){ ?>
      <li class=""> <a href="javascript:;"> <i class="icon-custom-form"></i> <span class="title">Bukti</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="<?php echo base_url(); ?>content/controller/bukti.php?halaman=kas_masuk">Bukti Kas Masuk </a> </li>
          <li > <a href="<?php echo base_url(); ?>content/controller/bukti.php?halaman=kas_keluar">Bukti Kas Keluar</a> </li>
          <li > <a href="<?php echo base_url(); ?>content/controller/bukti.php?halaman=pindah_buku">Bukti Pemindah Bukuan</a> </li>		  
        </ul>
      </li>
      <?php } ?>

      <li class=""> <a href="javascript:;"> <i class="icon-custom-portlets"></i> <span class="title">Buku</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=catatan_uang_masuk"> Catatan Uang Masuk </a> </li>
          <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=catatan_uang_keluar"> Catatan Uang Keluar </a> </li>
          <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=catatan_pindah_buku"> Catatan Pemindah Bukuan </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=buku_kas"> Buku Kas </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=buku_bank"> Buku Bank </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=buku_inventaris"> Buku Inventaris </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=buku_neraca_saldo"> Buku Besar & Neraca Saldo </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=buku_pendapatan_biaya"> Buku Pendapatan & Biaya </a> </li>
        </ul>
      </li>
		<li class=""> <a href="javascript:;"> <i class="icon-custom-chart"></i> <span class="title">Laporan</span> <span class="arrow "></span> </a> 
        <ul class="sub-menu">
          <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=laba_rugi"> Laporan Laba Rugi </a> </li>
          <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=neraca"> Laporan Neraca </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/report.php?halaman=kolektabilitas"> Laporan Kolektabilitas </a> </li>
        </ul>	  
	  </li>
      <li class=""> <a href="javascript:;"> <i class="icon-custom-thumb"></i> <span class="title">KSM</span> <span class="arrow "></span> </a>
        <ul class="sub-menu">
          <li > <a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=ksm">Database KSM</a> </li>
          <li > <a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=register_pinjaman">Register Pinjaman </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=register_tabungan">Register Tabungan </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=kartu_pinjaman">Kartu Pinjaman </a> </li>
		  <li > <a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=kartu_tabungan">Kartu Tabungan </a> </li>
        </ul>
      </li>

    </ul>

    <a href="#" class="scrollup">Scroll</a>
    <div class="clearfix"></div>
    <!-- END SIDEBAR MENU -->
  </div>

  <!-- END SIDEBAR -->
  <!-- BEGIN PAGE CONTAINER-->
  <div class="page-content"> 
<?php if($konten) require_once($konten); ?>
  </div>
  </div>
 </div>
<!-- END CONTAINER --> 

<!-- END CONTAINER -->

<!-- BEGIN CORE JS FRAMEWORK-->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>

<!-- END CORE JS FRAMEWORK -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-inputmask/jquery.inputmask.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-autonumeric/autoNumeric.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url(); ?>assets/js/form_elements.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/form_validations.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/core.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/demo.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->

<script type="text/javascript">
  var _globalFormMark = false;

  $('#tabelreport').DataTable({
      "scrollX": true,
      "footerCallback": function ( row, data, start, end, display ) {
        
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[^0-9]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            
            // Total over all pages
            total = api
                .column( 5, { search: 'applied'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 )
                .toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            
            // Update footer
            $( api.column( 5 ).footer() ).html(
              '<h5 style="font-weight: bold">'+total+'</h5>'
            );
            $( api.column( 4 ).footer() ).html(
              '<h5 style="font-weight: bold; text-align: right;">Total : </h5>'
            );
        },

        dom: 'Bfrtip',
        buttons: [
          'pageLength',
          {
              extend: 'excel',
              exportOptions: {
                  columns: ':visible'
              }
          },
          {
              extend: 'pdf',
              orientation: 'landscape',             
              exportOptions: {
                  columns: ':visible'           
              },
              
          },
          {
              extend: 'print',
              autoPrint: true,
              exportOptions: {
                  columns: ':visible'
              },
              customize: function(win) {               
                var body = $(win.document.body).find( 'table tbody' );
                $(body).append($(body).find('tr:eq(0)').clone());
                var row = $(body).find('tr').last();
                $(row).find('td').text('');    
                $(row).find('td:eq(4)').html('<h5 style="font-weight: bold; text-align: right;">Total    : </h5>');
                $(row).find('td:eq(5)').html('<h5 style="font-weight: bold">'+total+'</h5>');
              }
          },
            'colvis'                 
        ]      
    }
  );

  $('#table-kas').DataTable({
    
    "footerCallback": function ( row, data, start, end, display ) {
      var api = this.api(), data;

      // Remove the formatting to get integer data for summation
      intVal = function ( i ) {
          return typeof i === 'string' ?
              i.replace(/[^0-9]/g, '')*1 :
              typeof i === 'number' ?
                  i : 0;
      };
      
      // Total over all pages
      total = function( i ) { 
        return api
          .column( i, { search: 'applied'} ).data()
          .reduce( function (a, b) {
              return intVal(a) + intVal(b);}, 0 )
          .toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      };
      // Total over this page
      pageTotal = function(i){
        return api
          .column( 4, { page: 'current'} ).data()
          .reduce( function (a, b) {
              return intVal(a) + intVal(b);}, 0 )
          .toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      };
      
      totalSaldo = function(){
        var saldo_awal = intVal('<?php echo $saldo_awal?>');
        return  saldo_awal - (intVal(total(4)) - intVal(total(3)));
      }

      saldoHeader = function(){
        var header_debet = intVal(api.column( 3 ).header());
        var header_kredit = intVal(api.column( 4 ).header());
        var saldo_awal = intVal('<?php echo $saldo_awal?>');
        return saldo_awal - (header_debet - header_kredit);
      }

      totalPindahan = function(){
        return totalSaldo();
      }
      // Update footer
      $( api.column( 1 ).footer() ).html(
        '<h5 style="font-weight: bold">Total</h5>'
      );
      $( api.column( 3 ).footer() ).html(
        '<h5 style="font-weight: bold ; text-align : right">'+total(3)+'</h5>'
      );
      $( api.column( 4 ).footer() ).html(
        '<h5 style="font-weight: bold ; text-align : right">'+total(4)+'</h5>'
      );
      $( api.column( 5 ).footer() ).html(
        '<h5 style="font-weight: bold ; text-align : right">'+totalSaldo()+'</h5>'
      );
      $( api.column( 5 ).header() ).html(
        '<h5 style="font-weight: bold ; text-align : right">'+saldoHeader()+'</h5>'
      );
},
    dom: 'Bfrtip',
        buttons: [
           {
              extend: 'print',
              exportOptions: {
                  columns: ':visible'
              },
              customize: function(win) {     
                var body = $(win.document.body).find( 'table tbody' );
                $(body).append($(body).find('tr:eq(0)').clone());
                var last_row = $(body).find('tr').last();
                var first_row = $(body).find('tr').first();
                $(first_row).find('td').text('');    
                $(first_row).find('td:eq(1)').html('<h5 style="font-weight: bold; text-align: right;">Total    : </h5>');
                $(first_row).find('td:eq(4)').html('<h5 style="font-weight: bold">'+total(4)+'</h5>');
                $(last_row).find('td').text('');    
                $(last_row).find('td:eq(1)').html('<h5 style="font-weight: bold; text-align: right;">Total    : </h5>');
                $(last_row).find('td:eq(4)').html('<h5 style="font-weight: bold">'+total(4)+'</h5>');
              }
           }
        ],
    "ordering": false,
    "paging": false,
  });


  $(function(){
      $('form input, form textarea').keyup(function(){
          _globalFormMark = true;
          console.log(_globalFormMark);
      });

      $('form select').change(function(){
          _globalFormMark = true;
          console.log(_globalFormMark)
      });

      $('a').click(function(){
        if($(this).attr('href') != 'javascript:;' && $(this).attr('href') != '' && $(this).attr('href') != undefined){
          console.log($(this).attr('href'));

          if(_globalFormMark){
            var con = confirm('Yakin ingin meninggalkan halaman sebelum menyimpan ? ');
            if(!con) return false;
          }
        }
      });
  });
</script>

</body>
</html>