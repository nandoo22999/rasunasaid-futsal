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

$halamane=$_GET[halamane];
$act=$_GET[act];
// Hapus user
if ($halamane=='lapangan' AND $act=='hapus'){
mysql_query("DELETE FROM lapangan WHERE id_lapangan='$_GET[id]'");
mysql_query("DELETE FROM jadwal WHERE id_lapangan='$_GET[id]'");
header('location:../../index.php?halamane='.$halamane);
}

// Input user
elseif ($halamane=='lapangan' AND $act=='input'){
  //buat lapangan otomatis
	$query = "select max(id_lapangan) as maksi from lapangan";
    $hasil = mysql_query($query);
    $data_oto     = mysql_fetch_array($hasil);
	  
	$data_potong = substr($data_oto['maksi'],0,5);
	$data_potong++;
	$kode="";
	for ($i=strlen($data_potong); $i<=1; $i++)
	$kode = $kode."0";
	$lapangan_id = "$kode$data_potong";
	
  mysql_query("INSERT INTO lapangan(id_lapangan,
                                 nama_lapangan,harga)
	                       VALUES('$lapangan_id',
                                '$_POST[nama_lapangan]','$_POST[harga]')");

  header('location:../../index.php?halamane='.$halamane);
 
}


// Update Member
elseif ($halamane=='lapangan' AND $act=='update') {
  
    mysql_query("UPDATE lapangan SET nama_lapangan  = '$_POST[nama_lapangan]',  harga  = '$_POST[harga]', blokir='$_POST[blokir]'
								  WHERE id_lapangan = '$_POST[id]'");

 header('location:../../index.php?halamane='.$halamane);
  }
  


}
?>
