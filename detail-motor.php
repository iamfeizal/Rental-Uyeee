<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {
    $dariTgl = $_POST['dariTgl'];
    $sampaiTgl = $_POST['sampaiTgl'];
    $pesan = $_POST['pesan'];
    $emailPenyewa = $_SESSION['login'];
    $dari = new DateTime($_POST['dariTgl']);
    $sampai = new DateTime($_POST['sampaiTgl']);
    $diff = date_diff($dari, $sampai);
    $jml = $diff->days;
    $a = 1;
    $jmlHari = $jml + $a;
    $hargaPerHari = $_POST['hargaPerHari'];
    $totalHarga = intval($hargaPerHari) * $jmlHari;
    $status = 0;
    $mtid = $_GET['mtid'];
    $sql = "INSERT INTO pemesanan(emailPenyewa,idMotor,dariTgl,sampaiTgl,pesan,status,jmlHari,totalHarga) VALUES(:emailPenyewa,:mtid,:dariTgl,:sampaiTgl,:pesan,:status,:jmlHari,:totalHarga)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
    $query->bindParam(':mtid', $mtid, PDO::PARAM_STR);
    $query->bindParam(':dariTgl', $dariTgl, PDO::PARAM_STR);
    $query->bindParam(':sampaiTgl', $sampaiTgl, PDO::PARAM_STR);
    $query->bindParam(':pesan', $pesan, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':jmlHari', $jmlHari, PDO::PARAM_STR);
    $query->bindParam(':totalHarga', $totalHarga, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Pemesanan Berhasil.');</script>";
        header("location:pesananku.php");
    } else {
        echo "<script>alert('Pemesanan Gagal, Mohon Coba Lagi');</script>";
    }
}
?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Rental UYEEE | Detail Motor</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/24x24.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>
    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->

    <!--Listing-Image-Slider-->
    <?php
    $idMotor = intval($_GET['mtid']);
    $sql = "SELECT motor.*,merk.namaMerk,merk.idMerk AS bid FROM motor JOIN merk ON merk.idMerk=motor.idMerk where motor.idMotor=:idMotor";
    $query = $dbh->prepare($sql);
    $query->bindParam(':idMotor', $idMotor, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['brndid'] = $result->bid;
    ?>
            <section id="listing_img_slider">
                <div><img class="img-responsive" alt=" " width="900" height="560"></div>
                <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->gambar1); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
            </section>
            <!--/Listing-Image-Slider-->

            <!--Listing-detail-->
            <section class="listing-detail">
                <div class="container">
                    <div class="listing_detail_head row">
                        <div class="col-md-9">
                            <h2><?php echo htmlentities($result->namaMerk); ?>, <?php echo htmlentities($result->namaMotor); ?></h2>
                        </div>
                        <div class="col-md-3">
                            <div class="price_info">
                                <p>Rp. <?php echo htmlentities($result->harga); ?> </p>Per Hari
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="main_features">
                                <ul>
                                    <li> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <h5><?php echo htmlentities($result->tahunBuat); ?></h5>
                                        <p>Tahun Pembuatan</p>
                                    </li>
                                    <li> <i class="fa fa-cogs" aria-hidden="true"></i>
                                        <h5><?php echo htmlentities($result->bahanBakar); ?></h5>
                                        <p>Bahan Bakar</p>
                                    </li>
                                    <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <h5><?php echo htmlentities($result->tempatDuduk); ?></h5>
                                        <p>Tempat Duduk</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="listing_more_info">
                                <div class="listing_detail_wrap">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs gray-bg" role="tablist">
                                        <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Deskripsi </a></li>

                                        <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Spesifikasi</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <!-- vehicle-overview -->
                                        <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                                            <p><?php echo htmlentities($result->deskripsi); ?></p>
                                        </div>
                                        <!-- accessories -->
                                        <div role="tabpanel" class="tab-pane" id="accessories">
                                            <!--accessories-->
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th colspan="2">Spesifikasi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>AntiLock Braking System (ABS)</td>
                                                        <?php if ($result->abs == 1) {
                                                        ?>
                                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                        <?php } else { ?>
                                                            <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <td>Lampu LED</td>
                                                        <?php if ($result->led == 1) {
                                                        ?>
                                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                        <?php } else { ?>
                                                            <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <td>Crash Sensor</td>
                                                        <?php if ($result->crashSensor == 1) {
                                                        ?>
                                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                        <?php } else { ?>
                                                            <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <td>Riding Mode</td>
                                                        <?php if ($result->ridingMode == 1) {
                                                        ?>
                                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                        <?php } else { ?>
                                                            <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                        <?php } ?>
                                                    </tr>
                                                    <td>Fuel Injection</td>
                                                    <?php if ($result->fi == 1) {
                                                    ?>
                                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                    <?php  } else { ?>
                                                        <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                    <?php } ?>
                                                    </tr>
                                                    <tr>
                                                        <td>Traction Control System</td>
                                                        <?php if ($result->tcs == 1) {
                                                        ?>
                                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                        <?php } else { ?>
                                                            <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                        <?php } ?>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                }
            } ?>
                        </div>
                        <!--Side-Bar-->
                        <aside class="col-md-3">
                            <div class="share_vehicle">
                                <p>Bantuan:
                                    <?php $sql = "SELECT alamatRental,emailRental,teleponRental,wa,fb,twt,ig from kontak";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <a href="https://wa.me/<?php echo htmlentities($result->wa); ?>?text=Halo%20Admin%20Rental%20UYEEE%0ASaya%20perlu%20bantuan" target="blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                            <a href="<?php echo htmlentities($result->fb); ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                                            <a href="<?php echo htmlentities($result->twt); ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                                            <a href="<?php echo htmlentities($result->ig); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    <?php
                                        }
                                    } ?>
                                </p>
                            </div>
                            <div class="sidebar_widget">
                                <div class="widget_heading">
                                    <h5><i class="fa fa-envelope" aria-hidden="true"></i>Pesan Sekarang</h5>
                                </div>
                                <form method="post">
                                    <?php
                                    $idMotor = intval($_GET['mtid']);
                                    $sqlHarga = "SELECT harga FROM motor where motor.idMotor=:idMotor";
                                    $query = $dbh->prepare($sqlHarga);
                                    $query->bindParam(':idMotor', $idMotor, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="hargaPerHari" value="<?php echo htmlentities($result->harga); ?>" required readonly>
                                    </div>
                                    <?php }
                                    } ?>
                                    <div class="form-group">
                                        <P>Dari Tanggal</P>
                                        <input type="date" class="form-control" name="dariTgl" placeholder="From Date(dd/mm/yyyy)" required>
                                    </div>
                                    <div class="form-group">
                                        <p>Sampai Tanggal</p>
                                        <input type="date" class="form-control" name="sampaiTgl" placeholder="To Date(dd/mm/yyyy)" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control" name="pesan" placeholder="Pesan" required></textarea>
                                    </div>
                                    <?php if ($_SESSION['login']) { ?>
                                        <div class="form-group">
                                            <input type="submit" class="btn" name="submit" value="Pesan Sekarang">
                                        </div>
                                    <?php } else { ?>
                                        <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login Untuk Pesan</a>
                                    <?php } ?>
                                </form>
                            </div>
                        </aside>
                        <!--/Side-Bar-->
                    </div>
                    <div class="space-20"></div>
                    <div class="divider"></div>
                    <!--Similar-Motors-->
                    <div class="similar_cars">
                        <h3>Motor yang Mirip</h3>
                        <div class="row">
                            <?php
                            $bid = $_SESSION['brndid'];
                            $sql = "SELECT motor.namaMotor,merk.namaMerk,motor.harga,motor.bahanBakar,motor.tahunBuat,motor.idMotor,motor.tempatDuduk,motor.deskripsi,motor.gambar1 from motor join merk on merk.idMerk=motor.idMerk where motor.idMerk=:bid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':bid', $bid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <div class="col-md-3 grid_listing">
                                        <div class="product-listing-m gray-bg">
                                            <div class="product-listing-img"> <a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->gambar1); ?>" class="img-responsive" alt="image" /> </a>
                                            </div>
                                            <div class="product-listing-content">
                                                <h5><a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>"><?php echo htmlentities($result->namaMerk); ?> , <?php echo htmlentities($result->namaMotor); ?></a></h5>
                                                <p class="list-price">Rp.<?php echo htmlentities($result->harga); ?></p>
                                                <ul class="features_list">
                                                    <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->tempatDuduk); ?></li>
                                                    <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->tahunBuat); ?></li>
                                                    <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->bahanBakar); ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>

                        </div>
                    </div>
                    <!--/Similar-Cars-->
                </div>
            </section>
            <!--/Listing-detail-->
            <!--Footer -->
            <?php include('includes/footer.php'); ?>
            <!-- /Footer-->

            <!--Back to top-->
            <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
            <!--/Back to top-->

            <!--Login-Form -->
            <?php include('includes/login.php'); ?>
            <!--/Login-Form -->

            <!--Register-Form -->
            <?php include('includes/registration.php'); ?>
            <!--/Register-Form -->

            <!--Forgot-password-Form -->
            <?php include('includes/forgotpassword.php'); ?>

            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/interface.js"></script>
            <script src="assets/js/bootstrap-slider.min.js"></script>
            <script src="assets/js/slick.min.js"></script>
            <script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>