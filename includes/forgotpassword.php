<?php
if (isset($_POST['update'])) {
  $emailPenyewa = $_POST['emailPenyewa'];
  $telepon = $_POST['telepon'];
  $newpassword = md5($_POST['newpassword']);
  $sql = "SELECT emailPenyewa FROM penyewa WHERE emailPenyewa=:emailPenyewa and telepon=:telepon";
  $query = $dbh->prepare($sql);
  $query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
  $query->bindParam(':telepon', $telepon, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    $con = "UPDATE penyewa SET password=:newpassword where emailPenyewa=:emailPenyewa and telepon=:telepon";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
    $chngpwd1->bindParam(':telepon', $telepon, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    echo "<script>alert('Password Berhasil Diubah');</script>";
  } else {
    echo "<script>alert('Email atau Nomor Telepon Tidak Ada');</script>";
  }
}
?>

<script type="text/javascript">
  function valid() {
    if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
      alert("Password Baru dan Konfirmasi Password Tidak Sama  !!");
      document.chngpwd.confirmpassword.focus();
      return false;
    }
    return true;
  }
</script>
<div class="modal fade" id="forgotpassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Ganti Password</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="forgotpassword_wrap">
            <div class="col-md-12">
              <form name="chngpwd" method="post" onSubmit="return valid();">
                <div class="form-group">
                  <input type="email" name="emailPenyewa" class="form-control" placeholder="Email Terdaftar*" required="">
                </div>
                <div class="form-group">
                  <input type="text" name="telepon" class="form-control" placeholder="Nomor Telepon terdaftar*" required="">
                </div>
                <div class="form-group">
                  <input type="password" name="newpassword" class="form-control" placeholder="Password Baru*" required="">
                </div>
                <div class="form-group">
                  <input type="password" name="confirmpassword" class="form-control" placeholder="Konfirmasi Password*" required="">
                </div>
                <div class="form-group">
                  <input type="submit" value="Ubah Password" name="update" class="btn btn-block">
                </div>
              </form>
              <div class="text-center">
                <p class="gray_text">Jangan Berikan Passwordmu Kepada Siapa pun.<br>Password Akan Diubah Jika Mengeklik Tombol "Ubah Password".</p>
                <p><a href="#loginform" data-toggle="modal" data-dismiss="modal"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Kembali ke Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>