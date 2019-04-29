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
    $anggotaL = $_SESSION['id_anggota'];
    $jabatan = $_SESSION['id_jabatan'];
    $departemenL = $_SESSION['id_departemen'];
    $unitL = $_SESSION['id_unit'];

    $id_anggotaD = $_GET['id_anggota'];
    $id_jabatanD = $_GET['id_jabatan_lama'];
    $id_departemenD = $_GET['id_departemen_lama'];
    $id_unitD = $_GET['id_unit_lama'];
    $idA = 'kosong';

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
                                // error_reporting(0);
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
                            <li class="active submenu">
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
                                    <li><a href="laporan_sub_ordinat.php">Penilaian Sub Ordinat</a></li>
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
						<div class="col-xs-7">
                            <?php
                                $nj = $db->tampil_jabatan_detail($id_jabatanD, 1);
                                $nd = $db->tampil_jabatan_detail($id_departemenD, 2);
                                $nu = $db->tampil_jabatan_detail($id_unitD, 3);
							    echo '<h4 class="page-title">Data KPI Individu <b>('.$nj.' - '.$nd.' - '.$nu.')</b></h4>';
                            ?>
                        </div>
                        <div class="col-xs-5 text-right">
                            <div class="col-md-12 text-right m-b-30">
                                <a href="input_kpi_mutasi.php?id_anggota=<?php echo $id_anggotaD."&&id_jabatan_lama=".$id_jabatanD."&&id_departemen_lama=".$id_departemenD."&&id_unit_lama=".$id_unitD; ?>" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Tambah Data KPI Individu (Mutasi)</a>
                            </div>
                        </div>
                    </div>
					<div class="row" style="border:1px solid black;color:black; background-color:white; padding:1%;">
						<div class="col-md-12">
                            <?php
                                $ket = '';
                                $totB = $db->total_bobot($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA);
                                if($db->hitung_perubahan_usulan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                {
                                    $totB = 0;
                                    $bobot = 0;
                                    foreach($db->tampil_kpi($idA, $id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD) as $tk)
                                    {
                                        $bobot = $tk['bobot'];
                                        foreach($db->cek_perubahan($tk['id_kpi']) as $tc2)
                                        {
                                            if($tc2['bobot'] != '')
                                                $bobot = $tc2['bobot'];
                                            $totB = $totB+$bobot;
                                        }
                                    }
                                }

                                if($totB < 100)
                                    $ket = 'Bobot Masih Kurang dari 100%';
                                else if($totB > 100)
                                    $ket = 'Bobot Lebih dari 100%';
    
                                if($ket != '')
                                {
                                    echo    '<div class="alert alert-danger">
                                                <div class="row" style="vertical-align:bottom;">
                                                    <div class="col-md-12" align="center">
                                                        <b>!! '.$ket.' !!</b>
                                                    </div>
                                                </div>
                                            </div>';
                                }
                                
                                if(isset($_POST['tombolKembali']))
                                {
                                    header('location:data_kpi_mutasi.php');
                                }
                                else if(isset($_POST['tombolHapus']))
                                {
                                    $eksekusi = $db->hapus_kpi($_POST['id_kpi_hapus'], $id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA);
                                    if($eksekusi == 1)
                                    {
                                        echo '
                                            <script>
                                                alert("Data Berhasil Terhapus");
                                                window.location = "detail_kpi_individu_mutasi.php?id_anggota='.$id_anggotaD.'&&id_jabatan_lama='.$id_jabatanD.'&&id_departemen_lama='.$id_departemenD.'&&id_unit_lama='.$id_unitD.'";
                                            </script>
                                        ';
                                    }
                                    else if($eksekusi == 2)
                                    {
                                        echo '
                                            <script>
                                                alert("Data Gagal Terhapus");
                                                window.location = "detail_kpi_individu_mutasi.php?id_anggota='.$id_anggotaD.'&&id_jabatan_lama='.$id_jabatanD.'&&id_departemen_lama='.$id_departemenD.'&&id_unit_lama='.$id_unitD.'";
                                            </script>
                                        ';
                                    }
                                    else
                                    {
                                        echo '
                                            <script>
                                                alert("'.$eksekusi.'");
                                                window.location = "detail_kpi_individu_mutasi.php?id_anggota='.$id_anggotaD.'&&id_jabatan_lama='.$id_jabatanD.'&&id_departemen_lama='.$id_departemenD.'&&id_unit_lama='.$id_unitD.'";
                                            </script>
                                        ';
                                    }
                                }

                                if($db->hitung_perubahan_usulan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                {
                                    echo '<div class="alert alert-warning">
                                            <div class="row" style="vertical-align:bottom;">
                                                <div class="col-md-10">
                                                    <b>'.$db->pemberi_perubahan_usulan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA).'</b> Telah Melakukan Perubahan Pada Data Bobot ataupun Sasaran Usulan KPI.
                                                </div>
                                            </div>
                                          </div>';
                                }
                                if($db->hitung_catatan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                {
                                    echo '<div class="alert alert-info">
                                            <div class="row" style="vertical-align:bottom;">
                                                <div class="col-md-10">
                                                    <b>Catatan : </b>'.$db->tampil_catatan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA).'
                                                </div>
                                            </div>
                                          </div>';
                                }
                            ?>
                        </div>
                        <form action="#" method="POST">
                        <div class="col-md-12">
							<div class="table-responsive">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th>KPI</th>
                                                    <th>Deskripsi</th>
                                                    <?php
                                                        if($db->hitung_perubahan_usulan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                                            echo '
                                                                <th>Bobot Murni (%)</th>
                                                                <th>Bobot Perubahan (%)</th>
                                                                <th>Sasaran/Target Murni</th>
                                                                <th>Sasaran/Target Perubahan</th>
                                                            ';
                                                        else
                                                            echo '
                                                                <th>Bobot (%)</th>
                                                                <th>Sasaran/Target</th>
                                                            ';
                                                    ?>
                                                    <th>Satuan</th>
                                                    <th>Polarisasi</th>
                                                    <th>Periode</th>
                                                    <th>Status</th>
                                                    <th class="text-right">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                error_reporting(0);
                                                foreach($db->tampil_kpi($idA, $id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD) as $data)
                                                {
                                                    $no = $no+1;
                                                    $id_kpi = $data['id_kpi'];
                                                    $bobot = $data['bobot'];
                                                    $sasaran = $data['sasaran'];

                                                    if($db->hitung_perubahan_usulan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                                    {
                                                        foreach($db->cek_perubahan($id_kpi) as $tc)
                                                        {
                                                            if($tc['bobot'] != '' && $tc['sasaran'] != '')
                                                            {
                                                                $bobot = $tc['bobot'];
                                                                $sasaran = $tc['sasaran'];
                                                            }
                                                        }
                                                    }
                                            ?>
                                                    <tr>
                                                        <td><?php echo $data['kpi']; ?></td>
                                                        <td><?php echo $data['deskripsi']; ?></td>
                                                        <?php
                                                            if($db->hitung_perubahan_usulan($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA) > 0)
                                                                echo '
                                                                    <td>'.$data['bobot'].'</td>
                                                                    <td>'.$bobot.'</td>
                                                                    <td>'.$data['sasaran'].'</td>
                                                                    <td>'.$sasaran.'</td>
                                                                ';
                                                            else 
                                                            echo '
                                                                <td>'.$data['bobot'].'</td>
                                                                <td>'.$data['sasaran'].'</td>
                                                            ';
                                                        ?>
                                                        <td><?php echo $data['nama_satuan']; ?></td>
                                                        <td><?php echo $data['nama_polarisasi']; ?></td>
                                                        <td><?php echo $data['tahun']; ?></td>
                                                        <td><?php echo ($data['status'] == 0)?'Belum Verifikasi':'Sudah Verifikasi'; ?></td>
                                                        <td class="text-right">
                                                            <div class="dropdown">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <?php
                                                                        if($data['status'] != 1)
                                                                        {
                                                                    ?>
                                                                            <li><a href="edit_kpi_mutasi.php?id=<?php echo $data['id_kpi']."&&id_anggota=".$id_anggotaD."&&id_jabatan=".$id_jabatanD."&&id_departemen=".$id_departemenD."&&id_unit=".$id_unitD; ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
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
                        <br>
                        <div class="col-md-12" align="right">
                            <button type="submit" name="tombolKembali" class="btn btn-primary">Kembali</button>
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
                    searching : false,
                    ordering : false,
                    info : false,
                    paging : false,
                });

                $("#inputan").on("submit", function(e){
                    var inputan = $("#inputan").find("textarea");
                    var v = '';
                    $.each(inputan, function(i){
                        v = $(this).val();
                        if(v == '')
                        {
                            e.preventDefault();
                            alert('Masih Ada data yang kosong');
                        }
                        v = '';
                    });
                });

                $('.table').on('change','#verifikasi1',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    var paramId = $(this).data('id');
                    var id_anggota = $(this).data('id_anggota');
                    var id_jabatan = $(this).data('id_jabatan');
                    var id_departemen = $(this).data('id_departemen');
                    var id_unit = $(this).data('id_unit');
                    var lokasi = "detail_kpi.php?id_anggota="+id_anggota+"&&id_jabatan="+id_jabatan+"&&id_departemen="+id_departemen+"&&id_unit="+id_unit;
                    var id1 = 'bobot';
                    var id2 = 'sasaran';
                    var id3 = 'tempat';
                    $.ajax({
                        url : 'verifikasi.php',
                        type : 'get',
                        data:{
                            'id' : paramId,
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                                document.getElementById(id1+paramId).readOnly = true;
                                document.getElementById(id2+paramId).readOnly = true;
                                document.getElementById(id3+paramId).innerHTML = '<a href="#" id="hapusData'+paramId+'" class="btn btn-danger" disabled="disabled">Hapus</a>';
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                                document.getElementById(id1+paramId).readOnly = false;
                                document.getElementById(id2+paramId).readOnly = false;
                                document.getElementById(id3+paramId).innerHTML = '<a href="#" id="hapusData'+paramId+'" class="btn btn-danger" onclick="fungsi_hapus('+paramId+')">Hapus</a>';
                            }
                            setTimeout(function(){window.location = lokasi}, 1000);
                        }
                    });
                });
            });
            }
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>