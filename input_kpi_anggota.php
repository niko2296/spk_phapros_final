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

	$id_anggotaD = $_GET['id_anggota'];
	$id_jabatanD = $_GET['id_jabatan'];
	$id_departemenD = $_GET['id_departemen'];
	$id_unitD = $_GET['id_unit'];

	$idA = 'kosong';
	foreach($db->tampil_periode() as $tP)
	{
		if($tP['status'] == 1)
		{
			$tA = $tP['tahun'];
			$idA = $tP['id_periode'];
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
											echo '<li><a href="kompetensi_individu.php">Data Kompetensi Individu</a></li>';
										if($eksekusi2 == 1 || $_SESSION['aksus'] == TRUE)
											echo '<li><a href="kompetensi_sub.php">Data Kompetensi Sub Ordinat</a></li>';
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
						<div class="col-xs-8">
							<h4 class="page-title">Input Data KPI Individu Untuk Anggota Sub Ordinat</h4>
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
											<label>Mau Input Berapa KPI ?</label>
											<input type="text" value="" class="form-control" name="jml_kpi">
										</div>
									</div>
									<div class="col-sm-6">
										<button class="btn btn-primary" type="submit" name="tombolKirim" style="margin-top:6%;">Kirim Data</button>
										<button class="btn btn-danger" type="submit" name="tombolKembali" style="margin-top:6%;">Kembali</button>
									</div>
								</div>
                            </form>
						</div>
					</div>
					<?php
						if(isset($_POST['tombolKirim']))
						{
							$jmlB = $db->total_bobot($id_anggotaD, $id_jabatanD, $id_departemenD, $id_unitD, $idA);
							$html = '
							<br><br><br>
							<form action="simpan_kpi_anggota.php" method="POST" id="kpi_input">
							<div class="row">
                                <div class="col-md-4">
                                    <input type="hidden" name="id_anggota" value="'.$_GET['id_anggota'].'">
                                    <input type="hidden" name="id_jabatan" value="'.$_GET['id_jabatan'].'">
                                    <input type="hidden" name="id_departemen" value="'.$_GET['id_departemen'].'">
                                    <input type="hidden" name="id_unit" value="'.$_GET['id_unit'].'">
									<select name="id_periode" class="form-control">
							';
										foreach($db->tampil_periode() as $tampilP)
										{
											if($tampilP['status'] == 1)
											{
												$html .= '<option value="'.$tampilP['id_periode'].'">'.$tampilP['tahun'].'</option>';
											}
										}
							$html .= '
									</select>
								</div>
								<div class="col-md-8">
									<div class="alert alert-info">
										<div class="row" style="vertical-align:bottom;">
											<div class="col-md-12" align="center">
												<b>Bobot Saat Ini : <font id="skor">'.$jmlB.'</font>%</b>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
								<div class="row" style="border:1px solid black;color:black; background-color:white; padding:1%;">
									<div class="col-md-12">
										<div class="table-responsive">
											<table class="table table-striped custom-table m-b-0">
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

							echo $html;

							$jml_kpi = $_POST['jml_kpi'];
							for($i=1; $i<=$jml_kpi; $i++)
							{
					?>
								<!-- Form Kedua -->
											<tbody>
												<?php $id4 = "konten".$i; ?>
												<tr id="<?php echo $id4; ?>">
													<td><input type="text" value="" class="form-control cek" name="kpi[]"></td>
													<td><textarea name="deskripsi[]" id="" cols="30" rows="0" class="form-control cek"></textarea></td>
													<td><input type="text" value="" class="form-control cek cek2" name="bobot[]"></td>
													<td><input type="text" value="" class="form-control cek" name="sasaran[]"></td>
													<td>
														<?php $id1 = "satuan".$i; ?>
														<select id="<?php echo $id1; ?>" name="satuan[] cek" class="select" style="width:100%;" onchange="fungsi1(<?php echo $i; ?>)">
															<option value="">Silahkan Pilih Satuan</option>
															<?php
																foreach($db->tampil_satuan($idA) as $tampil)
																{
																		echo '<option value="'.$tampil['id_satuan'].'">'.$tampil['nama_satuan'].'</option>';
																}
															?>
														</select>
													</td>
													<td>
														<?php $id2 = "sifat_kpi".$i; ?>
														<select id="<?php echo $id2; ?>" name="sifat_kpi[] cek" class="select" style="width:100%;">
															<option value="">Silahkan Pilih Polarisasi</option>
														</select>
													</td>
													<td>
														<?php $id3 = "hapus".$i; ?>
														<button class="btn btn-danger" id="<?php echo $id3; ?>" onclick="fungsi2(<?php echo $i; ?>)">Hapus</button>
													</td>
												</tr>
											</tbody>
								<!-- Akhiran Form Kedua -->
					<?php
							}
							echo '
										</table>
										</div>
									</div>
								</div>
								<div class="m-t-20 text-center">
									<button class="btn btn-primary" type="submit" name="tombolSimpan">Simpan Data KPI Individu</button>
								</div>
							</form>
							';
                        }
                        else if(isset($_POST['tombolKembali']))
                        {
                            header("location:detail_kpi.php?id_anggota=$id_anggotaD&&id_jabatan=$id_jabatanD&&id_departemen=$id_departemenD&&id_unit=$id_unitD");
                        }
					?>
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

				$("#kpi_input").on("submit", function(e){
                    var inputan = $("#kpi_input").find(".cek");
                    var inputan2 = $("#kpi_input").find(".cek2");
                    var v = '';
                    var k = [];
                    var p = 0;
					var j = 0;
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

					$.each(inputan2, function(i){
                        v = $(this).val();
                        j = parseInt(j) + parseInt(v);
					});
					var tot = parseInt(document.getElementById('skor').innerHTML) + j;
					if(tot > 100)
					{
						e.preventDefault();
						alert('Bobot Melebihi dari 100%');
						tot = 0;
					}
					else if(tot < 100)
					{
						e.preventDefault();
						alert('Bobot Kurang dari 100%');
						tot = 0;
					}
                });
            });

			function fungsi1(param = 0){
				var v1 = '#satuan'+param;
				var v2 = '#sifat_kpi'+param;
				var v3 = 'sifat_kpi'+param;
				var id = $(v1).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					var result = JSON.parse(data);
					document.getElementById(v3).innerHTML = '';
					$.each(result, function (index, value) {
						var jenis_polarisasi = value.id_polarisasi;
						var ket = value.nama_polarisasi;

						$(v2).append($('<option/>', { 
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
		</script>
    </body>
</html>
<?php
	ob_end_flush();
?>