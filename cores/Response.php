<?php

class Response {
	public function render($file, $var = []) { 
		extract($var);
		include 'views/' . $file . '.php';
	}

	public function redirect($to) {
		echo "<script>window.location='". SITE_URL . "$to'</script>";
	}

	public function redirectFull($to) {
		echo "<script>window.location='$to'</script>";
	}

	public function renderPart($to, $file, $var = []) {
		extract($var);
		include 'views/' . $to . '/partials/files/' . $file . '.php';
	}

	public function renderPart2($to, $file, $var = []) {
		extract($var);
		include 'views/' . $to . '/partials/pages/' . $file . '.php';
	}

	public function render404() {
		$content['title'] = '404 Page Not Found';
		$content['page'] = '404';
		$content['filez'] = false;
		Response::render('front/front', $content);
		exit();
	}
}