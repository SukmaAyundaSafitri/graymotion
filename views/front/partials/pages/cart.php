 	<section id='content-wrapper'>
		<div id='cart-wrapper'>
			<div class='title'>
				List Cart
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
							<th>Name</th>
							<th>Size</th>
							<th>Color</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Total</th>
							<th>Action</th>
						</tr>

					<?php
						foreach($_SESSION['cart'] as $cart) {
							echo '<tr>
								<td>' . $cart[1] . '</td>
								<td>' . $cart[3] . '</td>
								<td>' . $cart[2] . '</td>
								<td>' . $cart[4] . '</td>';

							foreach($barangs as $barang) {
								if($barang['id'] == $cart[0]) {
									echo '<td>Rp. ' . number_format($barang['harga'], 0, '', '.') . '</td>
									<td>Rp. ' . number_format($cart[4] * $barang['harga'], 0, '', '.') . '</td>';

									break;
								}
							}

								echo '<td data-id="' . $barang['id'] . '" data-size="' . $cart[3] . '" data-warna="' . $cart[2] . '">
									<button class="btn btn-blue-white btn-update-qty">Update Qty</button>
									<button class="btn btn-blue-white btn-remove-cart">Remove</button>
								</td>
							</tr>';
						}
					?>

					</table>
				</div>
			</div><br>
			<a href='<?php echo SITE_URL ?>transaction/1'><button class='btn btn-white-blue f-right' style='width: 150px'>Next Step (1)</button></a>
			<div style="clear:both"></div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>