<?php 

/**
 * 
 */
class Performance extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('login'))) {
			redirect('login');
		}
		
		$this->load->model('Training_Model');
	}

  public function index() {
    if (empty($this->session->performance)) {
      $this->session->set_flashdata(['msg' => 'Dibutuhkan Jumlah Data Untuk Proses Klasifikasi!']);
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
    // return array_slice($this->Training_Model->getAllDataArray(), 0, $this->session->total_data_train);
    $init_array = $this->Training_Model->getAllDataArray();
    $new_array = [];
    for($i = 0; $i < $this->session->userdata('total_train_data'); $i++):
      $random_int = mt_rand(0, sizeof($init_array)-1);
      // echo '<br/>Rand: ';
      // echo $random_int;
      // echo '<br/>Size: ';
      // echo sizeof($init_array);
      // echo '<br/>Max: ';
      // echo sizeof($init_array)-1;
      $picked_index = $init_array[$random_int];
      array_push($new_array, $picked_index);
      unset($init_array[$random_int]);
      $init_array = array_values($init_array);
    endfor;
    return $new_array;
  }

  public function calculation() {
		if (empty($this->session->userdata('total_train_data'))) {
      $this->session->set_flashdata(['msg' => 'Jumlah Data Training']);
      redirect(base_url('initialize'));
    }

    $this->session->unset_userdata('performance');

    // Classifying Naive Bayes
    $this->classifying();

    // uji Perfrma Confusion Matrix
    $this->confusionMatrix();

    redirect(base_url('performance'));
  }

  // Confusion Matrix
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
    $this->session->set_userdata(['confusion_matrix'=>['accuration' => $accurating, 'precition' => $precition, 'recall' => $recall, 'details' => ['tp' => $TP, 'tn' => $TN, 'fp' => $FP, 'fn' => $FN]]]);
  }

  // Naive Baiyes
  public function classifying() {
    // $trainings = $this->Training_Model->getAllDataArray();
    $trainings = $this->Training_Model->getAllDataAfterLimited('asc');
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
      $jumlah_layak = $this->Training_Model->count_layak();
      $jumlah_tidak_layak = $this->Training_Model->count_tidaklayak();
      $total_training = $jumlah_layak+$jumlah_tidak_layak;
      // echo ($this->session->userdata('total_train_data') ?? 0);
      // echo $jumlah_layak;
      // echo $jumlah_tidak_layak;
      // echo $total_training;
      // return;
      $b_indo = $this->Training_Model->convert('b_indo',$row['b_indo']);
      $agama = $this->Training_Model->convert('agama',$row['agama']);
      $pancasila = $this->Training_Model->convert('pancasila',$row['pancasila']);
      $umum = $this->Training_Model->convert('umum',$row['umum']);
      $kasi_pem = $this->Training_Model->convert('kasi_pem',$row['kasi_pem']);
      $wawancara = $this->Training_Model->convert('wawancara',$row['wawancara']);

      // $PC1 = number_format($jumlah_layak/($jumlah_tidak_layak+$jumlah_layak), 2);
      // $PC0 = number_format($jumlah_tidak_layak/($jumlah_tidak_layak+$jumlah_layak), 2);
      
      // $kelas_layak = number_format($b_indo['layak'],2)*number_format($agama['layak'], 2)*number_format($pancasila['layak'], 2)*number_format($umum['layak'], 2)*number_format($kasi_pem['layak'], 2)*number_format($wawancara['layak'], 2)*$PC1;
      // $kelas_tidak_layak = number_format($b_indo['tidaklayak'],2)*number_format($agama['tidaklayak'], 2)*number_format($pancasila['tidaklayak'], 2)*number_format($umum['tidaklayak'], 2)*number_format($kasi_pem['tidaklayak'], 2)*number_format($wawancara['tidaklayak'], 2)*$PC0;

      $PC1 = ($jumlah_layak/($jumlah_tidak_layak+$jumlah_layak));
      $PC0 = $jumlah_tidak_layak/($jumlah_tidak_layak+$jumlah_layak);
      
      $kelas_layak = $b_indo['layak']*$agama['layak']*$pancasila['layak']*$umum['layak']*$kasi_pem['layak']*$wawancara['layak']*$PC1;
      $kelas_tidak_layak = $b_indo['tidaklayak']*$agama['tidaklayak']*$pancasila['tidaklayak']*$umum['tidaklayak']*$kasi_pem['tidaklayak']*$wawancara['tidaklayak']*$PC0;
      

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
        'jumlah' => [
          'layak' => $jumlah_layak,
          'tidaklayak' => $jumlah_tidak_layak,
        ],
        'probabilitas_prior' => [
          'layak' => $PC1,
          'tidaklayak' => $PC0,
        ],
        'kelas' => [
          'layak' => $kelas_layak,
          'tidaklayak' => $kelas_tidak_layak,
        ],
        'result' => [
          'type' => $kelas_layak > $kelas_tidak_layak ? 'layak': 'tidak layak',
          'value' => $kelas_layak > $kelas_tidak_layak ? $kelas_layak: $kelas_tidak_layak,
          'default_type' => $row['status_kelayakan']
        ],
        'value' => $kelas_layak > $kelas_tidak_layak ? $kelas_layak: $kelas_tidak_layak,

      ];
      if(strtolower($result['result']['type']) == strtolower($row['status_kelayakan'])) {
        $result['status'] = 'sesuai';
      } else {
        $result['status'] = 'tidak sesuai';
      }
      array_push($results, $result);
    }
    usort($results, function ($item1, $item2) {
        return $item2['value'] <=> $item1['value'];
    });
    // $results = array_slice($results, 0, $this->session->userdata('total_train_data'));
    $this->session->set_userdata(['performance' => $results]);
  }

}




// }
