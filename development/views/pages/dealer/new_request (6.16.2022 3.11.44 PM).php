<html>
<head></head>
<body>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer'); 

$dealer_code=$CI->session->getProfileData("login");
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
var ta_overdue_param = false;
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
			   // var obj = jQuery.parseJSON(response);
				// console.log(obj);
				// $('#maximum_eligibleamount').val(obj[0].TA_MAXIMUM_ELIGIBLE_AMOUNT);
			 //   $('#ta_balance').val(obj[0].TA_BALANCE_AS_ON_DATE);
			 //   $('#pending_request').val(obj[0].TA_NO_OF_PENDING_REQUEST);
			 //   $('#ta_overdue').val(obj[0].TA_OVERDUE_AS_ON_DATE);
			 //   $('#pending_amount').val(obj[0].TA_PENDING_REQUEST_AMOUNT);  //commented on 4 may 2020
			  /*var $title = $('<h1>').text(data.talks[0].talk_title);
			  var $description = $('<p>').text(data.talks[0].talk_description);
			  $('#info')
				 .append($title)
				 .append($description);*/
				 try {
              var obj = jQuery.parseJSON(response);
              $('#maximum_eligibleamount').val(obj[0].TA_MAXIMUM_ELIGIBLE_AMOUNT);
              $('#ta_balance').val(obj[0].TA_BALANCE_AS_ON_DATE);
              $('#pending_request').val(obj[0].TA_NO_OF_PENDING_REQUEST);
              $('#ta_overdue').val(obj[0].TA_OVERDUE_AS_ON_DATE);
              // $('#ta_overdue').val(50000);
              $('#pending_amount').val(obj[0].TA_PENDING_REQUEST_AMOUNT);
              $('#maximum_amount').val(parseInt($('#maximum_eligibleamount').val() ? $('#maximum_eligibleamount').val() : 0) - (parseInt($('#pending_amount').val() ? $('#pending_amount').val() : 0) + parseInt($('#ta_balance').val() ? $('#ta_balance').val() : 0)));
              if ($('#ta_overdue').val().length > 0 && $('#ta_overdue').val() != "0") {
                $('#ta_overdue').parent().css("border", "3px solid red");
                // $('#maximum_amount').attr("disabled", true);
                // $('#btnTARequest').attr("disabled", true);
                ta_overdue_param = true;
                $('#issue').html("Your TA is in Overdue.").css("display","block");
              }
              else{
              	// $('#btnTARequest').removeAttr("disabled");
              	$('#issue').css("display","none");
              }
            } catch (e) {
            	console.error(e);
            }
		   },
		   type: 'POST'
		});
});
var html ;
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
	if(ta_overdue_param == true){
		if($('#ta_overdue').val() >= 100000 ){
				bootbox.alert('<div class="alert alert-warning"><strong>Your TA is in Overdue. You cannot raise an indent.</strong></div>');
		}
		else if(amt_request == 0 ){
				//Request amount should be greater than zero
				//If ((Maximum Eligible Amount - TA Balance as on Date) < Amount Request) THEN
				bootbox.alert('<div class="alert alert-warning"><strong>Request amount should be greater than zero.</strong></div>');
		}
		else if(diff_amt < amt_request){
				//Request amount should be greater than zero
				
				//If ((Maximum Eligible Amount - TA Balance as on Date) < Amount Request) THEN
				bootbox.alert('<div class="alert alert-warning"><strong>Amount Request should be less than or equal to TA Balance.</strong></div>');
		}
		else if(amt_request < 400000){
				bootbox.alert('<div class="alert alert-warning"><strong>Request amount should be greater than Four Lakhs (4,00,000).</strong></div>');
		}
		else
		{
			// alert("inside Create req");
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
 							if(obj[0].count!=null)
					   {
							bootbox.alert('<div class="alert alert-warning"><strong>New request can be raised after getting decision by TVSCS on existing Indent request.</strong></div>');
					   }
					   else
					   {
					   	 html = '<p>Thanks for submitting your TA Request. Use this reference number for follow up: <b><a href="/app/dealer/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
					   //alert(obj[0].value_id);
					   //console.log(obj);
					   sendApproverEmail(obj[0].value_id);
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
		
	}
	else{
		if(amt_request == 0 ){
				//Request amount should be greater than zero
				bootbox.alert('<div class="alert alert-warning"><strong>Request amount should be greater than zero.</strong></div>');
		}
		else if(diff_amt < amt_request){			
				//If ((Maximum Eligible Amount - TA Balance as on Date) < Amount Request) THEN
				bootbox.alert('<div class="alert alert-warning"><strong>Amount Request should be less than or equal to TA Balance.</strong></div>');
		}
		else if(amt_request < 400000){
				bootbox.alert('<div class="alert alert-warning"><strong>Request amount should be greater than Four Lakhs (4,00,000).</strong></div>');
		}
		else
		{
			// alert("inside Create req");
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
					    if(obj[0].count!=null)
					   {
							bootbox.alert('<div class="alert alert-warning"><strong>New request can be raised after getting decision by TVSCS on existing Indent request.</strong></div>');
					   }
					   else
					   {
					   	 html = '<p>Thanks for submitting your TA Request. Use this reference number for follow up: <b><a href="/app/dealer/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
					   //alert(obj[0].value_id);
					   //console.log(obj);
					   sendApproverEmail(obj[0].value_id);
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
	
	}
});

function sendApproverEmail(incidentID){
		if(incidentID != ''){
			var paramstring = {
				'dcode': '<?php echo $dealer_code;?>',
				'i_id': incidentID
			}
			 $.ajax({
			   url: '/cc/DealerCustom/sendApproverEmailRequest',
			   type: 'post',
			   data: paramstring,
			   beforeSend: function(){
						$("#loader").removeClass("hidden");
			   },
			   error: function() {
						bootbox.alert("<p>An error has occurred....</p>");
			   },
			   success: function(response) {
						//console.log(response);
						// var obj = jQuery.parseJSON(response);
						console.log(response);
						$("#loader").addClass("hidden");
					//	console.log(obj);
					///	alert(obj.email_sent);
						// if (obj.email_sent == 'true'){
						bootbox.alert(html,function(){ window.location.reload(); });
					//	   }else{
						//	bootbox.alert("<p>An error has occurred sending Approver Email</p>",function(){ window.location.reload(); });
						//   }
			   }
			 });
		}
}
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
			<p id="issue" style="display: none;color:red;padding:2px;"></p>
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
		<label for="formGroupExampleInput2">No. of Pending Request & Amount</label>
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