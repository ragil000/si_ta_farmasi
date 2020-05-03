<?php

  $getDataBA = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekBA = mysqli_num_rows($getDataBA);
  if($cekBA > 0){
    $dataBA = mysqli_fetch_array($getDataBA);
  }else{
    $dataBA = null;
  }

  $getDataBA1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang'");
  $cekBA1 = mysqli_num_rows($getDataBA1);
  if($cekBA1 > 0){
    $dataBA1 = mysqli_fetch_array($getDataBA1);
  }else{
    $dataBA1 = null;
  }

  $getDataBA2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang'");
  $cekBA2 = mysqli_num_rows($getDataBA2);
  if($cekBA2 > 0){
    $dataBA2 = mysqli_fetch_array($getDataBA2);
  }else{
    $dataBA2 = null;
  }

  $getDataBA3 = $query->select("SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'");
  $cekBA3 = mysqli_num_rows($getDataBA3);
  if($cekBA3 > 0){
    $dataBA3 = mysqli_fetch_array($getDataBA3);
  }else{
    $dataBA3 = null;
  }

  if ($dataBA['table_dokumen_jam_awal_ujian_proposal'] != null){
    $table_dokumen_jam_awal_ujian_proposalBA = $time->waktuView($dataBA['table_dokumen_jam_awal_ujian_proposal']);
  }else{
    $table_dokumen_jam_awal_ujian_proposalBA = '';
  }
  if ($dataBA['table_dokumen_jam_akhir_ujian_proposal'] != null){
    $table_dokumen_jam_akhir_ujian_proposalBA = $time->waktuView($dataBA['table_dokumen_jam_akhir_ujian_proposal']);
  }else{
    $table_dokumen_jam_akhir_ujian_proposalBA = '';
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/berita_acara.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
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
      <label>Tanggal Ujian Proposal</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" value="<?=$dataBA['table_dokumen_tgl_ujian_proposal']?>" name="table_dokumen_tgl_ujian_proposal" class="form-control pull-left" id="datepicker" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group col-md-12">
      <label>Tempat Ujian Proposal</label>
      <textarea type="text" name="table_dokumen_tempat_ujian_proposal" class="form-control" <?=$disabledAdm?>><?=$dataBA['table_dokumen_tempat_ujian_proposal']?></textarea>
    </div>
    <div class="form-group">
      <!-- time Picker -->
      <div class="bootstrap-timepicker">
        <div class="form-group col-md-6">
          <label>Waktu Mulai Ujian Proposal</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_awal_ujian_proposalBA?>" name="table_dokumen_jam_awal_ujian_proposal" class="form-control timepicker" <?=$disabledAdm?>>

            <div class="input-group-addon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group col-md-6">
          <label>Waktu Berakhir Ujian Proposal</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_akhir_ujian_proposalBA?>" name="table_dokumen_jam_akhir_ujian_proposal" class="form-control timepicker2" <?=$disabledAdm?>>

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
            if($dataBA1 != null){
          ?>
          <option selected="selected" value="<?=$dataBA1['id_table_dosen']?>"><?=$dataBA1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlBADsn1 = "SELECT * FROM table_dosen";
            $getDataBADsn1 = $query->select($sqlBADsn1);
            while ($dataBADsn1 = mysqli_fetch_array($getDataBADsn1)){
              if($dataBADsn1['id_table_dosen'] == $dataBA1['id_table_dosen']){
                $disabledBA1 = 'disabled';
              }else{
                $disabledBA1 = '';
              }
          ?>
          <option value="<?=$dataBADsn1['id_table_dosen']?>" <?=$disabledBA1?>><?=$dataBADsn1['table_dosen_nama']?></option>
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
            if($dataBA2 != null){
          ?>
          <option selected="selected" value="<?=$dataBA2['id_table_dosen']?>"><?=$dataBA2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlBADsn2 = "SELECT * FROM table_dosen";
            $getDataBADsn2 = $query->select($sqlBADsn2);
            while ($dataBADsn2 = mysqli_fetch_array($getDataBADsn2)){
              if($dataBADsn2['id_table_dosen'] == $dataBA2['id_table_dosen']){
                $disabledBA2 = 'disabled';
              }else{
                $disabledBA2 = '';
              }
          ?>
          <option value="<?=$dataBADsn2['id_table_dosen']?>" <?=$disabledBA2?>><?=$dataBADsn2['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Ketua Jurusan</label>
      <input type="text" class="form-control" placeholder="<?=$dataBA3['table_dosen_nama']?>" disabled>
    </div>
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanBA" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanBA'])){

    $table_dokumen_jam_awal_ujian_proposalBAI = $time->waktuInput($_POST['table_dokumen_jam_awal_ujian_proposal']);
    $table_dokumen_jam_akhir_ujian_proposalBAI = $time->waktuInput($_POST['table_dokumen_jam_akhir_ujian_proposal']);

    if($cekBA != null){
      $sqlBAU = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_proposal = '$_POST[table_dokumen_tgl_ujian_proposal]', table_dokumen_tempat_ujian_proposal = '$_POST[table_dokumen_tempat_ujian_proposal]', table_dokumen_jam_awal_ujian_proposal = '$table_dokumen_jam_awal_ujian_proposalBAI', table_dokumen_jam_akhir_ujian_proposal = '$table_dokumen_jam_akhir_ujian_proposalBAI' WHERE id_table_akun = '$id_table_akun'";
      $query->update($sqlBAU);
    }else{
      $sqlBAS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_proposal, table_dokumen_tempat_ujian_proposal, table_dokumen_jam_awal_ujian_proposal, table_dokumen_jam_akhir_ujian_proposal, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_proposal]', '$_POST[table_dokumen_tempat_ujian_proposal]', '$table_dokumen_jam_awal_ujian_proposalBAI', '$table_dokumen_jam_akhir_ujian_proposalBAI', '$id_table_akun')";
      $query->insert($sqlBAS);
    }

    if($cekBA1 != null){
      $sqlBAU1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang'";
      $query->update($sqlBAU1);
    }else{
      $sqlBAS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang', '$_POST[id_table_dosen1]', '$id_table_akun')";
      $query->insert($sqlBAS1);
    }

    if($cekBA2 != null){
      $sqlBAU2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang'";
      $query->update($sqlBAU2);
    }else{
      $sqlBAS2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang', '$_POST[id_table_dosen2]', '$id_table_akun')";
      $query->insert($sqlBAS2);
    }

    $sqlBAU3 = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataBA[id_table_data_akun]'";
    $query->update($sqlBAU3);

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&dokumen=BeritaAcara&id_table_akun=$id_table_akun';</script>";
  }

?>
