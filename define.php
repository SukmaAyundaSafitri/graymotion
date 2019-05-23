<?php

define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . basename(__DIR__) . '/');
define('BASEPATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

//if chart not exists
if(empty($_SESSION['cart'])) {
	$_SESSION['cart'] = [];
	$_SESSION['chartId'] = [];
}

//If userlogin not exists
if(empty($_SESSION['userlogin']))
	$_SESSION['userlogin'] = false; 