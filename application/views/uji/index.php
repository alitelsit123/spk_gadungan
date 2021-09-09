<title>Data Uji</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="content">
    <!-- NOTIFIKASI -->
    <?php 
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
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Uji Data</h5>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url() ?>DataUji/hitung" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Id Training</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="id_training">
                    </div> -->
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama Penduduk</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="nama">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Bahasa Indonesia</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="b_indo">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Agama</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="agama">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Pancasila</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="pancasila">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Pengetahuan Umum</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="umum">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Kasi Pemerintahan</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="kasi_pem">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Wawancara</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="wawancara">
                    </div>
                    <!-- <div class="form-group">
                      <label>Status Kelayakan</label>
                      <select class="form-control" name="status_kelayakan">
                        <option value="layak">Layak</option>
                        <option value="tidak layak">Tidak Layak</option>
                      </select>
                    </div>
                  -->
                  <input type="submit" name="save" class="btn btn-primary" value="Uji">
                </div>
                <!-- /.card-body -->
              </form>
            </div>
            <!-- /.col -->
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
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- card-body -->
        <div class="card-body">
          <div class="modal-body">
          <?php echo $this->session->flashdata('flash_hitung'); ?>
        </div>
        <div class="col mt-3">
          <a href="<?= base_url('DataUji/cetakLaporan'); ?>" class="btn btn-default"><i class="fas fa-print"> Cetak Laporan</i></a>
        </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>