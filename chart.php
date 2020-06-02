<?php
	include "head.php";
?>
<script>
	$(document).ready(function() {
		load_data();
	});

	function load_data() {

		var url="chart_data.php?req=chart&type=users";
		// alert(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(data) {
				$("#tbl_pending").html(data);
			}
		});

		var url="chart_data.php?req=chart&type=products";
		// alert(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(data) {
				$("#tbl_accepted").html(data);
			}
		});

	}

	function accept(cat_id){
		var url="upd_del.php?op=cat_accept&cat_id="+cat_id;
		// alert(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(data){
				load_data();
			}
		});
	}

	function reject(cat_id){
		var url="upd_del.php?op=cat_reject&cat_id="+cat_id;
		// alert(url);
		$.ajax({
			type: "GET",
			url: url,
			success: function(data){
				load_data();
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
					<h3 class="card-title">Chart</h3>
				</div>
			</div>
		</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<div class="card-status bg-green"></div>
						<h3 class="card-title">Accepted</h3>
						<div class="card-options">
							<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
							<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-outline table-vcenter text-nowrap card-table" id="tbl_accepted">
							</table>
						</div>
					</div>
				</div>
			</div>


			<div class="col-md-6">
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