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
// Hapus user
if ($halamane=='member' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT foto FROM member WHERE username='$_GET[id]'"));
  if ($data['foto']!=''){
     mysql_query("DELETE FROM member WHERE username='$_GET[id]'");
     unlink("../../foto_user/$_GET[namafile]");   
     unlink("../../foto_user/small_$_GET[namafile]");

  }
  else{
     mysql_query("DELETE FROM member WHERE username=$_GET[id]");
  }
header('location:../../index.php?halamane='.$halamane);
}
// Start Hapus-akun-member============================================================
elseif ($halamane=='member' AND $act=='hapus-akun-member'){
  $data=mysql_fetch_array(mysql_query("SELECT foto_ktp FROM member WHERE username='$_GET[id]'"));
  if ($data['foto_ktp']!=''){
     mysql_query("DELETE FROM member WHERE username='$_GET[id]'");
     unlink("../../foto_ktp/$_GET[namafile]");   
     unlink("../../foto_ktp/small_$_GET[namafile]");

  }
  else{
     mysql_query("DELETE FROM member WHERE username=$_GET[id]");
  }

  mysql_query("DELETE FROM transaksi WHERE id_member=$_GET[id]");

header('location:../../index.php?halamane=member&act=akun-member');
}
// END Hapus-akun-member============================================================

// Tambah tambah-akun-member============================================================
elseif ($halamane=='member' AND $act=='input-akun-member') {
$lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $pass=md5($_POST['password']);
  $nama_lengkap=antiinjection($_POST['nama_lengkap']);
  $email=antiinjection($_POST['email']);
  $alamat=antiinjection($_POST['alamat']);
  $no_telp=antiinjection($_POST['no_telp']);
  
  // Apabila ada foto yang diupload
  if (!empty($lokasi_file)){
    UploadKTPDiAdmin($nama_file_unik);
  mysql_query("INSERT INTO member(password,
                                 nama_lengkap,
                                 email,
                                 foto,
                                 level,
                                 tanggal,
                                 alamat,
                                 no_telp,
                                 foto_ktp) 
                         VALUES('$pass',
                                '$nama_lengkap',
                                '$email',
                                '',
                                'user',
                                '$tgl_sekarang',
                                '$alamat',
                                '$no_telp',
                                '$nama_file_unik')");
  }
  else{
  mysql_query("INSERT INTO member(password,
                                 nama_lengkap,
                                 email,
                                 tanggal,
                                 alamat,
                                 no_telp)
                         VALUES('$pass',
                                '$nama_lengkap',
                                '$email',
                                '$tgl_sekarang',
                                '$alamat',
                                '$no_telp')");
}
header('location:../../index.php?halamane=member&act=akun-member');
} // END Tambah tambah-akun-member============================================================

// Input user
elseif ($halamane=='member' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $pass=md5($_POST[password]);
  
if (!empty($lokasi_file)){
    UploadMemberDiAdmin($nama_file_unik);
  mysql_query("INSERT INTO member(password,
                                 nama_lengkap,
                                 email,
								 foto,level) 
	                       VALUES('$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
								'$nama_file_unik','$_POST[level]')");
  
 header('location:../../index.php?halamane='.$halamane);
  }
  else{
  mysql_query("INSERT INTO member(password,
                                 nama_lengkap,
                                 email,level)
	                       VALUES('$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]','$_POST[level]')");
 
  
}
  header('location:../../index.php?halamane='.$halamane);
 
}


// Update Member
elseif ($halamane=='member' AND $act=='update') {
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  // Apabila foto tidak diganti
  if($_POST[password]!=''){
  $pass=md5($_POST[password]);
  if (empty($lokasi_file)){
    mysql_query("UPDATE member SET password     = '$pass',
								  nama_lengkap  = '$_POST[nama_lengkap]',
                                  email         = '$_POST[email]',
                                  blokir        = '$_POST[blokir]',
                                   level        = '$_POST[level]'
                            WHERE  username     = '$_POST[id]'");

 header('location:../../index.php?halamane='.$halamane);
  }
  
  
  
  // Apabila password diubah
  else{
	$data_foto = mysql_query("SELECT foto FROM member WHERE username='$_POST[id]'");
	$r    	= mysql_fetch_array($data_foto);
	@unlink('../../foto_user/'.$r['foto']);
	@unlink('../../foto_user/'.'small_'.$r['foto']);
    UploadMemberDiAdmin($nama_file_unik ,'foto_user/');
    mysql_query("UPDATE member SET password        = '$pass',
								  nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]', 
								  foto          = '$nama_file_unik',
								  blokir        = '$_POST[blokir]',
								  level        = '$_POST[level]'
                           WHERE  username     = '$_POST[id]'");
  }
  } else {
  if (empty($lokasi_file)){
   mysql_query("UPDATE member SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
								  blokir        = '$_POST[blokir]',
								  level        = '$_POST[level]'
                           WHERE  username     = '$_POST[id]'");
  
 header('location:../../index.php?halamane='.$halamane);
  }
  // Apabila password diubah
  else{
	$data_foto = mysql_query("SELECT foto FROM member WHERE username='$_POST[id]'");
	$r    	= mysql_fetch_array($data_foto);
	@unlink('../../foto_user/'.$r['foto']);
	@unlink('../../foto_user/'.'small_'.$r['foto']);
    UploadMemberDiAdmin($nama_file_unik ,'foto_user/');
    mysql_query("UPDATE member SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]', 
								  foto          = '$nama_file_unik',
								  blokir        = '$_POST[blokir]',
								   level        = '$_POST[level]'
                           WHERE  username     = '$_POST[id]'");
  }
  }
  header('location:../../index.php?halamane='.$halamane);
  
}


// START UPDATE tambah-akun-member============================================================
elseif ($halamane=='member' AND $act=='update-akun-member') {
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
  header('location:../../index.php?halamane=member&act=edit-akun-member&id='.$_POST[id]);
  
}

// END UPDATE tambah-akun-member============================================================


}
?>
