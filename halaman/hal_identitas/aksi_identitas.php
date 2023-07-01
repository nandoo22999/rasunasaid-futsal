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
if ($halamane=='identitas' AND $act=='update'){
  mysql_query("UPDATE identitas SET nama_identitas  = '$_POST[nama_identitas]',  alamat  = '$_POST[alamat]',no_telp  = '$_POST[no_telp]',email  = '$_POST[email]',rekening  = '$_POST[rekening]' WHERE id_identitas = '$_POST[id]'");

header('location:../../index.php?halamane='.$halamane);
}
}
?>
