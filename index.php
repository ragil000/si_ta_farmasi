<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Administrasi | Farmasi UHO</title>
  <link rel="shortcut icon" href="img/farmasi_logo.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="template/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="template/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="template/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="template/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="template/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="template/plugins/iCheck/all.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="template/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="template/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="template/dist/css/skins/_all-skins.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="css/custom.css">
  <link rel="stylesheet" href="alert/css/sweetalert.css">
	<!-- <link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/demo.css">
	<link rel="stylesheet" type="text/css" href="css/component.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="template/dist/css/skins/_all-skins.min.css">

  <!-- link style dokumen nilai_proposal -->
  <!-- <link rel="stylesheet" href="dokumen/nilai_proposal.html/base.min.css"/>
  <link rel="stylesheet" href="dokumen/nilai_proposal.html/fancy.min.css"/>
  <link rel="stylesheet" href="dokumen/nilai_proposal.html/main.css"/> -->

  <!-- link style dokumen rekomendasi -->
  <!-- <link rel="stylesheet" href="dokumen/rekomendasi.html/base.min.css"/>
  <link rel="stylesheet" href="dokumen/rekomendasi.html/fancy.min.css"/>
  <link rel="stylesheet" href="dokumen/rekomendasi.html/main.css"/> -->

</head>
<body class="hold-transition skin-blue fixed sidebar-mini">

<?php
  include ('class/Class.php');

  if(empty($_SESSION['id_table_akun'])){
    echo "<script>window.location='login/index.php';</script>";
  }

  $sqlGlobal = "SELECT * FROM table_data_akun da, table_akun a WHERE da.id_table_data_akun = a.id_table_data_akun AND id_table_akun = '$_SESSION[id_table_akun]'";
  $getDataGlobal = $query->select($sqlGlobal);
  $dataGlobal = mysqli_fetch_array($getDataGlobal);

  $halaman = 'BERANDA';
  $menuBeranda = 'active';
  $menuDataAkun = '';
  $menuPengaturanAkun = '';
  $menuDokumen = '';
  $menuDataAkunAdmin = '';
  $menuDataDosen = '';
  $halamanDokumen = '';
  $menuProposal = '';
  $menuHasil = '';
  $menuSkripsi = '';
  if(isset($_GET['halaman'])){
    if($_GET['halaman']=='data_akun_mahasiswa'){
      $menuDataAkun = 'active';
      $menuBeranda = '';
      $menuPengaturanAkun = '';
      $menuDokumen = '';
      $halaman = 'DATA AKUN MAHASISWA';
      $menuDataAkunAdmin = '';
      $menuDataDosen = '';
      $halamanDokumen = '';
      $menuProposal = '';
      $menuHasil = '';
      $menuSkripsi = '';
    }else if($_GET['halaman']=='view_akun_mahasiswa'){
      $menuDataAkun = 'active';
      $menuBeranda = '';
      $menuPengaturanAkun = '';
      $menuDokumen = 'active';
      $halaman = 'DOKUMEN UNDUHAN';
      $menuDataAkunAdmin = '';
      $menuDataDosen = '';
      $halamanDokumen = '';
      $menuProposal = '';
      $menuHasil = '';
      $menuSkripsi = '';

      if(isset($_GET['menu'])){
        if($_GET['menu']=='halaman_proposal'){
          $halaman = 'DOKUMEN PROPOSAL';
          $halamanDokumen = 'active';
          $menuProposal = 'active';
          $menuHasil = '';
          $menuSkripsi = '';
        }else if($_GET['menu']=='halaman_hasil'){
          $halaman = 'DOKUMEN HASIL';
          $halamanDokumen = 'active';
          $menuProposal = '';
          $menuHasil = 'active';
          $menuSkripsi = '';
        }else if($_GET['menu']=='halaman_skripsi'){
          $halaman = 'DOKUMEN SKRIPSI';
          $halamanDokumen = 'active';
          $menuProposal = '';
          $menuHasil = '';
          $menuSkripsi = 'active';
        }
      }
    }else if($_GET['halaman']=='profile_akun'){
      $menuDataAkun = '';
      $menuBeranda = '';
      $menuPengaturanAkun = 'active';
      $menuDokumen = '';
      $halaman = 'PROFIL';
      $menuDataAkunAdmin = '';
      $menuDataDosen = '';
      $halamanDokumen = '';
      $menuProposal = '';
      $menuHasil = '';
      $menuSkripsi = '';
    }else if($_GET['halaman']=='dashboard'){
      $menuDataAkun = '';
      $menuBeranda = 'active';
      $menuPengaturanAkun = '';
      $menuDokumen = '';
      $halaman = 'BERANDA';
      $menuDataAkunAdmin = '';
      $menuDataDosen = '';
      $halamanDokumen = '';
      $menuProposal = '';
      $menuHasil = '';
      $menuSkripsi = '';
    }else if($_GET['halaman']=='data_akun_admin'){
      $menuDataAkun = '';
      $menuBeranda = '';
      $menuPengaturanAkun = '';
      $menuDokumen = '';
      $halaman = 'DATA AKUN ADMIN';
      $menuDataAkunAdmin = 'active';
      $menuDataDosen = '';
      $halamanDokumen = '';
      $menuProposal = '';
      $menuHasil = '';
      $menuSkripsi = '';
    }else if($_GET['halaman']=='data_dosen'){
      $menuDataAkun = '';
      $menuBeranda = '';
      $menuPengaturanAkun = '';
      $menuDokumen = '';
      $halaman = 'DATA DOSEN';
      $menuDataAkunAdmin = '';
      $menuDataDosen = 'active';
      $halamanDokumen = '';
      $menuProposal = '';
      $menuHasil = '';
      $menuSkripsi = '';
    }
  }
?>

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img style="width:50px" src="img/farmasi_logo.png"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>FARMASI</b> UHO</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki 10 notifikasi</li>
              <li>

                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li> -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="img/<?=$dataGlobal['table_data_akun_foto']?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$dataGlobal['table_data_akun_nama']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="img/<?=$dataGlobal['table_data_akun_foto']?>" class="img-circle" alt="User Image">

                <?php
                  if(isset($_SESSION['table_akun_level'])){
                    if($_SESSION['table_akun_level'] == 'Administrator'){
                ?>
                <p>
                  <?=$dataGlobal['table_data_akun_nama']?>
                  <small><?=$_SESSION['table_akun_level']?></small>
                </p>
                <?php
                    }else if($_SESSION['table_akun_level'] == 'Mahasiswa'){
                ?>
                <p>
                  <?=$dataGlobal['table_data_akun_nama']?> - <?=$dataGlobal['table_data_akun_nim']?>
                  <small><?=$_SESSION['table_akun_level']?></small>
                </p>
                <?php
                    }
                  }
                ?>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?halaman=profile_akun" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="index.php?halaman=keluar" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
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
          <img src="img/<?=$dataGlobal['table_data_akun_foto']?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$dataGlobal['table_data_akun_nama']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?=$_SESSION['table_akun_level']?></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <li class="<?=$menuBeranda?>">
          <a href="index.php?halaman=dashboard">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <?php
          if(isset($_SESSION['table_akun_level'])){
            if($_SESSION['table_akun_level'] == 'Administrator'){
        ?>

        <li class="<?=$menuDataAkun?>">
          <a href="index.php?halaman=data_akun_mahasiswa">
            <i class="fa fa-users"></i> <span>Data Akun Mahasiswa</span>
          </a>
        </li>
        <li class="<?=$menuDataAkunAdmin?>">
          <a href="index.php?halaman=data_akun_admin">
            <i class="fa fa-users"></i> <span>Data Akun Admin</span>
          </a>
        </li>
        <li class="<?=$menuDataDosen?>">
          <a href="index.php?halaman=data_dosen">
            <i class="fa fa-users"></i> <span>Data Dosen</span>
          </a>
        </li>

        <?php
            }else if($_SESSION['table_akun_level'] == 'Mahasiswa'){
        ?>

        <li class="treeview <?=$halamanDokumen?> menu-open">
          <a href="#">
            <i class="fa fa-clone"></i>
            <span>Dokumen Unduhan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php
                if($dataGlobal['table_akun_tahap_proposal'] == 'aktif'){
            ?>

            <li class="<?=$menuProposal?>"><a href="index.php?halaman=view_akun_mahasiswa&menu=halaman_proposal"><i class="fa fa-file-word-o"></i> Proposal</a></li>

            <?php
                }
                if($dataGlobal['table_akun_tahap_hasil'] == 'aktif'){
            ?>

            <li class="<?=$menuHasil?>"><a href="index.php?halaman=view_akun_mahasiswa&menu=halaman_hasil"><i class="fa fa-file-word-o"></i> Hasil</a></li>

            <?php
                }
                if($dataGlobal['table_akun_tahap_skripsi'] == 'aktif'){
            ?>

            <li class="<?=$menuSkripsi?>"><a href="index.php?halaman=view_akun_mahasiswa&menu=halaman_skripsi"><i class="fa fa-file-word-o"></i> Skripsi</a></li>

            <?php
                }
            ?>

          </ul>
        </li>

        <?php
            }
          }
        ?>

        <li class="header">MENU PROFIL</li>
        <li class="<?=$menuPengaturanAkun?>">
          <a href="index.php?halaman=profile_akun">
            <i class="fa fa-sliders"></i> <span>Pengaturan Akun</span>
          </a>
        </li>
        <li>
          <a href="index.php?halaman=keluar">
            <i class="fa fa-power-off"></i> <span>Keluar</span>
          </a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>HALAMAN</small>
        <?=$halaman?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active" style="text-transform: capitalize"><?=$halaman?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_GET['halaman'])){
          if($_GET['halaman']=='berita_acara'){
            include ('dokumen/berita_acara.html/berita_acara.php');
          }else if($_GET['halaman']=='kesediaan_penguji'){
            include ('dokumen/kesediaan_penguji.html/kesediaan_penguji.php');
          }else if($_GET['halaman']=='data_akun_mahasiswa'){
            include ('data_akun_mahasiswa.php');
          }else if($_GET['halaman']=='keluar'){
            $admin->logout();
            echo "<script>window.location='index.php';</script>";
          }else if($_GET['halaman']=='view_akun_mahasiswa'){
            if($_SESSION['table_akun_level'] == 'Administrator'){
              include ('view_akun_mahasiswa.php');
            }else if($_SESSION['table_akun_level'] == 'Mahasiswa'){
              if(isset($_GET['menu'])){
                if($_GET['menu'] == 'halaman_proposal'){
                  include ('halaman_proposal.php');
                }else if($_GET['menu'] == 'halaman_hasil'){
                  include ('halaman_hasil.php');
                }else if($_GET['menu'] == 'halaman_skripsi'){
                  include ('halaman_skripsi.php');
                }
              }
            }
          }else if($_GET['halaman']=='dashboard'){
            if($_SESSION['table_akun_level'] == 'Administrator'){
              include ('dashboard.php');
            }else if($_SESSION['table_akun_level'] == 'Mahasiswa'){
              include ('landing.php');
            }
          }else if($_GET['halaman']=='profile_akun'){
            include ('profile_akun.php');
          }else if($_GET['halaman']=='data_akun_admin'){
            include ('data_akun_admin.php');
          }else if($_GET['halaman']=='data_dosen'){
            include ('data_dosen.php');
          }
        }else{
          if($_SESSION['table_akun_level'] == 'Administrator'){
            include ('dashboard.php');
          }else if($_SESSION['table_akun_level'] == 'Mahasiswa'){
            include ('landing.php');
          }
        }

        if(isset($_GET['aksi'])){
          if($_GET['aksi'] == 'hapus'){
            $id_table_akun = $_GET['id_table_akun'];
            $getDataK = $query->select("SELECT * FROM table_akun a, table_data_akun da WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = '$id_table_akun'");
            $dataK = mysqli_fetch_array($getDataK);
            $id_table_data_akun = $dataK['id_table_data_akun'];
            $target = "img/".$dataK['table_data_akun_foto'];

            $query->delete("DELETE FROM table_data_akun WHERE id_table_data_akun = '$id_table_data_akun'");
            $query->delete_image($target);
            echo "<script>window.location='index.php?halaman=data_akun_mahasiswa';</script>";
          }else if($_GET['aksi'] == 'aktif'){
            $sqlK = "UPDATE table_akun SET table_akun_ket = 'aktif' WHERE id_table_akun = '$_GET[id_table_akun]'";
            $query->update($sqlK);
            echo "<script>window.location='index.php?halaman=data_akun_mahasiswa&ketAkun=nonaktif';</script>";
          }else if($_GET['aksi'] == 'nonaktif'){
            $sqlK = "UPDATE table_akun SET table_akun_ket = 'nonaktif' WHERE id_table_akun = '$_GET[id_table_akun]'";
            $query->update($sqlK);
            echo "<script>window.location='index.php?halaman=data_akun_mahasiswa&ketAkun=aktif';</script>";
          }else if($_GET['aksi'] == 'hapusDosen'){
            $id_table_dosen = $_GET['id_table_dosen'];
            $query->delete("DELETE FROM table_dosen WHERE id_table_dosen = '$id_table_dosen'");
            echo "<script>window.location='index.php?halaman=data_dosen';</script>";
          }else if($_GET['aksi'] == 'hapusAdmin'){
            $id_table_akun = $_GET['id_table_akun'];
            $getDataK = $query->select("SELECT * FROM table_akun a, table_data_akun da WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = '$id_table_akun'");
            $dataK = mysqli_fetch_array($getDataK);
            $id_table_data_akun = $dataK['id_table_data_akun'];
            $target = "img/".$dataK['table_data_akun_foto'];

            $query->delete("DELETE FROM table_data_akun WHERE id_table_data_akun = '$id_table_data_akun'");
            $query->delete_image($target);
            echo "<script>window.location='index.php?halaman=data_akun_admin';</script>";
          }
        }

        if(isset($_GET['tahapAksi'])){
          if($_GET['tahapAksi'] == 'aktif'){
            if(isset($_GET['tahap'])){
              $id_table_akunT = $_GET['id_table_akun'];
              if($_GET['tahap'] == 'proposal'){
                $sqlP = "UPDATE table_akun SET table_akun_tahap_proposal = 'aktif' WHERE id_table_akun = '$id_table_akunT'";
                $query->update($sqlP);
                echo "<script>window.location='index.php?halaman=view_akun_mahasiswa&menu=halaman_proposal&pilihan=halamanProposal&dokumen=BeritaAcaraP&id_table_akun=$id_table_akunT';</script>";
              }else if($_GET['tahap'] == 'hasil'){
                $sqlH = "UPDATE table_akun SET table_akun_tahap_hasil = 'aktif' WHERE id_table_akun = '$id_table_akunT'";
                $query->update($sqlH);
                echo "<script>window.location='index.php?halaman=view_akun_mahasiswa&menu=halaman_hasil&pilihan=halamanHasil&dokumen=BeritaAcaraH&id_table_akun=$id_table_akunT';</script>";
              }else if($_GET['tahap'] == 'skripsi'){
                $sqlS = "UPDATE table_akun SET table_akun_tahap_skripsi = 'aktif' WHERE id_table_akun = '$id_table_akunT'";
                $query->update($sqlS);
                echo "<script>window.location='index.php?halaman=view_akun_mahasiswa&menu=halaman_skripsi&pilihan=halamanSkripsi&dokumen=BeritaAcaraS&id_table_akun=$id_table_akunT';</script>";
              }
            }
          }else if($_GET['tahapAksi'] == 'nonaktif'){
            if(isset($_GET['tahap'])){
              $id_table_akunT = $_GET['id_table_akun'];
              if($_GET['tahap'] == 'proposal'){
                $sqlP = "UPDATE table_akun SET table_akun_tahap_proposal = 'nonaktif' WHERE id_table_akun = '$id_table_akunT'";
                $query->update($sqlP);
                echo "<script>window.location='index.php?halaman=view_akun_mahasiswa&menu=halaman_proposal&pilihan=halamanProposal&dokumen=BeritaAcaraP&id_table_akun=$id_table_akunT';</script>";
              }else if($_GET['tahap'] == 'hasil'){
                $sqlH = "UPDATE table_akun SET table_akun_tahap_hasil = 'nonaktif' WHERE id_table_akun = '$id_table_akunT'";
                $query->update($sqlH);
                echo "<script>window.location='index.php?halaman=view_akun_mahasiswa&menu=halaman_hasil&pilihan=halamanHasil&dokumen=BeritaAcaraH&id_table_akun=$id_table_akunT';</script>";
              }else if($_GET['tahap'] == 'skripsi'){
                $sqlS = "UPDATE table_akun SET table_akun_tahap_skripsi = 'nonaktif' WHERE id_table_akun = '$id_table_akunT'";
                $query->update($sqlS);
                echo "<script>window.location='index.php?halaman=view_akun_mahasiswa&menu=halaman_skripsi&pilihan=halamanSkripsi&dokumen=BeritaAcaraS&id_table_akun=$id_table_akunT';</script>";
              }
            }
          }
        }
      ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2019 <a href="http://farmasi.uho.ac.id/">Fakultas Farmasi UHO</a>.</strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="template/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="template/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="template/bower_components/raphael/raphael.min.js"></script>
<script src="template/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="template/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="template/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="template/bower_components/moment/min/moment.min.js"></script>
<script src="template/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="template/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="template/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="template/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- bootstrap color picker -->
<script src="template/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- Select2 -->
<script src="template/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="template/plugins/input-mask/jquery.inputmask.js"></script>
<script src="template/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="template/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- bootstrap time picker -->
<script src="template/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="template/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="template/bower_components/fastclick/lib/fastclick.js"></script>

<!-- custom js -->
<script src="js/custom.js"></script>
<!-- <script src="js/custom-file-input.js"></script>
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script> -->

<!-- custom sweetAlert -->
<script src="alert/js/sweetalert.min.js"></script>
<script src="alert/js/qunit-1.18.0.js"></script>

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepickerP').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepickerH').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepickerS').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepicker3').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepickerS3').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepicker4').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepickerP4').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepickerH4').datepicker({
      autoclose: true
    })

    //Date picker
    $('#datepicker5').datepicker({
      autoclose: true
    })


    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepicker2').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepickerP').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepickerP2').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepickerH').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepickerH2').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepickerS').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepickerS2').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepicker3').timepicker({
      showInputs: false
    })

    //Timepicker
    $('.timepicker4').timepicker({
      showInputs: false
    })
  })
</script>

<!-- page script -->
<script>
  $(function () {
    $('#dataAktif').DataTable()
    $('#dataNonaktif').DataTable()
  })
</script>

<script>
    jQuery(document).ready(function($){
        $('.delete-link').on('click',function(){
            var getLink = $(this).attr('href');
            swal({
                    title: ' Peringatan!',
                    text: 'Yakin untuk menghapus data?',
                    html: true,
                    confirmButtonColor: '#d9534f',
                    showCancelButton: true,
                    },function(){
                    window.location.href = getLink
                });
            return false;
        });
    });
</script>

<script>
    jQuery(document).ready(function($){
        $('.view-link').on('click',function(){
           var getLink = $(this).attr('href');
            swal({
                    title: 'Peringatan!',
                    text: 'Edit Data?',
                    html: true,
                    confirmButtonColor: '#16adc4',
                    showCancelButton: true,
                    },function(){
                    window.location.href = getLink
                });
            return false;
        });
    });
</script>

<script>
    jQuery(document).ready(function($){
        $('.aktif-link').on('click',function(){
           var getLink = $(this).attr('href');
            swal({
                    title: ' Peringatan!',
                    text: 'Aktifkan Akun?',
                    html: true,
                    confirmButtonColor: '#16c484',
                    showCancelButton: true,
                    },function(){
                    window.location.href = getLink
                });
            return false;
        });
    });
</script>

<script>
    jQuery(document).ready(function($){
        $('.nonaktif-link').on('click',function(){
           var getLink = $(this).attr('href');
            swal({
                    title: ' Peringatan!',
                    text: 'Nonaktifkan Akun?',
                    html: true,
                    confirmButtonColor: '#ffd100',
                    showCancelButton: true,
                    },function(){
                    window.location.href = getLink
                });
            return false;
        });
    });
</script>


<script type="text/javascript">
  $(window).load(function() {
      $(".loader").fadeOut("slow");
  });
</script>

<script>
  $('#mn1').addClass('active');
</script>

</body>
</html>
