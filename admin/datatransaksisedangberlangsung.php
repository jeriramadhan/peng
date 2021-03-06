<?php
session_start();
include "login/ceksession.php";
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>e-Kurir PT. Fajar Cahaya Media </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
     <!-- iCheck -->
     <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
     <!-- Morris chart -->
     <link rel="stylesheet" href="../assets/plugins/morris/morris.css">
     <!-- jvectormap -->
     <link rel="stylesheet" href="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
     <!-- Date Picker -->
     <link rel="stylesheet" href="../assets/plugins/datepicker/datepicker3.css">
     <!-- Daterange picker -->
     <link rel="stylesheet" href="../assets/plugins/daterangepicker/daterangepicker-bs3.css">
     <!-- bootstrap wysihtml5 - text editor -->
     <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
     <!-- css table datatables/dataTables -->
     <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css"/>

   </head>
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include "header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "menu.php"; ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Transaksi
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Transaksi</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Data Transaksi Sedang Berlangsung</h3>
                  <div class="box-tools pull-right"></div> 
                </div><!-- /.box-header -->
                <div class="box-body">
          <h4>Pilih Periode</h4>
          <div class="table">
              <form method="POST" action="" class="form-inline mt-3">
     <label for="date1">Tanggal mulai </label>
     <input type="date" name="date1" id="date1" class="form-control mr-2">
     <label for="date2">sampai </label>
     <input type="date" name="date2" id="date2" class="form-control mr-2">
     <button type="submit" name="submit" class="btn btn-primary">Cari</button>
    </form>
    <br>
            <?php
            include '../koneksi/koneksi.php';
          if (isset($_POST['submit'])) {
 $date1 = $_POST['date1'];
 $date2 = $_POST['date2'];

 if (!empty($date1) && !empty($date2)) {
   
  // perintah tampil data berdasarkan range tanggal
  $q = mysqli_query($db, "SELECT * FROM tb_transaksi inner join tb_pelanggan on tb_transaksi.pengirim = tb_pelanggan.id_pelanggan
            inner join tb_kurir on tb_transaksi.kurir = tb_kurir.id_kurir where status LIKE '%Proses%' and tgl_transaksi BETWEEN '$date1' and '$date2'"); 
 } else {
  // perintah tampil semua data
  $q = mysqli_query($db, "SELECT * FROM tb_transaksi inner join tb_pelanggan on tb_transaksi.pengirim = tb_pelanggan.id_pelanggan
            inner join tb_kurir on tb_transaksi.kurir = tb_kurir.id_kurir where status LIKE '%Proses%'"); 
 }
} else {
 // perintah tampil semua data
 $q = mysqli_query($db, "SELECT * FROM tb_transaksi inner join tb_pelanggan on tb_transaksi.pengirim = tb_pelanggan.id_pelanggan
            inner join tb_kurir on tb_transaksi.kurir = tb_kurir.id_kurir where status LIKE '%Proses%'");
}
?>
<a class="btn btn-info" href="javascript:void(0);"
    onclick="window.open('reportdatasdgterkirim.php?date1=<?php echo $date1?>&date2=<?php echo $date2?>','nama_window_pop_up','size=800,height=800,scrollbars=yes,resizeable=no')">Cetak</a>	
            <table id="lookup" class="table table-bordered table-hover">  
             <thead bgcolor="eeeeee" align="center">
              <tr>
               <th>No Transaksi</th>
               <th>Nama Barang</th>
               <th>Alamat Asal</th>
               <th>Alamat Tujuan</th>
               <th>Pengirim</th>
               <th>Penerima</th>
               <th>Kurir</th>
               <th>Tanggal Transaksi</th>
               <th>Penilaian</th>
               <th class="text-center"> Action </th>	  
             </tr>
           </thead>
           <?php
           while($data = mysqli_fetch_array($q)){
            echo'<tr>
            <td>	'. $data['no_transaksi'].'   		</td>
            <td>	'. $data['nama_barang'].'			</td>
            <td>	'. $data['alamat_asal'].'			</td>
            <td>	'. $data['alamat_tujuan'].'  		</td>
            <td>	'. $data['nama_pelanggan'].'  		</td>
            <td>	'. $data['penerima'].'				</td>
            <td>	'. $data['nama_kurir'].'			</td>
            <td>	'. $data['tgl_transaksi'].'			</td>
            <td>';
            if($data['penilaian']==0){
             echo'Belum Ada Penilaian';
           }
         else{
           echo $data['penilaian'];
         }
         echo'	</td>
         <td style="text-align:center;">
         <a href=detail-transaksiterkirim.php?no_transaksi='.$data['no_transaksi'].'>Detail</a></td>
         </tr>';
       }
       ?>
       <tbody>		 
       </tbody>
     </table>
   </div>
 </div><!-- /.box-body -->
              

    </div><!-- /.box -->

  </section><!-- /.Left col -->
</div><!-- /.row (main row) -->

</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php include "footer.php"; ?>

      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
       <div class="control-sidebar-bg"></div>
     </div><!-- ./wrapper -->

     <!-- jQuery 2.1.4 -->
     <script src="../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
     <!-- Bootstrap 3.3.5 -->
     <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
     <!-- DataTables -->
     <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
     <script src="../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
     <!-- SlimScroll -->
     <script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
     <!-- FastClick -->
     <script src="../assets/plugins/fastclick/fastclick.min.js"></script>
     <!-- AdminLTE App -->
     <script src="../assets/dist/js/app.min.js"></script>
     <!-- AdminLTE for demo purposes -->
     <script src="../assets/dist/js/demo.js"></script>
	  <script type="text/javascript"> 

            $(function () {
                $("#lookup").dataTable({"lengthMenu":[25,50,75,100],"pageLength":25});
            });
  
   
          </script>

  </body>
</html>
