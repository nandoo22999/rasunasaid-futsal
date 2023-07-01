<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/koneksi.php";
include "../../config/library.php";
include "../../config/fungsi_thumb_luar.php";

$halamane=$_GET['halamane'];
$act=$_GET['act'];

//buat transaksi otomatis
   function createRandomNo() {
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
  srand((double)microtime()*1000000);
  $i = 0;
  $pass = '' ;
  while ($i <= 5) {
    $num = rand() % 33;
    $tmp = substr($chars, $num, 1);
    $pass = $pass . $tmp;
    $i++;
  }
  return $pass;
}
  $transaksi_id = createRandomNo();

// Hapus user
if ($halamane=='transaksi' AND $act=='hapus'){
mysql_query("DELETE FROM transaksi WHERE id_transaksi='$_GET[id]'");
mysql_query("DELETE FROM pembayaran WHERE reff_id='$_GET[id]'");
mysql_query("DELETE FROM pemakaian WHERE id_transaksi='$_GET[id]'");

header('location:../../index.php?halamane='.$halamane);
}


// aksi Booking
elseif ($halamane=='transaksi' AND $act=='booking') {

          
          //Ambil data array
          $jumlah = count($_POST['id_jadwal']);
          for($a=0; $a<$jumlah; $a++){
          $urut      = $a+1;
          $lapangan  = $_POST['lapangan'][$a];
          $id_jadwal     = $_POST['id_jadwal'][$a];
          
          //Simpan ke tabel pemakaian                   
              mysql_query("INSERT INTO pemakaian(id_lapangan,
                               id_transaksi,
                               tanggal_booking,
                               id_jadwal) 
                          VALUES('$lapangan',
                               '$transaksi_id',
                               '$_POST[tanggal_bermain]',
                               '$id_jadwal')");                           
          
          }

           //Simpan ke tabel transaksi  
             mysql_query("INSERT INTO transaksi(id_transaksi,tgl_transaksi,
                                    id_pelanggan,
                                    tanggal_bermain,
                                    lama,
                                    lapangan,
                                    harga,
                                    total,
                                    sisa)
                         VALUES('$transaksi_id',
                                '$_POST[tanggal_bermain]',
                                '$_POST[id_member]',
                                '$_POST[tanggal_bermain]',
                                '$jumlah',
                                '$_POST[lapangan2]',
                                '$_POST[harga2]',
                                '$_POST[grandtotal]',
                                '$_POST[grandtotal]')");   

         
 if ($_SESSION['level'] =='user'){
header('location:../../index.php?halamane=transaksi&act=booking-sukses&id='.$transaksi_id);
}
else {
header('location:../../index.php?halamane='.$halamane);
} 
}




// aksi pembayaran
elseif ($halamane=='transaksi' AND $act=='bayar') {
  if (!empty($_POST['dibayar'])){

    //insert ke pembayaran
   mysql_query("INSERT INTO pembayaran(reff_id,tanggal,jumlah_bayar,catatan)
                         VALUES('$_POST[id]','$_POST[tanggal_bayar]','$_POST[dibayar]','$_POST[catatan]')");
  
   //transaksi
   $t=mysql_fetch_array(mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$_POST[id]'"));
   $dibayar=$t['dibayar']+$_POST['dibayar'];
    //update ke tabel transaksi
    mysql_query("UPDATE transaksi SET
                             dibayar  = '$dibayar',
                             sisa  = '$_POST[sisa_bayar]'
                  WHERE id_transaksi = '$_POST[id]'");

    //jika sisa 0
    if ($_POST['sisa_bayar']=='0')
    {
       mysql_query("UPDATE transaksi SET
                             status  = 'Lunas'
                  WHERE id_transaksi = '$_POST[id]'");
    }

      }

  header('location:../../index.php?halamane='.$halamane); 


}

  

// Update updatelapangan
elseif ($halamane=='transaksi' AND $act=='updatelapangan') {
    mysql_query("UPDATE pemakaian SET status = '$_GET[s]' WHERE id_transaksi ='$_GET[id]'");
  
 header('location:../../index.php?halamane='.$halamane);
  }



}
?>
