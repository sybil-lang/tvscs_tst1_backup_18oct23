<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="employee_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 700px;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');

// echo $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

checkCustomerType('internal employee');
$contact_id=$CI->session->getProfileData("c_id");

$userProfile = $CI->session->getSessionData('userProfile');

$back_url = $_SERVER['HTTP_REFERER'];

?>
	<!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
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
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<?php
if(!empty($userProfile['agg_no'])){
?>
<div class="rn_Hero">
    <div class="rn_Container">
			<div class="col-sm-9">
				<h1>Self-Service : Client</h1>
			</div>
	<?php if(!empty($back_url)){?>
			<div class="col-sm-1 navbar-right"><br />
				<a id="back" href="<?php echo $back_url;?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="font-size:13px">Back</a>
			</div>
	  <?php } ?>
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
                <li><a>Initial loan amount<span>&nbsp;</span></a></li>
                <li><a>Instrument details<span>&nbsp;</span></a></li>
                <li><a>Status of loan<span>&nbsp;</span></a></li>
				<li><a>Courier Details<span>&nbsp;</span></a></li>
                <li><a>ECS Mandate/NDC<span>&nbsp;</span></a></li>
<!--				<li><a>Notifications<span>&nbsp;</span></a></li>
                <li><a>Raise a query<span>&nbsp;</span></a></li>
				<li><a href="<?php echo $site_url;?>/app/employee/address_change">Address Change Request<span>&nbsp;</span></a></li>
         -->   </ul>

            <!-- Content container -->
            <div>
                <div data-content-url='<?php echo $site_url;?>/app/employee/loan_amount'></div>
                <div data-content-url='<?php echo $site_url;?>/app/employee/instrument_details'></div>
                <div data-content-url='<?php echo $site_url;?>/app/employee/status_loan'></div>
				<div data-content-url='<?php echo $site_url;?>/app/employee/newjencourierdetails'></div>
                <div data-content-url='<?php echo $site_url;?>/app/employee/ecsmandate'></div>
			<!--	<div data-content-url='<?php echo $site_url;?>/app/employee/get_notifications'></div>
				 <div data-content-url='<?php echo $site_url;?>/app/employee/incidentlist'></div>-->
            </div>

        </div>
        <!-- Zozo Tabs End-->
		</div>
    </div>
    
</div>
<script>
        jQuery(document).ready(function ($) {
var tab='<?php echo $strtab;?>'
var queryString = window.location.href;
                                var agg=queryString.split("_");

                            if(agg[1])
                            {
                              tab=  "tab2"
                            }

           
            /* jQuery activation and setting options for first tabs, enabling multiline*/
           /* jQuery activation and setting options for second tabs*/
            $("#tabbed-nav2").zozoTabs({
                defaultTab:tab,
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
               $(".modal-backdrop").removeClass(".modal-backdrop");

        });
    </script>
<?php }else{?>


<script type="text/javascript">
 


                            // if(agg[1])
                            // {
                            //   console.log();
                            // }
$("#customerModal").modal('show');


    


</script>
<?php } ?>