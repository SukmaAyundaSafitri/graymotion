	<div class="page-title">
		<h3>Report: Product</h3>
	</div> 

	<div class="page-wrapper">
		<div class="row" style="margin-bottom: 30px">
			<div class="col-12">
				<div class="box">
					<div class="box-title">
						Product Chart
					</div>
					<div class="box-body">
						<div id='chartku'></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-title">
						Statistics
					</div>
					<div class="box-body" style="padding: 0">
						<div class="table-responsive" id='product'>
							<div class='pull-right'>
								Show 
									<select name="" class="cmbLimit filter">
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="25">25</option>
									</select> 
									<form action='<?php echo BASEURL ?>admin/report/exportProduct' method='get' style="display: inline">&nbsp; category 
									<select name="cg" class="cmbCategory filter">
										<option value="">No Problem</option>
									<?php
										foreach($kategori as $k)
											echo "<option value='$k[nama]'>$k[nama]</option>";
									?>
									</select>
									&nbsp; from date
									<input type='date' class="filter cmbDateFrom" name="df">
									&nbsp; and to date 
									<input type='date' class="filter cmbDateTo" name="dt"> &nbsp; <button class="btn-ku btn-white btn-export">Export</button>
									</form>
							</div>
							<div style="clear:both"></div>
							<br>
							<div id='data'>
								<?php
									include '_tableProduct.php';
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>