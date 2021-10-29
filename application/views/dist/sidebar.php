<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>welcome">SPK Gadungan</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>dist/index">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              <ul class="dropdown-menu">
                <li class="<?php echo $this->uri->segment(1) == '' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>">Home</a></li>
                <li class="<?php echo $this->uri->segment(1) == 'DataTraining' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>DataTraining">Dataset</a></li>
                <!-- <li class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'DataUji' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>DataUji">Data Uji</a></li> -->
              </ul>
            </li>
            <li class="<?php echo $this->uri->segment(2) == 'credits' ? 'active' : ''; ?>">
              <a href="#" class="nav-link" onclick="if (confirm('Yakin Keluar?')) {document.location.href= '<?php echo base_url(); ?>login/logout'}">
                <i class="fas fa-pencil-ruler"></i> <span>LogOut</span>
              </a>
            </li>
          </ul>
          <ul class="sidebar-menu">
            <li class="menu-header">Mining</li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown" id="dr-togg"><i class="fas fa-fire"></i><span>Data Uji</span></a>
              <ul class="dropdown-menu" style="display: block;">
                <!-- <li class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(2) == 'stat' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('initialize/stat') ?>">Stat</a></li> -->
                <li class="<?php echo $this->uri->segment(2) == '' && $this->uri->segment(1) == 'initialize' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('initialize') ?>">Init</a></li>
                <li class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'performance' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('performance') ?>">Perform</a></li>
                <!-- <li class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'DataUji' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>DataUji">Data Uji</a></li> -->
              </ul>
            </li>
          </ul>

        </aside>
      </div>
