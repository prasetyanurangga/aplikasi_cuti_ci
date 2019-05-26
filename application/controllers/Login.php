
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{
		if ($this->session->userdata('status') == null || $this->session->userdata('login') == null || $this->session->userdata('nip') == null) {
			$error = array('error' => '');
			$this->load->view('view_login');
		}
		else{
			redirect(base_url('menu'),'refresh');
		}
	}

	public function proses_login()
	{
		if ($this->input->post("nip") == null OR $this->input->post("password") == null) {
			redirect(base_url('login'),'refresh');
		}
		else
		{
		$this->form_validation->set_rules('nip','Nip','required|min_length[10]|integer');
		$this->form_validation->set_rules('password','Password','required');
 
		if($this->form_validation->run() != false){
			$nip = $this->input->post("nip");
			$password = $this->input->post("password");


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
				$error = array('error' => '<script>alert("Login Gagal");</script>');
				$this->load->view('view_login',$error);
			}

		}else{
			$error = array('error' => '<script>alert("Login Gagal");</script>');
			$this->load->view('view_login',$error);
		}
	}
		



	}

	public function keluar()
	{
		$this->session->sess_destroy();
		$this->load->view('view_login');
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
