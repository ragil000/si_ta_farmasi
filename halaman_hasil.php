<?php
  if(isset($_GET['id_table_akun'])){
    $id_table_akun = $_GET['id_table_akun'];
  }else{
    $id_table_akun = $_SESSION['id_table_akun'];
  }
  $sqlMhs = "SELECT * FROM table_akun a, table_data_akun da WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = '$id_table_akun'";
  $getDataMhs = $query->select($sqlMhs);
  $dataMhs = mysqli_fetch_array($getDataMhs);

  $disabledMhs = 'disabled';
  $disabledAdm = '';
  if(isset($_SESSION['table_akun_level'])){
    if($_SESSION['table_akun_level'] == 'Mahasiswa'){
      $disabledMhs = '';
      $disabledAdm = 'disabled';
    }else if($_SESSION['table_akun_level'] == 'Administrator'){
      $disabledMhs = 'disabled';
      $disabledAdm = '';
    }
  }

  $BeritaAcaraH = 'active';
  $kesediaanPenguji = '';
  $nilaiHasil = '';
  $SuratRekomendasiH = '';
  if(isset($_GET['dokumen'])){
    if($_GET['dokumen'] == 'BeritaAcaraH'){
      $BeritaAcaraH = 'active';
      $kesediaanPenguji = '';
      $nilaiHasil = '';
      $SuratRekomendasiH = '';
    }else if($_GET['dokumen'] == 'KesediaanPenguji'){
      $BeritaAcaraH = '';
      $kesediaanPenguji = 'active';
      $nilaiHasil = '';
      $SuratRekomendasiH = '';
    }else if($_GET['dokumen'] == 'NilaiHasil'){
      $BeritaAcaraH = '';
      $kesediaanPenguji = '';
      $nilaiHasil = 'active';
      $SuratRekomendasiH = '';
    }else if($_GET['dokumen'] == 'SuratRekomendasiH'){
      $BeritaAcaraH = '';
      $kesediaanPenguji = '';
      $nilaiHasil = '';
      $SuratRekomendasiH = 'active';
    }
  }

?>
<!-- Main row -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?=$BeritaAcaraH?>"><a href="#dokumenBeritaAcaraH" data-toggle="tab">Dokumen Berita Acara</a></li>
        <li class="<?=$SuratRekomendasiH?>"><a href="#dokumenSuratRekomendasiH" data-toggle="tab">Dokumen Surat Rekomendasi</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?=$BeritaAcaraH?> tab-pane" id="dokumenBeritaAcaraH">
          <?php
            include ('dokumenBeritaAcaraHasil.php');
          ?>
        </div>
        <!-- /.tab-pane -->
        <div class="<?=$SuratRekomendasiH?> tab-pane" id="dokumenSuratRekomendasiH">
          <?php
            include ('dokumenSuratRekomendasiHasil.php');
          ?>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row (main row) -->
