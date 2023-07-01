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

$halamane=$_GET[halamane];
$act=$_GET[act];

// START UPDATE tambah-akun-member============================================================
if ($halamane=='member' AND $act=='update-akun-member') {
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  // Apabila foto_ktp tidak diganti
  if($_POST[password]!=''){
  $pass=md5($_POST[password]);
  if (empty($lokasi_file)){
    mysql_query("UPDATE member SET password     = '$pass',
                                   nama_lengkap = '$_POST[nama_lengkap]',
                                   email        = '$_POST[email]',
                                   blokir       = '$_POST[blokir]',
                                   alamat       = '$_POST[alamat]',
                                   no_telp      = '$_POST[no_telp]'
                            WHERE  username     = '$_POST[id]'");

 header('location:../../index.php?halamane='.$halamane);
  }
  
  
  
  // Apabila password diubah
  else{
  $data_foto = mysql_query("SELECT foto_ktp FROM member WHERE username='$_POST[id]'");
  $r      = mysql_fetch_array($data_foto);
  @unlink('../../foto_ktp/'.$r['foto_ktp']);
  @unlink('../../foto_ktp/'.'small_'.$r['foto_ktp']);
    UploadKTPDiAdmin($nama_file_unik ,'foto_ktp/');
    mysql_query("UPDATE member SET password = '$pass',
                               nama_lengkap = '$_POST[nama_lengkap]',
                               email        = '$_POST[email]', 
                               blokir       = '$_POST[blokir]',
                               alamat       = '$_POST[alamat]',
                               no_telp      = '$_POST[no_telp]',
                               foto_ktp     = '$nama_file_unik'
                             WHERE username = '$_POST[id]'");
  }
  } else {
  if (empty($lokasi_file)){
   mysql_query("UPDATE member SET nama_lengkap = '$_POST[nama_lengkap]',
                                         email = '$_POST[email]',
                                        blokir = '$_POST[blokir]',
                                        alamat = '$_POST[alamat]',
                                       no_telp = '$_POST[no_telp]'
                                WHERE username = '$_POST[id]'");
  
 header('location:../../index.php?halamane='.$halamane);
  }
  // Apabila password diubah
  else{
  $data_foto = mysql_query("SELECT foto_ktp FROM member WHERE username='$_POST[id]'");
  $r      = mysql_fetch_array($data_foto);
  @unlink('../../foto_ktp/'.$r['foto_ktp']);
  @unlink('../../foto_ktp/'.'small_'.$r['foto_ktp']);
    UploadKTPDiAdmin($nama_file_unik ,'foto_ktp/');
    mysql_query("UPDATE member SET nama_lengkap = '$_POST[nama_lengkap]',
                                          email = '$_POST[email]', 
                                         alamat = '$_POST[alamat]',
                                        no_telp = '$_POST[no_telp]',
                                       foto_ktp = '$nama_file_unik'
                                 WHERE username = '$_POST[id]'");
  }
  }
  header('location:../../index.php?halamane=update-data-member');
  
}

// END UPDATE tambah-akun-member============================================================

}
?>
