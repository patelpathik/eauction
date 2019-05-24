<?php
	include "head.php";
?>
<script>
	function accept1(bi_id,cu_id){
		var url="upd_del.php?op=accept_bid&bi_id="+bi_id+"&cu_id="+cu_id;
		alert(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(data){
				location.reload();
			}
		});
	}
</script>
<div class="my-3 my-md-5">
	<div class="container">
		<div class="row">

		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Manage Bids</h3>
				</div>
			</div>
		</div>

		
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="card-status bg-orange"></div>
					<h3 class="card-title">Pending</h3>
					<div class="card-options">
						<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
						<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tbl_pending">
							<?php
								/*$q1="select * from bid_info b,product p, category c where b.pr_id = p.pr_id && c.cat_id = p.cat_id";
								$e1=$conn->query($q1);
								if($e1->num_rows > 0){
									$i=0;
									while($row=$e1->fetch_object()){
										$i++;
										$sdate=strtotime($row->start_date);
										$edate=strtotime($row->end_date);
										$cdate=strtotime(date('Y-m-d'));
										if($cdate > $edate){
											// print_r($row);
											echo "<br>";
											echo "<tr>";
											echo "<td colspan='2'><h3>$i) $row->name ($row->category)</h3></td>";
											echo "</tr>";

											echo "<tr>";
											$qt="select * from bids b,customer c where b.bi_id='$row->bi_id' && b.cu_id=c.cu_id order by b.amt desc";
											$et=$conn->query($qt);

											if($et->num_rows > 0){
												$i2=0;
												while($rowt=$et->fetch_object()){
													$i2++;
													echo "<tr>";
													echo "<td><h5>($i2) $rowt->fname $rowt->lname ($rowt->email)</h5></td>";
													echo "<td>$rowt->amt</td>";
													echo "<tr>";
												}
											}
											echo "</tr>";
										}
									}
								}*/
							?>
						</table>
					</div>
				</div>
			</div>
		</div>	

							
		<?php
			$q1="select * from bid_info b,product p, category c where b.pr_id = p.pr_id && c.cat_id = p.cat_id && b.cu_id='-1'";
			$e1=$conn->query($q1);
			if($e1->num_rows > 0){
				$i=0;
				while($row=$e1->fetch_object()){
					$i++;
					$sdate=strtotime($row->start_date);
					$edate=strtotime($row->end_date);
					$cdate=strtotime(date('Y-m-d'));
					if($cdate > $edate){
						$qt="select * from bids b,customer c where b.bi_id='$row->bi_id' && b.cu_id=c.cu_id order by b.amt desc";
						$et=$conn->query($qt);

						if($et->num_rows > 0){
							$i2=0;
							
							echo "<div class='col-xl-12'>";
							echo "<div class='card'>";
							echo "<div class='card-header'>";
							echo "<div class='card-status bg-orange'></div>";
							echo "<h3 class='card-title'>$i) $row->name ($row->category)</h3>";
							echo "</div>";
							echo "<div class='card-body'>";
							echo "<div class='table-responsive'>";
							echo "<table class='table table-hover table-outline table-vcenter text-nowrap card-table'><tbody>";

							echo "<thead>";
							echo "<tr><td>#</td><td>Name</td><td>Email</td><td>Amount Offered</td><td>Select</td></tr>";
							echo "</thead>";
							echo "<tbody>";
							while($rowt=$et->fetch_object()){
								$i2++;
								echo "<tr>";
								echo "<td>$i2</td>";
								echo "<td>$rowt->fname $rowt->lname</td>";
								echo "<td>$rowt->email</td>";
								echo "<td>$rowt->amt</td>";

								$bi_id=$row->bi_id;
								$cu_id=$rowt->cu_id;

								echo "<td><button type='button' onclick='accept1($bi_id,$cu_id);' class='btn btn-lime'><i class='fe fe-check'></i></button></td>";
								echo "</tr>";
							}

							echo "</tbody></table>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
						// echo "</tr>";
					}
				}
			}
			else{
				echo "<div class='col-md-6 col-xl-12'>";
				echo "<div class='card'>";
				echo "<div class='card-header'>";
				echo "<div class='card-status bg-orange'></div>";
				echo "<h3 class='card-title'>asdsa</h3>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
			}
		?>
		</div>
	</div>
</div>
<?php
	include "foot.php";
?>