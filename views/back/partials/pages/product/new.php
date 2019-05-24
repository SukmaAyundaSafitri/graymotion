<div class="page-wrapper">
	<div class="row">
		<div class="col-10">
			<h3>Add Product</h3>
		</div> 
	</div>
	
	<div id='desc'>
		<?php
			if(isset($_SESSION['message'])) {
				echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
				unset($_SESSION['message']);
			}
		?>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="flex">
				<div class="frm-left">
					<div class="form-group">
						<label for="title">Name</label>
						<input type="text" placeholder='Name' class="form-control" name="name" value='<?php echo Input::get('name') ?>' required>
					</div>
					<div class="form-group">
						<label for="kategori">Description</label>
						<textarea style='height: 450px' class="form-control" placeholder='Description' name="description" id='teks'><?php echo isset($_SESSION['description']) ? $_SESSION['description'] : ''; unset($_SESSION['description']) ?></textarea>
					</div>
					<button class="btn btn-green btn-block" type="button" id='btn-add-color' data-start='1'>Add Color & Stock</button>
				</div>

				<div class="frm-right">
					<div class="form-group">
						<label for="kategori">Category</label>
						<select class="form-control" name="category" required>
							<option value=''>- Select -</option>
					<?php
						foreach($kategori as $k)
							echo "<option value='$k[id]'>$k[nama]</option>";
					?>
						</select>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-control" name="status" required>
							<option value="">- Select -</option>
							<option value="1">Active</option>
							<option value="0">Non Active</option>
						</select>
					</div>
					<div class="form-group">
						<label for="permalink">Permalink</label>
						<input type='text' class="form-control" value='<?php echo Input::get('permalink') ?>' placeholder='Permalink' name='permalink' required>
					</div>
					<div class="form-group">
						<label for="harga">Harga</label>
						<input type='number' class="form-control" value='<?php echo Input::get('price') ?>' placeholder='Harga' name='price' required>
					</div>
					<div class="form-group">
						<label for="harga">Berat (Kg)</label>
						<input type='text' class="form-control" value='<?php echo Input::get('berat') ?>' placeholder='Berat' name='berat' required>
					</div>	
				</div>
			</div>



			<div style="text-align: right">
				<input type='reset' class="btn btn-green" value="Bersihkan">
				<input class="btn btn-green" type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>
<script>
$(function() {
	$('select[name="status"]').val("<?php echo Input::get('status') == '' ? '' : Input::get('status') ?>");
	$('select[name="category"]').val("<?php echo Input::get('category') == '' ? '' : Input::get('category') ?>");
})
</script>