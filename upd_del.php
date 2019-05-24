<?php
	include "conn.php";
	if(isset($_REQUEST['op']) && !empty($_REQUEST['op'])){
		$op=$_REQUEST['op'];
		if($op=="cat_upd"){
			$v=$_REQUEST['v'];
			$cat_id=$_REQUEST['cat_id'];
			$qc="select * from category where category='$v'";
			$ec=$conn->query($qc);
			if($ec->num_rows == 0){
				$q1="update category set category='$v' where cat_id='$cat_id'";
				$e1=$conn->query($q1);
			}
		}
		else if($op=="cat_del"){
			$cat_id=$_REQUEST['cat_id'];
			$q1="delete from category where cat_id='$cat_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="cat_accept"){
			$cat_id=$_REQUEST['cat_id'];
			$q1="update category set status='1' where cat_id='$cat_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="cat_reject"){
			$cat_id=$_REQUEST['cat_id'];
			$q1="update category set status='0' where cat_id='$cat_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="pr_del"){
			$pr_id=$_REQUEST['pr_id'];
			echo $q1="delete from product where pr_id='$pr_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="pr_accept"){
			$pr_id=$_REQUEST['pr_id'];
			$q1="update product set status='1' where pr_id='$pr_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="pr_reject"){
			$pr_id=$_REQUEST['pr_id'];
			$q1="update product set status='0' where pr_id='$pr_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="cu_accept"){
			$cu_id=$_REQUEST['cu_id'];
			$q1="update customer set status='1' where cu_id='$cu_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="cu_reject"){
			$cu_id=$_REQUEST['cu_id'];
			$q1="update customer set status='0' where cu_id='$cu_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="ve_accept"){
			$ve_id=$_REQUEST['ve_id'];
			$q1="update vendor set status='1' where ve_id='$ve_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="ve_reject"){
			$ve_id=$_REQUEST['ve_id'];
			$q1="update vendor set status='0' where ve_id='$ve_id'";
			$e1=$conn->query($q1);
		}
		else if($op=="add_bid"){
			$cu_id=$_REQUEST['cu_id'];
			$amt=$_REQUEST['amt'];
			$bi_id=$_REQUEST['bi_id'];

			echo $q1="insert into bids (cu_id,amt,bi_id) values ('$cu_id','$amt','$bi_id')";
			$e1=$conn->query($q1);
		}
		else if($op=="accept_bid"){
			$bi_id=$_REQUEST['bi_id'];
			$cu_id=$_REQUEST['cu_id'];
			echo $q1="update bid_info set cu_id='$cu_id' where bi_id='$bi_id'";
			$e1=$conn->query($q1);
		}
	}
?>