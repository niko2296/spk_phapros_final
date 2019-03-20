<?php
	class database{
		function __construct(){
			$this->connection = new mysqli('localhost', 'root', '','phapros');
		}
		
		//Fungsi Untuk Tampil
		function tampil_golongan(){
			$query = $this->connection->query("SELECT * FROM mst_golongan");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		
		function tampil_anggota(){
			$query = $this->connection->query("SELECT ang.*, gol.nama_golongan, jab.nama_jabatan, uni.nama_unit FROM mst_anggota as ang JOIN mst_golongan as gol ON ang.id_golongan = gol.id_golongan JOIN mst_jabatan as jab ON ang.id_jabatan = jab.id_jabatan JOIN mst_unit as uni ON ang.id_unit = uni.id_unit");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		
		function tampil_jabatan(){
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
		function tampil_satuan(){
			$query = $this->connection->query('SELECT * FROM mst_satuan');
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}
		function tampil_kpi(){
			error_reporting(0);
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			$id_jabatan = $_SESSION['id_jabatan'];
			$id_unit = $_SESSION['id_unit'];
			if($id_jabatan != 0)
				$query = $this->connection->query("SELECT * FROM data_kpi WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit'");
			else
				$query = $this->connection->query("SELECT * FROM data_kpi");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_kpi_detail($id_anggota = null, $id_jabatan = null, $id_unit = null){
			error_reporting(0);
			$tahun = date('Y');
			$query = $this->connection->query("SELECT k.*, a.nama, j.nama_jabatan, u.nama_unit FROM data_kpi k JOIN mst_anggota a ON a.id_anggota = k.id_anggota JOIN mst_jabatan j ON j.id_jabatan = k.id_jabatan JOIN mst_unit u ON u.id_unit = k.id_unit WHERE k.id_anggota = '$id_anggota' AND k.id_jabatan = '$id_jabatan' AND k.id_unit = '$id_unit' AND k.tahun = '$tahun'");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
			return $hasil;
		}

		function tampil_kpi_verifikasi(){
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

			$query = $this->connection->query('SELECT d.*, a.nama, j.nama_jabatan, u.nama_unit FROM data_kpi d JOIN mst_anggota a ON d.id_anggota = a.id_anggota JOIN mst_jabatan j ON j.id_jabatan = d.id_jabatan JOIN mst_unit u ON u.id_unit = d.id_unit');
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

		function tampil_polarisasi(){
			$query = $this->connection->query("SELECT * FROM mst_polarisasi");
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
			$query = $this->connection->query("SELECT * FROM akses_menu");
			while($tampil = $query->fetch_array())
				$hasil[] = $tampil;
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
		
		function input_jabatan($nama_jabatan = null, $akses_nilai = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO mst_jabatan VALUES ('', '$nama_jabatan', '$akses_nilai', '$tanggal')";
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
		
		function input_satuan($nama_satuan = null, $jenis_polarisasi = null){
			$tanggal = date('Y-m-d');
			$arrJenis = serialize($jenis_polarisasi);
			$query = "INSERT INTO mst_satuan VALUES ('', '$nama_satuan', '$arrJenis', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else
				return 2;
		}

		function input_kpi($kpi = [], $deskripsi = [], $bobot = [], $sasaran = [], $satuan = [], $sifat_kpi = [], $tahun = 0)
		{
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			$id_jabatan = $_SESSION['id_jabatan'];
			$id_unit = $_SESSION['id_unit'];
			for($a=0; $a<count($kpi); $a++)
			{
				$tanggal_input = date('Y-m-d');
				$query = "INSERT INTO data_kpi VALUES ('', '$id_anggota', '$id_jabatan', '$id_unit', '$tahun','$kpi[$a]', '$deskripsi[$a]', '$bobot[$a]', '$sasaran[$a]', '$satuan[$a]', '$sifat_kpi[$a]', '0', '0', '$tanggal_input', '')";
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

		function input_awal_input($tanggal1 = null, $tanggal2 = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO waktu_input VALUES ('', '$tanggal1', '$tanggal2', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else 
				return 2;
		}

		function input_verifikasi($tanggal1 = null, $tanggal2 = null){
			$tanggal = date('Y-m-d');
			$query = "INSERT INTO waktu_verifikasi VALUES ('', '$tanggal1', '$tanggal2', '$tanggal')";
			$input = $this->connection->prepare($query);
			if($input->execute())
				return 1;
			else 
				return 2;
		}

		function input_polarisasi($nama_polarisasi = null){
			$tgl = date('Y-m-d');
			$query = "INSERT INTO mst_polarisasi VALUES ('', '$nama_polarisasi', '$tgl')";
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
		//Akhiran Fungsi Input

		//Fungsi Edit
		function edit_satuan($id_satuan = null, $nama_satuan = null, $jenis_polarisasi = null){
			if($id_satuan != null)
			{
				$tanggal = date('Y-m-d');
				$arrJenis = serialize($jenis_polarisasi);
				$query = "UPDATE mst_satuan SET nama_satuan = '$nama_satuan', jenis_polarisasi = '$arrJenis', tanggal_input = '$tanggal' WHERE id_satuan = '$id_satuan'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header("location:data_satuan.php");
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

		function edit_jabatan($id_jabatan = null, $nama_jabatan = null, $akses_nilai = null)
		{
			if($id_jabatan != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE mst_jabatan SET nama_jabatan = '$nama_jabatan', akses_nilai = '$akses_nilai', tanggal_input = '$tanggal' WHERE id_jabatan = '$id_jabatan'";
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

		function edit_kpi($id_kpi = null, $kpi = null, $deskripsi = null, $bobot = null, $sasaran = null, $satuan = null, $sifat_kpi = null, $tahun = null)
		{
			$tanggal_input = date('Y-m-d');
			$query = "UPDATE data_kpi SET kpi = '$kpi', status = '0', id_verifikator = '0', tanggal_verifikasi = '0000-00-00', deskripsi = '$deskripsi', bobot = '$bobot', sasaran = '$sasaran', satuan = '$satuan', sifat_kpi = '$sifat_kpi', tahun = '$tahun' WHERE id_kpi = '$id_kpi'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
			{
				return 1;
			}
			else {
				return 2;
			}
		}

		function edit_awal_input($id_awal_input = null, $tanggal1 = null, $tanggal2 = null)
		{
			$query = "UPDATE waktu_input SET tanggal_awal_input = '$tanggal1', tanggal_akhir_input = '$tanggal2' WHERE id_waktu_input = '$id_awal_input'";
			$edit = $this->connection->prepare($query);
			if($edit->execute())
				header("location:waktu_input.php");
			else 
				return 2;
		}

		function edit_verifikasi($id = null, $tanggal1 = null, $tanggal2 = null)
		{
			$query = "UPDATE waktu_verifikasi SET tanggal_awal_verifikasi = '$tanggal1', tanggal_akhir_verifikasi = '$tanggal2' WHERE id_waktu_verifikasi = '$id'";
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

		function edit_polarisasi($id_polarisasi = null, $nama_polarisasi = null)
		{
			if($id_polarisasi != null)
			{
				$tanggal = date('Y-m-d');
				$query = "UPDATE mst_polarisasi SET nama_polarisasi = '$nama_polarisasi', tanggal_input = '$tanggal' WHERE id_polarisasi = '$id_polarisasi'";
				$edit = $this->connection->prepare($query);
				if($edit->execute())
					header("location:data_polarisasi.php");
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
		//Akhiran Fungsi Edit

		//Fungsi Hapus
		function hapus_satuan($id_satuan = null)
		{
			if($id_satuan != null)
			{
				$query = "DELETE FROM mst_satuan WHERE id_satuan = '$id_satuan'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:data_satuan.php");
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

		function hapus_kpi($id_kpi = null)
		{
			if($id_kpi != null)
			{
				$query = "DELETE FROM data_kpi WHERE id_kpi = '$id_kpi'";
				$hapus = $this->connection->prepare($query);
				if($hapus->execute())
					header("location:data_kpi.php");
				else
					return 2;
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

		function hapus_polarisasi($id_polarisasi = null)
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
						header("location:data_polarisasi.php");	
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
		//Akhiran Fungsi Cek Login

		// Fungsi Verifikasi
		function verifikasi($id = 0, $status = 0)
		{
			session_start();
			$id_anggota = $_SESSION['id_anggota'];
			if($status == 1)
				$tanggal = date('Y-m-d');
			else 
				$tanggal = '0000-00-00';
			$query = "UPDATE data_kpi SET status = '$status', tanggal_verifikasi = '$tanggal', id_verifikator = '$id_anggota' WHERE id_kpi = '$id'";
			$verif = $this->connection->prepare($query);
			if($verif->execute())
				return 1;
			else
			{ 
				return 2;
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
					$n[] = 1;
				else 
					$n[] = 0;
			}
			
			if(in_array(0, $n))
				return 'Gagal Memverifikasi';
			else 
				return 1;
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
		function hitung_data_kpi($id_anggota = null, $id_jabatan = null, $id_unit = null)
		{
			$tahun = date('Y');
			$query = $this->connection->query("SELECT * FROM data_kpi WHERE id_anggota = '$id_anggota' AND id_jabatan = '$id_jabatan' AND id_unit = '$id_unit' AND tahun = '$tahun'");
			$jml = 0;
			while($tampil = $query->fetch_array())
				$jml = $jml+1;
			return $jml;
		}
		// Akhiran Menghitung Data
	}
?>