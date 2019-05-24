 	<section id='content-wrapper'>
		<div id='register-wrapper'>
			<div class='title'>
				Profile
			</div>
			<div class='content'>
						<div class="col-5">
							<div class="form-group">
								<div class="label">
									<label>Username</label>
								</div>
								<div class="input">
									<input type='text' name='username' placeholder='your username...' value='<?php echo $users[0]['username'] ?>' readonly>
								</div>
							</div>

							<div class="form-group">
								<div class="label">
									<label>Full Name</label>
								</div>
								<div class="input">
									<input type='text' name='fullname' placeholder='your full name...' value='<?php echo Input::get('fullname') == '' ? $users[0]['nama'] : Input::get('fullname') ?>' readonly>
								</div>
							</div>
						</div>
						<div class="col-5">
							<div class="form-group">
								<div class="label">
									<label>Email</label>
								</div>
								<div class="input">
									<input type='text' name='email' placeholder='your email...' value='<?php echo Input::get('email') == '' ? $users[0]['email'] : Input::get('email') ?>' readonly>
								</div>
							</div>

							<div class="form-group">
								<div class="label">
									<label>Phone</label>
								</div>
								<div class="input">
									<input type='text' name='nohp' placeholder='your number phone...' value='<?php echo Input::get('nohp') == '' ? $users[0]['no_hp'] : Input::get('nohp') ?>' readonly>
								</div>
							</div>

							<div class="form-group">
								<div class="label">
									<label>Address</label>
								</div>
								<div class="input">
									<textarea placeholder='your address...' name='address' readonly><?php echo Input::get('address') == '' ? $users[0]['alamat'] : Input::get('address') ?></textarea>
								</div>
							</div>
						</div>
						<div style='clear: both'></div>
			</div>
			<br>
			<i style='font-size: 15px'>*) Barang yang akan diorder akan dikirim sesuai profil akun yang meliputi nama, alamat, no hp, email (Tercantum diatas). Mohon sesuaikan data profil dengan sebenarnya untuk menghindari kesalahan pengiriman. Terima Kasih</i>
			<br>
			<br>
			<form action="" method="post">
			<button class='btn btn-white-blue f-right' style='width: 150px; border-radius: 0; font-size: 14px; padding: 10px' onclick='return confirm("Are you sure ?")'>Order</button>
			</form>
			<div style='clear: both'></div>
		</div>

	</section>
	<div style='clear:both'></div>

</section>