<html>
<head>

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
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
			  <div class="row">
				<div class='col-sm-12 form-inline'>
					  <div class="form-group">
						<label>Date Range</label>
						<div class='select-group' id='date-range_1'>

						  <select name="yearval_1" id="yearval_1" class="wide">
							  <?php
							  $count = 1;
							  $datadisplay = '';
							  for($i=date("Y")+1;$i >= 2000;$i--){
								//	if($count ==1)
											//$datadisplay = 'data-display="Select"';
								//	else
											//$datadisplay = '';
									echo ' <option  value="'.($i-1).'-'.$i.'">'.($i-1).'-'.$i.'</option>';
									$count++;
								}
								?>
							  
							</select>
						  
						</div>
					  </div>

				  <div class="form-group">
					<label>Month</label>
					<div class='input-group date' id='month_1'>

					  <select name="monthval_1" id="monthval_1" class="wide">
						  <?php
						  for($i=1;$i<=12;$i++){
								echo ' <option '.$datadisplay.' value="'.date("M",mktime(0,0,0,$i,1,date("Y"))).'">'.date("M",mktime(0,0,0,$i,1,date("Y"))).'</option>';
						  }
						  ?>
						</select>
					 
					</div>
				  </div>
				</div>
			  </div>

			</div>
    <p>&nbsp</p>
<table id="icdetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Business Count</th>
				<th>Comm Amount</th>
				<th>Delay INT AMT</th>
				<th>Demand Amount</th>
				<th>Final Pay</th>
				<th>Mode Type</th>
				<th>Month</th>
				<th>NET Pay</th>
				<th>Paid DT</th>
				<th>Received AMT</th>
				<th>GST Amount</th>
				<th>GST PREC</th>
				<th>TR TAT</th>
				
            </tr>
        </thead>
        
    </table>



		<script type="text/javascript">
//var table = $('#example').DataTable();
$("#loader").removeClass("hidden");
var ddctable;
ddctable = $('#icdetails').DataTable( {
	
	 "scrollX": true,
		  dom: 'Bfrtip',
			buttons: [
				{
					extend: 'excelHtml5',
					title: 'Collection Incentive'
				},
				{
					extend: 'pdfHtml5',
					title: 'Collection Incentive',
					orientation: 'landscape',
					pageSize: 'LEGAL'
				},
				{
					extend: 'csvHtml5',
					title: 'Collection Incentive'
				}
			],
//		 "responsive":true,
		"ajax": {
				"url": "/cc/DealerCustom/getCollectionIncentiveSummarySoapData",
				"dataSrc": "",
				"method": 'post',
				"data": {
						method: 'GetDealerCollectionIncentiveSummaryDetails',
						date_range: $("#yearval_1").val(),
						month_sel: $("#monthval_1").val(),
						dealer_code:'<?php echo $dealer_code;?>'
				}
			},
		
	"columns": [
		{
				"data": "Business_Count",
				"defaultContent": "<i>Not set</i>"
		},
		{
				"data": "COMM_AMOUNT",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "DELAY_INT_AMT",
				"defaultContent": "<i>Not set</i>"
		},
		{
					"data": "DEMAND_AMOUNT",
					"defaultContent": "<i>Not set</i>"
		},
	    {
					"data": "FINAL_PAY",
					"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "MODE_TYPE" ,
			"defaultContent": "<i>Not set</i>"
		},
		{ "data": "MONTH" },
		{ "data": "NET_PAY" },
		{ "data": "PAID_DT" },
		{ "data": "RECEIVED_AMT" },
		{ "data": "TDS_AMOUNT" },
		{ "data": "TDS_PREC" },
		{ "data": "TR_TAT" }
		],
		"bDestroy": true
	} );
setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
function updateCollectionTableData(method,date_range,month_sel,dealer_code){

			$("#loader").removeClass("hidden");
			 var url = "/cc/DealerCustom/reloadCollectionIncentiveSoapData?method="+method+"&date_range="+date_range+"&month_sel="+month_sel+"&dealer_code="+dealer_code;
			ddctable.ajax.url(url).load();
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
}

$( "#monthval_1" ).change(function() {
		//alert( "Handler for .change() called." );
		var	method = 'GetDealerCollectionIncentiveSummaryDetails';
		var date_range = $("#date-range_1 select").val();
		var month_sel = $("#month_1 select").val();
		var dealer_code =  '<?php echo $dealer_code;?>';
		updateCollectionTableData(method,date_range,month_sel,dealer_code);
});

$( "#yearval_1" ).change(function() {
		/*
		$.getJSON(url, null, function (json) {
		dt.fnClearTable();
		dt.fnAddData(json.aaData);
		dt.fnDraw();
	});
*/
	var	method = 'GetDealerCollectionIncentiveSummaryDetails';
	var date_range = $("#date-range_1 select").val();
	var month_sel = $("#month_1 select").val();
	var dealer_code = 3406 ;

	updateCollectionTableData(method,date_range,month_sel,dealer_code);

				
});
//updateTableData();
 </script>
</body>
</html>