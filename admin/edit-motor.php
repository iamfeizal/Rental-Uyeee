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
		$abs = $_POST['abs'];
		$led = $_POST['led'];
		$crashSensor = $_POST['crashSensor'];
		$ridingMode = $_POST['ridingMode'];
		$fi = $_POST['fi'];
		$tcs = $_POST['tcs'];
		$idMotor = $_GET['mtid'];

		$sql = "UPDATE motor SET namaMotor=:namaMotor,idMerk=:idMerk,deskripsi=:deskripsi,harga=:harga,bahanBakar=:bahanBakar,tahunBuat=:tahunBuat,tempatDuduk=:tempatDuduk,abs=:abs,led=:led,crashSensor=:crashSensor,ridingMode=:ridingMode,fi=:fi,tcs=:tcs WHERE idMotor=:idMotor ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':namaMotor', $namaMotor, PDO::PARAM_STR);
		$query->bindParam(':idMerk', $idMerk, PDO::PARAM_STR);
		$query->bindParam(':deskripsi', $deskripsi, PDO::PARAM_STR);
		$query->bindParam(':harga', $harga, PDO::PARAM_STR);
		$query->bindParam(':bahanBakar', $bahanBakar, PDO::PARAM_STR);
		$query->bindParam(':tahunBuat', $tahunBuat, PDO::PARAM_STR);
		$query->bindParam(':tempatDuduk', $tempatDuduk, PDO::PARAM_STR);
		$query->bindParam(':abs', $abs, PDO::PARAM_STR);
		$query->bindParam(':led', $led, PDO::PARAM_STR);
		$query->bindParam(':crashSensor', $crashSensor, PDO::PARAM_STR);
		$query->bindParam(':ridingMode', $ridingMode, PDO::PARAM_STR);
		$query->bindParam(':fi', $fi, PDO::PARAM_STR);
		$query->bindParam(':tcs', $tcs, PDO::PARAM_STR);
		$query->bindParam(':idMotor', $idMotor, PDO::PARAM_STR);
		$query->execute();
		$msg = "Data updated successfully";
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
					<form method="post" class="form-horizontal" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<h2 class="page-title">Edit Motor</h2>
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">Info Dasar</div>
											<div class="panel-body">
												<?php
												if ($msg) { ?>
													<div class="succWrap">
														<strong>BERHASIL</strong>:<?php echo htmlentities($msg); ?>
													</div><?php 
												} ?>
												<?php
												$idMotor = intval($_GET['mtid']);
												$sql = "SELECT motor.*,merk.namaMerk,merk.idMerk as bid from motor join merk on merk.idMerk=motor.idMerk where motor.idMotor=:idMotor";
												$query = $dbh->prepare($sql);
												$query->bindParam(':idMotor', $idMotor, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {	?>
														<div class="form-group">
															<label class="col-sm-2 control-label">
																Nama Motor<span style="color:red">*</span>
															</label>
															<div class="col-sm-4">
																<input type="text" name="namaMotor" class="form-control" value="<?php echo htmlentities($result->namaMotor) ?>" required>
															</div>
															<label class="col-sm-2 control-label">
																Pilih Merk<span style="color:red">*</span>
															</label>
															<div class="col-sm-4">
																<select class="selectpicker" name="idMerk" required>
																	<option value="<?php echo htmlentities($result->bid); ?>"><?php echo htmlentities($namaMerk = $result->namaMerk); ?> </option>
																	<?php $ret = "SELECT idMerk,namaMerk FROM merk";
																	$query = $dbh->prepare($ret);
																	//$query->bindParam(':id',$id, PDO::PARAM_STR);
																	$query->execute();
																	$resultss = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($resultss as $results) {
																			if ($results->namaMerk == $namaMerk) {
																				continue;
																			} else {?>
																				<option value="<?php echo htmlentities($results->idMerk); ?>"><?php echo htmlentities($results->namaMerk); ?></option>
																					<?php
																			}
																		}
																	} ?>
																</select>
															</div>
														</div>
														<div class="hr-dashed"></div>
														<div class="form-group">
															<label class="col-sm-2 control-label">
																Deskripsi<span style="color:red">*</span>
															</label>
															<div class="col-sm-10">
																<textarea class="form-control" name="deskripsi" rows="3" required><?php echo htmlentities($result->deskripsi); ?></textarea>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">
																Harga Per Hari(Rupiah)<span style="color:red">*</span>
															</label>
															<div class="col-sm-4">
																<input type="text" name="harga" class="form-control" value="<?php echo htmlentities($result->harga); ?>" required>
															</div>
															<label class="col-sm-2 control-label">
																Bahan Bakar Minimal<span style="color:red">*</span>
															</label>
															<div class="col-sm-4">
																<select class="selectpicker" name="bahanBakar" required>
																	<option value="<?php echo htmlentities($result->bahanBakar); ?>"> <?php echo htmlentities($result->bahanBakar); ?> </option>
																	<?php
																	$qbahan = "SELECT DISTINCT bahanBakar FROM motor";
																	$query = $dbh->prepare($qbahan);
																	$query->execute();
																	$BB = $query->fetchAll(PDO::FETCH_OBJ);
																	$cnt = 1;
																	if ($query->rowCount() > 0) {
																		foreach ($BB as $bb) { ?>
																			<option value="<?php echo htmlentities($bb->bahanBakar); ?>"><?php echo htmlentities($bb->bahanBakar); ?></option>
																	<?php }
																	} ?>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">
																Tahun Pembuatan<span style="color:red">*</span>
															</label>
															<div class="col-sm-4">
																<input type="text" name="tahunBuat" class="form-control" value="<?php echo htmlentities($result->tahunBuat); ?>" required>
															</div>
															<label class="col-sm-2 control-label">
																Tempat Duduk<span style="color:red">*</span>
															</label>
															<div class="col-sm-4">
																<input type="text" name="tempatDuduk" class="form-control" value="<?php echo htmlentities($result->tempatDuduk); ?>" required>
															</div>
														</div>
														<div class="hr-dashed"></div>
														<div class="form-group">
															<div class="col-sm-12">
																<h4><b>Gambar Motor</b></h4>
															</div>
														</div>
														<div class="form-group">
															<div class="col-sm-4">
																<img src="img/vehicleimages/<?php echo htmlentities($result->gambar1); ?>" width="300" height="200" style="border:solid 1px #000">
																<a href="gantigambar1.php?imgid=<?php echo htmlentities($result->idMotor) ?>">Ganti Gambar</a>
															</div>
														</div>
														<div class="hr-dashed"></div>
													</div>
												<?php }
												} ?>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">Spesifikasi </div>
												<div class="panel-body">
													<?php
													$idMotor = intval($_GET['mtid']);
													$sql = "SELECT motor.*,merk.namaMerk,merk.idMerk as bid from motor join merk on merk.idMerk=motor.idMerk where motor.idMotor=:idMotor";
													$query = $dbh->prepare($sql);
													$query->bindParam(':idMotor', $idMotor, PDO::PARAM_STR);
													$query->execute();
													$results = $query->fetchAll(PDO::FETCH_OBJ);
													$cnt = 1;
													if ($query->rowCount() > 0) {
														foreach ($results as $result) {	?>
															<div class="form-group">
																<div class="col-sm-3">
																	<?php if ($result->abs == 1) { ?>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="abs" name="abs" checked value="1">
																			<label for="abs"> AntiLock Braking System (ABS) </label>
																		</div>
																	<?php } else { ?>
																		<div class="checkbox checkbox-success checkbox-inline">
																			<input type="checkbox" id="abs" name="abs" value="1">
																			<label for="abs"> AntiLock Braking System (ABS) </label>
																		</div>
																	<?php } ?>
																</div>
																<div class="col-sm-3">
																	<?php if ($result->led == 1) { ?>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="led" name="led" checked value="1">
																			<label for="led"> Lampu LED </label>
																		</div>
																	<?php } else { ?>
																		<div class="checkbox checkbox-success checkbox-inline">
																			<input type="checkbox" id="led" name="led" value="1">
																			<label for="led"> Lampu LED </label>
																		</div>
																	<?php } ?>
																</div>
																<div class="col-sm-3">
																	<?php if ($result->crashSensor == 1) { ?>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="crashSensor" name="crashSensor" checked value="1">
																			<label for="crashSensor"> Crash Sensor </label>
																		</div>
																	<?php } else { ?>
																		<div class="checkbox checkbox-success checkbox-inline">
																			<input type="checkbox" id="crashSensor" name="crashSensor" value="1">
																			<label for="crashSensor"> Crash Sensor </label>
																		</div>
																	<?php } ?>
																</div>
															</div>
															<div class="form-group">
																<div class="col-sm-3">
																	<?php if ($result->ridingMode == 1) { ?>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="ridingMode" name="ridingMode" checked value="1">
																			<label for="ridingMode"> Riding Mode</label>
																		</div>
																	<?php } else { ?>
																		<div class="checkbox checkbox-success checkbox-inline">
																			<input type="checkbox" id="ridingMode" name="ridingMode" value="1">
																			<label for="ridingMode"> Riding Mode</label>
																		</div>
																	<?php } ?>
																</div>
																<div class="col-sm-3">
																	<?php if ($result->fi == 1) { ?>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="fi" name="fi" checked value="1">
																			<label for="fi"> Fuel Injection </label>
																		</div>
																	<?php } else { ?>
																		<div class="checkbox checkbox-success checkbox-inline">
																			<input type="checkbox" id="fi" name="fi" value="1">
																			<label for="fi"> Fuel Injection </label>
																		</div>
																	<?php } ?>
																</div>
																<div class="col-sm-3">
																	<?php if ($result->tcs == 1) { ?>
																		<div class="checkbox checkbox-inline">
																			<input type="checkbox" id="tcs" name="tcs" checked value="1">
																			<label for="tcs"> Traction Control System </label>
																		</div>
																	<?php } else { ?>
																		<div class="checkbox checkbox-success checkbox-inline">
																			<input type="checkbox" id="tcs" name="tcs" value="1">
																			<label for="tcs"> Traction Control System </label>
																		</div>
																	<?php } ?>
																</div>
															</div>
															<div class="form-group">
																<div class="col-sm-8 col-sm-offset-2">
																	<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
																</div>
															</div>
															<?php
														}
													}?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
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