
<title>Login</title>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header_auth');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?php echo base_url(); ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>

              <div class="card-body">
            <form method="post" action="<?= base_url('login/login_aksi');?>">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" autocomplete="off">
                <small><span class="text-danger"><?= form_error('username'); ?></span></small>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" autocomplete="off">
                <small><span class="text-danger"><?= form_error('password'); ?></span></small>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Mega
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
