<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim_data extends CI_Model {

	
	public function m_pengajuan($data)
	{
		$this->db->insert('cuti', $data);
	}

	public function m_status($data,$nip)
	{
		$this->db->where('id_cuti', $nip);
		$this->db->update('cuti', $data);
	}
}
