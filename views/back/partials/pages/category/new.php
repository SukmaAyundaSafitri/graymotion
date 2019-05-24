<div class="title">
	Add New Category
</div> 
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
			<td><input type='text' class="form-control" name="name" placeholder='Name' value='<?php echo Input::get('name') ?>' required></td>
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
	<div style="text-align: right">
		<input type='reset' class="btn btn-white-blue" value="Bersihkan">
		<input class="btn btn-white-blue" type="submit" value="Submit">
	</div>
</form>
<script>
$(function() {
	$('select[name="name"]').val("<?php echo Input::get('name') ?>");
})
</script>