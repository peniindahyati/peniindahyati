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
        <h2 style="margin-top:0px">Data Alumni</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('alumni/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('alumni/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('alumni'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Npm</th>
		<th>Nama</th>
		<th>Jk</th>
		<th>Alamat</th>
		<th>Prodi</th>
		<th>Angkatan</th>
		<th>Id Pekerjaan</th>
		<th>Alamat Kantor</th>
		<th>Keterangan</th>
		<th>Action</th>
            </tr><?php
            foreach ($alumni_data as $alumni)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $alumni->npm ?></td>
			<td><?php echo $alumni->nama ?></td>
			<td><?php echo $alumni->jk ?></td>
			<td><?php echo $alumni->alamat ?></td>
			<td><?php echo $alumni->prodi ?></td>
			<td><?php echo $alumni->angkatan ?></td>
			<td><?php echo $alumni->id_pekerjaan ?></td>
			<td><?php echo $alumni->alamat_kantor ?></td>
			<td><?php echo $alumni->keterangan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('alumni/read/'.$alumni->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('alumni/update/'.$alumni->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('alumni/delete/'.$alumni->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('alumni/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('alumni/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
   </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->