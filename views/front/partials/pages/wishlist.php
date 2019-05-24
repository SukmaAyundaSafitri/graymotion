	<section id='content-wrapper'>
  		<div id='cart-wrapper'>
			<div class='title'>
				My Wishlist
			</div>
			<div class='content'>
				<div class='table'>
					<?php
						if(isset($_SESSION['message'])) {
							echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div><br>";
							unset($_SESSION['message']);
						}
					?>
					<table>
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Date</th>
							<th>Action</th>
						</tr>

					<?php
						foreach ($wishlist as $val) {
							echo "<tr>
								<td><img src='" . SITE_URL . "assets/img/product/$val[img]' width='150px' height='150px'></td>
								<td><a href='". SITE_URL ."product/$val[permalink]/'>$val[nama]</a></td>
								<td>$val[tanggal]</td>
								<td><a href='" . SITE_URL . "wishlist/$val[id]/destroy'><button class='btn btn-blue-white'>Delete</button></a></td>
							</tr>";
						}
						if(count($wishlist) < 1) {
							echo "<tr><td colspan='4'><b>No Data</b></td></tr>";
						}
					?>

					</table>
				</div>
			</div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>