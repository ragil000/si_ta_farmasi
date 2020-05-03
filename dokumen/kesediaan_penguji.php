<?php
	include ('../class/Class.php');

	$id_table_akun = $_GET['id_table_akun'];

	$table_data_akun_nama = 'Belum Diisi';
	$table_data_akun_nim = 'Belum Diisi';
	$table_data_akun_judul_skripsi = 'Belum Diisi';
	$table_dosen_nama_p1 = 'Belum Diisi';
	$table_dosen_nama_p2 = 'Belum Diisi';
	$table_dokumen_tempat_ujian_hasil = 'Belum Diisi';
	$table_dosen_nama_ketua = 'Belum Diisi';
	$table_dosen_nip_ketua = 'Belum Diisi';
	$table_dosen_nama_sekretaris = 'Belum Diisi';
	$table_dosen_nip_sekretaris = 'Belum Diisi';
	$table_dosen_nama_a1 = 'Belum Diisi';
	$table_dosen_nip_a1 = 'Belum Diisi';
	$table_dosen_nama_a2 = 'Belum Diisi';
	$table_dosen_nip_a2 = 'Belum Diisi';
	$table_dosen_nama_a3 = 'Belum Diisi';
	$table_dosen_nip_a3 = 'Belum Diisi';
	$table_dosen_nama_kajur = 'Belum Diisi';
	$table_dosen_nip_kajur = 'Belum Diisi';
	$hari = 'Belum Diisi';
	$tanggal = 'Belum Diisi';
	$jamMulai = 'Belum Diisi';
	$jamAkhir = 'Belum Diisi';

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

		if($data['table_data_akun_judul_skripsi'] != '' || $data['table_data_akun_judul_skripsi'] != null){
			$table_data_akun_judul_skripsi = $data['table_data_akun_judul_skripsi'];
		}

		if($data['table_dokumen_tempat_ujian_hasil'] != '' || $data['table_dokumen_tempat_ujian_hasil'] != null){
			$table_dokumen_tempat_ujian_hasil = $data['table_dokumen_tempat_ujian_hasil'];
		}

		if($data['table_dokumen_tgl_ujian_hasil'] != '' || $data['table_dokumen_tgl_ujian_hasil'] != null){
			if($data['table_dokumen_tgl_ujian_hasil'] != '0000-00-00'){
				$hari = $date->hari($data['table_dokumen_tgl_ujian_hasil']);
				$tanggal = $date->tanggal($data['table_dokumen_tgl_ujian_hasil']);
			}
		}

		if($data['table_dokumen_jam_awal_ujian_hasil'] != '' || $data['table_dokumen_jam_awal_ujian_hasil'] != null){
			$jamMulai = $time->waktuView($data['table_dokumen_jam_awal_ujian_hasil']);
		}

		if($data['table_dokumen_jam_akhir_ujian_hasil'] != '' || $data['table_dokumen_jam_akhir_ujian_hasil'] != null){
			$jamAkhir = $time->waktuView($data['table_dokumen_jam_akhir_ujian_hasil']);
		}

	}

	$getData1 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Pembimbing 1' AND id_table_akun = '$id_table_akun'");
	$cek1 = mysqli_num_rows($getData1);
	if ($cek1 > 0){
		$data1 = mysqli_fetch_array($getData1);
		$table_dosen_nama_p1 = $data1['table_dosen_nama'];
		$table_dosen_nama_a2 = $data1['table_dosen_nama'];
		$table_dosen_nip_a2 = $data1['table_dosen_nip'];
	}

	$getData2 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Pembimbing 2' AND id_table_akun = '$id_table_akun'");
	$cek2 = mysqli_num_rows($getData2);
	if ($cek2 > 0){
		$data1 = mysqli_fetch_array($getData2);
		$table_dosen_nama_p2 = $data2['table_dosen_nama'];
		$table_dosen_nama_a3 = $data2['table_dosen_nama'];
		$table_dosen_nip_a3 = $data2['table_dosen_nip'];
	}

	$getData3 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Ketua Sidang' AND id_table_akun = '$id_table_akun'");
	$cek3 = mysqli_num_rows($getData3);
	if ($cek3 > 0){
		$data3 = mysqli_fetch_array($getData3);
		$table_dosen_nama_ketua = $data3['table_dosen_nama'];
		$table_dosen_nip_ketua = $data3['table_dosen_nip'];
	}

	$getData4 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Sekretaris Sidang' AND id_table_akun = '$id_table_akun'");
	$cek4 = mysqli_num_rows($getData4);
	if ($cek4 > 0){
		$data4 = mysqli_fetch_array($getData4);
		$table_dosen_nama_sekretaris = $data4['table_dosen_nama'];
		$table_dosen_nip_sekretaris = $data4['table_dosen_nip'];
	}

	$getData5 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Anggota 1' AND id_table_akun = '$id_table_akun'");
	$cek5 = mysqli_num_rows($getData5);
	if ($cek5 > 0){
		$data1 = mysqli_fetch_array($getData5);
		$table_dosen_nama_a1 = $data5['table_dosen_nama'];
		$table_dosen_nip_a1 = $data5['table_dosen_nip'];
	}

	$getData6 = $query->select("SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'");
	$cek6 = mysqli_num_rows($getData6);
	if ($cek6 > 0){
		$data6 = mysqli_fetch_array($getData6);
		$table_dosen_nama_kajur = $data6['table_dosen_nama'];
		$table_dosen_nip_kajur = $data6['table_dosen_nip'];
	}

	$tanggalNow = $date->tanggalRealtime();

	// memanggil dan membaca template dokumen yang telah kita buat
	$document = file_get_contents("kesediaan_penguji.rtf");

	/* isi dokumen dinyatakan dalam bentuk string	#NAMA, #NIM, #JUDUL, #PEMBIMBING1, #PEMBIMBING2,
		 #HARI, #TGLS, #JAMMULAI, #JAMAKHIR, #TEMPAT, #KETUAUJIANHASIL
		 #NIPKETUA, #SEKRETARISUJIANHASIL, #NIPSEKRETARIS, #ANGGOTA1UJIANHASIL, #NIPANGGOTA1
		 #ANGGOTA2UJIANHASIL, #NIPANGGOTA2, #ANGGOTA3UJIANHASIL, #NIPANGGOTA3, #KETUAJURUSAN,
		 #NIPKJ, #TGL */

	$document = str_replace("#NAMA", $table_data_akun_nama, $document);
	$document = str_replace("#NIM", $table_data_akun_nim, $document);
	$document = str_replace("#JUDUL", $table_data_akun_judul_skripsi, $document);
	$document = str_replace("#PEMBIMBING1", $table_dosen_nama_p1, $document);
	$document = str_replace("#PEMBIMBING2", $table_dosen_nama_p2, $document);
	$document = str_replace("#HARI", $hari, $document);
	$document = str_replace("#TGLS", $tanggal, $document);
	$document = str_replace("#JAMMULAI", $jamMulai, $document);
	$document = str_replace("#JAMAKHIR", $jamAkhir, $document);
	$document = str_replace("#TEMPAT", $table_dokumen_tempat_ujian_hasil, $document);
	$document = str_replace("#KETUAUJIANHASIL", $table_dosen_nama_ketua, $document);
	$document = str_replace("#NIPKETUA", $table_dosen_nip_ketua, $document);
	$document = str_replace("#SEKRETARISUJIANHASIL", $table_dosen_nama_sekretaris, $document);
	$document = str_replace("#NIPSEKRETARIS", $table_dosen_nip_sekretaris, $document);
	$document = str_replace("#ANGGOTA1UJIANHASIL", $table_dosen_nama_a1, $document);
	$document = str_replace("#NIPANGGOTA1", $table_dosen_nip_a1, $document);
	$document = str_replace("#ANGGOTA2UJIANHASIL", $table_dosen_nama_a2, $document);
	$document = str_replace("#NIPANGGOTA2", $table_dosen_nip_a2, $document);
	$document = str_replace("#ANGGOTA3UJIANHASIL", $table_dosen_nama_a3, $document);
	$document = str_replace("#NIPANGGOTA3", $table_dosen_nip_a3, $document);
	$document = str_replace("#KETUAJURUSAN", $table_dosen_nama_kajur, $document);
	$document = str_replace("#NIPKJ", $table_dosen_nip_kajur, $document);
	$document = str_replace("#TGL", $tanggalNow, $document);



	// header untuk membuka file output RTF dengan MS. Word
	header("Content-type: application/msword");
	header("Content-disposition: inline; filename=kesediaan_penguji_$table_data_akun_nim.doc");
	header("Content-length: ".strlen($document));
	echo $document;

 ?>
