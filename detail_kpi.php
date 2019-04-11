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

    $id_anggotaD = $_GET['id_anggota'];
    $id_jabatanD = $_GET['id_jabatan'];
    $id_unitD = $_GET['id_unit'];
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
							<h4 class="page-title">Data KPI Individu Detail</h4>
                        </div>
                        <div class="col-xs-4 text-right m-b-30">
                            <?php
                                $b1 = 0;
                                error_reporting(0);
                                foreach($db->tampil_waktu_input() as $tampil)
                                {
                                    $sekarang = date('Y-m-d');
                                    if($sekarang >= $tampil['tanggal_awal_input'] AND $sekarang <= $tampil['tanggal_akhir_input'] AND $tampil['jenis_input'] == 1)
                                        $b1 = 1;
                                }
                                
                                if($b1 == 1)
                                {
                                    echo '
                                        <a href="input_kpi_anggota.php?id_anggota='.$id_anggotaD.'&&id_jabatan='.$id_jabatanD.'&&id_unit='.$id_unitD.'" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> Tambah Data KPI Individu Untuk Anggota Sub Ordinat</a>
                                    ';
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
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
                            <center><div style="background-color:#7CFC00; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi1">Data Diverifikasi</div></center>
                            <center><div style="background-color:red; width:20%; color:white; padding:5px; display:none; margin-bottom:2%;" id="notifikasi2">Data Batal Diverifikasi</div></center>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
                            <?php
                                $ket = '';
                                $totB = $db->total_bobot($id_anggotaD, $id_jabatanD, $id_unitD, $idA);
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
                                    header('location:data_kpi_verifikasi.php');
                                }
                                else if(isset($_POST['tombolSimpan']))
                                {
                                    $eksekusi = $db->revisi_nilai($_POST['id_kpi'], $_POST['bobot'], $_POST['sasaran']);
                                    if($eksekusi == 2 || $eksekusi == 3)
                                        echo '<center><div style="background-color:red; width:20%; color:white; padding:5px; margin-bottom:1%;">Data Gagal Disimpan</div></center>';
                                }
                                else if(isset($_POST['tombolCatatan']))
                                {
                                    $eksekusi = $db->input_catatan($id_anggotaD, $id_jabatanD, $id_unitD, $idA, $_POST['catatan']);
                                    if($eksekusi == 2 || $eksekusi == 3)
                                        echo '<center><div style="background-color:red; width:20%; color:white; padding:5px; margin-bottom:1%;">Data Gagal Disimpan</div></center>';
                                }
                                else if(isset($_POST['tombolHapusC']))
                                {
                                    $eksekusi = $db->hapus_catatan($id_anggotaD, $id_jabatanD, $id_unitD, $idA);
                                    if($eksekusi == 2 || $eksekusi == 3)
                                        echo '<center><div style="background-color:red; width:20%; color:white; padding:5px; margin-bottom:1%;">Data Gagal Dihapus</div></center>';
                                }

                                if($db->hitung_catatan($id_anggotaD, $id_jabatanD, $id_unitD, $idA) > 0)
                                {
                                    echo '<div class="alert alert-info">
                                            <div class="row" style="vertical-align:bottom;">
                                                <div class="col-md-10">
                                                    <b>Catatan : </b>'.$db->tampil_catatan($id_anggotaD, $id_jabatanD, $id_unitD, $idA).'
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
							<div class="table-responsive">
                                <div class="row">
                                    <form action="" method="POST">
                                    <div class="col-md-12">
                                        <table class="table table-striped custom-table m-b-0 display" id="tabel">
                                            <thead>
                                                <tr>
                                                    <th>Nama Pegawai</th>
                                                    <th>Jabatan</th>
                                                    <th>Unit</th>
                                                    <th>KPI</th>
                                                    <th>Deskripsi</th>
                                                    <th>Bobot (%)</th>
                                                    <th>Sasaran/Target</th>
                                                    <th>Satuan</th>
                                                    <th>Polarisasi</th>
                                                    <th>Tahun</th>
                                                    <th class="text-right">Verifikasi</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $no = 0;
                                                error_reporting(0);
                                                foreach($db->tampil_kpi_detail($id_anggotaD, $id_jabatanD, $id_unitD, $idA) as $data)
                                                {
                                                    $no = $no+1;
                                                    $id1 = 'bobot'.$data['id_kpi'];
                                                    $id2 = 'sasaran'.$data['id_kpi'];
                                                    $id3 = 'hapusData'.$data['id_kpi'];
                                                    $id4 = 'baris'.$data['id_kpi'];
                                                    $id5 = 'tempat'.$data['id_kpi'];
                                                    $r1 = '';
                                                    $r2 = '';

                                                    if($data['status'])
                                                    {
                                                        $r1 = 'readonly="readonly"';
                                                        $r2 = 'readonly="readonly"';
                                                    }
                                            ?>
                                                    <tr id="<?php echo $id4; ?>">
                                                        <td><?php echo $data['nama']; ?></td>
                                                        <td><?php echo $data['nama_jabatan']; ?></td>
                                                        <td><?php echo $data['nama_unit']; ?></td>
                                                        <td><?php echo $data['kpi']; ?></td>
                                                        <td><?php echo $data['deskripsi']; ?></td>
                                                        <td>
                                                            <input type="hidden" class="form-control" name="id_kpi[]" value="<?php echo $data['id_kpi']; ?>">
                                                            <input type="text" class="form-control" id="<?php echo $id1; ?>" name="bobot[]" value="<?php echo $data['bobot']; ?>" <?php echo $r1; ?>>
                                                        </td>
                                                        <td><input type="text" class="form-control" id="<?php echo $id2; ?>" name="sasaran[]" value="<?php echo $data['sasaran']; ?>" <?php echo $r2; ?>></td>
                                                        <td><?php echo $data['nama_satuan']; ?></td>
                                                        <td><?php echo $data['nama_polarisasi']; ?></td>
                                                        <td><?php echo $data['tahun']; ?></td>
                                                        <td class="text-center">
                                                            <div class="dropdown">
                                                                <input data-id="<?php echo $data['id_kpi']; ?>" type="checkbox" <?php echo ($data['status'] == '1')?'checked':''; ?> data-field='status1' id='verifikasi1' <?php echo $k1; ?>>
                                                            </div>
                                                        </td>
                                                        <td class="text-center" id="<?php echo $id5; ?>">
                                                            <?php
                                                                if($data['status'] == 0 AND $b1 == 1)
                                                                    echo '<a href="#" id="'.$id3.'" class="btn btn-danger" onclick="fungsi_hapus('.$data['id_kpi'].')">Hapus</a>';
                                                                else
                                                                    echo '<a href="#" id="'.$id3.'" class="btn btn-danger" disabled="disabled">Hapus</a>';                                       
                                                            ?>
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
                            <br>
                            <div class="row">
                                <div class="col-md-12" align="right">
                                    <button type="" name="tombolKembali" class="btn btn-primary">Kembali</button>
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#laporan">Catatan</a>
                                    <button type="submit" name="tombolSimpan" class="btn btn-success">Simpan</button>
                                </div>
                                </form>
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
                                                    if($db->hitung_catatan($id_anggotaD, $id_jabatanD, $id_unitD, $idA) == 0)
                                                        echo '<textarea name="catatan" cols="30" rows="10" class="form-control" placeholder="Silahkan Masukkan Catatan Untuk Data KPI yang Ada"></textarea>';
                                                    else
                                                        echo '<textarea name="catatan" cols="30" rows="10" class="form-control">'.$db->tampil_catatan($id_anggotaD, $id_jabatanD, $id_unitD, $idA).'</textarea>';
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
                        }
                    });
                });
            });

            function fungsi_hapus(id_kpi = null){
                var id = '#baris'+id_kpi;
                $.ajax({
                    url : 'verifikasi_final.php',
                    type : 'get',
                    data:{
                        'id_kpi' : id_kpi,
                        'jenis' : 'hapus_kpi'
                    },
                    success:function(html){
                        if(html == 1)
                        {
                            $(id).fadeOut("slow", function(){
                                $(id).remove();
                            });
                        }
                        else
                        {
                            alert('Gagal Dihapus');
                        }
                    }
                });
            }
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>