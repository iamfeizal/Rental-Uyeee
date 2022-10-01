<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_GET['del'])) {
		$emailPenyewa = $_GET['del'];
		$sql = "DELETE from penyewa  WHERE emailPenyewa=:emailPenyewa";
		$query = $dbh->prepare($sql);
		$query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
		$query->execute();
		$msg = "Akun Penyewa Berhasil Dihapus";
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
		<meta name="theme-color" content="#3e454c">

		<title>Rental UYEEE | Admin</title>

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
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<?php if ($_SESSION['role'] == 99) { ?>
								<h2 class="page-title">Daftar Penyewa</h2>
							<?php
							} else { ?>
								<h2 class="page-title">Kelola Penyewa</h2>
							<?php } ?>
							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Daftar Penyewa</div>
								<div class="panel-body">
									<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>BERHASIL</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
									<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama</th>
												<th>Username</th>
												<th>Email</th>
												<th>Nomor Telepon</th>
												<th>Alamat</th>
												<th>Tanggal Daftar</th>
												<?php
												if ($_SESSION['role'] != 99) { ?>
													<th>Hapus</th>
												<?php
												} ?>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama</th>
												<th>Username</th>
												<th>Email</th>
												<th>Nomor Telepon</th>
												<th>Alamat</th>
												<th>Tanggal Daftar</th>
												<?php
												if ($_SESSION['role'] != 99) { ?>
													<th>Hapus</th>
												<?php
												} ?>
											</tr>
										</tfoot>
										<tbody>
											<?php $sql = "SELECT * from  penyewa ";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo htmlentities($result->namaPenyewa); ?></td>
														<td><?php echo htmlentities($result->username); ?></td>
														<td><?php echo htmlentities($result->emailPenyewa); ?></td>
														<td><?php echo htmlentities($result->telepon); ?></td>
														<td><?php echo htmlentities($result->alamat); ?></td>
														<td><?php echo htmlentities($result->tglDaftar); ?></td>
														<?php
														if ($_SESSION['role'] != 99) { ?>
															<td>
																<a href="penyewa.php?del=<?php echo $result->emailPenyewa; ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Penyewa &quot <?php echo $result->username ?> &quot ?');"><i class="fa fa-close"></i></a>
															</td>
														<?php } ?>
													</tr>
											<?php $cnt = $cnt + 1;
												}
											} ?>
										</tbody>
									</table>
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
<?php } ?>