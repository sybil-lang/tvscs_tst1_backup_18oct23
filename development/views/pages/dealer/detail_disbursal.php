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
    <style type="text/css">
    
    </style> 
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

					  <input type='text' id="datetimepicker6_input" value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-1,date("d"),date("Y")));?>" class="form-control"  data-provide="datepicker"  />
					  <span class="input-group-addon click_6">
									<span class="glyphicon glyphicon-calendar"></span>
					  </span>
					</div>
				  </div>

				  <div class="form-group">
					<label>To</label>
					<div class='input-group date' id='datetimepicker7'>

					  <input type='text' class="form-control" id="datetimepicker7_input" value="<?php echo date("d/m/Y");?>" />
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
            	<th>ASC Code</th>
            	<th>ASC Name</th>
				<th>Asset Cost</th>
				<th>CMS Number</th>
				<th>Checque Favour</th>
				<th>Contract Number</th>
				<th>Customer Name</th>
				<th>Dealer Code</th>
				<th>Dealer Name</th>
				<th>Disbursal Amount</th>
				<th>Instrument Ref No.</th>
				<th>Liquidation Date</th>
				<th>Loan Amount</th>
				<th>Login Date</th>
				<th>Model Name</th>
				<th>Payment Amount</th>
				<th>Payment Mode</th>
				<th>Payment Status</th>
				<th>Proposal Number</th>
				<th>Sales Executive Code</th>
				<th>Sales Executive Name</th>
				<th>Status</th>
				<th>UTR Date</th>
				<th>UTR No.</th>
            </tr>
        </thead>
        
    </table>
<script type="text/javascript">

		</script>

<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();
	   ddtable = $('#ddetails').DataTable({
    "scrollX": true,

    dom: 'Bfrtip',
    buttons: [{
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
        "url": "/cc/DealerCustom/getDealerDisbursalRestData",
        "dataSrc": "",
        "method": 'post',
        "data": {
            start_date: $("#datetimepicker6_input").val(),
            end_date: $("#datetimepicker7_input").val(),
            dealer_code: '<?php echo $dealer_code;?>'
        }


    },
    "columns": [{
            "data": "ASC_CODE",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "ASC_NAME",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "ASSET_COST",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "CMS_NUMBER",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "CHECQUE_FAVOUR",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "CONTRACT_NUMBER",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "CUSTOMER_NAME",
            "defaultContent": "<i>Not set</i>"
        },
        {
            "data": "DEALER_CODE",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "DEALER_NAME",
            "defaultContent": "<i>Not set</i>"

        },
        {
            "data": "DISBURSAL_AMOUNT",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "INSTRUMENT_REF_NO",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "LIQUIDATION_DATE",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "LOAN_AMOUNT",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "LOGIN_DATE",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "MODEL_NAME",
            "defaultContent": "<i>Not set</i>"
        },
        {
            "data": "PAY_AMOUNT"
        },
        {
            "data": "PAYMENT_MODE",
            "defaultContent": "<i>Not set</i>"
        },
        {
            "data": "PAYMENT_STATUS",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "PROPOSAL_NUMBER",
            "defaultContent": "<i>Not set</i>"
        },
        {
            "data": "SALES_EXECUTIVE_CODE",
            "defaultContent": "<i>Not set</i>"
        },
        {
            "data": "SALES_EXECUTIVE_NAME",
            "defaultContent": "<i>Not set</i>"
        },
        {
            "data": "STATUS",
            "defaultContent": "<i>n/a</i>",
        },
        {
            "data": "UTR_DATE",
            "defaultContent": "<i>n/a</i>"
        },
        {
            "data": "UTR_NUMBER",
            "defaultContent": "<i>n/a</i>"
        }
    ],
    "bDestroy": true
});
$(document).ready(function() {

    $('body').find('.dataTables_scrollBody').addClass("scrollbar");
    $('body').find('.dataTables_scrollBody').removeClass("dataTables_scrollBody");
});
                       
 </script>
</body>
</html>