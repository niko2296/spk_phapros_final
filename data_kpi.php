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
									<li><a href="waktu_input.php">Waktu Input KPI</a></li>
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
						<div class="col-xs-8">
							<h4 class="page-title">Data KPI Individu</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
                            <?php
                                $b1 = 0;
                                error_reporting(0);
                                foreach($db->tampil_waktu_input() as $tampil)
                                {
                                    $sekarang = date('Y-m-d');
                                    if($sekarang >= $tampil['tanggal_awal_input'] AND $sekarang <= $tampil['tanggal_akhir_input'])
                                        $b1 = 1;
                                }

                                if($b1 == 1)
                                {
                            ?>
							        <a href="input_kpi.php" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Tambah Data KPI Individu</a>
                            <?php
                                }
                            ?>
                        </div>
					</div>
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
											<th>KPI</th>
                                            <th>Deskripsi</th>
                                            <th>Bobot (%)</th>
                                            <th>Sasaran/Target</th>
                                            <th>Satuan</th>
                                            <th>Polarisasi</th>
                                            <th>Tahun</th>
                                            <th>Status</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $no = 0;
                                        error_reporting(0);
                                        foreach($db->tampil_kpi() as $data)
                                        {
                                            $no = $no+1;
                                    ?>
                                            <tr>
                                                <td><?php echo $data['kpi']; ?></td>
                                                <td><?php echo $data['deskripsi']; ?></td>
                                                <td><?php echo $data['bobot']; ?></td>
                                                <td><?php echo $data['sasaran']; ?></td>
                                                <td>
                                                    <?php
                                                        $nama_satuan = '';
                                                        foreach($db->tampil_satuan() as $tampilS)
                                                        {
                                                            if($tampilS['id_satuan'] == $data['satuan'])
                                                                $nama_satuan = $tampilS['nama_satuan'];
                                                        }
                                                        echo $nama_satuan;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $value = $data['sifat_kpi'];
                                                        foreach($db->tampil_polarisasi() as $tampil)
                                                        {
                                                            if($tampil['id_polarisasi'] == $value)
                                                                $ket = $tampil['nama_polarisasi'];
                                                        }

                                                        echo $ket;
                                                    ?>
                                                </td>
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
                    searching : true,
                    ordering : false
                });
            });
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>