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
							<h4 class="page-title">Detail Kriteria Nilai (<b>Periode 
                                <?php
                                    foreach($db->tampil_periode($_GET['id_periode']) as $dataP)
                                    {
                                        $tP = $dataP['tahun'];
                                        $sP = $dataP['status'];
                                    }
                                    echo $tP;
                                ?>
                            </b>)
                            </h4>
						</div>
					</div>
					<div class="row">

                        <?php
                            if(isset($_POST['tombolEdit'])){
                                $eksekusi = $db->edit_kriteria($_POST['id_kriteria_edit'], $_POST['bmin_edit'], $_POST['bmax_edit'], $_POST['kriteria_nilai_edit'], $_POST['keterangan_edit']);
                                if($eksekusi == 2 || $eksekusi == 3)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                                else if($eksekusi == 1)
                                {
                                    echo '
                                        <script>
                                            alert("Data Berhasil Disimpan");
                                            window.location = "detail_kriteria.php?id_periode='.$_GET['id_periode'].'";
                                        </script>
                                    ';
                                }
                            }
                            else if(isset($_POST['tombolHapus']))
                            {
                                $eksekusi = $db->hapus_kriteria($_POST['id_kriteria_hapus']);
                                if($eksekusi == 2 || $eksekusi == 3)
                                {
                                    echo '<div class="alert alert-danger">Data Gagal Disimpan</div>';
                                }
                                else if($eksekusi == 1)
                                {
                                    echo '
                                        <script>
                                            alert("Data Berhasil Dihapus");
                                            window.location = "detail_kriteria.php?id_periode='.$_GET['id_periode'].'";
                                        </script>
                                    ';
                                }
                            }
                            else if(isset($_POST['tombolCopySatuan']))
                            {
                                $eksekusi = $db->copy_kriteria(1, $_POST['id_copy'], $_POST['periode']);
                                if($eksekusi == 2 || $eksekusi == 3)
                                {
                                    echo '
                                        <script>
                                            alert("Data Gagal Di-copy");
                                            window.location = "kriteria_nilai.php";
                                        </script>
                                    ';
                                }
                                else if($eksekusi == 1)
                                {
                                    echo '
                                        <script>
                                            alert("Data Berhasil Di-copy");
                                            window.location = "kriteria_nilai.php";
                                        </script>
                                    ';
                                }
                            }
                            else if(isset($_POST['tombolCopyAll']))
                            {
                                $eksekusi = $db->copy_kriteria(2, $_POST['id_copy'], $_POST['periode']);
                                if($eksekusi == 2)
                                {
                                    echo '
                                        <script>
                                            alert("Terdapat Data yang Gagal Di-copy");
                                            window.location = "kriteria_nilai.php";
                                        </script>
                                    ';
                                }
                                else if($eksekusi == 1)
                                {
                                    echo '
                                        <script>
                                            alert("Data Berhasil Di-copy");
                                            window.location = "kriteria_nilai.php";
                                        </script>
                                    ';
                                }
                                else if($eksekusi == 3)
                                {
                                    echo '
                                        <script>
                                            alert("Data Kriteria Nilai Sudah Sama Dengan Tahun Tujuan");
                                            window.location = "kriteria_nilai.php";
                                        </script>
                                    ';
                                }
                            }
                        ?>

						<div class="col-md-12">
							<div class="table-responsive">
                                <table class="table table-striped custom-table m-b-0 display" id="tabel">
									<thead>
										<tr>
											<th>Batas Minimum</th>
											<th>Batas Maksimum</th>
											<th>Kriteria Nilai</th>
											<th>Keterangan</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $no = 0;
                                        error_reporting(0);
                                        foreach($db->tampil_kriteria($_GET['id_periode']) as $data)
                                        {
                                            $no = $no+1;
                                    ?>
                                            <tr>
                                                <td><?php echo $data['batas_minimum']; ?></td>
                                                <td><?php echo $data['batas_maksimum']; ?></td>
                                                <td><?php echo $data['kriteria_nilai']; ?></td>
                                                <td><?php echo $data['keterangan']; ?></td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li><a href="#" title="Edit" data-toggle="modal" data-target="#copy<?php echo $data['id_kriteria']; ?>"><i class="fa fa-copy m-r-5"></i> Copy</a></li>
                                                            <?php
                                                                if($sP == 1)
                                                                {
                                                            ?>
                                                                    <li><a href="#" title="Edit" data-toggle="modal" data-target="#edit_ticket<?php echo $data['id_kriteria']; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                                    <li><a href="#" title="Delete" data-toggle="modal" data-target="#delete_ticket<?php echo $data['id_kriteria']; ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                                            <?php
                                                                }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div id="edit_ticket<?php echo $data['id_kriteria']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <div class="modal-content modal-lg">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Kriteria Nilai</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="#">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Batas Minimum</label>
                                                                            <input class="form-control" type="hidden" name="id_kriteria_edit" value="<?php echo $data['id_kriteria']; ?>">
                                                                            <input class="form-control" type="text" name="bmin_edit" value="<?php echo $data['batas_minimum']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Batas Maksimum</label>
                                                                            <input class="form-control" type="text" name="bmax_edit" value="<?php echo $data['batas_maksimum']; ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Kriteria Nilai</label>
                                                                            <input class="form-control" type="text" name="kriteria_nilai_edit" value="<?php echo $data['kriteria_nilai']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Keterangan</label>
                                                                            <textarea class="form-control" name="keterangan_edit" cols="30" rows="0"><?php echo $data['keterangan']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="m-t-20 text-center">
                                                                    <button class="btn btn-primary" type="submit" name="tombolEdit">Edit Data Kriteria Nilai</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhiran Modal Edit -->

                                            <!-- Modal Hapus -->
                                            <div id="delete_ticket<?php echo $data['id_kriteria']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content modal-md">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Data Kriteria Nilai</h4>
                                                        </div>
                                                        <form method="POST" action="#">
                                                            <div class="modal-body card-box">
                                                                <p>Yakin Untuk Menghapus Kriteria Nilai <b><?php echo $data['kriteria_nilai']; ?></b> ?</p>
                                                                <input type="hidden" name="id_kriteria_hapus" value="<?php echo $data['id_kriteria']; ?>">
                                                                <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                                                                    <button type="submit" name="tombolHapus" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhiran Modal Hapus -->

                                            <!-- Modal Copy -->
                                            <div id="copy<?php echo $data['id_kriteria']; ?>" class="modal custom-modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content modal-md">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Copy Satuan</h4>
                                                        </div>
                                                        <form method="POST" action="#">
                                                            <div class="modal-body card-box">
                                                                <p>Yakin Untuk Mengcopy Kriteria Nilai <b><?php echo $data['kriteria_nilai']."</b> dari Periode ".$tP; ?> ?</p>
                                                                <input type="hidden" name="id_copy" value="<?php echo $data['id_kriteria']; ?>">
                                                                <select name="periode" class="form-control">
                                                                    <option value="">Silahkan Pilih Periode</option>
                                                                    <?php
                                                                        foreach($db->tampil_periode() as $tampil)
                                                                        {
                                                                            if($tampil['status'] == 1)
                                                                            {
                                                                                echo '<option value="'.$tampil['id_periode'].'">'.$tampil['tahun'].'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                                                                    <button type="submit" name="tombolCopySatuan" class="btn btn-primary">Copy data</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Akhiran Modal Copy -->
                                    <?php
                                        }
                                    ?>
									</tbody>
								</table>
							</div>
						</div>
                        <div class="col-md-12" align="right">
                            <a href="kriteria_nilai.php" title="Kembali">
                                <button class="btn btn-primary" type="submit" name="">Kembali</button>
                            </a>
                            <a href="#" title="CopyAll" data-toggle="modal" data-target="#copyAll">
                                <button class="btn btn-danger" type="submit" name="modalCopyAll">Copy Semua Data</button>
                            </a>
                        </div>

                        <!-- Modal Copy All -->
                        <div id="copyAll" class="modal custom-modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content modal-md">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Copy Kriteria Nilai</h4>
                                    </div>
                                    <form method="POST" action="#">
                                        <div class="modal-body card-box">
                                            <p>Yakin Untuk Meng-<i>copy</i> Kriteria Nilai <?php echo "Pada Periode ".$tP; ?> ?</p>
                                            <input type="hidden" name="id_copy" value="<?php echo $_GET['id_periode']; ?>">
                                            <select name="periode" class="form-control">
                                                <option value="">Silahkan Pilih Periode</option>
                                                <?php
                                                    foreach($db->tampil_periode() as $tampilP)
                                                    {
                                                        if($tampilP['status'] == 1)
                                                        {
                                                            echo '<option value="'.$tampilP['id_periode'].'">'.$tampilP['tahun'].'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                                                <button type="submit" name="tombolCopyAll" class="btn btn-primary">Copy Data</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Akhiran Modal Copy All -->

					</div>
                </div>
            </div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
		<!-- <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script> -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<!-- <script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script> -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>

        <script type="text/javascript">
            $('#tabel').DataTable({
                searching : true,
                ordering : false,
                paging : false,
                info : false
            });
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>