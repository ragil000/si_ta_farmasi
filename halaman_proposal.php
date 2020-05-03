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

  $BeritaAcaraP = 'active';
  $kesediaanPenguji = '';
  $nilaiProposal = '';
  $SuratRekomendasiP = '';
  if(isset($_GET['dokumen'])){
    if($_GET['dokumen'] == 'BeritaAcaraP'){
      $BeritaAcaraP = 'active';
      $kesediaanPenguji = '';
      $nilaiProposal = '';
      $SuratRekomendasiP = '';
    }else if($_GET['dokumen'] == 'KesediaanPenguji'){
      $BeritaAcaraP = '';
      $kesediaanPenguji = 'active';
      $nilaiProposal = '';
      $SuratRekomendasiP = '';
    }else if($_GET['dokumen'] == 'NilaiProposal'){
      $BeritaAcaraP = '';
      $kesediaanPenguji = '';
      $nilaiProposal = 'active';
      $SuratRekomendasiP = '';
    }else if($_GET['dokumen'] == 'SuratRekomendasiP'){
      $BeritaAcaraP = '';
      $kesediaanPenguji = '';
      $nilaiProposal = '';
      $SuratRekomendasiP = 'active';
    }
  }

?>
<!-- Main row -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?=$BeritaAcaraP?>"><a href="#dokumenBeritaAcaraP" data-toggle="tab">Dokumen Berita Acara</a></li>
        <li class="<?=$SuratRekomendasiP?>"><a href="#dokumenSuratRekomendasiP" data-toggle="tab">Dokumen Surat Rekomendasi</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?=$BeritaAcaraP?> tab-pane" id="dokumenBeritaAcaraP">
          <?php
            include ('dokumenBeritaAcaraProposal.php');
          ?>
        </div>
        <!-- /.tab-pane -->
        <div class="<?=$SuratRekomendasiP?> tab-pane" id="dokumenSuratRekomendasiP">
          <?php
            include ('dokumenSuratRekomendasiProposal.php');
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
