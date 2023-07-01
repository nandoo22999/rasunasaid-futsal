<link href="assets/css/style_doc.css" rel="stylesheet" type="text/css" />
<?php
error_reporting(0);
session_start();
require_once "config/koneksi.php";
require_once "config/fungsi_rupiah.php";
$day =date(d);
$month =date(M);
$mo =date(m);
$year =date(y);

if($_POST['berdasar'] == "Semua Data"){
//modus delete Semua Data
	$sql = "SELECT * FROM transaksi";
  $dsum=mysql_fetch_array(mysql_query("SELECT SUM(total)AS total FROM transaksi"));
  $grandtotal=$dsum['total'];
							
}
else if ($_POST['berdasar'] == "Tanggal"){
	//modus tanggal
	$dari = $_POST['dari'];
	$ke = $_POST['ke'];

  $sql = "SELECT * FROM transaksi where tgl_transaksi >= '$dari' and tgl_transaksi <= '$ke'";
	$dsum=mysql_fetch_array(mysql_query("SELECT SUM(total)AS total FROM transaksi where tgl_transaksi >= '$dari' and tgl_transaksi <= '$ke'"));
  $grandtotal=$dsum['total'];

	}

  else if($_POST['berdasar'] == "Pencarian Kata"){
   //modus berdasarkan kata
  $field = $_POST['field'];
  $kata = $_POST['kata'];

  $sql = "SELECT * FROM transaksi where $field like '%$kata%'";
  $dsum=mysql_fetch_array(mysql_query("SELECT SUM(total)AS total FROM transaksi where $field like '%$kata%'"));
  $grandtotal=$dsum['total'];  
  }



$query = mysql_query($sql);

$i=mysql_fetch_array(mysql_query("SELECT * FROM identitas WHERE id_identitas='00'"));
echo"<table width='70%' border='0'>
<tr>
    <td colspan='3' align=center><b>LAPORAN TRANSAKSI PEMBAYARAN <br> PENYEWAAN LAPANGAN FUTSAL RASUNA SAID</b></td>
  </tr 
</table>
<table width='100%' border='0'>
<tr><br>
    <th align='left' width='108' scope='row'>Nama Cabang &nbsp;&nbsp;&nbsp;&nbsp; : $i[nama_identitas]</th>
    <th align='left' width='85'>Periode &nbsp;&nbsp;&nbsp;&nbsp; : $day/$mo/$year</th>
 
  </tr>
<tr>
    <th align='left' width='108' scope='row'>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : $i[alamat]</th>
    <th align='left' width='85'>Petugas  &nbsp; &nbsp;&nbsp;&nbsp;: $_SESSION[namalengkap]</th>
	
  </tr>
  
  <tr>
    <th align='left' width='108' scope='row'></th>
   
  </tr>
  
</table>
";
?>
	
							 
						
<br/>
 <table width='80%' border='1'>
							  <thead>
								  <tr>
									  <th>Tanggal</th>
									  <th><center>No. Transaksi</center></th>
									  <th><center>Nama pelanggan</center></th>
									  <th>Lapangan</th>
                    <th>Jam</th>
									  <th>Lama</th>
									  <th>Harga per Jam</th>
									  <th>Total</th>
                    
									 
									  							  
								  </tr>
							  </thead>   
							  <tbody>
							   <?php
				 while ($d = mysql_fetch_array($query)){
				$p=mysql_fetch_array(mysql_query("SELECT * FROM member WHERE username='$d[id_pelanggan]'"));		
        $l=mysql_fetch_array(mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$d[lapangan]'"));

			  ?>
				<tr>
                <td><center><?php echo $d['tgl_transaksi']; ?></center></td>
                <td><center><?php echo "$d[id_transaksi]"; ?></center></td>
                <td><?php echo "$p[nama_lengkap]"; ?></td>
                <td><?php echo"$l[nama_lapangan]"; ?></td>
                <td><?php 

            $data=mysql_query("SELECT * FROM pemakaian WHERE id_transaksi='$d[id_transaksi]'");
   while ($x=mysql_fetch_array($data)) {
   //ambil data dari tabel jadwal
  $xx=mysql_fetch_array(mysql_query("SELECT * FROM jadwal WHERE id_jadwal='$x[id_jadwal]'"));
    echo"Jam &nbsp;: $xx[nama_jadwal].&nbsp;";
   }

    ?></td>
                <td align="right"><center><?php echo "$d[lama] Jam"; ?></center></td>
                <td align="right"><center><?php echo Rp. "&nbsp;". format_rupiah($d[harga]); ?></center></td>
                <td align="right"><center><?php echo Rp. "&nbsp;". format_rupiah($d[total]); ?></center></td>
               
                </tr>
			   <?php } ?>
			    <tr>
				<td style="color:#FFF; background-color:#C0C0C0; border:none" colspan="" align="left">Total</td>
                <td colspan='6' style="color:#FFF; background-color:#C0C0C0; border:none" align="right"></td>
                
                <td style="color:#FFF; background-color:#C0C0C0; border:none" align="center">
				<?php
						
						echo "". format_rupiah($grandtotal);
						
				?>
				</td>
                 
                
				
              </tr>
			  

								                                  
							  </tbody>
				
				
							  
						 </table> 
<br/>
<br/>
<table width='80%' border='0'>
  <tr>
    <th width='201' scope='col'>Dilaporkan Oleh, </th>
    <th width='202' scope='col'>Diverifikasi Oleh,</th><br />
    <th width='218' scope='col'>Disetujui Oleh, </th>
    
  </tr>
   <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr><tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr><tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  <tr>
    <th width='201' scope='col'></th>
    <th width='202' scope='col'></th>
    <th width='218' scope='col'></th>
    
  </tr>
  </tr>
   <tr>
    <th width='201' scope='col'>(<?php echo $_SESSION['namalengkap']; ?>)</th>
    <th width='202' scope='col'>(-------------------------------------) </th>
    <th width='218' scope='col'>(-------------------------------------)</th>
    
  </tr>
  
</table>
						 
						 
							 