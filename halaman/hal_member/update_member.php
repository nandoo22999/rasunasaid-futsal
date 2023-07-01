<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-fw fa-user"></i> User Account Setting<small></small></h1>
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
$aksi="halaman/hal_member/aksi_akun_member.php";
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil User
  default:
$edit=mysql_query("SELECT * FROM member WHERE username='$_SESSION[username]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION['level']=='user'){
    
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
    <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Ubah Data Member</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=member&act=update-akun-member' enctype='multipart/form-data'>
      <input type=hidden name=id value=$_SESSION[username]>
              <div class='box-body'>

        <div class='form-group'>
                  <label for='nama_lengkap' class='col-sm-2 control-label'>Name</label>
                  <div class='col-sm-10'>
                    <input type='text' name='nama_lengkap' class='form-control' required='required' placeholder='Full Name' value='$r[nama_lengkap]'>
                  </div>
                </div>
        
                <div class='form-group'>
                  <label for='inputEmail3' class='col-sm-2 control-label'>Email</label>
                  <div class='col-sm-10'>
                    <input type='email' name='email' class='form-control' required='required' placeholder='Email' value='$r[email]'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputPassword3' class='col-sm-2 control-label'>Password</label>
                  <div class='col-sm-10'>
                    <input type='password' name='password' class='form-control' id='inputPassword3' placeholder='Password'>
                  </div>
                </div>

                 <div class='form-group'>
                  <label for='inputPassword3' class='col-sm-2 control-label'>Alamat</label>
                  <div class='col-sm-10'>
                  <textarea class=\"form-control\" rows=\"3\" name=\"alamat\" placeholder=\"Alamat ...\" required='required'>$r[alamat]</textarea>
                   </div>
                </div>

                <div class='form-group'>
                  <label for='inputEmail3' class='col-sm-2 control-label'>No Telp</label>
                  <div class='col-sm-10'>
                    <input type='number' name='no_telp' class='form-control' required='required' placeholder='No Telp' onkeypress=\"return isNumberKey(event)\" value='$r[no_telp]'>
                  </div>
                </div>

        <div class='form-group'>
        <img src='foto_ktp/small_$r[foto_ktp]' width=100>
                  <label for='exampleInputFile' class='col-sm-2 control-label'>Foto KTP</label>
                </div>
        <div class='form-group'>
                  <label for='exampleInputFile' class='col-sm-2 control-label'>Upload</label>
                  <input type='file' name='fupload' id='exampleInputFile'>Ganti Foto disni
                </div>
        
  
        
    
                
              <!-- /.box-body -->
              <div class='box-footer'>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
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
