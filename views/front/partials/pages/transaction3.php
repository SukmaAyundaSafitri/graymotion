 	<section id='content-wrapper'>
		<div id='cart-wrapper'>
			<div class='title'>
				Payment & Confirmation
			</div>
			<div class='content'>
				<?php
					if(isset($_SESSION['invoice'])) {
						echo "<div class='alert alert-info'><b>Alert: </b> Your invoice code is : <b>" . $_SESSION['invoice'] . "</b>. Please use this code to confirm your payment</div>";
						unset($_SESSION['invoice']);
					}
				?>
				<br>
				Terima kasih telah memilih Graymotion.com sebagai online shop yang anda gunakan. Anda diwajibkan membayar dengan nominal yang tertera pada langkah sebelumnya.
				<br><br>
				Berikut ini rekening bank pembayaran yang dapat Anda gunakan:
				<ul>
					<li>Bank BRI - 0213.015321.51627 (A/n: Mas Ilham)</li>
					<li>Bank BCA - 0213.015321.51627 (A/n: Pakde Firza)</li>
					<li>Bank Mandiri - 0213.015321.51627 (A/n: Paijo With Dika)</li>
				</ul>
				<br>
				Setelah anda melakukan pembayaran, anda harus melakukan konfirmasi pembayaran. Silahkan mengklik link 'Konfirmasi Pembayaran' dan mengikuti langkah yang disediakan.
				<br><br>
				Batas pembayaran yaitu 1 x 24 jam, jika dalam tenggang waktu tersebut Anda belum melakukan pembayaran. Maka pembayaran dianggap batal.
			</div><br>
			<button class='btn btn-white-blue f-right' style='width: 150px; margin-right: 10px'>Export PDF</button>
			<button class='btn btn-white-blue f-right' style='width: 150px; margin-right: 10px'>Export Excel</button>
			<button class='btn btn-white-blue f-right' style='width: 150px; margin-right: 10px'>Print</button>
			<div style="clear:both"></div>
		</div>
	</section>
	<div style='clear:both'></div>

</section>