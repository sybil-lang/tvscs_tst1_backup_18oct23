<?php
//checkLoggedIn('dealer'); //check Logged-in or not
$CI=&get_instance();
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$CI->load->helper('report');

checkCustomerType('dealer');
$dealer_code=$CI->session->getProfileData("login");
?>
<html>
<head>
<script type="text/javascript">
var scounter = 10;
var ecounter = 11;

var methodName = 'getPDDAgeingDetails';
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
					<div class='input-group date' id='datetimepicker10'>

					  <input type='text' value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-1,date("d"),date("Y")));?>" class="form-control"  data-provide="datepicker"  />
					  <span class="input-group-addon click_10">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>

				  <div class="form-group">
					<label>To</label>
					<div class='input-group date' id='datetimepicker11'>

					  <input type='text' class="form-control" value="<?php echo date("d/m/Y");?>" />
					  <span class="input-group-addon click_11">
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

<table id="pdddetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Main Dealer Name</th>
				<th>Dealer Name</th>
				<th>Customer Name</th>
				<th>Dealer Type</th>
				<th>Dealer Code</th>
				<th>Disbursed Date</th>
				<th>Model Name</th>
				<th>Agreement Number</th>
				<th>Main Dealer Code</th>
            </tr>
        </thead>
        
    </table>
<script type="text/javascript">

		</script>

<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();
		ddtable = $('#pdddetails').DataTable( {
					 "scrollX": true,
						 cache: true,
					  dom: 'Bfrtip',
						buttons: [
							{
								extend: 'excelHtml5',
								title: 'PDD Pending'
							},
							{
								extend: 'pdfHtml5',
								title: 'PDD Pending',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'PDD Pending'
							}
						],
			//		 "responsive":true,
					"ajax": {
								"url": "/cc/DealerCustom/getSalesRestData",
								"dataSrc": "",
								"method": 'post',
								"data": {
										method: 'getPDDAgeingDetails',
										start_date: $("#datetimepicker10 input").val(),
										end_date: $("#datetimepicker11 input").val(),
										dealer_code:'<?php echo $dealer_code;?>'
								}
							},
					"columns": [
						{
								"data": "MAIN_DEALER_NAME",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "DEALER_NAME",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "CUSTOMER_NAME",
								"defaultContent": "<i>Not set</i>"
						},
						{
									"data": "DEALER_TYPE",
									"defaultContent": "<i>Not set</i>"
						},
						{ "data": "DEALER_CODE" },
						{ "data": "DISBURSED_DATE" },
						{ "data": "MODEL_NAME" },
						{ "data": "AGREEMENT_NO" },
						{
								"data": "MAIN_DEALER_CODE",
								"defaultContent": "<i>Not set</i>"
						}
						
						],
						"bDestroy": true
					} );
               $(document).ready(function(){
               
                           $('body').find('.dataTables_scrollBody').addClass("scrollbar");
                           $('body').find('.dataTables_scrollBody').removeClass("dataTables_scrollBody");
           });
 </script>
</body>
</html>
