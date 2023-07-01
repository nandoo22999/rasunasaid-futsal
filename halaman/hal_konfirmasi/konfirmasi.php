<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Daftar Konfirmasi Pembayaran<small></small></h1>
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
$aksi="halaman/hal_konfirmasi/aksi_konfirmasi.php";
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil User
  default:
   if ($_SESSION['level']=='admin'){
echo " <section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
           <div class='box'>
            <div class='box-header'>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
				  <th>Tanggal</th>
                  <th>No Transaksi</th>
                 
                  <th>Bank Tujuan</th>
                  <th>Jumlah</th>
                   <th>Pengirim</th>
                   <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>";
				   
    $tampil = mysql_query("SELECT * FROM konfirmasi ORDER BY id_konfirmasi ASC");
    while($r=mysql_fetch_array($tampil)){
   echo "<tr> 
   <td>$r[tanggal]</td>
   <td>$r[id_transaksi]</td>
   
   <td>$r[asal_bank]</td>
   <td>".format_rupiah($r['jumlah'])."</td>
   <td>$r[pengirim]</td>
   <td>$r[status]</td>
   <td> <div class='btn-group'>
                  <button type='button' class='btn btn-default btn-xs'>Action</button>
                  <button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown'>
                    <span class='caret'></span>
                    <span class='sr-only'>Toggle Dropdown</span>
                  </button>
                  <ul class='dropdown-menu' role='menu'>";
                   if($r['status'] !=='Diterima'){
                      echo"<li><a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=konfirmasi&act=hapus&id=$r[id_konfirmasi]'>Hapus</a></li>";
                    }
                    
                    

                    if($r['status']=='Menunggu'){
                      echo"<li><a href='$aksi?halamane=konfirmasi&act=updatekonfirmasi&id=$r[id_konfirmasi]&status=Diterima'>Diterima</a></li>";
                      echo"<li><a href='$aksi?halamane=konfirmasi&act=updatekonfirmasi&id=$r[id_konfirmasi]&status=Ditolak'>Ditolak</a></li>";
                    }

                  echo"</ul>
                </div>
                </td>
   </tr> ";
	}
                
                echo"</tbody>
                
              </table>
            </div>
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
}
else{ include "halaman/hal_blank/blank.php";}

   break;  

  
  
   case "tambahkonfirmasi":
   if ($_SESSION[level]=='user'){
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Konfirmasi Pembayaran</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=konfirmasi&act=input' enctype='multipart/form-data'>
              <div class='box-body'>";
              if ($_GET['ganda'] =='ya'){
               echo"<div class='alert alert-warning alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Warning!</h4>
                Kode Booking sudah di konfirmasi sebelumnya, mohon menunggu proses approval. 
              </div>";
            }
			 
                echo"<div class='form-group'>
                  <label for='input' class='col-sm-2 control-label'>No Transaksi</label>
                  <div class='col-sm-10'>
                    <input type='text' name='no_transaksi' class='form-control' required='required' placeholder='No Transaksi' maxlength='6'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='input' class='col-sm-2 control-label'>Asal Bank</label>
                  <div class='col-sm-10'>
                  <input type='text' name='asal_bank' class='form-control' required='required' placeholder='Asal Bank' maxlength='10'>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='input' class='col-sm-2 control-label'>Asal No Rekening</label>
                  <div class='col-sm-10'>
                  <input type='number' name='asal_no_rekening' class='form-control' required='required' placeholder='Asal Rekening' maxlength='10'>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='input=' class='col-sm-2 control-label'>Nama Pengirim</label>
                  <div class='col-sm-10'>
                    <input type='text' name='pengirim' class='form-control' required='required' placeholder='pengirim'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='input=' class='col-sm-2 control-label'>Jumlah Transfer</label>
                  <div class='col-sm-10'>
                    <input type='number' name='jumlah' class='form-control' required='required' placeholder='Jumlah Transfer'>
                  </div>
                </div>

               
                
                
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=konfirmasi'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div></div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>"; }
	  
	 
    else{
   echo "<h1>Anda tidak berhak mengakses halaman ini !</h1>";  }
	 
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
