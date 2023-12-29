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
var scounter = 8;
var ecounter = 9;
var methodName = 'getSalesPerformanceDetails';
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
					<div class='input-group date' id='datetimepicker8'>

					  <input type='text' value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-3,date("d"),date("Y")));?>" class="form-control"  data-provide="datepicker"  />
					  <span class="input-group-addon click_8">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>

				  <div class="form-group">
					<label>To</label>
					<div class='input-group date' id='datetimepicker9'>

					  <input type='text' class="form-control" value="<?php echo date("d/m/Y");?>" />
					  <span class="input-group-addon click_9">
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
		  
<table id="pdetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Channel</th>
				<th>DP Amount</th>
				<th>EMI</th>
				<th>Model</th>
				<th>Customer Name</th>
				<th>Prospect No</th>
				<th>ASC Name</th>
				<th>Asset Cost</th>
				<th>Tenor</th>
				<th>Status</th>
				<th>Loan Amount</th>
            </tr>
        </thead>
        
    </table>
<script type="text/javascript">

		</script>

<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();
		ddtable = $('#pdetails').DataTable( {
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
								"url": "/cc/DealerCustom/getSalesRestData",
								"dataSrc": "",
								"method": 'post',
								"data": {
										method: 'getSalesPerformanceDetails',
										start_date: $("#datetimepicker8 input").val(),
										end_date: $("#datetimepicker9 input").val(),
										dealer_code:'<?php echo $dealer_code;?>'
								}
							},
					"columns": [
						{
								"data": "CHANNEL",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "DP_AMOUNT",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "EMI",
								"defaultContent": "<i>Not set</i>"
						},
						{
									"data": "MODEL",
									"defaultContent": "<i>Not set</i>"
						},
						{ "data": "CUSTOMER_NAME" },
						{ "data": "PROSPECT_NO" },
						{ "data": "ASC_NAME" },
						{ "data": "ASSET_COST" },
						{ "data": "TENOR" },
						{
								"data": "STATUS",
								"defaultContent": "<i>Not set</i>"
						},
						{"data" : "LOAN_AMOUNT"}
						
						],
						"bDestroy": true
					} );
 </script>
</body>
</html>
