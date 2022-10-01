	<nav class="ts-sidebar">
		<ul class="ts-sidebar-menu">

			<li class="ts-label">Main</li>
			<?php if ($_SESSION['role'] == 99) { ?>
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Laporan</a></li>
				<li><a href="kelola-merk.php"><i class="fa fa-files-o"></i> Daftar Merk</a></li>
				<li><a href="kelola-motor.php"><i class="fa fa-sitemap"></i> Daftar Motor</a>
				</li>
				<li><a href="kelola-pesanan.php"><i class="fa fa-users"></i> Daftar Pemesanan</a></li>
				<li><a href="kelola-testimoni.php"><i class="fa fa-table"></i> Daftar Testimoni</a></li>
				<li><a href="penyewa.php"><i class="fa fa-users"></i> Daftar Penyewa</a></li>
				<li><a href="kelola-sosmed.php"><i class="fa fa-files-o"></i> Daftar Sosial Media</a></li>
			<?php
			} else { ?>
				<li><a href="#"><i class="fa fa-files-o"></i> Merk</a>
					<ul>
						<li><a href="tambah-merk.php"> Tambah Merk</a></li>
						<li><a href="kelola-merk.php"> Kelola Merk</a></li>
					</ul>
				</li>

				<li><a href="#"><i class="fa fa-sitemap"></i> Motor</a>
					<ul>
						<li><a href="tambah-motor.php"> Tambah Motor</a></li>
						<li><a href="kelola-motor.php"> Kelola Motor</a></li>
					</ul>
				</li>
				<li><a href="kelola-pesanan.php"><i class="fa fa-users"></i> Kelola Pemesanan</a></li>

				<li><a href="kelola-testimoni.php"><i class="fa fa-table"></i> Kelola Testimoni</a></li>
				<li><a href="penyewa.php"><i class="fa fa-users"></i> Kelola Penyewa</a></li>
				<li><a href="kelola-sosmed.php"><i class="fa fa-files-o"></i> Kelola Sosial Media</a></li>
			<?php
			} ?>

		</ul>
	</nav>