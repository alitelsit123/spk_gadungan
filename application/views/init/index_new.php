<title>Initialize</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>
<!-- Main Content -->
<div class="main-content">
<section class="content">
<div class="card" style="min-height: 500px;">
  <div class="card-body">
    <div class="table-responsive" style="max-height: 500px;">
      <form action="<?= base_url('initialize/set_number_of_train') ?>" method="post" class="w-100">
        <div class="d-flex align-items-center">
          <label for="" style="width: 100px;">Jumlah</label>
          <input type="number" name="train_data" id="train_data" class="flex-grow-1 form-control mr-2 w-100" max="<?= $max_people ?>" min="1" 
          value="<?= $max_people ?>"
          placeholder="Max <?= $max_people ?>">
          <button type="button" class="btn btn-info ml-2" onClick="document.getElementById('train_data').value = <?= $max_people ?>">Max</button>
          <button type="button" class="btn btn-warning ml-2" onClick="document.location.href='<?= base_url('initialize/reset') ?>'">Reset</button>
          <input type="submit" class="btn btn-primary ml-2" value="Simpan">
        </div>
      </form>
      <?php
        if(!empty($this->session->userdata('msg'))) {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>'.$this->session->flashdata("msg").'!</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
        }
      ?>

    </div>


      <div class="row">
        <div class="card-header"><h5 class="card-title">Conversion</h5></div>

        <div class="col-md-12">
          <div class="table-responsive" style="max-height: 500px;">
            <table class="table">
              <thead>
                <tr>
                  <?php
                    $converted_keys = array_keys($converted[0]);
                    foreach($converted_keys as $attr) {
                      echo '<th>'.$attr.'</th>';
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($converted as $value): ?>
                  <tr>
                    <?php  
                      foreach($converted_keys as $key) {
                        echo '<td>'.$value[$key].'</td>';
                      }
                    ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-header"><h5 class="card-title">Spread Data Total</h5></div>

        <?php foreach($stats as $row=>$values): ?>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th><?= $row ?></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($values as $key=>$sub_value): ?>
                    <tr>
                      <td><?= $key ?></td>
                      <td><?= $sub_value->total ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

  </div>
</div>
</section>