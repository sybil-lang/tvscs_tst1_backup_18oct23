<?php
 $CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
?>
<html>
<head>
<style type="text/css">
.rn_Body{
min-height: 563px;
}

.nice-select.wide{
	width:30%;
}
.table>caption+thead>tr:first-child>td, .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th{
    color: white;
}
#psan{
	color: #108a43 !important;
	font-size: 14px !important;
	text-transform: none !important;
}
@media screen and (max-device-width: 480px) and (orientation: portrait){
div.dataTables_scrollBody > table{
	padding-bottom: 0px !important;
}
div.dataTables_wrapper div.dataTables_filter input{
	width: 80% !important;
    background-position: center right;
    padding: 0 0 !important;
    border-radius: 20px !important;
    margin-left: 0px !important;
}
.z-tabs > .z-container > .z-content > .z-content-inner{
	height: 500px;
}
select{
	margin-left: 35px;
}
}
</style>

</head>
<body>
<?php
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
$report_id=$msg->Value;
$contact_id=$CI->session->getProfileData("c_id");
//print_r($CI->session->getProfile());
$userProfile =$CI->session->getSessionData("userProfile");
$filter=array('ContactID'=>$contact_id);
$agreement_array = report_result($report_id,$filter);
?>

<h2>MGM Details</h2>

<h4 align="left" style="margin-top:15px;" id="psan">Please Select Agreement Number</h4>
<form name="mgmdata" id="mgmdata">
<select name="strLoginAgrmnt1" class="wide" id="strLoginAgrmnt1">
			<option value="">Please Select</option>
	<?php
	if(!empty($agreement_array)){
		foreach($agreement_array as $key => $value){
			if(!empty(trim($value['Agreement No']))){
	?>
			<option value="<?php echo  $value['Agreement No'];?>" ><?php echo  $value['Agreement No'];?></option>
	<?php 
			}
		}
	} ?>
	<!--<option value="RJ0504TW00011">RJ0504TW00011</option>
	<option value="RJ0504TW00013">RJ0504TW00013</option>-->
	</select>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<script type="text/javascript">
$(document).ready(function() {
	  /*$('select').niceSelect({
			'overflow':scroll
	 });*/

	$('#strLoginAgrmnt1').change(function(){
			
			//alert("good");
					$('#mgmdetails').removeClass('hidden');
					$('#mgmdetails').DataTable( {
						 "scrollX": true,
						  "processing": true,
						  dom: 'Bfrtip',
						   buttons: [
							{
								extend: 'excelHtml5',
								title: 'MGM Details'
							},
							{
								extend: 'pdfHtml5',
								title: 'MGM Details',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							},
							{
								extend: 'csvHtml5',
								title: 'MGM Details'
							}
						],
				//		 "responsive":true,
						"ajax": {
									"url": '/cc/AjaxCustom/getMGMReferralDetails',
									"dataSrc": "",
									"type": "POST",
									"data": function ( d ) {
									  d.form = $('#mgmdata').serializeArray();
									  }
									//"data": $('#mgmdata').serializeArray()
								},
						"columns": [
								{ "data": "Exist_CustomerAgmntNo" },
								{ "data": "Exist_CustomerMobileNo" },
								{ "data": "Exist_customerName" },
								{ "data": "New_CustomerMobileNo" },
								{ "data": "New_CustomerName" },
								{ "data": "Product" },
								{"data":"Status"},
								{"data":"referred_date"}
							],
							"destroy": true,
						} );
				});
	});
 </script>

 <table id="mgmdetails"  class="table display table-bordered  nowrap hidden" cellspacing="0" width="100%" >
        <thead>
            <tr>
                <th>Customer Agreement No</th>
                <th>Customer Mobile No</th>
                <th>Customer Name</th>
                <th>New Customer Mobile No</th>
                <th>New Customer Name</th>
                <th>Product</th>
				<th>Status</th>
				<th>Referred Date</th>
            </tr>
        </thead>
       
    </table>
</body>
</html>