<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data Transaksi Penyewaan Lapangan<small></small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Halaman</li>
        <li class="active"><?php echo"$_GET[halamane]"; ?></li>
      </ol>
    </section>


    <script language=Javascript>
function subtotal(lama){
var hitung = (document.getElementById('harga').value * document.getElementById('lama').value);
  document.forms.formID.subtotaltxt.value = hitung;
}


function sisabayar(dibayar){
var hitung2 = (document.getElementById('total_bayar').value - document.getElementById('dibayar').value);
  document.forms.formID2.sisa_bayar.value = hitung2;
}

function isNumberKey(evt)
//Membuat validasi hanya untuk input angka menggunakan kode javascript
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))

return false;
return true;
}

</script> 


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
$aksi="halaman/hal_transaksi/aksi_transaksi.php";
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil User
  default:
echo " <section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
           <div class='box'>
            <div class='box-header'>
              <a href='?halamane=transaksi&act=bookingtanggal' class='btn btn-large btn-primary'><span>Tambah Data</span></a>

              </h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>";
    if ($_GET['confirm'] =='konfirmasi'){
    echo" <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Konfirmasi Sukses!</h4>
                Mohon Menunggu transaksi anda segera di proses.
              </div>"; }

    if ($_SESSION['level'] =='admin'){
    echo"<table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>No transaksi</th>
                  <th>Nama member</th>
                  <th>Deskripsi</th> 
                  <th>Total</th>
                  <th>Dibayar</th>
                  <th>Sisa</th>
                  <th>Status Pembayaran</th>
                  <th>Status Lapangan</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>";
           
    $tampil = mysql_query("SELECT * FROM transaksi ORDER BY tgl_transaksi DESC");
    while($r=mysql_fetch_array($tampil)){

   $p=mysql_fetch_array(mysql_query("SELECT * FROM member WHERE username='$r[id_member]'"));
   $j=mysql_fetch_array(mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$r[lapangan]'"));
   $pm=mysql_fetch_array(mysql_query("SELECT * FROM pemakaian WHERE id_transaksi='$r[id_transaksi]'"));
   $jam_selesai=$r['jam_mulai']+$r['lama'];
   echo "<tr> 
   <td><a href='invoice-print.php?id=$r[id_transaksi]'>$r[id_transaksi]</a></td>
   <td>$p[nama_lengkap]</td>
   <td><b>".strtoupper($j['nama_lapangan'])."</b><br/> Dates : $r[tanggal_bermain] <br/>
   Jam Main: ";

   $data=mysql_query("SELECT * FROM pemakaian WHERE id_transaksi='$r[id_transaksi]'");
   while ($x=mysql_fetch_array($data)) {
   //ambil data dari tabel jadwal
  $xx=mysql_fetch_array(mysql_query("SELECT * FROM jadwal WHERE id_jadwal='$x[id_jadwal]'"));
    echo"<br/> $xx[nama_jadwal]";
   }
   



   echo"<br/>Lama Main : $r[lama] Jam</td>
        <td>".format_rupiah($r['total'])."</td>
        <td>".format_rupiah($r['dibayar'])."</td>
        <td>".format_rupiah($r['sisa'])."</td>
        <td>"; if($r['status']=='Lunas') {echo"<span class='label label-success'>Lunas</span>";} else {echo"<span class='label label-danger'>Belum Lunas</span>";} echo"</td>
        <td>"; 

          if ($pm['status']=='Pakai'){ 
   echo"<div class='btn-group'>
                  <button type='button' class='btn btn-danger btn-xs'>Pakai</button>
                  <button type='button' class='btn btn-danger btn-xs dropdown-toggle' data-toggle='dropdown'>
                    <span class='caret'></span>
                    <span class='sr-only'>Toggle Dropdown</span>
                  </button>
                  <ul class='dropdown-menu' role='menu'>
                    <li><a href='$aksi?halamane=transaksi&act=updatelapangan&id=$r[id_transaksi]&s=Book'>Book</a></li>
                  </ul>
                </div>"; 
   } 
   elseif ($pm['status']=='Book'){ 
      echo"<div class='btn-group'>
                  <button type='button' class='btn btn-warning btn-xs'>Book</button>
                  <button type='button' class='btn btn-warning btn-xs dropdown-toggle' data-toggle='dropdown'>
                    <span class='caret'></span>
                    <span class='sr-only'>Toggle Dropdown</span>
                  </button>
                  <ul class='dropdown-menu' role='menu'>
                    <li><a href='$aksi?halamane=transaksi&act=updatelapangan&id=$r[id_transaksi]&s=Pakai'>Pakai</a></li>
                  </ul>
                </div>"; 

              }


        echo"</td>
   
   <td> <div class='btn-group'>
                  <button type='button' class='btn btn-default btn-xs'>Action</button>
                  <button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown'>
                    <span class='caret'></span>
                    <span class='sr-only'>Toggle Dropdown</span>
                  </button>
                  <ul class='dropdown-menu' role='menu'>
                    
                    <li><a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=transaksi&act=hapus&id=$r[id_transaksi]'>Hapus</a></li>";

                    if($r['status']=='Belum Lunas'){
                      echo"<li><a href='?halamane=transaksi&act=pembayaran&id=$r[id_transaksi]'>Pembayaran</a></li>";
                    }

                  echo"</ul>
                </div></td>
   </tr> ";
  }
                
                echo"</tbody>
                
              </table>";
    }

     if ($_SESSION['level'] =='user'){

      echo"<table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>No transaksi</th>
                  <th>Nama Lengkap</th>
                  <th>Deskripsi</th> 
                  <th>Total</th>
                  <th>Dibayar</th>
                  <th>Sisa</th>
                  <th>Status Pembayaran</th>
                  <th>Status Lapangan</th>
                </tr>
                </thead>
                <tbody>";
           
    $tampil = mysql_query("SELECT * FROM transaksi WHERE id_pelanggan='$_SESSION[username]'");
    while($r=mysql_fetch_array($tampil)){

   $p=mysql_fetch_array(mysql_query("SELECT * FROM member WHERE username='$_SESSION[username]'"));
   $j=mysql_fetch_array(mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$r[lapangan]'"));
   $pm=mysql_fetch_array(mysql_query("SELECT * FROM pemakaian WHERE id_transaksi='$r[id_transaksi]'"));
   $jam_selesai=$r['jam_mulai']+$r['lama'];
   echo "<tr> 
   <td><a href='invoice-print.php?id=$r[id_transaksi]'>$r[id_transaksi]</a></td>
   <td>$p[nama_lengkap]</td>
   <td><b>".strtoupper($j['nama_lapangan'])."</b><br/> Dates : $r[tanggal_bermain] <br/>
   Jam Main: ";

   $data=mysql_query("SELECT * FROM pemakaian WHERE id_transaksi='$r[id_transaksi]'");
   while ($x=mysql_fetch_array($data)) {
   //ambil data dari tabel jadwal
  $xx=mysql_fetch_array(mysql_query("SELECT * FROM jadwal WHERE id_jadwal='$x[id_jadwal]'"));
    echo"<br/> $xx[nama_jadwal]";
   }
   



   echo"<br/>Lama Main : $r[lama] Jam</td>
        <td>".format_rupiah($r['total'])."</td>
        <td>".format_rupiah($r['dibayar'])."</td>
        <td>".format_rupiah($r['sisa'])."</td>
        <td>"; if($r['status']=='Lunas') {echo"<span class='label label-success'>Lunas</span>";} else {echo"<span class='label label-danger'>Belum Lunas</span>";} echo"</td>
        <td>"; 

   if ($pm['status']=='Pakai'){ 
   echo"<a class='label label-danger' href='#'>Pakai</a>"; } 
  
   elseif ($pm['status']=='Book'){ 
   echo"<a class='label label-warning' href='#'>Book</a>"; }


        echo"</td></tr> ";
  } // endif  while($r=mysql_fetch_array($tampil))
                
                echo"</tbody>
                
              </table>";
    
    } // endif ($_SESSION['level'] =='user')
            echo"</div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>";

   break;  

  case "pembayaran":
  $edit=mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$_GET[id]'");
   $r=mysql_fetch_array($edit);
  echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
    <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Formulir Pembayaran Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id='formID2' class='form-horizontal' method='POST' action='$aksi?halamane=transaksi&act=bayar' enctype='multipart/form-data'>
              <div class='box-body'>             


              <input type='hidden' name='id' readonly='true' value='$_GET[id]'>
                <div class='form-group'>
                  <label for='inputalamat3' class='col-sm-2 control-label'>Tanggal Bayar</label>
                  <div class='col-sm-10'>
                    <input type='text' name='tanggal_bayar' class='form-control' id='datepicker' readonly='true' value='$tgl_sekarang'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputno_hp3' class='col-sm-2 control-label'>Total Bayar</label>
                  <div class='col-sm-10'>
                    <input type='text' name='total_bayar' class='form-control' id='total_bayar' value='$r[sisa]' readonly='yes'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputno_hp3' class='col-sm-2 control-label'>Di Bayar</label>
                  <div class='col-sm-10'>
                    <input type='text' name='dibayar' id='dibayar' class='form-control required' onkeyup=\"sisabayar(this.value,getElementById('dibayar').value);\" onkeypress=\"return isNumberKey(event)\">
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputno_hp3' class='col-sm-2 control-label'>Sisa Bayar</label>
                  <div class='col-sm-10'>
                    <input type='text' name='sisa_bayar' id='sisa_bayar' class='form-control' readonly='yes'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputno_hp3' class='col-sm-2 control-label'>Catatan</label>
                  <div class='col-sm-10'>
                    <input type='text' name='catatan' class='form-control'>
                  </div>
                </div>


                
                
              <!-- /.box-body -->
              <div class='box-footer'>
        <a class='btn btn-default' href='?halamane=transaksi'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Save</button>
              </div>
              <!-- /.box-footer -->
            </form>

 <!-- /.Histori transaksi -->
 <h3 class='box-title'>Formulir Histori Pembayaran</h3>
 <div class='box-footer'>
  <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>No transaksi</th>
                  <th>Tanggal</th>
                  <th>Jumlah Bayar</th> 
                  <th>Catatan</th>
                </thead>
                <tbody>";
				   
    $tampil = mysql_query("SELECT * FROM pembayaran WHERE reff_id ='$_GET[id]' ORDER BY id_pembayaran ASC");
    while($r=mysql_fetch_array($tampil)){

   echo "<tr> 
        <td>$r[reff_id]</td>
        <td>$r[tanggal]</td>
        <td>$r[jumlah_bayar]</td>
        <td>$r[catatan]</td>
        
   </tr> ";
	}
                
                echo"</tbody>
                
              </table>      
              </div>
 <!-- /.Histori transaksi -->         

          </div></div></div>
      <!-- /.row -->


    </section>
    <!-- /.content -->
  </div>"; 



   break;

   case "bookingtanggal":
  
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-6'>
    <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Booking Tanggal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <div class='box-body'>
           <form method='post' action='?halamane=transaksi&act=bookinglapangan'>
            <table class='table table-bordered table-striped'>
             
              <tr>
                <td>Tanggal<br/><br/>
                 <div class='col-xs-12'>
                       <input type='text' value='$tgl_sekarang' class='form-control' id='datepicker' name='tanggal_booking' readonly='yes'>
                         </div>
                  
                  </td>
              </tr>


              <tr>
                <td>Lapangan<br/><br/>
                 <select name='lapangan' class=\"form-control\">
                <option value=''>-- Pilih lapangan --</option>";
                $data= mysql_query("SELECT * FROM lapangan ORDER BY nama_lapangan ASC");
                while($z=mysql_fetch_array($data)){
                echo"<option value='$z[id_lapangan]'>$z[nama_lapangan]</option>";
                }
          
          echo"</select>
                  
                  </td>
              </tr>

              
              <tr>
                <td><input type='submit' name='Submit' class='btn btn-primary' value='Tampilkan' /></td>
                
              </tr>
              
            </table>
            </form>
</div>

          </div></div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>"; 

   break;


   case "bookinglapangan":
  ?>
<script type = "text/javascript">
function change_button(checkbx,button_id) {
    var btn = document.getElementById(button_id);
    if (checkbx.checked == true) {
        btn.disabled = "";
    } else {
        btn.disabled = "disabled";
    }
}
</script>
  <?php
   //ambil data dari tabel lapangan
  $l=mysql_fetch_array(mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$_POST[lapangan]'"));

   echo " <section class='content'>
<form action='?halamane=transaksi&act=booking&tanggal=$_POST[tanggal_booking]&lapangan=$_POST[lapangan]' method='POST' name='f' accept-charset='utf-8'>
<h1><input type='submit' name='submit' value='Book now!' id='sub1' disabled='disabled'/></h1>

    <div class='row'>
    <div class='col-md-6'>
          <div class='box'>
            <div class='box-header with-border'>
              <h3 class='box-title'># Tanggal: $_POST[tanggal_booking] - $l[nama_lapangan]</h3>
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

//Array
$jumlah=1;
for($i=0; $i<$jumlah; $i++){
$nomor = $i + 1;
           
    $jadwal = mysql_query("SELECT * FROM jadwal WHERE id_lapangan='$_POST[lapangan]' ORDER BY id_jadwal ASC");
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
    
//array
  }            
                echo"</tbody>
                
              </table>
            </div>
          </div>
        </div>";

                
    echo"</form>
    </div> <!-- /.row -->       
    </section> <!-- /.content -->";

   break;


    case "booking":
  
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
    <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Formulir Tambah Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id='formID' class='form-horizontal' method='POST' action='$aksi?halamane=transaksi&act=booking' enctype='multipart/form-data'>
              <div class='box-body'>
              <input type='hidden' name='lapangan2' class='form-control' id='lapangan' value='$_GET[lapangan]'>

              <div class='form-group'>
                <label for='inputlevel3' class='col-sm-2 control-label'>Nama Member</label>
                <div class='col-sm-4'>";
                if ($_SESSION['level'] =='admin'){   
                  $result = mysql_query("select * from member WHERE username !='0' AND level !='admin' ORDER BY nama_lengkap ASC");  
                  } else {   
                  $result = mysql_query("select * from member WHERE username ='$_SESSION[username]'"); }
                  ?>

                  <select class="form-control" name="id_member" id="member">
                  
                  <?php
                  if ($_SESSION['level'] =='admin'){ echo"<option value='0'>Umum / Non Member</option>"; }

                  while ($row = mysql_fetch_array($result)) { 
                  echo '<option value="' . $row['username'] . '">' . $row['nama_lengkap'] . '</option>';   
                  }  
                echo '</select>';  
                echo"</div></div>

               

                <div class='form-group'>
                  <label for='inputalamat3' class='col-sm-2 control-label'>Tanggal Main</label>
                  <div class='col-sm-4'>
                    <input type='text' name='tanggal_bermain' class='form-control' id='datepicker' value='$_GET[tanggal]' readonly='yes'>
                  </div>
                </div>




                <table class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>Lapangan</th>
                  <th>Jadwal</th>
                  <th>Lama Main</th>
                   <th>Harga</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>";
  //hitung jumlah form yang dikirim
  $jmljadwal = count($_POST['jadwal']);

  ////Munculkan array data yang tadi dipilih
  for($a=0; $a<$jmljadwal; $a++){
  $nomor  = $a+1;
  $jadwal  = $_POST['jadwal'][$a];

  //ambil data dari tabel jadwal
  $j=mysql_fetch_array(mysql_query("SELECT * FROM jadwal WHERE id_jadwal='$jadwal'"));
  
  //ambil data dari tabel lapangan
  $l=mysql_fetch_array(mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$j[id_lapangan]'"));
  $total=$j['remark']*$l['harga'];

   echo"<tr>
    <td>$l[nama_lapangan] <input type='hidden' name='lapangan[]' class='form-control' id='lapangan' value='$j[id_lapangan]'> </td>
    <td>$j[nama_jadwal] <input type='hidden' name='id_jadwal[]' class='form-control' id='inputjam_mulai' value='$jadwal'>
    </td>
    <td>$j[remark]</td>
    <td>".format_rupiah($l[harga])."</td>
    <td>".format_rupiah($total)."</td>
   </tr> ";
   //array
  }


  
  $grandtotal=$jmljadwal*$l[harga];
echo"
 <input type='hidden' name='harga2' class='form-control' id='lapangan' value='$l[harga]'>
 <input type='hidden' name='grandtotal' class='form-control' id='lapangan' value='$grandtotal'>
<tr> 
    <td colspan='2'>Grand Total</td>
    <td>$jmljadwal</td>
    <td></td>
    <td>".format_rupiah($grandtotal)."</td>
   </tr>";

 echo"</tbody>
      </table>";



                 echo"<!-- /.box-body -->
              <div class='box-footer'>
        <a class='btn btn-default' href='?halamane=transaksi'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div></div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>";   
   break;
  
  case "booking-sukses":
$trans=mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$_GET[id]'");
   $r=mysql_fetch_array($trans);
  echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
    <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Booking Sukses</h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
  <p>Terima Kasih, Anda telah melakukan booking.</p>
  <p><h4>Kode Booking Anda: </h4>
   <h1><b>$_GET[id]</b></h1></p>";
  $m=mysql_fetch_array(mysql_query("select * from member WHERE username ='$_SESSION[username]'")); 
  echo "<p>Data booking anda adalah sebagai berikut: <br />
                <table>
                <tr><td>Nama Lengkap   </td><td> : <b>$m[nama_lengkap]</b> </td></tr>
                <tr><td>Alamat Lengkap </td><td> : $m[alamat] </td></tr>
                <tr><td>Telpon         </td><td> : $m[no_telp] </td></tr>
                <tr><td>E-mail         </td><td> : $m[email] </td></tr>
                </table>

                <hr/><br/>
                
               
                Silahkan lakukan pembayaran sebanyak Rp. ".format_rupiah($r[total]).", ke Nomer Rekening :<br/>
  </p>";

echo"<p>$i[rekening]</p>";

 echo"<p>Apabila sudah transfer, konfirmasi ke nomor: $i[no_telp] </p>";
 echo" <button type='button' class='btn btn-default btn-lrg ajax'  onclick=\"location.href='index.php?halamane=konfirmasi&act=tambahkonfirmasi';\">
            <i class='fa fa-spin fa-refresh'></i>&nbsp; konfirmasi Pembayaran
          </button>";
//============================================//=================
  $kepada = "$m[email]"; 
  $judul = "Booking Lapangan no: $_GET[id]";
  $pesan.="<br />Kode Booking Anda: $_GET[id]  
           <br />Grand Total : Rp. ".format_rupiah($r[total])."
           <br />Silahkan lakukan pembayaran sebanyak Rp. ".format_rupiah($r[total]).", ke Nomer Rekening : <br />
           $i[rekening]
           <br />Apabila sudah transfer, konfirmasi ke nomor: $i[no_telp]";

  mail($kepada,$judul,$pesan,"From: $i[email]\n Content-type:text/html\r\n");
//============================================//=================
          echo"</div></div>
          </div>
          </div>
      <!-- /.row -->
    </section>
  </div>"; 



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
