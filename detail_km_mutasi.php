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
    $id_departemenD = $_GET['id_departemen'];
    $id_unitD = $_GET['id_unit'];

    foreach($db->tampil_anggota($id_anggotaD) as $tc)
        $nama_anggota = $tc['nama'];
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
							<h4 class="page-title">Detail Kompetensi - <b>
                            <?php
                                $nj = $db->tampil_jabatan_detail($id_jabatanD, 1);
                                $nd = $db->tampil_jabatan_detail($id_departemenD, 2);
                                $nu = $db->tampil_jabatan_detail($id_unitD, 3);
                                
                                echo $nama_anggota." ( ".$nj." - ".$nd." - ".$nu." )"; 
                            ?>
                            </b></h4>
						</div>
                        <div class="col-xs-5" align="right">
                            <a class="btn btn-warning" href="detail_jabatan_matriks_mutasi.php?id_jabatan=<?php echo $id_jabatanD."&&id_departemen=".$id_departemenD."&&id_unit=".$id_unitD; ?>">Kembali Halaman Sebelumnya</a>
                        </div>
					</div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if(isset($_POST['tombolSimpanK']))
                                {
                                    $id_ki = $_POST['id_ki'];
                                    $jumlah = count($_POST['id_ki']);
                                    $peringkat = [];
                                    if($jumlah > 0)
                                    {
                                        for($i=0; $i<$jumlah; $i++)
                                        {
                                            $p1 = 'peringkat'.$id_ki[$i];
                                            $peringkat[] = $_POST[$p1]; 
                                        }

                                        $eksekusi = $db->revisi_kompetensi_matriks($id_ki, $peringkat, $idA, $id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $id_anggotaV, $jabatan, $departemenL, $unitL);
                                        if($eksekusi == 1)
                                        {
                                            echo    '
                                                        <script>
                                                            alert("Berhasil Disimpan");
                                                            window.location = "detail_km_mutasi.php?id_anggota='.$id_anggotaD.'&&id_jabatan='.$id_jabatanD.'&&id_departemen='.$id_departemenD.'&&id_unit='.$id_unitD.'";
                                                        </script>
                                                    ';
                                        }
                                        else if($eksekusi == 2)
                                        {
                                            echo    '
                                                        <script>
                                                            alert("Gagal Disimpan");
                                                            window.location = "detail_km_mutasi.php?id_anggota='.$id_anggotaD.'&&id_jabatan='.$id_jabatanD.'&&id_departemen='.$id_departemenD.'&&id_unit='.$id_unitD.'";
                                                        </script>
                                                    ';
                                        }
                                    }
                                }

                                echo '<center><div style="background-color:#7CFC00; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi1">Data Diverifikasi</div></center>';
                                echo '<center><div style="background-color:red; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi2">Data Batal Diverifikasi</div></center>';
                            ?>
                        </div>
                    </div>
					<div class="row" style="border:1px solid black;color:black; background-color:white; padding:1%;">
                        <form action="#" method="POST">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th style="width:10%;">Nama Kompetensi</th>
                                                    <th style="width:30%;">Indikator Terendah</th>
                                                    <th style="width:30%;">Indikator Tertinggi</th>
                                                    <th style="width:25%;">Peringkat</th>
                                                    <th style="width:5%;">Verifikasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                error_reporting(0);
                                                $p = 0;
                                                $cv = 0;
                                                foreach($db->tampil_kompetensi_individu($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA) as $data)
                                                {
                                                    foreach($db->tampil_kompetensi_individu($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data['jenis'], $data['id_kompetensi_individu']) as $data2)
                                                    {
                                                        $d = '';
                                                        $p = $p+1;
                                                        $v1 = 'peringkat'.$data2['id_kompetensi_individu'];
                                                        $v2 = 'id_ki'.$p;
                                                        
                                                        if($db->cek_verif_kompetensi_matriks($data2['id_kompetensi_individu'], $id_anggotaV, $jabatan, $departemenL, $unitL) > 0)
                                                        {
                                                            $cv = $cv+1;
                                                            $d = 'disabled="disabled"';
                                                        }
                                                        
                                                        $id_peringkat = $data['id_peringkat'];
                                                        if($db->hitung_perubahan_kompetensi_matriks($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA, $data2['id_kompetensi_individu'], $id_anggotaV, $jabatan, $departemenL, $unitL) > 0)
                                                            $id_peringkat = $db->cek_perubahan4($data2['id_kompetensi_individu'], $id_anggotaV, $jabatan, $departemenL, $unitL);
                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?php 
                                                                        echo $data2['nama_kompetensi'];
                                                                        echo '<input type="hidden" name="id_ki[]" id="'.$v2.'" value="'.$data2['id_kompetensi_individu'].'" '.$d.'>';
                                                                ?>
                                                            </td>
                                                            <td><?php echo $data2['indikator_terendah']; ?></td>
                                                            <td><?php echo $data2['indikator_tertinggi']; ?></td>
                                                            <td>
                                                            <?php
                                                                foreach($db->tampil_peringkat($idA) as $tampilP)
                                                                {
                                                                    $s = '';
                                                                    if($tampilP['id_peringkat'] == $id_peringkat)
                                                                        $s = 'checked';
                                                                    
                                                                    echo '
                                                                        <label class="btn btn-inline">
                                                                            <input class="form-control peringkat'.$data2['id_kompetensi_individu'].'" type="radio" name="'.$v1.'" value="'.$tampilP['id_peringkat'].'" '.$s.' '.$d.'> '.$tampilP['peringkat'].'
                                                                        </label>
                                                                    ';
                                                                }
                                                            ?>
                                                            </td>
                                                            <td align="center"><input type="checkbox" name="verifikasi" id="verifikasi" class="form-control" data-id_anggota="<?php echo $id_anggotaD; ?>" data-id_jabatan="<?php echo $id_jabatanD; ?>" data-id_departemen="<?php echo $id_departemenD; ?>" data-id_unit="<?php echo $id_unitD; ?>" data-verifikator="<?php echo $id_anggotaV; ?>" data-jabatan_verifikator="<?php echo $jabatan; ?>" data-departemen_verifikator="<?php echo $departemenL; ?>" data-unit_verifikator="<?php echo $unitL; ?>" data-id="<?php echo $data2['id_kompetensi_individu']; ?>" data-jenis="<?php echo $data2['jenis']; ?>" <?php echo ($db->cek_verif_kompetensi_matriks($data2['id_kompetensi_individu'], $id_anggotaV, $jabatan, $departemenL, $unitL) > 0)?('checked'):(''); ?>></td>
                                                        </tr>
                                            <?php
                                                    }
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                    if($p == 0)
                                    {
                                        echo '
                                            <div class="col-md-12" align="right">
                                                <button name="" class="btn btn-danger" disabled="disabled">Data Kompetensi Belum Diisikan</button>
                                            </div>
                                            ';
                                    }
                                    else
                                    {
                                        echo '
                                            <div class="col-md-12" align="right">
                                                <button class="btn btn-primary" type="submit" name="tombolSimpanK">Simpan Data</button>
                                            </div>
                                            ';
                                    }
                                ?>
                            </div>
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
                    paging : false,
                    info : false
                });

                $('.table').on('change','#verifikasi',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    var paramId = $(this).data('id');
                    var verifikator = $(this).data('verifikator');
                    var jk = $(this).data('jenis');
                    var jabatan_verifikator = $(this).data('jabatan_verifikator');
                    var departemen_verifikator = $(this).data('departemen_verifikator');
                    var unit_verifikator = $(this).data('unit_verifikator');
                    var id_anggota = $(this).data('id_anggota');
                    var id_jabatan = $(this).data('id_jabatan');
                    var id_departemen = $(this).data('id_departemen');
                    var id_unit = $(this).data('id_unit');
                    var lokasi = "detail_km_mutasi.php?id_anggota="+ id_anggota +"&&id_jabatan="+ id_jabatan +"&&id_departemen="+ id_departemen +"&&id_unit="+ id_unit;
                    $.ajax({
                        url : 'verifikasi_final.php',
                        type : 'get',
                        data:{
                            'id' : paramId,
                            'value' : v,
                            'jenis' : 'verif_matriks',
                            'verifikator' : verifikator,
                            'jk' : jk,
                            'id_anggota' : id_anggota,
                            'id_jabatan' : id_jabatan,
                            'id_departemen' : id_departemen,
                            'id_unit' : id_unit,
                            'jabatan_verifikator' : jabatan_verifikator,
                            'departemen_verifikator' : departemen_verifikator,
                            'unit_verifikator' : unit_verifikator

                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $('.peringkat'+paramId).attr('disabled', 'disabled');
                                $('#id_ki'+paramId).attr('disabled', 'disabled');
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $('.peringkat'+paramId).removeAttr('disabled');
                                $('#id_ki'+paramId).removeAttr('disabled');
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                            else{
                                alert("Terdapat Kegagal Pengiriman Data");
                            }
                            setTimeout(function(){window.location = lokasi}, 1000);
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