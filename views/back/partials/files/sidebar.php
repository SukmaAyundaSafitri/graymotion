<?php $url = BASEURL . 'admin' ?> 
<section id="sidebar-wrapper">
	<div class="sidebar-header">
		<div class="sidebar-profile">
			<img src="<?php echo BASEURL ?>assets/img/site/user.png" class="img-circle">
			<span>
				<?php echo $_SESSION['username'] ?><br>
				<small>Graymotion BackEnd</small>
			</span>
		</div>
	</div>
	<ul class="sidebar-menu">
		<li class="active"><a href="<?php echo $url ?>"><span><i class="menu-icon fa fa-home fa-fw"></i></span>Dashboard</a></li>
		<li>
			<a href="#"><span><i class="menu-icon fa fa-tags fa-fw"></i></span>Category<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/category/' ?>">List Category</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span><i class="menu-icon fa fa-bullhorn fa-fw"></i></span>Article<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/article/' ?>">List Article</a></li>
				<li><a href="<?php echo $url . '/article/new/' ?>">Add Article</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span><i class="menu-icon fa fa-users fa-fw"></i></span>Account<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/account/' ?>">List Account</a></li>
				<li><a href="<?php echo $url . '/account/new' ?>">Add Account</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span><i class="menu-icon fa fa-shopping-bag fa-fw"></i></span>Product<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/product/' ?>">List Product</a></li>
				<li><a href="<?php echo $url . '/product/new' ?>">Add Product</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span><i class="menu-icon fa fa-comments fa-fw"></i></span>Comment<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/comment/' ?>">List Comment</a></li>
			</ul>
		</li>
		<!--<li>
			<a href="#"><span><i class="menu-icon fa fa-database fa-fw"></i></span>Stock<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/stock/new' ?>">Add Stock</a></li>
			</ul>
		</li>-->
		<li>
			<a href="#"><span><i class="menu-icon fa fa-shopping-cart fa-fw"></i></span>Transaction<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/transaction/' ?>">List Transaction</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span><i class="menu-icon fa fa-credit-card-alt fa-fw"></i></span>Confirmation<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/confirmation/' ?>">List Confirmation</a></li>
			</ul>
		</li>
		<li>
			<a href="#"><span><i class="menu-icon fa fa-gift fa-fw"></i></span>Wish List<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/wishlist/' ?>">List Wish</a></li>
			</ul>
		</li>
		<!--<li>
			<a href="#"><span><i class="menu-icon fa fa-reply-all fa-fw"></i></span>Testimonials<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/answer/' ?>">List Comment</a></li>
			</ul>
		</li>-->
		<li>
			<a href="#"><span><i class="menu-icon fa fa-line-chart fa-fw"></i></span>Report<i class="arrow fa fa-angle-left"></i></a>
			<ul class="submenu">
				<li><a href="<?php echo $url . '/report/' ?>">Overview</a></li>
				<li><a href="<?php echo $url . '/report/product/' ?>">Product</a></li>
			</ul>
		</li>
	</ul>
</section>