<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$CI->load->helper('report');

checkCustomerType('internal employee');
//$dealer_code=$CI->session->getProfileData("login");
$userProfile = $CI->session->getSessionData('userProfile');
$dealer_code = $userProfile['dealer_codes'];
//$dealer_code = 7033;

?>
<html>
<head>
<script type="text/javascript">
var scounter = 6;
var ecounter = 7;
var methodName = 'getSalesDisbursedDetails';
var dealerCode = '<?php echo $dealer_code;?>';
</script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/date_validation.js"></script>
</head>
<body>

  <div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
              
		  <div class="row">
			
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
			  <div class="row">
				<div class='col-sm-12 form-inline datetimepickerwrapper'>
				  <div class="form-group">
					<label>From</label>
					<div class='input-group date' id='datetimepicker6'>

					  <input type='text' value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-3,date("d"),date("Y")));?>" class="form-control"  data-provide="datepicker"  />
					  <span class="input-group-addon click_6">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>

				  <div class="form-group">
					<label>To</label>
					<div class='input-group date' id='datetimepicker7'>

					  <input type='text' class="form-control" value="<?php echo date("d/m/Y");?>" />
					  <span class="input-group-addon click_7">
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
<table id="ddetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Checque or UTR Date</th>
				<th>Sales Executive</th>
				<th>Proposal Number</th>
				<th>Customer Name</th>
				<th>Asset Cost</th>
				<th>Payment Mode</th>
				<th>Dealer Code</th>
				<th>Login Date</th>
				<th>Model Name</th>
				<th>Status</th>
				<th>Contract Number</th>
				<th>Dealer Name</th>
				<th>Disbursal Amount</th>
				<th>Loan Amount</th>
            </tr>
        </thead>
        
    </table>
<script type="text/javascript">

		</script>

<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();
		ddtable = $('#ddetails').DataTable( {
					 "scrollX": true,
					  dom: 'Bfrtip',
						buttons: [
							{
								extend: 'excelHtml5',
								title: 'Disbursal Details'
							},
							{
								extend: 'pdfHtml5',
								title: 'Disbursal Details',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'Disbursal Details'
							}
						],
			//		 "responsive":true,
					"ajax": {
								"url": "/cc/DealerCustom/getSalesRestData",
								"dataSrc": "",
								"method": 'post',
								"data": {
										method: 'getSalesDisbursedDetails',
										start_date: $("#datetimepicker6 input").val(),
										end_date: $("#datetimepicker7 input").val(),
										dealer_code:'<?php echo $dealer_code;?>'
								}
							},
					"columns": [
						{
								"data": "CHECQUE_OR_UTR_DATE",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "SALES_EXECUTIVE",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "PROPOSAL_NUMBER",
								"defaultContent": "<i>Not set</i>"
						},
						{
									"data": "CUSTOMER_NAME",
									"defaultContent": "<i>Not set</i>"
						},
						{ "data": "ASSET_COST" },
						{ "data": "PAYMENT_MODE" },
						{ "data": "DEALER_CODE" },
						{ "data": "LOGIN_DATE" },
						{ "data": "MODEL_NAME" },
						{
								"data": "STATUS",
								"defaultContent": "<i>Not set</i>"
						},
						{"data" : "CONTRACT_NUMBER"},
						{ 
								"data": "DEALER_NAME" ,
							    "defaultContent": "<i>Not set</i>"
								
						},
						{ "data" : "DISBURSAL_AMOUNT"	},
						{ "data" : "LOAN_AMOUNT"	}
						],
						"bDestroy": true
					} );
 </script>
</body>
</html>