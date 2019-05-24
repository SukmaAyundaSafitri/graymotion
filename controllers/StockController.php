<?php

include 'controllers/SiteController.php';
include 'models/Stok.php';

class StockController extends SiteController {
	public function Add() {
		$stok = new Stok;
		$content['data'] = $stok->Select("id_barang, warna")
		->group('warna')
		->where('id_barang = ' . $_GET['id'])
		->get();

		$content['title'] = 'Add Stock';
		$content['view'] = 'stock/new';
		Response::render('back/back', $content); 
	}

	public function Store() {
		$stok = new Stok;
		$orm = new ORM;
		$pdo = $orm->pdo;
		$size = ['S', 'M', 'L', 'XL'];
		
			try {
				$pdo->beginTransaction();

				for($i = 0; $i < count($_POST['color']); $i++) {
					$warna = $_POST['color'][$i];
					for($j = 0; $j < 4; $j++) {
						$qty = $_POST[$size[$j]][$i];
						$a = $pdo->prepare("UPDATE stok SET stok = stok + $qty WHERE id_barang = $_POST[id] AND warna = '$warna' AND ukuran = '$size[$j]'");

						$a->execute();
					}
				}

				$pdo->commit();
				return App::FillAndRedirect('info', 'Successfully add stock', 'admin/product/');
			} catch (Exception $e) {
				$pdo->rollback();
			}
	}
}