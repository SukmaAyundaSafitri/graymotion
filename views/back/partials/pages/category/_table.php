<table class="table">
	<tr>
		<th>Category</th>
		<th>Type</th>
	</tr>
	<?php
		$adm = SITE_URL . 'admin/';
			foreach($kategori as $a) {
				echo "
					<tr id='$a[id]' data-type='category'>
					<td>
						$a[nama]
						<span>
							<button class='btn-edit' data-id='$a[id]'>Edit</button> | <button class='btn-delete'>Delete</button></a>
					</span>
					</td>
					<td>";

				echo ($a['tipe'] == 'produk') ? 'Product' : 'Article';

				echo "</td>
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