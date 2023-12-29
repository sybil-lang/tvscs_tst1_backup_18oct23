<?php
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('internal employee');
?>
 <html>
 <head></head>
 <body>
 <?php
 //$agreement = \RightNow\Utils\Url::getParameter('ag_id');
$userProfile = $CI->session->getSessionData('userProfile');
$agreement = $userProfile['agg_no'];
?>
 <script type="text/javascript">
$.ajax('/cc/AjaxCustom/rest_api_call', 
			{ 
				data: {
				method : 'getCustomerDetails',  
				ag_no : '<?php echo $agreement;?>'
			},
			type: "POST",
			beforeSend: function() {
				//alert("before send");
				$("#loader").removeClass("hidden"); 
			},
			success: function( data ) {
					$("#loader").addClass("hidden"); 
					$('#login_status_data').html(data);
			}
		});
 </script>
<div id="login_status_data"></div>

 </body>
 </html>