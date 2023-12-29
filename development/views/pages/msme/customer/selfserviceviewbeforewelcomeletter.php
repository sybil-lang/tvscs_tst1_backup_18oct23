
<!-- LIVE SITE -->
<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standardMSME.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 700px;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');
$nflag = 0;
$nflag = \RightNow\Utils\Url::getParameter('notification');
checkCustomerType('customer');
$contact_id=$CI->session->getProfileData("c_id");

// $report_id=100705;
// //       $msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
// // $report_id=$msg->Value;
//       if($report_id>0){
//         $filter=array('Contact ID'=>$contact_id);
//         // print_r($filter);
//         $report_result=report_result($report_id,$filter);
//         // print_r($report_result);
//         if(count($report_result) > 0)
//         {
//             // echo       '<pre>';
//             // print_r($report_result);
            

//             for($i=0;$i<count($report_result);$i++)
//             {
//                 if($report_result[$i]['loan_sub_type']=="TL")
//                 {
//                    $countTL++;
//                 }
                
//             }
//             // echo $countTL.$countOD.$countBD;

                    


//         }
//     }

//$contact_id = 3;
//print_r($this->session->getProfile() );
//  $msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
//  $report_id=$msg->Value;
    //$report_id = '100010';
?>
    <!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<!-- Datatable CSS and JAVAScript -->
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
<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery.nice-select.js"></script>

<link rel="stylesheet" href="/euf/assets/themes/standard/css/nice-select.css">

<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Self-Service : Client</h1>
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
                <li><a>Initial Loan Amount<span>&nbsp;</span></a></li>
                <li><a>Documents Download<span>&nbsp;</span></a></li>
                <!-- <li><a>Foreclosure Letter<span>&nbsp;</span></a></li> -->
                <li><a>Last Payment Details<span>&nbsp;</span></a></li>
                <li id="repay_div" ><a>Repayment<span>&nbsp;</span></a></li>
                <li><a>Loan Status<span>&nbsp;</span></a></li>
                
               
                <li><a>ECS Mandate<span>&nbsp;</span></a></li>
                 <li><a>Raise a Query<span>&nbsp;</span></a></li>
                <li><a href="<?php echo $site_url;?>/app/msme/customer/address_change">Address Change Request<span>&nbsp;</span></a></li>
            </ul>

            <!-- Content container -->
            <div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/loan_amount'></div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/instrument_details'></div>
                <!-- <div data-content-url='<?php echo $site_url;?>/app/msme/customer/foreclosure_letter'></div>                 -->
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/payment'></div>
               <div data-content-url='<?php echo $site_url;?>/app/msme/customer/repayment'></div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/status_loan'></div>
                <div data-content-url='<?php echo $site_url;?>/app/msme/customer/ecs_mandate'></div>
                    <div data-content-url='<?php echo $site_url;?>/app/msme/customer/incidentlist'></div>
            </div>

        </div>
        <!-- Zozo Tabs End-->

        </div>
    </div>
    
</div>
<style type="text/css">
    #tabbed-nav2{
        width:auto;
    }
    .rn_AccountOverview .rn_ContentDetail {
        width:100%;
    }
    .z-tabs.z-multiline > ul > li > a{
        text-transform: none !important;
        font-size: 15px !important;
    }
</style>
<?php if($nflag){
                $strtab = 'defaultTab: "tab5",';
}else{
    $strtab = '';
}
?>
<script>


        jQuery(document).ready(function ($) {

            
            // var countTL=parseInt(localStorage.getItem("countTL"));
            // if(countTL)
            // {
            //             $('#repay_div').removeClass('hidden');

            // }
            /* jQuery activation and setting options for first tabs, enabling multiline*/
           /* jQuery activation and setting options for second tabs*/
            $("#tabbed-nav2").zozoTabs({
                <?php echo $strtab;?>
                position: "top-left",
                orientation: "vertical",
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
    <style type="text/css">
        .z-tabs.flat.vertical.contained > .z-container > .z-content > .z-content-inner{
            height: 100%;
        }
    </style>