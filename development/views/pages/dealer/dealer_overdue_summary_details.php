<html>
<head>
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$CI->load->helper('report');

checkCustomerType('dealer');
$dealer_code=$CI->session->getProfileData("login");
?>
</head>
<body>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
			   
		   
<table id="idetails_summary" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo ucwords(strtolower('PROSPECT NO'));?></th>
				<th><?php echo ucwords(strtolower('AGMTNO'));?></th>
				<th><?php echo ucwords(strtolower('CUSTOMER NAME'));?></th>
				<th><?php echo ucwords(strtolower('DEALER CODE'));?></th>
				<th><?php echo ucwords(strtolower('ADDRESS'));?></th>
				<th><?php echo ucwords(strtolower('PHONE NUMBER'));?></th>
				<th><?php echo ucwords(strtolower('VEHICLE NO'));?></th>
				<th><?php echo ucwords(strtolower('LOAN AMOUNT'));?></th>
				<th><?php echo ucwords(strtolower('TENOR'));?></th>
				<th><?php echo ucwords(strtolower('EMI PAID'));?></th>
				<th><?php echo ucwords(strtolower('OVERDUE'));?></th>
				<th><?php echo ucwords(strtolower('BUCKET'));?></th>
				<th><?php echo ucwords(strtolower('OS PRINCIPAL'));?></th>
				
            </tr>
        </thead>
        
    </table>
    <div class="row">
			
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
			  <div class="row">
				<div class='col-sm-12 form-inline datetimepickerwrapper'>
				  <div class="form-group">
					<label>From</label>
					<div class='input-group date' id='datetimepicker_22'>

					  <input type='text' value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-3,date("d"),date("Y")));?>" class="form-control"  data-provide="datepicker"  />
					  <span class="input-group-addon click_22">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>

				  <div class="form-group">
					<label>To</label>
					<div class='input-group date' id='datetimepicker_23'>

					  <input type='text' class="form-control" value="<?php echo date("d/m/Y");?>" />
					  <span class="input-group-addon click_23">
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
		    <p>&nbsp;</p>
</div>

<script type="text/javascript">
	//	  $('select').niceSelect();

		</script>

<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();





function data_fetch_overdue(start,end,dealercode)
{
var param = {
			'startDate' : start,
			'endDate': end,
			'dealerCode': dealercode
		};
var ddtable;
ddtable = $('#idetails_summary').DataTable( {
	
	  "scrollX": true,
		  dom: 'Bfrtip',
			buttons: [
				{
					extend: 'excelHtml5',
					title: 'Collection Incentive Details'
				},
				{
					extend: 'pdfHtml5',
					title: 'Collection Incentive Details',
					orientation: 'landscape',
					pageSize: 'LEGAL'
				},
				{
					extend: 'csvHtml5',
					title: 'Collection Incentive Details'
				}
			],
//		 "responsive":true,
		"ajax": {
				"url": "/cc/DealerCustom/getOrderSummaryRestData",
				"dataSrc": "",
				"method": 'post',
				"data": param,
				// "success": function(result){
				// 				console.log(result)
				// }
			},
			"columns": [
		{
				"data": "PROSPECT_NO",
				"defaultContent": "<i>Not set</i>"
		},
		{
				"data": "AGMTNO",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "CUSTOMER_NAME",
				"defaultContent": "<i>Not set</i>"
		},
		{
					"data": "DEALER_CODE",
					"defaultContent": "<i>Not set</i>"
		},
	    {
					"data": "ADDRESS",
					"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "PHONE_NUMBER" ,
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "VEHICLE_NO",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "LOAN_AMOUNT",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "TENUR",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "EMI_PAID",
			"defaultContent": "<i>Not set</i>"
		},
		{
				"data": "OVERDUE",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "BUCKET",
				"defaultContent": "<i>Not set</i>"
		},
		{
					"data": "OS_PRINCIPAL",
					"defaultContent": "<i>Not set</i>"
		}
	
		],
		"bDestroy": true
	} );

	// console.log('response',response)

}

 </script>
 <script type="text/javascript">
var pick_upstart_date = new Date(moment($('#datetimepicker_22 input').val(), 'DD/MM/YYYY', true).format());
var pick_upend_date = new Date(moment($('#datetimepicker_23 input').val(), 'DD/MM/YYYY', true).format());
var dealercode = '<?php echo $dealer_code;?>';

$(document).ready(function(){
$("#loader").removeClass("hidden");
// 
console.log(pick_upstart_date,pick_upend_date,dealercode);
data_fetch_overdue(pick_upstart_date,pick_upend_date,dealercode);
setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
});
$(function() {
    //Maximum  date for which the analytic could be done
    var max_pickup_Date = new Date();
    var maxDate = new Date(new Date(max_pickup_Date).setMonth(max_pickup_Date.getMonth()-3));
    
	//alert(maxDate);
	//alert("good");
    $('#datetimepicker_22').datetimepicker({
      format:'DD/MM/YYYY',
		widgetPositioning: {
            horizontal: 'right',
            vertical: 'top'
        }
      //maxDate : maxDate
    });
    //Setting the defailt date 
   // $('#datetimepicker_6').data("DateTimePicker").date(new Date('1 July 2016'));  
    
    $('#datetimepicker_23').datetimepicker({
      format:'DD/MM/YYYY'
    });
    
    $("#datetimepicker_22 input").click(function(){
        $(".click_22").click();
    });

	$("#datetimepicker_23 input").click(function(){
        $(".click_23").click();
    });
    
    //Variable initialization
    var static_sdate = new Date(moment($('#datetimepicker_22 input').val(), 'DD/MM/YYYY', true).format());
	//alert(static_sdate);
    
    //Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker_22").on("dp.change", function(e) {
      
      $('#datetimepicker_22 input').blur();
     // $("#loader").removeClass("hidden");
      
      pick_upstart_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker_22').data("DateTimePicker").date(e.date);
      
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  //alert(diff_mon);
	   console.log("Diff: ",diff_mon);
		if(diff_mon <=365  && diff_mon != 0){
			 $("#loader").removeClass("hidden");
			 // console.log("On  ready call");
			 data_fetch_overdue(moment(pick_upstart_date).format( 'DD/MM/YYYY'),moment(pick_upend_date).format( 'DD/MM/YYYY'),dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
		  }
		  else
		  {
		  	console.log(diff_mon)
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference cannot be greater than Twelve Months.</div>');
						
		  }
     
    });


	//Checking for any change in the Date Time Picker input box to manipulate the chart data accordingly  
    $("#datetimepicker_23").on("dp.change", function(e) {
      
      $('#datetimepicker_23 input').blur();
     
      
      //var pick_upend_date = new Date(e.date);
	  pick_upend_date = new Date(moment(e.date, 'DD/MM/YYYY', true).format());
	  $('#datetimepicker_23').data("DateTimePicker").date(e.date);
      //var one_month_foward = new Date(new Date(pick_up_date).setMonth(pick_up_date.getMonth()+1)); 
      //$('#datetimepicker_7').data("DateTimePicker").date(one_month_foward);
      
     // alert(pick_upstart_date);
	 // alert(pick_upend_date);
	  var diff_mon = getMonthsDiff(pick_upstart_date,pick_upend_date);
	  console.log("Diff: ",diff_mon);
		if(diff_mon <=365  && diff_mon != 0){
			 $("#loader").removeClass("hidden");
			 
		 data_fetch_overdue(moment(pick_upstart_date).format( 'DD/MM/YYYY'),moment(pick_upend_date).format( 'DD/MM/YYYY'),dealercode);
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
		  }else{
					bootbox.alert('<div class="alert alert-warning"><strong>Month Difference cannot be greater than Twelve Months.</div>');
						
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

return moment([endDate.getFullYear(), endDate.getMonth(), endDate.getDate()]).diff(moment([startDate.getFullYear(), startDate.getMonth(), startDate.getDate()]), 'Days'); //12


};




</script>
</body>
</html>