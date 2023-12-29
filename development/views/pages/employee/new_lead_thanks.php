<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="employee_header.php" clickstream="incident_create"/>
<?php
 $reference_id = \RightNow\Utils\Url::getParameter('ref_id');

?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Thank You</strong></h3>
  </div>
</div>
<br clear="all">
<div class="table-responsive col-md-8 ">
  <table width="100%" cellpadding="10" cellspacing="3" class="table-striped">
    <thead>
      <tr>
        <td align="center">Thanks for submitting your details. Your reference number is <?php echo $reference_id;?>. We will get back to you soon. <a href="/app/employee/dashboard">Click here</a> to go back.</td>
      </tr>
    </thead>
  </table>
</div>