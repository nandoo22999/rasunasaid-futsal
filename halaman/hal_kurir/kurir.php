<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data kurir<small></small></h1>
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
$aksi="halaman/hal_kurir/aksi_kurir.php";
switch($_GET[act]){
  // Tampil User
  default:
echo " <section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
           <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?halamane=kurir&act=tambahkurir' class='btn btn-large btn-success'><span>Tambah Data</span></a></h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>id_kurir</th>
                  <th>Nama kurir</th>
                  <th>No KTP</th>
                  <th>Alamat</th>
                  <th>Jenis Kelamin</th>
                  <th>Pendidikan</th>
                  <th>No HP</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>";
				   
      $tampil = mysql_query("SELECT * FROM kurir ORDER BY id_kurir ASC");
  
    while($r=mysql_fetch_array($tampil)){
   echo "<tr> 
   <td>$r[id_kurir]</td>
   <td>$r[nama_kurir]</td>
   <td>$r[no_ktp]</td>
   <td>$r[alamat]</td>
   <td>$r[jenis_kelamin]</td>
   <td>$r[pendidikan]</td>
   <td>$r[no_hp]</td>
   <td><a href='?halamane=kurir&act=editkurir&id=$r[id_kurir]'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=kurir&act=hapus&id=$r[id_kurir]'><span class='badge bg-red'>Hapus</span></a></td>
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

   break;  

  
  
   case "tambahkurir":
   if ($_SESSION[level]=='admin'){
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Tambah kurir</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=kurir&act=input' enctype='multipart/form-data'>
              <div class='box-body'>
			 
                <div class='form-group'>
                  <label for='inputnama_kurir3' class='col-sm-2 control-label'>Nama kurir</label>
                  <div class='col-sm-10'>
                    <input type='text' name='nama_kurir' class='form-control' id='inputnama_kurir3' placeholder='Nama kurir'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputno_ktp' class='col-sm-2 control-label'>no_ktp</label>
                  <div class='col-sm-10'>
                    <input type='text' name='no_ktp' class='form-control' id='inputno_ktp' placeholder='no_ktp'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputalamat' class='col-sm-2 control-label'>alamat</label>
                  <div class='col-sm-10'>
                    <input type='text' name='alamat' class='form-control' id='inputalamat' placeholder='alamat'>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='inputalamat' class='col-sm-2 control-label'>jenis_kelamin</label>
                  <div class='col-sm-10'>
                    <select name='jenis_kelamin' class=\"form-control\">
 <option value=''>-- Pilih Jenis Kelamin --</option>";
                $data= mysql_query("SELECT * FROM keterangan WHERE remark='JK' ORDER BY nama_keterangan ASC");
                while($z=mysql_fetch_array($data)){
                echo"<option value='$z[nama_keterangan]'>$z[nama_keterangan]</option>";
                }
          
          echo"</select>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputalamat' class='col-sm-2 control-label'>pendidikan</label>
                  <div class='col-sm-10'>
                     <select name='pendidikan' class=\"form-control\">
 <option value=''>-- Pilih Pendidikan --</option>";
                $data= mysql_query("SELECT * FROM keterangan WHERE remark='Pendidikan' ORDER BY id_keterangan ASC");
                while($z=mysql_fetch_array($data)){
                echo"<option value='$z[nama_keterangan]'>$z[nama_keterangan]</option>";
                }
          
          echo"</select>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='inputno_hp' class='col-sm-2 control-label'>No HP</label>
                  <div class='col-sm-10'>
                    <input type='text' name='no_hp' class='form-control' id='inputno_hp' placeholder='no_hp'>
                  </div>
                </div>

                
                
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=kurir'>Cancel</a>
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
    
   case "editkurir":
   $edit=mysql_query("SELECT * FROM kurir WHERE id_kurir='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
	  
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Ubah Data kurir</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=kurir&act=update' enctype='multipart/form-data'>
			<input type=hidden name=id value=$r[id_kurir]>
              <div class='box-body'>
			  
                <div class='form-group'>
                  <label for='inputnama_kurir3' class='col-sm-2 control-label'>Nama kurir</label>

                  <div class='col-sm-10'>
                    <input type='text' name='nama_kurir' class='form-control' id='inputnama_kurir3' placeholder='Nama kurir' value='$r[nama_kurir]'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputno_ktp' class='col-sm-2 control-label'>no_ktp</label>
                  <div class='col-sm-10'>
                    <input type='text' name='no_ktp' class='form-control' id='inputno_ktp' placeholder='no_ktp' value='$r[no_ktp]'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputalamat' class='col-sm-2 control-label'>alamat</label>
                  <div class='col-sm-10'>
                    <input type='text' name='alamat' class='form-control' id='inputno_ktp' placeholder='alamat' value='$r[alamat]'>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='inputalamat' class='col-sm-2 control-label'>jenis_kelamin</label>
                  <div class='col-sm-10'>
                    <select name='jenis_kelamin' class=\"form-control\">";
       $tampil=mysql_query("SELECT * FROM keterangan WHERE remark='JK' ORDER BY nama_keterangan");
          if ($r[jenis_kelamin]==0){
            echo "<option value=0 selected>- Pilih Jenis Kelamin -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[jenis_kelamin]==$w[nama_keterangan]){
              echo "<option value=$w[nama_keterangan] selected>$w[nama_keterangan]</option>";
            }
            else{
              echo "<option value=$w[nama_keterangan]>$w[nama_keterangan]</option>";
            }
          }
      echo"</select>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputalamat' class='col-sm-2 control-label'>pendidikan</label>
                  <div class='col-sm-10'>
                    <select name='pendidikan' class=\"form-control\">";
       $tampil=mysql_query("SELECT * FROM keterangan WHERE remark='Pendidikan' ORDER BY id_keterangan");
          if ($r[pendidikan]==0){
            echo "<option value=0 selected>- Pilih Pendidikan -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[pendidikan]==$w[nama_keterangan]){
              echo "<option value=$w[nama_keterangan] selected>$w[nama_keterangan]</option>";
            }
            else{
              echo "<option value=$w[nama_keterangan]>$w[nama_keterangan]</option>";
            }
          }
      echo"</select>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='inputno_hp' class='col-sm-2 control-label'>No HP</label>
                  <div class='col-sm-10'>
                    <input type='text' name='no_hp' class='form-control' id='inputno_hp' placeholder='no_hp' value='$r[no_hp]'>
                  </div>
                </div>

                
				
                
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=kurir'>Cancel</a>
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
