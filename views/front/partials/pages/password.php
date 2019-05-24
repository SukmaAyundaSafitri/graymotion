	<section id='content-wrapper'>
		<div id='register-wrapper'>
			<div class='title'>
				Change Password
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
								<label>Old Password</label>
							</div>
							<div class="input">
								<input type="password" name="oldpassword" placeholder="your old password..." class="form-control">
							</div>
						</div>

						<div class="form-group">
							<div class="label">
								<label>New Password</label>
							</div>
							<div class="input">
								<input type="password" name="newpassword" placeholder="your new password..." class="form-control">
							</div>
						</div>

						<div class="form-group">
							<div class="label">
								<label>Re New Password</label>
							</div>
							<div class="input">
								<input type="password" name="newpassword2" placeholder="your new password..." class="form-control">
							</div>
						</div>

						<div style="text-align: right">
							<input type='reset' class='btn btn-blue-white' value='Bersihkan'><input type='submit' class='btn btn-blue-white' value='Change'>
						</div>
						<div style='clear: both'></div>
					</form>
				</div>
			</div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>