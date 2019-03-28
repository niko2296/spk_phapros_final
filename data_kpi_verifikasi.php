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
    $id_unitD = $_SESSION['id_unit'];

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
                                    <li class="submenu">
                                        <a href="#"><i class="la la-briefcase"></i> <span> Master Data</span> <span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="data_golongan.php">Golongan</a></li>
                                            <li><a href="data_jabatan.php">Jabatan</a></li>
                                            <li><a href="data_unit.php">Departemen/Unit</a></li>
                                            <li><a href="data_anggota.php">Pegawai</a></li>
                                            <li><a href="data_user.php">User</a></li>
                                            <li><a href="data_periode.php">Periode</a></li>
                                            <li><a href="data_polarisasi.php">Polarisasi</a></li>
                                            <li><a href="data_satuan.php">Satuan</a></li>
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
						</ul>
					</div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<h4 class="page-title">Data KPI Sub Koordinator</h4>
                            <?php
                                $b1 = 0;
                                $k1 = '';
                                error_reporting(0);
                                foreach($db->tampil_waktu_verifikasi() as $tampil)
                                {
                                    $sekarang = date('Y-m-d');
                                    if($sekarang >= $tampil['tanggal_awal_verifikasi'] AND $sekarang <= $tampil['tanggal_akhir_verifikasi'] AND $tampil['jenis_verifikasi'] == 1)
                                        $b1 = 1;
                                }

                                if($b1 == 0)
                                {
                                    $k1 = 'disabled="disabled"';
                                    echo '<center><div style="background-color:orange; width:30%; color:white; padding:5px;">Waktu Verifikasi Sudah Ditutup</div></center><br>';
                                }
                            ?>
                            <center><div style="background-color:#7CFC00; width:20%; color:white; padding:5px; display:none;" id="notifikasi1">Data Diverifikasi</div></center>
                            <center><div style="background-color:red; width:20%; color:white; padding:5px; display:none;" id="notifikasi2">Data Batal Diverifikasi</div></center>
						</div>
					</div>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#dk">Data Per-Jabatan dan Per-Unit</a></li>
                        <li><a data-toggle="tab" href="#dp">Data Per-Anggota</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="dk" class="tab-pane fade in active">
                            <!-- Tab Pertama -->
                            <div class="row">
                                <?php
                                    if(isset($_POST['tombolHapus']))
                                    {
                                        $db->hapus_kpi($_POST['id_kpi_hapus']);
                                    }
                                ?>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th>Jabatan</th>
                                                    <th>Unit</th>
                                                    <th>Jumlah Anggota</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                error_reporting(0);
                                                foreach($db->tampil_jabatan_grup($jabatan, $id_unitD) as $data)
                                                {
                                                    $no = $no+1;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $data['nama_jabatan']; ?></td>
                                                        <td><?php echo $data['nama_unit']; ?></td>
                                                        <td><?php echo $db->hitung_jabatan_grup($data['id_jabatan_dinilai'], $data['id_unit_dinilai']); ?> Anggota</td>
                                                        <td class="text-center  ">
                                                            <div class="dropdown">
                                                                <a href="detail_jabatan.php?id_jabatan=<?php echo $data['id_jabatan_dinilai']."&&id_unit=".$data['id_unit_dinilai']; ?>">Detail</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhiran Tab Pertama -->
                        </div>
                        <div id="dp" class="tab-pane fade">
                            <!-- Tab Kedua -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel2">
                                            <thead>
                                                <tr>
                                                    <th>NIK</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Nomor Hp</th>
                                                    <th>Email</th>
                                                    <th>Jabatan</th>
                                                    <th>Unit</th>
                                                    <th>Jumlah KPI</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                error_reporting(0);
                                                foreach($db->tampil_anggota_grup() as $data)
                                                {
                                                    $no = $no+1;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $data['nik']; ?></td>
                                                        <td><?php echo $data['nama']; ?></td>
                                                        <td><?php echo $data['nomor_hp']; ?></td>
                                                        <td><?php echo $data['email']; ?></td>
                                                        <td><?php echo $data['nama_jabatan']; ?></td>
                                                        <td><?php echo $data['nama_unit']; ?></td>
                                                        <td><?php echo $db->hitung_data_kpi($data['id_anggota'], $data['id_jabatan'], $data['id_unit'], $idA); ?> KPI</td>
                                                        <td class="text-center"><a href="detail_kpi.php?id_anggota=<?php echo $data['id_anggota']."&&id_jabatan=".$data['id_jabatan']."&&id_unit=".$data['id_unit']; ?>">Detail</a></td>
                                                    </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhiran Tab Kedua -->
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

        <script>
            $(document).ready(function () {
                $('#tabel').DataTable({
                    searching : true,
                    ordering : false
                });
                $('#tabel2').DataTable({
                    searching : true,
                    ordering : false
                });
                $("#notifikasi1").css("display","none");
                $("#notifikasi2").css("display","none");
                $('#tabel').on('change','#verifikasi1',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>