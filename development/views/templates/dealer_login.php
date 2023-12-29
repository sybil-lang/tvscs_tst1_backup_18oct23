<?php
$CI=&get_instance();

$contact_id=$CI->session->getProfileData("c_id");
//$dealer_contact = \RightNow\Connect\v1_3\Contact::fetch($contact_id);

if(!empty($contact_id)){
	$userData = $CI->session->getSessionData('userProfile');
}else{
	$userData = array();
}
if(strlen($contact_id)){
  $CI->load->helper('report');
  $eligibleForWorkingRequest = isDealerEligibleForWorkingRequest();
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
	<rn:theme path="/euf/assets/themes/standard/css" css="site.css,style.css,styles.css,style-product.css,select.dataTables.min.css,dataTables.bootstrap.min.css,customerlogin-style.css,custom_dashboard.css,buttons.dataTables.min.css,bootstrap-datetimepicker.min.css"/>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
	<link rel="stylesheet" href="/euf/assets/themes/standard/Css-new/font-awesome.min.css">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
      <script type="text/javascript" src="/euf/assets/themes/standard/js/jquery-1.10.2.min.js"></script>
	  <script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap.js"></script>

	  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
   <!--   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
<link  href="/euf/assets/themes/standard/Css-new/style-product.css" rel="stylesheet">
	  <link  href="/euf/assets/themes/standard/Css-new/customerlogin-style.css" rel="stylesheet">
	  <rn:head_content/>
	  <link rel="icon" href="/euf/assets/themes/standard/Images-new/favicon.png" type="image/png"/>
	  <rn:widget path="utils/ClickjackPrevention"/>
      <rn:widget path="utils/AdvancedSecurityHeaders"/>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/euf/assets/themes/standard/Css-new/custom-style.css"/>
      <link  href="/euf/assets/Images-new/favicon.png" rel="shortcut icon">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  
      <link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link  href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
      <link  href="/euf/assets/themes/standard/Css-new/style.css" rel="stylesheet">
      <link  href="/euf/assets/themes/standard/Css-new/style-product.css" rel="stylesheet">
	  <link  href="/euf/assets/themes/standard/Css-new/customerlogin-style.css" rel="stylesheet">
    <link  href="/euf/assets/themes/standard/Css-new/style.css" rel="stylesheet">
	<style type="text/css">
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
        
	</style>

</head>

<body>
    <div id="wrapper" class="customers_login">
<header id="header1">
   <div class="container1">
	<a href="#rn_MainContent" class="rn_SkipNav rn_ScreenReaderOnly">#rn:msg:SKIP_NAVIGATION_CMD#</a>

	<div id="logo" class="pull-left">
         <a class="" href="<?php echo $site_url;?>"><img src="/euf/assets/themes/standard/Images-new/logo.png" alt="TVS Credits"/s></a>
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
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/mobile_icon/contact-us icon.png">Contact Us: <a href="callto://+18004255008">1800 425 5008</a></p> (Toll Free) </div>
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
						<rn:condition logged_in="true">

<rn:widget path="custom/login/dealerAccountDropdown" subpages="#rn:msg:ACCOUNT_OVERVIEW_LBL# > dealer/account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > dealer/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > dealer/account/profile"/>
						</rn:condition>
					</div>

				</div>
			
		

<nav id="nav-menu-container" class="hidden-xs ">
	  <div class="row">
	  <div class="contact-info">
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/contact-us icon.png">Contact Us: <a href="callto://+18004255008">1800 425 5008</a></p> (Toll Free) </div>
	  </div>
	   <div class="contact-info">
<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/time-icon.png"><span id="reg">9:00AM to 5:30PM
</span></p></div>
	  </div>
	  <div class="contact-info">
 <div class="contacts"><p> <img src="/euf/assets/themes/standard/Images-new/message-icon.png"><a href="mailto:dealer.helpdesk@tvscredit.com">dealer.helpdesk@tvscredit.com</a></p>
	  </div>
	  </div>
       
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
        
    
    </div>
</header>
			<div class="second-nav customer-service-info ">
<div class="row">
<div class="col-md-offset-4 col-md-3">
		<div class="rn_ChatLink">
					<rn:widget path="chat/ConditionalChatLink" min_sessions_avail="1" chat_login_page="/app/chat/chat_launch" label_default="Chat directly with a member of our support team." sub_id="conditionalChat"/>
				</div>
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
    
			<!-- End OF Search -->
    

	<rn:condition logged_in="true">
	<div style="background-color: #ECF0F1; height:22px;">
	<marquee scrolldelay="60" style="valign: middle;" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
				<p style="color:#FF5733;font-size: 14px;">
				<b> Dear Sir / Madam, Please transfer the TA / WC reimbursement only in the following account for faster updation / reconciliation. Thanks for your understanding. Beneficiary Name - TVS CREDIT SERVICES LIMITED, Credit Account Number - 30711501927, Bank - STATE BANK OF INDIA, CAG Branch, Egmore, Chennai – 600 008, IFSC Code - SBIN0009999.
				</b>
				</p>
			</marquee>
	</div>
	<header>
			<nav>			
				<div class="rn_NavigationBar">
					<input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly"/>
					<label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
					<ul class="rn_NavigationMenu">
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
							<i class="fa fa-money" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/incentive">Incentives & Claims</a>
						</li>
						<li>
							<i class="fa fa-address-card-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/account/overview">Overview</a>
						</li>
						<li>
							<i class="fa fa-question-circle"></i>
							&nbsp;<a href="<?php echo $site_url;?>/app/dealer/raisequery">Raise a Query</a>
						</li>
						<li>
							<i class="fa fa-question-circle-o" aria-hidden="true"></i>&nbsp;<a href="<?php echo $site_url;?>/app/dealer/answers/list">FAQ</a>
						</li>
						<!--<li>
							<i class="icon-envelope"></i> <a href="<?php// echo $site_url;?>/app/account/profile">General</a>
						</li>
						<li>
							<i class="icon-question-sign"></i>
							<rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/raisequery" pages="raisequery, ask_confirm"/>
						</li>-->
					<li>
							<i class="fa fa-phone"></i>&nbsp;<a href="javascript:void();" data-toggle="modal" data-target="#myModal">Call me Back</a>
						</li>
					</ul>
				</div>

				<!--  <rn:condition hide_on_pages="home, public_profile, results, answers/list, social/questions/list">
            <div class="rn_SearchBar">
                <rn:widget path="search/SimpleSearch" report_page_url="/app/results"/>
            </div>
        </rn:condition>-->
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
								<label for="exampleInputEmail1">Preferred contact no.</label>
								<input type="number" class="form-control" id="contact_number"  name="contact_number"aria-describedby="Preferred contact no" placeholder="Enter Mobile Number" maxlength="10" required >
								<small id="emailHelp" class="form-text text-muted">&nbsp;</small>
							  </div>
							 
							  
							<div class="form-group">
								<label for="datetimepicker">Preferred Date/Time to speak</label>
								<div class='input-group date' id='datetimepicker8'>
									<input type='text' class="form-control" name="datetime_speak" />
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
				
  
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="call_back">Submit</button>

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
			if($('#contact_number').val() == ''){
				bootbox.alert("<p>Please Enter valid Mobile No</p>");
				validFlag = true;
			}else{
				validFlag = false;
			}

			if(!validFlag){
				$( "#response_text" ).html("Logging Request......");
				$.ajax({
							url: "/cc/DealerCustom/create_inc",
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
											window.location.href= '/app/dealer/ask_confirm/i_id/'+obj[0].value_id;
								}
							}
				   });
			}
		} );
	</script>
	<!-- script for modal-->
			</nav>
		</header>
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
        </div>
</body>

</html>