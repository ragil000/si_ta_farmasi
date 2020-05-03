<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Form Masuk</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php
    include ('../class/Class.php');
  ?>

  <div class="wrapper">
	<div class="container isian">
    <?php
      if(isset($_GET['halaman'])){
        if($_GET['halaman']=='register'){
          include ('register.php');
        }else if($_GET['halaman']=='login'){
          include ('login.php');
        }
      }else{
        include ('login.php');
      }
    ?>
	</div>

	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>

  <?php
    $tgl = date('Y-m-d');
    if(isset($_POST['login'])){
      $admin->login($_POST['table_akun_username'], $_POST['table_akun_password']);
      echo "<script>window.location='../index.php';</script>";
    }else if(isset($_POST['register'])){
      //$table_data_akun_nama = $_POST[table_data_akun_nama];
      //echo "<script>alert('$table_data_akun_nama');</script>";
      $sql = "INSERT INTO table_data_akun (table_data_akun_nama, table_data_akun_nim, table_data_akun_jenis_kelamin, table_data_akun_agama, table_data_akun_foto, table_data_akun_tgl_daftar) VALUES ('$_POST[table_data_akun_nama]', '$_POST[table_data_akun_nim]', '$_POST[table_data_akun_jenis_kelamin]', '$_POST[table_data_akun_agama]', 'default_avatar.png', '$tgl')";
      $cekInput = $admin->register($sql, $_POST['table_akun_username'], $_POST['table_akun_password'], 'nonaktif', '1');

      if($cekInput){
        echo "<script>alert('Berhasil');</script>";
        echo "<script>window.location='index.php?halaman=login';</script>";
      }else{
        echo "<script>alert('Gagal');</script>";
        echo "<script>window.location='index.php?halaman=register';</script>";
      }
    }

  ?>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="js/index.js"></script>
</body>

</html>
