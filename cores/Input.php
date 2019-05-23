<?php

class Input {
	public function get($name) { 
		return isset($_GET[$name]) ? $_GET[$name] : "";
	}
}