<table class="table">
	<tr>
		<th>Name</th>
		<th>Username</th>
		<th>Date</th>
	</tr>
	<?php
		$adm = SITE_URL . 'admin/';
			foreach($wishlist as $a) {
				echo "
					<tr id='$a[id]' data-type='wishlist'>
					<td>
						$a[nama]
						<span>
							<button class='btn-delete'>Delete</button></a>
					</span>
					</td>
					<td>$a[username]</td>
					<td>$a[tanggal]</td>
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
		
		<div style="float: right">
				<b class="totalz"><?php echo $ttl['ttl'] ?></b> Records from Graymotion.com
		</div>
		<div style="clear:both"></div>
	</div> 