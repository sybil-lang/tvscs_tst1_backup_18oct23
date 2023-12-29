<rn:meta title="Incentives & Claims" template="dealer_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 1000px;
}
     .z-container{
        width: 1230px;
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
	<!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<!-- Datatable CSS and JAVAScript -->
<!--	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>


<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">


<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>



<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>


<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />


<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"> </script>
<script type="text/javascript" src = "https://cdn.datatables.net/buttons/1.2.3/js/dataTables.buttons.min.js"> </script>

<script type="text/javascript" src = "//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"> </script>

<script type="text/javascript" src = "//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"> </script>

<script type="text/javascript" src = "//cdn.datatables.net/buttons/1.2.3/js/buttons.html5.min.js"> </script>

<script src="//cdn.datatables.net/plug-ins/1.10.13/api/fnReloadAjax.js"></script>
<!--<script src="/euf/assets/themes/standard/js/jquery.nice-select.js"></script>

<link rel="stylesheet" href="/euf/assets/themes/standard/css/nice-select.css">-->


        <h1 style="position: initial !important;left: 41px !important;">Incentives & Claims</h1>
  
<p>&nbsp;</p>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
    <div class="rn_ContentDetail full_width">
	<div id="page">
        <!-- Zozo Tabs Start-->
        <div id="tabbed-nav2" >

            <!-- Tab Navigation Menu -->
            <ul>
                <li><a>Dealer Sales Incentive</a></li>
                <li><a>Dealer collection incentives</a></li>
                <li><a>Dealer overdue summary</a></li>
            </ul>

            <!-- Content container -->
            <div>
                <div data-content-url='<?php echo $site_url;?>/app/dealer/dealer_sales_incentive_details'></div>
                <div data-content-url='<?php echo $site_url;?>/app/dealer/dealer_collection_incentive_details'></div>
                <div data-content-url='<?php echo $site_url;?>/app/dealer/dealer_overdue_summary_details'></div>
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

         //   $('#example').DataTable();
        });
    </script>
    <style type="text/css">
        #tabbed-nav2 {
            width: 1367px;
        }
        .z-tabs.flat.contained.z-spaced.z-bordered.horizontal.top > .z-container{
            width: 100%;
        }
    </style>