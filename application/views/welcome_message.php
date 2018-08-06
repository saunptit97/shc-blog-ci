<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('css/dataTables.bootstrap.min.css') ?>"/>
	<style type="text/css">
		body{
			padding-top: 50px;
		}
	</style>
	<script src="<?php echo base_url('js/jquery-2.2.3.min.js') ?>"></script>
	<script src="<?php echo base_url('js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?php echo base_url('js/dataTables.bootstrap.min.js') ?>"></script>
</head>
<body>
	<div class="row">
		<div class="container">
			<div class="col-md-6">
				<div id="message"></div>
				<?php echo form_open('welcome', array('id'=>'mahasiswa')); ?>
				<div class="form-group">
					<label>NIM</label>
					<input type="text" name="niam" class="form-control" placeholder="NIM"/>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="nama" class="form-control" placeholder="Nama"/>
				</div>
				<div class="form-group">
					<label>Kelamin</label>
					<select name="kelamin" class="form-control">
						<option value="">Pilih Kelamin</option>
						<option value="L">Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Telepon</label>
					<input type="text" name="telp" class="form-control" placeholder="Telepon"/>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="alamat" class="form-control" cols="30" rows="3" placeholder="Alamat"></textarea>
				</div>
				<button type="button" class="btn btn-primary save" onclick="simpan_mhs()">Simpan</button>
				<button type="button" class="btn btn-success update" disabled="disabled" onclick="ubah_mhs()">Ubah</button>
				<?php echo form_close(); ?>
			</div>
		</div>
		<div class="container">
			<div class="col-md-12">
				<h3 class="page-header">Tampil Data</h3>
				<table id="data_mahasiswa" class="table table-hover">
					<thead>
						<tr>
							<th>NIM</th>
							<th>Nama</th>
							<th>Kelamin</th>
							<th>Telp</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function simpan_mhs() {
			$.ajax({
				url: "<?php echo site_url('welcome/simpan') ?>",
				type: 'POST',
				dataType: 'json',
				data: $('#mahasiswa').serialize(),
				encode:true,
				success:function(data) {
					if(!data.success){
						if(data.errors){
							$('#message').html(data.errors).addClass('alert alert-danger');
						}
					}else {
						alert(data.message);
						setTimeout(function() {
							window.location.reload()
						}, 400);
					}
				}
			})
		}
	</script>
</body>
</html>