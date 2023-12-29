<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('dealer');
$contact_id=$CI->session->getProfileData("c_id");
if($contact_id){
$dealer_contact = RightNow\Connect\v1_3\Contact::fetch($contact_id);
$product = $dealer_contact->CustomFields->CO->DealerProduct->LookupName;
$dealer_code = $dealer_contact->CustomFields->c->dealer_code;
$contact_fname = $dealer_contact->Name->First;
$contact_lname= $dealer_contact->Name->Last;
}
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
<rn:meta title="Working Capital Request" template="dealer_header.php" login_required="true" force_https="true" />
<!-- Zozo Tabs css -->
<link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

 <!-- Zozo Tabs Flat Themes css -->
<link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />

<!-- Zozo Tabs js -->
<script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>

<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />


<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"> </script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>
<style type="text/css">
    .input-group-addon{
        justify-content: center;
        font-size: 18px !important;
    }
    .input-group, .col-md-4{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    }
    tr, td, th{
        vertical-align: initial;
    }
    .form-control{
        width: 360px !important;
        font-size: 18px !important;
    }
</style>
<div class="rn_Hero">
    <div class="rn_Container">
        <h2 style="color:white !important;">Working Capital Request</h2>
    </div>
</div>
<p>&nbsp;</p>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<div class="rn_PageContent rn_AccountOverview rn_Container_dash ">
   <div class="rn_ContentDetail full_width">
    <!-- <div id="wcpage">
        <iframe src="https://tvscscrmuatservice.tvscs.co.in/WC%20Insurence.aspx?dealercode=<? echo $dealer_code; ?>" width="100%" height="560"></iframe>
    </div> -->
     <div id="page">
        <!-- Zozo Tabs Start-->
        <div id="tabbed-nav2" >

            <!-- Tab Navigation Menu -->
            <ul>
                <li><a>Create new Working Capital Request</span></a></li>
                <li><a>Summary of Working Capital Requests</span></a></li>
            </ul>

            <!-- Content container -->
            <div>
                <div data-content-url='<?php echo $site_url;?>/app/dealer/working_capital_new_request'></div>
                <div data-content-url='<?php echo $site_url;?>/app/dealer/working_capital_view_request'></div>
            </div>

        </div>
        <!-- Zozo Tabs End-->
		</div>
    </div>
    <!-- WC INSURANCE POP UP CODE START -->
                    
                
        <!-- <script type="text/javascript">
            var open_count = 0;
            function GetWCInsuranceResult(){ 
                    $.ajax({
                                url: "/cc/DealerCustom/GetWCInsuranceResult",
                                type: "post",
                                data:{dealercode:"<? echo $dealer_code; ?>"},
                                success: function(response) {
                                    console.log(response[0].Result);  
                                    if(response[0].Result == "Error"){
                                        $("#page").addClass("hidden");
                                        $("#wcpage").removeClass("hidden");
                                        open_count=open_count+1;
                                    }
                                    else{
                                        $("#page").removeClass("hidden");
                                        $("#wcpage").addClass("hidden");
                                    }
                                },
                                error:function(response){
                                    console.error(response);
                                }
                       }); //ajax closing   
            }
            $(document).ready(function(){
                GetWCInsuranceResult();    
            }); //document.ready
            $('#WCIModal').on('hidden.bs.modal', function () {
                    if(open_count==0){
                        GetWCInsuranceResult();
                    }
                    
            });           
        </script> -->
        <!-- WC INSURANCE POP UP CODE END -->
</div>
<script>
        jQuery(document).ready(function ($) {
            /* jQuery activation and setting options for first tabs, enabling multiline*/
           /* jQuery activation and setting options for second tabs*/
            $("#tabbed-nav2").zozoTabs({
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

         //   $('#example').DataTable();
        });
    </script>