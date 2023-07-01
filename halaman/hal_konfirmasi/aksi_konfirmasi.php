<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/fungsi_thumb_luar.php";
include "../../config/library.php";

$halamane=$_GET['halamane'];
$act=$_GET['act'];
// Hapus user
if ($halamane=='konfirmasi' AND $act=='hapus'){
mysql_query("DELETE FROM konfirmasi WHERE id_konfirmasi=$_GET[id]");
header('location:../../index.php?halamane='.$halamane);
}

// Input user
elseif ($halamane=='konfirmasi' AND $act=='input'){
  // Cek email kustomer di database
$cek_kode=mysql_num_rows(mysql_query("SELECT id_transaksi FROM konfirmasi WHERE id_transaksi='$_POST[no_transaksi]'"));
// Kalau email sudah ada yang pakai
if ($cek_kode > 0){
 header('location:../../index.php?halamane=konfirmasi&act=tambahkonfirmasi&ganda=ya');
}

else {
 mysql_query("INSERT INTO konfirmasi(id_transaksi,
                                   asal_bank,
                                   asal_no_rekening,
                                   jumlah,
                                   pengirim,
                                   tanggal) 
                        VALUES('$_POST[no_transaksi]',
                               '$_POST[asal_bank]',
                               '$_POST[asal_no_rekening]',
                               '$_POST[jumlah]',
                               '$_POST[pengirim]',
                               '$tgl_sekarang')");

  header('location:../../index.php?halamane=transaksi&confirm=konfirmasi');
}

 
}


// Update Member
elseif ($halamane=='konfirmasi' AND $act=='updatekonfirmasi') {
 //update status konfirmasi
 mysql_query("UPDATE konfirmasi SET status = '$_GET[status]' WHERE id_konfirmasi ='$_GET[id]'");

 //jika Status Diterima
    if ($_GET['status']=='Diterima')
    {

 $k=mysql_fetch_array(mysql_query("SELECT * FROM konfirmasi WHERE id_konfirmasi='$_GET[id]'"));

    //insert ke pembayaran
   mysql_query("INSERT INTO pembayaran(reff_id,tanggal,jumlah_bayar,catatan)
                         VALUES('$k[id_transaksi]','$tgl_sekarang','$k[jumlah]','')");
  
   //transaksi
   $t=mysql_fetch_array(mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$k[id_transaksi]'"));
   $dibayar=$t['dibayar']+$k['jumlah'];
    //update ke tabel transaksi
    mysql_query("UPDATE transaksi SET
                             dibayar  = '$dibayar',
                             sisa  = '$_POST[sisa_bayar]'
                  WHERE id_transaksi = '$k[id_transaksi]'");

    //jika sisa 0
   mysql_query("UPDATE transaksi SET
                             status  = 'Lunas'
                  WHERE id_transaksi = '$k[id_transaksi]'");

}


 header('location:../../index.php?halamane='.$halamane);
  }
  


}
?>
