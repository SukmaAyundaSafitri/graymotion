<table class="table">
	<tr>
		<th>Code</th>
		<th>Bank</th>
		<th>Status</th>
		<th>Date</th>
	</tr>
	<?php
		$adm = SITE_URL . 'admin/';

		foreach($konfirmasi as $a) {
			echo "
				<tr id='$a[id]' data-type='confirmation'>
				<td>
					$a[kode_unik]
					<span>
						<button class='btn-delete'>Delete</button></a> ";

			if($a['status'] == 'Not Accepted' || $a['status'] == 'Pending')
				echo "| <button class='btn-status'> Accept</button>";
			else if($a['status'] == 'Accepted')
				echo "| <button class='btn-status'>Cancel Accept</button>";

			if($a['status'] == 'Pending')
				echo "| <button class='btn-status'> Not Accept</button>";

			echo " | <a href='$adm" . "transaction/$a[kode_unik]/detail#$a[id]'><button class='btn-detail'>Detail</button></a>
				</span>
				</td>
				<td>$a[bank]</td>
				<td>$a[status]</td>
				<td>$a[tgl_konfirmasi2]</td>
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