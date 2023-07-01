<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Daftar List Jadwal<small></small></h1>
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
       
        <div class='col-xs-12'>
           <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?halamane=jadwal&act=tambahjadwal' class='btn btn-large btn-success'><span>Tambah Data</span></a></h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>Lapangan</th>
                  <th>Penjadwalan</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>";
           
    $tampil = mysql_query("SELECT * FROM jadwal ORDER BY id_jadwal ASC");
    while($r=mysql_fetch_array($tampil)){
   $l=mysql_fetch_array(mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$r[id_lapangan]'"));
   echo "<tr> 
    <td>$l[nama_lapangan]</td>
   <td>$r[nama_jadwal]</td>
  
   
   <td><a href='?halamane=jadwal&act=editjadwal&id=$r[id_jadwal]'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=jadwal&act=hapus&id=$r[id_jadwal]'><span class='badge bg-red'>Hapus</span></a></td>
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
      <!-- /.row -->
    </section>
    <!-- /.content -->";

   break;  

  
  
   case "tambahjadwal":
   if ($_SESSION[level]=='admin'){
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Formulir Tambah Jadwal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=jadwal&act=input' enctype='multipart/form-data'>
              <div class='box-body'>

              <div class='form-group'>
                <label for='inputlevel3' class='col-sm-2 control-label'>Lapangan</label>
                <div class='col-sm-10'>
                <select name='lapangan' class=\"form-control select2\">
                <option value=''>-- Pilih Lapangan --</option>";
                $data= mysql_query("SELECT * FROM lapangan ORDER BY nama_lapangan ASC");
                while($z=mysql_fetch_array($data)){
                echo"<option value='$z[id_lapangan]'>$z[nama_lapangan]</option>";
                }
          
          echo"</select>
                </div>
                </div>

			 
                <div class='form-group'>
                  <label for='inputnama_jadwal3' class='col-sm-2 control-label'>Penjadwalan</label>
                  <div class='col-sm-10'>
                    <select name='nama_jadwal' class=\"form-control select2\">
                <option value=''>-- Pilih waktu --</option>";
                $data= mysql_query("SELECT * FROM waktu ORDER BY nama_waktu ASC");
                while($z=mysql_fetch_array($data)){
                echo"<option>$z[nama_waktu]</option>";
                }
          
          echo"</select>
                  </div>
                </div>

                
                    <input type='hidden' name='remark' class='form-control' value='1'>
                  
                
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=jadwal'>Cancel</a>
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
    
   case "editjadwal":
   $edit=mysql_query("SELECT * FROM jadwal WHERE id_jadwal='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
	  
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Ubah Data jadwal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=jadwal&act=update' enctype='multipart/form-data'>
			<input type=hidden name=id value=$r[id_jadwal]>
              <div class='box-body'>

               <div class='form-group'>
                <label for='inputlevel3' class='col-sm-2 control-label'>Lapangan</label>
                <div class='col-sm-10'>
                <select name='lapangan' class=\"form-control select2\">";
                         $tampil=mysql_query("SELECT * FROM lapangan ORDER BY nama_lapangan");
          if ($r[id_lapangan]==0){
            echo "<option value=0 selected>- Pilih lapangan -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_lapangan]==$w[id_lapangan]){
              echo "<option value=$w[id_lapangan] selected>$w[nama_lapangan]</option>";
            }
            else{
              echo "<option value=$w[id_lapangan]>$w[nama_lapangan]</option>";
            }
          }
                        echo"</select>
                </div>
                </div>
			  
                <div class='form-group'>
                  <label for='inputnama_jadwal3' class='col-sm-2 control-label'>Penjadwalan</label>

                  <div class='col-sm-10'>
                    <select name='nama_jadwal' class=\"form-control select2\">";
                         $tampil=mysql_query("SELECT * FROM waktu ORDER BY nama_waktu");
          if ($r[nama_waktu]==0){
            echo "<option value=0 selected>- Pilih waktu -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[nama_jadwal]==$w[nama_waktu]){
              echo "<option value='$w[nama_waktu]' selected>$w[nama_waktu]</option>";
            }
            else{
              echo "<option value='$w[nama_waktu]'>$w[nama_waktu]</option>";
            }
          }
                        echo"</select>
                  </div>
                </div>


                <input type='hidden' name='remark' class='form-control' value='1'>
                
				
                
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=jadwal'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Save</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div></div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>";}
	
  
	
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
