<?php

include 'models/Detil_Akun.php';
include 'models/Wishlist.php';
include 'controllers/SiteController.php';

class AkunController extends SiteController {
	public function getTtlUser() {
		$data = $this->akun->Select('count(*) ttl')->get()[0];
		return $data['ttl'];
	}

	public function Insert() { 
		if(($_POST['password'] != $_POST['repassword']))
			return App::FillAndRedirect('danger', 'Password not match with password confirmation', "user/register&username=$_POST[username]&fullname=$_POST[fullname]&email=$_POST[email]&nohp=$_POST[nohp]&address=$_POST[address]");

		$orm = new ORM;
		$pdo = $orm->pdo;
		$detil_akun = new Detil_Akun;

		try {
			$pdo->beginTransaction();
			$a = $pdo->prepare($this->akun->qBuilder->QueryInsert());
			$a->execute(['username' => $_POST['username'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'level' => 2, 'status' => 1]);
			$last = $pdo->lastInsertId();

			$da = $pdo->prepare($detil_akun->qBuilder->QueryInsert());
			$da->execute(['nama' => $_POST['fullname'], 'no_hp' => $_POST['nohp'], 'email' => $_POST['email'], 'alamat' => $_POST['address'], 'id_akun' => $last]);

			$pdo->commit();

			return App::FillAndRedirect('info', 'Successfully created account, you can login now', 'user/login/');
		}
		catch(Exception $e) {
			if($e->getLine() == 19)
				$msg = 'Username not exists, type another username';
			else if($e->getLine() == 23)
				$msg = 'Email not exists, type another email';
			$pdo->rollback();

			return App::FillAndRedirect('danger', $msg, "user/register&username=$_POST[username]&fullname=$_POST[fullname]&email=$_POST[email]&nohp=$_POST[nohp]&address=$_POST[address]");
		}
		
	}

	public function Login() {
		$data = $this->akun->Select('id, username, password, level, status')
		->where("username = '$_POST[username]'")
		->get();

		if(count($data) > 0 && password_verify($_POST['password'], $data[0]['password'])) {

			if($data[0]['status'] == 1) {
				$_SESSION['userlogin'] = true;
				$_SESSION['userid'] = $data[0]['id'];
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['userlevel'] = $data[0]['level'];

				return App::FillAndRedirect('info', 'Successfully login, welcome to Graymotion.com', '');
			}
			else
				return App::FillAndRedirect('danger', 'Your account not actived', 'user/login/');
		}
		else
			return App::FillAndRedirect('danger', 'Login failed, please check your username and password', 'user/login/');
	}

	public function UpdateProfile() {
		$detil_akun = new Detil_Akun;

		try {
			$detil_akun->Update(['nama' => $_POST['fullname'], 'no_hp' => $_POST['nohp'], 'email' => $_POST['email'], 'alamat' => $_POST['address'], 'id_akun' => $_SESSION['userid']], 'WHERE id_akun = ' . $_SESSION['userid']);

			return App::FillAndRedirect('info', 'Successfully update data account', 'user/view/');
		}
		catch(Exception $e) {
			return App::FillAndRedirect('danger', 'Email not exists, type another email', "user/view&fullname=$_POST[fullname]&email=$_POST[email]&nohp=$_POST[nohp]&address=$_POST[address]");
		}
	}

	public function ChangePassword() {
		if($_POST['newpassword1'] != $_POST['newpassword2'])
			return App::FillAndRedirectFull('danger', 'Password not match with password confirmation', $_SERVER['HTTP_REFERER']);

		try {
			$data = $this->akun->Select('id, password')
			->where("username = '$_SESSION[username]'")
			->get();

			if(password_verify($_POST['oldpassword'], $data[0]['password'])) {
				$this->akun->Update(['password' => password_hash($_POST['newpassword1'], PASSWORD_DEFAULT)], "WHERE username = '$_SESSION[username]'");

				return App::FillAndRedirectFull('info', 'Successfully change your password', $_SERVER['HTTP_REFERER']);
			}
			else
				return App::FillAndRedirectFull('danger', 'Your old password is wrong, type valid password', $_SERVER['HTTP_REFERER']);
		}
		catch(Exception $e) {
			return App::FillAndRedirectFull('danger', 'Failed change password', $_SERVER['HTTP_REFERER']);
		}
	}

	public function Password() {
		$content['title'] = 'Change Password';
		$content['view'] = 'account/password';

		Response::render('back/back', $content);
	}

	public function UserView($view) {
		$content = $this->GetWidgetFront();
		if ($_SESSION['userlogin']) {
			if(strtolower($view) == 'logout') {
				$_SESSION['userlogin'] = false;
				unset($_SESSION['userid']);
				unset($_SESSION['username']);
				unset($_SESSION['userlevel']);

				$_SESSION['message'] = ['alert-info', 'Successfully logout'];
				Response::redirect('user/login/');
			}
			else if(strtolower($view) == 'view') {
				$content['users'] = $this->akun->Select('username, nama, no_hp, email, alamat')
					->join(array(' JOIN Detil_Akun' => 'id = id_akun'))
					->where('id = ' . $_SESSION['userid'])
					->get();

				$content['title'] = 'View Profile - Graymotion.com';
				$content['page'] = 'profile';
			}
			else if(strtolower($view) == 'password') {
				$content['title'] = 'Change Password - Graymotion.com';
				$content['page'] = 'password';
			}
			else if(strtolower($view) == 'history') {
				$content['title'] = 'History Transaction - Graymotion.com';
				$content['page'] = 'history';
				$content['transaksi'] = $this->akun->Select("t.id, kode_unik, count(*) as jenis, sum(qty) as qty, DATE_FORMAT(tgl_transaksi, '%d %b %Y | %k:%i') tgl_transaksi2, case t.status when 0 then 'Not Complete' when 1 then 'Complete' when 2 then 'Cancel' end status")
				->join([' JOIN transaksi t' => 't.id_akun = Akun.id', ' JOIN detil_transaksi dt' => 't.id = dt.id_transaksi'])
				->order('tgl_transaksi', 'DESC')
				->group('kode_unik')
				->where("Akun.id = " . $_SESSION['userid'])
				->limit(0, 5)
				->get();
			}
			else if(strtolower($view) == 'wishlist') {
				$content['title'] = 'My Wishlist - Graymotion.com';
				$content['page'] = 'wishlist';
				$wishlist = new Wishlist;

				$content['wishlist'] = $this->barang->Select('nama, w.id, DATE_FORMAT(w.tanggal, "%d-%m-%Y") tanggal, s.foto as img, permalink')
				->join([' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id', ' JOIN wishlist w' => 'w.id_barang = Barang.id'])
				->where('w.id_akun = ' . $_SESSION['userid'])
				->get();
			}
			else
				return Response::render404();
		}
		else {
			if(strtolower($view) == 'login') {
				$content['title'] = 'Login - Graymotion.com';
				$content['page'] = 'login';
			}
			else if(strtolower($view) == 'register') {
				$content['title'] = 'Register - Graymotion.com';
				$content['page'] = 'register';
			}
			else
				return Response::render404();
		}

		Response::render('front/front', $content);
	}

	public function Index() {
		$content['title'] = 'List Account';
		$content['akun'] = $this->akun->Select('Akun.id, username, email, CASE level WHEN 1 THEN "Admin" ELSE "User" END level, CASE status WHEN 1 THEN "Active" WHEN 0 THEN "Non Active" END status')
		->join([' JOIN detil_akun du' => 'du.id_akun = Akun.id'])
		->order('Akun.id', 'ASC')
		->limit(0, 5)
		->get();
		$content['ttl'] = $this->akun->Select('COUNT(*) ttl')
		->get()[0];
		$content['view'] = 'account/index';
		$content['limit'] = 5;

		Response::render('back/back', $content);
	}

	public function Add() {
		$content['title'] = 'Add Account';
		$content['view'] = 'account/new';
		Response::render('back/back', $content);
	}

	public function Store() {
		$orm = new ORM;
		$pdo = $orm->pdo;
		$detil_akun = new Detil_Akun;

		$a = $pdo->prepare($this->akun->qBuilder->QueryInsert());
		$da = $pdo->prepare($detil_akun->qBuilder->QueryInsert());

		try {
			$pdo->beginTransaction();
			
			$a->execute(['username' => $_POST['username'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'level' => $_POST['level'], 'status' => $_POST['status']]);
			$last = $pdo->lastInsertId();

			$da->execute(['nama' => $_POST['fullname'], 'no_hp' => $_POST['nohp'], 'email' => $_POST['email'], 'alamat' => $_POST['address'], 'id_akun' => $last]);

			$pdo->commit();

			return App::FillAndRedirect('info', 'Successfully created new account', 'admin/account/');
		}
		catch(Exception $e) {
			if($a->errorInfo()[1] == 1062)
				$msg = 'Username not exists, type another username';
			else if($da->errorInfo()[1] == 1062)
				$msg = 'Email not exists, type another email';
			else
				$msg = 'Upss.. something wrong..';
			$pdo->rollback();

			return App::FillAndRedirect('danger', $msg, "admin/account/new&username=$_POST[username]&fullname=$_POST[fullname]&email=$_POST[email]&nohp=$_POST[nohp]&address=$_POST[address]&level=$_POST[level]&status=$_POST[status]");
		}
	}

	public function Edit($id) {
		$content['title'] = 'Edit Account';
		$content['view'] = 'account/edit';
		$content['akun'] = $this->akun->Select('Akun.id, username, nama, status, no_hp, password, email, level, alamat')
		->join([' JOIN detil_akun da' => 'da.id_akun = Akun.id'])
		->where("Akun.id = '$id'")
		->get();

		if(count($content['akun']) < 1)
			Response::render404();

		$content['akun'] = $content['akun'][0];

		Response::render('back/back', $content);
	}

	public function Update($id) {
		$orm = new ORM;
		$pdo = $orm->pdo;
		$da = new Detil_Akun;

		$q = ['level' => $_POST['level'], 'status' => $_POST['status']];

		if(isset($_POST['password']) AND $_POST['password'] != '')
			$q = array_merge($q, ['password' => password_hash($_POST['password'], PASSWORD_DEFAULT)]);

		$q1 = $pdo->prepare($this->akun->qBuilder->QueryUpdate($q) . ' WHERE id = ' . $id);

		$q = ['nama' => $_POST['fullname'], 'no_hp' => $_POST['nohp'], 'email' => $_POST['email'], 'alamat' => $_POST['address']];
		$q2 = $pdo->prepare($da->qBuilder->QueryUpdate($q) . ' WHERE id_akun = ' . $id);

		try {
			$pdo->beginTransaction();

			$q1->execute();
			$q2->execute();

			$pdo->commit();

			return App::FillAndRedirect('info', 'Successfully update data account', 'admin/account/');
		}
		catch(Exception $e) {
			$pdo->rollback();

			if($q2->errorInfo()[1] == 1062)
				$msg = 'Email not exists, type another email';
			else
				$msg = 'Upss.. something wrong..';

			return App::FillAndRedirect('danger', $msg, "admin/account/$id/edit&username=$_POST[username]&fullname=$_POST[fullname]&email=$_POST[email]&nohp=$_POST[nohp]&address=$_POST[address]&level=$_POST[level]&status=$_POST[status]");
		}
	}

	public function Destroy($id) {
		$this->akun->Delete('WHERE id = ' . $id);
		return App::FillAndRedirect('info', 'Successfully delete account', 'admin/account/');
	}

	public function Filter() {
		$pg = $_POST['pg'];
		$li = $_POST['li'];
		$st = $_POST['st'];
		$lv = $_POST['lv'];
		$kw = $_POST['kw'];

		$content['akun'] = $this->akun->Select('Akun.id, username, email, CASE level WHEN 1 THEN "Admin" ELSE "User" END level, CASE status WHEN 1 THEN "Active" WHEN 0 THEN "Non Active" END status')
		->join([' JOIN detil_akun du' => 'du.id_akun = Akun.id'])
		->order('Akun.id', 'ASC')
		->where("status LIKE '%$st%' AND level LIKE '%$lv%' AND (username LIKE '%$kw%' OR email LIKE '%$kw%' OR no_hp LIKE '%$kw%' OR alamat LIKE '%$kw%')")
		->limit($pg * $li - $li, $li)
		->get();

		$content['ttl'] = $this->akun->Select('COUNT(*) as ttl')
		->join([' JOIN detil_akun du' => 'du.id_akun = Akun.id'])
		->order('Akun.id', 'ASC')
		->where("status LIKE '%$st%' AND level LIKE '%$lv%' AND (username LIKE '%$kw%' OR email LIKE '%$kw%' OR no_hp LIKE '%$kw%' OR alamat LIKE '%$kw%')")
		->get()[0];

		$content['limit'] = $li;

		Response::renderPart2('back', 'account/_table', $content);
	}

	public function Status($id) {
		if($_POST['tipe'] == ' Deactived') {
			$this->akun->Update(['status' => 0], 'WHERE id = ' . $id);
		}
		else if($_POST['tipe'] == ' Activated') {
			$this->akun->Update(['status' => 1], 'WHERE id = ' . $id);
		}
		$_SESSION['message'] = ['alert-info', 'Successfully change status'];
	}
}