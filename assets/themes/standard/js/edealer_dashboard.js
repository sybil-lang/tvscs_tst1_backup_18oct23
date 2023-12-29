/*
 FusionCharts JavaScript Library
 Copyright FusionCharts Technologies LLP
 License Information at <http://www.fusioncharts.com/license>
*/
 /**
 *  Dashboard Controllers
    The given below code will render all the charts that you see when the file is loaded
 */
//Creating the users chart for the no. of user that visited in that month

//$(document).ready(function() {

//Disbursal Count

  var baroption;
//$(function () {
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
                text: '<a href="/app/employee/dealer_disbursal_detail" id="linktosales">Summary details for Dealer disbursal</a>'
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
				type:'category',
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

// Disbursal Pending
var optionsdpdd_bar;
optionsdpdd_bar = {
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

var optionsdpdd_pie;
//$('#pddpiechart1').highcharts({
optionsdpdd_pie = {
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

// PDD Pending
var optionspdd_bar;
optionspdd_bar = {
//$('#pddbarchart1').highcharts({
            chart: {
                type: 'column',
                margin: 75,
				renderTo: 'pddbarchart1',
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 15,
                    depth: 70
                }
            },
            title: {
                text: 'AGEING WISE SUMMARY'
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
                pointFormat: 'COUNT :<b>{point.count}</b>',
                valueSuffix: ' ',
            },
            lang: {
                noData: "No Data Available"
            },
            legend:{
                align: 'center',
                itemHiddenStyle: {
                    color: '#054fa4 '
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

var optionspdd_pie;
//$('#pddpiechart1').highcharts({
optionspdd_pie = {
	chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
				renderTo: 'pddpiechart1',
                type: 'pie'
            },
            title: {
                text: 'AGEING WISE SUMMARY'
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

var optionspdd_line;
//});
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
                    fillColor: '#F62459',
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

var pick_upstart_date = new Date(moment($('#datetimepicker6 input').val(), 'DD/MM/YYYY', true).format());
var pick_upend_date = new Date(moment($('#datetimepicker7 input').val(), 'DD/MM/YYYY', true).format());
var dealercode = '<?php echo $dealer_code;?>';
$(function() {
    //Maximum  date for which the analytic could be done
    var max_pickup_Date = new Date();
    var maxDate = new Date(new Date(max_pickup_Date).setMonth(max_pickup_Date.getMonth()-3));
    
	//alert(maxDate);
	//alert("good");
    $('#datetimepicker6').datetimepicker({
      format:'DD/MM/YYYY',
		widgetPositioning: {
            horizontal: 'right',
            vertical: 'bottom'
        }
      //maxDate : maxDate
    });
    //Setting the defailt date 
   // $('#datetimepicker_6').data("DateTimePicker").date(new Date('1 July 2016'));  
    
    $('#datetimepicker7').datetimepicker({
      format:'DD/MM/YYYY'
    });
    
    $("#datetimepicker6 input").click(function(){
        $(".click6").click();
    });

	$("#datetimepicker7 input").click(function(){
        $(".click7").click();
    });
    
    //Variable initialization
    var static_sdate = new Date(moment($('#datetimepicker6 input').val(), 'DD/MM/YYYY', true).format());
	//alert(static_sdate);
    
    //Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker6").on("dp.change", function(e) {
      
      $('#datetimepicker6 input').blur();
     // $("#loader").removeClass("hidden");
      
      pick_upstart_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker6').data("DateTimePicker").date(e.date);
      
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  //alert(diff_mon);
		if(diff_mon <=12  && diff_mon >= 0){
			 $("#loader").removeClass("hidden");
			 
			 updateDashboardData(pick_upstart_date,pick_upend_date,dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
		  }else{
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference can not be greater then Three Months.</div>');
						
		  }
     
    });


	//Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker7").on("dp.change", function(e) {
      
      $('#datetimepicker7 input').blur();
     
      
      //var pick_upend_date = new Date(e.date);
	  pick_upend_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker7').data("DateTimePicker").date(e.date);
      //var one_month_foward = new Date(new Date(pick_up_date).setMonth(pick_up_date.getMonth()+1)); 
      //$('#datetimepicker_7').data("DateTimePicker").date(one_month_foward);
      
     // alert(pick_upstart_date);
	 // alert(pick_upend_date);
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  //alert(diff_mon);
		if(diff_mon <=12  && diff_mon >= 0){
			 $("#loader").removeClass("hidden");
			 
		 updateDashboardData(pick_upstart_date,pick_upend_date,dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
		  }else{
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference can not be greater then Three Months.</div>');
						
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

function updateDashboardData(startDate,endDate,dcode){

//alert(startDate);
//alert(endDate);
		$("[id$=hfyear1]").val(moment(startDate).format( 'DD/MM/YYYY'));
		$("[id$=hfyear2]").val(moment(endDate).format( 'DD/MM/YYYY'));
		var	chart_1 = getGraph('graph1','getSalesDisbursedCount',dcode);
        var  chart_2 = getGraph('graph2','getSalesPerformanceChartSummary',dcode);
        var chart_3 = getGraph('graph3','getPDDAgeingChartSummary',dcode);
        var chart_4 = getGraph('graph4','getSalesPerformanceSummary',dcode);

}