<?php
include 'controllers/SiteController.php';
include 'models/Stok.php';

class ProductController extends SiteController {
	public function Index() {
		$content['barang'] = $this->barang->Select('Barang.id, s.foto as img, s.s, m, l, xl, Barang.nama, k.nama as kategori, CASE status WHEN 1 THEN "Active" WHEN 0 THEN "Non Active" END status, DATE_FORMAT(tgl_ditambah, "%d/%c/%Y %H:%i") tgl_ditambah2, permalink')
		->join([' JOIN kategori k' => 'k.id = Barang.id_kategori', ' JOIN (select id_barang as id_ku, (select sum(stok) from stok where ukuran = "S" AND id_barang = id_ku) s, (select sum(stok) from stok where ukuran = "M" AND id_barang = id_ku) m, (select sum(stok) from stok where ukuran = "L" AND id_barang = id_ku) l, (select sum(stok) from stok where ukuran = "XL" AND id_barang = id_ku) xl, foto from stok group by id_barang) s' => 's.id_ku = Barang.id'])
		->order('tgl_ditambah', 'DESC') 
		->limit(0, 5)
		->get();

		$content['kategori'] = $this->kategori->Select('id, nama')
		->order('nama', 'ASC')
		->where('tipe = "produk"')
		->get();

		$content['ttl'] = $this->barang->Select('COUNT(*) ttl')
		->get()[0];
		$content['limit'] = 5;

		$content['view'] = 'product/index';
		$content['title'] = 'List Product';

		Response::render('back/back', $content);
	}

	public function Add() {
		$content['kategori'] = $this->kategori->Select('id, nama')
		->order('nama', 'ASC')
		->where('tipe = "produk"')
		->get();
		$content['view'] = 'product/new';
		$content['title'] = 'Add Product';

		Response::render('back/back', $content);
	}

	public function Store() {
		try {
			$st = false;
			$ex = '';
			$size = ['S', 'M', 'L', 'XL'];
			$img = $_FILES['image'];


			$orm = new ORM;
			$pdo = $orm->pdo;
			$stok = new Stok;

			$pdo->beginTransaction();
			$a = $pdo->prepare($this->barang->qBuilder->QueryInsert());
			$a->execute(['nama' => $_POST['name'], 'deskripsi' => $_POST['description'], 'berat' => $_POST['berat'], 'harga' => $_POST['price'], 'status' => $_POST['status'], 'tgl_ditambah' => date('Y/m/d H:i:s'), 'permalink' => $_POST['permalink'], 'id_akun' => $_SESSION['userid'], 'id_kategori' => $_POST['category']]);
			$last = $pdo->lastInsertId();

			$da = $pdo->prepare($stok->qBuilder->QueryInsert());

			for($i = 0; $i < count($_POST['color']); $i++) {
				/* GAMBAR */
				$ext = explode('.', $img['name'][$i]);
				$ext = $ext[count($ext) - 1];
				$ex = $ext;
				$nm = $_POST['permalink'] . '-' . App::RandomString(5) . '.' . $ext;

				$dest = 'assets/img/product/' . $nm;
				move_uploaded_file($img['tmp_name'][$i], $dest);
				chmod($dest, 0755);
				/* END GAMBAR */

				for($j = 0; $j < 4; $j++) {
					$da->execute(['id_barang' => $last, 'warna' => $_POST['color'][$i], 'ukuran' => $size[$j], 'stok' => $_POST[$size[$j]][$i], 'foto' => $nm]);
				}
				
			}

			$pdo->commit();

			return App::FillAndRedirect('info', 'Successfully created new product', 'admin/product/');
				
		} catch (Exception $e) {
			if($e->getCode() == 23000)
				$msg = 'Permalink not exists, type another permalink';
			else
				$msg = 'Upss.. something wrong..';
			
			echo $e->getMessage();
			$_SESSION['description'] = $_POST['description'];
			return App::FillAndRedirect('danger', $msg, "admin/product/new&name=$_POST[name]&category=$_POST[category]&status=$_POST[status]&berat=$_POST[berat]&price=$_POST[price]&s=$_POST[s]&m=$_POST[m]&l=$_POST[l]&xl=$_POST[xl]&permalink=$_POST[permalink]");
		}
	}

	public function Edit($id) {
		$content['barang'] = $this->barang->Select('Barang.id, z.id as id_ku, warna, z.s, m, l, xl, Barang.status, id_kategori, deskripsi, harga, berat, Barang.nama, k.nama as kategori, permalink')
		->join([' JOIN kategori k' => 'k.id = Barang.id_kategori', ' join (select id, id_barang, warna, (select stok from stok where id_barang = z.id_barang and ukuran = "S" and warna = z.warna) s, (select stok from stok where id_barang = z.id_barang and ukuran = "M" and warna = z.warna) m, (select stok from stok where id_barang = z.id_barang and ukuran = "L" and warna = z.warna) l, (select stok from stok where id_barang = z.id_barang and ukuran = "XL" and warna = z.warna) xl from stok z group by id_barang, warna order by id asc) z' => 'z.id_barang = Barang.id'])
		->where('Barang.id = ' . $id)
		->get();


		if(count($content['barang']) < 1)
			Response::render404();

		$content['kategori'] = $this->kategori->Select('id, nama')
		->order('nama', 'ASC')
		->where('tipe = "produk"')
		->get();

		$content['title'] = 'Edit Product';
		$content['view'] = 'product/edit';
		Response::render('back/back', $content);
	}

	public function Update($id) {
		try {
			$st = false;
			$ex = '';
			$size = ['S', 'M', 'L', 'XL'];
			if(isset($_FILES['image']))
				$img = $_FILES['image'];


			$orm = new ORM;
			$pdo = $orm->pdo;
			$stok = new Stok;

			$pdo->beginTransaction();
			$a = $pdo->prepare($this->barang->qBuilder->QueryUpdate(['nama' => $_POST['name'], 'deskripsi' => $_POST['description'], 'berat' => $_POST['berat'], 'harga' => $_POST['price'], 'status' => $_POST['status'], 'id_kategori' => $_POST['category']], "WHERE Barang.id = $id") . " where id = $id");

			$a->execute();

			$da = $pdo->prepare($stok->qBuilder->QueryInsert());

			if(isset($_POST['color'])) {
				for($i = 0; $i < count($_POST['color']); $i++) {
					/* GAMBAR */
					$ext = explode('.', $img['name'][$i]);
					$ext = $ext[count($ext) - 1];
					$ex = $ext;
					$nm = $_POST['permalink'] . '-' . App::RandomString(5) . '.' . $ext;

					$dest = 'assets/img/product/' . $nm;
					move_uploaded_file($img['tmp_name'][$i], $dest);
					chmod($dest, 0755);
					/* END GAMBAR */

					for($j = 0; $j < 4; $j++) {
						$da->execute(['id_barang' => $id, 'warna' => $_POST['color'][$i], 'ukuran' => $size[$j], 'stok' => $_POST[$size[$j]][$i], 'foto' => $nm]);
					}
					
				}
			}

			$pdo->commit();

			//if(isset($_FILES['oldimage']))
			$oldimg = $_FILES['oldimage'];

			if(isset($_POST['oldcolor'])) {
				for($i = 0; $i < count($_POST['oldcolor']); $i++) {
					$data = ['warna' => $_POST['oldcolor'][$i]];
					/* GAMBAR */
					if($oldimg['error'][$i] == 0) {
						$ext = explode('.', $oldimg['name'][$i]);
						$ext = $ext[count($ext) - 1];
						$ex = $ext;
						$nm = $_POST['permalink'] . '-' . App::RandomString(5) . '.' . $ext;

						$dest = 'assets/img/product/' . $nm;
						move_uploaded_file($oldimg['tmp_name'][$i], $dest);
						chmod($dest, 0755);
						/* END GAMBAR */
						$data = array_merge(['foto' => $nm], $data);
					}

					$stok->Update($data, " where id_barang = " . $_POST['oldid_barang'][$i] . " and warna = '" . $_POST['oldwarna_barang'][$i] . "'");
				}
			}

			return App::FillAndRedirect('info', 'Successfully created new product', 'admin/product/');
				
		} 
		catch(Exception $e) {
			$msg = 'Upss.. something wrong..';
			echo $e->getMessage();

			return App::FillAndRedirect('danger', $e->getMessage(), "admin/product/$id/edit&name=" . str_replace(' ', '+', $_POST['name']) . "&category=$_POST[category]&status=$_POST[status]&price=$_POST[price]");
		}
	}

	public function Destroy($id) {
		$this->barang->Delete("WHERE id = $id");
		return App::FillAndRedirect('info', 'Successfully delete product', 'admin/product/');
	}

	public function Filter() {
		$pg = $_POST['pg'];
		$li = $_POST['li'];
		$st = $_POST['st'];
		$cg = $_POST['cg'];
		$kw = $_POST['kw'];
		$so = $_POST['so'];

		$q = '';
		if($so === '1')
			$q .= ' AND s != 0 AND m != 0 AND l != 0 AND xl != 0';
		else if($so === '0')
			$q .= ' AND (s = 0 OR m = 0 OR l = 0 OR xl = 0)';

		$content['barang'] = $this->barang->Select('Barang.id, s.foto as img, s.s, m, l, xl, Barang.nama, k.nama as kategori, CASE status WHEN 1 THEN "Active" WHEN 0 THEN "Non Active" END status, DATE_FORMAT(tgl_ditambah, "%d/%c/%Y %H:%i") tgl_ditambah2, permalink')
		->join([' JOIN kategori k' => 'k.id = Barang.id_kategori', ' JOIN (select id_barang as id_ku, (select sum(stok) from stok where ukuran = "S" AND id_barang = id_ku) s, (select sum(stok) from stok where ukuran = "M" AND id_barang = id_ku) m, (select sum(stok) from stok where ukuran = "L" AND id_barang = id_ku) l, (select sum(stok) from stok where ukuran = "XL" AND id_barang = id_ku) xl, foto from stok group by id_barang) s' => 's.id_ku = Barang.id'])
		->order('tgl_ditambah', 'DESC')
		->where("k.nama LIKE '%$cg%' AND status LIKE '%$st%' AND (Barang.nama LIKE '%$kw%' OR permalink LIKE '%$kw%')" . $q)
		->limit($pg * $li - $li, $li)
		->get();

		$content['ttl'] = $this->barang->Select('COUNT(*) ttl')
		->join([' JOIN kategori k' => 'k.id = Barang.id_kategori'])
		->order('tgl_ditambah', 'ASC')
		->where("k.nama LIKE '%$cg%' AND status LIKE '%$st%' AND (Barang.nama LIKE '%$kw%' OR permalink LIKE '%$kw%')" . $q)
		->get()[0];
		$content['limit'] = $li;

		Response::renderPart2('back', 'product/_table', $content);
	}

	public function Status($id) {
		if($_POST['tipe'] == ' Deactived') {
			$this->barang->Update(['status' => 0], 'WHERE id = ' . $id);
		}
		else if($_POST['tipe'] == ' Activated') {
			$this->barang->Update(['status' => 1], 'WHERE id = ' . $id);
		}
		$_SESSION['message'] = ['alert-info', 'Successfully change status'];
	}

	public function Stock($id) {
		$d = $this->barang->Select($_POST['size'])->where("id = $id")->get()[0];
			print_r($d);
		$q = $d[$_POST['size']] + $_POST['stock'];
		$this->barang->Update([$_POST['size'] => $q], "WHERE id = $id");
		$_SESSION['message'] = ['alert-info', 'Successfully add stock'];
	}
}