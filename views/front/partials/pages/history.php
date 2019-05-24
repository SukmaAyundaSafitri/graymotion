	<section id='content-wrapper'>
		<div id="cart-wrapper">
			<div class='title'>
				History Transaction 
			</div>
			<div class="content">
				<div id="filter-history">
					<div id="filter-form">
						<div class="filter">
							<input type="text" class="form-control" placeholder='Keyword' id='hsKw'>
						</div>
						<div class="filter">
							<select name="" id="hsSt" class="form-control">
								<option value="">- Select Status -</option>
								<option value="1">Complete</option>
								<option value="0">Not Complete</option>
								<option value="3">Cancel</option>
							</select>
						</div>
						<div class="filter">
							<select name="" id="hsNo" class="form-control">
								<option value="0">- Limit -</option>
								<option value="5" selected>5</option>
								<option value="10">10</option>
								<option value="15">15</option>
								<option value="20">20</option>
								<option value="25">25</option>
							</select>
						</div>
						<div class="filter">
							<select name="" id="hsPg" class="form-control">
								<option value="1">- Page -</option>
								<option value="1" selected>1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
					</div>
				</div>
				
				<div class="data">
					<?php Response::renderPart('front', 'history', ['transaksi' => $transaksi]) ?>
				</div>
			</div>
			
		</div>

	</section>

	<div style='clear:both'></div>
</section>