<div class="page-wrapper"> 
	<div class="row">
		<div class="col-10">
			<h3>Change Password</h3>
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
			<table class="form-table" style='width: 70%; margin: 0 auto'>
				<tr>
					<td style="width: 20%">Old Password</td>
					<td><input type='password' class="form-control" name="oldpassword" placeholder='Old Password' required></td>
				</tr>
				<tr>
					<td>New Password</td>
					<td><input type='password' class="form-control" name="newpassword1" placeholder='New Password' required></td>
				</tr>
				<tr>
					<td>Re New Password</td>
					<td><input type='password' class="form-control" name="newpassword2" placeholder='Re New Password' required></td>
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
	$('select[name="status"]').val("<?php echo Input::get('status') == '' ? '' : Input::get('status') ?>");
	$('select[name="category"]').val("<?php echo Input::get('category') == '' ? '' : Input::get('category') ?>");
})
</script>