<title>Cetak Laporan Kelayakan Pemilihan Kasie Desa Gadungan</title>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/header_auth');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="content">
    <!-- NOTIFIKASI -->
    
  <div class="row">
    <div class="col-12">
      <div class="card">
        <!-- card-body -->
        <div class="card-body">
          <div class="modal-body">
          <?php echo $this->session->flashdata('flash_hitung'); ?>
          </div>
          <script type="text/javascript">
            window.print();
          </script>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>