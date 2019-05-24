	<section id='content-wrapper'>
		<div id="cart-wrapper">
			<div class='title'>
				Detail Transaction
			</div>
			<div class="content">
				<div class='alert alert-info'>
					This is list all item for unique code: <b><?php echo $invoice ?></b>
				</div>
				<br>
				<div class="data">
					<table> 

						<tr>
							<th>Image</th>
							<th>Item</th>
							<th>Category</th>
							<th>Size</th>
							<th>Qty</th>
							<th>Price</th>
							<th>Total</th>
						</tr>
					<?php
					$ttl = 0;
					foreach($transaksi as $t) {
						echo "<tr>
							<td><img src='" . SITE_URL . "assets/img/product/$t[img]'></td>
							<td>$t[nama]</td>
							<td><a href='" . SITE_URL . "category/product/" . strtolower($t['kategori']) . "'>$t[kategori]</a></td>
							<td>" . strtoupper($t['ukuran']) . "</td>
							<td>$t[qty]</td>
							<td>Rp. ". number_format($t['harga_satuan'], 0, '', '.') . "</td>
							<td>Rp. ". number_format($t['harga_satuan'] * $t['qty'], 0, '', '.') . "</td>";
						echo "</tr>";
						$ttl += $t['harga_satuan'] * $t['qty'];
					}
					?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><b>Rp. <?php echo number_format($ttl, 0, '', '.') ?></b></td>
						</tr>
					</table>
				</div>
			</div>
			<br>
			<button class='btn btn-white-blue f-right' style='width: 150px; margin-right: 10px'>Export PDF</button>
			<button class='btn btn-white-blue f-right' style='width: 150px; margin-right: 10px'>Export Excel</button>
			<button class='btn btn-white-blue f-right' style='width: 150px; margin-right: 10px'>Print</button>
			<div style="clear:both"></div>
		</div>

	</section>

	<div style='clear:both'></div>
</section>