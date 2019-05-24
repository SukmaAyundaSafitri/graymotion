<?php

include 'models/Barang.php';
include 'models/Artikel.php';
include 'models/Akun.php';
include 'models/Rating.php';
include 'models/Komentar.php';
include 'models/Kategori.php';
include 'models/Transaksi.php';
include 'models/Propinsi.php';

class SiteController { 
	protected $akun;
	protected $barang;
	protected $rating;
	protected $komentar;
	protected $artikel;
	protected $kategori;
	protected $transaksi;

	public function __construct() {
		$this->akun = new Akun;
		$this->barang = new Barang;
		$this->rating = new Rating;
		$this->komentar = new Komentar;
		$this->artikel = new Artikel;
		$this->barang = new Barang;
		$this->kategori = new Kategori;
		$this->transaksi = new Transaksi;
	}

	public function About() {
		$content = $this->GetWidgetFront();

		$content['title'] = 'About - Graymotion.com';
		$content['page'] = 'about';

		Response::render('front/front', $content);
	}

	public function FAQ() {
		$content = $this->GetWidgetFront();

		$content['title'] = 'FAQ - Graymotion.com';
		$content['page'] = 'faq';

		Response::render('front/front', $content);
	}

	public function Home($page = 1) {
		if($page < 1)
			Response::render404();

		if(!is_numeric($page))
			Response::render404();

		$content = $this->GetWidgetFront();
		$content['barangs'] = $this->barang->Select('Barang.id, z.s, m, l, xl, s.foto as img, Barang.nama, k.nama as nama_kategori, deskripsi, harga, permalink, case when avg(nilai) is null then 0 else round(avg(nilai), 2) end as rating')
		->order('tgl_ditambah', 'DESC')
		->limit($page * 6 - 6, 6)
		->join(array(' JOIN Kategori k' => 'Barang.id_kategori = k.id', ' LEFT JOIN Rating r' => 'Barang.id = r.id_barang', ' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id', ' join (select id, id_barang, warna, (select stok from stok where id_barang = z.id_barang and ukuran = "S" and warna = z.warna) s, (select stok from stok where id_barang = z.id_barang and ukuran = "M" and warna = z.warna) m, (select stok from stok where id_barang = z.id_barang and ukuran = "L" and warna = z.warna) l, (select stok from stok where id_barang = z.id_barang and ukuran = "XL" and warna = z.warna) xl from stok z group by id_barang, warna) z' => 'z.id_barang = Barang.id'))
		->where('status = 1')
		->group('Barang.id')
		->get();

		

		$a = $this->barang->Select('count(*) as ttl')->get()[0];
		$content['ttlProduct'] = [$page, $a['ttl']];

		$content['artikels'] = $this->artikel->Select('judul, img, isi, tgl_terbit, permalink')
		->order('tgl_terbit', 'DESC')
		->where('status = 1')
		->limit(0, 3)
		->get();

		$content['title'] = 'Graymotion.com';
		$content['page'] = 'home';

		Response::render('front/front', $content);
	}

	public function Product($permalink) {
		$q = "permalink = '$permalink'";
		if(!(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1))
			$q .= " AND status = 1";

		$content = $this->GetWidgetFront();
		$content['barang'] = $this->barang->Select('Barang.id, id_kategori, Barang.nama, k.nama as nama_kategori, berat, DATE_FORMAT(tgl_ditambah, "%d-%m-%Y") tgl_ditambah, deskripsi, harga, permalink')
		->where($q)
		->join(array('JOIN Kategori k' => 'Barang.id_kategori = k.id', ' JOIN stok s' => 's.id_barang = Barang.id'))
		->get();

		if(count($content['barang']) < 1)
			Response::render404();

		$content['warnaNimg'] = $this->barang->Select('warna, foto')
		->where($q)
		->join(array('JOIN stok s' => 's.id_barang = Barang.id'))
		->group('warna')
		->order('s.id', 'asc')
		->get();

		$content['ttlComment'] = $this->barang->Select('COUNT(*) ttl')
		->where('k.status = 1 and tipe = "product"')
		->join([' join komentar k' => 'k.id_page = barang.id'])
		->get();

		$content['before'] = $this->barang->Select('nama, permalink')
		->where('tgl_ditambah < "' . $content['barang'][0]['tgl_ditambah'] . '" AND status = 1')
		->order('tgl_ditambah', 'desc')
		->limit(0, 1)
		->get();

		$content['after'] = $this->barang->Select('nama, permalink')
		->where('tgl_ditambah > "' . $content['barang'][0]['tgl_ditambah'] . '" AND status = 1')
		->order('tgl_ditambah', 'asc')
		->limit(0, 1)
		->get();

		$content['related'] = $this->barang->Select('nama, s.foto as img, permalink')
		->where('rand() <= 0.75 AND id_kategori = ' . $content['barang'][0]['id_kategori'] . " AND status = 1")
		->join([' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id'])
		->limit(0, 4)
		->get();

		$content['komentar'] = $this->komentar->Select('id, nama, email, isi, DATE_FORMAT(tgl_komentar, "%d/%c/%Y %H:%i") tgl_komentar2')
		->where('id_page = ' . $content['barang'][0]['id'] . " AND status = 1")
		->order('tgl_komentar', 'desc')
		->limit(0, 5)
		->get();
		
		$content['rating'] = $this->GetStatisticRating($content['barang'][0]['id'])[0];

		$uid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;
		$content['userHasRating'] = $this->rating->IsExists('count(*) as ttl', "id_akun = $uid and id_barang = " . $content['barang'][0]['id']);

		$content['title'] = $content['barang'][0]['nama'] . ' - Graymotion.com';
		$content['page'] = 'product';

		Response::render('front/front', $content);
	}

	public function getComment($id, $type, $page, $limit) {
		$komentar = $this->komentar->Select('id, nama, email, isi, DATE_FORMAT(tgl_komentar, "%d/%c/%Y %H:%i") tgl_komentar2')
		->where('id_page = ' .$id . " AND status = 1 AND tipe = '$type'")
		->order('tgl_komentar', 'desc')
		->limit($page * $limit - $limit, $limit)
		->get();

		Response::renderPart('front', 'item-comment', ['komentar' => $komentar]);
	}

	public function getStok($id, $warna, $ukuran) {
		if($warna == '0' || $ukuran == '0')
			return;

		$data = $this->barang->Select('stok')
		->join(array('JOIN stok s' => 's.id_barang = Barang.id'))
		->where("id_barang = $id AND ukuran = '$ukuran' AND warna = '$warna'")
		->get();

		if(count($data) > 0)
			echo $data[0]['stok'];
		else
			echo 'Not Available';
	}

	public function getKabupaten($id) {
		$propinsi = new Propinsi;
		$content['data'] = $propinsi->Select('k.id, k.nama')->join(['JOIN kabupaten k' => 'k.id_propinsi = propinsi.id'])->where('propinsi.id = ' . $id)->order('k.nama', 'asc')->get();

		Response::renderPart('front', 'optionWilayah', $content);
	}

	public function getKecamatan($id) {
		$propinsi = new Propinsi;
		$content['data'] = $propinsi->Select('ke.id, ke.nama')->join(['JOIN kabupaten k' => 'k.id_propinsi = propinsi.id', ' JOIN kecamatan as ke' => 'ke.id_kabupaten = k.id'])->where('k.id = ' . $id)->order('ke.nama', 'asc')->get();

		Response::renderPart('front', 'optionWilayah', $content);
	}

	public function getPrice() {
		$id = $_POST['id'];
		$propinsi = new Propinsi;
		$data = $propinsi->Select('biaya')->join(['JOIN kabupaten k' => 'k.id_propinsi = propinsi.id', ' JOIN kecamatan as ke' => 'ke.id_kabupaten = k.id'])->where('ke.id = ' . $id)->get();

		if(count($data) < 1)
			return;

		$_SESSION['id_kecamatan'] = $id;
		$_SESSION['biaya'] = $data[0]['biaya'];
		echo $data[0]['biaya'];
	}

	public function Article($permalink) {
		$q = "permalink = '$permalink'";
		if(!(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1))
			$q .= " AND status = 1";

		$content = $this->GetWidgetFront();
		$content['artikel'] = $this->artikel->Select('Artikel.id, nama, judul, img, isi, tgl_terbit, permalink, id_kategori')
		->join([' JOIN Kategori k' => 'id_kategori = k.id'])
		->where($q)
		->get();

		if(count($content['artikel']) < 1)
			Response::render404();

		$content['before'] = $this->artikel->Select('judul, permalink')
		->where('tgl_terbit < "' . $content['artikel'][0]['tgl_terbit'] . '" AND status = 1')
		->order('tgl_terbit', 'desc')
		->limit(0, 1)
		->get();

		$content['after'] = $this->artikel->Select('judul, permalink')
		->where('tgl_terbit > "' . $content['artikel'][0]['tgl_terbit'] . '" AND status = 1')
		->order('tgl_terbit', 'asc')
		->limit(0, 1)
		->get();

		$content['komentar'] = $this->komentar->Select('id, nama, email, isi, DATE_FORMAT(tgl_komentar, "%d/%c/%Y %H:%i") tgl_komentar2')
		->where("status = 1 AND tipe = 'article' AND id_page = " . $content['artikel'][0]['id'])
		->order('tgl_komentar', 'desc')
		->limit(0, 5)
		->get();

		$content['related'] = $this->artikel->Select('judul, img, permalink')
		->where('rand() <= 2 AND id_kategori = ' . $content['artikel'][0]['id_kategori'] . " AND status = 1")
		->limit(0, 4)
		->get();

		$content['title'] = $content['artikel'][0]['judul'] . ' - Graymotion.com';
		$content['page'] = 'article';

		Response::render('front/front', $content);
	}

	public function Search($page = 1) {
		if($page < 1)
			Response::redirect('search');

		if(!is_numeric($page))
			return;

		$q = empty($_GET['q']) ? '': $_GET['q'];

		$content = $this->GetWidgetFront();
		$content['barangs'] = $this->barang->Select('Barang.id, z.s, m, l, xl, Barang.nama, s.foto as img, k.nama as nama_kategori, deskripsi, harga, permalink, case when avg(nilai) is null then 0 else round(avg(nilai), 2) end as rating')
		->where("Barang.nama LIKE '%$q%'")
		->order('tgl_ditambah', 'DESC')
		->limit($page * 6 - 6, 6)
		->join(array(' JOIN Kategori k' => 'Barang.id_kategori = k.id', ' LEFT JOIN Rating r' => 'Barang.id = r.id_barang', ' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id', ' join (select id, id_barang, warna, (select stok from stok where id_barang = z.id_barang and ukuran = "S" and warna = z.warna) s, (select stok from stok where id_barang = z.id_barang and ukuran = "M" and warna = z.warna) m, (select stok from stok where id_barang = z.id_barang and ukuran = "L" and warna = z.warna) l, (select stok from stok where id_barang = z.id_barang and ukuran = "XL" and warna = z.warna) xl from stok z group by id_barang, warna) z' => 'z.id_barang = Barang.id'))
		->group('Barang.id')
		->get();

		$a = $this->barang->Select('count(*) as ttl')->where("nama LIKE '%$q%'")->get()[0];
		$content['ttlProduct'] = [$page, $a['ttl']];

		$content['tResult'] = $this->barang->Select('count(*) as ttl')
		->where("Barang.nama LIKE '%$q%'")
		->get();

		$content['title'] = 'Search - Graymotion.com';
		$content['page'] = 'search';

		Response::render('front/front', $content);
	}

	public function Category($type = '', $category ='', $page = 1) {
		$content = $this->GetWidgetFront();

		if($type == 'product') {
			if(!is_numeric($page) || $page < 1)
				return Response::render404();

			$content['barangs'] = $this->barang->Select('Barang.id, z.s, m, l, xl, s.foto as img, Barang.nama, k.nama as nama_kategori, deskripsi, harga, permalink, case when avg(nilai) is null then 0 else round(avg(nilai), 2) end as rating')
			->order('tgl_ditambah', 'DESC')
			->limit($page * 6 - 6, 6)
			->join(array(' JOIN Kategori k' => 'Barang.id_kategori = k.id', ' LEFT JOIN Rating r' => 'Barang.id = r.id_barang', ' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id', ' join (select id, id_barang, warna, (select stok from stok where id_barang = z.id_barang and ukuran = "S" and warna = z.warna) s, (select stok from stok where id_barang = z.id_barang and ukuran = "M" and warna = z.warna) m, (select stok from stok where id_barang = z.id_barang and ukuran = "L" and warna = z.warna) l, (select stok from stok where id_barang = z.id_barang and ukuran = "XL" and warna = z.warna) xl from stok z group by id_barang, warna) z' => 'z.id_barang = Barang.id'))
			->where("k.nama = '$category' AND status = 1")
			->group('Barang.id')
			->get();

			$a = $this->barang->Select('count(*) as ttl')->join([' JOIN Kategori k' => 'k.id = Barang.id_kategori'])->where("k.nama = '$category' and status = 1")->get()[0];

			$content['page'] = 'category-product';
		}
		else if($type == 'article') {
			if(!is_numeric($page) || $page < 1)
				return Response::render404();

			$content['artikels'] = $this->artikel->Select('judul, nama, isi, img, tgl_terbit, permalink')
			->order('tgl_terbit', 'DESC')
			->limit($page * 6 - 6, 6)
			->join(array(' JOIN Kategori k' => 'id_kategori = k.id'))
			->where("k.nama = '$category'")
			->get();

			$a = $this->artikel->Select('count(*) as ttl')->join([' JOIN Kategori k' => 'k.id = id_kategori'])->where("k.nama = '$category'")->get()[0];

			$content['page'] = 'category-article';
		}
		else
			return Response::render404();
		
		$content['ttlProduct'] = [$page, $a['ttl']];
		$content['category'] = $category;

		$content['title'] = ucfirst($category) . ' - Graymotion.com';

		Response::render('front/front', $content);
	}

	public function ChartActionRev() {
		if(empty($_SESSION['cart']))
			$_SESSION['cart'] = [];

		if(empty($_POST['action']))
			return;

		if(isset($_POST['id'])) {
			$idx = $_POST['id'];
			$ukuran = $_POST['ukuran'];
			$warna = $_POST['warna'];
			$qty = $_POST['qty'];

			$ind = $idx . '-' . $ukuran . '-' . $warna;
		}

		if($_POST['action'] == 'add') {
			$barang = $this->barang->Select('s.id as id_stok, nama, stok, permalink, foto')
				->where('Barang.id = ' . $idx . " AND ukuran = '$ukuran' AND warna = '$warna'")
				->join(array('JOIN stok s' => 's.id_barang = Barang.id'))
				->get()[0];

			if(array_key_exists($ind, $_SESSION['cart']) && in_array($warna, $_SESSION['cart'][$ind]) && in_array($ukuran, $_SESSION['cart'][$ind])) {
				$qty = $qty + $_SESSION['cart'][$ind][4];
				if($qty > $barang['stok']) {
					echo 'out stock';
					return;
				}
				else {
					$_SESSION['cart'][$ind] = array($idx, $barang['nama'], $warna, $ukuran, $qty, $barang['foto'], $barang['permalink'], $barang['id_stok']);
				}
			}
			else {
				if($qty > $barang['stok']) {
					echo 'out stock';
					return;
				}
				else {
					$_SESSION['cart'][$ind] = array($idx, $barang['nama'], $warna, $ukuran, $qty, $barang['foto'], $barang['permalink'], $barang['id_stok']);
				}
			}

			echo 'ok';
		}
		else if($_POST['action'] == 'load') {
			echo json_encode($_SESSION['cart']);
		}
		else if($_POST['action'] == 'update') {
			$_SESSION['cart'][$ind][4] = $qty;
		}
		else if($_POST['action'] == 'remove') {
			unset($_SESSION['cart'][$ind]);
		}
	}

	public function ChartAction() {
		//default id (multiple), nama, size, qty, image, permalink
		if(empty($_POST['action']))
			return;

		if(isset($_POST['id']) && $_POST['action'] == 'addRemove' && isset($_POST['size'])) {

			foreach($_SESSION['chart'] as $a => $val) {
				//If isset berarti delete
				if($val[0] == $_POST['id'] && $val[2] == $_POST['size']) {
					unset($_SESSION['chart'][$a]);
					//unset($_SESSION['chartId'][$a]);
					return;
				}
			}

			$barang = $this->barang->Select('nama, permalink')
				->where('id = ' . $_POST['id'])
				->get();

			if($barang[0][$_POST['size']] > 0) {
				//$_SESSION['chartId'][] = $_POST['id'];
				$_SESSION['chart'][] = array($_POST['id'], $barang[0]['nama'], $_POST['size'], 1, $barang[0]['img'], $barang[0]['permalink']);
			}
			
		}
		else if($_POST['action'] == 'load')
			echo json_encode($_SESSION['chart']);

		else if($_POST['action'] == 'updateQty' && isset($_POST['qty']) && isset($_POST['id']) && isset($_POST['size']) && is_numeric($_POST['qty'])) {
			
			foreach($_SESSION['chart'] as $key => $chart) {
				if($chart[0] == $_POST['id'] && $chart[2] == $_POST['size']) {
					$_SESSION['chart'][$key][3] = $_POST['qty'];
					break;
				}
			}

		}
	}

	protected function GetStatisticRating($id) {
		return $this->rating->Select('(select count(*) from Rating where id_barang = ' . $id . ' and nilai = 1) n1, (select count(*) from Rating where id_barang = ' . $id . ' and nilai = 2) n2, (select count(*) from Rating where id_barang = ' . $id . ' and nilai = 3) n3, (select count(*) from Rating where id_barang = ' . $id . ' and nilai = 4) n4, (select count(*) from Rating where id_barang = ' . $id . ' and nilai = 5) n5, count(*) as ttl_review, avg(nilai) avg_review')
		->where('id_barang = ' . $id)
		->get();
	}

	protected function GetWidgetFront() {
		$content['wKomentar'] = $this->GetRecentComment();
		$content['wNew'] = $this->GetNewProduct();
		$content['wSitemap'] = $this->GetSitemapCategory();
		$content['wPopular'] = $this->GetPopularProduct();
		$content['wKategori'] = $this->GetKategori();
		return $content;
	}

	protected function GetKategori() {
		$kategori = new Kategori;
		return $kategori->Select("id, nama")->where("tipe = 'produk'")->get();
	}

	protected function GetRecentComment() {
		$orm = new ORM;
		return $orm->CustomSelect("select nama, tipe, isi, permalink from (select k.nama, tipe, k.isi, tgl_komentar, permalink from Komentar k join Barang b on k.id_page = b.id where tipe = 'product' union select k.nama, tipe, k.isi, tgl_komentar, permalink from Komentar k join Artikel b on k.id_page = b.id where tipe = 'article') a order by tgl_komentar desc limit 5");
	}

	protected function GetNewProduct() {
		return $this->barang->Select('nama, s.foto as img, permalink')
		->join([' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id'])
		->order('tgl_ditambah', 'desc')
		->where('status = 1')
		->limit(0, 5)
		->get();
	}

	protected function GetSitemapCategory($lim = 5) {
		return $this->barang->Select('k.nama, count(*) ttl')
		->join([' join kategori k' => 'k.id = Barang.id_kategori'])
		->group('k.nama')
		->order('ttl', 'desc')
		->where('status = 1')
		->limit(0, $lim)
		->get();
	}

	protected function GetPopularProduct($lim = 5) {
		return $this->barang->Select('nama, s.foto as img, permalink')
		->join([' join (select id_barang, sum(qty) as ttl from Detil_Transaksi dt join Transaksi t on dt.id_transaksi = t.id where status = 1 group by id_barang) dt' => 'id = id_barang', ' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = Barang.id'])
		->order('ttl', 'desc')
		->where('status = 1')
		->limit(0, $lim)
		->get();
	}
}