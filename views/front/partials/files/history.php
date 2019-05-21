					<div class="table">
						<table>
 
							<tr>
								<th>Unique Code</th>
								<th>Total Type</th>
								<th>Total Qty</th>
								<th>Status</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						<?php
						foreach($transaksi as $t) {
							echo "<tr>
								<td>$t[kode_unik]</td>
								<td>$t[jenis]</td>
								<td>$t[qty]</td>
								<td>$t[status]</td>
								<td>$t[tgl_transaksi2]</td>
								<td><a href='" . SITE_URL . 'history/' . $t['kode_unik'] . "'><button class='btn btn-white-blue'>Detail</button></a>"; 
							if($t['status'] == 'Not Complete')
								echo " <button class='btn btn-white-blue'>Cancel</button></td>";
							echo "</tr>";
						}
						?>
						</table>
					</div>