<?php
//error_reporting(0);
if (isset($_POST['submit'])) {
  $emailPenyewa = $_POST['emailPenyewa'];
  $username = $_POST['username'];
  $fname = $_POST['namaPenyewa'];
  $telepon = $_POST['telepon'];
  $password = md5($_POST['password']);
  $alamat = $_POST['alamat'];
  $sql = "INSERT INTO  penyewa(emailPenyewa,username,namaPenyewa,telepon,password,alamat) VALUES(:emailPenyewa,:username,:fname,:telepon,:password,:alamat)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
  $query->bindParam(':username', $username, PDO::PARAM_STR);
  $query->bindParam(':fname', $fname, PDO::PARAM_STR);
  $query->bindParam(':telepon', $telepon, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->bindParam(':alamat', $alamat, PDO::PARAM_STR);
  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if ($lastInsertId) {
    echo "<script>alert('Pendaftaran Berhasil, Sekarang Kamu Dapat Mulai Menyewa');</script>";
  } else {
    echo "<script>alert('Pendaftaran Gagal, Coba Lagi.');</script>";
  }
}

?>


<script type="text/javascript">
  function valid() {
    if (document.daftar.password.value != document.daftar.confirmpassword.value) {
      alert("Password and Konfirmasi Password Tidak Cocok  !!");
      document.daftar.confirmpassword.focus();
      return false;
    }
    return true;
  }
</script>
<script>
  function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
      url: "check_availability.php",
      data: 'emailPenyewa=' + $("#emailPenyewa").val(),
      type: "POST",
      success: function(data) {
        $("#user-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error: function() {}
    });
  }
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Daftar</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post" name="daftar" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="namaPenyewa" placeholder="Nama Lengkap*" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username*" required="required">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="emailPenyewa" id="emailPenyewa" onBlur="checkAvailability()" placeholder="Email*" required="required">
                  <span id="user-availability-status" style="font-size:12px;"></span>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="telepon" placeholder="Nomor Telepon*" maxlength="13" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Konfirmasi Password*" required="required">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="alamat" placeholder="Alamat Sesuai KTP*" required="required">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">Saya setuju dengan <a href="terms.php">Syarat dan Ketentuan</a></label>
                </div>
                <div class="form-group">
                  <button class="btn btn-block" type="submit" name="submit">Sign Up</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Sudah Punya Akun? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Disini</a></p>
      </div>
    </div>
  </div>
</div>