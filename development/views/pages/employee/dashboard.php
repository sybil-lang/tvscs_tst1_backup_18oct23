<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="employee_header.php" clickstream="dashboard" login_required="true" force_https="true" />
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$contact_id=$CI->session->getProfileData("c_id");

$employee_code=$CI->session->getProfileData("login");
$fname=$CI->session->getProfileData("first_name");

$lname=$CI->session->getProfileData("last_name");

$name = ucfirst($fname)." ".ucfirst($lname);

$CI->load->helper('report');

checkCustomerType('internal employee');
?>
	

	<style type="text/css">
		/* ======================================================================= */
		/* Server Statistics */
		.well.widget-pie-charts .box {
			margin-bottom: -20px;
		}

		/* ======================================================================= */
		/* Why AdminFlare */
		#why-adminflare ul {
			position: relative;
			padding: 0 10px;
			margin: 0 -10px;
		}

		#why-adminflare ul:nth-child(2n) {
			background: rgba(0, 0, 0, 0.02);
		}

		#why-adminflare li {
			padding: 8px 10px;
			list-style: none;
			font-size: 14px;
			padding-left: 23px;
		}

		#why-adminflare li i {
			color: #666;
			font-size: 14px;
			margin: 3px 0 0 -23px;
			position: absolute;
		}


		/* ======================================================================= */
		/* Supported Browsers */
		#supported-browsers header { color: #666; display: block; font-size: 14px; }
			
		#supported-browsers header strong { font-size: 18px; }

		#supported-browsers .span10 { margin-bottom: -15px; text-align: center; }

		#supported-browsers .span10 div {
			margin-bottom: 15px;
			margin-right: 15px;
			display: inline-block;
			width: 120px;
		}

		#supported-browsers .span10 div:last-child { margin-right: 0; }

		#supported-browsers .span10 img { height: 40px; width: 40px; }

		#supported-browsers .span10 span { line-height: 40px; font-size: 14px; font-weight: 600; }
		
		@media (max-width: 767px) {
			#supported-browsers header { text-align: center; margin-bottom: 20px; }
		}

		/* ======================================================================= */
		/* Status panel */
		.status-example { line-height: 0; position:relative; top: 22px }
	</style>
		<link rel="stylesheet" href="/euf/assets/themes/standard/css/adminflare.css" />

	   <link href="/euf/assets/themes/standard/css/font-awesome-home.css" rel="stylesheet" />       
	<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">
<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery.easypiechart.js"></script>
<link rel="stylesheet"type="text/css" href="/euf/assets/themes/standard/css/jquery.easy-pie-chart.css">

<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"  rel="stylesheet" >
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>


	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script type="text/javascript">
		var 	incidents_pie;
		$(document).ready(function () {
			//$('a[rel=tooltip]').tooltip();

			// Easy Pie Charts
			var easyPieChartDefaults = {
				animate: 2000,
				scaleColor: false,
				lineWidth: 12,
				lineCap: 'square',
				size: 100,
				trackColor: '#e5e5e5'
			}
			//$('.chart').data('easyPieChart').update(40);
			$('#easy-pie-chart-1').easyPieChart($.extend({}, easyPieChartDefaults, {
				barColor: '#3da0ea'
			}));
			$('#easy-pie-chart-2').easyPieChart($.extend({}, easyPieChartDefaults, {
				barColor: '#e7912a'
			}));
			$('#easy-pie-chart-3').easyPieChart($.extend({}, easyPieChartDefaults, {
				barColor: '#bacf0b'
			}));
		/*	$('#easy-pie-chart-4').easyPieChart($.extend({}, easyPieChartDefaults, {
				barColor: '#4ec9ce'
			}));*/
			$('#easy-pie-chart-5').easyPieChart($.extend({}, easyPieChartDefaults, {
				barColor: '#ec7337'
			}));
			$('#easy-pie-chart-6').easyPieChart($.extend({}, easyPieChartDefaults, {
				barColor: '#f377ab'
			}));
			
			
			//Highcharts.chart('visits-chart', {
			 incidents_pie = {
				chart: {
						renderTo: 'visits-chart',
						type: 'pie',
						options3d: {
							enabled: true,
							alpha: 45,
							beta: 0
						}
					},
					title: {
						text: 'Total Incidents'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							depth: 35,
							dataLabels: {
								enabled: true,
								format: '{point.name}'
							}
						}
					},
					series: [{}]
			};
				//});
			// Comments Tab
			$('.comment-remove').click(function () {
				bootbox.confirm("Are you sure?", function (result) {
					alert("Confirm result: " + result);
				});
				return false;
			});
			// New Users Tab
		//	$('#tab-users a').tooltip();
		});
	</script>

	<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>
	<!-- Page content
		================================================== -->
	<section class="container">

		<!-- Server statistics
			================================================== -->
		<section class="row-fluid">
			<div class="well widget-pie-charts">
				<h3 class="box-header">
					Employee statictics
				</h3>
				<div class="box no-border non-collapsible">
					<div class="span2 pie-chart">
						<div id="easy-pie-chart-1" data-percent="58">
							<span id="pie1"></span>
						</div>
						<div class="caption">
							New
						</div>
					</div>
					
					<div class="span2 pie-chart">
						<div id="easy-pie-chart-2" data-percent="43">
							<span id="pie2"></span>
						</div>
						<div class="caption">
							Logged In
						</div>
					</div>

					<div class="span2 pie-chart">
						<div id="easy-pie-chart-3" data-percent="91">
							<span id="pie3"></span>
						</div>
						<div class="caption">
							Response Awaited
						</div>
					</div>



					<div class="span2 pie-chart">
						<div id="easy-pie-chart-5" data-percent="35">
							<span id="pie5"></span>
						</div>
						<div class="caption">
							Closed
						</div>
					</div>

					<div class="span2 pie-chart">
						<div id="easy-pie-chart-6" data-percent="77">
							77%
						</div>
						<div class="caption">
							New Leads
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- / Server statistics -->

		<!-- ================================================== -->
		<section class="row-fluid">
		
			<!-- Daily visits chart
				================================================== -->
			<div class="span8">
				<h3 class="box-header">
					<i class="fa fa-clock-o" aria-hidden="true"></i>
					Incidents chart
				</h3>

				<div class="box">
					<div id="visits-chart"></div>
				</div>
			</div>
			<!-- / Daily visits chart -->
			
			<!-- Daily statistics
				================================================== -->
			<div id="counters" class="span4">
				
			</div>
			<!-- / Daily statistics -->
		</section>

		<!--=============================================================-->
		<section class="row-fluid">
			
			<!-- Support tickets
				================================================== -->
			<div class="span12">
				<h3 class="box-header">
					<a class="rn_Questions" href="/app/employee/account/questions/list#rn:session#"><i class="fa fa-bullhorn" aria-hidden="true"></i> #rn:msg:MY_SUPPORT_QUESTIONS_LBL#</a>
				</h3>
				<div class="box widget-support-tickets">
					<table id="support_incident" class="display" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Incident ID</th>
								<th>Reference #</th>
								<th>Status</th>
								<th>Subject</th>
								<th>Date Created</th>
							</tr>
						</thead>
					
					</table>

					<div class="widget-actions">
						<a href="/app/employee/account/questions/list#rn:session#" class="btn btn-mini">#rn:msg:SEE_ALL_MY_SUPPORT_QUESTIONS_LBL#</a>
					</div>
				</div>
			</div>
			<!-- / Support tickets -->

			
		</section>

		
		
	</section>
<script type="text/javascript">
$(document).ready(function () {
		$.ajax({
							 url: "/cc/EmployeeCustom/getEmployeePieData/",
							dataType: "json",
							method: 'post',
							beforeSend: function() {
								//	$("#loader").removeClass("hidden");   
							},
							success: function(response) {
								console.log(response);
								//alert(incidents_pie);
								var obj = response.data;
								incidents_pie.series[0].data = response.data;
								var chart = new Highcharts.Chart(incidents_pie);
								//$('#support_incident').html(response.htmlData);
								$('#counters').html(response.statisticsData);
								var totalNumber = response.total;
								var table = $('#support_incident').DataTable( {
											data: response.htmlData
								});
								//var len = obj.length;
								if(obj[0][0] == "Closed"){
									//alert(Math.round(obj[0][1]*100/totalNumber));
									$('#easy-pie-chart-5').data('easyPieChart').update(Math.round(obj[0][1]*100/totalNumber));
									$('#pie5').html(Math.round(obj[0][1]*100/totalNumber) + "%");
								}
								if(obj[4][0] == "New"){
									//alert(Math.round(obj[0][1]*100/totalNumber));
									$('#easy-pie-chart-1').data('easyPieChart').update(Math.round(obj[4][1]*100/totalNumber));
									$('#pie1').html(Math.round(obj[4][1]*100/totalNumber) + "%");
								}
								if(obj[1][0] == "Logged in"){
									//alert(Math.round(obj[0][1]*100/totalNumber));
									$('#easy-pie-chart-2').data('easyPieChart').update(Math.round(obj[1][1]*100/totalNumber));
									$('#pie2').html(Math.round(obj[1][1]*100/totalNumber) + "%");
								}
								if(obj[3][0] == "Response Awaited"){
									//alert(Math.round(obj[0][1]*100/totalNumber));
									$('#easy-pie-chart-3').data('easyPieChart').update(Math.round(obj[3][1]*100/totalNumber));
									$('#pie3').html(Math.round(obj[3][1]*100/totalNumber) + "%");
								}
								
							},
							cache:true
			});
	});
</script>