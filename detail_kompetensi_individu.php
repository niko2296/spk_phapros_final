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
    $id_anggotaD = $_SESSION['id_anggota'];
    $id_unitD = $_SESSION['id_unit'];
    $idA = 'kosong';

	foreach($db->tampil_periode() as $tP)
	{
		if($tP['status'] == 1)
		{
			$tA = $tP['tahun'];
			$idA = $tP['id_periode'];
		}	
    }
    
    $id_anggotaD2 = $_GET['id_anggota'];
    $id_jabatanD2 = $_GET['id_jabatan_lama'];
    $id_departemenD2 = $_GET['id_departemen_lama'];
    $id_unitD2 = $_GET['id_unit_lama'];
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
							<li class="active submenu">
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
						<div class="col-xs-8">
							<h4 class="page-title">
                                <?php
                                    $nj = $db->tampil_jabatan_detail($id_jabatanD2, 1);
                                    $nd = $db->tampil_jabatan_detail($id_departemenD2, 2);
                                    $nu = $db->tampil_jabatan_detail($id_unitD2, 3);
                                    echo 'Data Kompetensi Individu (Mutasi) - <b>( '.$nj.' - '.$nd.' - '.$nd.' )</b>';
                                ?>
                            </h4>
						</div>
                        <?php
                            echo '
                                <div class="col-xs-4 text-right m-b-30">
                                    <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Input Data Kompetensi Individu</a>
                                </div>
                            ';
                        ?>
					</div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if(isset($_POST['tombolSimpan']))
                                {
                                    $jml = $_POST['jml'];
                                    for($a=1; $a<=$jml; $a++)
                                    {
                                        $var = 'peringkat'.$a;
                                        $peringkat[] = $_POST[$var];
                                    }

                                    $jml2 = $_POST['jml2'];
                                    for($a=1; $a<=$jml2; $a++)
                                    {
                                        $var = 'peringkat_khusus'.$a;
                                        $peringkat_khusus[] = $_POST[$var];
                                    }

                                    $eksekusi = $db->input_kompetensi_individu($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $_POST['id_kompetensi'], $peringkat, $_POST['jenis1'], $_POST['id_kompetensi_khusus'], $peringkat_khusus, $_POST['jenis2'], $idA);
                                    if($eksekusi == 1)
                                        echo '
                                            <script>
                                                alert("Berhasil Disimpan");
                                                window.location = "kompetensi_individu_mutasi.php";
                                            </script>
                                        ';
                                    else 
                                        echo '
                                            <script>
                                                alert("Gagal Disimpan");
                                                window.location = "kompetensi_individu_mutasi.php";
                                            </script>
                                        ';
                                }
                                else if(isset($_POST['tombolEdit']))
                                {
                                    $eksekusi = $db->edit_kompetensi_individu($_POST['id_ki_edit'], $_POST['peringkat_edit']);
                                    if($eksekusi == 1)
                                        echo '
                                            <script>
                                                alert("Berhasil Disimpan");
                                                window.location = "kompetensi_individu_mutasi.php";
                                            </script>
                                        ';
                                    else 
                                        echo '
                                            <script>
                                                alert("Gagal Disimpan");
                                                window.location = "kompetensi_individu_mutasi.php";
                                            </script>
                                        ';
                                }
                            ?>
                        </div>
                    </div>
					<div class="row" style="border:1px solid black;color:black; background-color:white; padding:1%;">
                        <div class="col-md-12">
                            <?php
                                if($db->cek_matriks($id_departemenD2) == 0)
                                {
                                    if($db->hitung_perubahan_kompetensi($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA) > 0)
                                    {
                                        echo '<div class="alert alert-warning">
                                                <div class="row" style="vertical-align:bottom;">
                                                    <div class="col-md-10">
                                                        <b>'.$db->pemberi_perubahan_kompetensi($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA).'</b> Telah Melakukan Perubahan Pada Data Peringkat Pada Kompetensi Individu.
                                                    </div>
                                                </div>
                                            </div>';
                                    }

                                    if($db->hitung_catatan2($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA) > 0)
                                    {
                                        echo '<div class="alert alert-info">
                                                <div class="row" style="vertical-align:bottom;">
                                                    <div class="col-md-12">
                                                        <b>Catatan : </b>'.$db->tampil_catatan2($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA).'
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 display" id="tabel">
									<thead>
										<tr>
											<th>Kompetensi</th>
                                            <th>Indikator Terendah</th>
                                            <th>Indikator Tertinggi</th>
                                            <?php
                                                if($db->cek_matriks($id_departemenD2) > 0)
                                                {
                                                    if($db->hitung_perubahan_kompetensi($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA) == 0)
                                                    {
                                                        echo '<th>Peringkat</th>';
                                                    }
                                                    else
                                                    {
                                                        echo '<th>Peringkat Asli</th>';
                                                        foreach($db->tampil_perubahan($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA) as $tabel)
                                                        {
                                                            echo '<th>Peringkat ('.$tabel['nama'].')</th>';
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    if($db->hitung_perubahan_kompetensi($id_anggotaD, $jabatan, $departemenL, $unitL, $idA) == 0)
                                                    {
                                                        echo '<th>Peringkat</th>';
                                                    }
                                                    else
                                                    {
                                                        echo '<th>Peringkat Asli</th>';    
                                                        echo '<th>Peringkat Perubahan</th>';    
                                                    }    
                                                }
                                            ?>
                                            <th>Status</th>
											<th class="text-right">Actions</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        error_reporting(0);
                                        foreach($db->tampil_kompetensi_individu($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA) as $data)
                                        {
                                            foreach($db->tampil_kompetensi_individu($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA, $data['jenis'], $data['id_kompetensi_individu']) as $data2)
                                            {
                                    ?>
                                                <tr>
                                                    <td><?php echo $data2['nama_kompetensi']; ?></td>
                                                    <td><?php echo $data2['indikator_terendah']; ?></td>
                                                    <td><?php echo $data2['indikator_tertinggi']; ?></td>
                                                    <td>
                                                        <?php
                                                            foreach($db->tampil_peringkat($idA) as $tampilP)
                                                            {
                                                                if($tampilP['id_peringkat'] == $data2['id_peringkat'])
                                                                    echo $tampilP['peringkat'];
                                                            }
                                                        ?>
                                                    </td>
                                                    <?php
                                                        if($db->cek_matriks($id_departemenD2) == 0)
                                                        {
                                                            $id_peringkat = null;
                                                            if($db->hitung_perubahan_kompetensi($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA, $data2['id_kompetensi_individu']) > 0)
                                                            {    
                                                                $id_peringkat = $db->cek_perubahan3($data2['id_kompetensi_individu']);
                                                                foreach($db->tampil_peringkat($idA) as $tampilP)
                                                                {
                                                                    if($tampilP['id_peringkat'] == $id_peringkat)
                                                                        echo '<td>'.$tampilP['peringkat'].'</td>';
                                                                }
                                                            }
                                                        }
                                                        else 
                                                        {
                                                            if($db->hitung_perubahan_kompetensi($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA, $data2['id_kompetensi_individu']) > 0)
                                                            {
                                                                foreach($db->tampil_perubahan($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $idA) as $tabel)
                                                                {
                                                                    if($data2['id_kompetensi_individu'] == $tabel['id_kompetensi_asli'])
                                                                        echo '<td>'.$tabel['peringkat'].'</td>';
                                                                    else 
                                                                        echo '<td>-</td>';
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    <td><?php echo ($data2['status'] == 1)?('Sudah Diverifikasi'):('Belum Diverifikasi'); ?></td>
                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                            <ul class="dropdown-menu pull-right">
                                                                <?php
                                                                    if($db->cek_verif_kompetensi($data['id_kompetensi_individu']) == 1)
                                                                        echo '<li>Tidak Terdapat Aksi</li>';
                                                                    else 
                                                                        echo '<li><a href="#" title="Edit" data-toggle="modal" data-target="#edit_ticket'.$data['id_kompetensi_individu'].'"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>';
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- Modal Edit -->
                                                <div id="edit_ticket<?php echo $data2['id_kompetensi_individu']; ?>" class="modal custom-modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Data Kompetensi Individu</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST" action="#" id="">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Indikator Terendah</label>
                                                                                <input class="form-control" type="hidden" name="id_ki_edit" value="<?php echo $data2['id_kompetensi_individu']; ?>">
                                                                                <textarea class="form-control" rows="10"  disabled="disabled"><?php echo $data2['indikator_terendah']; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <center><label>Peringkat</label></center>
                                                                                <div align="center">
                                                                                    <?php
                                                                                        foreach($db->tampil_peringkat($idA) as $tampilP)
                                                                                        {
                                                                                            $s = '';
                                                                                            if($tampilP['id_peringkat'] == $data2['id_peringkat'])
                                                                                                $s = 'checked';
                                                                                            echo '
                                                                                                <label class="btn btn-inline">
                                                                                                    <input class="form-control cek" type="radio" name="peringkat_edit" value="'.$tampilP['id_peringkat'].'" '.$s.'> '.$tampilP['peringkat'].'
                                                                                                </label>
                                                                                            ';
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Indikator Tertinggi</label>
                                                                                <textarea class="form-control" rows="10"  disabled="disabled"><?php echo $data2['indikator_tertinggi']; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="m-t-20 text-center">
                                                                        <button class="btn btn-primary" type="submit" name="tombolEdit">Edit Data Kompetensi Individu</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Akhiran Modal Edit -->
                                    <?php
                                            }
                                        }
                                    ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                    <br>
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <a href="kompetensi_individu_mutasi.php" class="btn btn-warning">Kembali Halaman Sebelumnya</a>
                        </div>
                    </div>
                </div>
            </div>
			<div id="add_ticket" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-content modal-lg">
						<div class="modal-header">
							<h4 class="modal-title">Input Data Kompetensi Individu</h4>
						</div>
						<div class="modal-body">
                            <div class="row" style="border:1px solid black;color:black; background-color:white; padding:1%;">
                                <form method="POST" action="#" id="golongan_input">
                                <div class="col-md-12">
                                    <table class="table table-striped custom-table m-b-0" id="tabel2">
                                        <thead>
                                            <tr>
                                                <th><center><b>Indikator Terendah</b></center></th>
                                                <th><center><b>Peringkat</b></center></th>
                                                <th><center><b>Indikator Tertinggi</b></center></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 0;
                                                $c = 0;
                                                foreach ($db->tampil_soal($idA, $id_jabatanD2) as $tampilS)
                                                {
                                                    if($db->cek_kompetensi($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $tampilS['id_kompetensi'], 1) == 0)
                                                    {
                                                        $no = $no+1;
                                            ?>
                                                        <tr>
                                                            <div class="form-group">
                                                                <td><?php echo $tampilS['indikator_terendah']; ?></td>
                                                                <td>
                                                                    <div align="center">
                                                                        <?php
                                                                            $v1 = 'peringkat'.$no;
                                                                            foreach($db->tampil_peringkat($idA) as $tampilP)
                                                                                echo '
                                                                                    <label class="btn btn-inline">
                                                                                        <input class="form-control cek" type="radio" name="'.$v1.'" value="'.$tampilP['id_peringkat'].'"> '.$tampilP['peringkat'].'
                                                                                    </label>
                                                                                ';
                                                                            echo '<input type="hidden" value="'.$tampilS['id_kompetensi'].'" name="id_kompetensi[]">';
                                                                            echo '<input type="hidden" value="1" name="jenis1">';
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $tampilS['indikator_tertinggi']; ?></td>
                                                            </div>
                                                        </tr>
                                            <?php
                                                        $c = $c+1;
                                                    }
                                                }

                                                $no2 = 0;
                                                $c2 = 0;
                                                foreach($db->tampil_soal_khusus($idA, $id_jabatanD2, $id_departemenD2, $id_unitD2) as $tampilSK)
                                                {
                                                    if($db->cek_kompetensi($id_anggotaD2, $id_jabatanD2, $id_departemenD2, $id_unitD2, $tampilSK['id_kompetensi_khusus'], 2) == 0)
                                                    {
                                                        $no2 = $no2+1;
                                            ?>
                                                        <tr>
                                                            <div class="form-group">
                                                                <td><?php echo $tampilSK['indikator_terendah']; ?></td>
                                                                <td>
                                                                    <div align="center">
                                                                        <?php
                                                                            $v1 = 'peringkat_khusus'.$no2;
                                                                            foreach($db->tampil_peringkat($idA) as $tampilP)
                                                                                echo '
                                                                                    <label class="btn btn-inline">
                                                                                        <input class="form-control cek" type="radio" name="'.$v1.'" value="'.$tampilP['id_peringkat'].'"> '.$tampilP['peringkat'].'
                                                                                    </label>
                                                                                ';
                                                                            echo '<input type="hidden" value="'.$tampilSK['id_kompetensi_khusus'].'" name="id_kompetensi_khusus[]">';
                                                                            echo '<input type="hidden" value="2" name="jenis2">';
                                                                        ?>
                                                                    </div>
                                                                </td>
                                                                <td><?php echo $tampilSK['indikator_tertinggi']; ?></td>
                                                            </div>
                                                        </tr>
                                            <?php
                                                        $c2 = $c2+1;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table> 
                                </div>
                                <div class="col-md-12" align="right">
                                    <?php
                                        if($c != 0 || $c2 != 0)
                                        {
                                            echo '<input type="hidden" value="'.$no.'" name="jml">';
                                            echo '<input type="hidden" value="'.$no2.'" name="jml2">';
                                            echo '<input type="submit" class="btn btn-primary" name="tombolSimpan" value="Simpan">';
                                        }
                                    ?>
                                </div>  
                                </form>
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
                    paging : false
                });
                $('#tabel2').DataTable({
                    searching : true,
                    ordering : false,
                    info : false,
                    paging : false
                });

                $("#golongan_input").on("submit", function(e){
                    var inputan = $("#golongan_input").find(".cek");
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