<div class='page-wrapper'>
	<h3>
		Edit Category 
	</h3>

	<div id='desc'>
		<?php
			if(isset($_SESSION['message'])) {
				echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
				unset($_SESSION['message']);
			}
		?>
		<form action="" method="post">
			<table class="form-table" style="width: 60%; margin: 0 auto">
				<tr>
					<td style='width: 10%'>Name</td>
					<td><input type='text' class="form-control" name="name" placeholder='Name' value='<?php echo Input::get('name') == '' ? $kategori['nama'] : Input::get('name') ?>' required></td>
				</tr>
				<tr>
					<td>Type</td>
					<td><select name="type" class="form-control">
						<option value="">- Select -</option>
						<option value="artikel">Article</option>
						<option value="produk">Product</option>
					</select></td>
				</tr>
			</table>
			<div style="text-align: right; margin-right: 20%">
				<input type='reset' class="btn btn-green" value="Bersihkan">
				<input class="btn btn-green" type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>
<script>
$(function() {
	$('select[name="type"]').val("<?php echo Input::get('type') == '' ? $kategori['tipe'] : Input::get('type') ?>");
})
</script>