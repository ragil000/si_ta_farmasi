<form class="form form-register" method="POST">
  <h1>Daftar</h1>
  <input type="text" name="table_data_akun_nama" placeholder="Nama Lengkap">
  <input type="text" name="table_data_akun_nim" placeholder="NIM">
  <select class="" name="table_data_akun_jenis_kelamin">
    <option value="">Jenis Kelamin</option>
    <option value="L">Laki-laki</option>
    <option value="P">Perempuan</option>
  <select>
  <select class="text-center" name="table_data_akun_agama">
    <option class="text-center" value="">Agama</option>
    <option value="Islam">Islam</option>
    <option value="Kristen">Kristen</option>
    <option value="Hindu">Hindu</option>
    <option value="Budha">Budha</option>
    <option value="Kong Hu Cu">Kong Hu Cu</option>
  <select>
  <input type="text" name="table_akun_username" placeholder="Username">
  <input type="text" name="table_akun_password" placeholder="Password">
  <button type="submit" name="register">Daftar</button>
  <p class="message">Sudah Punya Akun? <a href="index.php?halaman=login">Masuk</a></p>
</form>
