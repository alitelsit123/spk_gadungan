<?php 

/**
 * 
 */
class DataTraining extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('login'))) {
			redirect('login');
		}

		$this->load->model('Training_Model');
		$this->load->library('form_validation');
	}
	
	function index()
	{
		$data['training'] = $this->Training_Model->getAllData();
		$this->load->view('training/index', $data);
		$this->load->view('dist/header');
		$this->load->view('dist/sidebar');
		$this->load->view('dist/footer');
	}

	function tambahdata () {
		$this->load->view('training/tambahdata');
		$this->load->view('dist/header');
		$this->load->view('dist/sidebar');
		$this->load->view('dist/footer');
	}

	public function validation_form(){
		// $this->form_validation->set_rules("id_training", "Id Training", "required|is_unique[tbl_training.id_training]|max_length[5]");
		$this->form_validation->set_rules("nama", "Nama ", "required");
		$this->form_validation->set_rules("b_indo", "Bahasa Indonesia ", "required");
		$this->form_validation->set_rules("agama", "Agama ", "required");
		$this->form_validation->set_rules("pancasila", "Pancasila", "required");
		$this->form_validation->set_rules("umum", "Umum", "required");
		$this->form_validation->set_rules("kasi_pem", "Kasi Pemerintah", "required");
		$this->form_validation->set_rules("wawancara", "Wawancara", "required");
		// $this->form_validation->set_rules("status_kelayakan", "Status Kelayakan", "required");

		if ($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->Training_Model->tambah_data();
			$this->session->set_flashdata('flash_training', 'Disimpan');
			redirect('DataTraining');
		}	
	}

	public function hapus($id)
	{
		$this->Training_Model->hapus_data($id);
		$this->session->set_flashdata('flash_training', 'Dihapus');
		redirect('DataTraining');
	}

	public function ubah($id)
	{
		// $this->form_validation->set_rules("id_training", "Id Training", "required|max_length[5]");
		$this->form_validation->set_rules("nama", "Nama", "required");
		$this->form_validation->set_rules("b_indo", "Bahasa Indonesia", "required");
		$this->form_validation->set_rules("agama", "Agama", "required");
		$this->form_validation->set_rules("pancasila", "Pancasila", "required");
		$this->form_validation->set_rules("umum", "Umum", "required");
		$this->form_validation->set_rules("kasi_pem", "Kasi Pemerintah", "required");
		$this->form_validation->set_rules("wawancara", "Wawancara", "required");
		$this->form_validation->set_rules("status_kelayakan", "Status Kelayakan", "required");

		if ($this->form_validation->run() == FALSE)
		{
			$data['ubah']= $this->Training_Model->detail_data($id);
			$this->load->view('dist/header');
			$this->load->view('dist/sidebar');
			$this->load->view('training/ubah', $data);
			$this->load->view('dist/footer');
		}
		else
		{
			$this->Training_Model->ubah_data();
			$this->session->set_flashdata('flash_training', 'Diubah');
			redirect('DataTraining');
		}	
	}


}
?>