<table class="table">
	<tr>
		<th>Code</th>
		<th>Type</th>
		<th>Qty</th>
		<th>Status</th>
		<th>Date</th>
	</tr>
	<?php
		$adm = SITE_URL . 'admin/';

		foreach($transaksi as $a) {
			echo "
				<tr id='$a[id]' data-type='transaction'>
				<td>
					$a[kode_unik]
					<span>
						<button class='btn-delete'>Delete</button></a> | <button class='btn-status'> ";

			echo ($a['status'] == 'Complete') ? 'Cancel Confirm' : 'Confirm';

			echo "</button> | <a href='$adm" . "transaction/$a[kode_unik]/detail'><button class='btn-detail'>Detail</button></a>
				</span>
				</td>
				<td>$a[jenis]</td>
				<td>$a[qty]</td>
				<td>$a[status]</td>
				<td>$a[tgl_transaksi2]</td>
				</tr>";
		}
	?>
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