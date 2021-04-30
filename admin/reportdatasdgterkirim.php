<?php
session_start();
include "login/ceksession.php";
ob_start();
?>
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
  <link rel="stylesheet" href="../assets/plugins/datatables/dataTables.bootstrap.css" />
</head>
<body>
                <div class="table"><p align="center">
                <img style="width:100px;" src="../images/rmlogo.png" alt=""> <br> PT Fajar Cahaya Media <br> Jl. Raya Bantar Gebang Pangkalan 2, Bekasi</p>
                  <?php
            include '../koneksi/koneksi.php';
          	$sql1  		= "SELECT * FROM tb_kurir order by id_kurir asc";                        
          	$query1  	= mysqli_query($db, $sql1);
          	$total		= mysqli_num_rows($query1);
          	if ($total == 0) {
          		echo"<center><h2>Belum Ada Kurir Terdaftar</h2></center>";
          	}
          	else{?>		

          <div class="table">
            <?php
            $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];
            include '../koneksi/koneksi.php';
            if(!empty($date1) && !empty($date2)){
            $sql1  		= "SELECT * FROM tb_pelanggan inner join (tb_transaksi inner join tb_kurir on tb_transaksi.kurir = tb_kurir.id_kurir) on tb_pelanggan.id_pelanggan = tb_transaksi.pengirim where tb_transaksi.tgl_transaksi BETWEEN '$date1' and '$date2' and status LIKE '%Proses%' order by no_transaksi desc";
            }else{
              $sql1  		= "SELECT * FROM tb_pelanggan inner join (tb_transaksi inner join tb_kurir on tb_transaksi.kurir = tb_kurir.id_kurir) on tb_pelanggan.id_pelanggan = tb_transaksi.pengirim where status LIKE '%Proses%' order by no_transaksi desc";
            }        
            $query1  	= mysqli_query($db, $sql1);
            $total  	= mysqli_num_rows($query1);
            if ($total == 0) {
              echo"<center><h2>Tidak Ada Transaksi Belum Terkirim</h2></center>";
            }
            else{?>
            <style>
            #customers {
              table-layout: auto;
  width: 100%; 
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
}</style>
             <table align="center" id="customers">  
             <thead bgcolor="eeeeee" align="center">
               <tr>
                 	<th style="border:black 1px solid;">No Transaksi</th>
                 	<th style="border:black 1px solid;">Nama Barang</th>
                 	<th style="border:black 1px solid;">Alamat Asal</th>
                 	<th style="border:black 1px solid;">Alamat Tujuan</th>	   
                 	<th style="border:black 1px solid;">Pengirim</th>
                 	<th style="border:black 1px solid;">Penerima</th>
                 	<th style="border:black 1px solid;">Kurir</th>
                 	<th style="border:black 1px solid;">Status</th>  
               </tr>
             </thead>
             <?php
             while($data = mysqli_fetch_array($query1)){
               $namakurir = $data['nama_kurir'];
               if($namakurir == '' || $namakurir == null){
                 $namakurir = "Belum di Pickup";
               } else{
                 $namakurir = $data['nama_kurir'];
               }
              echo'<tr>
              	<td style="border:black 1px solid;">	'. $data['no_transaksi'].'   		</td>
              	<td style="border:black 1px solid;">	'. $data['nama_barang'].'			</td>
              	<td style="border:black 1px solid; ">	'. $data['alamat_asal'].'			</td>
              	<td style="border:black 1px solid;">	'. $data['alamat_tujuan'].'  		</td>
              	<td style="border:black 1px solid;">	'. $data['nama_pelanggan'].'  		</td>
              	<td style="border:black 1px solid;">	'. $data['penerima'].'				</td>
              	<td style="border:black 1px solid;">	'. $namakurir.'				</td>
              	<td style="border:black 1px solid;">	'. $data['status'].'				</td>
              
              </tr>';
            }
            ?>
            <tbody>		 
            </tbody>
          </table>
          <?php } ?>
        </div>

                  <?php } ?>
                  <br>
<p align='right'>Bekasi, <?php echo date('d-m-Y')?>
<br><br><br>TTD <br><br><br>
Admin</p>
                </div>

</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="datapelanggan.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.($content).'</page>';
 require_once(dirname(__FILE__).'../../html2pdf/html2pdf.class.php');
 try
 {
  $html2pdf = new HTML2PDF('L','A4','en', false, 'ISO-8859-15',array(5, 0, 20, 0));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>