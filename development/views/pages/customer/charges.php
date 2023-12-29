 <html>
 <head></head>
 
 <body>
<?php
 $agreement = \RightNow\Utils\Url::getParameter('ag_id');
 $CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');

?>
 <script type="text/javascript">
 $.post('/cc/AjaxCustom/rest_api_call', { method : 'getLastPaymentDetails',  ag_no : '<?php echo $agreement;?>'})
													 .done(function( data ) {
												 $('#charges_data').html(data);
										 });

 </script>
 <div id="charges_data"></div>


 </body>
 </html>