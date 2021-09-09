<title>Performance</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>
<!-- Main Content -->
<div class="main-content">
<section class="content">
  <div class="card shadow-none">
    <!-- <div class="card-header">
      <h5 class="card-title">Performance</h5>
    </div> -->
    <div class="card-body">
      <!-- list data -->
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-md-12">
              <?php if(!empty($this->session->userdata('total_train_data'))): ?>
              <h6 class="modal-title pb-2">Hasil Uji Data Menggunakan <?= $this->session->userdata('total_train_data') ?> Data Training</h6>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Probabilitas</th>
                      <th>Kelayakan</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($train_data as $row): ?>
                    <tr>
                      <td><?= $row['nama'] ?></td>
                      <td><?= $row['result']['value'] ?></td>
                      <td><?= $row['result']['default_type'] ?></td>
                      <td><?= $row['status'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                      <div class="d-flex align-items-stretch">
                        <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-bullhorn"></i></h5></div>
                        <div class="flex-grow-1 text-center">
                          <h5 class="card-title">Accuracy</h5>
                          <h5 class="card-title"><?= $this->session->confusion_matrix['accuration'] ?>%</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                      <div class="d-flex align-items-stretch">
                        <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-phone"></i></h5></div>
                        <div class="flex-grow-1 text-center">
                          <h5 class="card-title">Recall</h5>
                          <h5 class="card-title"><?= $this->session->confusion_matrix['recall'] ?>%</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                      <div class="d-flex align-items-stretch">
                        <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-math"></i></h5></div>
                        <div class="flex-grow-1 text-center">
                          <h5 class="card-title">Precision</h5>
                          <h5 class="card-title"><?= $this->session->confusion_matrix['precition'] ?>%</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- <h6 class="modal-title">Data Testing</h6>
              <table class="table">
                <thead>
                  <tr>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                  </tr>
                </tbody>
              </table> -->
              <?php endif; ?>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

  </div>
  
</section>