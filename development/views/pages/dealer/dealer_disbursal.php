<html>
<head>

<style type="text/css">
.rn_Body{
min-height: 1400px !important;
}
    .float input[type="text"]
    {
        width:150px !important;
    }
.rn_Footer
    {
           width: 1400px;
    right: 60px;
    position: relative; 
    }
.scrollbar::-webkit-scrollbar
{
    width: 6px;
    background-color: #000000;
}
 
.scrollbar::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #FFFFFF;
}
</style>
</head>
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$CI->load->helper('report');

checkCustomerType('dealer');
$dealer_code=$CI->session->getProfileData("login");
?>
<body>

		 <input type="hidden" name="hfFirstYear" id="hfFirstYear" value="<?php echo date("Y");?>" />
		<input type="hidden" name="hfSecondYear" id="hfSecondYear" value="<?php echo date("Y")+1;?>" />

		<input type="hidden" name="hfyear1" id="hfyear1" value="<?php echo date('d/m/Y', mktime(0,0,0,date("m")-3,date("d"),date("Y")));?>" />
		
		<input type="hidden" name="hfyear2" id="hfyear2" value="<?php echo date('d/m/Y');?>" />

<script type="text/javascript">
var baroption;
$(function () {
    // Set up the chart
   // var chart = new Highcharts.Chart({
	   baroption = {
        chart: {
            renderTo: 'container',
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 15,
                depth: 50,
                viewDistance: 25
            }
        },
        title: {
                useHTML: true,
                text: '<a href="/app/dealer/dealer_disbursal_detail#dealerDisbursal" id="linktosales">Summary details for Dealer disbursal</a>'
            },
            subtitle: {
                useHTML: true,
                text:'*Click above link to view the Transaction wise details*',
                style:{
                    color:'green',
                    fontSize: '14px',
                }
            },
            xAxis: {
                /*categories: ['APR'+'-'+$("[id$=hfFirstYear]").val(), 'MAY'+'-'+$("[id$=hfFirstYear]").val(), 'JUN'+'-'+$("[id$=hfFirstYear]").val(),
                    'JUL'+'-'+$("[id$=hfFirstYear]").val(), 'AUG'+'-'+$("[id$=hfFirstYear]").val(), 'SEP'+'-'+$("[id$=hfFirstYear]").val(), 
                    'OCT'+'-'+$("[id$=hfFirstYear]").val(), 'NOV'+'-'+$("[id$=hfFirstYear]").val(), 'DEC'+'-'+$("[id$=hfFirstYear]").val(),
                    'JAN'+'-'+$("[id$=hfSecondYear]").val(),'FEB'+'-'+$("[id$=hfSecondYear]").val(), 'MAR'+'-'+$("[id$=hfSecondYear]").val()],*/
				//categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				type: 'category',
                crosshair: false,
                tickLength: 5,
            },
            yAxis: {
                title: {
                    text: 'Disbursal No'
                },
                floor: 0,
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
            
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


});
		</script>

		<script type="text/javascript">
		var options_line;
$(document).ready(function(){
        //var chart1 = new Highcharts.Chart({
			 options_line = {
            chart: {
                zoomType: 'x',
                margin: 100,
				 renderTo: 'line',
            },
            title: {
                useHTML: true,
                text: '<a href="#" id="linktosales">Sales Disbursed Count</a>'
            },
            subtitle: {
                useHTML: true,
                text:'*Click above link to view the Sales Disbursed Count*',
                style:{
                    color:'green',
                    fontSize: '14px',
                }
            },
            xAxis: {

				//categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				type: 'category',
                crosshair: false,
                tickLength: 5,
            },
            yAxis: {
                title: {
                    text: 'Disbursal No'
                },
                floor: 0,
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }],
            
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
			/*$.getJSON('data.json', function(data) {
				options.series[0].data = data;
				var chart = new Highcharts.Chart(options);
			});*/
});

		</script>
		
	</head>
	<body>
	
	<div class="col-sm-9 col-md-9 col-lg-12" id="contemt-main">
              
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" id="">
				 <div class="row">
						<div class='col-sm-12 form-inline'>
									<select name="graphdata" id="graphdata" class=" btn btn-default">
											<option value="1" selected>Bar Graph</option>
											<option value="2">Line Graph</option>
									</select>
									</div>
				        </div>
                </div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                  <div class="row">
						<div class='col-sm-12 form-inline datetimepickerwrapper'>
								<select name="ddlyear" id="ddlyear_1" class=" btn btn-default">
										<?php
										for($i=date("Y");$i>=2008;$i--){
										?>
										<option value="<?php echo date($i);?>" <?php if($i == date("Y")) { echo "selected"; } ?> ><?php echo $i;?></option>
										<?php } ?>
									</select>
                    </div>
        </div>
</div></div>
<div class="clearfix"><p>&nbsp;</p></div>
<div class="row">
	<div class="col-sm-12">
		<div id="container"></div>
	</div>
</div>
<div class="clearfix"><p>&nbsp;</p></div>

<div class="row">
	<div class="col-sm-12">
	  <div id="line"></div>
	</div>
</div>


</div>
<div class="clearfix"><p>&nbsp;</p></div>


<div class="col-sm-12 col-md-12 col-lg-12 algin-left">
              
		  <div class="row">
			
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
			  <div class="row">
				<div class='col-sm-12 form-inline datetimepickerwrapper'>
				  <div class="form-group">
					<label>From</label>
					<div class='input-group date' id='datetimepicker_14'>

					  <input type='text' value="<?php echo date("d/m/Y",mktime(0,0,0,4,1,date("Y")));?>" class="form-control"  data-provide="datepicker"  />
					  <span class="input-group-addon click_14">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>

				  <div class="form-group">
					<label>To</label>
					<div class='input-group date' id='datetimepicker_15'>

					  <input type='text' class="form-control" value="<?php echo date("d/m/Y");?>" />
					  <span class="input-group-addon click_15">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>
				</div>
			  </div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
			 
			</div>
			</div>
		  </div>
<div class="clearfix"><p>&nbsp;</p></div>

              
		  <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
					<div id="data_api"></div>
				</div>
			</div>
<script type="text/javascript">

    

	/**
 * Request data from the server, add it to the graph and set a timeout 
 * to request again
 */
	function requestData(pick_up_date , one_month_foward) {
		var param = {
			'startDate' : pick_up_date,
			'endDate': one_month_foward,
			'dealerCode': '<?php echo $dealer_code;?>'
		};
		$.ajax({
			url: '/cc/DealerCustom/getSalesDisbursedCount',
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
				options_line.series[0].id = response[0].id;
				options_line.series[0].name = response[0].name;
				options_line.series[0].data = response[0].data;
				//options_line.series[1] = response[1];
				baroption.series[0] = response[0];
				//baroption.series[1] = response[1];
				//console.log(options_line);
				var chart1 = new Highcharts.Chart(options_line);
				var chart = new Highcharts.Chart(baroption);

				$('#line').hide();
				/* Bar Chart
				options_bar.series[0].data = data;
				options_bar.series[1].data = data;
				
				var chart = new Highcharts.Chart(options_bar);*/
			/*	 var ddata = response[0].data;
				    $('#disburse_table').dataTable( {
					"paging":   false,
			        "ordering": false,
					"searching": false, 
					"aaData": [
						/* Reduced data set 
						[ddata[0].y, ddata[1].y, ddata[2].y, ddata[3].y, ddata[4].y,ddata[5].y, ddata[6].y, ddata[7].y, ddata[8].y, ddata[9].y,ddata[10].y, ddata[11].y]
						
					],
					"aoColumns": [
						{ "sTitle": "Jan" , "sClass": "center" },
						{ "sTitle": "Feb" , "sClass": "center" },
						{ "sTitle": "Mar", "sClass": "center"  },
						{ "sTitle": "Apr", "sClass": "center" },
						{ "sTitle": "May", "sClass": "center" },
						{ "sTitle": "Jun" , "sClass": "center" },
						{ "sTitle": "Jul" , "sClass": "center" },
						{ "sTitle": "Aug", "sClass": "center"  },
						{ "sTitle": "Sept", "sClass": "center" },
						{ "sTitle": "Oct", "sClass": "center" },
						{ "sTitle": "Nov", "sClass": "center"  },
						{ "sTitle": "Dec", "sClass": "center" }
					]
				} );   */

				$("#loader").addClass("hidden");   
			},
			cache: false
		});

		
}

   

  //});
//});
// moment([new Date().getFullYear(),3,1])
		//requestData($("[id$=hfyear1]").val(),$("[id$=hfyear2]").val());
		requestData(moment([new Date().getFullYear(),3,1]).format('DD/MM/YYYY'),$("[id$=hfyear2]").val());

</script>

<script type="text/javascript">
var pick_upstart_date = new Date(moment($('#datetimepicker_14 input').val(), 'DD/MM/YYYY', true).format());
var pick_upend_date = new Date(moment($('#datetimepicker_15 input').val(), 'DD/MM/YYYY', true).format());
var dealercode = '<?php echo $dealer_code;?>';
var maxDate;
$(function() {
    //Maximum  date for which the analytic could be done
    var max_pickup_Date = new Date();
    //var maxDate = new Date(new Date(max_pickup_Date).setMonth(max_pickup_Date.getMonth()-3));
    maxDate = new Date (new Date(new Date(max_pickup_Date).setMonth(3)).setDate(1));
    //console.log("Maxdate",maxDate);
	//alert(maxDate);
	//alert("good");
    $('#datetimepicker_14').datetimepicker({
      format:'DD/MM/YYYY',
		widgetPositioning: {
            horizontal: 'right',
            vertical: 'top'
        }
      //maxDate : maxDate
    });
    //Setting the defailt date 
   // $('#datetimepicker_6').data("DateTimePicker").date(new Date('1 July 2016'));  
    
    $('#datetimepicker_15').datetimepicker({
      format:'DD/MM/YYYY'
    });
    
    $("#datetimepicker_14 input").click(function(){
        $(".click_14").click();
    });

	$("#datetimepicker_15 input").click(function(){
        $(".click_15").click();
    });
    
    //Variable initialization
    var static_sdate = new Date(moment($('#datetimepicker_14 input').val(), 'DD/MM/YYYY', true).format());
	//alert(static_sdate);
    
    //Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker_14").on("dp.change", function(e) {
      
      $('#datetimepicker_14 input').blur();
     // $("#loader").removeClass("hidden");
      
      pick_upstart_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker_14').data("DateTimePicker").date(e.date);
      
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  //alert(diff_mon);
		if(diff_mon <=12  && diff_mon >= 0){
			 $("#loader").removeClass("hidden");
			 
			 updateDisbursalData(moment(pick_upstart_date).format( 'DD/MM/YYYY'),moment(pick_upend_date).format( 'DD/MM/YYYY'),dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
		  }else{
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference can not be greater than 12 Months.</div>');
						
		  }
     
    });


	//Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker_15").on("dp.change", function(e) {
      
      $('#datetimepicker_15 input').blur();
     
      
      //var pick_upend_date = new Date(e.date);
	  pick_upend_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker_15').data("DateTimePicker").date(e.date);
      //var one_month_foward = new Date(new Date(pick_up_date).setMonth(pick_up_date.getMonth()+1)); 
      //$('#datetimepicker_7').data("DateTimePicker").date(one_month_foward);
      
     // alert(pick_upstart_date);
	 // alert(pick_upend_date);
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  //alert(diff_mon);
		if(diff_mon <=12  && diff_mon >= 0){
			 $("#loader").removeClass("hidden");
			 
		 updateDisbursalData(moment(pick_upstart_date).format( 'DD/MM/YYYY'),moment(pick_upend_date).format( 'DD/MM/YYYY'),dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
		  }else{
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference can not be greater then 12 Months.</div>');
						
		  }
    });
});

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

function updateDisbursalData(sdate,edate,dcode){

	var param = {
			'startDate' : sdate,
			'endDate': edate,
			'dealerCode': dcode
		};
		$.ajax({
			url: '/cc/DealerCustom/getSalesDisbursedCountData',
			data: param,
			method: 'post',
			beforeSend: function() {
					$("#loader").removeClass("hidden");   
			},
			success: function(response) {
			//	alert(response);
				//$("#loader").addClass("hidden");   
					$('#data_api').html(response);
			}
		});
}
updateDisbursalData(moment(maxDate).format('DD/MM/YYYY'),$('#datetimepicker_15 input').val(),dealercode);

$('#graphdata').change(function(){
	
	var value = $('#graphdata').val();
	if(value == 1){
			$('#container').show();
			$('#line').hide();
	}else{
			$('#container').hide();
			$('#line').show();
	}

});

//requestDisbursalData
$('#ddlyear_1').on('change', function(){
		var selYear = $('#ddlyear_1').val();
		//alert(selYear);
		var s_date = '01/01/'+selYear;
		var e_date = '31/12/'+selYear;
		requestData(s_date,e_date);
});
</script>
</body>
</html>
