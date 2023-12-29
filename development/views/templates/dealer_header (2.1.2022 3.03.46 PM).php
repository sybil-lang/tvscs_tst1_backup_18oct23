<?php
$CI=&get_instance();

$contact_id=$CI->session->getProfileData("c_id");
if($contact_id){
$dealer_contact = RightNow\Connect\v1_3\Contact::fetch($contact_id);
$product = $dealer_contact->CustomFields->CO->DealerProduct->LookupName;
$dealer_code = $dealer_contact->CustomFields->c->dealer_code;
$contact_fname = $dealer_contact->Name->First;
$contact_lname= $dealer_contact->Name->Last;
}
if(!empty($contact_id) || strlen($contact_id)>0){
	$userData = $CI->session->getSessionData('userProfile');
  $CI->load->helper('report');
  $eligibleForWorkingRequest = isDealerEligibleForWorkingRequest();
}else{
	$userData = array();
}
try{
			  $notifications_array=array();
			  $report_id = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_Noti_report)->Value;
			   // echo "<br>Report ID:".$report_id;
	    	  $product_filter = new RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
		      $product_filter->Name = "Product Code";
		      $product_filter->Values= array("$product");
		      $status_filter = new RightNow\Connect\v1_3\AnalyticsReportSearchFilter;
		     
		      $filters = new RightNow\Connect\v1_3\AnalyticsReportSearchFilterArray;
	          $filters[0] = $product_filter;
	    
			  $ar= RightNow\Connect\v1_3\AnalyticsReport::fetch($report_id);
			  $arr = $ar->run(0,$filters);
			  $notification_count = $arr->count();
			  // echo "Notification Count: ".$notification_count;
			  if ($notification_count>0) 
			  {  	 $row = $arr->next();
				     for ( $ii = 0; $ii++ < $notification_count; $row = $arr->next())
				     {
				     	array_push($notifications_array, $row);
				     }
				     
			  }
		}
catch(Exception $w){
	echo $w->getMessage();
}
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
	<rn:theme path="/euf/assets/themes/standard/css" css="site.css,style.css,styles.css,style-product.css,customerlogin-style.css,custom_dashboard.css,bootstrap-datetimepicker.min.css"/>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
     <!-- <script type="text/javascript" src="/euf/assets/themes/standard/js/jquery-1.10.2.min.js"></script>-->
	  <!--<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap.js"></script>-->

	  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link  href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet">
	  <link  href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet">
	  <rn:head_content/>
	  <link rel="icon" href="/euf/assets/themes/standard/Images-new/favicon.png" type="image/png"/>
	  <rn:widget path="utils/ClickjackPrevention"/>
      <rn:widget path="utils/AdvancedSecurityHeaders"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/euf/assets/themes/standard/css/custom-style.css"/>
      <link  href="/euf/assets/Images-new/favicon.png" rel="shortcut icon">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  
      <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
      <link  href="/euf/assets/themes/standard/css/style.css" rel="stylesheet">
      <link  href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet">
	  <link  href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet">
    <link  href="/euf/assets/themes/standard/css/style.css" rel="stylesheet">
 	<style type="text/css">
        /*input[type=search]{
          width: 314px !important;
          padding: 10px 10px!important;
        }*/
        .customers_login #header1 #logo img { width: 200px !important; }
        .customers_login #header1 #logo {margin-top: 5px;}
        .rn_AccountDropdownParent{margin-right: 60px;}
        h2.m-top-none {
            color: white !important;
            font-size: 22px !important;
        }
		.hiding{
        	display: none;
        }
        .close {
			top: -8px;
			right: -175px;
        }
        @media screen and (max-width: 1253px){
          
          button[type=submit]{
            position: absolute !important;
          }
        }
        .bootstrap-datetimepicker-widget {
            z-index: 9999 !important;
        }
        
        #myModal .modal-dialog .modal-content
        {
           width: 600px;
           bottom: 30px;
           height: auto;
           overflow-y: hidden;
        }
        .modal-header .close{
            /*position: relative;
            top: -3px;
            left: -10px;*/
            /* margin-right: 225px; */
            /*font-size: 28px;*/
              position: relative;
              top: -32px !important;
              left: -161px !important;
              width: 25px !important;
              /* margin-right: 225px; */
              /* height: 22px; */
              background-color: #c30202 !important;
              color: white !important;
              font-size: 25px !important;
          }
        #myModal .form-group
        {
            position:relative;
            bottom:10px;
        }
        #myModal
        {
            overflow-y:hidden;
            overflow-x:hidden;
        }
        #myModal .modal-dialog .modal-content #modal-button 
        {
            position: relative;
            top : 13px;

        }
        button.close
        {
            color:black;
        }
        .rn_LoginStatus
        {
           background-color: #115184;
           height: 0px;
                  
        }
        .rn_AccountDropdown
        {
            width:300px;
        }
        .form-group
        {
           text-align:left !important;
        }
        .rn_Hero .rn_HeroInner .rn_SearchControls .rn_SearchButton
        {
                position: relative;
                left: 0px;
        }
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
            color:white;   
        }
      
  span.year:after,span.decade:after,span.month:after {
    content: "";
    display: block;
    height: 1px;
    width: 40%;
    margin: 10px;
    background: #f00;
}
        .scrollbar
        {
            border-bottom: 1px solid;
        }
        .modal-dialog
        {
            z-index:1050 !important;
        }
		.in
        {
            background:none !important;
        }
   .rn_SubNavigation
            {
                    right: 118px;
            }
  .rn_SearchControls .rn_SearchButton
        {
                position: relative;
                right: 26px;
        }
 
      @media screen and (max-width: 1228px){
         li>a{
          font-size: 14px !important;
         }
         header nav .rn_NavigationBar .rn_NavigationMenu li{
          padding-right: 0.9em !important;
         }
        }
        @media screen and (max-width: 1053px){
         li>a{
          font-size: 13px !important;
         }
         header nav .rn_NavigationBar .rn_NavigationMenu li{
          padding-right: 0.58em !important;
         }
        }
       @media screen and (max-width: 800px)
       {
           
           .rn_SearchControls form .rn_SearchButton
           {
               right: 249px;
           }
            .rn_AccountDropdownTrigger
            {
                 position: relative;
                 right: 10px;
            }
           h4
           {
                   font-size: 14px !important;
           }
           #new4
           {
                   width: 700px !important;
           }
           #myModal
           {
                   width: 650px !important;
           }
           .rn_SourceSearchButton
           {
               position: relative;
              right: -4px;
           }
           .z-container,#page
           {
                   width: 610px;
           }
           .login
           {
                   width: 300px;
           }
  
           .rn_SearchButton
           {
               right: 229px;
               position: relative;
           }
           .rn_LoggedInUser
           {
                   position: relative;
                   right: 135px;
           }
         
           .rn_SourceSearchButton
           {
                   position: relative !important;
                   right: -6px !important;

           }
           #header1
           {
               background-color:white !important;
           }
          .primary-menu .fa 
           {
               font-size:9px;
           }
          .form-group label
           {
               position:relative;
               right:100px;
            }
          .form-group ~label
            {
               position:relative;
               right:100px;
            }
        .form-group input[type="password"]~label
            {    
               position:relative;
               right:120px;
            }
        .form-group~input[type="submit"], .custom_log .submit, .custom_log .submit:hover, button:active:not(:disabled), input[type="submit"]:active:not(:disabled)
            {
               width:300px !important;
               position: relative;
               right: -43px;
               top: 41px;
            }
        .z-container, #tabbed-nav2
           {
               width:620px !important;
           }
           .rn_Footer
           {
               width:700px !important;
           }
        }
                .blink_me {
		  animation: blinker 0.8s linear infinite;
		  font-weight: 900;
		  font-size: 16px;
		}
		@keyframes blinker {  
		  50% { opacity: 0; }
		}
		.nav-menu, .nav-menu *{
			margin: 3px 0px 0px 0px;
		    padding: 0;
		    list-style: none;
		    right: 40%;
		}
		.dropdowns {
		    /*display: inline-block;
		    margin-left: 220px;
		    padding: 10px;*/
        display: inline-block;
        position: absolute;
        top: 0px;
        right: -40px;
		}
		div.notification.notify.show-count::after{
			background-color: #0e8943;
		}
		.notifications .notifications-wrapper .content,.notification
        {
            right:0% !important;
        }
        .notifications .notifications-wrapper .content .notification-item-read p.item-info
        {
            color:#337ab7;
        }
        .dropdown-menu{
        	/*right: 0;*/
          left: -395px;
        }
        .notifications-wrapper h5{
        	color:blue;
        }
		   .glyphicon-chevron-left, .glyphicon-chevron-right,.dow,.picker-switch {
              color: white !important;
          }
	</style>
<!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-KBWP7ZJ');</script>

<!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBWP7ZJ"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- End Google Tag Manager (noscript) -->
    <div id="wrapper" class="customers_login">
<header id="header1">
   <div class="container1">
	<a href="#rn_MainContent" class="rn_SkipNav rn_ScreenReaderOnly">#rn:msg:SKIP_NAVIGATION_CMD#</a>
    <div id="logo" class="pull-left">
         <a class="" href="<?php echo $site_url;?>"><img src="/euf/assets/themes/standard/Images-new/TVSCSlogo.png" alt="TVS Credits"/s></a>
    </div>
    <div class="pull-right login-search-panel">
         <ul class="nav-menu navbar-right primary-menu">
           <li class="dropdown search-slide">
                <div class="social-statuses"><span> </span><a href="https://www.facebook.com/TVSCREDIT" target="_blank"><i class="fa fa-facebook facebook"></i></a> <a href="https://twitter.com/TVSCredit" target="_blank"><i class="fa fa-twitter twitter"></i></a> <a href="https://www.linkedin.com/company-beta/1481214?pathWildcard=1481214" target="_blank"><i class="fa fa-linkedin linkedin"></i></a>
				</div>	 
            </li> 
          </ul>
       </div>
				<?php
				if(!empty($userData['sess_email'])){?>
					<div class="col-md-3 col-xs-12 text-xs-center text-md-left"><!--<strong>Email: <i class="fa fa-envelope"></i>  <a href="mailto:dealer.helpdesk@tvscredit.com">dealer.helpdesk@tvscredit.com</a></strong> --> </div>
				<?php }else{ ?>
					<div class="pull-right login-search-panel">
         <ul class="nav-menu navbar-right primary-menu">
             <li class="dropdown login-dropdown logins-dropdown hover-dropdown customermain_login  hidden-md visible-sm visible-xs">
                  <ul class="dropdown-menu slide-animate">
                      <li> <div class="contact-info">
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/mobile_icon/contact-us icon.png">Contact Us: <a href="callto://+18001030010">1800 103 0010</a></p> (Toll Free) </div>
	  </div></li>
	 <!-- <li><div class="contact-info">
 <div class="contacts"><p> <img src="images/mobile_icon/message-icon.png"><a href="mailto:Helpdesk@tvscredit.com">Helpdesk@tvscredit.com</a></p>
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
                        
				<?php } ?>
				
				<div class="col-md-3 col-xs-12 text-right login">
					<div class="rn_LoginStatus">
						<!-- <rn:condition logged_in="true">

<rn:widget path="custom/login/dealerAccountDropdown" subpages="Profile Information > dealer/account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > dealer/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > dealer/account/profile"/>
						</rn:condition> -->

                        <rn:condition logged_in="true">

<rn:widget path="custom/login/dealerAccountDropdown" subpages="Profile Information > dealer/account/profile, #rn:msg:SUPPORT_HISTORY_LBL# > dealer/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > dealer/account/overview"/>
                        </rn:condition>
					</div>

				</div>
       
			
		

<nav id="nav-menu-container" class="hidden-xs ">
	  <div class="row" style="
    position: relative;
    right: 71px;
">
	  <div class="contact-info">
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/contact-us icon.png">Contact Us: <a href="callto://+18001030010">1800 103 0010</a></p> (Toll Free) </div>
	  </div>
	   <div class="contact-info">
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/time-icon.png"><span id="reg">9:00AM to 7:00PM
</span></p></div>
	  </div>
	  <div class="contact-info">
 <div class="contacts"><p> <img src="/euf/assets/themes/standard/Images-new/message-icon.png"><a href="mailto:dealer.helpdesk@tvscredit.com">dealer.helpdesk@tvscredit.com</a></p>
	  </div>
	  </div>
       <rn:condition logged_in="true">
					<div class="dropdowns">
						  <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
								<div class="notification"></div>
						</a>
										<ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
											<div class="notification-heading"><h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right"><a href="<?php echo $site_url; ?>/app/customer/selfserviceview/notification/1">View all</a><i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
											</div>
											<li class="divider"></li>
										   <div class="notifications-wrapper" style="height: fit-content;word-break: normal;padding-left:15px;white-space: normal;">
											 <?php
													for ($i=0; $i<count($notifications_array); $i++) { 
														echo "<a href='".$site_url."/app/dealer/notification/id/".$notifications_array[$i]["ID"]."'>".$notifications_array[$i]["Name"]."</a><hr/>";
													}
											
											?>
										   </div>
											<li class="divider"></li>
											
										  </ul>
								</div>
					</rn:condition>
	  </div>  
       </nav>
   <!-- <nav id="secondary-nav" class="hidden-xs hidden-sm">
		   
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
</header>
<div class="second-nav customer-service-info ">
  <div class="row">
   <div class="col-md-offset-4 col-md-3">
      <!-- <rn:widget path="chat/ConditionalChatLink" /> -->
      <script id="gs-sdk" src='//www.buildquickbots.com/botwidget/v3/demo/static/js/sdk.js?v=3' key="048009c1-d806-4932-b4ce-a5a248921c9a" callback="tAInit"></script>
    </div>
				
   <div class="col-md-4 ">
     <div class=""> 
         <div class="rn_SearchControls">
					<h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
					<form method="get" action="/app/dealer/results">
						<rn:container source_id="KFSearch">
							<div class="rn_SearchInput">
								<rn:widget path="searchsource/SourceSearchField" initial_focus="true"/>
							</div>
							<rn:widget path="searchsource/SourceSearchButton" search_results_url="/app/dealer/results"/>
						</rn:container>
					</form>
				</div>
			</div>
    </div>
        </div>
    </div>
    <rn:condition logged_in="true">
			<!-- End OF Search -->
    <script type="text/javascript">
      var ShowApplyNow = false;
      var dealerProduct= '<?php echo $product; ?>';
    	$(document).ready(function(){
        			$.ajax({
							url: "/cc/DealerCustom/getWCPOPUP",
							type: "post",
							data: {"DealerCode":"<? echo $dealer_code; ?>"},
							success: function(response) {
                
    							if(response[0].Amount!=undefined ||response[0].Amount!=null){
    								  $('.classamt').text(response[0].Amount);
                  }
                  if(response[0].InterestFlag == "" || response[0].InterestFlag == "Y"){
                      $('#simple-marquee').removeClass('hiding');
                      $('#applynow-marquee').addClass('hiding');
                  }
                  else{
                      $('#simple-marquee').addClass('hiding');
                      $('#applynow-marquee').removeClass('hiding');
                  }
                console.info(response);
							},
							error: function(e){
								console.error(e);
							}
				   });
        		});
    </script>
 
</rn:condition>
	<rn:condition logged_in="true">
	<div style="background-color: #ECF0F1; height:22px;">
	
	<marquee id="simple-marquee" class="hiding" scrolldelay="60" style="valign: middle;" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();">
				<p style="color:#FF5733;font-size: 14px;">
				<b> Dear Sir / Madam, Please transfer the TA / WC reimbursement only in the following account for faster updation / reconciliation. Thanks for your understanding. Beneficiary Name - TVS CREDIT SERVICES LIMITED, Credit Account Number - 30711501927, Bank - STATE BANK OF INDIA, CAG Branch, Egmore, Chennai – 600 008, IFSC Code - SBIN0009999.
				</b>
				</p>
			</marquee>
			
      <marquee id="applynow-marquee" class="hiding" scrolldelay="20" style="valign: middle;" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();">
        <p style="color:#FF5733;font-size: 14px; padding: 2px; text-align: center;">
        <a href="#" data-toggle="modal" class="blink_me" data-backdrop="static" data-keyboard="false" data-target="#myModal"><strong>Apply Now</strong></a>   
        <b> Dear <strong><?echo $contact_fname." ".$contact_lname; ?></strong>, You are Eligible for  availing TVSCS Working Capital Facility for limit up to <strong>Rs.<span class="classamt">0</span><strong>/-. For further details contact your TVSCS Area Manager immediately. <a href="#" data-toggle="modal" class="blink_me" data-target="#myModal"><strong> Apply Now</strong></a>
          <!-- <a id="applynow" onclick="yes_js_login()">Apply Now</a>  -->
        </b>
        </p>
      </marquee>
    
	</div>
	<header>
			<nav>			
				<div class="rn_NavigationBar">
					<input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly"/>
					<label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
					<ul class="rn_NavigationMenu" style="text-align: center;">
						<!--<li>
							<i class="fa fa-home" aria-hidden="true"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/dealer#rn:config:CP_HOME_URL#" pages="home"/>
						</li>-->
						<li>
							<i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/dashboard">Dashboard</a>
						</li>
						<li>
							<i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/business-information">Business Information</a>
						</li>
						<li>
						    <?php if($eligibleForWorkingRequest){ ?>
								<i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/working-capital">Working Capital Request</a>
							<?php } else { ?>
							  <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/trade-advance">Trade Advance</a>
							<?php } ?>
						</li>
						<li>
              <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/lead_generation">Leads</a>
            </li>
						<li>
							<i class="fa fa-money" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/incentive">Incentives & Claims</a>
						</li>
						<li>
							<i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/account/profile">Profile Info</a>
						</li>
            <li>
              <i class="fa fa-file"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/invoice">Dealer Invoice</a>
            </li>
          
						<li>
							<i class="fa fa-question-circle"></i>
							&nbsp;<a href="<?php echo $site_url;?>/app/dealer/raisequery">Raise a Query</a>
						</li>
						<!--<li>
							<i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/answers/list">FAQ</a>
						</li>-->
						<!--<li>
							<i class="icon-envelope"></i> <a href="<?php// echo $site_url;?>/app/account/profile">General</a>
						</li>
						<li>
							<i class="icon-question-sign"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/raisequery" pages="raisequery, ask_confirm"/>
						</li>-->
					<!-- <li>
							<i class="fa fa-phone"></i>&nbsp;<a href="#" data-toggle="modal" data-target="#myModal">Call me Back</a>
						</li> -->
					</ul>
				</div>

				</nav>
		</header><!--  <rn:condition hide_on_pages="home, public_profile, results, answers/list, social/questions/list">
            <div class="rn_SearchBar">
                <rn:widget path="search/SimpleSearch" report_page_url="/app/results"/>
            </div>
        </rn:condition>-->
		<!-- Modal -->
	
	 <!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
     
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">TVS - Call Request</h4>
        </div>
      <p id="response_text"></p>
      <form id="frmcall" name="frmcall" method="post">
        <div class="modal-body" id="model_body">
          <div class="form-group" id="fodate">
                <label for="datetimepicker">Preferred Date/Time to speak</label>
                <div class='input-group date' id='datetimepicker8'>
                  <input type='text' class="form-control" name="datetime_speak" />
                  <span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                  </span>
                </div>
                          </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Preferred contact no.</label>
                <input type="number" class="form-control" id="contact_number"  name="contact_number"aria-describedby="Preferred contact no" placeholder="Enter Mobile Number" maxlength="10" required >
                <small id="emailHelp" class="form-text text-muted">&nbsp;</small>
                </div> -->
	<!-- script for modal-->
  
	<!-- ///////////////////////////////////////////////////////////// #9: WC LIMIT POP UP INTERESTED///////////////////////////////////// -->
			
        <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
			<div class="modal-content">
				
			<p id="response_text"></p>
			<form id="frmcall" name="frmcall" method="post">
				<div class="modal-body" id="model_body">
										<div class="modal-body" id="model_body">
				  <div class="form-group">
								Dear <strong><?echo $contact_fname." ".$contact_lname; ?></strong>, You are Eligible for  availing TVSCS Working Capital Facility For limit up to <strong>Rs.<span class="classamt">0</span></strong>/-. For further details contact your TVSCS Area Manager immediately.
					</div>
				
					<div class="form-group" id="foas">
            			  <input type="hidden" name="DealerCode" id="DealerCode" value="<? echo $dealer_code; ?>">
                    <label><input type="radio" name="isInterested" value="Y" id="yesI" required> Interested</label>
                    <label><input type="radio" name="isInterested" value="N" id="noI" required> Not Interested</label>
              			 <br><label for="Comments" id="remarsk" class="hiding">Remarks</label>
                     <textarea id="comments" name="Comments" rows="4" cols="6" class="hiding"></textarea>
					</div>
					<div class="modal-footer" id="modal-button">
						<button type="button" class="btn btn-primary" id="call_back">Submit</button>
					</div>
					<!-- <div id="after-submit" style="display:none;">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div> -->
				</div>
				</form>
			</div>
			<script type="text/javascript">
				$('#noI').click(function(){
					$('#comments').removeClass("hiding");
          $('#remarsk').removeClass("hiding");
          $('#comments').prop('required',true);
				});			
			</script>
		</div>
	</div>
	</div>
        	<script>
        		
		var validFlag = false;
		$( "#call_back" ).click( function (e) {
			//alert( "Handler for .click() called." );
      e.preventDefault();
      if(jQuery("input[name='isInterested']:checked").val() == undefined){
            alert("Please select interested or not.");
      }
      else{
        if($('#comments').val().length==0){
          alert("Please add remarks.");
          return false;
        }
        else{  
      				$.ajax({
      							url: "/cc/DealerCustom/setWCPOPUP",
      							type: "post",
      							data: $('#frmcall').serialize(),
      							success: function(response) {
      								console.log(response[0].Message);
      							},
      							error: function(e){
      								console.log(e);
      							}
      				   });
              $('#myModal').modal('toggle');
              return true;
          }
			}
      return false;
    }
		 );
        
	</script>
	<!-- //////////////////////////////////////////////////////////////////// END : #9 ////////////////////////////////////////////// -->
	</rn:condition>
	<rn:widget path="utils/CapabilityDetector"/>

	<div class="rn_Body">
		<div class="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
			<rn:page_content/>
		</div>
	</div>
	<footer class="rn_Footer">
		<div class="rn_Container " id="new3">
			<div class="footer-bottom text-center">
				<div class="container">
					<div class="pull-center">
						  <div class="row">
										<ul id="new4">
										<li class="pull-left"><a href="http://www.tvscredit.co.in/termsandcondition.aspx" target="_blank">Terms and Conditions</a>| <a href="http://www.tvscredit.co.in/privacypolicy.aspx" target="_blank">Privacy Policy</a></li>
											<li><a href="/#" style="pointer-events:none;">
											Copyright  © 2018 All rights reserved by TVS Credit Services Limited. </a></li>
											<li class="pull-right"><a href="mailto:dealer.helpdesk@tvscredit.com"> dealer.helpdesk@tvscredit.com </a></li>
											
											
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

	<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.css">

<script type="text/javascript" src="/euf/assets/themes/standard/js/moment-with-locales.js"></script>

<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap-datetimepicker.js"></script>
    	<script type="text/javascript">
		yes_js_login = function() {
         // alert("You clicked a link");
         return false;
    }
//							$(function () {
								$('#datetimepicker8').datetimepicker({
									icons: {
										time: "fa fa-clock-o",
										date: "fa fa-calendar",
										up: "fa fa-arrow-up",
										down: "fa fa-arrow-down"
									},
									minDate : 'now',
                  debug:true
								});
                                
            $(document).ready(function() {
                $("#datetimepicker8 span").click(function() {
    $(".bootstrap-datetimepicker-widget").removeClass("top");
    $(".bootstrap-datetimepicker-widget").addClass("bottom");
    $(".bootstrap-datetimepicker-widget").addClass("down");
                    });
});
          
//							});
                          
if($('.notification').length){
	var el = document.querySelector('.notification');
	//document.querySelector('button').addEventListener('click', function(){//
		var count = Number('<?php echo $notification_count; ?>') || 0;
		el.setAttribute('data-count', count);
		el.classList.remove('notify');
		el.offsetWidth = el.offsetWidth;
		el.classList.add('notify');
	//	alert(count);
		if(count != 0){
			el.classList.add('show-count');
		}
}
    // $("#dLabel").click(function(){
    //    el.classList.add('show-count');
    // });
//}, false);
</script>
<style type="text/css">
  header nav .rn_NavigationBar .rn_NavigationMenu li{
    padding-right: 1.2em !important;
  }
  
</style>
        </div>
</body>

</html>