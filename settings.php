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
										<a href="data_mutasi.php"><i class="wikwik"></i> <span>Mutasi</span></a>
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
						<div class="col-xs-12">
							<h4 class="page-title">Settings Data Pribadi</h4>
						</div>
					</div>
					<?php
                        error_reporting(0);
                        foreach($db->tampil_user_detail($_SESSION['nik']) as $tampilK)
                        {
                            if($tampilK['nik'] == $_SESSION['nik'])
                            {
                                $nama = $tampilK['nama'];
                                $jenis_kelamin = $tampilK['jenis_kelamin'];
                                $tempat_lahir = $tampilK['tempat_lahir'];
                                $tanggal_lahir = $tampilK['tanggal_lahir'];
                                $status = $tampilK['status'];
                                $nomor_hp = $tampilK['nomor_hp'];
                                $email = $tampilK['email'];
                                $nama_golongan = $tampilK['nama_golongan'];
                                $nama_jabatan = $tampilK['nama_jabatan'];
                                $nama_departemen = $tampilK['nama_departemen'];
                                $nama_unit = $tampilK['nama_unit'];
                                $alamat = $tampilK['alamat'];
                            }
                        }

						if(isset($_POST['tombolSimpan']))
						{   
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
                            $alamat = $_POST['alamat'];
                            $password_baru = $_POST['password_baru'];
                            $konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];
                            $cc = 0;

                            if($password_baru != '' && $konfirmasi_password_baru == '')
                            {
                                echo '
                                    <script>
                                        alert("Silahkan Isikan Konfirmasi Password Baru");
                                        window.location = "settings.php";
                                    </script>
                                ';
                                $cc = $cc+1;
                            }

                            if($password_baru == '' && $konfirmasi_password_baru != '')
                            {
                                echo '
                                    <script>
                                        alert("Silahkan Isikan Password Baru");
                                        window.location = "settings.php";
                                    </script>
                                ';
                                $cc = $cc+1;
                            }

                            if($password_baru != '' && $konfirmasi_password_baru != '')
                            {
                                if($password_baru != $konfirmasi_password_baru)
                                {
                                    echo '
                                        <script>
                                            alert("Konfirmasi Password Baru Tidak Sama Dengan Password Baru");
                                            window.location = "settings.php";
                                        </script>
                                    ';
                                    $cc = $cc+1;
                                }
                            }

                            if($cc == 0)
                            {
                                $eksekusi = $db->update_biodata($nik, $nama_anggota, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $status, $nomor_hp, $email, $alamat, $password_baru);
                                if($eksekusi == 1)
                                {
                                    header("location:data_kpi.php");
                                }
                            }
                        }
                    ?>
                    <!-- Form Kedua -->
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <form action="#" method="POST" id="form_biodata">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" value="<?php echo $_SESSION['nik']; ?>" class="form-control" name="nik" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <input type="text" value="<?php echo $nama; ?>" class="form-control" name="nama_anggota">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tempat Lahir</label>
                                            <input type="text" value="<?php echo $tempat_lahir; ?>" class="form-control" name="tempat_lahir">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo date('d/m/Y', strtotime($tanggal_lahir)); ?>"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="1" <?php echo ($jenis_kelamin == 1)?'selected="selected"':'';?>>Pria</option>
                                                <option value="2" <?php echo ($jenis_kelamin == 2)?'selected="selected"':'';?>>Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Silahkan Pilih Status</option>
                                                <option value="1" <?php echo ($status == 1)?'selected="selected"':'';?>>Belum Menikah</option>
                                                <option value="2"<?php echo ($status == 2)?'selected="selected"':'';?>>Sudah Menikah</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nomor Handphone</label>
                                            <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="<?php echo $nomor_hp; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Golongan</label>
                                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $nama_golongan; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $nama_jabatan; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Departemen</label>
                                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $nama_departemen; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="text" class="form-control" disabled="disabled" value="<?php echo $nama_unit; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control"><?php echo $alamat; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Password Baru</label>
                                            <input type="password" name="password_baru" id="password_baru" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Konfirmasi Password Baru</label>
                                            <input type="password" name="konfirmasi_password_baru" id="konfirmasi_password_baru" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button class="btn btn-primary" type="submit" name="tombolSimpan">Update Data Pribadi</button>
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
                $("select").select2({
                    placeholder: "Please Select"
                });
            });
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>