<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['send'])) {
    $namaPengirim = $_POST['namaPengirim'];
    $emailPengirim = $_POST['emailPengirim'];
    $teleponPengirim = $_POST['teleponPengirim'];
    $masukan = $_POST['masukan'];
    $sql = "INSERT INTO  masukan(namaPengirim,emailPengirim,teleponPengirim,masukan) VALUES(:namaPengirim,:emailPengirim,:teleponPengirim,:masukan)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':namaPengirim', $namaPengirim, PDO::PARAM_STR);
    $query->bindParam(':emailPengirim', $emailPengirim, PDO::PARAM_STR);
    $query->bindParam(':teleponPengirim', $teleponPengirim, PDO::PARAM_STR);
    $query->bindParam(':masukan', $masukan, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        $msg = " Masukan Telah Dikirim, Terimakasih Atas Masukannya";
    } else {
        $error = " Masukan Gagal Dikirim, Harap Coba Lagi";
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
    <title>Rental | UYEEE</title>
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
    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->

    <!--Page Header-->
    <section class="page-header contactus_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    <h1>Hubungi Kami</h1>
                </div>
                <ul class="coustom-breadcrumb">
                    <li><a href="index.php">Beranda</a></li>
                    <li>Hubungi Kami</li>
                </ul>
            </div>
        </div>
        <!-- Dark Overlay-->
        <div class="dark-overlay"></div>
    </section>
    <!-- /Page Header-->

    <!--Contact-us-->
    <section class="contact_us section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3>Kotak Masukan</h3>
                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>BERHASIL</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                    <div class="contact_form gray-bg">
                        <form method="post">
                            <div class="form-group">
                                <label class="control-label">Nama Lengkap<span>*</span></label>
                                <input type="text" name="namaPengirim" class="form-control white_bg" id="fullname" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email<span>*</span></label>
                                <input type="email" name="emailPengirim" class="form-control white_bg" id="emailaddress" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Nomor Telepon<span>*</span></label>
                                <input type="text" name="teleponPengirim" class="form-control white_bg" id="phonenumber" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Masukan<span>*</span></label>
                                <textarea class="form-control white_bg" name="masukan" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn" type="submit" name="send" type="submit">Kirim Masukan <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Contact Info</h3>
                    <div class="contact_detail">
                        <?php
                        $sql = "SELECT alamatRental,emailRental,teleponRental,wa,fb,twt,ig from kontak";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <ul>
                                    <li>
                                        <div class="icon_wrap">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        </div>
                                        <div class="contact_info_m">
                                            <?php echo htmlentities($result->alamatRental); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon_wrap">
                                            <a href="tel:<?php echo htmlentities($result->teleponRental); ?>"><i class="fa fa-phone" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="contact_info_m">
                                            <a href="tel:<?php echo htmlentities($result->teleponRental); ?>">+<?php echo htmlentities($result->teleponRental); ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon_wrap">
                                            <a href="mailto:<?php echo htmlentities($result->emailRental); ?>">
                                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="contact_info_m">
                                            <a href="mailto:<?php echo htmlentities($result->emailRental); ?>"><?php echo htmlentities($result->emailRental); ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon_wrap">
                                            <a href="https://wa.me/<?php echo htmlentities($result->wa); ?>">
                                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="contact_info_m">
                                            <a href="https://wa.me/<?php echo htmlentities($result->wa); ?>">+<?php echo htmlentities($result->wa); ?></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon_wrap">
                                            <a href="<?php echo htmlentities($result->fb); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="contact_info_m">
                                            <a href="<?php echo htmlentities($result->fb); ?>">Rental UYEEE</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon_wrap">
                                            <a href="<?php echo htmlentities($result->twt); ?>"><i class="fa fa-twitter" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="contact_info_m">
                                            <a href="<?php echo htmlentities($result->twt); ?>">Rental UYEEE</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon_wrap">
                                            <a href="<?php echo htmlentities($result->twt); ?>"><i class="fa fa-instagram" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="contact_info_m">
                                            <a href="<?php echo htmlentities($result->ig); ?>">Rental UYEEE</a>
                                        </div>
                                    </li>
                                </ul>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Contact-us-->


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

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/contact-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:26:55 GMT -->

</html>