<rn:meta title="#rn:msg:ACCOUNT_OVERVIEW_LBL#" template="employee_header.php" login_required="true" force_https="true" />
<style type="text/css">
.rn_Body{
min-height: 800px;
}
    .rn_Hero .rn_Container h1 
    {
        color:#114984 !important;
    }
    .modal-dialog
    {
            z-index: 1100;
    }
</style>
<?php
$CI=&get_instance();
$CI->load->helper('report');
$contact_id=$CI->session->getProfileData("c_id");
checkCustomerType('internal employee');
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

<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">

<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
           <center>
              <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
            </center>
        </div>
<style type="text/css">
.rn_Hero{
	background-color:#ffffff;
	color: #000000;
}
</style>
<div class="rn_Hero">
    <div class="rn_Container">
			<div class="col-sm-9">
				<h1>Dashboard</h1>
			</div>
	<?php if(!empty($back_url)){?>
			<div class="col-sm-1 navbar-right"><br />
				<a id="back" href="<?php echo $back_url;?>" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="font-size:13px">Back</a>
			</div>
	  <?php } ?>
		</div>
</div>
<p>&nbsp;</p>
<?php
if(!empty($userProfile['agg_no'])){
?>
<section class="dealercontainer">
          <div class="row-fluid">
				<div class="rn_PageContent rn_AccountOverview rn_Container_dash">
					<div class="rn_ContentDetail full_width">
					<div id="page">
						<!-- Zozo Tabs Start-->
						<div id="tabbed-nav2" >

							<!-- Tab Navigation Menu -->
							<ul>
								<li <?php if(checkTAB('login_status')){ echo "class='z-active'";}?>><a>Login Status</a></li>
								<li <?php if(checkTAB('payment_details')){ echo "class='z-active'";}?>><a>Payment Details</a></li>
								<li <?php if(checkTAB('loan_schedule')){ echo "class='z-active'";}?>><a>Loan Schedule</a></li>
								<li <?php if(checkTAB('charges')){ echo "class='z-active'";}?>><a>Charges</a></li>
							</ul>

							<!-- Content container -->
							<div>
								<div data-content-url='<?php echo $site_url;?>/app/employee/login_status'></div>
								<div data-content-url='<?php echo $site_url;?>/app/employee/payment_details'></div>
								<div data-content-url='<?php echo $site_url;?>/app/employee/loan_schedule'></div>
								<div data-content-url='<?php echo $site_url;?>/app/employee/charges'></div>
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
                orientation: "vertical",
                multiline: true,
                style: "contained",
                theme: "flat-peter-river",
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
<?php }else{?>


<script type="text/javascript">
$("#customerModal").modal('show');


</script>
<?php } ?>