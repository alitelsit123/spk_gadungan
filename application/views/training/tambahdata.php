<title>Data Training</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>

<title>Data Training</title>
<div class="main-content">
        <section class="section">
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
                      <input type="number" min="0" max="100" class="form-control" id="exampleInputPassword1" name="b_indo">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Agama</label>
                      <input type="number" min="0" max="100" class="form-control" id="exampleInputPassword1" name="agama">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Pancasila</label>
                      <input type="number" min="0" max="100" class="form-control" id="exampleInputPassword1" name="pancasila">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Pengetahuan Umum</label>
                      <input type="number" min="0" max="100" class="form-control" id="exampleInputPassword1" name="umum">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Kasi Pemerintahan</label>
                      <input type="number" min="0" max="100" class="form-control" id="exampleInputPassword1" name="kasi_pem">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Wawancara</label>
                      <input type="number" min="0" max="100" class="form-control" id="exampleInputPassword1" name="wawancara">
                    </div>
                    <!-- <div class="form-group">
                      <label>Status Kelayakan</label>
                      <select class="form-control" name="status_kelayakan">
                        <option value="layak">Layak</option>
                        <option value="tidak layak">Tidak Layak</option>
                      </select>
                    </div> -->

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
    
        </section>
      </div>

<script>
var nama_el = document.querySelector('input[name="nama"]');
var b_indo_el = document.querySelector('input[name="b_indo"]');
var agama_el = document.querySelector('input[name="agama"]');
var pancasila_el = document.querySelector('input[name="pancasila"]');
var umum_el = document.querySelector('input[name="umum"]');
var kasi_pem_el = document.querySelector('input[name="kasi_pem"]');
var wawancara_el = document.querySelector('input[name="wawancara"]');

function check(e) {
    let o = e.target.value;
    let n = e.data;
    if(/^(0)(0)+$/.test(o)) {
      e.target.value = "0";
    } else if(/^(100)\d+/.test(o)) {
      e.target.value = o.slice(0,3);  
    } else if(parseInt(o) > 100) {
      e.target.value = o.slice(0,2);
      // console.log(parseInt(o))
    }
};
var a = [b_indo_el, agama_el, pancasila_el, umum_el, kasi_pem_el, wawancara_el];
a.map(function(item) {
  item.addEventListener('input', function(e) {check(e)}, false);
})

</script>