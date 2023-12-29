<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="dealer_header.php" clickstream="dashboard" login_required="true" force_https="true" />
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$contact_id=$CI->session->getProfileData("c_id");

$dealer_code=$CI->session->getProfileData("login");
$fname=$CI->session->getProfileData("first_name");

$lname=$CI->session->getProfileData("last_name");

$name = ucfirst($fname)." ".ucfirst($lname);

$CI->load->helper('report');

checkCustomerType('dealer');

$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
$report_id= $msg->Value;
$filter = array("Date Created" => date('d/m/Y'));
//$report_result=report_result($report_id,$filter);
//print_r($report_result);
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!--<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  -->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>

        <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>

        <nav class="navbar navbar-default visible-xs">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
               <button type="button" class="navbar-toggle user-info" data-toggle="collapse" data-target="#useInfo">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>   
              </button>
            </div>
             <div class="collapse navbar-collapse" id="useInfo">
              <ul class="nav navbar-nav">
                <li class="text-center">
                <h2 class="small text-uppercase">Welcome</h2>
               <!-- <img src="imgs/john.png" alt="" width="70" height="70" style="border-radius:50px">-->
                <div class="text-uppercase"><?php echo $name;?></div>
                </li>
              </ul>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                  <!--<li ><a href="#dashboard">Dashboard</a></li>-->
                  <li class="active"><a href="javascript:void(0);" onclick="setDashboardGraph('sales_1');">Dealer Disbursal</a> </li>
                      <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_2');">Sales Performance</a></li>
                      <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_4');">PDD Pending</a></li>
                      <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_5');">Trade Advance</a></li>
					  <li><a href="https://tvscscrmservice.tvscredit.com/TDSDealerRed.aspx?DEALER_CODE=<?php echo $dealer_code;?>" target=newtab>GST Certificate</a></li> 
              </ul>
            </div>
          </div>
        </nav>
		<input type="hidden" name="hfFirstYear" id="hfFirstYear" value="<?php echo date("Y");?>" />
		<input type="hidden" name="hfSecondYear" id="hfSecondYear" value="<?php echo date("Y")+1;?>" />
		<input type="hidden" name="hfyear1" id="hfyear1" value="<?php echo date('d/m/Y', mktime(0,0,0,date("m")-3,date("d"),date("Y")));?>" />
		<input type="hidden" name="hfyear2" id="hfyear2" value="<?php echo date('d/m/Y');?>" />

        <div class="container-fluid">
          <div class="row content">
            <div class="col-sm-3 col-md-3 col-lg-2 " id="nav">
             
              <div >
                <div class="row">
                  <div class="col-sm-12">
                    <p></p>
                  </div>
                </div>
               
                <div class="row">
                   <div class="col-sm-12 col-md-12 col-lg-5">
                      <img src="/euf/assets/themes/standard/img/photo.png" alt="<?php echo $name;?>"  style="border-radius:50px">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-7" style="margin-top:5px">
                      <div class="small">Welcome,</div>
                      <div class="text-uppercase"><?php echo $name;?></div>
                    </div>
                </div>
				<!--
				
-->
                <div class="row">
                  <div class="col-sm-12">
                    <ul class="nav nav-pills nav-stacked">
                      <!--<li ><a href="#dashboard">Dashboard</a></li>-->
                      <li class="active"><a href="javascript:void(0);" onclick="setDashboardGraph('sales_1');">Dealer Disbursal</a> </li>
                      <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_2');">Sales Performance</a></li>
                      <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_4');">PDD Pending</a></li>
                      <li><a href="https://tvscs.custhelp.com/app/dealer/upload_documents" onclick="">PDD Image Upload</a></li>
                      <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_5');">Trade Advance</a></li>
					  <li><a href="http://tvscscrmservice.tvscredit.com/TDSDealerRed.aspx?DEALER_CODE=<?php echo $dealer_code;?>" target=newtab>GST Certificate</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <br>

            </div>
            <br>

            <div class="col-sm-9 col-md-9 col-lg-10" id="contemt-main">
              
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

                          <input type='text' class="form-control" value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-3,date("d"),date("Y")));?>" data-provide="datepicker"  />
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
              <div class="row" id="sales_1">
                <div class="col-sm-12">
                  <div class="well"  id="Sales_Disbursed">
                    <h4>Sales Disbursed Details</h4>
                     <div id="container"></div>
                  </div>
                </div>
              </div>

			   <div class="row" id="sales_2" style="display:none;">
                <div class="col-sm-12">
                  <div class="well"  id="Sales_Performance" >
                    <h4>Sales Performance Details</h4>
                     <div id="disbursalcontainer"></div>
                  </div>
                </div>
              </div>

              <div class="row"  id="sales_3" style="display:none;">
                <div class="col-sm-6">
                  <div class="well" >
                    <!--<h4 >Sales Performance Details</h4>-->
                   <div id="disbursalbarchart1" ></div>  
                  </div>
                </div>
                <div class="col-sm-6" >
                  <div class="well">
                  <!--  <h4>Summary Details for PDD Pending</h4>-->
                    <div id="disbursalpiechart1"></div> 
                  </div>
                </div>
              </div>
			  <div class="row" id="sales_4"  style="display:none;">
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
              <div class="row" id="sales_5" style="display:none;">
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
          </div>
        </div>

 

<script type="text/javascript" src="/euf/assets/themes/standard/js/dashboard.js" ></script>
<script type="text/javascript">
    var taincident;
	var tarequest;
	var finalgraph ="sales_1";
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
$(function () {
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
});
  </script>
<script type="text/javascript">

    function microtime(get_as_float) {
       var now = new Date().getTime() ;
       var s = parseInt(now) ;
   
       return now ;
    }
    
    function getGraph(datafile,methodName) {
		var sdate = $("[id$=hfyear1]").val();
		var edate = $("[id$=hfyear2]").val();
		//alert(sdate);
		//alert(edate);
		var dealerCode = '<?php echo $dealer_code;?>';
		//$("#loader").removeClass("hidden");   
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
			//		$("#loader").removeClass("hidden");   
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
			
				//$("#loader").addClass("hidden");   
			},
			cache: false
		});
	}
	if(datafile == 'graph2'){
		dealerCode =  '<?php echo $dealer_code;?>';
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
						//$("#loader").removeClass("hidden");   
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
			dealerCode =  '<?php echo $dealer_code;?>';
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
						//$("#loader").removeClass("hidden");   
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
				'endDate': edate
			}
				$.ajax({
					url: '/cc/DealerCustom/getDealerIncidentPieData',
					data: param,
					method: 'post',
					dataType: 'json',
					beforeSend: function() {
						//$("#loader").removeClass("hidden");   
					},
					success: function(response) {
						console.log(response);
						
						if(response == null){
							
							taincident.series[0]= response;
						}else{
							taincident.series[0]= response;
						}

						/*if(response[1].data == null){
								/*optionspdd_bar.series[0].id = response[0].id;
								optionspdd_bar.series[0].color = response[0].color;
							//optionspdd_pie.series[0].id = response[0].id;
								optionspdd_bar.series[0].data = '[{"name":"Invoice with Ageing","y":0,"count":0},{"name":"Insurance with Ageing","y":0,"count":0},{"name":"RC Book with Ageing","y":0,"count":0}]';
//							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
							optionspdd_bar.series[0] = response[1];
						}else{
							optionspdd_bar.series[0] = response[1];
						}*/
						var chart_5 = new Highcharts.Chart(taincident);
						//var chart5 = new Highcharts.Chart(optionspdd_bar);
						//$('#total_pdd').text(response[0].total);
						//$("#loader").addClass("hidden");   
					},
					cache: false
				});
	}

	if(datafile == 'graph6'){
			var param = {
				'startDate': sdate,
				'endDate': edate
			}
				$.ajax({
					url: '/cc/DealerCustom/getTADealerIncidentPieData',
					data: param,
					method: 'post',
					dataType: 'json',
					beforeSend: function() {
						//$("#loader").removeClass("hidden");   
					},
					success: function(response) {
						console.log(response);
						
						if(response == null){
							
							tarequest.series[0]= response;
						}else{
							tarequest.series[0]= response;
						}

						/*if(response[1].data == null){
								/*optionspdd_bar.series[0].id = response[0].id;
								optionspdd_bar.series[0].color = response[0].color;
							//optionspdd_pie.series[0].id = response[0].id;
								optionspdd_bar.series[0].data = '[{"name":"Invoice with Ageing","y":0,"count":0},{"name":"Insurance with Ageing","y":0,"count":0},{"name":"RC Book with Ageing","y":0,"count":0}]';
//							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
							optionspdd_bar.series[0] = response[1];
						}else{
							optionspdd_bar.series[0] = response[1];
						}*/
						var chart_6 = new Highcharts.Chart(tarequest);
						//var chart5 = new Highcharts.Chart(optionspdd_bar);
						//$('#total_pdd').text(response[0].total);
						//$("#loader").addClass("hidden");   
					},
					cache: false
				});
	}
		
//	$("#loader").addClass("hidden");   
 /*     $.post('/cc/DealerCustom/graphdata/', data, function(json){
         obj = eval('({'+json+'})');
         return new Highcharts.Chart(obj);
      });*/
  }  
       
	   
    $(function () {
        var chart_1, chart_2, chart_3, chart_4, chart_5, chart_6,chart_7;
        $(document).ready(function() {
            chart_1 = getGraph('graph1','getSalesDisbursedCount');
            chart_2 = getGraph('graph2','getSalesPerformanceChartSummary');
            chart_3 = getGraph('graph3','getPDDAgeingChartSummary');
            chart_4 = getGraph('graph4','getSalesPerformanceSummary');
						chart_5 = getGraph('graph5','getPieData');
						chart_6 = getGraph('graph6','getTAPieData');
        });
      });

    function setDashboardGraph(graph_id){
			finalgraph = graph_id;
			if(graph_id == "sales_1"){
				 chart_1 = getGraph('graph1','getSalesDisbursedCount');
				 $('#sales_1').show();
				 $('#sales_2').hide();
				 $('#sales_3').hide();
				 $('#sales_4').hide();
				 $('#sales_5').hide();
			}else if(graph_id == "sales_2"){
				 chart_2 = getGraph('graph2','getSalesPerformanceChartSummary');
				 chart_4 = getGraph('graph4','getSalesPerformanceSummary');
				 $('#sales_1').hide();
				 $('#sales_2').show();
				 $('#sales_3').show();
				 $('#sales_4').hide();
				 $('#sales_5').hide();
			}else if(graph_id == "sales_4"){
				 chart_3 = getGraph('graph3','getPDDAgeingChartSummary');
				 $('#sales_1').hide();
				 $('#sales_2').hide();
				 $('#sales_3').hide();
				 $('#sales_4').show();
				 $('#sales_5').hide();
			}else if(graph_id == "sales_5"){
				 chart_5 = getGraph('graph5','getPieData');
				 chart_6 = getGraph('graph6','getTAPieData');
				 $('#sales_1').hide();
				 $('#sales_2').hide();
				 $('#sales_3').hide();
				 $('#sales_4').hide();
				 $('#sales_5').show();
			}
	}
	jQuery(document).ajaxStart(function() {
		$("#loader").removeClass("hidden");  
	});
	jQuery(document).ajaxStop(function() {
		$("#loader").addClass("hidden");  
	});
		</script>