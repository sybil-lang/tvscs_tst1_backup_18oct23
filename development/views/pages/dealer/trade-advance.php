<rn:meta title="Incentives & Claims" template="dealer_header.php" login_required="true" force_https="true" />
<style type="text/css">
  .bg-danger {
    background-color: #054fa4 !important;
    color: #fff!important;
  }

  .bg-info {
    background-color: #054fa4 ;
    color: #fff;
  }

  .bg-warning {
    background-color: #ff8a00 ;
    color: #fff;
  }

  .bg-success {
    background-color: #054fa4 ;
    color: #fff;
  }

  .panel-stat3 {
    position: relative;
    overflow: hidden;
    padding: 25px 20px;
    margin-bottom: 20px;
    color: #fff;
    border-radius: 10px;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
  } 
  .m-top-none {
    margin-top: 0;
  }
  .m-left-xs {
    margin-left: 5px;
  }

  .panel-stat3 .stat-icon {
    position: absolute;
    top: 20px;
    right: 10px;
    font-size: 30px;
    opacity: .3;
  }

  .panel-stat3 .refresh-button {
    position: absolute;
    top: 10px;
    right: 10px;
    transition: all .2s ease;
    -webkit-transition: all .2s ease;
    -moz-transition: all .2s ease;
    -ms-transition: all .2s ease;
    -o-transition: all .2s ease;
    color: rgba(0,0,0,.3);
  }
  .rn_Body{
    min-height: 500px;
  }
  .bg-successG{
    background-image: linear-gradient(110deg, #11a700, #115184);
  }
  #page_title{
    margin-left:15px;
  }
  .noti_text{
    text-align: center;
    font-size: 1.8rem;
    padding-top: 20px;
    color: red;
  }
  .noti_div{
    width: 50%;
    margin: 0 auto;
  }
  span#to-pay{
    font-size: 14px;
  }
</style>
<?php
$CI = &get_instance();
$CI->load->helper('report');
checkCustomerType('dealer');
$c_id = $CI->session->getProfileData("c_id");
$contact = \RightNow\Connect\v1_3\Contact::fetch($c_id);
$dealerProduct = $contact->CustomFields->CO->DealerProduct;
$newTaRequestVisible = false;
$taSummaryVisible = false;
$taTransactionVisible = true;
if ($dealerProduct->ProductCode == "TR") {
  $newTaRequestVisible = true;
  $taSummaryVisible = true;
}
//echo ($this->uri->segment('1'));
//echo $agg_no = \RightNow\Utils\Url::getParameter('ag_id');
/* $pros_no = \RightNow\Utils\Url::getParameter('p_id');
  list($pros_no,$agg_no) = explode("_",$pros_no);
  if(!empty($agg_no)){
  $agreement_id = $agg_no;
  }elseif(empty($agg_no) && !empty($pros_no)){
  $agreement_id = $pros_no;
  }
 */
?>

<h1 id="page_title">Trade Advance</h1>
<div class="noti_div">
    <p class="noti_text">Transfer the amount through Payment gateway for easy & faster Updation. Once payment completed it will reflect in statement within one hour.</p>
</div>
<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">

  <div class="row">
    <div style="padding-top: 3em;"></div>
    <div class="col-lg-3 col-md-4" style="visibility: show;"></div>

    <?php if ($newTaRequestVisible) { ?>
      <div id="TA_REQ" class="col-lg-3 col-md-6" style="visibility: show;">
        <div class="panel-stat3 bg-danger">
          <h2 class="m-top-none">TA Request</h2>
          <div>
            <a  id="btnTARequest" class="btn  btn-warning" href="<?php echo $site_url; ?>/app/dealer/trade-request">Create
              <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="stat-icon">
            <i class="fa fa-angle-double-right fa-3x"></i>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if ($taSummaryVisible) {
      ?>
      <div id="TA_SUM" class="col-lg-3 col-md-6">
        <div class="panel-stat3 bg-warning">
          <h2 class="m-top-none">TA Summary</h2>
          <div>
            <a id="btnTASummary" class="btn btn-warning" href="<?php echo $site_url; ?>/app/dealer/trade_summary">View
              <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="stat-icon">
            <i class="fa fa-bar-chart-o fa-2x"></i>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>

  <div class="row">
    <div style="padding-top: 5em;"></div>
    <div class="col-lg-3 col-md-4"></div>
    <?php if ($taTransactionVisible) { ?>
      <div id="TA_TRANS" class="col-lg-3 col-md-6">
        <div class="panel-stat3 bg-warning">
          <h2 class="m-top-none">TA Transaction</h2>
          <div>
            <a onclick="#" id="btnTATransaction" class="btn btn-warning" href="<?php echo $site_url; ?>/app/dealer/trade_transaction">View
              <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="stat-icon">
            <i class="fa fa-exchange fa-2x"></i>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- <div id="TA_REF" class="col-lg-3 col-md-6" style="visibility: hidden;">
      <div class="panel-stat3 bg-success">
        <h2 class="m-top-none">TA Refund</h2>
        <div>
          <a  id="btnTARefund" class="btn btn-warning" href="<?php echo $site_url; ?>/app/dealer/trade_refund">View
            <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="stat-icon">
          <i class="fa fa-inr fa-3x"></i>
        </div>
      </div>
    </div> -->
    <div id="TA_RET" class="col-lg-3 col-md-6" >
      <div class="panel-stat3 bg-successG">
        <h2 class="m-top-none">TA Return - <span id="to-pay">Pay Online</span></h2>
        <div>
          <a  id="btnTARefund" class="btn btn-warning" href="<?php echo $site_url; ?>/app/dealer/trade-return">View
            <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="stat-icon">
          <i class="fa fa-inr fa-3x"></i>
        </div>
      </div>
    </div>


  </div>
</div>