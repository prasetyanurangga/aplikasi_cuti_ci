<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller
{
	
	public function index()
	{
		if ($this->session->userdata('status') == null || $this->session->userdata('login') == null || $this->session->userdata('nip') == null) {
			redirect(base_url('login'),'refresh');
		}
		else{
			$status = $this->session->userdata('status');
			$nip = $this->session->userdata('nip');

			if ($status == "pegawai") {
				$data["biodata"] = $this->ambil_pegawai($nip);
				$this->load->view('view_menu_pegawai',$data);
			}
			elseif ($status == "atasan") {
				$data["biodata"] = $this->ambil_pegawai($nip);
				$this->load->view('view_menu_atasan',$data);
			}
			else
			{
				redirect(base_url('login'),'refresh');
			}
		}
	}

	public function ambil_pegawai($nip)
	{
		$data = array('nip' => $nip);
		$this->load->model('ambil_data');
		$cek = $this->ambil_data->m_pegawai_nip($data);
		return $cek;
	}	
}

?>