<rn:meta title="#rn:msg:SUPPORT_HISTORY_LBL#" template="employee_header.php" clickstream="incident_list" login_required="true" force_https="true" />
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"  rel="stylesheet" >
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');
//
$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy);
$report_id=$msg->Value;
//$c_id =3;
$c_id=$this->session->getProfileData("c_id");
$filter = array("Employee_Id" => $c_id);
$report_dealer_results=report_result($report_id,$filter);

//print_r($report_dealer_results);
$userProfile = $CI->session->getSessionData('userProfile');
$dealer_array = array();
$dealer_array[] = array('text' => 'Choose One','value' => '');
if(!empty($report_dealer_results)){
	foreach($report_dealer_results as $key => $response_customer){
		$dealer_array[] = array('text' => $response_customer['Full Name'],'value' => $response_customer['Dealer ID']);
	}
}
$dealer_input_Options = json_encode($dealer_array);
unset($dealer_array);
?>
<style type="text/css">
.yui3-datatable-table th{
background-color: #3B6DB1;
color: #ffffff;
	}
.rn_Hero{
background:#f1f1f1;
color: #000000;
	}
</style>
<section class="clearfix">
	 <div class="main">
					<form method="post" action="/app/employee/dealer_dashboard" name="dform" id="dform">
						
							<!-- Modal -->
							<div id="myModal" class="modal fade" role="dialog">
								<div id="bootbox-body"></div>
							  <div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Select Dealer</h4>
								  </div>
								  <div class="modal-body">
									
										<div id="magicsuggest_incident"></div>
								  </div>
								  <div class="modal-footer">
									<input type="hidden" id="dealer_id" name="dealer_id" value="" />
									<input type="hidden" id="dealer_name" name="dealer_name" value="" />
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-default" id="btn_save_incident">Save</button>
								  </div>
								</div>

							  </div>
							</div>
					</form>
	  </div>
</section>
<?php
if(!empty($userProfile['employee_d_id'])){?>

<div class="rn_Hero">
    <div class="rn_Container">
		<div class="col-sm-12">
			<div class="col-sm-4">
				<h1>Support Questions List</h1>
			</div>
			<br />
			<div class="col-sm-8">
					<div class="col-sm-12 col-xs-12 col-md-12 col-lg-10 ">
						<button type="button" class="btn btn-primary pull-right" id="btndealer">Change Dealer</button>
				</div>
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-2 ">
						<a class="btn btn-primary pull-left" href="<?php echo $site_url;?>/app/employee/dealerquery" role="button">Raise a Query</a>
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
									
									<th>Date Created</th>
								</tr>
							</tfoot>
						</table>
						</div>
				</div>
		</div>
</section>
<script type="text/javascript">
//var table = $('#example').DataTable();
		$.ajax({
				 url: "/cc/EmployeeCustom/getDealerIncidents/",
				dataType: "json",
				data: {
						did:'<?php echo $userProfile["employee_d_id"];?>'
				},
				method: 'post',
				beforeSend: function() {
						$("#loader").removeClass("hidden");   
				},
				success: function(response) {
					var table = $('#incident_list').DataTable( {
								data: response.htmlData
					});
				},
				cache:true
			});
			
			$('#btndealer').on('click', function (e) {
					e.preventDefault();
					$("#myModal").modal('show');
			});
			
 </script>

<?php }else{

?>

<script type="text/javascript">
$("#myModal").modal('show');
</script>

<?php } ?>

<script type="text/javascript">
var ms = $('#magicsuggest_incident').magicSuggest({
       data:  '/cc/EmployeeCustom/getIncidentDealerLists',
		maxSelection: 1,
        renderer: function(data){
		  
            return '<div style="padding: 5px; overflow:hidden;">' +
                '<div style="float: left;"><i class="fa fa-address-card" aria-hidden="true"></i></div>' +
                '<div style="float: left; margin-left: 5px">' +
                    //'<div style="font-weight: bold; color: #333; font-size: 13px; line-height: 11px">' + data.value + '</div>' +
                    '<div style="color: #999; font-size: 13px;">' + data.name + '</div>' +
                '</div>' +
            '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff

        }
    });
	$(ms).on('selectionchange', function(e,m){
		  $('#dealer_id').val(this.getValue());
		});

$("#btn_save_incident").on("click", function(){
			jQuery.ajax({
						type: 'POST',
						data: {
							'dealer_id' : $('#dealer_id').val()
						},
						url: '/cc/EmployeeCustom/setDealerId',
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
</script>