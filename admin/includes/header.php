<div class="brand clearfix">
	<a href="#" style="font-size: 20px;">Rental UYEEE | Admin</a>
	<span class="menu-btn"><i class="fa fa-bars"></i></span>
	<ul class="ts-profile-nav">
		<li class="ts-account">
			<?php
			$emailAdmin = $_SESSION['alogin'];
			$sql = "SELECT username FROM admin WHERE emailAdmin=:emailAdmin";
			$query = $dbh->prepare($sql);
			$query->bindParam(':emailAdmin', $emailAdmin, PDO::PARAM_STR);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			if ($query->rowCount() > 0) { 
				foreach ($results as $result) {?>
				<a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> <?php echo htmlentities($result->username); ?><i class="fa fa-angle-down hidden-side"></i></a>
			<?php }
			}
			?>
			<ul>
				<li><a href="ubah-password.php">Ubah Password</a></li>
				<li><a href="includes/logout.php">Logout</a></li>
			</ul>
		</li>
	</ul>
</div>