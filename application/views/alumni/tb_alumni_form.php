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
        <h2 style="margin-top:0px"><?php echo $button ?>Data Alumni</h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Npm <?php echo form_error('npm') ?></label>
            <input type="text" class="form-control" name="npm" id="npm" placeholder="Npm" value="<?php echo $npm; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jk <?php echo form_error('jk') ?></label>
            <input type="text" class="form-control" name="jk" id="jk" placeholder="Jk" value="<?php echo $jk; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Prodi <?php echo form_error('prodi') ?></label>
            <input type="text" class="form-control" name="prodi" id="prodi" placeholder="Prodi" value="<?php echo $prodi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Angkatan <?php echo form_error('angkatan') ?></label>
            <input type="text" class="form-control" name="angkatan" id="angkatan" placeholder="Angkatan" value="<?php echo $angkatan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Id Pekerjaan <?php echo form_error('id_pekerjaan') ?></label>
            <input type="text" class="form-control" name="id_pekerjaan" id="id_pekerjaan" placeholder="Id Pekerjaan" value="<?php echo $id_pekerjaan; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat_kantor">Alamat Kantor <?php echo form_error('alamat_kantor') ?></label>
            <textarea class="form-control" rows="3" name="alamat_kantor" id="alamat_kantor" placeholder="Alamat Kantor"><?php echo $alamat_kantor; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="keterangan">Keterangan <?php echo form_error('keterangan') ?></label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('alumni') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->