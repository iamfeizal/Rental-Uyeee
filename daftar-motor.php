<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Rental UYEEE | Daftar Motor</title>
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
    <!-- Fav and touch icons -->
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

    <!--Page Header-->
    <section class="page-header listing_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    <h1>Daftar Motor</h1>
                </div>
                <ul class="coustom-breadcrumb">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Daftar Motor</li>
                </ul>
            </div>
        </div>
        <!-- Dark Overlay-->
        <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <!--Listing-->
    <section class="listing-page">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="result-sorting-wrapper">
                        <div class="sorting-count">
                            <?php
                            //Query for Listing count
                            $sql = "SELECT idMotor FROM motor";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = $query->rowCount();
                            ?>
                            <p><span><?php echo htmlentities($cnt); ?> Motor</span></p>
                        </div>
                    </div>
                    <?php $sql1 = "SELECT motor.*,merk.namaMerk,merk.idMerk AS bid FROM motor JOIN merk ON merk.idMerk=motor.idMerk";
                    $query = $dbh->prepare($sql1);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {  ?>
                            <div class="product-listing-m gray-bg">
                                <div class="product-listing-img"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->gambar1); ?>" class="img-responsive" alt="Image" /> </a>
                                </div>
                                <div class="product-listing-content">
                                    <h5><a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>"><?php echo htmlentities($result->namaMerk); ?>, <?php echo htmlentities($result->namaMotor); ?></a></h5>
                                    <p class="list-price">$<?php echo htmlentities($result->harga); ?> Per Hari</p>
                                    <ul>
                                        <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->tempatDuduk); ?> Tempat Duduk</li>
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->tahunBuat); ?></li>
                                        <li><i class="fa fa-motorcycle" aria-hidden="true"></i><?php echo htmlentities($result->bahanBakar); ?></li>
                                    </ul>
                                    <a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>" class="btn">Lihat Detail <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>

                <!--Side-Bar-->
                <aside class="col-md-3 col-md-pull-9">
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-filter" aria-hidden="true"></i> Cari Motor Keinginanmu </h5>
                        </div>
                        <div class="sidebar_filter">
                            <form action="hasil-pencarian.php" method="post">
                                <div class="form-group select">
                                    <select class="form-control" name="merk">
                                        <option>Pilih Merk</option>
                                        <?php $sql2 = "SELECT * FROM merk";
                                        $query = $dbh->prepare($sql2);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <option value="<?php echo htmlentities($result->idMerk); ?>"><?php echo htmlentities($result->namaMerk); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group select">
                                    <select class="form-control" name="bahanBakar">
                                        <option>Pilih Bahan Bakar Minimal</option>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Cari Motor</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-car" aria-hidden="true"></i> Motor Terbaru</h5>
                        </div>
                        <div class="recent_addedcars">
                            <ul>
                                <?php $sql4 = "SELECT motor.*,merk.namaMerk,merk.idMerk AS bid FROM motor JOIN merk ON merk.idMerk=motor.idMerk ORDER BY idMotor DESC LIMIT 4";
                                $query = $dbh->prepare($sql4);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {  ?>
                                        <li class="gray-bg">
                                            <div class="recent_post_img"> <a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->gambar1); ?>"alt="image"></a></div>
                                            <div class="recent_post_title"> <a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>"><?php echo htmlentities($result->namaMerk); ?>, <?php echo htmlentities($result->namaMotor); ?></a>
                                                <p class="widget_price">Rp.<?php echo htmlentities($result->harga); ?> Per Hari</p>
                                            </div>
                                        </li>
                                <?php }
                                } ?>

                            </ul>
                        </div>
                    </div>
                </aside>
                <!--/Side-Bar-->
            </div>
        </div>
    </section>
    <!-- /Listing-->

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

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <!--bootstrap-slider-JS-->
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>