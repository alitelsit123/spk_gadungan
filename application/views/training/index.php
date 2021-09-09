<title>Data Training</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>

<title>Data Training</title>
<div class="main-content">
        <section class="section">
          <?php 
    if ($this->session->flashdata('flash_training')){ ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h6>
          <i class="icon fas fa-check"></i> 
          Data Berhasil 
          <strong>
            <?= $this->session->flashdata('flash_training');   ?>
          </strong> 
        </h6>
      </div>
    <?php } ?>
    <!-- tambah data -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tambah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="<?= base_url() ?>DataTraining/validation_form" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Id Training</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="id_training">
                    </div> -->
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
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
                    <div class="form-group">
                      <label>Status Kelayakan</label>
                      <select class="form-control" name="status_kelayakan">
                        <option value="layak">Layak</option>
                        <option value="tidak layak">Tidak Layak</option>
                      </select>
                    </div>

                    <input type="submit" name="save" class="btn btn-primary" value="Save">
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
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Bahasa Indonesia</th>
                  <th>Agama</th>
                  <th>Pancasila</th>
                  <th>Pengetahuan Umum</th>
                  <th>Kasi Pemerintahan</th>
                  <th>Tes Wawancara</th>
                  <th>Status Kelayakan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no=1;
                foreach ($training as $row){ ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->b_indo ?></td>
                    <td><?= $row->agama ?></td>
                    <td><?= $row->pancasila ?></td>
                    <td><?= $row->umum ?></td>
                    <td><?= $row->kasi_pem ?></td>
                    <td><?= $row->wawancara ?></td>
                    <td><?= $row->status_kelayakan ?></td>


                    <td>
                      <div class="btn-group">
                        <a href="<?= base_url() ?>DataTraining/hapus/<?= $row->id_training ?>" class="btn btn-danger" onclick="return confirm('yakin ?')">Hapus</a>
                        <a href="<?= base_url() ?>DataTraining/ubah/<?= $row->id_training ?>" class="btn btn-warning">update</a>
                      </div>
                    </td>
                  </tr>
                  <?php 
                  $no++;
                } 
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
        </section>
      </div>