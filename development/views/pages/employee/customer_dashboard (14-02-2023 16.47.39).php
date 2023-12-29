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
updateEmpCustomerSession();

$userProfile = $CI->session->getSessionData('userProfile');

//print_r($userProfile);
?>
	
<link rel="stylesheet" href="/euf/assets/themes/standard/css/bootstrap.min.css">
  <link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
	<style type="text/css">
		/* ======================================================================= */
		/* Server Statistics */
        .navbar .nav>li>a:focus, .navbar .nav>li>a:hover
        {
            color:white !important;
        }
        #support_incident_filter label input[type="search"]
        {
            height:14px !important;
        }
        .rn_SourceSearchField input[type="search"]
        {
            height:14px !important;
            width:338px !important;
        }
		.well.widget-pie-charts .box {
			margin-bottom: -20px;
		}
        .btn-mini
        {
            font-size:14px;
        }
         header nav, header .navbar {
     		max-width: 1230px !important; 
        }
        header
        {
            height:38px;
        }
		.navbar .nav>li>a
        {
            text-shadow:none !important;
        }
		/* ======================================================================= */
		/* Why AdminFlare */
		#why-adminflare ul {
			position: relative;
			padding: 0 10px;
			margin: 0 -10px;
		}
       .rn_Body .navbar-collapse .navbar-nav li a h4
        {
                width: 325px;
    box-shadow: none;
    color: white !important;
        }
.rn_Body .sidebar-nav .navbar li a
        {
            width:329px;
        }
        .collapse.in ul li a
        {
            color:white;
        }
		#why-adminflare ul:nth-child(2n) {
			background: rgba(0, 0, 0, 0.02);
		}
.navbar-nav>li>.dropdown-menu
        {
            left:none !important;
            right:none !important;
            
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

.container-fluid .navbar-header~.collapse>nav
        {
            height:80px !important;
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
		
		@media (max-width: 768px) {
			#supported-browsers header { text-align: center; margin-bottom: 20px; }
		}

		/* ======================================================================= */
		/* Status panel */
		.status-example { line-height: 0; position:relative; top: 22px }
	</style>

<link rel="stylesheet" href="/euf/assets/themes/standard/css/adminflare.css" />




	<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"  rel="stylesheet" >
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<br />
<section class="dealercontainer">

<div class="row affix-row">
    <div class="col-sm1-3 col-xs-3 affix-sidebar">
		
		<!--<div class="row">
		   <div class="col-sm-12 col-md-12 col-lg-5">
			  <img src="/euf/assets/themes/standard/img/photo.png" alt="<?php echo $dealer_name;?>"  style="border-radius:50px">
			</div>
			<div class="col-sm-12 col-md-12 col-lg-7" style="margin-top:5px">
			  <div class="small"><?php echo $dealer_code;?></div>
			  <div class="text-uppercase"><?php echo $dealer_name;?> </div>
			</div>
		</div>-->
		<!-- End Div -->
		<br />
		<div class="sidebar-nav">
  <div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <span class="visible-xs navbar-brand">Sidebar menu</span>
    </div>

    <div class="navbar-collapse collapse sidebar-navbar-collapse">
      <ul class="nav navbar-nav" id="sidenav01">
        <li class="active">
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
          <h4>
          Control Panel
          </h4>
          </a>
        </li>
        <li >
          <a href="javascript:void(0)" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-cloud"></span> Dashboard <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo" style="height: 0px;">
            <ul class="nav nav-list">
              <li> <a href="<?php echo $site_url;?>/app/employee/payment-details">Login Status</a> </li>
			  <li><a href="<?php echo $site_url;?>/app/employee/payment-details">Payment Details</a></li>
			  <li><a href="<?php echo $site_url;?>/app/employee/payment-details">Loan Schedule</a></li>
			  <li><a href="<?php echo $site_url;?>/app/employee/payment-details">Charges</a></li>
            </ul>
          </div>
        </li>
		<!--<li><a href="<?php echo $site_url;?>/app/employee/business-information"><span class="glyphicon glyphicon-lock"></span> Business Information</a></li>
        <li><a href="<?php echo $site_url;?>/app/employee/dealer_disbursal_detail"><span class="glyphicon glyphicon-calendar"></span> Sales Performance <span class="badge pull-right">42</span></a></li>-->
        <li >
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-inbox"></span> Self Service <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo2" style="height: 0px;">
            <ul class="nav nav-list">
				<li><a href="<?php echo $site_url;?>/app/employee/selfserviceview">Initial loan amount</a></li>
				<li><a href="<?php echo $site_url;?>/app/employee/selfserviceview">Instrument details</a></li>
				<li><a href="<?php echo $site_url;?>/app/employee/selfserviceview">Status of loan</a></li>
				<li><a href="<?php echo $site_url;?>/app/employee/selfserviceview">Courier Details</a></li>
				<li><a href="<?php echo $site_url;?>/app/employee/selfserviceview">ECS Mandate/NDC</a></li>
            </ul>
          </div>
        </li>

		<!--<li >
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-inbox"></span> Incentives & Claims<span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo3" style="height: 0px;">
            <ul class="nav nav-list">
				<li><a href="<?php echo $site_url;?>/app/employee/incentive_view">I & C Summary</a></li>
                <li><a href="<?php echo $site_url;?>/app/employee/transaction_view">I & C Transactions</a></li>
            </ul>
          </div>
        </li>-->
       

      </ul>
      </div><!--/.nav-collapse -->
    </div>
	<p>&nbsp;</p>
	<div>
		<ul><li style="margin-top:10px;"><a href="<?php echo $site_url;?>/app/employee/customerquery"><img src="<?php echo $site_url;?>/euf/assets/themes/standard/images/for-customer-img.gif"></a></li></ul>
	</div>
  </div>
	</div>
	
	<!-- Main -->
	<div class="column col-sm-9 col-xs-11 affix-content">
	  <div class="container-fluid">
		
		  <div class="row content">
			
			<br>

			<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
				<!--<h4>Customer Dashboard</h4>-->
				<script type="text/javascript">
						var 	incidents_pie;
						$(document).ready(function () {
							$('a[rel=tooltip]').tooltip();

							// Easy Pie Charts
						
							
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
							$('#tab-users a').tooltip();
						});
					</script>

					<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
						   <center>
							  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
							</center>
						</div>



					<!-- Page content
						================================================== -->
                <div>
					<section class="" style="margin-top:-90px;">
						
						<span class="small text-uppercase text-muted"></span>
							<h1>Customer Dashboard</h1>
						<!-- Server statistics
							================================================== -->
						
						<!-- ================================================== -->
						<section class="row-fluid">
							
							
							<!-- Daily visits chart
								================================================== -->
							<div class="span8">
								<h3 class="box-header">
									<i class="icon-home"></i>
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
									<i class="icon-bullhorn"></i>
									<a class="rn_Questions" href="/app/employee/customer_incident_list#rn:session#">#rn:msg:MY_SUPPORT_QUESTIONS_LBL#</a>
								</h3>
								<div class="box widget-support-tickets">
									<table id="support_incident" class="display" cellspacing="0" width="100%">
										<thead>
											<tr>
											<!--	<th>Dealer ID</th>
												<th>Dealer Name</th>-->
												<th>Customer Name</th>
												<th>Reference #</th>
												<th>Status</th>
												<th>Status Type</th>
												<th>Subject</th>
												<th>Date Created</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
										<!--		<th>Dealer ID</th>
												<th>Dealer Name</th>-->
												<th>Customer Name</th>
												<th>Reference #</th>
												<th>Status</th>
												<th>Status Type</th>
												<th>Subject</th>
												<th>Date Created</th>
											</tr>
										</tfoot>
									</table>

									<div class="widget-actions">
										<a href="/app/employee/customer_incident_list#rn:session#" class="btn btn-mini">#rn:msg:SEE_ALL_MY_SUPPORT_QUESTIONS_LBL#</a>
									</div>
								</div>
							</div>
							<!-- / Support tickets -->

							
						</section>

						
						
					</section>
                    </div>
				<script type="text/javascript">
				$(document).ready(function () {
						$.ajax({
											 url: "/cc/EmployeeCustom/getEmployeeCustomerPieData",
											dataType: "json",
											method: 'post',
											beforeSend: function() {
													$("#loader").removeClass("hidden");   
											},
											success: function(response) {
												//console.log(response);
												//alert(incidents_pie);
												incidents_pie.series[0].data = response.data;
												$("#loader").addClass("hidden");   
												var chart = new Highcharts.Chart(incidents_pie);
												$('#counters').html(response.statisticsData);
											//alert(response.htmlData);
											//	var table_data = JSON.parse(response.htmlData);
												//console.log(response.htmlData);

												var table = $('#support_incident').DataTable( {
															data: response.htmlData
												});
											},
											cache:false
							});
					});


				</script>
			  
			</div>
		  </div>
		</div>
	</div>
	<!-- /main -->
	
</div>
	  
	  
</section>
