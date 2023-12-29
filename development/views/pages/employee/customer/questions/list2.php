<rn:meta title="#rn:msg:SUPPORT_HISTORY_LBL#" template="employee_header.php" clickstream="incident_list" login_required="true" force_https="true" />
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<?php
$CI = &get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');
//
$msg = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy_Customer);
$report_id = $msg->Value;
//$c_id =3;
$c_id = $this->session->getProfileData("c_id");
//$filter = array("Employee_Id" => $c_id);
//$report_customer_results=report_result($report_id,$filter);

//print_r($report_results);
$userProfile = $CI->session->getSessionData('userProfile');

$customer_array = array();
$customer_array[] = array('text' => 'Choose One', 'value' => '');
/*foreach($report_customer_results as $key => $response_customer){
	$customer_array[] = array('text' => $response_customer['Full Name'],'value' => $response_customer['Customer']);
}*/

?>
<style type="text/css">
	.yui3-datatable-table th {
		background-color: #3B6DB1;
		color: #ffffff;
	}
</style>
<section class="clearfix">
	<div class="main">
		<form method="post" action="/app/employee/customer_dashboard" name="dform" id="dform">

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div id="bootbox-body"></div>
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Select Customer</h4>
						</div>
						<div class="modal-body">

							<div id="magicsuggest_incident"></div>
						</div>
						<div class="modal-footer">
							<input type="hidden" id="customer_id" name="customer_id" value="" />
							<input type="hidden" id="customer_name" name="dealer_name" value="" />
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-default" id="btn_save_incident">Ok</button>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
</section>
<?php
//if(!empty($userProfile['employee_c_id'])){
//$customer_input_Options = json_encode($customer_array);
//unset($customer_array);
?>
<div class="rn_Hero">
	<div class="rn_Container">
		<div class="col-sm-12">
			<div class="col-sm-4">
				<h1>Support Questions List</h1>
			</div>
			<br />
			<div class="col-sm-8">
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-10 ">
					<button type="button" class="btn btn-primary pull-right" id="btncustomer">Change Customer</button>
				</div>
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-2 ">
					<a class="btn btn-primary" href="<?php echo $site_url; ?>/app/employee/customerquery" role="button">Raise a Query</a>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="container">

	<div class="row-fluid">


	</div>
	<br />
	<div class="row-fluid">
		<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
			<table id="incident_list" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Incident ID</th>
						<th>Dealer Name</th>
						<th>Reference #</th>
						<th>Subject</th>
						<th>Status</th>
						<th>Status Type</th>
						<!--	<th>Dealer Name</th>-->
						<th>Date Created</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Incident ID</th>
						<th>Dealer Name</th>
						<th>Reference #</th>
						<th>Subject</th>
						<th>Status</th>
						<th>Status Type</th>
						<!---<th>Dealer Name</th>-->
						<th>Date Created</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>

<script type="text/javascript">
	//var table = $('#example').DataTable();
// alert("hello")
// 
	$.ajax({
		url: "/cc/EmployeeCustom/getCustomerIncidentsfordealer/",
		dataType: "json",
		data: {
			cid: '<?php echo $userProfile["employee_c_id"]; ?>'
		},
		method: 'post',
		beforeSend: function() {
			$("#loader").removeClass("hidden");
		},
		success: function(response) {
			console.log("resoonse is",response)  //getting aall the incident details and displaying in tabe
			$("#loader").addClass("hidden");
			var table = $('#incident_list').DataTable({
				data: response.htmlData
			});
		},
		cache: true
	});

	$('#btncustomer').on('click', function(e) {
		e.preventDefault();
		$("#myModal").modal('show');
	});
</script>

<?php //}else{

//$customer_input_Options = json_encode($customer_array);
//unset($customer_array);
?>
<script type="text/javascript">
	//$("#myModal").modal('show');
</script>
<?php //} 
?>

<!-- <script type="text/javascript">
	// alert("inside second ")
  
	var ms = $('#magicsuggest_incident').magicSuggest({
		data: '/cc/EmployeeCustom/getIncidentCustomerLists',
		maxSelection: 1,
		minChars: 5,
		maxSuggestions: 50,
		renderer: function(data) {
			console.log("gfdredwedrf",data.name );
			return '<div style="padding: 5px; overflow:hidden;">' +
				'<div style="float: left;"><i class="fa fa-address-card" aria-hidden="true"></i></div>' +
				'<div style="float: left; margin-left: 5px">' +
				'<div style="font-weight: bold; color: #333; font-size: 13px; line-height: 11px">' + data.value + '</div>' +
				'<div style="color: #999; font-size: 13px;">' + data.name + '</div>' +
				'</div>' +
				'</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff

		}
	});
	$(ms).on('selectionchange', function(e, m) {
		$('#customer_id').val(this.getValue());
	});

	$("#btn_save_incident").on("click", function() {
		jQuery.ajax({
			type: 'POST',
			data: {
				'customer_id': $('#customer_id').val()
			},
			url: '/cc/EmployeeCustom/setCustomerCode',
			beforeSend: function() {
				// setting a timeout
				$('#bootbox-body').html('<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>');
				//$(placeholder).addClass('loading');
			},
			success: function(response) {
				//alert(response);
				$('#bootbox-body').html('');
				window.location.reload();
			}
		});
	});
</script> -->