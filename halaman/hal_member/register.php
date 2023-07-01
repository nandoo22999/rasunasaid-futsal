<?php
error_reporting(0);
include "../../config/koneksi.php";
include "../../config/fungsi_thumb_luar.php";
include "../../config/library.php";

// Cek email member di database
$cek_email=mysql_num_rows(mysql_query("SELECT email FROM member WHERE email='$_POST[email]'"));
// Kalau email sudah ada yang pakai
if ($cek_email > 0){
echo "<script>window.alert('Email yang anda masukkan sudah digunakan')</script>";
 echo "<meta http-equiv='refresh' content='0; url=../../register.html'>";
}
elseif (empty($_POST[nama_lengkap]) || empty($_POST[password]) || empty($_POST[email])){
  echo "<script>window.alert('Data yang anda isikan belum lengkap ')</script>";
 echo "<meta http-equiv='refresh' content='0; url=../../register.html'>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama_lengkap]")){
	echo "<script>window.alert('Nama tidak boleh diisi dengan angka atau simbol')</script>";
 echo "<meta http-equiv='refresh' content='0; url=../../register.html'>";

}

else{


$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");


// Input user
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
    UploadKTP($nama_file_unik);
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
echo "<script>window.alert('Pendaftaran berhasil, Silahkan melakukan login')</script>";
 echo "<meta http-equiv='refresh' content='0; url=../../login.html'>";
}

?>
