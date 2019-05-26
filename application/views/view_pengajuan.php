<?php defined('BASEPATH') OR exit('No direct script access allowed');
//
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Aplikasi Cuti Online</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css'); ?>">
		<script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>
		<script src="<?php echo base_url('/assets/jquery.min.js'); ?>"></script>
		<script  src="<?php echo base_url('/assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('/assets/jquery-ui.js'); ?>"></script>
		<script>
		$( function() {
		$( "#datepicker" ).datepicker({
		altFormat: "yyyy-mm-dd"
		});
		$( "#datepicker2" ).datepicker({
		altFormat: "yyyy-mm-dd"
		});
		} );
		</script>
		<script type="text/javascript">
			
		$(document).ready(function(){
			$(".modf").click(function(){
				$("#exampleModal").modal("show");
			});

			$(".out").click(function(){
				$("#exampleModal").modal("hide");
			});



		});
		</script>
		<link rel="stylesheet" href="<?php echo base_url('/assets/jquery-ui.css'); ?>">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			
		
		.active{
			background-color: tomato!important;
		}
		.ad{
			color: #ffff!important;
			padding: 20px!important;
			font-size: small;
		}
		a:link {
		text-decoration: none;
		color: #000;
		}
		a:visited {
		text-decoration: none;
		color: #000;
		}
		a:hover {
		text-decoration: none;
		color: #000;
		}
		a:active {
		text-decoration: none;
		color: #000;
		}
		.judul h4{
			margin:0px!important;
			color: #ffff;
		}
		.judul{
			border-left: solid tomato 7px;
			border-bottom: solid #343a40 1px;
			display: flex;
			justify-content: space-between;
			padding: 20px;
		}
		.form_aju .row, .wow div{
			padding: 10px;
		}
		</style>
	</head>
	<body style="background: #ddd;">
		<div class="container">
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Daftar Atasan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<ul class="list-group">
								<?php
									foreach ($atasan as $key => $value) {
								?>
								<li class="list-group-item d-flex align-items-center" onclick="setNIP('<?php echo $value["nip"] ?>')" style="cursor: pointer;">
									<span style="display: inline-block;"><?php echo $value["nama"]; ?></span>
									<span style="margin-left: 10px;"><?php echo $value["jabatan"]; ?></span>
								</li>
								<?php
								}
								?>
								
							</ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary out">Pilih</button>
						</div>
					</div>
				</div>
			</div>
			<div class="judul bg-dark">
				<h4>Aplikasi Pengajuan Cuti Online</h4>
				<a style="margin-left: auto;" href="<?php echo base_url('menu'); ?>"><button class="btn btn-primary"><span style="color: #fff;" class="fas fa-arrow-left"></span></button></a>
				<a style="margin-left: 10px;"  href="<?php echo base_url('login/keluar'); ?>"><button class="btn btn-danger" ><span style="color: #fff;" class="fas fa-sign-out-alt"></span></button></a>
			</div>
			<nav style="padding: 0px;" class="navbar navbar-expand-sm bg-dark navbar-light">
				<ul class="navbar-nav">
					<li class="nav-option active">
						<a class="ad nav-link" href="<?php echo base_url('cuti/pegawai'); ?>">Form Pengajuan</a>
					</li>
					<li class="nav-option">
						<a class="ad nav-link" href="<?php echo base_url('cuti/daftar_cuti'); ?>">Data Pengajuan</a>
					</li>

				</ul>
			</nav>
			<form  enctype="multipart/form-data" action="<?php echo base_url('cuti/kirim_pengajuan'); ?>"  method="post">
			<div class="container" style="padding: 20px!important; background-color:#fff;">
				<div class="row">
					<div class="col-md-6 col-sm-12">
						
							<div class="form_aju">
							<div class="row">
								<div class="col-md-3">
									Sisa Cuti
								</div>
								<div class="col-md-9">
									<?php
										if($cuti == null)
										{
											echo "12";
											$sisa = 12;
										}
										else
										{
											foreach ($cuti as $key => $value) {
												echo 12-$value["jumlah"];
												$sisa = 12-$value["jumlah"];
											}
										}
										
									?>
									<input type="hidden" value="<?php echo $sisa; ?>" name="kuota" id="kuota">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									Saldo Cuti <?php echo date("Y"); ?>
								</div>
								<div class="col-md-9">
									12
									<input type="hidden" name="nip_atasan" id="nip_atasan">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									Jenis Cuti
								</div>
								<div class="col-md-9">
									<select class="form-control" name="jenis">
										<option>Cuti Tahunan</option>
										<option>Cuti Alasan Penting</option>
										<option>Cuti Sakit</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div style="padding: 10px;" class="col-md-3">
									Tgl Cuti
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-6">

											<input name="mulai" id="datepicker" class="form-control tanggal" type="text" placeholder="Tanggal Mulai">
											<small  class="form-text text-muted"><?php echo form_error('mulai'); ?></small>
										</div>
										<div class="col-md-6">
											<input name="selesai" id="datepicker2" class="form-control tanggal" type="text" placeholder="Tanggal Selesai">
											<small  class="form-text text-muted"><?php echo form_error('selesai'); ?></small>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div style="padding: 10px;" class="col-md-3">
									<span class="align-options-center">Lama Cuti</span>
								</div>
								<div class="col-md-9">
									<div class="row">
										<div class="col-md-8">
											<input min="1" max="<?php echo $sisa; ?>" name="lama" class="form-control" type="number" placeholder="Masukan Lama Hari">
											<small  class="form-text text-muted"><?php echo form_error('lama'); ?></small>
										</div>
										<div class="col-md-4">
											Hari Kerja
										</div>
									</div>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									Tempat Cuti
								</div>
								<div class="col-md-9">
									<select class="form-control" name="tempat">
										<option>Dalam Negeri</option>
										<option>Luar Negeri</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									Keperluan
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<textarea class="form-control" rows="5" id="comment" name="keperluan"></textarea>
										<small  class="form-text text-muted"><?php echo form_error('keperluan'); ?></small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									Alamat Dan Nomor Telpon
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<textarea class="form-control" rows="5" name="alamat" id="comment"></textarea>
										<small  class="form-text text-muted"><?php echo form_error('alamat'); ?></small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									Upload Dokumen
								</div>
								<div class="col-md-9">
									<div class="form-group">
										<input type="file" class="form-control-file" id="exampleFormControlFile1" name="dokumen">
										<small  class="form-text">Max File Size 950kb. Format : jpeg,png,pdf,gif</small>
										<small  class="form-text text-muted"><?php echo form_error('dokumen'); ?></small>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
						foreach ($pegawai as $key => $value) {
							$nip = $value["nip"];
							$nama = $value["nama"];
							$jabatan = $value["jabatan"];
							$golongan = $value["golongan"];
							$unit_kerja = $value["unit_kerja"];
						}
					?>
					<div class="col-md-6 col-sm-12 wow">
						<div class="row">
							<div class="col-md-12">
								<h5 class="text-success">Keterangan Pegawai</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								Nama
							</div>
							<div class="col-md-9">
								<?php echo $nama; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								NIP
							</div>
							<div class="col-md-9">
								<?php echo $nip; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								Jabatan
							</div>
							<div class="col-md-9">
								<?php echo $jabatan; ?>
							</div>
						</div>
						<div class="row">
							<div style="padding: 10px;" class="col-md-3">
								Golongan
							</div>
							<div class="col-md-9">
								<?php echo $golongan; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								Unit Kerja
							</div>
							<div class="col-md-9">
								<?php echo $unit_kerja; ?>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-9">
								<h5 class="text-success">Keterangan Atasan</h5>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn modf btn-info" data-toggle="modal" data-target="#myModal">Pilih Atasan</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								Nama
							</div>
							<div class="col-md-9" id="nama">
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-3" >
								NIP
							</div>
							<div class="col-md-9" id="nip">
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								Jabatan
							</div>
							<div class="col-md-9" id="jabatan">
								
							</div>
						</div>
						<div class="row">
							<div style="padding: 10px;" class="col-md-3">
								Golongan
							</div>
							<div class="col-md-9" id="golongan">
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								Unit Kerja
							</div>
							<div class="col-md-9" id="unit">
								
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h5 class="text-success">Informasi Kelengkapan Syarat Cuti</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								1. Waktu Pengajuan Cuti Maksimal Saat Hari H Cuti Dilaksanakan
							</div>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<button type='reset' class='btn btn-primary'> Batal</button>
						<button type='submit' class='btn btn-success' value="kirim"> Kirim</button>
					</div>
				</div>
			</div>
		</form>
		</div>
		<script type="text/javascript">
			var nip = "";

			function setNIP(nips)
			{
				nip = nips;
			}

			$('#exampleModal').on('hidden.bs.modal', function (e) {
  				$.ajax({
          			url: "<?php echo base_url('/cuti/json_atasan'); ?>",
          			type : 'post',
          			data: "nip="+nip, 
          			success: function(results){
          				var result = results.replace("[","").replace("]","");
            			var json = JSON.parse(result);
            			$("#nama").html(json.nama);
            			$("#nip").html(json.nip);
            			$("#nip_atasan").val(json.nip);
            			$("#golongan").html(json.golongan);
            			$("#unit").html(json.unit_kerja);
            			$("#jabatan").html(json.jabatan);
          			}
        		});
			})
		</script>
	</body>
</html>