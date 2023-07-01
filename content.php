<?php
// Bagian Home
if ($_GET['halamane']=='home'){
	include "halaman/hal_home/home.html";
	?>

	<?php
}   
// Bagian Daftar Member
elseif ($_GET['halamane']=='member'){
  if ($_SESSION['level']=='admin'){
    include "halaman/hal_member/member.php";
  } else{ include "halaman/hal_blank/blank.php";}
}

// Bagian Daftar Member
elseif ($_GET['halamane']=='update-data-member'){
  if ($_SESSION['level']=='user'){
    include "halaman/hal_member/update_member.php";
  } else{ include "halaman/hal_blank/blank.php";}
}

// Bagian Daftar lapangan
elseif ($_GET['halamane']=='lapangan'){
  if ($_SESSION['level']=='admin'){
    include "halaman/hal_lapangan/lapangan.php";
  } else{ include "halaman/hal_blank/blank.php";}
}


// Bagian Daftar jadwal
elseif ($_GET['halamane']=='jadwal'){
  if ($_SESSION['level']=='admin'){
    include "halaman/hal_jadwal/jadwal.php";
  } else{ include "halaman/hal_blank/blank.php";}
}


// Bagian pilih jadwal
elseif ($_GET['halamane']=='pilih-jadwal'){
  if ($_SESSION['level']=='admin'  || $_SESSION['level']=='user'){
    include "halaman/hal_jadwal/pilih_jadwal.php";
  } else{ include "halaman/hal_blank/blank.php";}
}


// Bagian Daftar konfirmasi
elseif ($_GET['halamane']=='konfirmasi'){
  if ($_SESSION['level']=='admin' || $_SESSION['level']=='user'){
    include "halaman/hal_konfirmasi/konfirmasi.php";
  } else{ include "halaman/hal_blank/blank.php";}
}


// Bagian Daftar transaksi
elseif ($_GET['halamane']=='transaksi'){
  if ($_SESSION['level']=='admin' || $_SESSION['level']=='user'){
    include "halaman/hal_transaksi/transaksi.php";
  } else{ include "halaman/hal_blank/blank.php";}
}

// Bagian Daftar identitas
elseif ($_GET['halamane']=='identitas'){
  if ($_SESSION['level']=='admin'){
    include "halaman/hal_identitas/identitas.php";
  } else{ include "halaman/hal_blank/blank.php";}
}

// Bagian Daftar identitas
elseif ($_GET['halamane']=='laptrans'){
  if ($_SESSION['level']=='admin'){
    include "laptrans.php";
  } else{ include "halaman/hal_blank/blank.php";}
}


// Apabila halaman tidak ditemukan
else{
  include "halaman/hal_blank/blank.php";
}


?>
