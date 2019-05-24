 	<section id='content-wrapper'>
		<div id='product-wrapper'>
		<?php
			if($tResult[0]['ttl'] > 0) {
		?>
			<div id='navigation-list'>
				<button class='cList active'><img src='<?php echo SITE_URL ?>assets/img/site/list-white.png'></button>
				<button class='cGrid'><img src='<?php echo SITE_URL ?>assets/img/site/grid-gray.png'></button>
			</div>
			<div style="clear:both"></div>
		<?php
		}
			$q = empty($_GET['q']) ? '': $_GET['q'];
			if($tResult[0]['ttl'] <= 0)
				echo "<div class='alert alert-danger'><b>Alert: </b>0 results for <u>$q</u> keyword</div><br>";
			else
				echo "<div class='alert alert-info'><b>Alert: </b>" . $tResult[0]['ttl'] . " results for <u>$q</u> keyword</div><br>";

			include 'views/front/partials/files/product.php'
		?>

		</div>
	</section>
	<div style='clear:both'></div>
</section>