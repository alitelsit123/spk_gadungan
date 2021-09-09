<?php 

/**
 * 
 */
class performance extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('login'))) {
			redirect('login');
		}
		
		// $this->load->model('Uji_Model');
		$this->load->model('Training_Model');
	}

  public function index() {
    // var_dump($this->session->userdata('total_data_train'));return;
    if (empty($this->session->performance)) {
      $this->session->set_flashdata(['msg' => 'Dibutuhkan Total Data Trains']);
      redirect(base_url('initialize'));
    }
    $trainings = $this->Training_Model->getAllData();

    $data = [
      'train_data' => $this->session->performance,
    ];


		$this->load->view('perform/index', $data);
		$this->load->view('dist/header');
		$this->load->view('dist/sidebar');
		$this->load->view('dist/footer');
  }

  public function pickTrainData() {
    return array_slice($this->Training_Model->getAllDataArray(), 0, $this->session->total_data_train);
  }

  public function calculation() {
		if (empty($this->session->userdata('total_train_data'))) {
      $this->session->set_flashdata(['msg' => 'Jumlah Data Training']);
      redirect(base_url('initialize'));
    }

    $this->session->unset_userdata('performance');

    // Classifying Naive Bayes
    $this->classifying();

    // Confusion Matrix
    $this->confusionMatrix();

    redirect(base_url('performance'));
  }
  public function confusionMatrix() {
    $train_data = $this->session->performance;
    $sesuai = array_filter($train_data, function($item, $index) {
      return $item['status'] == 'sesuai';
    }, ARRAY_FILTER_USE_BOTH);
    $unsesuai = array_filter($train_data, function($item, $index) {
      return $item['status'] == 'tidak sesuai';
    }, ARRAY_FILTER_USE_BOTH);
    $TP = sizeof(array_filter($sesuai, function($item, $index) {
      return $item['result']['type'] == 'layak';
    }, ARRAY_FILTER_USE_BOTH));

    $TN = sizeof(array_filter($sesuai, function($item, $index) {
      return $item['result']['type'] == 'tidak layak';
    }, ARRAY_FILTER_USE_BOTH));
    $FP = sizeof(array_filter($unsesuai, function($item, $index) {
      return $item['result']['type'] == 'layak';
    }, ARRAY_FILTER_USE_BOTH));
    $FN = sizeof(array_filter($unsesuai, function($item, $index) {
      return $item['result']['type'] == 'tidak layak';
    }, ARRAY_FILTER_USE_BOTH));
    
    $accurating = ($TP+$TN)/($TP+$TN+$FP+$FN)*100;
    $precition = ($TP)/($FP+$TP)*100;
    $recall = ($TP)/($FN+$TP)*100;
    $this->session->set_userdata(['confusion_matrix'=>['accuration' => $accurating, 'precition' => $precition, 'recall' => $recall]]);
  }


  public function classifying() {
    $trainings = $this->Training_Model->getAllDataArray();
    $result = [];
    $results = [];
    foreach($trainings as $row) {
      // Initialize array Data
      $b_indo = array();
      $agama = array();
      $pancasila = array();
      $umum = array();
      $kasi_pem = array();
      $wawancara = array();

      // Start Calculating
      $jumlah_layak = $this->Training_Model->count_layak($this->session->userdata('total_train_data') ?? 0);
      $jumlah_tidak_layak = $this->Training_Model->count_tidaklayak($this->session->userdata('total_train_data') ?? 0);
      $total_training = $jumlah_layak+$jumlah_tidak_layak;
      $b_indo = $this->Training_Model->b_indo($row['b_indo']);
      $agama = $this->Training_Model->agama($row['agama']);
      $pancasila = $this->Training_Model->pancasila($row['pancasila']);
      $umum = $this->Training_Model->umum($row['umum']);
      $kasi_pem = $this->Training_Model->kasi_pem($row['kasi_pem']);
      $wawancara = $this->Training_Model->wawancara($row['wawancara']);

      $PC1 = round($jumlah_layak/($jumlah_tidak_layak+$jumlah_layak), 6);
      $PC0 = round($jumlah_tidak_layak/($jumlah_tidak_layak+$jumlah_layak), 6);
      
      $kelas_layak = round($b_indo['layak'],2)*round($agama['layak'], 9)*round($pancasila['layak'], 9)*round($umum['layak'], 9)*round($kasi_pem['layak'], 9)*round($wawancara['layak'], 9)*$PC1;
      $kelas_tidak_layak = round($b_indo['tidaklayak'],2)*round($agama['tidaklayak'], 9)*round($pancasila['tidaklayak'], 9)*round($umum['tidaklayak'], 9)*round($kasi_pem['tidaklayak'], 9)*round($wawancara['tidaklayak'], 9)*$PC0;
      

      $result = [
        'nama' => $row['nama'],
        'probabilitas_data_uji' => [
          'b_indo' => $b_indo,
          'agama' => $agama,
          'pancasila' => $pancasila,
          'umum' => $umum,
          'kasi_pem' => $kasi_pem,
          'wawancara' => $wawancara,
        ],
        'probabilitas_prior' => [
          'layak' => $PC1,
          'tidaklayak' => $PC0,
        ],
        'result' => [
          'type' => $kelas_layak > $kelas_tidak_layak ? 'layak': 'tidak layak',
          'value' => $kelas_layak > $kelas_tidak_layak ? $kelas_layak: $kelas_tidak_layak,
          'default_type' => $row['status_kelayakan']
        ],
      ];
      if($result['result']['type'] == $row['status_kelayakan']) {
        $result['status'] = 'sesuai';
      } else {
        $result['status'] = 'tidak sesuai';
      }
      array_push($results, $result);
    }
    $this->session->set_userdata(['performance' => $results]);
  }

}




// }
