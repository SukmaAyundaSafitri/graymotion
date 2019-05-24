<table class="table">
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Type</th>
		<th style='display: none'>Text</th>
		<th>Status</th>
		<th>Date</th>
	</tr>
	<?php
		$adm = SITE_URL . 'admin/';

		foreach($komentar as $a) {
			echo "
				<tr id='$a[id]' data-type='comment'>
				<td>
					$a[nama]
					<span>
						<button class='btn-delete'>Delete</button></a> | <button class='btn-status'> ";

			echo ($a['status'] == 1) ? 'Deactived' : 'Activated';

			echo "</button> | <button class='btn-text'>Text</button> | <a href='" . SITE_URL . "$a[tipe]/$a[permalink]/#$a[id]' target='_blank'><button>View</button></a>
				</span>
				</td>
				<td>$a[email]</td>
				<td>";

				echo ($a['tipe'] == 'product') ? 'Product' : 'Article';

				echo "</td><td class='txtComment' style='display: none'>$a[isi]</td><td>";

				echo $a['status'] == 1 ? 'Active' : 'Non Active';

				echo "</td><td>$a[tgl_komentar2]</td>
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