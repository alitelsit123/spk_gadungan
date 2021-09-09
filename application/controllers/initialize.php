<?php 

/**
 * 
 */
class initialize extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('login'))) {
			redirect('login');
		}
		
		// $this->load->model('Uji_Model');
		$this->load->model('Training_Model');
		// $this->load->library('form_validation');
	}

  public function index() {
    $trainings = $this->Training_Model->getAllDataArray();
    $total_train_data = $this->session->total_train_data ?? 0;


    $data = [
      'max_people' => sizeof($trainings),
      'converted' => $this->Training_Model->allDataWithConversion(),
      'stats' => $this->stats_calc()
    ];
		$this->load->view('init/index_new', $data);
		$this->load->view('dist/header');
		$this->load->view('dist/sidebar');
		$this->load->view('dist/footer');
  }

  public function set_number_of_train() {
    $countMin = 0;
    $countMax = sizeof($this->Training_Model->getAllDataArray())+1;
    $this->load->library('form_validation');
    $this->form_validation->set_rules("train_data", "DataTrain", "required|integer|greater_than[0]|less_than[".$countMax."]");
		if ($this->form_validation->run() == FALSE):
      $this->session->set_flashdata('msg', 'Jumlah Data Training Dibutuhkan Min. '.($countMin+1).' Max. '.($countMax-1));
      redirect(base_url('initialize'));
    endif;
    $this->session->set_userdata(['train_data' => []]);
    $this->session->set_userdata(['total_train_data' => $this->input->post('train_data')]);
    redirect(base_url('performance/calculation'));
  }

  public function reset() {
    $this->session->unset_userdata('total_train_data');
    $this->session->unset_userdata('performance');
    $this->session->unset_userdata('confusion_matrix');
    redirect(base_url('initialize'));
  }

  
  private function stats_calc() {
    $a = $this->Training_Model->getAttributes();
    $result = [];
    foreach($a as $r) {
      $l = ['high', 'medium', 'low'];
      $s = [];
      foreach($l as $n) {
        $s[$n] = $this->Training_Model->countValue($r, $n);
      }
      $result[$r] = $s;
    }
    return $result;
  }

}




// }
