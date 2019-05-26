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
		<link rel="stylesheet" href="<?php echo base_url('/assets/jquery-ui.css'); ?>">
		<script type="text/javascript">
			$(document).ready(function() {
				tampil_data_barang();
			function tampil_data_barang(){
            $.ajax({
                url   : '<?php echo base_url("cuti/json_cuti")?>',
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

                    	switch (data[i].status_cuti) {
                    		case '1':
                    			satatus = 'Usulan Baru';
                    			break;
                    		case '2':
                    			satatus = 'Disetujui Atasan';
                    			break;
                    		case '3':
                    			satatus = 'Ditolak Atasan';
                    			break;
                    		default:
                    			satatus = 'Usulan Baru';
                    			break;
                    	}

                        html += '<tr>'+
                        		'<td>'+j+'</td>'+
                                '<td>'+data[i].tanggal_mulai+' s.d '+data[i].tanggal_selesai+'<br>'+data[i].jenis_cuti+'</td>'+
                                '<td>'+data[i].lama_cuti+' Hari Kerja</td>'+
                                '<td id="ini_loh">'+data[i].tempat_cuti+'</td>'+
                                '<td id="satatus">'+satatus+'<br>'+data[i].tanggal_pengajuan+'</td>'+
                                '<td>-</td>'+
                                '<td id="tanggalnya">'+data[i].tanggal_pengajuan+'</td>'+
                                '<td style="text-align:center;"><a href="<?php echo base_url('assets/dokumen_cuti/'); ?>'+data[i].dokumen_cuti+'"><button class="btn btn-success"><span style="color:#fff;" class="fas fa-download"></span></button></a></td>'+
                                '</tr>';
                        j++;
                    }
                    $('#show_data').html(html);
                }
 
            });
        }
		} );
		</script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			
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
		</style>
	</head>
	<body style="background: #ddd;">
		<div class="container">
			
			<div class="judul bg-dark">
				<h4>Aplikasi Pengajuan Cuti Online</h4>
				<a style="margin-left: auto;" href="<?php echo base_url('menu'); ?>"><button class="btn btn-primary"><span style="color: #fff;" class="fas fa-arrow-left"></span></button></a>
				<a style="margin-left: 10px;"  href="<?php echo base_url('login/keluar'); ?>"><button class="btn btn-danger" ><span style="color: #fff;" class="fas fa-sign-out-alt"></span></button></a>
			</div>
			<nav style="padding: 0px;" class="navbar navbar-expand-sm bg-dark navbar-light">
				<div class="row" style="width: 100%;">
					<div class="col-md-6 col-sm-12">
						<ul class="navbar-nav">
					<li class="nav-option">
						<a class="ad nav-link" style="color: #fff;" href="<?php echo base_url('cuti/pegawai'); ?>">Form Pengajuan</a>
					</li>
					<li class="nav-option active">
						<a class="ad nav-link" style="color: #fff;" href="<?php echo base_url('cuti/daftar_cuti'); ?>">Data Pengajuan</a>
					</li>
					<li class="nav-option">
						<a class="ad nav-link" href="<?php echo base_url('cuti/pegawai'); ?>"></a>
					</li>
				</ul>
			</div>
					<div class="col-md-6 col-sm-12">
						<div class="row" style="margin-left: 15px;">
					<div class="col" style="padding: 5px;">
						<input style="color: #000!important;" id="datepicker" class=" ad nav-link form-control tanggal" type="text" placeholder="Tanggal Mulai">
					</div>
					<div class="col" style="padding: 5px;">
						<input style="color: #000!important;" id="datepicker2" class="  ad nav-link form-control tanggal" type="text" placeholder="Tanggal Selesai" >
					</div>
					<div class="col" style="padding: 5px;">
						<select  id="myInput" placeholder="Semua" class="form-control" id="tempat">
							<option>Semua</option>
										<option>Dalam Negeri</option>
										<option>Luar Negeri</option>
									</select>
					</div>
					<div class="col" style="padding: 5px;">
						<select   placeholder="Semua" class="form-control" id="status">
							<option>Semua</option>
							<option>Usulan Baru</option>
										<option>Disetujui Atasan</option>
										<option>Ditolak Atasan</option>
									</select>
					</div>
					<div class="col " style="text-align:right;color:#fff;padding: 10px;">
  						<a href="<?php echo base_url('Cuti/laporan_data_pengajuan'); ?>"><button class="btn btn-success"><span class="fas fa-print"></span></button></span></a>
						
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
							<th scope="col">Tanggal & Jenis Cuti</th>
							<th scope="col">Lama Cuti</th>
							<th scope="col">Tempat Cuti</th>
							<th scope="col">Status & Tanggal</th>
							<th scope="col">-</th>
							<th scope="col">Tanggal Permohonan</th>
							<th scope="col">Dokumen</th>
						</tr>
					</thead>
					<tbody id="show_data">

					</tbody>
				</table>
			</div>
		</div>
		<script type="text/javascript">
				$(document).ready(function(){
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