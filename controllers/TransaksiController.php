<?php

include 'models/Detil_Transaksi.php';
include 'models/Konfirmasi.php';
include 'controllers/SiteController.php';

class TransaksiController extends SiteController {
	public function getTtlTransaksi() {
		$data = $this->transaksi->Select('count(*) ttl')->get()[0];
		return $data['ttl'];
	}
 
	public function Index() {
		$content['transaksi'] = $this->akun->Select("t.id, kode_unik, count(*) as jenis, sum(qty) as qty, DATE_FORMAT(tgl_transaksi, '%d/%c/%Y %H:%i') tgl_transaksi2, case t.status when 0 then 'Not Complete' when 1 then 'Complete' when 2 then 'Cancel' end status")
		->join([' JOIN transaksi t' => 't.id_akun = Akun.id', ' JOIN detil_transaksi dt' => 't.id = dt.id_transaksi'])
		->group('kode_unik')
		->limit(0, 5)
		->order('tgl_transaksi', 'DESC')
		->get();

		$content['ttl'] = $this->transaksi->Select("COUNT(*) ttl")
		->get()[0];
		$content['limit'] = 5;
		$content['view'] = 'transaction/index';
		$content['title'] = 'List Transaction';

		Response::render('back/back', $content);
	}


	public function Status($id) {
		$trans = $this->transaksi->Select('dt.id_barang, id_stok, ukuran, warna, qty')
			->join([' JOIN detil_transaksi dt' => 'Transaksi.id = dt.id_transaksi'])
			->where("Transaksi.id = $id")
			->get();

		$orm = new ORM;
		$pdo = $orm->pdo;
		if($_POST['tipe'] == ' Confirm') {
			try {
				$pdo->beginTransaction();

				foreach($trans as $t) {
					$qty = (int) $t['qty'];
					$a = $pdo->prepare("UPDATE stok SET stok = stok - $qty WHERE id = $t[id_stok]");
					echo "UPDATE stok SET stok = stok - $qty WHERE id = $t[id_stok]";
					$a->execute();
				}

				$a = $pdo->prepare($this->transaksi->qBuilder->QueryUpdate(['status' => 1]) . " WHERE id = $id");
				$a->execute();

				$pdo->commit();
			} catch (Exception $e) {
				$pdo->rollback();
			}
		}
		else if($_POST['tipe'] == ' Cancel Confirm') {
			try {
				$pdo->beginTransaction();

				foreach($trans as $t) {
					$qty = (int) $t['qty'];
					$a = $pdo->prepare("UPDATE stok SET stok = stok + $qty WHERE id = $t[id_stok]");
					$a->execute();
				}

				$a = $pdo->prepare($this->transaksi->qBuilder->QueryUpdate(['status' => 0]) . " WHERE id = $id");
				$a->execute();

				$pdo->commit();
			} catch (Exception $e) {
				$pdo->rollback();
			}
		}
		$_SESSION['message'] = ['alert-info', 'Successfully change status'];
	}

	private function GetListCart() {
		$in = "''";
		$arr = [];

		if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
			foreach($_SESSION['cart'] as $cart) {
				if(in_array($cart[0], $arr))
					continue;

				$arr[] = $cart[0];
			}

			$in .= ',' . implode(',', $arr);
		}

		return $this->barang->Select('id, nama, harga, permalink, berat')
		->where('id IN (' . $in . ')')
		->get();
	}

	public function Cart() {
		$content = $this->GetWidgetFront();
		$content['title'] = 'Your Cart - Graymotion.com';
		$content['page'] = 'cart';

		$content['barangs'] = $this->GetListCart();
		Response::render('front/front', $content);
	}

	public function Step($step) {
		if(!$_SESSION['userlogin'])
			return App::FillAndRedirect('danger', 'You must login for access that page', 'user/login/');
		else if(isset($_SESSION['cart']) && count($_SESSION['cart']) <= 0 && isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != SITE_URL . 'transaction/2' && $_SERVER['HTTP_REFERER'] != SITE_URL . 'transaction/2/')
			return App::FillAndRedirect('danger', 'You must add least one item to cart', 'cart/');

		$content = $this->GetWidgetFront();
		$content['title'] = 'Transaction - Graymotion.com';

		if($step == 1) {
			$propinsi = new Propinsi;
			$content['page'] = 'transaction1';
			$content['propinsi'] = $propinsi->Select('id, nama')->order('nama', 'asc')->get();
			$content['barangs'] = $this->GetListCart();
		}
		else if($step == 2) {
			$content['users'] = $this->akun->Select('username, nama, no_hp, email, alamat')
					->join(array(' JOIN Detil_Akun' => 'id = id_akun'))
					->where('id = ' . $_SESSION['userid'])
					->get();

			$content['page'] = 'transaction2';
		}
		else if($step == 3) {
			if(empty($_SESSION['invoice']))
				Response::redirect('cart');

			$content['page'] = 'transaction3';
		}
		else
			return Response::render404();

		Response::render('front/front', $content);
	}

	public function InsertTransaction() {
		if(!$_SESSION['userlogin']) {
			return App::FillAndRedirect('danger', 'You must login for access that page', 'user/login/');
		}
		else if(count($_SESSION['cart']) <= 0) {
			return App::FillAndRedirect('danger', 'You must add least one item to cart', 'cart/');
		}

		$orm = new ORM;
		$transaksi = new Transaksi;
		$detil = new Detil_Transaksi;
		$cart = $this->GetListCart();

		try {
			$uq = App::RandomString(10);
			$_SESSION['invoice'] = $uq;

			$orm->pdo->beginTransaction();
			$a = $orm->pdo->prepare($transaksi->qBuilder->QueryInsert());
			$a->execute(['kode_unik' => $uq, 'status' => 0, 'tgl_transaksi' => date('Y-m-d H:i:s'), 'id_akun' => $_SESSION['userid'], 'ongkir' => $_SESSION['biaya'], 'id_kecamatan' => $_SESSION['id_kecamatan']]);
			
			$last = $orm->pdo->lastInsertId();
			
			$b = $orm->pdo->prepare($detil->qBuilder->QueryInsert());
			foreach($_SESSION['cart'] as $chart) {
				foreach($cart as $c) {
					if($chart[0] == $c['id']) {
						$b->execute(['id_transaksi' => $last, 'id_stok' => $chart[7], 'id_barang' => $c['id'], 'ukuran' => $chart[3], 'warna' => $chart[2], 'qty' => $chart[4], 'harga_satuan' => $c['harga']]);

						break;
					}
				}
			}
			
			$orm->pdo->commit();
			unset($_SESSION['cart']);
			Response::redirect('transaction/3');
		}
		catch (Exception $e) {
			$orm->pdo->rollback();

			return App::FillAndRedirect('danger', 'Failed to insert a transaction', 'cart/');
		}
	}

	public function FormConfirm() {
		$content = $this->GetWidgetFront();
		$content['title'] = 'Confirm Your Payment';
		$content['page'] = 'confirm';

		Response::render('front/front', $content);
	}

	public function Destroy($id) {
		$this->transaksi->Delete("WHERE id = $id");
		return App::FillAndRedirect('info', 'Successfully delete transaction', 'admin/transaction/');
	}

	public function InsertConfirm() {
		$transaksi = new Transaksi;
		$konfirmasi = new Konfirmasi;

		if(!$transaksi->IsExists('count(*) as ttl', "kode_unik = '$_POST[uniqueCode]'")) {
			return App::FillAndRedirect('danger', 'Unique code not valid, please write a valid unique code', 'confirm&code=' . $_POST['uniqueCode'] . '&bank=' . $_POST['bank'] . '&desc=' . $_POST['description']);
		}
		else if($konfirmasi->IsExists('count(*) as ttl', "kode_unik = '$_POST[uniqueCode]' AND status = 0")) {
			return App::FillAndRedirect('danger', 'Your before confirmation with same code already submit, please wait until BS.com confirm', 'confirm&code=' . $_POST['uniqueCode'] . '&bank=' . $_POST['bank'] . '&desc=' . $_POST['description']);
		}
		else if($konfirmasi->IsExists('count(*) as ttl', "kode_unik = '$_POST[uniqueCode]' AND status = 1")) {
			return App::FillAndRedirect('danger', 'You cannot confirm again with same successfully unique code confirmation', 'confirm&code=' . $_POST['uniqueCode'] . '&bank=' . $_POST['bank'] . '&desc=' . $_POST['description']);
		}


		try {
			$img = $_FILES['screenshot'];

			$ext = explode('.', $img['name']);
			$ext = $ext[count($ext) - 1];
			$dest = 'assets/img/confirm/' . $_POST['uniqueCode'] . '.' . $ext;

			$konfirmasi->Insert(['kode_unik' => $_POST['uniqueCode'], 'bank' => $_POST['bank'], 'foto_bukti' => $_POST['uniqueCode'] . '.' . $ext, 'ket' => $_POST['description'], 'status' => 0, 'tgl_konfirmasi' => date('Y-m-d H:i:s')]);

			move_uploaded_file($_FILES['screenshot']['tmp_name'], $dest);
			chmod($dest, 0777);

			return App::FillAndRedirect('info', 'Successfully add your confirm. Please wait 1 x 24, and we are contact you about your confirmation. Thanks', 'confirm/');
		}
		catch(Exception $e) {
			return App::FillAndRedirect('danger', 'Failed to add your confirmation', 'confirm&code=' . $_POST['uniqueCode'] . '&bank=' . $_POST['bank'] . '&desc=' . $_POST['description']);
		}
	}

	public function Detail($id) {
		if(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 2)
			$content = $this->GetWidgetFront();

		$transaksi = new Transaksi;
		$content['transaksi'] = $transaksi->Select("s.foto as img, ongkir, pro.nama as propinsi, kab.nama as kabupaten, kec.nama as kecamatan, berat, warna, ukuran, b.nama, k.nama as kategori, dt.ukuran, dt.harga_satuan, dt.qty")
		->join([' JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id', ' JOIN barang b' => 'b.id = dt.id_barang', ' JOIN kategori k' => 'k.id = b.id_kategori', ' JOIN (select id_barang, foto from stok group by id_barang) s' => 's.id_barang = b.id', ' JOIN kecamatan kec' => 'kec.id = Transaksi.id_kecamatan', ' JOIN kabupaten kab' => 'kab.id = kec.id_kabupaten', ' JOIN propinsi pro' => 'pro.id = kab.id_propinsi'])
		->where("kode_unik = '$id'")
		->get();

		if(count($content['transaksi']) < 1)
			Response::render404();

		$k = new Konfirmasi;
		$content['konfirmasi'] = $k->Select('bank, status, DATE_FORMAT(tgl_konfirmasi, "%d/%c/%Y %H:%i") tgl_konfirmasi, foto_bukti, ket')
		->where("kode_unik = '$id'")
		->get();

		$content['invoice'] = $id;
		$content['title'] = 'Detail Transaction';

		if(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 2) {
			$content['page'] = 'detail';
			Response::render('front/front', $content);
		}
		else {
			$content['view'] = 'transaction/detail';
			Response::render('back/back', $content);
		}

		
	}

	public function Filter() {
		$kw = isset($_POST['kw']) ? $_POST['kw'] : '';
		$st = isset($_POST['st']) ? $_POST['st'] : '';
		$li = isset($_POST['li']) ? $_POST['li'] : 5;
		$pg = isset($_POST['pg']) ? $_POST['pg'] : 1;

		$transaksi = new Transaksi;

		$wh = '';
		if(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 2)
			$wh = "Akun.id = " . $_SESSION['userid'] . " AND ";

		$content['transaksi'] = $this->akun->Select("t.id, kode_unik, count(*) as jenis, sum(qty) as qty, DATE_FORMAT(tgl_transaksi, '%d/%c/%Y %H:%i') tgl_transaksi2, case t.status when 0 then 'Not Complete' when 1 then 'Complete' when 2 then 'Cancel' end status")
		->join([' JOIN transaksi t' => 't.id_akun = Akun.id', ' JOIN detil_transaksi dt' => 't.id = dt.id_transaksi'])
		->group('kode_unik')
		->order('tgl_transaksi', 'DESC')
		->where($wh . "t.status LIKE '%$st%' AND (kode_unik LIKE '%$kw%')")
		->limit($li * $pg - $li, $li)
		->order('tgl_transaksi', 'DESC')
		->get();

		if(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 2)
			Response::renderPart('front', 'history', $content);
		else if(isset($_SESSION['userlevel']) && $_SESSION['userlevel'] == 1) {
			$content['limit'] = $li;
			$content['ttl'] = $this->transaksi->Select("COUNT(*) ttl")
			->where("status LIKE '%$st%' AND (kode_unik LIKE '%$kw%')")
			->get()[0];
			Response::renderPart2('back', 'transaction/_table', $content);
		}
	}
}