<?php 

/**
 * 
 */
class Uji_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('tbl_training')->result();
	}

	public function tambah_data($kesimpulan)
	{
		$data = array(
			// 'id_training' => $this->input->post('id_training', true),
			'nama' => $this->input->post('nama', true),
			'b_indo' => $this->input->post('b_indo', true),
			'agama' => $this->input->post('agama', true),
			'pancasila' => $this->input->post('pancasila', true),
			'umum' => $this->input->post('umum', true),
			'kasi_pem' => $this->input->post('kasi_pem', true),
			'wawancara' => $this->input->post('wawancara', true),
			'status_kelayakan' => $kesimpulan
		);

		$this->db->insert('tbl_training', $data);
	}

	public function ubah_data( )
	{
		$data = array(
			'nama' => $this->input->post('nama', true),
			'b_indo' => $this->input->post('b_indo', true),
			'agama' => $this->input->post('agama', true),
			'pancasila' => $this->input->post('pancasila', true),
			'umum' => $this->input->post('umum', true),
			'kasi_pem' => $this->input->post('kasi_pem', true),
			'wawancara' => $this->input->post('wawancara', true),
			'status_kelayakan' => $this->input->post('status_kelayakan', true)
		);
		$this->db->where('id_training', $this->input->post('id_training', true));
		$this->db->update('tbl_training', $data);
	}

	public function hapus_data($id)
	{
		$this->db->delete('tbl_training', ['id_training' => $id]);
	}

	public function detail_data($id)
	{
		return $this->db->get_where('tbl_training', ['id_training' => $id]) ->row_array(); 
	}

}
?>