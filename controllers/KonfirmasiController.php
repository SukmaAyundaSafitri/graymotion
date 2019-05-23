<?php

include 'models/Konfirmasi.php';
include 'controllers/SiteController.php';

class KonfirmasiController extends SiteController { 
	private $konfirmasi;

	public function __construct() {
		$this->konfirmasi = new Konfirmasi;
	}

	public function Index() {
		$content['konfirmasi'] = $this->konfirmasi->Select("id, kode_unik, bank, CASE status WHEN 0 THEN 'Pending' WHEN 1 THEN 'Accepted' WHEN 2 THEN 'Not Accepted' END status, DATE_FORMAT(tgl_konfirmasi, '%d/%c/%Y %H:%i') tgl_konfirmasi2")
		->limit(0, 5)
		->order('tgl_konfirmasi', 'DESC')
		->get();
		$content['ttl'] = $this->konfirmasi->Select("COUNT(*) ttl")
		->get()[0];

		$content['limit'] = 5;
		$content['title'] = 'List Confirmation';
		$content['view'] = 'confirmation/index';

		Response::render('back/back', $content);
	}

	public function Filter() {
		$kw = isset($_POST['kw']) ? $_POST['kw'] : '';
		$st = isset($_POST['st']) ? $_POST['st'] : '';
		$li = isset($_POST['li']) ? $_POST['li'] : 5;
		$pg = isset($_POST['pg']) ? $_POST['pg'] : 1;

		$content['konfirmasi'] = $this->konfirmasi->Select("id, kode_unik, bank, CASE status WHEN 0 THEN 'Pending' WHEN 1 THEN 'Accepted' WHEN 2 THEN 'Not Accepted' END status, DATE_FORMAT(tgl_konfirmasi, '%d/%c/%Y %H:%i') tgl_konfirmasi2")
		->limit($li * $pg - $li, $li)
		->where("(kode_unik LIKE '%$kw%' OR bank LIKE '%$kw%') AND status LIKE '%$st%'")
		->order('tgl_konfirmasi', 'DESC')
		->get();
		$content['ttl'] = $this->konfirmasi->Select("COUNT(*) ttl")
		->where("(kode_unik LIKE '%$kw%' OR bank LIKE '%$kw%') AND status LIKE '%$st%'")
		->get()[0];

		$content['limit'] = $li;

		Response::renderPart2('back', 'confirmation/_table', $content);
	}

	public function Destroy($id) {
		$this->konfirmasi->Delete("WHERE id = $id");
		return App::FillAndRedirect('info', 'Successfully delete confirmation', 'admin/confirmation/');
	}

	public function Status($id) {
		if($_POST['tipe'] == ' Accept') {
			$this->konfirmasi->Update(['status' => 1], 'WHERE id = ' . $id);
		}
		else if($_POST['tipe'] == ' Not Accept') {
			$this->konfirmasi->Update(['status' => 2], 'WHERE id = ' . $id);
		}
		else if($_POST['tipe'] == 'Cancel Accept') {
			$this->konfirmasi->Update(['status' => 2], 'WHERE id = ' . $id);
		}

		$_SESSION['message'] = ['alert-info', 'Successfully change status'];
	}
}