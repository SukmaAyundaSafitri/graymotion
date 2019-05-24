<div class="page-wrapper">
	<div class="row">
		<div class="col-10">
			<h3>Add Stock</h3> 
		</div>
	</div>
	
	<div id='desc'>
		<?php
			if(isset($_SESSION['message'])) {
				echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
				unset($_SESSION['message']);
			}
		?>
		<form action="" method="post" id='stockAct'>
			<input type='hidden' name='id' value="<?php echo $data[0]['id_barang'] ?>">
				<?php
					$i = 1;
					foreach($data as $b) {
							echo '<div class="item">';
							echo "<fieldset><legend>Color $i</legend><div class='flex'><div class='form-group flex1'><label for='title'>Color</label><input type='text' placeholder='Color' class='form-control' name='color[]' value='$b[warna]' readonly></div></div><div class='flex'><div class='form-group flex1'><label for='title'>S</label><input type='number' placeholder='S Stock' class='form-control' name='S[]' required></div><div class='form-group flex1'><label for='title'>M</label><input type='number' placeholder='M Stock' class='form-control' name='M[]'  required></div><div class='form-group flex1'><label for='title'>L</label><input type='number' placeholder='L Stock' class='form-control' name='L[]' required></div><div class='form-group flex1'><label for='title'>XL</label><input type='number' placeholder='XL Stock' class='form-control' name='XL[]' required></div></div></fieldset>";
							echo "</div>";
						if($i % 2 == 0)
							echo '<div style="clear:both"></div>';
						$i++;
					}
				?>
			<div style="clear:both"></div>

			<div style="text-align: right">
				<input type='reset' class="btn btn-green" value="Bersihkan">
				<input class="btn btn-green" type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>
<script>
$(function() {
	$('select[name="status"]').val("<?php echo Input::get('status') ?>");
	$('select[name="level"]').val("<?php echo Input::get('level') ?>");
})
</script>