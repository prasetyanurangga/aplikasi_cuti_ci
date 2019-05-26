<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ambil_data extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function m_login($data)
	{
		return $this->db->get_where('pegawai',$data);
	}

	public function m_pegawai_nip($data)
	{
		$sq = $this->db->get_where('pegawai',$data);
		$qu = $sq->result_array();
		return $qu;
	}

	public function m_pegawai($data)
	{
		$sq = $this->db->get_where('pegawai',$data);
		$qu = $sq->result_array();
		return $qu;
	
	}
	public function m_atasan($data)
	{
		$sq = $this->db->get_where('pegawai',$data);
		return $sq;
	
	}

	public function m_cuti($data)
	{
	
		$sq = $this->db->get_where('cuti',$data);
		return $sq;
	
	}
	public function m_verifikasi($data)
	{
	
		$sq = $this->db->get_where('pegawai_cuti',$data);
		return $sq;
	
	}

	public function m_verifikasi2($data)
	{
	
		$sq = $this->db->get_where('pegawai_cuti2',$data);
		return $sq;
	
	}


	public function m_sisa_cuti($data)
	{
		$sq = $this->db->query("CALL `ambil_cuti`('".date("Y")."', '".$data."');");
		$qu = $sq->result_array();
		return $qu;
	}


	public function m_id_cuti()
	{
		$sq = $this->db->query('SELECT SUBSTRING(id_cuti,3,20)+1 AS id_cuti FROM cuti ORDER BY id_cuti DESC LIMIT 1');
		return $sq;
	}

	public function ambil_siswa()
	{
		$sq = $this->db->query('SELECT *, nilai_bindo+nilai_bingg+nilai_mtk+nilai_prod AS jumlah_nilai,(nilai_bindo+nilai_bingg+nilai_mtk+nilai_prod)/4 As rata FROM nilaisiswa');
		$qu = $sq->result_array();
return $qu;
		
	}
}
