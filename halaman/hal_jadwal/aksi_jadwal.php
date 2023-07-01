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
if ($halamane=='jadwal' AND $act=='hapus'){
mysql_query("DELETE FROM jadwal WHERE id_jadwal=$_GET[id]");
header('location:../../index.php?halamane='.$halamane);
}

// Input user
elseif ($halamane=='jadwal' AND $act=='input'){
 	
  mysql_query("INSERT INTO jadwal(id_lapangan,nama_jadwal,remark)
	                       VALUES('$_POST[lapangan]','$_POST[nama_jadwal]','$_POST[remark]')");

  header('location:../../index.php?halamane='.$halamane);
 
}


// Update Member
elseif ($halamane=='jadwal' AND $act=='update') {
  
    mysql_query("UPDATE jadwal SET nama_jadwal = '$_POST[nama_jadwal]',
    							   id_lapangan = '$_POST[lapangan]',
    									remark = '$_POST[remark]'
							   WHERE id_jadwal = '$_POST[id]'");

 header('location:../../index.php?halamane='.$halamane);
  }
  


}
?>
