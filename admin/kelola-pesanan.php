<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['eid'])) {
		$eid = intval($_GET['eid']);
		$status = 2;
		$sql = "UPDATE pemesanan SET status=:status WHERE idPemesanan=:eid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':eid', $eid, PDO::PARAM_STR);
		$query->execute();

		$msg = "Pesanan Berhasil Dibatalkan";
	}


	if (isset($_REQUEST['aeid'])) {
		$aeid = intval($_GET['aeid']);
		$status = 1;
		$sql = "UPDATE pemesanan SET status=:status WHERE idPemesanan=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();

		$msg = "Pesanan Berhasil Disetujui";
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

		<title>Rental UYEEE |Admin</title>

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
								<h2 class="page-title">Daftar Pemesanan</h2>
							<?php
							} else { ?>
								<h2 class="page-title">Kelola Pemesanan</h2>
							<?php } ?>
							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Daftar Pemesanan</div>
								<div class="panel-body">
									<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>BERHASIL</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
									<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama</th>
												<th>Motor</th>
												<th>Dari Tanggal</th>
												<th>Sampai Tanggal</th>
												<th>Pesan</th>
												<th>Status</th>
												<th>Tanggal Pesan</th>
												<?php
												if ($_SESSION['role'] != 99) { ?>
													<th>Konfirmasi</th>
												<?php
												} ?>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Nama</th>
												<th>Motor</th>
												<th>Dari Tanggal</th>
												<th>Sampai Tanggal</th>
												<th>Pesan</th>
												<th>Status</th>
												<th>Tanggal Pesan</th>
												<?php
												if ($_SESSION['role'] != 99) { ?>
													<th>Konfirmasi</th>
												<?php
												} ?>
											</tr>
										</tfoot>
										<tbody>
											<?php $sql = "SELECT penyewa.namaPenyewa,merk.namaMerk,motor.namaMotor,pemesanan.dariTgl,pemesanan.sampaiTgl,pemesanan.pesan,pemesanan.idMotor AS vid, pemesanan.status,pemesanan.tanggalPemesanan,pemesanan.idPemesanan FROM pemesanan JOIN motor ON motor.idMotor=pemesanan.idMotor JOIN penyewa ON penyewa.emailPenyewa=pemesanan.emailPenyewa JOIN merk ON motor.idMerk=merk.idMerk";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo htmlentities($result->namaPenyewa); ?></td>
														<td> <?php echo htmlentities($result->namaMerk); ?>, <?php echo htmlentities($result->namaMotor); ?> </td>
														<td><?php echo htmlentities($result->dariTgl); ?></td>
														<td><?php echo htmlentities($result->sampaiTgl); ?></td>
														<td><?php echo htmlentities($result->pesan); ?></td>
														<td><?php
															if ($result->status == 0) {
																echo htmlentities('Belum Dikonfirmasi');
															} else if ($result->status == 1) {
																echo htmlentities('Disetujui');
															} else {
																echo htmlentities('Dibatalkan');
															}
															?></td>
														<td><?php echo htmlentities($result->tanggalPemesanan); ?></td>
														<?php
														if ($_SESSION['role'] != 99) { ?>
															<td><a href="kelola-pesanan.php?aeid=<?php echo htmlentities($result->idPemesanan); ?>" onclick="return confirm('Anda Yakin Ingin Menyetujui Pesanan?')"> Setuju</a> /
																<a href="kelola-pesanan.php?eid=<?php echo htmlentities($result->idPemesanan); ?>" onclick="return confirm('Anda Yakin Ingin Membatalkan Pesanan?')">Batalkan</a>
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