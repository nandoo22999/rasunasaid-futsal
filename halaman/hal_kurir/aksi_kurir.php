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
if ($halamane=='kurir' AND $act=='hapus'){
mysql_query("DELETE FROM kurir WHERE id_kurir=$_GET[id]");
header('location:../../index.php?halamane='.$halamane);
}

// Input user
elseif ($halamane=='kurir' AND $act=='input'){
  //buat kurir otomatis
	$query = "select max(id_kurir) as maksi from kurir";
    $hasil = mysql_query($query);
    $data_oto     = mysql_fetch_array($hasil);
	  
	$data_potong = substr($data_oto['maksi'],0,5);
	$data_potong++;
	$kode="";
	for ($i=strlen($data_potong); $i<=1; $i++)
	$kode = $kode."0";
	$kurir_id = "$kode$data_potong";
	
  mysql_query("INSERT INTO kurir(id_kurir,nama_kurir,no_ktp,alamat,jenis_kelamin,pendidikan,no_hp)
	                       VALUES('$kurir_id','$_POST[nama_kurir]','$_POST[no_ktp]','$_POST[alamat]','$_POST[jenis_kelamin]','$_POST[pendidikan]','$_POST[no_hp]')");

  header('location:../../index.php?halamane='.$halamane);
 
}


// Update Member
elseif ($halamane=='kurir' AND $act=='update') {
  
    mysql_query("UPDATE kurir SET nama_kurir  = '$_POST[nama_kurir]', no_ktp='$_POST[no_ktp]',alamat='$_POST[alamat]',jenis_kelamin='$_POST[jenis_kelamin]',
    	pendidikan='$_POST[pendidikan]',no_hp='$_POST[no_hp]'
								  WHERE id_kurir = '$_POST[id]'");

 header('location:../../index.php?halamane='.$halamane);
  }
  


}
?>
