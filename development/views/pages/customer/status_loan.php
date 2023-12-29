<?php
$CI = &get_instance();
$CI->load->helper('report');

checkCustomerType('customer');
?>
<html>

<head>
  <style type="text/css">
    #isload {
      height: 80px;
      position: absolute;
      top: 101px;
      right: 599px;
      display: none;
    }
  </style>
</head>

<body>
  <img id="isload" src="/euf/assets/themes/standard/images/loading-large.gif">
  <?php
  // $report_id = \RightNow\Utils\Url::getParameter('r_id');
  $msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
  $report_id = $msg->Value;
  ?>
  <h4 align="center" style="margin-top:15px;">Please Select Agreement Number</h4>

  <form action='#' method='post' class="loan-form">
    <fieldset>
      <div id="statusofloan"></div>

    </fieldset>
  </form>
  <p>&nbsp;</p>
  <div id="showresult_loan"></div>
  <script type="text/javascript">
    $.post("/cc/AjaxCustom/rest_api_report", {
        id_of_report: '<?php echo $report_id; ?>',
        filtering_val: 'statusofloan',
        method_val: 'statusofloan'
      })
      .done(function(data) {
        console.log("data from " ,data)
        $("#statusofloan").html(data);
      });
  </script>

</body>

</html>