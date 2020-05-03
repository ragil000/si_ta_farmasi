<?php

  $getDataSRP = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekSRP = mysqli_num_rows($getDataSRP);
  if($cekSRP > 0){
    $dataSRP = mysqli_fetch_array($getDataSRP);
  }else{
    $dataSRP = null;
  }

  $getDataSRP1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang Proposal'");
  $cekSRP1 = mysqli_num_rows($getDataSRP1);
  if($cekSRP1 > 0){
    $dataSRP1 = mysqli_fetch_array($getDataSRP1);
  }else{
    $dataSRP1 = null;
  }

  $getDataSRP2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang Proposal'");
  $cekSRP2 = mysqli_num_rows($getDataSRP2);
  if($cekSRP2 > 0){
    $dataSRP2 = mysqli_fetch_array($getDataSRP2);
  }else{
    $dataSRP2 = null;
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/rekomendasi_proposal.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
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
      <input type="text" value="<?=$dataSRP['table_dokumen_nilai_ujian_proposal']?>" name="table_dokumen_nilai_ujian_proposal" class="form-control" placeholder="0" <?=$disabledAdm?>>
    </div>
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Ketua Sidang</label>
        <select class="form-control select2" name="id_table_dosen1" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataSRP1 != null){
          ?>
          <option selected="selected" value="<?=$dataSRP1['id_table_dosen']?>"><?=$dataSRP1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlSRPDsn1 = "SELECT * FROM table_dosen";
            $getDataSRPDsn1 = $query->select($sqlSRPDsn1);
            while ($dataSRPDsn1 = mysqli_fetch_array($getDataSRPDsn1)){
              if($dataSRPDsn1['id_table_dosen'] == $dataSRP1['id_table_dosen']){
                $disabledSRP1 = 'disabled';
              }else{
                $disabledSRP1 = '';
              }
          ?>
          <option value="<?=$dataSRPDsn1['id_table_dosen']?>" <?=$disabledSRP1?>><?=$dataSRPDsn1['table_dosen_nama']?></option>
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
            if($dataSRP2 != null){
          ?>
          <option selected="selected" value="<?=$dataSRP2['id_table_dosen']?>"><?=$dataSRP2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlSRPDsn2 = "SELECT * FROM table_dosen";
            $getDataSRPDsn2 = $query->select($sqlSRPDsn2);
            while ($dataSRPDsn2 = mysqli_fetch_array($getDataSRPDsn2)){
              if($dataSRPDsn2['id_table_dosen'] == $dataSRP2['id_table_dosen']){
                $disabledSRP2 = 'disabled';
              }else{
                $disabledSRP2 = '';
              }
          ?>
          <option value="<?=$dataSRPDsn2['id_table_dosen']?>" <?=$disabledSRP2?>><?=$dataSRPDsn2['table_dosen_nama']?></option>
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
        <input type="text" name="table_dokumen_tgl_ujian_proposal" value="<?=$dataSRP['table_dokumen_tgl_ujian_proposal']?>" class="form-control pull-left" id="datepickerP4" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanSRP" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanSRP'])){

    if($disabledMhs == 'disabled'){
      if($cekSRP != null){
        $sqlSRUP = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_proposal = '$_POST[table_dokumen_tgl_ujian_proposal]', table_dokumen_nilai_ujian_proposal = '$_POST[table_dokumen_nilai_ujian_proposal]' WHERE id_table_akun = '$id_table_akun'";
        $query->update($sqlSRUP);
      }else{
        $sqlSRSP = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_proposal, table_dokumen_nilai_ujian_proposal, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_proposal]', '$_POST[table_dokumen_nilai_ujian_proposal]', '$id_table_akun')";
        $query->insert($sqlSRSP);
      }

      if($cekSRP1 != null){
        $sqlSRUP1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Proposal'";
        $query->update($sqlSRUP1);
      }else{
        $sqlSRSP1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Proposal', '$_POST[id_table_dosen1]', '$id_table_akun')";
        $query->insert($sqlSRSP1);
      }

      if($cekSRP2 != null){
        $sqlSRUP2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Proposal'";
        $query->update($sqlSRUP2);
      }else{
        $sqlSRSP2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Proposal', '$_POST[id_table_dosen2]', '$id_table_akun')";
        $query->insert($sqlSRSP2);
      }

      // $sqlSRUP3 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataSRP[id_table_data_akun]'";
      // $query->update($sqlSRUP3);
    }else if($disabledAdm == 'disabled'){
      // if($cekSRP != null){
      //   $sqlSRUP = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_proposal = '$_POST[table_dokumen_tgl_ujian_proposal]', table_dokumen_nilai_ujian_proposal = '$_POST[table_dokumen_nilai_ujian_proposal]' WHERE id_table_akun = '$id_table_akun'";
      //   $query->update($sqlSRUP);
      // }else{
      //   $sqlSRSP = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_proposal, table_dokumen_nilai_ujian_proposal, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_proposal]', '$_POST[table_dokumen_nilai_ujian_proposal]', '$id_table_akun')";
      //   $query->insert($sqlSRSP);
      // }
      //
      // if($cekSRP1 != null){
      //   $sqlSRUP1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Proposal'";
      //   $query->update($sqlSRUP1);
      // }else{
      //   $sqlSRSP1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Proposal', '$_POST[id_table_dosen1]', '$id_table_akun')";
      //   $query->insert($sqlSRSP1);
      // }
      //
      // if($cekSRP2 != null){
      //   $sqlSRUP2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Proposal'";
      //   $query->update($sqlSRUP2);
      // }else{
      //   $sqlSRSP2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Proposal', '$_POST[id_table_dosen2]', '$id_table_akun')";
      //   $query->insert($sqlSRSP2);
      // }

      $sqlSRUP3 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataSRP[id_table_data_akun]'";
      $query->update($sqlSRUP3);
    }

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&menu=halaman_proposal&pilihan=halamanProposal&dokumen=SuratRekomendasiP&id_table_akun=$id_table_akun';</script>";
  }

?>
