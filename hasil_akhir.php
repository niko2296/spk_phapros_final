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
    </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index.php" class="logo">
						<img src="assets/img/logo-phapros.jpg" width="75" height="" alt="">
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
							<li class="active"> 
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
                                            <li><a href="data_peringkat.php">Peringkat Kompetensi</a></li>
											<li><a href="persentase_nilai.php">Persentase Nilai</a></li>
											<li><a href="kriteria_nilai.php">Kriteria Nilai</a></li>
                                        </ul>
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
											<li><a href="copy_kpi.php">Copy Data KPI Individu</a></li>
                                    <?php 
										}
										$eksekusi2 = $db->cek_akses(2, $jabatan, $departemenL, $unitL);
                                        if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                    ?>
                                    		<li><a href="data_kpi_verifikasi.php">Data KPI Sub Ordinat</a></li>
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
											echo '<li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>';
										if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
											echo '<li><a href="kompetensi_sub.php">Data Kompetensi Sub Ordinat</a></li>';
									?>
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
                        <div class="col-md-12" align="center">
                            <h1><b>Laporan Hasil Akhir Penilaian</b></h1>
                            <h1><b>Periode 2020</b></h1>
                        </div>
                    </div>
                    <div class="row">
						<div class="col-md-12">
							<div class="panel panel-table">
								<div class="panel-heading" align="center">
									<h3 class="panel-title"><b>Data Pegawai</b></h3>
								</div>
								<div class="panel-body" style="padding:0.5%;">
                                    <?php
                                        foreach($db->tampil_anggota($id_anggota) as $tampil)
                                        {
                                            $nik_pegawai = $tampil['nik'];
                                            $nama_pegawai = $tampil['nama'];
                                            $jk_pegawai = $tampil['jenis_kelamin'];
                                            $golongan_pegawai = $tampil['nama_golongan'];
                                            $jabatan_pegawai = $tampil['nama_jabatan'];
                                            $unit_pegawai = $tampil['nama_unit'];
                                        }
                                    ?>
									<div class="table-responsive">	
										<table class="table table-striped custom-table m-b-0">
                                            <thead>
                                                <tr>
                                                    <th><b>NIK</b></th>
                                                    <th><b>Nama Pegawai</b></th>
                                                    <th><b>Golongan</b></th>
                                                    <th><b>Jabatan</b></th>
                                                    <th><b>Unit</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $nik_pegawai; ?></td>
                                                    <td><?php echo $nama_pegawai; ?></td>
                                                    <td><?php echo $golongan_pegawai; ?></td>
                                                    <td><?php echo $jabatan_pegawai; ?></td>
                                                    <td><?php echo $unit_pegawai; ?></td>
                                                </tr>
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="row">
						<div class="col-md-6">
							<div class="panel panel-table">
								<div class="panel-heading" align="center">
									<h3 class="panel-title"><b>Data Penilai KPI</b></h3>
								</div>
								<div class="panel-body" style="padding:0.5%;">
									<div class="table-responsive">	
										<table class="table table-striped custom-table m-b-0">
                                            <thead>
                                                <tr>
                                                    <th><b>NIK</b></th>
                                                    <th><b>Nama Penilai</b></th>
                                                    <th><b>Golongan</b></th>
                                                    <th><b>Jabatan</b></th>
                                                    <th><b>Unit</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $c = 0;
                                                    foreach($db->tampil_penilai_kpi($id_anggota, $idA) as $tampil)
                                                    {
                                                        foreach($db->tampil_anggota($tampil['id_verifikator']) as $tampil2)
                                                            echo '<tr>
                                                                        <td>'.$tampil2['nik'].'</td>
                                                                        <td>'.$tampil2['nama'].'</td>
                                                                        <td>'.$tampil2['nama_golongan'].'</td>
                                                                        <td>'.$tampil2['nama_jabatan'].'</td>
                                                                        <td>'.$tampil2['nama_unit'].'</td>
                                                                    </tr>';
                                                        $c = $c+1;
                                                    }

                                                    if($c == 0)
                                                    {
                                                        echo '
                                                            <tr>
                                                                <td colspan="5" align="center">Data Kosong</td>
                                                            </tr>
                                                        ';
                                                    }
                                                ?>
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-table">
								<div class="panel-heading" align="center">
									<h3 class="panel-title"><b>Data Penilai Kompetensi</b></h3>
								</div>
								<div class="panel-body" style="padding:0.5%;">
									<div class="table-responsive">	
										<table class="table table-striped custom-table m-b-0">
                                            <thead>
                                                <tr>
                                                    <th><b>NIK</b></th>
                                                    <th><b>Nama Penilai</b></th>
                                                    <th><b>Golongan</b></th>
                                                    <th><b>Jabatan</b></th>
                                                    <th><b>Unit</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $c = 0;
                                                    foreach($db->tampil_penilai_kompetensi($id_anggota, $idA) as $tampil)
                                                    {
                                                        foreach($db->tampil_anggota($tampil['id_verifikator']) as $tampil2)
                                                            echo '<tr>
                                                                        <td>'.$tampil2['nik'].'</td>
                                                                        <td>'.$tampil2['nama'].'</td>
                                                                        <td>'.$tampil2['nama_golongan'].'</td>
                                                                        <td>'.$tampil2['nama_jabatan'].'</td>
                                                                        <td>'.$tampil2['nama_unit'].'</td>
                                                                    </tr>';
                                                        $c = $c+1;
                                                    }

                                                    if($c == 0)
                                                    {
                                                        echo '
                                                            <tr>
                                                                <td colspan="5" align="center">Data Kosong</td>
                                                            </tr>
                                                        ';
                                                    }
                                                ?>
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
							<div class="panel panel-table">
								<div class="panel-heading" align="center">
									<h3 class="panel-title"><b>Data KPI</b></h3>
								</div>
								<div class="panel-body" style="padding:0.5%;">
									<div class="table-responsive">	
										<table class="table table-striped custom-table m-b-0">
											<thead>
                                                <tr>
                                                    <th><b>KPI</b></th>
                                                    <th><b>Deskripsi</b></th>
                                                    <th><b>Bobot (%)</b></th>
                                                    <th><b>Sasaran / Target</b></th>
                                                    <th><b>Satuan</b></th>
                                                    <th><b>Polarisasi</b></th>
                                                    <th><b>Periode</b></th>
                                                    <th><b>Realisasi</b></th>
                                                    <th><b>Skor</b></th>
                                                    <th><b>Nilai</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="10" align="center"><b>Jabatan : Makan - Unit : Minum</b></td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                    <td>5</td>
                                                    <td>6</td>
                                                    <td>7</td>
                                                    <td>8</td>
                                                    <td>9</td>
                                                    <td>10</td>
                                                </tr>
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
							<div class="panel panel-table">
								<div class="panel-heading" align="center">
									<h3 class="panel-title"><b>Data Kompetensi</b></h3>
								</div>
								<div class="panel-body" style="padding:0.5%;">
									<div class="table-responsive">	
										<table class="table table-striped custom-table m-b-0">
											<thead>
                                                <tr>
                                                    <th><b>Dimensi Kompetensi</b></th>
                                                    <th><b>Bobot (%)</b></th>
                                                    <th><b>Skor</b></th>
                                                    <th><b>Nilai</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                </tr>
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
							<div class="panel panel-table">
								<div class="panel-heading" align="center">
									<h3 class="panel-title"><b>Perhitungan Total Nilai Kinerja</b></h3>
								</div>
								<div class="panel-body" style="padding:0.5%;">
									<div class="table-responsive">	
										<table class="table table-striped custom-table m-b-0">
											<thead>
                                                <tr>
                                                    <th><b>Komponen Penilaian</b></th>
                                                    <th><b>Total Nilai</b></th>
                                                    <th><b>Bobot</b></th>
                                                    <th><b>Nilai Kinerja</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>2</td>
                                                    <td>3</td>
                                                    <td>4</td>
                                                </tr>
                                            </tbody>
										</table>
									</div>
								</div>
							</div>
                        </div>
                    </div>
				</div>			
			</div>
        </div>
		
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/plugins/morris/morris.min.js"></script>
		<script type="text/javascript" src="assets/plugins/raphael/raphael-min.js"></script>
		<script type="text/javascript" src="assets/js/chart.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>
		
    </body>
</html>
<?php
	ob_end_flush();
?>