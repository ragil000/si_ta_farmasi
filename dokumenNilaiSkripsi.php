<?php

  $getDataNS = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
  $cekNS = mysqli_num_rows($getDataNS);
  if($cekNS > 0){
    $dataNS = mysqli_fetch_array($getDataNS);
  }else{
    $dataNS = null;
  }

  $getDataNS1 = $query->select("SELECT * FROM table_akun a, table_dosen ds, table_tugas_dosen td WHERE ds.id_table_dosen = td.id_table_dosen AND a.id_table_akun = td.id_table_akun AND a.id_table_akun = '$id_table_akun' AND td.table_tugas_dosen_tugas = 'Dosen Penguji Skripsi'");
  $cekNS1 = mysqli_num_rows($getDataNS1);
  if($cekNS1 > 0){
    $dataNS1 = mysqli_fetch_array($getDataNS1);
  }else{
    $dataNS1 = null;
  }

?>
<!-- form start -->
<div class="box-body">
  <div class="form-group col-md-12">
    <a href="dokumen/nilai_skripsi.php?id_table_akun=<?=$id_table_akun?>" class="btn btn-primary pull-right">Unduh Dokumen</a>
  </div>
</div>
<form role="form" method="POST">
  <div class="box-body">
    <!-- Date -->
    <div class="form-group col-md-12">
      <label>Tanggal Ujian Skripsi</label>
      <div class="input-group date">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" value="<?=$dataNS['table_dokumen_tgl_ujian_skripsi']?>" name="table_dokumen_tgl_ujian_skripsi" class="form-control pull-left" id="datepickerS3" <?=$disabledAdm?>>
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
      <label>Nilai skripsi</label>
      <input type="text" class="form-control" placeholder="Nilai">
    </div> -->
    <div class="form-group col-md-12">
      <div class="form-group">
        <label>Dosen Penguji</label>
        <select class="form-control select2" name="id_table_dosen" style="width: 100%;" <?=$disabledAdm?>>
          <?php
            if($dataNS1 != null){
          ?>
          <option selected="selected" value="<?=$dataNS1['id_table_dosen']?>"><?=$dataNS1['table_dosen_nama']?></option>
          <?php
            }else{
          ?>
          <option selected="selected">Pilih Dosen Penguji</option>
          <?php
            }
            $sqlNSDsn1 = "SELECT * FROM table_dosen";
            $getDataNSDsn1 = $query->select($sqlNSDsn1);
            while ($dataNSDsn1 = mysqli_fetch_array($getDataNSDsn1)){
              if($dataNSDsn1['id_table_dosen'] == $dataNS1['id_table_dosen']){
                $disabledNS1 = 'disabled';
              }else{
                $disabledNS1 = '';
              }
          ?>
          <option value="<?=$dataNSDsn1['id_table_dosen']?>" <?=$disabledNS1?>><?=$dataNSDsn1['table_dosen_nama']?></option>
          <?php
            }
          ?>
        </select>
      </div>
    </div>

  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" name="simpanNS" class="btn btn-primary">Simpan</button>
  </div>
</form>

<?php

  if(isset($_POST['simpanNS'])){

    if($disabledMhs == 'disabled'){
      if($cekNS != null){
        $sqlNSU = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_skripsi = '$_POST[table_dokumen_tgl_ujian_skripsi]' WHERE id_table_akun = '$id_table_akun'";
        $query->update($sqlNSU);
      }else{
        $sqlNSS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_skripsi, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_skripsi]', '$id_table_akun')";
        $query->insert($sqlNSS);
      }

      if($cekNS1 != null){
        $sqlNSU1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Dosen Penguji Skripsi'";
        $query->update($sqlNSU1);
      }else{
        $sqlNSS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Dosen Penguji Skripsi', '$_POST[id_table_dosen]', '$id_table_akun')";
        $query->insert($sqlNSS1);
      }

      // $sqlNSU2 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataNS[id_table_data_akun]'";
      // $query->update($sqlNSU2);
    }else if($disabledAdm == 'disabled'){
      // if($cekNS != null){
      //   $sqlNSU = "UPDATE table_dokumen SET table_dokumen_tgl_ujian_skripsi = '$_POST[table_dokumen_tgl_ujian_skripsi]' WHERE id_table_akun = '$id_table_akun'";
      //   $query->update($sqlNSU);
      // }else{
      //   $sqlNSS = "INSERT INTO table_dokumen (table_dokumen_tgl_ujian_skripsi, id_table_akun) VALUES ('$_POST[table_dokumen_tgl_ujian_skripsi]', '$id_table_akun')";
      //   $query->insert($sqlNSS);
      // }
      //
      // if($cekNS1 != null){
      //   $sqlNSU1 = "UPDATE table_tugas_dosen SET id_table_dosen = '$_POST[id_table_dosen]' WHERE id_table_akun = '$id_table_akun' AND table_tugas_dosen_tugas = 'Dosen Penguji Skripsi'";
      //   $query->update($sqlNSU1);
      // }else{
      //   $sqlNSS1 = "INSERT INTO table_tugas_dosen (table_tugas_dosen_tugas, id_table_dosen, id_table_akun) VALUES ('Dosen Penguji Skripsi', '$_POST[id_table_dosen]', '$id_table_akun')";
      //   $query->insert($sqlNSS1);
      // }

      $sqlNSU2 = "UPDATE table_data_akun SET table_data_akun_judul_skripsi = '$_POST[table_data_akun_judul_skripsi]', table_data_akun_nama = '$_POST[table_data_akun_nama]', table_data_akun_nim = '$_POST[table_data_akun_nim]' WHERE id_table_data_akun = '$dataNS[id_table_data_akun]'";
      $query->update($sqlNSU2);
    }

    echo "<script>window.location = 'index.php?halaman=view_akun_mahasiswa&menu=halaman_skripsi&pilihan=halamanSkripsi&dokumen=NilaiSkripsi&id_table_akun=$id_table_akun';</script>";
  }

?>
