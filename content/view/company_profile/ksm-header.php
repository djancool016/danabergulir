<?php $is_used = cek_is_used(); ?>

<tr style="background-color : #d1dade">
	<td align="center" style="<?php if($_GET['halaman'] == "ksm") echo 'background : #fff; '; ?>padding:14px 1px 14px 1px; width:12%">
		<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=ksm">Database KSM</a>
	</td>
	<td align="center" style="<?php if($_GET['halaman'] == "tambah_ksm") echo 'background : #fff; '; ?>padding:14px 1px 14px 1px; width:15%; ">
		<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=tambah_ksm">Tambah KSM</a>
	</td>
	
	<?php if(!$is_used){ ?>
	<td align="center" style="<?php if($_GET['halaman'] == "pinjaman_ksm_lama") echo 'background : #fff; '; ?>padding:14px 1px 14px 1px; width:15%; ">
		<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=pinjaman_ksm_lama">Pinjaman KSM Lama</a>
	</td>
	<td style="<?php if($_GET['halaman'] == "tabungan_ksm_lama") echo 'background : #fff; '; ?>padding-left:15px; width:15%">
		<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=tabungan_ksm_lama">Tabungan KSM Lama</a>
	</td>
	<?php } else { ?>
	<td align="center" style="<?php if($_GET['halaman'] == "pinjaman_ksm") echo 'background : #fff; '; ?>padding:14px 1px 14px 1px; width:15%; ">
		<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=pinjaman_ksm_lama">Pinjaman KSM</a>
	</td>
	<td style="<?php if($_GET['halaman'] == "tabungan_awal_ksm") echo 'background : #fff; '; ?>padding-left:15px; width:15%">
		<a href="<?php echo base_url(); ?>content/controller/dashboard.php?halaman=tabungan_awal_ksm">Tabungan KSM Baru</a>
	</td>
	<?php } ?>
	<td colspan="3"></td>
</tr>