<title>Performance</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header');
?>
<!-- Main Content -->
<div class="main-content">
<section class="content">
  <div class="card shadow-none">
    <div class="card-header d-flex justify-content-between">
      <h5 class="card-title">Performance</h5>
      <button class="btn btn-primary" type="button" id="print_btn" onClick="download_table_as_csv('result-table')">Download</button>
    </div>
    <div class="card-body">
      <!-- list data -->
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-md-12">
              <?php if(!empty($this->session->userdata('total_train_data'))): ?>
              <div class="table-responsive">
                <table class="table" id="result-table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Nama</th>
                      <th>Probabilitas</th>
                      <th>Kelayakan</th>
                      <th>Hasil Test Kelayakan</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $i=0; foreach($train_data as $row): ?>
                    <tr>
                      <td><?= ++$i ?></td>
                      <td><?= $row['nama'] ?></td>
                      <td><?= round($row['result']['value'], 4) ?></td>
                      <td><?= $row['result']['default_type'] ?></td>
                      <td><?= $row['result']['type'] ?></td>
                      <td><?= $row['status'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive mt-4">
                <table class="table text-center">
                  <thead>
                    <tr>
                      <!-- <th></th> -->
                      <th>TP</th>
                      <th>TN</th>
                      <th>FP</th>
                      <th>FN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $indx = 0 ?>
                    <tr>
                      <!-- <td><?= ++$indx ?></td> -->
                      <td><?= $this->session->confusion_matrix['details']['tp'] ?></td>
                      <td><?= $this->session->confusion_matrix['details']['tn'] ?></td>
                      <td><?= $this->session->confusion_matrix['details']['fp'] ?></td>
                      <td><?= $this->session->confusion_matrix['details']['fn'] ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="row mt-5">
                <!-- <div class="col-md-4"></div> -->
                <div class="col-md-4">
                  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                      <div class="d-flex align-items-stretch">
                        <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-bullhorn"></i></h5></div>
                        <div class="flex-grow-1 text-center">
                          <h5 class="card-title">Accuracy</h5>
                          <h5 class="card-title"><?= round($this->session->confusion_matrix['accuration'], 2) ?>%</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-4"></div> -->
                <div class="col-md-4">
                  <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                      <div class="d-flex align-items-stretch">
                        <div><h5 class="card-title" style="font-size: 56px;"><i class="fa fa-phone"></i></h5></div>
                        <div class="flex-grow-1 text-center">
                          <h5 class="card-title">Recall</h5>
                          <h5 class="card-title"><?= round($this->session->confusion_matrix['recall'], 2) ?>%</h5>
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
                          <h5 class="card-title"><?= round($this->session->confusion_matrix['precition'], 2) ?>%</h5>
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

<script>
var print_el = document.getElementById('print_btn');
function download_table_as_csv(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            // Clean innertext to remove multiple spaces and jumpline (break csv)
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'laporan' + '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

</script>