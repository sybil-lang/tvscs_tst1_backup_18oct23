<rn:meta title="Lead Creation Result" template="dealer_header.php" clickstream="incident_create"/>
<?php
 $reference_id = \RightNow\Utils\Url::getParameter('ref_id');
 $error_mesg = \RightNow\Utils\Url::getParameter('err_msg');
?>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"><strong>Thank You</strong></h3>
  </div>
</div>
<style type="text/css">
  .mytext{
    font-size: 16px;
    background-color: #e4e4e4;
    padding: 20px;
    border-radius: 10px;
  }
</style>
<br clear="all">
<div class="container mytext">
  
        <?php if(is_null($reference_id) && !is_null($error_mesg)){ ?>
          <div><? echo $error_mesg; ?>. <a href="/app/dealer/dashboard">Click here</a> to go back.</div>
        <? } else if(is_null($error_mesg) && !is_null($reference_id)){ ?>
        <div>Thanks for submitting your details. Your reference number is <strong> <?php echo $reference_id;?></strong>. We will get back to you soon. <a href="/app/dealer/dashboard">Click here</a> to go back.</div>
      <? } ?>
     
</div>