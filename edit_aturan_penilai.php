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

    $idjp = $_GET['idjp'];
    $idup = $_GET['idup'];
    foreach($db->tampil_aturan(2, $idjp, $idup) as $tampil)
    {
        $jd[] = $tampil['id_jabatan_dinilai'];
        $ud = $tampil['id_unit_dinilai'];
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
		<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.min.css">
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
                                            <li><a href="data_unit.php">Departemen/Unit</a></li>
                                            <li><a href="data_anggota.php">Pegawai</a></li>
                                            <li><a href="data_user.php">User</a></li>
                                            <li><a href="data_periode.php">Periode</a></li>
                                            <li><a href="data_polarisasi.php">Polarisasi</a></li>
                                            <li><a href="data_satuan.php">Satuan</a></li>
                                            <li><a href="data_kompetensi.php">Kompetensi</a></li>
                                            <li><a href="data_peringkat.php">Peringkat Kompetensi</a></li>
                                        </ul>
                                    </li>
                            <?php
                                }
                                if($m2 == 1 || $_SESSION['aksus'] == TRUE)
                                {
                            ?>
                                    <li class="active"> 
                                        <a href="aturan_penilai.php"><i class="la la-key"></i> <span>Aturan Penilai</span></a>
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
                                    <li><a href="data_kpi_verifikasi.php">Data KPI Sub Koordinator</a></li>
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
								<a href="#"><i class="la la-certificate"></i> <span> Kompetensi</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
                                    <li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>
									<li><a href="kompetensi_sub.php">Data Kompetensi Sub Koordinator</a></li>
                                </ul>
							</li>
						</ul>
					</div>
                </div>
            </div>

            <?php
                if(isset($_POST['tombolSimpan']))
                {
                    $jpA = $_POST['idjp'];
                    $jd = $_POST['id_jabatan_dinilai'];
                    $upA = $_POST['idup'];
                    $ud = $_POST['id_unit_dinilai'];
                    $jp = $_POST['id_jabatan_penilai'];
                    $up = $_POST['id_unit_penilai'];

                    $eksekusi = $db->edit_aturan($jp, $up, $jd, $ud, $jpA, $upA);
                    if($eksekusi == 1)
                    {
                        header("location:aturan_penilai.php");
                    }

                }
            ?>

            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-8">
							<h4 class="page-title">Edit Aturan Penilai</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							<!-- <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Tambah Data KPI Individu</a> -->
						</div>
					</div>
                    <!-- Form Kedua -->
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jabatan Penilai</label>
                                            <input type="hidden" name="idjp" value="<?php echo $idjp; ?>">
                                            <input type="hidden" name="idup" value="<?php echo $idup; ?>">
                                            <select name="id_jabatan_penilai" id="id_jabatan_penilai" class="form-control">
                                                <option value="">Silahkan Pilih Jabatan</option>
                                                <?php
                                                    $a = '';
                                                    foreach($db->tampil_jabatan() as $tampil)
                                                    {
                                                        if($tampil['id_jabatan'] == $idjp)
                                                            $a = 'selected="selected"';
                                                ?>
                                                        <option value="<?php echo $tampil['id_jabatan']?>" <?php echo $a; ?>><?php echo $tampil['nama_jabatan']; ?></option>
                                                <?php
                                                        $a = '';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Unit Penilai</label>
                                            <select name="id_unit_penilai" id="id_unit_penilai" class="form-control">
                                                <option value="">Silahkan Pilih Unit</option>
                                                <?php
                                                    $a = '';
                                                    foreach($db->tampil_unit() as $tampil)
                                                    {
                                                        if($tampil['id_unit'] == $idup)
                                                                $a = 'selected="selected"';
                                                ?>
                                                        <option value="<?php echo $tampil['id_unit']?>" <?php echo $a; ?>><?php echo $tampil['nama_unit']; ?></option>
                                                <?php
                                                        $a = '';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jabatan Dinilai</label>
                                            <select name="id_jabatan_dinilai[]" id="id_jabatan_dinilai" class="form-control" multiple="multiple">
                                                <option value="">Silahkan Pilih Jabatan</option>
                                                <?php
                                                    $a = '';
                                                    foreach($db->tampil_jabatan() as $tampil)
                                                    {
                                                            if(in_array($tampil['id_jabatan'], $jd))
                                                                $a = 'selected="selected"';
                                                ?>
                                                        <option value="<?php echo $tampil['id_jabatan']?>" <?php echo $a; ?>><?php echo $tampil['nama_jabatan']; ?></option>
                                                <?php
                                                        $a = '';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Unit Dinilai</label>
                                            <select name="id_unit_dinilai" id="id_unit_dinilai" class="form-control">
                                                <option value="">Silahkan Pilih Unit</option>
                                                <?php
                                                    $a = '';
                                                    foreach($db->tampil_unit() as $tampil)
                                                    {
                                                        if($tampil['id_unit'] == $ud)
                                                                $a = 'selected="selected"';
                                                ?>
                                                        <option value="<?php echo $tampil['id_unit']?>" <?php echo $a; ?>><?php echo $tampil['nama_unit']; ?></option>
                                                <?php
                                                        $a = '';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary" type="submit" name="tombolSimpan">Simpan Data Aturan Penilai</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Akhiran Form Kedua -->
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
            $(document).ready(function () {
                $('#id_jabatan_dinilai').select2({
                    placeholder: "Please Select"
                });
                $('#id_jabatan_penilai').select2({
                    placeholder: "Please Select"
                });
                $('#id_unit_dinilai').select2({
                    placeholder: "Please Select"
                });
                $('#id_unit_penilai').select2({
                    placeholder: "Please Select"
                });
            });
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>