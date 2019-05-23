<?php

include 'controllers/SiteController.php';

class ArtikelController extends SiteController {
	public function getTtlArtikel() { 
		$data = $this->artikel->Select('count(*) ttl')->get()[0];
		return $data['ttl'];
	}

	public function Index() {
		$content['artikel'] = $this->artikel->Select('Artikel.id, judul, k.nama as kategori, CASE status WHEN 1 THEN "Active" WHEN 0 THEN "Non Active" END status, DATE_FORMAT(tgl_terbit, "%d/%c/%Y %H:%i") tgl_terbit2, permalink')
		->join([' JOIN kategori k' => 'Artikel.id_kategori = k.id'])
		->order('tgl_terbit', 'DESC')
		->limit(0, 5)
		->get();
		$content['ttl'] = $this->artikel->Select('COUNT(*) ttl')->get()[0];
		$content['kategori'] = $this->kategori->Select('id, nama')
		->order('nama', 'ASC')
		->where('tipe = "artikel"')
		->get();
		$content['limit'] = 5;

		$content['title'] = 'List Article';
		$content['view'] = 'article/index';
		Response::render('back/back', $content);
	}

	public function Add() {
		$content['kategori'] = $this->kategori->Select('id, nama')
		->order('nama', 'ASC')
		->where('tipe = "artikel"')
		->get();

		$content['title'] = 'Add Article';
		$content['view'] = 'article/new';
		Response::render('back/back', $content);
	}

	public function Store() {
		try {
			$st = false;
			$ex = '';
			$img = $_FILES['image'];

			if($img['error'] == 0) {
				$ext = explode('.', $img['name']);
				$ext = $ext[count($ext) - 1];
				$ex = $ext;

				$dest = 'assets/img/article/' . $_POST['permalink'] . '.' . $ext;
				if(move_uploaded_file($img['tmp_name'], $dest) && chmod($dest, 0755))
					$st = true;
			}

			if(!$st)
				throw new Exception("Uuupppsss.. something wrong");
			else {
				$this->artikel->Insert(['judul' => $_POST['title'], 'img' => $_POST['permalink'] . '.' . $ext, 'isi' => $_POST['body'], 'status' => $_POST['status'], 'tgl_terbit' => date('Y/m/d H:i:s'), 'permalink' => $_POST['permalink'], 'id_akun' => $_SESSION['userid'], 'id_kategori' => $_POST['category']]);
			}
			return App::FillAndRedirect('info', 'Successfully created new article', 'admin/article/');
				
		} catch (Exception $e) {
			if($e->getCode() == 23000)
				$msg = 'Permalink not exists, type another permalink';
			else
				$msg = 'Upss.. something wrong..';
			
			$_SESSION['body'] = $_POST['body'];
			return App::FillAndRedirect('danger', $msg, "admin/article/new&title=$_POST[title]&category=$_POST[category]&status=$_POST[status]&permalink=$_POST[permalink]");
		}
	}

	public function Edit($id) {
		$content['artikel'] = $this->artikel->Select('judul, isi, id_kategori, k.nama as kategori, status, permalink')
		->join([' JOIN kategori k' => 'k.id = Artikel.id_kategori'])
		->where('Artikel.id = ' . $id)
		->get();

		if(count($content['artikel']) < 1)
			Response::render404();

		$content['artikel'] = $content['artikel'][0];

		$content['kategori'] = $this->kategori->Select('id, nama')
		->order('nama', 'ASC')
		->where('tipe = "artikel"')
		->get();

		$content['title'] = 'Edit Article';
		$content['view'] = 'article/edit';

		Response::render('back/back', $content);
	}

	public function Update($id) {
		try {
			$data = ['judul' => $_POST['title'], 'isi' => $_POST['body'], 'id_kategori' => $_POST['category'], 'status' => $_POST['status']];

			$st = false;
			$img = $_FILES['image'];

			if($img['error'] == 0) {
				$ext = explode('.', $img['name']);
				$ext = $ext[count($ext) - 1];

				$dest = 'assets/img/article/' . $_POST['permalink'] . '.' . $ext;
				if(move_uploaded_file($img['tmp_name'], $dest) && chmod($dest, 0755)) {
					$data = array_merge($data, ['img' => $_POST['permalink'] . '.' . $ext]);
					$st = true;
				}
			}
			else
				$st = true;

			if(!$st)
				throw new Exception("Uuupppsss.. something wrong");
			else {
				$this->artikel->Update($data, "WHERE id = $id");
			}

			return App::FillAndRedirect('info', 'Successfully update article', 'admin/article/');
		}
		catch(Exception $e) {
			$msg = 'Upss.. something wrong..';

			$_SESSION['body'] = $_POST['body'];
			return App::FillAndRedirect('danger', $e->getMessage(), "admin/article/$id/edit&title=" . str_replace(' ', '+', $_POST['title']) . "&category=$_POST[category]&status=$_POST[status]");
		}
	}

	public function Destroy($id) {
		$this->artikel->Delete("WHERE id = $id");
		return App::FillAndRedirect('info', 'Successfully delete article', 'admin/article/');
	}

	public function Filter() {
		$pg = $_POST['pg'];
		$li = $_POST['li'];
		$st = $_POST['st'];
		$cg = $_POST['cg'];
		$kw = $_POST['kw'];

		$content['artikel'] = $this->artikel->Select('Artikel.id, judul, k.nama as kategori, CASE status WHEN 1 THEN "Active" WHEN 0 THEN "Non Active" END status, DATE_FORMAT(tgl_terbit, "%d/%c/%Y %H:%i") tgl_terbit2, permalink')
		->join([' JOIN kategori k' => 'Artikel.id_kategori = k.id'])
		->where("k.nama LIKE '%$cg%' AND status LIKE '%$st%' AND (judul LIKE '%$kw%' OR permalink LIKE '%$kw%')")
		->limit($pg * $li - $li, $li)
		->order('tgl_terbit', 'DESC')
		->get();
		$content['ttl'] = $this->artikel->Select('COUNT(*) ttl')
		->join([' JOIN kategori k' => 'Artikel.id_kategori = k.id'])
		->where("k.nama LIKE '%$cg%' AND status LIKE '%$st%' AND (judul LIKE '%$kw%' OR permalink LIKE '%$kw%')")
		->get()[0];
		$content['limit'] = $li;

		Response::renderPart2('back', 'article/_table', $content);
	}

	public function Status($id) {
		if($_POST['tipe'] == ' Deactived') {
			$this->artikel->Update(['status' => 0], 'WHERE id = ' . $id);
		}
		else if($_POST['tipe'] == ' Activated') {
			$this->artikel->Update(['status' => 1], 'WHERE id = ' . $id);
		}
		$_SESSION['message'] = ['alert-info', 'Successfully change status'];
	}
}