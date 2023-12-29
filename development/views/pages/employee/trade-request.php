<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');

$back_url = $_SERVER['HTTP_REFERER'];

?>
<rn:meta title="Trade Request" template="employee_header.php" login_required="true" force_https="true" />
<!-- Zozo Tabs css -->
<link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />

 <!-- Zozo Tabs Flat Themes css -->
<link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />

<!-- Zozo Tabs js -->
<script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />


<script type="text/javascript" src = "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"> </script>


<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Trade Request</h1>
    </div>
</div>

<?php if(!empty($back_url)){?>
			<div class="col-sm-2 navbar-right-e"><br />
				<a id="back" href="<?php echo $back_url;?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="font-size:13px">Back</a>
			</div>
	  <?php } ?>
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
              <!--  <li><a>Create new TA Request</span></a></li>-->
                <li><a>Summary of TA Requests</span></a></li>
            </ul>

            <!-- Content container -->
            <div>
           <!--     <div data-content-url='<?php echo $site_url;?>/app/employee/new_request''></div>-->
                <div data-content-url='<?php echo $site_url;?>/app/employee/view_request'></div>
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