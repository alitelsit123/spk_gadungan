<title>Initialize</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="content">
    <!-- NOTIFIKASI -->
    <!-- <?php 
    if ($this->session->flashdata('flash_uji')){ ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i> 
          Data Berhasil 
          <strong>
            <?= $this->session->flashdata('flash_uji');   ?>
          </strong> 
        </h6>
      </div>
    <?php } ?> -->
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <!-- <div class="card-header">
            <h5 class="card-title">Input Data Testing</h5>            
            
          </div> -->
          <!-- /.card-header -->
          <div class="card-body">
            <?php
              if(!empty($this->session->userdata('error_msg'))) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>'.$this->session->flashdata("error_msg").'!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
              }
            ?>
            <div class="row">
              <!-- <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <strong>Note!</strong> Input Angka
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div> -->

              <!-- <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url('performance/calculation') ?>" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Bahasa Indonesia</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="b_indo" value="<?php echo !empty($this->session->userdata('old_input')) ? $this->session->userdata('old_input')['b_indo']:'' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Agama</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="agama"
                          value="<?php echo !empty($this->session->userdata('old_input')) ? $this->session->userdata('old_input')['agama']:'' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Pancasila</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="pancasila"
                          value="<?php echo !empty($this->session->userdata('old_input')) ? $this->session->userdata('old_input')['pancasila']:'' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Pengetahuan Umum</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="umum"
                          value="<?php echo !empty($this->session->userdata('old_input')) ? $this->session->userdata('old_input')['umum']:'' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Kasi Pemerintahan</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="kasi_pem"
                          value="<?php echo !empty($this->session->userdata('old_input')) ? $this->session->userdata('old_input')['kasi_pem']:'' ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Wawancara</label>
                          <input type="text" class="form-control" id="exampleInputPassword1" name="wawancara"
                          value="<?php echo !empty($this->session->userdata('old_input')) ? $this->session->userdata('old_input')['wawancara']:'' ?>">
                        </div>
                      </div>

                    </div>
                  <button type="button" class="btn btn-danger" onClick="
                    <?= empty($this->session->userdata('old_input')) ? '': "document.location.href= '".base_url('initialize/reset')."'" ?>
                  ">Reset</button>
                  <input type="submit" name="save" class="btn btn-primary" value="Save">
                </div>
              </form>
            </div> -->
          </div>
          <!-- /.row -->
        </div>
        <!-- ./card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- list data -->
  <!-- <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="modal-body">
          <?php echo $this->session->flashdata('flash_hitung'); ?>
        </div>
        <div class="col mt-3">
          <a href="<?= base_url('DataUji/cetakLaporan'); ?>" class="btn btn-default"><i class="fas fa-print"> Cetak Laporan</i></a>
        </div>
        </div>
      </div>
    </div>
  </div> -->
  
</section>