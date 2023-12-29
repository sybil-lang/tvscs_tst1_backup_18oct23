<rn:meta title="Business Information" template="employee_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 800px;
}
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');

checkCustomerType('internal employee');

$back_url = $_SERVER['HTTP_REFERER'];

$userProfile = $CI->session->getSessionData('userProfile');
$dealer_code = $userProfile['dealer_codes'];
?>
	<!-- Zozo Tabs css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.min.css" rel="stylesheet" />
	        <link href="/euf/assets/themes/standard/css/font-awesome-home.css" rel="stylesheet" />                

     <!-- Zozo Tabs Flat Themes css -->
    <link href="/euf/assets/themes/standard/css/zozo.tabs.flat.min.css" rel="stylesheet" />
    
    <!-- Zozo Tabs js -->
    <script src="/euf/assets/themes/standard/js/zozo.tabs.min.js"></script>

<!-- Datatable CSS and JAVAScript -->
<!--	<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css" rel="stylesheet" />
-->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">


<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>



<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>


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

<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Transaction wise details</h1>
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

<section class="dealercontainer">
          <div class="row-fluid">
				<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
					<div class="rn_ContentDetail full_width">
					<div id="page">
						<!-- Zozo Tabs Start-->
						<div id="tabbed-nav2" >

							<!-- Tab Navigation Menu -->
							<ul>
								<li><a><span class="z-icon"><i class="icon-desktop baseline">&nbsp;</i></span>Details for Dealer disbursal</a></li>
								<li><a><span class="z-icon"><i class="icon-laptop baseline">&nbsp;</i></span>Details for Disbursal pending</a></li>
								<li><a><span class="z-icon"><i class="icon-tablet baseline">&nbsp;</i></span>Details for PDD pending</a></li>
							</ul>
							<!-- Content container -->
							<div>
								<div data-content-url='<?php echo $site_url;?>/app/employee/detail_disbursal''></div>
								<div data-content-url='<?php echo $site_url;?>/app/employee/detail_disbursal_pending'></div>
								<div data-content-url='<?php echo $site_url;?>/app/employee/detail_pdd_pending''></div>
							</div>

						</div>
						<!-- Zozo Tabs End-->
						</div>
					</div>
					
				</div>
			</div>
		</section>
<script>
        jQuery(document).ready(function ($) {
            /* jQuery activation and setting options for first tabs, enabling multiline*/
           /* jQuery activation and setting options for second tabs*/
            $("#tabbed-nav2").zozoTabs({
                position: "top-left",
                orientation: "horizontal",
                multiline: true,
                style: "contained",
                theme: "flat-peter-river",
                spaced: true,
                rounded: true,
                animation: {
                    easing: "easeInOutExpo",
                    duration: 450,
                    effects: "slideH"
                }
            });

         //   $('#example').DataTable();
        });
    </script>