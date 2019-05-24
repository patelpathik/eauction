<?php
	include "head.php";

	// print_r($_SESSION);
?>
<script>
	$(document).ready(function(){
		$("#pr_info").hide();
	});
	function show_info(x,y){
		// alert(x);
		// alert(y);
		document.getElementById("bi_id").value=y;
		$.ajax({
			type: "GET",
			url: "get_data.php?req=pr_brief&pr_id="+x,
			success: function(data){
				$("#tbl_pr_info").html(data);
			}
		});
		$("#pr_info").fadeIn(500);
	}
	function addMyBid(){

		var cu_id=$("#uid").val();
		var amt=$("#mybidval").val();
		var bi_id=$("#bi_id").val();


		var url="upd_del.php?op=add_bid&cu_id="+cu_id+"&amt="+amt+"&bi_id="+bi_id;
		// alert(url);

		$.ajax({
			type: "GET",
			url: url,
			success: function(data){
				location.reload();
			}
		});
	}
	function checkme(x,y){
		if(y<x){
			return false;
		}
	}
</script>
<input type="hidden" id="bi_id" />
<input type="hidden" id="uid" value="<?php echo $_SESSION['uid']; ?>" />
<div class="col-lg-10 mx-auto my-md-5">

	<div class="col-xl-12" id="pr_info">
		<div class="card">
			<div class="card-header">
				<div class="card-status bg-orange"></div>
				<h3 class="card-title">Product Info. (<span id="pname"></span>)</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tbl_pr_info">
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-12" id="pr_list">
		<div class="card">
			<div class="card-header">
				<div class="card-status bg-blue"></div>
				<h3 class="card-title">Open products..</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover table-outline table-vcenter text-nowrap card-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Category</th>
								<th>Name</th>
								<th>Preview</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>!!Apply!!</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$uid=$_SESSION['uid'];
								$qone="SELECT * from category c, bid_info b inner join product p on b.pr_id=p.pr_id WHERE p.cat_id=c.cat_id && b.bi_id NOT IN (select bi_id from bids where cu_id='$uid')";
								$eone=$conn->query($qone);
								$i=0;
								while($r1=$eone->fetch_object()){
									$i++;
									echo "<tr>";
									echo "<td>$i</td>";
									echo "<td>$r1->category</td>";
									echo "<td>$r1->name</td>";
									echo "<td><a href='$r1->img' target='_blank'><img src='$r1->img' width='35px' /></a></td>";
									echo "<td>$r1->start_date</td>";
									echo "<td>$r1->end_date</td>";
									$sdate=strtotime($r1->start_date);
									$edate=strtotime($r1->end_date);
									$cdate=strtotime(date('Y-m-d'));
									if(($cdate>=$sdate) && ($cdate<=$edate)){
										$temp=$r1->bi_id;
										echo "<td><button class='btn btn-teal btn-sm' id='$r1->pr_id' onclick='show_info(this.id,$temp);'>View/Apply</button></td>";
									}
									else{
										echo "<td><label class='btn btn-cyan btn-sm'>View/Apply</label></td>";
									}
									echo "</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include "foot.php";
?>