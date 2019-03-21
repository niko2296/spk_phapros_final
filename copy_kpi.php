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
                                    <li class="submenu">
                                        <a href="#"><i class="la la-briefcase"></i> <span> Master Data</span> <span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="data_golongan.php">Golongan</a></li>
                                            <li><a href="data_jabatan.php">Jabatan</a></li>
                                            <li><a href="data_unit.php">Departemen/Unit</a></li>
                                            <li><a href="data_anggota.php">Pegawai</a></li>
                                            <li><a href="data_user.php">User</a></li>
                                            <li><a href="data_periode.php">Periode</a></li>
                                            <li><a href="data_polarisasi.php">Polarisasi</a></li>
                                            <li><a href="data_satuan.php">Satuan</a></li>
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
									<li><a href="waktu_input.php">Waktu Input KPI</a></li>
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
                                    <li><a href="data_kpi_verifikasi.php">Data KPI Sub Koordinator</a></li>
                                    <?php
										}
										if($m7 == 1 || $_SESSION['aksus'] == TRUE)
                                        {
                                            echo '<li><a href="data_kpi_seluruh.php">Data KPI Keseluruhan</a></li>';
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
							<h4 class="page-title">Copy Data KPI Individu</h4>
						</div>
						<div class="col-xs-4 text-right m-b-30">
							<!-- <a href="#" class="btn btn-primary rounded pull-right" data-toggle="modal" data-target="#add_ticket"><i class="fa fa-plus"></i> Tambah Data KPI Individu</a> -->
						</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<form action="#" method="POST">
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Mau Meng-Copy Data KPI Individu Tahun Berapa ?</label>
											<input type="text" value="" class="form-control" name="tahun_kpi">
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
							<br><br><br>
							<div class="row">
								<div class="col-md-12">
									<h3>Data Tahun '.$_POST['tahun_kpi'].'</h3>
								</div>
							</div>
							<br>
								<div class="row">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-striped custom-table m-b-0" id="tabel">
											<thead>
												<tr>
													<th>KPI</th>
													<th>Deskripsi</th>
													<th>Bobot (%)</th>
													<th>Sasaran/Target</th>
													<th>Satuan</th>
													<th>Polarisasi</th>
													<th>Action</th>
												</tr>
											</thead>
							';
                            $i = 0;
							$tahun_kpi = $_POST['tahun_kpi'];
                            foreach($db->tampil_kpi() as $tampil)
                            {
                                if($tampil['tahun'] == $tahun_kpi)
                                {
                                    $i = $i + 1;
                                    $id1 = "kpi_c".$tampil['id_kpi'];
                                    $id2 = "deskripsi_c".$tampil['id_kpi'];
                                    $id3 = "bobot_c".$tampil['id_kpi'];
                                    $id4 = "sasaran_c".$tampil['id_kpi'];
                                    $id5 = "satuan_c".$tampil['id_kpi'];
                                    $id6 = "sifat_c".$tampil['id_kpi'];
                                    $id7 = "id_sifat_c".$tampil['id_kpi'];

                                    $value = $tampil['sifat_kpi'];
                                    foreach($db->tampil_polarisasi() as $tampilP)
                                    {
                                        if($tampilP['id_polarisasi'] == $value)
                                            $ket = $tampilP['nama_polarisasi'];
                                    }
					?>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" id="<?php echo $id1; ?>" value="<?php echo $tampil['kpi']; ?>" readonly="readonly" class="form-control"></td>
                                            <td><textarea class="form-control" id="<?php echo $id2; ?>" readonly="readonly"><?php echo $tampil['deskripsi']; ?></textarea></td>
                                            <td><input type="text" id="<?php echo $id3; ?>" value="<?php echo $tampil['bobot']; ?>" readonly="readonly" class="form-control"></td>
                                            <td><input type="text" id="<?php echo $id4; ?>" value="<?php echo $tampil['sasaran']; ?>" readonly="readonly" class="form-control"></td>
                                            <td>
                                                <input type="hidden" id="<?php echo $id5; ?>" value="<?php echo $tampil['satuan']; ?>" readonly="readonly" class="form-control">
                                                <?php
                                                    $nama_satuan = '';
                                                    foreach($db->tampil_satuan() as $tampilS)
                                                    {
                                                        if($tampilS['id_satuan'] == $tampil['satuan'])
                                                            $nama_satuan = $tampilS['nama_satuan'];
                                                    }
                                                    echo '<input type="text" value="'.$nama_satuan.'" readonly="readonly" class="form-control">';
                                                ?>
                                            </td>
                                            <td><input type="text" id="<?php echo $id6; ?>" value="<?php echo $ket; ?>" readonly="readonly" class="form-control">
                                            <input type="hidden" id="<?php echo $id7; ?>" value="<?php echo $tampil['sifat_kpi']; ?>" readonly="readonly" class="form-control"></td>
                                            <td><button class="btn btn-success" onclick="fungsi3(<?php echo $tampil['id_kpi']; ?>)">Copy</button></td>
                                        </tr>
                                    </tbody>
					<?php
                                }
							}
							echo '
										</table>
										</div>
									</div>
								</div>
							';
						}
					?>
                    
                    <!-- Tabel Tampil  -->
                    <div style="margin-top:8%; display:none" id="tampil2">
                    <form action="simpan_kpi.php" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="tahun" value="" placeholder="Tahun Tujuan" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0 display" id="tabel2">
									<thead>
										<tr>
											<th>KPI</th>
                                            <th>Deskripsi</th>
                                            <th>Bobot (%)</th>
                                            <th>Sasaran/Target</th>
                                            <th>Satuan</th>
                                            <th>Polarisasi</th>
                                            <th>Action</th>
										</tr>
									</thead>
									<tbody id="tambahan">
									</tbody>
								</table>
                                <div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="tombolSimpan">Simpan Data KPI Individu</button>
								</div>
							</div>
						</div>
                    </div>
                    </form>
                    </div>
                    <!-- Akhiran Tabel Tampil  -->

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

		<script>
			$(document).ready(function () {
                $(".select").select2({
                    placeholder: "Please Select"
                });
            });

			function fungsi1(param = 0){
				var v1 = "#satuan"+param;
				var v2 = "#sifat_kpi"+param;
                var v3 = "sifat_kpi"+param;
				var id = $(v1).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					var result = JSON.parse(data);
                    document.getElementById(v3).innerHTML = "";
					$.each(result, function (index, value) {
						var jenis_polarisasi = value.id_polarisasi;
						var ket = value.nama_polarisasi;

						$(v2).append($("<option/>", { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			}

			function fungsi2(param = 0){
				var v1 = "#konten"+param;
				$(v1).remove();
			}

            var awal = 0;
            function fungsi3(param = 0){
                var id1 = "#kpi_c"+param;
                var id2 = "#deskripsi_c"+param;
                var id3 = "#bobot_c"+param;
                var id4 = "#sasaran_c"+param;
                var id5 = "#satuan_c"+param;
                var id6 = "#sifat_c"+param;
                var id_sifat = "#id_sifat_c"+param;

                
                $('#tampil2').css('display', 'block');
                $.ajax({
				url: "append.php",
				type: "GET",
                data : {
                    'id1' : $(id1).val(),
                    'id2' : $(id2).val(),
                    'id3' : $(id3).val(),
                    'id4' : $(id4).val(),
                    'id5' : $(id5).val(),
                    'id6' : $(id6).val(),
                    'id_sifat' : $(id_sifat).val(),
                    'param' : param
                },			
				success: function(html) {
                    $('#tambahan').append(html);
				}
				});
                awal = awal + 1;
                alert('Data Di-copy');
            }

            function fungsi4(param = 0){
                awal = awal - 1;
                if(awal == 0)
                    $('#tampil2').css('display', 'none');
                $('#hapusan'+param).remove();
                alert('Data Dihapus');
            }
		</script>
    </body>
</html>
<?php
	ob_end_flush();
?>