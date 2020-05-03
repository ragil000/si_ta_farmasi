<?php

  $getDataBAP = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekBAP = mysqli_num_rows($getDataBAP);
  if($cekBAP > 0){
    $dataBAP = mysqli_fetch_array($getDataBAP);
  }else{
    $dataBAP = null;
  }

  $getDataBAP1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Ketua Sidang Proposal'");
  $cekBAP1 = mysqli_num_rows($getDataBAP1);
  if($cekBAP1 > 0){
    $dataBAP1 = mysqli_fetch_array($getDataBAP1);
  }else{
    $dataBAP1 = null;
  }

  $getDataBAP2 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Sekretaris Sidang Proposal'");
  $cekBAP2 = mysqli_num_rows($getDataBAP2);
  if($cekBAP2 > 0){
    $dataBAP2 = mysqli_fetch_array($getDataBAP2);
  }else{
    $dataBAP2 = null;
  }

  $getDataBAP3 = $query->select("SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'");
  $cekBAP3 = mysqli_num_rows($getDataBAP3);
  if($cekBAP3 > 0){
    $dataBAP3 = mysqli_fetch_array($getDataBAP3);
  }else{
    $dataBAP3 = null;
  }

  if ($dataBAP['table_dokumen_jam_awal_ujian_proposal'] != null){
    $table_dokumen_jam_awal_ujian_proposalBAP = $time->waktuView($dataBAP['table_dokumen_jam_awal_ujian_proposal']);
  }else{
    $table_dokumen_jam_awal_ujian_proposalBAP = '';
  }
  if ($dataBAP['table_dokumen_jam_akhir_ujian_proposal'] != null){
    $table_dokumen_jam_akhir_ujian_proposalBAP = $time->waktuView($dataBAP['table_dokumen_jam_akhir_ujian_proposal']);
  }else{
    $table_dokumen_jam_akhir_ujian_proposalBAP = '';
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/berita_acara_proposal.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
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
        <input type="text" value="<?=$dataBAP['table_dokumen_tgl_ujian_proposal']?>" name="table_dokumen_tgl_ujian_proposal" class="form-control pull-left" id="datepickerP" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group col-md-12">
      <label>Tempat Ujian Proposal</label>
      <textarea type="text" name="table_dokumen_tempat_ujian_proposal" class="form-control" <?=$disabledAdm?>><?=$dataBAP['table_dokumen_tempat_ujian_proposal']?></textarea>
    </div>
    <div class="form-group">
      <!-- time Picker -->
      <div class="bootstrap-timepicker">
        <div class="form-group col-md-6">
          <label>Waktu Mulai Ujian Proposal</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_awal_ujian_proposalBAP?>" name="table_dokumen_jam_awal_ujian_proposal" class="form-control timepickerP" <?=$disabledAdm?>>

            <div class="input-group-addon">
              <i class="fa fa-clock-o"></i>
            </div>
          </div>
          <!-- /.input group -->
        </div>
        <div class="form-group col-md-6">
          <label>Waktu Berakhir Ujian Proposal</label>

          <div class="input-group">
            <input type="text" value="<?=$table_dokumen_jam_akhir_ujian_proposalBAP?>" name="table_dokumen_jam_akhir_ujian_proposal" class="form-control timepickerP2" <?=$disabledAdm?>>

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
            if($dataBAP1 != null){
          ?>
          <option selected="selected" value="<?=$dataBAP1['id_table_dosen']?>"><?=$dataBAP1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Ketua Sidang</option>
          <?php
            }
            $sqlBAPDsn1 = "SELECT * FROM table_dosen";
            $getDataBAPDsn1 = $query->select($sqlBAPDsn1);
            while ($dataBAPDsn1 = mysqli_fetch_array($getDataBAPDsn1)){
              if($dataBAPDsn1['id_table_dosen'] == $dataBAP1['id_table_dosen']){
                $disabledBAP1 = 'disabled';
              }else{
                $disabledBAP1 = '';
              }
          ?>
          <option value="<?=$dataBAPDsn1['id_table_dosen']?>" <?=$disabledBAP1?>><?=$dataBAPDsn1['table_dosen_nama']?></option>
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
            if($dataBAP2 != null){
          ?>
          <option selected="selected" value="<?=$dataBAP2['id_table_dosen']?>"><?=$dataBAP2['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Sekretaris Sidang</option>
          <?php
            }
            $sqlBAPDsn2 = "SELECT * FROM table_dosen";
            $getDataBAPDsn2 = $query->select($sqlBAPDsn2);
            while ($dataBAPDsn2 = mysqli_fetch_array($getDataBAPDsn2)){
              if($dataBAPDsn2['id_table_dosen'] == $dataBAP2['id_table_dosen']){
                $disabledBAP2 = 'disabled';
              }else{
                $disabledBAP2 = '';
              }
          ?>
          <option value="<?=$dataBAPDsn2['id_table_dosen']?>" <?=$disabledBAP2?>><?=$dataBAPDsn2['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Ketua Jurusan</label>
      <input type="text" class="form-control" placeholder="<?=$dataBAP3['table_dosen_nama']?>" disabled>
    </div>
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanBAP" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanBAP'])){

    $table_dokumen_jam_awal_ujian_proposalBAPI = $time->waktuInput($_POST['table_dokumen_jam_awal_ujian_proposal']);
    $table_dokumen_jam_akhir_ujian_proposalBAPI = $time->waktuInput($_POST['table_dokumen_jam_akhir_ujian_proposal']);

    if($disabledMhs == 'disabled'){
      if($cekBAP != null){
        $sqlBAUP = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_proposal = '$_POST[table_dokumen_tgl_ujian_proposal]', table_dokumen_tempat_ujian_proposal = '$_POST[table_dokumen_tempat_ujian_proposal]', table_dokumen_jam_awal_ujian_proposal = '$table_dokumen_jam_awal_ujian_proposalBAPI', table_dokumen_jam_akhir_ujian_proposal = '$table_dokumen_jam_akhir_ujian_proposalBAPI' WHERE id_table_akun = '$id_table_akun'";
        $query->update($sqlBAUP);
      }else{
        $sqlBASP = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_proposal, table_dokumen_tempat_ujian_proposal, table_dokumen_jam_awal_ujian_proposal, table_dokumen_jam_akhir_ujian_proposal, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_proposal]', '$_POST[table_dokumen_tempat_ujian_proposal]', '$table_dokumen_jam_awal_ujian_proposalBAPI', '$table_dokumen_jam_akhir_ujian_proposalBAPI', '$id_table_akun')";
        $query->insert($sqlBASP);
      }

      if($cekBAP1 != null){
        $sqlBAUP1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Proposal'";
        $query->update($sqlBAUP1);
      }else{
        $sqlBASP1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Proposal', '$_POST[id_table_dosen1]', '$id_table_akun')";
        $query->insert($sqlBASP1);
      }

      if($cekBAP2 != null){
        $sqlBAUP2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Proposal'";
        $query->update($sqlBAUP2);
      }else{
        $sqlBASP2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Proposal', '$_POST[id_table_dosen2]', '$id_table_akun')";
        $query->insert($sqlBASP2);
      }

      // $sqlBAUP3 = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataBAP[id_table_data_akun]'";
      // $query->update($sqlBAUP3);
    }else if($disabledAdm == 'disabled'){
      // if($cekBAP != null){
      //   $sqlBAUP = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_proposal = '$_POST[table_dokumen_tgl_ujian_proposal]', table_dokumen_tempat_ujian_proposal = '$_POST[table_dokumen_tempat_ujian_proposal]', table_dokumen_jam_awal_ujian_proposal = '$table_dokumen_jam_awal_ujian_proposalBAPI', table_dokumen_jam_akhir_ujian_proposal = '$table_dokumen_jam_akhir_ujian_proposalBAPI' WHERE id_table_akun = '$id_table_akun'";
      //   $query->update($sqlBAUP);
      // }else{
      //   $sqlBASP = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_proposal, table_dokumen_tempat_ujian_proposal, table_dokumen_jam_awal_ujian_proposal, table_dokumen_jam_akhir_ujian_proposal, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_proposal]', '$_POST[table_dokumen_tempat_ujian_proposal]', '$table_dokumen_jam_awal_ujian_proposalBAPI', '$table_dokumen_jam_akhir_ujian_proposalBAPI', '$id_table_akun')";
      //   $query->insert($sqlBASP);
      // }
      //
      // if($cekBAP1 != null){
      //   $sqlBAUP1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen1]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Ketua Sidang Proposal'";
      //   $query->update($sqlBAUP1);
      // }else{
      //   $sqlBASP1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Ketua Sidang Proposal', '$_POST[id_table_dosen1]', '$id_table_akun')";
      //   $query->insert($sqlBASP1);
      // }
      //
      // if($cekBAP2 != null){
      //   $sqlBAUP2 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen2]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Sekretaris Sidang Proposal'";
      //   $query->update($sqlBAUP2);
      // }else{
      //   $sqlBASP2 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Sekretaris Sidang Proposal', '$_POST[id_table_dosen2]', '$id_table_akun')";
      //   $query->insert($sqlBASP2);
      // }

      $sqlBAUP3 = "UPDATE table_data_akun SET table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataBAP[id_table_data_akun]'";
      $query->update($sqlBAUP3);
    }

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&menu=halaman_proposal&pilihan=halamanProposal&dokumen=BeritaAcaraP&id_table_akun=$id_table_akun&nama=$_POST[table_data_akun_nama]';</script>";
  }

?>
