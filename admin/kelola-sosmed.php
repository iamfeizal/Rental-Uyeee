<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	// Code for change password
	if (isset($_POST['submit'])) {
		$alamatRental = $_POST['alamatRental'];
		$emailRental = $_POST['emailRental'];
		$teleponRental = $_POST['teleponRental'];
		$sql = "UPDATE kontak set alamatRental=:alamatRental,emailRental=:emailRental,teleponRental=:teleponRental";
		$query = $dbh->prepare($sql);
		$query->bindParam(':alamatRental', $alamatRental, PDO::PARAM_STR);
		$query->bindParam(':emailRental', $emailRental, PDO::PARAM_STR);
		$query->bindParam(':teleponRental', $teleponRental, PDO::PARAM_STR);
		$query->execute();
		$msg = "Sosial Media Berhasil Diperbaharui";
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
								<h2 class="page-title">Daftar Sosial Media</h2>
							<?php
							} else { ?>
								<h2 class="page-title">Kelola Sosial Media</h2>
							<?php } ?>
							<div class="row">
								<div class="col-md-10">
									<div class="panel panel-default">
										<div class="panel-heading">Daftar Sosial Media</div>
										<div class="panel-body">
											<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
												<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>BERHASIL</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
												<?php $sql = "SELECT * from  kontak ";
												$query = $dbh->prepare($sql);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {				?>
														<div class="form-group">
															<label class="col-sm-4 control-label"> Alamat<span style="color:red">*</span></label>
															<div class="col-sm-8">
																<textarea class="form-control" name="alamatRental" id="alamatRental" required <?php if ($_SESSION['role'] == 99) { ?> readonly <?php } ?>><?php echo htmlentities($result->alamatRental); ?></textarea>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label"> Email<span style="color:red">*</span></label>
															<div class="col-sm-8">
																<input type="email" class="form-control" name="emailRental" id="emailRental" value="<?php echo htmlentities($result->emailRental); ?>" required <?php if ($_SESSION['role'] == 99) { ?> readonly <?php } ?>>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label"> Nomor Telepon<span style="color:red">*</span></label>
															<div class="col-sm-8">
																<input type="text" class="form-control" value="<?php echo htmlentities($result->teleponRental); ?>" name="teleponRental" id="teleponRental" required <?php if ($_SESSION['role'] == 99) { ?> readonly <?php } ?>>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label"> Nomor Whatsapp<span style="color:red">*</span></label>
															<div class="col-sm-8">
																<input type="text" class="form-control" value="<?php echo htmlentities($result->wa); ?>" name="wa" id="wa" required <?php if ($_SESSION['role'] == 99) { ?> readonly <?php } ?>>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label"> Alamat Facebook<span style="color:red">*</span></label>
															<div class="col-sm-8">
																<input type="text" class="form-control" value="<?php echo htmlentities($result->fb); ?>" name="fb" id="fb" required <?php if ($_SESSION['role'] == 99) { ?> readonly <?php } ?>>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label"> Alamat Twitter<span style="color:red">*</span></label>
															<div class="col-sm-8">
																<input type="text" class="form-control" value="<?php echo htmlentities($result->twt); ?>" name="twt" id="twt" required <?php if ($_SESSION['role'] == 99) { ?> readonly <?php } ?>>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label"> Alamat Instagram<span style="color:red">*</span></label>
															<div class="col-sm-8">
																<input type="text" class="form-control" value="<?php echo htmlentities($result->ig); ?>" name="ig" id="ig" required <?php if ($_SESSION['role'] == 99) { ?> readonly <?php } ?>>
															</div>
														</div>
												<?php }
												} ?>
												<?php if ($_SESSION['role'] != 99) { ?>
													<div class="hr-dashed"></div>
													<div class="form-group">
														<div class="col-sm-8 col-sm-offset-4">
															<button class="btn btn-primary" name="submit" type="submit">Perbarui</button>
														</div>
													</div>
												<?php } ?>
											</form>

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

	</body>

	</html>
<?php } ?>