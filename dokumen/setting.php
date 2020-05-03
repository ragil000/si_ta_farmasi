<?php     
session_start();
@ob_start();
include '../../inc/config.php';
    
    if (isset($_SESSION['user_idxx'])) {
      $user_idzz = $_SESSION['user_idxx'];
      $user_pass = $_SESSION['user_password'];
      $x = mysqli_query($con, "SELECT * FROM user WHERE id_user='$user_idzz' AND pass='$user_pass'");
      $cek = mysqli_num_rows($x);

      if ($cek > 0){

      }
      else{
        session_destroy();
        header("location:../../login/index.php");
      }
    }
    else{
      session_destroy();
      header("location:../../login/index.php");
    }

    if ($_SESSION['user_level'] != 'Mahasiswa') {
      session_destroy();
      echo "<script> document.location='../../login/index.php'; </script>";
    }
//endHeader

 ?>