	<section id='content-wrapper'>
		<div id='register-wrapper'>
			<div class='title'>
				Login Account
			</div>
			<div class='content'> 
				<?php
					if(isset($_SESSION['message']))
					echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
					unset($_SESSION['message']);
				?>

				<div class="row">
					<form action="" method='post' class="col-8 col-offset-1">
						<div class="form-group">
							<div class="label">
								<label>Username</label>
							</div>
							<div class="input">
								<input type="text" name="username" placeholder="your username...">
							</div>
						</div>

						<div class="form-group">
							<div class="label">
								<label>Password</label>
							</div>
							<div class="input">
								<input type="password" name="password" placeholder="your new password...">
							</div>
						</div>
						<div style='clear: both'></div>

						<div class='f-right'>
							<input type='reset' class='btn btn-blue-white' value='Bersihkan'><input type='submit' class='btn btn-blue-white' value='Login'>
						</div>
						<div style='clear: both'></div>
					</form>
				</div>
			</div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>