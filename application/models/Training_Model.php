<?php 

/**
 * 
 */
class Training_Model extends CI_Model
{
	public function getAllData()
	{
		return $this->db->get('tbl_training')->result();
	}
	public function getAllDataArray()
	{
		return $this->db->get('tbl_training')->result_array();
	}

	public function tambah_data( )
	{
		$nama = $this->input->post('nama', true);
		$b_indo = $this->input->post('b_indo', true);
		$agama = $this->input->post('agama', true);
		$pancasila = $this->input->post('pancasila', true);
		$umum = $this->input->post('umum', true);
		$kasi_pem = $this->input->post('kasi_pem', true);
		$wawancara = $this->input->post('wawancara', true);

		$values = [$b_indo, $agama, $pancasila, $umum, $kasi_pem, $wawancara];
		$status = '';
		$count = 0;
		foreach($values as $row) {
			if($row >= 80) {
				$count++;
			}
		}
		if($count >= 3) {
			$status = 'layak';
		} else {
			$status = 'tidak layak';
		}

		$data = array(
			// 'id_training' => $this->input->post('id_training', true),
			'nama' => $this->input->post('nama', true),
			'b_indo' => $this->input->post('b_indo', true),
			'agama' => $this->input->post('agama', true),
			'pancasila' => $this->input->post('pancasila', true),
			'umum' => $this->input->post('umum', true),
			'kasi_pem' => $this->input->post('kasi_pem', true),
			'wawancara' => $this->input->post('wawancara', true),
			'status_kelayakan' => $status
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

	public function count_layak($limit = 0)
	{
		$r = $this->db->query('
		SELECT tb.* FROM (select *, b_indo+agama+pancasila+umum+kasi_pem,wawancara as point FROM tbl_training order by point desc limit '.
		($this->session->userdata('total_train_data') ?? 0).
		') as tb 
		WHERE tb.status_kelayakan="Layak"
		');
		return sizeof($r->result_array());
	}

	public function count_tidaklayak($limit = 0)
	{
		// $this->db->where('status_kelayakan', 'Tidak Layak');
		// $this->db->from('(SELECT * FROM tbl_training order by id desc limit '.$this->session->userdata('total_train_data') ?? 0.')');
		$r = $this->db->query('
		SELECT tb.* FROM (select *, b_indo+agama+pancasila+umum+kasi_pem,wawancara as point FROM tbl_training order by point desc limit '.
		($this->session->userdata('total_train_data') ?? 0).
		') as tb 
		WHERE tb.status_kelayakan="Tidak Layak"
		');
		return sizeof($r->result_array());
	}

	// public function spread() {
  //   $result = [];
  //   $result['total'] = sizeof($this->getAllData());
  //   $result['layak'] = $this->count_layak();
  //   $result['tidak_layak'] = $this->count_tidaklayak();

  //   return $result;
  // }
	public function getAttributes() {
		$attributes = array_keys($this->getAllDataArray()[0]);
		return array_slice($attributes, 2, sizeof($attributes)-3);
	}
	public function allDataWithConversion() {
		$base = $this->getAllDataArray();
		$result = array_map(function($item) {
			$attrs = $this->getAttributes();
			foreach($attrs as $row) {
				if($item[$row] > 80) {
					$item[$row] = 'high';
				} else if($item[$row] >= 60 && $item[$row] <= 80) {
					$item[$row] = 'medium';
				} else {
					$item[$row] = 'low';
				}
			}
			unset($item['id_training']);			
			return $item;
		}, $base);

		return $result;
	}
	public function countValue($column, $type) {
		switch($type) {
			case 'high': {
				return $this->db->query('SELECT COUNT(*) total FROM tbl_training WHERE '.$column.' > 80')->row();
			}
			case 'medium': {
				return $this->db->query('SELECT COUNT(*) total FROM tbl_training WHERE '.$column.' >= 60 AND '.$column.' <= 80')->row();
			}
			case 'low': {
				return $this->db->query('SELECT COUNT(*) total FROM tbl_training WHERE '.$column.' < 60')->row();
			}
			default: {
				return 0;
			}
		}
	}

	public function convert($table, $status)
	{
		$kat ="";
		if ($status > 80) {
			$kat = "tinggi";
		}else if($status >= 60 && $status <= 80){
			$kat = "sedang";
		}else if($status < 60){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT tbl_training.$table,  tbl_training.status_kelayakan,
			CASE
			WHEN tbl_training.$table > 80 THEN 'tinggi'
			WHEN tbl_training.$table >= 60 AND $table <= 80 THEN 'sedang'
			WHEN tbl_training.$table < 60 THEN 'rendah'
			ELSE ''
			END AS c_b_indo
			FROM (select *, b_indo+agama+pancasila+umum+kasi_pem,wawancara as point FROM tbl_training order by point desc limit ".
			($this->session->userdata('total_train_data') ?? 0).
			") as tbl_training 
			) as conversi_b_indo  WHERE c_b_indo ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/($this->count_layak() == 0 ? 1: $this->count_layak());
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT tbl_training.$table,  tbl_training.status_kelayakan,
			CASE
			WHEN $table > 80 THEN 'tinggi'
			WHEN $table >= 60 AND $table <= 80 THEN 'sedang'
			WHEN $table < 60 THEN 'rendah'
			ELSE ''
			END AS c_b_indo
			FROM (select *, b_indo+agama+pancasila+umum+kasi_pem,wawancara as point FROM tbl_training order by point desc limit ".
			($this->session->userdata('total_train_data') ?? 0).
			") as tbl_training 
			) as conversi_b_indo  WHERE c_b_indo ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/($this->count_tidaklayak() == 0 ? 1:$this->count_tidaklayak());

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}


	// ambil probabilitas PKH
	public function b_indo($status)
	{
		$kat ="";
		if ($status > 80) {
			$kat = "tinggi";
		}else if($status >= 60 && $status <= 80){
			$kat = "sedang";
		}else if($status < 60){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT b_indo,  status_kelayakan,
			CASE
			WHEN b_indo > 80 THEN 'tinggi'
			WHEN b_indo >= 60 AND b_indo <= 80 THEN 'sedang'
			WHEN b_indo < 60 THEN 'rendah'
			ELSE ''
			END AS c_b_indo
			FROM tbl_training 
			) as conversi_b_indo  WHERE c_b_indo ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/$this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT b_indo,  status_kelayakan,
			CASE
			WHEN b_indo > 80 THEN 'tinggi'
			WHEN b_indo >= 60 AND b_indo <= 80 THEN 'sedang'
			WHEN b_indo < 60 THEN 'rendah'
			ELSE ''
			END AS c_b_indo
			FROM tbl_training 
			) as conversi_b_indo  WHERE c_b_indo ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/$this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}

	public function agama($status)
	{

		$kat ="";
		if ($status > 80) {
			$kat = "tinggi";
		}else if($status >= 60 && $status <= 80){
			$kat = "sedang";
		}else if($status < 60){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT agama,  status_kelayakan,
			CASE
			WHEN agama > 80 THEN 'tinggi'
			WHEN agama >= 60 AND agama <= 80 THEN 'sedang'
			WHEN agama < 60 THEN 'rendah'
			ELSE ''
			END AS c_agama
			FROM tbl_training 
			) as conversi_agama  WHERE c_agama ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/$this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT agama,  status_kelayakan,
			CASE
			WHEN agama > 80 THEN 'tinggi'
			WHEN agama >= 60 AND agama <= 80 THEN 'sedang'
			WHEN agama < 60 THEN 'rendah'
			ELSE ''
			END AS c_agama
			FROM tbl_training 
			) as conversi_agama  WHERE c_agama ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/$this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}

	public function pancasila($status)
	{
		$kat ="";
		if ($status > 80) {
			$kat = "tinggi";
		}else if($status >= 60 && $status <= 80){
			$kat = "sedang";
		}else if($status < 60){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT pancasila,  status_kelayakan,
			CASE
			WHEN pancasila > 80 THEN 'tinggi'
			WHEN pancasila >= 60 AND pancasila <= 80 THEN 'sedang'
			WHEN pancasila < 60 THEN 'rendah'
			ELSE ''
			END AS c_pancasila
			FROM tbl_training 
			) as conversi_pancasila  WHERE c_pancasila ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/$this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT pancasila,  status_kelayakan,
			CASE
			WHEN pancasila > 80 THEN 'tinggi'
			WHEN pancasila >= 60 AND pancasila <= 80 THEN 'sedang'
			WHEN pancasila < 60 THEN 'rendah'
			ELSE ''
			END AS c_pancasila
			FROM tbl_training 
			) as conversi_pancasila  WHERE c_pancasila ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/$this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}

	public function umum($status)
	{
		$kat ="";
		if ($status > 80) {
			$kat = "tinggi";
		}else if($status >= 60 && $status <= 80){
			$kat = "sedang";
		}else if($status < 60){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT umum,  status_kelayakan,
			CASE
			WHEN umum > 80 THEN 'tinggi'
			WHEN umum >= 60 AND umum <= 80 THEN 'sedang'
			WHEN umum < 60 THEN 'rendah'
			ELSE ''
			END AS c_umum
			FROM tbl_training 
			) as conversi_umum  WHERE c_umum ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/$this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT umum,  status_kelayakan,
			CASE
			WHEN umum > 80 THEN 'tinggi'
			WHEN umum >= 60 AND umum <= 80 THEN 'sedang'
			WHEN umum < 60 THEN 'rendah'
			ELSE ''
			END AS c_umum
			FROM tbl_training 
			) as conversi_umum  WHERE c_umum ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/$this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}

	public function kasi_pem($status)
	{	
		$kat ="";
		if ($status > 80) {
			$kat = "tinggi";
		}else if($status >= 60 && $status <= 80){
			$kat = "sedang";
		}else if($status < 60){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT kasi_pem,  status_kelayakan,
			CASE
			WHEN kasi_pem > 80 THEN 'tinggi'
			WHEN kasi_pem >= 60 AND kasi_pem <= 80 THEN 'sedang'
			WHEN kasi_pem < 60 THEN 'rendah'
			ELSE ''
			END AS c_kasi_pem
			FROM tbl_training 
			) as conversi_kasi_pem  WHERE c_kasi_pem ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/$this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT kasi_pem,  status_kelayakan,
			CASE
			WHEN kasi_pem > 80 THEN 'tinggi'
			WHEN kasi_pem >= 60 AND kasi_pem <= 80 THEN 'sedang'
			WHEN kasi_pem < 60 THEN 'rendah'
			ELSE ''
			END AS c_kasi_pem
			FROM tbl_training 
			) as conversi_kasi_pem  WHERE c_kasi_pem ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/$this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}

	public function wawancara($status)
	{
		// $status = "Milik Sendiri";
		$kat ="";
		if ($status > 80) {
			$kat = "tinggi";
		}else if($status >= 60 && $status <= 80){
			$kat = "sedang";
		}else if($status < 60){
			$kat = "rendah";
		}
		$q_layak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT wawancara,  status_kelayakan,
			CASE
			WHEN wawancara > 80 THEN 'tinggi'
			WHEN wawancara >= 60 AND wawancara <= 80 THEN 'sedang'
			WHEN wawancara < 60 THEN 'rendah'
			ELSE ''
			END AS c_wawancara
			FROM tbl_training 
			) as conversi_wawancara  WHERE c_wawancara ='$kat' AND status_kelayakan = 'layak'
			")->row();
		$layak = $q_layak->jml/$this->count_layak();
		$q_tidak = $this->db->query("
			SELECT count(*) as jml FROM (
			SELECT wawancara,  status_kelayakan,
			CASE
			WHEN wawancara > 80 THEN 'tinggi'
			WHEN wawancara >= 60 AND wawancara <= 80 THEN 'sedang'
			WHEN wawancara < 60 THEN 'rendah'
			ELSE ''
			END AS c_wawancara
			FROM tbl_training 
			) as conversi_wawancara  WHERE c_wawancara ='$kat' AND status_kelayakan = 'tidak layak'
			")->row();
		$tidak = $q_tidak->jml/$this->count_tidaklayak();

		return array('layak' => $layak, 'tidaklayak' => $tidak);	
	}




}
?>