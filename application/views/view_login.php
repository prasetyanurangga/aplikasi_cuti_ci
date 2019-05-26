<?php defined('BASEPATH') OR exit('No direct script access allowed');



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Aplikasi Cuti Online</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.css'); ?>">
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
			margin-top: 10px!important;
			margin-bottom: 10px!important;
		}
		#untuk > * {
			vertical-align: middle;
		}
		</style>
	</head>
	<body>
		<div class="container" style="padding: 20px;">
			<div class="card" style="width: 75%;margin: auto;">
				<div id="untuk" class="card-header" style="background: #2c3e4e;color: #fff;padding-top: 40vh;text-align: center;">
					<span style="font-size:larger;vertical-align: bottom;"><h3>Aplikasi Cuti Online</h3></span>
				</div>
				<div class="card-body" style="padding: 4%;">
					
					<form method="POST" action="<?php echo base_url('login/proses_login'); ?>">
						<div class="bagian form-group">
							<input name="nip"  style="box-shadow: none; border-radius: 0;border-right: none;border-top: none;border-left: none;" type="text" class="form-control" aria-describedby="nipHelp" placeholder="Masukan NIP">
							<small id="nipHelp" class="form-text text-muted"><?php echo form_error('nip'); ?></small>
						</div>
						<div class="bagian form-group">
							<input name="password" type="password" style="box-shadow: none; border-radius: 0;border-right: none;border-top: none;border-left: none;" class="form-control" placeholder="Masukan Password" aria-describedby="passwordHelp">
							<small id="passwordHelp" class="form-text text-muted"><?php echo form_error('password'); ?></small>
						</div>
						<div style="margin-left: 10px;" class="bagian form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="remember">
							<label style="font-size: small;" class="form-check-label" for="inlineCheckbox1">Ingatkan Saya</label>
						</div>
						
						<button style="width: 100%; margin: auto;" type="submit" name="kirim" value="masuk" class="bagian btn btn-success">Masuk</button>
					</form>
				</div>
			</div>
			
		</div>
		<script type="text/javascript" src="<?php echo base_url('/assets/bootstrap/css/bootstrap.js'); ?>"></script>
	</body>
</html>