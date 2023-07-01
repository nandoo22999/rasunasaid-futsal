<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data lapangan<small></small></h1>
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
$aksi="halaman/hal_lapangan/aksi_lapangan.php";
switch($_GET[act]){
  // Tampil User
  default:
echo " <section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
           <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?halamane=lapangan&act=tambahlapangan' class='btn btn-large btn-success'><span>Tambah Data</span></a></h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>id_lapangan</th>
                  <th>Nama lapangan</th>
                   <th>Harga/Jam</th>
                  <th><center>Status</center></th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>";
				   
      $tampil = mysql_query("SELECT * FROM lapangan ORDER BY id_lapangan ASC");
  
    while($r=mysql_fetch_array($tampil)){
   echo "<tr> 
   <td>$r[id_lapangan]</td>
   <td>$r[nama_lapangan]</td>
    <td>$r[harga]</td>
   <td><center>"; if ($r['blokir']=='N'){ echo"<span class='label label-success'>Aktif</span>"; } else {echo"<span class='label label-danger'>Block</span>"; } echo"</center></td>
   
   <td><a href='?halamane=lapangan&act=editlapangan&id=$r[id_lapangan]'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=lapangan&act=hapus&id=$r[id_lapangan]'><span class='badge bg-red'>Hapus</span></a></td>
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

  
  
   case "tambahlapangan":
   if ($_SESSION[level]=='admin'){
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Formulir Tambah Data lapangan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=lapangan&act=input' enctype='multipart/form-data'>
              <div class='box-body'>
			 
                <div class='form-group'>
                  <label for='inputnama_lapangan3' class='col-sm-2 control-label'>Nama lapangan</label>
                  <div class='col-sm-10'>
                    <input type='text' name='nama_lapangan' class='form-control' id='inputnama_lapangan3' placeholder='Nama lapangan'>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='inputharga' class='col-sm-2 control-label'>Harga/jam</label>
                  <div class='col-sm-10'>
                    <input type='text' name='harga' class='form-control' id='inputiharga' placeholder='Harga'>
                  </div>
                </div>
                
                
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=lapangan'>Cancel</a>
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
    
   case "editlapangan":
   $edit=mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
	  
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Ubah Data lapangan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=lapangan&act=update' enctype='multipart/form-data'>
			<input type=hidden name=id value=$r[id_lapangan]>
              <div class='box-body'>
			  
                <div class='form-group'>
                  <label for='inputnama_lapangan3' class='col-sm-2 control-label'>Nama lapangan</label>

                  <div class='col-sm-10'>
                    <input type='text' name='nama_lapangan' class='form-control' id='inputnama_lapangan3' placeholder='Nama lapangan' value='$r[nama_lapangan]'>
                  </div>
                </div>


                <div class='form-group'>
                  <label for='inputharga' class='col-sm-2 control-label'>Harga</label>

                  <div class='col-sm-10'>
                    <input type='text' name='harga' class='form-control' id='inputharga' placeholder='Harga' value='$r[harga]'>
                  </div>
                </div>
                
				<div class='form-group'>
				<label for='exampleInputFile' class='col-sm-2 control-label'>Blokir</label>";
		  
	
    if ($r['blokir']=='N'){
      echo "<input type=radio name='blokir' value='Y'> Ya   
		    <input type=radio name='blokir' value='N' checked> Tidak";}
    else{
      echo "<input type=radio name='blokir' value='Y' checked> Ya  
            <input type=radio name='blokir' value='N'> Tidak </td></tr>";}
										  
	 
	echo "</div>
				
                
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=lapangan'>Cancel</a>
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
