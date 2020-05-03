<?php
	include ('../class/Class.php');

	$id_table_akun = $_GET['id_table_akun'];

	$table_data_akun_nama = 'Belum Diisi';
	$table_data_akun_nim = 'Belum Diisi';
	$table_dokumen_tempat_ujian_proposal = 'Belum Diisi';
	$table_dokumen_nilai_ujian_proposal = 'Belum Diisi';
	$table_dosen_nama_ketua = 'Belum Diisi';
	$table_dosen_nip_ketua = 'Belum Diisi';
	$table_dosen_nama_sekretaris = 'Belum Diisi';
	$table_dosen_nip_sekretaris = 'Belum Diisi';
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

		if($data['table_dokumen_tempat_ujian_proposal'] != '' || $data['table_dokumen_tempat_ujian_proposal'] != null){
			$table_dokumen_tempat_ujian_proposal = $data['table_dokumen_tempat_ujian_proposal'];
		}

		if($data['table_dokumen_nilai_ujian_proposal'] != '' || $data['table_dokumen_nilai_ujian_proposal'] != null){
			$table_dokumen_nilai_ujian_proposal = $data['table_dokumen_nilai_ujian_proposal'];
		}

		if($data['table_dokumen_tgl_ujian_proposal'] != '' || $data['table_dokumen_tgl_ujian_proposal'] != NULL){
			if($data['table_dokumen_tgl_ujian_proposal'] != '0000-00-00'){
				$hari = $date->hari($data['table_dokumen_tgl_ujian_proposal']);
				$tanggal = $date->tanggal($data['table_dokumen_tgl_ujian_proposal']);
			}
		}

		if($data['table_dokumen_jam_awal_ujian_proposal'] != '' || $data['table_dokumen_jam_awal_ujian_proposal'] != NULL){
			$jamMulai = $time->waktuView($data['table_dokumen_jam_awal_ujian_proposal']);
		}

		if($data['table_dokumen_jam_akhir_ujian_proposal'] != '' || $data['table_dokumen_jam_akhir_ujian_proposal'] != NULL){
			$jamAkhir = $time->waktuView($data['table_dokumen_jam_akhir_ujian_proposal']);
		}

	}

	$getData1 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Ketua Sidang Proposal' AND id_table_akun = '$id_table_akun'");
	$cek1 = mysqli_num_rows($getData1);
	if ($cek1 > 0){
		$data1 = mysqli_fetch_array($getData1);
		$table_dosen_nama_ketua = $data1['table_dosen_nama'];
		$table_dosen_nip_ketua = $data1['table_dosen_nip'];
	}

	$getData2 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Sekretaris Sidang Proposal' AND id_table_akun = '$id_table_akun'");
	$cek2 = mysqli_num_rows($getData2);
	if ($cek2 > 0){
		$data2 = mysqli_fetch_array($getData2);
		$table_dosen_nama_sekretaris = $data2['table_dosen_nama'];
		$table_dosen_nip_sekretaris = $data2['table_dosen_nip'];
	}

	$getData3 = $query->select("SELECT * FROM table_dosen WHERE table_dosen_level = 'Ketua Jurusan'");
	$cek3 = mysqli_num_rows($getData3);
	if ($cek3 > 0){
		$data3 = mysqli_fetch_array($getData3);
		$table_dosen_nama_kajur = $data3['table_dosen_nama'];
		$table_dosen_nip_kajur = $data3['table_dosen_nip'];
	}

	// memanggil dan membaca template dokumen yang telah kita buat
	$document = file_get_contents("berita_acara_proposal.rtf");

	/* isi dokumen dinyatakan dalam bentuk string	#NAMA, #NIM, #HARI, #TGL, #JAMMULAI,
		 #JAMBERAKHIR, #TEMPAT, #KETUASIDANG, #NIPKETUASIDANG, #SEKRETARISSIDANG, #NIPSEKRETARISSIDANG
		 #KETUAJURUSAN, #NIPKETUA */

	$document = str_replace("#NAMA", $table_data_akun_nama, $document);
	$document = str_replace("#NIM", $table_data_akun_nim, $document);
	$document = str_replace("#HARI", $hari, $document);
	$document = str_replace("#TGL", $tanggal, $document);
	$document = str_replace("#JAMMULAI", $jamMulai, $document);
	$document = str_replace("#JAMBERAKHIR", $jamAkhir, $document);
	$document = str_replace("#TEMPAT", $table_dokumen_tempat_ujian_proposal, $document);
	$document = str_replace("#KETUASIDANG", $table_dosen_nama_ketua, $document);
	$document = str_replace("#NIPKETUASIDANG", $table_dosen_nip_ketua, $document);
	$document = str_replace("#SEKRETARISSIDANG", $table_dosen_nama_sekretaris, $document);
	$document = str_replace("#NIPSEKRETARISSIDANG", $table_dosen_nip_sekretaris, $document);
	$document = str_replace("#KETUAJURUSAN", $table_dosen_nama_kajur, $document);
	$document = str_replace("#NIPKETUA", $table_dosen_nip_kajur, $document);
	$document = str_replace("#NILAI", $table_dokumen_nilai_ujian_proposal, $document);


	// header untuk membuka file output RTF dengan MS. Word
	header("Content-type: application/msword");
	header("Content-disposition: inline; filename=berita_acara_proposal_$table_data_akun_nim.doc");
	header("Content-length: ".strlen($document));
	echo $document;

 ?>
