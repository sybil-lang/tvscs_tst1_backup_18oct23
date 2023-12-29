<html>
<head>

<style type="text/css">
.rn_Body{
min-height: 1400px !important;
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
		<input type="hidden" name="hfyear1" id="hfyear1" value="<?php echo date('d/m/Y', mktime(0,0,0,1,1,date("Y")));?>" />
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
                text: '<a href="/app/dealer/dealer_disbursal_detail" id="linktosales">Summary details for Dealer disbursal</a>'
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
				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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

				categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
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
									&nbsp;
                </div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                  <div class="row">
						<div class='col-sm-12 form-inline datetimepickerwrapper'>
								<select name="ddlyear" id="ddlyear" class=" btn btn-default">
										<?php
										for($i=date("Y");$i<=2008;$i++){
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

<div class="row">
	<div class="col-sm-12">
		<p align="center"><a href="/app/dealer/dealer_disbursal_detail" id="linktosales"><h3>Summary details for Dealer disbursal</h3></a></p>
	</div>
</div>
<table id="disburse_table" class="display" cellspacing="0" width="100%">
               
    </table>
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
				/* Bar Chart
				options_bar.series[0].data = data;
				options_bar.series[1].data = data;
				
				var chart = new Highcharts.Chart(options_bar);*/
				 var ddata = response[0].data;
				    $('#disburse_table').dataTable( {
					"paging":   false,
			        "ordering": false,
					"searching": false, 
					"aaData": [
						/* Reduced data set */
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
				} );   

				$("#loader").addClass("hidden");   
			},
			cache: false
		});

		
}

   

  //});
//});

		requestData($("[id$=hfyear1]").val(),$("[id$=hfyear2]").val());

</script>


</body>
</html>
