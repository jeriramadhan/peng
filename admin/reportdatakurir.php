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
						<style>
            table.d {
  table-layout: fixed;
  width: 100%;  
}
            #customers {
              align: center;
              table-layout: fixed;
  width: 200px; 
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
          				<th  style="border:black 1px solid;">id</th>
          				<th style="border:black 1px solid;">Nama</th>
          				<th style="border:black 1px solid;">Username</th>
          				<th style="border:black 1px solid;">Tanggal Lahir</th>
          				<th style="border:black 1px solid;">Alamat</th>
          				<th style="border:black 1px solid;">No Hp</th>
          				<th style="border:black 1px solid;">Rata-Rata Penilaian</th>	  
          			</tr>
          		</thead>
          		<?php

          		while($data = mysqli_fetch_array($query1)){
          			$sql5  		= "SELECT * FROM tb_transaksi where kurir = '".$data['id_kurir']."' and penilaian <> 0";                        
          			$query5  	= mysqli_query($db, $sql5);
          			$bariss		= mysqli_num_rows($query5);
          			$total_nilai = 0;
          			if ($bariss <> 0){
          				while($data5 = mysqli_fetch_array($query5)){
          					$total_nilai =  $total_nilai + $data5['penilaian'];					
          				}
          				$nilai = $total_nilai / $bariss;
          			}
          		else{
          			$nilai='Belum Ada Penilaian';
          		}
          		echo'<tr>
          		<td style="border:black 1px solid;">	'. $data['id_kurir'].'   			</td>
          		<td style="border:black 1px solid;">	'. $data['nama_kurir'].'			</td>
          		<td style="border:black 1px solid;">	'. $data['username_kurir'].'		</td>
          		<td style="border:black 1px solid;">	'. $data['tanggal_lahir_kurir'].'  	</td>
          		<td style="border:black 1px solid;">	'. $data['alamat'].'   				</td>
          		<td style="border:black 1px solid;">	'. $data['no_hp_kurir'].'			</td>
          		<td style="border:black 1px solid;">	'. $nilai.'							</td>
          		</tr>';
          	}
          	?>

          	<tbody>		 
          	</tbody>
          </table>

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
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 0, 20, 0));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>