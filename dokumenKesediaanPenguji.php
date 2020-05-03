<?php

  $getDataKP = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekKP = mysqli_num_rows($getDataKP);
  if($cekKP > 0){
    $dataKP = mysqli_fetch_array($getDataKP);
  }else{
    $dataKP = null;
  }

  $getDataKP1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Pembimbing 1'");
  $cekKP1 = mysqli_num_rows($getDataKP1);
  if($cekKP1 > 0){
    $dataKP1 = mysqli_fetch_array($getDataKP1);
  }else{
    $dataKP1 = null;
  }

  $getDataKP2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Pembimbing 2'");
  $cekKP2 = mysqli_num_rows($getDataKP2);
  if($cekKP2 > 0){
    $dataKP2 = mysqli_fetch_array($getDataKP2);
  }else{
    $dataKP2 = null;
  }

  $getDataKP3 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang'");
  $cekKP3 = mysqli_num_rows($getDataKP3);
  if($cekKP3 > 0){
    $dataKP3 = mysqli_fetch_array($getDataKP3);
  }else{
    $dataKP3 = null;
  }

  $getDataKP4 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang'");
  $cekKP4 = mysqli_num_rows($getDataKP4);
  if($cekKP4 > 0){
    $dataKP4 = mysqli_fetch_array($getDataKP4);
  }else{
    $dataKP4 = null;
  }

  $getDataKP5 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Anggota 1'");
  $cekKP5 = mysqli_num_rows($getDataKP5);
  if($cekKP5 > 0){
    $dataKP5 = mysqli_fetch_array($getDataKP5);
  }else{
    $dataKP5 = null;
  }

  $getDataKP6 = $query->select("SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'");
  $cekKP6 = mysqli_num_rows($getDataKP6);
  if($cekKP6 > 0){
    $dataKP6 = mysqli_fetch_array($getDataKP6);
  }else{
    $dataKP6 = null;
  }

  if ($dataKP['table_dokumen_jam_awal_ujian_hasil'] != null){
    $table_dokumen_jam_awal_ujian_hasilKP = $time->waktuView($dataKP['table_dokumen_jam_awal_ujian_hasil']);
  }else{
    $table_dokumen_jam_awal_ujian_hasilKP = '';
  }
  if ($dataKP['table_dokumen_jam_akhir_ujian_hasil'] != null){
    $table_dokumen_jam_akhir_ujian_hasilKP = $time->waktuView($dataKP['table_dokumen_jam_akhir_ujian_hasil']);
  }else{
    $table_dokumen_jam_akhir_ujian_hasilKP = '';
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/kesediaan_penguji.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
  </div>
</div>
<form role="form" method="POST">
  <div class="box-body">
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Nama Mahasiswa</label>
        <input type="text" name="table_data_akun_nama" value="<?=$dataMhs['table_data_akun_nama']?>" class="form-control" placeholder="Nama" <?=$disabledMhs?>>
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>NIM</label>
        <input type="text" name="table_data_akun_nim" value="<?=$dataMhs['table_data_akun_nim']?>" class="form-control" placeholder="NIM" <?=$disabledMhs?>>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Judul Skripsi</label>
      <textarea type="text" name="table_data_akun_judul_skripsi" class="form-control" <?=$disabledMhs?>><?=$dataMhs['table_data_akun_judul_skripsi']?></textarea>
    </div>
    <div class="form-group col-md-12">
      <label>Tempat Ujian Hasil</label>
      <textarea type="text" name="table_dokumen_tempat_ujian_hasil" class="form-control" <?=$disabledAdm?>><?=$dataKP['table_dokumen_tempat_ujian_hasil']?></textarea>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Pembimbing 1</label>
        <select class="form-control select2" name="id_table_dosen1" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataKP1 != null){
          ?>
          <option selected="selected" value="<?=$dataKP1['id_table_dosen']?>"><?=$dataKP1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Pembimbing 1</option>
          <?php
            }
            $sqlKPDsn1 = "SELECT * FROM table_dosen";
            $getDataKPDsn1 = $query->select($sqlKPDsn1);
            while ($dataKPDsn1 = mysqli_fetch_array($getDataKPDsn1)){
              if($dataKPDsn1['id_table_dosen'] == $dataKP1['id_table_dosen']){
                $disabledKP1 = 'disabled';
              }else{
                $disabledKP1 = '';
              }
          ?>
          <option value="<?=$dataKPDsn1['id_table_dosen']?>" <?=$disabledKP1?>><?=$dataKPDsn1['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Pembimbing 2</label>
        <select class="form-control select2" name="id_table_dosen2" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataKP2 != null){
          ?>
          <option selected="selected" value="<?=$dataKP2['id_table_dosen']?>"><?=$dataKP2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Pembimbing 2</option>
          <?php
            }
            $sqlKPDsn2 = "SELECT * FROM table_dosen";
            $getDataKPDsn2 = $query->select($sqlKPDsn2);
            while ($dataKPDsn2 = mysqli_fetch_array($getDataKPDsn2)){
              if($dataKPDsn2['id_table_dosen'] == $dataKP2['id_table_dosen']){
                $disabledKP2 = 'disabled';
              }else{
                $disabledKP2 = '';
              }
          ?>
          <option value="<?=$dataKPDsn2['id_table_dosen']?>" <?=$disabledKP2?>><?=$dataKPDsn2['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-4">
      <div class="form-group">
        <label>Ketua Sidang Ujian</label>
        <select class="form-control select2" name="id_table_dosen3" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataKP3 != null){
          ?>
          <option selected="selected" value="<?=$dataKP3['id_table_dosen']?>"><?=$dataKP3['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlKPDsn3 = "SELECT * FROM table_dosen";
            $getDataKPDsn3 = $query->select($sqlKPDsn3);
            while ($dataKPDsn3 = mysqli_fetch_array($getDataKPDsn3)){
              if($dataKPDsn3['id_table_dosen'] == $dataKP3['id_table_dosen']){
                $disabledKP3 = 'disabled';
              }else{
                $disabledKP3 = '';
              }
          ?>
          <option value="<?=$dataKPDsn3['id_table_dosen']?>" <?=$disabledKP3?>><?=$dataKPDsn3['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-4">
      <div class="form-group">
        <label>Sekretaris Sidang Ujian</label>
        <select class="form-control select2" name="id_table_dosen4" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataKP4 != null){
          ?>
          <option selected="selected" value="<?=$dataKP4['id_table_dosen']?>"><?=$dataKP4['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlKPDsn4 = "SELECT * FROM table_dosen";
            $getDataKPDsn4 = $query->select($sqlKPDsn4);
            while ($dataKPDsn4 = mysqli_fetch_array($getDataKPDsn4)){
              if($dataKPDsn4['id_table_dosen'] == $dataKP4['id_table_dosen']){
                $disabledKP4 = 'disabled';
              }else{
                $disabledKP4 = '';
              }
          ?>
          <option value="<?=$dataKPDsn4['id_table_dosen']?>" <?=$disabledKP4?>><?=$dataKPDsn4['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-4">
      <div class="form-group">
        <label>Anggota 1 Sidang Ujian</label>
        <select class="form-control select2" name="id_table_dosen5" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataKP5 != null){
          ?>
          <option selected="selected" value="<?=$dataKP5['id_table_dosen']?>"><?=$dataKP5['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Anggota Sidang 1</option>
          <?php
            }
            $sqlKPDsn5 = "SELECT * FROM table_dosen";
            $getDataKPDsn5 = $query->select($sqlKPDsn5);
            while ($dataKPDsn5 = mysqli_fetch_array($getDataKPDsn5)){
              if($dataKPDsn5['id_table_dosen'] == $dataKP5['id_table_dosen']){
                $disabledKP5 = 'disabled';
              }else{
                $disabledKP5 = '';
              }
          ?>
          <option value="<?=$dataKPDsn5['id_table_dosen']?>" <?=$disabledKP5?>><?=$dataKPDsn5['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <!-- Date -->
    <div class="form-group col-md-12">
      <label>Tanggal Ujian Hasil</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" name="table_dokumen_tgl_ujian_hasil" value="<?=$dataKP['table_dokumen_tgl_ujian_hasil']?>" class="form-control pull-left" id="datepicker2" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group">
      <!-- time Picker -->
      <div class="bootstrap-timepicker">
        <div class="form-group col-md-6">
          <label>Waktu Mulai Ujian Hasil</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_awal_ujian_hasilKP?>" name="table_dokumen_jam_awal_ujian_hasil" class="form-control timepicker3" <?=$disabledAdm?>>

            <div class="input-group-addon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group col-md-6">
          <label>Waktu Berakhir Ujian Hasil</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_akhir_ujian_hasilKP?>" name="table_dokumen_jam_akhir_ujian_hasil" class="form-control timepicker4" <?=$disabledAdm?>>

            <div class="input-group-addon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Ketua Jurusan</label>
      <input type="text" class="form-control" placeholder="<?=$dataKP6['table_dosen_nama']?>" disabled>
    </div>
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanKP" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanKP'])){

    $table_dokumen_jam_awal_ujian_hasilKPI = $time->waktuInput($_POST['table_dokumen_jam_awal_ujian_hasil']);
    $table_dokumen_jam_akhir_ujian_hasilKPI = $time->waktuInput($_POST['table_dokumen_jam_akhir_ujian_hasil']);

    if($cekKP != null){
      $sqlKPU = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_hasil = '$_POST[table_dokumen_tgl_ujian_hasil]', table_dokumen_tempat_ujian_hasil = '$_POST[table_dokumen_tempat_ujian_hasil]', table_dokumen_jam_awal_ujian_hasil = '$table_dokumen_jam_awal_ujian_hasilKPI', table_dokumen_jam_akhir_ujian_hasil = '$table_dokumen_jam_akhir_ujian_hasilKPI' WHERE id_table_akun = '$id_table_akun'";
      $query->update($sqlKPU);
    }else{
      $sqlKPS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_hasil, table_dokumen_tempat_ujian_hasil, table_dokumen_jam_awal_ujian_hasil, table_dokumen_jam_akhir_ujian_hasil, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_hasil]', '$_POST[table_dokumen_tempat_ujian_hasil]', '$table_dokumen_jam_awal_ujian_hasilKPI', '$table_dokumen_jam_akhir_ujian_hasilKPI', '$id_table_akun')";
      $query->insert($sqlKPS);
    }

    if($cekKP1 != null){
      $sqlKPU1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Pembimbing 1'";
      $query->update($sqlKPU1);
    }else{
      $sqlKPS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Pembimbing 1', '$_POST[id_table_dosen1]', '$id_table_akun')";
      $query->insert($sqlKPS1);
    }

    if($cekKP2 != null){
      $sqlKPU2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Pembimbing 2'";
      $query->update($sqlKPU2);
    }else{
      $sqlKPS2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Pembimbing 2', '$_POST[id_table_dosen2]', '$id_table_akun')";
      $query->insert($sqlKPS2);
    }

    if($cekKP3 != null){
      $sqlKPU3 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen3]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang'";
      $query->update($sqlKPU3);
    }else{
      $sqlKPS3 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang', '$_POST[id_table_dosen3]', '$id_table_akun')";
      $query->insert($sqlKPS3);
    }

    if($cekKP4 != null){
      $sqlKPU4 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen4]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang'";
      $query->update($sqlKPU4);
    }else{
      $sqlKPS4 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang', '$_POST[id_table_dosen4]', '$id_table_akun')";
      $query->insert($sqlKPS4);
    }

    if($cekKP5 != null){
      $sqlKPU5 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen5]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Anggota 1'";
      $query->update($sqlKPU5);
    }else{
      $sqlKPS5 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Anggota 1', '$_POST[id_table_dosen5]', '$id_table_akun')";
      $query->insert($sqlKPS5);
    }

    $sqlKPU6 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataKP[id_table_data_akun]'";
    $query->update($sqlKPU6);

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&dokumen=KesediaanPenguji&id_table_akun=$id_table_akun';</script>";
  }

?>
