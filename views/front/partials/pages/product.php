		<section id='content-wrapper'>
		<div class='breadcrumb-wrapper' style="border-bottom: 1px solid #ebebeb">
			Home &nbsp;&raquo;&nbsp; Product &nbsp;&raquo;&nbsp; <a class='link-gray-blue' href='<?php echo SITE_URL . "category/product/". strtolower($barang[0]['nama_kategori']) ?>/'><?php echo $barang[0]['nama_kategori'] ?></a> &nbsp;&raquo;&nbsp; <?php echo $barang[0]['nama'] ?>
		</div>

<!-- ini di ganti posisi --> 


		<div id='detail-wrapper'>
			<div class='info row'>
				<div class='img col-5' style="padding: 0">
					<div class='kat'><?php echo $barang[0]['nama_kategori'] ?></div>
					<img src='<?php echo SITE_URL ?>assets/img/product/<?php echo $warnaNimg[0]['foto'] ?>' class="primary">
					<?php
						foreach($warnaNimg as $w)
							echo "<img src='" . SITE_URL . "assets/img/product/$w[foto]' data-warna='$w[warna]' class='preview'>";
					?>
				</div>
				<div class='detil col-5' style="padding-left: 20px">
					<div class='form-group no-flex'>
						<div class="label">	
							<label>Harga</label>
						</div>
						<div class="input">
							<input type='text' value="Rp. <?php echo number_format($barang[0]['harga'], 0, "", ".") ?>" readonly>
						</div>
					</div>
						
					<div class='row'>
						<div class='col-5'>
							<div class='form-group no-flex'>
								<div class="label">
									<label>Warna</label>
								</div>
								<div class="input">
									<!-- <select id='warna' class="filter-stok">
										<option value='0'>- Select -</option>
									<?php
									//	foreach($warnaNimg as $w)
									//		echo "<option value='$w[warna]'>$w[warna]</option>";
									?>
									</select> -->
									<input type="text" id="warna" readonly value="<?php echo $w['warna']; ?>">
								</div>
							</div>
						</div>
						<div class='col-5'>
							<div class='form-group no-flex'>
								<div class="label">	
									<label>Berat</label>
								</div>
								<div class="input">
									<input type='text' value="<?php echo $barang[0]['berat'] ?> kg" readonly>
								</div>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class='col-5'>
							<div class='form-group no-flex'>
								<div class="label">
									<label>Ukuran</label>
								</div>
								<div class="input">
									<select id='ukuran' class="filter-stok" data-id='<?php echo $barang[0]['id'] ?>'>
										<option value='0'>- Select -</option>
										<option value='S'>S</option>
										<option value='M'>M</option>
										<option value='L'>L</option>
										<option value='XL'>XL</option>
									</select>
								</div>
							</div>
						</div>
						<div class='col-5'>
							<div class='form-group no-flex'>
								<div class="label">	
									<label>Stok</label>
								</div>
								<div class="input">
									<input type='text' readonly id='stok'>
								</div>
							</div>
						</div>
					</div>
					<div class='form-group no-flex'>
						<div class="label">	
							<label>Kuantitas</label>
						</div>
						<div class="input">
							<input type='number' value="0" id='qty'>
						</div>
					</div>
						
					<button data-id='<?php echo $barang[0]['id'] ?>'  class="btn btn-blue-blue btn-block btn-add-to-cart1" style="padding: 10px; border-radius: 0; ">Beli Sekarang</button>
					<button data-id='<?php echo $barang[0]['id'] ?>' class="btn btn-blue-white btn-block btn-add-to-cart" style="padding: 10px; border-radius: 0">Tambah Ke Keranjang</button>
				</div>
			</div>
			<br>
			<?php echo $barang[0]['deskripsi'] ?>
		</div>

		<div id='statistic-wrapper' style="border-bottom: 1px solid #ebebeb">
			<div class='overview-stat f-left'>
				<div class="title">
					<?php echo $barang[0]['nama'] ?>
				</div>
				<div class="date">
					Published On <?php echo $barang[0]['tgl_ditambah'] ?>
				</div>
				<div class='f-left overview-action'>
					<div class='button-wrap'>
						<button class='btn btn-blue-white btn-comment btn-chart'>Comment</button>
						<a href='<?php echo SITE_URL ?>wishlist/<?php echo $barang[0]['id']; ?>/add'><button class='btn btn-blue-white btn-chart'>Keranjang Belanja</button></a>
					</div>
					<div class='ratings-wrap' data-id='<?php echo $barang[0]['id'] ?>' data-avg='<?php echo round($rating['avg_review']) ?>'>
					<?php
						if($userHasRating) {
							for($i = 0; $i < 5; $i++) {
								if($rating['avg_review'] - $i >= 1)
									echo "<div class='rating-over' data-value='" . ($i + 1) . "'>&nbsp;</div>";
								else if($rating['avg_review'] - $i > 0)
									echo "<div class='rating-half' data-value='" . ($i + 1) . "'>&nbsp;</div>";
								else
									echo "<div class='rating-star' data-value='" . ($i + 1) . "'>&nbsp;</div>";
							}
						}
						else {
							for($i = 0; $i < 5; $i++) {
								if($rating['avg_review'] - $i >= 1)
									echo "<div class='star rating-over' data-value='" . ($i + 1) . "'>&nbsp;</div>";
								else if($rating['avg_review'] - $i > 0)
									echo "<div class='star rating-half' data-value='" . ($i + 1) . "'>&nbsp;</div>";
								else
									echo "<div class='star rating-star' data-value='" . ($i + 1) . "'>&nbsp;</div>";
							}
						}
					?>
						

						<div style="clear: both"></div>

						<span class='type-rating'>Please give me rating...</span>
					</div>
					<div style="clear: both"></div>
				</div>

				<div class='f-right overview-history'>
					<div class='data'>
						<span class='value'><?php echo round($rating['avg_review'], 2) ?></span>
						<span class='desc'>From <?php echo $rating['ttl_review'] ?> Users</span>
					</div>

					<div class='data'>
						<span class='value'><?php echo $ttlComment[0]['ttl'] ?> comments</span>
						<span class='desc'>Since <?php echo $barang[0]['tgl_ditambah'] ?></span>
					</div>
				</div>
				<div style='clear:both'></div>

			</div>
			<div class='rating-stat f-right'>
				<div class='text'>Rating Analysis</div>
				<ul>
			<?php
				for($i = 1; $i <= 5; $i++) {
					echo "<li>
						<p>$i Stars</p>
						<div class='progress'>
							<div style='width: " . ($rating['ttl_review'] != 0 ? ($rating["n$i"]*100/$rating['ttl_review']) : 0) . "%;'>&nbsp;</div>
						</div>
						<p>" . $rating["n$i"] . " Users</p>
					</li>";
				}
			?>
				</ul>
			</div>
			<div style="clear:both"></div>
		</div>

		<div class='breadcrumb-wrapper' style='background:transparent'>
			<span class='f-left'>
				<?php
					if(count($after) > 0) {
						echo "<a title='Next Product' class='link-gray-blue' href='" . SITE_URL . "product/" . $after[0]['permalink'] . "'>&laquo;&nbsp; " . $after[0]['nama'] . "</a>";
					}
				?>
			</span>
			<span class='f-right'>
				<?php
					if(count($before) > 0) {
						echo "<a title='Previous Product' class='link-gray-blue' href='" . SITE_URL . "product/" . $before[0]['permalink'] . "'>" .$before[0]['nama'] . " &nbsp;&raquo;</a>";
					}
				?>
			</span>
			<div style='clear:both'></div>
		</div>

		<div id='related-wrapper'>

		<?php
			foreach($related as $relate) {
				echo "<div class='item f-left'>
					<a class='link-gray-blue' href='" . SITE_URL . "product/$relate[permalink]/'><img src='" . SITE_URL . "assets/img/product/$relate[img]'></a>
					<div><a class='link-gray-blue' href='" . SITE_URL . "product/$relate[permalink]/'>$relate[nama]</a></div>
				</div>";
			}
		?>
			
			<div style='clear: both'></div>
		</div>
		<br>
		<?php
			if(isset($_SESSION['message'])) {
				echo "<div class='alert " . $_SESSION['message'][0] . "'><b>Alert: </b> " . $_SESSION['message'][1] . "</div><br>";
				unset($_SESSION['message']);
			}
		?>
		<div id='comment-wrapper'>
			
			<div class='form-comment'>
				<form action='<?php echo SITE_URL ?>comment/' method='post'>
					<input type='hidden' value='<?php echo $barang[0]['id'] ?>' name='id'>
					<input type='hidden' value='product' name='tipe'>
					<textarea class='body' placeholder='Komentarmu' name='body'></textarea>

					<div class='form-comment-bottom'>
						<div class='f-left picture-form'>
							<img src='<?php echo SITE_URL ?>assets/img/site/user.png' class='f-left'>
						</div>
						<div class='f-right input-form'>
							<input type='text' placeholder='Name' name='nama'>
							<input type='text' placeholder='Email' name='email'>
							<input type='reset' class='btn-flat btn-flat-blue' value='Bersihkan'>
							<input type='submit' class='btn-flat btn-flat-blue' value="Submit">
						</div>

						<div style="clear:both"></div>
					</div>
				</form>
			</div>

			<div class='all-comment-wrapper' data-id='<?php echo $barang[0]['id'] ?>' data-type='product'>
			<?php
				foreach($komentar as $k) {
					echo "<div class='item' id ='$k[id]'>
					<div class='picture-comment f-left'>
						<img src='" . SITE_URL . "assets/img/site/user.png'>
					</div>
					<div class='body-comment f-right'>
						<div class='title'>
							$k[nama] <span style='font-weight: normal'>- $k[tgl_komentar2]</span>
						</div>
						<div class='content'>
							$k[isi]
						</div>
					</div>
					<div style='clear:both'></div>

					</div>";
				}
			?>
			</div>
			<button class="btn-flat-blue btn-load-more" data-page='1'>Load More...</button>
		</div>
	</section>
	<div style='clear:both'></div>

</section>