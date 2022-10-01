<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
?>
    <!DOCTYPE HTML>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <title>Rental UYEEE | Pesananku</title>
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
        <!-- Google-Font-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    </head>

    <body>

        <!--Header-->
        <?php include('includes/header.php'); ?>
        <!-- /Header -->

        <!--Page Header-->
        <section class="page-header profile_page">
            <div class="container">
                <div class="page-header_wrap">
                    <div class="page-heading">
                        <h1>Pesananku</h1>
                    </div>
                    <ul class="coustom-breadcrumb">
                        <li><a href="index.php">Beranda</a></li>
                        <li>Pesananku</li>
                    </ul>
                </div>
            </div>
            <!-- Dark Overlay-->
            <div class="dark-overlay"></div>
        </section>
        <!-- /Page Header-->

        <?php
        $emailPenyewa = $_SESSION['login'];
        $sql = "SELECT * FROM penyewa WHERE emailPenyewa=:emailPenyewa";
        $query = $dbh->prepare($sql);
        $query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
                <section class="user_profile inner_pages">
                    <div class="container">
                        <div class="user_profile_info gray-bg padding_4x4_40">
                            <div class="upload_user_logo"> <img src="assets/images/dealer-logo.jpg" alt="image">
                            </div>
                            <div class="dealer_info">
                                <h5><?php echo htmlentities($result->namaPenyewa); ?></h5>
                                <p><?php echo htmlentities($result->alamat);
                                }
                            } ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <?php include('includes/sidebar.php'); ?>
                                <div class="col-md-8 col-sm-10">
                                    <div class="profile_wrap">
                                        <h5 class="uppercase underline">Pesananku</h5>
                                        <div class="my_vehicles_list">
                                            <ul class="vehicle_listing">
                                                <?php
                                                $emailPenyewa = $_SESSION['login'];
                                                $sql = "SELECT pemesanan.*,motor.idMotor,motor.namaMotor,motor.gambar1,merk.namaMerk FROM pemesanan JOIN motor ON pemesanan.idMotor=motor.idMotor JOIN merk ON motor.idMerk=merk.idMerk WHERE pemesanan.emailPenyewa=:emailPenyewa ORDER BY idPemesanan DESC";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {  ?>
                                                        <li>
                                                            <div class="vehicle_img"> <a href="detail-motor.php?mtid=<?php echo htmlentities($result->vid); ?>"><img src=" admin/img/vehicleimages/<?php echo htmlentities($result->gambar1); ?>" alt="image"></a> </div>
                                                            <div class="vehicle_title">
                                                                <h6><a href="detail-motor.php?mtid=<?php echo htmlentities($result->vid); ?>"> <?php echo htmlentities($result->namaMerk); ?>, <?php echo htmlentities($result->namaMotor); ?></a></h6>
                                                                <p><b>Dari Tanggal:</b> <?php echo htmlentities($result->dariTgl); ?><br /> <b>Sampai Tanggal:</b> <?php echo htmlentities($result->sampaiTgl); ?></p>
                                                            </div>
                                                            <?php if ($result->status == 1) { ?>
                                                                <div class="vehicle_status"> <button class="btn outline btn-xs active-btn">Disetujui</button>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                            <?php } else if ($result->status == 2) { ?>
                                                                <div class="vehicle_status"> <button class="btn outline btn-xs">Dibatalkan</button>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                            <?php } else { ?>
                                                                <div class="vehicle_status"> <button class="btn outline btn-xs">Belum Dikonfirmasi</button>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            <?php } ?>
                                                            <div style="float: left">
                                                                <p><b>Total: <span style="color:red">Rp. <?php echo htmlentities($result->totalHarga); ?></span></b></p>
                                                                <p><b>Pesan:</b> <?php echo htmlentities($result->pesan); ?> </p>
                                                            </div>
                                                        </li>
                                                <?php }
                                                } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
                <!--/my-vehicles-->
                <?php include('includes/footer.php'); ?>

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
<?php } ?>