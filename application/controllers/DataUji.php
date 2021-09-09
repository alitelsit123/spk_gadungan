<?php 

/**
 * 
 */
class DataUji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('login'))) {
			redirect('login');
		}
		
		$this->load->model('Uji_Model');
		$this->load->model('Training_Model');
		$this->load->library('form_validation');
	}

	function index()
	{

		$data['training'] = $this->Training_Model->getAllData();
		$this->load->view('uji/index', $data);
		$this->load->view('dist/header');
		$this->load->view('dist/sidebar');
		$this->load->view('dist/footer');
	}

	public function hapus($id)
	{
		$this->Uji_Model->hapus_data($id);
		$this->session->set_flashdata('flash_uji', 'Dihapus');
		redirect('DataUji');
	}

	public function ubah($id)
	{

		$this->form_validation->set_rules("nama", "Nama", "required");
		$this->form_validation->set_rules("b_indo", "Bahasa Indonesia", "required");
		$this->form_validation->set_rules("agama", "Agama", "required");
		$this->form_validation->set_rules("pancasila", "Pansila", "required");
		$this->form_validation->set_rules("umum", "Umum", "required");
		$this->form_validation->set_rules("kasi_pem", "Kasi Pemerintah", "required");
		$this->form_validation->set_rules("wawancara", "Wawancara", "required");


		if ($this->form_validation->run() == FALSE)
		{
			$data['ubah']= $this->Uji_Model->detail_data($id);
			$this->load->view('dist/header');
			$this->load->view('dist/sidebar');
			$this->load->view('uji/ubah', $data);
			$this->load->view('dist/footer');
		}
		else
		{
			$this->Uji_Model->ubah_data();
			$this->session->set_flashdata('flash_uji', 'DiUbah');
			redirect('DataUji');
		} 
	}

	

	function hitung(){
		$output = "";
		$this->form_validation->set_rules("nama", "Nama", "required");
		$this->form_validation->set_rules("b_indo", "Bahasa Indonesia", "required");
		$this->form_validation->set_rules("agama", "Agama", "required");
		$this->form_validation->set_rules("pancasila", "Pancasila", "required");
		$this->form_validation->set_rules("umum", "Umum", "required");
		$this->form_validation->set_rules("kasi_pem", "Kasi Pemerintah", "required");
		$this->form_validation->set_rules("wawancara", "Wawancara", "required");
		// if ($this->form_validation->run() == FALSE)
		// {
		// 	$data['ubah']= $this->Uji_Model->detail_data();
		// 	$this->load->view('uji/ubah', $data);
		// 	$this->load->view('dist/header');
		// 	$this->load->view('dist/sidebar');
		// 	$this->load->view('dist/footer');
		// }
		// else
		// {
			$b_indo = array();
			$agama = array();
			$pancasila = array();
			$umum = array();
			$kasi_pem = array();
			$wawancara = array();

			$jumlah_layak = $this->Training_Model->count_layak();
			$jumlah_tidak_layak = $this->Training_Model->count_tidaklayak();
			$total_training = $jumlah_layak+$jumlah_tidak_layak;
			$b_indo = $this->Training_Model->b_indo($this->input->post('b_indo'));
			$agama = $this->Training_Model->agama($this->input->post('agama'));
			$pancasila = $this->Training_Model->pancasila($this->input->post('pancasila'));
			$umum = $this->Training_Model->umum($this->input->post('umum'));
			$kasi_pem = $this->Training_Model->kasi_pem($this->input->post('kasi_pem'));
			$wawancara = $this->Training_Model->wawancara($this->input->post('wawancara'));

  //perhitungan //Step 1
			
			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th>Jumlah Data</th>
			<th>Kelas PC1(Layak)</th>
			<th>Kelas PC0(Tidak Layak)</th>
			</tr>
			<tr>
			<td>" .$total_training. "</td>
			<td>" .$jumlah_layak. "</td>
			<td>" .$jumlah_tidak_layak. "</td>
			</tr>
			</thead>
			</table>";



   //Step 1
   //tampil
			$PC1 = round($jumlah_layak/($jumlah_tidak_layak+$jumlah_layak), 2);
			$PC0 = round($jumlah_tidak_layak/($jumlah_tidak_layak+$jumlah_layak), 2);

			$kelas_layak = round($b_indo['layak'],2)*round($agama['layak'], 2)*round($pancasila['layak'], 2)*round($umum['layak'], 2)*round($kasi_pem['layak'], 2)*round($wawancara['layak'], 2)*$PC1;

			$kelas_tidak_layak = round($b_indo['tidaklayak'],2)*round($agama['tidaklayak'], 2)*round($pancasila['tidaklayak'], 2)*round($umum['tidaklayak'], 2)*round($kasi_pem['tidaklayak'], 2)*round($wawancara['tidaklayak'], 2)*$PC0;

			$output .= "----Probabilitas Prior----<br>";
			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th>Kelas PC1(Layak)</th>
			<th>Kelas PC0(Tidak Layak)</th>
			</tr>
			<tr>
			<td>" .$PC1. "</td>
			<td>" .$PC0. "</td>
			</tr>
			</thead>
			</table>";




   //STEP 2
			// $output .= "----Probabilitas Posterior----<br>";
			// $output .= "status_PKH : ";
			// $output .= var_dump($status_PKH);
			// $output .= "<br>";
			// $output .= "jumlah tanggungan : ";
			// $output .= var_dump($jumlah_tanggungan);
			// $output .= "<br>";
			// $output .= "kepala_rt : ";
			// $output .= var_dump($kepala_rt);
			// $output .= "<br>";
			// $output .= "kondisi_rumah : ";
			// $output .= var_dump($kondisi_rumah);
			// $output .= "<br>";
			// $output .= "jml_penghasilan : ";
			// $output .= var_dump($jml_penghasilan);
			// $output .= "<br>";
			// $output .= "status_rumah : ";
			// $output .= var_dump($status_rumah);
			// $output .= "<br><br>";


   //step 3
			$output .= "----Probabilitas Data Uji----<br>";
			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th> </th>
			<th>B.Indonesia</th>
			<th>Agama</th>
			<th>Pancasila</th>
			<th>Umum</th>
			<th>Kasi Pemerintah</th>
			<th>Wawancara</th>
			<th>Hasil Proba bilitas</th>
			</tr>
			<tr>
			<td>PC1 (Layak)</th>
			<td>" .round($b_indo['layak'],2). "</td>
			<td>" .round($agama['layak'], 2). "</td>
			<td>" .round($pancasila['layak'], 2). "</td>
			<td>" .round($umum['layak'], 2). "</td>
			<td>".round($kasi_pem['layak'], 2). "</td>
			<td>".round($wawancara['layak'], 2). "</td>
			
			<td>".$kelas_layak."</td>
			</tr>

			<tr>
			<td>PC0 (Tidak Layak)</th>
			<td>" .round($b_indo['tidaklayak'],2). "</td>
			<td>" .round($agama['tidaklayak'], 2). "</td>
			<td>" .round($pancasila['tidaklayak'], 2). "</td>
			<td>" .round($umum['tidaklayak'], 2). "</td>
			<td>".round($kasi_pem['tidaklayak'], 2). "</td>
			<td>".round($wawancara['tidaklayak'], 2). "</td>

			<td>".$kelas_tidak_layak."</td>
			</tr>
			</thead>
			</table>";


			// $output .= "----Probabilitas Data Uji----<br>";
			// $output .= "-PCO (Tidak Layak) <br> ";

			// $output .= "Status PKH: ".round($status_PKH['tidaklayak'],2);
			// $output .= "<br>Jumlah Tanggungan: ".round($jumlah_tanggungan['tidaklayak'], 2);
			// $output .= "<br>Kepala Rumah Tangga: ".round($kepala_rt['tidaklayak'], 2);
			// $output .= "<br>Kondisi Rumah: ".round($kondisi_rumah['tidaklayak'], 2);
			// $output .= "<br>Jumlah Penghasilan: ".round($jml_penghasilan['tidaklayak'], 2);
			// $output .= "<br>Status Rumah: ".round($status_rumah['tidaklayak'], 2);
			// $output .= "<br>Hasil Probabilitas: ";

			// $output .= $kelas_tidak_layak = round($status_PKH['tidaklayak'],2)*round($jumlah_tanggungan['tidaklayak'], 2)*round($kepala_rt['tidaklayak'], 2)*round($kondisi_rumah['tidaklayak'], 2)*round($jml_penghasilan['tidaklayak'], 2)*round($status_rumah['tidaklayak'], 2)*$PC0;

			// $output .= " </br><br>";
			// $output .= "-PC1 (Layak)<br>";

			// $output .= "Status PKH: ".round($status_PKH['layak'],2);
			// $output .= "<br>Jumlah Tanggungan: ".round($jumlah_tanggungan['layak'], 2);
			// $output .= "<br>Kepala Rumah Tangga: ".round($kepala_rt['layak'], 2);
			// $output .= "<br>Kondisi Rumah: ".round($kondisi_rumah['layak'], 2);
			// $output .= "<br>Jumlah Penghasilan: ".round($jml_penghasilan['layak'], 2);
			// $output .= "<br>Status Rumah: ".round($status_rumah['layak'], 2);
			// $output .= "<br> Hasil Probabilitas: ";
			// $output .= $kelas_layak = round($status_PKH['layak'],2)*round($jumlah_tanggungan['layak'], 2)*round($kepala_rt['layak'], 2)*round($kondisi_rumah['layak'], 2)*round($jml_penghasilan['layak'], 2)*round($status_rumah['layak'], 2)*$PC1;
			
			$kesimpulan = "";
			$operator="";

			echo "kelas layak".$kelas_layak."<br>";
			echo "kelas tidak layak".$kelas_tidak_layak."<br>";

			echo "<br>";
			if ($kelas_layak >= $kelas_tidak_layak) {
				$kesimpulan = "layak";
				$operator = ">=";
			}else{
				$kesimpulan = "Tidak layak";
				$operator = "<=";
			}


			$output .= "<br>Dapat disimpulkan Bahwa Data Uji tersebut <b><u>".$kesimpulan."</u></b> dipertimbangkan menjadi Kasie Kelurahan Gadungan";

      // masukan hasil kesimpulan dalam parameter untuk di save
			// $this->Uji_Model->tambah_data($kesimpulan);
			$this->session->set_flashdata('flash_uji','dihitung' );
			$this->session->set_flashdata('flash_hitung', $output );
			redirect('DataUji');
			echo $output;
		} 

	public function cetakLaporan()
  	{
  		$output = "";
		$this->form_validation->set_rules("nama", "Nama", "required");
		$this->form_validation->set_rules("b_indo", "Bahasa Indonesia", "required");
		$this->form_validation->set_rules("agama", "Agama", "required");
		$this->form_validation->set_rules("pancasila", "Pancasila", "required");
		$this->form_validation->set_rules("umum", "Umum", "required");
		$this->form_validation->set_rules("kasi_pem", "Kasi Pemerintah", "required");
		$this->form_validation->set_rules("wawancara", "Wawancara", "required");

			$b_indo = array();
			$agama = array();
			$pancasila = array();
			$umum = array();
			$kasi_pem = array();
			$wawancara = array();

			$jumlah_layak = $this->Training_Model->count_layak();
			$jumlah_tidak_layak = $this->Training_Model->count_tidaklayak();
			$total_training = $jumlah_layak+$jumlah_tidak_layak;
			$b_indo = $this->Training_Model->b_indo($this->input->post('b_indo'));
			$agama = $this->Training_Model->agama($this->input->post('agama'));
			$pancasila = $this->Training_Model->pancasila($this->input->post('pancasila'));
			$umum = $this->Training_Model->umum($this->input->post('umum'));
			$kasi_pem = $this->Training_Model->kasi_pem($this->input->post('kasi_pem'));
			$wawancara = $this->Training_Model->wawancara($this->input->post('wawancara'));

  //perhitungan //Step 1
			
			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th>Jumlah Data</th>
			<th>Kelas PC1(Layak)</th>
			<th>Kelas PC0(Tidak Layak)</th>
			</tr>
			<tr>
			<td>" .$total_training. "</td>
			<td>" .$jumlah_layak. "</td>
			<td>" .$jumlah_tidak_layak. "</td>
			</tr>
			</thead>
			</table>";



   //Step 1
   //tampil
			$PC1 = round($jumlah_layak/($jumlah_tidak_layak+$jumlah_layak), 2);
			$PC0 = round($jumlah_tidak_layak/($jumlah_tidak_layak+$jumlah_layak), 2);

			$kelas_layak = round($b_indo['layak'],2)*round($agama['layak'], 2)*round($pancasila['layak'], 2)*round($umum['layak'], 2)*round($kasi_pem['layak'], 2)*round($wawancara['layak'], 2)*$PC1;

			$kelas_tidak_layak = round($b_indo['tidaklayak'],2)*round($agama['tidaklayak'], 2)*round($pancasila['tidaklayak'], 2)*round($umum['tidaklayak'], 2)*round($kasi_pem['tidaklayak'], 2)*round($wawancara['tidaklayak'], 2)*$PC0;

			$output .= "----Probabilitas Prior----<br>";
			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th>Kelas PC1(Layak)</th>
			<th>Kelas PC0(Tidak Layak)</th>
			</tr>
			<tr>
			<td>" .$PC1. "</td>
			<td>" .$PC0. "</td>
			</tr>
			</thead>
			</table>";






   //step 3
			$output .= "----Probabilitas Data Uji----<br>";
			$output .= "
			<table id='example1' class='table table-bordered table-striped'>
			<thead>
			<tr>
			<th> </th>
			<th>B.Indonesia</th>
			<th>Agama</th>
			<th>Pancasila</th>
			<th>Umum</th>
			<th>Kasi Pemerintah</th>
			<th>Wawancara</th>
			<th>Hasil Proba bilitas</th>
			</tr>
			<tr>
			<td>PC1 (Layak)</th>
			<td>" .round($b_indo['layak'],2). "</td>
			<td>" .round($agama['layak'], 2). "</td>
			<td>" .round($pancasila['layak'], 2). "</td>
			<td>" .round($umum['layak'], 2). "</td>
			<td>".round($kasi_pem['layak'], 2). "</td>
			<td>".round($wawancara['layak'], 2). "</td>
			
			<td>".$kelas_layak."</td>
			</tr>

			<tr>
			<td>PC0 (Tidak Layak)</th>
			<td>" .round($b_indo['tidaklayak'],2). "</td>
			<td>" .round($agama['tidaklayak'], 2). "</td>
			<td>" .round($pancasila['tidaklayak'], 2). "</td>
			<td>" .round($umum['tidaklayak'], 2). "</td>
			<td>".round($kasi_pem['tidaklayak'], 2). "</td>
			<td>".round($wawancara['tidaklayak'], 2). "</td>

			<td>".$kelas_tidak_layak."</td>
			</tr>
			</thead>
			</table>";

  	$kesimpulan = "";
			$operator="";

			echo "kelas layak ".$kelas_layak."<br>";
			echo "kelas tidak layak ".$kelas_tidak_layak;

			echo "<br>";
			if ($kelas_layak >= $kelas_tidak_layak) {
				$kesimpulan = "layak";
				$operator = ">=";
			}else{
				$kesimpulan = "Tidak layak";
				$operator = "<=";
			}


			$output .= "<br>Dapat disimpulkan Bahwa Data Uji tersebut <b><u>".$kesimpulan."</u></b> dipertimbangkan menjadi Kasie Kelurahan Gadungan";

      // masukan hasil kesimpulan dalam parameter untuk di save
			// $this->Uji_Model->tambah_data($kesimpulan);
			$this->session->set_flashdata('flash_uji','dihitung' );
			$this->session->set_flashdata('flash_hitung', $output );
			$this->load->view('cetakLaporan');
  	}
	}




// }
