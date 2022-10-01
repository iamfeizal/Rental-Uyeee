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
    <title>Rental UYEEE | Beranda</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/styles.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
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

    <!-- Banners -->
    <section id="banner" class="banner-section">
        <div class="container">
            <div class="div_zindex">
                <div class="row">
                    <div class="col-md-5 col-md-push-7">
                        <div class="banner_content">
                            <h1>Temukan Motor Keinginanmu</h1>
                            <p>Kami mempunyai banyak pilihan jenis motor. </p>
                            <a href="daftar-motor.php" class="btn">Klik Disini <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Banners -->


    <!-- Resent Cat-->
    <section class="section-padding gray-bg">
        <div class="container">
            <div class="section-header text-center">
                <h2>Temukan <span>Motor Pilihamu</h2>
            </div>
            <div class="row">

                <!-- Nav tabs -->
                <div class="recent-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Motor Baru</a></li>
                    </ul>
                </div>
                <!-- Recently Listed New Cars -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="resentnewcar">
                        <?php $sql = "SELECT motor.namaMotor,merk.namaMerk,motor.harga,motor.bahanBakar,motor.tahunBuat,motor.idMotor,motor.tempatDuduk,motor.deskripsi,motor.gambar1 from motor join merk on merk.idMerk=motor.idMerk ORDER BY idMotor DESC LIMIT 6";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                        ?>
                                <div class="col-list-3">
                                    <div class="recent-car-list">
                                        <div class="car-info-box"> <a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->gambar1); ?>" class="img-responsive" alt="image"></a>
                                            <ul>
                                                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->bahanBakar); ?></li>
                                                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->tahunBuat); ?></li>
                                                <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->tempatDuduk); ?></li>
                                            </ul>
                                        </div>
                                        <div class="car-title-m">
                                            <h6><a href="detail-motor.php?mtid=<?php echo htmlentities($result->idMotor); ?>"><?php echo htmlentities($result->namaMerk); ?> , <?php echo htmlentities($result->namaMotor); ?></a></h6>
                                            <span class="price">Rp.<?php echo htmlentities($result->harga); ?> /Hari</span>
                                        </div>
                                        <div class="inventory_info_m">
                                            <p><?php echo substr($result->deskripsi, 0, 70); ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                    </div>
                </div>
            </div>
    </section>
    <!-- /Resent Cat -->

    <!-- Fun Facts-->
    <section class="fun-facts-section">
        <div class="container div_zindex">
            <div class="row">
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-calendar" aria-hidden="true"></i>40+</h2>
                            <p>Tahun Berdiri</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-motorcycle " aria-hidden="true"></i>1000+</h2>
                            <p>Motor Tersewa</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-motorcycle " aria-hidden="true"></i>999+</h2>
                            <p>Motor</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 col-sm-3">
                    <div class="fun-facts-m">
                        <div class="cell">
                            <h2><i class="fa fa-user-circle-o" aria-hidden="true"></i>850+</h2>
                            <p>Penyewa Puas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dark Overlay-->
        <div class="dark-overlay"></div>
    </section>
    <!-- /Fun Facts-->


    <!--Testimonial -->
    <section class="section-padding testimonial-section parallex-bg">
        <div class="container div_zindex">
            <div class="section-header white-text text-center">
                <h2>Testimoni <span>Kepuasan Pelanggan</span></h2>
            </div>
            <div class="row">
                <div id="testimonial-slider">
                    <?php
                    $tid = 1;
                    $sql = "SELECT testimoni.testimoni,penyewa.namaPenyewa from testimoni join penyewa on testimoni.emailPenyewa=penyewa.emailPenyewa where testimoni.status=:tid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':tid', $tid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) {  ?>
                            <div class="testimonial-m">
                                <div class="testimonial-img"> <img src="assets/images/cat-profile.png" alt="" /></div>
                                <div class="testimonial-content">
                                    <div class="testimonial-heading">
                                        <h5><?php echo htmlentities($result->namaPenyewa); ?></h5>
                                        <p><?php echo htmlentities($result->testimoni); ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
        <!-- Dark Overlay-->
        <div class="dark-overlay"></div>
    </section>
    <!-- /Testimonial-->


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
    <!--/Forgot-password-Form -->

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

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>