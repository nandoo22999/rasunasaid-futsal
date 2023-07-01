<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-fw fa-user"></i> Pengaturan Akun Pengguna<small></small></h1>
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
$aksi="halaman/hal_member/aksi_member.php";
switch($_GET[act]){
  // Tampil User
  default:
echo " <section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
           <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?halamane=member&act=tambahmember' class='btn btn-large btn-success'><span>Tambah Data</span></a></h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th><center>Foto</center></th>
                  <th><center>Level</center></th>
                  <th><center>Status</center></th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>";
				   if ($_SESSION[level]=='admin'){
      $tampil = mysql_query("SELECT * FROM member WHERE level='admin' ORDER BY nama_lengkap ASC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM member WHERE username='$_SESSION[namauser]'");
    }
  
    while($r=mysql_fetch_array($tampil)){
   echo "<tr> 
   <td>$r[nama_lengkap]</td>
   <td><a href=mailto:$r[email]>$r[email]</a></td>
   <td><center><img src='foto_user/small_$r[foto]' width=50></center></td>
   <td><center>"; if ($r['level']=='admin'){echo"admin";} if ($r['level']=='user'){echo"user";} echo"</center></td>
   <td><center>"; if ($r['blokir']=='N'){ echo"<span class='label label-success'>Aktif</span>"; } else {echo"<span class='label label-danger'>Block</span>"; } echo"</center></td>
   
   <td><a href='?halamane=member&act=editmember&id=$r[username]'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=member&act=hapus&id=$r[username]&namafile=$r[foto]'><span class='badge bg-red'>Hapus</span></a></td>
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

  case "akun-member":
  echo " <section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
           <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'><a href='?halamane=member&act=tambah-akun-member' class='btn btn-large btn-success'><span>Tambah Data</span></a></h3>
            </div>
            <!-- /.box-header -->
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>No Telp</th>
                   <th>Foto KTP</th>
                  <th><center>Status</center></th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>";
           if ($_SESSION[level]=='admin'){
      $tampil = mysql_query("SELECT * FROM member WHERE level='user' AND username !='0' ORDER BY nama_lengkap ASC");
    }
    else{
      $tampil=mysql_query("SELECT * FROM member WHERE username='$_SESSION[namauser]'");
    }
  
    while($r=mysql_fetch_array($tampil)){
 
   echo "<tr> 
   <td>$r[nama_lengkap]</td>
   <td><a href=mailto:$r[email]>$r[email]</a></td>
   <td>$r[alamat]</td>
   <td>$r[no_telp]</td>
   <td><center>"; if ($r['foto_ktp'] !==''){ echo"<a href='foto_ktp/$r[foto_ktp]' target='_blank'>View</a>"; } echo"</center></td>
   <td><center>"; if ($r['blokir']=='N'){ echo"<span class='label label-success'>Aktif</span>"; } else {echo"<span class='label label-danger'>Block</span>"; } echo"</center></td>
   
   <td><a href='?halamane=member&act=edit-akun-member&id=$r[username]'><span class='badge bg-blue'>Edit</span></a>
       <a onclick=\"return confirm('Are sure want to delete this data ??')\" href='$aksi?halamane=member&act=hapus-akun-member&id=$r[username]&namafile=$r[foto_ktp]'><span class='badge bg-red'>Hapus</span></a></td>
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

   case "tambah-akun-member":
   if ($_SESSION[level]=='admin'){
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
    <div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Formulir Pendaftaran Member Baru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=member&act=input-akun-member' enctype='multipart/form-data'>
              <div class='box-body'>
        
        <div class='form-group'>
                  <label for='nama_lengkap' class='col-sm-2 control-label'>Nama Lengkap</label>
                  <div class='col-sm-10'>
                    <input type='text' name='nama_lengkap' class='form-control' required='required' placeholder='Nama Lengkap'>
                  </div>
                </div>
        
                <div class='form-group'>
                  <label for='inputEmail3' class='col-sm-2 control-label'>Email</label>
                  <div class='col-sm-10'>
                    <input type='email' name='email' class='form-control'  required='required' placeholder='Email'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputPassword3' class='col-sm-2 control-label'>Password</label>
                  <div class='col-sm-10'>
                    <input type='password' name='password' class='form-control'  required='required' placeholder='Password'>
                  </div>
                </div>

                <div class='form-group'>
                  <label for='inputPassword3' class='col-sm-2 control-label'>Alamat</label>
                  <div class='col-sm-10'>
                  <textarea class=\"form-control\" rows=\"3\" name=\"alamat\" placeholder=\"Alamat ...\" required='required'></textarea>
                   </div>
                </div>

                <div class='form-group'>
                  <label for='inputEmail3' class='col-sm-2 control-label'>No Telp</label>
                  <div class='col-sm-10'>
                    <input type='number' name='no_telp' class='form-control'  required='required' placeholder='No Telp' onkeypress=\"return isNumberKey(event)\">
                  </div>
                </div>


        <div class='form-group'>
                  <label for='exampleInputFile' class='col-sm-2 control-label'>Foto KTP</label>
                  <input type='file' name='fupload' id='exampleInputFile' required='required'>Upload Foto KTP Anda Disini.
                </div>
        
              
        
              <!-- /.box-body -->
              <div class='box-footer'>
        <a class='btn btn-default' href='?halamane=member&act=akun-member'>Cancel</a>
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


   case "tambahmember":
   if ($_SESSION[level]=='admin'){
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Formulir Pendaftaran Pegawai</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=member&act=input' enctype='multipart/form-data'>
              <div class='box-body'>
			  <div class='form-group'>
                  <label for='nama_lengkap' class='col-sm-2 control-label'>Name</label>

                  <div class='col-sm-10'>
                    <input type='text' name='nama_lengkap' class='form-control' id='nama_lengkap' placeholder='Full Name'>
                  </div>
                </div>
				
                <div class='form-group'>
                  <label for='inputEmail3' class='col-sm-2 control-label'>Email</label>
                  <div class='col-sm-10'>
                    <input type='email' name='email' class='form-control' id='inputEmail3' placeholder='Email'>
                  </div>
                </div>
                <div class='form-group'>
                  <label for='inputPassword3' class='col-sm-2 control-label'>Password</label>

                  <div class='col-sm-10'>
                    <input type='password' name='password' class='form-control' id='inputPassword3' placeholder='Password'>
                  </div>
                </div>
				<div class='form-group'>
                  <label for='exampleInputFile' class='col-sm-2 control-label'>Foto</label>
                  <input type='file' name='fupload' id='exampleInputFile'>Upload Foto disni
                </div>
				
                <div class='form-group'>
                  <label for='inputlevel3' class='col-sm-2 control-label'>Level</label>
                  <div class='col-sm-10'>
                    <select name='level' class=\"form-control\">
		  <option value='admin'>Admin</option>";
           
     echo "</select>
                  </div>
                </div>
				
              <!-- /.box-body -->
              <div class='box-footer'>
			  <a class='btn btn-default' href='?halamane=member'>Cancel</a>
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
    
   case "editmember":
   $edit=mysql_query("SELECT * FROM member WHERE username='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
	  
   echo "<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Form Ubah Data Member</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class='form-horizontal' method='POST' action='$aksi?halamane=member&act=update' enctype='multipart/form-data'>
			<input type=hidden name=id value=$r[username]>
              <div class='box-body'>
			  <div class='form-group'>
                  <label for='nama_lengkap' class='col-sm-2 control-label'>Name</label>

                  <div class='col-sm-10'>
                    <input type='text' name='nama_lengkap' class='form-control' id='nama_lengkap' placeholder='Full Name' value='$r[nama_lengkap]'>
                  </div>
                </div>
				
                <div class='form-group'>
                  <label for='inputEmail3' class='col-sm-2 control-label'>Email</label>

                  <div class='col-sm-10'>
                    <input type='email' name='email' class='form-control' id='inputEmail3' placeholder='Email' value='$r[email]'>
                  </div>
                </div>
                <div class='form-group'>
                  <label for='inputPassword3' class='col-sm-2 control-label'>Password</label>

                  <div class='col-sm-10'>
                    <input type='password' name='password' class='form-control' id='inputPassword3' placeholder='Password'>
                  </div>
                </div>
				<div class='form-group'>
				<img src='foto_user/small_$r[foto]' width=100>
                  <label for='exampleInputFile' class='col-sm-2 control-label'>Foto</label>
                  

                </div>
				<div class='form-group'>
                  <label for='exampleInputFile' class='col-sm-2 control-label'>Upload</label>
                  <input type='file' name='fupload' id='exampleInputFile'>Ganti Foto disni
                </div>
				
				<div class='form-group'>
                  <label for='inputlevel3' class='col-sm-2 control-label'>Level</label>
                  <div class='col-sm-10'>
                   <select name='level' class=\"form-control\">
                   <option value='admin'>Admin</option>";
         
			echo"</select>
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
			  <a class='btn btn-default' href='?halamane=member'>Cancel</a>
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


case "edit-akun-member":
   $edit=mysql_query("SELECT * FROM member WHERE username='$_GET[id]'");
   $r=mysql_fetch_array($edit);
   if($_SESSION[level]=='admin'){
    
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
      <input type=hidden name=id value=$r[username]>
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
        <a class='btn btn-default' href='?halamane=member&act=akun-member'>Cancel</a>
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
