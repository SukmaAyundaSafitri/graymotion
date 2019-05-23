<section id='main-wrapper'>
	<section id='sidebar-wrapper'>
		<!--<div class='box box-filter'>
			<div class='title'>Filter</div>
			<div class='filter-area'>
				<select class='cmb-filter cmb-gender'>
					<option value="">- Select Trend -</option>
					<option value="Most Popular">Most Popular</option>
					<option value="Most Comment">Most Comment</option>
					<option value="Latest Added">Latest Added</option>
				</select>
				<select class='cmb-filter cmb-size'>
					<option value="">- Select Exist Size -</option>
					<option value="S">Small</option>
					<option value="M">Medium</option>
					<option value="L">Large</option>
					<option value="XL">Xtra Large</option>
				</select>
				<select class='cmb-filter cmb-category'>
					<option value="">- Select Category -</option>
				<?php foreach($wKategori as $k) {
					echo "<option value='$k[id]'>$k[nama]</option>";
				} ?>
				</select>
			</div> 
		</div>-->

		<div class='box box-trend'>
			<div class='title'>Kategori Produk</div>
			<div class='content'>
			<?php
				if(count($wSitemap) == 0)
					echo "<div class='no-data'>No Data</div>";
				foreach($wSitemap as $rSitemap) {
					echo "<div class='item-produk'>
						<div class='title-produk'>
							<a href='" . SITE_URL . "category/product/$rSitemap[nama]'>" . substr($rSitemap['nama'], 0, 20) .
						" <span class='total-produk'>$rSitemap[ttl]</span></a></div>
						<div style='clear:both'></div>
					</div>";
				}
			?>
			</div>
		</div>

		<div class='box box-new'>
			<div class='title'>Produk Terbaru</div>
			<div class='content'>
			<?php
				if(count($wNew) == 0)
					echo "<div class='no-data'>No Data</div>";
				foreach($wNew as $rNew) {
					echo "<div class='item-produk'>
						<div class='img-produk f-left'>
							<img src='" . SITE_URL . "assets/img/product/". $rNew['img'] ."'>
						</div>
						<div class='title-produk f-right'>
							<a href='" . SITE_URL . "product/$rNew[permalink]/'>" . substr($rNew['nama'], 0, 20) .
						" ...</a></div>
						<div style='clear:both'></div>
					</div>";
				}
			?>
			</div>
		</div>
		
		<div class='box box-hot'>
			<div class='title'>Produk Terlaris</div>
				<div class='content'>
				<?php
					if(count($wPopular) == 0)
						echo "<div class='no-data'>No Data</div>";
					foreach($wPopular as $rPopular) {
						echo "<div class='item-produk'>
							<div class='img-produk f-left'>
								<img src='" . SITE_URL . "assets/img/product/". $rPopular['img'] ."'>
							</div>
							<div class='title-produk f-right'>
								<a href='" . SITE_URL . "product/$rPopular[permalink]/'>" . substr($rPopular['nama'], 0, 20) .
							" ...</a></div>
							<div style='clear:both'></div>
						</div>";
					}
				?>
				</div>
			</div>


		<div class='box box-comment'>
			<div class='title'>Daftar Komentar</div>
			<div class='content'>
		<?php
			if(count($wKomentar) == 0)
					echo "<div class='no-data'>No Data</div>";
			foreach($wKomentar as $rkomentar) {
				echo "<div class='item-produk'>
					<div class='img-produk f-left'>
						<img src='" . SITE_URL . "assets/img/site/user.png'>
					</div>
					<div class='title-produk f-right' style='line-height:20px'>
						<a href='" . SITE_URL . "$rkomentar[tipe]/$rkomentar[permalink]/' style='color: #8E9091'><b>$rkomentar[nama]</b><br>" . substr($rkomentar['isi'], 0, 20) .
					" ...</a></div>
					<div style='clear:both'></div>
				</div>";
			}
		?>
			</div>
		</div>
	</section>