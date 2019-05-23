<?php

class App {
	public function Param() { 
		print_r($_SERVER);
	}

	public function RandomString($length) {
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$val = '';

		for($i = 0; $i < $length; $i++) {
			$val .= $chars[rand(0, strlen($chars) - 1)];
		}

		return $val;
	}

	public function FillAndRedirect($type, $msg, $to) {
		$_SESSION['message'] = ['alert-' . $type, $msg];
		return Response::redirect($to);
	}

	public function FillAndRedirectFull($type, $msg, $to) {
		$_SESSION['message'] = ['alert-' . $type, $msg];
		return Response::redirectFull($to);
	}
}