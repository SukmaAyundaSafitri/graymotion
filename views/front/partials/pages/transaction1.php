 	<section id='content-wrapper'>
		<div id='cart-wrapper'>
			<div class='title'>
				List Cart
			</div>
			<div class='content'>
				<div class="table">
					<table>
						<tr>
							<th>Name</th>
							<th>Size</th>
							<th>Color</th>
							<th>Price</th>
							<th>Weight</th>
							<th>Qty</th>
							<th>Total</th>
						</tr>

					<?php
						$total = 0;
						$berat = 0;
						$qty = 0;
						foreach($_SESSION['cart'] as $cart) {
							echo '<tr>
								<td>' . $cart[1] . '</td>
								<td>' . $cart[3] . '</td>
								<td>' . $cart[2] . '</td>';

							foreach($barangs as $barang) {
								if($barang['id'] == $cart[0]) {
									$qty += $cart[4];
									$berat += $barang['berat'] * $cart[4];
									echo '<td>Rp. ' . number_format($barang['harga'], 0, '', '.') . '</td>
									<td>' . $barang['berat'] * $cart[4] . ' kg</td>
									<td>' . $cart[4] . '</td>
									<td>Rp. ' . number_format($cart[4] * $barang['harga'], 0, '', '.') . '</td>';
									$total += $cart[4] * $barang['harga'];
									break;
								}
							}

						echo '</tr>';
						}
					?>
						<tr>
							<td></td><td></td><td></td><td></td><td><?php echo ceil($berat) ?> kg</td><td><?php echo $qty; ?></td><td>Rp. <?php echo number_format($total, 0, '', '.') ?></td>
						</tr>

					</table>
				</div>
			</div>
			<br>
			<div class='title'>
				Destination
			</div>
			<div class='content'>
				<div class="table">
					<table>
						<tr>
							<th>Propinsi</th>
							<th>Kabupaten/Kota</th>
							<th>Kecamatan</th>
							<th>Price/kg</th>
						</tr>
						<tr>
							<td><select id='propinsi'>
								<option value="0">- Select -</option>
								<?php foreach($propinsi as $p)
									echo "<option value='$p[id]'>$p[nama]</option>";
								?>
							</select></td>
							<td><select id='kabupaten'>
							</select></td>
							<td><select id='kecamatan'>
							</select></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			<br>
			<div class='title'>
				Cost
			</div>
			<div class='content'>
				<div class="table">
					<table id="cost" data-berat='<?php echo $berat ?>'>
						<tr>
							<th>Total Weight</th>
							<th>Each Kg</th>
							<th>Total</th>
						</tr>
						<tr>
							<td><?php echo ceil($berat); ?> kg</td>
							<td></td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			<br>
			<div class='title'>
				Final Calculation
			</div>
			<div class='content'>
				<div class="table">
					<table id="final">
						<tr>
							<th>Type</th>
							<th>Total</th>
						</tr>
						<tr>
							<td>Item</td>
							<td>Rp. <?php echo number_format($total, 0, '', '.'); ?></td>
						</tr>
						<tr>
							<td>Cost</td>
							<td>Rp. ?</td>
						</tr>
						<tr>
							<td></td><td><b>Rp. <?php echo number_format($total, 0, '', '.'); ?> + ?</b></td>
						</tr>
					</table>
				</div>
			</div><br><br>
			<a href='<?php echo SITE_URL ?>transaction/2'><button class='btn btn-white-blue f-right' style='width: 150px'>Next Step (2)</button></a>
			<button class='btn btn-white-blue f-right btn-print' onclick='window.print()' style='width: 150px; margin-right: 10px'>Print</button>
			<div style="clear:both"></div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>

<style>
	@media print {
		#content-wrapper table {
			width: 100%;
			overflow: none;
		}
		footer, button {
			display: none;
		}
	}
</style>