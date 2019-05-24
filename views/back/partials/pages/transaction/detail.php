<div class="page-wrapper">
	<div class="row">
		<div class="col-10"> 
			<h3>Detail Transaction</h3>
		</div>
	</div>
	
	<div id='desc'>
		<?php
	if(isset($_SESSION['message'])) {
		echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div><br>";
		unset($_SESSION['message']);
	}
?>
<div id="data">
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
		</table>
		<br>
		<div class='title'>
			Confirmation Detail
		</div>
		<div class="confirmation">
	<?php
	if(count($konfirmasi) > 0) {
		foreach($konfirmasi as $k) {
	?>
			<img src='<?php echo SITE_URL ?>assets/img/confirm/<?php echo $k['foto_bukti'] ?>'>
			<div class="det">
				<b>Bank</b>: <?php echo $k['bank'] ?><br>
				<b>Status</b>: <?php echo $k['status'] == 1 ? 'Accepted' : $k['status'] == 2 ? 'Not Accepted' : 'Pending' ?><br>
				<b>Date</b>: <?php echo $k['tgl_konfirmasi'] ?><br>
				<b>Info</b>: <?php echo $k['ket'] ?>
			</div>

	<?php
		}
	}
		else {
			echo "<h3 style='margin-top: 15px; font-weight: normal; text-align: center'>Confirmation not exists for code <b>$invoice</b></h3>";
		}
	?>
		</div>

		<br><br>
		<div style='text-align: right'>
			<button class='btn btn-green' style='width: 150px; margin-right: 10px'>Export Excel</button>
		</div>
	</div>
	</div>
</div>