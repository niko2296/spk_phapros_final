<?php
    ob_start();
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
							<li><a href="settings.php">Settings</a></li>
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
                                if($jabatan <= 3)
                                {
                            ?>
							<li class="submenu">
								<a href="#"><i class="la la-briefcase"></i> <span> Master Data</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="data_golongan.php">Golongan</a></li>
									<li><a href="data_jabatan.php">Jabatan</a></li>
									<li><a href="data_unit.php">Departemen/Unit</a></li>
									<li><a href="data_anggota.php">Pegawai</a></li>
									<li><a href="data_satuan.php">Satuan</a></li>
								</ul>
							</li>
							<li> 
								<a href="aturan_penilai.php"><i class="la la-key"></i> <span>Aturan Penilai</span></a>
							</li>
							<?php
								}
							?>
                            <li class="active submenu">
								<a href="#"><i class="la la-clipboard"></i> <span> KPI</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="data_kpi.php">Data KPI Individu</a></li>
									<?php 
										if($jabatan <= 3)
										{
									?>
									<li><a href="data_kpi_verifikasi.php">Data KPI Sub Koordinator</a></li>
									<?php
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
							<h4 class="page-title">Input Data KPI Individu</h4>
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
									</div>
								</div>
                            </form>
						</div>
					</div>
					<?php
						if(isset($_POST['tombolKirim']))
						{
							include "conn/database.php";
							$db = new database();

							echo '
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<form action="simpan_kpi.php" method="POST">
									<input type="hidden" id="jml_kpi" value="'.$_POST['jml_kpi'].'">
							';

							$jml_kpi = $_POST['jml_kpi'];
							for($i=1; $i<=$jml_kpi; $i++)
							{
					?>
								<!-- Form Kedua -->
											<br><br><br>
											<div class="row">
												<h4 align="center">Data Ke-<?php echo $i;?></h4>
												<div class="col-sm-6">
													<div class="form-group">
														<label>KPI</label>
														<input type="text" value="" class="form-control" name="kpi[]">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Deskripsi</label>
														<textarea name="deskripsi[]" id="" cols="30" rows="0" class="form-control"></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Bobot</label>
														<input type="text" value="" class="form-control" name="bobot[]">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Sasaran/Target</label>
														<input type="text" value="" class="form-control" name="sasaran[]">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label>Satuan</label>
														<?php $id1 = "satuan".$i; ?>
														<select id="<?php echo $id1; ?>" name="satuan[]" class="form-control">
															<option value="">Silahkan Pilih Satuan</option>
															<?php
																foreach($db->tampil_satuan() as $tampil)
																{
																	echo '<option value="'.$tampil['id_satuan'].'">'.$tampil['nama_satuan'].'</option>';
																}
															?>
														</select>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label>Polarisasi</label>
														<?php $id2 = "sifat_kpi".$i; ?>
														<select id="<?php echo $id2; ?>" name="sifat_kpi[]" class="form-control">
															<option value="">Silahkan Pilih Polarisasi</option>
														</select>
													</div>
												</div>
											</div>
								<!-- Akhiran Form Kedua -->
					<?php
							}
							echo '
										<div class="m-t-20 text-center">
											<button class="btn btn-primary" type="submit" name="tombolSimpan">Simpan Data KPI Individu</button>
										</div>
									</form>
								</div>
							</div>
							';
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
                for(var a=1; a<=10; a++)
				{
					var v1 = "#satuan"+a;
					var v2 = "#sifat_kpi"+a;
					$(v1).select2({
						placeholder: "Please Select"
					});
					$(v2).select2({
						placeholder: "Please Select"
					});
				}
            });
        </script>

		<script>
			$('#satuan1').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi1').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi1').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan2').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi2').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi2').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan3').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi3').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi3').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan4').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi4').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi4').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan5').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi5').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi5').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan6').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi6').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi6').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan7').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi7').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi7').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan8').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi8').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi8').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan9').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi9').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi9').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});

			$('#satuan10').on('change', function() 
			{
				var id = $(this).children(":selected").attr("value");
				
				$.ajax({
				url: "get_satuan.php?id_satuan="+id,
				type: "GET",
				
				success: function(data) {
					
					var result = JSON.parse(data);
					$('#sifat_kpi10').html('');
					$.each(result, function (index, value) {
						var jenis_polarisasi = value;
						var ket = null;
						if(jenis_polarisasi == 1)
							ket = "Polarisasi Positif";
						else if(jenis_polarisasi == 2)
							ket = "Polarisasi Negatif";
						else if(jenis_polarisasi == 3)
							ket = "Polarisasi Absolute Positif/Project";
						else if(jenis_polarisasi == 4)
							ket = "Polatisasi Absolute Negatif";
						else if(jenis_polarisasi == 5)
							ket = "Polarisasi Waktu";
						else if(jenis_polarisasi == 6)
							ket = "Polarisasi Akurasi";
						else if(jenis_polarisasi == 7)
							ket = "Polarisasi Survey";
						else if(jenis_polarisasi == 8) 
							ket = "Polarisasi Khusus";

						$('#sifat_kpi10').append($('<option/>', { 
							value: jenis_polarisasi,
							text : ket 
						}));
					});
					
				}
				});
			});
		</script>
    </body>
</html>
<?php
	ob_end_flush();
?>