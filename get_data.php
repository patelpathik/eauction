<?php
	include "conn.php";
	if(isset($_REQUEST['req']) && !empty($_REQUEST['req'])){
		$req=$_REQUEST['req'];
		if($req=="tbl_category"){
			$cu_id=$_REQUEST['cu_id'];
			$q1="select * from category where added_by='$cu_id'";
			$e1=$conn->query($q1);
			if($e1->num_rows > 0){
				$i=0;
				?>
					<thead>
						<tr>
							<th class="text-center w-1"><i class="icon-people"></i>#</th>
							<th>Category Name</th>
							<th class="text-center">Action</th>
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
								<div><input type="text" class="form-control" id="<?php echo "t_".$row->cat_id; ?>" value="<?php echo $row->category; ?>" required disabled></div>
							</td>
							<td class="text-center">
								<div id="<?php echo 'controls_'.$row->cat_id; ?>">
									<button type='button' id="<?php echo "e_".$row->cat_id; ?>" onclick="edit(this.id);" class='btn btn-green btn-sm'><i class='fe fe-edit-3'></i></button>
									<button type='button' id="<?php echo "d_".$row->cat_id; ?>" onclick="del(this.id);" class='btn btn-red btn-sm'><i class='fe fe-trash-2'></i></button>
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
		}
		else if($req=="manage_cat"){
			$type=$_REQUEST['type'];
			$q1="select * from category where status='$type' order by category";
			$e1=$conn->query($q1);
			if($e1->num_rows > 0){
				echo "<thead><tr>";
				echo "<th class='text-center w-1'><i class='icon-people'></i>#</th>";
				echo "<th>Category Name</th>";
				echo "<th class='text-center'>O / X</th>";
				echo "</tr></thead>";
				echo "<tbody>";
				$i=0;
				while($row=$e1->fetch_object()){
					$i++;
					echo "<tr>";
					echo "<td class='text-center'><div>$i</div></td>";
					echo "<td><div>$row->category</div></td>";
					echo "<td class='text-center'><div>";
					if($type=="1"){
						echo "<button type='button' id='$row->cat_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					else if($type=="0"){
						echo "<button type='button' id='$row->cat_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
					}
					else if($type=="-1"){
						echo "<button type='button' id='$row->cat_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
						echo "<button type='button' id='$row->cat_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					echo "</div></td>";
					echo "</tr>";
				}
				echo "</tbody>";
			}
			else{
				echo "<thead><tr>";
				echo "<th class='text-center w-1'>No entries to manage!</th>";
				echo "</tr></thead>";
			}
		}
		else if($req=="manage_pr"){
			$type=$_REQUEST['type'];
			$q1="select * from product p, category c, vendor v where p.cat_id=c.cat_id && p.added_by=v.ve_id && p.status='$type' order by p.name";
			$e1=$conn->query($q1);
			if($e1->num_rows > 0){
				echo "<thead><tr>";
				echo "<th class='text-center w-1'><i class='icon-people'></i>#</th>";
				echo "<th>Category</th>";
				echo "<th>Name</th>";
				echo "<th>Price</th>";
				echo "<th>Year</th>";
				echo "<th>Description</th>";
				echo "<th>Key Points</th>";
				echo "<th>Video URL</th>";
				echo "<th>Image</th>";
				echo "<th>Added By..</th>";
				echo "<th class='text-center w-1'>Status</th>";
				// echo "<th></th>";
				echo "</tr></thead>";
				echo "<tbody>";
				$i=0;
				while($row=$e1->fetch_object()){
					$i++;
					echo "<tr>";
					echo "<td class='text-center'><div>$i</div></td>";
					echo "<td><div>$row->category</div></td>";
					echo "<td><div>$row->name</div></td>";
					echo "<td><div>$row->price</div></td>";
					echo "<td><div>$row->mfg_yr</div></td>";
					echo "<td><div>$row->des</div></td>";
					echo "<td><div>$row->key_points</div></td>";
					echo "<td><div>$row->url</div></td>";
					echo "<td><div><img src='$row->img' height='35px' /></div></td>";
					echo "<td><div>$row->email</div></td>";
					echo "<td class='text-center'><div>";
					if($type=="1"){
						echo "<button type='button' id='$row->pr_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					else if($type=="0"){
						echo "<button type='button' id='$row->pr_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
					}
					else if($type=="-1"){
						echo "<button type='button' id='$row->pr_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
						echo "<button type='button' id='$row->pr_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					echo "</div></td>";
					echo "</tr>";
				}
				echo "</tbody>";
			}
			else{
				echo "<thead><tr>";
				echo "<th class='text-center w-1'>No entries to manage!</th>";
				echo "</tr></thead>";
			}
		}
		else if($req=="manage_cu"){
			$type=$_REQUEST['type'];
			echo $q1="select * from customer where status='$type' order by fname";
			$e1=$conn->query($q1);
			if($e1->num_rows > 0){
				echo "<thead><tr>";
				echo "<th class='text-center w-1'><i class='icon-people'></i>#</th>";
				echo "<th>F. Name</th>";
				echo "<th>L. Name</th>";
				echo "<th>Email</th>";
				echo "<th>D.O.B.</th>";
				echo "<th>Gender</th>";
				echo "<th>Mobile</th>";
				echo "<th>Addr.</th>";
				echo "<th class='text-center w-1'>Status</th>";
				// echo "<th></th>";
				echo "</tr></thead>";
				echo "<tbody>";
				$i=0;
				while($row=$e1->fetch_object()){
					$i++;
					echo "<tr>";
					echo "<td class='text-center'><div>$i</div></td>";
					echo "<td><div>$row->fname</div></td>";
					echo "<td><div>$row->lname</div></td>";
					echo "<td><div>$row->email</div></td>";
					echo "<td><div>$row->dob</div></td>";
					echo "<td><div>$row->gender</div></td>";
					echo "<td><div>$row->mobile</div></td>";
					echo "<td><div>$row->addr</div></td>";
					echo "<td class='text-center'><div>";
					if($type=="1"){
						echo "<button type='button' id='$row->cu_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					else if($type=="0"){
						echo "<button type='button' id='$row->cu_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
					}
					else if($type=="-1"){
						echo "<button type='button' id='$row->cu_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
						echo "<button type='button' id='$row->cu_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					echo "</div></td>";
					echo "</tr>";
				}
				echo "</tbody>";
			}
			else{
				echo "<thead><tr>";
				echo "<th class='text-center w-1'>No entries to manage!</th>";
				echo "</tr></thead>";
			}
		}
		else if($req=="manage_ve"){
			$type=$_REQUEST['type'];
			echo $q1="select * from vendor where status='$type' order by fname";
			$e1=$conn->query($q1);
			if($e1->num_rows > 0){
				echo "<thead><tr>";
				echo "<th class='text-center w-1'><i class='icon-people'></i>#</th>";
				echo "<th>F. Name</th>";
				echo "<th>L. Name</th>";
				echo "<th>Email</th>";
				echo "<th>D.O.B.</th>";
				echo "<th>Gender</th>";
				echo "<th>Mobile</th>";
				echo "<th>Addr.</th>";
				echo "<th class='text-center w-1'>Status</th>";
				// echo "<th></th>";
				echo "</tr></thead>";
				echo "<tbody>";
				$i=0;
				while($row=$e1->fetch_object()){
					$i++;
					echo "<tr>";
					echo "<td class='text-center'><div>$i</div></td>";
					echo "<td><div>$row->fname</div></td>";
					echo "<td><div>$row->lname</div></td>";
					echo "<td><div>$row->email</div></td>";
					echo "<td><div>$row->dob</div></td>";
					echo "<td><div>$row->gender</div></td>";
					echo "<td><div>$row->mobile</div></td>";
					echo "<td><div>$row->addr</div></td>";
					echo "<td class='text-center'><div>";
					if($type=="1"){
						echo "<button type='button' id='$row->ve_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					else if($type=="0"){
						echo "<button type='button' id='$row->ve_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
					}
					else if($type=="-1"){
						echo "<button type='button' id='$row->ve_id' onclick='accept(this.id);' class='btn btn-green btn-sm'><i class='fe fe-check'></i></button>&nbsp;";
						echo "<button type='button' id='$row->ve_id' onclick='reject(this.id);' class='btn btn-red btn-sm'><i class='fe fe-x'></i></button>";
					}
					echo "</div></td>";
					echo "</tr>";
				}
				echo "</tbody>";
			}
			else{
				echo "<thead><tr>";
				echo "<th class='text-center w-1'>No entries to manage!</th>";
				echo "</tr></thead>";
			}
		}
		else if($req=="pr_brief"){
			$pr_id=$_REQUEST['pr_id'];
			$q1="select * from category c, product p, bid_info b where p.pr_id='$pr_id' && p.pr_id=b.pr_id && c.cat_id=p.cat_id";
			$e1=$conn->query($q1);
			if($e1->num_rows > 0){
				while($row=$e1->fetch_object()){
					// print_r($row);
					echo "<tr colspan='2'><td align='center'><img src='$row->img' style='width:50%; height:auto;' /></td></tr>";
					echo "<tr><td>Categoty:</td><td>$row->category</td></tr>";
					echo "<tr><td>Name:</td><td>$row->name</td></tr>";
					echo "<tr><td>Base Price:</td><td><b>$row->price</b></td></tr>";
					echo "<tr><td>MFG/Production Year:</td><td>$row->mfg_yr</td></tr>";
					echo "<tr><td>Description:</td><td>$row->des</td></tr>";
					echo "<tr><td>Key Points:</td><td>$row->key_points</td></tr>";
					echo "<tr><td>Video URL:</td><td>$row->url</td></tr>";
					echo "<tr><td>Date Stated:</td><td>$row->start_date</td></tr>";
					echo "<tr><td>Last Date:</td><td>$row->end_date</td></tr>";
					$p=0;
					$p=$row->price;
					$p++;
					echo "<tr><td><input type='number' value='$p' id='mybidval' onchange='checkme($p,this.value);' min='$p' class='form-element' /></td><td><button class='btn btn-primary' onclick='addMyBid();'>Add My Bid</button></td></tr>";
				}
			}
		}
	}
?>