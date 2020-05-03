<?php

  $getDataBAS = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekBAS = mysqli_num_rows($getDataBAS);
  if($cekBAS > 0){
    $dataBAS = mysqli_fetch_array($getDataBAS);
  }else{
    $dataBAS = null;
  }

  $getDataBAS1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang Skripsi'");
  $cekBAS1 = mysqli_num_rows($getDataBAS1);
  if($cekBAS1 > 0){
    $dataBAS1 = mysqli_fetch_array($getDataBAS1);
  }else{
    $dataBAS1 = null;
  }

  $getDataBAS2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang Skripsi'");
  $cekBAS2 = mysqli_num_rows($getDataBAS2);
  if($cekBAS2 > 0){
    $dataBAS2 = mysqli_fetch_array($getDataBAS2);
  }else{
    $dataBAS2 = null;
  }

  $getDataBAS3 = $query->select("SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'");
  $cekBAS3 = mysqli_num_rows($getDataBAS3);
  if($cekBAS3 > 0){
    $dataBAS3 = mysqli_fetch_array($getDataBAS3);
  }else{
    $dataBAS3 = null;
  }

  if ($dataBAS['table_dokumen_jam_awal_ujian_skripsi'] != null){
    $table_dokumen_jam_awal_ujian_skripsiBAS = $time->waktuView($dataBAS['table_dokumen_jam_awal_ujian_skripsi']);
  }else{
    $table_dokumen_jam_awal_ujian_skripsiBAS = '';
  }
  if ($dataBAS['table_dokumen_jam_akhir_ujian_skripsi'] != null){
    $table_dokumen_jam_akhir_ujian_skripsiBAS = $time->waktuView($dataBAS['table_dokumen_jam_akhir_ujian_skripsi']);
  }else{
    $table_dokumen_jam_akhir_ujian_skripsiBAS = '';
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/berita_acara_skripsi.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
  </div>
</div>
<form role="form" method="POST">
  <div class="box-body">
    <div class="form-group col-md-4">
      <div class="form-group">
        <label>Nama Mahasiswa</label>
        <input type="text" name="table_data_akun_nama" value="<?=$dataMhs['table_data_akun_nama']?>" class="form-control" placeholder="Nama" <?=$disabledMhs?>>
      </div>
    </div>
    <div class="form-group col-md-4">
      <div class="form-group">
        <label>NIM</label>
        <input type="text" name="table_data_akun_nim" value="<?=$dataMhs['table_data_akun_nim']?>" class="form-control" placeholder="NIM" <?=$disabledMhs?>>
      </div>
    </div>
    <!-- Date -->
    <div class="form-group col-md-4">
      <label>Tanggal Ujian Skripsi</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" value="<?=$dataBAS['table_dokumen_tgl_ujian_skripsi']?>" name="table_dokumen_tgl_ujian_skripsi" class="form-control pull-left" id="datepickerS" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group col-md-12">
      <label>Tempat Ujian Skripsi</label>
      <textarea type="text" name="table_dokumen_tempat_ujian_skripsi" class="form-control" <?=$disabledAdm?>><?=$dataBAS['table_dokumen_tempat_ujian_skripsi']?></textarea>
    </div>
    <div class="form-group">
      <!-- time Picker -->
      <div class="bootstrap-timepicker">
        <div class="form-group col-md-6">
          <label>Waktu Mulai Ujian Skripsi</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_awal_ujian_skripsiBAS?>" name="table_dokumen_jam_awal_ujian_skripsi" class="form-control timepickerS" <?=$disabledAdm?>>

            <div class="input-group-addon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group col-md-6">
          <label>Waktu Berakhir Ujian Skripsi</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_akhir_ujian_skripsiBAS?>" name="table_dokumen_jam_akhir_ujian_skripsi" class="form-control timepickerS2" <?=$disabledAdm?>>

            <div class="input-group-addon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Ketua Sidang</label>
        <select name="id_table_dosen1" class="form-control select2" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataBAS1 != null){
          ?>
          <option selected="selected" value="<?=$dataBAS1['id_table_dosen']?>"><?=$dataBAS1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlBASDsn1 = "SELECT * FROM table_dosen";
            $getDataBASDsn1 = $query->select($sqlBASDsn1);
            while ($dataBASDsn1 = mysqli_fetch_array($getDataBASDsn1)){
              if($dataBASDsn1['id_table_dosen'] == $dataBAS1['id_table_dosen']){
                $disabledBAS1 = 'disabled';
              }else{
                $disabledBAS1 = '';
              }
          ?>
          <option value="<?=$dataBASDsn1['id_table_dosen']?>" <?=$disabledBAS1?>><?=$dataBASDsn1['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Sekretaris Sidang</label>
        <select name="id_table_dosen2" class="form-control select2" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataBAS2 != null){
          ?>
          <option selected="selected" value="<?=$dataBAS2['id_table_dosen']?>"><?=$dataBAS2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlBASDsn2 = "SELECT * FROM table_dosen";
            $getDataBASDsn2 = $query->select($sqlBASDsn2);
            while ($dataBASDsn2 = mysqli_fetch_array($getDataBASDsn2)){
              if($dataBASDsn2['id_table_dosen'] == $dataBAS2['id_table_dosen']){
                $disabledBAS2 = 'disabled';
              }else{
                $disabledBAS2 = '';
              }
          ?>
          <option value="<?=$dataBASDsn2['id_table_dosen']?>" <?=$disabledBAS2?>><?=$dataBASDsn2['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Ketua Jurusan</label>
      <input type="text" class="form-control" placeholder="<?=$dataBAS3['table_dosen_nama']?>" disabled>
    </div>
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanBAS" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanBAS'])){

    $table_dokumen_jam_awal_ujian_skripsiBASI = $time->waktuInput($_POST['table_dokumen_jam_awal_ujian_skripsi']);
    $table_dokumen_jam_akhir_ujian_skripsiBASI = $time->waktuInput($_POST['table_dokumen_jam_akhir_ujian_skripsi']);

    if($disabledMhs == 'disabled'){
      if($cekBAS != null){
        $sqlBAUS = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_skripsi = '$_POST[table_dokumen_tgl_ujian_skripsi]', table_dokumen_tempat_ujian_skripsi = '$_POST[table_dokumen_tempat_ujian_skripsi]', table_dokumen_jam_awal_ujian_skripsi = '$table_dokumen_jam_awal_ujian_skripsiBASI', table_dokumen_jam_akhir_ujian_skripsi = '$table_dokumen_jam_akhir_ujian_skripsiBASI' WHERE id_table_akun = '$id_table_akun'";
        $query->update($sqlBAUS);
      }else{
        $sqlBASS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_skripsi, table_dokumen_tempat_ujian_skripsi, table_dokumen_jam_awal_ujian_skripsi, table_dokumen_jam_akhir_ujian_skripsi, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_skripsi]', '$_POST[table_dokumen_tempat_ujian_skripsi]', '$table_dokumen_jam_awal_ujian_skripsiBASI', '$table_dokumen_jam_akhir_ujian_skripsiBASI', '$id_table_akun')";
        $query->insert($sqlBASS);
      }

      if($cekBAS1 != null){
        $sqlBAUS1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Skripsi'";
        $query->update($sqlBAUS1);
      }else{
        $sqlBASS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang skripsi', '$_POST[id_table_dosen1]', '$id_table_akun')";
        $query->insert($sqlBASS1);
      }

      if($cekBAS2 != null){
        $sqlBAUS2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Skripsi'";
        $query->update($sqlBAUS2);
      }else{
        $sqlBASS2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang skripsi', '$_POST[id_table_dosen2]', '$id_table_akun')";
        $query->insert($sqlBASS2);
      }

      // $sqlBAUS3 = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataBAS[id_table_data_akun]'";
      // $query->update($sqlBAUS3);
    }else if($disabledAdm == 'disabled'){
      // if($cekBAS != null){
      //   $sqlBAUS = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_skripsi = '$_POST[table_dokumen_tgl_ujian_skripsi]', table_dokumen_tempat_ujian_skripsi = '$_POST[table_dokumen_tempat_ujian_skripsi]', table_dokumen_jam_awal_ujian_skripsi = '$table_dokumen_jam_awal_ujian_skripsiBASI', table_dokumen_jam_akhir_ujian_skripsi = '$table_dokumen_jam_akhir_ujian_skripsiBASI' WHERE id_table_akun = '$id_table_akun'";
      //   $query->update($sqlBAUS);
      // }else{
      //   $sqlBASS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_skripsi, table_dokumen_tempat_ujian_skripsi, table_dokumen_jam_awal_ujian_skripsi, table_dokumen_jam_akhir_ujian_skripsi, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_skripsi]', '$_POST[table_dokumen_tempat_ujian_skripsi]', '$table_dokumen_jam_awal_ujian_skripsiBASI', '$table_dokumen_jam_akhir_ujian_skripsiBASI', '$id_table_akun')";
      //   $query->insert($sqlBASS);
      // }
      //
      // if($cekBAS1 != null){
      //   $sqlBAUS1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Skripsi'";
      //   $query->update($sqlBAUS1);
      // }else{
      //   $sqlBASS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang skripsi', '$_POST[id_table_dosen1]', '$id_table_akun')";
      //   $query->insert($sqlBASS1);
      // }
      //
      // if($cekBAS2 != null){
      //   $sqlBAUS2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Skripsi'";
      //   $query->update($sqlBAUS2);
      // }else{
      //   $sqlBASS2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang skripsi', '$_POST[id_table_dosen2]', '$id_table_akun')";
      //   $query->insert($sqlBASS2);
      // }

      $sqlBAUS3 = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataBAS[id_table_data_akun]'";
      $query->update($sqlBAUS3);
    }

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&menu=halaman_skripsi&pilihan=halamanSkripsi&dokumen=BeritaAcaraS&id_table_akun=$id_table_akun';</script>";
  }

?>
