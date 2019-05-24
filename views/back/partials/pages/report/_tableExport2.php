							<table class="table" border=1 cellpadding="5">
								<thead>
									<tr>
										<th>Tanggal</th> 
										<th>Nama</th>
										<th>Kategori</th>
										<th>Total Qty</th>
										<th>Income</th>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach($data as $d) {
									echo "<tr>
										<td>$d[tgl_transaksi2]</td>
										<td>$d[nama]</td>
										<td>$d[kategori]</td>
										<td>$d[qty]</td>
										<td>Rp. " . number_format($d['income'], 0, '', '.') . "</td>
									</tr>";
								} ?>
								</tbody>
							</table>