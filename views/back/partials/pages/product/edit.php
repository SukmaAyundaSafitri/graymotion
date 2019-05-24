<div class="page-wrapper">
	<div class="row">
		<div class="col-10">
			<h3>Edit Product</h3>
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
						<input type="text" placeholder='Name' class="form-control" name="name" value='<?php echo Input::get('name') == '' ? $barang[0]['nama'] : str_replace('+', ' ', Input::get('name')) ?>' required>
					</div>
					<div class="form-group">
						<label for="kategori">Description</label>
						<textarea id="teks" style='height: 450px' class="form-control" placeholder='Description' name="description" required><?php echo isset($_SESSION['description']) ? $_SESSION['description'] : $barang[0]['deskripsi']; unset($_SESSION['description']) ?></textarea>
					</div>

			<?php
				$i = 1;
				foreach($barang as $b) {
					echo "<input type='hidden' name='oldid_barang[]' value='$b[id]'><input type='hidden' name='oldwarna_barang[]' value='$b[warna]'><input type='hidden' name='oldid_barang[]' value='$b[id]'><fieldset><legend>Color $i</legend><div class='flex'><div class='form-group flex1'><label for='title'>Color</label><input type='text' placeholder='Color' class='form-control' name='oldcolor[]' value='$b[warna]' required></div><div class='form-group flex1'><label for='title'>Image (can be null)</label><input type='file' class='form-control' name='oldimage[]'></div></div><div class='flex'><div class='form-group flex1'><label for='title'>S</label><input type='number' value='$b[s]' readonly placeholder='S Stock' class='form-control' name='oldS[]' required></div><div class='form-group flex1'><label for='title'>M</label><input type='number' placeholder='M Stock' value='$b[m]' readonly class='form-control' name='oldM[]'  required></div><div class='form-group flex1'><label for='title'>L</label><input type='number' placeholder='L Stock' value='$b[l]' readonly class='form-control' name='oldL[]' required></div><div class='form-group flex1'><label for='title'>XL</label><input type='number' placeholder='XL Stock' value='$b[xl]' class='form-control' name='oldXL[]' required readonly></div></div></fieldset>";
					$i++;
				}
			?>

					<button class="btn btn-green btn-block" type="button" id='btn-add-color' data-start='<?php echo count($barang) + 1 ?>'>Add Color & Stock</button>
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
						<input type='text' class="form-control" value='<?php echo $barang[0]['permalink'] ?>' placeholder='Permalink' name='permalink' required readonly>
					</div>
					<div class="form-group">
						<label for="harga">Harga</label>
						<input type='number' class="form-control" value='<?php echo Input::get('price') == '' ? $barang[0]['harga'] : Input::get('price') ?>' placeholder='Harga' name='price' required>
					</div>
					<div class="form-group">
						<label for="harga">Berat</label>
						<input type='text' class="form-control" value='<?php echo Input::get('price') == '' ? $barang[0]['berat'] : Input::get('price') ?>' placeholder='Berat' name='berat' required>
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
	$('select[name="status"]').val("<?php echo Input::get('status') == '' ? $barang[0]['status'] : Input::get('status') ?>");
	$('select[name="category"]').val("<?php echo Input::get('category') == '' ? $barang[0]['id_kategori'] : Input::get('category') ?>");
})
</script>