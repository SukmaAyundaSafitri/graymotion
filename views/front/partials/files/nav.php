
<section id='menu-wrapper'>
	<a href='<?php echo SITE_URL ?>' class='logo f-left'>
		<img src='<?php echo SITE_URL ?>assets/img/site/Graymotion.png'>
	</a>
	<nav class='f-right'>
		<ul class='f-left'>
			<div class='wrap-search-cart'>
				<div class='search-box f-right'>
					<form action='<?php echo SITE_URL ?>search'>
						<img src='<?php echo SITE_URL ?>assets/img/site/search.png'>
						<input type='text' placeholder='PENCARIAN...' name='q' value='<?php echo Input::get('q') ?>'>
					</form>
				</div>

				<div class='cart-box f-right'>
					<button class='btn-list-chart'  style="border-radius:0;">
						<img src='<?php echo SITE_URL ?>assets/img/site/cart.png' align='middle'><font style=" width:20px;"><?php echo count($_SESSION['cart']); ?></font>
					</button>
					<ul class='list-chart'>
						<div class='list'>
						</div>
						<div class='link'>
							<a href='<?php echo SITE_URL ?>cart/'>Beli Sekarang</a>
						</div>
					</ul>
				</div>
			</div>
			<a href='<?php echo SITE_URL ?>'</a>
			<li>Beranda</li>
			</a>
			<a href="<?php echo SITE_URL ?>about/"><li>Tentang</li></a>
	<?php
		if(!$_SESSION['userlogin']) {
			echo "<a href='" . SITE_URL . "user/login/'><li>Login</li></a>
			<a href='" . SITE_URL . "user/register/'><li>Daftar</li></a>";
		}
		else {
			if($_SESSION['userlevel'] == 1)
				echo "<a href='" . SITE_URL . "admin'><li>CPanel</li></a><a href='" . SITE_URL . "user/logout/'><li>Logout</li></a>";
			else {
				echo "<li>Akun
					<ul>
						<a href='" . SITE_URL . "user/view/'><li>&times; &nbsp; &nbsp;Lihat Account</li></a>
						<a href='" . SITE_URL . "user/password/'><li>&times; &nbsp; &nbsp;Ubah Password</li></a>
						<a href='" . SITE_URL . "user/history/'><li>&times; &nbsp; &nbsp;Riwayat Transaksi</li></a>
						<a href='" . SITE_URL . "user/wishlist/'><li>&times; &nbsp; &nbsp;Daftar Belanja</li></a>
						<a href='" . SITE_URL . "user/logout/'><li>&times; &nbsp; &nbsp;Logout</li></a>
					</ul>
				</li>";
				echo "<a href='" . SITE_URL . "confirm/'><li>Konfirmasi</li></a>";
			}
		}
	?>
		</ul>
	</nav>
	
	<div class='btn-toggle btn-toggle1'>
		<div class='bar'></div>
		<div class='bar'></div>
		<div class='bar'></div>
		<div class='bar'></div>
	</div>
	<div class='btn-toggle btn-toggle2'>
	<div class='bar'></div>
		<div class='bar'></div>
		<div class='bar'></div>
	</div>
</section>
