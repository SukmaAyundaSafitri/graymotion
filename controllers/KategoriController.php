<?php
include 'controllers/SiteController.php';

class KategoriController extends SiteController { 

	public function Index() {
		$content['kategori'] = $this->kategori->Select('id, nama, tipe')
		->limit(0, 5)
		->order('nama', 'asc')
		->get();
		$content['ttl'] = $this->kategori->Select('COUNT(*) ttl')
		->get()[0];
		$content['limit'] = 5;

		$content['title'] = 'List Category';
		$content['view'] = 'category/index';

		Response::render('back/back', $content);
	}

	public function get($id) {
		$data = $this->kategori->Select('nama, tipe')->where('id = ' . $id)->get()[0];

		echo json_encode($data);
	}

	public function Add() {
		$content['view'] = 'category/new';
		$content['title'] = 'Add Category';

		Response::render('back/back', $content);
	}

	public function Store() {
		try {
			$this->kategori->Insert(['nama' => $_POST['name'], 'tipe' => $_POST['type']]);

			return App::FillAndRedirect('info', 'Successfully created new category', 'admin/category/');
		} catch (Exception $e) {
			return App::FillAndRedirect('danger', 'Uppss.. something wrong', 'admin/category/');
		}
	}

	public function Edit($id) {
		$content['kategori'] = $this->kategori->Select('nama, tipe')
		->where("id = $id")
		->get();

		if(count($content['kategori']) < 1)
			Response::render404();

		$content['kategori'] = $content['kategori'][0];

		$content['view'] = 'category/edit';
		$content['title'] = 'Edit Category';

		Response::render('back/back', $content);
	}

	public function Update($id) {
		try {
			$this->kategori->Update(['nama' => $_POST['name'], 'tipe' => $_POST['type']], "WHERE id = $id");

			return App::FillAndRedirect('info', 'Successfully update new category', 'admin/category/');
		} catch (Exception $e) {
			return App::FillAndRedirect('danger', 'Uppss.. something wrong', "admin/category/edit&name=$_POST[name]&type=$_POST[type]");
		}
	}

	public function Destroy($id) {
		$this->kategori->Delete("WHERE id = $id");
		return App::FillAndRedirect('info', 'Successfully delete category', 'admin/category/');
	}

	public function Filter() {
		$kw = $_POST['kw'];
		$pg = $_POST['pg'];
		$li = $_POST['li'];
		$ty = $_POST['ty'];

		$content['kategori'] = $this->kategori->Select('id, nama, tipe')
		->limit($li * $pg - $li, $li)
		->order('nama', 'asc')
		->where("nama LIKE '%$kw%' AND tipe LIKE '%$ty%'")
		->get();
		$content['ttl'] = $this->kategori->Select('COUNT(*) ttl')
		->where("nama LIKE '%$kw%' AND tipe LIKE '%$ty%'")
		->get()[0];
		$content['limit'] = $li;

		Response::renderPart2('back', 'category/_table', $content);
	}
}