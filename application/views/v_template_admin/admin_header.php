<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <title><?=strtoupper(@$title)?> | GABRIEL MAJU JAYA FARM</title>
  <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/gambar/icon.ico" /> -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/font-awesome/css/font-awesome.min.css"> 
  <!-- Ionicons --> 
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/Ionicons/css/ionicons.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/dist/css/skins/_all-skins.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Data Table -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/select2/dist/css/select2.min.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>

  <!--sweetalert-->
  <script src="<?php echo base_url('assets/') ?>sweetalert/sweet-alert.js"></script>

  <!-- number format -->
  <script type="text/javascript" src="<?php echo base_url('assets/js/number_format.js') ?>"></script>


<style type="text/css">

#loader {
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    width: 140px;
    height: 45px;
    font-size: 18px;
    opacity: 40%;
}

.clock {
    font-size: 18px;
    color: white;
    margin: 0;
    position: absolute;
    top: 50%;
    left: 37.5vw;
    transform: translateY(-50%);
    background-color: #bd2512;
    padding: 5px 30px 5px 30px;
    border-radius: 50px;
 }

.title-app{
  float: left;
  line-height: 3.7;
  color: white;
  margin-left: 20px;
 }
 @media (max-width: 767px) {
    .clock {
    left: 37vw;
    }
    .title-app{
      display: none; 
    }
  }

</style>

</head>
<body class="hold-transition skin-green-light sidebar-mini">

<div class="wrapper"> 

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><i class="fa fa-pie-chart"></i></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><i class="fa fa-pie-chart" aria-hidden="true"></i> <b>SISMAKU</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="font-size: 14px;">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <span class="title-app">GABRIEL MAJU JAYA FARM</span>

      <span class="clock" id="clock"></span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         <li>
            <a href="#" onclick="refresh()"><i style="padding-top: 5px;" class="fa fa-refresh"></i></a>
          </li>
          <li>
            <a href="#" data-toggle="control-sidebar"><i style="padding-top: 5px;" class="fa fa-gears"></i></a>
          </li>
          
        </ul>
      </div>

      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

          <img src="<?=@$this->server->offline()?>assets/gambar/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image"  style="height: 45px;">

          <!-- <img src="<?php echo base_url() ?>assets/gambar/user/<?php echo $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image"  style="height: 45px;"> -->
          
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('name'); ?></p>
          <a><i class="fa fa-circle text-success"></i> offline</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

          <li class="dashboard">
            <a href="<?php echo base_url() ?>dashboard">
              <i class="fa fa-pie-chart"></i> <span>Dashboard</span>
            </a>
          </li>

          <li class="treeview master">
            <a href="#">
              <i class="fa fa-th-large"></i> <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('kontak/index/s')?>"><i class="fa fa-circle-o"></i> Supplier</a></li>
              <li><a href="<?=base_url('karyawan')?>"><i class="fa fa-circle-o"></i> Karyawan</a></li>
            </ul>
          </li>

          <li class="treeview gudang">
            <a href="#">
              <i class="fa fa-dropbox"></i> <span>Master Gudang</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="telur_sub"><a href="<?=base_url('barang/telur')?>"><i class="fa fa-circle-o"></i> Telur</a></li>
              <li class="pakan_sub"><a href="<?=base_url('barang/pakan')?>"><i class="fa fa-circle-o"></i> Pakan</a></li>
              <li class="obat_sub"><a href="<?=base_url('barang/obat')?>"><i class="fa fa-circle-o"></i> Obat</a></li>
              <li class="kotoran_sub"><a href="<?=base_url('barang/kotoran')?>"><i class="fa fa-circle-o"></i> Kotoran</a></li>
              <li class="ayam_sub"><a href="<?=base_url('barang/ayam')?>"><i class="fa fa-circle-o"></i> Ayam</a></li>
              <li class="afkir_sub"><a href="<?=base_url('afkir')?>"><i class="fa fa-circle-o"></i> Afkir</a></li>
            </ul>
          </li>

          <li class="treeview pembelian">
            <a href="#">
              <i class="fa fa-shopping-basket"></i> <span>Pembelian</span>
              <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i>
                <small style="display: none;" class="label pull-right bg-red pembelian_notif">Jatuh Tempo</small>
              </span>
            </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('pembelian/transaksi')?>"><i class="fa fa-circle-o"></i> Transaksi</a></li>
            </ul>
          </li>

          <li class="treeview recording">
            <a href="#">
              <i class="fa fa-paste"></i> <span>Recording</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('recording/harian')?>"><i class="fa fa-circle-o"></i> Harian</a></li>
            </ul>
          </li>

          <li class="treeview penjualan">
            <a href="#">
              <i class="fa fa-shopping-cart"></i> <span>Penjualan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                <small style="display: none;" class="label pull-right bg-red penjualan_notif">Jatuh Tempo</small>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('penjualan/transaksi')?>"><i class="fa fa-circle-o"></i> Transaksi</a></li>
            </ul>
          </li>

          <li class="treeview laporan">
            <a href="#">
              <i class="fa fa-file-text"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('laporan/pembelian')?>"><i class="fa fa-circle-o"></i> Pembelian</a></li>
              <li><a href="<?=base_url('laporan/penjualan')?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            </ul>
          </li>

          <li class="treeview absensi">
            <a href="#">
              <i class="fa fa-check-square-o"></i> <span>Absensi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('absen/harian')?>"><i class="fa fa-circle-o"></i> Harian</a></li>
              <li><a href="<?=base_url('absen/riwayat')?>"><i class="fa fa-circle-o"></i> Riwayat</a></li>
            </ul>
          </li>

          <li class="treeview gaji">
            <a href="#">
              <i class="fa fa-tasks"></i> <span>Gaji Karyawan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('gaji/bulan')?>"><i class="fa fa-circle-o"></i> Bulan Ini</a></li>
              <li><a href="<?=base_url('gaji/riwayat')?>"><i class="fa fa-circle-o"></i> Riwayat</a></li>
            </ul>
          </li>

          <li class="treeview user">
            <a href="#">
              <i class="fa fa-user-plus"></i> <span>User</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?=base_url('user')?>"><i class="fa fa-circle-o"></i> Akun</a></li>
            </ul>
          </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active">
       <ul class="control-sidebar-menu">
          <li>
            <a style="color: #444444;" href="<?php echo base_url() ?>profile">
              <i class="fa fa-user-circle-o"></i><span> &#160;&#160;Profile</span>
            </a>
          </li>

          <li>
            <a style="color: #444444;" href="#" onclick="logout('<?php echo base_url('login/logout') ?>')">
              <i class="fa fa-sign-out"></i><span> &#160;&#160;Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
<button style="display: none;" id="loader" class="btn btn-danger" type="button" disabled>
  <i class="fa fa-spinner fa-spin"></i>
  Loading...
</button>

  