<?php

	$bulan = array('Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	$active = $_GET['report_filter_period'];
?>

<script type="text/javascript">
	var _halaman = "<?php echo $_GET['halaman']; ?>";

	$(function(){
		$('#report-filter-date').change(function(){ 
			location.replace('?halaman=' + _halaman + '&report_filter_period=' + $(this).val());
		});

		$(".report-filter").change(function(){
			var _date = $("#report-date-filter").val();
			var _month = $("#report-month-filter").val();
			var _year  = $("#report-year-filter").val();

			location.replace('?halaman=' + _halaman + '&report_filter_period=' + _year + '-' + _month + '-' + _date);
		});
	});
</script>

<?php if($_GET['print']){ ?>
<style type="text/css">
	table{
		border-collapse : collapse;
		border : 1px solid #000;		 
		font-size : 11px;
	}

	table tr td{
		border : 1px solid #000;
		padding : 3px;		
		color : #000; 
	}

	.grid-title h4{
		padding : 0px;
		margin : 0px;
	}

	.page-title{
		display : none; 
	}

	.table-header-color1{
		color  : #000;
	}
</style>
<?php } ?>

<?php if(!$_GET['print']){ ?>
<div style="margin-bottom : 40px">
	 <div class="span12" style="float : left">
	 <?php //if($_GET['halaman'] != "kolektabilitas"){ ?>
	    <div class="input-append success date" data-date-format="yyyy-mm-dd" data-date-viewmode="months" data-date-minviewmode="months">
	      <input value="<?php echo $active; ?>" type="text" class="span12" id="report-filter-date" readonly="" data-date-format="yyyy-mm-dd" data-date-viewmode="months" data-date-minviewmode="months">
	      <span class="add-on"><span class="arrow"></span><i class="icon-th white-small" style="top:-5px;"></i></span> </div>
	<?php //} ?>
	 </div>

	<div style="float : right; margin-top : -30px">
      	<span class="label label-info" style="margin : 3px; margin-bottom : 10px">
			<i class="icon-print" style="margin-right : 5px"></i>
			<a style="color : #fff" href="?halaman=<?php echo $_GET['halaman']; ?>&print=xls">Print XLS</a>
		</span>
		<span class="label label-info" style="margin : 3px; margin-bottom : 10px">
			<i class="icon-print" style="margin-right : 5px"></i>
			<a style="color : #fff" href="?halaman=<?php echo $_GET['halaman']; ?>&print=pdf">Print PDF</a>
		</span>
      </div>
</div>
<?php } ?>