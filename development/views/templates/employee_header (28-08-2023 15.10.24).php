<?php
$CI = &get_instance();

$CI->load->helper('report');


//100107Array ( [0] => Array ( [Dealer] => 6937 [Full Name] => SUNIL TRACTORS ) ) 
$contact_id = $CI->session->getProfileData("c_id");

if (isset($contact_id) && strlen($contact_id)) {
  $contact = RightNow\Connect\v1_3\Contact::fetch($contact_id);
  $enable_walkin_customers = $contact->CustomFields->c->enable_walkin_customer;
}

$msg = RightNow\Connect\v1_3\MessageBase::fetch(CUSTOM_MSG_all_agreements_list);

?>
<!DOCTYPE html>
<html lang="#rn:language_code#">
<rn:meta javascript_module="standard" />

<head>
  <meta charset="utf-8" />
  <title>
    TVS Credit
  </title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta charset="UTF-8">
  <title>TVS Credits</title>
  <meta name="description" content="tvs" field="metaDescription" />
  <meta name="keywords" content="tvs" field="metaKeywords" />
  <Meta name="robots" content="noydir" />
  <Meta name="robots" content="noodp" />
  <meta http-equiv="X-UA-Compatible" content="IE=11">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <!--[if lt IE 9]><script src="/euf/core/static/html5.js"></script><![endif]-->

  <rn:widget path="search/BrowserSearchPlugin" pages="home, answers/list, answers/detail" />
  <rn:theme path="/euf/assets/themes/standard/css" css="site.css,style.css,style-product.css,styles.css,style-product.css,customerlogin-style.css" />

  <link rel="stylesheet" href="/euf/assets/themes/standard/css/font-awesome.min.css">
  <link href="/euf/assets/themes/standard/css/dealerlogin-style.css" rel="stylesheet">
  <rn:head_content />
  <link rel="icon" href="/euf/assets/themes/standard/Images-new/favicon.png" type="image/png" />
  <rn:widget path="utils/ClickjackPrevention" />
  <rn:widget path="utils/AdvancedSecurityHeaders" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/euf/assets/themes/standard/css/custom-style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/euf/assets/themes/standard/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="/euf/assets/themes/standard/js/bootbox.min.js"></script>
  <!--<link href="/euf/assets/themes/standard/css/magicsuggest-min.css" rel="stylesheet">
  <script src="/euf/assets/themes/standard/js/magicsuggest.js"></script>-->
  <link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/tautocomplete.css" />
  <script src="/euf/assets/themes/standard/js/tautocomplete.js" type="text/javascript"></script>
  <link href="/euf/assets/themes/standard/css/style-product.css" rel="stylesheet">
  <link href="/euf/assets/themes/standard/css/customerlogin-style.css" rel="stylesheet">

  <link href="/euf/assets/themes/standard/css/style.css" rel="stylesheet">
  <style type="text/css">
    .customers_login #header1 #logo img {
      width: 200px !important;
    }

    .customers_login #header1 #logo {
      margin-top: 5px;
    }

    .close {
      font-size: 54px !important;
    }

    /* .modal-body
      {
              height: 169px;
      } */
    #customerModal {
      height: 388px;
      width: 599px;
      overflow: hidden;
    }

    .rn_DisplayName {
      position: relative;
      height: 30px;
    }

    .rn_LoggedInUser {
      height: 42px;
      border: 1px solid black;
    }

    .rn_LoginStatus {
      right: 10px;
      position: relative;
    }

    #nav-menu-container {
      left: 185px !important;
    }

    /*   #mailid
      {
          bottom: 21px;
          position: relative;
      }*/
    nav.navbar {
      position: relative;
      bottom: 54px;
    }

    .custom_log employee_log {
      font-family: raleway-regular !important;
    }

    header nav {
      margin-left: 57px !important;
    }

    .nav-stacked {
      margin-top: 0px !important;
    }

    .nav-pills {
      margin-bottom: 12px !important;
    }

    .nav-stacked li a {
      margin-left: 0px !important;
    }

    .nav-stacked li {
      line-height: 25px;
    }

    .nav-stacked li a .fa {
      color: #ffffff !important;
    }

    header nav {
      max-width: 1280px !important;
    }

    .navbar-right-e {
      float: right !important;
      margin-right: 0px !important;
      top: 38px;
      position: relative;
    }

    .customers_login #nav-menu-container {
      top: 5%;
      /*left: 20%;*/
    }
  </style>
  <!-- Google Tag Manager -->

  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start':

          new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],

        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =

        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);

    })(window, document, 'script', 'dataLayer', 'GTM-KBWP7ZJ');
    var submit_variable = "";
  </script>

  <!-- End Google Tag Manager -->
</head>

<body>
  <!-- Google Tag Manager (noscript) -->

  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBWP7ZJ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

  <!-- End Google Tag Manager (noscript) -->
  <div id="wrapper" class="customers_login employee_log">
    <header id="header1">
      <div class="container1">

        <div id="logo" class="pull-left">
          <a class="" href="http://183.87.127.174:8787/"><img src="/euf/assets/themes/standard/Images-new/TVSCSlogo.png" alt="TVS Credits" /s></a>
        </div>
        <div class="pull-right login-search-panel">
          <ul class="nav-menu navbar-right primary-menu">

            <li class="dropdown search-slide">
              <div class="social-statuses"><span> </span><a href="https://www.facebook.com/TVSCREDIT" target="_blank"><i class="fa fa-facebook  facebook"></i></a> <a href="https://twitter.com/TVSCredit" target="_blank"><i class="fa fa-twitter twitter"></i></a> <a href="https://www.linkedin.com/company-beta/1481214?pathWildcard=1481214" target="_blank"><i class="fa fa-linkedin  linkedin"></i></a>
              </div>

            </li>

            <li class="dropdown login-dropdown logins-dropdown hover-dropdown customermain_login  hidden-md visible-sm visible-xs">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="/euf/assets/themes/standard/Images-new/dropdown icon.png" class="img-responsive hovers-back" alt="dots">
                <img src="/euf/assets/themes/standard/Images-new/dropdown icons.png" class="img-responsive hovers-no" alt="dots" style="display:none">
                <span class="mobile-nav-title"></span>
              </a>
              <ul class="dropdown-menu slide-animate">
                <li>
                  <div class="contact-info">
                    <!--<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/contact-us icon.png">Contact Us: <a href="callto://+18004253883">1800 425 3883</a></p> (Toll Free) </div>-->
                  </div>
                </li>
                <li>
                  <div class="contact-info  text-capitalize">
                    <div class="contacts">
                      <p><a href="http://183.87.127.174:8484/about-us/">about us</a></p>
                    </div>
                  </div>
                </li>

                <li>
                  <div class="contact-info text-capitalize">
                    <div class="contacts">
                      <p> <a href="http://183.87.127.174:8484/investor/"> investors</a></p>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="contact-info text-capitalize">
                    <div class="contacts">
                      <p> <a href="http://183.87.127.174:8484/careers/">careers</a></p>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
          <div class="col-md-2 col-xs-12 login">
            <div class="rn_LoginStatus">
              <rn:condition logged_in="true">

                <rn:widget path="custom/login/employeeAccountDropdown" subpages="#rn:msg:ACCOUNT_OVERVIEW_LBL# > employee/account/overview, #rn:msg:SUPPORT_HISTORY_LBL# > employee/account/questions/list, #rn:msg:ACCOUNT_SETTINGS_LBL# > employee/account/profile" />
              </rn:condition>
            </div>

          </div>
        </div>
        <nav id="nav-menu-container" class="hidden-xs ">
          <div class="row">
            <div class="contact-info" style="width: 300px;">
              <!--<div class="contacts"><p><img src="/euf/assets/themes/standard/Images-new/contact-us icon.png">Contact Us: <a href="callto://+18004253883">1800 425 3883</a></p> (Toll Free) </div>-->
            </div>
            <div class="contact-info">
              <div class="contacts">
                <p><img src="/euf/assets/themes/standard/Images-new/time-icon.png"><span id="reg">9:00AM to 5:30PM
                  </span></p>
              </div>
            </div>
            <div class="contact-info" id="mailid">
              <div class="contacts">
                <p> <img src="/euf/assets/themes/standard/Images-new/message-icon.png"><a href="mailto:helpdesk@tvscredit.com">helpdesk@tvscredit.com</a></p>
              </div>
            </div>

          </div>
        </nav>
        <!-- <script id="gs-sdk" src='//www.buildquickbots.com/botwidget/v3/demo/static/js/sdk.js?v=3' key="048009c1-d806-4932-b4ce-a5a248921c9a" callback="tAInit"></script> -->
        <script type="text/javascript">
          window.ymConfig = {
            "bot": "x1661764681102",
            "host": "https://chatbotcld.tvscredit.com"
          };
          (function() {

            var w = window,
              ic = w.YellowMessenger;
            if ("function" === typeof ic) ic("reattach_activator"), ic("update", ymConfig);
            else {

              var d = document,
                i = function() {
                  i.c(arguments)
                };

              function l() {

                var e = d.createElement("script");
                e.type = "text/javascript", e.async = !0, e.src = "https://chatbotcld.tvscredit.com/assets/plugin/widget-v2/latest/dist/main.min.js";
                var

                  t = d.getElementsByTagName("script")[0];
                t.parentNode.insertBefore(e, t)

              }
              i.q = [], i.c = function(e) {
                i.q.push(e)
              }, w.YellowMessenger = i, w.attachEvent ? w.attachEvent("onload", l) : w.addEventListener("load", l, !1)

            }

          })();
        </script>
        <!-- Start Chat -->
        <!--  <div class="col-md-3">
              <div class="rn_ChatLink">
                      <rn:widget path="chat/ConditionalChatLink" min_sessions_avail="1" chat_login_page="/app/chat/chat_launch" label_default="Chat directly with a member of our support team." sub_id="conditionalChat"/>
              </div>
      </div>
      End Chat -->

        <!-- Start Search -->
        <!--     <nav id="secondary-nav" class="hidden-xs hidden-sm">
       
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
          <!--	<rn:widget path="chat/ConditionalChatLink" />-->
        </div>
        <div class="col-md-4">
          <div class="rn_SearchControls">
            <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
            <form method="get" action="/app/employee/results">
              <rn:container source_id="KFSearch">
                <div class="rn_SearchInput">
                  <rn:widget path="searchsource/SourceSearchField" initial_focus="true" />
                </div>
                <rn:widget path="searchsource/SourceSearchButton" search_results_url="/app/employee/results" />
              </rn:container>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End OF Search -->
  <rn:condition logged_in="true">
    <header>
      <?php if (checkURL('dealer')) { ?>
        <ul class="nav navbar-nav navbar-right-e">
          <li>
            <a id="changedealer" href="#" class="btn btn-warning btn-lg active" role="button" aria-pressed="true">Change
              Dealer</a>
          </li>
        </ul>
      <?php } elseif (checkURL('customer')) { ?>
        <ul style="list-style: none;z-index: 10;float: right !important;margin-right: 14px !important;top:15px;position: relative;">
          <li>
            <a id="changecustomer" href="#" class="btn btn-warning btn-lg active" role="button" aria-pressed="true" style="font-size:13px;padding-top:0px;">Change Customer</a>
          </li>
        </ul>

      <?php } ?>

      </div>
      </div>
      </div>
    </header>
    </div>


    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="#"></a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" style="padding-top: 7px;">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $site_url; ?>/app/employee/dashboard"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Employee Dashboard</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo $site_url; ?>/app/employee/dealer/questions/list"><i class="fa fa-pie-chart" aria-hidden="true"></i>&nbsp;Dealer Dashboard</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo $site_url; ?>/app/employee/customer/questions/list"><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Customer Dashboard</a></li>
                <!--							<li><a href="#">Something else here</a></li>
                                                                        <li><a href="#">Separated link</a></li>-->
              </ul>
            </li>
            <li>
              <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/dealerquery"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Dealer Helpdesk</a>
              <!-- <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/dealerquery"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Dealer Helpdesk</a> -->
            </li>
            <li>
              <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/customer_dashboard"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;Customer Helpdesk</a>
            </li>
            <li class="lp-dropdown">
              <a href="#" class="dropdown-toggle" id="Agent-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Leads
                <span class="caret"></span></a>
              <ul class="dropdown-menu" data-dropdown-owner="Agent-dropdown">
                <li>
                  <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/lead_generation"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Lead generation</a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/lead_status"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Lead Status</a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/login_status"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Login Status</a>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?php echo $site_url; ?>/app/employee/account/profile"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;Profile</a>
            </li>
            <!-- <li>
              <a href="<?php echo $site_url; ?>/app/employee/tutorial"><i class="fa fa-hourglass-half" aria-hidden="true"></i>&nbsp;Tutorial</a>
            </li>
            <li>
              <a href="<?php echo $site_url; ?>/app/employee/documents"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;Documents</a>
            </li>-->
            <li>
              <a href="<?php echo $site_url; ?>/app/employee/raisequery"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Employee Helpdesk</a>
            </li>
            <?php if ($enable_walkin_customers) { ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-male" aria-hidden="true"></i>&nbsp;Walkin <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="<?php echo $site_url; ?>/app/employee/walkin_dashboard"><i class="fa fa-male"></i>&nbsp;Walkin Dashboard</a>
                  </li>
                  <li>
                    <a href="<?php echo $site_url; ?>/app/employee/walkin_reports"><i class="fa fa-male"></i>&nbsp;Walkin
                    Reports</a>
                  </li>
                </ul>
              </li>
              
              
              <?php } ?>
              <li>
                <a href="<?php echo $site_url; ?>/app/employee/customer/questions/list2"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Dealer Tickets</a>
              </li>
            <!--             
            <li class="lp-dropdown">
              <a href="#" class="dropdown-toggle" id="Agent-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Walkin <span class="caret"></span></a>
              <ul class="dropdown-menu" data-dropdown-owner="Agent-dropdown">
                <li>
                  <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/walkin_dashboard"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Walkin Dashboard</a>
                </li>
                <li role="separator" class="divider"></li>
                <li>
                  <a tabindex="-1" href="<?php echo $site_url; ?>/app/employee/walkin_reports"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Walkin Reports</a>
                </li>
                <li role="separator" class="divider"></li>

              </ul>
            </li> -->






        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    </header>
  </rn:condition>


  <!--<section class="clearfix">
  <div class="main">
    <form method="post" action="/app/employee/dealer_dashboard" name="dealerform" id="dealerform">

     Modal -->
  <!--  <div id="dealerModal" class="modal fade" role="dialog">
        <div id="bootbox-body"></div>
        <div class="modal-dialog">

         Modal content-->
  <!-- <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Select Dealer</h4>
            </div>
            <div class="modal-body">

               <div id="magicsuggest_1"></div>-->
  <!--  <input type="text" name="dealer_no" id="dealer_no" />
            </div>
            <div class="modal-footer">
              <div id="errorimg"></div>		
              <input type="hidden" id="d_code" name="d_code" value="" />
              <input type="hidden" id="d_name" name="d_name" value="" />
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-default" id="btn_update">Ok</button>
            </div>
          </div>

        </div>
      </div>

       Customer Modal -->
  <!-- Modal -->
  <div id="customerModal" class="modal fade" role="dialog" style="height: 460px;">
    <div id="bootbox-body"></div>
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Customer</h4>
        </div>
        <div class="modal-body">

          <input type="text" name="agreement_number" id="agreement_number" />
        </div>
        <div class="modal-footer">
          <div id="errorimg_1"></div>
          <input type="hidden" id="c_code" name="c_code" value="" />
          <input type="hidden" id="c_agreement" name="c_agreement" value="" />
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default" id="btn_change">Ok</button>
        </div>
        <!-- IARC CR -->
        <!-- show this div when user has entered some transferred agr and clicked on okay -->
        <div id="iarc_message" style="display: none;
    margin-top: 17px;
    margin-bottom: -24px; height:200px;overflow-y:auto">
          <pre>
<b style="letter-spacing: 1px;">This loan has been transferred to International Asset Reconstruction Company Private Limited (“IARC”). Please inform the customer to contact the IARC customer support team for any further queries.

Customer Support:

International Asset Reconstruction Company Private Limited,
A-601/602/605, 215 Atrium, Kanakia Spaces,
Andheri Kurla Road, Andheri (East), Mumbai – 400093
Email id: customersupport@iarc.co.in
Customer Support number: 022-45963100 (Between 10:00 A.M. to 07:00 P.M. Monday to Saturday, except National & Public Holidays)
Website: www.iarc.co.in
For online access and payment: res.iarc.co.in</b>
</pre>

          <!-- <p><b style="letter-spacing : 1px;"> This loan has been transferred to International Asset Reconstruction Company Private Limited (“IARC”). Please inform the customer to contact the IARC customer support team for any further queries.



              Customer Support:

              International Asset Reconstruction Company Private Limited,

              A-601/602/605, 215 Atrium, Kanakia Spaces,

              Andheri Kurla Road, Andheri (East), Mumbai – 400093

              Email id: customersupport@iarc.co.in

              Customer Support number: 022-45963100 (Between 10:00 A.M. to 07:00 P.M. Monday to Saturday, except National & Public Holidays)

              Website: www.iarc.co.in

              For online access and payment: res.iarc.co.in</b></p> -->



          <!-- <p><b style="letter-spacing : 1px;"> This agreement is transferred to International Asset Reconstruction
              Company Private Limited (“IARC”).
              Hence loan details are not available.</b></p> -->

        </div>
        <!-- IARC CR -->
      </div>

    </div>
  </div>




  </form>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.modal-backdrop').removeClass('modal-backdrop');

      document.getElementById("agreement_number").addEventListener("change", myFunction);

      function myFunction() {
        if ($('#agreement_number').val == "") {
          $("#iarc_message").css("display", "none");
        }
      }

    });
    var text2 = $("#dealer_no").tautocomplete({
      // width: "700px",
      columns: ['Value', 'Name'],
      placeholder: "Search Dealer Name",
      //	regex: "/^[a-zA-Z0-9]{3,}$/",
      ajax: {
        url: "/cc/EmployeeCustom/getDealerLists",
        type: "GET",
        data: function() {
          var x = {
            query: text2.searchdata()
          };
          return x;
        },
        success: function(result) {

          var filterData = [];

          var searchData = eval("/" + text2.searchdata() + "/gi");

          $.each(result, function(i, v) {
            if (v.name.search(new RegExp(searchData)) != -1) {
              filterData.push(v);
            }
          });
          return filterData;
        }
      },
      onchange: function() {
        // $("#ta-txt").html(text2.text());
        $('#d_code').val(text2.id());
      }
    });
    //$(function() {
    /*    var ms1 = $('#magicsuggest_1').magicSuggest({
       data:  '/cc/EmployeeCustom/getDealerLists',
       maxSelection: 1,
       minChars: 5,
       maxSuggestions: 30,
       renderer: function(data){
   
       return '<div style="padding: 5px; overflow:hidden;">' +
       '<div style="float: left;"><i class="fa fa-address-card" aria-hidden="true"></i></div>' +
       '<div style="float: left; margin-left: 5px">' +
       '<div style="font-weight: bold; color: #333; font-size: 13px; line-height: 11px">' + data.value + '</div>' +
       '<div style="color: #999; font-size: 13px;">' + data.name + '</div>' +
       '</div>' +
       '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff
   
       }
       });
       $(ms1).on('selectionchange', function(e,m){
       $('#errorimg').html('');
       $('#d_code').val(this.getValue());
       });
       $(ms1).on('beforeload', function(){
       // add your gif loader here
       $('#errorimg').html("<img src='images/loading.gif' alt='loading' />").fadeIn();  
       });*/
  </script>

  <script type="text/javascript">
    var queryString = window.location.href;
    console.log(queryString);
    var agg = queryString.split("_");
    console.log(agg);
    console.log("testing");
    console.log(Number.isInteger(agg));


    $("#iarc_message").css("display", "none");

    var text1 = $("#agreement_number").tautocomplete({
      // width: "700px",
      columns: ['Value', 'Name'],
      placeholder: "Search Agreement Number",
      //	regex: "/^[a-zA-Z0-9]{3,}$/",
      ajax: {
        url: "/cc/EmployeeCustom/getIncidentCustomerLists",
        type: "GET",
        data: function() {

          var x = {
            query: text1.searchdata()
          };
          return x;
        },
        success: function(result) {

          var filterData = [];
          var data = text1.searchdata();




          if (text1.searchdata() != "") {
            $.ajax({
                url: "/cc/EmployeeCustom/getTransferredAgreement?query_ag=" + data,
                type: "GET",

                success: function(result) {
                  if (result == "true") {
                    $("#iarc_message").css("display", "block");
                    //                 $("#iarc_message").css("display", "block");
                    //                 setTimeout(hideDiv, 10 * 1000);
                    //                 function hideDiv() {
                    //                   $("#iarc_message").css("display", "none");
                    // }

                    // Set a timeout of 20 seconds (20 * 1000 milliseconds)

                    //   $('#customerModal').mouseover(function() {
                    //   // Action to be performed when mouse leaves the element
                    //   // For example, changing the background color
                    //   $("#iarc_message").css("display", "none");
                    // });

                    //3rd approach
                    var targetElement = document.getElementById('customerModal'); // Replace with the ID of your element

                    document.addEventListener('click', function(event) {
                      var isClickInside = targetElement.contains(event.target);

                      if (!isClickInside) {
                        $("#iarc_message").css("display", "none");
                      } else {

                        $("#iarc_message").css("display", "none");
                      }
                    });

                  } else {
                    $("#iarc_message").css("display", "none");
                  }
                }

              }

            );
          }
          if (agg[1] && Number.isInteger(agg[1])) {
            data = agg[1]
          }



          var searchData = eval("/" + data + "/gi");

          $.each(result, function(i, v) {
            if (v.name.search(new RegExp(searchData)) != -1) {
              filterData.push(v);
            }
          });

          return filterData;
        }
      },
      onchange: function() {
        // $("#ta-txt").html(text2.text());
        $('#c_code').val(text1.id());
        $('#c_agreement').val(text1.text());
        console.log('onchange');
        console.log("bye" + text1.text());

      },









    });

    // if (tautocomplete.isNull()) {
    //   $("#iarc_message").css("display", "none");
    // }







    //IARC
    console.log('IARC');


    ///IARC
    var queryString = window.location.href;
    var agg = queryString.split("_");
    var prof = localStorage.getItem("prof")
    if (agg[1] && !prof) {
      $("#agreement_number").val(agg[1]);
      $.ajax({
        url: "/cc/EmployeeCustom/getIncidentCustomerLists",
        type: "GET",
        data: {
          query: agg[1]
        },
        success: function(result) {

          var filterData = [];
          var data = agg[1];

          console.log(JSON.parse(result))
          var r = JSON.parse(result);
          $('#c_code').val(r[0].id);
          $('#c_agreement').val(r[0].name);

          jQuery.ajax({
            type: 'POST',
            data: {
              'customer_id': $('#c_code').val(),
              'agreement_no': $('#c_agreement').val()
            },
            url: '/cc/EmployeeCustom/setCustomerCode',
            beforeSend: function() {
              // setting a timeout
              $('#bootbox-body').html('<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>');

            },
            success: function(response) {
              //alert(response);

              $('#bootbox-body').html('');
              localStorage.setItem("prof", 1);
              window.location.reload();
            }
          });

          // var searchData = eval ("/" + agg[1] + "/gi");


        }

      });
    }

    /*var ms = $('#magicsuggest_2').magicSuggest({
       data:  '/cc/EmployeeCustom/getIncidentCustomerLists',
       maxSelection: 1,
       minChars: 5,
       id: 'my-customer',
       maxSuggestions: 30,
       renderer: function(data){
   
       return '<div style="padding: 5px; overflow:hidden;">' +
       '<div style="float: left;"><i class="fa fa-address-card" aria-hidden="true"></i></div>' +
       '<div style="float: left; margin-left: 5px">' +
       '<div style="font-weight: bold; color: #333; font-size: 13px; line-height: 11px">' + data.value + '</div>' +
       '<div style="color: #999; font-size: 13px;">' + data.name + '</div>' +
       '</div>' +
       '</div><div style="clear:both;"></div>'; // make sure we have closed our dom stuff
   
       },
       selectionRenderer: function(data){
       $('#c_agreement').val(data.name);
       return  data.name; // make sure we have closed our dom stuff
       }
       });
       $(ms).on('selectionchange', function(e,m){
       $('#errorimg_1').html('');
       console.log(m);
   
       $('#c_code').val(this.getValue());
       });
       $(ms).on('beforeload', function(){
       // add your gif loader here
       $('#errorimg_1').html("<img src='images/loading.gif' alt='loading' />").fadeIn();  
       });*/
  </script>

  <script type="text/javascript">
    $('#changedealer').on('click', function(e) {
      e.preventDefault();
      $("#dealerModal").modal('show');
    });
    $('#btn_update').on('click', function(e) {
      e.preventDefault();
      jQuery.ajax({
        type: 'POST',
        data: {
          'dealer_codes': $('#d_code').val()
        },
        url: '/cc/EmployeeCustom/setDealerCode',
        beforeSend: function() {
          // setting a timeout
          $('#bootbox-body').html('<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>');
          //$(placeholder).addClass('loading');
        },
        success: function(response) {
          //alert(response);
          $('#bootbox-body').html('');
          window.location.reload();
        }
      });
    });

    $('#changecustomer').on('click', function(e) {
      e.preventDefault();
      $("#customerModal").modal('show');
      $('.modal-backdrop').addClass('modal-con');
      $('.modal-backdrop').removeClass('modal-backdrop');
    });
    $("#btn_change").on("click", function() {
      jQuery.ajax({
        type: 'POST',
        data: {
          'customer_id': $('#c_code').val(),
          'agreement_no': $('#c_agreement').val()
        },
        url: '/cc/EmployeeCustom/setCustomerCode',
        beforeSend: function() {
          // setting a timeout
          $('#bootbox-body').html('<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>');

        },
        success: function(response) {
          //alert(response);

          $('#bootbox-body').html('');
          window.location.reload();
        }
      });
    });
  </script>
  </div>
  </section>
  <rn:widget path="utils/CapabilityDetector" />

  <div class="rn_Body">
    <div class="rn_MainColumn" role="main"> <a id="rn_MainContent"></a>
      <rn:page_content />
    </div>
  </div>

  <footer class="rn_Footer">
    <style type="text/css">
      .rn_Hero {
        background-color: #114984;
      }

      .yui3-datatable-table th {
        background-color: #114984;
      }

      a {
        color: #114984;
      }
    </style>
    <div class="rn_Container " id="new3">
      <div class="footer-bottom text-center">
        <div class="container">
          <div class="pull-center">
            <div class="row">
              <ul id="new4">
                <li class="pull-left"><a href="http://www.tvscredit.co.in/termsandcondition.aspx" target="_blank">Terms
                    and Conditions</a>| <a href="http://www.tvscredit.co.in/privacypolicy.aspx" target="_blank">Privacy
                    Policy</a></li>
                <li><a href="/#" style="pointer-events:none;">
                    Copyright © 2018 All rights reserved by TVS Credit Services Limited. </a></li>
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


</body>