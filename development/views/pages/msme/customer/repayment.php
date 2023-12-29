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
		div.dataTables_scrollBody > table > tbody > tr:first-child > th, div.dataTables_scrollBody > table > tbody > tr:first-child > td 
		{
		    /* border-top: none; */
		    text-align: none;
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

$contact= \RightNow\Connect\v1_3\Contact::fetch($contact_id);
 $custID=$contact->CustomFields->c->customerno;

$filter=array('ContactID'=>$contact_id,'Loan Type'=>2 );
$agreement_array = report_result($report_id,$filter);
// print_r($agreement_array);
// echo count($agreement_array);
// exit();
for ($i=0; $i <count($agreement_array) ; $i++) 
{ 
	$prospectNumber[$i]=$agreement_array[$i]["Prospect No"];

}
$prospectNumber = array_unique($prospectNumber);
?>
<style type="text/css">
	#prospno th
	{
		background-color: #114984 !important;
		color: white !important;
	}
</style>
<h4  style="margin-top:15px;text-transform:none !important;" class="not_visible_in_mobile">Repayment</h4>
<p>#rn:msg:CUSTOM_MSG_REPAYMENT_PAGE_INTRO#</p>

<!-- <h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4> -->
<form name="remsmedata" id="remsmedata">
<!-- <select name="strLoginAgrmnt12re"  class="wide" id="strLoginAgrmnt12re"> -->
			<!-- <option value="">Please Select</option> -->
			<table id="prospno" class="table display table-bordered  nowrap " cellspacing="0" width="100%">
		<tr>
			<th>Prospect No.</th>
			<th>Payment Link</th>
		</tr>
	<?php

	if(!empty($prospectNumber)){
		for ($i=0; $i <count($prospectNumber) ; $i++) {
			if(!empty(trim($prospectNumber[$i]))){
		
	?>
	
		<tr>
			<td><?php echo $prospectNumber[$i];?></td>
			<td><a target="_blank" href="https://msmeallianceuat.tvscredit.com/tvs/action/crm-Repayment-odtl.jsp?hidBeanId=payment&hidBeanGetMethod=getLoanRePaymentSummary&prospno=<?php echo  $prospectNumber[$i];?>&customerno=<?php echo  $custID;?>" >Pay</a></td>
		</tr>

			<!-- <option value="<?php echo  $value['Prospect No'];?>" ><?php echo  $value['Prospect No'];?></option> -->
	<?php 
			}
		}
	} ?>
	</table>
	<!--<option value="RJ0504TW00011">RJ0504TW00011</option>
	<option value="RJ0504TW00013">RJ0504TW00013</option>-->
	<!-- </select> -->
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<!-- <table id="msme_repayment_details"  class="table display table-bordered  nowrap hidden" cellspacing="0" width="100%" >
        <thead>
            <tr>
                 <th>Loan Account Number</th>
                <th>Organisation Code</th>
                <th>User Id</th> 
                <th>Installment Number</th>
                <th>Installment Due Date</th>
                <th>Principal Amount</th>
				<th>Interest Amount</th>
				<th>Last PaymentDate"</th>				
				<th>Tax Deducted Source Amount </th>
				<th>Opening Balance</th>
				<th>Closing Balance </th>
				<th>Pay Now</th>
					

				

            </tr>
        </thead>
       
    </table> -->
<!-- <script type="text/javascript">
$(document).ready(function() {
	  /*$('select').niceSelect({
			'overflow':scroll
	 });*/

	$('#strLoginAgrmnt12re').change(function(){
	var data=document.getElementById('strLoginAgrmnt12re').value;
if($("#strLoginAgrmnt12re").val())
				{
						var agreementtlod = JSON.parse(localStorage.getItem("agreementtlod"));
			var repayment_customerID;
			var repayment_prospectno;
			console.log("tlod",agreementtlod[0].agreementNumber );
						for(var l=0;l<agreementtlod.length;l++)
						{
							
								if(agreementtlod[l].agreementNumber == $("#strLoginAgrmnt12re").val())
								{
									repayment_customerID=agreementtlod[l].customerID;
									repayment_prospectno=agreementtlod[l].prospectNumber;
								}
						   

						}
						//alert("good");
								$('#msme_repayment_details').removeClass('hidden');
								$('#msme_repayment_details').DataTable( {
									 "scrollX": true,
									  "processing": true,
									  dom: 'Bfrtip',
									   buttons: [
										{
											extend: 'excelHtml5',
											title: 'Payment Details'
										},
										{
											extend: 'pdfHtml5',
											title: 'Payment Details',
											orientation: 'landscape',
											pageSize: 'LEGAL'
										},
										{
											extend: 'csvHtml5',
											title: 'Payment Details'
										}
									],
									 // "responsive":true,
									"ajax": {
												"url": '/cc/AjaxCustom/repayment_msme',
												"dataSrc": "",
												"method": "post",
												"data": {
			           									 agreement_no: $("#strLoginAgrmnt12re").val(),
												  },

												//"data": $('#mgmdata').serializeArray()
											},


									"columns": [
											// { "data": "loanAccountNumber" },
											// { "data": "organizationCode" },
											// { "data": "userId" },
											{ "data": "emiNumber" },
											{ "data": "emiDueDate" },
											{ "data": "principalAmount" },
											{"data":"interestAmount"},
											{"data":"lastPaymentDate"},
											{"data":"taxDeductedSourceAmount"},
											{"data":"openingBalance"},
											{"data":"closingBalance"},
											{"data": null,"defaultContent": "<?php echo '<a target=\'_blank\' href=\'https://msmeallianceuat.tvscredit.com/tvs/action/crm-Repayment-odtl.jsp?hidBeanId=payment&hidBeanGetMethod=getLoanRePaymentSummary&prospno=7001MS0000292&customerno=9523771\'>PAY</a>';?>"
			                                }],
										// "columnDefs": [ {
										//             "targets": -1,
										//             "data": null,
										//             "defaultContent": "<button>Click!</button>"
										//         } ],
										
										"destroy": true,
									} );
							}
					});

	});
// console.log('data',data)
 </script> -->

 
</body>
</html>