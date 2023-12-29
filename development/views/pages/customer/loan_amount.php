<html>
<head>
    <style>
       #initialloanamount
        {
           background: #fff;
            padding: 0px 10px;
            display: inline-block;
            width: 250px;
        }
        .form-group ul
        {
            border:1px solid;
        }
        #iload
        {
        height: 80px;
        position: absolute;
        top: 101px;
        right: 599px;
        display:none;
        }
        .z-container{
            min-height: 161px !important;
        }
    </style></head>
<body>
  <img id="iload" src="/euf/assets/themes/standard/images/loading-large.gif">
<?php
// $report_id = \RightNow\Utils\Url::getParameter('r_id');
$CI=&get_instance();
$CI->load->helper('report');
checkCustomerType('customer');
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
$report_id=$msg->Value;
?>
<h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

<form action='#' method='post' class="loan-form">
  <fieldset>
    <div id="initialloanamount"></div>

  </fieldset>
</form>
<p>&nbsp;</p>
<div id="showresult"></div>
<script type="text/javascript">
									$.post( "/cc/AjaxCustom/rest_api_report", { id_of_report : '<?php echo $report_id;?>' , filtering_val : 'initialloan', method_val : 'initialloanamount'})
													 .done(function( data ) {
												 $( "#initialloanamount" ).html(data);
										 });
</script>

</body>
</html>