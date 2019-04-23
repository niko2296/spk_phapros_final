<?php
    ob_start();
    include "conn/database.php";
    $db = new database();
    $nama = '';
    $jabatan = '';
	session_start();
	if($_SESSION['login'] == FALSE)
        header("location:login.php");
    $id_anggota = $_SESSION['id_anggota'];
    $nama = $_SESSION['nama'];
    $jabatan = $_SESSION['id_jabatan'];
    $departemenL = $_SESSION['id_departemen'];
    $unitL = $_SESSION['id_unit'];

    foreach($db->tampil_periode() as $tPer)
    {
        if($tPer['status'] == 1)
        {
            $idA = $tPer['id_periode'];
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
									<li class="active"> 
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
					<div class="row">
						<div class="col-xs-8">
							<h4 class="page-title">Data Mutasi</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Tambah Data Mutasi</a>
						</div>
					</div>
					<div class="row">

                        <?php
                            if(isset($_POST['tombolSimpan'])){
                                $tanggal_mutasi = $_POST['tanggal_mutasi'];
                                $a = explode('/', $tanggal_mutasi);
                                $tanggal_mutasi = $a[2].'-'.$a[1].'-'.$a[0];
                                $eksekusi = $db->input_mutasi($_POST['id_periode'], $_POST['id_anggota'], $_POST['id_jabatan'], $_POST['id_departemen'], $_POST['id_unit'], $tanggal_mutasi);
                                if($eksekusi == 2)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                                else if($eksekusi == 3)
                                {
                                    echo '<div class="alert alert-danger">Data Pegawai Tidak Ditemukan</div>';
                                }
                            }
                            else if(isset($_POST['tombolEdit'])){
                                $tanggal_mutasi_edit = $_POST['tanggal_mutasi_edit'];
                                $a = explode('/', $tanggal_mutasi_edit);
                                $tanggal_mutasi_edit = $a[2].'-'.$a[1].'-'.$a[0];
                                $eksekusi = $db->edit_mutasi($_POST['id_anggota_edit'], $_POST['id_mutasi'], $_POST['id_periode_edit'], $_POST['id_jabatan_edit'], $_POST['id_departemen_edit'], $_POST['id_unit_edit'], $tanggal_mutasi_edit);
                                if($eksekusi == 2 || $eksekusi == 3)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                            }
                            else if(isset($_POST['tombolHapus']))
                            {
                                $eksekusi = $db->hapus_mutasi($_POST['id_mutasi_hapus'], $_POST['id_anggota_hapus'], $_POST['id_jabatan_lama'], $_POST['id_departemen_lama'], $_POST['id_unit_lama']);
                                if($eksekusi == 2 || $eksekusi == 3)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                            }
                        ?>

						<div class="col-md-12" style="border:1px solid black;color:black; background-color:white; padding:1%;">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 display" id="tabel">
									<thead>
										<tr>
											<th>Nama Pegawai</th>
											<th>Jabatan Lama</th>
											<th>Departemen Lama</th>
											<th>Unit Lama</th>
											<th>Jabatan Baru</th>
											<th>Departemen Baru</th>
											<th>Unit Baru</th>
											<th>Tanggal</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $no = 0;
                                        error_reporting(0);
                                        foreach($db->tampil_mutasi($idA) as $data)
                                        {
                                            $no = $no+1;
                                    ?>
                                            <tr>
                                                <td><?php echo $data['nama']; ?></td>
                                                <td><?php echo $data['nama_jabatan']; ?></td>
                                                <td><?php echo $data['nama_departemen']; ?></td>
                                                <td><?php echo $data['nama_unit']; ?></td>
                                                <td><?php echo $db->tampil_jabatan_detail($data['id_jabatan_baru'], 1); ?></td>
                                                <td><?php echo $db->tampil_jabatan_detail($data['id_departemen_baru'], 2); ?></td>
                                                <td><?php echo $db->tampil_jabatan_detail($data['id_unit_baru'], 3); ?></td>
                                                <td><?php echo date('d F Y', strtotime($data['tanggal_mutasi'])); ?></td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#" title="Edit" data-toggle="modal" data-target="#edit_ticket<?php echo $data['id_mutasi']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                            <li><a href="#" title="Delete" data-toggle="modal" data-target="#delete_ticket<?php echo $data['id_mutasi']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div id="edit_ticket<?php echo $data['id_mutasi']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <div class="modal-content modal-lg">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Mutasi</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="#" id="golongan_edit">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Periode</label>
                                                                        <input type="hidden" name="id_mutasi" value="<?php echo $data['id_mutasi']; ?>">
                                                                        <input type="hidden" name="id_anggota_edit" value="<?php echo $data['id_anggota']; ?>">
                                                                        <select name="id_periode_edit" id="id_periode_edit" class="form-control cek" style="width:100%;">
                                                                            <option value="">Silahkan Pilih Periode</option>
                                                                            <?php
                                                                                foreach($db->tampil_periode() as $tampil)
                                                                                {
                                                                                    $s = '';
                                                                                    if($tampil['id_periode'] == $data['id_periode'])
                                                                                        $s = 'selected="selected"';
                                                                            ?>
                                                                                    <option value="<?php echo $tampil['id_periode']?>" <?php echo $s; ?>><?php echo $tampil['tahun']; ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Tanggal Mutasi</label>
                                                                        <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="tanggal_mutasi_edit" id="tanggal_mutasi_edit" value="<?php echo date('d/m/Y', strtotime($data['tanggal_mutasi'])); ?>"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Nama Pegawai</label>
                                                                        <select name="id_anggota_edit" id="id_anggota_edit" class="form-control cek" style="width:100%;" disabled="disabled">
                                                                            <option value="">Silahkan Pilih Anggota</option>
                                                                            <?php
                                                                                foreach($db->tampil_anggota() as $tampil)
                                                                                {
                                                                                    $s = '';
                                                                                    if($tampil['id_anggota'] == $data['id_anggota'])
                                                                                        $s = 'selected="selected"';
                                                                            ?>
                                                                                    <option value="<?php echo $tampil['id_anggota']?>" <?php echo $s; ?>><?php echo $tampil['nama']; ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Jabatan Baru</label>
                                                                        <select name="id_jabatan_edit" id="id_jabatan_edit" class="form-control cek" style="width:100%;">
                                                                            <option value="">Silahkan Pilih Jabatan</option>
                                                                            <?php
                                                                                foreach($db->tampil_jabatan() as $tampil)
                                                                                {
                                                                                    $s = '';
                                                                                    if($tampil['id_jabatan'] == $data['id_jabatan_baru'])
                                                                                        $s = 'selected="selected"';
                                                                            ?>
                                                                                    <option value="<?php echo $tampil['id_jabatan']?>" <?php echo $s; ?>><?php echo $tampil['nama_jabatan']; ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Departemen Baru</label>
                                                                        <select name="id_departemen_edit" id="id_departemen_edit" class="form-control cek" style="width:100%;">
                                                                            <option value="">Silahkan Pilih Departemen</option>
                                                                            <?php
                                                                                foreach($db->tampil_departemen() as $tampil)
                                                                                {
                                                                                    $s = '';
                                                                                    if($tampil['id_departemen'] == $data['id_departemen_baru'])
                                                                                        $s = 'selected="selected"';
                                                                            ?>
                                                                                    <option value="<?php echo $tampil['id_departemen']?>" <?php echo $s; ?>><?php echo $tampil['nama_departemen']; ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Unit Baru</label>
                                                                        <select name="id_unit_edit" id="id_unit_edit" class="form-control cek" style="width:100%;">
                                                                            <option value="">Silahkan Pilih Unit</option>
                                                                            <?php
                                                                                foreach($db->tampil_unit() as $tampil)
                                                                                {
                                                                                    $s = '';
                                                                                    if($tampil['id_unit'] == $data['id_unit_baru'])
                                                                                        $s = 'selected="selected"';
                                                                            ?>
                                                                                    <option value="<?php echo $tampil['id_unit']?>" <?php echo $s; ?>><?php echo $tampil['nama_unit']; ?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <div class="m-t-20 text-center">
                                                                    <button class="btn btn-primary" type="submit" name="tombolEdit">Edit Data Mutasi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhiran Modal Edit -->

                                            <!-- Modal Hapus -->
                                            <div id="delete_ticket<?php echo $data['id_mutasi']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content modal-md">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data Mutasi</h4>
                                                        </div>
                                                        <form method="POST" action="#">
                                                            <div class="modal-body card-box">
                                                                <p>Yakin Untuk Menghapus Data Mutasi <?php echo $data['nama']; ?> ?</p>
                                                                <input type="hidden" name="id_mutasi_hapus" value="<?php echo $data['id_mutasi']; ?>">
                                                                <input type="hidden" name="id_anggota_hapus" value="<?php echo $data['id_anggota']; ?>">
                                                                <input type="hidden" name="id_jabatan_lama" value="<?php echo $data['id_jabatan_lama']; ?>">
                                                                <input type="hidden" name="id_departemen_lama" value="<?php echo $data['id_departemen_lama']; ?>">
                                                                <input type="hidden" name="id_unit_lama" value="<?php echo $data['id_unit_lama']; ?>">
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
            </div>
			<div id="add_ticket" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Data Mutasi</h4>
						</div>
						<div class="modal-body">
							<form method="POST" action="#" id="golongan_input">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Periode</label>
											<select name="id_periode" id="id_periode" class="form-control cek" style="width:100%;">
                                                <option value="">Silahkan Pilih Periode</option>
                                                <?php
                                                    foreach($db->tampil_periode() as $tampil)
                                                    {
                                                ?>
                                                        <option value="<?php echo $tampil['id_periode']?>"><?php echo $tampil['tahun']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
										</div>
									</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Mutasi</label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="tanggal_mutasi" id="tanggal_mutasi" value="" placeholder="dd/mm/yyyy"></div>
                                        </div>
                                    </div>
                                </div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama Pegawai</label>
											<select name="id_anggota" id="id_anggota" class="form-control cek" style="width:100%;">
                                                <option value="">Silahkan Pilih Anggota</option>
                                                <?php
                                                    foreach($db->tampil_anggota() as $tampil)
                                                    {
                                                ?>
                                                        <option value="<?php echo $tampil['id_anggota']?>"><?php echo $tampil['nik']." | ".$tampil['nama']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Jabatan Baru</label>
											<select name="id_jabatan" id="id_jabatan" class="form-control cek" style="width:100%;">
                                                <option value="">Silahkan Pilih Jabatan</option>
                                                <?php
                                                    foreach($db->tampil_jabatan() as $tampil)
                                                    {
                                                ?>
                                                        <option value="<?php echo $tampil['id_jabatan']?>"><?php echo $tampil['nama_jabatan']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
										</div>
									</div>
                                </div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Departemen Baru</label>
											<select name="id_departemen" id="id_departemen" class="form-control cek" style="width:100%;">
                                                <option value="">Silahkan Pilih Departemen</option>
                                                <?php
                                                    foreach($db->tampil_departemen() as $tampil)
                                                    {
                                                ?>
                                                        <option value="<?php echo $tampil['id_departemen']?>"><?php echo $tampil['nama_departemen']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Unit Baru</label>
											<select name="id_unit" id="id_unit" class="form-control cek" style="width:100%;">
                                                <option value="">Silahkan Pilih Unit</option>
                                                <?php
                                                    foreach($db->tampil_unit() as $tampil)
                                                    {
                                                ?>
                                                        <option value="<?php echo $tampil['id_unit']?>"><?php echo $tampil['nama_unit']; ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
										</div>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="tombolSimpan">Simpan Data Mutasi</button>
								</div>
							</form>
						</div>
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

                $('select').select2({
                    placeholder: "Please Select"
                });

                $("#golongan_input").on("submit", function(e){
                    var inputan = $("#golongan_input").find(".cek");
                    var v = '';
                    var k = [];
                    var p = 0;
                    $.each(inputan, function(i){
                        v = $(this).val();
                        if(v == '')
                        {
                            k[p] = 1;
                        }
                        else{
                            k[p] = 0;
                        }
                        v = '';
                        p = p+1;
                    });
                    
                    for(var c=0; c < p; c++)
                    {
                        if(k[c] == 1)
                        {
                            e.preventDefault();
                            alert('Masih Terdapat yg Kosong');
                            break;
                        }
                    }
                });
            });
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>