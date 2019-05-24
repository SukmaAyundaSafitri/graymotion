	<section id='content-wrapper'>
		<div class='breadcrumb-wrapper' style='border: none'>
			Home &nbsp;&raquo;&nbsp; Article &nbsp;&raquo;&nbsp; <a class='link-gray-blue' href='<?php echo SITE_URL . "category/article/". strtolower($artikel[0]['nama']) ?>/'><?php echo $artikel[0]['nama'] ?></a> &nbsp;&raquo;&nbsp; <?php echo $artikel[0]['judul'] ?>
		</div>
		<div id='article-detail'>
			<div class='title'>
				<?php echo $artikel[0]['judul'] ?>
			</div> 
			<div class='date'>
				Admin &bull; <?php echo $artikel[0]['tgl_terbit'] ?>
			</div>
			<div class='content'>
				<img src='<?php echo SITE_URL . 'assets/img/article/' . $artikel[0]['img'] ?>' align='right'>
				<?php echo $artikel[0]['isi'] ?>
				<div style="clear:both"></div>
			</div>
		</div>

		<div class='breadcrumb-wrapper' style='background:transparent'>
			<span class='f-left'>
				<?php
					if(count($after) > 0) {
						echo "<a title='Next Article' class='link-gray-blue' href='" . SITE_URL . "article/" . $after[0]['permalink'] . "'>&laquo;&nbsp; " . $after[0]['judul'] . "</a>";
					}
				?>
			</span>
			<span class='f-right'>
				<?php
					if(count($before) > 0) {
						echo "<a title='Previous Article' class='link-gray-blue' href='" . SITE_URL . "article/" . $before[0]['permalink'] . "'>" .$before[0]['judul'] . " &nbsp;&raquo;</a>";
					}
				?>
			</span>
			<div style='clear:both'></div>
		</div>

		<div id='related-wrapper'>
		<?php
			foreach($related as $relate) {
				echo "<div class='item f-left'>
					<img src='" . SITE_URL . "assets/img/article/$relate[img]'>
					<div><a class='link-gray-blue' href='" . SITE_URL . "article/$relate[permalink]/'>$relate[judul]</a></div>
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
					<input type='hidden' value='<?php echo $artikel[0]['id'] ?>' name='id'>
					<input type='hidden' value='article' name='tipe'>
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

			<div class='all-comment-wrapper' data-id='<?php echo $artikel[0]['id'] ?>' data-type='article'>
			<?php
				foreach($komentar as $k) {
					echo "<div class='item'>
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