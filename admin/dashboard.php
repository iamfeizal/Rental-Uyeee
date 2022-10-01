<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Bike Rental Portal | Admin</title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title">Laporan</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-body bk-info text-light">
													<div class="stat-panel text-center">
														<?php
														$admin = "SELECT role from admin ";
														$queryadmin = $dbh->prepare($admin);;
														$queryadmin->execute();
														$roleadmin = $queryadmin->fetchAll(PDO::FETCH_OBJ);
														$role = $queryadmin->rowCount();

														$sqltotal = "SELECT totalHarga FROM pemesanan WHERE status=1";
														$querytotal = $dbh->prepare($sqltotal);
														$querytotal->execute();
														$resultstotal = $querytotal->fetchAll(PDO::FETCH_OBJ);
														$cnt = 1;
														if ($querytotal->rowCount() > 0) {
															foreach ($resultstotal as $resulttotal){
																$awal=($resulttotal->totalHarga);
																$total = $awal + $total;
															}
														}
														?>
														<div class="stat-panel-number h1 ">Rp. <?php echo htmlentities($total); ?></div>
														<div class="stat-panel-title text-uppercase">Total Penghasilan</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-primary text-light">
													<div class="stat-panel text-center">
														<?php
														$sql = "SELECT emailPenyewa from penyewa ";
														$query = $dbh->prepare($sql);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_OBJ);
														$totalPenyewa = $query->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($totalPenyewa); ?></div>
														<div class="stat-panel-title text-uppercase">Penyewa</div>
													</div>
												</div>
												<a href="penyewa.php" class="block-anchor panel-footer text-center">Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-success text-light">
													<div class="stat-panel text-center">
														<?php
														$sql1 = "SELECT idMotor from motor ";
														$query1 = $dbh->prepare($sql1);;
														$query1->execute();
														$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
														$totalMotor = $query1->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($totalMotor); ?></div>
														<div class="stat-panel-title text-uppercase">Motor</div>
													</div>
												</div>
												<a href="kelola-motor.php" class="block-anchor panel-footer text-center">Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-success text-light">
													<div class="stat-panel text-center">
														<?php
														$sql3 = "SELECT idMerk from merk ";
														$query3 = $dbh->prepare($sql3);
														$query3->execute();
														$results3 = $query3->fetchAll(PDO::FETCH_OBJ);
														$merk = $query3->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($merk); ?></div>
														<div class="stat-panel-title text-uppercase">Merk</div>
													</div>
												</div>
												<a href="kelola-merk.php" class="block-anchor panel-footer text-center">Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-warning text-light">
													<div class="stat-panel text-center">
														<?php
														$sql2 = "SELECT idPemesanan from pemesanan";
														$query2 = $dbh->prepare($sql2);
														$query2->execute();
														$results2 = $query2->fetchAll(PDO::FETCH_OBJ);
														$pesanan = $query2->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($pesanan); ?></div>
														<div class="stat-panel-title text-uppercase">Pesanan</div>
													</div>
												</div>
												<a href="kelola-pesanan.php" class="block-anchor panel-footer text-center">Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-primary text-light">
													<div class="stat-panel text-center">
														<?php
														$sql5 = "SELECT idTestimoni from testimoni ";
														$query5 = $dbh->prepare($sql5);
														$query5->execute();
														$results5 = $query5->fetchAll(PDO::FETCH_OBJ);
														$testimoni = $query5->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($testimoni); ?></div>
														<div class="stat-panel-title text-uppercase">Testimoni</div>
													</div>
												</div>
												<a href="testimoni.php" class="block-anchor panel-footer text-center">Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
									</div>
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

		<script>
			window.onload = function() {

				// Line chart from swirlData for dashReport
				var ctx = document.getElementById("dashReport").getContext("2d");
				window.myLine = new Chart(ctx).Line(swirlData, {
					responsive: true,
					scaleShowVerticalLines: false,
					scaleBeginAtZero: true,
					multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
				});

				// Pie Chart from doughutData
				var doctx = document.getElementById("chart-area3").getContext("2d");
				window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
					responsive: true
				});

				// Dougnut Chart from doughnutData
				var doctx = document.getElementById("chart-area4").getContext("2d");
				window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
					responsive: true
				});

			}
		</script>
	</body>

	</html>
<?php } ?>