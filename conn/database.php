<?php
	class database{
		function __construct(){
			$this->connection = new mysqli('localhost', 'root', '','phapros_final');
		}
		
		//Fungsi Untuk Tampil
		function tampil_golongan(){
			$query = $this->connection->query("SELECT * FROM mst_golongan");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		
		function tampil_anggota($id_anggota = null){
			if($id_anggota == null)
				$query = $this->connection->query("SELECT ang.*, gol.nama_golongan, jab.nama_jabatan, uni.nama_unit FROM mst_anggota as ang LEFT JOIN mst_golongan as gol ON ang.id_golongan = gol.id_golongan LEFT JOIN mst_jabatan as jab ON ang.id_jabatan = jab.id_jabatan LEFT JOIN mst_unit as uni ON ang.id_unit = uni.id_unit");
			else
				$query = $this->connection->query("SELECT ang.*, gol.nama_golongan, jab.nama_jabatan, uni.nama_unit FROM mst_anggota as ang LEFT JOIN mst_golongan as gol ON ang.id_golongan = gol.id_golongan LEFT JOIN mst_jabatan as jab ON ang.id_jabatan = jab.id_jabatan LEFT JOIN mst_unit as uni ON ang.id_unit = uni.id_unit WHERE id_anggota = '$id_anggota'");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		
		function tampil_jabatan($id_jabatan = null){
			if($id_jabatan != null)
				$query = $this->connection->query("SELECT * FROM mst_jabatan WHERE id_jabatan = '$id_jabatan'");
			else
				$query = $this->connection->query("SELECT * FROM mst_jabatan");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		
		function tampil_unit(){
			$query = $this->connection->query('SELECT * FROM mst_unit');
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		function tampil_satuan($id_periode = null){
			if($id_periode != null)
				$query = $this->connection->query("SELECT * FROM mst_satuan WHERE id_periode='$id_periode'");
			else 
				$query = $this->connection->query('SELECT * FROM mst_satuan');
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		function tampil_kpi($id_periode = null){
			error_reporting(0);
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			$id_jabatan = $_SESSION['id_jabatan'];
			$id_unit = $_SESSION['id_unit'];
			if($id_periode != null)
				$query = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun, s.nama_satuan, pol.nama_polarisasi FROM data_kpi k LEFT JOIN mst_jabatan j ON j.id_jabatan = k.id_jabatan LEFT JOIN mst_unit u ON u.id_unit = k.id_unit LEFT JOIN mst_periode p ON p.id_periode = k.id_periode LEFT JOIN mst_satuan s ON s.id_satuan = k.satuan LEFT JOIN mst_polarisasi pol ON pol.id_polarisasi = k.sifat_kpi WHERE k.id_anggota = '$id_anggota' AND k.id_jabatan = '$id_jabatan' AND k.id_unit = '$id_unit' AND p.id_periode = '$id_periode'");
			else
				$query = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun, s.nama_satuan, pol.nama_polarisasi FROM data_kpi k LEFT JOIN mst_jabatan j ON j.id_jabatan = k.id_jabatan LEFT JOIN mst_unit u ON u.id_unit = k.id_unit LEFT JOIN mst_periode p ON p.id_periode = k.id_periode LEFT JOIN mst_satuan s ON s.id_satuan = k.satuan LEFT JOIN mst_polarisasi pol ON pol.id_polarisasi = k.sifat_kpi WHERE k.id_anggota = '$id_anggota' AND k.id_jabatan = '$id_jabatan' AND k.id_unit = '$id_unit'");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_kpi_detail($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null){
			error_reporting(0);
			if($id_periode != null)
				$query = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun, s.nama_satuan, pol.nama_polarisasi, a.nama FROM data_kpi k LEFT JOIN mst_anggota a ON a.id_anggota = k.id_anggota LEFT JOIN mst_jabatan j ON j.id_jabatan = k.id_jabatan LEFT JOIN mst_unit u ON u.id_unit = k.id_unit LEFT JOIN mst_periode p ON p.id_periode = k.id_periode LEFT JOIN mst_satuan s ON s.id_satuan = k.satuan LEFT JOIN mst_polarisasi pol ON pol.id_polarisasi = k.sifat_kpi WHERE k.id_anggota = '$id_anggota' AND k.id_jabatan = '$id_jabatan' AND k.id_unit = '$id_unit' AND p.id_periode = '$id_periode'");
			else
				$query = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun, s.nama_satuan, pol.nama_polarisasi, a.nama FROM data_kpi k LEFT JOIN mst_anggota a ON a.id_anggota = k.id_anggota LEFT JOIN mst_jabatan j ON j.id_jabatan = k.id_jabatan LEFT JOIN mst_unit u ON u.id_unit = k.id_unit LEFT JOIN mst_periode p ON p.id_periode = k.id_periode LEFT JOIN mst_satuan s ON s.id_satuan = k.satuan LEFT JOIN mst_polarisasi pol ON pol.id_polarisasi = k.sifat_kpi WHERE k.id_anggota = '$id_anggota' AND k.id_jabatan = '$id_jabatan' AND k.id_unit = '$id_unit'");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_kpi_verifikasi($id_periode = null){
			error_reporting(0);
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			$id_jabatan = $_SESSION['id_jabatan'];
			$id_unit = $_SESSION['id_unit'];
			if($id_jabatan != 0)
				$query = $this->connection->query("SELECT * FROM aturan_penilai WHERE id_jabatan_penilai = '$id_jabatan' AND id_unit_penilai = '$id_unit'");
			else 
				$query = $this->connection->query("SELECT * FROM aturan_penilai");
			while($tampil = $query->fetch_array())
			{
				$jd[] = $tampil['id_jabatan_dinilai'];
				$ud[] = $tampil['id_unit_dinilai'];
			}

			if($id_periode != null)
				$query = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun, s.nama_satuan, pol.nama_polarisasi, a.nama FROM data_kpi k LEFT JOIN mst_anggota a ON a.id_anggota = k.id_anggota LEFT JOIN mst_jabatan j ON j.id_jabatan = k.id_jabatan LEFT JOIN mst_unit u ON u.id_unit = k.id_unit LEFT JOIN mst_periode p ON p.id_periode = k.id_periode LEFT JOIN mst_satuan s ON s.id_satuan = k.satuan LEFT JOIN mst_polarisasi pol ON pol.id_polarisasi = k.sifat_kpi WHERE p.id_periode = '$id_periode'");
			else
				$query = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun, s.nama_satuan, pol.nama_polarisasi, a.nama FROM data_kpi k LEFT JOIN mst_anggota a ON a.id_anggota = k.id_anggota LEFT JOIN mst_jabatan j ON j.id_jabatan = k.id_jabatan LEFT JOIN mst_unit u ON u.id_unit = k.id_unit LEFT JOIN mst_periode p ON p.id_periode = k.id_periode LEFT JOIN mst_satuan s ON s.id_satuan = k.satuan LEFT JOIN mst_polarisasi pol ON pol.id_polarisasi = k.sifat_kpi");
			while($tampil = $query->fetch_array())
			{
				if(in_array($tampil['id_jabatan'], $jd) && in_array($tampil['id_unit'], $ud))
				{
					$hasil[] = $tampil;
				}
			}
			return $hasil;
		}

		function tampil_anggota_grup(){
			error_reporting(0);
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			$id_jabatan = $_SESSION['id_jabatan'];
			$id_unit = $_SESSION['id_unit'];
			if($id_jabatan != 0)
				$query = $this->connection->query("SELECT * FROM aturan_penilai WHERE id_jabatan_penilai = '$id_jabatan' AND id_unit_penilai = '$id_unit'");
			else 
				$query = $this->connection->query("SELECT * FROM aturan_penilai");
			while($tampil = $query->fetch_array())
			{
				$jd[] = $tampil['id_jabatan_dinilai'];
				$ud[] = $tampil['id_unit_dinilai'];
			}

			$query = $this->connection->query("SELECT a.*, j.nama_jabatan, u.nama_unit FROM mst_anggota a JOIN mst_jabatan j ON j.id_jabatan = a.id_jabatan JOIN mst_unit u ON u.id_unit = a.id_unit GROUP BY a.nik");
			while($tampil = $query->fetch_array())
			{
				if(in_array($tampil['id_jabatan'], $jd) && in_array($tampil['id_unit'], $ud))
					$hasil[] = $tampil;
			}

			return $hasil;
		}

		function tampil_kpi_seluruh(){
			$query = $this->connection->query('SELECT d.*, a.nama, j.nama_jabatan, u.nama_unit FROM data_kpi d JOIN mst_anggota a ON d.id_anggota = a.id_anggota JOIN mst_jabatan j ON j.id_jabatan = d.id_jabatan JOIN mst_unit u ON u.id_unit = d.id_unit ORDER BY id_jabatan, id_unit ASC');
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_aturan($jenis = null, $idjp = null, $idup = null){
			if($jenis == 1)
			{
				$query = $this->connection->query("SELECT * FROM aturan_penilai GROUP BY id_jabatan_penilai, id_unit_penilai");
			}
			else if($jenis == 2)
			{
				$query = $this->connection->query("SELECT * FROM aturan_penilai WHERE id_jabatan_penilai = '$idjp' AND id_unit_penilai = '$idup'");
			}

			while($tampil = $query->fetch_array())
					$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_waktu_input(){
			$query = $this->connection->query("SELECT * FROM waktu_input");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		
		function tampil_waktu_verifikasi(){
			$query = $this->connection->query("SELECT * FROM waktu_verifikasi");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_user(){
			$query = $this->connection->query("SELECT u.*, a.nama, j.nama_jabatan, un.nama_unit FROM user u JOIN mst_anggota a ON u.username = a.nik JOIN mst_jabatan j ON j.id_jabatan = a.id_jabatan JOIN mst_unit un ON un.id_unit = a.id_unit");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_user_detail($nik = null){
			$query = $this->connection->query("SELECT a.*, g.nama_golongan, j.nama_jabatan, un.nama_unit, us.username, us.password, us.id_user FROM mst_anggota a JOIN mst_golongan g ON g.id_golongan = a.id_golongan JOIN mst_jabatan j ON j.id_jabatan = a.id_jabatan JOIN mst_unit un ON un.id_unit = a.id_unit JOIN user us ON us.username = a.nik WHERE a.nik = '$nik'");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_polarisasi($id_periode = null){
			if($id_periode == null)
				$query = $this->connection->query("SELECT * FROM mst_polarisasi");
			else 
				$query = $this->connection->query("SELECT * FROM mst_polarisasi WHERE id_periode = '$id_periode'");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_aturan_polarisasi(){
			$query = $this->connection->query("SELECT * FROM aturan_polarisasi");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_akses(){
			$hasil = [];
			$query = $this->connection->query("SELECT * FROM akses_menu");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_periode($id_periode = null){
			if($id_periode == null)
				$query = $this->connection->query("SELECT * FROM mst_periode");
			else 
				$query = $this->connection->query("SELECT * FROM mst_periode WHERE id_periode = '$id_periode'");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_catatan($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{
			$query = $this->connection->query("SELECT * FROM data_catatan WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'");
			$tampil = $query->fetch_array();
			$catatan = $tampil['catatan'];
			return $catatan;
		}

		function tampil_catatan2($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{
			$query = $this->connection->query("SELECT * FROM data_catatan2 WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'");
			$tampil = $query->fetch_array();
			$catatan = $tampil['catatan'];
			return $catatan;
		}

		function tampil_jabatan_grup($id_jabatatan_penilai = null, $id_unit_penilai = null)
		{
			error_reporting(0);
			$query = $this->connection->query("SELECT a.*, j.nama_jabatan, u.nama_unit FROM aturan_penilai a LEFT JOIN mst_jabatan j ON j.id_jabatan = a.id_jabatan_dinilai LEFT JOIN mst_unit u ON u.id_unit = a.id_unit_dinilai WHERE a.id_jabatan_penilai = '$id_jabatatan_penilai' AND a.id_unit_penilai = '$id_unit_penilai'");
			while($tampil = $query->fetch_array())
			{
				$hasil[] = $tampil;
			}
			return $hasil;
		}

		function tampil_anggota_grup2($id_jabatan = null, $id_unit = null)
		{
			$query = $this->connection->query("SELECT a.*, j.nama_jabatan, u.nama_unit FROM mst_anggota a JOIN mst_jabatan j ON j.id_jabatan = a.id_jabatan JOIN mst_unit u ON u.id_unit = a.id_unit WHERE a.id_jabatan = '$id_jabatan' AND a.id_unit = '$id_unit' GROUP BY a.nik");
			while($tampil = $query->fetch_array())
			{
				$hasil[] = $tampil;
			}

			return $hasil;
		}

		function tampil_realisasi($jenis = 1, $id_kpi = null)
		{
			if($jenis == 1)
			{
				$query = $this->connection->query("SELECT * FROM data_realisasi_kpi WHERE id_kpi = '$id_kpi'");
				$t = $query->fetch_array();
				return $t['realisasi'];
			}
			else if($jenis == 2)
			{
				$query = $this->connection->query("SELECT * FROM data_realisasi_kpi WHERE id_kpi = '$id_kpi'");
				$t = $query->fetch_array();
				return $t['keterangan'];
			}
		}

		function tampil_kompetensi($id_periode = null, $id_kompetensi = null)
		{
			if($id_kompetensi != null)
			{
				if($id_periode != null)
					$query = $this->connection->query("SELECT k.*, j.nama_kelompok FROM mst_kompetensi k LEFT JOIN mst_kelompok_jabatan j ON k.id_kelompok = j.id_kelompok WHERE k.id_kompetensi = '$id_kompetensi' AND k.id_periode = '$id_periode'");
				else 
					$query = $this->connection->query("SELECT k.*, j.nama_kelompok FROM mst_kompetensi k LEFT JOIN mst_kelompok_jabatan j ON k.id_kelompok = j.id_kelompok WHERE k.id_kompetensi = '$id_kompetensi'");
			}
			else 
			{
				if($id_periode != null)
					$query = $this->connection->query("SELECT k.*, j.nama_kelompok FROM mst_kompetensi k LEFT JOIN mst_kelompok_jabatan j ON k.id_kelompok = j.id_kelompok WHERE k.id_periode = '$id_periode'");
				else 	
					$query = $this->connection->query("SELECT k.*, j.nama_kelompok FROM mst_kompetensi k LEFT JOIN mst_kelompok_jabatan j ON k.id_kelompok = j.id_kelompok");
			}
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_kompetensi2($id_periode = null, $id_kelompok = null)
		{
			if($id_kelompok != null)
			{
				if($id_periode != null)
					$query = $this->connection->query("SELECT k.*, j.nama_kelompok FROM mst_kompetensi k LEFT JOIN mst_kelompok_jabatan j ON k.id_kelompok = j.id_kelompok WHERE k.id_kelompok = '$id_kelompok' AND k.id_periode = '$id_periode'");
				else 
					$query = $this->connection->query("SELECT k.*, j.nama_kelompok FROM mst_kompetensi k LEFT JOIN mst_kelompok_jabatan j ON k.id_kelompok = j.id_kelompok WHERE k.id_kelompok = '$id_kelompok'");
			}
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_kompetensi_individu($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{
			$hasil = [];
			if($id_anggota != null)
			{
				if($id_periode != null)
					$query = $this->connection->query("SELECT ki.*, mk.nama_kompetensi, mk.id_periode, mk.indikator_terendah, mk.indikator_tertinggi, p.peringkat, p.nilai FROM data_kompetensi_individu ki LEFT JOIN mst_kompetensi mk ON ki.id_kompetensi = mk.id_kompetensi LEFT JOIN mst_peringkat p ON ki.id_peringkat = p.id_peringkat WHERE ki.id_anggota = '$id_anggota' AND ki.id_periode = '$id_periode' AND ki.id_jabatan = '$id_jabatan' AND ki.id_unit = '$id_unit'");
				else
					$query = $this->connection->query("SELECT ki.*, mk.nama_kompetensi, mk.id_periode, mk.indikator_terendah, mk.indikator_tertinggi, p.peringkat, p.nilai FROM data_kompetensi_individu ki LEFT JOIN mst_kompetensi mk ON ki.id_kompetensi = mk.id_kompetensi LEFT JOIN mst_peringkat p ON ki.id_peringkat = p.id_peringkat WHERE ki.id_anggota = '$id_anggota' AND ki.id_jabatan = '$id_jabatan' AND ki.id_unit = '$id_unit'");
			}
			else
			{
				if($id_periode != null)
					$query = $this->connection->query("SELECT ki.*, mk.nama_kompetensi, mk.id_periode, mk.indikator_terendah, mk.indikator_tertinggi, p.peringkat, p.nilai FROM data_kompetensi_individu ki LEFT JOIN mst_kompetensi mk ON ki.id_kompetensi = mk.id_kompetensi LEFT JOIN mst_peringkat p ON ki.id_peringkat = p.id_peringkat WHERE ki.id_periode = '$id_periode' AND ki.id_jabatan = '$id_jabatan' AND ki.id_unit = '$id_unit'");
				else
					$query = $this->connection->query("SELECT ki.*, mk.nama_kompetensi, mk.id_periode, mk.indikator_terendah, mk.indikator_tertinggi, p.peringkat, p.nilai FROM data_kompetensi_individu ki LEFT JOIN mst_kompetensi mk ON ki.id_kompetensi = mk.id_kompetensi LEFT JOIN mst_peringkat p ON ki.id_peringkat = p.id_peringkat WHERE ki.id_jabatan = '$id_jabatan' AND ki.id_unit = '$id_unit'");
			}
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_peringkat($id_periode = null, $id_peringkat = null)
		{
			if($id_peringkat != null)
			{
				if($id_periode != null)
					$query = $this->connection->query("SELECT * FROM mst_peringkat WHERE id_peringkat = '$id_peringkat' AND id_periode = '$id_periode'");
				else
					$query = $this->connection->query("SELECT * FROM mst_peringkat WHERE id_periode = '$id_periode'");
			}
			else
			{
				if($id_periode != null)
					$query = $this->connection->query("SELECT * FROM mst_peringkat WHERE id_periode = '$id_periode'");
				else
					$query = $this->connection->query("SELECT * FROM mst_peringkat");
			}
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_kelompok_jabatan($id_kelompok = null)
		{
			if($id_kelompok != null)
				$query = $this->connection->query("SELECT * FROM mst_kelompok_jabatan WHERE id_kelompok = '$id_kelompok'");
			else
				$query = $this->connection->query("SELECT * FROM mst_kelompok_jabatan");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_soal($id_periode = null, $id_jabatan = null)
		{
			$id_kelompok = null;
			$hasil = [];
			$query1 = $this->connection->query("SELECT * FROM mst_kelompok_jabatan");
			while($tampil = $query1->fetch_array())
			{
				foreach(unserialize($tampil['id_jabatan']) as $key => $value)
				{
					if($value == $id_jabatan)
					{
						$id_kelompok = $tampil['id_kelompok'];
						break;
					}
				}
			}

			$query2 = $this->connection->query("SELECT * FROM mst_kompetensi WHERE id_periode = '$id_periode' AND id_kelompok = '$id_kelompok'");
			while($tampil2 = $query2->fetch_array())
				$hasil[] = $tampil2;
			return $hasil;
		}
		//Akhiran Fungsi Tampil

		//Fungsi Input
		function input_golongan($nama_golongan = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO mst_golongan VALUES ('', '$nama_golongan', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else
				return 2;
		}
		
		function input_jabatan($nama_jabatan = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO mst_jabatan VALUES ('', '$nama_jabatan', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else
				return 2;
		}
		
		function input_unit($nama_unit = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO mst_unit VALUES ('', '$nama_unit', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else
				return 2;
		}
		
		function input_anggota($nik = null, $nama_anggota = null, $jenis_kelamin = null, $tempat_lahir = null, $tanggal_lahir = null, $status = null, $nomor_hp = null, $email = null, $golongan = null, $jabatan = null, $unit = null, $alamat = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO mst_anggota VALUES ('', '$nik', '$nama_anggota', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$status', '$nomor_hp', '$email','$golongan', '$jabatan', '$unit', '$alamat', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
			{
				$pass = md5($nik);
				$query = "INSERT INTO user VALUES ('', '$nik', '$pass', '1', '0')";
				$input = $this->connection->prepare($query);

				if($input->execute())
					return 1;
				else 
					return 2;
			}
			else
			{
				return 2;
			}
		}
		
		function input_satuan($nama_satuan = null, $jenis_polarisasi = null, $periode = null){
			$tanggal = date('Y-m-d');
			$arrJenis = serialize($jenis_polarisasi);
			$query = "INSERT INTO mst_satuan VALUES ('', '$nama_satuan', '$arrJenis', '$periode', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else
				return 2;
		}

		function input_kelompok($kelompok = null, $jabatan = null){
			$arrJabatan = serialize($jabatan);
			$query = "INSERT INTO mst_kelompok_jabatan VALUES ('', '$kelompok', '$arrJabatan')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else 
				return 2;
		}

		function input_kpi($kpi = [], $deskripsi = [], $bobot = [], $sasaran = [], $satuan = [], $sifat_kpi = [], $id_periode = 0)
		{
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			$id_jabatan = $_SESSION['id_jabatan'];
			$id_unit = $_SESSION['id_unit'];
			for($a=0; $a<count($kpi); $a++)
			{
				$tanggal_input = date('Y-m-d');
				$query = "INSERT INTO data_kpi VALUES ('', '$id_anggota', '$id_jabatan', '$id_unit', '$id_periode','$kpi[$a]', '$deskripsi[$a]', '$bobot[$a]', '$sasaran[$a]', '$satuan[$a]', '$sifat_kpi[$a]', '0', '0', '$tanggal_input', '')";
				$input = $this->connection->prepare($query);
				if($input->execute())
					$cek[$a] = 1;
				else 
					$cek[$a] = 0;
			}

			if(in_array(0, $cek))
			{
				return 2;
			}
			else{
				header('location:data_kpi.php');
			}
		}

		function input_kpi_anggota($id_anggota = null, $id_jabatan = null, $id_unit = null, $kpi = [], $deskripsi = [], $bobot = [], $sasaran = [], $satuan = [], $sifat_kpi = [], $id_periode = 0)
		{
			for($a=0; $a<count($kpi); $a++)
			{
				$tanggal_input = date('Y-m-d');
				$query = "INSERT INTO data_kpi VALUES ('', '$id_anggota', '$id_jabatan', '$id_unit', '$id_periode','$kpi[$a]', '$deskripsi[$a]', '$bobot[$a]', '$sasaran[$a]', '$satuan[$a]', '$sifat_kpi[$a]', '0', '0', '$tanggal_input', '')";
				$input = $this->connection->prepare($query);
				if($input->execute())
					$cek[$a] = 1;
				else 
					$cek[$a] = 0;
			}

			if(in_array(0, $cek))
			{
				return 2;
			}
			else{
				header("location:detail_kpi.php?id_anggota=$id_anggota&&id_jabatan=$id_jabatan&&id_unit=$id_unit");
			}
		}

		function input_aturan($jp = null, $up = null, $jd = [], $ud = null){
			$jml = count($jd);
			$k = [];
			for($i=0; $i<$jml; $i++)
			{
				$query = "INSERT INTO aturan_penilai VALUES ('', '$jp', '$up', '$jd[$i]', '$ud')";
				$input = $this->connection->prepare($query);
				if($input->execute())
					$k[] = 1;
				else 
					$k[] = 0;
			}

			if(in_array(0, $k))
				return 2;
			else 
				return 1;
		}

		function input_awal_input($tanggal1 = null, $tanggal2 = null, $jenis_input = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO waktu_input VALUES ('', '$tanggal1', '$tanggal2', '$jenis_input', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else 
				return 2;
		}

		function input_verifikasi($tanggal1 = null, $tanggal2 = null, $jenis_verifikasi = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO waktu_verifikasi VALUES ('', '$tanggal1', '$tanggal2', '$jenis_verifikasi', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else 
				return 2;
		}

		function input_polarisasi($nama_polarisasi = null, $periode = null){
			$tgl = date('Y-m-d');
			$query = "INSERT INTO mst_polarisasi VALUES ('', '$nama_polarisasi', '$periode', '$tgl')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else
				return 2;
		}

		function input_aturan_polarisasi($id_polarisasi = null, $bmi = [], $bma = [], $poin = []){
			$tgl = date('Y-m-d');
			if(count($bmi) == count($bma) AND count($bmi) == count($poin))
			{
				for($a=0; $a<count($bmi); $a++)
				{
					$query = "INSERT INTO aturan_polarisasi VALUES ('', '$id_polarisasi', '$bmi[$a]', '$bma[$a]', '$poin[$a]', '$tgl')";
					$input = $this->connection->prepare($query);
					if($input->execute())
						$k[] = 1;
					else 
						$k[] = 0;
				}

				if(!in_array(0, $k))
					header('location:aturan_polarisasi.php?id_polarisasi='.$id_polarisasi.'');
			}
				
		}

		function input_periode($tahun_periode = null){
			$query = "INSERT INTO mst_periode VALUES ('', '$tahun_periode', '0')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				header('location:data_periode.php');
			else 
				return 2;
		}

		function input_catatan($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null, $catatan = null){
			$tanggal = date('Y-m-d');
			$query = $this->connection->query("SELECT * FROM data_catatan WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'");
			$tampil = $query->fetch_array();
			$k = 0;
			if(count($tampil) == 0)
			{
				$query = "INSERT INTO data_catatan VALUES ('', '$id_anggota', '$id_jabatan', '$id_unit', '$id_periode', '$catatan', '$tanggal')";
				$input = $this->connection->prepare($query);
				if($input->execute())
					$k = 1;
			}
			else {
				$idC = $tampil['id_catatan'];
				$query = "UPDATE data_catatan SET catatan = '$catatan' WHERE id_catatan = '$idC'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					$k = 1;
			}

			if($k == 1)
				header("location:detail_kpi.php?id_anggota=$id_anggota&&id_jabatan=$id_jabatan&&id_unit=$id_unit");
			else 
				return 2;
		}

		function input_catatan2($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null, $catatan = null){
			$tanggal = date('Y-m-d');
			$query = $this->connection->query("SELECT * FROM data_catatan2 WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'");
			$tampil = $query->fetch_array();
			$k = 0;
			if(count($tampil) == 0)
			{
				$query = "INSERT INTO data_catatan2 VALUES ('', '$id_anggota', '$id_jabatan', '$id_unit', '$id_periode', '$catatan', '$tanggal')";
				$input = $this->connection->prepare($query);
				if($input->execute())
					$k = 1;
			}
			else {
				$idC = $tampil['id_catatan'];
				$query = "UPDATE data_catatan2 SET catatan = '$catatan' WHERE id_catatan = '$idC'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					$k = 1;
			}

			if($k == 1)
				return 1;
			else 
				return 2;
		}

		function input_realisasi($id_kpi = [], $realisasi = [], $keterangan = [])
		{
			$tanggal = date('Y-m-d');
			$jml = count($id_kpi);
			if($jml > 0)
			{
				$k = [];
				$c = 0;
				for($a=0; $a<$jml; $a++)
				{
					$qc = $this->connection->query("SELECT * FROM data_realisasi_kpi WHERE id_kpi = '$id_kpi[$a]'");
					while($t = $qc->fetch_array())
						$c = $c+1;
					if($c == 0)
					{
						$query = "INSERT INTO data_realisasi_kpi VALUES ('', '$id_kpi[$a]', '$realisasi[$a]', '$keterangan[$a]', '0', '$tanggal', '0', '0000-00-00')";
						$input = $this->connection->prepare($query);
						if($input->execute())
							$k[] = 1;
						else 
							$k[] = 0;
					}
					else {
						$query = "UPDATE data_realisasi_kpi SET realisasi = '$realisasi[$a]', keterangan = '$keterangan[$a]' WHERE id_kpi = '$id_kpi[$a]'";
						$edit = $this->connection->prepare($query);
						if($edit->execute())
							$k[] = 1;
						else 
							$k[] = 0;
					}
					$c = 0;
				}
			}
			else{
				return 2;
			}

			if(in_array(0, $k))
				return 2;
			else
				return 1;
		}

		function input_kompetensi($id_periode = null, $id_kelompok = null, $nama_kompetensi = null, $indikator_terendah = null, $indikator_tertinggi = null, $bobot = null)
		{
			$query = "INSERT INTO mst_kompetensi VALUES ('', '$id_periode', '$id_kelompok', '$nama_kompetensi', '$indikator_terendah', '$indikator_tertinggi', '$bobot')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else 
				return 2;
		}

		function input_peringkat($id_periode = null, $peringkat = null, $nilai = null)
		{
			$query = "INSERT INTO mst_peringkat VALUES ('', '$id_periode', '$peringkat', '$nilai')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else 
				return 2;
		}

		function input_kompetensi_individu($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_kompetensi = [], $id_peringkat = [], $id_periode)
		{
			$jml = count($id_kompetensi);
			if($jml > 0)
			{
				for($a=0; $a<$jml; $a++)
				{
					$tanggal = date('Y-m-d');
					$jml2 = 0;
					$qc = $this->connection->query("SELECT * FROM data_kompetensi_individu WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_kompetensi = '$id_kompetensi[$a]' AND id_periode = '$d_periode'");
					while($tc = $qc->fetch_array())
					{
						$jml2 = $jml2+1;
						$id_ki = $tc['id_kompetensi_individu'];
					}

					if($jml2 > 0)
					{
						$query = "UPDATE data_kompetensi_individu SET id_peringkat = '$id_peringkat[$a]' WHERE id_kompetensi_individu = '$id_ki'";
						$input = $this->connection->prepare($query);
						if($input->execute())
							$k[] = 1;
						else 
							$k[] = 0;
					}
					else
					{
						$query = "INSERT INTO data_kompetensi_individu VALUES ('', '$id_anggota', '$id_jabatan', '$id_unit', '$id_kompetensi[$a]', '$id_peringkat[$a]', '$id_periode', '0', '0', '0000-00-00','$tanggal')";
						$input = $this->connection->prepare($query);
						if($input->execute())
							$k[] = 1;
						else 
							$k[] = 0;
					}
				}

				if(in_array(0, $k))
					return 2;
				else 
					return 1;
			}
		}
		//Akhiran Fungsi Input

		//Fungsi Edit
		function edit_satuan($id_satuan = null, $nama_satuan = null, $jenis_polarisasi = null, $periode = null, $id_periode = null){
			if($id_satuan != null)
			{
				$tanggal = date('Y-m-d');
				$arrJenis = serialize($jenis_polarisasi);
				$query = "UPDATE mst_satuan SET nama_satuan = '$nama_satuan', jenis_polarisasi = '$arrJenis', tanggal_input = '$tanggal', id_periode = '$periode' WHERE id_satuan = '$id_satuan'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header("location:detail_satuan.php?id_periode=$id_periode");
				else 
					return 2;
			}
			else{
				return 3;
			}
		}
		
		function edit_golongan($id_golongan = null, $nama_golongan = null)
		{
			if($id_golongan != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE mst_golongan SET nama_golongan = '$nama_golongan', tanggal_input = '$tanggal' WHERE id_golongan = '$id_golongan'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header("location:data_golongan.php");
				else 
					return 2;
			}
			else {
				return 3;
			}
		}

		function edit_jabatan($id_jabatan = null, $nama_jabatan = nulll)
		{
			if($id_jabatan != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE mst_jabatan SET nama_jabatan = '$nama_jabatan', tanggal_input = '$tanggal' WHERE id_jabatan = '$id_jabatan'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header('location:data_jabatan.php');
				else 
					return 2;
			}
			else {
				return 3;
			}
		}

		function edit_unit($id_unit = null, $nama_unit = null)
		{
			if($id_unit != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE mst_unit SET nama_unit = '$nama_unit', tanggal_input = '$tanggal' WHERE id_unit = '$id_unit'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header("location:data_unit.php");
				else 
					return 2;
			}
			else{
				return 3;
			}
		}
		function edit_anggota($id_anggota = null, $nik_asli = null, $nik = null, $nama_anggota = null, $jenis_kelamin = null, $tempat_lahir = null, $tanggal_lahir = null, $status = null, $nomor_hp = null, $email = null, $golongan = null, $jabatan = null, $unit = null, $alamat = null)
		{
			if($id_anggota != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE mst_anggota SET nik = '$nik', nama = '$nama_anggota', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', status = '$status', nomor_hp = '$nomor_hp', email = '$email', id_golongan = '$golongan', id_jabatan = '$jabatan', id_unit = '$unit', alamat = '$alamat' WHERE id_anggota = '$id_anggota'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
				{
					$query = $this->connection->query("SELECT * FROM user WHERE username = '$nik_asli'");
					while($tampil = $query->fetch_array())
						$id_user = $tampil['id_user'];
					
					$password = md5($nik);
					$query = "UPDATE user SET username = '$nik', password = '$password' WHERE id_user = '$id_user'";
					$edit = $this->connection->prepare($query);
					if($edit->execute())
						header("location:data_anggota.php");
					else 
						return 2;
				}
				else 
					return 2;
			}
			else {
				return 3;
			}
		}

		function edit_kpi($id_kpi = null, $kpi = null, $deskripsi = null, $bobot = null, $sasaran = null, $satuan = null, $sifat_kpi = null, $id_periode = null)
		{
			$tanggal_input = date('Y-m-d');
			$query = "UPDATE data_kpi SET kpi = '$kpi', status = '0', id_verifikator = '0', tanggal_verifikasi = '0000-00-00', deskripsi = '$deskripsi', bobot = '$bobot', sasaran = '$sasaran', satuan = '$satuan', sifat_kpi = '$sifat_kpi', id_periode = '$id_periode' WHERE id_kpi = '$id_kpi'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
			{
				return 1;
			}
			else {
				return 2;
			}
		}

		function edit_awal_input($id_awal_input = null, $tanggal1 = null, $tanggal2 = null, $jenis_inputan = null)
		{
			$query = "UPDATE waktu_input SET tanggal_awal_input = '$tanggal1', tanggal_akhir_input = '$tanggal2', jenis_input = '$jenis_inputan' WHERE id_waktu_input = '$id_awal_input'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				header("location:waktu_input.php");
			else 
				return 2;
		}

		function edit_verifikasi($id = null, $tanggal1 = null, $tanggal2 = null, $jenis_verifikasi = null)
		{
			$query = "UPDATE waktu_verifikasi SET tanggal_awal_verifikasi = '$tanggal1', tanggal_akhir_verifikasi = '$tanggal2', jenis_verifikasi = '$jenis_verifikasi' WHERE id_waktu_verifikasi = '$id'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				header("location:waktu_verifikasi.php");
			else 
				return 2;
		}

		function edit_aturan($jp = null, $up = null, $jd = null, $ud = null, $jpA = null, $upA = null){
			$query = "DELETE FROM aturan_penilai WHERE id_jabatan_penilai = '$jpA' AND id_unit_penilai = '$upA'";
			$hapus = $this->connection->prepare($query);
			if($hapus->execute())
			{
				for($a=0; $a<count($jd); $a++)
				{
					$query = "INSERT INTO aturan_penilai VALUES ('', '$jp', '$up', '$jd[$a]', '$ud')";
					$edit = $this->connection->prepare($query);
					if($edit->execute())
						$k[] = 1;
					else 
						$k[] = 0;
				}

				if(in_array(0, $k))
					return 2;
				else 
					return 1;
			}
			else{
				return 2;
			}
		}

		function edit_polarisasi($id_polarisasi = null, $nama_polarisasi = null, $periode = null, $periode_asli = null)
		{
			if($id_polarisasi != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE mst_polarisasi SET nama_polarisasi = '$nama_polarisasi', tanggal_input = '$tanggal', id_periode = '$periode' WHERE id_polarisasi = '$id_polarisasi'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header("location:detail_polarisasi.php?id_periode=$periode_asli");
				else 
					return 2;
			}
			else {
				return 3;
			}
		}

		function edit_aturan_polarisasi($id_aturan_polarisasi = null, $bmi = null, $bma = null, $poin = null, $id_polarisasi = null)
		{
			if($id_aturan_polarisasi != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE aturan_polarisasi SET bmi = '$bmi', bma = '$bma', poin = '$poin', tanggal_input = '$tanggal' WHERE id_aturan_polarisasi = '$id_aturan_polarisasi'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header('location:aturan_polarisasi.php?id_polarisasi='.$id_polarisasi.'');
				else 
					return 2;
			}
		}

		function edit_periode($id_periode = null, $tahun_periode = null)
		{
			$query = "UPDATE mst_periode SET tahun = '$tahun_periode' WHERE id_periode = '$id_periode'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				header('location:data_periode.php');
			else 
				return 2;
		}

		function revisi_nilai($id_kpi = [], $bobot = [], $sasaran = [])
		{
			$tanggal_input = date('Y-m-d');
			for($a=0; $a<count($id_kpi); $a++)
			{
				$query = "UPDATE data_kpi SET bobot = '$bobot[$a]', sasaran = '$sasaran[$a]' WHERE id_kpi = '$id_kpi[$a]'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					$k[] = 1;
				else 
					$k[] = 0;
			}

			if(in_array(0, $k))
				return 2;
			else
				header('location:data_kpi_verifikasi.php');
		}

		function edit_kompetensi($id_periode = null, $id_kelompok = null, $id_kompetensi = null, $nama_kompetensi = null, $indikator_terendah = null, $indikator_tertinggi = null, $bobot = null)
		{
			$query = "UPDATE mst_kompetensi SET id_kelompok = '$id_kelompok', nama_kompetensi = '$nama_kompetensi', indikator_terendah = '$indikator_terendah', indikator_tertinggi = '$indikator_tertinggi', bobot = '$bobot' WHERE id_kompetensi = '$id_kompetensi'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				header("location:detail_kompetensi.php?id_periode=$id_periode&&id_kelompok=$id_kelompok");
			else 
				return 2;
		}

		function edit_peringkat($id_periode = null, $id_peringkat = null, $peringkat = null, $nilai = null)
		{
			$query = "UPDATE mst_peringkat SET peringkat = '$peringkat', nilai = '$nilai' WHERE id_peringkat = '$id_peringkat'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				header("location:detail_peringkat.php?id_periode=$id_periode");
			else 
				return 2;
		}

		function edit_kelompok($id_kelompok = null, $kelompok = null, $id_jabatan = null)
		{
			$arrJabatan = serialize($id_jabatan);
			$query = "UPDATE mst_kelompok_jabatan SET nama_kelompok = '$kelompok', id_jabatan = '$arrJabatan' WHERE id_kelompok = '$id_kelompok'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				return 1;
			else 
				return 2;
		}		

		function edit_kompetensi_individu($id_ki = null, $id_peringkat = null)
		{
			$query = "UPDATE data_kompetensi_individu SET id_peringkat = '$id_peringkat' WHERE id_kompetensi_individu = '$id_ki'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				return 1;
			else 
				return 2;
		}

		function edit_kompetensi_penilai($id_ki = [], $id_peringkat = [])
		{
			$jml = count($id_ki);
			if($jml > 0)
			{
				$k = [];
				for($a=0; $a<$jml; $a++)
				{
					$query = "UPDATE data_kompetensi_individu SET id_peringkat = '$id_peringkat[$a]' WHERE id_kompetensi_individu = '$id_ki[$a]'";
					$edit = $this->connection->prepare($query);
					if($edit->execute())
						$k[] = 1;
					else 
						$k[] = 0;
				}
				if(in_array(0, $k))
					return 2;
				else 
					return 1;
			}else {
				return 1;
			}
		}
		//Akhiran Fungsi Edit

		//Fungsi Hapus
		function hapus_satuan($id_satuan = null, $id_periode = null)
		{
			if($id_satuan != null)
			{
				$query = "DELETE FROM mst_satuan WHERE id_satuan = '$id_satuan'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:detail_satuan.php?id_periode=$id_periode");
				else 
					return 2;
			}
			else 
			{
				return 3;
			}
		}
		
		function hapus_golongan($id_golongan = null)
		{
			if($id_golongan != null)
			{
				$query = "DELETE FROM mst_golongan WHERE id_golongan = '$id_golongan'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:data_golongan.php");
				else 
					return 2;
			}
			else {
				return 3;
			}
		}

		function hapus_jabatan($id_jabatan = null)
		{
			if($id_jabatan != null)
			{
				$query = "DELETE FROM mst_jabatan WHERE id_jabatan = '$id_jabatan'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:data_jabatan.php");
				else 
					return 2;
			}
			else{
				return 3;
			}
		}

		function hapus_unit($id_unit = null)
		{
			if($id_unit != null)
			{
				$query = "DELETE FROM mst_unit WHERE id_unit = '$id_unit'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:data_unit.php");
				else 
					return 2;
			}
			else {
				return 3;
			}
		}

		function hapus_anggota($id_anggota = null)
		{
			if($id_anggota != null)
			{
				$query = "DELETE FROM mst_anggota WHERE id_anggota = '$id_anggota'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:data_anggota.php");
				else 
					return 2;
			}
			else {
				return 3;
			}
		}

		function hapus_kpi($id_kpi = null, $jenis = null)
		{
			if($id_kpi != null)
			{
				$query = "DELETE FROM data_kpi WHERE id_kpi = '$id_kpi'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
				{
					if($jenis == null)
						header("location:data_kpi.php");
					else 
						return 1;
				}
				else
				{
					return 2;
				}
			}
			else {
				return 3;
			}
		}

		function hapus_aturan($id_aturan = null)
		{
			if($id_aturan != null)
			{
				$query = "DELETE FROM aturan_penilai WHERE id_aturan = '$id_aturan'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:aturan_penilai.php");
				else 
					return 2;
			}
		}

		function hapus_awal_input($id_waktu_input = null)
		{
			if($id_waktu_input != null)
			{
				$query = "DELETE FROM waktu_input WHERE id_waktu_input = '$id_waktu_input'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:waktu_input.php");
				else 
					return 2;
			}
		}

		function hapus_verifikasi($id = null)
		{
			if($id != null)
			{
				$query = "DELETE FROM waktu_verifikasi WHERE id_waktu_verifikasi = '$id'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:waktu_verifikasi.php");
				else 
					return 2;
			}
		}

		function hapus_polarisasi($id_polarisasi = null, $periode = null)
		{
			if($id_polarisasi != null)
			{
				$query = "DELETE FROM mst_polarisasi WHERE id_polarisasi = '$id_polarisasi'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
				{
					$query1 = "DELETE FROM aturan_polarisasi WHERE id_polarisasi = '$id_polarisasi'";
					$hapus1 = $this->connection->prepare($query1);
					if($hapus1->execute()){
						header("location:detail_polarisasi.php?id_periode=$periode");	
					}
				}
				else{
					return 2;
				}
			}
			else {
				return 3;
			}
		}

		function hapus_aturan_polarisasi($id_aturan_polarisasi = null, $id_polarisasi = null)
		{
			if($id_aturan_polarisasi != null)
			{
				$query = "DELETE FROM aturan_polarisasi WHERE id_aturan_polarisasi = '$id_aturan_polarisasi'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header('location:aturan_polarisasi.php?id_polarisasi='.$id_polarisasi.'');
			}
		}

		function hapus_periode($id_periode = null)
		{
			if($id_periode != null)
			{
				$query = "DELETE FROM mst_periode WHERE id_periode = '$id_periode'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header('location:data_periode.php');
				else 
					return 2;
			}
		}

		function hapus_catatan($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{

			$query = "DELETE FROM data_catatan WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'";
			$hapus = $this->connection->prepare($query);
			if($hapus->execute())
				header("location:detail_kpi.php?id_anggota=$id_anggota&&id_jabatan=$id_jabatan&&id_unit=$id_unit");
			else 
				return 2;
		}

		function hapus_catatan2($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{

			$query = "DELETE FROM data_catatan2 WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'";
			$hapus = $this->connection->prepare($query);
			if($hapus->execute())
				header("location:detail_ks.php?id_anggota=$id_anggota&&id_jabatan=$id_jabatan&&id_unit=$id_unit");
			else 
				return 2;
		}

		function hapus_kompetensi($id_kompetensi = null, $id_periode = null, $id_kelompok = null)
		{
			$query = "DELETE FROM mst_kompetensi WHERE id_kompetensi = '$id_kompetensi' AND id_periode = '$id_periode'";
			$hapus = $this->connection->prepare($query);
			if($hapus->execute())
				header("location:detail_kompetensi.php?id_periode=$id_periode&&id_kelompok=$id_kelompok");
			else 
				return 2;
		}

		function hapus_peringkat($id_peringkat = null, $id_periode = null)
		{
			$query = "DELETE FROM mst_peringkat WHERE id_peringkat = '$id_peringkat'";
			$hapus = $this->connection->prepare($query);
			if($hapus->execute())
				header("location:detail_peringkat.php?id_periode=$id_periode");
			else 
				return 2;
		}

		function hapus_kelompok($id_kelompok = null)
		{
			$query = "DELETE FROM mst_kelompok_jabatan WHERE id_kelompok = '$id_kelompok'";
			$hapus = $this->connection->prepare($query);
			if($hapus->execute())
				header("location:data_kelompok.php");
			else 
				return 2;
		}
		//Akhiran Fungsi Hapus

		//Fungsi Cek Login
		function cek_login($username = null, $password = null)
		{
			if($username == null || $password == null)
			{
				return 1;
			}
			else {
				if($username == 'admin' && $password == 'nikokusdiarto22')
				{
					session_start();
					$_SESSION['login'] = TRUE;
					$_SESSION['aksus'] = TRUE;
					$_SESSION['id_anggota'] = 0;
					$_SESSION['id_jabatan'] = 0;
					$_SESSION['id_unit'] = 0;
					$_SESSION['nama'] = 'Admin Super';
					$_SESSION['nik'] = 0;
					header("location:index.php");
				}
				else 
				{
					$query = $this->connection->query("SELECT * FROM user WHERE username = '$username'");
					$jml = count($query->fetch_array());
					if($jml == 0)
					{
						return 2;
					}else {
						$password = md5($password);
						$query1 = $this->connection->query("SELECT * FROM user WHERE username = '$username' AND password = '$password' AND status = 1");
						$jml = 0;
						$aksus = 0;
						while($tampil = $query1->fetch_array()){
							$jml = $jml + 1;
							$aksus = $tampil['aksus'];
						}

						if($jml == 0)
						{
							return 3;
						}
						else{
							$query = $this->connection->query("SELECT * FROM mst_anggota WHERE nik = '$username'");
							while($tampil = $query->fetch_array())
							{
								$id_anggota = $tampil['id_anggota'];
								$id_jabatan = $tampil['id_jabatan'];
								$id_unit = $tampil['id_unit'];
								$nama = $tampil['nama'];
							}

							session_start();
							$_SESSION['login'] = TRUE;
							if($aksus == 0)
								$_SESSION['aksus'] = FALSE;
							else 
								$_SESSION['aksus'] = TRUE;
								
							$_SESSION['id_anggota'] = $id_anggota;
							$_SESSION['id_jabatan'] = $id_jabatan;
							$_SESSION['id_unit'] = $id_unit;
							$_SESSION['nama'] = $nama;
							$_SESSION['nik'] = $username;
							header("location:index.php");
						}
					}
				}
			}
		}

		function cek_verif_realisasi($id_kpi = null)
		{
			$query = $this->connection->query("SELECT * FROM data_realisasi_kpi WHERE id_kpi = '$id_kpi'");
			$tampil = $query->fetch_array();
			return ($tampil['status'] == null)?(0):($tampil['status']);
		}

		function cek_verif_kompetensi($id_kompetensi = null)
		{
			$query = $this->connection->query("SELECT * FROM data_kompetensi_individu WHERE id_kompetensi_individu = '$id_kompetensi'");
			$tampil = $query->fetch_array();
			return $tampil['status'];
		}

		function cek_kompetensi($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_kompetensi = null)
		{
			$query = $this->connection->query("SELECT * FROM data_kompetensi_individu WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_kompetensi = '$id_kompetensi'");
			$jml = 0;
			while($tampil = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}
		//Akhiran Fungsi Cek Login

		// Fungsi Verifikasi
		function verifikasi($id = 0, $status = 0)
		{
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			if($status == 1)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE data_kpi SET status = '$status', tanggal_verifikasi = '$tanggal', id_verifikator = '$id_anggota' WHERE id_kpi = '$id'";
				$verif = $this->connection->prepare($query);
				if($verif->execute())
				{
					$queryT = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun FROM data_kpi k LEFT JOIN mst_jabatan j ON k.id_jabatan = j.id_jabatan LEFT JOIN mst_unit u ON k.id_unit = u.id_unit LEFT JOIN mst_periode p ON k.id_periode = p.id_periode WHERE k.id_kpi = '$id'");
					while($tampilT = $queryT->fetch_array())
					{
						$id_kpi_asli = $tampilT['id_kpi'];
						$id_anggota = $tampilT['id_anggota'];
						$jabatan = $tampilT['nama_jabatan'];
						$unit = $tampilT['nama_unit'];
						$tahun = $tampilT['tahun'];
						$kpi = $tampilT['kpi'];
						$deskripsi = $tampilT['deskripsi'];
						$bobot = $tampilT['bobot'];
						$sasaran = $tampilT['sasaran'];
						$satuan = $tampilT['satuan'];
						$sifat_kpi = $tampilT['sifat_kpi'];
						$status = $tampilT['status'];
						$id_verifikator = $tampilT['id_verifikator'];
						$tanggal_input = $tampilT['tanggal_input'];
						$tanggal_verifikasi = $tampilT['tanggal_verifikasi'];

						$queryI = "INSERT INTO data_kpi_verifikasi VALUES ('', '$id_kpi_asli', '$id_anggota', '$jabatan', '$unit', '$tahun', '$kpi', '$deskripsi', '$bobot', '$sasaran', '$satuan', '$sifat_kpi', '$status', '$id_verifikator', '$tanggal_input', '$tanggal_verifikasi')";
						$input1 = $this->connection->prepare($queryI);
						if($input1->execute())
							$c[] = 1;
						else 
							$c[] = 0;
					}
				}
				else{
					return 2;
				}
			}
			else 
			{
				$tanggal = '0000-00-00';
				$query = "UPDATE data_kpi SET status = '$status', tanggal_verifikasi = '$tanggal', id_verifikator = '$id_anggota' WHERE id_kpi = '$id'";
				$verif = $this->connection->prepare($query);
				if($verif->execute())
				{
					$queryH = "DELETE FROM data_kpi_verifikasi WHERE id_kpi_asli = '$id'";
					$hapus = $this->connection->prepare($queryH);
					if($hapus->execute())
						$c[] = 1;
					else 
						$c[] = 0;
				}
				else {
					return 2;
				}
			}

			if(in_array(0, $c))
			{
				return 2;
			}
			else
			{
				return 1;
			}
		}

		function verifikasi_akses($id = 0, $status = 0, $field = null)
		{
			
			$tanggal = date('Y-m-d');
			$query = $this->connection->query("SELECT * FROM akses_menu WHERE id_jabatan = '$id'");
			$jml = 0;
			while($tampil = $query->fetch_array())
			{
				$jml = $jml+1;
			}
			if($jml == 0)
			{
				$query = "INSERT INTO akses_menu (id_akses, id_jabatan, ".$field.") VALUES ('', '$id', '$status')";
				$input = $this->connection->prepare($query);
				if($input->execute())
					return 1;
				else 
					return 2;
			}
			else{
				$query = "UPDATE akses_menu SET $field = '$status' WHERE id_jabatan = '$id'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					return 1;
				else 
					return 2;
			}
		}
		
		function verif_all(){
			$query = $this->connection->query('SELECT * FROM data_kpi WHERE status = "0"');
			while($tampil = $query->fetch_array()){
				$id = $tampil['id_kpi'];
				$tgl = date('Y-m-d');
				$query1 = "UPDATE data_kpi SET status = '1', tanggal_verifikasi = '$tgl' WHERE id_kpi = '$id'";
				$vAll = $this->connection->prepare($query1);
				if($vAll->execute())
				{
					$queryT = $this->connection->query("SELECT k.*, j.nama_jabatan, u.nama_unit, p.tahun FROM data_kpi k LEFT JOIN mst_jabatan j ON k.id_jabatan = j.id_jabatan LEFT JOIN mst_unit u ON k.id_unit = u.id_unit LEFT JOIN mst_periode p ON k.id_periode = p.id_periode WHERE k.id_kpi = '$id'");
					while($tampilT = $queryT->fetch_array())
					{
						$id_kpi_asli = $tampilT['id_kpi'];
						$id_anggota = $tampilT['id_anggota'];
						$jabatan = $tampilT['nama_jabatan'];
						$unit = $tampilT['nama_unit'];
						$tahun = $tampilT['tahun'];
						$kpi = $tampilT['kpi'];
						$deskripsi = $tampilT['deskripsi'];
						$bobot = $tampilT['bobot'];
						$sasaran = $tampilT['sasaran'];
						$satuan = $tampilT['satuan'];
						$sifat_kpi = $tampilT['sifat_kpi'];
						$status = $tampilT['status'];
						$id_verifikator = $tampilT['id_verifikator'];
						$tanggal_input = $tampilT['tanggal_input'];
						$tanggal_verifikasi = $tampilT['tanggal_verifikasi'];

						$queryI = "INSERT INTO data_kpi_verifikasi VALUES ('', '$id_kpi_asli', '$id_anggota', '$jabatan', '$unit', '$tahun', '$kpi', '$deskripsi', '$bobot', '$sasaran', '$satuan', '$sifat_kpi', '$status', '0', '$tanggal_input', '$tanggal_verifikasi')";
						$input1 = $this->connection->prepare($queryI);
						if($input1->execute())
							$c[] = 1;
						else 
							$c[] = 0;
					}
				}
				else{
					return 'Gagal Memverifikasi';
				}
			}
			
			if(in_array(0, $c))
				return 'Gagal Memverifikasi';
			else 
				return 1;
		}

		function verif_periode($id_verifikasi = null, $status = null)
		{
			if($id_verifikasi != null)
			{
				$queryT = $this->connection->query("SELECT * FROM mst_periode WHERE status = 1");
				$idV = [];
				while($tampilT = $queryT->fetch_array())
				{
					$idV[] = $tampilT['id_periode'];
				}
				if(count($idV) > 0)
				{
					if($status == 1 AND !in_array($id_verifikasi, $idV))
					{
						return 3;
					}
					else{
						$query = "UPDATE mst_periode SET status = '$status' WHERE id_periode = '$id_verifikasi'";
						$verif = $this->connection->prepare($query);
						if($verif->execute())
							return 1;
						else 
							return 2;
					}
				}
				else {
					$query = "UPDATE mst_periode SET status = '$status' WHERE id_periode = '$id_verifikasi'";
					$verif = $this->connection->prepare($query);
					if($verif->execute())
						return 1;
					else 
						return 2;
				}
			}
		}

		function verif_realisasi($id_kpi = null, $status = null)
		{
			$query = "UPDATE data_realisasi_kpi SET status = '$status' WHERE id_kpi = '$id_kpi'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				return 1;
			else 
				return 2;
		}

		function verif_kompetensi($id_kompetensi = null, $status = null, $id_verifikator = null)
		{
			if($status == null || $status == 0 || $status == '0')
			{
				$id_verifikator = 0;
				$tanggal = '0000-00-00';
			}
			else {
				$tanggal = date('Y-m-d');
			}
			$query = "UPDATE data_kompetensi_individu SET status = '$status', id_verifikator = '$id_verifikator', tanggal_verifikasi = '$tanggal' WHERE id_kompetensi_individu = '$id_kompetensi'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				return 1;
			else 
				return 2;
		}
		// Akhiran Fungsi Verifikasi

		//User
			function reset_password($id = null, $username = null){
				$password = md5($username);
				$query = "UPDATE user SET password = '$password' WHERE id_user = '$id'";
				$reset = $this->connection->prepare($query);
				if($reset->execute())
					return 1;
				else 
					return 2;
			}

			function edit_user($id = null, $field = null, $value = null){
				$query = "UPDATE user SET $field = '$value' WHERE id_user = '$id'";
				$input = $this->connection->prepare($query);
				if($input->execute())
				{
					if($value == '1')
						return 1;
					else if($value == '2')
						return 2;
				}
			}

			function update_biodata($nik = null, $nama_anggota = null, $jenis_kelamin = null, $tempat_lahir = null, $tanggal_lahir = null, $status = null, $nomor_hp = null, $email = null, $alamat = null, $password = null){
				if($nik != null)
				{
					$tanggal = date('Y-m-d');
					$query = "UPDATE mst_anggota SET nama = '$nama_anggota', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', status = '$status', nomor_hp = '$nomor_hp', email = '$email', alamat = '$alamat' WHERE nik = '$nik'";
					$edit = $this->connection->prepare($query);
					if($edit->execute())
					{
						if($password != null)						
						{
							$password = md5($password);
							$query = "UPDATE user SET password = '$password' WHERE username = '$nik'";
							$edit = $this->connection->prepare($query);
						}
						if($edit->execute())
							header("location:index.php");
						else 
							return 2;
					}
					else 
						return 2;
				}
				else {
					return 3;
				}
			}
		//Akhiran User

		// Menghitung Data
		function hitung_data_kpi($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{
			if($id_periode != null)
				$query = $this->connection->query("SELECT * FROM data_kpi k LEFT JOIN mst_periode p ON p.id_periode = k.id_periode WHERE k.id_anggota = '$id_anggota' AND k.id_jabatan = '$id_jabatan' AND k.id_unit = '$id_unit' AND p.id_periode = '$id_periode'");
			else 
				$query = $this->connection->query("SELECT * FROM data_kpi k LEFT JOIN mst_periode p ON p.id_periode = k.id_periode WHERE k.id_anggota = '$id_anggota' AND k.id_jabatan = '$id_jabatan' AND k.id_unit = '$id_unit'");
			$jml = 0;
			while($tampil = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}

		function hitung_satuan($periode = null)
		{
			$query = $this->connection->query("SELECT * FROM mst_satuan WHERE id_periode = '$periode'");
			$jml = 0;
			while($tampil = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}

		function hitung_polarisasi($periode = null)
		{
			$query = $this->connection->query("SELECT * FROM mst_polarisasi WHERE id_periode = '$periode'");
			$jml = 0;
			while($tampil = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}

		function hitung_catatan($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{
			$query = $this->connection->query("SELECT * FROM data_catatan WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'");
			$jml = 0;
			while($t = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}

		function hitung_catatan2($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{
			$query = $this->connection->query("SELECT * FROM data_catatan2 WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'");
			$jml = 0;
			while($t = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}

		function hitung_jabatan_grup($id_jabatan = null, $id_unit = null)
		{
			error_reporting(0);
			$query = $this->connection->query("SELECT * FROM mst_anggota WHERE id_jabatan = '$id_jabatan' AND id_unit = '$id_unit'");
			$jml = 0;
			while($tampil = $query->fetch_array())
			{
				$jml = $jml+1;
			}
			return $jml;
		}

		function total_bobot($id_anggota = null, $id_jabatan = null, $id_unit = null, $id_periode = null)
		{
			error_reporting(0);
			$query = $this->connection->query("SELECT * FROM data_kpi WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND id_periode = '$id_periode'");
			$jml = 0;
			while($tampil = $query->fetch_array())
				$jml = $jml + $tampil['bobot'];
			return $jml;
		}
		function hitung_realisasi($id_kpi = null)
		{
			$query = $this->connection->query("SELECT * FROM data_realisasi_kpi WHERE id_kpi = '$id_kpi'");
			$jml = 0;
			while($t = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}

		function hitung_kompetensi($id_periode = null, $id_kelompok = null)
		{
			if($id_kelompok != null)
				$query = $this->connection->query("SELECT * FROM mst_kompetensi WHERE id_periode = '$id_periode' AND id_kelompok = '$id_kelompok'");
			else
				$query = $this->connection->query("SELECT * FROM mst_kompetensi WHERE id_periode = '$id_periode'");
			$jml = 0;
			while($t = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}

		function hitung_peringkat($id_periode = null)
		{
			$query = $this->connection->query("SELECT * FROM mst_peringkat WHERE id_periode = '$id_periode'");
			$jml = 0;
			while($t = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}
		// Akhiran Menghitung Data

		// Fungsi Copy Data
		function copy_satuan($jenis = null, $id_satuan = null, $id_periode = null)
		{
			$tanggal = date('Y-m-d');
			if($jenis == 1 || $jenis == '1')
			{
				$query1 = $this->connection->query("SELECT * FROM mst_satuan WHERE id_satuan = '$id_satuan'");
				while($tampil1 = $query1->fetch_array())
				{
					$nama_satuan = $tampil1['nama_satuan'];
					$jenis_polarisasi = $tampil1['jenis_polarisasi'];

					foreach(unserialize($jenis_polarisasi) as $key => $value)
					{
						$query2 = $this->connection->query("SELECT * FROM mst_polarisasi WHERE id_polarisasi = '$value'");
						while($tampil2 = $query2->fetch_array())
							$nama_polarisasi = $tampil2['nama_polarisasi'];
						$cek = 0;
						$query3 = $this->connection->query("SELECT * FROM mst_polarisasi WHERE nama_polarisasi = '$nama_polarisasi' AND id_periode = '$id_periode'");
						while($tampil3 = $query3->fetch_array())
						{
							$idP = $tampil3['id_polarisasi'];
							$cek = $cek+1;
						}

						if($cek == 0)
						{
							$queryInput2 = "INSERT INTO mst_polarisasi VALUES ('', '$nama_polarisasi', '$id_periode', '$tanggal')";
							$input2 = $this->connection->prepare($queryInput2);
							if($input2->execute())
							{
								$query3 = $this->connection->query("SELECT * FROM mst_polarisasi WHERE nama_polarisasi = '$nama_polarisasi' AND id_periode = '$id_periode'");
								while($tampil3 = $query3->fetch_array())
									$id_polarisasi_baru = $tampil3['id_polarisasi'];
								$query4 = $this->connection->query("SELECT * FROM aturan_polarisasi WHERE id_polarisasi = '$value'");
								while($tampil4 = $query4->fetch_array())
								{
									$bmi = $tampil4['bmi'];
									$bma = $tampil4['bma'];
									$poin = $tampil4['poin'];

									$queryInput3 = "INSERT INTO aturan_polarisasi VALUES ('', '$id_polarisasi_baru', '$bmi', '$bma', '$poin', '$tanggal')";
									$input3 = $this->connection->prepare($queryInput3);
									$input3->execute();
								}
								$jp[] = $id_polarisasi_baru;
							}
						}
						else {
							$jp[] = $idP;
						}
					}
					$jP2 = serialize($jp);
					$queryInput1 = "INSERT INTO mst_satuan VALUES ('', '$nama_satuan', '$jP2', '$id_periode', '$tanggal')";
					$input1 = $this->connection->prepare($queryInput1);
					if($input1->execute())
						$k[] = 1;
					else 
						$k[] = 0;
				}

				if(in_array(0, $k))
					return 2;
				else 
					header('location:data_satuan.php');
				
			}
			else if($jenis == 2 || $jenis == '2')
			{
				$a = 0;
				$query1 = $this->connection->query("SELECT * FROM mst_satuan WHERE id_periode = '$id_satuan'");
				while($tampil1 = $query1->fetch_array())
				{
					$a = $a+1;
					$nama_satuan = $tampil1['nama_satuan'];
					$jenis_polarisasi = $tampil1['jenis_polarisasi'];

					foreach(unserialize($jenis_polarisasi) as $key => $value)
					{
						$query2 = $this->connection->query("SELECT * FROM mst_polarisasi WHERE id_polarisasi = '$value'");
						while($tampil2 = $query2->fetch_array())
							$nama_polarisasi = $tampil2['nama_polarisasi'];
						$cek = 0;
						$query3 = $this->connection->query("SELECT * FROM mst_polarisasi WHERE nama_polarisasi = '$nama_polarisasi' AND id_periode = '$id_periode'");
						while($tampil3 = $query3->fetch_array())
						{
							$idP = $tampil3['id_polarisasi'];
							$cek = $cek+1;
						}

						if($cek == 0)
						{
							$queryInput2 = "INSERT INTO mst_polarisasi VALUES ('', '$nama_polarisasi', '$id_periode', '$tanggal')";
							$input2 = $this->connection->prepare($queryInput2);
							if($input2->execute())
							{
								$query3 = $this->connection->query("SELECT * FROM mst_polarisasi WHERE nama_polarisasi = '$nama_polarisasi' AND id_periode = '$id_periode'");
								while($tampil3 = $query3->fetch_array())
									$id_polarisasi_baru = $tampil3['id_polarisasi'];
								$query4 = $this->connection->query("SELECT * FROM aturan_polarisasi WHERE id_polarisasi = '$value'");
								while($tampil4 = $query4->fetch_array())
								{
									$bmi = $tampil4['bmi'];
									$bma = $tampil4['bma'];
									$poin = $tampil4['poin'];

									$queryInput3 = "INSERT INTO aturan_polarisasi VALUES ('', '$id_polarisasi_baru', '$bmi', '$bma', '$poin', '$tanggal')";
									$input3 = $this->connection->prepare($queryInput3);
									$input3->execute();
								}
								$jp[$a][] = $id_polarisasi_baru;
							}
						}
						else {
							$jp[$a][] = $idP;
						}
					}
					$jP2 = serialize($jp[$a]);
					$queryInput1 = "INSERT INTO mst_satuan VALUES ('', '$nama_satuan', '$jP2', '$id_periode', '$tanggal')";
					$input1 = $this->connection->prepare($queryInput1);
					if($input1->execute())
						$k[] = 1;
					else 
						$k[] = 0;
				}

				if(in_array(0, $k))
					return 2;
				else 
					header('location:data_satuan.php');
			}
		}

		function copy_polarisasi($jenis = null, $id_polarisasi = null, $id_periode = null)
		{
			$tanggal = date('Y-m-d');
			if($jenis == 1 || $jenis == '1')
			{
				$query = $this->connection->query("SELECT * FROM mst_polarisasi WHERE id_polarisasi = '$id_polarisasi'");
				while($tampil = $query->fetch_array())
				{
					$nama_polarisasi = $tampil['nama_polarisasi'];
				}
				$query1 = "INSERT INTO mst_polarisasi VALUES ('', '$nama_polarisasi', '$id_periode', '$tanggal')";
				$input1 = $this->connection->prepare($query1);
				if($input1->execute())
				{
					$query = $this->connection->query("SELECT * FROM mst_polarisasi WHERE nama_polarisasi = '$nama_polarisasi' AND id_periode = '$id_periode'");
					while($tampil = $query->fetch_array())
						$id_polarisasi_baru = $tampil['id_polarisasi'];
					$query = $this->connection->query("SELECT * FROM aturan_polarisasi WHERE id_polarisasi = '$id_polarisasi'");
					while($tampil = $query->fetch_array())
					{
						$bmi  = $tampil['bmi'];
						$bma  = $tampil['bma'];
						$poin = $tampil['poin'];
						
						$query2 = "INSERT INTO aturan_polarisasi VALUES ('', '$id_polarisasi_baru', '$bmi', '$bma', '$poin', '$tanggal')";
						$input2 = $this->connection->prepare($query2);
						if($input2->execute())
							$k[] = 1;
						else 
							$k[] = 0;
					}

					if(in_array(0, $k))
						return 2;
					else 
						header('location:data_polarisasi.php');
				}
				else{
					return 2;
				}
			}
			else if($jenis == 2 || $jenis == '2')
			{
				$id_periode_asli = $id_polarisasi;
				$query = $this->connection->query("SELECT * FROM mst_polarisasi WHERE id_periode = '$id_periode_asli'");
				while($tampil = $query->fetch_array())
				{
					$nama_polarisasi = $tampil['nama_polarisasi'];
					$id_polarisasi_asli = $tampil['id_polarisasi'];

					$queryInput1 = "INSERT INTO mst_polarisasi VALUES ('', '$nama_polarisasi', '$id_periode', '$tanggal')";
					$input1 = $this->connection->prepare($queryInput1);
					if($input1->execute())
					{
						$query2 = $this->connection->query("SELECT * FROM mst_polarisasi WHERE nama_polarisasi = '$nama_polarisasi' AND id_periode = '$id_periode'");
						while($tampil2 = $query2->fetch_array())
							$id_polarisasi_baru = $tampil2['id_polarisasi'];
						$query3 = $this->connection->query("SELECT * FROM aturan_polarisasi WHERE id_polarisasi = '$id_polarisasi_asli'");
						while($tampil3 = $query3->fetch_array())
						{
							$bmi = $tampil3['bmi'];
							$bma = $tampil3['bma'];
							$poin = $tampil3['poin'];

							$queryInput2 = "INSERT INTO aturan_polarisasi VALUES ('', '$id_polarisasi_baru', '$bmi', '$bma', '$poin', '$tanggal')";
							$input2 = $this->connection->prepare($queryInput2);
							if($input2->execute())
								$k[] = 1;
							else 
								$k[] = 0;
						}
					}
				}

				if(in_array(0, $k))
					return 2;
				else 
					header('location:data_polarisasi.php');
			}
		}

		function copy_kompetensi($jenis = null, $id_kompetensi = null, $id_periode = null)
		{
			if($jenis == 1 || $jenis == '1')
			{
				$query1 = $this->connection->query("SELECT * FROM mst_kompetensi WHERE id_kompetensi = '$id_kompetensi'");
				$tampil = $query1->fetch_array();
				$id_kelompok = $tampil['id_kelompok'];
				$nama_kompetensi = $tampil['nama_kompetensi'];
				$indikator_terendah = $tampil['indikator_terendah'];
				$indikator_tertinggi = $tampil['indikator_tertinggi'];
				$bobot = $tampil['bobot'];

				$query2 = "INSERT INTO mst_kompetensi VALUES ('', '$id_periode', '$id_kelompok', '$nama_kompetensi', '$indikator_terendah', '$indikator_tertinggi', '$bobot')";
				$input = $this->connection->prepare($query2);
				if($input->execute())
					header("location:data_kompetensi.php");
				else 
					return 2;
			}
			else if($jenis == 2 || $jenis == '2')
			{
				$query1 = $this->connection->query("SELECT * FROM mst_kompetensi WHERE id_periode = '$id_kompetensi'");
				while($tampil = $query1->fetch_array())
				{
					$id_kelompok = $tampil['id_kelompok'];
					$nama_kompetensi = $tampil['nama_kompetensi'];
					$indikator_terendah = $tampil['indikator_terendah'];
					$indikator_tertinggi = $tampil['indikator_tertinggi'];
					$bobot = $tampil['bobot'];
					$query2 = "INSERT INTO mst_kompetensi VALUES ('', '$id_periode', '$id_kelompok', '$nama_kompetensi', '$indikator_terendah', '$indikator_tertinggi', '$bobot')";
					$input = $this->connection->prepare($query2);
					if($input->execute())
						$a[] = 1;
					else 
						$a[] = 0;
				}

				if(in_array(0, $a))
					return 2;
				else 
					header("location:data_kompetensi.php");
			}
		}

		function copy_peringkat($jenis = null, $id_peringkat = null, $id_periode = null)
		{
			if($jenis == 1 || $jenis == '1')
			{
				$query1 = $this->connection->query("SELECT * FROM mst_peringkat WHERE id_peringkat = '$id_peringkat'");
				$tampil = $query1->fetch_array();
				$peringkat = $tampil['peringkat'];
				$nilai = $tampil['nilai'];

				$query2 = "INSERT INTO mst_peringkat VALUES ('', '$id_periode', '$peringkat', '$nilai')";
				$input = $this->connection->prepare($query2);
				if($input->execute())
					header("location:data_peringkat.php");
				else 
					return 2;
			}
			else if($jenis == 2 || $jenis == '2')
			{
				$query1 = $this->connection->query("SELECT * FROM mst_peringkat WHERE id_periode = '$id_peringkat'");
				while($t = $query1->fetch_array())
				{
					$peringkat = $t['peringkat'];
					$nilai = $t['nilai'];

					$query2 = "INSERT INTO mst_peringkat VALUES ('', '$id_periode', '$peringkat', '$nilai')";
					$input = $this->connection->prepare($query2);
					if($input->execute())
						$a[] = 1;
					else 
						$a[] = 0;
				}

				if(in_array(0, $a))
					return 2;
				else 
					header("location:data_peringkat.php");
			}
		}
		// Akhiran Fungsi Copy Data
	}
?>