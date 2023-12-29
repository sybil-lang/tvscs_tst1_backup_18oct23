<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="dealer_header.php" clickstream="dashboard" login_required="true" force_https="true" />
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$contact_id=$CI->session->getProfileData("c_id");

$fname=$CI->session->getProfileData("first_name");

$lname=$CI->session->getProfileData("last_name");

$name = ucfirst($fname)." ".ucfirst($lname);

$CI->load->helper('report');

checkCustomerType('dealer');
?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  
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
                  <li class="active"> <a href="#Sales_Disbursed">Dealer Disbursal</a> </li>
				  <li><a href="#Sales_Performance">Sales Performance</a></li>
				  <li><a href="#PDD_Pending">PDD Pending</a></li>
				  <li><a href="#TA">TA Request</a></li>
				  <li><a>TDS (Tax deducted at source)</a>                
              </ul>
            </div>
          </div>
        </nav>
		<input type="hidden" name="hfFirstYear" id="hfFirstYear" value="<?php echo date("Y");?>" />
		<input type="hidden" name="hfSecondYear" id="hfSecondYear" value="<?php echo date("Y")+1;?>" />
		<input type="hidden" name="hfyear1" id="hfyear1" value="<?php echo date('d/m/Y', mktime(0,0,0,1,1,date("Y")));?>" />
		<input type="hidden" name="hfyear2" id="hfyear2" value="<?php echo date('d/m/Y');?>" />

        <div class="container-fluid">
          <div class="row content">
            <div class="col-sm-3 col-md-3 col-lg-2  sidenav hidden-xs clearfix" id="nav">
             
              <div data-spy="affix" data-offset-top="0" class="sidenav-container">
                <div class="row">
                  <div class="col-sm-12">
                    <p></p>
                  </div>
                </div>
               
                <div class="row">
                  <!--  <div class="col-sm-12 col-md-12 col-lg-5">
                      <img src="imgs/john.png" alt="" width="70" height="70" style="border-radius:50px">
                    </div>-->
                    <div class="col-sm-12 col-md-12 col-lg-9" style="margin-top:20px">
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
                      <li class="active"> <a href="#Sales_Disbursed">Dealer Disbursal</a> </li>
                      <li><a href="#Sales_Performance">Sales Performance</a></li>
                      <li><a href="#PDD_Pending">PDD Pending</a></li>
                      <li><a>Trade Advance</a></li>
					  <li><a>TDS (Tax deducted at source)</a>
                    </ul>
                  </div>
                </div>
              </div>

              <br>

            </div>
            <br>

            <div class="col-sm-9 col-md-9 col-lg-10" id="contemt-main">
              
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" id="Sales_Performance">
                  <span class="small text-uppercase text-muted"></span>
                  <h1>Dashboard</h1>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                  <div class="row">
                    <div class='col-sm-12 form-inline datetimepickerwrapper'>
                      <div class="form-group">
                        <label>From</label>
                        <div class='input-group date' id='datetimepicker6'>

                          <input type='text' class="form-control" value="01/07/2016" data-provide="datepicker"  />
                          <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>To</label>
                        <div class='input-group date' id='datetimepicker7'>

                          <input type='text' class="form-control" value="1/08/2016" disabled="true" />
                          <span class="input-group-addon">
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
                      <div class="col-md-12 col-lg-6">

                        <h5>SALES</h5>
                        <h3>10</h3>

                      </div>
                      <div class="col-md-12 col-lg-6">
                        <span id="user-chart-container">Data will render here</span>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="well">
                    <div class="row">
                      <div class="col-md-12 col-lg-6">

                        <h5>INCENTIVE</h5>
                        <h3>20</h3>
                      </div>

                      <div class="col-md-12 col-lg-6">
                        <span id="page-views-chart-container">Data will render here</span>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="well">
                    <div class="row">
                      <div class="col-md-12 col-lg-6">
                        <h5>TA</h5>
                        <h3>30</h3>
                      </div>

                      <div class="col-md-12 col-lg-6">
                        <span id="session-duration-chart-container">Data will render here</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">


                  <div class="well">
                    <div class="row">
                      <div class="col-md-12 col-lg-6">

                        <h5>PDD</h5>
                        <h3>40</h3>
                      </div>

                      <div class="col-md-12 col-lg-6">
                        <span id="bounce-rate-chart-container">Data will render here</span>
                      </div>
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
						<h4 >Trade Advance</h4>
						<div id="ta_request"></div> 
					  </div>
					</div>
					<div class="col-sm-6">
					  <div class="well">
						<h4>Incidents</h4>
					   <div id="ta_incident"></div> 
					  </div>
					</div>
				</div>

              
            </div>
          </div>
        </div>

<script type="text/javascript" src="/euf/assets/themes/standard/js/dashboard.js" ></script>
<script type="text/javascript">
    
    function microtime(get_as_float) {
       var now = new Date().getTime() ;
       var s = parseInt(now) ;
   
       return now ;
    }
    
    function getGraph(datafile,methodName) {
		var sdate = $("[id$=hfyear1]").val();
		var edate = $("[id$=hfyear2]").val();
		var dealerCode = 1831;
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
		dealerCode = 1635;
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
							
							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
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

						//$("#loader").addClass("hidden");   
					},
					cache: false
				});

	}

	//PDD
	if(datafile == 'graph3'){
			dealerCode = 1635;
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
						//console.log(response);
						//alert(response[0].id);
						//console.log(response[0].data);
						//alert(response[0].data);
						if(response[0].data == null){
							/*optionspdd_pie.series[0].id = response[0].id;
							optionspdd_pie.series[0].colorByPoint = true;
							//optionspdd_pie.series[0].id = response[0].id;
							optionspdd_pie.series[0].data = '[{"name":"Invoice with Ageing","y":0,"count":0},{"name":"Insurance with Ageing","y":0,"count":0},{"name":"RC Book with Ageing","y":0,"count":0}]';*/
							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
						}else{
							optionspdd_pie.series[0]= response[0];
						}

						if(response[1].data == null){
								/*optionspdd_bar.series[0].id = response[0].id;
								optionspdd_bar.series[0].color = response[0].color;
							//optionspdd_pie.series[0].id = response[0].id;
								optionspdd_bar.series[0].data = '[{"name":"Invoice with Ageing","y":0,"count":0},{"name":"Insurance with Ageing","y":0,"count":0},{"name":"RC Book with Ageing","y":0,"count":0}]';*/
//							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
						}else{
							optionspdd_bar.series[0] = response[1];
						}
						var chart4 = new Highcharts.Chart(optionspdd_pie);
						var chart5 = new Highcharts.Chart(optionspdd_bar);

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
         //   chart_5 = getGraph('example4');
         //   chart_6 = getGraph('example5');
		//	chart_7 = getGraph('example6');
		//	chart_8 = getGraph('example7');
        });
      });

    $(function() {
    //Maximum  date for which the analytic could be done
		var max_pickup_Date = new Date();
		var maxDate = new Date(new Date(max_pickup_Date).setMonth(max_pickup_Date.getMonth()-1));
    
		$('#datetimepicker6').datetimepicker({
		  format:'DD/MM/YYYY',
		  maxDate : maxDate
		});
    //Setting the defailt date 
	    $('#datetimepicker6').data("DateTimePicker").date(new Date('1 July 2016'));  
    
    $('#datetimepicker7').datetimepicker({
      format:'DD/MM/YYYY'
    });
    
    $("#datetimepicker6 input").click(function(){
        $(".input-group-addon").click();
    });
    
    //Variable initialization
    var static_date = new Date($('#datetimepicker6 input').val());
    
    //Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker6").on("dp.change", function(e) {
      
		  $('#datetimepicker6 input').blur();
		  $("#loader").removeClass("hidden");
		  
		  var pick_up_date = new Date(e.date);
		  var one_month_foward = new Date(new Date(pick_up_date).setMonth(pick_up_date.getMonth()+1)); 
		  $('#datetimepicker7').data("DateTimePicker").date(one_month_foward);
		  
		  setTimeout(function(){
			//seed_data(pick_up_date,one_month_foward);  
		  }, 1);
		});
	});
		</script>