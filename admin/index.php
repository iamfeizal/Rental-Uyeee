<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$emailAdmin = $_POST['emailAdmin'];
	$password = md5($_POST['password']);
	$sql = "SELECT emailAdmin, password, role FROM admin WHERE emailAdmin=:emailAdmin and password=:password";
	$query = $dbh->prepare($sql);
	$query->bindParam(':emailAdmin', $emailAdmin, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		$_SESSION['alogin'] = $_POST['emailAdmin'];
		foreach($results as $result){
			$role=($result->role);
			$_SESSION['role'] = $role;
			if($_SESSION['role']==99){
				echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
			} else{
				echo "<script type='text/javascript'> document.location = 'kelola-pesanan.php'; </script>";
			}
		}
	} else {
		echo "<script>alert('Email atau Password Salah');</script>";
	}
}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Rental UYEEE | Admin Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/favicon-icon/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/favicon-icon/apple-touch-icon-114-precomposed.html">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/favicon-icon/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/favicon-icon/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="images/favicon-icon/24x24.png">
</head>

<body>
	<div class="login-page bk-img" style="background-image: url(img/adminlogin0.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">ADMIN LOGIN</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">
									<label for="" class="text-uppercase text-sm">Masukkan Email </label>
									<input type="text" placeholder="Email" name="emailAdmin" class="form-control mb">
									<label for="" class="text-uppercase text-sm">Masukkan Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">
									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>