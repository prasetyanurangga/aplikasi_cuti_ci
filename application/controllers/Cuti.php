<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cuti extends CI_Controller {

	public function index()
	{
		redirect(base_url('login'),'refresh');
	}
	public function pegawai()
	{
		
		if ($this->session->userdata('status') == null || $this->session->userdata('login') == null || $this->session->userdata('nip') == null) {
			redirect(base_url('login'),'refresh');
		}
		else{
		if ($this->session->userdata('status') == "pegawai")
		{
			$nip = $this->session->userdata('nip');
			$this->load->model('ambil_data');
			$data['pegawai'] = $this->ambil_data->m_pegawai(array('nip' => $nip));

			$data['atasan'] = $this->ambil_data->m_pegawai(array('status' => 'atasan'));

			$data["cuti"] = $this->ambil_data->m_sisa_cuti($nip);

			$this->load->view("view_pengajuan",$data);
			}
			elseif ($this->session->userdata('status') == "atasan") {
				$nip = $this->session->userdata('nip');
				$this->load->model('ambil_data');
				$data['pegawai'] = $this->ambil_data->m_pegawai(array('nip' => $nip));
				$data['atasan'] = $this->ambil_data->m_pegawai(array('status' => 'pegawai'));
				$this->load->view("view_pengajuan_atasan",$data);
			}
		}
		
	}
	public function atasan()
	{
		
		if ($this->session->userdata('status') == null || $this->session->userdata('login') == null || $this->session->userdata('nip') == null) {
			redirect(base_url('login'),'refresh');
		}
		else{
		if ($this->session->userdata('status') == "pegawai")
		{
			$nip = $this->session->userdata('nip');
			$this->load->model('ambil_data');
			$data['pegawai'] = $this->ambil_data->m_pegawai(array('nip' => $nip));

			$data['atasan'] = $this->ambil_data->m_pegawai(array('status' => 'atasan'));

			$data["cuti"] = $this->ambil_data->m_sisa_cuti($nip);

			$this->load->view("view_pengajuan",$data);
			}
			elseif ($this->session->userdata('status') == "atasan") {
				$nip = $this->session->userdata('nip');
				$this->load->model('ambil_data');
				$data['pegawai'] = $this->ambil_data->m_pegawai(array('nip' => $nip));
				$data['atasan'] = $this->ambil_data->m_pegawai(array('status' => 'pegawai'));
				$this->load->view("view_pengajuan_atasan",$data);
			}
		}
		
	}

	public function json_jml_cuti()
	{
		if ($this->session->userdata('status') == "atasan") {
			$nip = '198204042008012035';
			$this->load->model('ambil_data');
			$datas = $this->ambil_data->m_sisa_cuti($nip);
			foreach ($datas as $key => $value) {
				echo '{"jumlah":"'.$value["jumlah"].'"}';
			}
	}
	}

	public function json_atasan()
	{
			$nip = $this->input->post("nip");
			$this->load->model('ambil_data');
			$data = $this->ambil_data->m_atasan(array('nip' => $nip))->result_array();
			echo json_encode($data);
	}


	public function json_cuti()
	{
		if ($this->input->post("nip") != null ) {
			$this->load->model('ambil_data');
		$data = $this->ambil_data->m_cuti(array('id_pegawai' => $this->input->post("nip")))->result();
		echo json_encode($data);
	}
		
	}

	public function json_verifikasi()
	{
		if ($this->input->post("nip") != null ) {
			$this->load->model('ambil_data');
		$data = $this->ambil_data->m_verifikasi(array('id_atasan' => $this->input->post("nip")))->result();
		echo json_encode($data);
	}
		
	}

	public function kirim_pengajuan()
	{

		$this->form_validation->set_rules('mulai','Tanggal Mulai','required');
		$this->form_validation->set_rules('selesai','Tanggal Selesai','required');
		$this->form_validation->set_rules('lama','Lama Cuti','required');
		$this->form_validation->set_rules('keperluan','Keperluan Cuti','required');
		$this->form_validation->set_rules('alamat','Alamat dan No Telepon','required');
		$this->form_validation->set_rules('nip_atasan','NIP Atasan','required');

		if($this->session->userdata('status') == "pegawai")
			{
				
				$arah = base_url('cuti/atasan');
			}
			elseif($this->session->userdata('status') == "atasan")
			{
				
				$arah = base_url('cuti/pegawai');
			}
		
		if($this->form_validation->run() != false){
			$jenis = $this->input->post("jenis");
			$mulai = date("Y-m-d", strtotime($this->input->post("mulai")));
			$lama = $this->input->post("lama");
			$keperluan = $this->input->post("keperluan");
			$tempat = $this->input->post("tempat");
			$alamat = $this->input->post("alamat");
			$selesai = date("Y-m-d", strtotime($this->input->post("selesai")));
			
			if($this->session->userdata('status') == "pegawai")
			{
				$atasan = $this->input->post("nip_atasan");
				$nip = $this->session->userdata('nip');
				$satatus = '1';
			}
			elseif($this->session->userdata('status') == "atasan")
			{
				$nip = $this->input->post("nip_atasan");
				$atasan = $this->session->userdata('nip');
				$satatus = '2';
			}

			$kuota = $this->input->post('kuota');
			$tanggal  = date("Y-m-d");

			$config['upload_path']          = './assets/dokumen_cuti';
			$config['allowed_types']        = 'gif|jpeg|png|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 950;
		 
			$this->load->library('upload', $config);
		 
			if ( ! $this->upload->do_upload('dokumen')){
				$dokumen = "";
				$data_kirim = array(
					'id_cuti' => $this->ambil_id_cuti(),
					'tanggal_mulai' => $mulai,
					'tanggal_selesai' => $selesai,
					'tanggal_pengajuan' => $tanggal,
					'jenis_cuti' => $jenis,
					'tempat_cuti' => $tempat,
					'alamat_nohp' => $alamat,
					'keperluan' => $keperluan,
					'lama_cuti' => $lama,
					'id_pegawai' => $nip,
					'id_atasan' => $atasan,
					'status_cuti' => $satatus,
					'dokumen_cuti' => $dokumen 
				);

				$this->load->model('kirim_data');
				$this->kirim_data->m_pengajuan($data_kirim);
				echo '<script>alert("Berhasil Mengirim");</script>';
				redirect($arah,'refresh');
				
			}
			elseif ($lama > $kuota) {
					echo '<script>alert("Melebihi Kuota Cuti");</script>';
				redirect($arah,'refresh');
			
				}
			else{
				$dokumen = $this->upload->data("file_name");
				$data_kirim = array(
					'id_cuti' => $this->ambil_id_cuti(),
					'tanggal_mulai' => $mulai,
					'tanggal_selesai' => $selesai,
					'tanggal_pengajuan' => $tanggal,
					'jenis_cuti' => $jenis,
					'tempat_cuti' => $tempat,
					'alamat_nohp' => $alamat,
					'keperluan' => $keperluan,
					'lama_cuti' => $lama,
					'id_pegawai' => $nip,
					'id_atasan' => $atasan,
					'status_cuti' => $satatus,
					'dokumen_cuti' => $dokumen 
				);

				$this->load->model('kirim_data');
				$this->kirim_data->m_pengajuan($data_kirim);
				echo '<script>alert("Berhasil Mengirim");</script>';
				redirect($arah,'refresh');

			}
		}
		else
		{
			echo '<script>alert("Harap Isi Semuanya");</script>';
			redirect($arah,'refresh');
		}
	}

	public function update_status()
	{
		$nip = $this->input->post("nip");
		$status = $this->input->post("status");
		$this->load->model('kirim_data');
		$cek = $this->kirim_data->m_status(array('status_cuti' => $status),$nip);

		echo "{'hasil':'berhasil'}";

	}

	public function laporan_data_verifikasi()
	{
		$this->load->model('ambil_data');
		$data["verif"] = $this->ambil_data->m_verifikasi2(array('id_atasan' => $this->session->userdata("nip")))->result_array();
		$data["pegawai"] = $this->ambil_data->m_pegawai(array('nip' => $this->session->userdata('nip')));
		
		$this->load->view('view_laporan',$data);
	}

	public function laporan_data_verifikasi_pegawai()
	{
		$this->load->model('ambil_data');
		$nip = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		$data["verif"] = $this->ambil_data->m_verifikasi2(array('id_cuti' => $id))->result_array();
		$data["pegawai"] = $this->ambil_data->m_pegawai(array('nip' => $nip));
		
		$this->load->view('view_laporan_pegawai',$data);
	}

    public function laporan_data_pengajuan()
    {
    	if ($this->session->userdata('nip') != null ) {
			$this->load->model('ambil_data');
			$data = $this->ambil_data->m_cuti(array('id_pegawai' => $this->session->userdata('nip')))->result_array();
			$data2 = $this->ambil_data->m_pegawai(array('nip' => $this->session->userdata('nip')));

		
			$html='
					<center><table cellspacing="1" border="0.5" style="border: 1px solid #ddd;" cellpadding="2">
						<thead  bgcolor="#ffffff">
						<tr style="text-align:center;">
							<th style="text-align:center;" width="5%">No</th>
							<th width="30%">Tanggal & Jenis Cuti</th>
							<th  width="15%">Lama Cuti</th>
							<th width="15%">Tempat Cuti</th>
							<th width="15%">Status & Tanggal</th>
							<th width="5%">-</th>
							<th width="15%">Tanggal Permohonan</th>
						</tr>
					</thead>';
					$i = 1;
			foreach ($data as $row => $value) 
				{
					switch ($value["status_cuti"]) {
                    		case "1":
                    			$satatus = 'Usulan Baru';
                    			break;
                    		case "2":
                    			$satatus = 'Disetujui Atasan';
                    			break;
                    		case "3":
                    			$satatus = 'Ditolak Atasan';
                    			break;
                    		default:
                    			$satatus = 'Usulan Baru';
                    			break;
                    	}
					$i++;
					$html.='<tbody  bgcolor="#ffffff">
							<tr style="text-align:center;">
							<td style="text-align:center;" width="5%">'.$i.'</td>'.
                        		'<td  width="30%">'.$value["tanggal_mulai"].' s.d '.$value["tanggal_selesai"].'<br>'.$value["jenis_cuti"].'</td>'.
                        		'<td width="15%">'.$value["lama_cuti"].' Hari Kerja</td>'.
                        		'<td width="15%">'.$value["tempat_cuti"].'</td>'.
                        		'<td width="15%">'.$satatus.'<br>'.$value["tanggal_pengajuan"].'</td>'.
                        		'<td  width="5%">-</td>'.
                        		'<td width="15%">'.$value["tanggal_pengajuan"].'</td>

                        	</tr>

						</tbody>';
				}
			$html.='</table></center>';

			$html2 = '<table>';
   	 		foreach ($data2 as $row => $value) 
				{
					$judul = $value["nip"]."-".date("Y");
						$html2 .= '<tr>
		<td width="30%">NIP</td>
		<td width="70%">:&nbsp;'.$value["nip"].'</td>
	</tr>
	<tr>
		<td width="30%">Nama</td>
		<td width="70%">:&nbsp;'.$value["nama"].'</td>
	</tr>
	<tr>
		<td width="30%">Jabatan</td>
		<td width="70%">:&nbsp;'.$value["jabatan"].'</td>
	</tr>
	<tr>
		<td width="30%">Golongan</td>
		<td width="70%">:&nbsp;'.$value["golongan"].'</td>
	</tr>
	<tr>
		<td width="30%">Unit Kerja</td>
		<td width="70%">:&nbsp;'.$value["unit_kerja"].'</td>
	</tr>';
				}
	
   $html2 .= '</table>';
			
			$this->load->library('Pdf');
        	$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
        	$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
        	$pdf->setPrintHeader(false);
    		$pdf->SetTitle($judul);
    		$pdf->SetTopMargin(20);
    		$pdf->setFooterMargin(20);
    		$pdf->SetAutoPageBreak(true);
    		$pdf->SetAuthor('Author');
   	 		$pdf->SetDisplayMode('real', 'default');

   	 		

// add a page


// set some text to print

    		$pdf->AddPage('L','A4');
    		$txt = <<<EOD
Laporan Data Cuti



EOD;

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

    		 $pdf->writeHTML($html2, true, false, true, false, '');
    		 $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output($judul.'.pdf', 'I');

		}
        

    }

	public function proses_login()
	{
		$this->form_validation->set_rules('nip','Nip','required|min_length[10]|integer');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run() != false){
			$nip = $this->input->post("nip");
			$password = $this->input->post("password");
			$remember = $this->input->post("remember");
			$data_user = array('nip' => $nip, 'password' => $password);
			$this->load->model('ambil_data');
			$cek = $this->ambil_data->m_login($data_user);
			$qu = $cek->result_array();
			foreach ($qu as $key => $value) {
				$status = $value["status"];
			}
			if ($cek->num_rows() > 0) {
				$this->session->set_userdata('nip',$nip);
				$this->session->set_userdata('status',$status);
				$this->session->set_userdata('login','ya');
				redirect(base_url('menu'),'refresh');
			}
			else
			{
				$this->load->view('view_login');
			}
		}else{
			$this->load->view('view_login');
		}
		
	}
	public function ambil_id_cuti()
	{
		$this->load->model('ambil_data');
		$num = $this->ambil_data->m_id_cuti()->num_rows();
		if ($num > 0) {
			$cek = $this->ambil_data->m_id_cuti()->result_array();
		foreach ($cek as $key => $value) {
			$jumlah = $value["id_cuti"];
		}
		$panjang = strlen($jumlah);
		$nol = "00000000000000000000";
		return "C-".substr($nol,0,strlen($nol)-$panjang).$jumlah;
		}
		else
		{
			return "C-00000000000000000001";
		}
		
	}
	public function keluar()
	{
		$this->session->sess_destroy();
		$this->load->view('view_login');
	}

	public function daftar_cuti()
	{

		if ($this->session->userdata('status') == "pegawai") {
		$this->load->view('view_daftar');
	}
	else
	{
		redirect(base_url('cuti'),'refresh');
	}

		
	}
	public function daftar_verifikasi()
	{
		if ($this->session->userdata('status') == "atasan") {
		$this->load->view('view_verifikasi');
	}
	else
	{
		redirect(base_url('cuti'),'refresh');
	}
	}


	/*public function data_siswa()
	{
		$this->load->model('kirim_data');
		$data["siswa"] = $this->kirim_data->ambil_siswa();
		$this->load->view('view_data_siswa',$data);
	}
	public function kirim_input()
	{
		if ($this->input->post("kirim") == "Simpan")
		{
		$this->load->model('kirim_data');
		$no = $this->input->post("no_induk");
		$nama = $this->input->post("nama");
		$kelas = $this->input->post("kelas");
		$indo = $this->input->post("n_indo");
		$ingg = $this->input->post("n_ingg");
		$mtk = $this->input->post("n_mtk");
		$prod = $this->input->post("n_prod");
		$data = array(
			'no_ind_siswa' => $no,
			'nama_siswa' => $nama,
			'kelas' => $kelas,
			'nilai_bindo' => $indo,
			'nilai_bingg' => $ingg,
			'nilai_mtk' => $mtk,
			'nilai_prod' => $prod
		);
		try{
		$this->kirim_data->kirim_siswa($data);
echo "<script>alert('Berhasil Mengupload');window.location.href='".base_url()."'</script>";
}
catch(Exception $e)
{
echo "<script>alert('Gagal Mengupload');window.location.href='".base_url()."'</script>";
}
}
else
{
echo "<script>window.location.href='".base_url()."'</script>";
}
}
*/
}