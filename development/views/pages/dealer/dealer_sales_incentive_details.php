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
						<div class='select-group' id='date-range'>

						  <select name="yearval" id="yearval" class="wide">
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
					<div class='input-group date' id='month'>

					  <select name="monthval" id="monthval" class="wide">
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
<table id="iidetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th><?php echo ucwords(strtolower('AGREEMENT NO'));?></th>
				<th><?php echo ucwords(strtolower('BRANCH NAME'));?></th>
				<th><?php echo ucwords(strtolower('COMMENTS'));?></th>
				<th><?php echo ucwords(strtolower('COMM AMT'));?></th>
				<th><?php echo ucwords(strtolower('CUSTOMER NAME'));?></th>
				<th><?php echo ucwords(strtolower('DEALER ASC'));?></th>
				<th><?php echo ucwords(strtolower('DEALER CODE'));?></th>
				<th><?php echo ucwords(strtolower('DEALER NAME'));?></th>
				<th><?php echo ucwords(strtolower('DISBURSAL AMT'));?></th>
				<th><?php echo ucwords(strtolower('MODE NEFT CHQ NO'));?></th>
				<th><?php echo ucwords(strtolower('MONTH'));?></th>
				<th><?php echo ucwords(strtolower('NET PAY'));?></th>
				<th><?php echo ucwords(strtolower('PAID DT'));?></th>
				<th><?php echo ucwords(strtolower('PAYMENT STATUS'));?></th>
				<th><?php echo ucwords(strtolower('PROSPECT NO'));?></th>
				<!-- <th><?php echo ucwords(strtolower('SLAB PERC'));?></th> -->
				<th><?php echo ucwords(('GST Amount'));?></th>
				<th><?php echo ucwords(('GST Perc'));?></th>
				<th><?php echo ucwords(strtolower('YEAR'));?></th>
            </tr>
        </thead>
        
    </table>
<script type="text/javascript">
		  //$('select').niceSelect();

		</script>

<!-- End of Date -->


		<script type="text/javascript">
//var table = $('#example').DataTable();
			$("#loader").removeClass("hidden");
var iddtable;
iddtable = $('#iidetails').DataTable( {
	 
	 "scrollX": true,
		  dom: 'Bfrtip',
			buttons: [
				{
					extend: 'excelHtml5',
					title: 'Sales Incentive Details'
				},
				{
					extend: 'pdfHtml5',
					title: 'Sales Incentive Details',
					orientation: 'landscape',
					pageSize: 'LEGAL'
				},
				{
					extend: 'csvHtml5',
					title: 'Sales Incentive Details'
				}
			],
//		 "responsive":true,
		"ajax": {
				"url": "/cc/DealerCustom/getIncentiveDetailsSoapData",
				"dataSrc": "",
				"method": 'post',
				"data": {
						method: 'GetDealerSalesIncentiveDetails',
						date_range: $("#yearval").val(),
						month_sel: $("#monthval").val(),
						dealer_code:'<?php echo $dealer_code;?>'
				},
				
			},
			"columns": [
		{
				"data": "AGREEMENT_NO",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "BRANCH_NAME",
				"defaultContent": "<i>Not set</i>"
		},
		{ 
				"data": "COMMENTS",
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
			"data": "DEALER_ASC" ,
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
			"data": "DISBURSAL_AMT",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "MODE_NEFT_CHQ_NO",
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
			"data": "PAYMENT_STATUS",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "PROSPECT_NO",
			"defaultContent": "<i>Not set</i>"
		},
		// { 
		// 	"data": "SLAB_PERC" ,
		// 	"defaultContent": "<i>Not set</i>"
		// },
		{ 
			"data": "TDS_AMOUNT",
			"defaultContent": "<i>Not set</i>"
		},
		{ 
			"data": "TDS_PREC",
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
function updateTableData(method,date_range,month_sel,dealer_code){

			$("#loader").removeClass("hidden");
			 var url = "/cc/DealerCustom/reloadIncentiveDetailsSoapData?method="+method+"&date_range="+date_range+"&month_sel="+month_sel+"&dealer_code="+dealer_code;
			iddtable.ajax.url(url).load();
			  setTimeout(function(){
				//seed_data(pick_up_date,one_month_foward);  
				$("#loader").addClass("hidden");
			  },5000);
}

$( "#monthval" ).change(function() {
		//alert( "Handler for .change() called." );
		var	method = 'GetDealerSalesIncentiveDetails';
		var date_range = $("#date-range select").val();
		var month_sel = $("#month select").val();
		var dealer_code = '<?php echo $dealer_code;?>' ;
		updateTableData(method,date_range,month_sel,dealer_code);
});

$( "#yearval" ).change(function() {
		/*
		$.getJSON(url, null, function (json) {
		dt.fnClearTable();
		dt.fnAddData(json.aaData);
		dt.fnDraw();
	});
*/
	var	method = 'GetDealerSalesIncentiveDetails';
	var date_range = $("#date-range select").val();
	var month_sel = $("#month select").val();
	var dealer_code = '<?php echo $dealer_code;?>' ;

	updateTableData(method,date_range,month_sel,dealer_code);

				
});
//updateTableData();
 </script>
</body>
</html>