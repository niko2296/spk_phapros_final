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
    $id_anggotaV = $_SESSION['id_anggota'];
    $idA = 'kosong';
    foreach($db->tampil_periode() as $tPer)
    {
        if($tPer['status'] == 1)
        {
            $idA = $tPer['id_periode'];
        }
    }

    $id_anggotaD = $_GET['id_anggota'];
    $id_jabatanD = $_GET['id_jabatan'];
    $id_unitD = $_GET['id_unit'];
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
                                            <li><a href="data_kelompok.php">Kelompok Jabatan</a></li>
                                            <li><a href="data_departemen.php">Departemen</a></li>
                                            <li><a href="data_unit.php">Unit</a></li>
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
								<a href="#"><i class="la la-tasks"></i> <span> Kompetensi</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
                                    <li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>
									<li><a href="kompetensi_sub.php">Data Kompetensi Sub Ordinat</a></li>
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
						<div class="col-xs-8">
							<h4 class="page-title">Detail Realisasi KPI</h4>
						</div>
                        <div class="col-xs-4 text-right m-b-10">
                            <a class="btn btn-warning" href="data_kpi_verifikasi.php">Kembali Pada Data KPI Sub Ordinat</a>
                        </div>
					</div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if(isset($_POST['tombolSimpanRealisasi']))
                                {
                                    $input = $db->input_realisasi($_POST['id_kpi'], $id_anggotaD, $id_jabatanD, $id_unitD, $idA, $_POST['realisasi'], $_POST['keterangan']);
                                    if($input == 2)
                                    {
                                        echo '
                                            <script>
                                                alert("Data Gagal Disimpan");
                                            </script>
                                        ';
                                    }
                                    if($input == 1)
                                    {
                                        echo '
                                            <script>
                                                alert("Data Berhasil Disimpan");
                                            </script>
                                        ';
                                    }
                                }
                            ?>
                            <center><div style="background-color:#7CFC00; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi1">Data Diverifikasi</div></center>
                            <center><div style="background-color:red; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi2">Data Batal Diverifikasi</div></center>
                        </div>
                    </div>
					<div class="row">
                        <form action="#" method="POST">
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
                                            <th>Periode</th>
                                            <th style="width:100px;">Realisasi</th>
                                            <th>Keterangan</th>
                                            <th>Verifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        error_reporting(0);
                                        foreach($db->tampil_kpi_detail($id_anggotaD, $id_jabatanD, $id_unitD, $idA) as $data)
                                        {
                                            if($data['status'] == 1)
                                            {
                                    ?>
                                            <tr>
                                                <td><?php echo $data['kpi']; ?></td>
                                                <td><?php echo $data['deskripsi']; ?></td>
                                                <td><?php echo $data['bobot']; ?></td>
                                                <td><?php echo $data['sasaran']; ?></td>
                                                <td><?php echo $data['nama_satuan']; ?></td>
                                                <td><?php echo $data['nama_polarisasi']; ?></td>
                                                <td><?php echo $data['tahun']; ?></td>
                                                <td>
                                                    <input type="hidden" name="id_kpi[]" class="form-control" value="<?php echo $data['id_kpi']; ?>">
                                                    <input type="text" id="realisasi<?php echo $data['id_kpi']; ?>" name="realisasi[]" class="form-control" value="<?php echo ($db->hitung_realisasi($data['id_kpi']) > 0)?($db->tampil_realisasi(1, $data['id_kpi'])):('0'); ?>" <?php echo ($db->cek_verif_realisasi($data['id_kpi']) == 1)?('readonly="readonly"'):(''); ?>>
                                                </td>
                                                <td><textarea id="keterangan<?php echo $data['id_kpi']; ?>" name="keterangan[]" cols="10" rows="1" class="form-control" placeholder="Isikan Keterangan" <?php echo ($db->cek_verif_realisasi($data['id_kpi']) == 1)?('readonly="readonly"'):(''); ?>><?php echo ($db->hitung_realisasi($data['id_kpi']) > 0)?($db->tampil_realisasi(2, $data['id_kpi'])):(''); ?></textarea></td>
                                                <td class="text-center"><input type="checkbox" name="verifikasi1" id="verifikasi1" data-id="<?php echo $data['id_kpi']; ?>" data-id_verifikator="<?php echo $id_anggotaV; ?>" class="form-control" <?php echo ($db->cek_verif_realisasi($data['id_kpi']) == 1)?('checked'):(''); ?>></td>
                                            </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12" align="right">
                            <button class="btn btn-primary" type="submit" name="tombolSimpanRealisasi">Simpan Data</button>
                        </div>
                        </form>
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
            $(document).ready(function()
            {    
                $('#tabel').DataTable({
                    searching : false,
                    ordering : false,
                    paging : false,
                    info : false
                });

                $('.table').on('change','#verifikasi1',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    var paramId = $(this).data('id');
                    var id_verifikator = $(this).data('id_verifikator');
                    var id1 = 'realisasi';
                    var id2 = 'keterangan';
                    $.ajax({
                        url : 'verifikasi_final.php',
                        type : 'get',
                        data:{
                            'id' : paramId,
                            'value' : v,
                            'jenis' : 'verif_realisasi',
                            'id_verifikator' : id_verifikator
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                                document.getElementById(id1+paramId).readOnly = true;
                                document.getElementById(id2+paramId).readOnly = true;
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                                document.getElementById(id1+paramId).readOnly = false;
                                document.getElementById(id2+paramId).readOnly = false;
                            }
                            else{
                                alert("Terdapat Kegagal Pengiriman Data");
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