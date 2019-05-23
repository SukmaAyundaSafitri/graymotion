<table class="table">
	<tr>
		<th>Username</th>
		<th>Email</th>
		<th>Level</th>
		<th>Status</th>
	</tr>
	<?php
		$adm = SITE_URL . 'admin/';

		foreach($akun as $a) {
			echo "
				<tr id='$a[id]'>
				<td>
					$a[username]
					<span>
						<a href='" . $adm . "account/$a[id]/edit'><button>Edit</button></a> | <button class='btn-delete'>Delete</button></a> | <button class='btn-status'> ";

			echo ($a['status'] == 'Active') ? 'Deactived' : 'Activated';

			echo "</button></span>
				</td>
				<td>$a[email]</td>
				<td>$a[level]</td>
				<td>$a[status]</td>
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