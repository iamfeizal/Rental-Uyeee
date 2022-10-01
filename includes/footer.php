<footer>
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h6>Rental UYEEE</h6>
          <ul>
            <li><a href="contact-us.php">Hubungi Kami</a></li>
            <li><a href="about-us.php">Tentang Kami</a></li>
            <li><a href="terms.php">Syarat dan Ketentuan</a></li>
            <li><a href="admin/index.php">Admin Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <div class="footer_widget">
            <p>Temukan Kami di :</p>
            <ul>
              <?php $sql = "SELECT alamatRental,emailRental,teleponRental,wa,fb,twt,ig from kontak";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = 1;
              if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                  <li><a href="https://wa.me/<?php echo htmlentities($result->wa); ?>?text=Halo%20Admin%20Rental%20UYEEE%0ASaya%20perlu%20bantuan" target="blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                  <li><a href="<?php echo htmlentities($result->fb); ?>"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                  <li><a href="<?php echo htmlentities($result->twt); ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                  <li><a href="<?php echo htmlentities($result->ig); ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
              <?php
                }
              } ?>
            </ul>
          </div>
        </div>
        <!--<div class="col-md-6 col-md-pull-6">
          <p class="copy-right">Copyright &copy; 2018 Bike Rental Portal. Brought To You By <a href="https://code-projects.org/">Code-Projects</a></p>
        </div>-->
      </div>
    </div>
  </div>
</footer>