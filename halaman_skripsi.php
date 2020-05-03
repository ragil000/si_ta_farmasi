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

  $BeritaAcaraS = 'active';
  $kesediaanPenguji = '';
  $nilaiSkripsi = '';
  $SuratRekomendasiS = '';
  if(isset($_GET['dokumen'])){
    if($_GET['dokumen'] == 'BeritaAcaraS'){
      $BeritaAcaraS = 'active';
      $kesediaanPenguji = '';
      $nilaiSkripsi = '';
      $SuratRekomendasiS = '';
    }else if($_GET['dokumen'] == 'KesediaanPenguji'){
      $BeritaAcaraS = '';
      $kesediaanPenguji = 'active';
      $nilaiSkripsi = '';
      $SuratRekomendasiS = '';
    }else if($_GET['dokumen'] == 'NilaiSkripsi'){
      $BeritaAcaraS = '';
      $kesediaanPenguji = '';
      $nilaiSkripsi = 'active';
      $SuratRekomendasiS = '';
    }else if($_GET['dokumen'] == 'SuratRekomendasiH'){
      $BeritaAcaraS = '';
      $kesediaanPenguji = '';
      $nilaiSkripsi = '';
      $SuratRekomendasiS = 'active';
    }
  }

?>
<!-- Main row -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?=$BeritaAcaraS?>"><a href="#dokumenBeritaAcaraS" data-toggle="tab">Dokumen Berita Acara</a></li>
        <li class="<?=$nilaiSkripsi?>"><a href="#dokumenNilaiS" data-toggle="tab">Dokumen Nilai</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?=$BeritaAcaraS?> tab-pane" id="dokumenBeritaAcaraS">
          <?php
            include ('dokumenBeritaAcaraSkripsi.php');
          ?>
        </div>
        <!-- /.tab-pane -->
        <div class="<?=$nilaiSkripsi?> tab-pane" id="dokumenNilaiS">
          <?php
            include ('dokumenNilaiSkripsi.php');
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
