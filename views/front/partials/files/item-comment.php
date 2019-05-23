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