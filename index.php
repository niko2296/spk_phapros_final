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
						<img src="assets/img/logo.png" width="75" height="" alt="">
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
											<li><a href="data_kpi_mutasi.php">Data KPI Individu (Mutasi)</a></li>
											<li><a href="copy_kpi.php">Copy Data KPI Individu</a></li>
                                    <?php 
										}
										$eksekusi2 = $db->cek_akses(2, $jabatan, $departemenL, $unitL);
                                        if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                    ?>
                                    		<li><a href="data_kpi_verifikasi.php">Data KPI Sub Ordinat</a></li>
                                    		<li><a href="data_kpi_verifikasi_mutasi.php">Data KPI Sub Ordinat (Mutasi)</a></li>
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
                                        {
											echo '<li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>';
											echo '<li><a href="kompetensi_individu_mutasi.php">Data Kompetensi Individu (Mutasi)</a></li>';
                                        }
										if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
										{
											if($db->cek_matriks($departemenL) <= 0 || $_SESSION['aksus'] == TRUE)
											{
												echo '<li><a href="kompetensi_sub.php">Data Kompetensi Sub Ordinat</a></li>';
												echo '<li><a href="kompetensi_sub_mutasi.php">Data Kompetensi Sub Ordinat (Mutasi)</a></li>';
											}
										}
										if($_SESSION['aksus'] == TRUE || $db->cek_matriks($departemenL) > 0)
										{
											echo '<li><a href="kompetensi_matriks.php">Data Kompetensi Matriks</a></li>';
											echo '<li><a href="kompetensi_matriks_mutasi.php">Data Kompetensi Matriks (Mutasi)</a></li>';
										}
									?>
                                </ul>
							</li>
							<li class="submenu">
                                <a href="#"><i class="la la-sticky-note-o"></i> <span> Laporan</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="laporan_individu.php">Penilaian Individu</a></li>
									<?php
                                        if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                            echo '<li><a href="laporan_sub_ordinat.php">Penilaian Sub Ordinat</a></li>';
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
						<div class="col-md-12">
							<div class="alert alert-warning">
								<div class="row">
									<div class="col-md-12">
										<b>Untuk Dapat Lebih Memahami Penggunaan Dari Sistem Penilaian Kinerja Ini, Dapat Men-Download Panduan Penggunaan Dari Sistem Penilaian Kinerja. <a href="">Download</a></b>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">KRITERIA NILAI</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th>Batas Minimum</th>
													<th>Batas Maksimum</th>
													<th>Kriteria Nilai</th>
													<th>Keterangan</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($db->tampil_kriteria($idA) as $data)
													{
														echo '
															<tr>
																<td>'.$data['batas_minimum'].'</td>
																<td>'.$data['batas_maksimum'].'</td>
																<td>'.$data['kriteria_nilai'].'</td>
																<td>'.$data['keterangan'].'</td>
															</tr>
														';
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									&nbsp;
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-table">
								<div class="panel-heading">
									<h3 class="panel-title">POLARISASI</h3>
								</div>
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped custom-table m-b-0">
											<thead>
												<tr>
													<th>Nama Polarisasi</th>
													<th>Jumlah Aturan</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($db->tampil_polarisasi($idA) as $data)
													{
														echo '
															<tr>
																<td>'.$data['nama_polarisasi'].'</td>
															';
															$jmlP = 0;
														foreach($db->tampil_aturan_polarisasi() as $data1)
														{
															if($data['id_polarisasi'] == $data1['id_polarisasi'])
																$jmlP = $jmlP+1;   
														}
														echo '
																<td>'.$jmlP.' Aturan Polarisasi</td>
																<td><a href="#" title="Detail Polarisasi" class="tampil_detail" data-id_polarisasi="'.$data['id_polarisasi'].'"> Detail</a></td>
															</tr>
														';

														echo '
															<div id="detail_polarisasi" class="modal custom-modal fade" role="dialog">
																<div class="modal-dialog">
																	<div class="modal-content modal-md">
																		<div class="modal-header">
																			<h4 class="modal-title">Data Aturan Polarisasi</h4>
																		</div>
																		<form method="POST" action="#" id="inputan">
																			<div class="modal-body card-box">
																				<div class="modal-data"></div>
																				<div class="m-t-20"> 
																					<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
																				</div>
																			</div>
																		</form>
																	</div>
																</div>
															</div>
														';
													}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									&nbsp;
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-table">
										<div class="panel-heading">
											<h3 class="panel-title">PERSENTASE NILAI</h3>
										</div>
										<div class="panel-body">
											<div class="table-responsive">
												<table class="table table-striped custom-table m-b-0">
													<thead>
														<tr>
															<th>Persentase KPI</th>
															<th>Persentase Kompetensi</th>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach($db->tampil_persentase($idA) as $data)
															{
																echo '
																	<tr>
																		<td>'.$data['persentase_kpi'].'</td>
																		<td>'.$data['persentase_kompetensi'].'</td>
																	</tr>
																';
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="panel-footer">
											&nbsp;
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-table">
										<div class="panel-heading">
											<h3 class="panel-title">WAKTU INPUT</h3>
										</div>
										<div class="panel-body">
											<div class="table-responsive">
												<table class="table table-striped custom-table m-b-0">
													<thead>
														<tr>
															<th>Tanggal Mulai</th>
															<th>Tanggal Selesai</th>
															<th>Jenis Input</th>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach($db->tampil_waktu_inputD($tA) as $data)
															{
																if($data['jenis_input'] == 0)
																	$k = '-';
																else if($data['jenis_input'] == 1)
																	$k = 'Input Pengajuan KPI';
																else if($data['jenis_input'] == 2)
																	$k = 'Input Realisasi KPI';
																echo '
																	<tr>
																		<td>'.date('d F Y', strtotime($data['tanggal_awal_input'])).'</td>
																		<td>'.date('d F Y', strtotime($data['tanggal_akhir_input'])).'</td>
																		<td>'.$k.'</td>
																	</tr>
																';
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="panel-footer">
											&nbsp;
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-table">
										<div class="panel-heading">
											<h3 class="panel-title">WAKTU VERIFIKASI</h3>
										</div>
										<div class="panel-body">
											<div class="table-responsive">
												<table class="table table-striped custom-table m-b-0">
													<thead>
														<tr>
															<th>Tanggal Mulai</th>
															<th>Tanggal Selesai</th>
															<th>Jenis Verifikasi</th>
														</tr>
													</thead>
													<tbody>
														<?php
															foreach($db->tampil_waktu_verifikasiD($tA) as $data)
															{
																if($data['jenis_verifikasi'] == 1)
																	$k = 'Verifikasi Pengajuan KPI';
																else if($data['jenis_verifikasi'] == 2)
																	$k = 'Verifikasi Realisasi KPI';
																else 
																	$k = '-';
																echo '
																	<tr>
																		<td>'.date('d F Y', strtotime($data['tanggal_awal_verifikasi'])).'</td>
																		<td>'.date('d F Y', strtotime($data['tanggal_akhir_verifikasi'])).'</td>
																		<td>'.$k.'</td>
																	</tr>
																';
															}
														?>
													</tbody>
												</table>
											</div>
										</div>
										<div class="panel-footer">
											&nbsp;
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="notification-box">
					<div class="msg-sidebar notifications msg-noti">
						<div class="topnav-dropdown-header">
							<span>Messages</span>
						</div>
						<div class="drop-scroll msg-list-scroll">
							<ul class="list-box">
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author">Richard Miles </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item new-message">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">John Doe</span>
												<span class="message-time">1 Aug</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Tarah Shropshire </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Mike Litorus</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Catherine Manseau </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">D</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Domenic Houston </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">B</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Buster Wigton </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">R</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Rolland Webber </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">C</span>
											</div>
											<div class="list-body">
												<span class="message-author"> Claire Mapes </span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">M</span>
											</div>
											<div class="list-body">
												<span class="message-author">Melita Faucher</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">J</span>
											</div>
											<div class="list-body">
												<span class="message-author">Jeffery Lalor</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">L</span>
											</div>
											<div class="list-body">
												<span class="message-author">Loren Gatlin</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
								<li>
									<a href="chat.html">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">T</span>
											</div>
											<div class="list-body">
												<span class="message-author">Tarah Shropshire</span>
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer">
							<a href="chat.html">See all messages</a>
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
		<script>
			$(function(){
				$(document).on('click','.tampil_detail',function(e){
					e.preventDefault();
					$("#detail_polarisasi").modal('show');
					var id_polarisasi = $(this).data('id_polarisasi');
					$.ajax({
						type : 'get',
						url : 'verifikasi_final.php',
						data:{
                            'id_polarisasi' : id_polarisasi,
                            'jenis' : 'cek_polarisasi'

                        },
						success : function(html){
							$('.modal-data').html(html);
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