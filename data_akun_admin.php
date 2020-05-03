<?php
  $dataAdmin = 'active';
  $tambahAdmin = '';
  $table_data_akun_nama = '';
  $table_data_akun_jenis_kelamin = '';
  $table_data_akun_agama = '';
  $table_akun_username = '';
  $table_akun_password = '';
  $id_table_data_akunA = '';
  if(isset($_GET['ketAkun'])){
    if($_GET['ketAkun'] == 'dataAdmin'){
      $dataAdmin = 'active';
      $tambahAdmin = '';
    }else if($_GET['ketAkun'] == 'tambahAdmin' || $_GET['ketAkun'] == 'editAdmin'){
      $dataAdmin = '';
      $tambahAdmin = 'active';

      $getDataAdmin = $query->select("SELECT * FROM table_akun a, table_data_akun da WHERE da.id_table_data_akun = a.id_table_data_akun AND a.id_table_akun = '$_GET[id_table_akun]'");
      $dataAdmin = mysqli_fetch_array($getDataAdmin);
      $table_data_akun_nama = $dataAdmin['table_data_akun_nama'];
      $table_data_akun_jenis_kelamin = $dataAdmin['table_data_akun_jenis_kelamin'];
      $table_data_akun_agama = $dataAdmin['table_data_akun_agama'];
      $table_akun_username = $dataAdmin['table_akun_username'];
      $table_akun_password = $dataAdmin['table_akun_password'];
      $id_table_data_akunA = $dataAdmin['id_table_data_akun'];
    }
  }

  $lakiAdmin = '';
  $perempuanAdmin = '';
  if($table_data_akun_jenis_kelamin == 'L'){
    $lakiAdmin = 'checked';
    $perempuanAdmin = '';
  }else if($table_data_akun_jenis_kelamin == 'P'){
    $lakiAdmin = '';
    $perempuanAdmin = 'checked';
  }

  $islamA = '';
  $kristenA = '';
  $hinduA = '';
  $budhaA = '';
  $kongA = '';
  if($table_data_akun_agama == 'Islam'){
    $islamA = 'selected';
    $kristenA = '';
    $hinduA = '';
    $budhaA = '';
    $kongA = '';
  }else if($table_data_akun_agama == 'Kristen'){
    $islamA = '';
    $kristenA = 'selected';
    $hinduA = '';
    $budhaA = '';
    $kongA = '';
  }else if($table_data_akun_agama == 'Hindu'){
    $islamA = '';
    $kristenA = '';
    $hinduA = 'selected';
    $budhaA = '';
    $kongA = '';
  }else if($table_data_akun_agama == 'Budha'){
    $islamA = '';
    $kristenA = '';
    $hinduA = '';
    $budhaA = 'selected';
    $kongA = '';
  }else if($table_data_akun_agama == 'Kong Hu Cu'){
    $islamA = '';
    $kristenA = '';
    $hinduA = '';
    $budhaA = '';
    $kongA = 'selected';
  }
?>
<!-- Main row -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?=$dataAdmin?>"><a href="#akunAdmin" data-toggle="tab">Akun Administrator</a></li>
        <li class="<?=$tambahAdmin?>"><a href="#tambahAdmin" data-toggle="tab">Tambah Akun Administrator</a></li>
      </ul>
      <div class="tab-content">
        <div class="<?=$dataAdmin?> tab-pane" id="akunAdmin">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Akun Administrator</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataAktif" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Pilihan</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  $sql = "SELECT * FROM table_data_akun da, table_akun a WHERE da.id_table_data_akun = a.id_table_data_akun AND table_akun_ket = 'aktif' AND table_akun_level = '0'";
                  $getData = $query->select($sql);
                  while ($data = mysqli_fetch_array($getData)) {
                    if($data['id_table_akun'] == $_SESSION['id_table_akun']){
                      $disable = 'disabled';
                    }else{
                      $disable = '';
                    }
                ?>
                <tr>
                  <td><?=$data['table_data_akun_nama']?></td>
                  <td><?=$data['table_akun_username']?></td>
                  <td><?=$data['table_akun_password']?></td>
                  <td class="text-center">
                    <a href="index.php?halaman=data_akun_admin&ketAkun=editAdmin&id_table_akun=<?=$data['id_table_akun']?>" class="btn btn-sm btn-primary view-link <?=$disable?>"><i class="fa fa-edit"></i></a>
                    <a href="index.php?aksi=hapusAdmin&id_table_akun=<?=$data['id_table_akun']?>" class="btn btn-sm btn-danger delete-link <?=$disable?>"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php
                  }
                ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
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
        <div class="tab-pane <?=$tambahAdmin?>" id="tambahAdmin">
            <div class="box-header">
              <h3 class="box-title">Tambah Akun Administrator</h3>
            </div>
            <form role="form" method="POST">
                <div class="box-body">
                  <div class="form-group col-md-12">
                    <label>Nama</label>
                    <input type="text" name="table_data_akun_nama" value="<?=$table_data_akun_nama?>" class="form-control" placeholder="Nama Lengkap">
                  </div>
                  <!-- radio -->
                  <div class="form-group col-md-12">
                    <label>Jenis Kelamin : </label>
                    <label>
                      <input type="radio" value="L" name="table_data_akun_jenis_kelamin" class="flat-red" <?=$lakiAdmin?>>
                      Laki-Laki
                    </label>
                    <label>
                      <input type="radio" value="P" name="table_data_akun_jenis_kelamin" class="flat-red" <?=$perempuanAdmin?>>
                      Perempuan
                    </label>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Agama</label>
                    <select class="form-control select2" name="table_data_akun_agama" style="width: 100%;">
                      <option value="">Agama</option>
                      <option value="Islam" <?=$islamA?>>Islam</option>
                      <option value="Kristen" <?=$kristenA?>>Kristen</option>
                      <option value="Hindu" <?=$hinduA?>>Hindu</option>
                      <option value="Budha" <?=$budhaA?>>Budha</option>
                      <option value="Kong Hu Cu" <?=$kongA?>>Kong Hu Cu</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="text" name="table_akun_username" value="<?=$table_akun_username?>" class="form-control" placeholder="Username">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="text" name="table_akun_password" value="<?=$table_akun_password?>" class="form-control" placeholder="Password">
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" name="tambahAkunAdmin" class="btn btn-primary">Simpan</button>
                </div>
              </form>
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

<?php
  if(isset($_POST['tambahAkunAdmin'])){
    $tgl = date('Y-m-d');

    if(isset($_GET['ketAkun'])){
      if($_GET['ketAkun'] == 'editAdmin'){
        $sqlAdmin = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_jenis_kelamin = '$_POST[table_data_akun_jenis_kelamin]', table_data_akun_agama = '$_POST[table_data_akun_agama]' WHERE id_table_data_akun = '$id_table_data_akunA'";
        $query->update($sqlAdmin);
        $sqlAdmin2 = "UPDATE table_akun SET table_akun_username = '$_POST[table_akun_username]', table_akun_password = '$_POST[table_akun_password]', table_akun_password_md5 = md5('$_POST[table_akun_password]') WHERE id_table_akun = '$_GET[id_table_akun]'";
        $query->update($sqlAdmin2);
      }else if($_GET['ketAkun'] == 'tambahAdmin'){
        $sqlAdm = "INSERT INTO table_data_akun (table_data_akun_nama, table_data_akun_jenis_kelamin, table_data_akun_agama, table_data_akun_foto, table_data_akun_tgl_daftar) VALUES ('$_POST[table_data_akun_nama]', '$_POST[table_data_akun_jenis_kelamin]', '$_POST[table_data_akun_agama]', 'default_avatar.png', '$tgl')";
        $cekInput = $admin->register($sqlAdm, $_POST['table_akun_username'], $_POST['table_akun_password'], 'aktif', '0');
      }
    }else{
      $sqlAdm = "INSERT INTO table_data_akun (table_data_akun_nama, table_data_akun_jenis_kelamin, table_data_akun_agama, table_data_akun_foto, table_data_akun_tgl_daftar) VALUES ('$_POST[table_data_akun_nama]', '$_POST[table_data_akun_jenis_kelamin]', '$_POST[table_data_akun_agama]', 'default_avatar.png', '$tgl')";
      $cekInput = $admin->register($sqlAdm, $_POST['table_akun_username'], $_POST['table_akun_password'], 'aktif', '0');
    }
    echo "<script>window.location='index.php?halaman=data_akun_admin';</script>";
  }
?>
