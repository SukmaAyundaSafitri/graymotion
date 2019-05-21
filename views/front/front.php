<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<link href="<?php echo SITE_URL ?>assets/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo SITE_URL ?>assets/lib/magnify/css/magnify.css" rel="stylesheet">
	<link href="<?php echo SITE_URL ?>assets/css/use.css" rel="stylesheet">
	<link href="<?php echo SITE_URL ?>assets/css/style.css" rel="stylesheet">
	<?php if($page == 'home') { ?>
	<style>
		#menu-wrapper {
			position: fixed;
		}
	</style>
	<?php } ?>
	<link href="<?php echo SITE_URL ?>assets/css/responsive.css" rel="stylesheet">
	<link href='<?php echo SITE_URL ?>assets/img/site/favicon.ico' rel='icon'>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php
		if(!isset($filez)) {
			include 'partials/files/nav.php';

			if($page == 'home')
			include 'partials/files/header.php';
		
			include 'partials/files/sidebar.php';
			include 'partials/pages/' . $page . '.php';
			include 'partials/files/footer.php';
		}
		else {
			include 'partials/pages/' . $page . '.php';
		}
		
	?>
</body>
</html>