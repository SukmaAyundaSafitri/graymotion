<div class='list' id='view-product'>
		<?php
			$n = 0;
			foreach($barangs as $barang) {
			$n++;
		?>
				<div class='item'>
					<a href='<?php echo SITE_URL ?>product/<?php echo $barang['permalink']; ?>/'>
						<div class='thumb'>
							<img src='<?php echo SITE_URL ?>assets/img/product/<?php echo $barang['img'] ?>'>
						</div>
					</a>
					<div class='content'>
						<div class='header'>
							<div class='title'>
								<a href='<?php echo SITE_URL . 'product/' . $barang['permalink'] ?>/'><?php echo $barang['nama'] ?></a><br>
							</div>
							<div class='progress'>
								<div style='width: <?php echo ($barang['rating']/5 * 100) ?>%;'>&nbsp;</div>
							</div>
							<div class='rating' title='Rating Product'>
								<?php echo $barang['rating'] ?>
							</div>
							<div style='clear: both'></div>
						</div>

						<div class='nav'>
							Admin &nbsp;&raquo;&nbsp; Product &nbsp;&raquo;&nbsp; <a class='link-blue-gray' href='<?php echo SITE_URL . "category/product/". strtolower($barang['nama_kategori']) ?>/'><?php echo $barang['nama_kategori'] ?></a>
						</div>

						<div class='body'>
							<?php echo substr($barang['deskripsi'], 0, 70) ?>...
						</div>

						<div class='footer'>
							<div class='price'>
								<?php if($barang['s'] != 0 || $barang['m'] != 0 || $barang['l'] != 0 || $barang['xl'] != 0)
										echo 'Tersedia';
									else
										echo 'Tidak Tersedia';
								?>
								<br><br>
								Rp. <?php echo number_format($barang['harga'], 0, 0, ".") ?> / pcs
							</div>

							<div class='buttons'>
								<a href='<?php echo SITE_URL ?>product/<?php echo $barang['permalink']; ?>/'><button class='btn btn-white-blue btn-detail'>Details</button></a>
								<!--<a href='<?php echo SITE_URL ?>product/<?php echo $barang['permalink']; ?>/'><button class='btn btn-white-blue btn-detail'>Wishlist</button></a>-->

								<?php if($barang['s'] != 0 || $barang['m'] != 0 || $barang['l'] != 0 || $barang['xl'] != 0) { ?>
 										<a href='<?php echo SITE_URL ?>product/<?php echo $barang['permalink']; ?>/'><button class='btn btn-white-blue btn-chart'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tambah Ke Keranjang</button></a>
								<?php }	else { ?>
										<a href='<?php echo SITE_URL ?>wishlist/<?php echo $barang['id']; ?>/add'><button class='btn btn-white-blue btn-chart'>Daftar Keranjang</button></a>
								<?php	}
								?>
							</div>

							<div style='clear: both'></div>
						</div>
					</div>

					<div style='clear: both'></div>
				</div>
				
		<?php
				if($n % 3 == 0)
					echo "<div style='clear: both'></div>";
			}
		?>
				<div style='clear:both'></div>
			</div>

	<div id='paging-wrapper'>
		<?php
			$ttl = ceil($ttlProduct[1] / 6);
			if($page == 'home')
				echo "<div class='nav " . (($ttlProduct[0] == 1) ? 'disabled': '') . "'><a href='" . ($ttlProduct[0] - 1) . "'>&laquo;</a></div>";
			else if($page == 'search')
				echo "<div class='nav " . (($ttlProduct[0] == 1) ? 'disabled': '') . "'><a href='" . ($ttlProduct[0] - 1) . "&q=$q'>&laquo;</a></div>";
			else if($page == 'category-product')
				echo "<div class='nav " . (($ttlProduct[0] == 1) ? 'disabled': '') . "'><a href='" . SITE_URL . "category/product/$category/" . ($ttlProduct[0] - 1) . "'>&laquo;</a></div>";

			for($i = 1; $i <= $ttl; $i++) {
				if($page == 'home')
					echo "<div class='nav'><a href='$i'>$i</a></div>";
				else if($page == 'search') {
					$q = empty($_GET['q']) ? '': $_GET['q'];
					echo "<div class='nav'><a href='" . SITE_URL . "search/$i&q=$q'>$i</a></div>";
				}
				else if($page == 'category-product') {
					echo "<div class='nav'><a href='" . SITE_URL . "category/product/$category/$i'>$i</a></div>";
				}
			}

			if($page == 'home')
				echo "<div class='nav " . (($ttlProduct[0] >=  $ttl) ? 'disabled': '') . "'><a href='" . ($ttlProduct[0] + 1) . "'>&raquo;</a></div>";
			else if($page == 'search')
				echo "<div class='nav " . (($ttlProduct[0] >=  $ttl) ? 'disabled': '') . "'><a href='" . SITE_URL . "search/" . ($ttlProduct[0] + 1) . "&q=$q'>&raquo;</a></div>";
			else if($page == 'category-product')
				echo "<div class='nav " . (($ttlProduct[0] >= $ttl) ? 'disabled': '') . "'><a href='" . SITE_URL . "category/product/$category/" . ($ttlProduct[0] + 1) . "'>&raquo;</a></div>";
		?>
			
			<div class='f-right'>
				<b><?php echo $ttlProduct[1] ?></b> Products from Graymotion.com
			</div>
			<div style="clear:both"></div>
		</div> 