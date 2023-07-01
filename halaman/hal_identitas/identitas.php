<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Data identitas<small></small></h1>
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
$aksi="halaman/hal_identitas/aksi_identitas.php";
switch($_GET[act]){
  // Tampil User
  default:
 $edit=mysql_query("SELECT * FROM identitas WHERE id_identitas='00'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
    
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
    <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Formulir Ubah Data identitas</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=identitas&act=update' enctype='multipart/form-data'>
      <input type=hidden name='id' value='00'>
              <div class='box-body'>
        
                <div class='form-group'>
                  <label for='inputnama_identitas3' class='col-sm-2 control-label'>Nama identitas</label>

                  <div class='col-sm-10'>
                    <input type='text' name='nama_identitas' class='form-control' required='required' id='inputnama_identitas3' placeholder='Nama identitas' value='$r[nama_identitas]'>
                  </div>
                </div>


                <div class='form-group'>
                  <label for='inputalamat' class='col-sm-2 control-label'>Alamat</label>

                  <div class='col-sm-10'>
                    <input type='text' name='alamat' class='form-control' id='inputalamat' required='required' placeholder='Alamat' value='$r[alamat]'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputno_telp' class='col-sm-2 control-label'>No Telp</label>

                  <div class='col-sm-10'>
                    <input type='text' name='no_telp' class='form-control' id='inputno_telp' required='required' placeholder='no_telp' value='$r[no_telp]'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='email' class='col-sm-2 control-label'>Email</label>

                  <div class='col-sm-10'>
                    <input type='email' name='email' class='form-control' required='required' id='email' placeholder='Email' value='$r[email]'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputrekening' class='col-sm-2 control-label'>Rekening</label>

                  <div class='col-sm-10'>

                     <textarea name='rekening' required='required' class='textarea' placeholder='No Rekening' style='width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;'>$r[rekening]</textarea>
              
                  </div>
                </div>
                
        
                
              <!-- /.box-body -->
              <div class='box-footer'>
        <a class='btn btn-default' href='?halamane=identitas'>Cancel</a>
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
