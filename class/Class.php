<?php
	/* #RMY-Developer */

	session_start();

	class database{
		public $host       = "localhost";
	    public $username   = "root";
	    public $password   = "";
	    public $database   = "db_farmasi";

		function koneksi()		{
			$koneksi = new mysqli($this->host, $this->username, $this->password, $this->database);

			return $koneksi;
		}
	}

	class admin	{
		function login($username, $password){

			//memanggil class database
			$this->database = new database();

			//memanggil class date
			$this->date = new date();

			//mengencripsi password dengan md5
			$password = md5($password);

			//query untuk menampilkan data
			$sql = "SELECT * FROM table_akun a, table_data_akun da WHERE table_akun_username='$username' AND table_akun_password_md5='$password' AND a.id_table_data_akun = da.id_table_data_akun AND a.table_akun_ket = 'aktif'";

			//mengambil data dari database
			$getData = $this->database->koneksi()->query($sql);

			//menghitung data yg ada di table database
			$hitung = mysqli_num_rows($getData);

			//mengeluarkan data
			$pecah = mysqli_fetch_array($getData);

			if($hitung>0){

				if($pecah['table_akun_level'] == 0){
					$level = 'Administrator';
				}else if($pecah['table_akun_level'] == 1){
					$level = 'Mahasiswa';
				}

				$_SESSION['id_table_akun'] = $pecah['id_table_akun'];
				$_SESSION['table_data_akun_nama'] = $pecah['table_data_akun_nama'];
				$_SESSION['table_data_akun_nim'] = $pecah['table_data_akun_nim'];
				$_SESSION['table_akun_level'] = $level;
				$_SESSION['table_akun_tahap'] = $pecah['table_akun_tahap'];	

				return true;
			}else{
				return false;
			}
		}

		function register($sql, $username, $password, $table_akun_ket, $table_akun_level){
			//memanggil class database
			$this->database = new database();

			//mengencripsi password dengan md5
			$passwordMD5 = md5($password);

			$this->database->koneksi()->query($sql);
			$getData = $this->database->koneksi()->query('SELECT * FROM table_data_akun ORDER BY id_table_data_akun DESC LIMIT 1');

			$data = mysqli_fetch_array($getData);
			$id_table_data_akun = $data['id_table_data_akun'];

			$sql2 = "INSERT INTO table_akun (table_akun_username, table_akun_password_md5, table_akun_password, table_akun_ket, table_akun_level, id_table_data_akun) VALUES ('$username', '$passwordMD5', '$password', '$table_akun_ket', '$table_akun_level', '$id_table_data_akun')";
			$inputData = $this->database->koneksi()->query($sql2);

			if($inputData){
				return true;
			}else{
				return false;
			}
		}

		function logout()		{
			session_destroy();
		}
	}


	class query	{

		function select($sql)		{
			//memanggil class database
			$this->database = new database();

			//mengambil data dari database
			$getData = $this->database->koneksi()->query($sql);

			return $getData;
		}

		function insert($sql)		{
			//memanggil class database
			$this->database = new database();

			//mendefinisikan query ke database
			$this->database->koneksi()->query($sql);
		}

		function upload_image($location, $destination, $name)		{

			move_uploaded_file($location, $destination."/".$name);
		}

		function delete($sql)		{
			//memanggil class database
			$this->database = new database();

			//mendefinisikan query ke database
			$this->database->koneksi()->query($sql);
		}

		function delete_image($target){
			if(file_exists($target)){
				unlink($target);
			}
		}

		function update($sql){
			//memanggil class database
			$this->database = new database();

			$this->database->koneksi()->query($sql);
		}

	}

	class date{

		function tanggal($tgl){
			$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tgl);

			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun

			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}

		function hari($tgl){
			$day = date('l', strtotime($tgl));
			$hari = "";
			if($day == 'Sunday'){
				$hari = "Minggu";
			}else if($day == 'Monday'){
				$hari = "Senin";
			}else if($day == 'Tuesday'){
				$hari = "Selasa";
			}else if($day == 'Wednesday'){
				$hari = "Rabu";
			}else if($day == 'Thursday'){
				$hari = "Kamis";
			}else if($day == 'Friday'){
				$hari = "Jum'at";
			}else if($day == 'Saturday'){
				$hari = "Sabtu";
			}

			return $hari;
		}

		function tanggalRealtime(){
			$tgl = date('Y-m-d');
			$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tgl);

			// variabel pecahkan 0 = tanggal
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tahun

			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}

		function hariRealtime(){
			$tgl = date('Y-m-d');
			$day = date('l', strtotime($tgl));
			$hari = "";
			if($day == 'Sunday'){
				$hari = "Minggu";
			}else if($day == 'Monday'){
				$hari = "Senin";
			}else if($day == 'Tuesday'){
				$hari = "Selasa";
			}else if($day == 'Wednesday'){
				$hari = "Rabu";
			}else if($day == 'Thursday'){
				$hari = "Kamis";
			}else if($day == 'Friday'){
				$hari = "Jum'at";
			}else if($day == 'Saturday'){
				$hari = "Sabtu";
			}

			return $hari;
		}

	}

	class time{

		function waktuView($jam){
			$waktu = explode(':', $jam);

			return $waktu[0].":".$waktu[1];
		}

		function waktuInput($jam){
			$waktu = explode(' ', $jam);

			return $waktu[0].":00";
		}

	}


	$database = new database();
	$database->koneksi();
	$admin = new admin();
	$query = new query();
	$date = new date();
	$time = new time();

?>
