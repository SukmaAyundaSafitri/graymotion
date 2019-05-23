<form class="search-box" style="margin-top: -60px"> 
	<input type="text" placeholder="Search..." class="form-control search-input">
	<button class="btn-ku btn-white btn-close-search" type="button"><i class="fa fa-times"></i></button>
</form>

<div id="navbar-wrapper" class="navbar navbar-fixed">
	<div class="navbar-inner">
		<div class="logo">
			<a href="<?php echo BASEURL ?>" class="logo-text">Graymotion</a>
		</div>
		<div class="menu">
			<ul class="nav navbar-left">
				<li><a href="#" onclick='return false'><i class="fa fa-bars"></i></a></li>
				<li><a href="#" class="toggle-fullscreen" onclick='return false'><i class="fa fa-expand"></i></a></li>
			</ul>

			<ul class="nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" onclick='return false'>
						<span class="text">AdminBS <i class="fa fa-angle-down"></i></span>
						<img src="<?php echo BASEURL ?>assets/img/site/user.png" width='40px' height='40px' class="avatar img-circle">
					</a>
					<ul class="dropdown-menu dropdown-sm dropdown-right">
						<li><a href="<?php echo BASEURL ?>admin/password/" class='btn-password'><i class="fa fa-key fa-fw"></i>&nbsp; Ubah password</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo BASEURL . 'user/logout' ?>"><i class="fa fa-sign-out fa-fw"></i>&nbsp; Log out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>