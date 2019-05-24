<?php
    include "head.php";
?>
<div class="my-3 my-md-5">
	<div class="container">
		<div class="row">

		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Bids Results</h3>
				</div>
			</div>
		</div>

		
		<div class="col-xl-12">
				<div class="card">
					<div class="card-header">
						<div class="card-status bg-orange"></div>
						<h3 class="card-title"><?php if($_SESSION['utype']=="c")echo "Check your bid result"; else echo "Lucky Users!"; ?></h3>
						<div class="card-options">
							<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tbl_pending">
                            <?php
                                $u=$_SESSION['utype'];
                                if($u=="c"){
                                    $cu_id=$_SESSION['uid'];
                                    $q1="select * from product p, category cat, bid_info b, customer c where b.cu_id=c.cu_id && b.cu_id='$cu_id' && b.pr_id=p.pr_id && p.cat_id=cat.cat_id";
                                    $e1=$conn->query($q1);
                                    if($e1->num_rows > 0){
                                        echo "<thead>";
                                        while($row=$e1->fetch_object()){
                                            $cu_id=$row->cu_id;
                                            $bi_id=$row->bi_id;
                                            $qt="select * from bids where bi_id='$bi_id' && cu_id='$cu_id'";
                                            $et=$conn->query($qt);
                                            $temp=$et->fetch_object();
                                            echo "<tr><th><h4>You have won: $row->name @$temp->amt</h4></th></tr>";
                                        }
                                        echo "<tr><th>Out admin team will contact you shortly</th></tr>";
                                        echo "</thead>";
                                    }
                                }
                                else{
                                    $q1="select * from product p, category cat, bid_info b, customer c where b.cu_id=c.cu_id && b.cu_id!='-1' && b.pr_id=p.pr_id && p.cat_id=cat.cat_id";
                                    $e1=$conn->query($q1);
                                    if($e1->num_rows > 0){
                                        echo "<thead><tr><th>#</th><th>Customer Name</th><th>Email</th><th>Product Name</th><th>Amount</th></tr></thead>";
                                        $i=0;
                                        while($row=$e1->fetch_object()){
                                            $i++;
                                            $cu_id=$row->cu_id;
                                            $bi_id=$row->bi_id;
                                            $qt="select * from bids where bi_id='$bi_id' && cu_id='$cu_id'";
                                            $et=$conn->query($qt);
                                            $temp=$et->fetch_object();
                                            echo "<tr><td>$i</td><td>$row->fname $row->lname</td><td>$row->email</td><td>$row->name($row->category)</td><td>$temp->amt</td></tr>";
                                        }
                                    }
                                }
                            ?>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<?php
    include "foot.php";
?>