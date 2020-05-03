<?php
  if(isset($_GET['id_table_akun'])){
    $id_table_akun = $_GET['id_table_akun'];
  }else{
    $id_table_akun = $_SESSION['id_table_akun'];
  }
  $sqlMhs = "SELECT * FROM table_akun a, table_data_akun da WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = '$id_table_akun'";
  $getDataMhs = $query->select($sqlMhs);
  $dataMhs = mysqli_fetch_array($getDataMhs);

  $tahapProposal = 'nonaktif';
  $tahapHasil = 'nonaktif';
  $tahapSkripsi = 'nonaktif';

  if($dataMhs['table_akun_tahap_proposal'] == 'aktif'){
    $tahapProposal = 'aktif';
  }else if($dataMhs['table_akun_tahap_proposal'] == 'nonaktif' || $dataMhs['table_akun_tahap_proposal'] == null){
    $tahapProposal = 'nonaktif';
  }

  if($dataMhs['table_akun_tahap_hasil'] == 'aktif'){
    $tahapHasil = 'aktif';
  }else if($dataMhs['table_akun_tahap_hasil'] == 'nonaktif' || $dataMhs['table_akun_tahap_hasil'] == null){
    $tahapHasil = 'nonaktif';
  }

  if($dataMhs['table_akun_tahap_skripsi'] == 'aktif'){
    $tahapSkripsi = 'aktif';
  }else if($dataMhs['table_akun_tahap_skripsi'] == 'nonaktif' || $dataMhs['table_akun_tahap_skripsi'] == null){
    $tahapSkripsi = 'nonaktif';
  }

  // if($dataMhs['table_akun_tahap'] == 'proposal'){
  //   $tahapProposal = 'nonaktif';
  //   $tahapHasil = 'nonaktif';
  //   $tahapSkripsi = 'nonaktif';
  // }

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

  $halamanProposal = 'active';
  $halamanHasil = '';
  $halamanSkripsi = '';
  $dokumenBeritaAcaraP = 'active';
  $dokumenBeritaAcaraH = 'active';
  $dokumenBeritaAcaraS = 'active';
  $dokumenSuratRekomendasiP = '';
  $dokumenSuratRekomendasiH = '';
  $dokumenNilaiSkripsi = '';
  if(isset($_GET['pilihan'])){
    if($_GET['pilihan'] == 'halamanProposal'){
      $halamanProposal = 'active';
      $halamanHasil = '';
      $halamanSkripsi = '';

      if(isset($_GET['dokumen'])){
        if($_GET['dokumen'] == 'BeritaAcaraP'){
          $dokumenBeritaAcaraP = 'active';
          $dokumenBeritaAcaraH = 'active';
          $dokumenBeritaAcaraS = 'active';
          $dokumenSuratRekomendasiP = '';
          $dokumenSuratRekomendasiH = '';
          $dokumenNilaiSkripsi = '';
        }else if($_GET['dokumen'] == 'SuratRekomendasiP'){
          $dokumenBeritaAcaraP = '';
          $dokumenBeritaAcaraH = 'active';
          $dokumenBeritaAcaraS = 'active';
          $dokumenSuratRekomendasiP = 'active';
          $dokumenSuratRekomendasiH = '';
          $dokumenNilaiSkripsi = '';
        }
      }
    }else if($_GET['pilihan'] == 'halamanHasil'){
      $halamanProposal = '';
      $halamanHasil = 'active';
      $halamanSkripsi = '';

      if(isset($_GET['dokumen'])){
        if($_GET['dokumen'] == 'BeritaAcaraH'){
          $dokumenBeritaAcaraP = 'active';
          $dokumenBeritaAcaraH = 'active';
          $dokumenBeritaAcaraS = 'active';
          $dokumenSuratRekomendasiP = '';
          $dokumenSuratRekomendasiH = '';
          $dokumenNilaiSkripsi = '';
        }else if($_GET['dokumen'] == 'SuratRekomendasiH'){
          $dokumenBeritaAcaraP = 'active';
          $dokumenBeritaAcaraH = '';
          $dokumenBeritaAcaraS = 'active';
          $dokumenSuratRekomendasiP = '';
          $dokumenSuratRekomendasiH = 'active';
          $dokumenNilaiSkripsi = '';
        }
      }
    }else if($_GET['pilihan'] == 'halamanSkripsi'){
      $halamanProposal = '';
      $halamanHasil = '';
      $halamanSkripsi = 'active';

      if(isset($_GET['dokumen'])){
        if($_GET['dokumen'] == 'BeritaAcaraS'){
          $dokumenBeritaAcaraP = 'active';
          $dokumenBeritaAcaraH = 'active';
          $dokumenBeritaAcaraS = 'active';
          $dokumenSuratRekomendasiP = '';
          $dokumenSuratRekomendasiH = '';
          $dokumenNilaiSkripsi = '';
        }else if($_GET['dokumen'] == 'NilaiSkripsi'){
          $dokumenBeritaAcaraP = 'active';
          $dokumenBeritaAcaraH = 'active';
          $dokumenBeritaAcaraS = '';
          $dokumenSuratRekomendasiP = '';
          $dokumenSuratRekomendasiH = '';
          $dokumenNilaiSkripsi = 'active';
        }
      }
    }
  }

?>
<!-- Main row -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?=$halamanProposal?>"><a href="#halamanProposal" data-toggle="tab">Dokumen Proposal</a></li>
        <li class="<?=$halamanHasil?>"><a href="#halamanHasil" data-toggle="tab">Dokumen Hasil</a></li>
        <li class="<?=$halamanSkripsi?>"><a href="#halamanSkripsi" data-toggle="tab">Dokumen Skripsi</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?=$halamanProposal?> tab-pane" id="halamanProposal">
          <div class="box-body">
            <div class="form-group col-md-12">
              <?php
                if($tahapProposal == 'nonaktif'){
              ?>
              <a href="index.php?tahapAksi=aktif&tahap=proposal&id_table_akun=<?=$id_table_akun?>" class="btn btn-success pull-left">Aktifkan Tahap Proposal</a>
              <?php
                }else if($tahapProposal == 'aktif'){
              ?>
              <a href="index.php?tahapAksi=nonaktif&tahap=proposal&id_table_akun=<?=$id_table_akun?>" class="btn btn-danger pull-left">Nonaktifkan Tahap Proposal</a>
              <?php
                }
              ?>
            </div>
          </div>
          <ul class="nav nav-tabs">
            <li class="<?=$dokumenBeritaAcaraP?>"><a href="#dokumenBeritaAcaraP" data-toggle="tab">Dokumen Berita Acara</a></li>
            <li class="<?=$dokumenSuratRekomendasiP?>"><a href="#dokumenSuratRekomendasiP" data-toggle="tab">Dokumen Surat Rekomendasi</a></li>
          </ul>
          <div class="tab-content">
            <div class="<?=$dokumenBeritaAcaraP?> tab-pane" id="dokumenBeritaAcaraP">
              <?php
                include ('dokumenBeritaAcaraProposal.php');
              ?>
            </div>
            <div class="<?=$dokumenSuratRekomendasiP?> tab-pane" id="dokumenSuratRekomendasiP">
              <?php
                include ('dokumenSuratRekomendasiProposal.php');
              ?>
            </div>
          </div>

        </div>
        <!-- /.tab-pane -->
        <div class="<?=$halamanHasil?> tab-pane" id="halamanHasil">
          <div class="box-body">
            <div class="form-group col-md-12">
              <?php
                if($tahapHasil == 'nonaktif'){
              ?>
              <a href="index.php?tahapAksi=aktif&tahap=hasil&id_table_akun=<?=$id_table_akun?>" class="btn btn-success pull-left">Aktifkan Tahap Proposal</a>
              <?php
            }else if($tahapHasil == 'aktif'){
              ?>
              <a href="index.php?tahapAksi=nonaktif&tahap=hasil&id_table_akun=<?=$id_table_akun?>" class="btn btn-danger pull-left">Nonaktifkan Tahap Proposal</a>
              <?php
                }
              ?>
            </div>
          </div>
          <ul class="nav nav-tabs">
            <li class="<?=$dokumenBeritaAcaraH?>"><a href="#dokumenBeritaAcaraH" data-toggle="tab">Dokumen Berita Acara</a></li>
            <li class="<?=$dokumenSuratRekomendasiH?>"><a href="#dokumenSuratRekomendasiH" data-toggle="tab">Dokumen Surat Rekomendasi</a></li>
          </ul>
          <div class="tab-content">
            <div class="<?=$dokumenBeritaAcaraH?> tab-pane" id="dokumenBeritaAcaraH">
              <?php
                include ('dokumenBeritaAcaraHasil.php');
              ?>
            </div>
            <div class="<?=$dokumenSuratRekomendasiH?> tab-pane" id="dokumenSuratRekomendasiH">
              <?php
                include ('dokumenSuratRekomendasiHasil.php');
              ?>
            </div>
          </div>

        </div>
        <!-- /.tab-pane -->
        <div class="<?=$halamanSkripsi?> tab-pane" id="halamanSkripsi">
          <div class="box-body">
            <div class="form-group col-md-12">
              <?php
                if($tahapSkripsi == 'nonaktif'){
              ?>
              <a href="index.php?tahapAksi=aktif&tahap=skripsi&id_table_akun=<?=$id_table_akun?>" class="btn btn-success pull-left">Aktifkan Tahap Proposal</a>
              <?php
            }else if($tahapSkripsi == 'aktif'){
              ?>
              <a href="index.php?tahapAksi=nonaktif&tahap=skripsi&id_table_akun=<?=$id_table_akun?>" class="btn btn-danger pull-left">Nonaktifkan Tahap Proposal</a>
              <?php
                }
              ?>
            </div>
          </div>
          <ul class="nav nav-tabs">
            <li class="<?=$dokumenBeritaAcaraS?>"><a href="#dokumenBeritaAcaraS" data-toggle="tab">Dokumen Berita Acara</a></li>
            <li class="<?=$dokumenNilaiSkripsi?>"><a href="#dokumenNilaiSkripsi" data-toggle="tab">Dokumen Nilai</a></li>
          </ul>
          <div class="tab-content">
            <div class="<?=$dokumenBeritaAcaraS?> tab-pane" id="dokumenBeritaAcaraS">
              <?php
                include ('dokumenBeritaAcaraSkripsi.php');
              ?>
            </div>
            <div class="<?=$dokumenNilaiSkripsi?> tab-pane" id="dokumenNilaiSkripsi">
              <?php
                include ('dokumenNilaiSkripsi.php');
              ?>
            </div>
          </div>

        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row (main row) -->
