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
//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$contact_id=$CI->session->getProfileData("c_id");

$employee_code=$CI->session->getProfileData("login");
$fname=$CI->session->getProfileData("first_name");

$lname=$CI->session->getProfileData("last_name");

$name = ucfirst($fname)." ".ucfirst($lname);

$msg=\RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Incident_UserStatus);
$report_id= $msg->Value;
$filter = array("Date Created" => date('d/m/Y'));
//$report_result=report_result($report_id,$filter);
//print_r($report_result);


$msg_a = \RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Contact_Hierarchy);
$report_id= $msg_a->Value;

//100107Array ( [0] => Array ( [Dealer] => 6937 [Full Name] => SUNIL TRACTORS ) ) 
$contact_id=$CI->session->getProfileData("c_id");

$filter = array("Employee_Id" => $contact_id);
$report_results=report_result($report_id,$filter);

$userProfile = $CI->session->getSessionData('userProfile');

if(isset($_POST['dealer_codes']) && !empty($_POST['dealer_codes'])){
	$userProfile['dealer_codes'] = $_POST['dealer_codes'];
	$CI->session->setSessionData(array('userProfile'=>$userProfile));
}

$dealer_code = $userProfile['dealer_codes'];
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
	        <link href="/euf/assets/themes/standard/css/font-awesome-home.css" rel="stylesheet" />                
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


<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/main.css">


<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>



<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>


<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"  rel="stylesheet" >
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>


<script src="/euf/assets/themes/standard/js/jquery.nice-select.js"></script>

<link rel="stylesheet" href="/euf/assets/themes/standard/css/nice-select.css">
<style type="text/css">
.small-box .icon{
top:-13px;
}
</style>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>


<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Dealer Information</h1>
    </div>
</div>
<p>&nbsp;</p>
<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 hidden" id="loader">
   <center>
	  <img src="/euf/assets/themes/standard/img/ajax-loader.gif">
	</center>
</div>
<section class="container">
          <div class="row-fluid">
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
						<div id="demo-tabs-vertical" class="tabbed-nav-flat hover clean medium flat-peter-river flat z-icons-light z-rounded z-bordered z-spaced z-tabs vertical top-left top">
						<ul class="z-tabs-nav z-tabs-mobile z-state-closed" style="display: none;"><li><a class="z-link" style="text-align: left;"><span class="z-title"><span class="z-icon"><i class="icon-tablet baseline">&nbsp;</i></span>Tabbed Content</span><span class="z-arrow"></span></a></li></ul><i class="z-dropdown-arrow"></i><ul class="z-tabs-nav z-tabs-desktop z-hide-menu">
                                        <li class="z-tab z-first" data-link="tab1">
                                            <a class="z-link"><span class="z-icon"><i class="icon-desktop baseline">&nbsp;</i></span>Responsive Tabs</a>
                                        </li>
                                        <li class="z-tab" data-link="tab2">
                                            <a class="z-link"><span class="z-icon"><i class="icon-laptop baseline">&nbsp;</i></span>Tabbed Navigation</a>
                                        </li>
                                        <li class="z-tab z-active" data-link="tab3">
                                            <a class="z-link"><span class="z-icon"><i class="icon-tablet baseline">&nbsp;</i></span>Tabbed Content</a>
                                        </li>
                                        <li class="z-tab" data-link="tab4">
                                            <a class="z-link"><span class="z-icon"><i class="icon-star-empty baseline">&nbsp;</i></span>jQuery Tabs</a>
                                        </li>
                                        <li class="z-tab" data-link="tab5">
                                            <a class="z-link"><span class="z-icon"><i class="icon-reorder baseline">&nbsp;</i></span>jQuery Vertical Tabs</a>
                                        </li>
                                        <li class="z-tab z-last" data-link="tab6">
                                            <a class="z-link"><span class="z-icon"><i class="icon-resize-full baseline">&nbsp;</i></span>jQuery Tabs Plugin</a>
                                        </li>
                                    </ul>
                                    
                                    
                                <div class="z-container" style="min-height: 305px;">
                                        <div class="imgtest z-content" style="display: none; position: absolute; left: -504px; top: 0px;"><div class="z-content-inner">
                                            <img alt="mobile phone" src="" style="min-width: 100%; height: auto;" class="hidden">

                                            <h4>Responsive Tabs</h4>
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally.</p>
                                            <blockquote>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account.</blockquote>
                                        </div></div>

                                        <div class="z-content"><div class="z-content-inner">
                                            <h4>Tabbed Navigation</h4>
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally.</p>
                                            <blockquote>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account</blockquote>

                                        </div></div>
                                        <div class="z-content z-active" style="display: block; position: relative; left: 0px;"><div class="z-content-inner">
                                            <h4>Tabbed Content</h4>
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally.</p>
                                            <blockquote>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account</blockquote>
                                        </div></div>
                                        <div class="z-content"><div class="z-content-inner">
                                            <h4>jQuery Tabs</h4>
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally.</p>
                                            <blockquote>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account</blockquote>
                                        </div></div>
                                        <div class="z-content"><div class="z-content-inner">
                                            <h4>jQuery Vertical Tabs</h4>
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally.</p>
                                            <blockquote>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account.</blockquote>
                                        </div></div>
                                        <div class="z-content"><div class="z-content-inner">
                                            <h4>jQuery Tabs Plugin</h4>
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally.</p>
                                            <blockquote>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account</blockquote>
                                        </div></div>
                                    </div></div>
					</div>
		</div>
</section>
<script>
        jQuery(document).ready(function ($) {
            /* jQuery activation and setting options for first tabs, enabling multiline*/
           /* jQuery activation and setting options for second tabs
		    data-options="{&quot;orientation&quot;: &quot;vertical&quot;, &quot;style&quot;: &quot;clean&quot;, &quot;size&quot;:&quot;medium&quot;, &quot;position&quot;: &quot;top-left&quot;, &quot;rounded&quot;:true,&quot;spaced&quot;:true, &quot;theme&quot;:&quot;flat-peter-river&quot;}"
			*/
            $("#demo-tabs-vertical").zozoTabs({
                position: "top-left",
                orientation: "vertical",
                multiline: true,
                style: "clean",
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