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
	th{
background-color: #3B6DB1;
color: #ffffff;
	}
	</style>
 <body>
  <?php
 //$agreement = \RightNow\Utils\Url::getParameter('ag_id');
$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
?>
 <script type="text/javascript">
$('#pdetails').DataTable( {
					 "scrollX": true,
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
			//		 "responsive":true,
					"ajax": {
								"url": "/cc/AjaxCustom/rest_api_call",
								"dataSrc": function ( json ) {
										//Make your callback here.
										//alert("Done!");
										$("#loader").addClass("hidden"); 
										//fnCallback(data);
										return json;
										//console.log(json);
									},
								"beforeSend": function() {
									//alert("before send");
									$("#loader").removeClass("hidden"); 
								},
								"data": {
										method: 'getLastPaymentHistory',
										ag_no: '<?php echo $agreement;?>',
								}
							},
					"columns": [
						
						{ 
							"data": "AGREEMENT_NO",
							"defaultContent": "<i>No value</i>"
						},
						{ 
							"data": "PAYMENT_MODE",
							"defaultContent": "<i>No value</i>"
						},
						{ 
							"data": "RECEIPT_NO",
							"defaultContent": "<i>No value</i>"
						},
						{ 
							"data": "PAYMENT_TYPE",
							"defaultContent": "<i>No value</i>"
						},
						{ 
							"data": "RECEIPT_AMOUNT",
							"defaultContent": "<i>No value</i>"
						},
						{ 
							"data": "RECEIPT_DATE",
							"defaultContent": "<i>No value</i>"
						},
						{ 
								"data": "EMI_WITH_INSURANCE",
								"defaultContent": "<i>No value</i>"
						},						
						{ 
							"data": "CBC_CASH_BOUNCE",
							"defaultContent": "<i>No value</i>"
						},						
						{ 
							"data": "BOUNCE_CHARGES",
							"defaultContent": "<i>No value</i>"
						},
						{ 
							"data": "PENAL",
							"defaultContent": "<i>No value</i>"
						},												
						{ 
							"data": "OTHER_CHANGES", 
							"defaultContent": "<i>No value</i>"
						}												
						],
						"bDestroy": true
					} );
 </script>
<table id="pdetails" class="table display table-bordered  nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Agreement No</th>
				<th>Payment Mode</th>
				<th>Receipt Number</th>
				<th>Payment Type</th>
				<th>Receipt Amount</th>
				<th>Receipt Date</th>
				<th>EMI</th>				
				<th>CBC</th>				
				<th>Bounce Charges</th>
				<th>Penal</th>
				<th>Others Charges</th>
								
            </tr>
        </thead>
        
    </table>
 </body>
 </html>