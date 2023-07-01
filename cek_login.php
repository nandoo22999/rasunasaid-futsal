<?php
error_reporting(0);
include "config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$email = $_POST['email'];
$pass     = md5($_POST['password']);

// pastikan username dan password adalah berupa huruf atau angka.
//if (!ctype_alnum($username) OR !ctype_alnum($pass)){
 // echo "Sekarang loginnya tidak bisa di injeksi lho.";
//}
//else{
$login=mysql_query("SELECT * FROM member WHERE email='$email' AND password='$pass'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  $_SESSION['username']     = $r['username'];
  $_SESSION['namauser']     = $r['email'];
  $_SESSION['namalengkap']  = $r['nama_lengkap'];
  $_SESSION['passuser']     = $r['password'];
  $_SESSION['foto']     	= $r['foto'];
  $_SESSION['level']     	= $r['level'];


	$sid_lama = session_id();
	session_regenerate_id();
	$sid_baru = session_id();

  mysql_query("UPDATE member SET status='Y' WHERE username='$_SESSION[username]'");
  
  echo "<script>alert('Selamat Datang $_SESSION[namalengkap]'); window.location = 'index.php?halamane=home'</script>";
}
else{
 echo "<script>alert('Login Gagal, username atau password anda salah'); window.location = 'login.html'</script>";
}
//}
?>
