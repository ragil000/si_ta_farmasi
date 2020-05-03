<?php
  $sqlAM = "SELECT * FROM table_akun WHERE table_akun_level = '1' AND table_akun_ket = 'aktif'";
  $getDataAM = $query->select($sqlAM);
  $hitungAM = mysqli_num_rows($getDataAM);

  $sqlNM = "SELECT * FROM table_akun WHERE table_akun_level = '1' AND table_akun_ket = 'nonaktif'";
  $getDataNM = $query->select($sqlNM);
  $hitungNM = mysqli_num_rows($getDataNM);

  $sqlT = "SELECT * FROM table_akun WHERE table_akun_level = '1'";
  $getDataT = $query->select($sqlT);
  $hitungT = mysqli_num_rows($getDataT);
?>
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?=$hitungAM?></h3>

        <p>Jumlah Akun Mahasiswa Aktif</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="index.php?halaman=data_akun_mahasiswa&ketAkun=aktif" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?=$hitungNM?></h3>

        <p>Jumlah Akun Mahasiswa Nonaktif</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="index.php?halaman=data_akun_mahasiswa&ketAkun=nonaktif" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-12 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-blue">
      <div class="inner">
        <h3><?=$hitungT?></h3>

        <p>Jumlah Total Akun Mahasiswa</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->
