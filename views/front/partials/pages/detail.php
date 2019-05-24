	<section id='content-wrapper'>
		<div id='cart-wrapper'>
			<div class='title'>
			List Cart
		</div>
		<div class='alert alert-info'>
			This is list all item for unique code: <b><?php echo $invoice ?></b>
		</div>
		<br>
		<table class="table">
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
				$qty = 0;
				$berat = 0;
				foreach($transaksi as $chart) {
					echo '<tr>
						<td>' . $chart['nama'] . '</td>
						<td>' . $chart['ukuran'] . '</td>
						<td>' . $chart['warna'] . '</td>';

					$qty += $chart['qty'];
					$berat += $chart['berat'];
					echo '<td>Rp. ' . number_format($chart['harga_satuan'], 0, '', '.') . '</td>
								<td>' . $chart['berat'] . ' kg</td>
								<td>' . $chart['qty'] . '</td>
								<td>Rp. ' . number_format($chart['qty'] * $chart['harga_satuan'], 0, '', '.') . '</td>';
					$total += $chart['harga_satuan'] * $chart['qty'];

					echo '</tr>';
				}
			?>
			<tr>
				<td></td><td></td><td></td><td></td><td><?php echo ceil($berat); ?> kg</td><td><?php echo $qty; ?></td><td>Rp. <?php echo number_format($total, 0, '', '.') ?></td>
			</tr>

		</table>

		<br>
		<div class='title'>
			Destination
		</div>
				
		<table class="table">
			<tr>
				<th>Propinsi</th>
				<th>Kabupaten/Kota</th>
				<th>Kecamatan</th>
				<th>Price/Kg</th>
			</tr>
			<tr>
				<td><?php echo $transaksi[0]['propinsi'] ?></td>
				<td><?php echo $transaksi[0]['kabupaten'] ?></td>
				<td><?php echo $transaksi[0]['kecamatan'] ?></td>
				<td>Rp. <?php echo number_format($transaksi[0]['ongkir'], 0, '', '.'); ?></td>
			</tr>
		</table>
				
		<br>
		<div class='title'>
			Cost
		</div>

		<table class="table">
			<tr>
				<th>Total Weight</th>
				<th>Each Kg</th>
				<th>Total</th>
			</tr>
			<tr>
				<?php $cost = $transaksi[0]['ongkir'] * ceil($berat) ?>
				<td><?php echo ceil($berat); ?></td>
				<td>Rp. <?php echo number_format($transaksi[0]['ongkir'], 0, '', '.'); ?></td>
				<td>Rp. <?php echo number_format($cost, 0, '', '.'); ?></td>
			</tr>
		</table>

		<br>
		<div class='title'>
			Final Calculation
		</div>
				
		<table class="table">
			<tr>
				<th style="width: 50%">Type</th>
				<th>Total</th>
			</tr>
			<tr>
				<td>Item</td>
				<td>Rp. <?php echo number_format($total, 0, '', '.'); ?></td>
			</tr>
			<tr>
				<td>Cost</td>
				<td>Rp. <?php echo number_format($cost, 0, '', '.'); ?></td>
			</tr>
			<tr>
				<td></td><td><b>Rp. <?php echo number_format($total + $cost, 0, '', '.'); ?></b></td>
			</tr>
		</table><br><br>
			<button class='btn btn-white-blue f-right' style='width: 150px; margin-right: 10px'>Export Excel</button>
			<div style="clear:both"></div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>