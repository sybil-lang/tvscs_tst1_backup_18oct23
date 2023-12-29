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
    #TA_SUM div h2
    {
        color:white !important;
    }
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');

//echo ($this->uri->segment('1'));
//echo $agg_no = \RightNow\Utils\Url::getParameter('ag_id');
/*$pros_no = \RightNow\Utils\Url::getParameter('p_id');
list($pros_no,$agg_no) = explode("_",$pros_no);
if(!empty($agg_no)){
	$agreement_id = $agg_no;
}elseif(empty($agg_no) && !empty($pros_no)){
	$agreement_id = $pros_no;
}
*/
?>
        <h1 style="
        position: relative !important;
    left: 41px !important;
">Incentives & Claims</h1>
<p>&nbsp;</p>
<div class="col-sm-12 col-md-12 col-lg-12" id="contemt-main">
              
		 <div class="row">
                            <div style="padding-top: 5em;"></div>

                            <div id="TA_REQ" class="col-lg-3 col-md-6" style="visibility: hidden;">
                                <div class="panel-stat3 bg-danger">
                                    <h2 class="m-top-none">TA Request</h2>
                                    <div>
                                        <a  id="btnTARequest" class="btn  btn-warning" href="#">View
                                            <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fa fa-angle-double-right fa-3x"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="TA_SUM" class="col-lg-3 col-md-6">
                                <div class="panel-stat3 bg-info">
                                    <h2 class="m-top-none">I & C Summary</h2>
                                    <div>
                                        <a id="btnTASummary" class="btn btn-warning" href="<?php echo $site_url;?>/app/dealer/incentive_view">View
                                            <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fa fa-bar-chart-o fa-2x"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="TA_TRANS" class="col-lg-3 col-md-6">
                                <div class="panel-stat3 bg-warning">
                                    <h2 class="m-top-none">I & C Transaction</h2>
                                    <div>
                                        <a onclick="#" id="btnTATransaction" class="btn btn-warning" href="<?php echo $site_url;?>/app/dealer/transaction_view">View
                                            <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fa fa-exchange fa-2x"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="TA_REF" class="col-lg-3 col-md-6" style="visibility: hidden;">
                                <div class="panel-stat3 bg-success">
                                    <h2 class="m-top-none">TA Refund</h2>
                                    <div>
                                        <a onclick="return FunPubShowLoagingPanel();" id="btnTARefund" class="btn btn-warning" href="javascript:__doPostBack('btnTARefund','')">View
                                            <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="fa fa-inr fa-3x"></i>
                                    </div>
                                </div>
                            </div>

                            <div style="padding-bottom: 27em;"></div>

                        </div>
</div>