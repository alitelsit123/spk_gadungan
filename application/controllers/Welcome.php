<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('login'))) {
			redirect('login');
		}

		$this->load->model('Training_Model');
		$this->load->library('form_validation');
	}
	
	public function index()
	{

		$data = array(
			'title' => "Dashboard",
			'total_data' => sizeof($this->Training_Model->getAllDataArray())
		);
		$this->load->view('index', $data);
		$this->load->view("dist/header");
		$this->load->view("dist/sidebar");
		$this->load->view("dist/footer");
	}
}
