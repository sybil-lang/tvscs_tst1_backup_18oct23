<?php
 $CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');
?>
<html>
<head></head>
<body>
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
//$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
//$report_id=$msg->Value;
$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
?>
<!--<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>-->

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="statusofloan"></div>

  </fieldset>
</form>
<p>&nbsp;</p>
<div id="showresult_loan"></div>
<script type="text/javascript">
/*$.post( "/cc/EmployeeCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'statusofloan', method_val : 'statusofloan'})
													 .done(function( data ) {
												 $( "#statusofloan" ).html(data);
										 });
	*/
$.ajax('/cc/AjaxCustom/rest_api_call_drop', 
			{ 
				data: {
				method_val : 'statusofloan',  
				ag_no : '<?php echo $agreement;?>'
			},
			type: "POST",
			beforeSend: function() {
				//alert("before send");
				$("#loader").removeClass("hidden"); 
			},
			success: function( data ) {
					$("#loader").addClass("hidden"); 
					$( "#statusofloan" ).html(data);
			}
		});
									
</script>

</body>
</html>