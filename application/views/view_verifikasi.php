<?php defined('BASEPATH') OR exit('No direct script access allowed');
$nip = $this->session->userdata('nip');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Aplikasi Cuti Online</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css'); ?>">
		<script src="<?php echo base_url('/assets/jquery.min.js'); ?>"></script>
		<script  src="<?php echo base_url('/assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
		<script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>
		<script src="<?php echo base_url('/assets/jquery-ui.js'); ?>"></script>
		
		<link rel="stylesheet" href="<?php echo base_url('/assets/jquery-ui.css'); ?>">
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
		});
		</script>
		<link rel="stylesheet" href="<?php echo base_url('/assets/jquery-ui.css'); ?>">
		<script type="text/javascript">
			$(document).ready(function() {
				tampil_data_barang();
			function tampil_data_barang(){
		$.ajax({
		url   : '<?php echo base_url("cuti/json_verifikasi")?>',
		async : false,
		type : 'post',
		data: "nip=<?php echo $nip; ?>",
		dataType : 'json',
		success : function(data){
		var html = '';
		var i;
		var j = 1;
		for(i=0; i<data.length; i++){
		var satatus;
		var datass;
		if (data[i].dokumen_cuti == "") {
		datass = '';
		}
		else
		{
		datass = '<button class="btn btn-primary"><a href="<?php echo base_url('assets/dokumen_cuti/'); ?>'+data[i].dokumen_cuti+'"><span style="color:#fff;" class="fas fa-download"></span></a></button>';
		}
		switch (data[i].status_cuti) {
		case '1':
		satatus = 'Usulan Baru';
		
		datass2 = '<button style="margin-bottom:10px;" class="btn btn-success"><a id="cek" valuenya="'+ data[i].id_cuti +'"><span class="fas fa-check-circle"></span></a></button><br><button class="btn btn-danger"><a id="kancel" valuenya="'+ data[i].id_cuti +'"><span class="fas fa-times-circle"></span></a></button>';
		break;
		case '2':
		satatus = 'Disetujui Atasan';
		
		datass2 = '';
		break;
		case '3':
		satatus = 'Ditolak Atasan';
		datass = '<button class="btn btn-primary"><a href="<?php echo base_url('assets/dokumen_cuti/'); ?>'+data[i].dokumen_cuti+'"><span style="color:#fff;" class="fas fa-download"></span></a></button>';
		datass2 = '';
		break;
		default:
		satatus = 'Usulan Baru';
		
		datass2 = '';
		break;
		}
		html += '<tr>'+
			'<td>'+j+'</td>'+
			'<td  id="nipnya">'+data[i].nama+'<br>'+data[i].nip+'</td>'+
			'<td>'+data[i].jabatan+'</td>'+
			'<td id="tanggalnya">'+data[i].tanggal_mulai+' - '+data[i].tanggal_selesai+'</td>'+
			'<td >'+data[i].lama_cuti+' Hari Kerja </td>'+
			'<td id="ini_loh">'+data[i].tempat_cuti+'</td>'+
			'<td>'+data[i].jenis_cuti+'</td>'+
			'<td id="satatus">'+satatus+'</td>'+
			'<td>'+data[i].tanggal_pengajuan+'</td>'+
			'<td style="text-align:center;"><button  data-toggle="modal" data-target="#exampleModal" style="margin-bottom:10px;" class="modf btn btn-success"><a id="modg" valuenya="'+ data[i].nip +'"><span class="fas fa-check-circle"></span></a></button><br><a href="<?php echo base_url("cuti/laporan_data_verifikasi_pegawai/"); ?>'+data[i].nip+'/'+data[i].id_cuti+'"><button class="btn btn-danger"><span class="fas fa-times-circle"></span></button></a></td>'+
			'<td style="text-align:center;">'+datass+'</td>'+
			'<td style="text-align:center;">'+datass2+'</td>'+
		'</tr>';
		j++;
		}
		$('#show_data').html(html);
		}
		
		});
		}
		$("#cek").on("click", function() {
		var value = $(this).attr("valuenya");
		update_status('2',value);
		alert("Berhasil Menyetujui");
		tampil_data_barang();
		});
		$("#kancel").on("click", function() {
		var value = $(this).attr("valuenya");
		update_status('3',value);
		alert("Berhasil Menolak");
		tampil_data_barang();
		});
		function update_status(statu,nip)
		{
		$.ajax({
		url   : '<?php echo base_url("cuti/update_status")?>',
		async : false,
		type : 'post',
		data: "nip="+ nip +"&status="+statu,
		dataType : 'json'
		
		});
		}
		} );
		</script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			.fas
			{
				color: #fff!important;
			}
			.container{
				max-width: 100%;
			}
		
		.active{
			background-color: tomato!important;
		}
		.ad{
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
		.angga
		{
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
							<h5 class="modal-title" id="exampleModalLabel">Detail Pegawai</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="angga row">
								<div class="col-md-6 col-sm-12">
									Nama
								</div>
								<div class="col-md-6 col-sm-12" id="nama">
									
								</div>
							</div>
							<div class="angga row">
								<div class="col-md-6 col-sm-12" >
									NIP
								</div>
								<div class="col-md-6 col-sm-12" id="nip">
									
								</div>
							</div>
							<div class="angga row">
								<div class="col-md-6 col-sm-12">
									Jabatan
								</div>
								<div class="col-md-6 col-sm-12" id="jabatan">
									
								</div>
							</div>
							<div class="angga row">
								<div  class="col-md-6 col-sm-12">
									Golongan
								</div>
								<div class="col-md-6 col-sm-12" id="golongan">
									
								</div>
							</div>
							<div class="angga row">
								<div class="col-md-6 col-sm-12">
									Unit Kerja
								</div>
								<div class="col-md-6 col-sm-12" id="unit">
									
									
								</div>
							</div>
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
				<div class="row" style="width: 100%;">
					<div class="col-md-3 col-sm-12">
						<ul class="navbar-nav">
							<li class="nav-option">
								<a class="ad nav-link" style="color: #fff;" href="<?php echo base_url('cuti/pegawai'); ?>">Form Pengajuan</a>
							</li>
							<li class="nav-option active">
								<a class="ad nav-link" style="color: #fff;" href="<?php echo base_url('cuti/daftar_cuti'); ?>">Data Verifikasi Cuti</a>
							</li>
							<li class="nav-option">
								<a class="ad nav-link" href="<?php echo base_url('cuti/pegawai'); ?>"></a>
							</li>
						</ul>
					</div>
					<div class="col-md-9 col-sm-12">
						<div class="row" style="margin-left: 15px;">
							<div class="col" style="padding: 5px;">
								<input style="color: #000!important;" id="nipnyassss" class=" ad nav-link form-control" type="text" placeholder="Masukan NIP">
							</div>
							<div class="col" style="padding: 5px;">
								<input style="color: #000!important;" id="datepicker" class=" ad nav-link form-control tanggal" type="text" placeholder="Tanggal Mulai">
							</div>
							<div class="col" style="padding: 5px;">
								<input style="color: #000!important;" id="datepicker2" class="  ad nav-link form-control tanggal" type="text" placeholder="Tanggal Selesai" >
							</div>
							<div class="col" style="padding: 5px;">
								<select id="myInput" placeholder="Semua" class="form-control" id="tempat">
									<option>Semua</option>
									<option>Dalam Negeri</option>
									<option>Luar Negeri</option>
								</select>
							</div>
							<div class="col" style="padding: 5px;">
								<select placeholder="Semua" class="form-control" id="status">
									<option>Semua</option>
									<option>Usulan Baru</option>
									<option>Disetujui Atasan</option>
									<option>Ditolak Atasan</option>
								</select>
							</div>
							<div class="col " style="text-align:right;color:#fff;padding: 5px;">
								<div class="row" class="ad">
									<div class="col"><a href="<?php echo base_url('Cuti/laporan_data_verifikasi'); ?>"><button class="btn btn-success">Tampilkan</button></a></div>
									<div class="col"><a href="<?php echo base_url('Cuti/laporan_data_verifikasi'); ?>"><button class="btn btn-success"><span class="fas fa-print"></span></button></a></div>
								</div>
								
								
							</div>
						</div>
					</div>
				</div>
			</nav>
			<div class="container" style="padding: 20px!important; background-color:#fff;">
				<table id="example" class="table">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">Jabatan</th>
							<th scope="col">Tgl Cuti</th>
							<th scope="col">Lama</th>
							<th scope="col">Tempat</th>
							<th scope="col">Jenis Cuti</th>
							<th scope="col">Status</th>
							<th scope="col">Tgl Pengajuan</th>
							<th scope="col">Detail</th>
							<th scope="col">Dokumen</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody id="show_data">
					</tbody>
				</table>
			</div>
		</div>
		<script type="text/javascript">
				$(document).ready(function(){
			$('#exampleModal').on('show.bs.modal', function (e) {
				var nip = $("#modg").attr("valuenya");
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
		});
		$("#nipnyassss").on("keyup", function() {
		var value = $(this).val();
		if (value == "") {
		$("#example tbody tr").css("display", "block");
		}
		else{
		$("#example tbody tr").css("display", "block");
		$("#example tbody tr").filter(function() {
		if ($('#nipnya', this).text().indexOf(value) < 0)
		{
		return true;
		}
		}).css("display", "none");
		}
		
		
		});
		$("#myInput").on("change", function() {
		var value = $(this).val();
		if (value == "Semua") {
		$("#example tbody tr").css("display", "block");
		}
		else{
		$("#example tbody tr").css("display", "block");
		$("#example tbody tr").filter(function() {
		if ($('#ini_loh', this).text() != value)
		{
		return true;
		}
		}).css("display", "none");
		}
		
		
		});
		$("#status").on("change", function() {
		var value = $(this).val();
		if (value == "Semua") {
		$("#example tbody tr").css("display", "block");
		}
		else{
		$("#example tbody tr").css("display", "block");
		$("#example tbody tr").filter(function() {
		if ($('#satatus', this).text().indexOf(value) < 0)
		{
		return true;
		}
		}).css("display", "none");
		}
		
		
		});
		$("#datepicker2").on("change", function() {
		if ($('#datepicker2').val() == "" || $('#datepicker').val() == "") {
		$("#example tbody tr").css("display", "block");
		}
		else{
		$("#example tbody tr").css("display", "block");
		$("#example tbody tr").filter(function() {
		if ($('#tanggalnya', this).text() > formatDate($('#datepicker2').val()) || $('#tanggalnya', this).text() < formatDate($('#datepicker').val()))
		{
		return true;
		}
		}).css("display", "none");
		}
		
		});
		function formatDate(date) {
		var d = new Date(date),
		month = '' + (d.getMonth() + 1),
		day = '' + d.getDate(),
		year = d.getFullYear();
		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;
		return [year, month, day].join('-');
		}
		});
		</script>
		
		</script>
	</body>
</html>