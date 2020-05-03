<?php
  $dataDosen = 'active';
  $tambahDosen = '';
  $ketAksi = '';
  if(isset($_GET['ketAksi'])){
    if($_GET['ketAksi'] == 'editDosen'){
      $dataDosen = '';
      $tambahDosen = 'active';
      $ketAksi = 'editDosen';
    }
  }
?>

<!-- Main row -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="<?=$dataDosen?>"><a href="#dataDosen" data-toggle="tab">Data Dosen</a></li>
        <li class="<?=$tambahDosen?>"><a href="#tambahDosen" data-toggle="tab">Tambah Dosen</a></li>
        <li><a href="#pilihKaJur" data-toggle="tab">Pilih Ketua Jurusan</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane <?=$dataDosen?>" id="dataDosen">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Semua Dosen</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dataAktif" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>Level Dosen</th>
                  <th>Pilihan</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  $sqlQ = "SELECT * FROM `table_dosen` ORDER BY `table_dosen_level` = 'Ketua Jurusan' DESC";
                  $getDataQ = $query->select($sqlQ);
                  while ($dataQ = mysqli_fetch_array($getDataQ)) {
                ?>
                <tr>
                  <td><?=$dataQ['table_dosen_nama']?></td>
                  <td><?=$dataQ['table_dosen_nip']?></td>
                  <td><?=$dataQ['table_dosen_level']?></td>
                  <td class="text-center">
                    <a href="index.php?halaman=data_dosen&ketAksi=editDosen&id_table_dosen=<?=$dataQ['id_table_dosen']?>" class="btn btn-sm btn-primary view-link"><i class="fa fa-edit"></i></a>
                    <a href="index.php?aksi=hapusDosen&id_table_dosen=<?=$dataQ['id_table_dosen']?>" class="btn btn-sm btn-danger delete-link"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php
                  }
                ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>Level Dosen</th>
                  <th>Pilihan</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane <?=$tambahDosen?>" id="tambahDosen">
            <div class="box-header">
              <h3 class="box-title">Tambah Dosen</h3>
            </div>

            <?php
              $dataDosenK['table_dosen_nama'] = '';
              $dataDosenK['table_dosen_nip'] = '';
              if($ketAksi == 'editDosen'){
                if(isset($_GET['id_table_dosen'])){
                  $getDataDosen = $query->select("SELECT * FROM table_dosen WHERE id_table_dosen = '$_GET[id_table_dosen]'");
                  $dataDosenK = mysqli_fetch_array($getDataDosen);
                }
              }
            ?>

            <form role="form" method="POST">
                <div class="box-body">
                  <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input type="text" value="<?=$dataDosenK['table_dosen_nama']?>" name="table_dosen_nama" class="form-control" placeholder="Nama dan Title">
                  </div>
                  <div class="form-group col-md-6">
                    <label>NIP</label>
                    <input type="text" value="<?=$dataDosenK['table_dosen_nip']?>" name="table_dosen_nip" class="form-control" placeholder="NIM">
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <?php
                    if($ketAksi == 'editDosen'){
                  ?>
                  <a class="btn btn-default" href="index.php?halaman=data_dosen">Batal</a>
                  <button type="submit" name="updateDosen" class="btn btn-primary">Ubah</button>
                  <?php
                    }else{
                  ?>
                  <button type="submit" name="tambahDosen" class="btn btn-primary">Simpan</button>
                  <?php
                    }
                  ?>
                </div>
              </form>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="pilihKaJur">
              <form role="form" method="POST">
                  <div class="box-body">
                    <div class="form-group col-md-12">
                      <div class="form-group">
                        <label>Pilih Ketua Jurusan</label>
                        <select name="id_table_dosen" class="form-control select2" style="width: 100%;">
                          <?php
                            $sqlD = "SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'";
                            $getDataD = $query->select($sqlD);
                            $dataD = mysqli_fetch_array($getDataD);
                            if($dataD != null){
                          ?>
                          <option selected="selected" value="<?=$dataD['id_table_dosen']?>"><?=$dataD['table_dosen_nama']?></option>
                          <?php
                            }else{
                          ?>
                          <option selected="selected">Pilih Ketua Jurusan</option>
                          <?php
                            }
                            $sqlD1 = "SELECT * FROM table_dosen";
                            $getDataD1 = $query->select($sqlD1);
                            while ($dataD1 = mysqli_fetch_array($getDataD1)){
                              if($dataD1['id_table_dosen'] == $dataD['id_table_dosen']){
                                $disabledD = 'disabled';
                              }else{
                                $disabledD = '';
                              }
                          ?>
                          <option value="<?=$dataD1['id_table_dosen']?>" <?=$disabledD?>><?=$dataD1['table_dosen_nama']?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" name="updateKaJur" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
            </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row (main row) -->

<?php
  if(isset($_POST['tambahDosen'])){
    $sqlDsn = "INSERT INTO table_dosen (table_dosen_nama, table_dosen_nip, table_dosen_level) VALUES ('$_POST[table_dosen_nama]', '$_POST[table_dosen_nip]', 'Dosen Biasa')";
    $query->insert($sqlDsn);
    echo "<script>window.location='index.php?halaman=data_dosen';</script>";
  }

  if(isset($_POST['updateDosen'])){
    $sqlDsn = "UPDATE table_dosen SET table_dosen_nama = '$_POST[table_dosen_nama]', table_dosen_nip = '$_POST[table_dosen_nip]' WHERE id_table_dosen = '$_GET[id_table_dosen]'";
    $query->update($sqlDsn);
    echo "<script>window.location='index.php?halaman=data_dosen';</script>";
  }

  if(isset($_POST['updateKaJur'])){
    $sqlDsn = "UPDATE table_dosen SET table_dosen_level = 'Ketua Jurusan' WHERE id_table_dosen = '$_POST[id_table_dosen]'";
    $query->update($sqlDsn);
    $sqlDsn1 = "UPDATE table_dosen SET table_dosen_level = 'Dosen Biasa' WHERE id_table_dosen != '$_POST[id_table_dosen]'";
    $query->update($sqlDsn1);
    echo "<script>window.location='index.php?halaman=data_dosen';</script>";

    //echo "<script>alert('$_POST[id_table_dosen]');</script>";
  }
?>
