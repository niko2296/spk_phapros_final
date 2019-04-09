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
    <!-- <body onkeydown="myFunction()"> -->
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
                                {
                                    echo '<li><a href="settings.php">Settings</a></li>';
                                }
                            ?>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
            </div>
            <?php
                if(isset($_POST['tombolHapus'])){
                    $id_aturan_hapus = $_POST['id_aturan_hapus'];
                    $eksekusi = $db->hapus_aturan($id_aturan_hapus);
                }
            ?>
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
									<li><a href="waktu_input.php">Waktu Input</a></li>
                                    <li><a href="waktu_verifikasi.php">Waktu Verifikasi</a></li>
                                </ul>
							</li>
                            <?php
                                }
                                if($m4 == 1 || $_SESSION['aksus'] == TRUE)
                                {
                            ?>
                            <li class="active"> 
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
								<a href="#"><i class="la la-certificate"></i> <span> Kompetensi</span> <span class="menu-arrow"></span></a>
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
							<h4 class="page-title">Akses Menu</h4>
                            <center><div style="background-color:#7CFC00; width:40%; color:white; padding:5px; display:none;" id="notifikasi1">Penambahan Hak Akses</div></center>
                            <center><div style="background-color:red; width:40%; color:white; padding:5px; display:none;" id="notifikasi2">Pencabutan Hak Akses</div></center>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							&nbsp;
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 display" id="tabel">
									<thead>
										<tr>
											<th>Jabatan</th>
                                            <th>Master Data</th>
                                            <th>Aturan Penilai</th>
                                            <th>Aturan Waktu</th>
                                            <th>Akses Menu</th>
                                            <th>Data KPI Individu</th>
                                            <th>Data KPI Sub Ordinat</th>
                                            <th>Data KPI Keseluruhan</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $no = 0;
                                        $m0 = 0;
                                        $m1 = 0;
                                        $m2 = 0;
                                        $m3 = 0;
                                        $m4 = 0;
                                        $m5 = 0;
                                        $m6 = 0;
                                        error_reporting(0);
                                        foreach($db->tampil_jabatan() as $data)
                                        {
                                            $no = $no+1;
                                            foreach($db->tampil_akses() as $data2)
                                            {
                                                if($data2['id_jabatan'] == $data['id_jabatan'])
                                                {
                                                    $m0 = $data2['menu1'];
                                                    $m1 = $data2['menu2'];
                                                    $m2 = $data2['menu3'];
                                                    $m3 = $data2['menu4'];
                                                    $m4 = $data2['menu5'];
                                                    $m5 = $data2['menu6'];
                                                    $m6 = $data2['menu7'];
                                                }
                                            }
                                    ?>
                                            <tr>
                                                <td><?php echo $data['nama_jabatan']; ?></td>
                                                <td><center><input data-id="<?php echo $data['id_jabatan']; ?>" data-field="menu1" type="checkbox" id='verifikasi1' <?php echo ($m0 == 1)?'checked':''; ?>></center></td>
                                                <td><center><input data-id="<?php echo $data['id_jabatan']; ?>" data-field="menu2" type="checkbox" id='verifikasi2' <?php echo ($m1 == 1)?'checked':''; ?>></center></td>
                                                <td><center><input data-id="<?php echo $data['id_jabatan']; ?>" data-field="menu3" type="checkbox" id='verifikasi3' <?php echo ($m2 == 1)?'checked':''; ?>></center></td>
                                                <td><center><input data-id="<?php echo $data['id_jabatan']; ?>" data-field="menu4" type="checkbox" id='verifikasi4' <?php echo ($m3 == 1)?'checked':''; ?>></center></td>
                                                <td><center><input data-id="<?php echo $data['id_jabatan']; ?>" data-field="menu5" type="checkbox" id='verifikasi5' <?php echo ($m4 == 1)?'checked':''; ?>></center></td>
                                                <td><center><input data-id="<?php echo $data['id_jabatan']; ?>" data-field="menu6" type="checkbox" id='verifikasi6' <?php echo ($m5 == 1)?'checked':''; ?>></center></td>
                                                <td><center><input data-id="<?php echo $data['id_jabatan']; ?>" data-field="menu7" type="checkbox" id='verifikasi7' <?php echo ($m6 == 1)?'checked':''; ?>></center></td>
                                            </tr>
                                    <?php
                                            $m0 = 0;
                                            $m1 = 0;
                                            $m2 = 0;
                                            $m3 = 0;
                                            $m4 = 0;
                                            $m5 = 0;
                                            $m6 = 0;
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
		<!-- <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script> -->
		<!-- <script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script> -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
		<script type="text/javascript" src="assets/js/select2.min.js"></script>
		<script type="text/javascript" src="assets/js/moment.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script type="text/javascript" src="assets/js/app.js"></script>

        <script>
            $(document).ready(function () {
                $("#tabel").DataTable({
                    ordering : false,
                    searching : true
                });
                $("#notifikasi1").css("display","none");
                $("#notifikasi2").css("display","none");
                $('#tabel').on('change','#verifikasi1',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi_akses.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'field' : $(this).data('field'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
                $('#tabel').on('change','#verifikasi2',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi_akses.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'field' : $(this).data('field'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
                $('#tabel').on('change','#verifikasi3',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi_akses.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'field' : $(this).data('field'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
                $('#tabel').on('change','#verifikasi4',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi_akses.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'field' : $(this).data('field'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
                $('#tabel').on('change','#verifikasi5',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi_akses.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'field' : $(this).data('field'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
                $('#tabel').on('change','#verifikasi6',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi_akses.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'field' : $(this).data('field'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
                $('#tabel').on('change','#verifikasi7',function(e){
                    var v = ($(this).is(':checked'))?'1':'0';
                    $.ajax({
                        url : 'verifikasi_akses.php',
                        type : 'get',
                        data:{
                            'id' : $(this).data('id'),
                            'field' : $(this).data('field'),
                            'value' : v
                        },
                        success:function(html){
                            if(html == 1)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi1").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi1").fadeOut('#notifikasi1');}, 1500);
                            }
                            else if(html == 2)
                            {
                                $(document).ready(function(){setTimeout(function(){$("#notifikasi2").fadeIn('slow');}, 300);});
                                setTimeout(function(){$("#notifikasi2").fadeOut('#notifikasi2');}, 1500);
                            }
                        }
                    });
                });
            });
        </script>
        <script>
            // function myFunction(){
            //     if(event.keyCode == 8) {
            //         event.preventDefault()
            //     }
            // }
        </script>
    </body>
</html>
<?php
    ob_end_flush();
?>