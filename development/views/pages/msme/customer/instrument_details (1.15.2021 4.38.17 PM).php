<html>
<head></head>
<body>
<?php
 //$report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
$report_id=$msg->Value;
?>
<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="instrumentdetails"></div>

  </fieldset>
  
</form>

<p>&nbsp;</p>
<div id="instrumentdetails_docs" style='display:none'>
	<div class="row">
		<div class="col-md-4">
			  <a href="javascript:void(0);" target="_blank" id="url_ins"><img src='/euf/assets/themes/standard/images/clipboard-icon.png' height="100" width="100"></a><p>Insurance Policy Renewal</p>
		</div>
		<div class="col-md-4" id="forclosure">
			  <a href="javascript:void(0);" target="_blank" id="url_for"><img src='/euf/assets/themes/standard/images/documents-flat.png' height="100" width="100"></a><p>Foreclosure Letter</p>
		</div>
		<div class="col-md-4" id="soa">
			  <a href="javascript:void(0);" id="url_for_soa"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a><p>SOA</p>
		</div>
	</div>
</div> 
<div id="showresult_instrument" style='display:none'>
<div class="row">
	<div class="col-md-4" id="forclosure_n">
		<a href="javascript:void(0);" target="_blank" id="url_for_n"><img src='/euf/assets/themes/standard/images/documents-flat.png' height="100" width="100"></a><p>Foreclosure Letter</p>
	</div>
	<div class="col-md-4" id="soa_n">
		<a href="javascript:void(0);"  id="url_for_n_soa"><img src='/euf/assets/themes/standard/images/clipboard_icon-1.png' height="100" width="100"></a><p>SOA</p>
	</div>
</div>
</div>
<script type="text/javascript">
$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'instrumentdetails', method_val : 'getInsuranceDetails'})
		 .done(function( data ) {
	 $( "#instrumentdetails" ).html(data);
});
$('a#url_for_soa').click(function(e){
		     // stop its defaut behaviour
		     //console.log("url_for_soa?: ",isSoaOk);
		     if(isSoaOk == false){
		     	alert("Contact Customer Support for SOA");
		     	e.preventDefault();
		     }
		      
});
$('a#url_for_n_soa').click(function(e){
	     // stop its defaut behaviour
	      //console.log("url_for_n_soa?: ",isSoaOk);
	     if(isSoaOk == false){
	     	alert("Contact Customer Support for SOA");
	     	e.preventDefault();
	     }
	      
});
									
</script>

</body>
</html>