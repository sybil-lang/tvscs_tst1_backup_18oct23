<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standardMSME.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 800px;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');
$contact_id=$CI->session->getProfileData("c_id");   
checkCustomerType('customer');

//echo ($this->uri->segment('1'));
//echo $agg_no = \RightNow\Utils\Url::getParameter('ag_id');
$pros_no = \RightNow\Utils\Url::getParameter('p_id');
list($pros_no,$agg_no) = explode("_",$pros_no);
if(!empty($agg_no)){
	$agreement_id = $agg_no;
	
}elseif(empty($agg_no) && !empty($pros_no)){
	$agreement_id = $pros_no;
	$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_NO_MSME);
	$report_id=$msg->Value;
	$filter = array('ContactID' => $contact_id);
	$response = report_result($report_id,$filter);
	//print_r($response);
	if(!in_array_r($agreement_id,$response)){
			header("location:/app/msme/customer/error/error_id/2");
			exit;
	}
}

?>
	<!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<!-- Datatable CSS and JAVAScript -->
<!--	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
-->
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />


<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"> </script>

<script type="text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"> </script>

<script type="text/javascript" src = "//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"> </script>

<script type="text/javascript" src = "//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"> </script>
<style type="text/css">
    #tabbed-nav2{
        width:auto;
    }
    .rn_AccountOverview .rn_ContentDetail {
        width:100%;
    }
    .dataTables_wrapper .dataTables_paginate{
        float: none;
    }
    div.dataTables_wrapper div.dataTables_paginate{
        text-align: center !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button{
        padding:0px !important;
    }
</style>

<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Dashboard</h1>
    </div>
</div>
<p>&nbsp;</p>
<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
    <div class="rn_ContentDetail full_width">
	<div id="page">
        <!-- Zozo Tabs Start-->
        <div id="tabbed-nav2" >

            <!-- Tab Navigation Menu -->
            <ul>
                <li><a>Login Status</a></li>
                <li><a>Payment Details</a></li>
                <li><a>Loan Schedule</a></li>
                <li><a>Charges</a></li>
            </ul>

            <!-- Content container -->
            <div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/login_status/ag_id/<?php echo $agreement_id;?>'></div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/payment_details/ag_id/<?php echo $agreement_id;?>'></div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/loan_schedule/ag_id/<?php echo $agreement_id;?>'></div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/charges/ag_id/<?php echo $agreement_id;?>'></div>
            </div>

        </div>
        <!-- Zozo Tabs End-->
		</div>
    </div>
    
</div>
<script>
        jQuery(document).ready(function ($) {
            /* jQuery activation and setting options for first tabs, enabling multiline*/
           /* jQuery activation and setting options for second tabs*/
            $("#tabbed-nav2").zozoTabs({
                position: "top-left",
                orientation: "horizontal",
                multiline: true,
                style: "contained",
                theme: "flat-peter-river flat",
                spaced: true,
                rounded: false,
                animation: {
                    easing: "easeInOutExpo",
                    duration: 450,
                    effects: "slideH"
                }
            });

            $('#example').DataTable();
        });
    </script>