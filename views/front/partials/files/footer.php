<footer>
	<div class='col f-left'>
		<div class='title'>
			HALAMAN
		</div>
		<div class='content'>
			<ul>
				<li><a href='#'>About</a></li>
				<li><a href='#'>Contact</a></li>
				<li><a href='#'>FAQ</a></li>
				<li><a href='#'>Cart</a></li>
				<li><a href='#'>Confirmation</a></li>
				<li><a href='#'>Search</a></li>
				<li><a href='#'>Login</a></li>
				<li><a href='#'>Register</a></li>
			</ul>
		</div>
	</div>

	<div class='col f-left'>
		<div class='title'>
			KATEGORI
		</div>
		<div class='content'>
			<ul>
				<?php
					foreach($wKategori as $kat) {
						echo "<li><a href='#'>$kat[nama]</a></li>";
					}
				?>
			</ul>
		</div>
	</div>

	<div class='col f-left'>
		<div class='title'>
			PARTNERS
		</div>
		<div class='content'>
			<ul>
				<li>Androbale Online</li>
				<li>Attractive Online Shop</li>
				<li>Bilabong Flip Shop</li>
				<li>Cloack Bluster</li>
				<li>Chesster Ampas</li>
				<li>Dinkry Sruput</li>
				<li>Franklink Pride</li>
				<li>Grist</li>
			</ul>
		</div>
	</div>

	<div class='col col-2 f-left'>
		<div class='title'>
			CONTACT
		</div>
		<div class='contact-wrapper'>
			<div class='contact f-left'>
				<img src='<?php echo SITE_URL ?>assets/img/site/email.png' width='30px'><br><br>admin@Graymotion.com
			</div>
			<div class='contact f-right'>
				<img src='<?php echo SITE_URL ?>assets/img/site/phone.png' width='30px'><br><br>+62-85			</div>
			<div style='clear:both'></div>
		</div><br><br>
		<a href='<?php echo SITE_URL ?>'><img src='<?php echo SITE_URL ?>assets/img/site/gr.jpeg' class='logo'></a>
	</div>

	<div style='clear:both'></div>
</footer>
<div id='copyright'>
	<div class="f-left">&copy; Graymotion.com &nbsp; / &nbsp; Banyuwangi Shop &nbsp; / &nbsp; All Right Reserved</div>
	<div class="f-right">Graymotion - Extremly Online Shop In This Century</div>
	<div style="clear:both"></div>
</div>

<div class="btn-up"><img src="<?php echo SITE_URL ?>assets/img/site/arrow-up.png"></div>

<script src='<?php echo SITE_URL ?>assets/js/jquery-1.11.3.min.js'></script> 
<script src='<?php echo SITE_URL ?>assets/js/script.js'></script>
