<table class="table">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Qty</th>
										<th>Jenis</th>
										<th>Income</th>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach($data as $d) {
									echo "<tr>
										<td>$d[tgl_transaksi2]</td>
										<td>$d[qty]</td>
										<td>$d[jenis]</td>
										<td>Rp. " . number_format($d['income'], 0, '', '.') . "</td>
									</tr>";
								} ?>
								</tbody>
							</table>
						<br>
	<div id='paging-wrapper'>
		<div class='nav disabled'><a href='1'>&laquo;</a></div>

	<?php
		for($i = 1; $i <= ceil($ttl['ttl'] / $limit); $i++) {
			echo "<div class='nav'><a href='$i'>$i</a></div>";
		}
	?>
		<div class='nav'><a href='1'>&raquo;</a></div>
		
		<div class='f-right'>
				<b><?php echo $ttl['ttl'] ?></b> Records from Graymotion.com
		</div>
		<div style="clear:both"></div>
	</div> 