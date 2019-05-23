<?php
include 'controllers/SiteController.php';

class DashboardController extends SiteController {
	public function index() {
		$content['title'] = 'Graymotion.com Dashboard';
		$content['view'] = 'index';
		$content['ttlUser'] = $this->akun->Select('count(*) ttl')->get()[0]['ttl'];
		$content['ttlTransaction'] = $this->transaksi->Select('count(*) ttl')->get()[0]['ttl'];
		$content['ttlProduct'] = $this->barang->Select('count(*) ttl')->get()[0]['ttl'];
		$content['ttlArticle'] = $this->artikel->Select('count(*) ttl')->get()[0]['ttl'];
		$content['popularProduct'] = $this->GetPopularProduct(9);
		$content['popularCategory'] = $this->GetSitemapCategory(9);
		$content['dangerStock'] = $this->getDangerStock(10);
		Response::render('back/back', $content);
	}

	public function getGraph() { 
		$content = $this->transaksi->Select('DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, count(*) as jenis, sum(qty) as qty')
		->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id'])
		->group("date_format(Transaksi.tgl_transaksi, '%Y-%m-%d')")
		->order('tgl_transaksi', 'desc')
		->where('status = 1')
		->limit(0, 5)
		->get();

		$d['date'] = [];
		$d['type'] = [];
		$d['qty'] = [];

		foreach ($content as $val) {
			$d['date'][] = $val['tgl_transaksi2'];
			$d['type'][] = (int)$val['jenis'];
			$d['qty'][] = (int)$val['qty'];
		}

		$d['date'] = array_reverse($d['date']);
		$d['type'] = array_reverse($d['type']);
		$d['qty'] = array_reverse($d['qty']);

		echo json_encode($d);
	}

	public function getDangerStock($lim = 5) {
		return $this->barang->Select('nama, warna, ukuran, stok, permalink')
		->join([' join stok s' => 'Barang.id = s.id_barang'])
		->order('stok', 'asc')
		->where('status = 1 and stok < 20')
		->limit(0, 10)
		->get();
	}
}