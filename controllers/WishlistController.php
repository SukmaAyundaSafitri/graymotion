<?php

include 'controllers/SiteController.php';
include 'models/Wishlist.php';

class WishlistController extends SiteController { 
	public function Add($id) {
		if(!$_SESSION['userlogin'])
			return App::FillAndRedirect('danger', 'You must login for access that page', 'user/login/');

		$wishlist = new Wishlist;
		$cek = $wishlist->Select('count(*) ttl')->where('id_barang = ' . $id . ' and id_akun = ' . $_SESSION['userid'])->get();
		if(count($cek) > 0 && $cek[0]['ttl']) {
			return Response::redirect('');
		}

		$wishlist->Insert(['id_akun' => $_SESSION['userid'], 'id_barang' => $id, 'tanggal' => date('Y-m-d H:i:s')]);
		return App::FillAndRedirect('info', 'Successfully add wishlist', 'user/wishlist');
	}

	public function Destroy2($id) {
		if(!$_SESSION['userlogin'])
			return App::FillAndRedirect('danger', 'You must login for access that page', 'user/wishlist');

		$wishlist = new Wishlist;
		$wishlist->Delete("WHERE id = $id");
		return App::FillAndRedirect('info', 'Successfully delete wishlist', 'user/wishlist');	
	}

	public function Index() {
		$wishlist = new Wishlist;

		$content['wishlist'] = $this->barang->Select('nama, w.id, username, DATE_FORMAT(w.tanggal, "%d-%m-%Y") tanggal, s.foto as img, permalink')
		->join([' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id', ' JOIN wishlist w' => 'w.id_barang = Barang.id', ' JOIN akun a' => 'a.id = w.id_akun'])
		->limit(0, 5)
		->get();

		$content['ttl'] = $wishlist->Select('COUNT(*) ttl')
		->get()[0];

		$content['limit'] = 5;

		$content['title'] = 'List Wishlist';
		$content['view'] = 'wishlist/index';

		Response::render('back/back', $content);
	}

	public function Filter() {
		$wishlist = new Wishlist;
		$kw = $_POST['kw'];
		$pg = $_POST['pg'];
		$li = $_POST['li'];

		$content['wishlist'] = $this->barang->Select('nama, w.id, username, DATE_FORMAT(w.tanggal, "%d-%m-%Y") tanggal, s.foto as img, permalink')
		->join([' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id', ' JOIN wishlist w' => 'w.id_barang = Barang.id', ' JOIN akun a' => 'a.id = w.id_akun'])
		->limit($li * $pg - $li, $li)
		->where("nama LIKE '%$kw%' OR username LIKE '%$kw%'")
		->get();

		$content['ttl'] = $this->barang->Select('COUNT(*) ttl')
		->join([' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id', ' JOIN wishlist w' => 'w.id_barang = Barang.id', ' JOIN akun a' => 'a.id = w.id_akun'])
		->where("nama LIKE '%$kw%' OR username LIKE '%$kw%'")
		->get()[0];
		$content['limit'] = $li;

		Response::renderPart2('back', 'wishlist/_table', $content);
	}

	public function Destroy($id) {
		$wishlist = new Wishlist;
		$wishlist->Delete("WHERE id = $id");

		return App::FillAndRedirect('info', 'Successfully delete wishlist', 'admin/wishlist/');
	}
}