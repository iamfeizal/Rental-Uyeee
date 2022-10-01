<div class="profile_nav">
    <ul>
        <li><a href="rekening.php">Daftar Rekening</a></li>
        <?php if (strlen($_SESSION['login']) == 0) {
            ?>
              <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Konfirmasi Pembayaran</a></li>
            <?php } else{?>
                <li><a href="pembayaran.php">Konfirmasi Pembayaran</a></li>
            <?php } ?>
    </ul>
</div>
</div>