<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$CI->load->helper('report');

checkCustomerType('internal employee');
//$dealer_code=$CI->session->getProfileData("login");
$userProfile = $CI->session->getSessionData('userProfile');
$dealer_code = $userProfile['dealer_codes'];
$dealer_code = 7033;
?>
<html>
<head>
<script type="text/javascript">
function getMonthsDiff(date1,date2,roundUpFractionalMonths)
{
    //Months will be calculated between start and end dates.
    //Make sure start date is less than end date.
    //But remember if the difference should be negative.
    var startDate=date1;
    var endDate=date2;
    var inverse=false;
    if(date1>date2)
    {
        //startDate=date2;
       // endDate=date1;
        inverse=true;
		//alert("good");
	   return -1;
    }

return moment([endDate.getFullYear(), endDate.getMonth(), endDate.getDate()]).diff(moment([startDate.getFullYear(), startDate.getMonth(), startDate.getDate()]), 'months');


};
</script>
<style type="text/css">
.rn_Body{
min-height: 1400px !important;
}
</style>
</head>
<body>

		 <input type="hidden" name="hfFirstYear" id="hfFirstYear" value="<?php echo date("Y");?>" />
		<input type="hidden" name="hfSecondYear" id="hfSecondYear" value="<?php echo date("Y")+1;?>" />
		<input type="hidden" name="hfyear1" id="hfyear1" value="<?php echo date('d/m/Y', mktime(0,0,0,1,1,date("Y")));?>" />
		<input type="hidden" name="hfyear2" id="hfyear2" value="<?php echo date('d/m/Y');?>" />

		<script type="text/javascript">
		//$('#piechart2').highcharts({
var optionspdd_line;
var optionspdd_pie;
var optionspdd_bar;
	optionspdd_line = {
            chart: {
                zoomType: 'x',
				renderTo: 'disbursalcontainer',
                margin: 100,
            },
            title: {
                useHTML: true,
                text: '<a href="/app/employee/dealer_disbursal_detail" id="linktopdd">Sales Performance Details In '+$("[id$=hfFirstYear]").val()+'</a>',
            },
            subtitle: {
                useHTML: true,
                text:'*Click above link to view the Sales performance*',
                style:{
                    color:'green',
                    fontSize: '14px',
                }
            },
            xAxis: {
              // categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				type: "category",
                crosshair: false,
                tickLength: 5,
            },
            tooltip: {
                useHTML: true,
                enabled:true,
                shared:true,                
            },
            credits: {
                enabled: false
            },
            legend: {
                enabled: true,
                itemDistance:40,
                itemHiddenStyle: {
                    color: 'green'
                },
                itemHoverStyle: {
                    color: 'red'
                },
                labelFormatter: function () {
                    return this.name + '(click to hide)';
                }
            },
            plotOptions: {
                area: {
                    fillColor: 'rgba(2,160,233,.6)',
                    lineColor: 'rgba(42,148,184,1)',
                    marker: {
                        radius: 2,
                        fillColor: 'rgba(2,160,233,.8)',
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                },
                series: {
                    dataLabels: { 
                        align: 'left',
                        enabled: false,
                    },
                },
            },
			series: [{}]
          
        };


		</script>
	</head>
	<body>
	
	<div class="col-sm-9 col-md-9 col-lg-12" id="contemt-main">
              
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" id="">
									&nbsp;
                </div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                  <div class="row">
						<div class='col-sm-12 form-inline datetimepickerwrapper'>
								<select name="ddlyear" id="ddlyear" class=" btn btn-default">
										<?php
										for($i=date("Y");$i>=2008;$i--){
										?>
										<option value="<?php echo date('1/1/'.$i);?>" <?php if($i == date("Y")) { echo "selected"; } ?> ><?php echo $i;?></option>
										<?php } ?>
									</select>
                    </div>
        </div>
</div></div>
<div class="clearfix"><p>&nbsp;</p></div>
<div class="row">
	<div class="col-sm-12">
		<div id="disbursalcontainer"></div>
	</div>
</div>
<div class="clearfix"><p>&nbsp;</p></div>

<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
		  <div class="row">
			<div class='col-sm-12 form-inline datetimepickerwrapper'>
			  <div class="form-group">
				<label>From</label>
				<div class='input-group date' id='datetimepicker_8'>

				  <input type='text' class="form-control" value="<?php echo date('d/m/Y',mktime(0,0,0,date('m')-3,date('d'),date("Y")));?>" data-provide="datepicker"  />
				  <span class="input-group-addon click8">
								<span class="glyphicon glyphicon-calendar"></span>
				  </span>
				</div>
			  </div>

			  <div class="form-group">
				<label>To</label>
				<div class='input-group date' id='datetimepicker_9'>

				  <input type='text' class="form-control" value="<?php echo date('d/m/Y');?>" />
				  <span class="input-group-addon click9">
								<span class="glyphicon glyphicon-calendar"></span>
				  </span>
				</div>
			  </div>
			</div>
		  </div>

		</div>
	  </div>
	  <div class="clearfix"><p>&nbsp;</p></div>
	<div class="row">
		<div class="col-sm-6">
		  <div id="disbursalbarchart1"></div>
		</div>
		<div class="col-sm-6">
			<div id="disbursalpiechart1"></div>
		</div>
	</div>


</div>

<script type="text/javascript">
var pick_upstart_date = new Date(moment($('#datetimepicker_8 input').val(), 'DD/MM/YYYY', true).format());
var pick_upend_date = new Date(moment($('#datetimepicker_9 input').val(), 'DD/MM/YYYY', true).format());
var dealercode = '<?php echo $dealer_code;?>';
$(function() {
    //Maximum  date for which the analytic could be done
    var max_pickup_Date = new Date();
    var maxDate = new Date(new Date(max_pickup_Date).setMonth(max_pickup_Date.getMonth()-3));
    
	//alert(maxDate);
	//alert("good");
    $('#datetimepicker_8').datetimepicker({
      format:'DD/MM/YYYY'
      //maxDate : maxDate
    });
    //Setting the defailt date 
   // $('#datetimepicker_6').data("DateTimePicker").date(new Date('1 July 2016'));  
    
    $('#datetimepicker_9').datetimepicker({
      format:'DD/MM/YYYY'
    });
    
    $("#datetimepicker_8 input").click(function(){
        $(".click8").click();
    });

	$("#datetimepicker_9 input").click(function(){
        $(".click9").click();
    });
    
    //Variable initialization
    var static_sdate = new Date(moment($('#datetimepicker_8 input').val(), 'DD/MM/YYYY', true).format());
	//alert(static_sdate);
    
    //Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker_8").on("dp.change", function(e) {
      
      $('#datetimepicker_8 input').blur();
     // $("#loader").removeClass("hidden");
      
      pick_upstart_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker_8').data("DateTimePicker").date(e.date);
      //var one_month_foward = new Date(new Date(pick_up_date).setMonth(pick_up_date.getMonth()+1)); 
      //$('#datetimepicker_7').data("DateTimePicker").date(one_month_foward);
      //pick_upstart_date  = new Date(moment(pick_upstart_date, 'DD/MM/YYYY', true).format());
	  //pick_upend_date  = new Date(moment(pick_upend_date, 'DD/MM/YYYY', true).format());
	//  alert(pick_upstart_date);
	 // alert(pick_upend_date);
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  //alert(diff_mon);
		if(diff_mon <=3  && diff_mon >= 0){
			 $("#loader").removeClass("hidden");
			 
			 updateDisbursalChartData(pick_upstart_date,pick_upend_date,dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },9000);
		  }else{
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference can not be greater then Three Months.</div>');
						
		  }
     
    });


	//Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker_9").on("dp.change", function(e) {
      
      $('#datetimepicker_9 input').blur();
      $("#loader").removeClass("hidden");
      
      //var pick_upend_date = new Date(e.date);
	  pick_upend_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker_9').data("DateTimePicker").date(e.date);
      //var one_month_foward = new Date(new Date(pick_up_date).setMonth(pick_up_date.getMonth()+1)); 
      //$('#datetimepicker_7').data("DateTimePicker").date(one_month_foward);
      
     // alert(pick_upstart_date);
	 // alert(pick_upend_date);
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  //alert(diff_mon);
		if(diff_mon <=3  && diff_mon >= 0){
			 $("#loader").removeClass("hidden");
			 
			 updateDisbursalChartData(pick_upstart_date,pick_upend_date,dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },9000);
		  }else{
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference can not be greater then Three Months.</div>');
						
		  }
    });
});


	/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
	function requestDisbursalData(pick_up_date , one_month_foward) {
		var param = {
			'startDate' : pick_up_date,
			'endDate': one_month_foward,
			'dealerCode': '<?php echo $dealer_code;?>'
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
				var chart1 = new Highcharts.Chart(optionspdd_line);
		//		var chart = new Highcharts.Chart(baroption);
			
				
				$("#loader").addClass("hidden");   
			},
			cache: false
		});

		
}

function  updateDisbursalChartData(startDate, endDate, dealerCode){
			
			var param = {
				'startDate': moment(startDate).format("DD/MM/YYYY"),
				'endDate': moment(endDate).format("DD/MM/YYYY"),
				'dealerCode':dealerCode
			}
			$.ajax({
					url: '/cc/DealerCustom/getSalesPerformanceChartSummary',
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
						//alert(response[0].data);
						if(response[0].data == null){
							
							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
						}else{
							optionspdd_pie.series[0]= response[0];
						}

						if(response[1].data == null){
								
//							bootbox.alert('<div class="alert alert-warning"><strong>No Data Found.</div>');
						}else{
							optionspdd_bar.series[0] = response[1];
						}
						var chart2 = new Highcharts.Chart(optionspdd_pie);
						var chart3 = new Highcharts.Chart(optionspdd_bar);

						//$("#loader").addClass("hidden");   
					},
					cache: false
				});

   }

  //});
//});

		requestDisbursalData($("[id$=hfyear1]").val(),$("[id$=hfyear2]").val());
		updateDisbursalChartData(pick_upstart_date,pick_upend_date,dealercode);
</script>


<script type="text/javascript">
optionspdd_bar = {
//$('#pddbarchart1').highcharts({
            chart: {
                type: 'column',
                margin: 75,
				renderTo: 'disbursalbarchart1',
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 15,
                    depth: 70
                }
            },
            title: {
                text: 'SALE PERFORMANCE WISE SUMMARY'
            },

            plotOptions: {
                column: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.product}'
                    },
                    showInLegend: true,
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            tooltip: {
                shared: true,
                useHtml:true,
                pointFormat: 'COUNT :<b>{point.count}</b> <br/> VALUE :<b> {point.y}</b>',
                valueSuffix: '₹',
            },
            lang: {
                noData: "No Data Available"
            },
            legend:{
                align: 'center',
                itemHiddenStyle: {
                    color: 'green'
                },
                itemHoverStyle: {
                    color: 'red'
                },
                labelFormatter: function () {
                    return this.name + '(click to hide)';
                }
            },
            
            xAxis: {
               // categories: ['Invoice with Ageing','Insurance with Ageing','RC Book with Ageing']
			   type: 'category'
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            credits: {
                enabled: false
            },
            series: [{}]
        };

//$('#pddpiechart1').highcharts({
optionspdd_pie = {
	chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
				renderTo: 'disbursalpiechart1',
                type: 'pie'
            },
            title: {
                text: 'Sale Performance wise Summary'
            },
            tooltip: {
                pointFormat: 'COUNT :<b>{point.count}</b> <br/> VALUE :<b> {point.y}</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
			credits: {
                enabled: false
            },
            series: [{}]
};

</script>


</body>
</html>
