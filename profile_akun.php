<?php

  if(isset($_GET['id_table_akun'])){
    $id_table_akun = $_GET['id_table_akun'];
  }else{
    $id_table_akun = $_SESSION['id_table_akun'];
  }

  $getDataP = $query->select("SELECT * FROM table_akun a, table_data_akun da WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = '$id_table_akun'");
  $dataP = mysqli_fetch_array($getDataP);

  if($dataP['table_akun_level'] == '1'){
    $dataP['table_akun_level'] = 'Mahasiswa';
  }else if($dataP['table_akun_level'] == '0'){
    $dataP['table_akun_level'] = 'Administrator';
  }

  $perempuan = '';
  $laki = '';
  if($dataP['table_data_akun_jenis_kelamin'] == 'L'){
    $laki = 'checked';
    $perempuan = '';
  }else if($dataP['table_data_akun_jenis_kelamin'] == 'P'){
    $perempuan = 'checked';
    $laki = '';
  }

  $islam = '';
  $kristen = '';
  $hindu = '';
  $budha = '';
  $kong = '';
  if($dataP['table_data_akun_agama'] == 'Islam'){
    $islam = 'selected';
    $kristen = '';
    $hindu = '';
    $budha = '';
    $kong = '';
  }else if($dataP['table_data_akun_agama'] == 'Kristen'){
    $islam = '';
    $kristen = 'selected';
    $hindu = '';
    $budha = '';
    $kong = '';
  }else if($dataP['table_data_akun_agama'] == 'Hindu'){
    $islam = '';
    $kristen = '';
    $hindu = 'selected';
    $budha = '';
    $kong = '';
  }else if($dataP['table_data_akun_agama'] == 'Budha'){
    $islam = '';
    $kristen = '';
    $hindu = '';
    $budha = 'selected';
    $kong = '';
  }else if($dataP['table_data_akun_agama'] == 'Kong Hu Cu'){
    $islam = '';
    $kristen = '';
    $hindu = '';
    $budha = '';
    $kong = 'selected';
  }

  if($dataP['table_data_akun_tgl_daftar'] != null && $dataP['table_data_akun_tgl_daftar'] != '0000-00-00'){
      $table_data_akun_tgl_daftar = $date->tanggal($dataP['table_data_akun_tgl_daftar']);
  }else{
    $table_data_akun_tgl_daftar = '';
  }

  if ($dataP['table_data_akun_tgl_lahir'] != null && $dataP['table_data_akun_tgl_lahir'] != '0000-00-00'){
    $table_data_akun_tgl_lahir = $date->tanggal($dataP['table_data_akun_tgl_lahir']);
  }else{
    $table_data_akun_tgl_lahir = '';
  }

  $col_md = 'col-md-6';
  if(isset($_SESSION['table_akun_level']) && !isset($_GET['id_table_akun'])){
    if($_SESSION['table_akun_level'] == 'Administrator'){
      $col_md = 'col-md-12';
    }
  }


?>
<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="img/<?=$dataP['table_data_akun_foto']?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?=$dataP['table_data_akun_nama']?></h3>

        <p class="text-muted text-center"><?=$dataP['table_akun_level']?></p>

        <form method="POST" enctype="multipart/form-data">
          <div class="form-group text-center">
            <input type="file" name="table_data_akun_foto" id="file-1" class="inputfile inputfile-1">
  					<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Pilih Foto</span></label>
  				</div>
          <hr>
          <button type="submit" name="simpanFoto" class="btn btn-primary btn-block"><b>Ganti Foto</b></button>
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#profile" data-toggle="tab">Pengaturan Profil</a></li>
        <li><a href="#akun" data-toggle="tab">Pengaturan Akun</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="profile">
          <form role="form" method="POST">
              <div class="box-body">
                <div class="form-group <?=$col_md?>">
                  <label>Nama</label>
                  <input type="text" value="<?=$dataP['table_data_akun_nama']?>" name="table_data_akun_nama" class="form-control" placeholder="Nama Lengkap">
                </div>

                <?php
                  if(isset($_SESSION['table_akun_level'])){
                    if($_SESSION['table_akun_level'] == 'Mahasiswa' || $dataP['table_akun_level'] != 'Administrator'){
                ?>

                <div class="form-group col-md-6">
                  <label>NIM</label>
                  <input type="text" value="<?=$dataP['table_data_akun_nim']?>" name="table_data_akun_nim" class="form-control" placeholder="NIM">
                </div>
                <div class="form-group col-md-12">
                  <label>Judul Skripsi</label>
                  <textarea type="text" name="table_data_akun_judul_skripsi" class="form-control" placeholder="Judul Skripsi Anda"><?=$dataP['table_data_akun_judul_skripsi']?></textarea>
                </div>

                <?php
                    }
                  }
                ?>

                <!-- radio -->
                <div class="form-group col-md-12">
                  <label>Jenis Kelamin : </label>
                  <label>
                    <input type="radio" value="L" name="table_data_akun_jenis_kelamin" class="flat-red" <?=$laki?>>
                    Laki-Laki
                  </label>
                  <label>
                    <input type="radio" value="P" name="table_data_akun_jenis_kelamin" class="flat-red" <?=$perempuan?>>
                    Perempuan
                  </label>
                </div>
                <div class="form-group col-md-12">
                  <label>Agama</label>
                  <select class="form-control select2" name="table_data_akun_agama" style="width: 100%;">
                    <option value="">Agama</option>
                    <option value="Islam" <?=$islam?>>Islam</option>
                    <option value="Kristen" <?=$kristen?>>Kristen</option>
                    <option value="Hindu" <?=$hindu?>>Hindu</option>
                    <option value="Budha" <?=$budha?>>Budha</option>
                    <option value="Kong Hu Cu" <?=$kong?>>Kong Hu Cu</option>
                  </select>
                </div>
                <div class="form-group col-md-5">
                  <label>Tempat Lahir</label>
                  <input type="text" name="table_data_akun_tempat_lahir" value="<?=$dataP['table_data_akun_tempat_lahir']?>" class="form-control" placeholder="Tempat Lahir">
                </div>
                <!-- Date -->
                <div class="form-group col-md-3">
                  <label>Tanggal Lahir</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="table_data_akun_tgl_lahir" value="<?=$dataP['table_data_akun_tgl_lahir']?>" class="form-control pull-left" id="datepicker5">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- Date -->
                <div class="form-group col-md-4">
                  <label class="text-white">Tanggal Lahir</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" value="<?=$table_data_akun_tgl_lahir?>" class="form-control pull-left" disabled>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- Date -->
                <div class="form-group col-md-12">
                  <label>Tanggal Daftar</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" value="<?=$table_data_akun_tgl_daftar?>" class="form-control pull-left" disabled>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="simpanProfil" class="btn btn-primary">Simpan</button>
              </div>
            </form>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="akun">
          <form class="form-horizontal" method="POST">
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Username</label>

              <div class="col-sm-10">
                <input type="text" name="table_akun_username" value="<?=$dataP['table_akun_username']?>" class="form-control" id="inputName" placeholder="Username">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-10">
                <input type="text" value="<?=$dataP['table_akun_password']?>" name="table_akun_password" class="form-control" id="inputPassword" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="ubahPassword" class="btn btn-danger">Ubah</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<?php
  if(isset($_POST['simpanFoto'])){

    $sqlCek = "SELECT * FROM table_akun a, table_data_akun da WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = '$id_table_akun'";
    $getDataCek = $query->select($sqlCek);
    $dataCek = mysqli_fetch_array($getDataCek);

    $id_table_data_akun = $dataCek['id_table_data_akun'];

    $tgl = date('Y-m-d');
    $name = $_FILES['table_data_akun_foto']['name'];
		$location = $_FILES['table_data_akun_foto']['tmp_name'];

		$name = str_replace($name, "", $name);
		$name = $dataP['table_data_akun_nim']."_".$tgl.".jpg";

		$destination = "img";

		$sql = "UPDATE table_data_akun SET table_data_akun_foto = '$name' WHERE id_table_data_akun = '$id_table_data_akun'";
		$query->update($sql);
		$query->upload_image($location, $destination, $name);

    echo "<script>window.location='index.php?halaman=profile_akun';</script>";
  }else if(isset($_POST['simpanProfil'])){

    $sqlCek = "SELECT * FROM table_akun a, table_data_akun da WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = '$id_table_akun'";
    $getDataCek = $query->select($sqlCek);
    $dataCek = mysqli_fetch_array($getDataCek);

    $id_table_data_akun = $dataCek['id_table_data_akun'];

    if($_POST['table_data_akun_judul_skripsi'] == '' || $_POST['table_data_akun_judul_skripsi'] == null){
      $table_data_akun_judul_skripsi = '';
    }else{
      $table_data_akun_judul_skripsi = $_POST['table_data_akun_judul_skripsi'];
    }

    if($_POST['table_data_akun_nim'] == '' || $_POST['table_data_akun_nim'] == null){
      $table_data_akun_nim = '';
    }else{
      $table_data_akun_nim = $_POST['table_data_akun_nim'];
    }

    $sql = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$table_data_akun_nim', table_data_akun_jenis_kelamin = '$_POST[table_data_akun_jenis_kelamin]', table_data_akun_agama = '$_POST[table_data_akun_agama]', table_data_akun_tempat_lahir = '$_POST[table_data_akun_tempat_lahir]', table_data_akun_tgl_lahir = '$_POST[table_data_akun_tgl_lahir]', table_data_akun_judul_skripsi = '$table_data_akun_judul_skripsi' WHERE id_table_data_akun = '$id_table_data_akun'";
    $query->update($sql);

    echo "<script>window.location='index.php?halaman=profile_akun';</script>";
  }else if(isset($_POST['ubahPassword'])){

    if($dataP['table_akun_username'] == $_POST['table_akun_username'] && $dataP['table_akun_password'] == $_POST['table_akun_password']){
      echo "<script>window.location='index.php?halaman=profile_akun';</script>";
    }else{
      $sql = "UPDATE table_akun SET table_akun_username = '$_POST[table_akun_username]', table_akun_password = '$_POST[table_akun_password]', table_akun_password_md5 = md5('$_POST[table_akun_password]') WHERE id_table_akun = '$id_table_akun'";
      $query->update($sql);
      if(isset($_GET['id_table_akun'])){
        echo "<script>window.location='index.php?halaman=profile_akun&id_table_akun=$_GET[id_table_akun]';</script>";
      }else{
        echo "<script>window.location='index.php?halaman=keluar';</script>";
      }
    }
  }
?>
