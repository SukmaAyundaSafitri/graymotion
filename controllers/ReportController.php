<?php
include 'controllers/SiteController.php';

class ReportController extends SiteController {
	public function index() {
		$content['title'] = 'Report & Analytics';
		$content['data'] = $this->getOverview();
		$content['view'] = 'report/index';
		$content['ttl'] = $this->transaksi->Select('COUNT(*) ttl')->get()[0];
		$content['limit'] = 5;

		Response::render('back/back', $content);
	} 

	public function ExportOverview() {
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=reportOverview.xls");

		$w = "";
		if(isset($_GET['df']) && $_GET['df'] != "" && isset($_GET['dt']) && $_GET['dt'] != "")
			$w .= " AND tgl_transaksi BETWEEN '$_GET[df] 00:00' AND '$_GET[dt] 23:59'";

		$content['data'] = $this->transaksi->Select('DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, sum(harga_satuan * qty) as income, count(*) as jenis, sum(qty) as qty')
		->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id'])
		->group("date_format(Transaksi.tgl_transaksi, '%Y-%m-%d')")
		->where('Transaksi.id > 0' . $w)
		->order('tgl_transaksi', 'DESC')
		->get();

		Response::renderPart2('back', 'report/_tableExport1', $content);
	}

	public function ExportProduct() {
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=reportProduct.xls");
		$cg = $_GET['cg'];

		$w = "";
		if(isset($_GET['df']) && $_GET['df'] != "" && isset($_GET['dt']) && $_GET['dt'] != "")
			$w .= " AND tgl_transaksi BETWEEN '$_GET[df] 00:00' AND '$_GET[dt] 23:59'";

		$content['data'] = $this->transaksi->Select('b.nama, k.nama as kategori, DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, sum(qty) as qty, sum(harga_satuan * qty) as income')
		->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id', ' JOIN barang b' => 'b.id = dt.id_barang', ' JOIN kategori k' => 'k.id = b.id_kategori'])
		->group("id_barang")
		->where('b.status = 1 AND k.nama LIKE "%'. $cg .'%" ' . $w)
		->order('tgl_transaksi', 'DESC')
		->get();

		Response::renderPart2('back', 'report/_tableExport2', $content);
	}

	public function Filter() {
		$pg = $_POST['pg'];
		$li = $_POST['li'];

		$w = "";
		if(isset($_POST['df']) && $_POST['df'] != "" && isset($_POST['dt']) && $_POST['dt'] != "")
			$w .= " AND tgl_transaksi BETWEEN '$_POST[df] 00:00' AND '$_POST[dt] 23:59'";

		$content['data'] = $this->transaksi->Select('DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, sum(harga_satuan * qty) as income, count(*) as jenis, sum(qty) as qty')
		->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id'])
		->group("date_format(Transaksi.tgl_transaksi, '%Y-%m-%d')")
		->where('Transaksi.id > 0' . $w)
		->limit($pg * $li - $li, $li)
		->order('tgl_transaksi', 'DESC')
		->get();

		$content['ttl'] = $this->transaksi->Select('COUNT(*) ttl')
		->where('id > 0' . $w)
		->get()[0];
		$content['limit'] = $li;

		Response::renderPart2('back', 'report/_tableIndex', $content);
	}

	public function getOverview() {
		$content = $this->transaksi->Select('DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, sum(harga_satuan * qty) as income, count(*) as jenis, sum(qty) as qty')
			->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id'])
			->group("date_format(Transaksi.tgl_transaksi, '%Y-%m-%d')")
			->order('tgl_transaksi', 'desc')
			->where('status = 1')
			->limit(0, 5)
			->get();

		return $content;
	}

	public function getProduct() {
		$content = $this->transaksi->Select('b.nama, k.nama as kategori, DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, sum(qty) as qty, sum(harga_satuan * qty) as income')
		->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id', ' JOIN barang b' => 'b.id = dt.id_barang', ' JOIN kategori k' => 'k.id = b.id_kategori'])
		->group('id_barang')
		->where('b.status = 1')
		->order('qty', 'desc')
		->limit(0, 5)
		->get();

		return $content;
	}

	public function getGraph($type) {
		if($type == 'income') {
			$content = $this->transaksi->Select('DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, sum(harga_satuan * qty) as total')
			->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id'])
			->group("date_format(Transaksi.tgl_transaksi, '%Y-%m-%d')")
			->order('tgl_transaksi', 'desc')
			->where('status = 1')
			->limit(0, 10)
			->get();

			$d['date'] = [];
			$d['total'] = [];

			foreach ($content as $val) {
				$d['date'][] = $val['tgl_transaksi2'];
				$d['total'][] = (int)$val['total'];
			}

			$d['date'] = array_reverse($d['date']);
			$d['total'] = array_reverse($d['total']);

			echo json_encode($d);
		}
		else if($type == 'quantity') {
			$content = $this->transaksi->Select('DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, count(*) as jenis, sum(qty) as qty')
			->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id'])
			->group("date_format(Transaksi.tgl_transaksi, '%Y-%m-%d')")
			->order('tgl_transaksi', 'desc')
			->where('status = 1')
			->limit(0, 10)
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
	}

	public function getGraph2() {
		$content = $this->transaksi->Select('b.nama, sum(qty) as qty')
		->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id', ' JOIN barang b' => 'b.id = dt.id_barang'])
		->group('id_barang')
		->where('b.status = 1')
		->order('qty', 'desc')
		->limit(0, 5)
		->get();

		$d = [];
		$temp = [];

		$i = 0;
		foreach ($content as $val) {
			$temp = [];
			$temp['name'] = $val['nama'];
			$temp['y'] = (int)$val['qty'];
			if($i == 0) {
				$temp['sliced'] = true;
				$temp['selected'] = true;
			}

			$d[] = $temp;
			$i++;
		}

		echo json_encode($d);
	}

	public function indexProduct() {
		$content['title'] = 'Report & Analytics';
		$content['data'] = $this->getProduct();
		$content['view'] = 'report/product';
		/*$content['ttl'] = $this->transaksi->Select('COUNT(*) ttl')->get()[0];
		$content['limit'] = 5;*/

		$content['kategori'] = $this->kategori->Select('id, nama')
		->order('nama', 'ASC')
		->where('tipe = "produk"')
		->get();

		$content['ttl'] = $this->barang->Select('COUNT(*) ttl')
		->join([' JOIN (select id_barang from detil_transaksi dt group by id_barang) dt' => 'dt.id_barang = Barang.id'])
		->get()[0];

		$content['limit'] = 5;

		Response::render('back/back', $content);
	}

	public function filterProduct() {
		$pg = $_POST['pg'];
		$cg = $_POST['cg'];
		$li = $_POST['li'];

		$w = "";
		if(isset($_POST['df']) && $_POST['df'] != "" && isset($_POST['dt']) && $_POST['dt'] != "")
			$w .= " AND tgl_transaksi BETWEEN '$_POST[df] 00:00' AND '$_POST[dt] 23:59'";

		$content['data'] = $this->transaksi->Select('b.nama, k.nama as kategori, DATE_FORMAT(Transaksi.tgl_transaksi, "%d-%m-%Y") tgl_transaksi2, sum(qty) as qty, sum(harga_satuan * qty) as income')
		->join(['JOIN detil_transaksi dt' => 'dt.id_transaksi = Transaksi.id', ' JOIN barang b' => 'b.id = dt.id_barang', ' JOIN kategori k' => 'k.id = b.id_kategori'])
		->group("id_barang")
		->where('b.status = 1 AND k.nama LIKE "%'. $cg .'%" ' . $w)
		->limit($pg * $li - $li, $li)
		->order('tgl_transaksi', 'DESC')
		->get();

		$content['ttl'] = $this->transaksi->Select('COUNT(*) ttl')
		->where('id > 0' . $w)
		->get()[0];
		$content['limit'] = $li;

		Response::renderPart2('back', 'report/_tableProduct', $content);
	}
}