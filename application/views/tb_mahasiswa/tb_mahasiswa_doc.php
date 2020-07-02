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
        <h2>Tb_mahasiswa List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Npm</th>
		<th>Nama</th>
		<th>Jk</th>
		<th>Prodi</th>
		
            </tr><?php
            foreach ($tb_mahasiswa_data as $tb_mahasiswa)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tb_mahasiswa->npm ?></td>
		      <td><?php echo $tb_mahasiswa->nama ?></td>
		      <td><?php echo $tb_mahasiswa->jk ?></td>
		      <td><?php echo $tb_mahasiswa->prodi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>