<?php
include 'controllers/SiteController.php';

class KomentarController extends SiteController {
	public function Insert() {
		$komentar = new Komentar;
		try {
			$komentar->Insert(['nama' => $_POST['nama'], 'email' => $_POST['email'], 'tipe' => $_POST['tipe'], 'isi' => $_POST['body'], 'status' => 1, 'tgl_komentar' => date('Y-m-d H:i:s'), 'id_page' => $_POST['id']]);
			App::FillAndRedirect('info', 'Successfully add your comment, thanks for your partipation', str_replace(SITE_URL, '', $_SERVER['HTTP_REFERER']));
		}
		catch(Exception $e) {
			App::FillAndRedirect('danger', 'Failed to add your comment, try again', str_replace(SITE_URL, '', $_SERVER['HTTP_REFERER']));
		}
	}

	public function Index() { 
		$orm = new ORM;
		$content['komentar'] = $orm->CustomSelect("select id, nama, tipe, email, status, DATE_FORMAT(tgl_komentar, '%d/%c/%Y %H:%i') tgl_komentar2, isi, permalink from (select k.id, k.nama, k.email, tipe, k.isi, k.status, tgl_komentar, permalink from Komentar k join Barang b on k.id_page = b.id where tipe = 'product' union select k.id, k.nama, k.email, tipe, k.isi, k.status, tgl_komentar, permalink from Komentar k join Artikel b on k.id_page = b.id where tipe = 'article') a order by tgl_komentar desc limit 0, 5");

		$content['ttl'] = $this->komentar->Select('count(*) ttl')
		->get()[0];
		$content['limit'] = 5;
		$content['title'] = 'List Comment';
		$content['view'] = 'comment/index';

		Response::render('back/back', $content);
	}

	public function Destroy($id) {
		$this->komentar->Delete("WHERE id = $id");
		return App::FillAndRedirect('info', 'Successfully delete comment', 'admin/comment/');
	}

	public function Status($id) {
		if($_POST['tipe'] == ' Deactived') {
			$this->komentar->Update(['status' => 0], 'WHERE id = ' . $id);
		}
		else if($_POST['tipe'] == ' Activated') {
			$this->komentar->Update(['status' => 1], 'WHERE id = ' . $id);
		}
		$_SESSION['message'] = ['alert-info', 'Successfully change status'];
	}

	public function Filter() {
		$kw = $_POST['kw'];
		$pg = $_POST['pg'];
		$li = $_POST['li'];
		$ty = $_POST['ty'];
		$st = $_POST['st'];

		$orm = new ORM;
		$content['komentar'] = $orm->CustomSelect("select id, nama, tipe, email, status, DATE_FORMAT(tgl_komentar, '%d/%c/%Y %H:%i') tgl_komentar2, isi, permalink from (select k.id, k.nama, k.email, tipe, k.isi, k.status, tgl_komentar, permalink from Komentar k join Barang b on k.id_page = b.id where tipe = 'product' union select k.id, k.nama, k.email, tipe, k.isi, k.status, tgl_komentar, permalink from Komentar k join Artikel b on k.id_page = b.id where tipe = 'article') a WHERE (nama LIKE '%$kw%' or email LIKE '%$kw%' or isi LIKE '%$kw%') AND tipe LIKE '%$ty%' AND status LIKE '%$st%' order by tgl_komentar desc limit " . ($li * $pg - $li) . ", $li");
		$content['ttl'] = $this->komentar->Select('COUNT(*) ttl')
		->where("(nama LIKE '%$kw%' or email LIKE '%$kw%' or isi LIKE '%$kw%') AND tipe LIKE '%$ty%' AND status LIKE '%$st%'")
		->get()[0];
		$content['limit'] = $li;

		Response::renderPart2('back', 'comment/_table', $content);
	}
}