<!-- LIVE SITE -->
<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="standard.php" login_required="true" force_https="true" />
<style type="text/css">
    .rn_Body {
        min-height: 700px;
    }
</style>
<?php
$CI = &get_instance();
$CI->load->helper('report');
$nflag = 0;
$nflag = \RightNow\Utils\Url::getParameter('notification');
checkCustomerType('customer');
$contact_id = $CI->session->getProfileData("c_id");
//$contact_id = 3;
//print_r($this->session->getProfile() );
//	$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Prospect_No);
//	$report_id=$msg->Value;
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


<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"> </script>
<script type="text/javascript"
    src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript"
    src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"> </script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"> </script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"> </script>

<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"> </script>

<script type="text/javascript" src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"> </script>

<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"> </script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery.nice-select.js"></script>

<link rel="stylesheet" href="/euf/assets/themes/standard/css/nice-select.css">
<style type="text/css">
    #tabbed-nav2 {
        width: auto;
    }

    #tabbed-nav3 {
        width: auto;
    }

    .rn_AccountOverview .rn_ContentDetail {
        width: 100%;
    }
</style>
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
            <div id="tabbed-nav2" style="display:none;">

                <!-- Tab Navigation Menu -->
                <ul>
                    <li><a>Initial loan amount<span>&nbsp;</span></a></li>
                    <li><a>Instrument details<span>&nbsp;</span></a></li>
                    <li><a>Status of loan<span>&nbsp;</span></a></li>
                    <li><a>Courier Details<span>&nbsp;</span></a></li>
                    <li><a>Notifications<span>&nbsp;</span></a></li>
                    <li><a>Raise a query<span>&nbsp;</span></a></li>
                    <li><a>E-Document Download<span>&nbsp;</span></a></li>
                    <li><a>ECS Mandate / NDC<span>&nbsp;</span></a></li>
                    <li><a>RC PULL<span>&nbsp;</span></a></li>
                    <li><a>Mandate Cancellation<span>&nbsp;</span></a></li>
                    <li><a href="<?php echo $site_url; ?>/app/customer/address_change">Address Change
                            Request<span>&nbsp;</span></a></li>
                </ul>

                <!-- Content container -->
                <div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/loan_amount'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/instrument_details'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/status_loan'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/newjencourierdetails'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/get_notifications'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/incidentlist'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/e_document'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/mandate'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/rcpull'></div>
                    <div data-content-url='<?php echo $site_url; ?>/app/customer/mandate_cancellation'></div>
                </div>

            </div>


            <!-- IARC -->
            <div id="tabbed-nav3" style="display:none;">
                <ul>

                    <li><a>Instrument details<span>&nbsp;</span></a></li>

                </ul>
                <div>

                    <div data-content-url='<?php echo $site_url; ?>/app/customer/instrument_details'></div>

                </div>
            </div>
            <!-- IARC -->
            <!-- Zozo Tabs End-->
        </div>
    </div>

</div>
<?php
if ($nflag) {
    $strtab = "tab5";
} else {

    $strtab = 'tab1';
}
?>


<script>

    jQuery(document).ready(function ($) {
        var SingleAg_IARC = localStorage.getItem("key");
        var OnlySoaDisplay = document.getElementById('tabbed-nav3');
        if (SingleAg_IARC == "1") {
            OnlySoaDisplay.style.display = 'block'; // Show the div  
            document.getElementById('tabbed-nav2').style.display= 'none';
            console.log("Single Ag_IARC");
        } else {
            OnlySoaDisplay.style.display = 'none'; // Hide the div
            document.getElementById('tabbed-nav2').style.display = 'block';
            console.log("Normal scenario");
        }

        var tab = '<?php echo $strtab; ?>'
        // var tabcharu = '<?php echo $mflag; ?>'
        // var tabcharu2 = '<?php echo $nflag; ?>'
        // console.log("tabcharu",tabcharu);
        // console.log("tabcharu2",tabcharu2);
        var queryString = window.location.href;
        var agg = queryString.split("_");

        if (agg[1]) {
            tab = "tab2"
        }
        let x = localStorage.getItem('insu_noti_1');
        if (x == "1") {
            tab = 'tab2';
        }
        localStorage.setItem("insu_noti_1", "0");
        let y = localStorage.getItem('insu_noti_2');
        if (y == "1") {
            tab = 'tab2';
        }
        localStorage.setItem("insu_noti_2", "0");
        //                     let y = localStorage.getItem('view_noti_1');
        //                     if (y == "1") {
        //                         tab = 'tab5';
        //                     } else {
        //                         tab = 'tab1';

        //                     }
        // localStorage.setItem("view_noti_1", "0");
        // let z = localStorage.getItem('view_noti_2');
        // if (z == "1") {
        //     tab = 'tab5';
        // } else {
        //     tab = 'tab1';

        // }
        // localStorage.setItem("view_noti_2", "0");
        var rcpull = localStorage.getItem("rcpull");
        if (rcpull == "1") {
            tab = "tab9"
        }
        localStorage.setItem("rcpull", "0");

        /* jQuery activation and setting options for first tabs, enabling multiline*/
        /* jQuery activation and setting options for second tabs*/
        $("#tabbed-nav2").zozoTabs({
            defaultTab: tab,
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


        $("#tabbed-nav3").zozoTabs({
           
            position: "top",
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