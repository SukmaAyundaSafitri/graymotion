<?php

include 'models/Rating.php';

class RatingController {
	public function Insert() {
		$rating = new Rating;

		try {
			if($rating->IsExists('count(*) as ttl', 'id_barang = ' . $_POST['id'] . ' AND id_akun = ' . $_SESSION['userid']))
				throw new Exception();

			$rating->Insert(['nilai' => $_POST['value'], 'id_akun' => $_SESSION['userid'], 'id_barang' => $_POST['id']]);

			echo json_encode(['result' => true]);
		}
		catch(Exception $e) {
			echo json_encode(['result' => false]); 
		}
	}
}