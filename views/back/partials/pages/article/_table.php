<table class="table">
	<tr>
		<th>Title</th>
		<th>Category</th>
		<th>Status</th>
		<th>Date</th>
	</tr>
	<?php
		$adm = SITE_URL . 'admin/';

		foreach($artikel as $a) {
			echo "
				<tr id='$a[id]' data-type='article'>
				<td>
					$a[judul]
					<span>
						<a href='" . $adm . "article/$a[id]/edit'><button>Edit</button></a> | <button class='btn-delete'>Delete</button></a> | <button class='btn-status'> ";

			echo ($a['status'] == 'Active') ? 'Deactived' : 'Activated';

			echo "</button> | <a href='" . SITE_URL . "article/$a[permalink]/' target='_blank'><button>View</button></a>";

			echo "</span>
				</td>
				<td>$a[kategori]</td>
				<td>$a[status]</td>
				<td>$a[tgl_terbit2]</td>
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