<div style="padding : 20px">
  <?php require_once("../view/company_profile/report_header.php"); ?>
</div>

 <div class="content">  
      <div class="page-title"> <i class="icon-custom-left"></i>
        <div class="row-fluid">
      <div class="span6">
        <h3>Catatan - <span class="semi-bold">Uang Masuk</span></h3>
      </div>
    </div>
      </div>

  <!-- BEGIN DAFTAR KAS KELUAR-->
  
      <div class="row-fluid">
        
        <div class="span12">
          <div class="grid simple ">
          <div class="grid-title no-border bg-green">
          <div class="row-fluid">
          <table width="100%">
            <tr>
              <td width="15%" nowrap><h4>Nama LKM</h4></td>
              <td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata("lkm_name"); ?></span></h4></td>
              <td width="20%" nowrap align="right"><h4><span class="semi-bold">Model U-1</span></h4></td>
            </tr>
            <tr>
              <td width="15%" nowrap><h4>Kelurahan/Desa</h4></td>
              <td width="65%" nowrap><h4><span class="semi-bold">: <?php echo get_userdata("kelurahan_name"); ?></span></h4></td>
              <td width="20%" nowrap align="right"><h4 style="color: #fff;"><span class="semi-bold"><?php echo get_userdata("kota_name"); ?></span></h4></td>
            </tr>
            </table>  
          </div>
        </div>

            <div class="grid-body ">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="tabelreport" width="100%" >
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>No. Transaksi</th>
                    <th>Terima Dari</th>
                    <th>Tipe</th>
                    <th>Akun</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($b = mysql_fetch_array($a)){ ?>
                    <tr class="odd gradeX">
                      <td><?php echo date("d-m-Y", strtotime($b[transaction_date])); ?></td>
                      <td><?php echo $b['no']; ?></td>
                      <td><?php if(!$b['other_ksm']) echo "$b[name]"; else echo $b['other_ksm']; ?></td>
                      <td><span class="label label-warning"><?php echo "$b[register_name]"; ?></span></td>
                      <td class="center"><span class="label label-calm tip" data-placement="left" title="" data-toggle="tooltip" type="button" data-original-title="Untuk pembayaran angsuran bulam Mei"><?php echo "$b[code] - $b[coa_name]"; ?></span></td>
                      <td style="text-align : right"><?php $total += $b[base]; echo decimal($b[base]); ?></td>
                      <td><?php echo $b['remark']; ?></td>
                      <td>
                        <span class="label label-info" style="margin : 3px; margin-bottom : 10px">
                          <i class="icon-print" style="margin-right : 5px"></i>
                          <a style="color : #fff" href="<?php echo base_url(); ?>content/controller/report.php?halaman=bukti_kas_masuk&id=<?php echo $b[id]; ?>&print=pdf">PDF</a>
                        </span>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                    <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
                </tfoot>
              </table>
             
            </div>
          </div>
        </div>
      </div>

 
    

  <!-- END DAFTAR KAS KELUAR-->    
    
    </div>
    </div>
  </div> 
