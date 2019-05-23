
	
	<section id='content-wrapper'>
		<?php
			if(isset($_SESSION['message']))
				echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
			unset($_SESSION['message']);
		?>
		<div id='about-wrapper'>
			<div class='title'>Tentang BanyuwangiShop.com</div>
			<div class='content'>
				Banyuwangi Shop ini keren dan bagus, Semoga Banyuwangi Shop ini Bermanfaat.Banyuwangi Shop ini keren dan bagus, Semoga Banyuwangi Shop ini Bermanfaat.Banyuwangi Shop ini keren dan bagus, Semoga Banyuwangi Shop ini Bermanfaat.Banyuwangi Shop ini keren dan bagus, Semoga Banyuwangi Shop ini Bermanfaat.Banyuwangi Shop ini keren dan bagus, Semoga Banyuwangi Shop ini Bermanfaat.
			</div>
			<div class='nav'>
				<a href='about/'>&raquo; &nbsp;Lihat Selengkapnya</a>
			</div>
		</div>

		<div id='product-wrapper'>
			<div id='navigation-list'>
				<button class='cList active'><img src='<?php echo SITE_URL ?>assets/img/site/list-white.png'></button>
				<button class='cGrid'><img src='<?php echo SITE_URL ?>assets/img/site/grid-gray.png'></button>
			</div>
			<div style="clear:both"></div>

		<?php
			include 'views/front/partials/files/product.php';
		?>
		</div>
		
		<div id='article-wrapper'>
			<div class='box f-left item artikel1 artikelar' style="background: #808080">
				<div class='title'>
					<a href='<?php echo SITE_URL ?>article/<?php echo $artikels[0]['permalink']; ?>/'><?php echo $artikels[0]['judul']; ?></a>
				</div>
				<div class='date'>
					Admin &bull; <?php echo $artikels[0]['tgl_terbit']; ?>
				</div>
				<div class='content'>
					<?php echo substr($artikels[0]['isi'], 0, 200); ?>
				</div>
			</div>
			<div class='box f-left image1 imagear'>
				<a href='<?php echo SITE_URL ?>article/<?php echo $artikels[0]['permalink']; ?>/'><img src='<?php echo SITE_URL ?>assets/img/article/<?php echo $artikels[0]['img']; ?>' class='gambar1'></a>
			</div>

			<div class='box f-left item artikel2 artikelar' style="background: #2497d0">
				<div class='title'>
					<a href='<?php echo SITE_URL ?>article/<?php echo $artikels[1]['permalink']; ?>/'><?php echo $artikels[1]['judul']; ?></a>
				</div>
				<div class='date'>
					Admin &bull; <?php echo $artikels[1]['tgl_terbit']; ?>
				</div>
				<div class='content'>
					<?php echo substr($artikels[1]['isi'], 0, 200); ?>
				</div>
			</div>
			<div class='box f-left image3 imagear'>
				<a href='<?php echo SITE_URL ?>article/<?php echo $artikels[1]['permalink']; ?>/'><img src='<?php echo SITE_URL ?>assets/img/article/<?php echo $artikels[2]['img']; ?>' class='gambar3'></a>
			</div>

			<div class='box f-left item artikel3 artikelar' style="background: #385e6f">
				<div class='title'>
					<a href='<?php echo SITE_URL ?>article/<?php echo $artikels[2]['permalink']; ?>/'><?php echo $artikels[2]['judul']; ?></a>
				</div>
				<div class='date'>
					Admin &bull; <?php echo $artikels[2]['tgl_terbit']; ?>
				</div>
				<div class='content'>
					<?php echo substr($artikels[2]['isi'], 0, 200); ?>
				</div>
			</div>
			<div class='box f-left image2 imagear'>
				<a href='<?php echo SITE_URL ?>article/<?php echo $artikels[2]['permalink']; ?>/'><img src='<?php echo SITE_URL ?>assets/img/article/<?php echo $artikels[1]['img']; ?>' class='gambar2'></a>
			</div>
		</div>
	</section>
	<div style='clear:both'></div>
</section>