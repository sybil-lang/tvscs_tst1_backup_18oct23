<?php
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
?>
 <html>
 <head></head>
 <body>
 <?php
 $agreement = \RightNow\Utils\Url::getParameter('ag_id');

?>
 <script type="text/javascript">
$.post('/cc/AjaxCustom/rest_api_call', { method : 'getCustomerDetails',  ag_no : '<?php echo $agreement;?>'})
													 .done(function( data ) {
												 $('#login_status_data').html(data);
										 });
 </script>
<div id="login_status_data"></div>

 </body>
 </html>