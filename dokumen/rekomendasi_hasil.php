<?php
	include ('../class/Class.php');

	$id_table_akun = $_GET['id_table_akun'];

	$tanggal = 'Belum Diisi';
	$table_data_akun_nama = 'Belum Diisi';
	$table_data_akun_nim = 'Belum Diisi';
	$table_data_akun_judul_skripsi = 'Belum Diisi';
	$table_dokumen_nilai_ujian_hasil = 'Belum Diisi';
	$table_dosen_nama_ketua = 'Belum Diisi';
	$table_dosen_nip_ketua = 'Belum Diisi';
	$table_dosen_nama_sekretaris = 'Belum Diisi';
	$table_dosen_nip_sekretaris = 'Belum Diisi';

	$getData = $query->select("SELECT * FROM table_akun a, table_data_akun da, table_dokumen d WHERE a.id_table_data_akun = da.id_table_data_akun AND a.id_table_akun = d.id_table_akun AND a.id_table_akun = '$id_table_akun'");
	$cek = mysqli_num_rows($getData);
	if ($cek > 0){
		$data = mysqli_fetch_array($getData);

		if($data['table_data_akun_nama'] != '' || $data['table_data_akun_nama'] != null){
			$table_data_akun_nama = $data['table_data_akun_nama'];
		}

		if($data['table_data_akun_nim'] != '' || $data['table_data_akun_nim'] != null){
			$table_data_akun_nim = $data['table_data_akun_nim'];
		}

		if($data['table_dokumen_nilai_ujian_hasil'] != '' || $data['table_dokumen_nilai_ujian_hasil'] != null){
			$table_dokumen_nilai_ujian_hasil = $data['table_dokumen_nilai_ujian_hasil'];
		}

		if($data['table_data_akun_judul_skripsi'] != '' || $data['table_data_akun_judul_skripsi'] != null){
			$table_data_akun_judul_skripsi = $data['table_data_akun_judul_skripsi'];
		}

		if($data['table_dokumen_tgl_ujian_hasil'] != '' || $data['table_dokumen_tgl_ujian_hasil'] != NULL){
			if($data['table_dokumen_tgl_ujian_hasil'] != '0000-00-00'){
				$tanggal = $date->tanggal($data['table_dokumen_tgl_ujian_hasil']);
			}
		}

	}

	$getData1 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Ketua Sidang Hasil' AND id_table_akun = '$id_table_akun'");
	$cek1 = mysqli_num_rows($getData1);
	if ($cek1 > 0){
		$data1 = mysqli_fetch_array($getData1);
		$table_dosen_nama_ketua = $data1['table_dosen_nama'];
		$table_dosen_nip_ketua = $data1['table_dosen_nip'];
	}

	$getData2 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Sekretaris Sidang Hasil' AND id_table_akun = '$id_table_akun'");
	$cek2 = mysqli_num_rows($getData2);
	if ($cek2 > 0){
		$data2 = mysqli_fetch_array($getData2);
		$table_dosen_nama_sekretaris = $data2['table_dosen_nama'];
		$table_dosen_nip_sekretaris = $data2['table_dosen_nip'];
	}

	// memanggil dan membaca template dokumen yang telah kita buat
	$document = file_get_contents("rekomendasi_hasil.rtf");

	/* isi dokumen dinyatakan dalam bentuk string	 #TGL, #NAMA, #NIM, #JUDUL, #NILAI,
		 #KETUASIDANG, #NIPKETUASIDANG, #SEKRETARISSIDANG, #NIPSEKRETARISSIDANG */
	$document = str_replace("#TGL", $tanggal, $document);
	$document = str_replace("#NAMA", $table_data_akun_nama, $document);
	$document = str_replace("#NIM", $table_data_akun_nim, $document);
	$document = str_replace("#JUDUL", $table_data_akun_judul_skripsi, $document);
	$document = str_replace("#NILAI", $table_dokumen_nilai_ujian_hasil, $document);
	$document = str_replace("#KETUASIDANG", $table_dosen_nama_ketua, $document);
	$document = str_replace("#NIPKETUASIDANG", $table_dosen_nip_ketua, $document);
	$document = str_replace("#SEKRETARISSIDANG", $table_dosen_nama_sekretaris, $document);
	$document = str_replace("#NIPSEKRETARISSIDANG", $table_dosen_nip_sekretaris, $document);

	// header untuk membuka file output RTF dengan MS. Word
	header("Content-type: application/msword");
	header("Content-disposition: inline; filename=rekomendasi_hasil_$table_data_akun_nim.doc");
	header("Content-length: ".strlen($document));
	echo $document;

 ?>
