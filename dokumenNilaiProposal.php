<?php

  $getDataNP = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekNP = mysqli_num_rows($getDataNP);
  if($cekNP > 0){
    $dataNP = mysqli_fetch_array($getDataNP);
  }else{
    $dataNP = null;
  }

  $getDataNP1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Dosen Penguji'");
  $cekNP1 = mysqli_num_rows($getDataNP1);
  if($cekNP1 > 0){
    $dataNP1 = mysqli_fetch_array($getDataNP1);
  }else{
    $dataNP1 = null;
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/nilai_proposal.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
  </div>
</div>
<form role="form" method="POST">
  <div class="box-body">
    <!-- Date -->
    <div class="form-group col-md-12">
      <label>Tanggal Ujian Proposal</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" value="<?=$dataNP['table_dokumen_tgl_ujian_proposal']?>" name="table_dokumen_tgl_ujian_proposal" class="form-control pull-left" id="datepicker3" <?=$disabledAdm?>>
      </div>
      <!-- /.input group -->
    </div>
    <!-- /.form group -->
    <div class="form-group col-md-6">
      <div class="form-group">
        <label>Nama Mahasiswa</label>
        <input type="text" name="table_data_akun_nama" value="<?=$dataMhs['table_data_akun_nama']?>" class="form-control" placeholder="Nama Lengkap" <?=$disabledMhs?>>
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
    <!-- <div class="form-group col-md-12">
      <label>Nilai Proposal</label>
      <input type="text" class="form-control" placeholder="Nilai">
    </div> -->
    <div class="form-group col-md-12">
      <div class="form-group">
        <label>Dosen Penguji</label>
        <select class="form-control select2" name="id_table_dosen" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataNP1 != null){
          ?>
          <option selected="selected" value="<?=$dataNP1['id_table_dosen']?>"><?=$dataNP1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Dosen Penguji</option>
          <?php
            }
            $sqlNPDsn1 = "SELECT * FROM table_dosen";
            $getDataNPDsn1 = $query->select($sqlNPDsn1);
            while ($dataNPDsn1 = mysqli_fetch_array($getDataNPDsn1)){
              if($dataNPDsn1['id_table_dosen'] == $dataNP1['id_table_dosen']){
                $disabledNP1 = 'disabled';
              }else{
                $disabledNP1 = '';
              }
          ?>
          <option value="<?=$dataNPDsn1['id_table_dosen']?>" <?=$disabledNP1?>><?=$dataNPDsn1['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>

  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanNP" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanNP'])){

    if($cekNP != null){
      $sqlNPU = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_proposal = '$_POST[table_dokumen_tgl_ujian_proposal]' WHERE id_table_akun = '$id_table_akun'";
      $query->update($sqlNPU);
    }else{
      $sqlNPS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_proposal, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_proposal]', '$id_table_akun')";
      $query->insert($sqlNPS);
    }

    if($cekNP1 != null){
      $sqlNPU1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Dosen Penguji'";
      $query->update($sqlNPU1);
    }else{
      $sqlNPS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Dosen Penguji', '$_POST[id_table_dosen]', '$id_table_akun')";
      $query->insert($sqlNPS1);
    }

    $sqlNPU2 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataNP[id_table_data_akun]'";
    $query->update($sqlNPU2);

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&dokumen=NilaiProposal&id_table_akun=$id_table_akun';</script>";
  }

?>
