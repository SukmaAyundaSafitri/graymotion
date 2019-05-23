<div class="page-wrapper"> 
	<div class="row">
		<div class="col-10">
			<h3>Add Account</h3>
		</div>
	</div>
	
	<div id='desc'>
		<?php
			if(isset($_SESSION['message'])) {
				echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div>";
				unset($_SESSION['message']);
			}
		?>
		<form action="" method="post">
			<table class="form-table">
				<tr>
					<td>Username</td>
					<td><input type='text' class="form-control" name="username" placeholder='Username' value='<?php echo Input::get('username') ?>' required></td>
					<td>Password</td>
					<td><input type='password' class="form-control" name="password" placeholder='Password' required></td>
				</tr>
				<tr>
					<td>Fullname</td>
					<td><input type='text' class="form-control" name="fullname" placeholder='Fullname' value='<?php echo Input::get('fullname') ?>' required></td>
					<td>Email</td>
					<td><input type='email' class="form-control" name="email" placeholder='Email' value='<?php echo Input::get('email') ?>' required></td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<select class="form-control" name="status" required>
							<option value="">- Select -</option>
							<option value="1">Active</option>
							<option value="0">Non Active</option>
						</select>
					</td>
					<td>Level</td>
					<td>
						<select class="form-control" name="level" required>
							<option value="">- Select -</option>
							<option value="1">Admin</option>
							<option value="2">User</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>No Hp</td>
					<td><input type='text' class="form-control" name="nohp" placeholder='No HP' value='<?php echo Input::get('nohp') ?>' required></td>
					<td>Address</td>
					<td><textarea class="form-control" name="address" placeholder='Alamat' required><?php echo Input::get('address') ?></textarea></td>
				</tr>
			</table>
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