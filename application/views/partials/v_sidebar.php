<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Fixed Sidebar</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/fontawesome-free/css/all.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('templates/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('templates/dist/css/adminlte.min.css'); ?>">
  <style>
    @media screen and (max-width: 900px) {
      table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }

      .posyandu-header {
        overflow-x: scroll;
        display: block;
        overflow-x: auto;
        white-space: nowrap;
        text-align: center;
      }
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url() ?>login/logout" type="submit" class="btn btn-danger" onclick="javasciprt: return confirm('Apa Anda Yakin?')">Logout </a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="<?php echo base_url("dashboard"); ?>" class="brand-link">
        <img src="<?php echo base_url('templates/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Posyandu</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url('templates/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $this->session->userdata('nama') ?></a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?php echo base_url("dashboard"); ?>" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <?php
            if ($this->session->userdata('level') == 'admin' || $this->session->userdata('level') == 'bidan') {
            ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Data User
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url("kader"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Kader</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("bidan"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Bidan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("ibu"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Ibu Hamil</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("balita"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Balita</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Data Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url("posyandu"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Posyandu</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("kegiatan"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Kegiatan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("imunisasi_ibu"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Imunisasi Ibu</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("imunisasi_balita"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Imunisasi Balita</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("penyuluhan_ibu"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Penyuluhan Ibu</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("penyuluhan_balita"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Penyuluhan Balita</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tree"></i>
                  <p>
                    Transaksi
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url("jadwal_ibu"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Ibu Hamil</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url("jadwal_balita"); ?>" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Jadwal Balita</p>
                    </a>
                  </li>
                  <?php
                  if ($this->session->userdata('level') == 'admin') {
                  ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url("pesan"); ?>" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Pesan</p>
                      </a>
                    </li>
                  <?php
                  }
                  ?>

                </ul>
              </li>
            <?php
            } else if ($this->session->userdata('level') == 'kader') {
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url("ibu"); ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Data Ibu Hamil
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("balita"); ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Data Balita
                  </p>
                </a>
              </li>
            <?php
            } else {
              redirect('login');
            }
            ?>

          </ul>
        </nav>
      </div>
    </aside>