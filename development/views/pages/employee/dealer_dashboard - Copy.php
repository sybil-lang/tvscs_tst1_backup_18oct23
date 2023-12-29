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

$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
$report_id= $msg->Value;
$filter = array("Date Created" => date('d/m/Y'));
//$report_result=report_result($report_id,$filter);
//print_r($report_result);



//print_r($report_results);
$userProfile = $CI->session->getSessionData('userProfile');

$dealer_code = $userProfile['dealer_codes'];
//$dealer_code = 7090;
//print_r($report_results);
?>
<?php
		if(!empty($dealer_code)){
		?>
<!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />
	        <link href="/euf/assets/themes/standard/css/font-awesome-home.css" rel="stylesheet" />                
     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!--<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  -->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<style type="text/css">
.small-box .icon{
top:-13px;
}
</style>



<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>

        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>

       
		<input type="hidden" name="hfFirstYear" id="hfFirstYear" value="<?php echo date("Y");?>" />
		<input type="hidden" name="hfSecondYear" id="hfSecondYear" value="<?php echo date("Y")+1;?>" />
		<input type="hidden" name="hfyear1" id="hfyear1" value="<?php echo date('d/m/Y', mktime(0,0,0,1,1,date("Y")));?>" />
		<input type="hidden" name="hfyear2" id="hfyear2" value="<?php echo date('d/m/Y');?>" />

		<br />
		
<script type="text/javascript" src="/euf/assets/themes/standard/js/edealer_dashboard.js" ></script>

<script type="text/javascript">
    var taincident;
	var tarequest;

/*
type: 'pie',
            name: 'Browser share',
            data: [
                ['Firefox', 45.0],
                ['IE', 26.8],
                {
                    name: 'Chrome',
                    y: 12.8,
                    sliced: true,
                    selected: true
                },
                ['Safari', 8.5],
                ['Opera', 6.2],
                ['Others', 0.7]
            ]
			*/
//$(function () {
    //Highcharts.chart('ta_incident', {
  taincident  = {
	  chart: {
            type: 'pie',
			renderTo: 'ta_incident',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Incidents '
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <br />VALUE :<b> {point.y}</b>'
        },
		credits: {
			enabled: false
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

//Highcharts.chart('ta_request', {
  tarequest = {
		chart: {
            type: 'pie',
			renderTo: 'ta_request',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'TA Requests '
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b><br />VALUE :<b> {point.y}</b>'
        },
		credits: {
                enabled: false
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
   // });
};
//});
  </script>
<script type="text/javascript">
    
    function microtime(get_as_float) {
       var now = new Date().getTime() ;
       var s = parseInt(now) ;
   
       return now ;
    }
    
    function getGraph(datafile,methodName,dealerCode) {
		var sdate = $("[id$=hfyear1]").val();
		var edate = $("[id$=hfyear2]").val();
		//alert(sdate);
		//alert(edate);
		//var dealerCode = '<?php echo $dealer_code;?>';
		$("#loader").removeClass("hidden");   
		if(datafile == 'graph1'){
				 var param = {
						'startDate' : sdate,
						'endDate': edate,
						'dealerCode': dealerCode
					};
					$.ajax({
						url: '/cc/DealerCustom/getSalesDisbursedCount',
						data: param,
						method: 'post',
						dataType: 'json',
						beforeSend: function() {
								//$("#loader").removeClass("hidden");   
						},
						success: function(response) {
							
							//options_line.series[1] = response[1];
							baroption.series[0] = response[0];
							//baroption.series[1] = response[1];
							//console.log(options_line);
							//var chart1 = new Highcharts.Chart(options_line);
							var chart1 = new Highcharts.Chart(baroption);
							//alert(response[0].total);
							$('#total_disbursal').text(response[0].total);
							//$("#loader").addClass("hidden");   
						},
						cache: false
					});
	}
	if(datafile == 'graph4'){
			var param = {
						'startDate' : sdate,
						'endDate': edate,
						'dealerCode': dealerCode
					};
		$.ajax({
			url: '/cc/DealerCustom/getSalesPerformanceSummary',
			data: param,
			method: 'post',
			dataType: 'json',
			beforeSend: function() {
					$("#loader").removeClass("hidden");   
			},
			success: function(response) {
				//console.log(response);
				//alert(response[0].id);
				//console.log(response[0].data);
			optionspdd_line.series[0] = response[0];
			optionspdd_line.series[1] = response[1];
			//optionspdd_line.series[2] = response[2];
			//	baroption.series[0] = response[0];
			//	baroption.series[1] = response[1];
				//console.log(options_line);
				var chart6 = new Highcharts.Chart(optionspdd_line);
		//		var chart = new Highcharts.Chart(baroption);
			
				
				$("#loader").addClass("hidden");   
			},
			cache: false
		});
	}
	if(datafile == 'graph2'){
		//dealerCode =  '<?php echo $dealer_code;?>';
		var param = {
				'startDate': sdate,
				'endDate': edate,
				'dealerCode':dealerCode
			}
			$.ajax({
					url: '/cc/DealerCustom/getSalesPerformanceChartSummary',
					data: param,
					method: 'post',
					dataType: 'json',
					beforeSend: function() {
						//	$("#loader").removeClass("hidden");   
					},
					success: function(response) {
						//console.log(response);
						//alert(response[0].id);
						//console.log(response[0].data);
						//alert(response[0].data);
						if(response[0].data == null){
							
							//bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
						}else{
							optionsdpdd_pie.series[0]= response[0];
						}

						if(response[1].data == null){
								
//							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
						}else{
							optionsdpdd_bar.series[0] = response[1];
						}
						var chart2 = new Highcharts.Chart(optionsdpdd_pie);
						var chart3 = new Highcharts.Chart(optionsdpdd_bar);
						
						//alert(response[0].total);
						$('#total_pending').text(response[0].total);
						//$("#loader").addClass("hidden");   
					},
					cache: false
				});

	}

	//PDD
	if(datafile == 'graph3'){
		//	dealerCode =  '<?php echo $dealer_code;?>';
			var param = {
				'startDate': sdate,
				'endDate': edate,
				'dealerCode':dealerCode
			}
			$.ajax({
					url: '/cc/DealerCustom/getPDDAgeingChartSummary',
					data: param,
					method: 'post',
					dataType: 'json',
					beforeSend: function() {
						//	$("#loader").removeClass("hidden");   
					},
					success: function(response) {
						console.log(response);
						//alert(response[0].id);
						//console.log(response[0].data);
						//alert(response[0].data);
						if(response[0].data == null){
							/*optionspdd_pie.series[0].id = response[0].id;
							optionspdd_pie.series[0].colorByPoint = true;
							//optionspdd_pie.series[0].id = response[0].id;
							optionspdd_pie.series[0].data = '[{"name":"Invoice with Ageing","y":0,"count":0},{"name":"Insurance with Ageing","y":0,"count":0},{"name":"RC Book with Ageing","y":0,"count":0}]';*/
							//bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
							optionspdd_pie.series[0]= response[0];
						}else{
							optionspdd_pie.series[0]= response[0];
						}

						if(response[1].data == null){
								/*optionspdd_bar.series[0].id = response[0].id;
								optionspdd_bar.series[0].color = response[0].color;
							//optionspdd_pie.series[0].id = response[0].id;
								optionspdd_bar.series[0].data = '[{"name":"Invoice with Ageing","y":0,"count":0},{"name":"Insurance with Ageing","y":0,"count":0},{"name":"RC Book with Ageing","y":0,"count":0}]';*/
//							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
							optionspdd_bar.series[0] = response[1];
						}else{
							optionspdd_bar.series[0] = response[1];
						}
						var chart4 = new Highcharts.Chart(optionspdd_pie);
						var chart5 = new Highcharts.Chart(optionspdd_bar);
						$('#total_pdd').text(response[0].total);
						//$("#loader").addClass("hidden");   
					},
					cache: false
				});

	}
	
	if(datafile == 'graph5'){
			var param = {
				'startDate': sdate,
				'endDate': edate,
				'dealerCode':dealerCode
			}
				$.ajax({
					url: '/cc/EmployeeCustom/getDealerIncidentPieData',
					data: param,
					method: 'post',
					dataType: 'json',
					beforeSend: function() {
						//	$("#loader").removeClass("hidden");   
					},
					success: function(response) {
						console.log(response);
						
						if(response == null){
							
							taincident.series[0]= response;
						}else{
							taincident.series[0]= response;
						}

						
						var chart_5 = new Highcharts.Chart(taincident);
						
					},
					cache: false
				});
	}

	if(datafile == 'graph6'){
			var param = {
				'startDate': sdate,
				'endDate': edate,
				'dealerCode':dealerCode
			}
				$.ajax({
					url: '/cc/EmployeeCustom/getTADealerIncidentPieData',
					data: param,
					method: 'post',
					dataType: 'json',
					beforeSend: function() {
						//	$("#loader").removeClass("hidden");   
					},
					success: function(response) {
						console.log(response);
						
						if(response == null){
							
							tarequest.series[0]= response;
						}else{
							tarequest.series[0]= response;
						}

						
						var chart_6 = new Highcharts.Chart(tarequest);
						
					},
					cache: false
				});
	}
  }  
       
   // $(function () {
        var chart_11, chart_12, chart_13, chart_14, chart_15, chart_16,chart_7;
       // $(document).ready(function() {

			function updateChartData(){
					chart_11 = getGraph('graph1','getSalesDisbursedCount','<?php echo $dealer_code;?>');
					chart_12 = getGraph('graph2','getSalesPerformanceChartSummary','<?php echo $dealer_code;?>');
					chart_13 = getGraph('graph3','getPDDAgeingChartSummary','<?php echo $dealer_code;?>');
					chart_14 = getGraph('graph4','getSalesPerformanceSummary','<?php echo $dealer_code;?>');
					chart_15 = getGraph('graph5','getPieData','<?php echo $dealer_code;?>');
					chart_16 = getGraph('graph6','getTAPieData','<?php echo $dealer_code;?>');
			}
         //   chart_5 = getGraph('example4');
         //   chart_6 = getGraph('example5');
		//	chart_7 = getGraph('example6');
		//	chart_8 = getGraph('example7');
       // });
   //   });

    
		</script>
		
		
        <section class="dealercontainer">
          <div class="row-fluid">
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
						<div id="demo-tabs-vertical" class="tabbed-nav-flat hover clean medium flat-peter-river flat z-icons-light z-rounded z-bordered z-spaced z-tabs vertical top-left top">
						<ul class="z-tabs-nav z-tabs-mobile z-state-closed" style="display: none;"><li><a class="z-link" style="text-align: left;"><span class="z-title"><span class="z-icon"><i class="icon-tablet baseline">&nbsp;</i></span>Tabbed Content</span><span class="z-arrow"></span></a></li></ul><i class="z-dropdown-arrow"></i><ul class="z-tabs-nav z-tabs-desktop z-hide-menu">
                                        <li class="z-tab z-first" data-link="tab1">
                                            <a class="z-link"><span class="z-icon"><i class="icon-desktop baseline">&nbsp;</i></span>Dealer Dashboard</a>
                                        </li>
                                        <li class="z-tab" data-link="tab2">
                                            <a class="z-link" href="<?php echo $site_url;?>/app/employee/dealer_disbursal_detail"><span class="z-icon"><i class="icon-laptop baseline">&nbsp;</i></span>Dealer Disbursal</a>
                                        </li>
                                        <li class="z-tab z-active" data-link="tab3">
                                            <a class="z-link"><span class="z-icon"><i class="icon-tablet baseline">&nbsp;</i></span>Incentive & Claim</a>
                                        </li>
                                       <!-- <li class="z-tab" data-link="tab4">
                                            <a class="z-link"><span class="z-icon"><i class="icon-star-empty baseline">&nbsp;</i></span>jQuery Tabs</a>
                                        </li>
                                        <li class="z-tab" data-link="tab5">
                                            <a class="z-link"><span class="z-icon"><i class="icon-reorder baseline">&nbsp;</i></span>jQuery Vertical Tabs</a>
                                        </li>
                                        <li class="z-tab z-last" data-link="tab6">
                                            <a class="z-link"><span class="z-icon"><i class="icon-resize-full baseline">&nbsp;</i></span>jQuery Tabs Plugin</a>
                                        </li>-->
                                    </ul>
                                    
                                    
                                <div class="z-container" style="min-height: 305px;">
                                        <div class="imgtest z-content z-active" style="display: block; position: relative; left: 0px;">
										<div class="z-content-inner">
                                            <img alt="mobile phone" src="" style="min-width: 100%; height: auto;" class="hidden">

                                           <div class="col-sm-9 col-md-9 col-lg-12" id="contemt-main">
              
													  <div class="row">
														<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
														  <span class="small text-uppercase text-muted"></span>
														  <h1>Dashboard</h1>

														</div>
														<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
														  <div class="row">
															<div class='col-sm-12 form-inline datetimepickerwrapper'>
															  <div class="form-group">
																<label>From</label>
																<div class='input-group date' id='datetimepicker6'>

																  <input type='text' class="form-control" value="<?php echo date("d/m/Y",mktime(0,0,0,1,1,date("Y")));?>" data-provide="datepicker"  />
																  <span class="input-group-addon click6">
																				<span class="glyphicon glyphicon-calendar"></span>
																  </span>
																</div>
															  </div>

															  <div class="form-group">
																<label>To</label>
																<div class='input-group date' id='datetimepicker7'>

																  <input type='text' class="form-control" value="<?php echo date("d/m/Y");?>" />
																  <span class="input-group-addon click7">
																				<span class="glyphicon glyphicon-calendar"></span>
																  </span>
																</div>
															  </div>
															</div>
														  </div>

														</div>
													  </div>
													  <div class="row">
														<div class="col-sm-12">
														  <hr>
														</div>
													  </div>

													  <div class="row">
														<div class="col-sm-6 col-md-6 col-lg-3">
														  <div class="well">
															<div class="row">
															  <div class="col-md-12 col-lg-12">

																
																	<div class="small-box ">
																		<div class="inners">
																		  <h3><span id="total_disbursal">0</span></h3>
																		  <p>Total Dealer Disbursal</p>
																		</div>
																		<div class="icon">
																		  <i class="fa fa-lightbulb-o"></i>

																		</div>
																		<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
																	</div>
															  </div>
															  <!--<div class="col-md-12 col-lg-6">
																<span id="user-chart-container">Data will render here</span>
															  </div>-->
															</div>
														  </div>

														</div>
														<div class="col-sm-6 col-md-6 col-lg-3">
														  <div class="well">
															<div class="row">
															  <div class="col-md-12 col-lg-12">

															   
																	<div class="small-box ">
																		<div class="inners">
																		  <h3><span id="total_pending">0</span></h3>
																		  <p>Total Disbursal Pending</p>
																		</div>
																		<div class="icon">
																		  <i class="fa fa-money"></i>

																		</div>
																		<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
																	</div>
															  </div>

															  <!--<div class="col-md-12 col-lg-6">
																<span id="page-views-chart-container">Data will render here</span>
															  </div>-->
															</div>

														  </div>
														</div>
														<div class="col-sm-6 col-md-6 col-lg-3">
														  <div class="well ">
															<div class="row">
															  <div class="col-md-12 col-lg-12">
																
																<div class="small-box ">
																		<div class="inners">
																		  <h3><span id="total_pdd">0</span></h3>
																		  <p>Total PDD Pending</p>
																		</div>
																		<div class="icon">
																		  <i class="fa fa-inr"></i>

																		</div>
																		<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
																	</div>
															  </div>

															  <!--<div class="col-md-12 col-lg-6">
																<span id="session-duration-chart-container">Data will render here</span>
															  </div>-->
															</div>
														  </div>
														</div>
														<div class="col-sm-6 col-md-6 col-lg-3">


														  <div class="well">
															<div class="row">
															  <div class="col-md-12 col-lg-12">

																	<div class="small-box ">
																		<div class="inners">
																		  <h3><span id="total_ta">0</span></h3>
																		  <p>Total TA Request</p>
																		</div>
																		<div class="icon">
																		  <i class="fa fa-calendar-check-o"></i>

																		</div>
																		<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
																	</div>
															  </div>

															<!--  <div class="col-md-12 col-lg-6">
																<span id="bounce-rate-chart-container">Data will render here</span>
															  </div>-->
															</div>

														  </div>
														</div>
													  </div>
													  <div class="row">
														<div class="col-sm-12">
														  <div class="well"  id="Sales_Disbursed">
															<h4>Sales Disbursed Details</h4>
															 <div id="container"></div>
														  </div>
														</div>
													  </div>

													   <div class="row">
														<div class="col-sm-12">
														  <div class="well"  id="Sales_Performance">
															<h4>Sales Performance Details</h4>
															 <div id="disbursalcontainer"></div>
														  </div>
														</div>
													  </div>

													  <div class="row">
														<div class="col-sm-6">
														  <div class="well" >
															<!--<h4 >Sales Performance Details</h4>-->
														   <div id="disbursalbarchart1"></div>  
														  </div>
														</div>
														<div class="col-sm-6">
														  <div class="well">
														  <!--  <h4>Summary Details for PDD Pending</h4>-->
															<div id="disbursalpiechart1"></div> 
														  </div>
														</div>
													  </div>
													  <div class="row">
															<div class="col-sm-6">
																<div class="well" id="PDD_Pending">
																	<!--<h4>Summary Details for PDD Pending</h4>-->
																	 <div id="pddbarchart1"></div> 
																</div>
															</div>
															<div class="col-sm-6">
																<div class="well">
																	<div id="pddpiechart1"></div>
																</div>
															</div>
													  </div>
													  <div class="row">
															<div class="col-sm-6">
															  <div class="well">
																<!--<h4 >Trade Advance</h4>-->
																<div id="ta_request"></div> 
															  </div>
															</div>
															<div class="col-sm-6">
															  <div class="well">
																<!--<h4>Incidents</h4>-->
															   <div id="ta_incident"></div> 
															  </div>
															</div>
														</div>

													  
													</div>
                                        </div></div>

                                        <div class="z-content"><div class="z-content-inner">
                                            &nbsp;

                                        </div></div>
                                        <div class="z-content z-active" style="display: block; position: relative; left: 0px;"><div class="z-content-inner">
                                            <h4>Incentive & Claim</h4>
                                            <div class="col-sm-12 col-md-12 col-lg-12" >
								  
												 <div class="row">
																	<div style="padding-top: 5em;"></div>

																	<div id="TA_SUM" class="col-lg-4 col-md-6">
																		<div class="panel-stat3 bg-info">
																			<h2 class="m-top-none">I & C Summary</h2>
																			<div>
																				<a id="btnTASummary" class="btn btn-warning" href="<?php echo $site_url;?>/app/employee/incentive_view">View
																					<i class="fa fa-arrow-right"></i></a>
																			</div>
																			<div class="stat-icon">
																				<i class="fa fa-bar-chart-o fa-2x"></i>
																			</div>
																		</div>
																	</div>

																	<div id="TA_TRANS" class="col-lg-4 col-md-6">
																		<div class="panel-stat3 bg-warning">
																			<h2 class="m-top-none">I & C Transaction</h2>
																			<div>
																				<a onclick="#" id="btnTATransaction" class="btn btn-warning" href="<?php echo $site_url;?>/app/employee/transaction_view">View
																					<i class="fa fa-arrow-right"></i></a>
																			</div>
																			<div class="stat-icon">
																				<i class="fa fa-exchange fa-2x"></i>
																			</div>
																		</div>
																	</div>

																	

																	<div style="padding-bottom: 27em;"></div>

																</div>
										</div>
                                        </div></div>
                                        
                                    </div></div>
					</div>
		</div>
</section>
<script>
        jQuery(document).ready(function ($) {
            /* jQuery activation and setting options for first tabs, enabling multiline*/
           /* jQuery activation and setting options for second tabs
		    data-options="{&quot;orientation&quot;: &quot;vertical&quot;, &quot;style&quot;: &quot;clean&quot;, &quot;size&quot;:&quot;medium&quot;, &quot;position&quot;: &quot;top-left&quot;, &quot;rounded&quot;:true,&quot;spaced&quot;:true, &quot;theme&quot;:&quot;flat-peter-river&quot;}"
			*/
            $("#demo-tabs-vertical").zozoTabs({
                position: "top-left",
                orientation: "vertical",
                multiline: true,
                style: "clean",
                theme: "flat-peter-river",
                spaced: true,
                rounded: true,
                animation: {
                    easing: "easeInOutExpo",
                    duration: 450,
                    effects: "slideH"
                }
            });

         //   $('#example').DataTable();
        });
    </script>
		<script type="text/javascript">
			updateChartData();
		</script>
		
<?php }else{ ?>



<section class="clearfix">
	 <div class="main">
					<form method="post" action="/app/employee/dealer_dashboard" name="dform" id="dform">
						
							<!-- Modal -->
							<div id="myModal" class="modal fade" role="dialog">
								<div id="bootbox-body"></div>
							  <div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Select Dealer</h4>
								  </div>
								  <div class="modal-body">
									<?php
								/*	if(!empty($dealer_array)){
											echo '<select name="dealer_code" id="dealer_code">';
											foreach($dealer_array as $key => $resultDealer){
												echo '<option value="'.$resultDealer['value'].'">'.$resultDealer['text'].'</option>';
											}
											echo '</select>';
									}*/

									?>
										<div id="magicsuggest"></div>
								  </div>
								  <div class="modal-footer">
								  <input type="hidden" id="dealer_code" name="dealer_code" value="" />
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-default" id="btn_save">Save</button>
								  </div>
								</div>

							  </div>
							</div>
					</form>
	  </div>
</section>


<script type="text/javascript">
$("#myModal").modal('show');
$("#btn_save").on("click", function(){
			jQuery.ajax({
						type: 'POST',
						data: {
							'dealer_codes' : $('#dealer_code').val()
						},
						url: '/cc/EmployeeCustom/setDealerCode',
						beforeSend: function() {
							// setting a timeout
							$('#bootbox-body').html('<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>');
							//$(placeholder).addClass('loading');
						},
						success: function(response) {
							//alert(response);
								$('#bootbox-body').html('');
								window.location.reload();
						}
					});
});

</script>
 <?php } ?>
