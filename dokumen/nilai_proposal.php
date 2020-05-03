<?php
	include ('../class/Class.php');

	$id_table_akun = $_GET['id_table_akun'];

	$table_data_akun_nama = 'Belum Diisi';
	$table_data_akun_nim = 'Belum Diisi';
	$table_data_akun_judul_skripsi = 'Belum Diisi';
	$tanggal = 'Belum Diisi';
	$table_dosen_nama = 'Belum Diisi';
	$table_dosen_nip = 'Belum Diisi';

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

		if($data['table_dokumen_tgl_ujian_proposal'] != '' || $data['table_dokumen_tgl_ujianproposal'] != null){
			if($data['table_dokumen_tgl_ujian_proposal'] != '0000-00-00'){
				$tanggal = $date->tanggal($data['table_dokumen_tgl_ujian_proposal']);
			}
		}

	}

	$getData1 = $query->select("SELECT * FROM table_dosen d, table_tugas_dosen td WHERE d.id_table_dosen = td.id_table_dosen AND table_tugas_dosen_tugas = 'Dosen Penguji' AND id_table_akun = '$id_table_akun'");
	$cek1 = mysqli_num_rows($getData1);
	if ($cek1 > 0){
		$data1 = mysqli_fetch_array($getData1);
		$table_dosen_nama = $data1['table_dosen_nama'];
		$table_dosen_nip = $data1['table_dosen_nip'];
	}

	// memanggil dan membaca template dokumen yang telah kita buat
	$document = file_get_contents("nilai_proposal.rtf");

	/* isi dokumen dinyatakan dalam bentuk string	#NAMA, #NIM, #JUDUL, #TGL, #PENGUJI,
		 #NIPPENGUJI */

	$document = str_replace("#NAMA", $table_data_akun_nama, $document);
	$document = str_replace("#NIM", $table_data_akun_nim, $document);
	$document = str_replace("#JUDUL", $table_data_akun_judul_skripsi, $document);
	$document = str_replace("#TGL", $tanggal, $document);
	$document = str_replace("#PENGUJI", $table_dosen_nama, $document);
	$document = str_replace("#NIPPENGUJI", $table_dosen_nip, $document);

	// header untuk membuka file output RTF dengan MS. Word
	header("Content-type: application/msword");
	header("Content-disposition: inline; filename=nilai_proposal_$table_data_akun_nim.doc");
	header("Content-length: ".strlen($document));
	echo $document;

 ?>
