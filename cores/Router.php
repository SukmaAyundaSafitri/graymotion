<?php

	class Router { 
		public static function get($url, $to) {
			$uri = isset($_REQUEST['uri']) ? '/' . $_REQUEST['uri'] : '/';

			if($uri != '/')
				$uri = preg_replace('(/+$)', '', $uri);

			if($url == $uri) {
				$to = explode('@', $to);

				include 'controllers/' . $to[0] . '.php';
				$class = new $to[0];
				$class->$to[1]();

				exit();
			}

			else if(strpos($url, ':') !== false || strpos($url, '?') !== false) {
				$_url = explode('/', $url);
				$_uri = explode('/', $uri);

				if((count($_uri) == count($_url) || strpos($url, '?') !== false) && count($_url) >= count($_uri)) {
					$args = [];

					for($i = 0; $i < count($_uri); $i++) {
						if(strpos($_url[$i], ':') === 0)
							$args[] = $_uri[$i];
						else if(strpos($_url[$i], '?') === 0) {
							if($_uri[$i] != '') {
								$args[] = $_uri[$i];
							}
						}
						else if($_url[$i] !== $_uri[$i])
							return;
					}

					$to = explode('@', $to);

					include 'controllers/' . $to[0] . '.php';
					$class = new $to[0];
					call_user_func_array([$class, $to[1]], $args);
					exit();
				}
			}
		}

		public static function post($url, $to) {
			if($_SERVER['REQUEST_METHOD'] == 'POST')
				self::get($url, $to);
		}

		public static function delete($url, $to) {
			if($_SERVER['REQUEST_METHOD'] == 'DELETE')
				self::get($url, $to);
		}

		public static function put($url, $to) {
			if($_SERVER['REQUEST_METHOD'] == 'PUT')
				self::get($url, $to);
		}

		private static function helpResource($path, $ctrl, $r) {
			if($r == 'Index')
				Router::get($path, $ctrl . '@Index');
			if($r == 'Store')
				Router::post($path . '/new', $ctrl . '@Store');
			if($r == 'Add')
				Router::get($path . '/new', $ctrl . '@Add');
			if($r == 'Get')
				Router::get($path . '/:id/get', $ctrl . '@get');
			if($r == 'Update')
				Router::post($path . '/:id/edit', $ctrl . '@Update');
			if($r == 'Edit')
				Router::get($path . '/:id/edit', $ctrl . '@Edit');
			if($r == 'Destroy')
				Router::delete($path . '/:id', $ctrl . '@Destroy');
			if($r == 'Filter')
				Router::post($path . '/filter', $ctrl . '@Filter');
			if($r == 'Status')
				Router::post($path . '/:id/status', $ctrl . '@Status');
		}

		public static function resource($path, $ctrl, $type = []) {
			if(count($type) > 0) {
				$t = array_keys($type);

				if($t[0] == 'only') {
					foreach($type['only'] as $r) {
						Router::helpResource($path, $ctrl, $r);
					}
				}
				else {
					$s = ['Index', 'Store', 'Add', 'Update', 'Edit', 'Destroy', 'Filter', 'Status', 'Get'];
					$k = array_diff($s, $type['except']);

					foreach($k as $r) {
						Router::helpResource($path, $ctrl, $r);
					}
				}
			}
			else {
				Router::get($path, $ctrl . '@Index');
				Router::post($path . '/new', $ctrl . '@Store');
				Router::get($path . '/new', $ctrl . '@Add');
				Router::post($path . '/:id/edit', $ctrl . '@Update');
				Router::get($path . '/:id/edit', $ctrl . '@Edit');

				Router::delete($path . '/:id', $ctrl . '@Destroy');
				Router::post($path . '/filter', $ctrl . '@Filter');
				Router::post($path . '/:id/status', $ctrl . '@Status');
			}
		}
	}