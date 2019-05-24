	<div class="page-title">
		<h3>Dashboard</h3>
		<ul class="breadcrumb"> 
			<li>Home</li>
			<li class="next">Dashboard</li>
		</ul>
	</div>

	<div class="page-wrapper">
		<div class="row" style="margin-bottom: 30px">
			<div class="col-3">
				<div class="box">
					<div class="stat">
						<p class="counter"><?php echo $ttlUser ?></p>
						<span class="title">Total users</span>
					</div>
					<div class="icon">
						<i class="fa fa fa-user-secret"></i>
					</div>
					<div style="clear:both"></div>

					<div class="progress">
						<div style="background-color: #22baa0; width: 40%; height: 100%"></div>
					</div>
				</div>
			</div>
			
			<div class="col-3">
				<div class="box">
					<div class="stat">
						<p class="counter"><?php echo $ttlTransaction ?></p>
						<span class="title">Total transactions</span>
					</div>
					<div class="icon">
						<i class="fa fa fa-shopping-cart"></i>
					</div>
					<div style="clear:both"></div>

					<div class="progress">
						<div style="background-color: #12afcb; width: 70%; height: 100%"></div>
					</div>
				</div>
			</div>

			<div class="col-3">
				<div class="box">
					<div class="stat">
						<p class="counter"><?php echo $ttlProduct ?></p>
						<span class="title">Total products</span>
					</div>
					<div class="icon">
						<i class="fa fa fa-shopping-bag"></i>
					</div>
					<div style="clear:both"></div>

					<div class="progress">
						<div style="background-color: #f6d433; width: 50%; height: 100%"></div>
					</div>
				</div>
			</div>

			<div class="col-3">
				<div class="box">
					<div class="stat">
						<p class="counter"><?php echo $ttlArticle ?></p>
						<span class="title">Total articles</span>
					</div>
					<div class="icon">
						<i class="fa fa fa-newspaper-o"></i>
					</div>
					<div style="clear:both"></div>

					<div class="progress">
						<div style="background-color: #f25656; width: 65%; height: 100%"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 30px">
			<div class="col-9">
				<div class="row" style="background: white; box-shadow: 0 5px 5px -5px rgba(0,0,0,.1); margin: 0">
					<div class="col-8" style="border-right: 1px solid #eee">
						<div class="box" style="box-shadow: none">
							<div class="box-title">
								Transaction Stat
								<div class="pull-right btn-refresh"><i class="fa fa-refresh"></i></div>
							</div>
							<div class="box-body">
								<div id="chart1" style="width: 100%"></div>
								<div class="overlay"><img src="<?php echo BASEURL ?>assets/img/site/reload.gif" width="20px"></div>
							</div>
						</div>
					</div>
					<div class="col-4">
						<div class="box" style="box-shadow: none">
							<div class="box-title">
								Top Product
								<div class="pull-right btn-refresh"><i class="fa fa-refresh"></i></div>
							</div>
							<div class="box-body">
								<ul class="browser">
								<?php foreach($popularProduct as $t)
									echo "<li><a href='" . SITE_URL . "product/" . $t['permalink'] . "/'>$t[nama]</a></li>";
								?>
								</ul>
								<div class="overlay"><img src="<?php echo BASEURL ?>assets/img/site/reload.gif" width="20px"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="box">
					<div class="box-title">
						Top Category
						<div class="pull-right btn-refresh"><i class="fa fa-refresh"></i></div>
					</div>
					<div class="box-body">
						<div class="flex space-between statistic">
							<ul class="browser">
								<?php foreach($popularCategory as $t)
									echo "<li><a href='" . BASEURL . "category/product/$t[nama]/' target='_blank'>$t[nama] ($t[ttl])</a></li>";
								?>
								</ul>
						</div>
						<div class="overlay"><img src="<?php echo BASEURL ?>assets/img/site/reload.gif" width="20px"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-title">
						Danger Stock
					</div>
					<div class="box-body" style="padding: 0">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Produk</th>
										<th>Warna</th>
										<th>Ukuran</th>
										<th>Stok</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$i = 0;
								foreach($dangerStock as $d) {
									$i++;
									echo "<tr>
										<td>$i</td>
										<td>$d[nama]</td>
										<td>$d[warna]</td>
										<td>$d[ukuran]</td>
										<td>$d[stok] Unit</td>
									</tr>";
								} ?>
								</tbody>
							</table>
						</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>