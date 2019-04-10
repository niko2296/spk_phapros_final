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
    $idA = 'kosong';

    foreach($db->tampil_periode() as $tP)
    {
        if($tP['status'] == 1)
        {
            $tA = $tP['tahun'];
            $idA = $tP['id_periode'];
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
                                            <li><a href="data_unit.php">Departemen/Unit</a></li>
                                            <li><a href="data_anggota.php">Pegawai</a></li>
                                            <li><a href="data_user.php">User</a></li>
                                            <li><a href="data_periode.php">Periode</a></li>
                                            <li><a href="data_polarisasi.php">Polarisasi</a></li>
                                            <li><a href="data_satuan.php">Satuan</a></li>
                                            <li><a href="data_kompetensi.php">Kompetensi</a></li>
                                            <li><a href="data_peringkat.php">Peringkat Kompetensi</a></li>
                                            <li><a href="persentase_nilai.php">Persentase Nilai</a></li>
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
								<a href="#"><i class="la la-certificate"></i> <span> Kompetensi</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
                                    <li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>
									<li><a href="kompetensi_sub.php">Data Kompetensi Sub Ordinat</a></li>
                                </ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-8">
							<h4 class="page-title">Edit Data KPI Individu</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							<!-- <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Tambah Data KPI Individu</a> -->
						</div>
					</div>
					<?php

                        $id_kpi = $_GET['id'];
                        foreach($db->tampil_kpi($idA) as $tampilK)
                        {
                            if($tampilK['id_kpi'] == $id_kpi)
                            {
                                $kpi = $tampilK['kpi'];
                                $deskripsi = $tampilK['deskripsi'];
                                $bobot = $tampilK['bobot'];
                                $sasaran = $tampilK['sasaran'];
                                $satuan = $tampilK['satuan'];
                                $sifat_kpi = $tampilK['sifat_kpi'];
                                $tahun = $tampilK['id_periode'];
                            }
                        }

						if(isset($_POST['tombolSimpan']))
						{   
                            $id_kpi = $_POST['id_kpi'];
							$kpi = $_POST['kpi'];
                            $deskripsi = $_POST['deskripsi'];
                            $bobot = $_POST['bobot'];
                            $sasaran = $_POST['sasaran'];
                            $satuan = $_POST['satuan'];
                            $sifat_kpi = $_POST['sifat_kpi'];
                            $id_periode = $_POST['id_periode'];

                            $eksekusi = $db->edit_kpi($id_kpi, $kpi, $deskripsi, $bobot, $sasaran, $satuan, $sifat_kpi, $id_periode);
                            if($eksekusi == 1)
                            {
                                header("location:data_kpi.php");
                            }
                        }
                    ?>
                    <!-- Form Kedua -->
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <center>
                                                <label>Tahun Data KPI</label>
                                                <select name="id_periode" class="form-control">
                                                    <?php
                                                        foreach($db->tampil_periode() as $tampilPer)
                                                        {
                                                            $s = '';
                                                            if($tampilPer['id_periode'] == $tahun)
                                                                $s = 'selected="selected"';
                                                            echo '<option value="'.$tampilPer['id_periode'].'" '.$s.'>'.$tampilPer['tahun'].'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>KPI</label>
                                            <input type="hidden" name="id_kpi" value="<?php echo $id_kpi; ?>">
                                            <input type="text" value="<?php echo $kpi; ?>" class="form-control" name="kpi">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" id="" cols="30" rows="0" class="form-control"><?php echo $deskripsi; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Bobot</label>
                                            <input type="text" value="<?php echo $bobot; ?>" class="form-control" name="bobot">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sasaran/Target</label>
                                            <input type="text" value="<?php echo $sasaran; ?>" class="form-control" name="sasaran">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <select id="satuan1" name="satuan" class="select" style="width:100%;">
                                                <option value="">Silahkan Pilih Satuan</option>
                                                <?php
                                                    $a = '';
                                                    foreach($db->tampil_satuan($idA) as $tampil)
                                                    {
                                                        if($tampil['id_satuan'] == $satuan)
                                                            $a = 'selected="selected"';
                                                        echo '<option value="'.$tampil['id_satuan'].'" '.$a.'>'.$tampil['nama_satuan'].'</option>';
                                                        $a = '';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Polarisasi</label>
                                            <select id="sifat_kpi1" name="sifat_kpi" class="select" style="width:100%;">
                                                <?php 
                                                    foreach($db->tampil_satuan($idA) as $tampil)
                                                    {
                                                        if($tampil['id_satuan'] == $satuan)
                                                        {
                                                            $a = '';
                                                            foreach(unserialize($tampil['jenis_polarisasi']) as $key => $value)
                                                            {
                                                                foreach($db->tampil_polarisasi() as $tampilP)
                                                                {
                                                                    if($tampilP['id_polarisasi'] == $value)
                                                                        $ket = $tampilP['nama_polarisasi'];
                                                                }
                                                                
                                                                if($value == $sifat_kpi)
                                                                    $a = 'selected="selected"';
                                                                echo '<option value="'.$value.'" '.$a.'>'.$ket.'</option>';
                                                                $a = '';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary" type="submit" name="tombolSimpan">Edit Data KPI Individu</button>
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
                $(".select").select2({
                    placeholder: "Please Select"
                });
            });
        </script>

		<script>
			$('#satuan1').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi1').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value.id_polarisasi;
						var ket = value.nama_polarisasi;

						$('#sifat_kpi1').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});
		</script>
    </body>
</html>
<?php
    ob_end_flush();
?>