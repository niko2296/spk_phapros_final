<?php
	ob_start();
	include "conn/database.php";
	$db = new database();
    $nama = '';
    $jabatan = '';
	session_start();
	if($_SESSION['login'] == FALSE)
		header("location:login.php");
    $nama = $_SESSION['nama'];
    $jabatan = $_SESSION['id_jabatan'];
    $departemenL = $_SESSION['id_departemen'];
    $unitL = $_SESSION['id_unit'];
    $id_anggota = $_SESSION['id_anggota'];
    $idA = 'kosong';

    foreach($db->tampil_periode() as $tampilP)
    {
        if($tampilP['status'] == 1)
        {
            $tA = $tampilP['tahun'];
            $idA = $tampilP['id_periode'];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png"> -->
        <title>Sistem Penilaian Kinerja</title>
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/line-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="assets/plugins/morris/morris.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->

        <!-- <style type="text/css">
            th, td {
                font-family: "Arial";
                font-size: 10px;
                padding: 5px;
                text-align: left;    
            }
        </style> -->
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index.php" class="logo">
						<img src="assets/img/logo.png" width="75" height="" alt="">
					</a>
                </div>
				<a id="toggle_btn" href="javascript:void(0);"><i class="la la-bars"></i></a>
                <div class="page-title-box pull-left">
					<h3>Sistem Penilaian Kinerja</h3>
                </div>
				<a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<ul class="nav navbar-nav navbar-right user-menu pull-right">
					<li class="dropdown">
						<a href="" class="dropdown-toggle user-link" data-toggle="dropdown" title="Admin">
							<!-- <span class="user-img"><img class="img-circle" src="assets/img/user.jpg" width="40" alt="Admin"> -->
							<span>
								<?php echo $nama; ?>
							</span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu">
							<!-- <li><a href="profile.html">My Profile</a></li>
							<li><a href="edit-profile.html">Edit Profile</a></li> -->
							<?php
								if($jabatan != 0)
									echo '<li><a href="settings.php">Settings</a></li>';
							?>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
            </div>
            <div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class=""> 
								<a href="index.php"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
							</li>
                            <?php 
                                $m1 = 0;
                                $m2 = 0;
                                $m3 = 0;
                                $m4 = 0;
                                $m5 = 0;
                                $m6 = 0;
								$m7 = 0;
								error_reporting(0);
                                foreach($db->tampil_akses() as $tampil)
                                {
                                    if($tampil['id_jabatan'] == $jabatan)
                                    {
                                        $m1 = $tampil['menu1'];
                                        $m2 = $tampil['menu2'];
                                        $m3 = $tampil['menu3'];
                                        $m4 = $tampil['menu4'];
                                        $m5 = $tampil['menu5'];
                                        $m6 = $tampil['menu6'];
                                        $m7 = $tampil['menu7'];
                                    }
                                }
                                if($m1 == 1 || $_SESSION['aksus'] == TRUE)
                                {
                            ?>
                                    <li class="submenu">
                                        <a href="#"><i class="la la-briefcase"></i> <span> Master Data</span> <span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
											<li><a href="data_golongan.php">Golongan</a></li>
                                            <li><a href="data_jabatan.php">Jabatan</a></li>
											<li><a href="data_kelompok.php">Kelompok Jabatan</a></li>
                                            <li><a href="data_departemen.php">Departemen</a></li>
                                            <li><a href="data_unit.php">Unit</a></li>
                                            <li><a href="data_anggota.php">Pegawai</a></li>
                                            <li><a href="data_user.php">User</a></li>
                                            <li><a href="data_periode.php">Periode</a></li>
                                            <li><a href="data_polarisasi.php">Polarisasi</a></li>
                                            <li><a href="data_satuan.php">Satuan</a></li>
                                            <li><a href="data_kompetensi.php">Kompetensi</a></li>
                                            <li><a href="data_kompetensi_khusus.php">Kompetensi Khusus</a></li>
                                            <li><a href="data_peringkat.php">Peringkat Kompetensi</a></li>
											<li><a href="persentase_nilai.php">Persentase Nilai</a></li>
											<li><a href="kriteria_nilai.php">Kriteria Nilai</a></li>
                                        </ul>
                                    </li>
                            <?php
                                }
                                if($_SESSION['aksus'] == TRUE)
								{
							?>
									<li class=""> 
										<a href="data_mutasi.php"><i class="la la-exchange"></i> <span>Mutasi</span></a>
									</li>
							<?php
								}
                                if($m2 == 1 || $_SESSION['aksus'] == TRUE)
                                {
                            ?>
                                    <li class=""> 
                                        <a href="aturan_penilai.php"><i class="la la-key"></i> <span>Aturan Penilai</span></a>
                                    </li>
									<li class=""> 
                                        <a href="aturan_matriks.php"><i class="la la-th"></i> <span>Perhitungan Matriks</span></a>
                                    </li>
                            <?php
                                }
                                if($m3 == 1 || $_SESSION['aksus'] == TRUE)
                                {
                            ?>
                            <li class="submenu">
								<a href="#"><i class="la la-calendar"></i> <span> Aturan Waktu</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="waktu_input.php">Waktu Input</a></li>
                                    <li><a href="waktu_verifikasi.php">Waktu Verifikasi</a></li>
                                </ul>
							</li>
                            <?php
                                }
                                if($m4 == 1 || $_SESSION['aksus'] == TRUE)
                                {
                            ?>
                            <li class=""> 
								<a href="akses_menu.php"><i class="la la-cog"></i> <span>Akses Menu</span></a>
							</li>
                            <?php
                                }
                            ?>
                            <li class="submenu">
								<a href="#"><i class="la la-clipboard"></i> <span> KPI</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
                                    <?php
										$eksekusi1 = $db->cek_akses(1, $jabatan, $departemenL, $unitL);
                                        if($eksekusi1 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                    ?>
											<li><a href="data_kpi.php">Data KPI Individu</a></li>
                                            <li><a href="data_kpi_mutasi.php">Data KPI Individu (Mutasi)</a></li>
											<li><a href="copy_kpi.php">Copy Data KPI Individu</a></li>
                                    <?php 
										}
										$eksekusi2 = $db->cek_akses(2, $jabatan, $departemenL, $unitL);
                                        if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                    ?>
                                    		<li><a href="data_kpi_verifikasi.php">Data KPI Sub Ordinat</a></li>
                                    		<li><a href="data_kpi_verifikasi_mutasi.php">Data KPI Sub Ordinat (Mutasi)</a></li>
                                    <?php
										}
										if($m7 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                            echo '<li><a href="data_kpi_seluruh.php">Data KPI Keseluruhan</a></li>';
                                        }
                                    ?>
                                </ul>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-tasks"></i> <span> Kompetensi</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<?php
										if($eksekusi1 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
											echo '<li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>';
											echo '<li><a href="kompetensi_individu_mutasi.php">Data Kompetensi Individu (Mutasi)</a></li>';
                                        }
                                        if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                            if($db->cek_matriks($departemenL) <= 0 || $_SESSION['aksus'] == TRUE)
                                            {
                                                echo '<li><a href="kompetensi_sub.php">Data Kompetensi Sub Ordinat</a></li>';
                                                echo '<li><a href="kompetensi_sub_mutasi.php">Data Kompetensi Sub Ordinat (Mutasi)</a></li>';
                                            }
                                        }
                                        if($_SESSION['aksus'] == TRUE || $db->cek_matriks($departemenL) > 0)
                                        {
                                            echo '<li><a href="kompetensi_matriks.php">Data Kompetensi Matriks</a></li>';
                                            echo '<li><a href="kompetensi_matriks_mutasi.php">Data Kompetensi Matriks (Mutasi)</a></li>';
                                        }
									?>
                                </ul>
							</li>
                            <li class="active submenu">
                                <a href="#"><i class="la la-sticky-note-o"></i> <span> Laporan</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="laporan_individu.php">Penilaian Individu</a></li>
                                    <li><a href="laporan_sub_ordinat.php">Penilaian Sub Ordinat</a></li>
                                </ul>
							</li>
							<li class=""> 
								<a href="hasil_akhir.php"><i class="la la-edit"></i> <span>Hasil Akhir</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row" style="margin-bottom:2%;">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-info" onclick="cetak()">
                                    <i class="fa fa-print"></i> 
                                    Print Data
                            </button>
                        </div>
                    </div>
                    <div id="printArea" style="background-color:white; padding:15px; border:1;">
                        <div class="row" style="page-break-inside: avoid;">
                            <div class="col-md-12">
                                <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                    <tr>
                                        <td style="padding:5px;" colspan="2">
                                            <table width="100%">
                                                <tr>
                                                    <td style="padding:10px; font-family: Arial; font-family: Arial; font-size:12px;">
                                                        <b>FORMULIR KERJA</b>
                                                        <br>
                                                        Document # : HR-FM-G3.04.001.05
                                                        <br><br>
                                                        <table style="border: 1px solid black; border-collapse: collapse;" border="1">
                                                            <tr>
                                                                <td style="padding:10px; font-family: Arial; font-size:12px;"><b><h7>LEVEL ADMINISTRASI</h7></b></td>
                                                            </tr></div>
                                                        </table>
                                                    </td>
                                                    <td><div align="right">
                                                        <table style="border: 1px solid black; border-collapse: collapse;" border="1">
                                                            <tr>
                                                                <td style="padding:10px; font-family: Arial; font-size:12px;"><b><h7>BERSIFAT PRIBADI DAN RAHASIA</h7></b></td>
                                                            </tr></div>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="30%"><center><img src="assets/img/logo.png" height="60" ></center></th>
                                        <th width="70%" style="font-family: Arial;"><center><br><h1><b>PENILAIAN KINERJA <br> PT PHAPROS</b></h1></center></th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding:5px; font-family: Arial; font-size:12px;"><center><b>Periode Penilaian Januari tahun <?php echo $tA; ?> sampai dengan Desember tahun <?php echo $tA; ?></b></center></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <?php
                            foreach($db->tampil_anggota($id_anggota) as $tampil)
                            {
                                $nama_pegawai = $tampil['nama'];
                                $jk_pegawai = $tampil['jenis_kelamin'];
                                $golongan_pegawai = $tampil['nama_golongan'];
                            }

                            $pNil = 0; 
                            $aJ = [];
                            $aD = [];
                            $aU = [];
                            $aN = [];
                            foreach($db->tampil_jabatan_anggota($id_anggota, $idA) as $penting)
                            {
                                $pNil = $pNil+1;
                                $id_jabatanD = $penting['id_jabatan_lama'];
                                $id_departemenD = $penting['id_departemen_lama'];
                                $id_unitD = $penting['id_unit_lama'];

                                $aJ[] = $id_jabatanD;
                                $aD[] = $id_departemenD;
                                $aU[] = $id_unitD;

                                if($pNil == 1)
                                    $kNil = 'PERTAMA';
                                else if($pNil == 2)
                                    $kNil = 'KEDUA';
                                else if($pNil == 3)
                                    $kNil = 'KETIGA';
                                else if($pNil == 4)
                                    $kNil = 'KEEMPAT';
                                else if($pNil == 5)
                                    $kNil = 'KELIMA';

                                echo '<h4 style="font-family: Arial;"><center><b>- PENILAIAN '.$kNil.' -</b></center></h4>';
                        ?>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="5" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>IDENTITAS PEGAWAI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>NAMA PEGAWAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>GOLONGAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>JABATAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>DEPARTEMEN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>UNIT</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $nama_pegawai; ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $golongan_pegawai; ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $db->tampil_jabatan_detail($id_jabatanD, 1); ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $db->tampil_jabatan_detail($id_departemenD, 2); ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $db->tampil_jabatan_detail($id_unitD, 3); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="5" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>IDENTITAS PENILAI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>NAMA</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>GOLONGAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>JABATAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>DEPARTEMEN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>UNIT</center></b></td>
                                            </tr>
                                            <?php
                                                $c = 0;
                                                foreach($db->tampil_penilai_kpi_satuan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $tampil)
                                                {
                                                    foreach($db->tampil_anggota_detail($tampil['id_verifikator'], $tampil['id_jabatan_verifikator'], $tampil['id_departemen_verifikator'], $tampil['id_unit_verifikator']) as $tampil2)
                                                        echo '<tr>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_golongan'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_jabatan'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_departemen'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_unit'].'</td>
                                                                </tr>';
                                                    $c = $c+1;
                                                }

                                                if($c == 0)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td colspan="5" align="center" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="9" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>DATA KPI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="15%"><b><center>KPI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="15%"><b><center>DESKRIPSI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>% BOBOT</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SASARAN / TARGET</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SATUAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SIFAT KPI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>REALISASI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SKOR</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>NILAI</center></b></td>
                                            </tr>
                                            <?php
                                                $c = 0;
                                                $tNil = 0;
                                                $tBot = 0;
                                                foreach($db->tampil_kpi($idA, $id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, 1) as $tampil)
                                                {
                                                    $bobot = $tampil['bobot'];
                                                    $sasaran = $tampil['sasaran'];
                                                    $realisasi = 0;
                                                    $keterangan = null;
                                                    $skor = 0;
                                                    $poin = 0;
                                                    if($db->hitung_perubahan_usulan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                                    {
                                                        foreach($db->cek_perubahan($tampil['id_kpi']) as $tc)
                                                        {
                                                            if($tc['bobot'] != '' && $tc['sasaran'] != '')
                                                            {
                                                                $bobot = $tc['bobot'];
                                                                $sasaran = $tc['sasaran'];
                                                            }
                                                        }
                                                    }

                                                    if($db->hitung_realisasi($tampil['id_kpi']) > 0)
                                                    {
                                                        if($db->hitung_perubahan_realisasi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $tampil['id_kpi']) > 0)
                                                        {
                                                            foreach($db->cek_perubahan2($tampil['id_kpi']) as $tc)
                                                            {
                                                                if($tc['realisasi'] != '' && $tc['keterangan'] != '')
                                                                {
                                                                    $realisasi = $tc['realisasi'];
                                                                    $keterangan = $tc['keterangan'];
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            $realisasi =  $db->tampil_realisasi(1, $tampil['id_kpi']);
                                                            $keterangan = $db->tampil_realisasi(2, $tampil['id_kpi']);
                                                        }
                                                    }

                                                    $nilai = 0;
                                                    if($tampil['rumus'] == 1)
                                                    {
                                                        $skor = ($realisasi/$sasaran)*100;
                                                    }
                                                    else if($tampil['rumus'] == 2)
                                                    {
                                                        $skor = $realisasi-$sasaran;
                                                    }
                                                    else if($tampil['rumus'] == 3)
                                                    {
                                                        $skor = $realisasi;
                                                    }

                                                    foreach($db->tampil_aturan_polarisasi($tampil['sifat_kpi']) as $tP)
                                                    {
                                                        if($tP['bmi'] != 0 AND $tP['bma'] == 0)
                                                        {   
                                                            if($skor >= $tP['bmi'])
                                                            {
                                                                $poin = $tP['poin'];
                                                            }
                                                        }
                                                        else if($tP['bmi'] == 0 AND $tP['bma'] != 0)
                                                        {
                                                            if($skor <= $tP['bmi'])
                                                            {
                                                                $poin = $tP['poin'];
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if($skor >= $tP['bmi'] AND $skor <= $tP['bma'])
                                                            {
                                                                $poin = $tP['poin'];
                                                            }
                                                        }
                                                    }
                                                    $nilai = ($bobot*$poin)/100;
                                                    $tNil = $tNil+$nilai;
                                                    $tBot = $tBot+$bobot;
                                                    echo '<tr>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['kpi'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['deskripsi'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$bobot.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$sasaran.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['nama_satuan'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['nama_polarisasi'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$realisasi.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$poin.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$nilai.'</td>
                                                            </tr>';
                                                    $c = $c+1;
                                                }

                                                if($c == 0)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td colspan="5" align="center" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                        </tr>
                                                    ';
                                                }

                                                echo '
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;" colspan="2"><b><center>TOTAL NILAI KPI</center></b></td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>'.$tBot.'</center></b></td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;" colspan="5"><b><center></center></b></td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>'.$tNil.'</center></b></td>
                                                ';
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="9" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>DATA KOMPETENSI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>INDIKATOR TERENDAH</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>PERINGKAT DAN NAMA KOMPETENSI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>INDIKATOR TERTINGGI</center></b></td>
                                            </tr>
                                            <?php
                                                $c = 0;
                                                foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $data)
                                                {
                                                    foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data['jenis'], $data['id_kompetensi_individu']) as $data2)
                                                    {
                                                        if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 0)
                                                        {
                                                            $id_peringkat = $data2['id_peringkat'];
                                                            if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                            {    
                                                                $id_peringkat = $db->cek_perubahan3($data2['id_kompetensi_individu']);
                                                            }

                                                            foreach($db->tampil_peringkat($idA) as $tampilP)
                                                            {
                                                                if($tampilP['id_peringkat'] == $id_peringkat)
                                                                    $peringkat = $tampilP['peringkat'];
                                                            }
                                                        }
                                                        echo '
                                                            <tr>
                                                                <td colspan="3" style="font-family: Arial; font-size:12px;"><center>'.$data2['nama_kompetensi'].'</center></td>
                                                            </tr>
                                                        ';
                                                        echo '<tr>
                                                                    <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;">'.$data2['indikator_terendah'].'</td>
                                                                    <td style="padding:5px; text-align:center; font-family: Arial; font-size:12px;">';
                                                                    if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 1)
                                                                    {
                                                                        echo '
                                                                            <table style="width:100%; border: 1px solid black; border-collapse: collapse;" border="1">
                                                                                <tr>';
                                                                                $p = 0;
                                                                                if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                                                {   
                                                                                    foreach($db->tampil_perubahan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $tabel)
                                                                                    {
                                                                                        $p = $p+1;
                                                                                        echo '<td>P'.$p.'</td>';
                                                                                    }
                                                                                }
                                                                        echo '
                                                                                </tr>
                                                                                <tr>
                                                                        ';
                                                                                if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                                                {   
                                                                                    foreach($db->tampil_perubahan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $tabel)
                                                                                    {
                                                                                        if($data2['id_kompetensi_individu'] == $tabel['id_kompetensi_asli'] AND $db->cek_laporan_kompetensi($tabel['id_kompetensi_asli'], $tA, $id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $tabel['id_anggota_perubahan'], $tabel['id_jabatan_perubahan'], $tabel['id_departemen_perubahan'], $tabel['id_unit_perubahan']) != 0)
                                                                                            echo '<td>'.$tabel['peringkat'].'</td>';
                                                                                        else 
                                                                                            echo '<td>-</td>';
                                                                                    }
                                                                                }
                                                                        echo '
                                                                                </tr>
                                                                            </table>
                                                                        ';
                                                                    }
                                                                    else if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 0)
                                                                    {
                                                                        echo $peringkat;
                                                                    }
                                                        echo '
                                                                    </td>
                                                                    <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;">'.$data2['indikator_tertinggi'].'</td>
                                                                </tr>';
                                                        $c = $c+1;
                                                    }
                                                }
                                                if($c == 0)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td colspan="3" align="center" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:50%; padding:5px; vertical-align:top;">
                                                    <!-- Kiri -->
                                                    <table width="100%" style="border: 1px solid black; border-collapse: collapse; margin-top:auto;" border="1">
                                                        <tr>
                                                            <td colspan="4" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>PERHITUNGAN NILAI KOMPETENSI</center></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>DIMENSI KOMPETENSI</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>% BOBOT</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>SKOR</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>NILAI</center></b></td>
                                                        </tr>
                                                        <?php
                                                            $c = 0;
                                                            $tNil2 = 0;
                                                            if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 0)
                                                            {
                                                                foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $data)
                                                                {
                                                                    if($data['status'] == 1)
                                                                    {
                                                                        $nPer = 0;
                                                                        $peringkat = 0;
                                                                        $id_peringkat = 0;
                                                                        foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data['jenis'], $data['id_kompetensi_individu']) as $data2)
                                                                        {
                                                                            $peringkat = $data2['peringkat'];
                                                                            $nPer = $data2['nilai'];
                                                                            $nilai2 = 0;
                                                                            $id_peringkat = $data2['id_peringkat'];
                                                                            if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                                                $id_peringkat = $db->cek_perubahan3($data2['id_kompetensi_individu']);
                                                                            
                                                                            foreach($db->tampil_peringkat($idA, $id_peringkat) as $tPer)
                                                                            {
                                                                                $peringkat = $tPer['peringkat'];
                                                                                $nPer = $tPer['nilai'];
                                                                            }
                                                                            $nilai2 = ($data2['bobot']*$nPer)/100;
                                                                            $tNil2 = $tNil2+$nilai2;
                                                                            echo '
                                                                                <tr>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;">'.$data2['nama_kompetensi'].'</td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data2['bobot'].'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nPer.'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nilai2.'</center></td>
                                                                                </tr>
                                                                            ';
                                                                            $c = $c+1;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $jml_penilai = $db->jumlah_penilai($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA);
                                                                $pembagian = 100/$jml_penilai;
                                                                $tot3 = [];
                                                                foreach($db->perhitungan_kompetensi_matriks1($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $data)
                                                                {
                                                                    $c = $c+1;
                                                                    $tot1 = 0;
                                                                    $tot2 = 0;
                                                                    echo '
                                                                        <tr>
                                                                            <td colspan="4" style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>Penilai '.$c.'</b></td>
                                                                        </tr>
                                                                    ';
                                                                    foreach($db->perhitungan_kompetensi_matriks2($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data['id_verifikator'], $data['id_jabatan_verifikator'], $data['id_departemen_verifikator'], $data['id_unit_verifikator']) as $data2)
                                                                    {
                                                                        $nilai = $db->perubahan_kompetensi($data2['id_kompetensi_individu'], $data2['id_anggota'], $data2['id_jabatan'], $data2['id_departemen'], $data2['id_unit'], $data2['id_verifikator'], $data2['id_jabatan_verifikator'], $data2['id_departemen_verifikator'], $data2['id_unit_verifikator'], $idA);
                                                                        $nilai2 = ($nilai*$data['bobot'])/100;
                                                                        $tot1 = $tot1+$nilai2;
                                                                        echo '
                                                                                <tr>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;">'.$data2['nama_kompetensi'].'</td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data['bobot'].'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nilai.'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nilai2.'</center></td>
                                                                                </tr>
                                                                            ';
                                                                    }
                                                                    echo '
                                                                        <tr>
                                                                            <td colspan="3" style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>Total Nilai</b></td>
                                                                            <td style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>'.$tot1.'</b></td>
                                                                        </tr>';
                                                                        $tot2 = ($tot1*$pembagian)/100;
                                                                        $tot3[] = $tot2; 
                                                                    echo '
                                                                        <tr>
                                                                            <td colspan="3" style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>Total Nilai x '.$pembagian.'%</b></td>
                                                                            <td style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>'.$tot2.'</b></td>
                                                                        </tr>
                                                                    ';
                                                                }
                                                                $tNil2 = array_sum($tot3);
                                                            }
                                                            if($c == 0)
                                                            {
                                                                echo '
                                                                    <tr>
                                                                        <td colspan="4" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                                    </tr>
                                                                ';
                                                            }

                                                            echo '
                                                                <tr>
                                                                    <td colspan="3" style="text-align:center; font-family: Arial; font-size:12px; padding:5px;"><b>Total Nilai Kompetensi</b></td>
                                                                    <td style="text-align:center; font-family: Arial; font-size:12px; padding:5px;"><b>'.$tNil2.'</b></td>
                                                                </tr>
                                                            ';
                                                        ?>
                                                    </table>
                                                    <!-- Akhiran Kiri -->
                                                </td>
                                                <td style="width:50%; padding:5px; vertical-align:top;">
                                                    <!-- Kanan -->
                                                    <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                                        <tr>
                                                            <td colspan="2" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>TABEL KONVERSI SKOR KOMPETENSI</center></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>PERINGKAT KOMPETENSI</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>SKOR</center></b></td>
                                                        </tr>
                                                        <?php
                                                            $c = 0;
                                                            foreach($db->tampil_peringkat($idA) as $data)
                                                            {
                                                                echo '
                                                                    <tr>
                                                                        <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data['peringkat'].'</center></td>
                                                                        <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data['nilai'].'</center></td>
                                                                    </tr>
                                                                ';
                                                                $c = $c+1;
                                                            }
                                                            if($c == 0)
                                                            {
                                                                echo '
                                                                    <tr>
                                                                        <td colspan="2" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                                    </tr>
                                                                ';
                                                            }
                                                        ?>
                                                    </table>
                                                    <!-- Akhiran Kanan -->
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="4" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>PERHITUNGAN TOTAL NILAI KINERJA</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>KOMPONEN PENILAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>TOTAL NILAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>BOBOT</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>NILAI KINERJA</center></b></td>
                                            </tr>
                                            <?php
                                                $gTot = 0;
                                                foreach($db->tampil_persentase($idA) as $tampil)
                                                {
                                                    $p_kpi = $tampil['persentase_kpi'];
                                                    $p_kompetensi = $tampil['persentase_kompetensi'];
                                                }

                                                $na_kpi = ($p_kpi*$tNil)/100;
                                                $na_kompetensi = ($p_kompetensi*$tNil2)/100;
                                                $gTot = $na_kpi+$na_kompetensi;

                                                $kn = '';
                                                foreach($db->tampil_kriteria($idA) as $tampil)
                                                {
                                                    if($tampil['batas_minimum'] != 0 AND $tampil['batas_maksimum'] == 0)
                                                    {
                                                        if($gTot >= $tampil['batas_minimum'])
                                                            $kn = $tampil['kriteria_nilai'];
                                                    }
                                                    else if($tampil['batas_minimum'] == 0 AND $tampil['batas_maksimum'] != 0)
                                                    {
                                                        if($gTot <= $tampil['batas_maksimum'])
                                                            $kn = $tampil['kriteria_nilai'];
                                                    }
                                                    else {
                                                        if($gTot >= $tampil['batas_minimum'] AND $gTot <= $tampil['batas_maksimum'])
                                                            $kn = $tampil['kriteria_nilai'];
                                                    }
                                                }
                                                echo '
                                                    <tr>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;">KPI</td>
                                                        <td style="padding:5px; text-align:center; font-family: Arial; font-size:12px;">'.$tNil.'</td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;"><center>'.$p_kpi.' %</center></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;">'.$na_kpi.'</td>
                                                    </tr>
                                                ';
                                                echo '
                                                    <tr>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;">Kompetensi</td>
                                                        <td style="padding:5px; text-align:center; font-family: Arial; font-size:12px;">'.$tNil2.'</td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;"><center>'.$p_kompetensi.' %</center></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;">'.$na_kompetensi.'</td>
                                                    </tr>
                                                ';
                                                echo '
                                                    <tr>
                                                        <td colspan="3" style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;"><b>Total Nilai Kinerja</b></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;"><b>'.$gTot.'</b></td>
                                                    </tr>
                                                ';
                                                echo '
                                                    <tr>
                                                        <td colspan="3" style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;"><b>Kriteria Nilai</b></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;"><b>'.$kn.'</b></td>
                                                    </tr>
                                                ';
                                                $aN[] = $gTot;
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="2" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>KETERANGAN KRITERIA NILAI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>KRITERIA NILAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="60%"><b><center>KETERANGAN</center></b></td>
                                            </tr>
                                            <?php
                                                foreach($db->tampil_kriteria($idA) as $tampil)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['kriteria_nilai'].'</td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['keterangan'].'</td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }

                            $id_jabatanD = $jabatan;
                            $id_departemenD = $departemenL;
                            $id_unitD = $unitL;

                            if($id_jabatanD != null)
                            {
                                $aJ[] = $id_jabatanD;
                                $aD[] = $id_departemenD;
                                $aU[] = $id_unitD;
                                $pNil = $pNil+1;
                                if($pNil == 1)
                                    $kNil = 'PERTAMA';
                                else if($pNil == 2)
                                    $kNil = 'KEDUA';
                                else if($pNil == 3)
                                    $kNil = 'KETIGA';
                                else if($pNil == 4)
                                    $kNil = 'KEEMPAT';
                                else if($pNil == 5)
                                    $kNil = 'KELIMA';
                                
                                echo '<br>';
                                echo '<h4 style="font-family: Arial;"><center><b>- PENILAIAN '.$kNil.' -</b></center></h4>';
                        ?>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="5" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>IDENTITAS PEGAWAI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>NAMA PEGAWAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>GOLONGAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>JABATAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>DEPARTEMEN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>UNIT</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $nama_pegawai; ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $golongan_pegawai; ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $db->tampil_jabatan_detail($id_jabatanD, 1); ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $db->tampil_jabatan_detail($id_departemenD, 2); ?></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;"><?php echo $db->tampil_jabatan_detail($id_unitD, 3); ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="5" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>IDENTITAS PENILAI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>NAMA</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>GOLONGAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>JABATAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>DEPARTEMEN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>UNIT</center></b></td>
                                            </tr>
                                            <?php
                                                $c = 0;
                                                foreach($db->tampil_penilai_kpi_satuan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $tampil)
                                                {
                                                    foreach($db->tampil_anggota_detail($tampil['id_verifikator'], $tampil['id_jabatan_verifikator'], $tampil['id_departemen_verifikator'], $tampil['id_unit_verifikator']) as $tampil2)
                                                        echo '<tr>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_golongan'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_jabatan'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_departemen'].'</td>
                                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil2['nama_unit'].'</td>
                                                                </tr>';
                                                    $c = $c+1;
                                                }

                                                if($c == 0)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td colspan="5" align="center" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="9" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>DATA KPI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="15%"><b><center>KPI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="15%"><b><center>DESKRIPSI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>% BOBOT</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SASARAN / TARGET</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SATUAN</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SIFAT KPI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>REALISASI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>SKOR</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>NILAI</center></b></td>
                                            </tr>
                                            <?php
                                                $c = 0;
                                                $tNil = 0;
                                                $tBot = 0;
                                                foreach($db->tampil_kpi($idA, $id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, 1) as $tampil)
                                                {
                                                    $bobot = $tampil['bobot'];
                                                    $sasaran = $tampil['sasaran'];
                                                    $realisasi = 0;
                                                    $keterangan = null;
                                                    $skor = 0;
                                                    $poin = 0;
                                                    if($db->hitung_perubahan_usulan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                                    {
                                                        foreach($db->cek_perubahan($tampil['id_kpi']) as $tc)
                                                        {
                                                            if($tc['bobot'] != '' && $tc['sasaran'] != '')
                                                            {
                                                                $bobot = $tc['bobot'];
                                                                $sasaran = $tc['sasaran'];
                                                            }
                                                        }
                                                    }

                                                    if($db->hitung_realisasi($tampil['id_kpi']) > 0)
                                                    {
                                                        if($db->hitung_perubahan_realisasi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $tampil['id_kpi']) > 0)
                                                        {
                                                            foreach($db->cek_perubahan2($tampil['id_kpi']) as $tc)
                                                            {
                                                                if($tc['realisasi'] != '' && $tc['keterangan'] != '')
                                                                {
                                                                    $realisasi = $tc['realisasi'];
                                                                    $keterangan = $tc['keterangan'];
                                                                }
                                                            }
                                                        }
                                                        else{
                                                            $realisasi =  $db->tampil_realisasi(1, $tampil['id_kpi']);
                                                            $keterangan = $db->tampil_realisasi(2, $tampil['id_kpi']);
                                                        }
                                                    }

                                                    $nilai = 0;
                                                    if($tampil['rumus'] == 1)
                                                    {
                                                        $skor = ($realisasi/$sasaran)*100;
                                                    }
                                                    else if($tampil['rumus'] == 2)
                                                    {
                                                        $skor = $realisasi-$sasaran;
                                                    }
                                                    else if($tampil['rumus'] == 3)
                                                    {
                                                        $skor = $realisasi;
                                                    }

                                                    foreach($db->tampil_aturan_polarisasi($tampil['sifat_kpi']) as $tP)
                                                    {
                                                        if($tP['bmi'] != 0 AND $tP['bma'] == 0)
                                                        {   
                                                            if($skor >= $tP['bmi'])
                                                            {
                                                                $poin = $tP['poin'];
                                                            }
                                                        }
                                                        else if($tP['bmi'] == 0 AND $tP['bma'] != 0)
                                                        {
                                                            if($skor <= $tP['bmi'])
                                                            {
                                                                $poin = $tP['poin'];
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if($skor >= $tP['bmi'] AND $skor <= $tP['bma'])
                                                            {
                                                                $poin = $tP['poin'];
                                                            }
                                                        }
                                                    }
                                                    $nilai = ($bobot*$poin)/100;
                                                    $tNil = $tNil+$nilai;
                                                    $tBot = $tBot+$bobot;
                                                    echo '<tr>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['kpi'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['deskripsi'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$bobot.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$sasaran.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['nama_satuan'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['nama_polarisasi'].'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$realisasi.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$poin.'</td>
                                                                <td style="padding:5px; font-family: Arial; font-size:12px;">'.$nilai.'</td>
                                                            </tr>';
                                                    $c = $c+1;
                                                }

                                                if($c == 0)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td colspan="5" align="center" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                        </tr>
                                                    ';
                                                }

                                                echo '
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;" colspan="2"><b><center>TOTAL NILAI KPI</center></b></td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>'.$tBot.'</center></b></td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;" colspan="5"><b><center></center></b></td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;"><b><center>'.$tNil.'</center></b></td>
                                                ';
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="9" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>DATA KOMPETENSI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>INDIKATOR TERENDAH</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>PERINGKAT DAN NAMA KOMPETENSI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>INDIKATOR TERTINGGI</center></b></td>
                                            </tr>
                                            <?php
                                                $c = 0;
                                                foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $data)
                                                {
                                                    foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data['jenis'], $data['id_kompetensi_individu']) as $data2)
                                                    {
                                                        if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 0)
                                                        {
                                                            $id_peringkat = $data2['id_peringkat'];
                                                            if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                            {    
                                                                $id_peringkat = $db->cek_perubahan3($data2['id_kompetensi_individu']);
                                                            }

                                                            foreach($db->tampil_peringkat($idA) as $tampilP)
                                                            {
                                                                if($tampilP['id_peringkat'] == $id_peringkat)
                                                                    $peringkat = $tampilP['peringkat'];
                                                            }
                                                        }
                                                        echo '
                                                            <tr>
                                                                <td colspan="3" style="font-family: Arial; font-size:12px;"><center>'.$data2['nama_kompetensi'].'</center></td>
                                                            </tr>
                                                        ';
                                                        echo '<tr>
                                                                    <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;">'.$data2['indikator_terendah'].'</td>
                                                                    <td style="padding:5px; text-align:center; font-family: Arial; font-size:12px;">';
                                                                    if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 1)
                                                                    {
                                                                        echo '
                                                                            <table style="width:100%; border: 1px solid black; border-collapse: collapse;" border="1">
                                                                                <tr>';
                                                                                $p = 0;
                                                                                if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                                                {   
                                                                                    foreach($db->tampil_perubahan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $tabel)
                                                                                    {
                                                                                        $p = $p+1;
                                                                                        echo '<td>P'.$p.'</td>';
                                                                                    }
                                                                                }
                                                                        echo '
                                                                                </tr>
                                                                                <tr>
                                                                        ';
                                                                                if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                                                {   
                                                                                    foreach($db->tampil_perubahan($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $tabel)
                                                                                    {
                                                                                        if($data2['id_kompetensi_individu'] == $tabel['id_kompetensi_asli'] AND $db->cek_laporan_kompetensi($tabel['id_kompetensi_asli'], $tA, $id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $tabel['id_anggota_perubahan'], $tabel['id_jabatan_perubahan'], $tabel['id_departemen_perubahan'], $tabel['id_unit_perubahan']) != 0)
                                                                                            echo '<td>'.$tabel['peringkat'].'</td>';
                                                                                        else 
                                                                                            echo '<td>-</td>';
                                                                                    }
                                                                                }
                                                                        echo '
                                                                                </tr>
                                                                            </table>
                                                                        ';
                                                                    }
                                                                    else if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 0)
                                                                    {
                                                                        echo $peringkat;
                                                                    }
                                                        echo '
                                                                    </td>
                                                                    <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;">'.$data2['indikator_tertinggi'].'</td>
                                                                </tr>';
                                                        $c = $c+1;
                                                    }
                                                }
                                                if($c == 0)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td colspan="3" align="center" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table style="width:100%;">
                                            <tr>
                                                <td style="width:50%; padding:5px; vertical-align:top;">
                                                    <!-- Kiri -->
                                                    <table width="100%" style="border: 1px solid black; border-collapse: collapse; margin-top:auto;" border="1">
                                                        <tr>
                                                            <td colspan="4" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>PERHITUNGAN NILAI KOMPETENSI</center></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>DIMENSI KOMPETENSI</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>% BOBOT</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>SKOR</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>NILAI</center></b></td>
                                                        </tr>
                                                        <?php
                                                            $c = 0;
                                                            $tNil2 = 0;
                                                            if($db->cek_laporan_matriks($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) == 0)
                                                            {
                                                                foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $data)
                                                                {
                                                                    if($data['status'] == 1)
                                                                    {
                                                                        $nPer = 0;
                                                                        $peringkat = 0;
                                                                        $id_peringkat = 0;
                                                                        foreach($db->tampil_kompetensi_individu($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data['jenis'], $data['id_kompetensi_individu']) as $data2)
                                                                        {
                                                                            $peringkat = $data2['peringkat'];
                                                                            $nPer = $data2['nilai'];
                                                                            $nilai2 = 0;
                                                                            $id_peringkat = $data2['id_peringkat'];
                                                                            if($db->hitung_perubahan_kompetensi($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu']) > 0)
                                                                                $id_peringkat = $db->cek_perubahan3($data2['id_kompetensi_individu']);
                                                                            
                                                                            foreach($db->tampil_peringkat($idA, $id_peringkat) as $tPer)
                                                                            {
                                                                                $peringkat = $tPer['peringkat'];
                                                                                $nPer = $tPer['nilai'];
                                                                            }
                                                                            $nilai2 = ($data2['bobot']*$nPer)/100;
                                                                            $tNil2 = $tNil2+$nilai2;
                                                                            echo '
                                                                                <tr>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;">'.$data2['nama_kompetensi'].'</td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data2['bobot'].'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nPer.'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nilai2.'</center></td>
                                                                                </tr>
                                                                            ';
                                                                            $c = $c+1;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            else
                                                            {
                                                                $jml_penilai = $db->jumlah_penilai($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA);
                                                                $pembagian = 100/$jml_penilai;
                                                                $tot3 = [];
                                                                foreach($db->perhitungan_kompetensi_matriks1($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $data)
                                                                {
                                                                    $c = $c+1;
                                                                    $tot1 = 0;
                                                                    $tot2 = 0;
                                                                    echo '
                                                                        <tr>
                                                                            <td colspan="4" style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>Penilai '.$c.'</b></td>
                                                                        </tr>
                                                                    ';
                                                                    foreach($db->perhitungan_kompetensi_matriks2($id_anggota, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data['id_verifikator'], $data['id_jabatan_verifikator'], $data['id_departemen_verifikator'], $data['id_unit_verifikator']) as $data2)
                                                                    {
                                                                        $nilai = $db->perubahan_kompetensi($data2['id_kompetensi_individu'], $data2['id_anggota'], $data2['id_jabatan'], $data2['id_departemen'], $data2['id_unit'], $data2['id_verifikator'], $data2['id_jabatan_verifikator'], $data2['id_departemen_verifikator'], $data2['id_unit_verifikator'], $idA);
                                                                        $nilai2 = ($nilai*$data['bobot'])/100;
                                                                        $tot1 = $tot1+$nilai2;
                                                                        echo '
                                                                                <tr>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;">'.$data2['nama_kompetensi'].'</td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data['bobot'].'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nilai.'</center></td>
                                                                                    <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$nilai2.'</center></td>
                                                                                </tr>
                                                                            ';
                                                                    }
                                                                    echo '
                                                                        <tr>
                                                                            <td colspan="3" style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>Total Nilai</b></td>
                                                                            <td style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>'.$tot1.'</b></td>
                                                                        </tr>';
                                                                        $tot2 = ($tot1*$pembagian)/100;
                                                                        $tot3[] = $tot2; 
                                                                    echo '
                                                                        <tr>
                                                                            <td colspan="3" style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>Total Nilai x '.$pembagian.'%</b></td>
                                                                            <td style="font-family: Arial; font-size:12px; padding:5px; text-align:center;"><b>'.$tot2.'</b></td>
                                                                        </tr>
                                                                    ';
                                                                }
                                                                $tNil2 = array_sum($tot3);
                                                            }
                                                            if($c == 0)
                                                            {
                                                                echo '
                                                                    <tr>
                                                                        <td colspan="4" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                                    </tr>
                                                                ';
                                                            }

                                                            echo '
                                                                <tr>
                                                                    <td colspan="3" style="text-align:center; font-family: Arial; font-size:12px; padding:5px;"><b>Total Nilai Kompetensi</b></td>
                                                                    <td style="text-align:center; font-family: Arial; font-size:12px; padding:5px;"><b>'.$tNil2.'</b></td>
                                                                </tr>
                                                            ';
                                                        ?>
                                                    </table>
                                                    <!-- Akhiran Kiri -->
                                                </td>
                                                <td style="width:50%; padding:5px; vertical-align:top;">
                                                    <!-- Kanan -->
                                                    <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                                        <tr>
                                                            <td colspan="2" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>TABEL KONVERSI SKOR KOMPETENSI</center></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>PERINGKAT KOMPETENSI</center></b></td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>SKOR</center></b></td>
                                                        </tr>
                                                        <?php
                                                            $c = 0;
                                                            foreach($db->tampil_peringkat($idA) as $data)
                                                            {
                                                                echo '
                                                                    <tr>
                                                                        <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data['peringkat'].'</center></td>
                                                                        <td style="font-family: Arial; font-size:12px; padding:5px;"><center>'.$data['nilai'].'</center></td>
                                                                    </tr>
                                                                ';
                                                                $c = $c+1;
                                                            }
                                                            if($c == 0)
                                                            {
                                                                echo '
                                                                    <tr>
                                                                        <td colspan="2" style="padding:5px; font-family: Arial; font-size:12px;">Data Kosong</td>
                                                                    </tr>
                                                                ';
                                                            }
                                                        ?>
                                                    </table>
                                                    <!-- Akhiran Kanan -->
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="4" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>PERHITUNGAN TOTAL NILAI KINERJA</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>KOMPONEN PENILAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>TOTAL NILAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>BOBOT</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="25%"><b><center>NILAI KINERJA</center></b></td>
                                            </tr>
                                            <?php
                                                $gTot = 0;
                                                foreach($db->tampil_persentase($idA) as $tampil)
                                                {
                                                    $p_kpi = $tampil['persentase_kpi'];
                                                    $p_kompetensi = $tampil['persentase_kompetensi'];
                                                }

                                                $na_kpi = ($p_kpi*$tNil)/100;
                                                $na_kompetensi = ($p_kompetensi*$tNil2)/100;
                                                $gTot = $na_kpi+$na_kompetensi;

                                                $kn = '';
                                                foreach($db->tampil_kriteria($idA) as $tampil)
                                                {
                                                    if($tampil['batas_minimum'] != 0 AND $tampil['batas_maksimum'] == 0)
                                                    {
                                                        if($gTot >= $tampil['batas_minimum'])
                                                            $kn = $tampil['kriteria_nilai'];
                                                    }
                                                    else if($tampil['batas_minimum'] == 0 AND $tampil['batas_maksimum'] != 0)
                                                    {
                                                        if($gTot <= $tampil['batas_maksimum'])
                                                            $kn = $tampil['kriteria_nilai'];
                                                    }
                                                    else {
                                                        if($gTot >= $tampil['batas_minimum'] AND $gTot <= $tampil['batas_maksimum'])
                                                            $kn = $tampil['kriteria_nilai'];
                                                    }
                                                }
                                                echo '
                                                    <tr>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;">KPI</td>
                                                        <td style="padding:5px; text-align:center; font-family: Arial; font-size:12px;">'.$tNil.'</td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;"><center>'.$p_kpi.' %</center></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;">'.$na_kpi.'</td>
                                                    </tr>
                                                ';
                                                echo '
                                                    <tr>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;">Kompetensi</td>
                                                        <td style="padding:5px; text-align:center; font-family: Arial; font-size:12px;">'.$tNil2.'</td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;"><center>'.$p_kompetensi.' %</center></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;">'.$na_kompetensi.'</td>
                                                    </tr>
                                                ';
                                                echo '
                                                    <tr>
                                                        <td colspan="3" style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;"><b>Total Nilai Kinerja</b></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;"><b>'.$gTot.'</b></td>
                                                    </tr>
                                                ';
                                                echo '
                                                    <tr>
                                                        <td colspan="3" style="padding:5px; text-align:justify; font-family: Arial; font-size:12px; text-align:center;"><b>Kriteria Nilai</b></td>
                                                        <td style="padding:5px; text-align:justify; font-family: Arial; font-size:12px;text-align:center;"><b>'.$kn.'</b></td>
                                                    </tr>
                                                ';

                                                $aN[] = $gTot;
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <br>
                                <div class="row" style="page-break-inside: avoid;">
                                    <div class="col-md-12">
                                        <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                            <tr>
                                                <td colspan="2" style="padding:10px; font-family: Arial; font-size:12px;"><b><center>KETERANGAN KRITERIA NILAI</center></b></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="40%"><b><center>KRITERIA NILAI</center></b></td>
                                                <td style="padding:5px; font-family: Arial; font-size:12px;" width="60%"><b><center>KETERANGAN</center></b></td>
                                            </tr>
                                            <?php
                                                foreach($db->tampil_kriteria($idA) as $tampil)
                                                {
                                                    echo '
                                                        <tr>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['kriteria_nilai'].'</td>
                                                            <td style="padding:5px; font-family: Arial; font-size:12px;">'.$tampil['keterangan'].'</td>
                                                        </tr>
                                                    ';
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                            echo '<br>';
                            echo '<h4 style="font-family: Arial;"><center><b>- AKUMULASI PENILAIAN -</b></center></h4>';
                        ?>
                        <div class="row" style="page-break-inside: avoid;">
                            <div class="col-md-12">
                                <table width="100%" style="border: 1px solid black; border-collapse: collapse;" border="1">
                                    <tr>
                                        <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>JABATAN</center></b></td>
                                        <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>DEPARTEMEN</center></b></td>
                                        <td style="padding:5px; font-family: Arial; font-size:12px;" width="20%"><b><center>UNIT</center></b></td>
                                        <td style="padding:5px; font-family: Arial; font-size:12px;" width="10%"><b><center>LAMA HARI</center></b></td>
                                        <td style="padding:5px; font-family: Arial; font-size:12px;" width="15%"><b><center>NILAI KINERJA</center></b></td>
                                        <td style="padding:5px; font-family: Arial; font-size:12px;" width="15%"><b><center>TOTAL NILAI KINERJA</center></b></td>
                                    </tr>
                                    <?php
                                        for($i=0; $i<count($aJ); $i++)
                                        {
                                            echo '
                                                <tr>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$db->tampil_jabatan_detail($aJ[$i], 1).'</td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$db->tampil_jabatan_detail($aD[$i], 2).'</td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$db->tampil_jabatan_detail($aU[$i], 3).'</td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$i.'</td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$aN[$i].'</td>
                                                    <td style="padding:5px; font-family: Arial; font-size:12px;">'.$i.'</td>
                                                </tr>
                                            ';
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>			
			</div>
        </div>
		
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
        <script>
			function cetak(){
				var windowContent = '<!DOCTYPE html>';
                windowContent += '<html>'
                windowContent += '<head>'+
                                '<title>Print Laporan</title>'+
                                '</head>';
                windowContent += '<body style="background-color: white;">'
                // windowContent += '<center><h3>Print Jadwal Meeting</h3></center>'
                windowContent += $('#printArea').html();
                windowContent += '</body>';
                windowContent += '</html>';
                var printWin = window.open('','','width=1024,height=780');
                printWin.document.open();
                printWin.document.write(windowContent);
                // printWin.document.close();
                printWin.focus();
                setTimeout(function(){
                    printWin.print();
                    printWin.close();
                },200);
			}
		</script>
		
    </body>
</html>
<?php
	ob_end_flush();
?>