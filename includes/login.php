<?php
if (isset($_POST['login'])) {
  $emailPenyewa = $_POST['emailPenyewa'];
  $password = md5($_POST['password']);
  $sql = "SELECT emailPenyewa,password,namaPenyewa FROM penyewa WHERE emailPenyewa=:emailPenyewa and password=:password";
  $query = $dbh->prepare($sql);
  $query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    $_SESSION['login'] = $_POST['emailPenyewa'];
    $_SESSION['fname'] = $results->namaPenyewa;
    $currentpage = $_SERVER['REQUEST_URI'];
    echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
  } else {
    echo "<script>alert('Email atau Password salah');</script>";
  }
}
?>

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="emailPenyewa" placeholder="Email address*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Belum Punya Akun? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Daftar Disini</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Lupa Password?</a></p>
      </div>
    </div>
  </div>
</div>