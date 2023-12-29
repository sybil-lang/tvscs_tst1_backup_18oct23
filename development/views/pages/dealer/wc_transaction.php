<rn:meta title="Working Capital Transaction Details" template="dealer_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 800px;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');


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
        <h1>WC Transaction Details</h1>
    </div>
</div>
<p>&nbsp;</p>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<script type="text/javascript">
var scounter = 9;
var ecounter = 10;
var methodName = 'getDealerTATransaction';
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
						<div class='input-group date' id='datetimepicker9'>

						  <input type='text' value="<?php echo date("d/m/Y",mktime(0,0,0,date("m")-3,date("d"),date("Y")));?>" class="form-control"  data-provide="datepicker"  />
						  <span class="input-group-addon click_9">
										<span class="glyphicon glyphicon-calendar"></span>
						  </span>
						</div>
					  </div>

					  <div class="form-group">
						<label>To</label>
						<div class='input-group date' id='datetimepicker10'>

						  <input type='text' class="form-control" value="<?php echo date("d/m/Y");?>" />
						  <span class="input-group-addon click_10">
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
                <th><?php echo ucwords(strtolower('SNo'));?></th>				
				<th><?php echo ucwords(strtolower('Date'));?></th>
				<th><?php echo ucwords(strtolower('Adj Agreement'));?></th>
				<th><?php echo ucwords(strtolower('Customer Name'));?></th>
				<th><?php echo ucwords(strtolower('Adj WC No'));?></th>
				<th><?php echo ucwords(strtolower('Given_Amount'));?></th>
				<th><?php echo ucwords(strtolower('Adjustment'));?></th>
				<th><?php echo ucwords(strtolower('Balance'));?></th>				
				<th><?php echo ucwords(strtolower('ASSET MODEL'));?></th>
				<th><?php echo ucwords(strtolower('Dealer Type'));?></th>
				<!--<th><?php //echo ucwords(strtolower('BRANCH CODE'));?></th>
				<th><?php //echo ucwords(strtolower('BRANCH NAME'));?></th>
				<th><?php //echo ucwords(strtolower('DEALER CODE'));?></th>
				<th><?php //echo ucwords(strtolower('DEALER NAME'));?></th>-->
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
								title: 'WC Transaction Details'
							},
							{
								extend: 'pdfHtml5',
								title: 'WC Transaction Details',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'WC Transaction Details'
							}
						],
			//		 "responsive":true,
					"ajax": {
								url: "/cc/DealerCustom/getTADealerDataREST",
								dataSrc: "",
								method: 'post',
								data: {
										method: 'getDealerTATransaction',
										start_date: $("#datetimepicker9 input").val(),
										end_date: $("#datetimepicker10 input").val(),
										dealer_code:'<?php echo $dealer_code;?>'
								}
							},
					"columns": [
						{
								"data": "SNo",
								"defaultContent": "<i>Not set</i>"
						},						
						{ 
							"data": "Date" ,
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "Adj_Agreement",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "Customer_Name" ,
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "Adj_TA_No",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "Given_Amount",
								"defaultContent": "<i>Not set</i>"
						},
						{
							"data" : "Adjustment",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "Balance" ,
							    "defaultContent": "<i>Not set</i>"
								
						},
						{ "data" : "ASSET_MODEL",
							"defaultContent": "<i>Not set</i>"
						},
						{
							"data" : "dealer_type",
							"defaultContent": "<i>Not set</i>"
						}
						/*,{
								"data": "BRANCHCODE",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "BRANCHNAME",
								"defaultContent": "<i>Not set</i>"
						},
						{
									"data": "DEALER_CODE",
									"defaultContent": "<i>Not set</i>"
						},
						{
							"data": "DEALER_NAME",
								"defaultContent": "<i>Not set</i>"
						}*/
						],
						"bDestroy": true
					} );
 </script>
</div>