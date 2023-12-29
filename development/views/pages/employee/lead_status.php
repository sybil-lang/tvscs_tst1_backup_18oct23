<rn:meta title="Lead Status" template="employee_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 800px;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');


$employee_code=$CI->session->getProfileData("login");
?>

	
<!-- Datatable CSS and JAVAScript -->
<!--	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
-->
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
        <h1>Lead Status</h1>
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
var methodName = 'GetVReferralDetails';
var empcode = '<?php echo $employee_code;?>';
//var empcode = '5014794';
</script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/lead_validation.js"></script>

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
                <th><?php echo ucwords(strtolower('Address'));?></th>
				<th><?php echo ucwords(strtolower('Agreement Date'));?></th>
				<th><?php echo ucwords(strtolower('Agreement No'));?></th>
				<th><?php echo ucwords(strtolower('City'));?></th>
				<th><?php echo ucwords(strtolower('Customer Email'));?></th>
				<th><?php echo ucwords(strtolower('Customer Name'));?></th>
				<th><?php echo ucwords(strtolower('Lead Creation Date'));?></th>
				<th><?php echo ucwords(strtolower('Lead ID'));?></th>
				<th><?php echo ucwords(strtolower('Loan Amount'));?></th>
				<th><?php echo ucwords(strtolower('Product Name'));?></th>
				<th><?php echo ucwords(strtolower('Remarks'));?></th>
				<th><?php echo ucwords(strtolower('State'));?></th>
				<th><?php echo ucwords(strtolower('Type of Loan'));?></th>
            </tr>
        </thead>
        
    </table>
<!-- End of Date -->

		<script type="text/javascript">
//var table = $('#example').DataTable();
$("#loader").removeClass("hidden");
		ddtable = $('#ddetails').DataTable( {
					 "scrollX": true,
					  "ServerSide": true,
					  "Processing": true,
					  dom: 'Bfrtip',
						buttons: [
							{
								extend: 'excelHtml5',
								title: 'Lead Status Details'
							},
							{
								extend: 'pdfHtml5',
								title: 'Lead Status Details',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'Lead Status Details'
							}
						],
			//		 "responsive":true,
					"ajax": {
								url: "/cc/EmployeeCustom/getEmployeeLeadData",
								dataSrc: "",
								"processing": true,
								"serverSide": true,
								method: 'post',
								data: {
										method: 'GetVReferralDetails',
										start_date: $("#datetimepicker9 input").val(),
										end_date: $("#datetimepicker10 input").val(),
										employee_code:empcode
								}
							},
					"columns": [
						{
								"data": "ADDRESS",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "AGREEMENT_DATE",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "AGREEMENT_NO",
								"defaultContent": "<i>Not set</i>"
						},
						{
									"data": "CITY",
									"defaultContent": "<i>Not set</i>"
						},
						{
							"data": "CUSTOMER_EMAIL",
								"defaultContent": "<i>Not set</i>"
						},
						{
							"data": "CUSTOMER_NAME",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "LEAD_CREATED_DATE" ,
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "LEAD_ID",
							"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "LOAN_AMOUNT" ,
								"defaultContent": "<i>Not set</i>"
						},
						{ 
							"data": "PRODUCT_NAME",
								"defaultContent": "<i>Not set</i>"
						},
						{
								"data": "REMARKS",
								"defaultContent": "<i>Not set</i>"
						},
						{
							"data" : "STATE",
								"defaultContent": "<i>Not set</i>"
						},
						{ 
								"data": "TYPE_OF_LOAN" ,
							    "defaultContent": "<i>Not set</i>"
						}
						],
						"bDestroy": true
					} );

  setTimeout(function(){
					//seed_data(pick_up_date,one_month_foward);  
					$("#loader").addClass("hidden");
				  },5000);
 </script>
</div>