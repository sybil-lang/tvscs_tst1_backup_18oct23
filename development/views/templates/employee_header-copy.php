<?php
$CI=&get_instance();
$CI->load->helper('report');
/* Get Employee Dealer Details */
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
$dealer_code = 7090;
?>
<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
	<meta charset="utf-8"/>
	<title>
		<rn:page_title/>
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
	<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail"/>
	<rn:theme path="/euf/assets/themes/standard" css="site.css"/>
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>

	<rn:head_content/>
	<link rel="icon" href="/euf/assets/images/favicon.png" type="image/png"/>
	<rn:widget path="utils/ClickjackPrevention"/>
	<rn:widget path="utils/AdvancedSecurityHeaders"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/euf/assets/themes/standard/css/custom-style.css"/>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"/>


	<script src="/euf/assets/themes/standard/javascripts/1.3.0/adminflare-demo-init.min.js" type="text/javascript"></script>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		// Include Bootstrap stylesheet 
		document.write('<link href="/euf/assets/themes/standard/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" id="bootstrap-css">');
		// Include AdminFlare stylesheet 
		document.write('<link href="/euf/assets/themes/standard/css/adminflare.css" media="all" rel="stylesheet" type="text/css" id="adminflare-css">');
		// Include AdminFlare page stylesheet 
		document.write('<link href="/euf/assets/themes/standard/css/pages.min.css" media="all" rel="stylesheet" type="text/css">');
	</script>
	
<!--	<script src="/euf/assets/themes/standard/javascripts/1.3.0/bootstrap.min.js" type="text/javascript"></script>-->
	<script src="/euf/assets/themes/standard/javascripts/1.3.0/adminflare.min.js" type="text/javascript"></script>

	<link href="/euf/assets/themes/standard/css/magicsuggest-min.css" rel="stylesheet">
	<script src="/euf/assets/themes/standard/js/magicsuggest-min.js"></script>
	<style type="text/css">
		#dealer_codes{
			width:25%;
			float:right;
		    margin: 13px;
		}

		.search-agreement{
				width: 500px;
				float: right;
				margin: 13px;
				z-index: 1009;
			    position: relative;
		}
	</style>
</head>

<body class="yui-skin-sam yui3-skin-sam" itemscope itemtype="http://schema.org/WebPage">
	<a href="#rn_MainContent" class="rn_SkipNav rn_ScreenReaderOnly">#rn:msg:SKIP_NAVIGATION_CMD#</a>
	<div class="container-fluid gray_bg">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-xs-12 text-xs-center text-md-left"><strong><i class="fa fa-phone-square"></i> 044-4587-5478 </strong> (Toll Free) </div>
				<div class="col-md-5 col-xs-12 text-center"><a style="color:white;" href="http://www.tvscredit.co.in/aboutus.aspx" target="_blank">ABOUT</a> | <a style="color:white;" href="http://www.tvscredit.co.in/rbi-compliance.aspx" target="_blank">INVESTOR</a> | <a style="color:white;" href="http://www.tvscredit.co.in/career.aspx" target="_blank">CAREER</a>
				</div>
				
				<div class="col-md-2">Follow Us <a href="https://www.facebook.com/TVSCREDIT" target="_blank"><i class="fa fa-facebook round facebook"></i></a> <a href="https://twitter.com/TVSCredit" target="_blank"><i class="fa fa-twitter round twitter"></i></a> <a href="https://www.linkedin.com/company-beta/1481214?pathWildcard=1481214" target="_blank"><i class="fa fa-linkedin round linkedin"></i></a>
				</div>
				<div class="col-md-2 col-xs-12 text-right">
					<div class="rn_LoginStatus">
						<rn:condition logged_in="true">

<rn:widget path="custom/login/employeeAccountDropdown" subpages="#rn:msg:ACCOUNT_OVERVIEW_LBL# > employee/account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > employee/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > employee/account/profile"/>
						</rn:condition>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="container martop20 marbtm10">
		<div class="row">

			<!--div class="wrapper"-->
			<div class="col-md-4 marbtm10 col-xs-12 text-xs-center text-md-left">
				<a href="<?php echo $site_url;?>/app/employee/dashboard"><img src="images/brand-logo.png"></a>
			</div>

			<!-- Start Chat -->
			<div class="col-md-3">
				<div class="rn_ChatLink">
					<rn:widget path="chat/ConditionalChatLink" min_sessions_avail="1" chat_login_page="/app/chat/chat_launch" label_default="Chat directly with a member of our support team." sub_id="conditionalChat"/>
				</div>
			</div>
			<!-- End Chat -->

			<!-- Start Search -->
			<div class="col-md-5 col-xs-12">
				<div class="rn_SearchControls">
					<h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
					<form method="get" action="/app/employee/results">
						<rn:container source_id="KFSearch">
							<div class="rn_SearchInput">
								<rn:widget path="searchsource/SourceSearchField" initial_focus="true"/>
							</div>
							<rn:widget path="searchsource/SourceSearchButton" search_results_url="/app/employee/results"/>
						</rn:container>
					</form>
				</div>
			</div>
			<!-- End OF Search -->
		</div>
	</div>
	</div>
	<rn:condition logged_in="true">
	<script type="text/javascript">demoSetBodyLayout();</script>
	<!-- Main navigation bar
		================================================== -->
	
	<!-- Left navigation panel
		================================================== -->
	<nav id="left-panel">
		<div id="left-panel-content">
			<ul>
				<!--<li class="active">
					<a href="dashboard.html"><span class="icon-dashboard"></span>Dashboard</a>
				</li>-->
				<li class="lp-dropdown active">
					<a href="#" class="lp-dropdown-toggle" id="Dashboard-dropdown"><span class="icon-reorder"></span>Dashboard</a>
					<ul class="lp-dropdown-menu" data-dropdown-owner="Dashboard-dropdown">
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/dealer_dashboard"><span class="icon-bar-chart"></span>Dealer</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/customer_dashboard"><span class="icon-bar-chart"></span>Customer</a>
						</li>
						
					</ul>
				</li>
				<li class="lp-dropdown">
					<a href="#" class="lp-dropdown-toggle" id="Agent-dropdown"><span class="icon-reorder"></span>Agent/AD</a>
					<ul class="lp-dropdown-menu" data-dropdown-owner="Agent-dropdown">
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/lead_generation"><span class="icon-bar-chart"></span>Lead generation</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/lead_status"><span class="icon-bar-chart"></span>Lead Status</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/login_status"><span class="icon-bar-chart"></span>Login Status</a>
						</li>
					</ul>
				</li>
				<li class="lp-dropdown">
					<a href="#" class="lp-dropdown-toggle" id="incident-dropdown"><span class="icon-reorder"></span>Helpdesk</a>
					<ul class="lp-dropdown-menu" data-dropdown-owner="incident-dropdown">
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/dealer_incidents_list"><span class="icon-coffee"></span>Dealer Helpdesk</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/customer_incident_list"><span class="icon-bar-chart"></span>Customer Helpdesk</a>
						</li>
						
					</ul>
				</li>
				<li>
					<a href="<?php echo $site_url;?>/app/employee/account/overview"><span class="icon-font"></span>General</a>
				</li>
				<li>
					<a href="<?php echo $site_url;?>/app/employee/tutorial"><span class="icon-edit"></span>Tutorial</a>
				</li>
				<li>
					<a href="<?php echo $site_url;?>/app/employee/documents"><span class="icon-table"></span>Documents</a>
				</li>
				
			<!--	<li>
					<a href="components.html"><span class="icon-inbox"></span>Components</a>
				</li>
				<li>
					<a href="javascript.html"><span class="icon-cog"></span>JavaScript</a>
				</li>
				<li class="lp-dropdown">
					<a href="#" class="lp-dropdown-toggle" id="extras-dropdown"><span class="icon-reorder"></span>Extras</a>
					<ul class="lp-dropdown-menu" data-dropdown-owner="extras-dropdown">
						<li>
							<a tabindex="-1" href="extras-icons.html"><span class="icon-coffee"></span>Icons</a>
						</li>
						<li>
							<a tabindex="-1" href="extras-charts.html"><span class="icon-bar-chart"></span>Charts</a>
						</li>
						<li>
							<a tabindex="-1" href="extras-widgets.html"><span class="icon-star"></span>Widgets</a>
						</li>
					</ul>
				</li>
				<li class="lp-dropdown">
					<a href="#" class="lp-dropdown-toggle" id="pages-dropdown"><span class="icon-file-alt"></span>Pages</a>
					<ul class="lp-dropdown-menu simple" data-dropdown-owner="pages-dropdown">
						<li>
							<a tabindex="-1" href="index-2.html"><i class="icon-signin"></i>&nbsp;&nbsp;Sign In</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-signup.html"><i class="icon-check"></i>&nbsp;&nbsp;Sign Up</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-messages.html"><i class="icon-envelope-alt"></i>&nbsp;&nbsp;Messages</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-stream.html"><i class="icon-leaf"></i>&nbsp;&nbsp;Stream</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-pricing.html"><i class="icon-money"></i>&nbsp;&nbsp;Pricing</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-invoice.html"><i class="icon-pencil"></i>&nbsp;&nbsp;Invoice</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-map.html"><i class="icon-map-marker"></i>&nbsp;&nbsp;Full page map</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-error-404.html"><i class="icon-unlink"></i>&nbsp;&nbsp;Error 404</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-error-500.html"><i class="icon-bug"></i>&nbsp;&nbsp;Error 500</a>
						</li>
						<li>
							<a tabindex="-1" href="pages-blank.html"><i class="icon-bookmark-empty"></i>&nbsp;&nbsp;Blank page</a>
						</li>
					</ul>
				</li>-->
			</ul>
		</div>
		<div class="icon-caret-down"></div>
		<div class="icon-caret-up"></div>
	</nav>
	<!-- / Left navigation panel -->
	<?php
	
	if(checkURL('dealer')){?>
		<header>
			<nav id="subhead">
				<div class="rn_NavigationBar">
					<input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly"/>
					<label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
					<ul class="rn_NavigationMenu">
						<!--<li>
							<i class="fa fa-home" aria-hidden="true"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/dealer#rn:config:CP_HOME_URL#" pages="home"/>
						</li>-->
						
						<li>
							<i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/employee/business-information">Business Information</a>
						</li>
						<!--<li>
							<i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/employee/trade-advance">Trade Advance</a>
						</li>-->
						<li>
							<i class="fa fa-money" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/employee/incentive">Incentives & Claims</a>
						</li>
						
						<li>
							<i class="fa fa-question-circle"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/employee/dealerquery" pages="dealerquery, dealer_ask_confirm"/>
						</li>
						<li>
						<!--<form id="seldealer" name="seldealer" method="post">-->
							  <select name="dealer_codes" id="dealer_codes" class="form-control" >
							  <option value="-1">Choose a Dealer</option>
									<?php
									foreach($report_results as $key => $resultData){
										if(isset($dealer_code) && ($dealer_code == $resultData['Dealer Code'])){
												echo '<option value="'.$resultData['Dealer Code'].'" selected>'.$resultData['Full Name'].'</option>';
										}else{
												echo '<option value="'.$resultData['Dealer Code'].'" >'.$resultData['Full Name'].'</option>';
										}
									}
									?>

							  </select>
						<!--	</form>-->
						</li>
					</ul>
					<!-- Collect the nav links, forms, and other content for toggling -->
				
				</div>
				
				<!--  <rn:condition hide_on_pages="home, public_profile, results, answers/list, social/questions/list">
            <div class="rn_SearchBar">
                <rn:widget path="search/SimpleSearch" report_page_url="/app/results"/>
            </div>
        </rn:condition>-->
			</nav>
		</header>
		<?php }elseif(checkURL('customer')){ ?>
		<header>
			<nav id="subhead">
				<div class="rn_NavigationBar">
					<input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly"/>
					<label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
					<ul class="rn_NavigationMenu">
						<!--<li>
							<i class="fa fa-home" aria-hidden="true"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/dealer#rn:config:CP_HOME_URL#" pages="home"/>
						</li>-->
						
						<li>
							<i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/employee/payment-details">Payment Details</a>
						</li>
						<!--<li>
							<i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/employee/trade-advance">Trade Advance</a>
						</li>-->
						<li>
							<i class="fa fa-money" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/employee/selfserviceview">Self Service</a>
						</li>
						
						<li>
							<i class="fa fa-question-circle"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/employee/customerquery" pages="customerquery, customer_ask_confirm"/>
						</li>
						<li>
						<!--<form id="seldealer" name="seldealer" method="post">-->
								<div class="search-agreement">
									<form action="/app/employee/payment-details" method="post">
										<div id="agreementsuggest"></div>
										<button type="submit" name="btnagreement">Submit</button>
									</form>
								</div>
						<!--	</form>-->
						</li>
					</ul>
					<!-- Collect the nav links, forms, and other content for toggling -->
				
				</div>
				
				<!--  <rn:condition hide_on_pages="home, public_profile, results, answers/list, social/questions/list">
            <div class="rn_SearchBar">
                <rn:widget path="search/SimpleSearch" report_page_url="/app/results"/>
            </div>
        </rn:condition>-->
			</nav>
		</header>

		<?php } ?>
	</rn:condition>

	<rn:widget path="utils/CapabilityDetector"/>

	<div class="rn_Body">
		<div class="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
			<rn:page_content/>
		</div>
	</div>
	<footer class="rn_Footer">
		<div class="rn_Container">
			<!--<rn:widget path="search/ProductCategoryList" report_page_url="/app/products/detail"/>-->
			<div class="footer-bottom text-center">
				<div class="container">
					<div class="pull-center">
						  <div class="row">
										<ul>
											<li><a href="/#">
											Copyright @ 2016 All rights reserved by TVS Credit Services Limited.
											</a></li>
											
										</ul>
						  </div>
									</div>
						<div class="row">
						  <div class="col-md-12">
							<ul>
							<li><a href="http://www.tvscredit.co.in/termsandcondition.aspx" target="_blank">Terms and Conditions</a> | <a href="http://www.tvscredit.co.in/privacypolicy.aspx" target="_blank">Privacy Policy</a></li>
											<li><a href="mailto:helpdesk@tvsc.co.in">helpdesk@tvsc.co.in</a></li>
							  
							</ul>
						  </div>
						</div>
				</div>
			</div>
		</div>
	</footer>

	<script type="text/javascript">
		$('#dealer_codes').on('change',function(){
				$('#seldealer').submit();
	});

	$(function() {
		$('#agreementsuggest').magicSuggest({
			placeholder: 'Enter Agreement Number',
			maxSelection: 1,
			width: 590,
			id: 'agg_no',
			name: 'agg_no',
			data: '/cc/EmployeeCustom/getEmployeeCustomerAgreements',
			valueField: 'Agreement_No',
			renderer: function(data){
				return '<b>' + data["Agreement_No"] + '</b>';
			},
			resultAsString: true
		});
	});
	</script>
</body>

</html>