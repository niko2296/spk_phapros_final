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

    $id_polarisasi = $_GET['id_polarisasi'];
    $nama_polarisasi = '';
    foreach($db->tampil_polarisasi() as $tampil)
    {
        if($tampil['id_polarisasi'] == $id_polarisasi)
        {
            $tP = $tampil['id_periode'];
            $nama_polarisasi = $tampil['nama_polarisasi'];
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
                                    <li class="active submenu">
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
						</ul>
					</div>
                </div>
            </div>
            <div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-xs-12">
							<h4 class="page-title">Data Aturan Polarisasi "<b><?php echo $nama_polarisasi; ?></b>" </h4>
						</div>
					</div>
                    
                    <?php
                        if(isset($_POST['tombolHapus']))
                        {
                            $id_aturan_polarisasi = $_POST['id_aturan_polarisasi_hapus'];
                            $db->hapus_aturan_polarisasi($id_aturan_polarisasi, $id_polarisasi);
                        }
                        else if(isset($_POST['tombolEdit']))
                        {
                            $id_aturan_polarisasi = $_POST['id_aturan_polarisasi_edit'];
                            $bmi = $_POST['bmi_edit'];
                            $bma = $_POST['bma_edit'];
                            $poin = $_POST['poin_edit'];
                            $db->edit_aturan_polarisasi($id_aturan_polarisasi, $bmi, $bma, $poin, $id_polarisasi);
                        }
                    ?>

                    <div class="row" style="margin-bottom:1%;">
                        <div class="col-md-12">
                            <a href="detail_polarisasi.php?id_periode=<?php echo $tP; ?>" title="Kembali">
                                <button class="btn btn-primary" type="submit" name="modalCopyAll">Kembali Melihat Data Polarisasi</button>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table m-b-0" id="tabel">
                                <thead>
                                    <tr>
                                        <th>Batas Minimal</th>
                                        <th>Batas Maksimal</th>
                                        <th>Poin</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($db->tampil_aturan_polarisasi() as $tampil)
                                        {
                                            if($id_polarisasi == $tampil['id_polarisasi'])
                                            {
                                    ?>
                                            <tr>
                                                <td><?php echo $tampil['bmi']; ?></td>
                                                <td><?php echo $tampil['bma']; ?></td>
                                                <td><?php echo $tampil['poin']; ?></td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#" title="Edit" data-toggle="modal" data-target="#edit_ticket<?php echo $tampil['id_aturan_polarisasi']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                            <li><a href="#" title="Delete" data-toggle="modal" data-target="#delete_ticket<?php echo $tampil['id_aturan_polarisasi']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div id="edit_ticket<?php echo $tampil['id_aturan_polarisasi']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <div class="modal-content modal-lg">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Polarisasi</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="#">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Batas Minimal</label>
                                                                            <input class="form-control" type="hidden" name="id_aturan_polarisasi_edit" value="<?php echo $tampil['id_aturan_polarisasi']; ?>">
                                                                            <input class="form-control" type="text" name="bmi_edit" value="<?php echo $tampil['bmi']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Batas Maksimal</label>
                                                                            <input class="form-control" type="text" name="bma_edit" value="<?php echo $tampil['bma']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Poin</label>
                                                                            <input class="form-control" type="text" name="poin_edit" value="<?php echo $tampil['poin']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="m-t-20 text-center">
                                                                    <button class="btn btn-primary" type="submit" name="tombolEdit">Edit Data Aturan Polarisasi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhiran Modal Edit -->

                                            <!-- Modal Hapus -->
                                            <div id="delete_ticket<?php echo $tampil['id_aturan_polarisasi']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content modal-md">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Golongan</h4>
                                                        </div>
                                                        <form method="POST" action="#">
                                                            <div class="modal-body card-box">
                                                                <p>Yakin Untuk Menghapus Aturan Polarisasi ?</p>
                                                                <input type="hidden" name="id_aturan_polarisasi_hapus" value="<?php echo $tampil['id_aturan_polarisasi']; ?>">
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
                                        }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <div class="row">
						<div class="col-md-10 col-md-offset-1">
							<form action="#" method="POST">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Mau Input Berapa Aturan Polarisasi ?</label>
											<input type="text" value="" class="form-control" name="jml_aturan">
										</div>
									</div>
									<div class="col-sm-6">
										<button class="btn btn-primary" type="submit" name="tombolKirim" style="margin-top:6%;">Kirim Data</button>
									</div>
								</div>
                            </form>
						</div>
					</div>
                        
                    
					<?php
						if(isset($_POST['tombolKirim']))
						{
							echo '
                            <form action="simpan_aturan_polarisasi.php" method="POST">
                            <input type="hidden" name="id_polarisasi" value="'.$id_polarisasi.'">
							<br>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th>Batas Minimal</th>
													<th>Batas Maksimal</th>
													<th>Poin</th>
													<th>Action</th>
												</tr>
											</thead>
							';

							$jml_aturan = $_POST['jml_aturan'];
							for($i=1; $i<=$jml_aturan; $i++)
							{
					?>
								<!-- Form Kedua -->
											<tbody>
												<?php $id4 = "konten".$i; ?>
												<tr id="<?php echo $id4; ?>">
                                                    <td><input type="text" value="" class="form-control" name="bmi[]"></td>
													<td><input type="text" value="" class="form-control" name="bma[]"></td>
													<td><input type="text" value="" class="form-control" name="poin[]"></td>
													<td>
														<?php $id3 = "hapus".$i; ?>
														<button class="btn btn-danger" id="<?php echo $id3; ?>" onclick="fungsi2(<?php echo $i; ?>)">Hapus</button>
													</td>
												</tr>
											</tbody>
								<!-- Akhiran Form Kedua -->
					<?php
							}
							echo '
										</table>
										</div>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="tombolSimpan">Simpan Data Aturan Polarisasi</button>
								</div>
							</form>
							';
						}
					?>
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

		<script type="text/javascript">
            $(document).ready(function(){
                $('#tabel').DataTable({
                    searching : true,
                    ordering : false
                });
            });

            function fungsi2(param = 0){
				var v1 = "#konten"+param;
				$(v1).remove();
			}
        </script>
    </body>
</html>
<?php
	ob_end_flush();
?>