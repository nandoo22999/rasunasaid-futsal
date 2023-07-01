<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Daftar List Jadwal Penggunaan Lapangan<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Halaman</li>
        <li class="active"><?php echo"$_GET[halamane]"; ?></li>
      </ol>
    </section>
<?php    
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="halaman/hal_jadwal/aksi_jadwal.php";
switch($_GET[act]){
  // Tampil User
  default:
echo " <section class='content'>
    <div class='row'>

    <form method='post' action='?halamane=pilih-jadwal&act=bytanggal'>
   <div class='form-group'>
            <div class='col-xs-3'>
                  <input type='text' value='$tgl_sekarang' class='form-control' id='datepicker' name='tanggal_booking' readonly='yes'>
                </div>
                </div>

                <div class='form-group'>
                <div class='col-xs-3'>
                       <input type='submit' name='Submit' class='btn btn-primary' value='Tampilkan' />
                </div>
                </div>               
            </form>

<br/>
<center><h1>Jadwal Hari Ini</h1></center>
  <form action='?halamane=pilih-jadwal&act=booking' method='POST' name='f' accept-charset='utf-8'>";

//Array
$jumlah=1;
for($i=0; $i<$jumlah; $i++){
$nomor = $i + 1;


    $tampil = mysql_query("SELECT * FROM lapangan ORDER BY id_lapangan ASC");
    while($r=mysql_fetch_array($tampil)){
   echo " <div class='col-md-6'>
          <div class='box'>
            <div class='box-header with-border'>
              <h3 class='box-title'>$r[nama_lapangan]</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table class='table table-bordered'>
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama jadwal</th>
                   <th>Status</th>
                </tr>
                </thead>
                <tbody>";
           
    $jadwal = mysql_query("SELECT * FROM jadwal WHERE id_lapangan='$r[id_lapangan]' ORDER BY id_jadwal ASC");
    while($j=mysql_fetch_array($jadwal)){
   echo "<tr> 
    <td>";

    $a1=mysql_fetch_array(mysql_query("SELECT * FROM pemakaian WHERE tanggal_booking='$tgl_sekarang' AND id_jadwal='$j[id_jadwal]' AND status !='Free'")); 
        if($a1['id_jadwal']=="$j[id_jadwal]"){
        echo"<input type=\"checkbox\" value='$j[id_jadwal]' name='jadwal[]' disabled='disabled' onclick=\"change_button(this,'sub1')\" checked/>";}
        else {
        echo"<input type=\"checkbox\" value='$j[id_jadwal]' name='jadwal[]' onclick=\"change_button(this,'sub1')\"/>$a1[status]";} 


  echo"</td>
   <td>$j[nama_jadwal]</td>
    <td>";
$a2=mysql_fetch_array(mysql_query("SELECT * FROM pemakaian WHERE tanggal_booking='$tgl_sekarang' AND id_jadwal='$j[id_jadwal]'")); 
    if($a2['status']=="Free"){
    echo"<span class='label label-success'>$a2[status]</span>";
  }
  elseif($a2['status']=="Book"){
    echo"<span class='label label-warning'>$a2[status]</span>";
  }

  elseif($a2['status']=="Pakai"){
    echo"<span class='label label-danger'>$a2[status]</span>";
  }
  else {
   echo"<span class='label label-success'>Free</span>"; 
  }

    echo"</td>
   </tr> ";
  }
                
                echo"</tbody>
                
              </table>
            </div>
          </div>
        </div>";
  }

//array
  }
                
    echo"</form></div> <!-- /.row -->       
    </section> <!-- /.content -->";

   break;


  case "bytanggal":
echo " <section class='content'>
    <div class='row'>

   <form method='post' action='?halamane=pilih-jadwal&act=bytanggal'>
   <div class='form-group'>
            <div class='col-xs-3'>
                  <input type='text' value='$_POST[tanggal_booking]' class='form-control' id='datepicker' name='tanggal_booking' readonly='yes'>
                </div>
                </div>

                <div class='form-group'>
                <div class='col-xs-3'>
                       <input type='submit' name='Submit' class='btn btn-primary' value='Tampilkan' />
                </div>
                </div>               
            </form>

<br/>
<center><h1>Jadwal ".tgl_indo($_POST[tanggal_booking])."</h1></center>

  <form action='?halamane=pilih-jadwal&act=booking' method='POST' name='f' accept-charset='utf-8'>";

//Array
$jumlah=1;
for($i=0; $i<$jumlah; $i++){
$nomor = $i + 1;


    $tampil = mysql_query("SELECT * FROM lapangan ORDER BY id_lapangan ASC");
    while($r=mysql_fetch_array($tampil)){
   echo " <div class='col-md-6'>
          <div class='box'>
            <div class='box-header with-border'>
              <h3 class='box-title'>$r[nama_lapangan]</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table class='table table-bordered'>
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama jadwal</th>
                   <th>Status</th>
                </tr>
                </thead>
                <tbody>";
           
    $jadwal = mysql_query("SELECT * FROM jadwal WHERE id_lapangan='$r[id_lapangan]' ORDER BY id_jadwal ASC");
    while($j=mysql_fetch_array($jadwal)){
   echo "<tr> 
    <td>";

    $a1=mysql_fetch_array(mysql_query("SELECT * FROM pemakaian WHERE tanggal_booking='$_POST[tanggal_booking]' AND id_jadwal='$j[id_jadwal]' AND status !='Free'")); 
        if($a1['id_jadwal']=="$j[id_jadwal]"){
        echo"<input type=\"checkbox\" value='$j[id_jadwal]' name='jadwal[]' disabled='disabled' onclick=\"change_button(this,'sub1')\" checked/>";}
        else {
        echo"<input type=\"checkbox\" value='$j[id_jadwal]' name='jadwal[]' onclick=\"change_button(this,'sub1')\"/>$a1[status]";} 


  echo"</td>
   <td>$j[nama_jadwal]</td>
    <td>";
$a2=mysql_fetch_array(mysql_query("SELECT * FROM pemakaian WHERE tanggal_booking='$_POST[tanggal_booking]' AND id_jadwal='$j[id_jadwal]'")); 
    if($a2['status']=="Free"){
    echo"<span class='label label-success'>$a2[status]</span>";
  }
  elseif($a2['status']=="Book"){
    echo"<span class='label label-warning'>$a2[status]</span>";
  }

  elseif($a2['status']=="Pakai"){
    echo"<span class='label label-danger'>$a2[status]</span>";
  }
  else {
   echo"<span class='label label-success'>Free</span>"; 
  }

    echo"</td>
   </tr> ";
  }
                
                echo"</tbody>
                
              </table>
            </div>
          </div>
        </div>";
  }

//array
  }
                
    echo"</form></div> <!-- /.row -->       
    </section> <!-- /.content -->";

   break;  



   }
   //kurawal akhir hak akses halamane
   

   }
   ?>


   </div> 
   </div>
   </div>
   <div class='clear height-fix'></div> 
   </div></div>
