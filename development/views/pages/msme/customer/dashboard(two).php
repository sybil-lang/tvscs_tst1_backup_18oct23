<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="tvs_header.php" clickstream="employee-login"/>
<?php 
$agg_no = $_REQUEST['aggno'];
$pros_no = $_REQUEST['prospect_no'];
?>
  <!-- Contact Number Ends Here--> 
  
  <!--Mega Menu starts Here!--> 
  
<!--Mega Menu Ends Here!--> 
<!--Main section  starts Here!-->

<div class="container dashboard">
  <div class="home-image" style="background: none!important;"> 
<h1>Dashboard : Client</h1>
<section>
  <h4 class="active" id="loginstatus_target">Login Status</h4>
  <ul>
  <li id="loginstatus">
			<p>Demo1</p>
	  </li>
  </ul>
  <h4 id="paymentdetails_target">Payment Details</h4>
  <ul>
    <li id="paymentdetails">
		  <table id="example2" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>EMI</th>
				<th>RECEIPT_NUMBER</th>
				<th>BOUNCE_CHARGES</th>
				<th>RECEIPT_AMOUNT</th>
				<th>PAYMENT_TYPE</th>
				<th>PAYMENT_MODE</th>
				<th>RECEIPT_DATE</th>
				<th>PENAL</th>
				<th>OTHERS_CHARGES</th>
				<th>CBC</th>
				<th>AGREEMENT_NO</th>
            </tr>
        </thead>
        <tfoot>
            <tr>			
                <th>EMI</th>
				<th>RECEIPT_NUMBER</th>
				<th>BOUNCE_CHARGES</th>
				<th>RECEIPT_AMOUNT</th>
				<th>PAYMENT_TYPE</th>
				<th>PAYMENT_MODE</th>
				<th>RECEIPT_DATE</th>
				<th>PENAL</th>
				<th>OTHERS_CHARGES</th>
				<th>CBC</th>
				<th>AGREEMENT_NO</th>																																				
            </tr>
        </tfoot>
    </table>
	  </li>
  </ul>
  <h4 id="loanschedule_target">Loan Schedule</h4>
  <ul>
	  <li id="loanschedule">
		  <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>INSURANCE_AMOUNT</th>
				<th>INSTALLMENT_STATUS</th>
				<th>PRINCIPLE_AMOUNT</th>
				<th>EMI</th>
				<th>INSTALLMENT_NO</th>
				<th>INSURANCE_AMOUNT_PAID</th>
				<th>INTEREST_AMOUNT_PAID</th>
				<th>OVER_DUE_INTEREST_AMOUNT</th>
				<th>INTEREST_AMOUNT</th>
				<th>INSTALLMENT_DUE_DATE</th>
				<th>INSURANCE_AMOUNT_WAIVED</th>
				<th>PRINCLIPLE_AMOUNT_PAID</th>
				<th>OVER_DUE_PRINCIPLE_AMOUNT</th>
            </tr>
        </thead>
        <tfoot>
            <tr>			
                <th>INSURANCE_AMOUNT</th>
				<th>INSTALLMENT_STATUS</th>
				<th>PRINCIPLE_AMOUNT</th>
				<th>EMI</th>
				<th>INSTALLMENT_NO</th>
				<th>INSURANCE_AMOUNT_PAID</th>
				<th>INTEREST_AMOUNT_PAID</th>
				<th>OVER_DUE_INTEREST_AMOUNT</th>
				<th>INTEREST_AMOUNT</th>
				<th>INSTALLMENT_DUE_DATE</th>
				<th>INSURANCE_AMOUNT_WAIVED</th>
				<th>PRINCLIPLE_AMOUNT_PAID</th>
				<th>OVER_DUE_PRINCIPLE_AMOUNT</th>
            </tr>
        </tfoot>
    </table>
	  </li>
  </ul>
  <h4 id="charges_target">Charges</h4>
  <ul>
   <li id="charges">
		   <table id="example3" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>DUE_TYPE</th>
				<th>VALUE</th>
            </tr>
        </thead>
        <tfoot>
            <tr>			
                <th>DUE_TYPE</th>
				<th>VALUE</th>
            </tr>
        </tfoot>
    </table>
	  </li>
  </ul>
  
</section>

</div>
	</div>
<!--Main section  Ends Here!-->

<script type="text/javascript" src="js/jquery.slicknav.js"></script>
	<script type="text/javascript">
	$('section h4').click(function(event) {
  event.preventDefault();
  $(this).addClass('active');
  $(this).siblings().removeClass('active');

  var ph = $(this).parent().height();
  var ch = $(this).next().height();

  if (ch > ph) {
    $(this).parent().css({
      'min-height': ch + 'px'
    });
  } else {
    $(this).parent().css({
      'height': 'auto'
    });
  }
});

function tabParentHeight() {
  var ph = $('section').height();
  var ch = $('section ul').height();
  if (ch > ph) {
    $('section').css({
      'height': ch + 'px'
    });
  } else {
    $(this).parent().css({
      'height': 'auto'
    });
  }
}

$(window).resize(function() {
  tabParentHeight();
});

$(document).resize(function() {
  tabParentHeight();
});
tabParentHeight();
	</script>
	
	
<script> 
	$("#loanschedule_target").click(function(){
		$('#example').DataTable( {
					"ajax": {
								"url": "/cc/AjaxCustom/rest_api_call",
								"dataSrc": "",
								"data": {
										method: 'getLoanScheduleDetails',
										ag_no: 'TN3003CA00023',
								}
							},
					"columns": [
						{ "data": "INSURANCE_AMOUNT" },
						{ "data": "INSTALLMENT_STATUS" },
						{ "data": "PRINCIPLE_AMOUNT" },
						{ "data": "EMI" },
						{ "data": "INSTALLMENT_NO" },
						{ "data": "INSURANCE_AMOUNT_PAID" },
						{ "data": "INTEREST_AMOUNT_PAID" },
						{ "data": "OVER_DUE_INTEREST_AMOUNT" },
						{ "data": "INTEREST_AMOUNT" },
						{ "data": "INTALLMENT_DUE_DATE" },
						{ "data": "INSURANCE_AMOUNT_WAIVED" },
						{ "data": "PRINCLIPLE_AMOUNT_PAID" },
						{ "data" : "OVER_DUE_PRINCIPLE_AMOUNT"	}
						],
						"bDestroy": true
					} ).fnDestroy();;
				} );
	
	
	$("#loginstatus_target").click(function() {
		$.post('/cc/AjaxCustom/rest_api_call', { method : 'getCustomerDetails',  ag_no : 'TN3003CA00023'})
													 .done(function( data ) {
												 $('#loginstatus').html(data);
										 });
	});
	
	$("#paymentdetails_target").click(function() {
		$('#example2').DataTable( {
					"ajax": {
								"url": "/cc/AjaxCustom/rest_api_call",
								"dataSrc": "",
								"data": {
										method: 'getLastPaymentHistory',
										ag_no: 'TN3003CA00023',
								}
							},
					"columns": [
						{ "data": "EMI" },
						{ "data": "RECEIPT_NUMBER" },
						{ "data": "BOUNCE_CHARGES" },
						{ "data": "RECEIPT_AMOUNT" },
						{ "data": "PAYMENT_TYPE" },
						{ "data": "PAYMENT_MODE" },
						{ "data": "RECEIPT_DATE" },
						{ "data": "PENAL" },
						{ "data": "OTHERS_CHARGES" },
						{ "data": "CBC" },
						{ "data": "AGREEMENT_NO" }
						],
						"bDestroy": true
					} ).fnDestroy();;
	});
	
	
	$("#charges_target").click(function() {
		$('#example3').DataTable( {
					"ajax": {
								"url": "/cc/AjaxCustom/rest_api_call",
								"dataSrc": "",
								"data": {
										method: 'getLastPaymentDetails',
										ag_no: 'TN3003CA00023',
								}
							},
					"columns": [
						{ "data": "DUE_TYPE" },
						{ "data": "VALUE" }
						],
						"bDestroy": true
					} ).fnDestroy();;
	});
</script>

</html>
