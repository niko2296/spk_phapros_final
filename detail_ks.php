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
                            <li class="active submenu">
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
						<div class="col-xs-7">
							<h4 class="page-title">Detail Kompetensi - <b><?php echo $nama_anggota; ?></b></h4>
						</div>
                        <div class="col-xs-5" align="right">
                            <a class="btn btn-warning" href="kompetensi_sub.php">Kembali Pada Data Kompetensi Sub Ordinat</a>
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

                                        $eksekusi = $db->edit_kompetensi_penilai($id_ki, $peringkat);
                                        if($eksekusi == 1)
                                        {
                                            echo    '
                                                        <script>
                                                            alert("Berhasil Disimpan");
                                                            window.location = "detail_ks.php?id_anggota='.$id_anggotaD.'&&id_jabatan='.$id_jabatanD.'&&id_unit='.$id_unitD.'";
                                                        </script>
                                                    ';
                                        }
                                        else if($eksekusi == 2)
                                        {
                                            echo    '
                                                        <script>
                                                            alert("Gagal Disimpan");
                                                            window.location = "detail_ks.php?id_anggota='.$id_anggotaD.'&&id_jabatan='.$id_jabatanD.'&&id_unit='.$id_unitD.'";
                                                        </script>
                                                    ';
                                        }
                                    }
                                }
                                else if(isset($_POST['tombolCatatan']))
                                {
                                    $eksekusi = $db->input_catatan2($id_anggotaD, $id_jabatanD, $id_unitD, $idA, $_POST['catatan']);
                                    if($eksekusi == 2 || $eksekusi == 3)
                                        echo '<center><div style="background-color:red; width:20%; color:white; padding:5px; margin-bottom:1%;">Data Gagal Disimpan</div></center>';
                                    else if($eksekusi == 1)
                                        echo '
                                            <script>
                                                window.location = "detail_ks.php?id_anggota='.$id_anggotaD.'&&id_jabatan='.$id_jabatanD.'&&id_unit='.$id_unitD.'";
                                            </script>
                                        ';
                                }
                                else if(isset($_POST['tombolHapusC']))
                                {
                                    $eksekusi = $db->hapus_catatan2($id_anggotaD, $id_jabatanD, $id_unitD, $idA);
                                    if($eksekusi == 2 || $eksekusi == 3)
                                        echo '<center><div style="background-color:red; width:20%; color:white; padding:5px; margin-bottom:1%;">Data Gagal Dihapus</div></center>';
                                }

                                echo '<center><div style="background-color:#7CFC00; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi1">Data Diverifikasi</div></center>';
                                echo '<center><div style="background-color:red; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi2">Data Batal Diverifikasi</div></center>';
                                
                                if($db->hitung_catatan2($id_anggotaD, $id_jabatanD, $id_unitD, $idA) > 0)
                                {
                                    echo '<div class="alert alert-info">
                                            <div class="row" style="vertical-align:bottom;">
                                                <div class="col-md-10">
                                                    <b>Catatan : </b>'.$db->tampil_catatan2($id_anggotaD, $id_jabatanD, $id_unitD, $idA).'
                                                </div>
                                                <div class="col-md-2">
                                                    <form method="POST">
                                                        <button type="submit" name="tombolHapusC" class="btn btn-danger">Hapus Catatan</button>
                                                    </form>
                                                </div>
                                            </div>
                                          </div>';
                                }
                            ?>
                        </div>
                    </div>
					<div class="row">
                        <form action="#" method="POST">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th>Nama Kompetensi</th>
                                                    <th>Indikator Terendah</th>
                                                    <th>Indikator Tertinggi</th>
                                                    <th>Peringkat</th>
                                                    <th>Verifikasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                error_reporting(0);
                                                $p = 0;
                                                foreach($db->tampil_kompetensi_individu($id_anggotaD, $id_jabatanD, $id_unitD, $idA) as $data)
                                                {
                                                    $d = '';
                                                    $p = $p+1;
                                                    $v1 = 'peringkat'.$p;
                                                    $v2 = 'id_ki'.$p;
                                                    
                                                    if($db->cek_verif_kompetensi($data['id_kompetensi_individu']) == 1)
                                                        $d = 'disabled="disabled"';
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                    echo $data['nama_kompetensi'];
                                                                    echo '<input type="hidden" name="id_ki[]" id="'.$v2.'" value="'.$data['id_kompetensi_individu'].'" '.$d.'>';
                                                            ?>
                                                        </td>
                                                        <td><?php echo $data['indikator_terendah']; ?></td>
                                                        <td><?php echo $data['indikator_tertinggi']; ?></td>
                                                        <td>
                                                        <?php
                                                            foreach($db->tampil_peringkat($idA) as $tampilP)
                                                            {
                                                                $s = '';
                                                                if($tampilP['id_peringkat'] == $data['id_peringkat'])
                                                                    $s = 'checked';
                                                                
                                                                echo '
                                                                    <label class="btn btn-inline">
                                                                        <input class="form-control peringkat'.$data['id_kompetensi_individu'].'" type="radio" name="'.$v1.'" value="'.$tampilP['id_peringkat'].'" '.$s.' '.$d.'> '.$tampilP['peringkat'].'
                                                                    </label>
                                                                ';
                                                            }
                                                        ?>
                                                        </td>
                                                        <td align="center"><input type="checkbox" name="verifikasi" id="verifikasi" class="form-control" data-id_anggota="<?php echo $id_anggotaD; ?>" data-verifikator="<?php echo $id_anggotaV; ?>" data-id="<?php echo $data['id_kompetensi_individu']; ?>" <?php echo ($db->cek_verif_kompetensi($data['id_kompetensi_individu']) == 1)?('checked'):(''); ?>></td>
                                                    </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" align="right">
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#laporan">Catatan</a>
                                    <button class="btn btn-primary" type="submit" name="tombolSimpanK">Simpan Data</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Laporan -->
        <div id="laporan" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Catatan KPI</h4>
                    </div>
                    <form method="POST" action="#" id="inputan">
                        <div class="modal-body card-box">
                            <?php
                                if($db->hitung_catatan2($id_anggotaD, $id_jabatanD, $id_unitD, $idA) == 0)
                                    echo '<textarea name="catatan" cols="30" rows="10" class="form-control" placeholder="Silahkan Masukkan Catatan Untuk Data KPI yang Ada"></textarea>';
                                else
                                    echo '<textarea name="catatan" cols="30" rows="10" class="form-control">'.$db->tampil_catatan2($id_anggotaD, $id_jabatanD, $id_unitD, $idA).'</textarea>';
                            ?>
                            <div class="m-t-20"> 
                                <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                                <button type="submit" name="tombolCatatan" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Akhiran Modal Laporan -->

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
                    searching : false,
                    ordering : false,
                    paging : false,
                    info : false
                });

                $('.table').on('change','#verifikasi',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    var paramId = $(this).data('id');
                    var verifikator = $(this).data('verifikator');
                    var id_anggota = $(this).data('id_anggota');
                    var id1 = 'realisasi';
                    var id2 = 'keterangan';
                    $.ajax({
                        url : 'verifikasi_final.php',
                        type : 'get',
                        data:{
                            'id' : paramId,
                            'value' : v,
                            'jenis' : 'verif_kompetensi',
                            'verifikator' : verifikator,
                            'id_anggota' : id_anggota,

                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $('.peringkat'+paramId).attr('disabled', 'disabled');
                                $('#id_ki'+paramId).attr('disabled', 'disabled');
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                                document.getElementById(id1+paramId).readOnly = true;
                                document.getElementById(id2+paramId).readOnly = true;
                            }
                            else if(html == 2)
                            {
                                $('.peringkat'+paramId).removeAttr('disabled');
                                $('#id_ki'+paramId).removeAttr('disabled');
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