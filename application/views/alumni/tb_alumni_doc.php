<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tb_alumni List</h2>
        <table class="word-table" style="margin-bottom: 10px">
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
		
            </tr><?php
            foreach ($alumni_data as $alumni)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $alumni->npm ?></td>
		      <td><?php echo $alumni->nama ?></td>
		      <td><?php echo $alumni->jk ?></td>
		      <td><?php echo $alumni->alamat ?></td>
		      <td><?php echo $alumni->prodi ?></td>
		      <td><?php echo $alumni->angkatan ?></td>
		      <td><?php echo $alumni->id_pekerjaan ?></td>
		      <td><?php echo $alumni->alamat_kantor ?></td>
		      <td><?php echo $alumni->keterangan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>