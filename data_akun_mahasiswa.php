<?php
  $akunAktif = 'active';
  $akunNonaktif = '';
  if(isset($_GET['ketAkun'])){
    if($_GET['ketAkun'] == 'aktif'){
      $akunAktif = 'active';
      $akunNonaktif = '';
    }else if($_GET['ketAkun'] == 'nonaktif'){
      $akunAktif = '';
      $akunNonaktif = 'active';
    }
  }
?>
<!-- Main row -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?=$akunAktif?>"><a href="#akunAktif" data-toggle="tab">Akun Mahasiswa Aktif</a></li>
        <li class="<?=$akunNonaktif?>"><a href="#akunNonaktif" data-toggle="tab">Akun Mahasiswa Tidak Aktif</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?=$akunAktif?> tab-pane" id="akunAktif">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Akun Mahasiswa Aktif</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataAktif" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Pilihan</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  $sql = "SELECT * FROM table_data_akun da, table_akun a WHERE da.id_table_data_akun = a.id_table_data_akun AND table_akun_ket = 'aktif' AND table_akun_level = '1'";
                  $getData = $query->select($sql);
                  while ($data = mysqli_fetch_array($getData)) {
                ?>
                <tr>
                  <td><?=$data['table_data_akun_nama']?></td>
                  <td><?=$data['table_data_akun_nim']?></td>
                  <td><?=$data['table_akun_username']?></td>
                  <td><?=$data['table_akun_password']?></td>
                  <td class="text-center">
                    <a href="index.php?halaman=view_akun_mahasiswa&id_table_akun=<?=$data['id_table_akun']?>" class="btn btn-sm btn-success"><i class="fa fa-file-text"></i></a>
                    <a href="index.php?halaman=profile_akun&id_table_akun=<?=$data['id_table_akun']?>" class="btn btn-sm btn-primary view-link"><i class="fa fa-edit"></i></a>
                    <a href="index.php?halaman=data_akun_mahasiswa&aksi=nonaktif&id_table_akun=<?=$data['id_table_akun']?>" class="btn btn-sm btn-warning nonaktif-link"><i class="fa fa-close"></i></a>
                    <a href="index.php?halaman=data_akun_mahasiswa&aksi=hapus&id_table_akun=<?=$data['id_table_akun']?>" class="btn btn-sm btn-danger delete-link"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php
                  }
                ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Pilihan</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane <?=$akunNonaktif?>" id="akunNonaktif">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Akun Mahasiswa Nonaktif</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataNonaktif" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Pilihan</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  $sql = "SELECT * FROM table_data_akun da, table_akun a WHERE da.id_table_data_akun = a.id_table_data_akun AND table_akun_ket = 'nonaktif' AND table_akun_level = '1'";
                  $getData = $query->select($sql);
                  while ($data = mysqli_fetch_array($getData)) {
                ?>
                <tr>
                  <td><?=$data['table_data_akun_nama']?></td>
                  <td><?=$data['table_data_akun_nim']?></td>
                  <td><?=$data['table_akun_username']?></td>
                  <td><?=$data['table_akun_password']?></td>
                  <td class="text-center">
                    <a href="index.php?aksi=aktif&id_table_akun=<?=$data['id_table_akun']?>" class="btn btn-sm btn-success aktif-link"><i class="fa fa-check"></i></a>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php
                  }
                ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Pilihan</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row (main row) -->
