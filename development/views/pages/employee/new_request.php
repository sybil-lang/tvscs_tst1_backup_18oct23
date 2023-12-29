<html>
<head></head>
<body>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');

$userProfile = $CI->session->getSessionData('userProfile');
$dealer_code = $userProfile['dealer_codes'];
//echo ($this->uri->segment('1'));
//echo $agg_no = \RightNow\Utils\Url::getParameter('ag_id');
/*$pros_no = \RightNow\Utils\Url::getParameter('p_id');
list($pros_no,$agg_no) = explode("_",$pros_no);
if(!empty($agg_no)){
	$agreement_id = $agg_no;
}elseif(empty($agg_no) && !empty($pros_no)){
	$agreement_id = $pros_no;
}
*/
?>
<script type="text/javascript">

$( document ).ready(function() {
		   $.ajax({
		   url: '/cc/DealerCustom/getTARestData',
		   data: {
			  method: 'getTADealerRequest',
			  dealer_code: '<?php echo $dealer_code;?>'
		   },
		   beforeSend: function(){
					$("#loader").removeClass("hidden");
		   },
		   error: function() {
			  //$('#info').html('<p>An error has occurred</p>');
		   },
		   success: function(response) {
			   $("#loader").addClass("hidden");
			  // alert(response);
			   var obj = jQuery.parseJSON(response);
				console.log(obj);
				$('#maximum_eligibleamount').val(obj[0].TA_MAXIMUM_ELIGIBLE_AMOUNT);
			   $('#ta_balance').val(obj[0].TA_BALANCE_AS_ON_DATE);
			   $('#pending_request').val(obj[0].TA_NO_OF_PENDING_REQUEST);
			   $('#ta_overdue').val(obj[0].TA_OVERDUE_AS_ON_DATE);
			   $('#pending_amount').val(obj[0].TA_PENDING_REQUEST_AMOUNT);
			  /*var $title = $('<h1>').text(data.talks[0].talk_title);
			  var $description = $('<p>').text(data.talks[0].talk_description);
			  $('#info')
				 .append($title)
				 .append($description);*/
		   },
		   type: 'POST'
		});
});

$( "#btnTARequest" ).click(function() {

	var datastring = $("#frmrequest").serialize();
	//alert("good");
	//alert(datastring);
	var amt_request = $('#maximum_amount').val();
	var ta_bal = $('#ta_balance').val();
	var amt_avail = $('#maximum_eligibleamount').val();
	//var amt_request = $('#maximum_amount').val();
	//alert(amt_avail);
	//alert(ta_bal);
	var diff_amt = amt_avail - ta_bal;
	if(amt_request == 0){
		//Request amount should be greater than zero
		//If ((Maximum Eligible Amount - TA Balance as on Date) < Amount Request) THEN
		bootbox.alert('<div class="alert alert-warning"><strong>Request amount should be greater than zero.</strong></div>');
	}else if(diff_amt < amt_request){
		//Request amount should be greater than zero
		
		//If ((Maximum Eligible Amount - TA Balance as on Date) < Amount Request) THEN
		bootbox.alert('<div class="alert alert-warning"><strong>Amount Request should be less than or equal to TA Balance.</strong></div>');
	}else{
		   $.ajax({
			   url: '/cc/DealerCustom/createTARequest',
			   data: datastring,
			   beforeSend: function(){
						$("#loader").removeClass("hidden");
			   },
			   error: function() {
						bootbox.alert("<p>An error has occurred....</p>");
			   },
			   success: function(response) {
				   $("#loader").addClass("hidden");
				   var obj = jQuery.parseJSON(response);
				   var html = '<p>Thanks for submitting your TA Request. Use this reference number for follow up: <b><a href="/app/employee/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
				   //alert(obj[0].value_id);
				   console.log(obj);
				   if (obj[0].value_id){
						bootbox.alert(html,function(){ window.location.reload(); });
				   }else{
						bootbox.alert("<p>An error has occurred</p>");
				   }
				  /*var $title = $('<h1>').text(data.talks[0].talk_title);
				  var $description = $('<p>').text(data.talks[0].talk_description);
				  $('#info')
					 .append($title)
					 .append($description);*/
			   },
			   type: 'POST'
			});
		}
});
</script>
<form id="frmrequest" name="frmrequest">
<input type="hidden" name="contactID" value="<?php echo $CI->session->getProfileData("c_id");?>" />
	  <div class="form-group">
		<label for="formGroupExampleInput1">Maximum Eligiable Amount</label>
		<div class="input-group col-md-4">
		  <div class="input-group-addon">₹</div>
		  <input type="text" class="form-control" id="maximum_eligibleamount" name="maximum_eligibleamount" placeholder="Amount" value="0" disabled>
		  <div class="input-group-addon">.00</div>
		</div>
	  </div>
	
	<div class="form-group">
		<label for="formGroupExampleInput2">TA Balance as on Date & Over Due</label>
		<div class="input-group col-sm-3">
		  <div class="input-group-addon">₹</div>
		  <input type="text" class="form-control" id="ta_balance" name="ta_balance" placeholder="TA Balance" value="0" disabled>
		  <div class="input-group-addon">.00</div>
		</div> <strong>& </strong>
		<div class="input-group col-sm-3">
		  <div class="input-group-addon">₹</div>
		  <input type="text" class="form-control" id="ta_overdue" name="ta_overdue" placeholder="TA Overdue" value="0" disabled>
		  <div class="input-group-addon">.00</div>
		</div>
	 </div>
	
	<div class="form-group">
		<label for="formGroupExampleInput3">Amount Request</label>
		<div class="input-group col-md-4">
		  <div class="input-group-addon">₹</div>
		  <input type="text" class="form-control" id="maximum_amount" name="maximum_amount" placeholder="Amount Request" value="0" class="required">
		  <div class="input-group-addon">.00</div>
		</div>
	  </div>

	
	
	<div class="form-group">
		<label for="formGroupExampleInput2">Noof Pending Request & Amount</label>
		<div class="input-group col-sm-3">
		  <div class="input-group-addon"></div>
		  <input type="text" class="form-control" id="pending_request"  name="pending_request" placeholder="Noof Pending Request" value="0" disabled>
		  <div class="input-group-addon"></div>
		</div> <strong>&</strong>
		<div class="input-group col-sm-3">
		  <div class="input-group-addon">₹</div>
		  <input type="text" class="form-control" id="pending_amount" name="pending_amount" placeholder="Amount" value="0" disabled>
		  <div class="input-group-addon">.00</div>
		</div>
	 </div>

  <button type="button" class="btn btn-primary" id="btnTARequest">Submit</button>
</form>
</body>
</html>