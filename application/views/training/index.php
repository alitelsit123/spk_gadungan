<title>Data Training</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>

<title>Data Training</title>
<div class="main-content">
        <section class="section">
          
    <!-- list data -->
    <div class="row">
      <div class="col-12">

        <div class="card">
          <!-- card-body -->
          <div class="card-header d-flex justify-content-between">
            <h5 class='card-title'>Dataset</h5>
            <button class="btn btn-info" onClick="document.location.href = '<?= base_url('DataTraining/tambahdata') ?>'">Tambah Data</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped"  style="color: black!important;">
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
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
        </section>
      </div>
