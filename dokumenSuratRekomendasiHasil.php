<?php

  $getDataSRH = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekSRH = mysqli_num_rows($getDataSRH);
  if($cekSRH > 0){
    $dataSRH = mysqli_fetch_array($getDataSRH);
  }else{
    $dataSRH = null;
  }

  $getDataSRH1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang Hasil'");
  $cekSRH1 = mysqli_num_rows($getDataSRH1);
  if($cekSRH1 > 0){
    $dataSRH1 = mysqli_fetch_array($getDataSRH1);
  }else{
    $dataSRH1 = null;
  }

  $getDataSRH2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang Hasil'");
  $cekSRH2 = mysqli_num_rows($getDataSRH2);
  if($cekSRH2 > 0){
    $dataSRH2 = mysqli_fetch_array($getDataSRH2);
  }else{
    $dataSRH2 = null;
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/rekomendasi_hasil.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
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
      <label>Nilai</label>
      <input type="text" value="<?=$dataSRH['table_dokumen_nilai_ujian_hasil']?>" name="table_dokumen_nilai_ujian_hasil" class="form-control" placeholder="0" <?=$disabledAdm?>>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Ketua Sidang</label>
        <select class="form-control select2" name="id_table_dosen1" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataSRH1 != null){
          ?>
          <option selected="selected" value="<?=$dataSRH1['id_table_dosen']?>"><?=$dataSRH1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlSRHDsn1 = "SELECT * FROM table_dosen";
            $getDataSRHDsn1 = $query->select($sqlSRHDsn1);
            while ($dataSRHDsn1 = mysqli_fetch_array($getDataSRHDsn1)){
              if($dataSRHDsn1['id_table_dosen'] == $dataSRH1['id_table_dosen']){
                $disabledSRH1 = 'disabled';
              }else{
                $disabledSRH1 = '';
              }
          ?>
          <option value="<?=$dataSRHDsn1['id_table_dosen']?>" <?=$disabledSRH1?>><?=$dataSRHDsn1['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Sekretaris Sidang</label>
        <select class="form-control select2" name="id_table_dosen2" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataSRH2 != null){
          ?>
          <option selected="selected" value="<?=$dataSRH2['id_table_dosen']?>"><?=$dataSRH2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlSRHDsn2 = "SELECT * FROM table_dosen";
            $getDataSRHDsn2 = $query->select($sqlSRHDsn2);
            while ($dataSRHDsn2 = mysqli_fetch_array($getDataSRHDsn2)){
              if($dataSRHDsn2['id_table_dosen'] == $dataSRH2['id_table_dosen']){
                $disabledSRH2 = 'disabled';
              }else{
                $disabledSRH2 = '';
              }
          ?>
          <option value="<?=$dataSRHDsn2['id_table_dosen']?>" <?=$disabledSRH2?>><?=$dataSRHDsn2['table_dosen_nama']?></option>
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
        <input type="text" name="table_dokumen_tgl_ujian_hasil" value="<?=$dataSRH['table_dokumen_tgl_ujian_hasil']?>" class="form-control pull-left" id="datepickerH4" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanSRH" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanSRH'])){

    if($disabledMhs == 'disabled'){
      if($cekSRH != null){
        $sqlSRUH = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_hasil = '$_POST[table_dokumen_tgl_ujian_hasil]', table_dokumen_nilai_ujian_hasil = '$_POST[table_dokumen_nilai_ujian_hasil]' WHERE id_table_akun = '$id_table_akun'";
        $query->update($sqlSRUH);
      }else{
        $sqlSRSH = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_hasil, table_dokumen_nilai_ujian_hasil, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_hasil]', '$_POST[table_dokumen_nilai_ujian_hasil]', '$id_table_akun')";
        $query->insert($sqlSRSH);
      }

      if($cekSRH1 != null){
        $sqlSRUH1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Hasil'";
        $query->update($sqlSRUH1);
      }else{
        $sqlSRSH1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Hasil', '$_POST[id_table_dosen1]', '$id_table_akun')";
        $query->insert($sqlSRSH1);
      }

      if($cekSRH2 != null){
        $sqlSRUH2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Hasil'";
        $query->update($sqlSRUH2);
      }else{
        $sqlSRSH2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Hasil', '$_POST[id_table_dosen2]', '$id_table_akun')";
        $query->insert($sqlSRSH2);
      }

      // $sqlSRUH3 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataSRH[id_table_data_akun]'";
      // $query->update($sqlSRUH3);
    }else if($disabledAdm == 'disabled'){
      // if($cekSRH != null){
      //   $sqlSRUH = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_hasil = '$_POST[table_dokumen_tgl_ujian_hasil]', table_dokumen_nilai_ujian_hasil = '$_POST[table_dokumen_nilai_ujian_hasil]' WHERE id_table_akun = '$id_table_akun'";
      //   $query->update($sqlSRUH);
      // }else{
      //   $sqlSRSH = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_hasil, table_dokumen_nilai_ujian_hasil, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_hasil]', '$_POST[table_dokumen_nilai_ujian_hasil]', '$id_table_akun')";
      //   $query->insert($sqlSRSH);
      // }
      //
      // if($cekSRH1 != null){
      //   $sqlSRUH1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Hasil'";
      //   $query->update($sqlSRUH1);
      // }else{
      //   $sqlSRSH1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Hasil', '$_POST[id_table_dosen1]', '$id_table_akun')";
      //   $query->insert($sqlSRSH1);
      // }
      //
      // if($cekSRH2 != null){
      //   $sqlSRUH2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Hasil'";
      //   $query->update($sqlSRUH2);
      // }else{
      //   $sqlSRSH2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Hasil', '$_POST[id_table_dosen2]', '$id_table_akun')";
      //   $query->insert($sqlSRSH2);
      // }

      $sqlSRUH3 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataSRH[id_table_data_akun]'";
      $query->update($sqlSRUH3);
    }

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&menu=halaman_hasil&pilihan=halamanHasil&dokumen=SuratRekomendasiH&id_table_akun=$id_table_akun';</script>";
  }

?>
