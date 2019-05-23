<div class="page-wrapper"> 
	<div class="row">
		<div class="col-10">
			<h3>Edit Article</h3>
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
						<input type="text" placeholder='Title' class="form-control" name="title" value='<?php echo Input::get('title') == '' ? $artikel['judul'] : str_replace('+', ' ', Input::get('title')) ?>'>
					</div>
					<div class="form-group">
						<label for="kategori">Body</label>
						<textarea id='teks' spellcheck='false' class="form-control" placeholder='Body' name='body'><?php echo empty($_SESSION['body']) ? $artikel['isi'] : $_SESSION['body']; unset($_SESSION['body']) ?></textarea>
					</div>
				</div>

				<div class="frm-right">
					<div class="form-group">
						<label for="kategori">Category</label>
						<select class="form-control" name='category'>
							<option value=''>- Select -</option>
					<?php
						foreach($kategori as $k) 
							echo "<option value='$k[id]'>$k[nama]</option>";
					?>
						</select>
					</div>
					<div class="form-group">
						<label for="kategori">Image (can be null)</label>
						<input type='file' name='image' class="form-control">
					</div>
					<div class="form-group">
						<label for="kategori">Status</label>
						<select class="form-control" name='status'>
							<option value="">- Select -</option>
							<option value="1">Active</option>
							<option value="0">Non Active</option>
						</select>
					</div>
					<div class="form-group">
						<label for="kategori">Permalink</label>
						<input type='text' class="form-control" name='permalink' value='<?php echo $artikel['permalink'] ?>' placeholder='Permalink' readonly>
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
	$('select[name="status"]').val("<?php echo Input::get('status') == '' ? $artikel['status'] : Input::get('status') ?>");
	$('select[name="category"]').val("<?php echo Input::get('category') == '' ? $artikel['id_kategori'] : Input::get('category') ?>");
})
</script>