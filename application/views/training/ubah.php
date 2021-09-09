<title>Data Training</title>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Ubah Data</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <?= validation_errors(); ?>
                <form action="" method="post" accept-charset="utf-8">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">id Training</label>
                      <input type="text" class="form-control disabled" name="id_training" value="<?= $ubah['id_training'] ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" class="form-control"name="nama" value="<?= $ubah['nama'] ?>">
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
        </section>
      </div>

