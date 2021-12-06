<html>
	<head>
		<style type="text/css">
			html, body{
				padding : 30px;
				margin : 0px;
				width : 695px;
				height : 495px;
				font-size : 11px;
			}
		</style>
	</head>
	<body>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td>
					
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="50%" align="left">
								
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td width="100px">Nama LKM</td>
										<td width="10px">:</td> 
										<td><?php echo get_userdata('lkm_name'); ?></td>
									</tr>
									<tr>
										<td>Kelurahan/Desa</td>
										<td>:</td>
										<td><?php echo get_userdata('kelurahan_name'); ?></td>
									</tr>
									<tr>
										<td>Kota/Kabupaten</td>
										<td>:</td>
										<td><?php echo get_userdata('kota_name'); ?></td>
									</tr>
								</table>	

							</td>
							<td width="50%" valign="top" align="right">
								Model LU-01
							</td>
						</tr>
					</table>
					
					
				</td>
			</tr>
			<tr>
				<td height="50px"></td>
			</tr>
			<tr>
				<td align="center">
					<div><b style="font-size : 25px">BUKTI KAS MASUK</b></div>
					<div><b style="font-size : 18px">No. Transaksi : <?php echo $fill['no']; ?></b></div>
				</td>
			</tr>
			<tr>
				<td height="50px"></td>
			</tr>
			<tr>
				<td>
					
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="200px">Terima Dari</td>
							<td width="10px">:</td>
							<td>
								<?php 
									if($fill['id_ksm'] and $fill['id_ksm'] != "-")
										echo get_ksm_name($fill['id_ksm']);
									else if($fill['id_ksm'] == "-")
										echo $fill['other_ksm'];
									else
										echo " - ";
								?>
							</td>
						</tr>
						<tr>
							<td colspan="3" height="10"></td>
						</tr>
						<tr>
							<td>Nomor Register</td>
							<td>:</td>
							<td><?php echo $fill['no_register']; ?></td>
						</tr>
						<tr>
							<td colspan="3" height="10"></td>
						</tr>
						<tr>
							<td>Untuk realisasi pembayaran</td>
							<td>:</td>
							<td><?php echo $fill['remark']; ?></td>
						</tr>
						<tr>
							<td colspan="3" height="10"></td>
						</tr>
						<tr>
							<td>Jumlah</td>
							<td>:</td>
							<td><?php echo decimal($fill['base']); ?></td>
						</tr>
						<tr>
							<td colspan="3" height="10"></td>
						</tr>
						<tr>
							<td>Terbilang</td>
							<td>:</td>
							<td><?php echo terbilang($fill['base']); ?></td>
						</tr>
						<tr>
							<td colspan="3" height="10"></td>
						</tr>
						<tr>
							<td>Penyetor</td>
							<td>:</td>
							<td><?php echo $fill['transaction_by']; ?></td>
						</tr>
					</table>

				</td>
			</tr>
			<tr>
				<td height="30px"></td>
			</tr>
			<tr>
				<td>
					
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td align="center">
								<div style="margin-top : 25px">Pembuku</div>
								<div style="margin-top : 60px">( ................................. )</div>
							</td>
							<td align="center">
								<div style="margin-top : 25px">Kasir</div>
								<div style="margin-top : 60px">( ................................. )</div>
							</td>
							<td align="center">
								<div style="margin-bottom : 10px"><?php echo date("d-M-Y", strtotime($fill['transaction_date'])); ?></div>
								<div>Penyetor</div>
								<div style="margin-top : 60px">( ................................. )</div>
							</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>
	</body>
</html>