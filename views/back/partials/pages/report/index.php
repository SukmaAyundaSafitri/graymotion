	<div class="page-title">
		<h3>Report: Overview</h3>
	</div>

	<div class="page-wrapper">
		<div class="row" style="margin-bottom: 30px">
			<div class="col-12">
				<div class="box">
					<div class="box-title">
						Chart
						<div class="pull-right"><button class='btn btn-cart btn-green' data-type='quantity'>Quantity</button></div>
						<div class="pull-right" style="margin-right: 5px;"><button class='btn btn-cart btn-green' data-type='income'>Income</button></div>
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
						<div class="table-responsive">
							<div class='pull-right'>
								Show 
									<select name="" class="cmbLimit filter">
										<option value="5">5</option>
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="25">25</option>
									</select>
									&nbsp; from date
									<form action='<?php echo BASEURL ?>admin/report/exportOverview' style="display: inline">
									<input type='date' class="filter cmbDateFrom" name="df">
									&nbsp; and to date 
									<input type='date' class="filter cmbDateTo" name="dt"> &nbsp; <button class="btn-ku btn-white btn-export">Export</button>
									</form>
							</div>
							<div style="clear:both"></div>
							<br>
						<div id='data'>
							<?php
								include '_tableIndex.php';
							?>
						</div>
						</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>