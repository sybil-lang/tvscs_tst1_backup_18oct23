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


<!--<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-theme.min.css">  -->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">


<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>



<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>


<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"  rel="stylesheet" >
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>


<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Business Information</h1>
    </div>
</div>


<p>&nbsp;</p>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<section class="container-fluid">
<div class="row affix-row">
    <div class="col-sm-3 col-md-2 affix-sidebar">
		<div class="sidebar-nav">
  <div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <span class="visible-xs navbar-brand">Sidebar menu</span>
    </div>
    <div class="navbar-collapse collapse sidebar-navbar-collapse">
      <ul class="nav navbar-nav" id="sidenav01">
        <li class="active">
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#toggleDemo0" data-parent="#sidenav01" class="collapsed">
          <h4>
          Control Panel
          </h4>
          </a>
        </li>
        <li >
          <a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-cloud"></span> Dashboard <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo" style="height: 0px;">
            <ul class="nav nav-list">
              <li> <a href="javascript:void(0);" onclick="setDashboardGraph('sales_1');">Dealer Disbursal</a> </li>
			  <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_2');">Sales Performance</a></li>
			  <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_4');">PDD Pending</a></li>
			  <li><a href="javascript:void(0);" onclick="setDashboardGraph('sales_5');">Trade Advance</a></li>
            </ul>
          </div>
        </li>
		<li><a href="<?php echo $site_url;?>/app/employee/business-information"><span class="glyphicon glyphicon-lock"></span> Business Information</a></li>
        <li><a href="<?php echo $site_url;?>/app/employee/dealer_disbursal_detail"><span class="glyphicon glyphicon-calendar"></span> Sales Performance <!--<span class="badge pull-right">42</span>--></a></li>
        <li >
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-inbox"></span> Trade Advance <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo2" style="height: 0px;">
            <ul class="nav nav-list">
				<li><a href="<?php echo $site_url;?>/app/employee/trade-request">TA Request</a></li>
				<li><a href="<?php echo $site_url;?>/app/employee/trade_summary">TA Summary</a></li>
				<li><a href="<?php echo $site_url;?>/app/employee/trade_transaction">TA Transactions</a></li>
            </ul>
          </div>
        </li>

		<li >
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav01" class="collapsed">
          <span class="glyphicon glyphicon-inbox"></span> Incentives & Claims<span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo3" style="height: 0px;">
            <ul class="nav nav-list">
				<li><a href="<?php echo $site_url;?>/app/employee/incentive_view">I & C Summary</a></li>
                <li><a href="<?php echo $site_url;?>/app/employee/transaction_view">I & C Transactions</a></li>
            </ul>
          </div>
        </li>
         
      </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
	</div>
	<div class="column col-sm-10 col-xs-11 affix-content">
	  <div class="container-fluid">
          <div class="row-fluid">
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
						<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
							<div class="rn_ContentDetail full_width">
							<div id="page">
								<!-- Zozo Tabs Start-->
								<div id="tabbed-nav2" >

									<!-- Tab Navigation Menu -->
									<ul>
										<li><a>Summary of Dealer disbursal</a></li>
										<li><a>Summary of Disbursal pending</a></li>
										<li><a>Summary of PDD pending</a></li>
									</ul>

									<!-- Content container -->
									<div>
										<div data-content-url='<?php echo $site_url;?>/app/employee/dealer_disbursal''></div>
										<div data-content-url='<?php echo $site_url;?>/app/employee/disbursal_pending'></div>
										<div data-content-url='<?php echo $site_url;?>/app/employee/pdd_pending''></div>
									</div>

								</div>
								<!-- Zozo Tabs End-->
								</div>
							</div>
							
						</div>
					</div>
					</div></div> <!-- Main -->
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
                theme: "flat-peter-river flat",
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