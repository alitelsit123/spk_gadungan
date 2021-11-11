<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>

<title>Backtest</title>
<div class="main-content">
	<section class="content">
	  <div class="card shadow-none">
	    <div class="card-header d-flex justify-content-between">
	      <h5 class="card-title">Backtest</h5>
	    </div>
	    <div class="card-body" style="min-height: 700px;background: white;">

			<div class="row">
				<div class="col-12">
		      		<h5 class="card-title">Data yang dipilih</h5>
					<table class="table">
	                	<thead>
		                  <tr>
		                    <th></th>
		                    <th>Nama</th>
		                    <th>Point</th>
		                  </tr>
		                </thead>
		                <tbody>
		                <?php $number = 0; ?>
		                  <?php foreach($sorted_data as $value): ?>
		                    <tr>
		                      <td><?= ++$number ?></td>
		                      <td><?= $value['nama'] ?></td>
		                      <td><?= $value['point'] ?></td>
		                    </tr>
		                  <?php endforeach; ?>
		                </tbody>
	              	</table>
				</div>
				<div class="col-12">
		      		<h5 class="card-title">Perform Details</h5>
		      		<p><?= 'PC1: '.$results[0]['probabilitas_prior']['layak'] ?></p>
		      		<p><?= 'PC0: '.$results[0]['probabilitas_prior']['tidaklayak'] ?></p>
		      		<p><?= 'Jumlah Layak: '.$results[0]['jumlah']['layak'] ?></p>
		      		<p><?= 'Jumlah Tidak Layak: '.$results[0]['jumlah']['tidaklayak'] ?></p>
					<div class="table-responsive mb-4">
						<table class="table">
		                	<thead>
			                  <tr>
			                    <th></th>
			                    <th>Nama</th>
			                    <th>BIndo</th>
			                    <th>agama</th>
			                    <th>pancasila</th>
			                    <th>umum</th>
			                    <th>kasi_pem</th>
			                    <th>wawancara</th>
			                  </tr>
			                </thead>
			                <tbody>
			                <?php $number = 0; ?>

			                  <?php foreach($results as $value): ?>
			                    <tr>
			                      <td><?= ++$number ?></td>
			                      <td><?= $value['nama'] ?></td>
			                      <td>
			                      	Layak <?= $value['probabilitas_data_uji']['b_indo']['layak'] ?><br/>
			                      	Tidak Layak <?= $value['probabilitas_data_uji']['b_indo']['tidaklayak'] ?>
			                      </td>
			                      <td>
			                      	Layak <?= $value['probabilitas_data_uji']['agama']['layak'] ?><br/>
			                      	Tidak Layak <?= $value['probabilitas_data_uji']['agama']['tidaklayak'] ?>
			                      </td>
			                      <td>
			                      	Layak <?= $value['probabilitas_data_uji']['pancasila']['layak'] ?><br/>
			                      	Tidak Layak <?= $value['probabilitas_data_uji']['pancasila']['tidaklayak'] ?>
			                      </td>
			                      <td>
			                      	Layak <?= $value['probabilitas_data_uji']['umum']['layak'] ?><br/>
			                      	Tidak Layak <?= $value['probabilitas_data_uji']['umum']['tidaklayak'] ?>
			                      </td>
			                      <td>
			                      	Layak <?= $value['probabilitas_data_uji']['kasi_pem']['layak'] ?><br/>
			                      	Tidak Layak <?= $value['probabilitas_data_uji']['kasi_pem']['tidaklayak'] ?>
			                      </td>
			                      <td>
			                      	Layak <?= $value['probabilitas_data_uji']['wawancara']['layak'] ?><br/>
			                      	Tidak Layak <?= $value['probabilitas_data_uji']['wawancara']['tidaklayak'] ?>
			                      </td>
			                    </tr>
			                  <?php endforeach; ?>
			                </tbody>
		              	</table>
					</div>
					<div class="table-responsive">
						<table class="table">
		                	<thead>
			                  <tr>
			                    <th></th>
			                    <th>Nama</th>
			                    <th>(Result) Layak</th>
			                    <th>(Result) Tidak Layak</th>
			                  </tr>
			                </thead>
			                <tbody>
			                <?php $number = 0; ?>

			                  <?php foreach($results as $value): ?>
			                    <tr>
			                      <td><?= ++$number ?></td>
			                      <td><?= $value['nama'] ?></td>
			                      <td><?= number_format($value['kelas']['layak'], 8) ?></td>
			                      <td><?= number_format($value['kelas']['tidaklayak'], 8) ?></td>
			                    </tr>
			                  <?php endforeach; ?>
			                </tbody>
		              	</table>
		              </div>
				</div>
			</div>
	    </div>
	  </div>
	</section>
</div>