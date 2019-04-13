<?php
    ob_start();
    include "conn/database.php";
    $db = new database();
    $nama = '';
    $jabatan = '';
    $id_anggotaD = '';
    $id_unitD = '';
	session_start();
	if($_SESSION['login'] == FALSE)
        header("location:login.php");
    $nama = $_SESSION['nama'];
    $jabatan = $_SESSION['id_jabatan'];
    $id_anggotaD = $_SESSION['id_anggota'];
    $id_unitD = $_SESSION['id_unit'];
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
		<!-- <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.min.css"> -->
        <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
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
							<li> 
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
                            <li class="active submenu">
								<a href="#"><i class="la la-clipboard"></i> <span> KPI</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
                                    <?php
                                        if($m5 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                    ?>
									<li><a href="data_kpi.php">Data KPI Individu</a></li>
                                    <li><a href="copy_kpi.php">Copy Data KPI Individu</a></li>
                                    <?php 
                                        }
                                        if($m6 == 1 || $_SESSION['aksus'] == TRUE)
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
                                    <li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>
									<li><a href="kompetensi_sub.php">Data Kompetensi Sub Ordinat</a></li>
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
					<div class="row">
						<div class="col-xs-12">
							<h4 class="page-title">Data KPI Individu</h4>
						</div>
					</div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#dpk">Data Pengajuan KPI</a></li>
                        <li><a data-toggle="tab" href="#drk">Data Realisasi KPI</a></li>
                    </ul>

                    <div class="tab-content">
                        <!-- Tab Pertama -->
                        <div id="dpk" class="tab-pane fade in active">
                            <div class="row">
                                <?php
                                    $b1 = 0;
                                    $b2 = 0;
                                    error_reporting(0);
                                    foreach($db->tampil_waktu_input() as $tampil)
                                    {
                                        $sekarang = date('Y-m-d');
                                        if($sekarang >= $tampil['tanggal_awal_input'] AND $sekarang <= $tampil['tanggal_akhir_input'] AND $tampil['jenis_input'] == 1)
                                            $b1 = 1;
                                        if($sekarang >= $tampil['tanggal_awal_input'] AND $sekarang <= $tampil['tanggal_akhir_input'] AND $tampil['jenis_input'] == 2)
                                            $b2 = 1;
                                    }
                                    
                                    if($b1 == 1)
                                    {
                                        echo '
                                            <div class="col-md-12 text-right m-b-30">
                                                <a href="input_kpi.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Tambah Data KPI Individu</a>
                                            </div>
                                        ';
                                    }
                                ?>
                            </div>
                            <div class="row">
                                <?php
                                    if(isset($_POST['tombolHapus']))
                                    {
                                        $db->hapus_kpi($_POST['id_kpi_hapus']);
                                    }

                                    $ket = '';
                                    $totB = $db->total_bobot($id_anggotaD, $jabatan, $id_unitD, $idA);
                                    if($totB < 100)
                                        $ket = 'Bobot Masih Kurang dari 100%';
                                    else if($totB > 100)
                                        $ket = 'Bobot Lebih dari 100%';

                                    if($ket != '')
                                    {
                                        echo    '<div class="alert alert-danger">
                                                    <div class="row" style="vertical-align:bottom;">
                                                        <div class="col-md-12" align="center">
                                                            <b>!! '.$ket.' !!</b>
                                                        </div>
                                                    </div>
                                                </div>';
                                    }

                                    if($db->hitung_catatan($id_anggotaD, $jabatan, $id_unitD, $idA) > 0)
                                    {
                                        echo '<div class="alert alert-info">
                                                <div class="row" style="vertical-align:bottom;">
                                                    <div class="col-md-12">
                                                        <b>Catatan</b> : '.$db->tampil_catatan($id_anggotaD, $jabatan, $id_unitD, $idA).'
                                                    </div>
                                                </div>
                                                </div>';
                                    }
                                ?>

                                <div class="col-md-12" style="border:1px solid black;color:black; background-color:white; padding:1%;">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Deskripsi</th>
                                                    <th>Bobot (%)</th>
                                                    <th>Sasaran/Target</th>
                                                    <th>Satuan</th>
                                                    <th>Polarisasi</th>
                                                    <th>Periode</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                error_reporting(0);
                                                foreach($db->tampil_kpi($idA) as $data)
                                                {
                                                    $no = $no+1;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $data['kpi']; ?></td>
                                                        <td><?php echo $data['deskripsi']; ?></td>
                                                        <td><?php echo $data['bobot']; ?></td>
                                                        <td><?php echo $data['sasaran']; ?></td>
                                                        <td><?php echo $data['nama_satuan']; ?></td>
                                                        <td><?php echo $data['nama_polarisasi']; ?></td>
                                                        <td><?php echo $data['tahun']; ?></td>
                                                        <td><?php echo ($data['status'] == 0)?'Belum Verifikasi':'Sudah Verifikasi'; ?></td>
                                                        <td class="text-right">
                                                            <div class="dropdown">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <?php
                                                                        if($b1 == 1 AND $data['status'] != 1)
                                                                        {
                                                                    ?>
                                                                            <li><a href="edit_kpi.php?id=<?php echo $data['id_kpi']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                                            <li><a href="#" title="Delete" data-toggle="modal" data-target="#delete_ticket<?php echo $data['id_kpi']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                                                    <?php
                                                                        }
                                                                        else {
                                                                            echo '<li><center>Tidak Terdapat Aksi</center></li>';
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Hapus -->
                                                    <div id="delete_ticket<?php echo $data['id_kpi']; ?>" class="modal custom-modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content modal-md">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Hapus Data KPI Individu</h4>
                                                                </div>
                                                                <form method="POST" action="#">
                                                                    <div class="modal-body card-box">
                                                                        <p>Yakin Untuk Menghapus Data KPI Individu : <?php echo $data['kpi']; ?> ?</p>
                                                                        <input type="hidden" name="id_kpi_hapus" value="<?php echo $data['id_kpi']; ?>">
                                                                        <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                                                                            <button type="submit" name="tombolHapus" class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Akhiran Modal Hapus -->
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhiran Tab Pertama -->
                        <!-- Tab Kedua -->
                        <div id="drk" class="tab-pane fade">
                            <?php
                                if(isset($_POST['tombolSimpanRealisasi']))
                                {
                                    $input = $db->input_realisasi($_POST['id_kpi'], $id_anggotaD, $jabatan, $id_unitD, $idA, $_POST['realisasi'], $_POST['keterangan']);
                                    if($input == 2)
                                    {
                                        echo '
                                            <script>
                                                alert("Data Gagal Disimpan");
                                            </script>
                                        ';
                                    }
                                    if($input == 1)
                                    {
                                        echo '
                                            <script>
                                                alert("Data Berhasil Disimpan");
                                            </script>
                                        ';
                                    }
                                }
                            ?>
                            <div class="row" style="border:1px solid black;color:black; background-color:white; padding:1%;">
                                <form action="#" method="POST">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel2">
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Deskripsi</th>
                                                    <th>Bobot (%)</th>
                                                    <th>Sasaran/Target</th>
                                                    <th>Satuan</th>
                                                    <th>Polarisasi</th>
                                                    <th>Periode</th>
                                                    <th style="width:100px;">Realisasi</th>
                                                    <th>Keterangan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                error_reporting(0);
                                                foreach($db->tampil_kpi($idA) as $data)
                                                {
                                                    if($data['status'] == 1)
                                                    {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $data['kpi']; ?></td>
                                                        <td><?php echo $data['deskripsi']; ?></td>
                                                        <td><?php echo $data['bobot']; ?></td>
                                                        <td><?php echo $data['sasaran']; ?></td>
                                                        <td><?php echo $data['nama_satuan']; ?></td>
                                                        <td><?php echo $data['nama_polarisasi']; ?></td>
                                                        <td><?php echo $data['tahun']; ?></td>
                                                        <td>
                                                            <input type="hidden" name="id_kpi[]" class="form-control" value="<?php echo $data['id_kpi']; ?>">
                                                            <input type="text" name="realisasi[]" class="form-control" value="<?php echo ($db->hitung_realisasi($data['id_kpi']) > 0)?($db->tampil_realisasi(1, $data['id_kpi'])):('0'); ?>" <?php echo ($db->cek_verif_realisasi($data['id_kpi']) == 1)?('readonly="readonly"'):(''); ?> <?php echo ($b2 != 1)?('readonly="readonly"'):(''); ?>>
                                                        </td>
                                                        <td><textarea name="keterangan[]" cols="10" rows="1" class="form-control" placeholder="Isikan Keterangan" <?php echo ($db->cek_verif_realisasi($data['id_kpi']) == 1)?('readonly="readonly"'):(''); ?> <?php echo ($b2 != 1)?('readonly="readonly"'):(''); ?>><?php echo ($db->hitung_realisasi($data['id_kpi']) > 0)?($db->tampil_realisasi(2, $data['id_kpi'])):(''); ?></textarea></td>
                                                        <td><?php echo ($db->cek_verif_realisasi($data['id_kpi']) == 1)?('Sudah Diverifikasi'):('Belum Diverifikasi'); ?></td>
                                                    </tr>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12" align="right">
                                    <button class="btn btn-primary" type="submit" name="tombolSimpanRealisasi">Simpan Data</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- Akhiran Tab Kedua -->
                    </div>
                </div>
            </div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<!-- <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script> -->
        <script type="text/javascript" charset="utf8" src="assets/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="assets/js/datatables.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#tabel').DataTable({
                    searching : true,
                    ordering : false
                });
                $('#tabel2').DataTable({
                    searching : true,
                    ordering : false,
                    paging : false,
                    info : false
                });
            });
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>