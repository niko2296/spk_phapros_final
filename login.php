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
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>

    <body>
        <div class="main-wrapper">
			<div class="account-page">
				<div class="container">
					<h3 class="account-title">Sistem Penilaian Kinerja</h3>
					<div class="account-box">
						<div class="account-wrapper">
							<div class="account-logo">
								<a href="index.html"><img src="assets/img/logo-phapros.jpg" alt="Logo Phapros"></a>
                                <?php
                                    include "conn/database.php";
                                    $db = new database();

                                    if(isset($_POST['Login']))
                                    {
                                        error_reporting(0);
                                        $username = $_POST['username'];
                                        $password = $_POST['password'];

                                        $eksekusi = $db->cek_login($username, $password);
                                        if($eksekusi == 1)
                                        {
                                            echo '<div style="background-color:red; color:white; padding:10px;">Username atau Password Kosong</div>';
                                        }else if($eksekusi == 2){
                                            echo '<div style="background-color:red; color:white; padding:10px;">Username Tidak Terdaftar</div>';
                                        }else if($eksekusi == 3){
                                            echo '<div style="background-color:red; color:white; padding:10px;">Kombinasi Username dan Password Tidak Tepat</div>';
                                        }
                                        

                                    }
                                ?>
							</div>
							<form action="#" method="POST">
								<div class="form-group form-focus">
									<label class="control-label">NIK</label>
									<input class="form-control floating" type="text" name="username">
								</div>
								<div class="form-group form-focus">
									<label class="control-label">Password</label>
									<input class="form-control floating" type="password" name="password">
								</div>
								<div class="form-group text-center">
									<button class="btn btn-primary btn-block" type="submit" name="Login">Login</button>
								</div>
								<!-- <div class="text-center">
									<a href="forgot-password.html">Forgot your password?</a>
								</div> -->
							</form>
						</div>
					</div>
				</div>
			</div>
        </div>
		<div class="sidebar-overlay" data-reff="#sidebar"></div>
        <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/app.js"></script>
    </body>
    
</html>