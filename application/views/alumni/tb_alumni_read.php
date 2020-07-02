<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <h2 style="margin-top:0px">Update Data Alumni</h2>
        <table class="table">
	    <tr><td>Npm</td><td><?php echo $npm; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
	    <tr><td>Jk</td><td><?php echo $jk; ?></td></tr>
	    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
	    <tr><td>Prodi</td><td><?php echo $prodi; ?></td></tr>
	    <tr><td>Angkatan</td><td><?php echo $angkatan; ?></td></tr>
	    <tr><td>Id Pekerjaan</td><td><?php echo $id_pekerjaan; ?></td></tr>
	    <tr><td>Alamat Kantor</td><td><?php echo $alamat_kantor; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('alumni') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
         </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->