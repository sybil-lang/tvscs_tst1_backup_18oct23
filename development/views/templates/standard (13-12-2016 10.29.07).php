<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard"/>
<head>
<meta charset="utf-8"/>
<title>
<rn:page_title/>
</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->
<rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
<rn:theme path="/euf/assets/themes/standard" css="site.css"/>
<link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
<script type="text/javascript" src="/euf/assets/themes/standard/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/euf/assets/themes/standard/js/bootstrap.js"></script>

<rn:head_content/>
<link rel="icon" href="/euf/assets/images/favicon.png" type="image/png"/>
<rn:widget path="utils/ClickjackPrevention"/>
<rn:widget path="utils/AdvancedSecurityHeaders"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.css"  rel="stylesheet" />
<link rel="stylesheet" href="/euf/assets/themes/standard/css/custom-style.css"/>

</head>
<body class="yui-skin-sam yui3-skin-sam" itemscope itemtype="http://schema.org/WebPage">
<a href="#rn_MainContent" class="rn_SkipNav rn_ScreenReaderOnly">#rn:msg:SKIP_NAVIGATION_CMD#</a>
<div class="container-fluid gray_bg">
  <div class="container">
  <div class="row">
      <div class="col-md-3 col-xs-12 text-xs-center text-md-left"><strong><i class="fa fa-phone-square"></i> 044-4587-5478 </strong> (Toll Free) </div>
      <div class="col-md-5 col-xs-12 text-center"><a style="color:white;" href="#">ABOUT</a> | <a style="color:white;" href="#">INVESTOR</a> | <a style="color:white;" href="#">CAREER</a></div>
      
		 <div class="col-md-2">Follow Us <i class="fa fa-facebook round facebook"></i> <i class="fa fa-twitter round twitter"></i> <i class="fa fa-linkedin round linkedin"></i></div>
		 <div class="col-md-2 col-xs-12 text-right">
				<div class="rn_LoginStatus">
							<rn:condition logged_in="true">
								
										<rn:widget path="login/AccountDropdown" subpages="#rn:msg:ACCOUNT_OVERVIEW_LBL# > account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > account/profile"/>
									
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
    <a href="<?php echo $site_url;?>/"><img src="images/brand-logo.png"></a>
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
	<!-- End OF Search -->
  </div>
</div>
</div>
<rn:condition logged_in="true">
<header>

  <nav>
    <div class="rn_NavigationBar">
      <input type="checkbox" id="rn_NavigationMenuButtonToggle" class="rn_ScreenReaderOnly" />
      <label class="rn_NavigationMenuButton" for="rn_NavigationMenuButtonToggle"> #rn:msg:MENU_LWR_LBL# </label>
      <ul class="rn_NavigationMenu">
        <li>
          <i class="fa fa-home" aria-hidden="true"></i><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:SUPPORT_HOME_TAB_HDG#" link="/app/#rn:config:CP_HOME_URL#" pages="home"/>
        </li>
		<li>
			<i class="icon-dashboard"></i> <a href="<?php echo $site_url;?>/app/customer/dashboard">Dashboard</a>
		 </li>
		 <li>
		 <i class="icon-cog"></i> <a href="<?php echo $site_url;?>/app/customer/selfserviceview">Self-Service</a>
		 </li>
		 <li>
		 <i class="icon-group"></i> <a href="<?php echo $site_url;?>/app/customer/dashboard">Value-Added Services</a>
		 </li>
		  <li>
		 <i class="icon-desktop"></i> <a href="<?php echo $site_url;?>/app/customer/wallet">Wallet</a>
		 </li>
		 <li>
		 <i class="icon-envelope"></i> <a href="<?php echo $site_url;?>/app/account/profile">General</a>
		 </li>
		 <li>
		 <i class="icon-question-sign"></i><rn:widget path="navigation/NavigationTab" label_tab="#rn:msg:ASK_QUESTION_HDG#" link="/app/raisequery" pages="raisequery, ask_confirm"/></li>
		 <li data-toggle="modal" data-target="#myModal" id="call_back">
		 <i class="icon-phone"></i> Call me Back</li>
		 </li>
      </ul>
    </div>
    
    <!--  <rn:condition hide_on_pages="home, public_profile, results, answers/list, social/questions/list">
            <div class="rn_SearchBar">
                <rn:widget path="search/SimpleSearch" report_page_url="/app/results"/>
            </div>
        </rn:condition>--> 
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
  <div class="rn_Container">
    <!--<rn:widget path="search/ProductCategoryList" report_page_url="/app/products/detail"/>-->
	<div class="footer-bottom text-center">
		<div class="container">
			<div class="pull-center">
				<ul>
					<li><a href="#">
					Copyright @ 2016 All rights reserved by TVS Credit Services Limited.
					</a></li>
					<li><a href="#">Terms and Conditions | Privacy Policy</a></li>
					<li><a href="#">helpdesk@tvsc.co.in</a></li>
				</ul>
			</div>
		</div>
	</div>  </div>
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
        <div class="modal-body">
          <p id="response_text">Logging Request......</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Modal -->

<!-- script for modal -->
<script>
$("#call_back").click(function() {
	//alert( "Handler for .click() called." );
			$.post( "/cc/AjaxCustom/create_inc", { url: "https://RNTpartner_VirtuosNarendra:Rightnow!1@tvscs.custhelp.com/services/rest/connect/v1.3/incidents" })
				.done(function( data ) {
				console.log( "Data Loaded: " + data );
				$("#response_text").html("Your request is logged and our representative will call you back ASAP!");
			});
});
</script>
<!-- script for modal -->
</body>
</html>
