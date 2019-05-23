<div class="page-wrapper"> 
	<div class="row">
		<div class="col-10">
			<h3>Add Article</h3>
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
						<label for="title">Title</label>
						<input type="text" placeholder='Title' class="form-control" name="title" value='<?php echo Input::get('title') ?>' required>
					</div>
					<div class="form-group">
						<label for="kategori">Body</label>
						<textarea id='teks' class="form-control" placeholder='Body' name="body"><?php echo isset($_SESSION['body']) ? $_SESSION['body'] : ''; unset($_SESSION['body']) ?></textarea>
					</div>
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
						<label for="image">Image</label>
						<input type='file' class="form-control" name="image" required>
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