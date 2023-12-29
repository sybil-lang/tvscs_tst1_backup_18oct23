<rn:meta title="Working Capital" template="dealer_header.php" login_required="true" force_https="true" />
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
    background-color: #038418 !important;
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
$newTaRequestVisible = true;
$taSummaryVisible = true;
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
<div class="rn_Hero">
  <div class="rn_Container">
    <h1>Working Captial</h1>
  </div>
</div>
<p>&nbsp;</p>
<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
  <div id="wcpage"class="row hidden" style="margin:0px;padding:0px;overflow:hidden;height: 121vh;">
    <!-- <iframe id= "upload-iframe" src="https://tvscscrmuatservice.tvscs.co.in/WC%20Insurence.aspx?dealercode=<? echo $dealer_code; ?>" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" frameborder="0" ></iframe> -->
  </div>
  <div id="nonwcpage" class="row" style="display: flex;flex-direction: row;justify-content: center;flex-wrap: wrap;align-items: center;align-content: center;">
    <!-- <div class="col-lg-3 col-md-4" style="visibility: show;"></div> -->

    <?php if ($newTaRequestVisible) { ?>
      <div id="TA_REQ" class="col-sm-6 col-md-6 col-lg-3" style="visibility: show;">
        <div class="panel-stat3 bg-danger">
          <h2 class="m-top-none" style="color:#fff !important;">WC Request</h2>
          <div>
            <a  id="btnTARequest" class="btn  btn-warning" href="<?php echo $site_url; ?>/app/dealer/working-capital-request">Create
              <i class="fa fa-arrow-right"></i></a>
          </div>
          <div class="stat-icon">
            <i class="fa fa-angle-double-right fa-3x"></i>
          </div>
        </div>
      </div>
    <?php } ?>
    <div id="TA_TRANS" class="col-sm-6 col-md-6 col-lg-3">
      <div class="panel-stat3 bg-warning">
        <h2 class="m-top-none" style="color:#fff !important;">WC Transaction</h2>
        <div>
          <a onclick="#" id="btnTATransaction" class="btn btn-warning" href="<?php echo $site_url; ?>/app/dealer/wc_transaction">View
            <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="stat-icon">
          <i class="fa fa-exchange fa-2x"></i>
        </div>
      </div>
    </div>
     <div id="TA_RET" class="col-sm-6 col-md-6 col-lg-3" >
      <div class="panel-stat3 bg-success">
        <h2 class="m-top-none">WC Return - <span id="to-pay">Pay Online</span></h2>
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

  <!-- WC INSURANCE POP UP CODE START -->

        <script type="text/javascript">
            // var open_count = 0;
            // function GetWCInsuranceResult(){ 
            //         $.ajax({
            //                     url: "/cc/DealerCustom/GetWCInsuranceResult",
            //                     type: "post",
            //                     data:{dealercode:"<? echo $dealer_code; ?>"},
            //                     success: function(response) {
            //                         console.log(response[0].Result);  
            //                         if(response[0].Result == "Error"){
                                        
            //                             $("#wcpage").removeClass("hidden");
            //                             $("#nonwcpage").addClass("hidden");
            //                             // open_count=open_count+1;
            //                             console.log(response[0].Result);
            //                         }                                                  //Commented for a while on 20 - 05 - 2020 by Dinesh's request.
            //                         else{
            //                             $("#nonpage").removeClass("hidden");
            //                             $("#wcpage").addClass("hidden");
            //                         }
            //                     },
            //                     error:function(response){
            //                         console.error(response);
            //                     }
            //            }); //ajax closing   
            // }
            // $(document).ready(function(){
            //     GetWCInsuranceResult();    
            // }); //document.ready

            // $('#WCIModal').on('hidden.bs.modal', function () {
            //         if(open_count==0){
            //             GetWCInsuranceResult();
            //         }
                    
            // });

            // $('#upload-iframe').load(function() {
            //   $(this).contents().find('#form1').submit(function() { 
            //       parent.location.reload(); // updated
            //       return true; //return false prevents submit
            //   });
            // });           
        </script>
</div>