<?php
	include "head.php";

?>
<script>
	require(['jquery', 'selectize'], function($, selectize) {
		$(document).ready(function() {
			$('#select-category').selectize({});
		});
	});
	$(document).ready(function() {
		$("#ta2").on('change keyup paste', function() {
			$("#len2").html($("#ta2").val().length);
			var l=$("#ta2").val().length;
			if(l == 50){
				$("#ta2").addClass("len_max");
			}
			else{
				$("#ta2").removeClass("len_max");
			}
		});

		$("#ta1").on('change keyup paste', function() {
			$("#len1").html($("#ta1").val().length);
			var l=$("#ta1").val().length;
			if(l == 100){
				$("#ta1").addClass("len_max");
			}
			else{
				$("#ta1").removeClass("len_max");
			}
		});

		$("#img").change(function() {
			readURL(this);
		});
	});
	function readURL(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#cur_img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	function chk_yr(yr) {
		if (yr > 2019) {
			alert("Please give proper year!");
			$("#yr").val("2019");
			return false;
		}
	}

	function load_data(){
		location.reload();
	}
	
	function del(pr_id) {
		console.log(pr_id);

		// hide controls
		$("#e_" + pr_id.substr(2)).fadeOut(500);
		$("#" + pr_id).fadeOut(500);

		var c_data = "<b style='color:red; text-transform:uppercase;'>Confirm delete?</b><br><button type='button' id='" + pr_id + "' onclick='del2(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button> <button type='button' id='' onclick='load_data();' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
		$("#controls_" + pr_id.substr(2)).html(c_data);
	}
	function del2(pr_id) {
		console.log("DEL:" + pr_id.substr(2));
		var id = pr_id.substr(2);

		var url = "upd_del.php?op=pr_del&pr_id=" + id;
		alert(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(data) {
				load_data();
			}
		})
	}
</script>
<?php
	
	// print_r($_REQUEST);
	if($_SESSION['edit_mode']=="0" || !isset($_SESSION['edit_mode'])){
		$pname="";
		$price="";
		$mfg_yr="";
		$des="";
		$keyp="";
		$url="";
		$img="";
	}

	if (isset($_REQUEST['add_product'])) {

		$cat = $_REQUEST['cat'];
		$pname = $_REQUEST['p_name'];
		$price = $_REQUEST['price'];
		$yr = $_REQUEST['yr'];
		$des = $_REQUEST['des'];
		$key = $_REQUEST['key'];
		$url = $_REQUEST['url'];

		$qc="select * from product where name='$pname'";
		$ec=$conn->query($qc);
		// print_r($ec);
		if($ec->num_rows == 0){
			$target_dir = "images/";
			$target_file = $target_dir . basename($_FILES["img"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			$check = getimagesize($_FILES["img"]["tmp_name"]);
			if ($check !== false) {
				// echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				// echo "File is not an image.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			} else {
				$uid=$_SESSION['uid'];
				$temp = explode(".", $_FILES["img"]["name"]);
				$newfilename = $target_dir . round(microtime(true)) . '.' . end($temp);
				if (move_uploaded_file($_FILES["img"]["tmp_name"], $newfilename)) {
					$q1 = "insert into product (cat_id,name,price,mfg_yr,des,key_points,url,img,added_by) values ('$cat','$pname','$price','$yr','$des','$key','$url','$newfilename','$uid')";
					$e1 = $conn->query($q1);
				}
			}
		}
		else{
			js_alert("Product \'$pname\' already added!");
		}
	}
	// else if (isset($_REQUEST['delete'])){
	// 	$delete=$_REQUEST['delete'];
	// 	$_SESSION['pr_id']=$delete;
	// 	$_SESSION['del_chk']=1;
	// }
	else if (isset($_REQUEST['edit'])){
		$edit=$_REQUEST['edit'];
		$q1="select * from product where pr_id='$edit'";
		$e1=$conn->query($q1);
		$row1=$e1->fetch_object();
		$_SESSION['edit_mode']=1;
		$_SESSION['pr_id']=$edit;
		print_r($row1);

		$pname=$row1->name;
		$price=$row1->price;
		$mfg_yr=$row1->mfg_yr;
		$des=$row1->mfg_yr;
		$keyp=$row1->key_points;
		$url=$row1->url;
		$img=$row1->img;
	}
	else if(isset($_REQUEST['edit_product'])){
		$cat = $_REQUEST['cat'];
		$pname = $_REQUEST['p_name'];
		$price = $_REQUEST['price'];
		$yr = $_REQUEST['yr'];
		$des = $_REQUEST['des'];
		$key = $_REQUEST['key'];
		$url = $_REQUEST['url'];

		$pr_id=$_SESSION['pr_id'];

		if(isset($_REQUEST['img'])){

			$target_dir = "images/";
			$target_file = $target_dir . basename($_FILES["img"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			$check = getimagesize($_FILES["img"]["tmp_name"]);
			if ($check !== false) {
				// echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				// echo "File is not an image.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			} else {
				$temp = explode(".", $_FILES["img"]["name"]);
				$fn="select * from product where pr_id='$pr_id'";
				$efn=$conn->query($fn);
				$temp2=$efn->fetch_object();
				$oldfilename=$temp2->img;
				$newfilename = $target_dir . round(microtime(true)) . '.' . end($temp);
				$_SESSION['nfn']=$newfilename;
				$_SESSION['nfn_f']=1;
				$x=unlink($oldfilename);
				// print_r($x);
				$temp="";
				move_uploaded_file($_FILES["img"]["tmp_name"], $newfilename);
			}
		}
		$p="";
		if($_SESSION['nfn_f']==1){
			$x=$_SESSION['nfn'];
			$p=",img='$x'";
		}
		$q1 = "update product set cat_id='$cat',name='$pname',price='$price',mfg_yr='$yr',des='$des',key_points='$key',url='$url'".$p." where pr_id='$pr_id'";
		$e1 = $conn->query($q1);
		
		$_SESSION['edit_mode']=0;
		$_SESSION['pr_id']=null;
		$_SESSION['nfn_f']=null;
		$_SESSION['nfn']=null;
	}
	else{
		$_SESSION['edit_mode']=0;
	}
?>

<div class="col-lg-10 mx-auto my-md-5" >
	<form method="POST" enctype="multipart/form-data" >
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
					<div class="col-md-3">
						<div class="form-group">
							<label class="form-label">Select Category</label>
							<select name="cat" id="select-category" class="form-control custom-select" required>
								<?php
								$qc = "select * from category where status='1' order by category";
								$ec = $conn->query($qc);
								if ($ec->num_rows > 0) {
									while ($r = $ec->fetch_object()) {
										$s1="";
										if($r->cat_id == $row1->cat_id){
											$s1="selected";
										}
										echo "<option value='$r->cat_id' $s1>$r->category</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="form-label">Product Name</label>
							<input type="text" value="<?php echo $pname; ?>" name="p_name" class="form-control" placeholder="Sachins' bat" required>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="form-label">Desired Price (INR)</label>
							<input type="number" value="<?php echo $price; ?>" name="price" class="form-control" min="1" placeholder="300" required>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="form-label">Production/ MFG Year</label>
							<input type="number" value="<?php echo $mfg_yr; ?>" name="yr" class="form-control" id="yr" min="1" onchange="chk_yr(this.value);" placeholder="1997" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Description <span class="form-label-small"><span id="len1">0</span>/100</span></label>
							<textarea class="form-control" name="des" rows="3" maxlength="100" id="ta1" placeholder="Content.." required><?php echo $des; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Key Points/Highlighters <span class="form-label-small"><span id="len2">0</span>/50</span></label>
							<textarea class="form-control" name="key" rows="3" maxlength="50" id="ta2" placeholder="Content.." required><?php echo $keyp; ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Video URL</label>
							<div class="input-group">
								<input type="text" name="url" value="<?php echo $url; ?>" class="form-control" placeholder="https://youtu.be/xyz123" required>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-label">Upload Image</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="img" id="img" <?php if($_SESSION['edit_mode']==1){}else{ echo "required";} ?>>
								<label class="custom-file-label">Choose file</label>
							</div>
						</div>
					</div>
					<div class="col-md-3 mx-auto">
						<div class="form-group">
							<!-- <label class="form-label">Current Image</label> -->
							<label>&nbsp;</label>
							<img src="<?php echo $img; ?>" id="cur_img" class="avatar avatar-xl" style="border-radius:10%;width:100%; height:auto;" />
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<div class="d-flex">
					<input type="reset" class="btn btn-secondary" value="Cancel" />
					<?php
						if($_SESSION['edit_mode']==1){
							?>
							<input type="submit" class="btn btn-primary ml-auto" id="edit_product" name="edit_product" value="Update Details">
							<?php
						}
						else{
							?>
							<input type="submit" class="btn btn-primary ml-auto" id="add_product" name="add_product" value="Add Product">
							<?php
						}
					?>

					<!-- <div id="edit_btn"></div> -->
				</div>
			</div>
	</form>
</div>

<div class="card">
	<div class="card-header">
		<h3 class="card-title">Manage Product(s)</h3>
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
					$q1="select p.pr_id,p.cat_id,p.name,p.price,p.mfg_yr,p.des,p.key_points,p.url,p.img,p.added_by,p.status,c.cat_id,c.category from product p, category c where p.cat_id=c.cat_id && p.added_by='$uid'";
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
									<td>
										<div><?php echo $row->status; ?></div>
									</td>
									<td class="text-center">
										<div id="<?php echo 'controls_'.$row->pr_id; ?>">
											<button type='submit' name="edit" value="<?php echo $row->pr_id; ?>" class='btn btn-green btn-sm'><i class='fe fe-edit-3'></i></button>
											<button type='button' id="<?php echo "d_".$row->pr_id; ?>" onclick="del(this.id);" class='btn btn-red btn-sm'><i class='fe fe-trash-2'></i></button>
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
</div>

<?php
	include "foot.php";
?> 