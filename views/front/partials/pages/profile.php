	<section id='content-wrapper'>
		<div id='register-wrapper'>
			<div class='title'>
				View Profile
			</div>
			<div class='content'> 
					<?php
						if(isset($_SESSION['message']))
						echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
						unset($_SESSION['message']);
					?>
					<form action="" method='post'>
						<div class="col-5">
							<div class="form-group">
								<div class="label">
									<label>Username</label>
								</div>
								<div class="input">
									<input type='text' name='username' placeholder='your username...' value='<?php echo $users[0]['username'] ?>' required readonly>
								</div>
							</div>

							<div class="form-group">
								<div class="label">
									<label>Full Name</label>
								</div>
								<div class="input">
									<input type='text' name='fullname' placeholder='your full name...' value='<?php echo Input::get('fullname') == '' ? $users[0]['nama'] : Input::get('fullname') ?>' required>
								</div>
							</div>
						</div>
						<div class="col-5">
							<div class="form-group">
								<div class="label">
									<label>Email</label>
								</div>
								<div class="input">
									<input type='text' name='email' placeholder='your email...' value='<?php echo Input::get('email') == '' ? $users[0]['email'] : Input::get('email') ?>' required>
								</div>
							</div>

							<div class="form-group">
								<div class="label">
									<label>Phone</label>
								</div>
								<div class="input">
									<input type='text' name='nohp' placeholder='your number phone...' value='<?php echo Input::get('nohp') == '' ? $users[0]['no_hp'] : Input::get('nohp') ?>' required>
								</div>
							</div>

							<div class="form-group">
								<div class="label">
									<label>Address</label>
								</div>
								<div class="input">
									<textarea placeholder='your address...' name='address' required><?php echo Input::get('address') == '' ? $users[0]['alamat'] : Input::get('address') ?></textarea>
								</div>
							</div>
						</div>
						
						<div class='f-right'>
							<input type='reset' class='btn btn-blue-white' value='Bersihkan'><input type='submit' class='btn btn-blue-white' value='Change'>
						</div>
						<div style='clear: both'></div>
					</form>
			</div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>