<?php 
session_start(); 
include "login/ceksession.php";?>
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
            Data Order Terkirim
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Order</li>
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
                  <h3 class="box-title">Data Order Terkirim</h3>
                  <div class="box-tools pull-right">
                  </div> 
                </div><!-- /.box-header -->
              <div class="box-body">
                <!-- <form action='admin.php' method="POST">
          
	       <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan User ID dan Username' required /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='admin.php' class="btn btn-sm btn-success" >Refresh</i></a>
          	</div>
          </form>-->
          <div class="table">
            <?php 
            include '../koneksi/koneksi.php';
            $sql1  		= "SELECT * FROM tb_transaksi inner join tb_pelanggan on tb_transaksi.pengirim = tb_pelanggan.id_pelanggan where kurir='".$_SESSION['id']."' and status='Terkirim' order by no_transaksi desc";                        
            $query1  	= mysqli_query($db, $sql1);
            $total		= mysqli_num_rows($query1);
            if ($total == 0) {
              echo"<center><h2>Belum Ada Order Terkirim</h2></center>";
            }
            else{?>
            <table id="lookup" class="table table-bordered table-hover">  
             <thead bgcolor="eeeeee" align="center">
              <tr>
               <th>No Order</th>
               <th>Nama Barang</th>
               <th>Alamat Asal</th>
               <th>Alamat Tujuan</th>
               <th>Pengirim</th>
               <th>Penerima</th>       
               <th>No Hp Penerima</th>
               <th>Penilaian</th>
               <th>Notifikasi</th>
               <th class="text-center"> Action </th>   
             </tr>
           </thead>
           <?php			
           while($data = mysqli_fetch_array($query1)){
                         $no = $data['no_hp_penerima'];
            $ptn = "/^0/"; 
            $rpltxt = "62";  // Replacement string
            $nohp = preg_replace($ptn, $rpltxt, $no);
            echo'<tr>
            <td>	'. $data['no_transaksi'].'   	</td>
            <td>	'. $data['nama_barang'].'		</td>
            <td>	'. $data['alamat_asal'].'		</td>
            <td>	'. $data['alamat_tujuan'].'   	</td>
            <td>	'. $data['nama_pelanggan'].'   	</td>
            <td>	'. $data['penerima'].'			</td>
            <td>	'. $data['no_hp_penerima'].'	</td>
            <td>';
            if($data['penilaian']==0){
             echo'Belum Ada Penilaian';
           }
         else{
           echo $data['penilaian'];
         }
        echo'	</td>
                     '?><td><a class="btn btn-warning" href="https://wa.me/<?php echo $nohp?>?text=Sistem+Notifikasi+Pengiriman%0D%0AID+Pesanan+%3A+<?php echo $no_transaksi ?>%0D%0AStatus+%3A+<?php echo $data['status']?>%0D%0ADikirim+oleh+kurir+%3A+<?php echo $_SESSION['nama']?>%0D%0AMenuju+%3A+<?php echo $data['alamat_tujuan']?>%0D%0ASelengkapnya+%3A+https://pengiriman.jtech.my.id/pelanggan/detail-orderterkirim2.php?no_transaksi=<?php echo $no_transaksi ?>">Kirim Notifikasi</a></td><?php echo'
         <td style="text-align:center;"><a href=detail-orderterkirim.php?no_transaksi='.$data['no_transaksi'].'>Detail</a></td>
         </tr>';
       }
       ?>
       <tbody>		 
       </tbody>
     </table>
     <?php } ?>
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
	  <!--<script type="text/javascript"> 

            $(function () {
                $("#lookup").dataTable({"lengthMenu":[25,50,75,100],"pageLength":25});
            });
  
   
          </script>-->

  </body>
</html>
