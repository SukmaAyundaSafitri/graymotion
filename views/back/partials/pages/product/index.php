<div id="popup" style="display: none">
	<div class="title">
		Add Stock
		<button type='button' class="btn btn-white-blue btn-close">X</button>
	</div>
	<form action=""> 
		<input type='hidden' name='productId'>
		<div class="form-group">
			<label for="produk">Product</label>
			<input name='productStock' type="text" class="form-control" value="" readonly>
		</div>
		<div class="form-group">
			<label for="produk">Size</label>
			<select class="form-control" name='productSize' required>
				<option value="">- Select -</option>
				<option value="s">S</option>
				<option value="m">M</option>
				<option value="l">L</option>
				<option value="xl">XL</option>
			</select>
		</div>
		<div class="form-group">
			<label for="produk">Quantity</label>
			<input type="number" class="form-control" value="0" name='productQty' required>
		</div>
		<div style="text-align: right">
			<input class="btn btn-white-blue" type="submit" value="Add">
		</div>
	</form>
</div>



	<div class="page-wrapper">
		<div class="row">
			<div class="col-8">
				<h3>Product</h3>
			</div>
			<div class="col-4">
				<form action="" class="search">
					<div class="input-group">
						<input type="text" class="form-control txtSearch" placeholder="Search...">
						<button type="button" class="input-group-btn btn-ku btn-green"><i class="fa fa-search"></i></button>
						<div style="clear:both"></div>
					</div>
				</form>
			</div>
		</div>
		<br>
		<div class="table-responsive">
			<div class='pull-right'>
				Show 
				<select name="" class="cmbLimit filter">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
				</select>
				&nbsp;& status 
				<select name="" class="cmbStatus filter">
					<option value="">No Problem</option>
					<option value="1">Active</option>
					<option value="0">Non Active</option>
				</select>
				&nbsp;& category 
				<select name="" class="cmbCategory filter">
					<option value="">No Problem</option>
				<?php
					foreach($kategori as $k)
						echo "<option value='$k[nama]'>$k[nama]</option>";
				?>
				</select>
				&nbsp;& stock
				<select name="" class="cmbStock filter">
					<option value="">No Problem</option>
					<option value="1">Available</option>
					<option value="0">Not Available</option>
				</select> &nbsp; &nbsp;<a href='<?php echo $url ?>/product/new'><button class="btn-ku btn-white" data-type='product'><i class="fa fa-plus ico"></i></button></a>
			</div>
			<div style="clear:both"></div>
			<br>
			<?php
				if(isset($_SESSION['message'])) {
					echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div><br>";
					unset($_SESSION['message']);
				}
			?>
			<div id="data">
				<?php
					include '_table.php';
				?>
			</div>
		</div>
	</div>