<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Aplikasi Cuti Online</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.css'); ?>">
<script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			
		input {
		background-color: #f6f6f6;
		border: none;
		color: #0d0d0d;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 5px;
		width: 85%;
		border: 2px solid #f6f6f6;
		-webkit-transition: all 0.5s ease-in-out;
		-moz-transition: all 0.5s ease-in-out;
		-ms-transition: all 0.5s ease-in-out;
		-o-transition: all 0.5s ease-in-out;
		transition: all 0.5s ease-in-out;
		-webkit-border-radius: 5px 5px 5px 5px;
		border-radius: 5px 5px 5px 5px;
		}
		.bagian{
			padding:0px!important;
		}
		.bagian2{
			background: #fff;
			margin: 10px;
			padding: 20px;
		}
		.main .row {
		display: table;
		}
		.main [class*="col-"] {
		float: none;
		display: table-cell;
		vertical-align: top;
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
		</style>
	</head>
	<body style="background: #ddd;">
		<div class="container" style="margin-top: 40px;border-radius: 2px;">
			<div class="row ">
				<div class="col-md-12  py-3 bagian" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
					<div class="bagian2"><h4>Aplikasi Cuti Online</h4></div>
				</div>
			</div>
			<div class="row">
				<div class="main col-md-8 col-sm-12 bagian h-100 py-3">
					<div class="bagian2">
						<?php
							foreach ($biodata as $key => $value) {
						?>
						<img src="<?php echo base_url('/assets/bootstrap/avatar.png'); ?>" class="rounded-circle" alt="Cinque Terre" style="margin: 10px; width: 25%;">
						<h4><?php echo $value["nama"]; ?></h4>
						<p style="margin-bottom: 0px;"><?php echo $value["nip"]; ?></p>
						<h3><?php echo $value["jabatan"]; ?></h3>
						<?php
						}
						?>
						
					</div>
				</div>
				<div class="col-md-4 col-sm-12 py-3 bagian" style="height: 100%;">
					<div class="bagian2">
						<h5>Daftar Pelayanan</h5>
						<ul class="list-group">
							<a href="<?php echo base_url('/cuti/pegawai'); ?>">
								<li class="list-group-item d-flex align-items-center">
									<span style="color: #545353;" class="fas fa-paper-plane"></span>
									<span style="margin-left: 10px;">Pengajuan Cuti Online</span>
								</li>
							</a>

							<a href="<?php echo base_url('/login/keluar'); ?>">
								<li class="list-group-item d-flex align-items-center">
									<span style="color: #dc3545;" class="fas fa-sign-out-alt"></span>
									<span style="margin-left: 10px;">Keluar</span>
								</li>
							</a>
						</ul>
					</div>
				</div>
			</div>
			<script type="text/javascript" src="<?php echo base_url('/assets/bootstrap/css/bootstrap.css'); ?>"></script>
		</body>
	</html>