<?php
	include "head.php";
	
	// print_r($_REQUEST);
	// print_r($_SESSION);
	if(!isset($_SESSION['flagtemp'])){
		$_SESSION['flagtemp']="false";
	}
	
	if (isset($_REQUEST['add_bid'])) {
		$id=$_REQUEST['add_bid'];
		$q2="select * from product p, category c where p.cat_id = c.cat_id && p.pr_id='$id'";
		$e2=$conn->query($q2);
		$row2=$e2->fetch_object();
		$_SESSION['pr_id']=$row2->pr_id;
		print_r($row2);
		$_SESSION['flagtemp']="true";
	}
	else if(isset($_REQUEST['cancel'])){
		$_SESSION['flagtemp']="fasle";
	}
	else if(isset($_REQUEST['save_product'])){
		$pr_id=$_SESSION['pr_id'];
		$sdt=$_REQUEST['sdt'];
		$edt=$_REQUEST['edt'];

		$q1="insert into bid_info (pr_id,start_date,end_date) values ('$pr_id','$sdt','$edt')";
		$e1=$conn->query($q1);

		$_SESSION['flagtemp']="false";
		$_SESSION['pr_id']=null;
		// header("location:bids_open.php?msg=1");
	}
?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="/css/result-light.css"> -->
<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<script>
	$(document).ready(function(){
		$( "#sdt" ).datepicker({ minDate: 0, maxDate: "+1M +10D", dateFormat: 'yy-mm-dd' });
		$( "#edt" ).datepicker({ minDate: "+15D", maxDate: "+1M +10D", dateFormat: 'yy-mm-dd' });

		// var date = $('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();

		$("#sdt").change(function(){
			// var x=$("#sdt").val();
			// $( "#edt" ).datepicker({ minDate: x, maxDate: "0 +10D" });


			var tt = document.getElementById('sdt').value;

			var date = new Date(tt);
			var newdate = new Date(date);

			newdate.setDate(newdate.getDate() + 10);
			
			var dd = newdate.getDate();
			var mm = newdate.getMonth() + 1;
			var y = newdate.getFullYear();

			var someFormattedDate = mm + '/' + dd + '/' + y;
			document.getElementById('edt').value = someFormattedDate;

			$( "#edt" ).datepicker({ minDate: tt, maxDate: someFormattedDate, dateFormat: 'yy-mm-dd' });
		});
	});
</script>

<div class="col-lg-10 mx-auto my-md-5">
	<form method="POST" enctype="multipart/form-data" <?php if($_SESSION['flagtemp']=="true"){ echo "style='display:block;'";} else echo "style='display:none;'"; ?>>
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Add Product</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
					<!-- <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Category: <?php echo $row2->category; ?></label>
							<label class="form-label">Name: <?php echo $row2->name; ?></label>
							<label class="form-label">Description: <?php echo $row2->des; ?></label>
							<label class="form-label">Price: <?php echo $row2->price; ?></label>
						</div>
					</div>
					<!-- <div class="col-md-12">
						<div class="form-group">
						</div>
					</div> -->
					<div class="col-md-6 mx-auto">
						<div class="form-group">
							<label class="form-label">Preview:</label>
							<label>&nbsp;</label>
							<img src="<?php echo $row2->img; ?>" id="cur_img" class="avatar avatar-xl" style="border-radius:10%;width:100px; height:auto;" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Select Start Date</label>
							<input type="text" class="form-control" id="sdt" name="sdt" placeholder="dd/mm/yyyy" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Select End Date</label>
							<input type="text" class="form-control" id="edt" name="edt" placeholder="dd/mm/yyyy" required>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<div class="d-flex">
					<input type="submit" name="cancel" class="btn btn-secondary" value="Cancel" formnovalidate />
					<input type="submit" class="btn btn-primary ml-auto" name="save_product" value="Add Product to bid">
				</div>
			</div>
		</form>
	</div>

	<div class="card" <?php if($_SESSION['flagtemp']=="true"){ echo "style='display:none;'";} else echo "style='display:block;'"; ?>>
		<div class="card-header">
			<h3 class="card-title">Open bids for product</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				<!-- <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a> -->
			</div>
		</div>
		<div class="card-body">
			<form method="POST">
				<div class="table-responsive">
					<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tbl_product">
					<?php
						$uid=$_SESSION['uid'];
						$q1="select p.pr_id,p.cat_id,p.name,p.price,p.mfg_yr,p.des,p.key_points,p.url,p.img,p.added_by,p.status,c.cat_id,c.category from product p, category c where p.cat_id=c.cat_id && p.added_by='$uid' && p.status='1' && p.pr_id NOT IN (select pr_id from bid_info)";
						$e1=$conn->query($q1);
						if($e1->num_rows > 0){
							$i=0;
							?>
								<thead>
									<tr>
										<th class="text-center w-1"><i class="icon-people"></i>#</th>
										<th>Category</th>
										<th>Name</th>
										<th>Price</th>
										<th>Year</th>
										<th>Description</th>
										<th>Key Points</th>
										<th>Video URL</th>
										<th>Image</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
							<?php
							while($row=$e1->fetch_object()){
								$i++;
								?>
									<tr>
									<td class="text-center">
											<div><?php echo $i; ?></div>
										</td>
										<td>
											<div><input type="text" class="form-control" id="<?php echo "t_".$row->pr_id; ?>" value="<?php echo $row->category; ?>" required disabled></div>
										</td>
										<td>
											<div><?php echo $row->name; ?></div>
										</td>
										<td>
											<div><?php echo $row->price; ?></div>
										</td>
										<td>
											<div><?php echo $row->mfg_yr; ?></div>
										</td>
										<td>
											<div><?php echo $row->des; ?></div>
										</td>
										<td>
											<div><?php echo $row->key_points; ?></div>
										</td>
										<td>
											<div><?php echo $row->url; ?></div>
										</td>
										<td>
											<div><img src="<?php echo $row->img; ?>" height="35px" /></div>
										</td>
										<td class="text-center">
											<div id="<?php echo 'controls_'.$row->pr_id; ?>">
												<button type='submit' name="add_bid" value="<?php echo $row->pr_id; ?>" class='btn btn-info btn-sm'><i class='fe fe-plus'></i></button>
											</div>
										</td>
									</tr>
								<?php
							}
							?>
								</tbody>
							<?php
						}
						else{
							?>
							<thead>
								<tr>
									<th class="text-center w-1">No entries to manage!</th>
								</tr>
							</thead>
							<?php
						}
					?>
					</table>
				</div>
			</form>
		</div>
	</div>

	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<div class="card-status bg-green"></div>
				<h3 class="card-title">Open products..</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tbl_accepted">
						<thead>
							<tr>
								<th>#</th>
								<th>Category</th>
								<th>Name</th>
								<th>Preview</th>
								<th>Start Date</th>
								<th>End Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$uid=$_SESSION['uid'];
								$qone="SELECT * from category c, bid_info b inner join product p on b.pr_id=p.pr_id WHERE p.added_by='$uid' && p.cat_id=c.cat_id";
								$eone=$conn->query($qone);
								$i=0;
								while($r1=$eone->fetch_object()){
									$i++;
									echo "<tr>";
									echo "<td>$i</td>";
									echo "<td>$r1->category</td>";
									echo "<td>$r1->name</td>";
									echo "<td><img src='$r1->img' width='35px' /></td>";
									echo "<td>$r1->start_date</td>";
									echo "<td>$r1->end_date</td>";
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