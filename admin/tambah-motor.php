<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$namaMotor = $_POST['namaMotor'];
		$idMerk = $_POST['idMerk'];
		$deskripsi = $_POST['deskripsi'];
		$harga = $_POST['harga'];
		$bahanBakar = $_POST['bahanBakar'];
		$tahunBuat = $_POST['tahunBuat'];
		$tempatDuduk = $_POST['tempatDuduk'];
		$gambar1 = $_FILES["img1"]["name"];
		$abs = $_POST['abs'];
		$led = $_POST['led'];
		$crashSensor = $_POST['crashSensor'];
		$ridingMode = $_POST['ridingMode'];
		$fi = $_POST['fi'];
		$tcs = $_POST['tcs'];
		move_uploaded_file($_FILES["img1"]["tmp_name"], "img/vehicleimages/" . $_FILES["img1"]["name"]);
		$sql = "INSERT INTO motor(namaMotor,idMerk,deskripsi,harga,bahanBakar,tahunBuat,tempatDuduk,gambar1,abs,led,crashSensor,ridingMode,fi,tcs) VALUES(:namaMotor,:idMerk,:deskripsi,:harga,:bahanBakar,:tahunBuat,:tempatDuduk,:gambar1,:abs,:led,:crashSensor,:ridingMode,:fi,:tcs)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':namaMotor', $namaMotor, PDO::PARAM_STR);
		$query->bindParam(':idMerk', $idMerk, PDO::PARAM_STR);
		$query->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
		$query->bindParam(':harga', $harga, PDO::PARAM_STR);
		$query->bindParam(':bahanBakar', $bahanBakar, PDO::PARAM_STR);
		$query->bindParam(':tahunBuat', $tahunBuat, PDO::PARAM_STR);
		$query->bindParam(':tempatDuduk', $tempatDuduk, PDO::PARAM_STR);
		$query->bindParam(':gambar1', $gambar1, PDO::PARAM_STR);
		$query->bindParam(':abs', $abs, PDO::PARAM_STR);
		$query->bindParam(':led', $led, PDO::PARAM_STR);
		$query->bindParam(':crashSensor', $crashSensor, PDO::PARAM_STR);
		$query->bindParam(':ridingMode', $ridingMode, PDO::PARAM_STR);
		$query->bindParam(':fi', $fi, PDO::PARAM_STR);
		$query->bindParam(':tcs', $tcs, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = " Motor Berhasil Ditambahkan";
		} else {
			$error = " Motor Gagal Ditambahkan, Harap Coba Lagi";
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
							<h2 class="page-title">Tambah Motor</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Info Dasar</div>
										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>BERHASIL</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-sm-2 control-label">Nama Motor<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="namaMotor" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Pilih Merk<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="idMerk" required>
															<option value=""> Pilih </option>
															<?php $ret = "SELECT idMerk,namaMerk from Merk";
															$query = $dbh->prepare($ret);
															//$query->bindParam(':id',$id, PDO::PARAM_STR);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_OBJ);
															if ($query->rowCount() > 0) {
																foreach ($results as $result) {
															?>
																	<option value="<?php echo htmlentities($result->idMerk); ?>"><?php echo htmlentities($result->namaMerk); ?></option>
															<?php }
															} ?>
														</select>
													</div>
												</div>

												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Deskripsi<span style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea class="form-control" name="deskripsi" rows="3" required></textarea>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Harga Per Hari<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="harga" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Pilih Minimal Bahan Bakar<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="bahanBakar" required>
															<option>Pilih</option>
															<?php $sql3 = "SELECT DISTINCT bahanBakar FROM motor";
															$query = $dbh->prepare($sql3);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_OBJ);
															$cnt = 1;
															if ($query->rowCount() > 0) {
																foreach ($results as $result) { ?>
																	<option value="<?php echo htmlentities($result->bahanBakar); ?>"><?php echo htmlentities($result->bahanBakar); ?></option>
															<?php }
															} ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Tahun Pembuatan<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="tahunBuat" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Jumlah Tempat Duduk<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="tempatDuduk" class="form-control" required>
													</div>
												</div>
												<div class="hr-dashed"></div>


												<div class="form-group">
													<div class="col-sm-12">
														<h4><b>Upload Gambar</b></h4>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-4">
														Pilih Gambar<span style="color:red">*</span><input type="file" name="img1" required>
													</div>
													<div class="hr-dashed"></div>
												</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">Spesifikasi</div>
											<div class="panel-body">
												<div class="form-group">
													<div class="col-sm-3">
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="abs" name="abs" value="1">
															<label for="abs"> AntiLock Braking System (ABS)</label>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="led" name="led" value="1">
															<label for="led"> Lampu LED </label>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="crashSensor" name="crashSensor" value="1">
															<label for="crashSensor"> Crash Sensor </label>
														</div>
													</div>
												</div>
											</div>
											<div class="panel-body">
												<div class="form-group">
													<div class="col-sm-3">
														<div class="checkbox h checkbox-inline">
															<input type="checkbox" id="ridingMode" name="ridingMode" value="1">
															<label for="ridingMode"> Riding Mode</label>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="fi" name="fi" value="1">
															<label for="fi"> Fuel Injection </label>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="checkbox checkbox-inline">
															<input type="checkbox" id="tcs" name="tcs" value="1">
															<label for="tcs"> Traction Control System</label>
														</div>
													</div>
												</div>
											</div>
											<div class="panel-body"></div>
											<div class="panel-body">
												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">
														<button class="btn btn-default" type="reset">Batal</button>
														<button class="btn btn-primary" name="submit" type="submit">Simpan</button>
													</div>
												</div>
											</div>
											</form>
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
	</body>

	</html>
<?php } ?>