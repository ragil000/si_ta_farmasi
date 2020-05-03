<?php

  $getDataSR = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekSR = mysqli_num_rows($getDataSR);
  if($cekSR > 0){
    $dataSR = mysqli_fetch_array($getDataSR);
  }else{
    $dataSR = null;
  }

  $getDataSR1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang'");
  $cekSR1 = mysqli_num_rows($getDataSR1);
  if($cekSR1 > 0){
    $dataSR1 = mysqli_fetch_array($getDataSR1);
  }else{
    $dataSR1 = null;
  }

  $getDataSR2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang'");
  $cekSR2 = mysqli_num_rows($getDataSR2);
  if($cekSR2 > 0){
    $dataSR2 = mysqli_fetch_array($getDataSR2);
  }else{
    $dataSR2 = null;
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/rekomendasi.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
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
      <input type="text" value="<?=$dataSR['table_dokumen_nilai_ujian_proposal']?>" name="table_dokumen_nilai_ujian_proposal" class="form-control" placeholder="0" <?=$disabledAdm?>>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Ketua Sidang</label>
        <select class="form-control select2" name="id_table_dosen1" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataSR1 != null){
          ?>
          <option selected="selected" value="<?=$dataSR1['id_table_dosen']?>"><?=$dataSR1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlSRDsn1 = "SELECT * FROM table_dosen";
            $getDataSRDsn1 = $query->select($sqlSRDsn1);
            while ($dataSRDsn1 = mysqli_fetch_array($getDataSRDsn1)){
              if($dataSRDsn1['id_table_dosen'] == $dataSR1['id_table_dosen']){
                $disabledSR1 = 'disabled';
              }else{
                $disabledSR1 = '';
              }
          ?>
          <option value="<?=$dataSRDsn1['id_table_dosen']?>" <?=$disabledSR1?>><?=$dataSRDsn1['table_dosen_nama']?></option>
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
            if($dataSR2 != null){
          ?>
          <option selected="selected" value="<?=$dataSR2['id_table_dosen']?>"><?=$dataSR2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlSRDsn2 = "SELECT * FROM table_dosen";
            $getDataSRDsn2 = $query->select($sqlSRDsn2);
            while ($dataSRDsn2 = mysqli_fetch_array($getDataSRDsn2)){
              if($dataSRDsn2['id_table_dosen'] == $dataSR2['id_table_dosen']){
                $disabledSR2 = 'disabled';
              }else{
                $disabledSR2 = '';
              }
          ?>
          <option value="<?=$dataSRDsn2['id_table_dosen']?>" <?=$disabledSR2?>><?=$dataSRDsn2['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <!-- Date -->
    <div class="form-group col-md-12">
      <label>Tanggal Ujian Proposal</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" name="table_dokumen_tgl_ujian_proposal" value="<?=$dataSR['table_dokumen_tgl_ujian_proposal']?>" class="form-control pull-left" id="datepicker4" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanSR" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanSR'])){

    if($cekSR != null){
      $sqlSRU = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_proposal = '$_POST[table_dokumen_tgl_ujian_proposal]', table_dokumen_nilai_ujian_proposal = '$_POST[table_dokumen_nilai_ujian_proposal]' WHERE id_table_akun = '$id_table_akun'";
      $query->update($sqlSRU);
    }else{
      $sqlSRS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_proposal, table_dokumen_nilai_ujian_proposal, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_proposal]', '$_POST[table_dokumen_nilai_ujian_proposal]', '$id_table_akun')";
      $query->insert($sqlSRS);
    }

    if($cekSR1 != null){
      $sqlSRU1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang'";
      $query->update($sqlSRU1);
    }else{
      $sqlSRS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang', '$_POST[id_table_dosen1]', '$id_table_akun')";
      $query->insert($sqlSRS1);
    }

    if($cekSR2 != null){
      $sqlSRU2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang'";
      $query->update($sqlSRU2);
    }else{
      $sqlSRS2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang', '$_POST[id_table_dosen2]', '$id_table_akun')";
      $query->insert($sqlSRS2);
    }

    $sqlSRU3 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataSR[id_table_data_akun]'";
    $query->update($sqlSRU3);

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&dokumen=SuratRekomendasi&id_table_akun=$id_table_akun';</script>";
  }

?>
