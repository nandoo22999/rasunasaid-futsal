<?php
error_reporting(0);
session_start();
require_once "config/koneksi.php";
require_once "config/library.php";
require_once "config/fungsi_indotgl.php";
require_once "config/fungsi_rupiah.php";
if (isset($_SESSION['username']) && isset($_SESSION['namauser']) && isset($_SESSION['namalengkap']) && isset($_SESSION['passuser']) && isset($_SESSION['level']))
{
	
$i=mysql_fetch_array(mysql_query("SELECT * FROM identitas WHERE id_identitas='00'"));

$tanggal=date("Y-m-d");
$sq=mysql_query("SELECT * FROM member WHERE tanggal='$tanggal' ORDER BY username ASC");
$jmlh=mysql_num_rows($sq);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Manajemen <?php echo"$i[nama_identitas]"; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
<!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!--####################################################################################################DATE PICKER##################- -->
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
<!--####################################################################################################DATE PICKER##################- -->
   <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<link href='plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />

<link rel="shortcut icon" type="image/x-icon" href="foto_user/favicon.png">
<script language=Javascript>
function isNumberKey(evt)
//Membuat validasi hanya untuk input angka menggunakan kode javascript
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))

return false;
return true;
}
</script>
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php?halamane=home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>FTS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><i class="fa fa-fw fa-soccer-ball-o"></i>-<?php echo"$i[nama_identitas]"; ?></b></i></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>


      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php
               if ($_SESSION['level'] =='admin'){
              ?>
              <img src="<?php echo"foto_user/small_$_SESSION[foto]";?>" class="user-image" alt="User Image">
               <?php
             }
               else{
                echo"<img src=\"foto_user/user.png\" class=\"user-image\" alt=\"User Image\">";
               }
              ?>
              <span class="hidden-xs"><?php echo"$_SESSION[namalengkap]";?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <?php
               if ($_SESSION['level'] =='admin'){
              ?>
              <img src="<?php echo"foto_user/small_$_SESSION[foto]";?>" class="img-circle" alt="User Image">
               <?php
             }
               else{
                echo"<img src=\"foto_user/user.png\" class=\"user-image\" alt=\"User Image\">";
               }
              ?>

                

                <p>
                  <?php echo"$_SESSION[namalengkap]";?>
                  <small>Member since <?php 
				  $l=mysql_fetch_array(mysql_query("SELECT * FROM member WHERE email='$_SESSION[namauser]'"));
				  $tanggal= tgl_indo($l['tanggal']);
				  echo"$tanggal";?></small>
                </p>
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
           <!--  <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
           <a></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <?php
               if ($_SESSION['level'] =='admin'){
              ?>
              <img src="<?php echo"foto_user/small_$_SESSION[foto]";?>" class="img-circle" alt="User Image">
               <?php
             }
               else{
                echo"<img src=\"foto_user/user.png\" class=\"user-image\" alt=\"User Image\">";
               }
              ?>

          
        </div>
        <div class="pull-left info">
          <p><?php echo"$_SESSION[namalengkap]";?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
        <?php
echo"<li class='header'>MAIN NAVIGATION</li>

<li><a href='index.php?halamane=home'><i class='fa fa-home'></i> <span>Home</span></a></li>

</li>";

        //Menu yang ditampilkan ketika login admin
         if ($_SESSION['level'] =='admin'){
        echo"<li class='treeview'>
          <a href='#'>
            <i class='fa fa-user'></i>
            <span>Setting App</span>
            <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
            <li><a href='index.php?halamane=member'><i class='fa fa-circle-o'></i>User Account</a></li>
            <li><a href='index.php?halamane=member&act=akun-member'><i class='fa fa-circle-o'></i>Member Account</a></li>
            <li><a href='index.php?halamane=identitas'><i class='fa fa-circle-o'></i> Identitas Web</a></li></ul>
        </li>

     <li class='treeview'>
          <a href='#'>
            <i class='fa fa-database'></i>
            <span>Master</span>
            <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
         <li><a href='index.php?halamane=lapangan'><i class='fa fa-circle-o'></i> Daftar Lapangan</a></li>
         <li><a href='index.php?halamane=konfirmasi'><i class='fa fa-circle-o'></i> Daftar Konfirmasi</a></li>
          </ul>
        </li>

         <li class='treeview'>
          <a href='#'>
            <i class='fa fa-recycle'></i>
            <span>Transaksi</span>
            <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>

         <li><a href='index.php?halamane=jadwal'><i class='fa fa-circle-o'></i> Penjadwalan</a></li>
         <li><a href='index.php?halamane=pilih-jadwal'><i class='fa fa-circle-o'></i> Jadwal Hari Ini</a></li>
         <li><a href='index.php?halamane=transaksi'><i class='fa fa-circle-o'></i> Rekap Transaksi</a></li>
          </ul>
        </li>


         <li class='treeview'>
          <a href='#'>
            <i class='fa fa-bar-chart'></i>
            <span>Laporan</span>
            <i class='fa fa-angle-left pull-right'></i>
          </a>
          <ul class='treeview-menu'>
         <li><a href='index.php?halamane=laptrans'><i class='fa fa-circle-o'></i> Laporan Transaksi</a></li>
          </ul>";
          
           }
      
       //Menu yang ditampilkan ketika login User
      if ($_SESSION['level'] =='user'){
      echo"<li><a href='index.php?halamane=update-data-member'><i class='fa fa-user'></i> <span>Update Data</span></a></li>";
       echo"<li><a href='index.php?halamane=pilih-jadwal'><i class='fa fa-calendar-times-o'></i> <span>Jadwal Hari Ini</span></a></li>";
       echo"<li><a href='index.php?halamane=transaksi'><i class='fa fa-history'></i> <span>Histori Transaksi</span></a></li>";
       echo"<li><a href='index.php?halamane=konfirmasi&act=tambahkonfirmasi'><i class='fa fa-money'></i> <span>Konfirmasi Pembayaran</span></a></li>";

      }

       echo"<li><a href='logout.php'><i class='fa fa-power-off'></i> <span>Logout</span></a></li>";

       
        ?>
       
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
    <!-- Main content -->
  <?php include "content.php"; ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <div align="center"><b>Versi</b> 1.0
      </div>
    </div>
    <strong>Copyright &copy; 2021 <a href="http://"><?php echo"$i[nama_identitas]"; ?></a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>

<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- ChartJS 1.0.1 -->
<!-- Page Script -->
<script>
  $(function () {
	  //Initialize Select2 Elements
    $(".select2").select2();
	
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<script src='plugins/fullcalendar/fullcalendar.min.js'></script>

<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>

<!-- Page script -->
<script>
  $(function () {
        //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    $('#datepicker1').datepicker({
      autoclose: true
    });

     $('#datepicker2').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>



</body>
</html>

<?php
}
else
{
	lompat_ke("login.html");
}
?>
