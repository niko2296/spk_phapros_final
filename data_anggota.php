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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
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
                                    <li class="active submenu">
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
						<div class="col-xs-8">
							<h4 class="page-title">Master Pegawai</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							<a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Tambah Pegawai</a>
						</div>
					</div>
					<div class="row">

                        <?php
                            if(isset($_POST['tombolSimpan'])){
                                $nik = $_POST['nik'];
                                $nama_anggota = $_POST['nama_anggota'];
                                $jenis_kelamin = $_POST['jenis_kelamin'];
                                $tempat_lahir = $_POST['tempat_lahir'];
                                $tanggal_lahir = $_POST['tanggal_lahir'];
                                $a = explode('/', $tanggal_lahir);
                                $tanggal_lahir = $a[2].'-'.$a[1].'-'.$a[0];
                                $status = $_POST['status'];
                                $nomor_hp = $_POST['nomor_hp'];
                                $email = $_POST['email'];
                                $golongan = $_POST['golongan'];
                                $jabatan = $_POST['jabatan'];
                                $unit = $_POST['unit'];
                                $alamat = $_POST['alamat'];
                                $eksekusi = $db->input_anggota($nik, $nama_anggota, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $status, $nomor_hp, $email, $golongan, $jabatan, $unit, $alamat);
                                if($eksekusi == 2)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                                else if($eksekusi == 1) {
                                    header("location:data_anggota.php");
                                }
                            }
                            else if(isset($_POST['tombolEdit'])){
                                $id_anggota = $_POST['id_anggota_edit'];
                                $nik_asli = $_POST['nik_asli'];
                                $nik = $_POST['nik_edit'];
                                $nama_anggota = $_POST['nama_anggota_edit'];
                                $jenis_kelamin = $_POST['jenis_kelamin_edit'];
                                $tempat_lahir = $_POST['tempat_lahir_edit'];
                                $tanggal_lahir = $_POST['tanggal_lahir_edit'];
                                $a = explode('/', $tanggal_lahir);
                                $tanggal_lahir = $a[2].'-'.$a[1].'-'.$a[0];
                                $status = $_POST['status_edit'];
                                $nomor_hp = $_POST['nomor_hp_edit'];
                                $email = $_POST['email_edit'];
                                $golongan = $_POST['golongan_edit'];
                                $jabatan = $_POST['jabatan_edit'];
                                $unit = $_POST['unit_edit'];
                                $alamat = $_POST['alamat_edit'];
                                $eksekusi = $db->edit_anggota($id_anggota, $nik_asli, $nik, $nama_anggota, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $status, $nomor_hp, $email, $golongan, $jabatan, $unit, $alamat);
                                if($eksekusi == 2 || $eksekusi == 3)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                            }
                            else if(isset($_POST['tombolHapus']))
                            {
                                $eksekusi = $db->hapus_anggota($_POST['id_anggota_hapus']);
                                if($eksekusi == 2 || $eksekusi == 3)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                            }
                        ?>

						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 display" id="tabel">
									<thead>
										<tr>
                                            <th>NIK</th>
											<th>Nama Pegawai</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Status</th>
                                            <th>Nomor Hp</th>
                                            <th>Email</th>
                                            <th>Golongan</th>
                                            <th>Jabatan</th>
                                            <th>Unit</th>
                                            <th>Alamat</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $no = 0;
                                        error_reporting(0);
                                        foreach($db->tampil_anggota() as $data)
                                        {
                                            $no = $no+1;
                                    ?>
                                            <tr>
                                                <td><?php echo $data['nik']; ?></td>
                                                <td><?php echo $data['nama']; ?></td>
                                                <td><?php echo ($data['jenis_kelamin'] == 1)?'Pria':'Wanita'; ?></td>
                                                <td><?php echo $data['tempat_lahir']; ?></td>
                                                <td><?php echo date('d F Y', strtotime($data['tanggal_lahir'])); ?></td>
                                                <td><?php echo ($data['status'] == 1)?'Belum Menikah':'Sudah Menikah'; ?></td>
                                                <td><?php echo $data['nomor_hp']; ?></td>
                                                <td><?php echo $data['email']; ?></td>
                                                <td><?php echo $data['nama_golongan']; ?></td>
                                                <td><?php echo $data['nama_jabatan']; ?></td>
                                                <td><?php echo $data['nama_unit']; ?></td>
                                                <td><?php echo $data['alamat']; ?></td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#" title="Edit" data-toggle="modal" data-target="#edit_ticket<?php echo $data['id_anggota']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                            <li><a href="#" title="Delete" data-toggle="modal" data-target="#delete_ticket<?php echo $data['id_anggota']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div id="edit_ticket<?php echo $data['id_anggota']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <div class="modal-content modal-lg">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Pegawai</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="#">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>NIK</label>
                                                                            <input class="form-control" type="hidden" name="id_anggota_edit" value="<?php echo $data['id_anggota']; ?>">
                                                                            <input class="form-control" type="hidden" name="nik_asli" value="<?php echo $data['nik']; ?>">
                                                                            <input class="form-control" type="text" name="nik_edit" value="<?php echo $data['nik']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Nama Pegawai</label>
                                                                            <input type="text" name="nama_anggota_edit" id="nama_anggota_edit" class="form-control" value="<?php echo $data['nama']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Jenis Kelamin</label>
                                                                            <select name="jenis_kelamin_edit" id="jenis_kelamin_edit" class="form-control">
                                                                                <option value="">Silahkan Pilih Jenis Kelamin</option>
                                                                                <option value="1" <?php echo ($data['jenis_kelamin'] == 1)?'selected="selected"':''; ?>>Pria</option>
                                                                                <option value="2" <?php echo ($data['jenis_kelamin'] == 2)?'selected="selected"':''; ?>>Wanita</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Tempat Lahir</label>
                                                                            <input type="text" name="tempat_lahir_edit" id="tempat_lahir_edit" class="form-control" value="<?php echo $data['tempat_lahir']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Tanggal Lahir</label>
                                                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="tanggal_lahir_edit" id="tanggal_lahir_edit" value="<?php echo date('d/m/Y', strtotime($data['tanggal_lahir'])); ?>"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Status</label>
                                                                            <select name="status_edit" id="status_edit" class="form-control">
                                                                                <option value="">Silahkan Pilih Status</option>
                                                                                <option value="1" <?php echo ($data['status'] == '1')?'selected="selected"':'';?>>Belum Menikah</option>
                                                                                <option value="2"<?php echo ($data['status'] == '2')?'selected="selected"':'';?>>Sudah Menikah</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Nomor Handphone</label>
                                                                            <input type="text" name="nomor_hp_edit" id="nomor_hp_edit" class="form-control" value="<?php echo $data['nomor_hp']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Email</label>
                                                                            <input type="text" name="email_edit" id="email_edit" class="form-control" value="<?php echo $data['email']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Golongan</label>
                                                                            <select name="golongan_edit" id="golongan_edit" class="form-control">
                                                                                <option value="">Silahkan Pilih Golongan</option>
                                                                                <?php
                                                                                    foreach($db->tampil_golongan() as $data2)
                                                                                    {
                                                                                        if($data['id_golongan'] == $data2['id_golongan'])
                                                                                            $s = 'selected = "selected"';
                                                                                ?>
                                                                                        <option value="<?php echo $data2['id_golongan']; ?>" <?php echo $s; ?>><?php echo $data2['nama_golongan']; ?></option>
                                                                                <?php
                                                                                            $s = '';
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Jabatan</label>
                                                                            <select name="jabatan_edit" id="jabatan_edit" class="form-control">
                                                                                <option value="">Silih Pilih Jabatan</option>
                                                                                <?php
                                                                                    foreach($db->tampil_jabatan() as $data2)
                                                                                    {
                                                                                        if($data['id_jabatan'] == $data2['id_jabatan'])
                                                                                            $s = 'selected = "selected"';
                                                                                ?>
                                                                                        <option value="<?php echo $data2['id_jabatan']; ?>" <?php echo $s; ?>><?php echo $data2['nama_jabatan']; ?></option>
                                                                                <?php
                                                                                        $s = '';
                                                                                    } 
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Unit</label>
                                                                            <select name="unit_edit" id="unit_edit" class="form-control">
                                                                                <option value="">Silahkan Pilih Unit</option>
                                                                                <?php
                                                                                    foreach($db->tampil_unit() as $data2)
                                                                                    {
                                                                                        if($data['id_unit'] == $data2['id_unit'])
                                                                                            $s = 'selected = "selected"';
                                                                                ?>
                                                                                        <option value="<?php echo $data2['id_unit']; ?>" <?php echo $s; ?>><?php echo $data2['nama_unit']; ?></option>
                                                                                <?php
                                                                                        $s = '';
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Alamat</label>
                                                                            <textarea name="alamat_edit" id="alamat_edit" cols="30" rows="10" class="form-control"><?php echo $data['alamat']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="m-t-20 text-center">
                                                                    <button class="btn btn-primary" type="submit" name="tombolEdit">Edit Data Pegawai</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhiran Modal Edit -->

                                            <!-- Modal Hapus -->
                                            <div id="delete_ticket<?php echo $data['id_anggota']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content modal-md">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Pegawai</h4>
                                                        </div>
                                                        <form method="POST" action="#">
                                                            <div class="modal-body card-box">
                                                                <p>Yakin Untuk Menghapus Pegawai : <?php echo $data['nama']; ?> ?</p>
                                                                <input type="hidden" name="id_anggota_hapus" value="<?php echo $data['id_anggota']; ?>">
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
							<h4 class="modal-title">Tambah Data Pegawai</h4>
						</div>
						<div class="modal-body">
                        <form method="POST" action="#" id="anggota_input">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK</label>
                                        <input class="form-control cek" type="text" name="nik">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <input type="text" name="nama_anggota" id="nama_anggota" class="form-control cek">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control cek">
                                            <option value="">Silahkan Pilih Jenis Kelamin</option>
                                            <option value="1">Pria</option>
                                            <option value="2">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control cek">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <div class="cal-icon"><input class="form-control datetimepicker cek" type="text" name="tanggal_lahir" id="tanggal_lahir" placeholder="dd/mm/yyyy"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control cek">
                                            <option value="">Silahkan Pilih Status</option>
                                            <option value="1">Belum Menikah</option>
                                            <option value="2">Sudah Menikah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Handphone</label>
                                        <input type="text" name="nomor_hp" id="nomor_hp" class="form-control cek">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" class="form-control cek">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Golongan</label>
                                        <select name="golongan" id="golongan" class="form-control cek">
                                            <option value="">Silahkan Pilih Golongan</option>
                                            <?php
                                                foreach($db->tampil_golongan() as $data)
                                                {
                                            ?>
                                                    <option value="<?php echo $data['id_golongan']; ?>"><?php echo $data['nama_golongan']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select name="jabatan" id="jabatan" class="form-control cek">
                                            <option value="">Silih Pilih Jabatan</option>
                                            <?php
                                                foreach($db->tampil_jabatan() as $data)
                                                {
                                            ?>
                                                    <option value="<?php echo $data['id_jabatan']; ?>"><?php echo $data['nama_jabatan']; ?></option>
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
                                        <label>Unit</label>
                                        <select name="unit" id="unit" class="form-control cek">
                                            <option value="">Silahkan Pilih Unit</option>
                                            <?php
                                                foreach($db->tampil_unit() as $data)
                                                {
                                            ?>
                                                    <option value="<?php echo $data['id_unit']; ?>"><?php echo $data['nama_unit']; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control cek"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary" type="submit" name="tombolSimpan">Simpan Data Pegawai</button>
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
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#tabel').DataTable({
                    ordering : false,
                    searching : true
                });

                $("#anggota_input").on("submit", function(e){
                    var inputan = $("#anggota_input").find(".cek");
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