<html>
<head>
<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$CI->load->helper('report');

checkCustomerType('internal employee');
//$dealer_code=$CI->session->getProfileData("login");
$userProfile = $CI->session->getSessionData('userProfile');
$dealer_code = $userProfile['dealer_codes'];
?>
</head>
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
   <p>&nbsp;</p>
<table id="idetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo ucwords(strtolower('ACCOUNT CODE'));?></th>
				<th><?php echo ucwords(strtolower('AGREEMENT NO'));?></th>
				<th><?php echo ucwords(strtolower('BRANCH NAME'));?></th>
				<th><?php echo ucwords(strtolower('COMM AMT'));?></th>
				<th><?php echo ucwords(strtolower('CUSTOMER NAME'));?></th>
				<th><?php echo ucwords(strtolower('DEALER CODE'));?></th>
				<th><?php echo ucwords(strtolower('DEALER NAME'));?></th>
				<th><?php echo ucwords(strtolower('DELAY INT AMT'));?></th>
				<th><?php echo ucwords(strtolower('DEMAND AMOUNT'));?></th>
				<th><?php echo ucwords(strtolower('DEMAND DATE'));?></th>
				
				<th><?php echo ucwords(strtolower('FINAL PAY'));?></th>
				<th><?php echo ucwords(strtolower('MODE TYPE'));?></th>
				<th><?php echo ucwords(strtolower('MONTH'));?></th>
				<th><?php echo ucwords(strtolower('NET PAY'));?></th>
				<th><?php echo ucwords(strtolower('PAID DT'));?></th>
				<th><?php echo ucwords(strtolower('PROSPECT NO'));?></th>
				<th><?php echo ucwords(strtolower('RECEIPT DATE'));?></th>
				<th><?php echo ucwords(strtolower('RECEIPT NUMBER'));?></th>
				<th><?php echo ucwords(strtolower('RECEIPT TYPE'));?></th>
				<th><?php echo ucwords(strtolower('RECEIVED AMT'));?></th>

				<th><?php echo ucwords(strtolower('SLAB PERC'));?></th>
				<th><?php echo ucwords(strtolower('TDS AMT'));?></th>
				<th><?php echo ucwords(strtolower('TDS PERC'));?></th>
				<th><?php echo ucwords(strtolower('TR DATE'));?></th>
				<th><?php echo ucwords(strtolower('TR TAT'));?></th>
				<th><?php echo ucwords(strtolower('Year'));?></th>
            </tr>
        </thead>
        
    </table>
<script type="text/javascript">
		 // $('select').niceSelect();

		</script>

<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();
$("#loader").removeClass("hidden");
var ddtable;
ddtable = $('#idetails').DataTable( {
	 
	 "scrollX": true,
	  dom: 'Bfrtip',
		buttons: [
			{
				extend: 'pdfHtml5',
				orientation: 'landscape',
				pageSize: 'LEGAL'
				
			}
		],
//		 "responsive":true,
		"ajax": {
				"url": "/cc/DealerCustom/getCollectionDetailsSoapData",
				"dataSrc": "",
				"method": 'post',
				"data": {
						method: 'GetDealerCollectionIncentiveDetails',
						date_range: $("#yearval").val(),
						month_sel: $("#monthval").val(),
						dealer_code:'<?php echo $dealer_code;?>'
				},
				/*"success": function(result){
								$("#loader").addClass("hidden");
				}*/
			},
			"columns": [
		{
				"data": "ACCOUNT_CODE",
				"defaultContent": "<i>Not set</i>"
		},
		{
				"data": "AGREEMENT_NO",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "BRANCH_NAME",
				"defaultContent": "<i>Not set</i>"
		},
		{
					"data": "COMM_AMT",
					"defaultContent": "<i>Not set</i>"
		},
	    {
					"data": "CUSTOMER_NAME",
					"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "DEALER_CODE" ,
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "DEALER_NAME",
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
			"data": "DEMAND_DATE",
			"defaultContent": "<i>Not set</i>"
		},
		{
				"data": "FINAL_PAY",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "MODE_TYPE",
				"defaultContent": "<i>Not set</i>"
		},
		{
					"data": "MONTH",
					"defaultContent": "<i>Not set</i>"
		},
	    {
					"data": "NET_PAY",
					"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "PAID_DT" ,
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "PROSPECT_NO",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "RECEIPT_DATE",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "RECEIPT_NUMBER",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "RECEIPT_TYPE",
			"defaultContent": "<i>Not set</i>"
		},
	    {
					"data": "RECEIVED_AMT",
					"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "SLAB_PERC" ,
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "TDS_AMT",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "TDS_PERC",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "TR_DATE",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "TR_TAT",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "YEAR",
			"defaultContent": "<i>Not set</i>"
		}
		],
		"bDestroy": true
	} );
setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
function updateCollectionTableData(method,date_range,month_sel,dealer_code){

			$("#loader").removeClass("hidden");
			 var url = "/cc/DealerCustom/reloadCollectionDetailsSoapData?method="+method+"&date_range="+date_range+"&month_sel="+month_sel+"&dealer_code="+dealer_code;
			ddtable.ajax.url(url).load();
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
}

$( "#monthval_1" ).change(function() {
		//alert( "Handler for .change() called." );
		var	method = 'GetDealerCollectionIncentiveDetails';
		var date_range = $("#date-range_1 select").val();
		var month_sel = $("#month_1 select").val();
		var dealer_code = '<?php echo $dealer_code;?>' ;
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
	var	method = 'GetDealerCollectionIncentiveDetails';
	var date_range = $("#date-range_1 select").val();
	var month_sel = $("#month_1 select").val();
	var dealer_code = '<?php echo $dealer_code;?>' ;

	updateCollectionTableData(method,date_range,month_sel,dealer_code);

				
});
//updateTableData();
 </script>
</body>
</html>