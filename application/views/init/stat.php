<title>Stat</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>
<!-- Main Content -->
<div class="main-content">
<section class="content">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-body">
              <div class="d-flex align-items-stretch">
                <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-bullhorn"></i></h5></div>
                <div class="flex-grow-1 text-center">
                  <h5 class="card-title">Total</h5>
                  <h5 class="card-title"><?= $total ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-body">
              <div class="d-flex align-items-stretch">
                <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-broadcast-tower"></i></h5></div>
                <div class="flex-grow-1 text-center">
                  <h5 class="card-title">Layak</h5>
                  <h5 class="card-title"><?= $layak ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-body">
              <div class="d-flex align-items-stretch">
                <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-bug"></i></h5></div>
                <div class="flex-grow-1 text-center">
                  <h5 class="card-title">Unlayak</h5>
                  <h5 class="card-title"><?= $unlayak ?></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
  </div>

  </div>
  
</section>