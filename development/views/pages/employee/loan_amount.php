<html>
<head></head>
<body>
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('internal employee');
//$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_AgreementNo_EmployeeBasis);
//$report_id=$msg->Value;
//$agreement = \RightNow\Utils\Url::getParameter('ag_id');
$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
?>
<!--<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>-->

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="initialloanamount"></div>

  </fieldset>
</form>

<p>&nbsp;</p>
<div id="showresult"></div>
<script type="text/javascript">
		/*$.post( "/cc/EmployeeCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'initialloan', method_val : 'initialloanamount'})
						 .done(function( data ) {
					 $( "#initialloanamount" ).html(data);
			 });
*/
$.ajax('/cc/AjaxCustom/rest_api_call_drop', 
			{ 
				data: {
				method_val : 'initialloanamount',  
				ag_no : '<?php echo $agreement;?>'
			},
			type: "POST",
			beforeSend: function() {
				//alert("before send");
				$("#loader").removeClass("hidden"); 
			},
			success: function( data ) {
					$("#loader").addClass("hidden"); 
					$( "#initialloanamount" ).html(data);
			}
		});
</script>

</body>
</html>