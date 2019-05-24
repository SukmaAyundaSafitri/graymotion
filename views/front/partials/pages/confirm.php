	<section id='content-wrapper'>
		<div id='register-wrapper'>
			<div class='title'>
				Confirm Your Payment
			</div>
			<div class='content'> 
				<?php
					if(isset($_SESSION['message']))
					echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
					unset($_SESSION['message']);
				?>
				<div class="row">
					<form action="" method='post' class="col-8 col-offset-1" enctype="multipart/form-data">
						<div class="form-group">
							<div class="label">
								<label>Unique Code</label>
							</div>
							<div class="input">
							<input type="text" name="uniqueCode" placeholder="your transaction unique code..." value='<?php echo Input::get('code') ?>'>
							</div>
						</div>
							
						<div class="form-group">
							<div class="label">
								<label>Bank</label>
							</div>
							<div class="input">
								<?php $bank = Input::get('bank') ?>
								<select name='bank'>
									<option value="">- Select -</option>
									<option value="BRI" <?php echo $bank == 'BRI' ? 'selected': '' ?>>BRI</option>
									<option value="BCA" <?php echo $bank == 'BCA' ? 'selected': '' ?>>BCA</option>
									<option value="Mandiri" <?php echo $bank == 'Mandiri' ? 'selected': '' ?>>Mandiri</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="label">
								<label>Screenshot Payment</label>
							</div>
							<div class="input">
								<input type='file' name='screenshot'>
							</div>
						</div>

						<div class="form-group">
							<div class="label">
								<label>Description</label>
							</div>
							<div class="input">
								<textarea name='description' placeholder='your description...'><?php echo Input::get('desc') ?></textarea>
							</div>
						</div>
						<div class='f-right'>
							<input type='reset' class='btn btn-blue-white' value='Bersihkan'><input type='submit' class='btn btn-blue-white' value='Submit'>
						</div>
						<div style='clear: both'></div>
					</form>
				</div>
			</div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>