<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2">
          <div class="logo"> <a href="index.php"><img src="assets/images/logg2.png" alt="image" /></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">
            <?php $sql = "SELECT alamatRental,emailRental,teleponRental,wa,fb,twt,ig from kontak";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
              foreach ($results as $result) { ?>
                <div class="header_widgets">
                  <div class="circle_icon">
                    <a href="mailto:<?php echo htmlentities($result->emailRental); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                  </div>
                  <a href="mailto:<?php echo htmlentities($result->emailRental); ?>">
                    <p class="uppercase_text">Email Kami : </p>
                  </a>
                  <a href="mailto:<?php echo htmlentities($result->emailRental); ?>"><?php echo htmlentities($result->emailRental); ?></a>
                </div>
                <div class="header_widgets">
                  <div class="circle_icon">
                    <a href="tel:<?php echo htmlentities($result->teleponRental); ?>"><i class="fa fa-phone" aria-hidden="true"></i></a>
                  </div>
                  <a href="tel:<?php echo htmlentities($result->teleponRental); ?>">
                    <p class="uppercase_text">Nomor Telepon: </p>
                  </a>
                  <a href="tel:<?php echo htmlentities($result->teleponRental); ?>">+<?php echo htmlentities($result->teleponRental); ?></a>
                </div>
                <div class="social-follow">
                  <ul>
                    <li><a href="https://wa.me/<?php echo htmlentities($result->wa); ?>?text=Halo%20Admin%20Rental%20UYEEE%0ASaya%20perlu%20bantuan" target="blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo htmlentities($result->fb); ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo htmlentities($result->twt); ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                    <li><a href="<?php echo htmlentities($result->ig); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  </ul>
                </div>
            <?php }
            } ?>
            <?php if (strlen($_SESSION['login']) == 0) {
            ?>
              <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Daftar</a> </div>
            <?php } else {
              echo "Selamat Datang di Rental UYEEE";
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
                <?php
                $emailPenyewa = $_SESSION['login'];
                $sql = "SELECT username FROM penyewa WHERE emailPenyewa=:emailPenyewa ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
                    echo htmlentities($result->username);
                  }
                } ?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
                <?php if ($_SESSION['login']) { ?>
                  <li><a href="profil.php">Pengaturan Profil</a></li>
                  <li><a href="update-password.php">Ubah Password</a></li>
                  <li><a href="pesananku.php">Pesananku</a></li>
                  <li><a href="kirim-testimoni.php">Kirim Testimoni</a></li>
                  <li><a href="testimoniku.php">Testimoniku</a></li>
                  <li><a href="includes/logout.php">Sign Out</a></li>
                <?php } else { ?>
                  <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Login</a></li>
                <?php } ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Beranda</a> </li>
          <li><a href="daftar-motor.php">Daftar Motor</a>
          <li><a href="rekening.php">Konfirmasi Pembayaran</a></li>
          <li><a href="contact-us.php">Hubungi Kami</a></li>
          <li><a href="about-us.php">Tentang Kami</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navigation end -->

</header>