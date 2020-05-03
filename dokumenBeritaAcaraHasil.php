<?php

  $getDataBAH = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekBAH = mysqli_num_rows($getDataBAH);
  if($cekBAH > 0){
    $dataBAH = mysqli_fetch_array($getDataBAH);
  }else{
    $dataBAH = null;
  }

  $getDataBAH1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang Hasil'");
  $cekBAH1 = mysqli_num_rows($getDataBAH1);
  if($cekBAH1 > 0){
    $dataBAH1 = mysqli_fetch_array($getDataBAH1);
  }else{
    $dataBAH1 = null;
  }

  $getDataBAH2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang Hasil'");
  $cekBAH2 = mysqli_num_rows($getDataBAH2);
  if($cekBAH2 > 0){
    $dataBAH2 = mysqli_fetch_array($getDataBAH2);
  }else{
    $dataBAH2 = null;
  }

  $getDataBAH3 = $query->select("SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'");
  $cekBAH3 = mysqli_num_rows($getDataBAH3);
  if($cekBAH3 > 0){
    $dataBAH3 = mysqli_fetch_array($getDataBAH3);
  }else{
    $dataBAH3 = null;
  }

  if ($dataBAH['table_dokumen_jam_awal_ujian_hasil'] != null){
    $table_dokumen_jam_awal_ujian_hasilBAH = $time->waktuView($dataBAH['table_dokumen_jam_awal_ujian_hasil']);
  }else{
    $table_dokumen_jam_awal_ujian_hasilBAH = '';
  }
  if ($dataBAH['table_dokumen_jam_akhir_ujian_hasil'] != null){
    $table_dokumen_jam_akhir_ujian_hasilBAH = $time->waktuView($dataBAH['table_dokumen_jam_akhir_ujian_hasil']);
  }else{
    $table_dokumen_jam_akhir_ujian_hasilBAH = '';
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/berita_acara_hasil.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
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
      <label>Tanggal Ujian Hasil</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" value="<?=$dataBAH['table_dokumen_tgl_ujian_hasil']?>" name="table_dokumen_tgl_ujian_hasil" class="form-control pull-left" id="datepickerH" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group col-md-12">
      <label>Tempat Ujian Hasil</label>
      <textarea type="text" name="table_dokumen_tempat_ujian_hasil" class="form-control" <?=$disabledAdm?>><?=$dataBAH['table_dokumen_tempat_ujian_hasil']?></textarea>
    </div>
    <div class="form-group">
      <!-- time Picker -->
      <div class="bootstrap-timepicker">
        <div class="form-group col-md-6">
          <label>Waktu Mulai Ujian Hasil</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_awal_ujian_hasilBAH?>" name="table_dokumen_jam_awal_ujian_hasil" class="form-control timepickerH" <?=$disabledAdm?>>

            <div class="input-group-addon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group col-md-6">
          <label>Waktu Berakhir Ujian Hasil</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_akhir_ujian_hasilBAH?>" name="table_dokumen_jam_akhir_ujian_hasil" class="form-control timepickerH2" <?=$disabledAdm?>>

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
            if($dataBAH1 != null){
          ?>
          <option selected="selected" value="<?=$dataBAH1['id_table_dosen']?>"><?=$dataBAH1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlBAHDsn1 = "SELECT * FROM table_dosen";
            $getDataBAHDsn1 = $query->select($sqlBAHDsn1);
            while ($dataBAHDsn1 = mysqli_fetch_array($getDataBAHDsn1)){
              if($dataBAHDsn1['id_table_dosen'] == $dataBAH1['id_table_dosen']){
                $disabledBAH1 = 'disabled';
              }else{
                $disabledBAH1 = '';
              }
          ?>
          <option value="<?=$dataBAHDsn1['id_table_dosen']?>" <?=$disabledBAH1?>><?=$dataBAHDsn1['table_dosen_nama']?></option>
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
            if($dataBAH2 != null){
          ?>
          <option selected="selected" value="<?=$dataBAH2['id_table_dosen']?>"><?=$dataBAH2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlBAHDsn2 = "SELECT * FROM table_dosen";
            $getDataBAHDsn2 = $query->select($sqlBAHDsn2);
            while ($dataBAHDsn2 = mysqli_fetch_array($getDataBAHDsn2)){
              if($dataBAHDsn2['id_table_dosen'] == $dataBAH2['id_table_dosen']){
                $disabledBAH2 = 'disabled';
              }else{
                $disabledBAH2 = '';
              }
          ?>
          <option value="<?=$dataBAHDsn2['id_table_dosen']?>" <?=$disabledBAH2?>><?=$dataBAHDsn2['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Ketua Jurusan</label>
      <input type="text" class="form-control" placeholder="<?=$dataBAH3['table_dosen_nama']?>" disabled>
    </div>
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanBAH" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanBAH'])){

    $table_dokumen_jam_awal_ujian_hasilBAHI = $time->waktuInput($_POST['table_dokumen_jam_awal_ujian_hasil']);
    $table_dokumen_jam_akhir_ujian_hasilBAHI = $time->waktuInput($_POST['table_dokumen_jam_akhir_ujian_hasil']);

    if($disabledMhs == 'disabled'){
      if($cekBAH != null){
        $sqlBAUH = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_hasil = '$_POST[table_dokumen_tgl_ujian_hasil]', table_dokumen_tempat_ujian_hasil = '$_POST[table_dokumen_tempat_ujian_hasil]', table_dokumen_jam_awal_ujian_hasil = '$table_dokumen_jam_awal_ujian_hasilBAHI', table_dokumen_jam_akhir_ujian_hasil = '$table_dokumen_jam_akhir_ujian_hasilBAHI' WHERE id_table_akun = '$id_table_akun'";
        $query->update($sqlBAUH);
      }else{
        $sqlBASH = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_hasil, table_dokumen_tempat_ujian_hasil, table_dokumen_jam_awal_ujian_hasil, table_dokumen_jam_akhir_ujian_hasil, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_hasil]', '$_POST[table_dokumen_tempat_ujian_hasil]', '$table_dokumen_jam_awal_ujian_hasilBAHI', '$table_dokumen_jam_akhir_ujian_hasilBAHI', '$id_table_akun')";
        $query->insert($sqlBASH);
      }

      if($cekBAH1 != null){
        $sqlBAUH1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Hasil'";
        $query->update($sqlBAUH1);
      }else{
        $sqlBASH1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Hasil', '$_POST[id_table_dosen1]', '$id_table_akun')";
        $query->insert($sqlBASH1);
      }

      if($cekBAH2 != null){
        $sqlBAUH2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Hasil'";
        $query->update($sqlBAUH2);
      }else{
        $sqlBASH2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Hasil', '$_POST[id_table_dosen2]', '$id_table_akun')";
        $query->insert($sqlBASH2);
      }

      // $sqlBAUH3 = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataBAH[id_table_data_akun]'";
      // $query->update($sqlBAUH3);
    }else if($disabledAdm == 'disabled'){
      // if($cekBAH != null){
      //   $sqlBAUH = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_hasil = '$_POST[table_dokumen_tgl_ujian_hasil]', table_dokumen_tempat_ujian_hasil = '$_POST[table_dokumen_tempat_ujian_hasil]', table_dokumen_jam_awal_ujian_hasil = '$table_dokumen_jam_awal_ujian_hasilBAHI', table_dokumen_jam_akhir_ujian_hasil = '$table_dokumen_jam_akhir_ujian_hasilBAHI' WHERE id_table_akun = '$id_table_akun'";
      //   $query->update($sqlBAUH);
      // }else{
      //   $sqlBASH = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_hasil, table_dokumen_tempat_ujian_hasil, table_dokumen_jam_awal_ujian_hasil, table_dokumen_jam_akhir_ujian_hasil, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_hasil]', '$_POST[table_dokumen_tempat_ujian_hasil]', '$table_dokumen_jam_awal_ujian_hasilBAHI', '$table_dokumen_jam_akhir_ujian_hasilBAHI', '$id_table_akun')";
      //   $query->insert($sqlBASH);
      // }
      //
      // if($cekBAH1 != null){
      //   $sqlBAUH1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Hasil'";
      //   $query->update($sqlBAUH1);
      // }else{
      //   $sqlBASH1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Hasil', '$_POST[id_table_dosen1]', '$id_table_akun')";
      //   $query->insert($sqlBASH1);
      // }
      //
      // if($cekBAH2 != null){
      //   $sqlBAUH2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Hasil'";
      //   $query->update($sqlBAUH2);
      // }else{
      //   $sqlBASH2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Hasil', '$_POST[id_table_dosen2]', '$id_table_akun')";
      //   $query->insert($sqlBASH2);
      // }

      $sqlBAUH3 = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataBAH[id_table_data_akun]'";
      $query->update($sqlBAUH3);
    }

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&menu=halaman_hasil&pilihan=halamanHasil&dokumen=BeritaAcaraH&id_table_akun=$id_table_akun';</script>";
  }

?>
