<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backtest extends CI_Controller {

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
		$sortedData = $this->Training_Model->getAllDataAfterLimited();

		$data = array(
			'title' => "Backtest",
			'number' => 0,
			'total_data' => sizeof($this->Training_Model->getAllDataArray()),
			'sorted_data' => $sortedData,
			'results' => $this->session->performance 
		);
		$this->load->view('backtest/index', $data);
		$this->load->view("dist/header");
		$this->load->view("dist/sidebar");
		$this->load->view("dist/footer");
	}
}
