	<section id='content-wrapper'>
		<div id='product-wrapper'>
			<div id='navigation-list'>
				<button class='cList active'><img src='<?php echo SITE_URL ?>assets/img/site/list-white.png'></button>
				<button class='cGrid'><img src='<?php echo SITE_URL ?>assets/img/site/grid-gray.png'></button>
			</div>
			<div style="clear:both"></div>

		<div class='list' id='view-product'> 

		<?php
			$n = 0;
			foreach($artikels as $artikel) {
			$n++;
		?>
				<div class='item'>
					<div class='thumb'>
						<img src='<?php echo SITE_URL ?>assets/img/article/<?php echo $artikel['img'] ?>'>
					</div>
					<div class='content'>
						<div class='header'>
							<div class='title'>
								<a href='<?php echo SITE_URL . 'article/' . $artikel['permalink'] ?>/'><?php echo $artikel['judul'] ?></a><br>
							</div>
							<div style="clear: both"></div>
						</div>

						<div class='nav'>
							Admin &nbsp;&raquo;&nbsp; Article &nbsp;&raquo;&nbsp; <a class='link-blue-gray' href='<?php echo SITE_URL . "category/article/". strtolower($artikel['nama']) ?>/'><?php echo $artikel['nama'] ?></a>
						</div>

						<div class='body'>
							<?php echo substr($artikel['isi'], 0, 500) ?>...
							<br>
							<a class='link-blue-gray' href='<?php echo SITE_URL . 'article/' . $artikel['permalink'] ?>/'>Read more this article &raquo;</a>
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
			echo "<div class='nav " . (($ttlProduct[0] == 1) ? 'disabled': '') . "'><a href='" . SITE_URL . "category/article/$category/" . ($ttlProduct[0] - 1) . "'>&laquo;</a></div>";

			for($i = 1; $i <= $ttl; $i++)
				echo "<div class='nav'><a href='" . SITE_URL . "category/article/$category/$i'>$i</a></div>";

			echo "<div class='nav " . (($ttlProduct[0] >= $ttl) ? 'disabled': '') . "'><a href='" . SITE_URL . "category/article/$category/" . ($ttlProduct[0] + 1) . "'>&raquo;</a></div>";
		?>
			
			<div class='f-right'>
				<b><?php echo $ttlProduct[1] ?></b> Articles from BS.com
			</div>
			<div style="clear:both"></div>
		</div> 
		</div>
	</section>
	<div style='clear:both'></div>
</section>