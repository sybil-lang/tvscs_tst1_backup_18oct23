<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
	<meta charset="utf-8"/>
	<title>
		TVS Credit
	</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
	<!-- <rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail"/> -->
	<rn:theme path="/euf/assets/themes/standard/css" css="site.css,style.css,styles.css,style-product.css,select.dataTables.min.css,dataTables.bootstrap.min.css,customerlogin-style.css,custom_dashboard.css,buttons.dataTables.min.css,bootstrap-datetimepicker.min.css"/>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery-1.10.2.min.js"></script>
	<!--<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap.js"></script>-->
    <!-- <script src="/euf/assets/themes/standard/js/jquery-2.1.1.min.js"></script> -->
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/site.css">
    <link rel="stylesheet" href="/euf/assets/themes/standard/css/style.css">
	<rn:head_content/>
	<link rel="icon" href="/euf/assets/themes/standard/Images-new/favicon.png" type="image/png"/>
	<rn:widget path="utils/ClickjackPrevention"/>
	<rn:widget path="utils/AdvancedSecurityHeaders"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet"/>
	<!--<link rel="stylesheet" href="/euf/assets/themes/standard/css/custom-style.css"/>-->
	<script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>
    <link  href="/euf/assets/Images-new/favicon.png" rel="shortcut icon">
    	<script src="https://www.malot.fr/bootstrap-datetimepicker/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">

    <!-- Google Fonts -->
    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
    <link  href="/euf/assets/themes/standard/css/style.css" rel="stylesheet">
    <link  href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet">
	<link  href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet">
	<style type="text/css">
        @media screen and (max-width: 720px)
        {
.rn_SearchInput input[type="search"] {
    position: relative;
    left: 65px;
            } }
        div.timepicker-picker div.table-condensed tbody tr td .btn ,.timepicker-picker .table-condensed tbody tr td .btn-primary
        {
            width:70px !important;
            height:40px !important;
            color:#2e6da4 !important;
            text-align:center !important;
            padding-right:0px !important;
            
        }
        div.timepicker-picker div.table-condensed tbody tr td .btn a
        {
            font-color:white;   
        }
     
  span.year:after,span.decade:after,span.month:after {
    content: "";
    display: block;
    height: 1px;
    width: 40%;
    margin: 10px;
    background: #f00;
}
		.in{background:none !important;}
        .col-md-4 .rn_SearchControls .rn_SourceSearchButton .rn_SubmitButton{
margin-left:10px;
        }
        #nav-menu-container{
    top: 1% !important;
    left: 25% !important;
        }
	</style>

</head>
<?php
$CI=&get_instance();
$CI->load->helper('report');

//$bundle=$CI->session->getSessionData("previouslySeenEmail");
$userProfile=$CI->session->getSessionData("userProfile");
$msg=RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_LOAN_NOTIFICATIONS);
$report_id=$msg->Value;
 $contact_id=$CI->session->getProfileData("c_id");
//$contact_id=$bundle['sess_contact_id'];
//$filter=array('Contact ID'=>7);
$filter = array('Contact ID' => $contact_id);
$notifications_count = 0;
if(strlen($contact_id)){
	$notificationResponse = report_result($report_id,$filter);
}
//print_r($notificationResponse);
$notifications_count = count($notificationResponse);
//echo "<h2>Notifications Details</h2><br><br>";
$notification_text = '';
$notification_counter = 0;
if($notifications_count > 0 ){
		for($i = 0; $i < $notifications_count && $i <=10; $i++) {

				if(!empty($notificationResponse[$i]['Bounce Date'])){
						if(strtolower($notificationResponse[$i]['Bounce Notification Read']) !='yes'){
							$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
													  
													   <div class="notification-item">
														<h4 class="item-title">Your Bounce Date is '.($notificationResponse[$i]['Bounce Date']).'</h4>
														<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
													  </div>
													   
													</a>';
								$notification_counter +=1;
						}else{
							$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
													  
													   <div class="notification-item-read">
														<h4 class="item-title">Your Bounce Date is '.($notificationResponse[$i]['Bounce Date']).'</h4>
														<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
													  </div>
													   
													</a>';
					}
				}

			if(!empty($notificationResponse[$i]['Insurance Renewal Date'])){							
				if(strtolower($notificationResponse[$i]['Insurance Notification Read']) !='yes'){
					$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
											  
											   <div class="notification-item">
												<h4 class="item-title">Your Insurance Renewal Date is '.($notificationResponse[$i]['Insurance Renewal Date']).'</h4>
												<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
											  </div>
											   
											</a>';
				$notification_counter +=1;
				}else{
					$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
											  
											   <div class="notification-item-read">
												<h4 class="item-title">Your Insurance Renewal Date is '.($notificationResponse[$i]['Insurance Renewal Date']).'</h4>
												<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
											  </div>
											   
											</a>';
				}
			}

			if(!empty($notificationResponse[$i]['Receipt Date'])){
				if(strtolower($notificationResponse[$i]['Receipt Notification Read']) !='yes'){
					$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
												  
												   <div class="notification-item">
													<h4 class="item-title">Your Receipt Date is '.($notificationResponse[$i]['Receipt Date']).'</h4>
													<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
												  </div>
												   
												</a>';
					$notification_counter +=1;
				}else{
					$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
												  
												   <div class="notification-item-read">
													<h4 class="item-title">Your Receipt Date is '.($notificationResponse[$i]['Receipt Date']).'</h4>
													<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
												  </div>
												   
												</a>';
				}
			}
			if(!empty($notificationResponse[$i]['Presentation Date'])){
				if(strtolower($notificationResponse[$i]['Presentation Notification Read']) !='yes'){

					$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
											  
											   <div class="notification-item">
												<h4 class="item-title">Your Presentation Date is '.($notificationResponse[$i]['Presentation Date']).' </h4>
												<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
											  </div>
											   
											</a>';
					$notification_counter +=1;
				}else{
					$notification_text .= '<a class="content" href="'.$site_url.'/app/customer/selfserviceview/notification/1">
											  
											   <div class="notification-item-read">
												<h4 class="item-title">Your Presentation Date is '.($notificationResponse[$i]['Presentation Date']).' </h4>
												<p class="item-info">For Agreement No '.$notificationResponse[$i]['Agreement No'].'</p>
											  </div>
											   
											</a>';
					}
				}
			}
		}
?>
<body>
 
   <div id="wrapper" class="customers_login">
	<header id="header1">
   <div class="container1">
      <div id="logo" class="pull-left">
         <a class="" href="http://183.87.127.174:8787/"><img src="/euf/assets/themes/standard/Images-new/TVSCSlogo.png" alt="TVS Credit"/></a>
         <!-- Uncomment below if you prefer to use a text image -->
         <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>
      <div class="pull-right login-search-panel">
         <ul class="nav-menu navbar-right primary-menu">
           
            <li class="dropdown search-slide">
            <div class="social-statuses"><span> </span><a href="https://www.facebook.com/TVSCREDIT" target="_blank"><i class="fa fa-facebook round facebook"></i></a> <a href="https://twitter.com/TVSCredit" target="_blank"><i class="fa fa-twitter round twitter"></i></a> <a href="https://www.linkedin.com/company-beta/1481214?pathWildcard=1481214" target="_blank"><i class="fa fa-linkedin round linkedin"></i></a>
				</div>	 
            </li>         
 <li class="dropdown login-dropdown logins-dropdown hover-dropdown customermain_login  hidden-md visible-sm visible-xs">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			   <img src="/euf/assets/themes/standard/Images-new/mobile_icon/dropdown icon.png" class="img-responsive hovers-back" alt="dots" >
			   <img src="/euf/assets/themes/standard/Images-new/mobile_icon/dropdown icons.png" class="img-responsive hovers-no" alt="dots" style="display:none">			  
			   <span class="mobile-nav-title"></span>
			   </a>
                   <ul class="dropdown-menu slide-animate">
                           	 <li> <div class="contact-info">
<div class="contacts"><p id="a"><img src="/euf/assets/themes/standard/Images-new/mobile_icon/contact-us icon.png">Contact Us: <a href="callto://+18004253883">1800 425 3883</a></p> (Toll Free) </div>
	  </div></li>
	 <!-- <li><div class="contact-info">
 <div class="contacts"><p> <img src="/euf/assets/themes/standard/Images-new/mobile_icon/message-icon.png"><a href="mailto:Helpdesk@tvscredit.com">Helpdesk@tvscredit.com</a></p>
	  </div>
	  </div></li>-->
	  
	    <li>
		<div class="contact-info  text-capitalize">
 <div class="contacts"><p><a href="http://183.87.127.174:8484/about-us/">about us</a></p>
	  </div>
	  </div>
	  </li>
	  
	      <li>
		<div class="contact-info text-capitalize">
 <div class="contacts"><p> <a href="http://183.87.127.174:8484/investor/"> investors</a></p>
	  </div>
	  </div>
	  </li>
	      <li>
		<div class="contact-info text-capitalize">
 <div class="contacts"><p> <a href="http://183.87.127.174:8484/careers/">careers</a></p>
	  </div>
	  </div>
	  </li>
                            </ul>
            </li> 	   
         </ul>
      </div>
     <nav id="nav-menu-container" class="hidden-xs ">
	  <div class="row">
	  <div class="contact-info">
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/contact-us icon.png">Contact Us: <a href="callto://+18004253883">1800 425 3883</a></p> (Toll Free) </div>
	  </div>
	   <div class="contact-info">
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/time-icon.png"><span id="reg">9:00AM to 5:30PM
</span></p></div>
	  </div>
	  <div class="contact-info">
 <div class="contacts"><p> <img src="/euf/assets/themes/standard/Images-new/message-icon.png"><a href="mailto:helpdesk@tvscredit.com">helpdesk@tvscredit.com</a></p>
	  </div>
	  </div>
       
	  </div>  
       </nav>
	  	     <!--  <nav id="secondary-nav" class="hidden-xs hidden-sm">
		   
	  <div class="row">

	  <div class="inline-block">
 <div class="contacts"><p> <a href="http://183.87.127.174:8484/about-us/">about us</a></p>
	  </div>
	  </div>
	 
	    <div class="inline-block">
 <div class="contacts"><p> <a href="http://183.87.127.174:8484/investor/"> investors</a></p>
	  </div>
	  </div>
	     <div class="inline-block">
<div class="contacts"><p> <a href="http://183.87.127.174:8484/careers/">careers</a></p>  </div>
	  </div>
	  
	  
	  </div>  

 
      </nav>-->
   </div>
</header>
	<!--<div class="second-nav customer-service-info">
		<div class="row">

			<div class="wrapper"-->
			
			
			<!-- Start Chat -->
	<!-- <div class="col-md-offset-4 col-md-3">
				<div class="rn_ChatLink">
					<div id="rn_ConditionalChatLink_24" class="rn_ConditionalChatLink"><div class="rn_Chat"><a  href="/app/chat/chat_launch">Live</a><span id="rn_ConditionalChatLink_24_UnavailableHoursMessage" style="color:#000;"> Our support team is available.
                        
Chat with our team and expect a quick 
reply.</span> </div></div>
				</div> -->
       <!-- <rn:widget path="chat/ConditionalChatLink" min_sessions_avail="1" chat_login_page="/app/chat/chat_launch" label_default="Chat directly with a member of our support team." sub_id="conditionalChat"/>-->
				
				
				
			<!-- </div> -->
			<!-- End Chat -->

			<!-- Start Search -->
			<!-- <div class="col-md-4">
				<div class="rn_SearchControls">
					<h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
					<form method="get" action="/app/results">
						<rn:container source_id="KFSearch">
							<div class="rn_SearchInput">
								<rn:widget path="searchsource/SourceSearchField" initial_focus="true"/>
                               
							</div>
						 <rn:widget path="searchsource/SourceSearchButton" search_results_url="/app/results"/>
						</rn:container>
				 	</form>
				</div>
			</div>
			
			<!-- End OF Search
		</div>
	</div>-->
	
	<!-- <rn:condition logged_in="true">
		<?php
		if($userProfile['cType'] =='Customer'){?>
		<header>

			<nav>
				<div class="rn_NavigationBar">
					<input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly"/>
					<label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
					<ul class="rn_NavigationMenu">
						<li>
							<i class="fa fa-home" aria-hidden="true"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="Home" link="/app/#rn:config:CP_HOME_URL#" pages="home"/>
						</li>
						<li>
							<i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/customer/dashboard">Dashboard</a>
						</li>
						<li>
							<i class="fa fa-share-alt-square" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/customer/selfserviceview">Self-Service</a>
						</li>
						<li>
							<i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/customer/value-added">Value-Added Services</a>
						</li>
						<li>
							<i class="fa fa-google-wallet" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/customer/wallet">Wallet</a>
						</li>
						<li>
							<i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/account/profile">Profile</a>
						</li>
						<li>
							<i class="fa fa-question" aria-hidden="true"></i>&nbsp;<rn:widget path="navigation/NavigationTab" label_tab="Ask a Question" link="/app/raisequery" pages="raisequery, ask_confirm"/>
						</li>
						<li>
							<i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/answers/list">FAQ</a>
						</li>
						<li>
							<i class="fa fa-phone"></i>&nbsp;<a href="javascript:void();" data-toggle="modal" data-target="#myModal">Call me Back</a>
						</li>
					</ul>
				</div>

				  <rn:condition hide_on_pages="home, public_profile, results, answers/list, social/questions/list">
            <div class="rn_SearchBar">
                <rn:widget path="search/SimpleSearch" report_page_url="/app/results"/>
            </div>
        </rn:condition>
			</nav>
		</header>
        </div>
		<?php }elseif(strtolower($userProfile['cType']) == 'dealer'){?>
				
				<header>

				<nav>
					<div class="rn_NavigationBar">
						<input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly"/>
						<label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
						<ul class="rn_NavigationMenu">
							<li>
								<i class="fa fa-home" aria-hidden="true"></i>
								<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/dealer#rn:config:CP_HOME_URL#" pages="home"/>
							</li>
							<li>
								<i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/dashboard">Dashboard</a>
							</li>
							<li>
								<i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/business-information">Business Information</a>
							</li>
							<li>
								<i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/trade-advance">Trade Advance</a>
							</li>
							<li>
								<i class="fa fa-money" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/incentive">Incentives & Claims</a>
							</li>
							<li>
								<i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/account/overview">Grievance</a>
							</li>
							<li>
								<i class="fa fa-question-circle"></i>
								<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/dealer/raisequery" pages="raisequery, ask_confirm"/>
							</li>
							<li>
								<i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/answers/list">FAQ</a>
							</li>
							<li>
								<i class="icon-envelope"></i> <a href="<?php echo $site_url;?>/app/account/profile">General</a>
							</li>
							<li>
								<i class="icon-question-sign"></i>
								<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/raisequery" pages="raisequery, ask_confirm"/>
							</li>
							<li data-toggle="modal" data-target="#myModal" id="call_back">
								<i class="icon-phone"></i> Call me Back</li>
							</li>
						</ul>
					</div>

					
				</nav>
		</header>

		<?php }elseif(strtolower($userProfile['cType']) == 'internal employee'){?>

		<header>

			<nav class="navbar navbar-default">
				  <div class="container-fluid">
					 Brand and toggle get grouped for better mobile display 
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="#"></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling 
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav">
						
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard <span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="<?php echo $site_url;?>/app/employee/dashboard"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Employee Dashboard</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo $site_url;?>/app/employee/dealer/questions/list"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Dealer Dashboard</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo $site_url;?>/app/employee/customer/questions/list"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Customer Dashboard</a></li>
			<!--	<li><a href="#">Something else here</a></li>
							<li><a href="#">Separated link</a></li>
						  </ul>
						</li>
						<li>
					<!--	<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/dealer_dashboard"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Dealer Helpdesk</a>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/dealerquery"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Dealer Helpdesk</a>
						</li>
						<li>
							<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/customer_dashboard"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;Customer Helpdesk</a>
						</li>
						<li class="lp-dropdown">
								<a href="#" class="dropdown-toggle" id="Agent-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Leads <span class="caret"></span></a>
								<ul class="dropdown-menu" data-dropdown-owner="Agent-dropdown">
									<li>
										<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/lead_generation"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Lead generation</a>
									</li>
									<li role="separator" class="divider"></li>
									<li>
										<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/lead_status"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Lead Status</a>
									</li>
									<li role="separator" class="divider"></li>
									<li>
										<a tabindex="-1" href="<?php echo $site_url;?>/app/employee/login_status"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Login Status</a>
									</li>
								</ul>
							</li>
							
							<li>
								<a href="<?php echo $site_url;?>/app/employee/account/profile"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;Profile</a>
							</li>
							<li>
								<a href="<?php echo $site_url;?>/app/employee/tutorial"><i class="fa fa-hourglass-half" aria-hidden="true"></i>&nbsp;Tutorial</a>
							</li>
							<li>
								<a href="<?php echo $site_url;?>/app/employee/documents"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Documents</a>
							</li>
							<li>
								<a href="<?php echo $site_url;?>/app/employee/raisequery"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Employee Helpdesk</a>
							</li>
							
					  </ul>
					  

					</div><!-- /.navbar-collapse 
				  </div><!-- /.container-fluid 
				</nav>
		</header>
		<?php } ?>
	</rn:condition> -->

	<rn:widget path="utils/CapabilityDetector"/>

	<div class="rn_Body">
		<div class="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
			<rn:page_content/>
		</div>
	</div>
	<footer class="rn_Footer">
		<div class="rn_Container">
			<div class="footer-bottom text-center">
				<div class="container">
					<div class="pull-center">
						  <div class="row">
										<ul>
										<li class="pull-left"><a href="http://www.tvscredit.co.in/termsandcondition.aspx" target="_blank">Terms and Conditions</a>| <a href="http://www.tvscredit.co.in/privacypolicy.aspx" target="_blank">Privacy Policy</a></li>
											<li><a href="/#" style="pointer-events:none;">
											Copyright  © 2018 All rights reserved by TVS Credit Services Limited. </a></li>
											<li class="pull-right"><a href="mailto:helpdesk@tvscredit.com"> helpdesk@tvscredit.com </a></li>
											
										</ul>
						  </div>
									</div>
						<!--<div class="row">
						  <div class="col-md-12">
							<ul>
							
											
							  
							</ul>
						  </div>
						</div>-->
				</div>
			</div>
		</div>
	</footer>	


	<!-- Modal -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">TVS - Call Request</h4>
				</div>
			<p id="response_text"></p>
			<form id="frmcall" name="frmcall" method="post">
				<div class="modal-body" id="model_body">
					
								<div class="form-group">
									<!--<label for="exampleSelect1">Agreement Number</label>-->
									<rn:widget path="custom/input/agreementSelect/" name="agreementno" required="true" label_input="Agreement Number"/>
								  </div>
							  <div class="form-group">
								<label for="exampleInputEmail1">Preferred contact no.</label>
								<input type="number" class="form-control" id="contact_number"  name="contact_number"  maxlength="10" required >
								<small id="emailHelp" class="form-text text-muted">&nbsp;</small>
							  </div>
							 
							  
							<div class="form-group">
								<label for="datetimepicker">Preferred Date/Time to speak</label>
								<div class='input-group date' id='datetimepicker8'>
									<input type='text' class="form-control" name="datetime_speak" id="datetime">
									<span class="input-group-addon">
										<span class="fa fa-calendar">
										</span>
									</span>
								</div>
							
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker8').datetimepicker({
									icons: {
										time: "fa fa-clock-o",
										date: "fa fa-calendar",
										up: "fa fa-arrow-up",
										down: "fa fa-arrow-down"
									},
									minDate : 'now'
								});
							
  });
						</script>
					</div>

					<div class="form-group">
						<label for="exampleTextarea">Assistance required</label>
						<textarea class="form-control" id="assistance"  name="assistance" rows="3" ></textarea>
					  </div>
				</div>
				<div class="modal-footer" id="modal-button">
					<button type="button" class="btn btn-primary" id="call_back">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>
				<div id="after-submit" style="display:none;"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
				</form>
			</div>

		</div>
	</div>
	<!-- Modal -->

	<!-- script for modal -->
	<script>
	var validFlag = false;
		$( "#call_back" ).click( function () {
			//alert( "Handler for .click() called." );
			if($('#rn_agreementSelect_30_agreementno').val() == '-1'){
				bootbox.alert("<p>Please select Agreement No</p>");
				validFlag = true;
			}else if($('#contact_number').val() == ''){
				bootbox.alert("<p>Please Enter valid Mobile No</p>");
				validFlag = true;
			}else{
				validFlag = false;
			}

			if(!validFlag){
				$( "#response_text" ).html("Logging Request......");
				$.ajax({
							url: "/cc/AjaxCustom/create_inc",
							type: "post",
							data: $('#frmcall').serialize(),
							success: function(response) {
								//alert(d);
								var obj = jQuery.parseJSON(response);
								//var html_txt = '<p>Thanks for submitting your Request. Your request is logged and our representative will call you back ASAP! <br />Use this reference number for follow up: <b><a href="/app/account/questions/detail/i_id/'+obj[0].value_id+'">'+obj[0].value_refno+'</a>.</b></p>';
								//$( "#response_text" ).html( html_txt );
								//$('#model_body').hide();
								//$('#modal-button').hide();
								//$('#after-submit').show();
								if(obj[0].value_id != ""){
											window.location.href= '/app/ask_confirm/i_id/'+obj[0].value_id;
								}
							}
				   });
			}
		} );
	</script>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
	
       <!--   <script src="js/main.js"></script>
  <script src="js/custom.js"></script>	  
	script for modal -->
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
if($('.notification').length){
	var el = document.querySelector('.notification');

	//document.querySelector('button').addEventListener('click', function(){//
		var count = Number('<?php echo $notification_counter;?>') || 0;
		el.setAttribute('data-count', count);
		el.classList.remove('notify');
		el.offsetWidth = el.offsetWidth;
		el.classList.add('notify');
	//	alert(count);
		if(count != 0){
			el.classList.add('show-count');
		}
}
//}, false);
</script>
</body>
