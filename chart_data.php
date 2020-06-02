<?php

	include "conn.php";
	// print_r($_REQUEST);

	function echo_chart($labels,$ds){

		$labels_data="[";
		foreach($labels as $l){
			$labels_data += "'".$l."'";
		}
		$labels_data += "]";
		str_replace("''","','",$labels_data);

		$ds_data="[";
		foreach($ds as $d, $labels as $l, $bgcol as $bg, $bdcol as $bd, $bdw as $bw, $datas as $data){
			$ds_data += "label: ";
		}
		$labels_data += "]";
		str_replace("''","','",$ds_data);

		$head="<head><title>Bar Chart</title><script src='https://www.chartjs.org/dist/2.8.0/Chart.min.js' type='5c1ca14605062da52f697efb-text/javascript'></script><script src='https://www.chartjs.org/samples/latest/utils.js' type='5c1ca14605062da52f697efb-text/javascript'></script><style>canvas {-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;}</style></head>";

		$body = "<body><div id='container' style='width: 75%;'><canvas id='canvas'></canvas></div>";

		$body += "";
            <script type='5c1ca14605062da52f697efb-text/javascript'>
                var barChartData = {
                    labels: $labels_data,
                    datasets: [{
                        label: 'Vendors',
                        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.red,
                        borderWidth: 1,
                        data: [
                            12,24,56,12,345,78,43,87,90,21,22,66
                        ]
                    }, {
                        label: 'Customers',
                        backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                        borderColor: window.chartColors.blue,
                        borderWidth: 1,
                        data: [
                            21,54,98,345,93,03,6,15,72,39,15,83
                        ]
                    }]

                };

                window.onload = function() {
                    var ctx = document.getElementById('canvas').getContext('2d');
                    window.myBar = new Chart(ctx, {
                        type: 'bar',
                        data: barChartData,
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'New Users in past year'
                            }
                        }
                    });

                };

                document.getElementById('randomizeData').addEventListener('click', function() {
                    var zero = Math.random() < 0.2 ? true : false;
                    barChartData.datasets.forEach(function(dataset) {
                        dataset.data = dataset.data.map(function() {
                            return zero ? 0.0 : randomScalingFactor();
                        });

                    });
                    window.myBar.update();
                });

                var colorNames = Object.keys(window.chartColors);
                document.getElementById('addDataset').addEventListener('click', function() {
                    var colorName = colorNames[barChartData.datasets.length % colorNames.length];
                    var dsColor = window.chartColors[colorName];
                    var newDataset = {
                        label: 'Dataset ' + (barChartData.datasets.length + 1),
                        backgroundColor: color(dsColor).alpha(0.5).rgbString(),
                        borderColor: dsColor,
                        borderWidth: 1,
                        data: []
                    };

                    for (var index = 0; index < barChartData.labels.length; ++index) {
                        newDataset.data.push(randomScalingFactor());
                    }

                    barChartData.datasets.push(newDataset);
                    window.myBar.update();
                });

                document.getElementById('addData').addEventListener('click', function() {
                    if (barChartData.datasets.length > 0) {
                        var month = MONTHS[barChartData.labels.length % MONTHS.length];
                        barChartData.labels.push(month);

                        for (var index = 0; index < barChartData.datasets.length; ++index) {
                            // window.myBar.addData(randomScalingFactor(), index);
                            barChartData.datasets[index].data.push(randomScalingFactor());
                        }

                        window.myBar.update();
                    }
                });

                document.getElementById('removeDataset').addEventListener('click', function() {
                    barChartData.datasets.pop();
                    window.myBar.update();
                });

                document.getElementById('removeData').addEventListener('click', function() {
                    barChartData.labels.splice(-1, 1); // remove the label first

                    barChartData.datasets.forEach(function(dataset) {
                        dataset.data.pop();
                    });

                    window.myBar.update();
                });
            </script>

            <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="5c1ca14605062da52f697efb-|49" defer=""></script>
        </body>

        </html>


    }

    if(isset($_REQUEST['req']) && !empty($_REQUEST['req'])){
        $req=$_REQUEST['req'];
        if($req=="chart"){
            if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
                $type=$_REQUEST['type'];
                if($type=="users"){
                    $qc_a="select count(*)'total' from customer where status='1'";
                    $ec_a=$conn->query($qc_a);
                    $dc_a=$ec_a->fetch_object();
                    $a=$dc_a->total;

                    $qc_p="select count(*)'total' from customer where status='-1'";
                    $ec_p=$conn->query($qc_p);
                    $dc_p=$ec_p->fetch_object();
                    $p=$dc_p->total;

                    $qc_r="select count(*)'total' from customer where status='0'";
                    $ec_r=$conn->query($qc_r);
                    $dc_r=$ec_r->fetch_object();
                    $r=$dc_r->total;

                    $data=array($a,$r,$p);
                }
                else if($type=="products"){
                    //
                }
            }
        }
    }

?>