<?php
session_start();
require_once "config/koneksi.php";
require_once "config/library.php";
require_once "config/fungsi_indotgl.php";
require_once "config/fungsi_terbilang.php";
require_once "config/fungsi_rupiah.php";
$tanggal=tgl_indo($tgl_sekarang);
$i=mysql_fetch_array(mysql_query("SELECT * FROM identitas WHERE id_identitas='00'"));
$t=mysql_fetch_array(mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$_GET[id]'"));
$p=mysql_fetch_array(mysql_query("SELECT * FROM member WHERE username='$t[id_pelanggan]'"));
$j=mysql_fetch_array(mysql_query("SELECT * FROM lapangan WHERE id_lapangan='$t[lapangan]'"));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo"$i[nama_identitas]"; ?> | Invoice</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body onLoad="window.print();">
<?php

$duedate = date('Y-m-d', strtotime('+3 days', strtotime($t['tgl_transaksi'])));
$duedate=tgl_indo($duedate);
$terbilang=terbilang($t['total'], $style=4);
?>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <a class="logo">
      <span class="logo-lg"><b><i class="fa fa-fw fa-soccer-ball-o"></i>-<?php echo"$i[nama_identitas]"; ?></b></span>
    </a></i> 
          <small class="pull-right">Tanggal: <?php echo"$tanggal"; ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        Dari
        <address>
          <strong><?php echo"$i[nama_identitas]"; ?></strong><br>
          <?php echo"$i[alamat]"; ?><br>
          Telepon: <?php echo"$i[no_telp]"; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        Kepada
        <address>
          <strong><?php echo"$p[nama_lengkap]"; ?></strong><br>
          <?php echo"$p[alamat]"; ?><br>
          Telepon: <?php echo"$p[no_telp]"; ?><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #<?php echo"$_GET[id]"; ?></b><br>
        <br>
        <b>Status <br/><span class="label label-primary"><?php echo"$t[status]"; ?></span></b>
       
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Lama Sewa</th>
            <th>Harga Per Jam</th>
            <th>Lapangan</th>
            <th>Keterangan</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><?php echo"$t[lama] Jam"; ?></td>
            <td><?php echo"Rp ". format_rupiah($t['harga']); ?></td>
            <td><?php echo"".strtoupper($j['nama_lapangan']).""; ?></td>
            <td>Sewa Lapangan pada Tanggal <?php echo"$t[tanggal_bermain] <br/>Jam Mulai:"; 

            $data=mysql_query("SELECT * FROM pemakaian WHERE id_transaksi='$t[id_transaksi]'");
   while ($x=mysql_fetch_array($data)) {
   //ambil data dari tabel jadwal
  $xx=mysql_fetch_array(mysql_query("SELECT * FROM jadwal WHERE id_jadwal='$x[id_jadwal]'"));
    echo"<br/> $xx[nama_jadwal]";
   }

    ?></td>
            <td><?php echo"Rp ". format_rupiah($t['total']); ?></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Metode Pembayaran:</p> 
        <address>
          <strong>TRANSFER BANK</strong><br>
          <?php echo"$i[rekening]"; ?>
        </address>

         
       
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          <?php echo"$terbilang Rupiah"; ?>
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:77%">Grand total:</th>
              <td><?php echo"Rp ". format_rupiah($t['total']); ?></td>
            </tr>

            <tr>
              <th style="width:77%">DP/Sudah Dibayar</th>
              <td><?php echo"Rp ". format_rupiah($t['dibayar']); ?></td>
            </tr>

            <tr>
              <th style="width:77%">Sisa</th>
              <td><?php echo"Rp ". format_rupiah($t['sisa']); ?></td>
            </tr>
        
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
