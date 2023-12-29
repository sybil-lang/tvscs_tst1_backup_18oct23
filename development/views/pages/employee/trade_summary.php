<rn:meta title="Business Information" template="dealer_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 800px;
}
table.dataTable.nowrap th, table.dataTable.nowrap td{
	word-wrap: break-all !important;
	white-space: normal !important;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('dealer');
$c_id = $CI->session->getProfileData("c_id");
$contact = \RightNow\Connect\v1_3\Contact::fetch($c_id);
$dealerProduct = $contact->CustomFields->CO->DealerProduct;
if($dealerProduct->ProductCode != "TR"){
    header('location:/app/dealer/trade-advance');
	exit;
}
$dealer_code=$CI->session->getProfileData("login");
?>

	
<!-- Datatable CSS and JAVAScript -->
<!--	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
-->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">


<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>



<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>


<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />


<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"> </script>

<script type="text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"> </script>

<script type="text/javascript" src = "//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"> </script>

<div class="rn_Hero">
    <div class="rn_Container">
        <h1>TA Transaction summary</h1>
    </div>
</div>
<p>&nbsp;</p>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<script type="text/javascript">
var scounter = 6;
var ecounter = 7;
var methodName = 'getTADealerSummary';
var dealercode = '<?php echo $dealer_code;?>';
</script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/ta_validation.js"></script>

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
			  </div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
			 
			</div>
	</div>

<table id="ddetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
			<tr>
				<th><?php echo ucwords(strtolower('SNO'));?></th>
                <th><?php echo ucwords(strtolower('TA AGREEMENT NO'));?></th>
				<th><?php echo ucwords(strtolower('DEALER CODE'));?></th>
				<th><?php echo ucwords(strtolower('DEALER NAME'));?></th>
				<th><?php echo ucwords(strtolower('DAYS'));?></th>
				<th><?php echo ucwords(strtolower('GIVEN DATE'));?></th>
				<th><?php echo ucwords(strtolower('BALANCE AMOUNT'));?></th>
				<th><?php echo ucwords(strtolower('SANCTIONED AMOUNT'));?></th>
				<th><?php echo ucwords(strtolower('INT FREE DAYS'));?></th>
				<th><?php echo ucwords(strtolower('UTILIZED AMOUNT'));?></th>
				<th><?php echo ucwords(strtolower('UTILIZED DATE'));?></th>
				<th><?php echo ucwords(strtolower('INT AMOUNT'));?></th>
				<th><?php echo ucwords(strtolower('ROI'));?></th>
            </tr>
        </thead>
        
    </table>
<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();
		ddtable = $('#ddetails').DataTable( {
					 "scrollX": true,
					  "ServerSide": true,
					  "Processing": true,
					  dom: 'Bfrtip',
						buttons: [
							{
								extend: 'excelHtml5',
								title: 'Trade Summary Details'
							},
							{
								extend: 'pdfHtml5',
								title: 'Trade Summary Details',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'Trade Summary Details'
							}
						],
			//		 "responsive":true,
					"ajax": {
								url: "/cc/DealerCustom/getTADealerSummary",
								dataSrc: "",
								method: 'post',
								data: {
										method: 'getTADealerSummary',
										start_date: $("#datetimepicker6 input").val(),
										end_date: $("#datetimepicker7 input").val(),
										dealer_code:'<?php echo $dealer_code;?>'
								}
							},
							
					"columns": [
						{
							"data" : "SNO",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "TA_AGREEMENTNO",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "DEALER_CODE",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "DEALER_NAME",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "DAYS",
								"defaultContent": "<i>Not set</i>"
						},
						{
									"data": "GIVEN_DATE",
									"defaultContent": "<i>Not set</i>"
						},
						{
							"data": "BALANCE_AMOUNT",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "SACTIONED_AMOUNT" ,
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "INT_FREE_DAYS",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "UTILLIZED_AMOUNT",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "UTILLIZED_DATE" ,
							    "defaultContent": "<i>Not set</i>"
								
						},
						{ "data" : "INT_AMOUNT",
							"defaultContent": "<i>Not set</i>"
						},
						{ "data" : "ROI",
							"defaultContent": "<i>Not set</i>"
						}
						],
						"bDestroy": true
					} );
 </script>
  <style type="text/css">
 	.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th, .dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td{
 		word-wrap: anywhere !important;
 	}
 </style>
</div>