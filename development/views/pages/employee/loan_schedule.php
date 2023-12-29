 <?php
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('internal employee');
 ?>
 <html>
 <head></head>
 <style type="text/css">
 div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
	
	</style>

 <body>
 <?php
 //$agreement = \RightNow\Utils\Url::getParameter('ag_id');
$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
?>
  <script type="text/javascript">
$('#lschedule').DataTable( {
					 "scrollX": true,
					  dom: 'Bfrtip',
						buttons: [
						{
							extend: 'excelHtml5',
							title: 'Loan Schedule Details'
						},
						{
							extend: 'pdfHtml5',
							title: 'Loan Schedule Details',
							orientation: 'landscape',
							pageSize: 'LEGAL'
						},
						{
							extend: 'csvHtml5',
							title: 'Loan Schedule Details'
						}
					],
			//		 "responsive":true,
					"ajax": {
								"url": "/cc/AjaxCustom/rest_api_call",
								"dataSrc": function ( json ) {
										$("#loader").addClass("hidden"); 
										return json;
								},
								"beforeSend": function() {
									//alert("before send");
									$("#loader").removeClass("hidden"); 
								},
								"data": {
										method: 'getLoanScheduleDetails',
										ag_no: '<?php echo $agreement ;?>',
								}
					},
					"columns": [
						{ "data": "INSTALLMENT_NO" },
						{ "data": "INSTALLMENT_DUE_DATE" },
						{ "data": "EMI" },
						{ "data": "PRINCIPLE_AMOUNT" },
						{ "data": "INTEREST_AMOUNT" },
						{ "data": "BALANCE_PRINCIPLE" },
						{ "data" : "INSURANCE_AMOUNT"	},
						{ "data": "MONTHLY_DUE" },
												
						],
						"bDestroy": true
					} );
 </script>
<table id="lschedule" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Installment No.</th>
				<th>Installment Due <br />Date</th>
				<th>EMI</th>
				<th>Principle Amount</th>
				
				<th>Interest Amount</th>
				<th>Balance Principle</th>
				<th>Insurance Amount</th>
				
				<th>Monthly Due</th>				
            </tr>
        </thead>
        
    </table>
 </body>
 </html>