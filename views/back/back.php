<?php
	define('BASEURL', SITE_URL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?></title>
	<link rel="stylesheet" href="<?php echo BASEURL ?>assets/lib/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASEURL ?>assets/css/useBackRev.css">
	<link rel="stylesheet" href="<?php echo BASEURL ?>assets/css/styleBackRev.css">
	<link href='<?php echo SITE_URL ?>assets/img/site/favicon.ico' rel='icon'>
	<script src="<?php echo BASEURL ?>assets/js/jquery-1.11.3.min.js"></script>
</head>
<body>
	<div class="overlay"></div>
	<?php
		include 'partials/files/header.php';
		include 'partials/files/main.php';
		//include 'content/account/password.php';
	?>

	<script src="<?php echo BASEURL ?>assets/lib/tinymce/js/tinymce/tinymce.min.js"></script>
	<script src="<?php echo BASEURL ?>assets/lib/highcharts.js"></script>
	<!--<script src="<?php echo BASEURL ?>assets/lib/toastr.min.js"></script>-->

	<?php if($view == 'index') { ?>
		<script src="<?php echo BASEURL ?>assets/js/data.js"></script>
	<?php } ?>

	<?php if($view == 'report/index') { ?>
		<script src="<?php echo BASEURL ?>assets/js/reportOverview.js"></script>
	<?php } ?>

	<?php if($view == 'report/product') { ?>
		<script src="<?php echo BASEURL ?>assets/js/reportProduct.js"></script>
	<?php } ?>

	<script src="<?php echo BASEURL ?>assets/js/scriptBackRev.js"></script>
</body>
</html>
</html>