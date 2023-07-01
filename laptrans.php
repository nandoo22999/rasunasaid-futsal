<section class='content'>
      <div class='row'>
        <div class='col-xs-12'>
		<div class='box box-info'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Laporan Berdasarkan Kriteria</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <div class="box-body">
           <form method="post" action="report_transaksi.php">
						<table class="table table-bordered table-striped">
							<tr>
								<td align="center"><input type="radio" name="berdasar" class="flat-red" value="Semua Data" checked="">
								<td>Semua Data</td>
							</tr>
							<tr>
								<td align="center"><input type="radio" name="berdasar" class="flat-red" value="Tanggal"></td>
								<td>Tanggal<br/><br/>
								 <div class="col-xs-5">
                			 <input type="text" placeholder='Dari Tanggal' class="form-control" id="datepicker" name="dari">
               					 </div>

               					  <div class="col-xs-5">
                			 <input type="text" placeholder='Sampai Tanggal' class="form-control" id="datepicker1" name="ke">
               					 </div>
									
									</td>
							</tr>

							<tr>
								<td align="center"><input type="radio" name="berdasar" class="flat-red" value="Pencarian Kata"></td>
								<td>Pencarian Kriteria<br/><br/>
			<div class="col-xs-3">					
		<select name="field" class="form-control">
        <option>Pilih Field</option>
          <option value="id_transaksi">No Transaksi</option>
          <option value="id_pelanggan">Kode Pelanggan</option>
      </select> 
 </div>
 <div class="col-xs-3">
      <input name="kata" type="text" class="form-control"/>
       </div>
								</td>
							</tr>

							
							
							<tr>
								<td></td>
								<td><input type="submit" name="Submit" class="btn btn-primary" value="Tampilkan" /></td>
								
							</tr>
							
						</table>
						</form>
</div>

          </div></div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>