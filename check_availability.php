<?php
require_once("includes/config.php");
// code user email availablity
if (!empty($_POST["emailPenyewa"])) {
	$emailPenyewa = $_POST["emailPenyewa"];
	if (filter_var($emailPenyewa, FILTER_VALIDATE_EMAIL) === false) {
		echo "Email Tidak Valid.";
	} else {
		$sql = "SELECT emailPenyewa FROM penyewa WHERE emailPenyewa=:emailPenyewa";
		$query = $dbh->prepare($sql);
		$query->bindParam(':emailPenyewa', $emailPenyewa, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		$cnt = 1;
		if ($query->rowCount() > 0) {
			echo "<span style='color:red'>Email Tidak Tersedia</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else {
			echo "<span style='color:green'>Email Tersedia</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
}
?>
